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
TTYPERFORMANCE MODEL HMI 1 BODY (INCLUDED TO ALL TTYPERFORMANCEMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 300;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_TTYPERFORMANCEMODEL_0.": ".$multilang_TTYPERFORMANCEMODEL_3."</B><BR>
								<I>".$TTYPERFORMANCEMODEL_SUBPAGETITLE."</I><BR>
								<BR>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT_FRESHTIME = $multilang_STATIC_NONE;
$mysql_query_END_DATESTAMP = $apache_DEFAULTDATESTAMP;
$mysql_query_START_DATESTAMP = apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM_GENERATE($TTYPERFORMANCEMODEL_DEPT_MONITOR_SNAPSHOT_TIME_MINUTES);

/* CALL SUPPLEMENT AND DECLARE WHAT WE INTEND TO USE IT FOR */
/* ------------------------------------------------------------------ */
$apache_BODY_SUPPLEMENT_USE = "HMI_0";
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/core_models/TTYPERFORMANCEMODEL_seer_hmi_0_BODY_SUPPLEMENT.php');

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
$apache_REPORT_FRESHTIME = $mysql_query_START_DATESTAMP." -- ".$apache_REPORT_FRESHTIME;
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($apache_REPORT_FRESHTIME,"SNAPSHOT");
$apache_REPORT_RECORDENTRY = $apache_REPORT_TOPPLATE."
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
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								".$apache_REPORT_RECORDENTRY."
								";

/* -- CLOSE OUT TABLE */
$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
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
