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
SPF REPORT 7 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_12."</B><BR>
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
	core_user_date_time_range_input_type_1($multilang_SPFMODEL_77,$multilang_FAULT_43);
	/* -- ADDITIONAL OPTIONS */
	$seer_AUTOSCALE_REPORT = $mysql_ENTRY_OPTIONNAME;

	/* IDENTIFY MACHINE TYPE, CLEANING METHOD */
	list($MACHINENAME_BY_INTEGER,$MACHINE_TYPE,$MACHINE_CLEANED_BY) = model_SPF_idenfity_machine_type_and_cleaning_method("YES",$mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_CIP_BY);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		model_SPF_export_csv_report_6_zero();

		$mysql_mod_openopc_query = "DATESTAMP, CIP_STEP, ALARM, CIP_TEMP, CIP_WATER_TYPE, CIP_WATER_USAGE, CIP_FLOW, CERTIFIED";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CIP_STEP ".$SPFMODEL_CIP_STEP_REALSTEPS.") ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		if ( $seer_AUTOSCALE_REPORT == 'YES' ) {
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($SPFMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		} else {
			$mysql_query_display_every_x_record = 1;
		}
		$mysql_rows_to_display_in_window = $SPFMODEL_ROWS_IN_WINDOWS;

		/* SET SOME INITIAL VALUES FOR REPORT REGISTERS */
		$mysql_query_index = 1;
		$first_run_this_table = 0;
		$apache_CURRENT_STEP = "8675309";
		$apache_CURRENT_WATER_USAGE = 0;
		$apache_CURRENT_ALARM_ARRAY = array();
		$apache_CURRENT_ALARM_DURING_STEP_ARRAY = array();
		$apache_CURRENT_ALARM_COUNT = 0;
		$apache_SWITCH_ROW_COLOR = 0;

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_CIP_STEP = $mysql_mod_openopc_query_row['CIP_STEP'];
			$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row['ALARM'];
			$mysql_mod_openopc_WORKING_CIP_TEMP = $mysql_mod_openopc_query_row['CIP_TEMP'];
			$mysql_mod_openopc_WORKING_CIP_WATER_TYPE = $mysql_mod_openopc_query_row['CIP_WATER_TYPE'];
			$mysql_mod_openopc_WORKING_CIP_WATER_USAGE = $mysql_mod_openopc_query_row['CIP_WATER_USAGE'];
			$mysql_mod_openopc_WORKING_CIP_FLOW = $mysql_mod_openopc_query_row['CIP_FLOW'];
			$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
			
			/* ACCOMODATE INSTANCE WHERE RECORD WAS MANUALLY INPUT AND ONLY TEMP IS LOGGED */
			if ( $mysql_mod_openopc_WORKING_CERTIFIED != '' ) {
				if ( $mysql_mod_openopc_WORKING_CIP_WATER_USAGE == '' ) {
					$mysql_mod_openopc_WORKING_CIP_WATER_USAGE = 0;
				}
				if ( $mysql_mod_openopc_WORKING_ALARM == '' ) {
					$mysql_mod_openopc_WORKING_ALARM = 0;
				}
				if ( $mysql_mod_openopc_WORKING_CIP_WATER_TYPE == '' ) {
					$mysql_mod_openopc_WORKING_CIP_WATER_TYPE = 0;
				}
				if ( $mysql_mod_openopc_WORKING_CIP_TEMP == '' ) {
					$mysql_mod_openopc_WORKING_CIP_TEMP = 0;
				}
			} else {
				/* pass */
			}

			/* LOG ALARMS */
			if ( $mysql_mod_openopc_WORKING_ALARM != 0 ) {
				$alarm_test_1 = $apache_CURRENT_ALARM_DURING_STEP_ARRAY[$apache_CURRENT_ALARM_COUNT];
				$alarm_test_2 = $multilang_SPFMODEL_114." # ".$mysql_mod_openopc_WORKING_CIP_STEP." ".$SPFMODEL_CIP_STEP[$mysql_mod_openopc_WORKING_CIP_STEP];
				$alarm_test_3 = $apache_CURRENT_ALARM_ARRAY[$apache_CURRENT_ALARM_COUNT];
				$alarm_test_4 = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];
				if ( ($alarm_test_1 == $alarm_test_2) && ($alarm_test_3 == $alarm_test_4) ) {
					/* DONT LOG EXISTING ALARMS */
					/* pass */
				} else {
					/* LOG THE NEW ALARMS */
					$apache_CURRENT_ALARM_COUNT = $apache_CURRENT_ALARM_COUNT + 1;
					$apache_CURRENT_ALARM_ARRAY[$apache_CURRENT_ALARM_COUNT] = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];
					$apache_CURRENT_ALARM_DURING_STEP_ARRAY[$apache_CURRENT_ALARM_COUNT] = $multilang_SPFMODEL_114." # ".$mysql_mod_openopc_WORKING_CIP_STEP." ".$SPFMODEL_CIP_STEP[$mysql_mod_openopc_WORKING_CIP_STEP];
				}
			} else {
				/* pass */
			}

			/* RUN WASH TIME AND TOTAL OPERATIONS */
			if ( $apache_CURRENT_STEP > $mysql_mod_openopc_WORKING_CIP_STEP ) {
				if ( $first_run_this_table > 0 ) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.model_SPF_wash_totals_report_6($apache_CURRENT_START_TIME,$apache_CURRENT_END_TIME,$apache_CURRENT_WATER_USAGE,$apache_CURRENT_ALARM_COUNT,$apache_CURRENT_ALARM_ARRAY,$apache_CURRENT_ALARM_DURING_STEP_ARRAY);
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.model_SPF_wash_totals_report_6_null();
				}
				/* RESET THE TOTALS */
				$apache_CURRENT_START_TIME = $mysql_mod_openopc_WORKING_DATESTAMP;
				$apache_CURRENT_ALARM_ARRAY = array();
				$apache_CURRENT_ALARM_DURING_STEP_ARRAY = array();
				$apache_CURRENT_ALARM_COUNT = 0;
			} else {
				/* pass */
			}

			/* SEPARATE WASH INSTANCES */
			list($apache_MARKUP_TO_RETURN,$first_run_this_table,$apache_CURRENT_WATER_USAGE,$apache_CURRENT_STEP,$apache_CURRENT_END_TIME) = model_SPF_wash_totals_report_6_divider($first_run_this_table,$apache_CURRENT_STEP,$mysql_mod_openopc_WORKING_CIP_STEP,$apache_CURRENT_WATER_USAGE,$mysql_mod_openopc_WORKING_CIP_WATER_USAGE,$mysql_mod_openopc_WORKING_DATESTAMP);
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								".$apache_MARKUP_TO_RETURN;			

			/* GRAPH DATA DURING WASH CYCLE */
			if ( $mysql_query_index == 1 ) {
				/* GRAPHICAL CELL WIDTH FOR BAR CHARTS */
				$GRAPHICAL_CELL_WIDTH = 150;

				/* HORIZONTAL BAR INDICATOR FOR ANALOG VALUES */
				$mysql_mod_openopc_WORKING_CIP_TEMP_BAR = core_display_horizontal_bar ("150",$mysql_mod_openopc_WORKING_CIP_TEMP,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
				$mysql_mod_openopc_WORKING_CIP_FLOW_BAR = core_display_horizontal_bar ("150",$mysql_mod_openopc_WORKING_CIP_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);

				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$SPFMODEL_WORKING_STEP = $SPFMODEL_CIP_STEP[$mysql_mod_openopc_WORKING_CIP_STEP];
				$SPFMODEL_WORKING_WATERTYPE = $SPFMODEL_CIP_WATER_TYPE[$mysql_mod_openopc_WORKING_CIP_WATER_TYPE];

				/* ALL RECORDS REQUIRE CERTIFICATION - THIS IS A CIP SYSTEM */
				if ( $mysql_mod_openopc_WORKING_CERTIFIED != '') {
					$SPFMODEL_WORKING_CIP_STEP_CELLBACKGROUND = "BGCOLOR='#CCFF66'";
					/* record required to be certified and is certified */
				} else {
					$SPFMODEL_WORKING_CIP_STEP_CELLBACKGROUND = "BGCOLOR='#FF8866'";
					/* record requried to be certified and is NOT certified */
				}
	
				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* POST MARKUP FOR GRAPH ROW */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ALIGN='CENTER' ".$SPFMODEL_WORKING_CIP_STEP_CELLBACKGROUND.">
										[".$mysql_mod_openopc_WORKING_CIP_STEP."] ".$SPFMODEL_WORKING_STEP."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_FLOW."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_CIP_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_TEMP."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_CIP_TEMP_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$SPFMODEL_WORKING_WATERTYPE."
									</TD>
								</TR>
								";

				/* BUILD CSV FOR EXPORT */
				model_SPF_export_csv_report_6_build();

			} else {	
				/* pass */
			}

			/* INDEX */
			if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
				$mysql_query_index = 1;
			} else {
				$mysql_query_index =  $mysql_query_index + 1;
			}
	
		}

		/* TAKE CARE OF THE LAST WASH INSTANCE's TOTALS DISPLAY */
		/* -- PICK UP THE STRAGGLER */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.model_SPF_wash_totals_report_6($apache_CURRENT_START_TIME,$apache_CURRENT_END_TIME,$apache_CURRENT_WATER_USAGE,$apache_CURRENT_ALARM_COUNT,$apache_CURRENT_ALARM_ARRAY,$apache_CURRENT_ALARM_DURING_STEP_ARRAY);

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$multilang_STATIC_CERTIFIED_HIGHLIGHT);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150' >
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_STATIC_DATESTAMP_CAPS."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_67."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_24."<BR>
										[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_68."<BR>
										[".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_21."</U></B>
									</TD>
								</TR>
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		$custom_array_of_option_names="<OPTION VALUE='YES'>".$multilang_STATIC_YES."<OPTION VALUE='NO'>".$multilang_STATIC_NO;
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_STATIC_AUTO_SCALE_DISPLAY,$custom_array_of_option_names)."
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_SPFMODEL_110,$multilang_SPFMODEL_119,"NULL","NULL",$multilang_STATIC_AUTO_SCALE_DISPLAY,$custom_array_of_option_names);
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

