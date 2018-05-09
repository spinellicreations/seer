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
S.E.E.R. MODEL FUNCTIONS FILE (THINCHART)
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
function model_THINCHART_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_THINCHART_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $first_run_full_model_report, $full_model_report_mode, $THINCHART_WORKING_PEN1_NAME, $THINCHART_WORKING_PEN1_UM, $THINCHART_WORKING_PEN2_NAME, $THINCHART_WORKING_PEN2_UM, $THINCHART_WORKING_PEN3_NAME, $THINCHART_WORKING_PEN3_UM, $THINCHART_WORKING_EVENT_NAME;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NOTE, $multilang_STATIC_DATESTAMP, $multilang_THINCHART_9, $multilang_THINCHART_6, $multilang_STATIC_CERTIFIED, $multilang_STATIC_CERTIFIED_BY, $multilang_STATIC_COMMENT;

	/* EXECUTE */
	/* -- DATESTAMP, CHART, EVENT_STATUS, PEN1, PEN2, PEN3, CERTIFIED, CERTIFIED_BY, COMMENT */
	if ($first_run_full_model_report == 1) {
		$seer_EXPORT_CONTENT = "";
	} else {
		/* pass */
	}
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_THINCHART_6.$seer_CSV_DELINEATION.$multilang_THINCHART_9.$seer_CSV_DELINEATION.$THINCHART_WORKING_PEN1_NAME." [".$THINCHART_WORKING_PEN1_UM."]".$seer_CSV_DELINEATION.$THINCHART_WORKING_PEN2_NAME." [".$THINCHART_WORKING_PEN2_UM."]".$seer_CSV_DELINEATION.$THINCHART_WORKING_PEN3_NAME." [".$THINCHART_WORKING_PEN3_UM."]".$seer_CSV_DELINEATION.$multilang_STATIC_NOTE.$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED.$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED_BY.$seer_CSV_DELINEATION.$multilang_STATIC_COMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_THINCHART_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_THINCHART_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_NOTIFICATION, $mysql_mod_openopc_WORKING_EVENT_FRIENDLYNAME, $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_CHARTNAME,$mysql_mod_openopc_WORKING_PEN1,$mysql_mod_openopc_WORKING_PEN2,$mysql_mod_openopc_WORKING_PEN3,$mysql_mod_openopc_WORKING_EVENT, $mysql_mod_openopc_WORKING_CERTIFIED, $MODEL_CERTIFIEDUSERREALNAME, $mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT;

	/* EXECUTE */
	/* -- DATESTAMP, CHART, EVENT_STATUS, PEN1, PEN2, PEN3, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CHARTNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_EVENT_FRIENDLYNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PEN1.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PEN2.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PEN3.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_NOTIFICATION.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIED.$seer_CSV_DELINEATION.$MODEL_CERTIFIEDUSERREALNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* IDENTIFY CHART */
