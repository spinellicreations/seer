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
TANK REPORT 6 BODY (INCLUDED TO ALL TANKMODELS)
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
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_124."</B><BR>
								<I>".$TANKMODEL_SUBPAGETITLE."</I><BR>
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
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREP FOR BUILDING A CONTAINER OF FAULTS */
		$cleaning_state_ID_INDEX = 0;
		$cleaning_state_ID = 0;
		while ($cleaning_state_ID_INDEX <= $TANKMODEL_STATE_COUNT) {
			if ($TANKMODEL_SPECIALSTATE_CIP == $TANKMODEL_STATE[$cleaning_state_ID_INDEX]) {
				$cleaning_state_ID = $cleaning_state_ID_INDEX;
			} else {
				/* pass */
			}
			$cleaning_state_ID_INDEX = $cleaning_state_ID_INDEX + 1;	
		}
		$post_FAULT_CONDITION_QUALIFIER_STRING = "AND (STATE != '".$cleaning_state_ID."') AND (LEVEL_PERCENT >= '".$TANKMODEL_CONTAINMENT_LEVEL_PERCENT_APPRECIABLE."') AND (TEMPERATURE NOT BETWEEN ".$TANKMODEL_CONTAINMENT_TEMP_ACCEPTABLE_LOW." AND ".$TANKMODEL_CONTAINMENT_TEMP_ACCEPTABLE_HIGH.") AND (TEMPERATURE != '0') ";

		/* BUILD THE CONTAINER */
		list($fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime,$machine_fault_index_container) = model_COMMON_fault_container_creation_report_3($mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$TANKMODEL_COUNT_ADJUSTED,$TANKMODEL_NAME,$TANKMODEL_mysql_mod_openopc_TABLENAME,"SILONAME","PRODUCT",$post_FAULT_CONDITION_QUALIFIER_STRING,$TANKMODEL_PRODUCT);

		/* SO AFTER ALL THIS, DO WE EVEN HAVE ANY FAULTS TO DISPLAY ?!?! */
		/* PROCEED TO A REPORT OUTPUT */
		$apache_ZERO_FAULT_OUTPUT = "NO";
		foreach ($machine_fault_index_container as &$machine_fault_index_container_test) {
			if ( $machine_fault_index_container_test == 0 ) {
				/* PROCEED TO A ZEROFAULT OUTPUT */
				$apache_ZERO_FAULT_OUTPUT = "YES";
				$apache_REPORT_RECORDENTRY = core_zero_fault_output();
			}
		}

		if ( $apache_ZERO_FAULT_OUTPUT == 'YES' ) {
			/* pass */
		} else {
			/* -- DETAIL TABLE FAULTS (Individual Systems) */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_DISCRETE,$multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL);
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<BR>
									</TD>
									<TD WIDTH='300' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_107."</U></B>
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
			while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {
	
				$MODEL_WORKING_MACHINENAME = $mysql_query_internal_index;
				$machine_fault_index_container_CYCLE = 0;
				$machine_fault_index_container_FIRSTRUN = 0;
				$apache_TOTAL_DURATION_UNIXTIME = 0;
				while ( $machine_fault_index_container_CYCLE <= $machine_fault_index_container[$MODEL_WORKING_MACHINENAME] ) {
	
					$fault_container_CHECK = isset($fault_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE]);

					if ($fault_container_CHECK == TRUE) {
	
						/* PULL IN DATA FOR ENTRY */
						$MACHINEMODEL_WORKING_POST_FAULT = $fault_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_ENDTIME = $endtime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_STARTTIME = $starttime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_DURATION = $duration_container_human_readable[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$MACHINEMODEL_WORKING_POST_UNIXTIME = $duration_container_unixtime[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
						$apache_TOTAL_DURATION_UNIXTIME = $apache_TOTAL_DURATION_UNIXTIME + $duration_container_unixtime[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];

						/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
						$MACHINEMODEL_WORKING_POST_FAULT = $TANKMODEL_PRODUCT[$MACHINEMODEL_WORKING_POST_FAULT];
						if ( $MACHINEMODEL_WORKING_POST_FAULT == '' ) {
							$MACHINEMODEL_WORKING_POST_FAULT = $multilang_STATIC_UNKNOWN;
						} else {
							/* pass */
						} 
						$MACHINEMODEL_WORKING_POST_MACHINE = $TANKMODEL_NAME[$MODEL_WORKING_MACHINENAME];

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
						/* POST THE ENTRY TO A ROW IF IT EXCEEDS MINIMUM DURATION NECESSARY */
						if ( $MACHINEMODEL_WORKING_POST_UNIXTIME >= $TANKMODEL_CONTAINMENT_MINIMUM_FAILURE_DURATION) {
							$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();
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
		/* -- NOTIFICATIONS */
		$apache_NOTIFICATION_PRODUCT_PRESENT = $multilang_TANKMODEL_125."... ".$TANKMODEL_CONTAINMENT_LEVEL_PERCENT_APPRECIABLE." [pct. ".$multilang_TANKMODEL_110."].";
		$apache_NOTIFICATION_TEMPERATURE = $multilang_TANKMODEL_126."... ".$TANKMODEL_CONTAINMENT_TEMP_ACCEPTABLE_LOW." [".$TANKMODEL_UM_TEMPERATURE."] -- ".$TANKMODEL_CONTAINMENT_TEMP_ACCEPTABLE_HIGH." [".$TANKMODEL_UM_TEMPERATURE."].";
		$apache_NOTIFICATION_DURATION = $multilang_TANKMODEL_127."... ".varcharTOnumeric2(($TANKMODEL_CONTAINMENT_MINIMUM_FAILURE_DURATION / 60),2)." [".$multilang_STATIC_MINUTES."].";
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$apache_NOTIFICATION_PRODUCT_PRESENT,$apache_NOTIFICATION_TEMPERATURE,$apache_NOTIFICATION_DURATION);
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_TOPPLATE_EXTENSION."
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL","NULL","NULL");
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
