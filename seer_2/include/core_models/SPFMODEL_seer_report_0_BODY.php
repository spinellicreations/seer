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
SPF REPORT 0 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_5."</B><BR>
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
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		model_SPF_export_csv_report_0_zero();

		/* ZERO OUT SOME HOLDING VALUES AND DELCARE SOME VARIABLES */
		$apache_SWITCH_ROW_COLOR = 0;
		$apache_REPORT_RECORDENTRY = "";

		/* CYCLE THROUGH --ALL-- MACHINES IN MODEL */
		$mysql_master_index = 0;
		while ($mysql_master_index <= $SPFMODEL_COUNT_ADJUSTED) {

			/* IDENTIFY THE MACHINE */
			$mysql_ENTRY_MACHINENAME = $SPFMODEL_NAME[$mysql_master_index];

			/* PREPARE THE QUERY */
			$mysql_mod_openopc_query = "DATESTAMP, MACHINE_NAME, MACHINE_TYPE, STATE, ALARM, SOURCE, DESTINATION1, DESTINATION2, SOURCE_FLOW, DESTINATION1_FLOW, DESTINATION2_FLOW, SOURCE_TOTAL_FLOW, DESTINATION1_TOTAL_FLOW, DESTINATION2_TOTAL_FLOW, POWER, POWER_TOTAL";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."')  AND (STATE != '".$SPFMODEL_STATE_CLEANING."') ORDER BY DATESTAMP ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* ZERO OUT OUR HOLDING AND INDEXING KEYS and SET SOME VARIABLES */
			$mysql_query_index = 1;
			$mysql_CIP_CYCLE_ACTIVE = 0;
			$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 0;
			$mysql_holding_SOURCE = "8675309";
			$mysql_holding_DESTINATION1 = "8675309";
			$mysql_holding_DESTINATION2 = "8675309";
			$mysql_holding_SOURCE_FLOW = 0;
			$mysql_holding_DESTINATION1_FLOW = 0;
			$mysql_holding_DESTINATION2_FLOW = 0;
			$mysql_difference_SOURCE_FLOW = 0;
			$mysql_difference_DESTINATION1_FLOW = 0;
			$mysql_difference_DESTINATION2_FLOW = 0;
			$mysql_holding_POWER_TOTAL = 0;
			$mysql_totalized_SOURCE_FLOW = 0;
			$mysql_totalized_DESTINATION1_FLOW = 0;
			$mysql_totalized_DESTINATION2_FLOW = 0;
			$mysql_totalized_POWER = 0;
			$mysql_holding_CYCLE_START = 0;
			$mysql_holding_CYCLE_END = 0;
			$mysql_holding_DATESTAMP = 0;

			/* ZERO OUT ALARM ARRAY */
			/* $alarm_DATESTAMP_START[X] = datestamp start of alarm id X */
			/* $alarm_DATESTAMP_END[X] = datestamp end of alarm id X */
			/* $alarm_NAME[X] = friendlyname of alarm id X */
			/* $alarm_COUNT = number of alarms, index from 1 */
			$alarm_DATESTAMP_START[0] = "NONE";
			$alarm_DATESTAMP_END[0] = "NONE";
			$alarm_NAME[0] = "NONE";
			$alarm_COUNT = 0;
			$mysql_ALARM_CYCLE_ACTIVE = 0;

			/* CYCLE THROUGH THE QUERY */ 
			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_MACHINE_NAME = $mysql_mod_openopc_query_row['MACHINE_NAME'];
				$mysql_mod_openopc_WORKING_MACHINE_TYPE = $mysql_mod_openopc_query_row['MACHINE_TYPE'];
				$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
				$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row['ALARM'];
				$mysql_mod_openopc_WORKING_SOURCE = $mysql_mod_openopc_query_row['SOURCE'];
				$mysql_mod_openopc_WORKING_DESTINATION1 = $mysql_mod_openopc_query_row['DESTINATION1'];
				$mysql_mod_openopc_WORKING_DESTINATION2 = $mysql_mod_openopc_query_row['DESTINATION2'];
				$mysql_mod_openopc_WORKING_SOURCE_FLOW = $mysql_mod_openopc_query_row['SOURCE_FLOW'];
				$mysql_mod_openopc_WORKING_DESTINATION1_FLOW = $mysql_mod_openopc_query_row['DESTINATION1_FLOW'];
				$mysql_mod_openopc_WORKING_DESTINATION2_FLOW = $mysql_mod_openopc_query_row['DESTINATION2_FLOW'];
				$mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW = $mysql_mod_openopc_query_row['SOURCE_TOTAL_FLOW'];
				$mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW = $mysql_mod_openopc_query_row['DESTINATION1_TOTAL_FLOW'];
				$mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW = $mysql_mod_openopc_query_row['DESTINATION2_TOTAL_FLOW'];
				$mysql_mod_openopc_WORKING_POWER = $mysql_mod_openopc_query_row['POWER'];
				$mysql_mod_openopc_WORKING_POWER_TOTAL = $mysql_mod_openopc_query_row['POWER_TOTAL'];

				/* CIP CYCLE */
				if ($mysql_CIP_CYCLE_ACTIVE == 1) {
					$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 0;
				} else {
					/* pass */
				}
				if ( ($mysql_CIP_CYCLE_ACTIVE == 0) && ($mysql_mod_openopc_WORKING_STATE == $SPFMODEL_STATE_CLEANING) ) {
					$mysql_CIP_CYCLE_ACTIVE = 1;
					$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 1;
				} else {
					/* pass */
				}
				if ( ($mysql_CIP_CYCLE_ACTIVE == 1) && ($mysql_mod_openopc_WORKING_STATE != $SPFMODEL_STATE_CLEANING) ) {
					$mysql_CIP_CYCLE_ACTIVE = 0;
					$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 0;
					/* CYCLE START AND END DATESTAMP */
					$mysql_holding_CYCLE_START = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_holding_CYCLE_END = $mysql_mod_openopc_WORKING_DATESTAMP;
				} else {
					/* pass */
				}

				/* CHECK IF OUR SOURCE AND DESTINATIONS ARE THE SAME */
				if ( ($mysql_holding_SOURCE != $mysql_mod_openopc_WORKING_SOURCE) || ($mysql_holding_DESTINATION1 != $mysql_mod_openopc_WORKING_DESTINATION1) || ($mysql_holding_DESTINATION2 != $mysql_mod_openopc_WORKING_DESTINATION2) || ($mysql_CIP_CYCLE_ACTIVE_ONE_SHOT == 1) ) {

					/* IF SOURCE OR DEST HAS CHANGED, POST TOTALS */
					if ($mysql_CIP_CYCLE_ACTIVE == 0) {
						/* CYCLE START AND END DATESTAMP */
						$mysql_holding_CYCLE_START = $mysql_mod_openopc_WORKING_DATESTAMP;
						$mysql_holding_CYCLE_END = $mysql_mod_openopc_WORKING_DATESTAMP;
						/* IF SOURCE OR DEST HAS CHANGED, RECYCLE OUR SYSTEM DATA */
						$alarm_DATESTAMP_START[0] = "NONE";
						$alarm_DATESTAMP_END[0] = "NONE";
						$mysql_ALARM_CYCLE_ACTIVE = 0;
					} else {
						/* pass */
					}

					/* IF SOURCE OR DEST HAS CHANGED, RECYCLE OUR SYSTEM DATA */
					$mysql_holding_DATESTAMP = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_holding_SOURCE = $mysql_mod_openopc_WORKING_SOURCE;
					$mysql_holding_DESTINATION1 = $mysql_mod_openopc_WORKING_DESTINATION1;
					$mysql_holding_DESTINATION2 = $mysql_mod_openopc_WORKING_DESTINATION2;
					$mysql_holding_SOURCE_FLOW = $mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW;
					$mysql_holding_DESTINATION1_FLOW = $mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW;
					$mysql_holding_DESTINATION2_FLOW = $mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW;
					$mysql_holding_POWER_TOTAL = $mysql_mod_openopc_WORKING_POWER_TOTAL;

				} else {
					if ($mysql_CIP_CYCLE_ACTIVE == 0) {

						/* CYCLE START AND END DATESTAMP */
						$mysql_holding_CYCLE_END = $mysql_mod_openopc_WORKING_DATESTAMP;

						/* CALCULATE CHANGE SINCE LAST SAMPLE */
						$mysql_difference_SOURCE_FLOW = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW, $mysql_holding_SOURCE_FLOW, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);
						$mysql_difference_DESTINATION1_FLOW = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW, $mysql_holding_DESTINATION1_FLOW, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);
						$mysql_difference_DESTINATION2_FLOW = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW, $mysql_holding_DESTINATION2_FLOW, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);
						$mysql_difference_POWER_TOTAL = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_POWER_TOTAL, $mysql_holding_POWER_TOTAL, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);

						/* UPDATE TOTALS */
						$mysql_totalized_SOURCE_FLOW = $mysql_totalized_SOURCE_FLOW + $mysql_difference_SOURCE_FLOW;
						$mysql_totalized_DESTINATION1_FLOW = $mysql_totalized_DESTINATION1_FLOW + $mysql_difference_DESTINATION1_FLOW;
						$mysql_totalized_DESTINATION2_FLOW = $mysql_totalized_DESTINATION2_FLOW + $mysql_difference_DESTINATION2_FLOW;
						$mysql_totalized_POWER = $mysql_totalized_POWER + $mysql_difference_POWER_TOTAL;

						/* UPDATE HOLDING VALUES */
						$mysql_holding_DATESTAMP = $mysql_mod_openopc_WORKING_DATESTAMP;
						$mysql_holding_SOURCE_FLOW = $mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW;
						$mysql_holding_DESTINATION1_FLOW = $mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW;
						$mysql_holding_DESTINATION2_FLOW = $mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW;
						$mysql_holding_POWER_TOTAL = $mysql_mod_openopc_WORKING_POWER_TOTAL;

						/* LOG ALARMS (QUANTITY, NOT IDENTITY) */
						if ($mysql_mod_openopc_WORKING_ALARM != 0) {
							if ( ($mysql_ALARM_CYCLE_ACTIVE == 1) && ($alarm_NAME[$alarm_COUNT] == $alarm_NAME[$mysql_mod_openopc_WORKING_ALARM]) ) {
								$alarm_DATESTAMP_END[$alarm_COUNT] = $mysql_mod_openopc_WORKING_DATESTAMP;
								$mysql_ALARM_CYCLE_ACTIVE = $SPFMODEL_ALARM_CONDITION_HOT_CYCLE_COUNT;
							} else {
								$alarm_COUNT = $alarm_COUNT + 1;
								$alarm_DATESTAMP_START[$alarm_COUNT] = $mysql_mod_openopc_WORKING_DATESTAMP;
								$alarm_DATESTAMP_END[$alarm_COUNT] = $mysql_mod_openopc_WORKING_DATESTAMP;
								$alarm_NAME[$alarm_COUNT] = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];
								$mysql_ALARM_CYCLE_ACTIVE = $SPFMODEL_ALARM_CONDITION_HOT_CYCLE_COUNT;
							}
						} else {
							$mysql_ALARM_CYCLE_ACTIVE = $mysql_ALARM_CYCLE_ACTIVE - 1;
						}
					} else {
						/* pass */
					}
				}

				if ($mysql_CIP_CYCLE_ACTIVE == 0) {

					/* CONVERT NUMERIC VALUES TO LITERAL VALUES */
					$mysql_mod_openopc_WORKING_MACHINE_TYPE_FRIENDLY = $SPFMODEL_MACHINE_TYPE[$mysql_mod_openopc_WORKING_MACHINE_TYPE];
					$mysql_mod_openopc_WORKING_STATE_FRIENDLY = $SPFMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
					$mysql_mod_openopc_WORKING_ALARM_FRIENDLY = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM]; 
					$mysql_mod_openopc_WORKING_SOURCE_FRIENDLY = $SPFMODEL_SOURCE[$mysql_mod_openopc_WORKING_SOURCE];
					$mysql_mod_openopc_WORKING_DESTINATION1_FRIENDLY = $SPFMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION1];
					$mysql_mod_openopc_WORKING_DESTINATION2_FRIENDLY = $SPFMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION2];

					/* APPLY NOT APPLICABLE VALUE TO UNNEEDED FIELDS - AND TOTALIZE ROLLING COUNTERS */
					$SPFMODEL_CHECK_FOR_TYPE = $mysql_mod_openopc_WORKING_MACHINE_TYPE{0};
					if ( $SPFMODEL_CHECK_FOR_TYPE == '1' ) {
						/* TYPE - SEPARATOR */
						/* pass */
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '2' ) {
						/* TYPE - CLARIFIER */
						/* pass */
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '3' ) {
						/* TYPE - ULTRA FILTRATION */
						/* pass */
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '4' ) {
						/* TYPE - REVERSE OSSMOSIS */
						/* pass */
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '5' ) {
						/* TYPE - HTST PASTEURIZER */
						$mysql_mod_openopc_WORKING_DESTINATION2_FRIENDLY = "NOT_APPLICABLE";
						$mysql_mod_openopc_WORKING_DESTINATION2_FLOW = "NOT_APPLICABLE";
						$mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW = "NOT_APPLICABLE";
						/* pass */
					} else {
						/* pass */
					}

				} else {	
					/* pass */
				}
			}

			/* DETERMINE EFFICIENCY */
			list($mysql_totalized_efficiency_SOURCE,$mysql_totalized_efficiency_DESTINATION1,$mysql_totalized_efficiency_DESTINATION2,$mysql_percent_injected_error) = model_SPF_efficiency_calculation_1($mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER);

			/* APPLY NOT APPLICABLE VALUE TO UNNEEDED FIELDS - AND TOTALIZE ROLLING COUNTERS */
			$SPFMODEL_CHECK_FOR_TYPE = $mysql_mod_openopc_WORKING_MACHINE_TYPE{0};
			if ( $SPFMODEL_CHECK_FOR_TYPE == '1' ) {
				/* TYPE - SEPARATOR */
				list($mysql_totalized_efficiency_SOURCE,$mysql_totalized_efficiency_DESTINATION1,$mysql_totalized_efficiency_DESTINATION2,$mysql_percent_injected_error) = model_SPF_efficiency_calculation_1($mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER, "1");
			} else {
				/* pass */
			}
			if ( $SPFMODEL_CHECK_FOR_TYPE == '2' ) {
				/* TYPE - CLARIFIER */
				list($mysql_totalized_efficiency_SOURCE,$mysql_totalized_efficiency_DESTINATION1,$mysql_totalized_efficiency_DESTINATION2,$mysql_percent_injected_error) = model_SPF_efficiency_calculation_1($mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER, "2");
			} else {
				/* pass */
			}
			if ( $SPFMODEL_CHECK_FOR_TYPE == '3' ) {
				/* TYPE - ULTRA FILTRATION */
				list($mysql_totalized_efficiency_SOURCE,$mysql_totalized_efficiency_DESTINATION1,$mysql_totalized_efficiency_DESTINATION2,$mysql_percent_injected_error) = model_SPF_efficiency_calculation_1($mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER, "3");
			} else {
				/* pass */
			}
			if ( $SPFMODEL_CHECK_FOR_TYPE == '4' ) {
				/* TYPE - REVERSE OSSMOSIS */
				list($mysql_totalized_efficiency_SOURCE,$mysql_totalized_efficiency_DESTINATION1,$mysql_totalized_efficiency_DESTINATION2,$mysql_percent_injected_error) = model_SPF_efficiency_calculation_1($mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER, "4");
			} else {
				/* pass */
			}
			if ( $SPFMODEL_CHECK_FOR_TYPE == '5' ) {
				/* TYPE - HTST PASTEURIZER */
				$mysql_totalized_DESTINATION2_FLOW = "NOT_APPLICABLE";
				list($mysql_totalized_efficiency_SOURCE,$mysql_totalized_efficiency_DESTINATION1,$mysql_totalized_efficiency_DESTINATION2,$mysql_percent_injected_error) = model_SPF_efficiency_calculation_1($mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER, "5");			} else {
				/* pass */
			}

			/* PUSH TO CSV FOR EXPORT */
			model_SPF_export_csv_report_0_build();

			/* FLIP FLOP ROW COLOR */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

			/* POST THE TOTALIZED DATA FOR THIS MACHINE */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
						<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
							<TD VALIGN='MIDDLE' ALIGN='CENTER'>
								<I>".$mysql_ENTRY_MACHINENAME."</I>
							</TD>
							<TD VALIGN='MIDDLE' ALIGN='CENTER'>
								".$mysql_totalized_SOURCE_FLOW."
							</TD>
							<TD VALIGN='MIDDLE' ALIGN='CENTER'>
								".$mysql_totalized_DESTINATION1_FLOW."
							</TD>
							<TD VALIGN='MIDDLE' ALIGN='CENTER'>
								".$mysql_totalized_DESTINATION2_FLOW."
							</TD>
							<TD VALIGN='MIDDLE' ALIGN='CENTER'>
								".$mysql_totalized_POWER."
							</TD>
							<TD VALIGN='MIDDLE' ALIGN='LEFT' COLSPAN='2'>
								".$multilang_SPFMODEL_27." -- <BR>
								".$multilang_SPFMODEL_28." -- <BR>
								".$multilang_SPFMODEL_29." -- <BR>
								".$multilang_SPFMODEL_17." -- <BR>
								<BR>
								".$multilang_SPFMODEL_150." -- <BR>
							</TD>
							<TD VALIGN='MIDDLE' ALIGN='LEFT' COLSPAN='2'>
								".$mysql_totalized_efficiency_SOURCE."<BR>
								".$mysql_totalized_efficiency_DESTINATION1."<BR>
								".$mysql_totalized_efficiency_DESTINATION2."<BR>
								".$alarm_COUNT."<BR>
								<BR>
								".$mysql_percent_injected_error." [%]<BR>
							</TD>
						</TR>
						<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
							<TD COLSPAN='9'>
								<BR>
							</TD>
						</TR>
						";

			/* INDEX THE MASTER CONTAINER */
			$mysql_master_index = $mysql_master_index + 1;
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD VALIGN='TOP' WIDTH='130'>
									</TD>
									<TD VALIGN='TOP' WIDTH='125'>
									</TD>
									<TD VALIGN='TOP' WIDTH='125'>
									</TD>
									<TD VALIGN='TOP' WIDTH='125'>
									</TD>
									<TD VALIGN='TOP' WIDTH='125'>
									</TD>
									<TD VALIGN='TOP' WIDTH='60'>
									</TD>
									<TD VALIGN='TOP' WIDTH='75'>
									</TD>
									<TD VALIGN='TOP' WIDTH='60'>
									</TD>
									<TD VALIGN='TOP' WIDTH='75'>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_46."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_140." [".$SPFMODEL_UM_VOLUME."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_141." [".$SPFMODEL_UM_VOLUME."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_142." [".$SPFMODEL_UM_VOLUME."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_131." [".$SPFMODEL_UM_POWER."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='4'>
										<B><U>".$multilang_SPFMODEL_147." [".$SPFMODEL_UM_VOLUME." / ".$SPFMODEL_UM_POWER."]</U></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
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
	$custom_array_of_option_names="<OPTION VALUE='NO'>".$multilang_STATIC_NO."<OPTION VALUE='YES'>".$multilang_STATIC_YES;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
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
