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
seer_echo_to_html
-- POSTS THE COMPUTED CONTENT TO A WEBPAGE
---------------------------------------------------------------------
*/

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/seer_header.php');
echo $apache_PAGETITLE;

/* -- SUPPORT POST PROCESSING PLUGINS (PULL IN) */
/* -- -- TYPICALLY POST PROCESSING PLUGINS WILL ACT UPON */
/*       THE FINISHED / GENERATED REPORT OR HMI BODY, WHICH */
/*       IS REPRESENTED IN VARIABLE FORM AS $apache_REPORT */
/* -- -- FOR STANDARD PLUGIN INVOCATION, SEE THE ADVANCED */
/*	 OPTIONS FILE IN THE CONFIG DIRECTORY */
$apache_plugin_process_active = "POST";
foreach ($seer_PLUGINS_TO_USE as $selected_PLUGIN) {
	include($apache_WEBROOT.'/'.$apache_seer_VERSION.'/plugins/'.$selected_PLUGIN.'/options.php');
}
$apache_plugin_process_active = "NONE";
/*	-- DO NOT EDIT */
/*	-- all plugins should be placed in /[seer_webroot]/plugins/[plugin_name]/ */
/*	   and contain an 'options.php' file */

echo $apache_REPORT;
if ($apache_REPORT_PULL_OTHER != "NO") {
	include ($apache_REPORT_PULL_OTHER);
} else {
	/* pass */
}
require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/seer_footer.php');

?>
