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
TRAFFIC COP
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */

$seer_TRAFFIC_COP_FAULT = "NO";

if ( $_POST[seer_TRAFFIC_COP_TARGET] != '' ) {
	$seer_TRAFFIC_COP_TARGET = $_POST['seer_TRAFFIC_COP_TARGET'];
} else {
	$seer_TRAFFIC_COP_FAULT = "YES";
}
if ( $_POST[seer_TRAFFIC_COP_OPTION] != '' ) {
	$seer_TRAFFIC_COP_OPTION = $_POST['seer_TRAFFIC_COP_OPTION'];
} else {
	$seer_TRAFFIC_COP_FAULT = "YES";
}
if ( $_POST[seer_TRAFFIC_COP_OPTION_2] != '' ) {
	$seer_TRAFFIC_COP_OPTION_2 = $_POST['seer_TRAFFIC_COP_OPTION_2'];
} else {
	// $seer_TRAFFIC_COP_FAULT = "YES";
}
if ( $_POST[seer_TRAFFIC_COP_OPTION_3] != '' ) {
	$seer_TRAFFIC_COP_OPTION_3 = $_POST['seer_TRAFFIC_COP_OPTION_3'];
} else {
	// $seer_TRAFFIC_COP_FAULT = "YES";
}

/* HANDLE FAULTS */
/* ------------------------------------------------------------------ */

if ( $seer_TRAFFIC_COP_FAULT == 'YES' ) {
	$seer_TRAFFIC_COP_DESTINATION = "./index.php".$seer_REFERRINGPAGE_ADDKEYINFO;
	$seer_TRAFFIC_COP_ACTIVE = "YES";
} else {
	/* pass */
}

/* DIRECT TRAFFIC */
/* ----------------------------------------------------------------- */

if ( $seer_TRAFFIC_COP_FAULT == 'NO' ) {
	$seer_TRAFFIC_COP_DESTINATION = $seer_TRAFFIC_COP_TARGET.$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION.";seer_TRAFFIC_COP_OPTION_2=".$seer_TRAFFIC_COP_OPTION_2.";seer_TRAFFIC_COP_OPTION_3=".$seer_TRAFFIC_COP_OPTION_3;
	$seer_TRAFFIC_COP_ACTIVE = "YES";
} else {
	/* pass */
}


/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_36."</B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT = "
						<TABLE ALIGN='CENTER' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD ALIGN='CENTER' WIDTH='250'>
									<IMG SRC=".$seer_DEFAULTTRAFFICCOPLOGO." ALT='TXCOP'>
								</TD>
								<TD WIDTH='250'>
									<P CLASS='INFOREPORT'>
										".$multilang_STATIC_37."
									</P>
								</TD>
							</TR>
						</TABLE>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