/* -- associate logical chart identity value to the friendly name */
function model_THINCHART_identify_chart ($chartname,$act_on_fault="NO")
{
	/* CALL THIS FUNCTION WITH... */
	/* $model_id = model_THINCHART_identify_chart($chartname,$act_on_fault); */
	/* -- $act_on_fault = "YES" or "NO" */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $THINCHART_COUNT, $THINCHART_NAME, $seer_HMIACTION_FAULT;

	/* EXECUTE */
	$mysql_query_name_id = $THINCHART_COUNT + 1;
	$mysql_query_name_id_fault = $mysql_query_name_id;
	$mysql_query_name_id_index = 0;
	while ($mysql_query_name_id_index < $THINCHART_COUNT) {
		if ($THINCHART_NAME[$mysql_query_name_id_index] == $chartname) {
			$mysql_query_name_id = $mysql_query_name_id_index;
		} else {
			/* pass */
		}
		$mysql_query_name_id_index = $mysql_query_name_id_index + 1;
	}
	if ( $act_on_fault != "NO" ) {
		if ( $mysql_query_name_id == $mysql_query_name_id_fault ) {
			$seer_HMIACTION_FAULT = 1;
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}

	/* RETURN */
	return $mysql_query_name_id;
}

/* CHART PARAMETERS */
/* -- pull in chart parameters for each pen */
function model_THINCHART_chart_parameters($chart_logical_id) {

	/* CALL THIS FUNCTION WITH... */
	/* model_THINCHART_chart_parameters($chart_logical_id); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $THINCHART_PENNAME_, $THINCHART_PENRANGE_LOW, $THINCHART_PENRANGE_HIGH, $THINCHART_PENUM_, $THINCHART_WORKING_PEN1_NAME, $THINCHART_WORKING_PEN1_PENRANGE_LOW, $THINCHART_WORKING_PEN1_PENRANGE_HIGH, $THINCHART_WORKING_PEN1_UM, $THINCHART_WORKING_PEN2_NAME, $THINCHART_WORKING_PEN2_PENRANGE_LOW, $THINCHART_WORKING_PEN2_PENRANGE_HIGH, $THINCHART_WORKING_PEN2_UM, $THINCHART_WORKING_PEN3_NAME, $THINCHART_WORKING_PEN3_PENRANGE_LOW, $THINCHART_WORKING_PEN3_PENRANGE_HIGH, $THINCHART_WORKING_PEN3_UM, $THINCHART_WORKING_EVENT_NAME;

	/* EXECUTE */
	$THINCHART_WORKING_PEN1_NAME = $THINCHART_PENNAME_[$chart_logical_id][1];
	$THINCHART_WORKING_PEN1_PENRANGE_LOW = $THINCHART_PENRANGE_LOW[$chart_logical_id][1];
	$THINCHART_WORKING_PEN1_PENRANGE_HIGH = $THINCHART_PENRANGE_HIGH[$chart_logical_id][1];
	$THINCHART_WORKING_PEN1_UM = $THINCHART_PENUM_[$chart_logical_id][1];
	$THINCHART_WORKING_PEN2_NAME = $THINCHART_PENNAME_[$chart_logical_id][2];
	$THINCHART_WORKING_PEN2_PENRANGE_LOW = $THINCHART_PENRANGE_LOW[$chart_logical_id][2];
	$THINCHART_WORKING_PEN2_PENRANGE_HIGH = $THINCHART_PENRANGE_HIGH[$chart_logical_id][2];
	$THINCHART_WORKING_PEN2_UM = $THINCHART_PENUM_[$chart_logical_id][2];
	$THINCHART_WORKING_PEN3_NAME = $THINCHART_PENNAME_[$chart_logical_id][3];
	$THINCHART_WORKING_PEN3_PENRANGE_LOW = $THINCHART_PENRANGE_LOW[$chart_logical_id][3];
	$THINCHART_WORKING_PEN3_PENRANGE_HIGH = $THINCHART_PENRANGE_HIGH[$chart_logical_id][3];
	$THINCHART_WORKING_PEN3_UM = $THINCHART_PENUM_[$chart_logical_id][3];
	$THINCHART_WORKING_EVENT_NAME = $THINCHART_PENNAME_[$chart_logical_id]['EVENT'];
}

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_THINCHART_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_7_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $THINCHART_PENNAME_, $THINCHART_PENUM_;

	/*	-- APACHE */
	global $THINCHART_LOOP_INDEX;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_STATIC_NOTE, $multilang_THINCHART_0;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, PEN1, PEN2, PEN3, EVENTPEN, NOTIFICATIONS and SUCH */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_ENDOFLINE_HOLDING;
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_THINCHART_0.$seer_CSV_DELINEATION.$THINCHART_PENNAME_[$THINCHART_LOOP_INDEX][1]." [".$THINCHART_PENUM_[$THINCHART_LOOP_INDEX][1]."]".$seer_CSV_DELINEATION.$THINCHART_PENNAME_[$THINCHART_LOOP_INDEX][2]." [".$THINCHART_PENUM_[$THINCHART_LOOP_INDEX][2]."]".$seer_CSV_DELINEATION.$THINCHART_PENNAME_[$THINCHART_LOOP_INDEX][3]." [".$THINCHART_PENUM_[$THINCHART_LOOP_INDEX][3]."]".$seer_CSV_DELINEATION.$THINCHART_PENNAME_[$THINCHART_LOOP_INDEX]['EVENT'].$seer_CSV_DELINEATION.$multilang_STATIC_NOTE.$seer_CSV_ENDOFLINE_HOLDING;
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_DELINEATION."XXXXXXXXXX".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_THINCHART_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_7_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_MACHINENAME, $mysql_mod_openopc_WORKING_PEN1, $mysql_mod_openopc_WORKING_PEN2, $mysql_mod_openopc_WORKING_PEN3, $mysql_mod_openopc_WORKING_EVENT, $mysql_mod_openopc_WORKING_NOTIFICATION;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, PEN1, PEN2, PEN3, EVENTPEN, NOTIFICATIONS and SUCH */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PEN1.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PEN2.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PEN3.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_EVENT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_NOTIFICATION.$seer_CSV_ENDOFLINE_HOLDING;
}

?>
