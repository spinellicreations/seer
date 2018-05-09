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
SPF MODEL HMI 1 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_3."</B><BR>
								<I>".$SPFMODEL_SUBPAGETITLE."</I>
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
	core_user_date_time_range_input_type_3($multilang_SPFMODEL_77,"OMITDATESTAMP");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
		list($mysql_ENTRY_MACHINENAME_BY_INTEGER,$seer_MANUAL_ENTRY_GROUP,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES) = model_SPF_identify_machine_type_and_manual_record_entry($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED);

		/* LABEL COLUMN ROW */
		$apache_COLUMN_LABEL_ROW = model_SPF_label_columns_for_manual_report_entry($seer_MANUAL_ENTRY_GROUP);

		/* PULL IN VARS */
		$mysql_ENTRY_INDEX = 1;
		$mysql_ENTRY_FIRST_PASS = "YES";
		while ( $mysql_ENTRY_INDEX <= $mysql_ENTRY_COUNT_REQUEST ) {
			$mysql_REQUEST_SPF_DATESTAMP = "mysql_SPF_DATESTAMP".$mysql_ENTRY_INDEX;
			if ( $_POST[$mysql_REQUEST_SPF_DATESTAMP] != '' ) {
				$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_SPF_DATESTAMP];
			} else {
				if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
					$seer_HMIACTION_FAULT = 1;
					$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
				} else {
					/* pass */
				}
			}
			$mysql_REQUEST_SPF_STATE = "mysql_SPF_STATE".$mysql_ENTRY_INDEX;
			if ( $_POST[$mysql_REQUEST_SPF_STATE] != '' ) {
				$mysql_SPF_STATE[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_SPF_STATE];
				$mysql_REQUEST_SPF_STATE_FRIENDLYNAME = $mysql_SPF_STATE[$mysql_ENTRY_INDEX];
				$mysql_SPF_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX] = $SPFMODEL_STATE[$mysql_REQUEST_SPF_STATE_FRIENDLYNAME];
			} else {
				if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
					$seer_HMIACTION_FAULT = 1;
					$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
				} else {
					/* pass */
				}
			}

			if ( ($seer_MANUAL_ENTRY_GROUP == 'A') || ($seer_MANUAL_ENTRY_GROUP == 'B') ) {
				$mysql_REQUEST_CIP_STEP = "mysql_CIP_STEP".$mysql_ENTRY_INDEX;
				if ( $_POST[$mysql_REQUEST_CIP_STEP] != '' ) {
					$mysql_CIP_STEP[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_CIP_STEP];
					$mysql_REQUEST_CIP_STEP_FRIENDLYNAME = $mysql_CIP_STEP[$mysql_ENTRY_INDEX];
					$mysql_CIP_STEP_FRIENDLYNAME[$mysql_ENTRY_INDEX] = $SPFMODEL_CIP_STEP[$mysql_REQUEST_CIP_STEP_FRIENDLYNAME];
				} else {
					if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
					} else {
						/* pass */
					}
				}
				$mysql_REQUEST_CIP_TEMP = "mysql_CIP_TEMP".$mysql_ENTRY_INDEX;
				if ( $_POST[$mysql_REQUEST_CIP_TEMP] != '' ) {
					$mysql_CIP_TEMP[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_CIP_TEMP];
				} else {
					if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
					} else {
						/* pass */
					}
				}
			} else {
				/* pass */
			}

			if ( ($seer_MANUAL_ENTRY_GROUP == 'B') || ($seer_MANUAL_ENTRY_GROUP == 'C') ) {
				$mysql_REQUEST_PRESSURE_RAW = "mysql_PRESSURE_RAW".$mysql_ENTRY_INDEX;
				if ( $_POST[$mysql_REQUEST_PRESSURE_RAW] != '' ) {
					$mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_PRESSURE_RAW];
				} else {
					if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
					} else {
						/* pass */
					}
				}
				$mysql_REQUEST_PRESSURE_PASTEURIZE = "mysql_PRESSURE_PASTEURIZE".$mysql_ENTRY_INDEX;
				if ( $_POST[$mysql_REQUEST_PRESSURE_PASTEURIZE] != '' ) {
					$mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_PRESSURE_PASTEURIZE];
				} else {
					if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
					} else {
						/* pass */
					}
				}
				$mysql_REQUEST_TEMPERATURE_INLET = "mysql_TEMPERATURE_INLET".$mysql_ENTRY_INDEX;
				if ( $_POST[$mysql_REQUEST_TEMPERATURE_INLET] != '' ) {
					$mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_TEMPERATURE_INLET];
				} else {
					if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
					} else {
						/* pass */
					}
				}
				$mysql_REQUEST_TEMPERATURE_PASTEURIZE = "mysql_TEMPERATURE_PASTEURIZE".$mysql_ENTRY_INDEX;
				if ( $_POST[$mysql_REQUEST_TEMPERATURE_PASTEURIZE] != '' ) {
					$mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX] = $_POST[$mysql_REQUEST_TEMPERATURE_PASTEURIZE];
				} else {
					if ( $mysql_ENTRY_FIRST_PASS == 'YES' ) {
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = $multilang_SPFMODEL_3;
					} else {
						/* pass */
					}
				}
			} else {
				/* pass */
			}

			$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
			$mysql_ENTRY_FIRST_PASS = "NO";
		}
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* START THE TICKET CONFIRMATION */
		$apache_REPORT_COMMENT_MANUAL_ADD = $multilang_SPFMODEL_70;

		$apache_REPORT_RECORDENTRY = "
								<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='113'>
										</TD>
										<TD WIDTH='132'>
										</TD>
										<TD WIDTH='93'>
										</TD>
										<TD WIDTH='112'>
										</TD>
										<TD WIDTH='113'>
										</TD>
										<TD WIDTH='92'>
										</TD>
										<TD WIDTH='133'>
										</TD>
										<TD WIDTH='112'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8' ALIGN='CENTER'>
											".$multilang_SPFMODEL_71.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4' ALIGN='CENTER'>
											".$multilang_SPFMODEL_72.":<BR>
											".$multilang_SPFMODEL_73.": <BR>
											".$multilang_SPFMODEL_74.":
										</TD>
										<TD COLSPAN='4' ALIGN='CENTER'>
											<B><I>".$mysql_seer_access_REALNAME."</I></B><BR>
											<B><I>".$apache_DEFAULTDATESTAMP."</I></B><BR>
											<B><I>".$apache_REPORT_COMMENT_MANUAL_ADD."</I></B>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8' ALIGN='CENTER'>
											".$multilang_SPFMODEL_75."... <A HREF='./$seer_REFERRINGPAGE'><B><U>".$multilang_MENU_BACK."</U></B></A>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='1'>
											<BR>
										</TD>
										<TD COLSPAN='6' ALIGN='CENTER'>
											".$multilang_SPFMODEL_76."
										</TD>
										<TD COLSPAN='1'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8'>
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
			if ( $seer_MANUAL_ENTRY_GROUP == 'A' ) {
				$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD COLSPAN='2' ALIGN='CENTER'>
											".$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX]."
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											".$mysql_SPF_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX]."
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											".$mysql_CIP_STEP_FRIENDLYNAME[$mysql_ENTRY_INDEX]."
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											".$mysql_CIP_TEMP[$mysql_ENTRY_INDEX]."
										</TD>
									</TR>
									";

				/* ADD THE ROW TO THE TICKET CONFIRMATION */
				if ( $mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX] != '' && $mysql_SPF_STATE[$mysql_ENTRY_INDEX] != '' && $mysql_CIP_STEP[$mysql_ENTRY_INDEX] != '' && $mysql_CIP_TEMP[$mysql_ENTRY_INDEX] != '' ) {

					/* ECHO TO PAGE */		
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;

					/* DUMP TO DATABASE */
					$mysql_mod_openopc_query = "INSERT INTO ".$SPFMODEL_mysql_mod_openopc_TABLENAME." VALUES('".$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX]."', '".$mysql_ENTRY_MACHINENAME."', '".$SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER]."', '".$mysql_SPF_STATE[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".$mysql_CIP_STEP[$mysql_ENTRY_INDEX]."', '".$mysql_CIP_TEMP[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', '".$apache_REPORT_COMMENT_MANUAL_ADD."')";
					core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);	

				} else {
					/* do not add */
				}
			} else {
				/* pass */
			}
			if ( $seer_MANUAL_ENTRY_GROUP == 'B' ) {
				$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD ALIGN='CENTER'>
											".$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_SPF_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_CIP_STEP_FRIENDLYNAME[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_CIP_TEMP[$mysql_ENTRY_INDEX]."
										</TD>
									</TR>
									";

				/* ADD THE ROW TO THE TICKET CONFIRMATION */

				if ( $mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX] != '' && $mysql_SPF_STATE[$mysql_ENTRY_INDEX] != '' && $mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX] != '' && $mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX] != '' && $mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX] != '' && $mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX] != '' && $mysql_CIP_STEP[$mysql_ENTRY_INDEX] != '' && $mysql_CIP_TEMP[$mysql_ENTRY_INDEX] != '' ) {

					/* ECHO TO PAGE */		
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;

					/* DUMP TO DATABASE */
					$mysql_mod_openopc_query = "INSERT INTO ".$SPFMODEL_mysql_mod_openopc_TABLENAME." VALUES('".$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX]."', '".$mysql_ENTRY_MACHINENAME."', '".$SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER]."', '".$mysql_SPF_STATE[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".$mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX]."', '".$mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX]."', '".$mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX]."', '".$mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX]."', NULL, '".$mysql_CIP_STEP[$mysql_ENTRY_INDEX]."', '".$mysql_CIP_TEMP[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', '".$apache_REPORT_COMMENT_MANUAL_ADD."')";
					core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);	

				} else {
					/* do not add */
				}
			} else {
				/* pass */
			}
			if ( $seer_MANUAL_ENTRY_GROUP == 'C' ) {
				$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD COLSPAN='2' ALIGN='CENTER'>
											".$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX]."
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											".$mysql_SPF_STATE_FRIENDLYNAME[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX]."
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX]."
										</TD>
									</TR>
									";

				/* ADD THE ROW TO THE TICKET CONFIRMATION */

				if ( $mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX] != '' && $mysql_SPF_STATE[$mysql_ENTRY_INDEX] != '' && $mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX] != '' && $mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX] != '' && $mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX] != '' && $mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX] != '' ) {

					/* ECHO TO PAGE */		
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;

					/* DUMP TO DATABASE */
					$mysql_mod_openopc_query = "INSERT INTO ".$SPFMODEL_mysql_mod_openopc_TABLENAME." VALUES('".$mysql_SPF_DATESTAMP[$mysql_ENTRY_INDEX]."', '".$mysql_ENTRY_MACHINENAME."', '".$SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER]."', '".$mysql_SPF_STATE[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".$mysql_PRESSURE_RAW[$mysql_ENTRY_INDEX]."', '".$mysql_PRESSURE_PASTEURIZE[$mysql_ENTRY_INDEX]."', '".$mysql_TEMPERATURE_INLET[$mysql_ENTRY_INDEX]."', '".$mysql_TEMPERATURE_PASTEURIZE[$mysql_ENTRY_INDEX]."', NULL, NULL, NULL, NULL, NULL, NULL, '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', '".$apache_REPORT_COMMENT_MANUAL_ADD."')";
					core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);	

				} else {
					/* do not add */
				}
			} else {
				/* pass */
			}

			/* INDEX THE TICKET CONFIRMATION */

			$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
		}

		/* FINISH THE TICKET CONFIRMATION */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TR>
										<TD COLSPAN='8'>
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
	core_user_date_time_range_input_type_3($multilang_SPFMODEL_77);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
		list($mysql_ENTRY_MACHINENAME_BY_INTEGER,$seer_MANUAL_ENTRY_GROUP,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES) = model_SPF_identify_machine_type_and_manual_record_entry($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED);

		/* LABEL COLUMN ROW */
		$apache_COLUMN_LABEL_ROW = model_SPF_label_columns_for_manual_report_entry($seer_MANUAL_ENTRY_GROUP);
	}

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* GENERATE AUTO FILL DATESTAMPS */
		$mysql_DATESTAMP = auto_fill_manual_record_entry_datestamp_fields($mysql_ENTRY_COUNT_REQUEST,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES,$mysql_ENTRY_START_YEAR,$mysql_ENTRY_START_MONTH,$mysql_ENTRY_START_DAY,$mysql_ENTRY_START_HOUR,$mysql_ENTRY_START_MINUTE);

		/* START THE TICKET */
		$apache_REPORT_RECORDENTRY = "
							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='113'>
										</TD>
										<TD WIDTH='132'>
										</TD>
										<TD WIDTH='93'>
										</TD>
										<TD WIDTH='112'>
										</TD>
										<TD WIDTH='113'>
										</TD>
										<TD WIDTH='92'>
										</TD>
										<TD WIDTH='133'>
										</TD>
										<TD WIDTH='112'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='8' ALIGN='CENTER'>
											".$multilang_SPFMODEL_64.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
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
			if ( $seer_MANUAL_ENTRY_GROUP == 'A' ) {
				$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<INPUT TYPE='text' size='20' maxlength='18' name='mysql_SPF_DATESTAMP".$mysql_ENTRY_INDEX."' value='".$mysql_DATESTAMP[$mysql_ENTRY_INDEX]."'>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<SELECT NAME='mysql_SPF_STATE".$mysql_ENTRY_INDEX."'><OPTION VALUE=''>".$multilang_SPFMODEL_69.$SPFMODEL_FORMFILL_STATE."</SELECT>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<SELECT NAME='mysql_CIP_STEP".$mysql_ENTRY_INDEX."'><OPTION VALUE=''>".$multilang_SPFMODEL_67.$SPFMODEL_FORMFILL_STEP."</SELECT>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_CIP_TEMP".$mysql_ENTRY_INDEX."' value=''>
										</TD>
									</TR>
									";
			} else {
				/* pass */
			}
			if ( $seer_MANUAL_ENTRY_GROUP == 'B' ) {
				$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='20' maxlength='18' name='mysql_SPF_DATESTAMP".$mysql_ENTRY_INDEX."' value='".$mysql_DATESTAMP[$mysql_ENTRY_INDEX]."'>
										</TD>
										<TD ALIGN='CENTER'>
											<SELECT NAME='mysql_SPF_STATE".$mysql_ENTRY_INDEX."'><OPTION VALUE=''>".$multilang_SPFMODEL_69.$SPFMODEL_FORMFILL_STATE."</SELECT>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_PRESSURE_RAW".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_PRESSURE_PASTEURIZE".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_TEMPERATURE_INLET".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_TEMPERATURE_PASTEURIZE".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<SELECT NAME='mysql_CIP_STEP".$mysql_ENTRY_INDEX."'><OPTION VALUE=''>".$multilang_SPFMODEL_67.$SPFMODEL_FORMFILL_STEP."</SELECT>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_CIP_TEMP".$mysql_ENTRY_INDEX."' value=''>
										</TD>
									</TR>
									";
			} else {
				/* pass */
			}
			if ( $seer_MANUAL_ENTRY_GROUP == 'C' ) {
				$apache_REPORT_RECORDENTRY_ROW_TEMP = $apache_REPORT_RECORDENTRY_ROW_TEMP."
									<TR>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<INPUT TYPE='text' size='20' maxlength='18' name='mysql_SPF_DATESTAMP".$mysql_ENTRY_INDEX."' value='".$mysql_DATESTAMP[$mysql_ENTRY_INDEX]."'>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<SELECT NAME='mysql_SPF_STATE".$mysql_ENTRY_INDEX."'><OPTION VALUE=''>".$multilang_SPFMODEL_69.$SPFMODEL_FORMFILL_STATE."</SELECT>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_PRESSURE_RAW".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_PRESSURE_PASTEURIZE".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_TEMPERATURE_INLET".$mysql_ENTRY_INDEX."' value=''>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='text' size='5' maxlength='6' name='mysql_TEMPERATURE_PASTEURIZE".$mysql_ENTRY_INDEX."' value=''>
										</TD>
									</TR>
									";
			} else {
				/* pass */
			}

			/* ADD THE ROW TO THE TICKET */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_ROW_TEMP;
	
			/* INDEX THE TICKET */
			$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;
		}

		/* FINISH THE TICKET */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='2'>
											<BR>
										</TD>
										<TD COLSPAN='2' ALIGN='RIGHT'>
											<B><I>".$multilang_CIPMODEL_20."</I></B><BR>
											...".$multilang_CIPMODEL_21."
										</TD>
										<TD COLSPAN='2'>
											<INPUT TYPE='hidden' name='seer_HMIACTION' value='SAVETICKET'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='".$mysql_ENTRY_MACHINENAME."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_COUNT_REQUEST' value='".$mysql_ENTRY_COUNT_REQUEST."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
										<TD COLSPAN='2'>
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
	$RECORD_TIME_INTERVAL_TO_POST = $SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES_PASTEURIZE." ".$multilang_SPFMODEL_62." - ".$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES_OTHER." ".$multilang_SPFMODEL_63;
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_3("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$RECORD_TIME_INTERVAL_TO_POST);
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