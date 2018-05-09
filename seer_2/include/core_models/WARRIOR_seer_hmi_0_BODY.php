<?php

/*
S.E.E.R. - incl. Warrior module.
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
WARRIOR HMI BODY 0 (INCLUDED TO ALL WARRIOR INSTANCES)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = $WARRIOR_hmi_NORMAL_BOUNCEBACK_TIME;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
$seer_BOUNCEBACKTIME_THISHMI_0_SLOW = $WARRIOR_hmi_SLOW_BOUNCEBACK_TIME;
/*	-- time between refreshing this page */

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
model_WARRIOR_hmi_0_determine_action_mode();

/* APPEND THE REFERRING PAGE WHEN GENERATED VIA */
/*    seer_REFERRINGPAGE_THISHMI_0 */
/* ------------------------------------------------------------------ */
$seer_NEWAPPENDAGE = ";seer_HMIACTION=".$seer_HMIACTION.";seer_MACHINE_TO_DISPLAY=".$seer_MACHINE_TO_DISPLAY;
referring_page_append_reqd_scada($seer_NEWAPPENDAGE);
/*	-- key manipulation required for pages utilizing scada */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<IMG SRC='./img/warrior_menu_0.png' BORDER='0' ALT='WARRIOR'><BR>
								<BR>
								<B>".$multilang_WARRIOR_20.": ".$multilang_WARRIOR_21."</B><BR>
								<I>".$WARRIOR_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
/* ------------------------------------------------------------------ */
if (($seer_USERACTIVE == "YES") && ($seer_WARRIOR_ENABLE_LABELING_PLUGIN == 'YES') && ($WARRIOR_ALLOW_LABELING_PLUGIN == 'YES')) {
	/* INITIALIZE THE PLUGIN */
	require($seer_WARRIOR_apache_ROOT_LABELING_PLUGIN.'/labeling_plugin_initialize.php');
} else {
	/* -- don't waste resources on random page hits */
	/* pass */
}

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
if ($seer_HMIACTION == 'DISPLAY_START_PAGE') {
	/* DISPLAY START PAGE */
	$apache_REPORT_RECORDENTRY = "

							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<P CLASS='INFOREPORT'>
												<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_WARRIOR_25."
											</P>
										</TD>
									</TR>
									<TR>
										<TD>
											<B><I>".$multilang_WARRIOR_24."</I></B>
										</TD>
										<TD COLSPAN='3'>
											<SELECT NAME='seer_MACHINE_TO_DISPLAY'><OPTION VALUE=''>".$multilang_WARRIOR_22.$WARRIOR_FORMFILL_NAME."</SELECT>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD ALIGN='RIGHT'>
											<B><I>".$multilang_WARRIOR_23."</I></B>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_HMIACTION' value='DISPLAY_MACHINE_PAGE'>
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
	/* pass */
}

