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
CANVAS
-- GENERIC 'NEW TAB' / 'NEW WINDOW' VIRTUAL POP-UP CONTAINER
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* ACCEPT ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( ($_POST[seer_CANVAS_SIZE] != '') && is_numeric($_POST[seer_CANVAS_SIZE]) ) {
	$seer_CANVAS_SIZE = varcharTOnumeric2($_POST['seer_CANVAS_SIZE']);
} else {
	$seer_CANVAS_SIZE = 900;
}
if ( $_POST[seer_CANVAS_TITLE] != '' ) {
	$seer_CANVAS_TITLE = $_POST['seer_CANVAS_TITLE'];
} else {
	$seer_CANVAS_TITLE = $multilang_CANVAS_3;
}
if ( $_POST[seer_CANVAS_CONTENT] != '' ) {
	$seer_CANVAS_CONTENT = $_POST['seer_CANVAS_CONTENT'];
} else {
	$seer_CANVAS_CONTENT = $multilang_CANVAS_1;
}

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_enable_CANVAS = "YES";

/* MANGLE CANVAS SIZE WITH RESPECT TO CONTAINER */
/* ------------------------------------------------------------------ */
if ($seer_CANVAS_SIZE >= 900) {
	if ($seer_CANVAS_SIZE > 4000) {
		$seer_CANVAS_SIZE = 4000;
		/* sanity check for canvas size */
	} else {
		/* pass */
	}
	$seer_CANVAS_CONTAINER = $seer_CANVAS_SIZE + 30;
} else {
	$seer_CANVAS_CONTAINER = 930;
}
$seer_CANVAS_CONTAINER_SHELL = $seer_CANVAS_CONTAINER + 20;

/* MANGLE CSS */
/* ------------------------------------------------------------------ */
$seer_CSS_INJECTION = $seer_CSS_INJECTION.
			"
			#CONTAINER_SHELL {
				width: ".$seer_CANVAS_CONTAINER_SHELL."px;
				}
			#CONTAINER {
				width: ".$seer_CANVAS_CONTAINER."px;
				}
			";

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_CANVAS_0."</B><BR>
							<BR>
							<I>".$multilang_CANVAS_2."</I><BR>
							<BR>
							".$multilang_STATIC_REPORT_TICKET_FOR.": <B><I>".$seer_CANVAS_TITLE."</I></B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT = "
						<DIV CLASS='USERREPORT'>
							".$seer_CANVAS_CONTENT."
						</DIV>
						";


/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
