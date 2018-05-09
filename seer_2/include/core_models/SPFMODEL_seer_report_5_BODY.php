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
SPF REPORT 5 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_10."</B><BR>
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

/* CHECK IF ANY MACHINE IS SELF-CLEANING */
/* -- REFERENCE THE LOCAL OPTIONS FILE FOR THIS MODEL */
/* ------------------------------------------------------------------ */
model_SPF_check_for_self_cleaning_machines_in_model($SPFMODEL_NAME,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_COUNT_ADJUSTED);

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		/* -- MACHINE, LINE BEING CLEANED, WATER TYPE, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME, WATER_USAGE */
		model_SPF_export_csv_report_4_zero();

		/* WASH QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, MACHINE_NAME, CIP_STEP, CIP_WATER_TYPE, CIP_WATER_USAGE";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINE_NAME LIKE '".$SPFMODEL_PRESET_PREFIX."%') AND (CIP_STEP ".$SPFMODEL_CIP_STEP_REALSTEPS.") ORDER BY MACHINE_NAME ASC, DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD CONTAINER FOR CIP WATER DISCRETE INSTANCES */
		list($water,$water2,$water3,$discrete_water_instance_count) = model_CIP_water_usage_discrete_container_build($mysql_mod_openopc_query_result,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_NAME,$SPFMODEL_WATER_TYPE_COUNT_ADJUSTED);

		/* LOOP THROUGH THE RESULT SET AND FILL THE RESULT CONTAINER WE DEFINED ABOVE */
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_CIPNAME = $mysql_mod_openopc_query_row['MACHINE_NAME'];
			$mysql_mod_openopc_WORKING_CIP_STEP = $mysql_mod_openopc_query_row['CIP_STEP'];
			/* IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
			$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED = model_COMMON_identify_logical_value_from_name($mysql_mod_openopc_WORKING_CIPNAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED);
			$mysql_mod_openopc_WORKING_WATER_TYPE = $mysql_mod_openopc_query_row['CIP_WATER_TYPE'];
			$mysql_mod_openopc_WORKING_WATER_USAGE = $mysql_mod_openopc_query_row['CIP_WATER_USAGE'];

			/* CHECK IF THIS IS AN EXISTING RECORD (INSTANCE) OR A NEW ONE */
			if ( ($water[$discrete_water_instance_count]["CIPNAME"] == $mysql_mod_openopc_WORKING_CIPNAME) && ($water[$discrete_water_instance_count]["LINEBEINGCLEANED"] == $mysql_mod_openopc_WORKING_LINE_BEING_CLEANED) && ($water[$discrete_water_instance_count]["WATERTYPE"] == $mysql_mod_openopc_WORKING_WATER_TYPE) && ($mysql_mod_openopc_WORKING_CIP_STEP >= $water[$discrete_water_instance_count]["CIP_STEP"]) ) {

				/* HOW TO HANDLE AN EXISTING RECORD */
				$water2["HOLDINGVALUE"][$mysql_mod_openopc_WORKING_CIPNAME] = $mysql_mod_openopc_WORKING_WATER_USAGE;
				$water[$discrete_water_instance_count]["WATEREND"] = $mysql_mod_openopc_WORKING_WATER_USAGE;
				$water[$discrete_water_instance_count]["DATESTAMPEND"] = $mysql_mod_openopc_WORKING_DATESTAMP;
				$water[$discrete_water_instance_count]["CIP_STEP"] = $mysql_mod_openopc_WORKING_CIP_STEP;

			} else {

				/* HOW TO HANDLE A NEW RECORD */
				$discrete_water_instance_count = $discrete_water_instance_count + 1;
				$water[$discrete_water_instance_count]["CIPNAME"] = $mysql_mod_openopc_WORKING_CIPNAME;
				$water[$discrete_water_instance_count]["LINEBEINGCLEANED"] = $mysql_mod_openopc_WORKING_LINE_BEING_CLEANED;
				$water[$discrete_water_instance_count]["CIP_STEP"] = $mysql_mod_openopc_WORKING_CIP_STEP;
				$water[$discrete_water_instance_count]["WATERTYPE"] = $mysql_mod_openopc_WORKING_WATER_TYPE;
				$water[$discrete_water_instance_count]["WATERSTART"] = $water2["HOLDINGVALUE"][$mysql_mod_openopc_WORKING_CIPNAME];
				$water2["HOLDINGVALUE"][$mysql_mod_openopc_WORKING_CIPNAME] = $mysql_mod_openopc_WORKING_WATER_USAGE;
				$water[$discrete_water_instance_count]["WATEREND"] = $mysql_mod_openopc_WORKING_WATER_USAGE;
				$water[$discrete_water_instance_count]["DATESTAMPSTART"] = $mysql_mod_openopc_WORKING_DATESTAMP;
				$water[$discrete_water_instance_count]["DATESTAMPEND"] = $mysql_mod_openopc_WORKING_DATESTAMP;

			}

		}

		/* NOW LET'S TAKE THE RESULT CONTAINER AND USE IT TO BUILD THE */
		/* REPORT BODY */
		/* -- ZERO OUT SOME CONSTANTS */
		$apache_REPORT_RECORDENTRY_BODY = "";
		$apache_SWITCH_ROW_COLOR = 0;
		$apache_REPORT_LAST_SYSTEM = "8675309";
		$apache_REPORT_LAST_LINE = "8675309";
		/* -- LOOP THROUGH THE RESULT CONTAINER */
		$apache_REPORT_LAST_STEP = 0;
		$this_table_first_run = 0;
		$mysql_query_index = 1;
		while ( $mysql_query_index <= $discrete_water_instance_count ) {

			if ( $water[$mysql_query_index]["WATEREND"] > $water[$mysql_query_index]["WATERSTART"] ) {

				/* PULL IN VARIABLES */
				$CIPNAME_EXAMINED = $water[$mysql_query_index]["CIPNAME"];
				$LINEBEINGCLEANED_EXAMINED = $water[$mysql_query_index]["LINEBEINGCLEANED"];
				$STEP_EXAMINED = $water[$mysql_query_index]["CIP_STEP"];
				$WATERTYPE_EXAMINED = $water[$mysql_query_index]["WATERTYPE"];
				$DATESTAMPSTART_EXAMINED = $water[$mysql_query_index]["DATESTAMPSTART"];
				$DATESTAMPEND_EXAMINED = $water[$mysql_query_index]["DATESTAMPEND"];
				$WATERSTART_EXAMINED = $water[$mysql_query_index]["WATERSTART"];
				if ( $WATERSTART_EXAMINED == '' ) {
					$WATERSTART_EXAMINED = 0;
					$water[$mysql_query_index]["WATERSTART"] = $WATERSTART_EXAMINED;
				} else {
					/* pass */
				}
				$WATEREND_EXAMINED = $water[$mysql_query_index]["WATEREND"];

				/* DETERMINE TOTAL WATER USAGE FOR THE INSTANCE */
				$WATERUSED_EXAMINED = $WATEREND_EXAMINED - $WATERSTART_EXAMINED;
				$water[$mysql_query_index]["WATERUSED"] = $WATERUSED_EXAMINED;

				/* CONVERT TO FRIENDLY VALUES */
				$LINEBEINGCLEANED_EXAMINED_FRIENDLY = $SPFMODEL_NAME[$LINEBEINGCLEANED_EXAMINED];
				$WATERTYPE_EXAMINED_FRIENDLY = $SPFMODEL_CIP_WATER_TYPE[$WATERTYPE_EXAMINED];

				/* CALCULATE DURATION IN TIME FOR INSTANCE */
				list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($DATESTAMPSTART_EXAMINED,$DATESTAMPEND_EXAMINED);
				$DURATION_EXAMINED = $apache_function_DURATION_FINAL;

				/* HOW LONG HAS IT BEEN SINCE LAST WASH WE THINK WAS COMPLETE OR DIFFERENT? */
				/* -- IF MORE THAN 15 MINUTES THAN CONFIRM AS A NEW WASH */
				/* -- IF LESS, THEN LET'S SAY IT IS THE SAME WASH */
				list($apache_function_DURATION_FINAL_DISCARD,$apache_REPORT_TIME_BETWEEN_SIMILAR_INSTANCES) = timeDuration($apache_REPORT_LAST_DATESTAMP_END,$DATESTAMPSTART_EXAMINED);

				/* POST THE TOTALIZED RESULTS FOR COMPLETED INSTANCES */
				if ( ($apache_REPORT_LAST_SYSTEM != $CIPNAME_EXAMINED) || ($apache_REPORT_LAST_LINE != $LINEBEINGCLEANED_EXAMINED_FRIENDLY) || ($apache_REPORT_LAST_STEP > $STEP_EXAMINED) || ($apache_REPORT_TIME_BETWEEN_SIMILAR_INSTANCES >= 900) ) {
					if ( $this_table_first_run > 0 ) {
						model_SPF_build_report_4_body($SPFMODEL_WATER_TYPE_COUNT_ADJUSTED, $SPFMODEL_CIP_WATER_TYPE, $multilang_SPFMODEL_115);
					} else {
						/* pass */
					}
				} else {
					/* pass */
				}

				/* TOTALIZE OVER THE INSTANCE */
				$INSTANCE_TOTAL_TIME_UNIXTIME[$WATERTYPE_EXAMINED] = $INSTANCE_TOTAL_TIME_UNIXTIME[$WATERTYPE_EXAMINED] + $apache_function_DURATION_UNIXTIME;
				$INSTANCE_TOTAL_USE[$WATERTYPE_EXAMINED] = $INSTANCE_TOTAL_USE[$WATERTYPE_EXAMINED] + $WATERUSED_EXAMINED;

				/* ADD TO CIPNAME & WATERTYPE TOTAL USAGE ARRAY */
				$water3["TOTAL"][$CIPNAME_EXAMINED][$WATERTYPE_EXAMINED] = $water3["TOTAL"][$CIPNAME_EXAMINED][$WATERTYPE_EXAMINED] + $WATERUSED_EXAMINED;
				$water3["TOTAL"]["ALL"][$WATERTYPE_EXAMINED] = $water3["TOTAL"]["ALL"][$WATERTYPE_EXAMINED] + $WATERUSED_EXAMINED;
				$water3["DURATION"][$CIPNAME_EXAMINED][$WATERTYPE_EXAMINED] = $water3["DURATION"][$CIPNAME_EXAMINED][$WATERTYPE_EXAMINED] + $apache_function_DURATION_UNIXTIME;
				$water3["DURATION"]["ALL"][$WATERTYPE_EXAMINED] = $water3["DURATION"]["ALL"][$WATERTYPE_EXAMINED] + $apache_function_DURATION_UNIXTIME;

				/* CONVERT UNIXTIME TO REAL TIME */
				$apache_unixtime = $water3["DURATION"][$CIPNAME_EXAMINED][$WATERTYPE_EXAMINED];
				$water3["DURATION_HUMAN_READABLE"][$CIPNAME_EXAMINED][$WATERTYPE_EXAMINED] = unixtimeTOrealtime($apache_unixtime);
				$apache_unixtime = $water3["DURATION"]["ALL"][$WATERTYPE_EXAMINED];
				$water3["DURATION_HUMAN_READABLE"]["ALL"][$WATERTYPE_EXAMINED] = unixtimeTOrealtime($apache_unixtime);

				/* PUSH INTO CSV FOR EXPORT */
				model_SPF_export_csv_report_4_build();

				/* BUILD THE BODY OF OUR REPORT */

				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* INSERT A LINE BETWEEN SYSTEM AND LINE COMBINATIONS */
				if ( ($apache_REPORT_LAST_SYSTEM != $CIPNAME_EXAMINED) || ($apache_REPORT_LAST_LINE != $LINEBEINGCLEANED_EXAMINED_FRIENDLY) || ($apache_REPORT_LAST_STEP > $STEP_EXAMINED) || ($apache_REPORT_TIME_BETWEEN_SIMILAR_INSTANCES >= 900) ) {
					if ( $this_table_first_run > 0 ) {
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
						$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
									<TR>
										<TD COLSPAN='7'>
											<BR>
											<BR>
										</TD>
									</TR>
									";
					}
					$this_table_first_run = 1;
				} else {
					/* pass */
				}

				$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$CIPNAME_EXAMINED."
									</TD>
									<TD>
										".$LINEBEINGCLEANED_EXAMINED_FRIENDLY."
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
										".$WATERTYPE_EXAMINED_FRIENDLY."
									</TD>
									<TD>
										".$WATERUSED_EXAMINED."
									</TD>
								</TR>
								";

				/* UPDATE TRACKING FOR LAST SYSTEM AND LINE */
				$apache_REPORT_LAST_SYSTEM = $CIPNAME_EXAMINED;
				$apache_REPORT_LAST_LINE = $LINEBEINGCLEANED_EXAMINED_FRIENDLY;
				$apache_REPORT_LAST_STEP = $STEP_EXAMINED;
				$apache_REPORT_LAST_DATESTAMP_END = $DATESTAMPEND_EXAMINED;

			} else {
				/* pass */
			}

			$mysql_query_index = $mysql_query_index + 1;

		}

		/* PICK UP THE STRAGGLER TOTAL FROM THE LAST CYCLE */

		if ( $this_table_first_run > 0 ) {
			model_SPF_build_report_4_body($SPFMODEL_WATER_TYPE_COUNT_ADJUSTED, $SPFMODEL_CIP_WATER_TYPE, $multilang_SPFMODEL_115);
		} else {
			/* pass */
		}

		/* BUILD THE TOTALS SECTION OF THE REPORT BODY */
		$apache_REPORT_RECORDENTRY_BODY_TOTALS = "";

		$mysql_query_index = 0;
		$this_table_first_run = 0;
		while ($mysql_query_index <= $SPFMODEL_COUNT_ADJUSTED ) {
			/* ONLY LIST SYSTEMS THAT ARE SELF CLEANING */
			if ($SPFMODEL_CIP_BY[$mysql_query_index] == "SELFCLEAN") {

				if ( $this_table_first_run > 0 ) {
					$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
							<TR>
								<TD COLSPAN='7'>
									<BR>
									<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='925' ALT='DIVIDER'><BR>
									<BR>
								</TD>
							</TR>
							";
				} else {
					$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
							<TR>
								<TD COLSPAN='7'>
									<BR>
								</TD>
							</TR>
							";
				}

				$CIPNAME = $SPFMODEL_NAME[$mysql_query_index];
				$this_table_first_run = 1;
				$mysql_query_internal_index = 0;
				while ($mysql_query_internal_index <= $SPFMODEL_WATER_TYPE_COUNT_ADJUSTED) {
					$TOTALWATER_TYPE_EXAMINED = $SPFMODEL_CIP_WATER_TYPE[$mysql_query_internal_index];
					$TOTALWATER_EXAMINED = $water3["TOTAL"][$CIPNAME][$mysql_query_internal_index];
					$TOTALDURATION_EXAMINED = $water3["DURATION_HUMAN_READABLE"][$CIPNAME][$mysql_query_internal_index];
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
										<TD>
											".$CIPNAME."
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
											".$TOTALDURATION_EXAMINED."
										</TD>
										<TD>
											".$TOTALWATER_TYPE_EXAMINED."
										</TD>
										<TD>
											".$TOTALWATER_EXAMINED."
										</TD>
									</TR>
									";

					$mysql_query_internal_index = $mysql_query_internal_index + 1;
				}
			} else {
				/* pass */
			}
			$mysql_query_index = $mysql_query_index + 1;
		}


		$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
							<TR>
								<TD COLSPAN='7'>
									<BR>
									<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='925' ALT='DIVIDER'><BR>
									<BR>
								</TD>
							</TR>
							";

		$mysql_query_internal_index = 0;
		while ($mysql_query_internal_index <= $SPFMODEL_WATER_TYPE_COUNT_ADJUSTED) {
			$TOTALWATER_TYPE_EXAMINED = $SPFMODEL_CIP_WATER_TYPE[$mysql_query_internal_index];
			$TOTALWATER_ALL_EXAMINED = $water3["TOTAL"]["ALL"][$mysql_query_internal_index];
			$TOTALDURATION_ALL_EXAMINED = $water3["DURATION_HUMAN_READABLE"]["ALL"][$mysql_query_internal_index];

			if ( $TOTALDURATION_ALL_EXAMINED == "0" ) {
				$TOTALDURATION_ALL_EXAMINED = "00d_00h_00m_00s";
			} else {
				/* pass */
			}

			/* ADD TO THE TOTAL SECTION */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();
			$apache_REPORT_RECORDENTRY_BODY_TOTALS = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
							<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
								<TD>
									".$multilang_SPFMODEL_123."
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
									".$TOTALWATER_TYPE_EXAMINED."
								</TD>
								<TD>
									".$TOTALWATER_ALL_EXAMINED."
								</TD>
							</TR>
							";

			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}


		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$multilang_CIPMODEL_77);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='129'>
									</TD>
									<TD WIDTH='170'>
									</TD>
									<TD WIDTH='116'>
									</TD>
									<TD WIDTH='116'>
									</TD>
									<TD WIDTH='116'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<P CLASS='INFOREPORTBIGTEXT'>
											[".$multilang_STATIC_AGGREGATE."] ".$multilang_SPFMODEL_121."...
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
										<B><U>".$multilang_SPFMODEL_21."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_22." [".$SPFMODEL_UM_WATER."]</U></B>
									</TD>
								</TR>
								";
		/* -- ADD TOTALS */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_BODY_TOTALS."
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<P CLASS='INFOREPORTBIGTEXT'>
										[".$multilang_STATIC_DISCRETE."] ".$multilang_SPFMODEL_122."...
										</P>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_15."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_126."</U></B>
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
										<B><U>".$multilang_SPFMODEL_21."</U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U>".$multilang_SPFMODEL_22." [".$SPFMODEL_UM_WATER."]</U></B>
									</TD>
								</TR>
								".$apache_REPORT_RECORDENTRY_BODY."
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE BODY */
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_STATIC_SELECT_FROM_DROPDOWN);
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
