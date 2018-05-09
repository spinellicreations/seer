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
S.E.E.R. MODEL FUNCTIONS FILE (TTYPERFORMANCEMODEL)
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

/* EXPORT TO CSV - REPORT 0 - ZERO */
/* -- clear csv content */
function model_TTYPERFORMANCE_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TTYPERFORMANCE_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MYSQL */
	global $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP;

	/*	-- MODEL */
	global	$TTYPERFORMANCEMODEL_SUBPAGETITLE;

	/*	-- LANGUAGE */
	global $multilang_TTYPERFORMANCEMODEL_1, $multilang_STATIC_DATESTAMP_START, $multilang_STATIC_DATESTAMP_END, $multilang_TTYPERFORMANCEMODEL_13, $multilang_TTYPERFORMANCEMODEL_7, $multilang_TTYPERFORMANCEMODEL_14, $multilang_TTYPERFORMANCEMODEL_8, $multilang_TTYPERFORMANCEMODEL_18, $multilang_TTYPERFORMANCEMODEL_19;

	/* EXECUTE */
	/* -- MACHINE_ID, FAULTS, ENTRIES, PERFORMANCE [percent] */
	$seer_EXPORT_CONTENT = $multilang_TTYPERFORMANCEMODEL_1.$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_DELINEATION.$TTYPERFORMANCEMODEL_SUBPAGETITLE.$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_ENDOFLINE_HOLDING."----------------------------------".$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_ENDOFLINE_HOLDING.$multilang_STATIC_DATESTAMP_START.$seer_CSV_DELINEATION.$mysql_query_START_DATESTAMP.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_END.$seer_CSV_DELINEATION.$mysql_query_END_DATESTAMP.$seer_CSV_ENDOFLINE_HOLDING."----------------------------------".$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_DELINEATION."----------------------------------".$seer_CSV_ENDOFLINE_HOLDING.$multilang_TTYPERFORMANCEMODEL_13.$seer_CSV_DELINEATION.$multilang_TTYPERFORMANCEMODEL_7.$seer_CSV_DELINEATION.$multilang_TTYPERFORMANCEMODEL_14.$seer_CSV_DELINEATION.$multilang_TTYPERFORMANCEMODEL_8.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_TTYPERFORMANCE_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TTYPERFORMANCE_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL */
	global $TTYPERFORMANCEMODEL_NAME;

	/*	-- MySQL */
	global 	$mysql_index, $mysql_mod_openopc_BAD_DATA_PERCENT, $mysql_mod_openopc_BAD_DATA_COUNT, $mysql_mod_openopc_query_result_rows2;

	/* EXECUTE */
	/* -- MACHINE_ID, FAULTS, ENTRIES, PERFORMANCE [percent] */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$TTYPERFORMANCEMODEL_NAME[$mysql_index].$seer_CSV_DELINEATION.$mysql_mod_openopc_BAD_DATA_COUNT.$seer_CSV_DELINEATION.$mysql_mod_openopc_query_result_rows2.$seer_CSV_DELINEATION.$mysql_mod_openopc_BAD_DATA_PERCENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_TTYPERFORMANCE_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TTYPERFORMANCE_export_csv_report_1_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_TTYPERFORMANCEMODEL_13, $multilang_STATIC_DATESTAMP, $multilang_STATIC_ITEM;

	/* EXECUTE */
	/* -- DATESTAMP, TTYPERFORMANCE, OPERATOR, RECIPE, GROSS MASS, TARE, NET MASS, DELTA MIN, DELTA MAX, RESULT */
	$seer_EXPORT_CONTENT =  $multilang_TTYPERFORMANCEMODEL_13.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_STATIC_ITEM.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_TTYPERFORMANCE_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TTYPERFORMANCE_export_csv_report_1_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $mysql_mod_openopc_WORKING_TTY;

	/* EXECUTE */
	/* -- DATESTAMP, TTYPERFORMANCE, OPERATOR, RECIPE, GROSS MASS, TARE, NET MASS, DELTA MIN, DELTA MAX, RESULT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TTY.$seer_CSV_ENDOFLINE_HOLDING;
}

?>
