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
SEER TRAFFIC COP OPTION NEGOTIATION
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CLOCK ME */
/* -------- */
if ( $ENABLE_CLOCK_ME_EXECUTION_TIME_STAMP == 'YES' ) {
	$ENABLE_CLOCK_ME_TRAFFIC_COP_ENCOUNTERED = "YES";
	$CLOCK_ME_START = date('Y_md_H:i:s');
} else {
	/* pass */
}

/* PULL IN TRAFFIC COP VARIABLES */
/* ------------------------------------------------------------------ */
if ( $_GET[seer_TRAFFIC_COP_OPTION] != '' ) {
	$seer_TRAFFIC_COP_OPTION = $_GET['seer_TRAFFIC_COP_OPTION'];
	$seer_append_TRAFFIC_COP_OPTION = "YES";
} else {
	$seer_TRAFFIC_COP_OPTION = 0;
	$seer_append_TRAFFIC_COP_OPTION = "NO";
}
if ( $_GET[seer_TRAFFIC_COP_OPTION_2] != '' ) {
	$seer_TRAFFIC_COP_OPTION_2 = $_GET['seer_TRAFFIC_COP_OPTION_2'];
	$seer_append_TRAFFIC_COP_OPTION = "YES";
} else {
	$seer_TRAFFIC_COP_OPTION = 0;
	$seer_append_TRAFFIC_COP_OPTION = "NO";
}
if ( $_GET[seer_TRAFFIC_COP_OPTION_3] != '' ) {
	$seer_TRAFFIC_COP_OPTION_3 = $_GET['seer_TRAFFIC_COP_OPTION_3'];
	$seer_append_TRAFFIC_COP_OPTION = "YES";
} else {
	$seer_TRAFFIC_COP_OPTION = 0;
	$seer_append_TRAFFIC_COP_OPTION = "NO";
}

/* HANDLE MODEL AND REPORT (or HMI) DECLARATION */
/* ------------------------------------------------------------------ */
$MODEL_IN_QUESTION = $seer_TRAFFIC_COP_OPTION_2;
$MODEL_REPORT_IN_QUESTION = $seer_TRAFFIC_COP_OPTION_3;

/* PULL IN MODEL OPTIONS */
/* ------------------------------------------------------------------ */
$MODEL_globaloption_to_pull = "./config/".$MODEL_IN_QUESTION."/globaloptions_".$MODEL_IN_QUESTION."_0.php";
$MODEL_localoption_to_pull = "./config/".$MODEL_IN_QUESTION."/localoptions_".$MODEL_IN_QUESTION."_".$seer_TRAFFIC_COP_OPTION.".php";

include($MODEL_globaloption_to_pull);
include($MODEL_localoption_to_pull);

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "DYNAMIC";
/*	-- auto refresh this page */
if ( $seer_append_TRAFFIC_COP_OPTION == 'YES' ) {
	$seer_REFERRINGPAGE = "./seer_traffic_cop_option_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION.";seer_TRAFFIC_COP_OPTION_2=".$seer_TRAFFIC_COP_OPTION_2.";seer_TRAFFIC_COP_OPTION_3=".$seer_TRAFFIC_COP_OPTION_3;
} else {
	$seer_REFERRINGPAGE = "./index.php".$seer_REFERRINGPAGE_ADDKEYINFO;
}
$seer_REFERRINGPAGE_THISHMI_0 = "./seer_traffic_cop_option_negotiation.php";
$seer_REFERRINGPAGE_APPEND = ";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION.";seer_TRAFFIC_COP_OPTION_2=".$seer_TRAFFIC_COP_OPTION_2.";seer_TRAFFIC_COP_OPTION_3=".$seer_TRAFFIC_COP_OPTION_3;
/*	-- send user back here after they execute actions */

/* MODEL report-or-hmi BODY */
/* ------------------------------------------------------------------ */
$MODEL_apache_report_to_run = "./include/core_models/".$MODEL_IN_QUESTION."_seer_".$MODEL_REPORT_IN_QUESTION."_BODY.php";
include($MODEL_apache_report_to_run);

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
