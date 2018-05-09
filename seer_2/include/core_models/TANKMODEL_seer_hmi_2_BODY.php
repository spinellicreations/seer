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
TANK MODEL HMI 2 BODY (INCLUDED TO ALL TANKMODELS)
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
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_74."</B><BR>
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

/* DATA ENTRY TICKET SAVE TO DATABASE */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'SAVETICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_TANKMODEL_75);
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
		$mysql_mod_openopc_query = "UPDATE ".$TANKMODEL_mysql_mod_openopc_TABLENAME." SET CERTIFIED='".$apache_DEFAULTDATESTAMP."', CERTIFIEDBY='".$mysql_seer_access_USERNAME."', CERTIFIEDCOMMENT='".$mysql_ENTRY_COMMENT."' WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP_CERT."%' AND '".$mysql_query_END_DATESTAMP_CERT."%') AND (SILONAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CERTIFIED IS NULL)";
		$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET FEEDBACK DATA */
		$apache_REPORT_RECORDENTRY = core_user_certification_result_display($multilang_TANKMODEL_15, $TANKMODEL_FORMFILL_NAME, $TANKMODEL_mysql_mod_openopc_TABLENAME);
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* CERTIFICATION TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_TANKMODEL_75);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, SILONAME, PRODUCT, STATE, CERTIFIED, LEVEL_PERCENT, TEMPERATURE, TIME_SINCE_CLEAN";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (SILONAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, SILONAME ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET DATA */
		$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='40'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='40'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='70'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>	
								<TR>
									<TD COLSPAN='9' ALIGN='CENTER'>
										<BR>
										".$multilang_TANKMODEL_85.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_TANKMODEL_86."<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_TANKMODEL_64."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_65."</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_TANKMODEL_47."</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_TANKMODEL_48."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_42."</U></B>
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
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($TANKMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		$TANKMODEL_WORKING_PRODUCT_LAST = "NO_QUERY_RESULT_PARSED_AS_OF_YET";
		$mysql_query_first_pass_for_form_radio_buttons = "YES";

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			if ( $mysql_query_index == 1 ) { 
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_SILONAME = $mysql_mod_openopc_query_row['SILONAME'];
				$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
				$mysql_mod_openopc_WORKING_PRODUCT = $mysql_mod_openopc_query_row['PRODUCT'];
				$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
				$mysql_mod_openopc_WORKING_LEVEL_PERCENT = round($mysql_mod_openopc_query_row['LEVEL_PERCENT']);
				$mysql_mod_openopc_WORKING_TEMPERATURE = round($mysql_mod_openopc_query_row['TEMPERATURE'],2);
				$mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN = $mysql_mod_openopc_query_row['TIME_SINCE_CLEAN'];
	
				/* HORIZONTAL BAR INDICATOR FOR LEVEL AND TEMPERATURE */
				$TANKMODEL_WORKING_BAR_FILL = core_display_horizontal_bar ("200",$mysql_mod_openopc_WORKING_LEVEL_PERCENT,"0","100");
				$TANKMODEL_WORKING_BAR_TEMPERATURE = core_display_horizontal_bar ("200",$mysql_mod_openopc_WORKING_TEMPERATURE,$TANKMODEL_RANGE_TEMPERATURE_LOW,$TANKMODEL_RANGE_TEMPERATURE_HIGH);
				$TANKMODEL_WORKING_BAR_TEMPERATURE = ( $mysql_mod_openopc_WORKING_TEMPERATURE / ( $TANKMODEL_RANGE_TEMPERATURE_HIGH - $TANKMODEL_RANGE_TEMPERATURE_LOW )) * 200;
	
				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$TANKMODEL_ROW_BACKGROUND = alarm_highlight_check($mysql_mod_openopc_WORKING_CERTIFIED,"NULL","NULL","CHECKFORNULL");
				$TANKMODEL_WORKING_STATE = $TANKMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
				$TANKMODEL_WORKING_PRODUCT = $TANKMODEL_PRODUCT[$mysql_mod_openopc_WORKING_PRODUCT];
			
				/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH TANK OR SILO */
				if ($TANKMODEL_WORKING_PRODUCT != $TANKMODEL_WORKING_PRODUCT_LAST) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR CLASS='hmirowborder1_ALT_NOBORDER'>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='3' ALIGN='RIGHT' VALIGN='MIDDLE'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='RIGHT'>
											<B>".$multilang_TANKMODEL_107.":</B> <I>".$TANKMODEL_WORKING_PRODUCT."</I>
										</P>
									</TD>
									<TD COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				$TANKMODEL_WORKING_PRODUCT_LAST = $TANKMODEL_WORKING_PRODUCT;
	
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD ".$TANKMODEL_ROW_BACKGROUND.">
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$TANKMODEL_WORKING_STATE."
									</TD>
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_LEVEL_PERCENT."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$TANKMODEL_WORKING_BAR_FILL." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TEMPERATURE."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$TANKMODEL_WORKING_BAR_TEMPERATURE." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN."
									</TD>
									";

				if ($mysql_query_first_pass_for_form_radio_buttons == 'YES') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' checked value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
					$mysql_query_first_pass_for_form_radio_buttons = "NO";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
				}
				$apache_REPORT_RECORDENTRY = preg_replace("/<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked/", "<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT'", $apache_REPORT_RECORDENTRY);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$TANKMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_TANKMODEL_13,$TANKMODEL_FORMFILL_NAME,$multilang_TANKMODEL_87,$multilang_TANKMODEL_88,"NULL","NULL","NULL","NULL","NULL","NULL","CERTIFICATION");
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
