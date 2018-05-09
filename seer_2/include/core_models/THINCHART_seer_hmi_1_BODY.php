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
THINCHART HMI 1 BODY (INCLUDED TO ALL THINCHARTS)
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
								<B>".$multilang_THINCHART_0.": ".$multilang_THINCHART_2."</B><BR>
								<I>".$THINCHART_SUBPAGETITLE."</I>
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
	core_user_date_time_range_input_type_3($multilang_THINCHART_5,"OMITDATESTAMP");

	/* IDENTIFY CHART */
	$mysql_query_name_id = model_THINCHART_identify_chart($mysql_ENTRY_MACHINENAME,"YES");

	/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
	model_THINCHART_chart_parameters($mysql_query_name_id);
	if ($mysql_mod_openopc_WORKING_EVENT < 1) {
		$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_OFF;
	} else {
		$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_ON;
	}

	/* MANUAL DATA ENTRY - ROW OF COLUMN LABELS */
	$apache_COLUMN_LABEL_ROW = "
									<TR>
										<TD COLSPAN='5'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN1_NAME." [".$THINCHART_WORKING_PEN1_UM."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN2_NAME." [".$THINCHART_WORKING_PEN2_UM."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN3_NAME." [".$THINCHART_WORKING_PEN3_UM."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_EVENT_NAME."</U></B>
										</TD>
									</TR>
									";

	$mysql_ENTRY_INDEX = 1;
	$mysql_ENTRY_FIRST_PASS = "YES";
	while ( $mysql_ENTRY_INDEX <= $mysql_ENTRY_COUNT_REQUEST ) {
		$mysql_REQUEST_THINCHART_DATESTAMP = "mysql_THINCHART_DATESTAMP".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_THINCHART_DATESTAMP] != '' ) {
			$mysql_THINCHART_DATESTAMP[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_THINCHART_DATESTAMP];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_THINCHART_PEN1 = "mysql_THINCHART_PEN1".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_THINCHART_PEN1] != '' ) {
			$mysql_THINCHART_PEN1[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_THINCHART_PEN1];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_THINCHART_PEN2 = "mysql_THINCHART_PEN2".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_THINCHART_PEN2] != '' ) {
			$mysql_THINCHART_PEN2[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_THINCHART_PEN2];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_THINCHART_PEN3 = "mysql_THINCHART_PEN3".$mysql_ENTRY_INDEX;
		if ( $_POST[$mysql_REQUEST_THINCHART_PEN3] != '' ) {
			$mysql_THINCHART_PEN3[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_THINCHART_PEN3];
		} else {
			if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
			} else {
				/* pass */
			}
		}
		$mysql_REQUEST_THINCHART_EVENT = "mysql_THINCHART_EVENT".$mysql_ENTRY_INDEX;
		if ( (isset($_POST[$mysql_REQUEST_THINCHART_EVENT])) && ($_POST[$mysql_REQUEST_THINCHART_EVENT] != '') ) {
			$mysql_THINCHART_EVENT[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_THINCHART_EVENT];
		} else {
			$mysql_THINCHART_EVENT[$mysql_ENTRY_INDEX] = 0;
		}
		if ($mysql_THINCHART_EVENT[$mysql_ENTRY_INDEX] < 1) {
			$mysql_THINCHART_EVENT_BGCOLOR[$mysql_ENTRY_INDEX] = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_OFF;
		} else {
			$mysql_THINCHART_EVENT_BGCOLOR[$mysql_ENTRY_INDEX] = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_ON;
		}
		$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
		$mysql_ENTRY_FIRST_PASS = "NO";
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* START THE TICKET CONFIRMATION */
		$apache_REPORT_COMMENT_MANUAL_ADD = $multilang_STATIC_RECORD_MANUALLY_ADDED;

		$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='STANDARD' WIDTH='700' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='140'>
									</TD>
									<TD WIDTH='140'>
									</TD>
									<TD WIDTH='140'>
									</TD>
									<TD WIDTH='140'>
									</TD>
									<TD WIDTH='140'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5' ALIGN='CENTER'>
										".$multilang_STATIC_CONFIRMATION_OF_TICKET.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' ALIGN='CENTER'>
										".$multilang_STATIC_AUTO_CERT_BY.":<BR>
										".$multilang_STATIC_CERT_STAMP.": <BR>
										".$multilang_STATIC_CERT_COMMENT.":
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER'>
										<B><I>".$mysql_seer_access_REALNAME."</I></B><BR>
										<B><I>".$apache_DEFAULTDATESTAMP."</I></B><BR>
										<B><I>".$apache_REPORT_COMMENT_MANUAL_ADD."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5' ALIGN='CENTER'>
										".$multilang_STATIC_INPUT_MORE_RECORDS."... <A HREF='./$seer_REFERRINGPAGE'><B><U>".$multilang_MENU_BACK."</U></B></A>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5' ALIGN='CENTER'>
										".$multilang_STATIC_CERT_INSPECT_LIST."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
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
										".$mysql_THINCHART_DATESTAMP[$mysql_ENTRY_INDEX]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_THINCHART_PEN1[$mysql_ENTRY_INDEX]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_THINCHART_PEN2[$mysql_ENTRY_INDEX]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_THINCHART_PEN3[$mysql_ENTRY_INDEX]."
									</TD>
									<TD CLASS='hmicellborder1' ".$mysql_THINCHART_EVENT_BGCOLOR[$mysql_ENTRY_INDEX].">
										<BR>
									</TD>
								</TR>
								";

			/* ADD THE ROW TO THE TICKET CONFIRMATION */
			if ( ($mysql_THINCHART_DATESTAMP[$mysql_ENTRY_INDEX] != '') && ($mysql_THINCHART_PEN1[$mysql_ENTRY_INDEX] != '') && ($mysql_THINCHART_PEN2[$mysql_ENTRY_INDEX] != '') && ($mysql_THINCHART_PEN3[$mysql_ENTRY_INDEX] != '')) {

				/* ECHO TO PAGE */		
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;

				/* DUMP TO DATABASE */
				$mysql_mod_openopc_query = "INSERT INTO ".$THINCHART_mysql_mod_openopc_TABLENAME." VALUES('".$mysql_THINCHART_DATESTAMP[$mysql_ENTRY_INDEX]."', '".$mysql_ENTRY_MACHINENAME."', '".$mysql_THINCHART_PEN1[$mysql_ENTRY_INDEX]."', '".$mysql_THINCHART_PEN2[$mysql_ENTRY_INDEX]."', '".$mysql_THINCHART_PEN3[$mysql_ENTRY_INDEX]."', '".$mysql_THINCHART_EVENT[$mysql_ENTRY_INDEX]."', '0', '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', '".$apache_REPORT_COMMENT_MANUAL_ADD."')";
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
									<TD COLSPAN='5'>
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
	core_user_date_time_range_input_type_3($multilang_THINCHART_5);

	/* IDENTIFY CHART */
	$mysql_query_name_id = 8675309;
	$mysql_query_name_id_index = 0;
	while ($mysql_query_name_id_index < $THINCHART_COUNT) {
		if ($THINCHART_NAME[$mysql_query_name_id_index] == $mysql_ENTRY_MACHINENAME) {
			$mysql_query_name_id = $mysql_query_name_id_index;
		} else {
			/* pass */
		}
		$mysql_query_name_id_index = $mysql_query_name_id_index + 1;
	}
	if ( $mysql_query_name_id == 8675309 ) {
		$seer_HMIACTION_FAULT = 1;
	} else {
		/* pass */
	}

	/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
	$THINCHART_WORKING_PEN1_NAME = $THINCHART_PENNAME_[$mysql_query_name_id][1];
	$THINCHART_WORKING_PEN1_PENRANGE_LOW = $THINCHART_PENRANGE_LOW[$mysql_query_name_id][1];
	$THINCHART_WORKING_PEN1_PENRANGE_HIGH = $THINCHART_PENRANGE_HIGH[$mysql_query_name_id][1];
	$THINCHART_WORKING_PEN1_UM = $THINCHART_PENUM_[$mysql_query_name_id][1];
	$THINCHART_WORKING_PEN2_NAME = $THINCHART_PENNAME_[$mysql_query_name_id][2];
	$THINCHART_WORKING_PEN2_PENRANGE_LOW = $THINCHART_PENRANGE_LOW[$mysql_query_name_id][2];
	$THINCHART_WORKING_PEN2_PENRANGE_HIGH = $THINCHART_PENRANGE_HIGH[$mysql_query_name_id][2];
	$THINCHART_WORKING_PEN2_UM = $THINCHART_PENUM_[$mysql_query_name_id][2];
	$THINCHART_WORKING_PEN3_NAME = $THINCHART_PENNAME_[$mysql_query_name_id][3];
	$THINCHART_WORKING_PEN3_PENRANGE_LOW = $THINCHART_PENRANGE_LOW[$mysql_query_name_id][3];
	$THINCHART_WORKING_PEN3_PENRANGE_HIGH = $THINCHART_PENRANGE_HIGH[$mysql_query_name_id][3];
	$THINCHART_WORKING_PEN3_UM = $THINCHART_PENUM_[$mysql_query_name_id][3];
	$THINCHART_WORKING_EVENT_NAME = $THINCHART_PENNAME_[$mysql_query_name_id]['EVENT'];
	if ($mysql_mod_openopc_WORKING_EVENT < 1) {
		$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_OFF;
	} else {
		$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_ON;
	}

	/* MANUAL DATA ENTRY - ROW OF COLUMN LABELS */
	$apache_COLUMN_LABEL_ROW = "
									<TR>
										<TD COLSPAN='5'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN1_NAME." [".$THINCHART_WORKING_PEN1_UM."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN2_NAME." [".$THINCHART_WORKING_PEN2_UM."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN3_NAME." [".$THINCHART_WORKING_PEN3_UM."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_EVENT_NAME."</U></B>
										</TD>
									</TR>
									";

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* GENERATE AUTO FILL DATESTAMPS */
		$mysql_DATESTAMP = auto_fill_manual_record_entry_datestamp_fields($mysql_ENTRY_COUNT_REQUEST,$THINCHART_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES,$mysql_ENTRY_START_YEAR,$mysql_ENTRY_START_MONTH,$mysql_ENTRY_START_DAY,$mysql_ENTRY_START_HOUR,$mysql_ENTRY_START_MINUTE);

		/* START THE TICKET */
		$apache_REPORT_RECORDENTRY = "
							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='STANDARD' WIDTH='700' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='140'>
										</TD>
										<TD WIDTH='140'>
										</TD>
										<TD WIDTH='140'>
										</TD>
										<TD WIDTH='140'>
										</TD>
										<TD WIDTH='140'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='5' ALIGN='CENTER'>
											".$multilang_STATIC_DATA_TICKET.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
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
											<INPUT TYPE='text' size='20' maxlength='18' name='mysql_THINCHART_DATESTAMP".$mysql_ENTRY_INDEX."' value='".$mysql_DATESTAMP[$mysql_ENTRY_INDEX]."'>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='10' maxlength='8' name='mysql_THINCHART_PEN1".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='10' maxlength='8' name='mysql_THINCHART_PEN2".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='10' maxlength='8' name='mysql_THINCHART_PEN3".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='checkbox' name='mysql_THINCHART_EVENT".$mysql_ENTRY_INDEX."' value='1'>
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
										<TD COLSPAN='5'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD  COLSPAN='2' ALIGN='RIGHT'>
											<B><I>".$multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER."</I></B><BR>
											... ".$multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER."
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_3("BUILDTICKET",$multilang_THINCHART_6,$THINCHART_FORMFILL_NAME,$THINCHART_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES);
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
