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
CIP MODEL HMI 2 BODY (INCLUDED TO ALL CIPMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* APPEND THE REFERRING PAGE WHEN GENERATED VIA */
/*    seer_REFERRINGPAGE_THISHMI_0 */
/* ------------------------------------------------------------------ */
$seer_REFERRINGPAGE_APPEND = "";
/*	-- what would you like to append to the REFERRINGPAGE after keys have been generated */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CIPMODEL_0.": ".$multilang_CIPMODEL_49."</B><BR>
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

/* DATA ENTRY TICKET SAVE TO DATABASE */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'SAVETICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_CIPMODEL_38);
	/* PULL IN CERTIFICATION COMMENT */
	if ( $_POST[mysql_ENTRY_COMMENT] != '' ) {
		$mysql_ENTRY_COMMENT = $_POST['mysql_ENTRY_COMMENT'];
		$mysql_ENTRY_COMMENT = sanitizeRANDOMcontent($mysql_ENTRY_COMMENT);
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_42;
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY AND CERTIFY THE TICKETED RECORDS*/
		$mysql_mod_openopc_query = "UPDATE ".$CIPMODEL_mysql_mod_openopc_TABLENAME." SET CERTIFIED='".$apache_DEFAULTDATESTAMP."', CERTIFIEDBY='".$mysql_seer_access_USERNAME."', CERTIFIEDCOMMENT='".$mysql_ENTRY_COMMENT."' WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP_CERT."%' AND '".$mysql_query_END_DATESTAMP_CERT."%') AND (CIPNAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (STEP ".$CIPMODEL_STEP_REALSTEPS.") AND (LINE_BEING_CLEANED" .$CIPMODEL_LINE_BEING_CLEANED_REALLINES .") AND (CERTIFIED IS NULL)";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET FEEDBACK DATA */
		$apache_REPORT_RECORDENTRY = core_user_certification_result_display($multilang_CIPMODEL_29, $CIPMODEL_FORMFILL_NAME, $CIPMODEL_mysql_mod_openopc_TABLENAME);
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* CERTIFICATION TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_CIPMODEL_38);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "*";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CIPMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (CIPNAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (STEP ".$CIPMODEL_STEP_REALSTEPS.") AND (LINE_BEING_CLEANED" .$CIPMODEL_LINE_BEING_CLEANED_REALLINES .") ORDER BY DATESTAMP ASC, CIPNAME ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET DATA */
		$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='STANDARD' WIDTH='930' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='155'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='8' ALIGN='CENTER'>
										<BR>
										".$multilang_CIPMODEL_30.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='8'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='8'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_CIPMODEL_31."<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='8'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_CIPMODEL_17."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_18."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_25."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD>
										<B><U>".$multilang_CIPMODEL_26." [".$CIPMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_CIPMODEL_37."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_START."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_END."</U></B>
									</TD>
								</TR>				
								";

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($CIPMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		$mysql_query_index = 1;
		$mysql_query_first_pass_for_form_radio_buttons = "YES";

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			if ( $mysql_query_index == 1 ) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_CIPNAME = $mysql_mod_openopc_query_row['CIPNAME'];
				$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED = $mysql_mod_openopc_query_row['LINE_BEING_CLEANED'];
				$mysql_mod_openopc_WORKING_STEP = $mysql_mod_openopc_query_row['STEP'];
				$mysql_mod_openopc_WORKING_RETURN_TEMP = $mysql_mod_openopc_query_row['RETURN_TEMP'];
				$mysql_mod_openopc_WORKING_WATER_TYPE = $mysql_mod_openopc_query_row['WATER_TYPE'];
				$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
	
				/* HORIZONTAL BAR INDICATOR FOR ANALOG SIGNALS */	
				$CIPMODEL_WORKING_BAR_RETURN_TEMP = core_display_horizontal_bar ("200",$mysql_mod_openopc_WORKING_RETURN_TEMP,$CIPMODEL_RANGE_TEMPERATURE_LOW,$CIPMODEL_RANGE_TEMPERATURE_HIGH);
	
				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$CIPMODEL_ROW_BACKGROUND = alarm_highlight_check($mysql_mod_openopc_WORKING_CERTIFIED,"NULL","NULL","CHECKFORNULL");
				$CIPMODEL_WORKING_LINE_BEING_CLEANED_FRIENDLYNAME = $CIPMODEL_LINE_BEING_CLEANED[$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED];
				$CIPMODEL_WORKING_WATER_TYPE_FRIENDLYNAME = $CIPMODEL_WATER_TYPE[$mysql_mod_openopc_WORKING_WATER_TYPE];
				$CIPMODEL_WORKING_STEP_FRIENDLYNAME = $CIPMODEL_STEP[$mysql_mod_openopc_WORKING_STEP];
			
				/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH CIP SYSTEM */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD ".$CIPMODEL_ROW_BACKGROUND.">
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$CIPMODEL_WORKING_LINE_BEING_CLEANED_FRIENDLYNAME."
									</TD>
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$CIPMODEL_WORKING_STEP_FRIENDLYNAME."
									</TD>
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_RETURN_TEMP."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_RETURN_TEMP." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$CIPMODEL_WORKING_WATER_TYPE_FRIENDLYNAME."
									</TD>
									";
				if ($mysql_query_first_pass_for_form_radio_buttons == 'YES') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' checked value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
					$mysql_query_first_pass_for_form_radio_buttons = "NO";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
				}
				$apache_REPORT_RECORDENTRY = preg_replace("/<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked/", "<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT'", $apache_REPORT_RECORDENTRY);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$CIPMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked value=".$mysql_mod_openopc_WORKING_DATESTAMP.">
									</TD>
								</TR>	
								";
			} else {	
				/* pass */
			}

			if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
				$mysql_query_index = 1;
			} else {
				$mysql_query_index =  $mysql_query_index + 1;
			}
	
		}
	
		/* FINISH THE TICKET */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";
		core_user_certification_submit_form_version_2();

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
/* -- CERTIFICATION TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_CIPMODEL_29,$CIPMODEL_FORMFILL_NAME,$multilang_CIPMODEL_32,$multilang_CIPMODEL_33,"NULL","NULL","NULL","NULL","NULL","NULL","CERTIFICATION");
}
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = ""; 
$apache_REPORTL6 = "";
$apache_REPORTL5 = $apache_REPORT_RECORDENTRY;
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
