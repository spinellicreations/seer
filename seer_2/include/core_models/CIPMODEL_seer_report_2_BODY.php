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
CIP REPORT 2 BODY (INCLUDED TO ALL CIPMODELS)
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
								<B>".$multilang_CIPMODEL_0.": ".$multilang_CIPMODEL_6."</B><BR>
								<I>".$CIPMODEL_SUBPAGETITLE."</I><BR>
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
	core_user_date_time_range_input_type_1($multilang_CHECKWEIGHERMODEL_38,$multilang_FAULT_43);
	/* -- ADDITIONAL OPTIONS */
	$seer_AUTOSCALE_REPORT = $mysql_ENTRY_OPTIONNAME;

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		model_CIP_export_csv_report_2_zero();

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, LINE_BEING_CLEANED, STEP, STATUS, RETURN_TEMP, SUPPLY_TEMP, SUPPLY_FLOW, RETURN_CONDUCTIVITY, WATER_TYPE, WATER_USAGE, CERTIFIED";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CIPMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (CIPNAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (STEP ".$CIPMODEL_STEP_REALSTEPS.") AND (LINE_BEING_CLEANED ".$CIPMODEL_LINE_BEING_CLEANED_REALLINES.") ORDER BY DATESTAMP ASC, LINE_BEING_CLEANED ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* SET SOME INITIAL VALUES FOR REPORT REGISTERS */
		$mysql_query_index = 1;
		$first_run_this_table = 0;
		$apache_CURRENT_LINE_BEING_CLEANED = "8675309";
		$apache_CURRENT_STEP = "8675309";
		$apache_CURRENT_WATER_USAGE = 0;
		$apache_CURRENT_ALARM_ARRAY = array();
		$apache_CURRENT_ALARM_DURING_STEP_ARRAY = array();
		$apache_CURRENT_ALARM_COUNT = 0;
		$apache_SWITCH_ROW_COLOR = 0;

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		if ( $seer_AUTOSCALE_REPORT == 'YES' ) {
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($CIPMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		} else {
			$mysql_query_display_every_x_record = 1;
		}
		
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {

			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED = $mysql_mod_openopc_query_row['LINE_BEING_CLEANED'];
			$mysql_mod_openopc_WORKING_STEP = $mysql_mod_openopc_query_row['STEP'];
			$mysql_mod_openopc_WORKING_STATUS = $mysql_mod_openopc_query_row['STATUS'];
			$mysql_mod_openopc_WORKING_RETURNTEMP = $mysql_mod_openopc_query_row['RETURN_TEMP'];
			$mysql_mod_openopc_WORKING_SUPPLYTEMP = $mysql_mod_openopc_query_row['SUPPLY_TEMP'];
			$mysql_mod_openopc_WORKING_SUPPLYFLOW = $mysql_mod_openopc_query_row['SUPPLY_FLOW'];
			$mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY = $mysql_mod_openopc_query_row['RETURN_CONDUCTIVITY'];
			$mysql_mod_openopc_WORKING_WATERTYPE = $mysql_mod_openopc_query_row['WATER_TYPE'];
			$mysql_mod_openopc_WORKING_WATERUSAGE = $mysql_mod_openopc_query_row['WATER_USAGE'];
			$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
			
			/* ACCOMODATE INSTANCE WHERE RECORD WAS MANUALLY INPUT AND ONLY TEMP IS LOGGED */
			if ( $mysql_mod_openopc_WORKING_CERTIFIED != '' ) {
				if ( $mysql_mod_openopc_WORKING_WATERUSAGE == '' ) {
					$mysql_mod_openopc_WORKING_WATERUSAGE = 0;
				} else {
					/* pass */
				}
				if ( $mysql_mod_openopc_WORKING_WATERTYPE == '' ) {
					$mysql_mod_openopc_WORKING_WATERTYPE = 0;
				} else {
					/* pass */
				}
				if ( $mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY == '' ) {
					$mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY = 0;
				} else {
					/* pass */
				}
				if ( $mysql_mod_openopc_WORKING_SUPPLYFLOW == '' ) {
					$mysql_mod_openopc_WORKING_SUPPLYFLOW = 0;
				} else {
					/* pass */
				}
				if ( $mysql_mod_openopc_WORKING_SUPPLYTEMP == '' ) {
					$mysql_mod_openopc_WORKING_SUPPLYTEMP = 0;
				} else {
					/* pass */
				}
				if ( $mysql_mod_openopc_WORKING_RETURNTEMP == '' ) {
					$mysql_mod_openopc_WORKING_RETURNTEMP = 0;
				} else {
					/* pass */
				}
			} else {
				/* pass */
			}

			/* MANGLE THE STATUS SO THAT WE CAN INTERPRET IT PROPERLY */
			/* -- THE ORIGINAL TAG CANT BE CHANGED IN THE OPTIONS FILE BECAUSE WE NEED IT FOR SQL COMPARISONS */
			/* -- SO WE'LL MANGLE IT TO WORK AS A PHP COMPARISON TOO */
			$CIPMODEL_STATUS_FAULT_CHECK = substr($CIPMODEL_STATUS_FAULT, 0, 2);
			if ( $CIPMODEL_STATUS_FAULT_CHECK  == '= ' ) {
				$CIPMODEL_STATUS_FAULT_PHP_FRIENDLY = "=".$CIPMODEL_STATUS_FAULT;
			} else {
				$CIPMODEL_STATUS_FAULT_PHP_FRIENDLY = $CIPMODEL_STATUS_FAULT;
			}

			/* LOG ALARMS */
			if ( eval("return($mysql_mod_openopc_WORKING_STATUS $CIPMODEL_STATUS_FAULT_PHP_FRIENDLY);") ) {
				$alarm_test_1 = $apache_CURRENT_ALARM_DURING_STEP_ARRAY[$apache_CURRENT_ALARM_COUNT];
				$alarm_test_2 = $multilang_CIPMODEL_25." # ".$mysql_mod_openopc_WORKING_STEP." ".$CIPMODEL_STEP[$mysql_mod_openopc_WORKING_STEP];
				$alarm_test_3 = $apache_CURRENT_ALARM_ARRAY[$apache_CURRENT_ALARM_COUNT];
				$alarm_test_4 = $CIPMODEL_STATUS[$mysql_mod_openopc_WORKING_STATUS];
				if ( ($alarm_test_1 == $alarm_test_2) && ($alarm_test_3 == $alarm_test_4) ) {
					/* DONT LOG EXISTING ALARMS */
					/* pass */
				} else {
					/* LOG THE NEW ALARMS */
					$apache_CURRENT_ALARM_COUNT = $apache_CURRENT_ALARM_COUNT + 1;
					$apache_CURRENT_ALARM_ARRAY[$apache_CURRENT_ALARM_COUNT] = $CIPMODEL_STATUS[$mysql_mod_openopc_WORKING_STATUS];
					$apache_CURRENT_ALARM_DURING_STEP_ARRAY[$apache_CURRENT_ALARM_COUNT] = $multilang_CIPMODEL_25." # ".$mysql_mod_openopc_WORKING_STEP." ".$CIPMODEL_STEP[$mysql_mod_openopc_WORKING_STEP];
				}
			} else {
				/* pass */
			}

			/* RUN WASH TIME AND TOTAL OPERATIONS */
			if ( ($apache_CURRENT_LINE_BEING_CLEANED != $mysql_mod_openopc_WORKING_LINE_BEING_CLEANED) || ( $apache_CURRENT_STEP > $mysql_mod_openopc_WORKING_STEP) ) {
				if ( $first_run_this_table > 0 ) {
					model_CIP_build_report_2_body();
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='12'>
										<BR>
									</TD>
								</TR>
								";
				}

				/* RESET THE TOTALS */
				$apache_CURRENT_START_TIME = $mysql_mod_openopc_WORKING_DATESTAMP;
				$apache_CURRENT_ALARM_ARRAY = array();
				$apache_CURRENT_ALARM_DURING_STEP_ARRAY = array();
				$apache_CURRENT_ALARM_COUNT = 0;
			} else {
				/* pass */
			}
			$apache_CURRENT_END_TIME = $mysql_mod_openopc_WORKING_DATESTAMP;

			/* SEPARATE WASH INSTANCES */
			if ( $first_run_this_table > 0 ) {
				if ( ($apache_CURRENT_LINE_BEING_CLEANED != $mysql_mod_openopc_WORKING_LINE_BEING_CLEANED) || ( $apache_CURRENT_STEP > $mysql_mod_openopc_WORKING_STEP) ) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='12'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='930' ALT='DIVIDER'><BR>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
			} else {
				/* pass */
			}
			$first_run_this_table = 1;

			/* SET THE CURRENT LINE BEING CLEANED (EXAMINED) TO THIS ONE */
			/* AND UPDATE WATER USAGE */
			$apache_CURRENT_LINE_BEING_CLEANED = $mysql_mod_openopc_WORKING_LINE_BEING_CLEANED;
			$apache_CURRENT_WATER_USAGE = $mysql_mod_openopc_WORKING_WATERUSAGE;
			$apache_CURRENT_STEP = $mysql_mod_openopc_WORKING_STEP;

			if ( $mysql_query_index == 1 ) {
			
				/* HORIZONTAL BAR INDICATOR FOR ANALOG VALUES */
				$CIPMODEL_WORKING_BAR_RETURNTEMP = core_display_horizontal_bar ("91",$mysql_mod_openopc_WORKING_RETURNTEMP,$CIPMODEL_RANGE_TEMPERATURE_LOW,$CIPMODEL_RANGE_TEMPERATURE_HIGH);
				$CIPMODEL_WORKING_BAR_SUPPLYTEMP = core_display_horizontal_bar ("91",$mysql_mod_openopc_WORKING_SUPPLYTEMP,$CIPMODEL_RANGE_TEMPERATURE_LOW,$CIPMODEL_RANGE_TEMPERATURE_HIGH);
				$CIPMODEL_WORKING_BAR_SUPPLYFLOW = core_display_horizontal_bar ("91",$mysql_mod_openopc_WORKING_SUPPLYFLOW,$CIPMODEL_RANGE_FLOW_LOW,$CIPMODEL_RANGE_FLOW_HIGH);
				$CIPMODEL_WORKING_BAR_RETURNCONDUCTIVITY = core_display_horizontal_bar ("91",$mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY,$CIPMODEL_RANGE_CONDUCTIVITY_LOW,$CIPMODEL_RANGE_CONDUCTIVITY_HIGH);

				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$CIPMODEL_WORKING_LINE_BEING_CLEANED = $CIPMODEL_LINE_BEING_CLEANED[$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED];
				$CIPMODEL_WORKING_STEP = $CIPMODEL_STEP[$mysql_mod_openopc_WORKING_STEP];
				$CIPMODEL_WORKING_WATERTYPE = $CIPMODEL_WATER_TYPE[$mysql_mod_openopc_WORKING_WATERTYPE];

				/* ALL RECORDS REQUIRE CERTIFICATION - THIS IS A CIP SYSTEM */
				if ( $mysql_mod_openopc_WORKING_CERTIFIED != '') {
					$CIPMODEL_WORKING_LINE_BEING_CLEANED_CELLBACKGROUND = "BGCOLOR='#CCFF66'";
					/* record required to be certified and is certified */
				} else {
					$CIPMODEL_WORKING_LINE_BEING_CLEANED_CELLBACKGROUND = "BGCOLOR='#FF8866'";
					/* record requried to be certified and is NOT certified */
				}
	
				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* CYCLE THROUGH THE DATABASE */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ALIGN='CENTER' ".$CIPMODEL_WORKING_LINE_BEING_CLEANED_CELLBACKGROUND.">
										".$CIPMODEL_WORKING_LINE_BEING_CLEANED."
									</TD>
									<TD ALIGN='CENTER'>
										[".$mysql_mod_openopc_WORKING_STEP."] ".$CIPMODEL_WORKING_STEP."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_SUPPLYTEMP."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_SUPPLYTEMP." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_RETURNTEMP."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_RETURNTEMP." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_SUPPLYFLOW."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_SUPPLYFLOW." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_RETURNCONDUCTIVITY." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$CIPMODEL_WORKING_WATERTYPE."
									</TD>
								</TR>
								";

				/* BUILD CSV FOR EXPORT */
				model_CIP_export_csv_report_2_build();

			} else {	
				/* pass */
			}

			if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
				$mysql_query_index = 1;
			} else {
				$mysql_query_index =  $mysql_query_index + 1;
			}
	
		}

		/* PICK UP THE STRAGGLER */
		model_CIP_build_report_2_body();

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$multilang_STATIC_CERTIFIED_HIGHLIGHT);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='930' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='95'>
									</TD>
									<TD WIDTH='135'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='30'>
									</TD>
									<TD WIDTH='92'>
									</TD>
									<TD WIDTH='30'>
									</TD>
									<TD WIDTH='92'>
									</TD>
									<TD WIDTH='30'>
									</TD>
									<TD WIDTH='92'>
									</TD>
									<TD WIDTH='36'>
									</TD>
									<TD WIDTH='92'>
									</TD>
									<TD WIDTH='81'>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_CIPMODEL_17."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_18."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_25."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_60."<BR>
										[".$CIPMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_26."<BR>
										[".$CIPMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_61."<BR>
										[".$CIPMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_62."<BR>
										[".$CIPMODEL_UM_CONDUCTIVITY."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_37."</U></B>
									</TD>
								</TR>			
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='12'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_CIPMODEL_29,$CIPMODEL_FORMFILL_NAME)."
									</TD>
								</TR>
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
	$custom_array_of_option_names="<OPTION VALUE='YES'>".$multilang_STATIC_YES."<OPTION VALUE='NO'>".$multilang_STATIC_NO;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_CIPMODEL_29,$CIPMODEL_FORMFILL_NAME,$multilang_CIPMODEL_81,$multilang_CIPMODEL_85,"NULL","NULL",$multilang_STATIC_AUTO_SCALE_DISPLAY,$custom_array_of_option_names);
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
