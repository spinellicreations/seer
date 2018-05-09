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
TANK MODEL HMI 1 BODY (INCLUDED TO ALL TANKMODELS)
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
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_56."</B><BR>
								<I>".$TANKMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* MANUAL DATA ENTRY - ROW OF COLUMN LABELS */
/* ------------------------------------------------------------------ */
$apache_COLUMN_LABEL_ROW = "
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER' WIDTH='200'>
											<B><U>".$multilang_TANKMODEL_64."</U></B>
										</TD>
										<TD ALIGN='CENTER' WIDTH='200'>
											<B><U>".$multilang_TANKMODEL_65."</U></B>
										</TD>
										<TD ALIGN='CENTER' WIDTH='150'>
											<B><U>".$multilang_TANKMODEL_47." [%]</U></B>
										</TD>
										<TD ALIGN='CENTER' WIDTH='150'>
											<B><U>".$multilang_TANKMODEL_48." [".$TANKMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
									</TR>
									";

/* DATA ENTRY TICKET SAVE TO DATABASE */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'SAVETICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_3($multilang_TANKMODEL_75,"OMITDATESTAMP");

	$mysql_ENTRY_INDEX = 1;
	$mysql_ENTRY_FIRST_PASS = "YES";
	while ( $mysql_ENTRY_INDEX <= $mysql_ENTRY_COUNT_REQUEST ) {
		$mysql_REQUEST_TANK_DATESTAMP = "mysql_TANK_DATESTAMP".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_TANK_DATESTAMP] != '' ) {
			$mysql_TANK_DATESTAMP[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_TANK_DATESTAMP];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_TANK_STATE = "mysql_TANK_STATE".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_TANK_STATE] != '' ) {
			$mysql_TANK_STATE[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_TANK_STATE];
			$mysql_REQUEST_TANK_STATE_FRIENDLYNAME = $mysql_TANK_STATE[$mysql_ENTRY_INDEX];
			$mysql_TANK_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX] = $TANKMODEL_STATE[$mysql_REQUEST_TANK_STATE_FRIENDLYNAME];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_TANK_LEVEL = "mysql_TANK_LEVEL".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_TANK_LEVEL] != '' ) {
			$mysql_TANK_LEVEL[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_TANK_LEVEL];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_TANK_TEMP = "mysql_TANK_TEMP".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_TANK_TEMP] != '' ) {
			$mysql_TANK_TEMP[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_TANK_TEMP];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
		$mysql_ENTRY_FIRST_PASS = "NO";
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* START THE TICKET CONFIRMATION */
		$apache_REPORT_COMMENT_MANUAL_ADD = $multilang_TANKMODEL_57;

		$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='STANDARD' WIDTH='700' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='150'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4' ALIGN='CENTER'>
										".$multilang_TANKMODEL_58.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' ALIGN='CENTER'>
										".$multilang_TANKMODEL_59.":<BR>
										".$multilang_TANKMODEL_60.": <BR>
										".$multilang_TANKMODEL_61.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><I>".$mysql_seer_access_REALNAME."</I></B><BR>
										<B><I>".$apache_DEFAULTDATESTAMP."</I></B><BR>
										<B><I>".$apache_REPORT_COMMENT_MANUAL_ADD."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4' ALIGN='CENTER'>
										".$multilang_TANKMODEL_62."... <A HREF='./$seer_REFERRINGPAGE'><B><U>".$multilang_MENU_BACK."</U></B></A>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4' ALIGN='CENTER'>
										".$multilang_TANKMODEL_63."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";

		/* ADD UNIQUE DATESTAMPS TO TICKET */
		$mysql_ENTRY_INDEX = 1;
		$mysql_COLUMN_LABEL_INDEX = 0;
		while ( $mysql_ENTRY_INDEX <= $mysql_ENTRY_COUNT_REQUEST ) {

			/* CREATE A UNIQUE ROW IDENTITY AND LABEL ROW COLUMNS EVERY SO OFTEN */
			$apache_REPORT_RECORDENTRY_ROW_TEMP = label_columns_as_a_row($apache_COLUMN_LABEL_ROW,"24");

			/* BUILD EACH ROW OF THE TICKET CONFIRMATION */
			$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
								<TR>
									<TD ALIGN='CENTER'>
										".$mysql_TANK_DATESTAMP[$mysql_ENTRY_INDEX]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_TANK_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_TANK_LEVEL[$mysql_ENTRY_INDEX]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_TANK_TEMP[$mysql_ENTRY_INDEX]."
									</TD>
								</TR>
								";

			/* ADD THE ROW TO THE TICKET CONFIRMATION */
			if ( ($mysql_TANK_DATESTAMP[$mysql_ENTRY_INDEX] != '') && ($mysql_TANK_STATE[$mysql_ENTRY_INDEX] != '') && ($mysql_TANK_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX] != '') && ($mysql_TANK_LEVEL[$mysql_ENTRY_INDEX] != '') && ($mysql_TANK_TEMP[$mysql_ENTRY_INDEX] != '') ) {

				/* ECHO TO PAGE */		
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;

				/* DUMP TO DATABASE */
				$mysql_mod_openopc_query = "INSERT INTO ".$TANKMODEL_mysql_mod_openopc_TABLENAME." VALUES('".$mysql_TANK_DATESTAMP[$mysql_ENTRY_INDEX]."', '".$mysql_ENTRY_MACHINENAME."', '".$mysql_TANK_STATE[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, NULL, NULL, '".$mysql_TANK_LEVEL[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".$mysql_TANK_TEMP[$mysql_ENTRY_INDEX]."', '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', '".$apache_REPORT_COMMENT_MANUAL_ADD."')";
				core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);	

			} else {
				/* do not add */
			}

			/* INDEX THE TICKET CONFIRMATION */
			$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
		}

		/* FINISH THE TICKET CONFIRMATION */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";
	} else {
		/* FAULT OUT TO START PAGE */
	}	
}

