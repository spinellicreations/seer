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
S.E.E.R. MODEL FUNCTIONS FILE (CHECKWEIGHERMODEL)
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
function model_CHECKWEIGHER_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CHECKWEIGHER_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $CHECKWEIGHERMODEL_UM_UNIT, $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES, $CHECKWEIGHERMODEL_UM_MASS;

	/*	-- LANGUAGE */
	global $multilang_CHECKWEIGHERMODEL_58, $multilang_CHECKWEIGHERMODEL_81, $multilang_STATIC_DATESTAMP_START, $multilang_STATIC_DATESTAMP_END, $multilang_STATIC_DURATION_CAPS, $multilang_CHECKWEIGHERMODEL_6, $multilang_CHECKWEIGHERMODEL_12, $multilang_CHECKWEIGHERMODEL_34, $multilang_CHECKWEIGHERMODEL_44, $multilang_CHECKWEIGHERMODEL_45, $multilang_CHECKWEIGHERMODEL_46, $multilang_CHECKWEIGHERMODEL_47, $multilang_CHECKWEIGHERMODEL_70, $multilang_CHECKWEIGHERMODEL_50, $multilang_CHECKWEIGHERMODEL_51, $multilang_CHECKWEIGHERMODEL_48, $multilang_CHECKWEIGHERMODEL_52, $multilang_CHECKWEIGHERMODEL_77, $multilang_CHECKWEIGHERMODEL_78, $multilang_CHECKWEIGHERMODEL_79,$multilang_CHECKWEIGHERMODEL_75, $multilang_CHECKWEIGHERMODEL_75, $multilang_CHECKWEIGHERMODEL_76, $multilang_CHECKWEIGHERMODEL_71;

	/* EXECUTE */
	/* -- CHECKWEIGHER, OPERATOR, DATESTAMP_START, DATESTAMP_END, RUNTIME_MINUTES, RECIPE, TARGET, TARE, MIN, MAX, QUANTITY, QUANTITY_ACCEPTED, QUANTITY_REJECTED, TOTAL_MASS, TOTAL_MASS_ACCEPTED, TOTAL_MASS_REJECTED, RATE, RATE_ACCEPTED, MEAN_MASS, MEAN_MASS_ACCEPTED, MEAN_MASS_REJECTED, EXPECTED_ACCEPTED_PRODUCTION, ACTUAL_ACCEPTED_PRODUCTION, DIFFERENCE, GIVEAWAY, TAKEAWAY, STANDARD_DEVIATION */
	$seer_EXPORT_CONTENT = $multilang_CHECKWEIGHERMODEL_58.$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_81.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_START.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_END.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION_CAPS."[".$multilang_CHECKWEIGHERMODEL_50."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_6.$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_12."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_34."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_44."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_45."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_46."[".$CHECKWEIGHERMODEL_UM_UNIT."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_46."-".$multilang_CHECKWEIGHERMODEL_51."[".$CHECKWEIGHERMODEL_UM_UNIT."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_46."-".$multilang_CHECKWEIGHERMODEL_52."[".$CHECKWEIGHERMODEL_UM_UNIT."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_47."[".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_47."-".$multilang_CHECKWEIGHERMODEL_51."[".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_47."-".$multilang_CHECKWEIGHERMODEL_52."[".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_70."[".$CHECKWEIGHERMODEL_UM_UNIT."/".$multilang_CHECKWEIGHERMODEL_50."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_70."-".$multilang_CHECKWEIGHERMODEL_51."[".$CHECKWEIGHERMODEL_UM_UNIT."/".$multilang_CHECKWEIGHERMODEL_50."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_48."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_48."-".$multilang_CHECKWEIGHERMODEL_51."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_48."-".$multilang_CHECKWEIGHERMODEL_52."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_77."[".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_78."[".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_79."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_75."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_75."[%]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_76."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_76."[%]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_71."[".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_CHECKWEIGHER_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CHECKWEIGHER_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_DEVIATION_STANDARD;

	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$mysql_ENTRY_MACHINENAME, $mysql_mod_openopc_HOLDING_OPERATOR, $mysql_mod_openopc_WORKING_DATESTAMP_START, $mysql_mod_openopc_WORKING_DATESTAMP_END, $mysql_mod_openopc_WORKING_DURATION_MINUTES, $mysql_mod_openopc_HOLDING_RECIPE, $mysql_mod_openopc_WORKING_TARGET, $mysql_mod_openopc_WORKING_TARE, $mysql_mod_openopc_WORKING_MIN, $mysql_mod_openopc_WORKING_MAX, $mysql_mod_openopc_WORKING_COUNT, $mysql_mod_openopc_WORKING_COUNT_ACCEPTED, $mysql_mod_openopc_WORKING_COUNT_REJECTED, $mysql_mod_openopc_WORKING_MASS_TOTAL, $mysql_mod_openopc_WORKING_MASS_ACCEPTED, $mysql_mod_openopc_WORKING_MASS_REJECTED, $mysql_mod_openopc_WORKING_RATE, $mysql_mod_openopc_WORKING_RATE_ACCEPTED, $mysql_mod_openopc_WORKING_MASS_AVERAGE, $mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED, $mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED, $mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION, $mysql_mod_openopc_WORKING_MASS_ACCEPTED, $mysql_mod_openopc_WORKING_DIFFERENCE, $mysql_mod_openopc_WORKING_GIVEAWAY, $mysql_mod_openopc_WORKING_GIVEAWAY_PCT, $mysql_mod_openopc_WORKING_TAKEAWAY, $mysql_mod_openopc_WORKING_TAKEAWAY_PCT;

	/* EXECUTE */
	/* -- CHECKWEIGHER, OPERATOR, DATESTAMP_START, DATESTAMP_END, RUNTIME_MINUTES, RECIPE, TARGET, TARE, MIN, MAX, QUANTITY, QUANTITY_ACCEPTED, QUANTITY_REJECTED, TOTAL_MASS, TOTAL_MASS_ACCEPTED, TOTAL_MASS_REJECTED, RATE, RATE_ACCEPTED, MEAN_MASS, MEAN_MASS_ACCEPTED, MEAN_MASS_REJECTED, EXPECTED_ACCEPTED_PRODUCTION, ACTUAL_ACCEPTED_PRODUCTION, DIFFERENCE, GIVEAWAY, TAKEAWAY, STANDARD_DEVIATION */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_HOLDING_OPERATOR.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DATESTAMP_START.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DATESTAMP_END.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DURATION_MINUTES.$seer_CSV_DELINEATION.$mysql_mod_openopc_HOLDING_RECIPE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TARGET.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TARE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MIN.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MAX.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_COUNT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_COUNT_ACCEPTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_COUNT_REJECTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_TOTAL.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_ACCEPTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_REJECTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RATE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RATE_ACCEPTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_AVERAGE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_ACCEPTED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DIFFERENCE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_GIVEAWAY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_GIVEAWAY_PCT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TAKEAWAY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TAKEAWAY_PCT.$seer_CSV_DELINEATION.$apache_DEVIATION_STANDARD.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_CHECKWEIGHER_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CHECKWEIGHER_export_csv_report_1_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $CHECKWEIGHERMODEL_UM_MASS;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_CHECKWEIGHERMODEL_58, $multilang_CHECKWEIGHERMODEL_81, $multilang_CHECKWEIGHERMODEL_6, $multilang_CHECKWEIGHERMODEL_60, $multilang_CHECKWEIGHERMODEL_34, $multilang_CHECKWEIGHERMODEL_61, $multilang_CHECKWEIGHERMODEL_14, $multilang_CHECKWEIGHERMODEL_16, $multilang_CHECKWEIGHERMODEL_62;

	/* EXECUTE */
	/* -- DATESTAMP, CHECKWEIGHER, OPERATOR, RECIPE, GROSS MASS, TARE, NET MASS, DELTA MIN, DELTA MAX, RESULT */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_58.$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_81.$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_6.$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_60." [".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_34." [".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_61." [".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_14." [".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_16." [".$CHECKWEIGHERMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_CHECKWEIGHERMODEL_62.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_CHECKWEIGHER_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CHECKWEIGHER_export_csv_report_1_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_MACHINENAME, $mysql_mod_openopc_WORKING_OPERATOR, $mysql_mod_openopc_WORKING_RECIPE, $mysql_mod_openopc_WORKING_MASS, $mysql_mod_openopc_WORKING_TARE, $mysql_mod_openopc_WORKING_MASS_NET, $mysql_mod_openopc_WORKING_MIN, $mysql_mod_openopc_WORKING_MAX, $mysql_mod_openopc_WORKING_RESULT;

	/* EXECUTE */
	/* -- DATESTAMP, CHECKWEIGHER, OPERATOR, RECIPE, GROSS MASS, TARE, NET MASS, DELTA MIN, DELTA MAX, RESULT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_OPERATOR.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RECIPE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TARE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MASS_NET.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MIN.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MAX.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RESULT.$seer_CSV_ENDOFLINE_HOLDING;		
}

/* DETERMINE OPERATOR'S NAME */
function model_CHECKWEIGHER_determine_operator_name ($OPERATOR_SEER_UNAME)
{
	/* CALL THIS FUNCTION WITH... */
	/* $OPERATOR_REAL_NAME = model_CHECKWEIGHER_determine_operator_name ($OPERATOR_SEER_UNAME); */

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global $multilang_STATIC_UNKNOWN;

	/* EXECUTE */
	if ($OPERATOR_SEER_UNAME != NULL) {
		/* BACKWARDS COMPATABILITY FOR DATABASES UPGRADED FROM CHECKWEIGHERMODEL */
		/* VERSION 1 */
		$mysql_seer_query = "REALNAME";
		$mysql_seer_query = "SELECT ".$mysql_seer_query." FROM access WHERE USERNAME LIKE '".$OPERATOR_SEER_UNAME."' LIMIT 1";
		list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query);
		if ($mysql_seer_num_rows > 0) {
			while ($mysql_seer_query_row = mysqli_fetch_assoc($mysql_seer_query_result)) {
				$mysql_seer_WORKING_REALNAME = $mysql_seer_query_row['REALNAME'];
			}
		} else {
			$mysql_seer_WORKING_REALNAME = $multilang_STATIC_UNKNOWN;
		}
	} else {
		$mysql_seer_WORKING_REALNAME = $multilang_STATIC_UNKNOWN;
	}

	/* RETURN VARIABLES */
	return $mysql_seer_WORKING_REALNAME;
}

/* PUSH RUN DATA TO REPORT 0 MARKUP */
/* -- generate html for use when building report via cycling through array(s) */
function model_CHECKWEIGHER_push_to_report_0 ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CHECKWEIGHER_push_to_report_0(); */

	/* GLOBALIZE VARIABLES */
	/*	-- PUSH TO OTHER FUNCTION(S) */
	global $post_BAR_GRAPH_TITLE, $post_BAR_GRAPH_HEIGHT, $post_RECORDS_EXAMINED, $recycle_array_ITEM, $post_TARGET_TO_MEASURE_DEVIATION_FROM, $apache_REPORT_STDEV_PLOT_MASS;

	/* 	-- APACHE */
	global $apache_REPORT_RECORDENTRY, $SIGMA_BAR_GRAPH_HEIGHT, $apache_DEVIATION_STANDARD;

	/*	-- SEER */
	global $CHECKWEIGHERMODEL_UM_MASS, $CHECKWEIGHERMODEL_UM_UNIT, $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES, $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR;

	/*	-- MYSQL */
	global $mysql_mod_openopc_WORKING_MASS_ARRAY, $mysql_mod_openopc_HOLDING_RECIPE, $mysql_mod_openopc_WORKING_TARGET, $mysql_mod_openopc_WORKING_TARE, $mysql_mod_openopc_WORKING_MIN, $mysql_mod_openopc_WORKING_MAX, $mysql_mod_openopc_WORKING_DATESTAMP_START, $mysql_mod_openopc_WORKING_DATESTAMP_END, $mysql_mod_openopc_WORKING_COUNT, $mysql_mod_openopc_WORKING_MASS_TOTAL, $mysql_mod_openopc_WORKING_COUNT_ACCEPTED, $mysql_mod_openopc_WORKING_MASS_ACCEPTED, $mysql_mod_openopc_WORKING_DURATION_MINUTES, $mysql_mod_openopc_WORKING_COUNT_REJECTED, $mysql_mod_openopc_WORKING_MASS_REJECTED, $mysql_seer_HOLDING_REALNAME, $mysql_mod_openopc_HOLDING_OPERATOR, $mysql_mod_openopc_WORKING_RATE, $mysql_mod_openopc_WORKING_MASS_AVERAGE, $mysql_mod_openopc_WORKING_RATE_ACCEPTED, $mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED, $mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED, $mysql_mod_openopc_WORKING_TAKEAWAY, $mysql_mod_openopc_WORKING_GIVEAWAY, $mysql_mod_openopc_WORKING_TAKEAWAY_PCT, $mysql_mod_openopc_WORKING_GIVEAWAY_PCT, $mysql_mod_openopc_WORKING_DIFFERENCE, $mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION, $mysql_mod_openopc_WORKING_COUNT_REJECTED, $mysql_ENTRY_DISPLAY_REJECTS, $mysql_mod_openopc_WORKING_COUNT_REJECTED, $mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP, $mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS, $mysql_mod_openopc_EXPORT_ME_PLEASE, $mysql_mod_openopc_FORCE_CLOSE_OUT_BATCH;

	/*	-- LANGAUGE */
	global $multilang_STATIC_UNKNOWN, $multilang_CHECKWEIGHERMODEL_72, $multilang_CHECKWEIGHERMODEL_12, $multilang_CHECKWEIGHERMODEL_34, $multilang_CHECKWEIGHERMODEL_44, $multilang_CHECKWEIGHERMODEL_45, $multilang_STATIC_DATESTAMP_START, $multilang_STATIC_DATESTAMP_END, $multilang_CHECKWEIGHERMODEL_46, $multilang_CHECKWEIGHERMODEL_47, $multilang_CHECKWEIGHERMODEL_51, $multilang_STATIC_DURATION_CAPS, $multilang_CHECKWEIGHERMODEL_50, $multilang_CHECKWEIGHERMODEL_52, $multilang_CHECKWEIGHERMODEL_81, $multilang_CHECKWEIGHERMODEL_70, $multilang_CHECKWEIGHERMODEL_48, $multilang_CHECKWEIGHERMODEL_76, $multilang_CHECKWEIGHERMODEL_75, $multilang_CHECKWEIGHERMODEL_79, $multilang_CHECKWEIGHERMODEL_78, $multilang_CHECKWEIGHERMODEL_77, $multilang_CHECKWEIGHERMODEL_74, $multilang_CHECKWEIGHERMODEL_73, $multilang_CHECKWEIGHERMODEL_61, $multilang_STATIC_DATESTAMP_CAPS; 

	/* EXECUTE */
	/*	-- CLOSE OUT LAST (or PREVIOUS) BATCH */
	list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($mysql_mod_openopc_WORKING_DATESTAMP_START,$mysql_mod_openopc_WORKING_DATESTAMP_END);
	$mysql_mod_openopc_WORKING_DURATION_MINUTES = varcharTOnumeric2(($apache_function_DURATION_UNIXTIME / 60), 2);
	$mysql_mod_openopc_WORKING_COUNT_ACCEPTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_COUNT - $mysql_mod_openopc_WORKING_COUNT_REJECTED), 0);
	$mysql_mod_openopc_WORKING_MASS_ACCEPTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_TOTAL - $mysql_mod_openopc_WORKING_MASS_REJECTED), 2);
	$mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION = varcharTOnumeric2(($mysql_mod_openopc_WORKING_COUNT_ACCEPTED * $mysql_mod_openopc_WORKING_TARGET), 2);
	$mysql_mod_openopc_WORKING_DIFFERENCE = varcharTOnumeric2(($mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION - $mysql_mod_openopc_WORKING_MASS_ACCEPTED),2);
	$mysql_mod_openopc_WORKING_RATE = varcharTOnumeric2(($mysql_mod_openopc_WORKING_COUNT / $mysql_mod_openopc_WORKING_DURATION_MINUTES), 2);
	$mysql_mod_openopc_WORKING_RATE_ACCEPTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_COUNT_ACCEPTED / $mysql_mod_openopc_WORKING_DURATION_MINUTES), 2);
	$mysql_mod_openopc_WORKING_MASS_AVERAGE = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_TOTAL / $mysql_mod_openopc_WORKING_COUNT), 2);
	$mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_ACCEPTED / $mysql_mod_openopc_WORKING_COUNT_ACCEPTED), 2);
	$mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_REJECTED / $mysql_mod_openopc_WORKING_COUNT_REJECTED), 2);
	$mysql_mod_openopc_WORKING_MASS_TOTAL = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_TOTAL * $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR), 2);
	$mysql_mod_openopc_WORKING_MASS_ACCEPTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_ACCEPTED * $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR), 2);
	$mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION = varcharTOnumeric2(($mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION * $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR), 2);
	if ($mysql_mod_openopc_WORKING_DIFFERENCE >= 0) {
		/* 		-- TAKEAWAY */
		$mysql_mod_openopc_WORKING_GIVEAWAY = 0.00;
		$mysql_mod_openopc_WORKING_GIVEAWAY_PCT = 0.00;
		$mysql_mod_openopc_WORKING_TAKEAWAY = varcharTOnumeric2((abs($mysql_mod_openopc_WORKING_DIFFERENCE)),2);
		$mysql_mod_openopc_WORKING_TAKEAWAY_PCT = varcharTOnumeric2((100 * $mysql_mod_openopc_WORKING_TAKEAWAY / ($mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION / $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR)), 4);
	} else {
		/* 		-- GIVEAWAY */
		$mysql_mod_openopc_WORKING_TAKEAWAY = 0.00;
		$mysql_mod_openopc_WORKING_TAKEAWAY_PCT = 0.00;
		$mysql_mod_openopc_WORKING_GIVEAWAY = varcharTOnumeric2((abs($mysql_mod_openopc_WORKING_DIFFERENCE)),2);
		$mysql_mod_openopc_WORKING_GIVEAWAY_PCT = varcharTOnumeric2((100 * $mysql_mod_openopc_WORKING_GIVEAWAY / ($mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION / $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR)), 4);
	}
	$mysql_mod_openopc_WORKING_MASS_REJECTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_REJECTED * $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR), 2);
	/* 		-- OPERATOR'S NAME */
	$mysql_seer_HOLDING_REALNAME = model_CHECKWEIGHER_determine_operator_name ($mysql_mod_openopc_HOLDING_OPERATOR);
	
	/* 	-- PLOT STANDARD DEVIATION */
	$post_BAR_GRAPH_TITLE = $multilang_CHECKWEIGHERMODEL_72;
	$post_BAR_GRAPH_HEIGHT = $SIGMA_BAR_GRAPH_HEIGHT;
	$post_RECORDS_EXAMINED = $mysql_mod_openopc_WORKING_COUNT;
	$recycle_array_ITEM = $mysql_mod_openopc_WORKING_MASS_ARRAY;
	$post_TARGET_TO_MEASURE_DEVIATION_FROM = $mysql_mod_openopc_WORKING_TARGET;
	list($apache_REPORT_STDEV_PLOT_MASS,$apache_DEVIATION_STANDARD) = core_standard_deviation_determination_and_plot();

	/*	-- EXPORT TO CSV */
	model_CHECKWEIGHER_export_csv_report_0_build();

	/*	-- UPDATE REPORT BUILD STATUS */
	$mysql_mod_openopc_WORKING_MASS_ARRAY = array();
	$mysql_mod_openopc_EXPORT_ME_PLEASE = 0;
	$mysql_mod_openopc_FORCE_CLOSE_OUT_BATCH = 0;

	/*	-- PRINT MARKUP */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='4' CLASS='hmicellborder1_ALT'>
										<B><U>".$mysql_mod_openopc_HOLDING_RECIPE."</U></B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_12."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_TARGET." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_34."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_TARE." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_44."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MIN." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_45."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MAX." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' VALIGN='TOP' COLSPAN='2'>
										<B>".$multilang_STATIC_DATESTAMP_START."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP' COLSPAN='2'>
										".$mysql_mod_openopc_WORKING_DATESTAMP_START."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_46."</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_COUNT." [".$CHECKWEIGHERMODEL_UM_UNIT."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_47."</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_TOTAL." [".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' VALIGN='TOP' COLSPAN='2'>
										<B>".$multilang_STATIC_DATESTAMP_END."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP' COLSPAN='2'>
										".$mysql_mod_openopc_WORKING_DATESTAMP_END."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_51."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_COUNT_ACCEPTED." [".$CHECKWEIGHERMODEL_UM_UNIT."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_51."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_ACCEPTED." [".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' VALIGN='TOP' COLSPAN='2'>
										<B>".$multilang_STATIC_DURATION_CAPS."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP' COLSPAN='2'>
										".$mysql_mod_openopc_WORKING_DURATION_MINUTES." [".$multilang_CHECKWEIGHERMODEL_50."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_52."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_COUNT_REJECTED." [".$CHECKWEIGHERMODEL_UM_UNIT."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_52."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_REJECTED." [".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]
									</TD>
								</TR>
								<TR>
									<TD ALIGN='RIGHT' VALIGN='TOP' COLSPAN='2'>
										<B>".$multilang_CHECKWEIGHERMODEL_81."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP' COLSPAN='2'>
										".$mysql_seer_HOLDING_REALNAME."<BR>
										[".$mysql_mod_openopc_HOLDING_OPERATOR."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_70."</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_RATE." [".$CHECKWEIGHERMODEL_UM_UNIT."/".$multilang_CHECKWEIGHERMODEL_50."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_48."</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_AVERAGE." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_51."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_RATE_ACCEPTED." [".$CHECKWEIGHERMODEL_UM_UNIT."/".$multilang_CHECKWEIGHERMODEL_50."]
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_51."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B>".$multilang_CHECKWEIGHERMODEL_52."</B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD COLSPAN='5'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='500' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD COLSPAN='5' VALIGN='MIDDLE' ALIGN='CENTER'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_74."</U></B><BR>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$multilang_CHECKWEIGHERMODEL_77."</B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION."</B> [".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$multilang_CHECKWEIGHERMODEL_78."</B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$mysql_mod_openopc_WORKING_MASS_ACCEPTED."</B> [".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$multilang_CHECKWEIGHERMODEL_79."</B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$mysql_mod_openopc_WORKING_DIFFERENCE."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$multilang_CHECKWEIGHERMODEL_75."</B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$mysql_mod_openopc_WORKING_GIVEAWAY."</B> [".$CHECKWEIGHERMODEL_UM_MASS."] (( ".$mysql_mod_openopc_WORKING_GIVEAWAY_PCT." [%] ))
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$multilang_CHECKWEIGHERMODEL_76."</B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B>".$mysql_mod_openopc_WORKING_TAKEAWAY."</B> [".$CHECKWEIGHERMODEL_UM_MASS."] (( ".$mysql_mod_openopc_WORKING_TAKEAWAY_PCT." [%] ))
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD COLSPAN='5'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='500' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9' VALIGN='TOP' ALIGN='CENTER'>
										".$apache_REPORT_STDEV_PLOT_MASS."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
	if ( ($mysql_mod_openopc_WORKING_COUNT_REJECTED > 0) && ($mysql_ENTRY_DISPLAY_REJECTS == 'YES') ) {
								/* REJECTS PRESENT - POST INFO */
								$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='5'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='500' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='5' VALIGN='MIDDLE' ALIGN='CENTER'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_73."</U></B><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_STATIC_DATESTAMP_CAPS."</U></B><BR>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_61."</U></B><BR>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								";
		$mysql_mod_openopc_REJECT_INDEX = 1;
		while ($mysql_mod_openopc_REJECT_INDEX <= $mysql_mod_openopc_WORKING_COUNT_REJECTED) {
			/* TOGGLE ROW COLOR FOR EASY VIEWING */
			$my_row_bgcolor_to_use = core_row_color_flip_flop();
			/* ADD TO REJECT OUTPUT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3' ".$my_row_bgcolor_to_use.">
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2' ".$my_row_bgcolor_to_use.">
										".$mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP[$mysql_mod_openopc_REJECT_INDEX]."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2' ".$my_row_bgcolor_to_use.">
										".$mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS[$mysql_mod_openopc_REJECT_INDEX]."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' BGCOLOR='#FF8866'>
										".$multilang_CHECKWEIGHERMODEL_52."
									</TD>
									<TD ".$my_row_bgcolor_to_use.">
										<BR>
									</TD>
								</TR>
								";
			/* INDEX */
			$mysql_mod_openopc_REJECT_INDEX = $mysql_mod_openopc_REJECT_INDEX + 1;
		}
	} else {
		/* pass */
	}
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
}

?>
