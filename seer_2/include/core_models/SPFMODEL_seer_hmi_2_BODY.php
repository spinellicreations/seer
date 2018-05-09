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
SPF MODEL HMI 2 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_4."</B><BR>
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

/* DATA ENTRY TICKET SAVE TO DATABASE */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'SAVETICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_SPFMODEL_77);
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

		/* IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
		list($mysql_ENTRY_MACHINENAME_BY_INTEGER,$seer_MANUAL_ENTRY_GROUP,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES) = model_SPF_identify_machine_type_and_manual_record_entry($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED);

	} else {
		/* pass */
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY AND CERTIFY THE TICKETED RECORDS*/
		if ( $seer_MANUAL_ENTRY_GROUP == 'A' ) {
			$mysql_mod_openopc_query = "UPDATE ".$SPFMODEL_mysql_mod_openopc_TABLENAME." SET CERTIFIED='".$apache_DEFAULTDATESTAMP."', CERTIFIEDBY='".$mysql_seer_access_USERNAME."', CERTIFIEDCOMMENT='".$mysql_ENTRY_COMMENT."' WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP_CERT."%' AND '".$mysql_query_END_DATESTAMP_CERT."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CIP_STEP ".$SPFMODEL_CIP_STEP_REALSTEPS.") AND (CERTIFIED IS NULL)";
			core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		} else {
			/* pass */
		}

		if ( ($seer_MANUAL_ENTRY_GROUP == 'B') || ($seer_MANUAL_ENTRY_GROUP == 'C') ) {
			$mysql_mod_openopc_query = "UPDATE ".$SPFMODEL_mysql_mod_openopc_TABLENAME." SET CERTIFIED='".$apache_DEFAULTDATESTAMP."', CERTIFIEDBY='".$mysql_seer_access_USERNAME."', CERTIFIEDCOMMENT='".$mysql_ENTRY_COMMENT."' WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CERTIFIED IS NULL)";
			core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		} else {
			/* pass */
		}

		/* BUILD TICKET FEEDBACK DATA */
		$apache_REPORT_RECORDENTRY = core_user_certification_result_display($multilang_SPFMODEL_58, $SPFMODEL_FORMFILL_NAME, $SPFMODEL_mysql_mod_openopc_TABLENAME);
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* CERTIFICATION TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_SPFMODEL_77);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
		list($mysql_ENTRY_MACHINENAME_BY_INTEGER,$seer_MANUAL_ENTRY_GROUP,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES) = model_SPF_identify_machine_type_and_manual_record_entry($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED);

	} else {
		/* pass */
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY */
		if ( $seer_MANUAL_ENTRY_GROUP == 'A') {
			$mysql_mod_openopc_query = "*";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CIP_STEP ".$SPFMODEL_CIP_STEP_REALSTEPS.") ORDER BY DATESTAMP ASC, MACHINE_NAME ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		} else {
			/* pass */
		}

		if ( ($seer_MANUAL_ENTRY_GROUP == 'B') || ($seer_MANUAL_ENTRY_GROUP == 'C') ) {
			$mysql_mod_openopc_query = "*";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, MACHINE_NAME ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		} else {
			/* pass */
		}

		/* BUILD TICKET DATA */
		$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='STANDARD' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='750'ALIGN='CENTER'>
										<BR>
										".$multilang_SPFMODEL_91.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_SPFMODEL_92."<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";
		if ( $seer_MANUAL_ENTRY_GROUP == 'A') {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='VERYSMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD>
										<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_67."</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_68." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_START."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_END."</U></B>
									</TD>
								</TR>	
								<TR>
									<TD COLSPAN='10'>
										<BR>
									</TD>
								</TR>				
								";
		} else {
			/* pass */
		}
		if ( $seer_MANUAL_ENTRY_GROUP == 'B') {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='VERYSMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
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
										<B><U>".$multilang_SPFMODEL_93." [".$SPFMODEL_UM_PRESSURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_38." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_67."</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_68." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_START."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_END."</U></B>
									</TD>
								</TR>	
								<TR>
									<TD COLSPAN='10'>
										<BR>
									</TD>
								</TR>				
								";
		} else {
			/* pass */
		}
		if ( $seer_MANUAL_ENTRY_GROUP == 'C') {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='VERYSMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='110'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD>
										<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_93." [".$SPFMODEL_UM_PRESSURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_38." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_START."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_END."</U></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='10'>
										<BR>
									</TD>
								</TR>				
								";
		} else {
			/* pass */
		}

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($SPFMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		$mysql_query_index = 1;
		$mysql_query_first_pass_for_form_radio_buttons = "YES";

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			if ( $mysql_query_index == 1 ) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_MACHINE_NAME = $mysql_mod_openopc_query_row['MACHINE_NAME'];
				$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
				$mysql_mod_openopc_WORKING_PRESSURE_RAW = $mysql_mod_openopc_query_row['PRESSURE_RAW'];
				$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = $mysql_mod_openopc_query_row['PRESSURE_PASTEURIZE'];
				$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = $mysql_mod_openopc_query_row['TEMPERATURE_PASTEURIZE'];
				$mysql_mod_openopc_WORKING_CIP_STEP = $mysql_mod_openopc_query_row['CIP_STEP'];
				$mysql_mod_openopc_WORKING_CIP_TEMP = $mysql_mod_openopc_query_row['CIP_TEMP'];
				$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
	
				/* HORIZONTAL BAR INDICATOR FOR ANALOG SIGNALS */	
				$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR = core_display_horizontal_bar ("110",$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
				$mysql_mod_openopc_WORKING_CIP_TEMP_BAR = core_display_horizontal_bar ("110",$mysql_mod_openopc_WORKING_CIP_TEMP,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
	
				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$SPFMODEL_ROW_BACKGROUND = alarm_highlight_check($mysql_mod_openopc_WORKING_CERTIFIED,"NULL","NULL","CHECKFORNULL");
				$mysql_mod_openopc_WORKING_STATE = $SPFMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
				$mysql_mod_openopc_WORKING_CIP_STEP = $SPFMODEL_CIP_STEP[$mysql_mod_openopc_WORKING_CIP_STEP];
				$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL = $mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE - $mysql_mod_openopc_WORKING_PRESSURE_RAW;

				/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH CIP SYSTEM */
				if ( $seer_MANUAL_ENTRY_GROUP == 'A') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND.">
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_STATE."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_STEP."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_TEMP."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_CIP_TEMP_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD COLSPAN='2' ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<BR>
									</TD>
									";
				if ($mysql_query_first_pass_for_form_radio_buttons == 'YES') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' checked value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
					$mysql_query_first_pass_for_form_radio_buttons = "NO";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
				}
				$apache_REPORT_RECORDENTRY = preg_replace("/<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked/", "<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT'", $apache_REPORT_RECORDENTRY);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked value=".$mysql_mod_openopc_WORKING_DATESTAMP.">
									</TD>
								</TR>	
								";
				} else {
					/* pass */
				}

				if ( $seer_MANUAL_ENTRY_GROUP == 'B') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD ".$SPFMODEL_ROW_BACKGROUND.">
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_STATE."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_STEP."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_TEMP."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_CIP_TEMP_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									";
				if ($mysql_query_first_pass_for_form_radio_buttons == 'YES') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' checked value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
					$mysql_query_first_pass_for_form_radio_buttons = "NO";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
				}
				$apache_REPORT_RECORDENTRY = preg_replace("/<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked/", "<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT'", $apache_REPORT_RECORDENTRY);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked value=".$mysql_mod_openopc_WORKING_DATESTAMP.">
									</TD>
								</TR>	
								";
				} else {
					/* pass */
				}

				if ( $seer_MANUAL_ENTRY_GROUP == 'C') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND.">
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_STATE."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL."
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<BR>
									</TD>
									";
				if ($mysql_query_first_pass_for_form_radio_buttons == 'YES') {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' checked value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
					$mysql_query_first_pass_for_form_radio_buttons = "NO";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_START_DATESTAMP_CERT' value=".substr($mysql_mod_openopc_WORKING_DATESTAMP, 0, 15).">
									</TD>
									";
				}
				$apache_REPORT_RECORDENTRY = preg_replace("/<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked/", "<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT'", $apache_REPORT_RECORDENTRY);
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$SPFMODEL_ROW_BACKGROUND." ALIGN='CENTER'>
										<INPUT TYPE='radio' name='mysql_query_END_DATESTAMP_CERT' checked value=".$mysql_mod_openopc_WORKING_DATESTAMP.">
									</TD>
								</TR>	
								";
				} else {
					/* pass */
				}

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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_SPFMODEL_94,$multilang_SPFMODEL_95,"NULL","NULL","NULL","NULL","NULL","NULL","CERTIFICATION");
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