/* DATA ENTRY TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_3($multilang_TANKMODEL_75);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* GENERATE AUTO FILL DATESTAMPS */
		$mysql_DATESTAMP = auto_fill_manual_record_entry_datestamp_fields($mysql_ENTRY_COUNT_REQUEST,$TANKMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES,$mysql_ENTRY_START_YEAR,$mysql_ENTRY_START_MONTH,$mysql_ENTRY_START_DAY,$mysql_ENTRY_START_HOUR,$mysql_ENTRY_START_MINUTE);

		/* START THE TICKET */
		$apache_REPORT_RECORDENTRY = "
							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='STANDARD' WIDTH='700' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD COLSPAN='4' ALIGN='CENTER'>
											".$multilang_TANKMODEL_66.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
										</TD>
									</TR>
									";

		/* ADD UNIQUE DATESTAMPS TO TICKET */
		$mysql_ENTRY_INDEX = 1;
		$mysql_COLUMN_LABEL_INDEX = 0;
		while ( $mysql_ENTRY_INDEX <= $mysql_ENTRY_COUNT_REQUEST ) {

			/* CREATE A UNIQUE ROW IDENTITY AND LABEL ROW COLUMNS EVERY SO OFTEN */
			$apache_REPORT_RECORDENTRY_ROW_TEMP = label_columns_as_a_row($apache_COLUMN_LABEL_ROW,"14");
	
			/* BUILD EACH ROW OF THE TICKET */
			$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='20' maxlength='18' name='mysql_TANK_DATESTAMP".$mysql_ENTRY_INDEX."' value='".$mysql_DATESTAMP[$mysql_ENTRY_INDEX]."'>
										</TD>
										<TD ALIGN='CENTER'>
											<SELECT NAME='mysql_TANK_STATE".$mysql_ENTRY_INDEX."'><OPTION VALUE=''>".$multilang_TANKMODEL_65.$TANKMODEL_FORMFILL_STATE."</SELECT>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='3' name='mysql_TANK_LEVEL".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_TANK_TEMP".$mysql_ENTRY_INDEX."' value=''>
										</TD>
									</TR>
									";

			/* ADD THE ROW TO THE TICKET */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;
	
			/* INDEX THE TICKET */
			$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
		}

		/* FINISH THE TICKET */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD ALIGN='RIGHT'>
											<B><I>".$multilang_TANKMODEL_67."</I></B><BR>
											... ".$multilang_TANKMODEL_68."
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_HMIACTION' value='SAVETICKET'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='".$mysql_ENTRY_MACHINENAME."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_COUNT_REQUEST' value='".$mysql_ENTRY_COUNT_REQUEST."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
										<TD>
											<BR>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
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
/* -- MANUAL RECORD ENTRY DATA TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_3("BUILDTICKET",$multilang_TANKMODEL_13,$TANKMODEL_FORMFILL_NAME,$TANKMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES);
}
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY; 
$apache_REPORTL6 = "";
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
