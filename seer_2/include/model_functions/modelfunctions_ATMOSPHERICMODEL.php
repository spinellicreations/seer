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
S.E.E.R. MODEL FUNCTIONS FILE (ATMOSPHERICMODEL)
-- MODEL SUBROUTINES (FUNCTION BY FORM, SUBROUTINE BY EXECUTION)
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is operating system agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* IMAP IMAGE DISPLAY */
/* -- for model local instances with the imap image enabled, tack */
/*    it onto the end of the report or hmi */
function model_ATMOSPHERIC_tack_on_imap ($traffic_cop_option,$your_resulting_report_or_hmi)
{
	/* CALL THIS FUNCTION WITH... */
	/* $your_resulting_report_or_hmi = model_ATMOSPHERIC_tack_on_imap($traffic_cop_option,$your_resulting_report_or_hmi); */

	/* GLOBALIZE VARIABLES */
	/* -- SEER */
	global $seer_ATMOSPHERICMODEL_ENABLE_IMAP;

	/* EXECUTE */
	if ( $seer_ATMOSPHERICMODEL_ENABLE_IMAP[$traffic_cop_option] == "YES" ) {
		/* display image map of zone location */
		$your_resulting_report_or_hmi = $your_resulting_report_or_hmi."
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						<!-- MODEL LOCAL INSTANCE IMAP OF MACHINE / ZONE / OR DEVICE LOCATION -->
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

						<P CLASS='BANNER'>
							<IMG SRC='./config/ATMOSPHERICMODEL/localoptions_ATMOSPHERICMODEL_".$traffic_cop_option."_IMAP.png' ALT='IMAP'>
						</P>

						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						";
	} else {
		/* do not display image map of zone location */
	}

	/* RETURN VARIABLES */
	return $your_resulting_report_or_hmi;
}

/* EXPORT TO CSV - REPORT 0 - ZERO */
/* -- clear csv content */
function model_ATMOSPHERIC_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_ATMOSPHERIC_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_ATMOSPHERICMODEL_4, $multilang_ATMOSPHERICMODEL_5, $ATMOSPHERICMODEL_UM_TEMPERATURE, $multilang_ATMOSPHERICMODEL_6, $ATMOSPHERICMODEL_UM_HUMIDITY, $multilang_ATMOSPHERICMODEL_7, $ATMOSPHERICMODEL_UM_PRESSURE;

	/* EXECUTE */
	/* -- DATESTAMP, ZONE, TEMPERATURE, HUMIDITY, PRESSURE */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_ATMOSPHERICMODEL_4.$seer_CSV_DELINEATION.$multilang_ATMOSPHERICMODEL_5." [".$ATMOSPHERICMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_ATMOSPHERICMODEL_6." [".$ATMOSPHERICMODEL_UM_HUMIDITY."]".$seer_CSV_DELINEATION.$multilang_ATMOSPHERICMODEL_7." [".$ATMOSPHERICMODEL_UM_PRESSURE."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_ATMOSPHERIC_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_ATMOSPHERIC_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $mysql_mod_openopc_WORKING_TEMPERATURE, $mysql_mod_openopc_WORKING_HUMIDITY, $mysql_mod_openopc_WORKING_PRESSURE;

	/* EXECUTE */
	/* -- DATESTAMP, ZONE, TEMPERATURE, HUMIDITY, PRESSURE */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TEMPERATURE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_HUMIDITY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PRESSURE.$seer_CSV_ENDOFLINE_HOLDING;
}

?>
