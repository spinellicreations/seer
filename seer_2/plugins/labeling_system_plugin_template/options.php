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
LABELING SYSTEM PLUGIN TEMPLATE
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
/* HEADER PROCESSING */
/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
if ($apache_plugin_process_active == 'HEADER') {
	/* ADDS ADDITIONAL CONTENT BETWEEN "HEAD" TAGS OF MARKUP */

	/* pass */
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

	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	/* REQUIRED OF ALL LABELING PLUGINS FOR W.A.R.R.I.O.R. */
	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */

	$seer_WARRIOR_ENABLE_LABELING_PLUGIN = "YES";
	/*	-- DO NOT EDIT */
	$seer_WARRIOR_apache_ROOT_LABELING_PLUGIN = $apache_WEBROOT."/".$apache_seer_VERSION."/plugins/labeling_system_plugin_template";
	/*	-- APACHE RELATIVE PATH */
	$seer_WARRIOR_operating_system_ROOT_LABELING_PLUGIN = "/".$apache_seer_VERSION."/plugins/labeling_system_plugin_template";
	/*	-- OS ABSOLUTE PATH */
	$seer_WARRIOR_AUTO_POLL_JOBS = "NO";
	/*	-- DO NOT EDIT */

	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	/* YOUR PLUGINS SPECIFIC OPTIONS */
	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */

	/* your plugins specific options go here... */

	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */
	/* INCLUDE RUNTIME FILES */
	/* ------------------------------------------------------------------ */
	/* ------------------------------------------------------------------ */

	include($seer_WARRIOR_apache_ROOT_LABELING_PLUGIN.'/labeling_plugin_functions.php');
	/*	-- FUNCTIONS */

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

	/* pass */
} else {
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
