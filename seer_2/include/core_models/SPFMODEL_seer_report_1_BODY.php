<?php

/*
S.E.E.R.
---------------------------------------------------------------------
System and Environment Effective Reports
-- version 2, codename: Brahma Bull
     ________________
   `/    \-'  '-/    \`
          \    /
          (\||/)

---------------------------------------------------------------------
 ... the http / web based front-end of mod_openopc, providing
     live HMI / reporting / and history functionality.
---------------------------------------------------------------------
---------------------------------------------------------------------
COPYRIGHT

 THE FOLLOWING 18 LINES MAY NOT BE REMOVED, but may be
     appended with additional contributor info.
 SEER 2
 Copyright (C) 2008 - 2013
 V. Spinelli for Sorrento Lactalis American Group
 Copyright (C) 2013 - 2014
 V. Spinelli for SpinelliCreations
 Copyright (C) 2014
 V. Spinelli for Harper International, Corp.
 Copyright (C) 2016
 V. Spinelli and J. Trembley for RS Automation, LLC.
 This program comes with ABSOLUTELY NO WARRANTY;
 As this program is based on [and has dependancies]
 the content of GPL and LGPL works, GPL is preserved (AGPL)
 This is open software, released under GNU AGPL v3,
 and you are welcome to redistribute it, with this
 tag in tact.
 A copy of the AGPL should be included with this work.
 If you did not receive a copy, see...
 http://www.gnu.org/licenses/agpl-3.0.txt
---------------------------------------------------------------------
---------------------------------------------------------------------
CONTACT		
		Author			V. Spinelli
				Email:	Vince@SpinelliCreations.com
				Site:	http://spinellicreations.com
				Handle:	PoweredByDodgeV8

		Copyright Holder	Sorrento Lactalis American Group
				Email:	http://www.sorrentocheese.com/about/contact.html
				Site:	http://www.sorrentolactalis.com

					SpinelliCreations
				Email:	Admin@SpinelliCreations.com
				Site:	http://www.spinellicreations.com

					Harper International, Corp.
				Email:	info@harperintl.com
				Site:	http://www.harperintl.com
					
					RS Automation, LLC.
				Email:	RickS@rsautomation.net
				Site:	http://www.rsautomation.net
---------------------------------------------------------------------
SPF REPORT 1 BODY (INCLUDED TO ALL SPFMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_6."</B><BR>
								<I>".$SPFMODEL_SUBPAGETITLE."</I><BR>
								<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE",$multilang_STATIC_UNKNOWN);
	/* -- ADDITIONAL OPTIONS */
	$mysql_ENTRY_DISPLAY_EVERY_POWER_INSTANCE = $mysql_ENTRY_OPTIONNAME;

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		model_SPF_export_csv_report_1_zero();

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, MACHINE_NAME, STATE, POWER_TOTAL";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINE_NAME LIKE '".$SPFMODEL_PRESET_PREFIX."%') ORDER BY MACHINE_NAME ASC, DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD A CONTAINER FOR DISCRETE POWER INSTANCES */
		list($power,$power2,$power3,$power4,$discrete_power_instance_count) = model_SPF_power_usage_discrete_container_build($mysql_mod_openopc_query_result,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_NAME);

		/* LOOP THROUGH THE RESULT SET AND FILL THE RESULT CONTAINER WE DEFINED ABOVE */
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_MACHINE_NAME = $mysql_mod_openopc_query_row['MACHINE_NAME'];
			$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
			$mysql_mod_openopc_WORKING_POWER_TYPE = 0; /* INTENTIONALLY STATIC */
			$mysql_mod_openopc_WORKING_POWER_TOTAL = $mysql_mod_openopc_query_row['POWER_TOTAL'];

			/* CHECK IF THIS IS AN EXISTING RECORD (INSTANCE) OR A NEW ONE */
			if ( ($power[$discrete_power_instance_count]["MACHINE_NAME"] == $mysql_mod_openopc_WORKING_MACHINE_NAME) && ($power[$discrete_power_instance_count]["STATE"] == $mysql_mod_openopc_WORKING_STATE) && ($power[$discrete_power_instance_count]["POWERTYPE"] == $mysql_mod_openopc_WORKING_POWER_TYPE) ) {

				/* HOW TO HANDLE AN EXISTING RECORD */
				$power2["HOLDINGVALUE"][$mysql_mod_openopc_WORKING_MACHINE_NAME] = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				if ($mysql_mod_openopc_WORKING_POWER_TOTAL >= $power[$discrete_power_instance_count]["POWEREND"]) {
					/* INSTANCE WHERE TOTALIZER ROLLOVER HAS -NOT- OCCURRED */
					$power[$discrete_power_instance_count]["POWEREND"] = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				} else {
					/* INSTANCE WHERE TOTALIZER ROLLOVER HAS OCCURRED */
					$power[$discrete_power_instance_count]["POWEREND"] = ( $SPFMODEL_TOTALIZER_ROLLOVER - $power[$discrete_power_instance_count]["POWEREND"] ) + $mysql_mod_openopc_WORKING_POWER_TOTAL;
				}
				$power[$discrete_power_instance_count]["DATESTAMPEND"] = $mysql_mod_openopc_WORKING_DATESTAMP;

			} else {

				/* HOW TO HANDLE A NEW RECORD */
				$discrete_power_instance_count = $discrete_power_instance_count + 1;
				$power[$discrete_power_instance_count]["MACHINE_NAME"] = $mysql_mod_openopc_WORKING_MACHINE_NAME;
				$power[$discrete_power_instance_count]["STATE"] = $mysql_mod_openopc_WORKING_STATE;
				$power[$discrete_power_instance_count]["POWERTYPE"] = 0;
				if (isset($power[$discrete_power_instance_count]["POWERSTART"])) {
					/* SUBSEQUENT CYCLES */
					$power[$discrete_power_instance_count]["POWERSTART"] = $power2["HOLDINGVALUE"][$mysql_mod_openopc_WORKING_MACHINE_NAME];
				} else {
					/* FIRST CYCLE FOR THIS MACHINE */
					$power[$discrete_power_instance_count]["POWERSTART"] = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				}
				$power2["HOLDINGVALUE"][$mysql_mod_openopc_WORKING_MACHINE_NAME] = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				$power[$discrete_power_instance_count]["POWEREND"] = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				$power[$discrete_power_instance_count]["DATESTAMPSTART"] = $mysql_mod_openopc_WORKING_DATESTAMP;
				$power[$discrete_power_instance_count]["DATESTAMPEND"] = $mysql_mod_openopc_WORKING_DATESTAMP;

			}
		}

		/* NOW LET'S TAKE THE RESULT CONTAINER AND USE IT TO BUILD THE */
		/* REPORT BODY */
		/* -- ZERO OUT SOME CONSTANTS */
		$apache_REPORT_RECORDENTRY_BODY = "";
		$apache_SWITCH_ROW_COLOR = 0;
		$apache_REPORT_LAST_SYSTEM = "8675309";
		$apache_REPORT_LAST_STATE = "8675309";
		/* -- LOOP THROUGH THE RESULT CONTAINER */
		$apache_REPORT_LAST_STEP = 0;
		$this_table_first_run = 0;
		$mysql_query_index = 1;
		while ( $mysql_query_index <= $discrete_power_instance_count ) {

			if ( $power[$mysql_query_index]["POWEREND"] > $power[$mysql_query_index]["POWERSTART"] ) {

				/* PULL IN VARIABLES */
				$MACHINE_NAME_EXAMINED = $power[$mysql_query_index]["MACHINE_NAME"];
				$STATE_EXAMINED = $power[$mysql_query_index]["STATE"];
				$POWERTYPE_EXAMINED = $power[$mysql_query_index]["POWERTYPE"];
				$DATESTAMPSTART_EXAMINED = $power[$mysql_query_index]["DATESTAMPSTART"];
				$DATESTAMPEND_EXAMINED = $power[$mysql_query_index]["DATESTAMPEND"];
				$POWERSTART_EXAMINED = $power[$mysql_query_index]["POWERSTART"];
				$POWEREND_EXAMINED = $power[$mysql_query_index]["POWEREND"];

				/* DETERMINE TOTAL power USAGE FOR THE INSTANCE */
				$POWERUSED_EXAMINED = $POWEREND_EXAMINED - $POWERSTART_EXAMINED;
				$power[$mysql_query_index]["POWERUSED"] = $POWERUSED_EXAMINED;
				
				/* ADD TO THE DISCRETE TOTALS ARRAY FOR INDIVIDUAL MACHINE ANALYSIS */
				$power4[$STATE_EXAMINED][$MACHINE_NAME_EXAMINED] = $power4[$STATE_EXAMINED][$MACHINE_NAME_EXAMINED] + $POWERUSED_EXAMINED;
				$power4[$STATE_EXAMINED]["ALL"] = $power4[$STATE_EXAMINED]["ALL"] + $POWERUSED_EXAMINED;

				/* CONVERT TO FRIENDLY VALUES */
				$STATE_EXAMINED_FRIENDLY = $SPFMODEL_STATE[$STATE_EXAMINED];
				$POWERTYPE_EXAMINED_FRIENDLY = $POWER_TYPE[$POWERTYPE_EXAMINED];

				/* CALCULATE DURATION IN TIME FOR INSTANCE */
				list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($DATESTAMPSTART_EXAMINED,$DATESTAMPEND_EXAMINED);
				$DURATION_EXAMINED = $apache_function_DURATION_FINAL;
				$DURATION_EXAMINED_SECONDS = $apache_function_DURATION_UNIXTIME;

				/* CALCULATE THE TOTALIZED RESULTS FOR COMPLETED INSTANCES */
				if ($apache_REPORT_LAST_SYSTEM != $MACHINE_NAME_EXAMINED) {
					if ( $this_table_first_run > 0 ) {
						model_SPF_build_report_1_body();
					} else {
						/* pass */
					}
				} else {
					/* pass */
				}

				/* TOTALIZE OVER THE INSTANCE */
				$INSTANCE_TOTAL_TIME_UNIXTIME[$POWERTYPE_EXAMINED] = $INSTANCE_TOTAL_TIME_UNIXTIME[$POWERTYPE_EXAMINED] + $apache_function_DURATION_UNIXTIME;
				$INSTANCE_TOTAL_USE[$POWERTYPE_EXAMINED] = $INSTANCE_TOTAL_USE[$POWERTYPE_EXAMINED] + $POWERUSED_EXAMINED;

				/* ADD TO MACHINE_NAME & POWERTYPE TOTAL USAGE ARRAY */
				$power3["TOTAL"][$MACHINE_NAME_EXAMINED][$POWERTYPE_EXAMINED] = $power3["TOTAL"][$MACHINE_NAME_EXAMINED][$POWERTYPE_EXAMINED] + $POWERUSED_EXAMINED;
				$power3["TOTAL"]["ALL"][$POWERTYPE_EXAMINED] = $power3["TOTAL"]["ALL"][$POWERTYPE_EXAMINED] + $POWERUSED_EXAMINED;
				$power3["DURATION"][$MACHINE_NAME_EXAMINED][$POWERTYPE_EXAMINED] = $power3["DURATION"][$MACHINE_NAME_EXAMINED][$POWERTYPE_EXAMINED] + $apache_function_DURATION_UNIXTIME;
				$power3["DURATION"]["ALL"][$POWERTYPE_EXAMINED] = $power3["DURATION"]["ALL"][$POWERTYPE_EXAMINED] + $apache_function_DURATION_UNIXTIME;

				/* CONVERT UNIXTIME TO REAL TIME */
				$apache_unixtime = $power3["DURATION"][$MACHINE_NAME_EXAMINED][$POWERTYPE_EXAMINED];
				$power3["DURATION_HUMAN_READABLE"][$MACHINE_NAME_EXAMINED][$POWERTYPE_EXAMINED] = unixtimeTOrealtime($apache_unixtime);
				$apache_unixtime = $power3["DURATION"]["ALL"][$POWERTYPE_EXAMINED];
				$power3["DURATION_HUMAN_READABLE"]["ALL"][$POWERTYPE_EXAMINED] = unixtimeTOrealtime($apache_unixtime);

				/* PUSH INTO CSV FOR EXPORT */
				model_SPF_export_csv_report_1_build ();
		
				/* BUILD THE BODY OF OUR REPORT */
				/* -- IF USER REQUESTS DETAILS ONLY */
				if ($mysql_ENTRY_DISPLAY_EVERY_POWER_INSTANCE == 'YES') {
					/* FLIP FLOP ROW COLOR */
					$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

					/* BREAK BETWEEN SYSTEM AND LINE COMBINATIONS */
					if ($apache_REPORT_LAST_SYSTEM != $MACHINE_NAME_EXAMINED) {

						if ( $this_table_first_run > 0 ) {
							/* INSERT A LINE BETWEEN SUBSEQUENT ENTRIES */
							$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='925' ALT='DIVIDER'><BR>
										<BR>
									</TD>
								</TR>
								";
						} else {
							/* pass */
						}

						$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
								<TR>
									<TD COLSPAN='7'>
										<P CLASS='INFOREPORTMEDTEXT'>
											<B><I>... ".$MACHINE_NAME_EXAMINED."</I></B><BR>
											<BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_STATIC_DATESTAMP_START."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_STATIC_DATESTAMP_END."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_STATIC_DURATION_CAPS."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_131." [".$SPFMODEL_UM_POWER."]</U></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								";
					
						/* UNSET FIRST RUN */
						$this_table_first_run = 1;
					} else {
						/* pass */
					}

					$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD>
										".$STATE_EXAMINED_FRIENDLY."
									</TD>
									<TD>
										".$DATESTAMPSTART_EXAMINED."
									</TD>
									<TD>
										".$DATESTAMPEND_EXAMINED."
									</TD>
									<TD>
										".$DURATION_EXAMINED."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										".$POWERUSED_EXAMINED."
									</TD>
								</TR>
								";
				
					/* UPDATE TRACKING FOR LAST SYSTEM AND LINE */
					$apache_REPORT_LAST_SYSTEM = $MACHINE_NAME_EXAMINED;
					$apache_REPORT_LAST_STATE = $STATE_EXAMINED_FRIENDLY;
					$apache_REPORT_LAST_DATESTAMP_END = $DATESTAMPEND_EXAMINED;

				} else {
					/* pass */
				}

			} else {
				/* pass */
			}

			$mysql_query_index = $mysql_query_index + 1;

		}

		/* PICK UP THE STRAGGLER TOTAL FROM THE LAST CYCLE */
		if ( $this_table_first_run > 0 ) {
			model_SPF_build_report_1_body();
		} else {
			/* pass */
		}

		/* BUILD THE TOTALS SECTION OF THE REPORT BODY */
		$apache_REPORT_RECORDENTRY_BODY_TOTALS = "";

		/* -- POWER USAGE BY STATE FOR EACH MACHINE */
		$mysql_query_index = 0;
		$this_table_first_run = 0;
		while ($mysql_query_index <= $SPFMODEL_COUNT_ADJUSTED ) {
			$MACHINE_NAME = $SPFMODEL_NAME[$mysql_query_index];
			$this_table_first_run = 1;
			$mysql_query_internal_index = 0;
			while ($mysql_query_internal_index <= 0) {
				$TOTALPOWER_TYPE_EXAMINED = $POWER_TYPE[0];
				$TOTALPOWER_EXAMINED = $power3["TOTAL"][$MACHINE_NAME][$mysql_query_internal_index];
				$TOTALDURATION_EXAMINED = $power3["DURATION_HUMAN_READABLE"][$MACHINE_NAME][$mysql_query_internal_index];
				if ( $TOTALDURATION_EXAMINED == "0" ) {
					$TOTALDURATION_EXAMINED = "00d_00h_00m_00s";
				} else {
					/* pass */
				}

				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* ADD TO THE TOTAL SECTION */
				$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3'>
										".$MACHINE_NAME."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										".$TOTALDURATION_EXAMINED."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										".$TOTALPOWER_EXAMINED."
									</TD>
								</TR>
								";

				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
			$mysql_query_index = $mysql_query_index + 1;
		}

		/* ADD A DIVIDER BAR FOR ASTHETICS */
		$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='925' ALT='DIVIDER'><BR>
										<BR>
									</TD>
								</TR>
								";

		/* -- POWER USAGE BY STATE FOR ALL MACHINES TOTAL */
		$mysql_query_internal_index = 0;
		while ($mysql_query_internal_index <= 0) {
			$TOTALPOWER_TYPE_EXAMINED = $POWER_TYPE[0];
			$TOTALPOWER_ALL_EXAMINED = $power3["TOTAL"]["ALL"][$mysql_query_internal_index];
			$TOTALDURATION_ALL_EXAMINED = $power3["DURATION_HUMAN_READABLE"]["ALL"][$mysql_query_internal_index];

			if ( $TOTALDURATION_ALL_EXAMINED == "0" ) {
				$TOTALDURATION_ALL_EXAMINED = "00d_00h_00m_00s";
			} else {
				/* pass */
			}

			/* FLIP FLOP ROW COLOR */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

			/* ADD TO THE TOTAL SECTION */
			$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$multilang_SPFMODEL_132."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										".$TOTALDURATION_ALL_EXAMINED."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										".$TOTALPOWER_ALL_EXAMINED."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='925' ALT='DIVIDER'><BR>
										<BR>
									</TD>
								</TR>
								";

			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}

		/* ADD REPORT UPPER SECTION - AGGREGATE PARETO */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<P CLASS='INFOREPORTBIGTEXT'>
										[".$multilang_STATIC_AGGREGATE."] ".$multilang_SPFMODEL_135."...
										</P>
									</TD>
								</TR>
								";

		/* -- ADD THE GUTS OF THE UPPER SECTION - AGGREGATE PARETO */
		/* -- CYCLE THROUGH ALL AND STATES */
		$MACHINE_NAME = "ALL";
		/* -- PUT UP A BANNER FOR THE DISCRETE MACHINE */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<P CLASS='INFOREPORTMEDTEXT'>
										<B><I>... ".$MACHINE_NAME."</I></B><BR>
										<BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>[".$SPFMODEL_UM_POWER."]</U></B>
									</TD>
									<TD COLSPAN='4' ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_136."</U></B>
									</TD>
								</TR>
								";

		/* -- NOW CYCLE THROUGH ARRAY */
		model_SPF_build_report_1_power_pareto();

		/* ADD REPORT LOWER HALF OF UPPER BODY - TOTALS BREAKDOWN */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<P CLASS='INFOREPORTBIGTEXT'>
										<BR>
										[".$multilang_STATIC_AGGREGATE."] ".$multilang_SPFMODEL_128."...
										</P>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_15."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_STATIC_DURATION_CAPS."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_131." [".$SPFMODEL_UM_POWER."]</U></B>
									</TD>
								</TR>
								";

		/* -- INSERT THE BODY_TOTALS SECTION WHICH CONTAINS THIS INFORMATION */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_BODY_TOTALS;

		/* ADD REPORT CENTER SECTION - DISCRETE PARETO */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<BR>
										<P CLASS='INFOREPORTBIGTEXT'>
										[".$multilang_STATIC_DISCRETE."] ".$multilang_SPFMODEL_133."...
										</P>
									</TD>
								</TR>
								";

		/* -- ADD THE GUTS OF THE CENTER SECTION - DISCRETE PARETO */
		/* -- CYCLE THROUGH ALL MACHINES AND STATES */
		$apache_discrete_pareto_index = 0;
		while ($apache_discrete_pareto_index <= $SPFMODEL_COUNT_ADJUSTED) {
			$MACHINE_NAME = $SPFMODEL_NAME[$apache_discrete_pareto_index];
			/* -- PUT UP A BANNER FOR THE DISCRETE MACHINE */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<P CLASS='INFOREPORTMEDTEXT'>
										<B><I>... ".$MACHINE_NAME."</I></B><BR>
										<BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>[".$SPFMODEL_UM_POWER."]</U></B>
									</TD>
									<TD COLSPAN='4' ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_134."</U></B>
									</TD>
								</TR>
								";

			/* -- NOW CYCLE THROUGH ARRAY */
			model_SPF_build_report_1_power_pareto();
			$apache_discrete_pareto_index = $apache_discrete_pareto_index + 1;
		}

		/* ADD REPORT LOWER BODY - DISCRETE INSTANCE SECTION */
		/* -- IF USER REQUESTS DETAILS ONLY */
		if ($mysql_ENTRY_DISPLAY_EVERY_POWER_INSTANCE == 'YES') {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<BR>
										<P CLASS='INFOREPORTBIGTEXT'>
										[".$multilang_STATIC_DISCRETE."] ".$multilang_SPFMODEL_129."...
										</P>
									</TD>
								</TR>
								";

			/* -- ADD THE BODY SECTION TO THE REPORT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_BODY;
		} else {
			 /* pass */
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$multilang_SPFMODEL_130);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
								</TR>
								";
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE REPORT BODY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY;
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* HANDLE FAULTS */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION_FAULT == 1 ) {
	$seer_HMIACTION = "DISPLAY_FAULT_PAGE";
} else {
	/* pass */
}

/* FAULT PAGE */
/* -- SOMETHING DIDN'T GO RIGHT, SO LET THE USER KNOW */
/* ------------------------------------------------------------------ */
core_user_conditionally_executed_fault_page_body();

/* START PAGE */
/* -- REPORT TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	/* OPTION FULFILLMENT */
	$custom_array_of_option_names="<OPTION VALUE='NO'>".$multilang_STATIC_NO."<OPTION VALUE='YES'>".$multilang_STATIC_YES;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_STATIC_SELECT_FROM_DROPDOWN,"NULL","NULL","NULL",$multilang_SPFMODEL_129,$custom_array_of_option_names);
}
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = "";
$apache_REPORTL6 = $apache_REPORT_RECORDENTRY; 
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
