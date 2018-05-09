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
SPF REPORT 2 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_7."</B><BR>
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
	core_user_date_time_range_input_type_1($multilang_SPFMODEL_77,$multilang_STATIC_UNKNOWN);

	/* -- ADDITIONAL OPTIONS */
	$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY = $mysql_ENTRY_OPTIONNAME;

	/* CHECK FOR TURBIDITY SENSOR (LACK OF ONE = FAULT) */
	$MACHINENAME_BY_INTEGER = model_SPF_check_for_turbidity_sensor_on_machine($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, STATE, HRS_SINCE_CLEAN, ALARM, TURBIDITY";
		if ( $mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY == 'YES' ) {
			/* DISPLAY TURBIDITY ONLY WHEN ALARM CONDITION EXISTS -- ANY ALARM CONDITION */
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME = '".$mysql_ENTRY_MACHINENAME."') AND (ALARM != 0) ORDER BY DATESTAMP ASC, MACHINE_NAME ASC";
			$REPORT_TICKET_ALARM_ID = $multilang_STATIC_YES;
		} else {
			/* DISPLAY TURBIDITY FROM ALL TIMES */
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME = '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, MACHINE_NAME ASC";
			$REPORT_TICKET_ALARM_ID = $multilang_STATIC_NO;
		}
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* ZERO OUT CSV FOR EXPORT */
		model_SPF_export_csv_report_2_zero();

		/* SO AFTER ALL THIS, DO WE EVEN HAVE ANY DATA TO DISPLAY ?!?! */
		if ( $mysql_mod_openopc_num_rows == 0 ) {
			/* PROCEED TO A ZEROFAULT OUTPUT */
			$apache_ZERO_FAULT_OUTPUT = "YES";
			$apache_REPORT_RECORDENTRY = core_zero_fault_output();
		} else {
			/* STANDARD REPORT OUTPUT */
			$apache_ZERO_FAULT_OUTPUT = "NO";

			/* DISPLAY ONE RECORD EVERY X RECORDS */
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($SPFMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
			$mysql_rows_to_display_in_window = $SPFMODEL_ROWS_IN_WINDOWS;

			/* SET SOME VARIABLE VALUES TO START */
			$mysql_query_index = 1;
			$apache_REPORT_RECORDENTRY = "";
			$apache_SWITCH_ROW_COLOR = 0;

			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				if ( $mysql_query_index == 1 ) {
					$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
					$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
					$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN = $mysql_mod_openopc_query_row['HRS_SINCE_CLEAN'];
					$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row['ALARM'];
					$mysql_mod_openopc_WORKING_TURBIDITY = $mysql_mod_openopc_query_row['TURBIDITY'];

					/* CONVERT LOGICAL VALUE TO FRIENDLY VALUES */
					$mysql_mod_openopc_WORKING_STATE_FRIENDLY = $SPFMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
					$mysql_mod_openopc_WORKING_ALARM_FRIENDLY = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];

					/* HORIZONTAL BAR INDICATOR FOR TURBIDITY */
					$mysql_mod_openopc_WORKING_TURBIDITY_BAR = core_display_horizontal_bar ("370",$mysql_mod_openopc_WORKING_TURBIDITY,$SPFMODEL_RANGE_TURBIDITY_LOW,$SPFMODEL_RANGE_TURBIDITY_HIGH);

					/* FLIP FLOP ROW COLOR */
					$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

					/* CYCLE THROUGH THE DATABASE */
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_STATE_FRIENDLY."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_ALARM_FRIENDLY."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TURBIDITY."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TURBIDITY_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";

					/* BUILD CSV FOR EXPORT */
					model_SPF_export_csv_report_2_build();

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
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE = $multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY.": <I>".$REPORT_TICKET_ALARM_ID."</I>";
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='95'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='170'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='370'>
									</TD>
								</TR>
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- OPTION FULFILLMENT */
		$custom_array_of_option_names="<OPTION VALUE='NO'>".$multilang_STATIC_NO."<OPTION VALUE='YES'>".$multilang_STATIC_YES;
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='6'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY,$custom_array_of_option_names)."
									</TD>
								</TR>
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE BODY */
		if ($apache_ZERO_FAULT_OUTPUT == "NO") {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE."
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='95'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='170'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='370'>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_18."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_17."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$SPFMODEL_RANGE_TURBIDITY_LOW." [".$SPFMODEL_UM_TURBIDITY."] ....... ".$multilang_SPFMODEL_109." ....... ".$SPFMODEL_RANGE_TURBIDITY_HIGH." [".$SPFMODEL_UM_TURBIDITY."]</U></B>
									</TD>
								</TR>
								".$apache_REPORT_RECORDENTRY;
		} else {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE."
								<TR>
									<TD COLSPAN='6'>
										".$apache_REPORT_RECORDENTRY."
									</TD>
								</TR>
								";
		}
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_SPFMODEL_110,$multilang_SPFMODEL_112,"NULL","NULL",$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY,$custom_array_of_option_names);
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
