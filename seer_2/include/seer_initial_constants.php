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
S.E.E.R. INITIAL CONSTANTS FILE
--  DO NOT EDIT
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

/* ADDITIONAL CONFIG DATA NEEDED TO RUN */
/* 	-- YOU SHOULDN'T NEED TO EDIT THIS AT ALL */
/* ------------------------------------------------------------------ */

/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */
/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */
/*								      */
/*	YOU SHOULD -NOT- HAVE TO EDIT THE FOLLOWING CONSTANTS	      */
/*	-- THEY ARE HERE FOR SEVERAL REASONS:			      */
/*								      */
/*		1- FUTURE COMPATABILITY				      */
/*		2- EASE OF PROGRAMMING				      */
/*		3- IN CASE YOU WANT TO START MODIFYING SEER,          */
/*	           AT WHICH TIME YOU MAY NEED TO CHANGE THESE ITEMS   */
/*								      */
/*	-- OTHER THAN THAT, DON'T MODIFY THEM!			      */
/*								      */
/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */
/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */

/*	AUTO REFRESH */
/*	------------ */
$apache_PAGETYPE = "DYNAMIC";
/*	-- DO NOT EDIT, DEFAULT SETTING IS 'DYNAMIC' */
/*	-- sets our default page type to an auto-refreshing one so all */
/*	   pages will auto refresh unless declared 'STATIC' inside them */ 
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/index.php";
/*	-- default page to jump back to upon refresh unless otherwise specified on page */

/*	REPORT DISPLAY (seer_final_report) FLAGS */
/*	---------------------------------------- */
$MODEL_MENUMACHINECONTROL_ENABLE = "NO";
/*	-- seer_machinecontrol, seer_reporting, and others use a block device for display */
/*	   containment and size adjustment, others do not. */
/*	-- valid values are "YES" or "NO", and this should be set to "NO" here, as */
/*	   pages that require it to be "YES" will declare it within themselves. */
$MODEL_INSTANCE_DEPT_ALLOW_ALL = "YES";
/*	-- default value required to make the MACHINECONTROL_ENABLE operation possible. */
/*	-- MODELS (local options instances of models) that require a "NO" value shall */
/*	   decalre it within their respective local options files. */
/*	-- valid options are "YES" or "NO", and this should be set to "YES" here. */
$MODEL_INSTANCE_DEPT_ARRAY = array("ALL");
/*	-- default value required to make the MACHINECONTROL_ENABLE operation possible. */
/*	-- should be set to "ALL" here. */
$MODEL_INFOREPORT_ENABLE = "NO";
/*	-- seer_settings, and others use a block device for display */
/*	   containment and size adjustment, others do not. */
/*	-- valid values are "YES" or "NO", and this should be set to "NO" here, as */
/*	   pages that require it to be "YES" will declare it within themselves. */
$MODEL_USERREPORT_ENABLE = "NO";
/*	-- seer_settings targets, and others use a block device for display */
/*	   containment and size adjustment, others do not. */
/*	-- valid values are "YES" or "NO", and this should be set to "NO" here, as */
/*	   pages that require it to be "YES" will declare it within themselves. */
$MODEL_ASSEMBLE_REPORT_BACKWARDS = "NO";
/*	-- valid values are "YES" or "NO" */
/*	-- typically, reports are assembled with user level 7 content first, then 6, on */
/*	   through user level 1 last.  However, you may assembled level 1 first, then 2, */
/*	   on through level 7 by setting this value to "YES" in any page! */
$apache_REPORT_PULL_OTHER = "NO";
/*	-- should be include some other / external / non-standard markup in the echo */
/*	   to html?  If so, what is the path to the script to generate that markup? */
/*	-- default value must be "NO" */
/*	-- if needed, a page shall set this variable to the relative path of the script */
/*	   to execute prior to calling seer_echo_to_html */

/*	GOVERN THE TRAFFIC COP */
/*	---------------------- */
$seer_TRAFFIC_COP_ACTIVE = "NO";
$seer_TRAFFIC_COP_OPTION = -1;

/*	SECURITY CONTROL */
/* 	---------------- */
$seer_PROCESSLOGIN = "NO";

/*	FIRST RUN (INSTALL) */
/*	------------------- */
if ($seer_settings_FIRSTRUN != 'NO') {
	$seer_ENABLE_TANKMODEL = "NO";
	$seer_ENABLE_SPFMODEL = "NO";
	$seer_ENABLE_CIPMODEL = "NO";
	$seer_ENABLE_BULKMODEL = "NO";
	$seer_ENABLE_WARRIOR = "NO";
	$seer_ENABLE_CHECKWEIGHERMODEL = "NO";
	$seer_ENABLE_ATMOSPHERICMODEL = "NO";
	$seer_ENABLE_THINCHART = "NO";
	$seer_ENABLE_TOUCHPANEL = "NO";
	$seer_ENABLE_TTYPERFORMANCEMODEL = "NO";
} else {
	/* pass */
}
/*	-- shuts off all models during initial install */

/*	PREP FOR WARRIOR LABELING INTEGRATION */
/*	------------------------------------- */
$seer_WARRIOR_ENABLE_LABELING_PLUGIN = "NO";
$seer_WARRIOR_apache_ROOT_LABELING_PLUGIN = "";
$seer_WARRIOR_operating_system_ROOT_LABELING_PLUGIN = "";
$seer_WARRIOR_AUTO_POLL_JOBS = "YES";
$WARRIOR_FORMFILL_BY_JOB_NUMBER = "";
/*	-- DO NOT EDIT */
/*	-- your labeling plugin will set these values as it sees fit and necessary */
/*	-- if you do not use a labeling plugin, then these required default values */
/*	   will force 'normal' (non-labeling usage) of the W.A.R.R.I.O.R. module */

/*	CSS INJECTION */
/*	------------- */
$seer_CSS_INJECTION = "";

/*	COMPATABILITY WITH CANVAS */
/*	------------------------- */
$seer_enable_CANVAS = "NO";

/*	ADVANCED CONFIG PULL IN */
/*	----------------------- */
require ($apache_WEBROOT.'/'.$apache_seer_VERSION.'/config/advancedoptions_seer_0.php');

?>
