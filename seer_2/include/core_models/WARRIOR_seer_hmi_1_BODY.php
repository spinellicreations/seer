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
WARRIOR HMI BODY 1 (INCLUDED TO ALL WARRIOR INSTANCES)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 60;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */

/* APPEND THE REFERRING PAGE WHEN GENERATED VIA */
/*    seer_REFERRINGPAGE_THISHMI_0 */
/* ------------------------------------------------------------------ */
$seer_REFERRINGPAGE_APPEND = "";
/*	-- what would you like to append to the REFERRINGPAGE after keys have been generated */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<IMG SRC='./img/warrior_menu_0.png' BORDER='0' ALT='WARRIOR'><BR>
								<BR>
								<B>".$multilang_WARRIOR_20.": ".$multilang_WARRIOR_68."</B><BR>
								<I>".$WARRIOR_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */

/* -- NOTE -- some of the tab-indents are 'off' our out of place because much
              of this report was recycled from WARRIOR_HMI_0_BODY, which is all
              fine and well, but you should be aware of that. */


/* CYCLE THROUGH ALL INSTANCES IN LOCALOPTIONS FILE FOR THIS DEPARTMENT */
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FRESHTIME = 0;
$apache_SWITCH_ROW_COLOR = 0;
$mysql_WARRIOR_master_index = 0;
while ($mysql_WARRIOR_master_index <= $WARRIOR_COUNT_ADJUSTED) {

	/* WHAT MACHINE ARE WE EXAMINING */
	$seer_MACHINE_TO_DISPLAY = $mysql_WARRIOR_master_index;
	$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME = $WARRIOR_NAME[$seer_MACHINE_TO_DISPLAY];

	/* PULL IN DATA FROM DATABASE */
	$mysql_mod_openopc_query = "*";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." WHERE MACHINE LIKE '".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."'";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	if ($mysql_mod_openopc_query_result_count < 1 ) {
		$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER = $multilang_STATIC_NONE;
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
	$mysql_mod_openopc_query_result_count = mysql_num_rows($mysql_mod_openopc_query_result);

	if ($mysql_mod_openopc_query_result_count < 2) {
		/* DONT BUILD THE STATUS DISPLAY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								";
		if ($seer_MACHINE_TO_DISPLAY != 0) {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='8'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								";
		} else {
			/* pass */
		}
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."</U></B><BR>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='5' BGCOLOR='#000000'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='8'>
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
		/* PREP */
		model_WARRIOR_hmi_report_body_prep();

		while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($WARRIOR_EXAMINE_RECENT_HISTORY == 1) ) {

			if ($WARRIOR_RESULT_FIRSTRUN == 1) {

				/* SPECIAL BEHAVIOR IF FIRST RUN */
				model_WARRIOR_hmi_report_body_first_run();

				/* -- FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* -- POST */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='8'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$seer_MACHINE_TO_DISPLAY_FRIENDLYNAME."</U></B><BR>
										".$multilang_WARRIOR_36.": <I>".$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER_FRIENDLYNAME."</I>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='5' ".$apache_REPORT_ROW_BGCOLOR_CURRENT_STATE.">
										".$multilang_WARRIOR_44.": <BR>
										<B>".$WARRIOR_RESULT_CURRENT_STATE_FRIENDLYNAME."</B><BR>
										<B><I>".$WARRIOR_RESULT_CURRENT_ALARM_FRIENDLYNAME."</I></B> - [ ".$WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION_FRIENDLYNAME." ]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3' ALIGN='LEFT'  VALIGN='MIDDLE'>
										".$WARRIOR_RESULT_CURRENT_DATESTAMP."
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_WARRIOR_47.":<BR>
										<B><I>".$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS_FRIENDLYNAME."</I></B>
									</TD>
									<TD COLSPAN='3' VALIGN='MIDDLE'>
										".$multilang_WARRIOR_6.":<BR>
										<B><I>".$WARRIOR_RESULT_CURRENT_JOB_NUMBER_FRIENDLYNAME."</I></B> 
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										<BR>
										".$multilang_WARRIOR_41.": <BR>
										<B><I>".$WARRIOR_RESULT_CURRENT_OPERATOR_FRIENDLYNAME."</I></B>
									</TD>
									<TD COLSPAN='3' VALIGN='MIDDLE' ALIGN='LEFT'>
										<BR>
										".$multilang_WARRIOR_72.": <BR>
										<B><I>".$WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_END." [".$WARRIOR_UM_PACKAGE_UNIT."] @ ".$WARRIOR_RESULT_CURRENT_MASS_END." [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]</I></B>
									</TD>
								</TR>
								";

			} else {

				/* STANDARD BEHAVIOR FOR SUBSEQUENT RUNS */
				model_WARRIOR_hmi_report_body_subsequent_run();

			}
		}

		/* PICK UP THE STRAGGLERS */
		model_WARRIOR_straggler_downtime_active_cleanup();

		/* TOTALIZE */
		model_WARRIOR_hmi_report_body_summation("500");

		/* POST */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD VALIGN='MIDDLE'>
										<BR>
										".$multilang_WARRIOR_61.": <BR>
										<B><I>".$WARRIOR_AVAILABILITY_OEE."</I></B> [%]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='LEFT'>
										<BR>
										".$multilang_WARRIOR_60.": <BR>
										<B><I>".$WARRIOR_PERFORMANCE_OEE."</I></B> [%]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='LEFT'>
										<BR>
										".$multilang_WARRIOR_64.": <BR>
										<B><I>".$WARRIOR_LOADING_TEEP."</I></B> [%]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='LEFT'>
										<BR>
										".$multilang_WARRIOR_62.": <BR>
										<B><I>".$WARRIOR_OEE."</I></B> [%]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='LEFT'>
										<BR>
										".$multilang_WARRIOR_63.": <BR>
										<B><I>".$WARRIOR_TEEP."</I></B> [%]
									</TD>
								</TR>	
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='8'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										".$multilang_WARRIOR_55." [".$multilang_WARRIOR_53."]: <B>".$WARRIOR_TOTAL_RUN_MINUTES."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										0 ".$multilang_WARRIOR_53."
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_green.png' WIDTH=".$WARRIOR_BAR_GRAPH_RUN_MINUTES." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$WARRIOR_TOTAL_DURATION_MINUTES." ".$multilang_WARRIOR_53."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										".$multilang_WARRIOR_58." [".$multilang_WARRIOR_53."]: <B>".$WARRIOR_TOTAL_DOWNTIME_MINUTES."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										0 ".$multilang_WARRIOR_53."
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_red.png' WIDTH=".$WARRIOR_BAR_GRAPH_DOWNTIME_MINUTES." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$WARRIOR_TOTAL_DURATION_MINUTES." ".$multilang_WARRIOR_53."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										".$multilang_WARRIOR_57." [".$multilang_WARRIOR_53."]: <B>".$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_MINUTES."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										0 ".$multilang_WARRIOR_53."
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH=".$WARRIOR_BAR_GRAPH_SCHEDULED_DOWNTIME_MINUTES." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$WARRIOR_TOTAL_DURATION_MINUTES." ".$multilang_WARRIOR_53."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='8'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										<U>".$multilang_WARRIOR_71.":</U>
									</TD>
									<TD ALIGN='RIGHT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE' COLSPAN='4'>
										".$WARRIOR_IDEAL_HOUR_UNIT." [".$WARRIOR_UM_PACKAGE_UNIT." / ".$multilang_WARRIOR_59."] @ ".$WARRIOR_IDEAL_HOUR_MASS." [".$WARRIOR_UM_PACKAGE_UNIT_MASS." / ".$multilang_WARRIOR_59."]
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										<U>".$multilang_WARRIOR_70.":</U>
									</TD>
									<TD ALIGN='RIGHT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE' COLSPAN='4'>
										".$WARRIOR_AVAILABILITY_RATE_UNITS." [".$WARRIOR_UM_PACKAGE_UNIT." / ".$multilang_WARRIOR_59."] @ ".$WARRIOR_AVAILABILITY_RATE_MASS." [".$WARRIOR_UM_PACKAGE_UNIT_MASS." / ".$multilang_WARRIOR_59."]
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='8'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";
	}

	/* INDEX TO NEXT MACHINE IN LOCALOPTIONS */
	$mysql_WARRIOR_master_index = $mysql_WARRIOR_master_index + 1;
}

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
if ($apache_REPORT_FRESHTIME == 0) {
	$apache_REPORT_FRESHTIME = $multilang_STATIC_NO_DATA_AVAILABLE;
} else {
	/* pass */
}
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($apache_REPORT_FRESHTIME,"WINDOW",$multilang_ATMOSPHERICMODEL_16,$seer_HMISQLSEARCHMINIMUMTIMEFRAME_WARRIOR);
$apache_REPORT_RECORDENTRY = $apache_REPORT_TOPPLATE.$apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD WIDTH='900'>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='8'>
										<BR>
											<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'>
										<BR>
									</TD>
								</TR>				
							</TABLE>
							";

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

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