/* ZERO OUT THE SCHEDULE UPDATE STATUS */
$WARRIOR_SCHEDULE_UPDATE_PUSHED = "NO";
if ($seer_HMIACTION == 'DISPLAY_MACHINE_PAGE') {
	/* PRETEST FOR THE OPERATOR CHAINED TO THE MACHINE (OWNERSHIP) */
	$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_WARRIOR = generateHMIMYSQLSEARCHDATESTAMP($apache_DEFAULTDATESTAMP_UNIXTIME, $seer_HMISQLSEARCHMINIMUMTIMEFRAME_WARRIOR);
	$mysql_mod_openopc_query = "OPERATOR";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_WARRIOR."%') AND (MACHINE_NAME LIKE '".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."') ) ORDER BY DATESTAMP DESC LIMIT 1";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);	
	if ($mysql_mod_openopc_query_result_count > 0) {
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$WARRIOR_PRETEST_OPERATOR_ID = $mysql_mod_openopc_query_row['OPERATOR'];
		}
	} else {
		$WARRIOR_PRETEST_OPERATOR_ID = 0;
	}

	/* DISPLAY MACHINE PAGE */
	$apache_PAGETITLE = $apache_PAGETITLE."
							<P CLASS='PAGETITLE'>
								".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."
							</P>
							";

	/* EXECUTE SCHEDULE UPDATE IF PUSHED */
	if ( $_POST[seer_HMIACTION_2] != '' ) {
		$seer_HMIACTION_2 = $_POST['seer_HMIACTION_2'];
		if ( $seer_HMIACTION_2 = "UPDATE_ACTIVE_SCHEDULE" ) {
			if ($mysql_seer_access_UID == $WARRIOR_PRETEST_OPERATOR_ID) {
				if ( $_POST[seer_UPDATED_SCHEDULE] != '' ) {
					$seer_UPDATED_SCHEDULE = $_POST['seer_UPDATED_SCHEDULE'];
					$seer_UPDATED_SCHEDULE = sanitizeRANDOMcontent($seer_UPDATED_SCHEDULE);
					$seer_UPDATED_SCHEDULE = strtoupper($seer_UPDATED_SCHEDULE);
					if ( (isset($seer_UPDATED_SCHEDULE)) && ($seer_UPDATED_SCHEDULE != "") ) {
						/* pass */
					} else {
						$seer_UPDATED_SCHEDULE = "0";
					}
					/* CHECK FOR EXISTING SCHEDULE FOR THIS MACHINE */
					$mysql_mod_openopc_query = "*";
					$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." WHERE MACHINE LIKE '".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."'";
					list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
					if ( $mysql_mod_openopc_query_result_count == 0 ) {
						/* MAKE A NEW ENTRY */
						$mysql_mod_openopc_query = "INSERT INTO ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." (MACHINE, SCHEDULE_NUMBER) VALUES('".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."', '".$seer_UPDATED_SCHEDULE."')";
						$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
						core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
					} else {
						/* CHECK IF ENTRY IS THE SAME OR DIFFERENT */
						while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
							$WARRIOR_RESULT_TEST_SCHEDULE_NUMBER_FRIENDLYNAME = $mysql_mod_openopc_query_row['SCHEDULE_NUMBER'];
						}
						if ($WARRIOR_RESULT_TEST_SCHEDULE_NUMBER_FRIENDLYNAME == $seer_UPDATED_SCHEDULE) {
							/* DO NOTHING - SOMEBODY TRIED TO UPDATE EXISTING SCHEDULE WITH THE SAME NUMBER */
							/* -- WHICH IS PRETTY BONEHEADED... SO LET'S IGNORE THE REQUEST */
							$WARRIOR_SCHEDULE_UPDATE_PUSHED = "SAME";
						} else {
							/* SAVE OLD SCHEDULE FOR POSSIBLE USE BY ANY 3RD PARTY PLUGIN */
							$WARRIOR_RESULT_TEST_SCHEDULE_NUMBER_FRIENDLYNAME_OLD = $WARRIOR_RESULT_TEST_SCHEDULE_NUMBER_FRIENDLYNAME;

							/* PUSH THE UPDATE, BECAUSE THE NEW SCHEDULE NUMBER IS DIFFERENT THAN THE OLD ONE */
							$apache_PUSHOUT_STATUS = mod_openopc_fudge_write_daemon_event_file ($mod_openopc_GWCOMMDIR,$mod_openopc_TEMPDIR,$_POST[mod_openopc_WRITEDAEMON],$_POST[mod_openopc_JOINMYWRITE],$_POST[mod_openopc_YOURPLC],$_POST[mod_openopc_YOURLEAFERS]);
							if ($apache_PUSHOUT_STATUS == 'YES') {
								/* -- UPDATE EXISTING ENTRY IN THE WARRIOR_SCHEDULE TABLE */
								$mysql_mod_openopc_query = "UPDATE ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." SET SCHEDULE_NUMBER='".$seer_UPDATED_SCHEDULE."' WHERE MACHINE='".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."'";
								core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
							} else {
								/* pass */
							}
							$WARRIOR_SCHEDULE_UPDATE_PUSHED = "YES";
						}
					}
				} else {
					/* pass */
				}
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}

	/* PULL IN DATA FROM DATABASE */
	$mysql_mod_openopc_query = "*";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." WHERE MACHINE LIKE '".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."'";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	if ($mysql_mod_openopc_query_result_count < 1 ) {
		$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER_FRIENDLYNAME = $multilang_STATIC_NONE;
	} else {
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER_FRIENDLYNAME = $mysql_mod_openopc_query_row['SCHEDULE_NUMBER'];
		}
	}

	$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_WARRIOR = generateHMIMYSQLSEARCHDATESTAMP($apache_DEFAULTDATESTAMP_UNIXTIME, $seer_HMISQLSEARCHMINIMUMTIMEFRAME_WARRIOR);
	$mysql_mod_openopc_query = "*";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_WARRIOR."%') AND (MACHINE_NAME LIKE '".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."') ) ORDER BY DATESTAMP DESC";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

	/* ACCOUNT FOR NON EXISTENT DATA */
	$apache_REPORT_RECORDENTRY = "";
	if ($mysql_mod_openopc_query_result_count < 2 ) {
		/* DONT BUILD THE STATUS DISPLAY */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORTCENTER'>
										<B><U>".$multilang_WARRIOR_38.":</U></B><BR>
										<BR>
										".$multilang_WARRIOR_39."
										</P>
									</TD>
								</TR>
							</TABLE>
							";
	} else {
		/* BUILD THE STATUS DISPLAY */
		$apache_REPORT_ROW_BGCOLOR = "";
		$apache_REPORT_ROW_BGCOLOR_ALT = "BGCOLOR='#DDDDDD'";
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORTCENTER'>
										<B><U>".$multilang_WARRIOR_38.":</U></B>
										</P>
									</TD>
								</TR>
							</TABLE>
							";

		/* PREP */
		model_WARRIOR_hmi_report_body_prep();

		while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($WARRIOR_EXAMINE_RECENT_HISTORY == 1) ) {

			if ($WARRIOR_RESULT_FIRSTRUN == 1) {

				/* SPECIAL BEHAVIOR IF FIRST RUN */
				model_WARRIOR_hmi_report_body_first_run();

				/* POST */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_STATIC_CURRENT_TIME."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										".$apache_DEFAULTDATESTAMP."
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_40."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_RESULT_CURRENT_DATESTAMP."
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='550' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_44."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_CURRENT_STATE.">
										<!--LANDMARK_DISPLAY_CURRENT_STATE_START-->
										".$WARRIOR_RESULT_CURRENT_STATE_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_STATE_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_45."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_CURRENT_ALARM.">
										<!--LANDMARK_DISPLAY_CURRENT_ALARM_START-->
										".$WARRIOR_RESULT_CURRENT_ALARM_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_ALARM_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_46."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_CURRENT_CORRECTIVE_ACTION.">
										<!--LANDMARK_DISPLAY_CURRENT_CORRECTIVE_ACTION_START-->
										".$WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_CORRECTIVE_ACTION_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='550' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_41."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<!--LANDMARK_DISPLAY_CURRENT_OPERATOR_START-->
										".$WARRIOR_RESULT_CURRENT_OPERATOR_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_OPERATOR_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_42."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<!--LANDMARK_DISPLAY_CURRENT_SCHEDULE_NUMBER_START-->
										".$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_SCHEDULE_NUMBER_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_43."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<!--LANDMARK_DISPLAY_CURRENT_JOB_NUMBER_START-->
										".$WARRIOR_RESULT_CURRENT_JOB_NUMBER_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_JOB_NUMBER_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='550' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_47."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<!--LANDMARK_DISPLAY_CURRENT_PACKAGE_CLASS_START-->
										".$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS_FRIENDLYNAME."
										<!--LANDMARK_DISPLAY_CURRENT_PACKAGE_CLASS_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_49."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<!--LANDMARK_DISPLAY_CURRENT_CYCLES_START-->
										".$WARRIOR_RESULT_CURRENT_CYCLES_END."
										<!--LANDMARK_DISPLAY_CURRENT_CYCLES_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_50." @ ".$multilang_WARRIOR_51."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<!--LANDMARK_DISPLAY_CURRENT_PACKAGE_UNIT_START-->
										".$WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_END." [".$WARRIOR_UM_PACKAGE_UNIT."] @ ".$WARRIOR_RESULT_CURRENT_MASS_END." [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]
										<!--LANDMARK_DISPLAY_CURRENT_PACKAGE_UNIT_END-->
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='550' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";

			} else {
				/* STANDARD BEHAVIOR FOR SUBSEQUENT RUNS */
				model_WARRIOR_hmi_report_body_subsequent_run();
			}
		}

		/* PICK UP THE STRAGGLERS */
		model_WARRIOR_straggler_downtime_active_cleanup();

		/* TOTALIZE */
		$WARRIOR_BAR_GRAPH_HEIGHT = "200";
		model_WARRIOR_hmi_report_body_summation($WARRIOR_BAR_GRAPH_HEIGHT);	

		/* POST */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='50'>
									</TD>
								</TR>
								<TR>	
									<TD COLSPAN='4' ALIGN='CENTER'>
										<P CLASS='INFOREPORTCENTER'>
										<B><U>".$multilang_WARRIOR_52.":</U></B><BR>
										[ ".$WARRIOR_RECENT_WINDOW_SIZE_IN_HOURS." ".$multilang_WARRIOR_59." ]
										</P>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_54."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_TOTAL_DURATION_READABLE." ( ".$WARRIOR_TOTAL_DURATION_MINUTES." [".$multilang_WARRIOR_53."] )
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_55."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										".$WARRIOR_TOTAL_RUN_MINUTES." [".$multilang_WARRIOR_53."]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_58."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_TOTAL_DOWNTIME_MINUTES." [".$multilang_WARRIOR_53."]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_57."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										".$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_MINUTES." [".$multilang_WARRIOR_53."]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='550' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_61."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_AVAILABILITY_OEE." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_60."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										".$WARRIOR_PERFORMANCE_OEE." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										".$WARRIOR_PERFORMANCE_RATE_UNITS." [".$WARRIOR_UM_PACKAGE_UNIT." / ".$multilang_WARRIOR_59."] @ ".$WARRIOR_PERFORMANCE_RATE_MASS." [".$WARRIOR_UM_PACKAGE_UNIT_MASS." / ".$multilang_WARRIOR_59."]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_62."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_OEE." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_AVAILABILITY_RATE_UNITS." [".$WARRIOR_UM_PACKAGE_UNIT." / ".$multilang_WARRIOR_59."] @ ".$WARRIOR_AVAILABILITY_RATE_MASS." [".$WARRIOR_UM_PACKAGE_UNIT_MASS." / ".$multilang_WARRIOR_59."]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										<B><I>".$multilang_WARRIOR_64."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR.">
										".$WARRIOR_LOADING_TEEP." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										<B><I>".$multilang_WARRIOR_63."</I></B>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_ALT.">
										".$WARRIOR_TEEP." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='550' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
							</TABLE>
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100' ALIGN='RIGHT' VALIGN='TOP'>
										<I><B>".$WARRIOR_TOTAL_DURATION_MINUTES."</B></I><BR>
										".$multilang_WARRIOR_53."
									</TD>
									<TD WIDTH='13' ALIGN='RIGHT' VALIGN='BOTTOM'>
										<IMG SRC='./img/clearspace_20px.png' WIDTH='2' HEIGHT='".$WARRIOR_BAR_GRAPH_HEIGHT."' ALT='bar_graph'>
									</TD>
									<TD WIDTH='420' ALIGN='CENTER'>
										<TABLE CLASS='STANDARD_2 'WIDTH='420' ALIGN='CENTER' BGCOLOR='#DDDDDD' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='6' ALIGN='CENTER' VALIGN='BOTTOM'>
													<IMG SRC='./img/horizontal_bar_black.png' WIDTH='4' HEIGHT='".$WARRIOR_BAR_GRAPH_HEIGHT."' ALT='bar_graph'>
												</TD>
												<TD WIDTH='136' ALIGN='CENTER' VALIGN='BOTTOM'>
													<IMG SRC='./img/horizontal_bar_green.png' WIDTH='132' HEIGHT='".$WARRIOR_BAR_GRAPH_RUN_MINUTES."' ALT='bar_graph'>
												</TD>
												<TD WIDTH='136' ALIGN='CENTER' VALIGN='BOTTOM'>
													<IMG SRC='./img/horizontal_bar_red.png' WIDTH='132' HEIGHT='".$WARRIOR_BAR_GRAPH_DOWNTIME_MINUTES."' ALT='bar_graph'>
												</TD>
												<TD WIDTH='136' ALIGN='CENTER' VALIGN='BOTTOM'>
													<IMG SRC='./img/horizontal_bar_black.png' WIDTH='132' HEIGHT='".$WARRIOR_BAR_GRAPH_SCHEDULED_DOWNTIME_MINUTES."' ALT='bar_graph'>
												</TD>
												<TD WIDTH='6' ALIGN='CENTER' VALIGN='BOTTOM'>
													<IMG SRC='./img/horizontal_bar_black.png' WIDTH='4' HEIGHT='".$WARRIOR_BAR_GRAPH_HEIGHT."' ALT='bar_graph'>
												</TD>
											</TR>
										</TABLE>
									</TD>
									<TD WIDTH='13' ALIGN='LEFT' VALIGN='BOTTOM'>
										<IMG SRC='./img/clearspace_20px.png' WIDTH='2' HEIGHT='".$WARRIOR_BAR_GRAPH_HEIGHT."' ALT='bar_graph'>
									</TD>
									<TD WIDTH='54'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
										<BR>
									</TD>
									<TD WIDTH='13'>
										<BR>
									</TD>
									<TD WIDTH='6'>
										<BR>
									</TD>
									<TD WIDTH='136' ALIGN='CENTER' VALIGN='TOP'>
										<B><I>".$multilang_WARRIOR_65."</I></B>
									</TD>
									<TD WIDTH='136' ALIGN='CENTER' VALIGN='TOP'>
										<B><I>".$multilang_WARRIOR_66."</I></B>
									</TD>
									<TD WIDTH='136' ALIGN='CENTER' VALIGN='TOP'>
										<B><I>".$multilang_WARRIOR_67."</I></B>
									</TD>
									<TD WIDTH='6'>
										<BR>
									</TD>
									<TD WIDTH='13'>
										<BR>
									</TD>
									<TD WIDTH='54'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";
	}

	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='600'>
									</TD>
								</TR>
								<TR>
									<TD>
										<P CLASS='INFOREPORTCENTER'>
											<B><U>".$multilang_WARRIOR_26.":</U></B>
										</P>
									</TD>
								</TR>
							</TABLE>
							";
	/* OWNED MODE */
	/* -- restrict all SCHEDULE, JOB, and CORRECTIVE ACTION unless operator has ownership of line */
	if ($mysql_seer_access_UID == $WARRIOR_RESULT_CURRENT_OPERATOR) {
		/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
		/* ------------------------------------------ */
		if ($seer_WARRIOR_AUTO_POLL_JOBS == 'YES') {
			/* PULL NEW VALUES */
			list($WARRIOR_JOB_COUNT,$WARRIOR_JOB,$WARRIOR_FORMFILL_JOB_PLCSAFE_NUMBER) = model_WARRIOR_poll_job();
		} else {
			/* USE THE STORED VALUES */
			/* pass */
		}
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<!--LANDMARK_UI_SCHEDULE_START-->
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_APPEND."' METHOD='post'>
								<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='MIDDLE' ALIGN='RIGHT'>
											<B><I>".$multilang_WARRIOR_36."</I></B>
										</TD>
										<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='RIGHT'>
											<INPUT TYPE='text' size='35' maxlength='20' name='seer_UPDATED_SCHEDULE' value='".$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER_FRIENDLYNAME."'>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$WARRIOR_CYCLE_RESET_VALUE."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$WARRIOR_PLC_LEAF_CYCLE_RESET[$seer_MACHINE_TO_DISPLAY]."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$WARRIOR_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='hidden' name='seer_HMIACTION_2' value='UPDATE_ACTIVE_SCHEDULE'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							<!--LANDMARK_UI_SCHEDULE_END-->

							<!--LANDMARK_UI_JOB_START-->
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='MIDDLE' ALIGN='RIGHT'>
											<B><I>".$multilang_WARRIOR_4."</I></B>
										</TD>
										<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='RIGHT'>
											<SELECT CLASS='SMALL' NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_WARRIOR_27.$WARRIOR_FORMFILL_JOB_PLCSAFE_NUMBER."</SELECT>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$WARRIOR_PLC_LEAF_JOB[$seer_MACHINE_TO_DISPLAY]."'>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0_SLOW."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$WARRIOR_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							<!--LANDMARK_UI_JOB_END-->

							<!--LANDMARK_UI_CI_START-->
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									";

		if ( ($WARRIOR_RESULT_CURRENT_STATE_MAINTAIN_FOR_CHECK < 3) || ($WARRIOR_RESULT_CURRENT_JOB_NUMBER_MAINTAIN_FOR_CHECK == 0) ) {
			/* only post corrective action form fill if there's a reason for the operator to have to enter one */
			/* otherwise it should be invisible */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TR>
										<TD VALIGN='MIDDLE' ALIGN='RIGHT'>
											<B><I>".$multilang_WARRIOR_28."</I></B>
										</TD>
										<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='RIGHT'>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_WARRIOR_27.$WARRIOR_FORMFILL_ACTION."</SELECT>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$WARRIOR_PLC_LEAF_ACTION[$seer_MACHINE_TO_DISPLAY]."'>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0_SLOW."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$WARRIOR_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
									";
		} else {
			/* pass */
		}
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								</TABLE>
							</FORM>
							<!--LANDMARK_UI_CI_END-->
							";
		/* MAINTENANCE MODE */
		/* -- restricted to SKILLED TRADES and MANAGER(or higher) access levels */
		if (($mysql_seer_access_ACCESSLEVEL == 6) || ($mysql_seer_access_ACCESSLEVEL <= 3)) {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<!--LANDMARK_UI_MM_START-->
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='MIDDLE' ALIGN='RIGHT'>
											<B><I>".$multilang_WARRIOR_33."</I></B>
										</TD>
										<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='RIGHT'>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_WARRIOR_27."<OPTION VALUE='1'>".$multilang_WARRIOR_34."<OPTION VALUE='0'>".$multilang_WARRIOR_35."</SELECT>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$WARRIOR_PLC_LEAF_MAINTENANCE_MODE[$seer_MACHINE_TO_DISPLAY]."'>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$WARRIOR_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							<!--LANDMARK_UI_MM_END-->
							";
		} else {
			/* pass */
		}
	} else {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR>
									<TD>
										<P CLASS='INFOREPORTCENTER'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B>
										</P>
									</TD>
									<TD COLSPAN='3'>
										<I>".$multilang_WARRIOR_37."</I>
									</TD>
								</TR>
							</TABLE>
								";
	}

	/* HMI TOPPLATE AND ASSEMBLY */
	/* ------------------------- */
	/* -- TOPPLATE IS EXCLUDED HERE */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<!--LANDMARK_UI_ASSUME_START-->
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD_2' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='MIDDLE' ALIGN='RIGHT'>
											<B><I>".$multilang_WARRIOR_30."</I></B>
										</TD>
										<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='RIGHT'>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_WARRIOR_27."<OPTION VALUE='0'>".$multilang_WARRIOR_31."<OPTION VALUE='".$mysql_seer_access_UID."'>".$multilang_WARRIOR_32."</SELECT>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$WARRIOR_PLC_LEAF_OPERATOR[$seer_MACHINE_TO_DISPLAY]."'>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0_SLOW."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$WARRIOR_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							<!--LANDMARK_UI_ASSUME_END-->
							";
		
	/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
	/* ------------------------------------------ */
	if ( ($mysql_seer_access_UID == $WARRIOR_RESULT_CURRENT_OPERATOR)  && ($seer_WARRIOR_ENABLE_LABELING_PLUGIN == 'YES') && ($WARRIOR_ALLOW_LABELING_PLUGIN == 'YES')) {
		/* PULL IN MARKUP FOR WARRIOR_seer_hmi_0_MARKUP (additional) */
		require($seer_WARRIOR_apache_ROOT_LABELING_PLUGIN.'/labeling_plugin_WARRIOR_seer_hmi_0_MARKUP.php');
	} else {
		/* -- don't waste resources on random page hits */
		/* pass */
	}
} else {
	/* pass */
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

/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY; 
$apache_REPORTL6 = "";
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
/* ------------------------------------------------------------------ */
if (($seer_USERACTIVE == "YES") && ($seer_WARRIOR_ENABLE_LABELING_PLUGIN == 'YES') && ($WARRIOR_ALLOW_LABELING_PLUGIN == 'YES')) {
	/* DEINITIALIZE THE PLUGIN */
	require($seer_WARRIOR_apache_ROOT_LABELING_PLUGIN.'/labeling_plugin_deinitialize.php');
} else {
	/* -- don't waste resources on random page hits */
	/* pass */
}

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
