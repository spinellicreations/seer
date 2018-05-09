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
REPORTING MENU
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_STATIC_53."</B>
							</P>
							";

/* CORE MODEL IMPORT */
/* ------------------------------------------------------------------ */

$apache_LINK_MODEL_WRAPPER_START = "
								<TABLE CLASS='STANDARD' ALIGN='LEFT' CELLPADDING=0 CELLSPACING=0>
								";

$apache_LINK_MODEL_WRAPPER_END = "
								</TABLE>
								";

/* -- MENU DECLARATIONS */

/*	-- TANK MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_TANKMODEL == "YES" ) {
	$apache_LINK_TANKMODEL = report_menu_markup("TANKMODEL");
} else {
	$apache_LINK_TANKMODEL = "";
}

/*	-- SPF MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_SPFMODEL == "YES" ) {
	$apache_LINK_SPFMODEL = report_menu_markup("SPFMODEL");
} else {
	$apache_LINK_BULKMODEL = "";
}

/*	-- WARRIOR -- */
/*	----------------------- */
if ( $seer_ENABLE_WARRIOR == "YES" ) {
	$apache_LINK_WARRIOR = report_menu_markup("WARRIOR");
} else {
	$apache_LINK_WARRIOR = "";
}

/*	-- CHECKWEIGHER MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_CHECKWEIGHERMODEL == "YES" ) {
	$apache_LINK_CHECKWEIGHERMODEL = report_menu_markup("CHECKWEIGHERMODEL");
} else {
	$apache_LINK_CHECKWEIGHERMODEL = "";
}

/*	-- TTYPERFORMANCE MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_TTYPERFORMANCEMODEL == "YES" ) {
	$apache_LINK_TTYPERFORMANCEMODEL = report_menu_markup("TTYPERFORMANCEMODEL");
} else {
	$apache_LINK_TTYPERFORMANCEMODEL = "";
}

/*	-- CIP MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_CIPMODEL == "YES" ) {
	$apache_LINK_CIPMODEL = report_menu_markup("CIPMODEL");
} else {
	$apache_LINK_CIPMODEL = "";
}

/*	-- BULK MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_BULKMODEL == "YES" ) {
	$apache_LINK_BULKMODEL = report_menu_markup("BULKMODEL");
} else {
	$apache_LINK_BULKMODEL = "";
}

/*	-- TOUCHPANEL -- */
/*	----------------------- */
if ( $seer_ENABLE_TOUCHPANEL == "YES" ) {
	$apache_LINK_TOUCHPANEL = report_menu_markup("TOUCHPANEL");
} else {
	$apache_LINK_TOUCHPANEL = "";
}

/*	-- THINCHART -- */
/*	----------------------- */
if ( $seer_ENABLE_THINCHART == "YES" ) {
	$apache_LINK_THINCHART = report_menu_markup("THINCHART");
} else {
	$apache_LINK_THINCHART = "";
}

/*	-- ATMOSPHERIC MODEL -- */
/*	----------------------- */
if ( $seer_ENABLE_ATMOSPHERICMODEL == "YES" ) {
	$apache_LINK_ATMOSPHERICMODEL = report_menu_markup("ATMOSPHERICMODEL");
} else {
	$apache_LINK_ATMOSPHERICMODEL = "";
}

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$mysql_seer_access_ACCESSLEVEL = 9999;
} else {
	/* proceed */
}

/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL1 = ""; 
$apache_REPORTL2 = "";
$apache_REPORTL3 = "";
$apache_REPORTL4 = "";
$apache_REPORTL5 = "";
$apache_REPORTL6 = "";
$apache_REPORTL7 = $apache_LINK_MODEL_WRAPPER_START.$apache_LINK_TANKMODEL.$apache_LINK_SPFMODEL.$apache_LINK_WARRIOR.$apache_LINK_CHECKWEIGHERMODEL.$apache_LINK_TTYPERFORMANCEMODEL.$apache_LINK_CIPMODEL.$apache_LINK_ATMOSPHERICMODEL.$apache_LINK_TOUCHPANEL.$apache_LINK_THINCHART.$apache_LINK_BULKMODEL.$apache_LINK_MODEL_WRAPPER_END;

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
$MODEL_MENUMACHINECONTROL_ENABLE = "YES";
	/*	-- use the MENUMACHINECONTROL block device for layout */
seer_final_report();

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
