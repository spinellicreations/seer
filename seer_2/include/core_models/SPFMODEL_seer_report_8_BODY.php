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
SPF REPORT 8 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_13."</B><BR>
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
	$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY = $mysql_ENTRY_OPTIONNAME;

	/* -- HANDLE THE OPTION */
	if ( $mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY == 'DEFAULT_PROCESSALLALARMS' ) {
		/* DISPLAY UNDER ANY AND ALL ALARM CONDITIONS */
		$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY_SELECT = "ALARM > '0'";
		$REPORT_TICKET_ALARM_ID = $multilang_STATIC_94;
	} else {
		/* DISPLAY UNDER ONLY THE USER SELECTED ALARM CONDITION */
		$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY_SELECT = "ALARM = ".$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY;
		$REPORT_TICKET_ALARM_ID = $SPFMODEL_ALARM[$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY];
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREP FOR BUILDING A CONTAINER OF FAULTS */
		$post_FAULT_CONDITION_QUALIFIER_STRING = "AND (".$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY_SELECT.") ";

		/* BUILD THE CONTAINER */
		list($fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime,$machine_fault_index_container) = model_COMMON_fault_container_creation_report_3($mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_NAME,$SPFMODEL_mysql_mod_openopc_TABLENAME,"MACHINE_NAME","ALARM",$post_FAULT_CONDITION_QUALIFIER_STRING,$SPFMODEL_STATUS);

		/* BUILD ANOTHER CONTAINER, BUT THIS TIME WITH ONLY THE TOP RATED FAULTS */
		/* -- SOMEWHAT OF AN OXYMORON, AS WHAT THIS ACTUALLY MEANS IS WE'RE GOING TO */
		/*    TAKE ALL THE UNIQUE INSTANCES OF INDIVIDUAL FAULTS AND THEN GROUP THEM */
		/*    TOGETHER TO GET TOTALS FOR EACH TYPE OF FAULT */
		list($fault_container_TOPRATED,$machine_fault_index_container_TOPRATED) = model_COMMON_top_rated_fault_container_creation_report_3($SPFMODEL_COUNT_ADJUSTED,$machine_fault_index_container,$fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime);

		/* SO AFTER ALL THIS, DO WE EVEN HAVE ANY FAULTS TO DISPLAY ?!?! */
		if ( $machine_fault_index_container_TOPRATED == 0 ) {
			/* PROCEED TO A ZEROFAULT OUTPUT */
			$apache_ZERO_FAULT_OUTPUT = "YES";
			$apache_REPORT_RECORDENTRY = core_zero_fault_output();
		} else {
			/* PROCEED TO A REPORT OUTPUT */
			$apache_ZERO_FAULT_OUTPUT = "NO";

			/* PRESORT FAULT ARRAYS PRIOR TO REPORT BODY GENERATION */
			list($fault_container_TOTAL_TOPRATED,$fault_container_TOPRATED,$fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE) = model_COMMON_presort_fault_arrays_report_3($machine_fault_index_container_TOPRATED,$fault_container_TOPRATED,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_ALARM_COUNT_ADJUSTED,$machine_fault_index_container,$fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime);

			/* SORT THE TOPRATED TOTALS ARRAY */
			$mysql_query_internal_index = 0;
			while ( $mysql_query_internal_index <= $SPFMODEL_ALARM_COUNT_ADJUSTED ) {
				$testarray1[$mysql_query_internal_index] = $fault_container_TOTAL_TOPRATED["fault"][$mysql_query_internal_index];
				$testarray2[$mysql_query_internal_index] = $fault_container_TOTAL_TOPRATED["duration_human_readable"][$mysql_query_internal_index];
				$testarray3[$mysql_query_internal_index] = $fault_container_TOTAL_TOPRATED["duration_unixtime"][$mysql_query_internal_index];
				$testarray4[$mysql_query_internal_index] = $fault_container_TOTAL_TOPRATED["frequency"][$mysql_query_internal_index];
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}

			$fault_container_TOTAL_TOPRATED = array();

			/* ---- FIRST SORT - BASED UPON DURATION */
			$array_sort_retvar = array_multisort($testarray3, SORT_DESC, SORT_NUMERIC, $testarray4, $testarray1, $testarray2);
			if ($array_sort_retvar == TRUE) {
				$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_SYNERGISTIC_PARETO = "BGCOLOR='#CCFF66'";
			} else {
				$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_SYNERGISTIC_PARETO = "BGCOLOR='#FF8866'";
			}

			$mysql_query_internal_index = 0;
			while ( $mysql_query_internal_index <= $SPFMODEL_ALARM_COUNT_ADJUSTED ) {
				$fault_container_TOTAL_TOPRATED["fault"][$mysql_query_internal_index] = $testarray1[$mysql_query_internal_index];
				$fault_container_TOTAL_TOPRATED["duration_human_readable"][$mysql_query_internal_index] = $testarray2[$mysql_query_internal_index];
				$fault_container_TOTAL_TOPRATED["duration_unixtime"][$mysql_query_internal_index] = $testarray3[$mysql_query_internal_index];
				$fault_container_TOTAL_TOPRATED["frequency"][$mysql_query_internal_index] = $testarray4[$mysql_query_internal_index];
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}

			/* -- PARETO CHART TOPRATED FAULTS [SYNERGISTIC] BY DURATION */
			if ( $mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY == 'DEFAULT_PROCESSALLALARMS' ) {
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_SYNERGISTIC,$multilang_STATIC_PARETO_DURATION_ALL);
				$apache_PARETO = core_pareto_determination_and_plot("DURATION",$multilang_STATIC_FAULTS_CAPS, $SPFMODEL_ALARM_COUNT_ADJUSTED, $SPFMODEL_ALARM, $fault_container_TOTAL_TOPRATED);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_PARETO;

			} else {
				/* pass */
			}

			/* ---- SECOND SORT - BASED UPON FREQUENCY */
			$array_sort_retvar = array_multisort($testarray4, SORT_DESC, SORT_NUMERIC, $testarray3, $testarray1, $testarray2);

			$mysql_query_internal_index = 0;
			while ( $mysql_query_internal_index <= $SPFMODEL_ALARM_COUNT_ADJUSTED ) {
				$fault_container_TOTAL_TOPRATED["fault"][$mysql_query_internal_index] = $testarray1[$mysql_query_internal_index];
				$fault_container_TOTAL_TOPRATED["duration_human_readable"][$mysql_query_internal_index] = $testarray2[$mysql_query_internal_index];
				$fault_container_TOTAL_TOPRATED["duration_unixtime"][$mysql_query_internal_index] = $testarray3[$mysql_query_internal_index];
				$fault_container_TOTAL_TOPRATED["frequency"][$mysql_query_internal_index] = $testarray4[$mysql_query_internal_index];
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}

			$testarray1 = array();
			$testarray2 = array();
			$testarray3 = array();
			$testarray4 = array();

			/* -- PARETO CHART TOPRATED FAULTS [SYNERGISTIC] BY FREQUENCY */
			if ( $mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY == 'DEFAULT_PROCESSALLALARMS' ) {
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_SYNERGISTIC,$multilang_STATIC_PARETO_FREQUENCY_ALL);
				$apache_PARETO = core_pareto_determination_and_plot("FREQUENCY",$multilang_STATIC_FAULTS_CAPS, $SPFMODEL_ALARM_COUNT_ADJUSTED, $SPFMODEL_ALARM, $fault_container_TOTAL_TOPRATED);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_PARETO;
			} else {
				/* pass */
			}


			/* -- DETAIL TABLE TOPRATED FAULTS (DISCRETE) */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_DISCRETE,($multilang_STATIC_DETAIL_RUNDOWN_ALL." - (1-25)"));
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<B><U>".$multilang_SPFMODEL_46."</U></B>
									</TD>
									<TD WIDTH='300' ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_FAULTS_CAPS."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_START_TIME_CAPS."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_END_TIME_CAPS."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_DURATION_CAPS."</U></B>
									</TD>
								</TR>				
								";

			$mysql_query_internal_index = 0;
			$apache_SWITCH_ROW_COLOR = 0;
			$apache_TOTAL_DURATION_UNIXTIME = 0;
			while ( ($mysql_query_internal_index <= $machine_fault_index_container_TOPRATED) && ($mysql_query_internal_index <= 24) ) {
	
				$fault_container_TOPRATED_CHECK = isset($fault_container_TOPRATED["fault"][$mysql_query_internal_index]);
	
				if ( $fault_container_TOPRATED_CHECK == TRUE ) {

					$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();
	
					$MACHINEMODEL_WORKING_POST_MACHINE = $fault_container_TOPRATED["machine"][$mysql_query_internal_index];
					$MACHINEMODEL_WORKING_POST_FAULT = $fault_container_TOPRATED["fault"][$mysql_query_internal_index];
					$MACHINEMODEL_WORKING_POST_ENDTIME = $fault_container_TOPRATED["starttime"][$mysql_query_internal_index];
					$MACHINEMODEL_WORKING_POST_STARTTIME = $fault_container_TOPRATED["endtime"][$mysql_query_internal_index];
					$MACHINEMODEL_WORKING_POST_DURATION = $fault_container_TOPRATED["duration_human_readable"][$mysql_query_internal_index];
					$apache_TOTAL_DURATION_UNIXTIME = $apache_TOTAL_DURATION_UNIXTIME + $fault_container_TOPRATED["duration_unixtime"][$mysql_query_internal_index];

					/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
					$MACHINEMODEL_WORKING_POST_MACHINE = $SPFMODEL_NAME[$MACHINEMODEL_WORKING_POST_MACHINE];
					$MACHINEMODEL_WORKING_POST_FAULT = $SPFMODEL_ALARM[$MACHINEMODEL_WORKING_POST_FAULT];
					if ( $MACHINEMODEL_WORKING_POST_FAULT == '' ) {
						$MACHINEMODEL_WORKING_POST_FAULT = ".$multilang_STATIC_UNKNOWN.";
					} else {
						/* pass */
					} 

					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$MACHINEMODEL_WORKING_POST_MACHINE."
									</TD>
									<TD ALIGN='CENTER'>
										".$MACHINEMODEL_WORKING_POST_FAULT."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_ENDTIME."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_STARTTIME."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_DURATION."
									</TD>
								</TR>				
								";
				} else {
					/* pass */
				}
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
			/* POST TOTAL DOWNTIME AT END OF TABLE */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B>".$multilang_STATIC_DURATION_CAPS."</B>:
									</TD>
									<TD ALIGN='RIGHT'>
										<B>".unixtimeTOrealtime($apache_TOTAL_DURATION_UNIXTIME)."</B>
									</TD>
								</TR>				
								";
		
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";

			/* -- DETAIL TABLE FAULTS (Individual Systems) */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_DISCRETE,$multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL);
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<BR>
									</TD>
									<TD WIDTH='300' ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_FAULTS_CAPS."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_START_TIME_CAPS."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_END_TIME_CAPS."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_DURATION_CAPS."</U></B>
									</TD>
								</TR>				
								";
	
			$mysql_query_internal_index = 0;
			$apache_SWITCH_ROW_COLOR = 0;
			while ( $mysql_query_internal_index <= $SPFMODEL_COUNT_ADJUSTED ) {
	
				$MODEL_WORKING_MACHINENAME = $mysql_query_internal_index;
				$machine_fault_index_container_CYCLE = 0;
				$machine_fault_index_container_FIRSTRUN = 0;
				$apache_TOTAL_DURATION_UNIXTIME = 0;
				while ( $machine_fault_index_container_CYCLE <= $machine_fault_index_container[$MODEL_WORKING_MACHINENAME] ) {
	
					$fault_container_CHECK = isset($fault_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE]);
					if ( $fault_container_CHECK == TRUE) {
						$fault_container_CHECK_2 = $fault_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
					} else {
						$fault_container_CHECK_2 = 0;
					}
	
					if ( ($fault_container_CHECK == TRUE) && ($fault_container_CHECK_2 != 0) ) {
	
						$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

						/* PULL IN DATA FOR ENTRY */
						$MACHINEMODEL_WORKING_POST_FAULT = $fault_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_ENDTIME = $endtime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_STARTTIME = $starttime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_DURATION = $duration_container_human_readable[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$apache_TOTAL_DURATION_UNIXTIME = $apache_TOTAL_DURATION_UNIXTIME + $duration_container_unixtime[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];

						/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
						$MACHINEMODEL_WORKING_POST_FAULT = $SPFMODEL_ALARM[$MACHINEMODEL_WORKING_POST_FAULT];
						if ( $MACHINEMODEL_WORKING_POST_FAULT == '' ) {
							$MACHINEMODEL_WORKING_POST_FAULT = $multilang_STATIC_UNKNOWN;
						} else {
							/* pass */
						} 
						$MACHINEMODEL_WORKING_POST_MACHINE = $SPFMODEL_NAME[$MODEL_WORKING_MACHINENAME];

						if ( $machine_fault_index_container_FIRSTRUN == 0 ) {
							/* POST A MACHINE HEADER ROW */
							$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='5'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<BR>
											<B><I>".$MACHINEMODEL_WORKING_POST_MACHINE."</I></B> - ".$multilang_STATIC_ITEMIZED.":<BR>
											<BR>
										</P>
									</TD>
								</TR>				
								";
							/* UNSET FIRST RUN IF IT EXISTS */
							$machine_fault_index_container_FIRSTRUN = 1;
						} else {
							/* pass */
						}
						/* POST THE ENTRY TO A ROW */
						$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										".$MACHINEMODEL_WORKING_POST_FAULT."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_STARTTIME."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_ENDTIME."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_DURATION."
									</TD>
								</TR>				
								";
					} else {
						/* pass */
					}
					/* INDEX THE LOOP */
					$machine_fault_index_container_CYCLE = $machine_fault_index_container_CYCLE + 1;
				}
				/* POST TOTAL DOWNTIME AT END OF TABLE */
				if ($machine_fault_index_container_FIRSTRUN != 0) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B>".$multilang_STATIC_DURATION_CAPS."</B>:
									</TD>
									<TD ALIGN='RIGHT'>
										<B>".unixtimeTOrealtime($apache_TOTAL_DURATION_UNIXTIME)."</B>
									</TD>
								</TR>				
								";
				} else {
					/* pass */
				}
				/* INDEX THE PARENT LOOP */
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE = $multilang_STATIC_FAULTS_CAPS.": <I>".$REPORT_TICKET_ALARM_ID."</I>";
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE,$multilang_STATIC_PARETO_EXPLAIN,$multilang_STATIC_SORTING_STATUS_EXPLAIN);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='300'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
								</TR>
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- OPTION FULFILLMENT */
		$custom_array_of_option_names="<OPTION VALUE='DEFAULT_PROCESSALLALARMS'>".$multilang_STATIC_94.$SPFMODEL_FORMFILL_ALARM;
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
										".core_user_date_time_range_rerun_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY,$custom_array_of_option_names)."
								";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		if ( ($apache_ZERO_FAULT_OUTPUT == 'NO') && ($mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY == 'DEFAULT_PROCESSALLALARMS') ) {
			$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
								<TR>
									<TD ALIGN='CENTER'>
										<B><I>".$multilang_STATIC_SORTING_STATUS.":</I></B>
									</TD>
									<TD CLASS='hmicellborder1' ALIGN='CENTER' ".$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_SYNERGISTIC_PARETO.">
										<B>".$multilang_STATIC_SYNERGISTIC_PARETO."</B>
									</TD>
									<TD CLASS='hmicellborder1' ALIGN='CENTER' ".$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO.">
										<B>".$multilang_STATIC_DISCRETE_PARETO."</B>
									</TD>
									<TD CLASS='hmicellborder1' ALIGN='CENTER' ".$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE.">
										<B>".$multilang_STATIC_DISCRETE_ITEMS."</B>
									</TD>
								</TR>
								";
		} else {
			/* pass */
		}
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							</TABLE>
							";
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
	/* OPTION FULFILLMENT */
	$custom_array_of_option_names="<OPTION VALUE='DEFAULT_PROCESSALLALARMS'>".$multilang_STATIC_94.$SPFMODEL_FORMFILL_ALARM;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_STATIC_SELECT_FROM_DROPDOWN,$multilang_STATIC_REPORT_TIME,"NULL","NULL",$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY,$custom_array_of_option_names);
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
