<?php

/*
---------------------------------------------------------------------
---------------------------------------------------------------------
GROUPE LACTALIS (USA) tele_hack_ahead FOR S.E.E.R.
---------------------------------------------------------------------
---------------------------------------------------------------------
COPYRIGHT

 THE FOLLOWING 34 LINES MAY NOT BE REMOVED, but may be
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
DEPENDANCY COPYRIGHT

 This file is a dependancy, required by tele_hack_ahead,
 and is the sole work of Mingyi Liu 2004-06.

 This script is freeware by author Mingyi Liu and comes with no 
 warranty whatsoever. In no case should the author be held liable for 
 anything including loss/damage of any kind as the result of using this
 script.
 The author hereby grants you license to freely distribute or modify 
 the script for whatever purposes.

 This version is 1.1.
	... http://www.mingyi.org
---------------------------------------------------------------------
---------------------------------------------------------------------
CONTACT		
		Author			V. Spinelli
				Email:	Vince@SpinelliCreations.com
				Site:	http://spinellicreations.com
				Handle:	PoweredByDodgeV8

		Dependancy Author	Dr. Mingyi Liu, Ph.D
				Email: 	mingyiliu@yahoo.com
				Site:	http://www.mingyi.org

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
---------------------------------------------------------------------
tele_hack_ahead PLUGIN - OPTIONS
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is Operating System agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
/* USER AGENT DEPENDENCY */
/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
/* -- THIS PLUGIN IS USER AGENT DEPENDANT, THAT IS TO SAY THAT IT IS
   INTENDED TO ONLY BE 'ENABLED' FOR USERS WITH SPECIFIC BROWSERS
   THAT FOR WHATEVER REASON NEED 'A LITTLE HELP' IN ORDER TO ACT 
   PROPERLY.

   -- TARGETING MICROSOFT INTERNET EXPLORER VERSION 7 AND OLDER
   	-- SEER ONLY SUPPORTS DOWN TO VERSION 6, SO THIS WILL COVER 7 AND 6
   -- ANY FIREFOX OLDER THAN 3.0
   -- ANY NETSCAPE (WE DON'T OFFICIALLY SUPPORT NETSCAPE, BUT v.9 SHOULD 
      WORK FINE.
*/

if ( (($apache_HTTP_BROWSER_ON_LINE_ENGINE == 'trident') && ($apache_HTTP_BROWSER_ON_LINE_VERSION < 8)) || ( ($apache_HTTP_BROWSER_ON_LINE_ENGINE == 'gecko') && ( (($apache_HTTP_BROWSER_ON_LINE == 'firefox') && ($apache_HTTP_BROWSER_ON_LINE_VERSION < 3)) || ($apache_HTTP_BROWSER_ON_LINE == 'netscape') ) ) ) {
	/* WE HAVE IDENTIFIED THE TARGET BROWSER */

	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	/* HEADER PROCESSING */
	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	if ($apache_plugin_process_active == 'HEADER') {
		/* ADDS ADDITIONAL CONTENT BETWEEN "HEAD" TAGS OF MARKUP */

		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */
		/* PATHS */
		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */

		/* -- FILESYSTEM BASED */
		$seer_apache_ROOT_THA_PLUGIN = $apache_WEBROOT."/".$apache_seer_VERSION."/plugins/tele_hack_ahead";

		/* -- WEB ROOT BASED */
		$seer_apache_THA_PLUGIN_AUTOCOMPLETE_JAVASCRIPT = "/".$apache_seer_VERSION."/plugins/tele_hack_ahead/autocomplete.js";

		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */
		/* ACCEPTABLE DELAY BETWEEN KEYSTROKES */
		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */
		
		/* -- VALUE IN MILLI-SECONDS (SECONDS x 1000) */
		$seer_apache_THA_PLUGIN_ACCEPTABLE_DELAY_MS = 3500;

		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */
		/* MODIFY HEAD */
		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */
		include($seer_apache_ROOT_THA_PLUGIN.'/tha_head.php');
		/*	-- JS DECLARATION */	

	} else {
		/* pass */
	}

	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	/* PRE PROCESSING */
	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	if ($apache_plugin_process_active == 'PRE') {
		/* EXECUTED BEFORE MAIN BODY OF MARKUP */

		/* pass */

	} else {
		/* pass */
	}

	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	/* POST PROCESSING */
	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	if ($apache_plugin_process_active == 'POST') {
		/* EXECUTED JUST AFTER FINAL MARKUP IS GENERATED */

		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */
		/* INCLUDE RUNTIME FILES */
		/* ------------------------------------------------------------------ */
		/* ------------------------------------------------------------------ */

		include($seer_apache_ROOT_THA_PLUGIN.'/tha_execute.php');
		/*	-- EXECUTION */	

	} else {
		/* pass */
	}

} else {
	/* NOT A TARGET BROWSER */
	/* pass */
}

/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
/* FAULTS AND LOGS */
/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
if ($apache_plugin_process_active == 'FAULTS') {
	/* EXECUTED ONLY IN THE SYSTEM FAULT PAGE (when clicking on the 'DATA' light) */
	/* -- DOES -NOT- GET INCLUDE IN THE DATA INTEGRITY CHECK (will not change */
	/*    the color of the light) */
	/* */
	/* -- PROPER FORM IS ... */
	/* 	$apache_REPORT_PLUGIN_ADDON = $apache_REPORT_PLUGIN_ADDON."
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
							-- YOUR CONTENT GOES HERE -- 
						</TABLE>
						"; */
	/* */
	/* pass */
} else {
	/* pass */
}

?>
