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
S.E.E.R. MODEL FUNCTIONS FILE (BULKMODEL)
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

/* HIGHLIGHT BASED UPON INVENTORY LEVEL */
/* -- provide a highlight color based upon inventory level of a bulk item */
function model_BULK_highlight_inventory_level ($post_WORKING_INVENTORY_PERCENT)
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_row_bgcolor = model_BULK_highlight_inventory_level($post_WORKING_INVENTORY_PERCENT); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $BULKMODEL_FILL_POINT_FULL, $BULKMODEL_FILL_POINT_REORDER, $BULKMODEL_FILL_POINT_EMPTY;

	/* EXECUTE */
	if ( $post_WORKING_INVENTORY_PERCENT >= $BULKMODEL_FILL_POINT_FULL ) {
		$post_FILL_BACKGROUND = "BGCOLOR='#66FF66'";
		/* green for full*/
	} else {
		$post_FILL_BACKGROUND = "BGCOLOR='#FFEE66'";
		/* yellow for nominal */
	}
	if ( $post_WORKING_INVENTORY_PERCENT <= $BULKMODEL_FILL_POINT_REORDER ) {
		$post_FILL_BACKGROUND = "BGCOLOR='#FFBB66'";
		/* orange for reorder */
	} else {
		/* pass */
	}
	if ( $post_WORKING_INVENTORY_PERCENT <= $BULKMODEL_FILL_POINT_EMPTY ) {
		$post_FILL_BACKGROUND = "BGCOLOR='#FF8866'";
		/* red for empty */
	} else {
		/* pass */
	}

	/* RETURN VARIABLES */
	return $post_FILL_BACKGROUND;
}

/* EXPORT TO CSV - REPORT 0 - ZERO */
/* -- clear csv content */
function model_BULK_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_BULK_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_BULKMODEL_16, $multilang_BULKMODEL_13, $multilang_BULKMODEL_25, $BULKMODEL_UM_THISMODEL;

	/* EXECUTE */
	/* -- DATESTAMP, ITEM, INVENTORY_PERCENT, INVENTORY_QUANTITY*/
	$seer_EXPORT_CONTENT = $multilang_BULKMODEL_16.$seer_CSV_DELINEATION.$multilang_BULKMODEL_13.$seer_CSV_DELINEATION.$multilang_BULKMODEL_25." [%]".$seer_CSV_DELINEATION.$multilang_BULKMODEL_25." [".$BULKMODEL_UM_THISMODEL."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_BULK_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_BULK_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_BULKNAME, $mysql_mod_openopc_WORKING_INVENTORY_PERCENT, $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;

	/* EXECUTE */
	/* -- DATESTAMP, ITEM, INVENTORY_PERCENT, INVENTORY_QUANTITY*/
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_BULKNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_INVENTORY_PERCENT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_BULK_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_BULK_export_csv_report_1_zero(); */
	/* -- be sure following variables are decalred BEFORE calling... */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_BULKMODEL_16, $multilang_BULKMODEL_13, $multilang_BULKMODEL_25, $BULKMODEL_UM_THISMODEL;

	/* EXECUTE */
	/* -- DATESTAMP, ITEM, INVENTORY_PERCENT, INVENTORY_QUANTITY*/
	$seer_EXPORT_CONTENT = $multilang_BULKMODEL_16.$seer_CSV_DELINEATION.$multilang_BULKMODEL_13.$seer_CSV_DELINEATION.$multilang_BULKMODEL_25." [%]".$seer_CSV_DELINEATION.$multilang_BULKMODEL_25." [".$BULKMODEL_UM_THISMODEL."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_BULK_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_BULK_export_csv_report_1_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $mysql_mod_openopc_WORKING_INVENTORY_PERCENT, $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;

	/* EXECUTE */
	/* -- DATESTAMP, BULKNAME, INVENTORY_PERCENT, INVENTORY_QUANTITY */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_INVENTORY_PERCENT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 2 - ZERO */
/* -- clear csv content */
function model_BULK_export_csv_report_2_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_BULK_export_csv_report_2_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_BULKMODEL_16, $multilang_STATIC_DATESTAMP_START, $multilang_STATIC_DATESTAMP_END, $multilang_BULKMODEL_33, $BULKMODEL_UM_THISMODEL;

	/* EXECUTE */
	/* -- DATESTAMP, ITEM, INVENTORY_PERCENT, INVENTORY_QUANTITY*/
	$seer_EXPORT_CONTENT = $multilang_BULKMODEL_13.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_START.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_END.$seer_CSV_DELINEATION.$multilang_BULKMODEL_33." [".$BULKMODEL_UM_THISMODEL."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 2 - BUILD */
/* -- add to (build) csv content */
function model_BULK_export_csv_report_2_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_BULK_export_csv_report_2_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, $mysql_ENTRY_FINAL_TOTAL, $mysql_ENTRY_MACHINENAME;

	/* EXECUTE */
	/* -- BULKNAME, DATESTAMP_START, DATESTAMP_END, USE */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_query_START_DATESTAMP.$seer_CSV_DELINEATION.$mysql_query_END_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_FINAL_TOTAL.$seer_CSV_ENDOFLINE_HOLDING;
}

?>
