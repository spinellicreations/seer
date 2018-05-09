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
S.E.E.R. FINALIZE OPTIONS AND FUNCTION PULL IN
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

/*	GLOBAL FUNCTION IMPORT */
/*	---------------------- */
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/global_functions/globalfunctions_seer_0.php');
/*	-- functions, tools, and common system subroutines (in function form) */
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/global_functions/globalfunctions_seer_1.php');
/*	-- mod_openopc specific system subroutines (in function form) */
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/global_functions/globalfunctions_seer_2.php');
/*	-- core model subroutines (in function form) */

/*	MODEL FUNCTION IMPORT */
/*	--------------------- */
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_COMMON.php');
/*	-- common to many models (typically report-type specific) */
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_ATMOSPHERICMODEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_BULKMODEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_CHECKWEIGHERMODEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_CIPMODEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_SPFMODEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_TANKMODEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_WARRIOR.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_THINCHART.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_TOUCHPANEL.php');
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/model_functions/modelfunctions_TTYPERFORMANCEMODEL.php');
/*	-- model specific core model subroutines (in function form), functions and tools */
/*	-- typically export preparation and handling, and anything that simply does not apply anywhere else */

/*	MySQL DB CONNECTION START */
/*	------------------------- */
seer_mysql_connect();

/*	DETERMINE HTTP USER AGENT */
/*	------------------------- */
$apache_HTTP_BROWSER = browser_info(); 
$apache_HTTP_BROWSER_ON_LINE = $apache_HTTP_BROWSER['browser'];
$apache_HTTP_BROWSER_ON_LINE_VERSION =  $apache_HTTP_BROWSER['version'];
$apache_HTTP_BROWSER_ON_LINE_ENGINE =  $apache_HTTP_BROWSER['engine'];

/*	USER STATUS UPDATE */
/*	------------------ */
seer_update_user_status();

/*	MULTILINGUAL SELECTED LANGUAGE PULL IN */
/*	-------------------------------------- */
$seer_language_file = $apache_WEBROOT."/".$apache_seer_VERSION."/language/multilang_file_".$seer_LANGUAGE.".php";
require($seer_language_file);

?>
