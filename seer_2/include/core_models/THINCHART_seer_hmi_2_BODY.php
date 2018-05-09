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
THINCHART HMI 2 BODY (INCLUDED TO ALL THINCHARTS)
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
								<B>".$multilang_THINCHART_0.": ".$multilang_THINCHART_3."</B><BR>
								<I>".$THINCHART_SUBPAGETITLE."</I><BR>
								<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A>
							</P>
							";


/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* PEN COLOR DETERMINATION */
/* ------------------------------------------------------------------ */
if ($THINCHART_PEN1_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN1_COLOR = $THINCHART_ADVANCED_OP_PEN1_COLOR;
} else {
	$THINCHART_UTILIZED_PEN1_COLOR = $THINCHART_PEN1_COLOR;
}
if ($THINCHART_PEN2_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN2_COLOR = $THINCHART_ADVANCED_OP_PEN2_COLOR;
} else {
	$THINCHART_UTILIZED_PEN2_COLOR = $THINCHART_PEN2_COLOR;
}
if ($THINCHART_PEN3_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN3_COLOR = $THINCHART_ADVANCED_OP_PEN3_COLOR;
} else {
	$THINCHART_UTILIZED_PEN3_COLOR = $THINCHART_PEN3_COLOR;
}

/* DATA ENTRY TICKET SAVE TO DATABASE */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'SAVETICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_THINCHART_5);
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
		$mysql_mod_openopc_query = "UPDATE ".$THINCHART_mysql_mod_openopc_TABLENAME." SET CERTIFIED='".$apache_DEFAULTDATESTAMP."', CERTIFIEDBY='".$mysql_seer_access_USERNAME."', CERTIFIEDCOMMENT='".$mysql_ENTRY_COMMENT."' WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP_CERT."%' AND '".$mysql_query_END_DATESTAMP_CERT."%') AND (CHARTNAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CERTIFIED IS NULL)";
		$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET FEEDBACK DATA */
		$apache_REPORT_RECORDENTRY = core_user_certification_result_display($multilang_THINCHART_6, $THINCHART_FORMFILL_NAME, $THINCHART_mysql_mod_openopc_TABLENAME);
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* CERTIFICATION TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_THINCHART_5);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* IDENTIFY CHART */
		$mysql_query_name_id = model_THINCHART_identify_chart($mysql_ENTRY_MACHINENAME,"YES");

		/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
		model_THINCHART_chart_parameters($mysql_query_name_id);

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "*";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$THINCHART_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (CHARTNAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, CHARTNAME ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET DATA */
		$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='SMALL' WIDTH='901' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='95'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='132'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='132'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='132'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>	
								<TR>
									<TD COLSPAN='10' ALIGN='CENTER'>
										<BR>
										".$multilang_STATIC_REVIEW_CERT.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='10'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='10'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN."<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='10'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='10'>
										<U><B>".$multilang_THINCHART_8.":</B></U> <I>".$THINCHART_WORKING_EVENT_NAME."</I><BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_STATIC_DATESTAMP_CAPS."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_THINCHART_9."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$THINCHART_WORKING_PEN1_NAME.":</U></B><BR>
										".$THINCHART_WORKING_PEN1_PENRANGE_LOW." [".$THINCHART_WORKING_PEN1_UM."] ..... ".$THINCHART_WORKING_PEN1_PENRANGE_HIGH." [".$THINCHART_WORKING_PEN1_UM."]
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$THINCHART_WORKING_PEN2_NAME.":</U></B><BR>
										".$THINCHART_WORKING_PEN2_PENRANGE_LOW." [".$THINCHART_WORKING_PEN2_UM."] ..... ".$THINCHART_WORKING_PEN2_PENRANGE_HIGH." [".$THINCHART_WORKING_PEN2_UM."]
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$THINCHART_WORKING_PEN3_NAME.":</U></B><BR>
										".$THINCHART_WORKING_PEN3_PENRANGE_LOW." [".$THINCHART_WORKING_PEN3_UM."] ..... ".$THINCHART_WORKING_PEN3_PENRANGE_HIGH." [".$THINCHART_WORKING_PEN3_UM."]
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_START."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_END."</U></B>
									</TD>
								</TR>				
								";

		/* HOLDING VALUES */
		$mysql_mod_openopc_WORKING_NOTIFICATION_HOLDING = 8675309;

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($THINCHART_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		$mysql_query_first_pass_for_form_radio_buttons = "YES";

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			if ( $mysql_query_index == 1 ) { 
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_CHARTNAME = $mysql_mod_openopc_query_row['CHARTNAME'];
				$mysql_mod_openopc_WORKING_PEN1 = $mysql_mod_openopc_query_row['PEN1'];
				$mysql_mod_openopc_WORKING_PEN2 = $mysql_mod_openopc_query_row['PEN2'];
				$mysql_mod_openopc_WORKING_PEN3 = $mysql_mod_openopc_query_row['PEN3'];
				$mysql_mod_openopc_WORKING_EVENT = $mysql_mod_openopc_query_row['EVENT'];
				$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
				$mysql_mod_openopc_WORKING_CERTIFIEDBY = $mysql_mod_openopc_query_row['CERTIFIEDBY'];
				$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT = $mysql_mod_openopc_query_row['CERTIFIEDCOMMENT'];
				if ($mysql_mod_openopc_WORKING_EVENT < 1) {
					$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_OFF;
				} else {
					$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_ON;
				}
				$mysql_mod_openopc_WORKING_NOTIFICATION = $mysql_mod_openopc_query_row['NOTIFICATION'];
				if ($mysql_mod_openopc_WORKING_NOTIFICATION == '') {
					$mysql_mod_openopc_WORKING_NOTIFICATION = 0;
				} else {
					/* pass */
				}
				$mysql_mod_openopc_WORKING_NOTIFICATION = $THINCHART_NOTIFICATION[$mysql_mod_openopc_WORKING_NOTIFICATION];
	
				/* HORIZONTAL BAR INDICATORS */
				$MODEL_WORKING_BAR_PEN1 = core_display_horizontal_bar ("132",$mysql_mod_openopc_WORKING_PEN1,$THINCHART_WORKING_PEN1_PENRANGE_LOW,$THINCHART_WORKING_PEN1_PENRANGE_HIGH);
				$MODEL_WORKING_BAR_PEN2 = core_display_horizontal_bar ("132",$mysql_mod_openopc_WORKING_PEN2,$THINCHART_WORKING_PEN2_PENRANGE_LOW,$THINCHART_WORKING_PEN2_PENRANGE_HIGH);
				$MODEL_WORKING_BAR_PEN3 = core_display_horizontal_bar ("132",$mysql_mod_openopc_WORKING_PEN3,$THINCHART_WORKING_PEN3_PENRANGE_LOW,$THINCHART_WORKING_PEN3_PENRANGE_HIGH);
	
				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$THINCHART_ROW_BACKGROUND = alarm_highlight_check($mysql_mod_openopc_WORKING_CERTIFIED,"NULL","NULL","CHECKFORNULL");

				/* IF NOTIFICATION HAS CHANGED, POST IT */
				if ($mysql_mod_openopc_WORKING_NOTIFICATION == $mysql_mod_openopc_WORKING_NOTIFICATION_HOLDING) {
					/* pass */
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR CLASS='hmirowborder1_ALT_NOBORDER'>
									<TD COLSPAN='9' ALIGN='RIGHT' VALIGN='MIDDLE'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='RIGHT'>
											<B>".$multilang_STATIC_NOTE.":</B> <I>".$mysql_mod_openopc_WORKING_NOTIFICATION."</I>
										</P>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
					/* UPDATE HOLDING VALUE */
					$mysql_mod_openopc_WORKING_NOTIFICATION_HOLDING = $mysql_mod_openopc_WORKING_NOTIFICATION;
				}

				/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH SYSTEM */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$THINCHART_ROW_BACKGROUND.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD CLASS='hmicellborder1' ".$THINCHART_WORKING_EVENT_BGCOLOR.">
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PEN1."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN1_COLOR.".png' WIDTH=".$MODEL_WORKING_BAR_PEN1." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PEN2."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN2_COLOR.".png' WIDTH=".$MODEL_WORKING_BAR_PEN2." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PEN3."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN3_COLOR.".png' WIDTH=".$MODEL_WORKING_BAR_PEN3." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									";
				if ($mysql_query_first_pass_for_form_radio_buttons == 'YES') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' checked value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
					$mysql_query_first_pass_for_form_radio_buttons = "NO";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
				}
				$apache_REPORT_RECORDENTRY = preg_replace("/<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked/", "<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT'", $apache_REPORT_RECORDENTRY);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ALIGN='CENTER'>
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_THINCHART_6,$THINCHART_FORMFILL_NAME,$multilang_STATIC_CERT_TIME_LIMIT,$multilang_THINCHART_10,"NULL","NULL","NULL","NULL","NULL","NULL","CERTIFICATION");
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
