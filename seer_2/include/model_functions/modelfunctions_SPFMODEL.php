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
S.E.E.R. MODEL FUNCTIONS FILE (SPFMODEL)
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
function model_SPF_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_VOLUME, $SPFMODEL_UM_POWER;

	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_15, $multilang_STATIC_DATESTAMP_START, $multilang_STATIC_DATESTAMP_END, $multilang_SPFMODEL_140, $multilang_SPFMODEL_141, $multilang_SPFMODEL_142, $multilang_SPFMODEL_131, $multilang_SPFMODEL_17;

	/* EXECUTE */
	/* -- MACHINE_NAME, DATESTAMP_START, DATESTAMP_END, SUPPLY_FLOW_TOTAL, DESTINATION1_FLOW_TOTAL, DESTINATION2_FLOW_TOTAL, POWER_USE_TOTAL, ALARM_COUNT */
	$seer_EXPORT_CONTENT = $multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_START.$seer_CSV_DELINEATION.$multilang_STATIC_DATESTAMP_END.$seer_CSV_DELINEATION.$multilang_SPFMODEL_140." [".$SPFMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_141." [".$SPFMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_142." [".$SPFMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_131." [".$SPFMODEL_UM_POWER."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_17.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_ENTRY_MACHINENAME, $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, $mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_totalized_POWER, $alarm_COUNT;

	/* EXECUTE */
	/* -- MACHINE_NAME, DATESTAMP_START, DATESTAMP_END, SUPPLY_FLOW_TOTAL, DESTINATION1_FLOW_TOTAL, DESTINATION2_FLOW_TOTAL, POWER_USE_TOTAL, ALARM_COUNT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_query_START_DATESTAMP.$seer_CSV_DELINEATION.$mysql_query_END_DATESTAMP.$seer_CSV_DELINEATION.$mysql_totalized_SOURCE_FLOW.$seer_CSV_DELINEATION.$mysql_totalized_DESTINATION1_FLOW.$seer_CSV_DELINEATION.$mysql_totalized_DESTINATION2_FLOW.$seer_CSV_DELINEATION.$mysql_totalized_POWER.$seer_CSV_DELINEATION.$alarm_COUNT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_SPF_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_1_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_POWER;

	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_15, $multilang_SPFMODEL_69, $multilang_STATIC_START_TIME, $multilang_STATIC_END_TIME, $multilang_STATIC_DURATION_CAPS, $multilang_STATIC_DURATION_IN_SECONDS, $multilang_SPFMODEL_131;

	/* EXECUTE */
	/* -- MACHINE, STATE, DATESTAMP_START, DATESTAMP_END, DURATION_READABLE, DURATION_UNIXTIME, POWER_TOTAL */
	$seer_EXPORT_CONTENT = $multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_SPFMODEL_69.$seer_CSV_DELINEATION.$multilang_STATIC_START_TIME.$seer_CSV_DELINEATION.$multilang_STATIC_END_TIME.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION_CAPS.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION_IN_SECONDS.$seer_CSV_DELINEATION.$multilang_SPFMODEL_131." [".$SPFMODEL_UM_POWER."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_1_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $MACHINE_NAME_EXAMINED, $STATE_EXAMINED_FRIENDLY, $DATESTAMPSTART_EXAMINED, $DATESTAMPEND_EXAMINED, $DURATION_EXAMINED, $DURATION_EXAMINED_SECONDS, $POWERUSED_EXAMINED;

	/* EXECUTE */
	/* -- MACHINE, LINE BEING CLEANED, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME, POWER_TYPE, POWER_TOTAL */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$MACHINE_NAME_EXAMINED.$seer_CSV_DELINEATION.$STATE_EXAMINED_FRIENDLY.$seer_CSV_DELINEATION.$DATESTAMPSTART_EXAMINED.$seer_CSV_DELINEATION.$DATESTAMPEND_EXAMINED.$seer_CSV_DELINEATION.$DURATION_EXAMINED.$seer_CSV_DELINEATION.$DURATION_EXAMINED_SECONDS.$seer_CSV_DELINEATION.$POWERUSED_EXAMINED.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 2 - ZERO */
/* -- clear csv content */
function model_SPF_export_csv_report_2_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_2_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_SPFMODEL_15, $multilang_SPFMODEL_69, $multilang_SPFMODEL_18, $multilang_SPFMODEL_17, $multilang_SPFMODEL_34;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STATE, HRS_SINCE_CLEAN, ALARMS, TURBIDITY */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_SPFMODEL_69.$seer_CSV_DELINEATION.$multilang_SPFMODEL_18.$seer_CSV_DELINEATION.$multilang_SPFMODEL_17.$seer_CSV_DELINEATION.$multilang_SPFMODEL_34." [%]".$seer_CSV_ENDOFLINE_HOLDING;

}

/* EXPORT TO CSV - REPORT 2 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_2_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_2_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $mysql_mod_openopc_WORKING_STATE_FRIENDLY, $mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN, $mysql_mod_openopc_WORKING_ALARM_FRIENDLY, $mysql_mod_openopc_WORKING_TURBIDITY;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STATE, HRS_SINCE_CLEAN, LEVEL_PCT, LEVEL_MASS, LEVEL_VOLUME, LEVEL_DENSITY */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_STATE_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_ALARM_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TURBIDITY.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 3 - ZERO */
/* -- clear csv content */
function model_SPF_export_csv_report_3_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_3_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_FLOW, $SPFMODEL_UM_TEMPERATURE, $SPFMODEL_UM_PRESSURE, $SPFMODEL_UM_VOLUME, $SPFMODEL_CONCENTRATION_RATIO_DIVIDED_BY, $SPFMODEL_UM_POWER_RATE, $SPFMODEL_UM_POWER, $SPFMODEL_UM_ROTATIONAL_SPEED;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP_CAPS, $multilang_SPFMODEL_15, $multilang_SPFMODEL_16, $multilang_SPFMODEL_69, $multilang_SPFMODEL_17, $multilang_SPFMODEL_34, $multilang_SPFMODEL_27, $multilang_SPFMODEL_28, $multilang_SPFMODEL_29, $multilang_SPFMODEL_30, $multilang_SPFMODEL_31, $multilang_SPFMODEL_32, $multilang_SPFMODEL_140, $multilang_SPFMODEL_141, $multilang_SPFMODEL_142, $multilang_SPFMODEL_33, $multilang_SPFMODEL_131, $multilang_SPFMODEL_36, $multilang_SPFMODEL_41, $multilang_SPFMODEL_43, $multilang_SPFMODEL_42, $multilang_SPFMODEL_39, $multilang_SPFMODEL_40, $multilang_SPFMODEL_37,  $multilang_SPFMODEL_38, $multilang_SPFMODEL_18;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE_NAME, MACHINE_TYPE_FRIENDLY, STATE, ALARM_FRIENDLY, TURBIDITY, SOURCE_FRIENDLY, DESTINATION1_FRIENDLY, DESTINATION2_FRIENDLY, SOURCE_FLOW, DESTINATION1_FLOW, DESTINATION2_FLOW, SOURCE_DELTA, DESTINATION1_DELTA, DESTINATION2_DELTA, SOURCE_TOTAL_FLOW, DESTINATION1_TOTAL_FLOW, DESTINATION2_TOTAL_FLOW, POWER, POWER_TOTAL, BOWL_MOTOR_RPM, BASELINEPRESSURE, CENCENTRATION_RATIO, CONCENTRATION_VALVE_POSITION, PRESSURE_RAW, PRESSURE_PASTEURIZE, TEMPERATURE_INLET, TEMPERATURE_PASTEURIZE, HRS_SINCE_CLEAN */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP_CAPS.$seer_CSV_DELINEATION.$multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_SPFMODEL_16.$seer_CSV_DELINEATION.$multilang_SPFMODEL_69.$seer_CSV_DELINEATION.$multilang_SPFMODEL_17.$seer_CSV_DELINEATION.$multilang_SPFMODEL_34." [%]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_27.$seer_CSV_DELINEATION.$multilang_SPFMODEL_28.$seer_CSV_DELINEATION.$multilang_SPFMODEL_29.$seer_CSV_DELINEATION.$multilang_SPFMODEL_30." [".$SPFMODEL_UM_FLOW."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_31." [".$SPFMODEL_UM_FLOW."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_32." [".$SPFMODEL_UM_FLOW."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_140." [".$SPFMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_141." [".$SPFMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_142." [".$SPFMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_33." [".$SPFMODEL_UM_POWER_RATE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_131." [".$SPFMODEL_UM_POWER."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_36." [".$SPFMODEL_UM_ROTATIONAL_SPEED."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_41." [".$SPFMODEL_UM_PRESSURE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_43." [ x / ".$SPFMODEL_CONCENTRATION_RATIO_DIVIDED_BY."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_42." [%]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_39." [".$SPFMODEL_UM_PRESSURE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_40." [".$SPFMODEL_UM_PRESSURE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_37." [".$SPFMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_38." [".$SPFMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_18.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 3 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_3_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_3_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_MACHINE_NAME, $mysql_mod_openopc_WORKING_MACHINE_TYPE_FRIENDLY, $mysql_mod_openopc_WORKING_STATE_FRIENDLY, $mysql_mod_openopc_WORKING_ALARM_FRIENDLY, $mysql_mod_openopc_WORKING_TURBIDITY, $mysql_mod_openopc_WORKING_SOURCE_FRIENDLY, $mysql_mod_openopc_WORKING_DESTINATION1_FRIENDLY, $mysql_mod_openopc_WORKING_DESTINATION2_FRIENDLY, $mysql_mod_openopc_WORKING_SOURCE_FLOW, $mysql_mod_openopc_WORKING_DESTINATION1_FLOW, $mysql_mod_openopc_WORKING_DESTINATION2_FLOW, $mysql_totalized_SOURCE_FLOW, $mysql_totalized_DESTINATION1_FLOW, $mysql_totalized_DESTINATION2_FLOW, $mysql_mod_openopc_WORKING_POWER, $mysql_totalized_POWER, $mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM, $mysql_mod_openopc_WORKING_BASELINEPRESSURE, $mysql_mod_openopc_WORKING_CONCENTRATION_RATIO, $mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION, $mysql_mod_openopc_WORKING_PRESSURE_RAW, $mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE, $mysql_mod_openopc_WORKING_TEMPERATURE_INLET, $mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE, $mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE_NAME, MACHINE_TYPE_FRIENDLY, STATE_FRIENDLY, ALARM_FRIENDLY, TURBIDITY, SOURCE_FRIENDLY, DESTINATION1_FRIENDLY, DESTINATION2_FRIENDLY, SOURCE_FLOW, DESTINATION1_FLOW, DESTINATION2_FLOW, SOURCE_TOTAL_FLOW, DESTINATION1_TOTAL_FLOW, DESTINATION2_TOTAL_FLOW, POWER, POWER_TOTAL, BOWL_MOTOR_RPM, BASELINEPRESSURE, CENCENTRATION_RATIO, CONCENTRATION_VALVE_POSITION, PRESSURE_RAW, PRESSURE_PASTEURIZE, TEMPERATURE_INLET, TEMPERATURE_PASTEURIZE, HRS_SINCE_CLEAN */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MACHINE_NAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MACHINE_TYPE_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_STATE_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_ALARM_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TURBIDITY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_SOURCE_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DESTINATION1_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DESTINATION2_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_SOURCE_FLOW.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DESTINATION1_FLOW.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DESTINATION2_FLOW.$seer_CSV_DELINEATION.$mysql_totalized_SOURCE_FLOW.$seer_CSV_DELINEATION.$mysql_totalized_DESTINATION1_FLOW.$seer_CSV_DELINEATION.$mysql_totalized_DESTINATION2_FLOW.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_POWER.$seer_CSV_DELINEATION.$mysql_totalized_POWER.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_BASELINEPRESSURE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PRESSURE_RAW.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TEMPERATURE_INLET.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 4 - ZERO */
/* -- clear csv content */
function model_SPF_export_csv_report_4_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_4_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_WATER;

	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_15, $multilang_SPFMODEL_126, $multilang_SPFMODEL_21, $multilang_STATIC_START_TIME, $multilang_STATIC_END_TIME, $multilang_STATIC_DURATION_CAPS, $multilang_STATIC_DURATION_IN_SECONDS, $multilang_SPFMODEL_22;

	/* EXECUTE */
	/* -- MACHINE, LINE BEING CLEANED, WATER TYPE, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME, WATER_USAGE */
	$seer_EXPORT_CONTENT = $multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_SPFMODEL_126.$seer_CSV_DELINEATION.$multilang_SPFMODEL_21.$seer_CSV_DELINEATION.$multilang_STATIC_START_TIME.$seer_CSV_DELINEATION.$multilang_STATIC_END_TIME.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION_CAPS.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION_IN_SECONDS.$seer_CSV_DELINEATION.$multilang_SPFMODEL_22." [".$SPFMODEL_UM_WATER."]".$seer_CSV_ENDOFLINE_HOLDING;

}

/* EXPORT TO CSV - REPORT 4 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_4_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_4_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_unixtime;

	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$CIPNAME_EXAMINED, $WATERUSED_EXAMINED, $LINEBEINGCLEANED_EXAMINED_FRIENDLY, $WATERTYPE_EXAMINED_FRIENDLY, $DATESTAMPSTART_EXAMINED, $DATESTAMPEND_EXAMINED, $DURATION_EXAMINED;

	/* EXECUTE */
	/* -- MACHINE, LINE BEING CLEANED, WATER TYPE, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME, WATER_USAGE */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$CIPNAME_EXAMINED.$seer_CSV_DELINEATION.$LINEBEINGCLEANED_EXAMINED_FRIENDLY.$seer_CSV_DELINEATION.$WATERTYPE_EXAMINED_FRIENDLY.$seer_CSV_DELINEATION.$DATESTAMPSTART_EXAMINED.$seer_CSV_DELINEATION.$DATESTAMPEND_EXAMINED.$seer_CSV_DELINEATION.$DURATION_EXAMINED.$seer_CSV_DELINEATION.$apache_unixtime.$seer_CSV_DELINEATION.$WATERUSED_EXAMINED.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 5 - ZERO */
/* -- clear csv content */
function model_SPF_export_csv_report_5_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_5_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_TEMPERATURE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP_CAPS, $multilang_SPFMODEL_15, $multilang_SPFMODEL_67, $multilang_SPFMODEL_68, $multilang_STATIC_CERTIFIED, $multilang_STATIC_CERTIFIED_BY, $multilang_STATIC_COMMENT;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STEP, TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP_CAPS.$seer_CSV_DELINEATION.$multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_SPFMODEL_67.$seer_CSV_DELINEATION.$multilang_SPFMODEL_68." [".$SPFMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED.$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED_BY.$seer_CSV_DELINEATION.$multilang_STATIC_COMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 5 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_5_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_5_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $MODEL_WORKING_CIP_STEP_FRIENDLY, $mysql_mod_openopc_WORKING_CIP_TEMP, $mysql_mod_openopc_WORKING_CERTIFIED, $SPFMODEL_CERTIFIEDUSERREALNAME, $mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STEP, TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$MODEL_WORKING_CIP_STEP_FRIENDLY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CIP_TEMP.$seer_CSV_DELINEATION.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIED.$seer_CSV_DELINEATION.$SPFMODEL_CERTIFIEDUSERREALNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 6 - ZERO */
/* -- clear csv content */
function model_SPF_export_csv_report_6_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_6_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_TEMPERATURE, $SPFMODEL_UM_FLOW;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP_CAPS, $multilang_SPFMODEL_15, $multilang_SPFMODEL_67, $multilang_SPFMODEL_68, $multilang_SPFMODEL_24, $multilang_SPFMODEL_21;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STEP, TEMP, CIP_FLOW, WATER_TYPE */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP_CAPS.$seer_CSV_DELINEATION.$multilang_SPFMODEL_15.$seer_CSV_DELINEATION.$multilang_SPFMODEL_67.$seer_CSV_DELINEATION.$multilang_SPFMODEL_68." [".$SPFMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_24." [".$SPFMODEL_UM_FLOW."]".$seer_CSV_DELINEATION.$multilang_SPFMODEL_21.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 6 - BUILD */
/* -- add to (build) csv content */
function model_SPF_export_csv_report_6_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_export_csv_report_6_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $SPFMODEL_WORKING_STEP, $mysql_mod_openopc_WORKING_CIP_TEMP, $mysql_mod_openopc_WORKING_CIP_FLOW, $SPFMODEL_WORKING_WATERTYPE;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STEP, TEMP, WATER_TYPE */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$SPFMODEL_WORKING_STEP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CIP_TEMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CIP_FLOW.$seer_CSV_DELINEATION.$SPFMODEL_WORKING_WATERTYPE.$seer_CSV_ENDOFLINE_HOLDING;
}

/* TIME SINCE CLEAN HIGHLIGHT */
/* -- highlights a cell with a background indicative of the time since the machine */
/*    was last cleaned */
function model_SPF_time_since_clean_highlight ($TIMESINCECLEAN)
{
	/* CALL THIS FUNCTION WITH */
	/* $my_background_color = model_SPF_time_since_clean_highlight($TIMESINCECLEAN); */

	/* GLOBALIZE VARIABLES */
	/* 	-- MODEL SPECIFIC */
	global $SPFMODEL_CLEANING_PASTDUE, $SPFMODEL_CLEANING_ALARM, $SPFMODEL_CLEANING_WARNING;

	/* EXECUTE */
	if ( $TIMESINCECLEAN <= $SPFMODEL_CLEANING_PASTDUE ) {
		$SPFMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#FF8866";
		/* alarm = red */
		if ( $TIMESINCECLEAN <= $SPFMODEL_CLEANING_ALARM ) {
			$SPFMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#FFAA33";
			/* warning = orange or yellow */
			if ( $TIMESINCECLEAN <= $SPFMODEL_CLEANING_WARNING ) {
				$SPFMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#CCFF66";
				/* good = green */
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}
	} else {
		$SPFMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#FF8866";
		/* lockdown = red (formerly black, however issues with font color */
		/* and limited visibility resulted in change to red */
	}

	/* RETURN VALUES */
	return $SPFMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND;
}

/* REPORT 3 - BUILD BODY */
/* -- builds the markup for body of report 3 */
function model_SPF_build_report_3_body ()
{
	/* CALL THIS FUNCTION WITH... */
	/* $model_SPF_build_report_3_body(); */

	/* GLOBALIZE VARIABLES */

	/*	-- APACHE */
	global $apache_REPORT_RECORDENTRY, $apache_SWITCH_ROW_COLOR, $apache_REPORT_RECORDENTRY_RECORD_GUTS;

	/*	-- SEER */
	global $seer_DISPLAY_ALARMS;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_SOURCE, $SPFMODEL_DESTINATION, $SPFMODEL_UM_VOLUME, $SPFMODEL_UM_POWER;

	/*	-- MYSQL */
	global $alarm_COUNT, $alarm_DATESTAMP_START, $alarm_DATESTAMP_END, $alarm_NAME, $mysql_totalized_POWER, $mysql_totalized_DESTINATION2_FLOW, $mysql_holding_DESTINATION2_FRIENDLY, $mysql_totalized_DESTINATION1_FLOW, $mysql_holding_DESTINATION1_FRIENDLY, $mysql_totalized_SOURCE_FLOW, $mysql_holding_SOURCE_FRIENDLY, $mysql_holding_CYCLE_START, $mysql_holding_CYCLE_END, $mysql_holding_SOURCE, $mysql_holding_DESTINATION1, $mysql_holding_DESTINATION2, $mysql_holding_SOURCE_FRIENDLY, $mysql_holding_DESTINATION1_FRIENDLY, $mysql_holding_DESTINATION2_FRIENDLY;

	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_139, $multilang_SPFMODEL_98, $multilang_SPFMODEL_99, $multilang_SPFMODEL_17, $multilang_SPFMODEL_148, $multilang_SPFMODEL_147, $multilang_SPFMODEL_138, $multilang_SPFMODEL_131, $multilang_SPFMODEL_146, $multilang_SPFMODEL_29, $multilang_SPFMODEL_28, $multilang_SPFMODEL_27, $multilang_SPFMODEL_137, $multilang_STATIC_DATESTAMP_START, $multilang_STATIC_DATESTAMP_END; 

	/* EXECUTE */
	/* -- ID THE SOURCE AND DESTINATION1/2 */
	$mysql_holding_SOURCE_FRIENDLY = $SPFMODEL_SOURCE[$mysql_holding_SOURCE];
	$mysql_holding_DESTINATION1_FRIENDLY = $SPFMODEL_DESTINATION[$mysql_holding_DESTINATION1];
	$mysql_holding_DESTINATION2_FRIENDLY = $SPFMODEL_DESTINATION[$mysql_holding_DESTINATION2];					

	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='CENTER'>
										<IMG SRC='/seer_2/img/seer_gear_small.png' ALT='INSTANCE'>
									</TD>
									<TD CLASS='hmicellborder1_ALT_L' COLSPAN='10' VALIGN='TOP'>
										<P CLASS='STANDARDTABLETEXTSIZE'>
											<B><I>".$multilang_SPFMODEL_137."...</I></B><BR>
											<BR>
											".$multilang_STATIC_DATESTAMP_START." -- ".$mysql_holding_CYCLE_START."<BR>
											".$multilang_STATIC_DATESTAMP_END." -- ".$mysql_holding_CYCLE_END."<BR>
										</P>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<P CLASS='STANDARDTABLETEXTSIZE'>
											<B><I>".$multilang_SPFMODEL_146."</I></B>...
										</P>
									</TD>
									<TD VALIGN='TOP' COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_27.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_totalized_SOURCE_FLOW."
									</TD>
									<TD VALIGN='TOP'>
										[".$SPFMODEL_UM_VOLUME."]
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										-- <I>".$mysql_holding_SOURCE_FRIENDLY."</I>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_28.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_totalized_DESTINATION1_FLOW."
									</TD>
									<TD VALIGN='TOP'>
										[".$SPFMODEL_UM_VOLUME."]
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										-- <I>".$mysql_holding_DESTINATION1_FRIENDLY."</I>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_29.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_totalized_DESTINATION2_FLOW."
									</TD>
									<TD VALIGN='TOP'>
										[".$SPFMODEL_UM_VOLUME."]
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										-- <I>".$mysql_holding_DESTINATION2_FRIENDLY."</I>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<P CLASS='STANDARDTABLETEXTSIZE'>
											<B><I>".$multilang_SPFMODEL_148."</I></B>...
										</P>
									</TD>
									<TD VALIGN='TOP' COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_131.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_totalized_POWER."
									</TD>
									<TD VALIGN='TOP'>
										[".$SPFMODEL_UM_POWER."]
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<P CLASS='STANDARDTABLETEXTSIZE'>
											<B><I>".$multilang_SPFMODEL_147."</I></B>...
										</P>
									</TD>
									<TD VALIGN='TOP' COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_27.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".varcharTOnumeric2($mysql_totalized_SOURCE_FLOW/$mysql_totalized_POWER)."
									</TD>
									<TD VALIGN='TOP' COLSPAN='4'>
										[".$SPFMODEL_UM_VOLUME." / ".$SPFMODEL_UM_POWER."]
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_28.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".varcharTOnumeric2($mysql_totalized_DESTINATION1_FLOW/$mysql_totalized_POWER)."
									</TD>
									<TD VALIGN='TOP' COLSPAN='4'>
										[".$SPFMODEL_UM_VOLUME." / ".$SPFMODEL_UM_POWER."]
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='6'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B>".$multilang_SPFMODEL_29.":</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".varcharTOnumeric2($mysql_totalized_DESTINATION2_FLOW/$mysql_totalized_POWER)."
									</TD>
									<TD VALIGN='TOP' COLSPAN='4'>
										[".$SPFMODEL_UM_VOLUME." / ".$SPFMODEL_UM_POWER."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='CENTER'>
										<IMG SRC='/seer_2/img/seer_gear_alarm.png' ALT='INSTANCE'>
									</TD>
									<TD CLASS='hmicellborder1_ALT_ALARM_L' COLSPAN='10' VALIGN='TOP'>
										<P CLASS='STANDARDTABLETEXTSIZE'>
											<B><I>".$multilang_SPFMODEL_138."...</I> (".$alarm_COUNT.")</B><BR>
										</P>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								";
	if ( ($alarm_COUNT != 0) && ($seer_DISPLAY_ALARMS == 'YES') ) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='4'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='2'>
										<U>".$multilang_SPFMODEL_98."</U>
									</TD>
									<TD VALIGN='TOP' COLSPAN='2'>
										<U>".$multilang_SPFMODEL_99."</U>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<U>".$multilang_SPFMODEL_17."</U>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								";
		$alarm_COUNT_index = 1;
		$apache_SWITCH_ROW_COLOR = 0;
		while ($alarm_COUNT_index <= $alarm_COUNT) {
			/* FLIP FLOP ROW COLOR */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();
			/* POST ALARM UNIQUE INSTANCES */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD VALIGN='TOP' COLSPAN='4'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='2' ".$apache_REPORT_ROW_BGCOLOR_USE.">
										".$alarm_DATESTAMP_START[$alarm_COUNT_index]."
									</TD>
									<TD VALIGN='TOP' COLSPAN='2' ".$apache_REPORT_ROW_BGCOLOR_USE.">
										".$alarm_DATESTAMP_END[$alarm_COUNT_index]."
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT' ".$apache_REPORT_ROW_BGCOLOR_USE.">
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3' ".$apache_REPORT_ROW_BGCOLOR_USE.">
										".$alarm_NAME[$alarm_COUNT_index]."
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
								</TR>
								";
			$alarm_COUNT_index = $alarm_COUNT_index + 1;
		}
		/* THROW IN A DIVIDER BAR */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='8'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='540' ALT='DIVIDER'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
	} else {
		if ($alarm_COUNT == 0) {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD VALIGN='TOP' COLSPAN='4'>
										<BR>
									</TD>
									<TD VALIGN='TOP' COLSPAN='8' ".$apache_REPORT_ROW_BGCOLOR_USE.">
										<B>".$multilang_SPFMODEL_139."</B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='8'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='540' ALT='DIVIDER'><BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
		} else {
			/* pass */
		}
	}

	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								".$apache_REPORT_RECORDENTRY_RECORD_GUTS."
								<TR>			
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='13' ALIGN='CENTER'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								";
}

/* REPORT 4 - BUILD BODY */
/* --  redirects to CIPMODEL REPORT 0 BUILD BODY */
function model_SPF_build_report_4_body($SPFMODEL_WATER_TYPE_COUNT_ADJUSTED, $SPFMODEL_CIP_WATER_TYPE, $multilang_SPFMODEL_115)
{
	model_CIP_build_report_0_body($SPFMODEL_WATER_TYPE_COUNT_ADJUSTED, $SPFMODEL_CIP_WATER_TYPE, $multilang_SPFMODEL_115);
}

/* WASH TOTALS (ALARMS AND SUCH) - REPORT 6 */
/* -- post totals for a wash instance or cycle */
function model_SPF_wash_totals_report_6 ($post_CURRENT_START_TIME,$post_CURRENT_END_TIME,$post_CURRENT_WATER_USAGE,$post_CURRENT_ALARM_COUNT,$post_CURRENT_ALARM_ARRAY,$post_CURRENT_ALARM_DURING_STEP_ARRAY)
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_MARKUP = model_SPF_wash_totals_report_6($post_CURRENT_START_TIME,$post_CURRENT_END_TIME,$post_CURRENT_WATER_USAGE,$post_CURRENT_ALARM_COUNT,$post_CURRENT_ALARM_ARRAY,$post_CURRENT_ALARM_DURING_STEP_ARRAY); */
	/* where...
		$post_CURRENT_START_TIME = start time of wash cycle
		$post_CURRENT_END_TIME = end time of wash cycle
		$post_CURRENT_WATER_USAGE = current water used for cycle
		$post_CURRENT_ALARM_COUNT = integer count of alarms for cycle
		$post_CURRENT_ALARM_ARRAY = array of alarm identification
		$post_CURRENT_ALARM_DURING_STEP_ARRAY = array of steps during which alarms (in ALARM_ARRAY) occurred
	*/

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_115, $multilang_STATIC_START_TIME, $multilang_STATIC_END_TIME, $multilang_SPFMODEL_116, $multilang_SPFMODEL_118, $multilang_SPFMODEL_117;

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_UM_WATER;

	/* EXECUTE */
	/* -- DURATION OF WASH */
	list($post_CURRENT_LENGTH_OF_WASH,$post_CURRENT_LENGTH_OF_WASH_UNIXTIME) = timeDuration($post_CURRENT_START_TIME,$post_CURRENT_END_TIME);
	/* -- HAVE WE GOT ANY ALARMS? */
	if ( $post_CURRENT_ALARM_COUNT > 0 ) {
		/* -- BUILD ALARM LIST MARKUP */
		$post_REPORT_TOTAL_ALARM_RUNDOWN = "";
		$post_CURRENT_ALARM_COUNT_index = 1;
		while ( $post_CURRENT_ALARM_COUNT_index <= $post_CURRENT_ALARM_COUNT ) {
			$post_REPORT_TOTAL_ALARM_RUNDOWN = $post_REPORT_TOTAL_ALARM_RUNDOWN."
										[".$post_CURRENT_ALARM_COUNT_index."] ".$post_CURRENT_ALARM_ARRAY[$post_CURRENT_ALARM_COUNT_index]." -- ".$post_CURRENT_ALARM_DURING_STEP_ARRAY[$post_CURRENT_ALARM_COUNT_index]."<BR>
										";
			$post_CURRENT_ALARM_COUNT_index = $post_CURRENT_ALARM_COUNT_index + 1;
		}
	} else {
		/* -- BLANK OUT THE ALARM LIST MARKUP */
		$post_REPORT_TOTAL_ALARM_RUNDOWN = "";
	}
	/* -- ASSEMBLE FINAL MARKUP TO RETURN */
	$post_MARKUP_TO_RETURN = "
								<TR>
									<TD ALIGN='RIGHT' COLSPAN='3'>
										<BR>
										<I>".$multilang_SPFMODEL_115."...</I>
									</TD>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										<B>".$multilang_STATIC_START_TIME.":</B> ".$post_CURRENT_START_TIME."<BR>
										<B>".$multilang_STATIC_END_TIME.":</B> ".$post_CURRENT_END_TIME."<BR>
										<B>".$multilang_SPFMODEL_116.":</B> ".$post_CURRENT_LENGTH_OF_WASH."<BR>
										<BR>
										<B>".$multilang_SPFMODEL_118.":</B> ".$post_CURRENT_WATER_USAGE." [".$SPFMODEL_UM_WATER."]<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										<B>".$multilang_SPFMODEL_117.":</B><BR>
										<BR>
										".$post_REPORT_TOTAL_ALARM_RUNDOWN."
									</TD>
								</TR>
								";

	/* RETURN VARIABLES */
	return $post_MARKUP_TO_RETURN;
}

/* WASH TOTALS (ALARMS AND SUCH) - NULL - REPORT 6 */
/* -- post nothing (null record) for an empty or non-existant wash instance or cycle */
function model_SPF_wash_totals_report_6_null ()
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_MARKUP = model_SPF_wash_totals_report_6_null(); */

	/* EXECUTE */
	/* -- ASSEMBLE FINAL MARKUP TO RETURN */
	$post_MARKUP_TO_RETURN = "
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								";

	/* RETURN VARIABLES */
	return $post_MARKUP_TO_RETURN;
}

/* POST DIVIDER (SEPARATE) WASH INSTANCES AFTER THE TOTALS HAVE BEEN POSTED - REPORT 6 */
/* -- post divider at end of wash cycle data, and update some holding values */
function model_SPF_wash_totals_report_6_divider ($first_run_this_table,$post_CURRENT_STEP,$mysql_mod_openopc_WORKING_CIP_STEP,$post_CURRENT_WATER_USAGE,$mysql_mod_openopc_WORKING_CIP_WATER_USAGE,$mysql_mod_openopc_WORKING_DATESTAMP)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($post_MARKUP_TO_RETURN,$first_run_this_table,$post_CURRENT_WATER_USAGE,$post_CURRENT_STEP,$post_WORKING_ENDTIME) = model_SPF_wash_totals_report_6_divider($first_run_this_table,$post_CURRENT_STEP,$mysql_mod_openopc_WORKING_CIP_STEP,$post_CURRENT_WATER_USAGE,$mysql_mod_openopc_WORKING_CIP_WATER_USAGE,$mysql_mod_openopc_WORKING_DATESTAMP); */

	/* EXECUTE */
	/* -- UPDATE END TIME */
	$post_WORKING_ENDTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
	/* -- IF THIS IS NOT FIRST RUN, ADD DIVIDER */
	if ( $first_run_this_table > 0 ) {
		if ( $post_CURRENT_STEP > $mysql_mod_openopc_WORKING_CIP_STEP ) {
			$post_MARKUP_TO_RETURN = "
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='900' ALT='DIVIDER'><BR>
										<BR>
									</TD>
								</TR>
								";
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}
	/* -- SET STATUS SUCH THAT WE KNOW ANY SUBSEQUENT CYCLES ARE NOT FIRST RUN */
	$first_run_this_table = 1;
	/* -- SET THE CURRENT LINE BEING CLEANED (EXAMINED) TO THIS ONE */
	/*    AND UPDATE WATER USAGE */
	$post_CURRENT_WATER_USAGE = $mysql_mod_openopc_WORKING_CIP_WATER_USAGE;
	$post_CURRENT_STEP = $mysql_mod_openopc_WORKING_CIP_STEP;

	/* RETURN VARIABLES */
	return array($post_MARKUP_TO_RETURN,$first_run_this_table,$post_CURRENT_WATER_USAGE,$post_CURRENT_STEP,$post_WORKING_ENDTIME);
}

/* REQUIRE TURBIDITY SENSOR BE PRESENT */
/* -- given a machine's name, require that a turbidity sensor be present */
/*    or else trigger fault */
function model_SPF_require_turbidity_sensor ($MACHINENAME_BY_INTEGER)
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_require_turbidity_sensor($MACHINENAME_BY_INTEGER); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;

	/*	-- SEER MODEL SPECIFIC */
	global $SPFMODEL_TURBIDITY_SENSOR_PRESENT;

	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_113;

	/* EXECUTE */
	if ( $SPFMODEL_TURBIDITY_SENSOR_PRESENT[$MACHINENAME_BY_INTEGER] == 'YES' ) {
		/* pass */
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_SPFMODEL_113;
	}
}

/* CHECK FOR TURBIDITY SENSOR */
/* -- lack of one triggers fault  */
function model_SPF_check_for_turbidity_sensor_on_machine ($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED)
{
	/* CALL THIS FUNCTION WITH... */
	/* $MACHINENAME_BY_INTEGER = model_SPF_check_for_turbidity_sensor_on_machine($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED); */
	/* where...
		$MACHINENAME = literal text name of machine
		$MODEL_NAME = array of literal text names for the model (local instance) in question
		$MODEL_COUNT_ADJUSTED = the number of machines in the model (local instance)
		$MACHINENAME_BY_INTEGER = the returned logical value corresponding to the machine's name
	*/

	/* EXECUTE */
	if ( $seer_HMIACTION_FAULT == 0 ) {
		/* -- IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
		$MACHINENAME_BY_INTEGER = model_COMMON_identify_logical_value_from_name($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED);
		/* -- PREREGISTER THE MACHINE TYPE */
		model_SPF_require_turbidity_sensor($MACHINENAME_BY_INTEGER);
	} else {
		/* pass */
	}

	/* RETURN VALUES */
	return $MACHINENAME_BY_INTEGER;
}

/* LABEL COLUMNS FOR MANUAL REPORT ENTRY */
function model_SPF_label_columns_for_manual_report_entry ($seer_MANUAL_ENTRY_GROUP)
{
	/* CALL THIS FUNCTION WITH */
	/* $markup = model_SPF_label_columns_for_manual_report_entry($seer_MANUAL_ENTRY_GROUP); */

	/* GLOBALIZE VARIABLES */
	/*	-- MODEL SPECIFIC */
	global	$SPFMODEL_UM_TEMPERATURE, $SPFMODEL_UM_PRESSURE;

	/*	-- LANGUAGE */
	global	$multilang_SPFMODEL_37, $multilang_SPFMODEL_38, $multilang_SPFMODEL_39, $multilang_SPFMODEL_40, $multilang_SPFMODEL_66, $multilang_SPFMODEL_67, $multilang_SPFMODEL_68, $multilang_SPFMODEL_69;

	/* EXECUTE */
	if ( $seer_MANUAL_ENTRY_GROUP == 'A' ) {
		$apache_COLUMN_LABEL_ROW = "
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_66."</U></B>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_69."</U></B>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_67."</U></B>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_68." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
									</TR>
									";
	} else {
		/* pass */
	}
	if ( $seer_MANUAL_ENTRY_GROUP == 'B' ) {
		$apache_COLUMN_LABEL_ROW = "
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_66."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_69."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_39." [".$SPFMODEL_UM_PRESSURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_40." [".$SPFMODEL_UM_PRESSURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_37." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_38." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_67."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_68." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
									</TR>
									";
	} else {
		/* pass */
	}
	if ( $seer_MANUAL_ENTRY_GROUP == 'C' ) {
		$apache_COLUMN_LABEL_ROW = "
									<TR>
										<TD COLSPAN='8'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_66."</U></B>
										</TD>
										<TD COLSPAN='2' ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_69."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_37." [".$SPFMODEL_UM_PRESSURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_38." [".$SPFMODEL_UM_PRESSURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_39." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_SPFMODEL_40." [".$SPFMODEL_UM_TEMPERATURE."]</U></B>
										</TD>
									</TR>
									";
	} else {
		/* pass */
	}
	
	/* RETURN MARKUP */
	return $apache_COLUMN_LABEL_ROW;
}

/* IDENTIFY MACHINE TYPE FOR MANUAL REPORT ENTRY */
/* -- identify the preregistered machine type from the local options file, */
/*    along with the manual entry category that it falls into for record filling. */
function model_SPF_identify_machine_type_and_manual_record_entry ($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED)
{
	/* CALL THIS FUNCTION WITH */
	/* list($mysql_ENTRY_MACHINENAME_BY_INTEGER,$seer_MANUAL_ENTRY_GROUP,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES) = model_SPF_identify_machine_type_and_manual_record_entry($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;
	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES_PASTEURIZE, $SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES_OTHER;
	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_65;

	/* EXECUTE */
	/* -- IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
	$mysql_ENTRY_MACHINENAME_BY_INTEGER = model_COMMON_identify_logical_value_from_name($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED);
	/* -- PREREGISTER THE MACHINE TYPE */
	if ( ($SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER] == 50) || ($SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER] == 51) ) {
		$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES = $SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES_PASTEURIZE;
	} else {
		$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES = $SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES_OTHER;
	}
	/* -- GROUP THE MACHINE INTO A MANUAL ENTRY GROUP */
	$SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN = $SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER];
	$SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN = strval($SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN);
	$SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN_TEST = $SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN[strlen($SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN)-1];
	if ( ($SPFMODEL_MACHINE_CHECK_FOR_SELFCLEAN_TEST == '1') && ($SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER] != 51) ) {
		/* -- GROUP -A- */
		/* -- -- SELF-CLEANING NON-PASTEURIZER MACHINES */
		$seer_MANUAL_ENTRY_GROUP = "A";
	} else {
		if ( $SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER] == 51 ) {
			/* -- GROUP -B- */
			/* -- -- SELF-CLEANING PASTEURIZERS */
			$seer_MANUAL_ENTRY_GROUP = "B";
		} else {
			if ( $SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER] == 50 ) {
				/* -- GROUP -C- */
				/* -- -- NON-SELF-CLEANING PASTEURIZERS */
				$seer_MANUAL_ENTRY_GROUP = "C";
			} else {
				/* -- GROUP -D- */
				/* -- -- ALL OTHER MACHINES [WHICH DO NOT NEED CERTIFIED RECORDS] */
				$seer_MANUAL_ENTRY_GROUP = "D";
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_SPFMODEL_65;
			}
		}
	}

	/* RETURN VALUES */
	return array ($mysql_ENTRY_MACHINENAME_BY_INTEGER,$seer_MANUAL_ENTRY_GROUP,$SPFMODEL_MANUAL_RECORD_ENTRY_INTERVAL_MINUTES);
}

/* IDENTIFY MACHINE TYPE AND SELF CLEANING METHOD */
/* -- identify the preregistered machine type from the local options file, */
/*    along with the self cleaning status of the machine, and whether or not we should flag a self-clean fault */
function model_SPF_idenfity_machine_type_and_cleaning_method ($post_FAULT_IF_NOT_SELF_CLEAN,$mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_CIP_BY)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($MACHINENAME_BY_INTEGER,$MACHINE_TYPE,$MACHINE_CLEANED_BY) = model_SPF_idenfity_machine_type_and_cleaning_method($post_FAULT_IF_NOT_SELF_CLEAN,$mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_CIP_BY); */
	/* where...
		$post_FAULT_IF_NOT_SELF_CLEAN = "YES" or "NO" (shall we throw a fault if this is not a self clean machine?)
		$mysql_ENTRY_MACHINENAME = literal (text) machine name
		$SPFMODEL_NAME = array of machine literal names from localoptions file
		$SPFMODEL_COUNT_ADJUSTED = number of machines in local instance
		$SPFMODEL_MACHINE_TYPE_PREREGISTERED = array of machine pre-registered types
		$SPFMODEL_CIP_BY = array of cleaning methods for machines in localoptions file
	*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;
	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_25, $multilang_SPFMODEL_26;

	/* EXECUTE */
	/* -- IDENTIFY THE MACHINE IN THE OPTIONS ARRAY */
	$MACHINENAME_BY_INTEGER = model_COMMON_identify_logical_value_from_name($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED);
	$SPFMODEL_POLLED_MACHINE_TYPE = $SPFMODEL_MACHINE_TYPE_PREREGISTERED[$MACHINENAME_BY_INTEGER];
	$SPFMODEL_POLLED_MACHINE_TYPE = strval($SPFMODEL_POLLED_MACHINE_TYPE);
	/* -- CHECK FOR SELF CLEANING MACHINE */
	$SPFMODEL_CIP_CHECK_FOR_SELFCLEAN = $SPFMODEL_POLLED_MACHINE_TYPE[strlen($SPFMODEL_POLLED_MACHINE_TYPE)-1];
	if ( $SPFMODEL_CIP_CHECK_FOR_SELFCLEAN == '1' ) {
		/* pass */
	} else {
		/* -- ONLY TRY TO POST A FAULT IF WE HAVE NOT ALREADY FAULTED FOR A DIFFERENT REASON */
		if ( $seer_HMIACTION_FAULT == 0 ) {
			if ($post_FAULT_IF_NOT_SELF_CLEAN == 'YES') {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = "
												".$multilang_SPFMODEL_25."<BR>
												<BR>
												<I>".$multilang_SPFMODEL_26."</I><BR>
												<BR>
												-- <B>[ ".$SPFMODEL_CIP_BY[$MACHINENAME_BY_INTEGER]." ]</B>
												";
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}
	}
	$MACHINE_CLEANED_BY = $SPFMODEL_CIP_BY[$MACHINENAME_BY_INTEGER];

	/* RETURN VALUES */
	return array($MACHINENAME_BY_INTEGER,$MACHINE_TYPE,$MACHINE_CLEANED_BY);
}

/* CHECK FOR SELF CLEANING MACHINES IN THE ACTIVE MODEL (LOCAL INSTANCE) */
/* -- lack of one triggers a fault  */
function model_SPF_check_for_self_cleaning_machines_in_model ($SPFMODEL_NAME,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_COUNT_ADJUSTED)
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_check_for_self_cleaning_machines_in_model($SPFMODEL_NAME,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_COUNT_ADJUSTED); */
	/* where...
		$MODEL_NAME = array of literal text names for the model (local instance) in question
		$SPFMODEL_MACHINE_TYPE_PREREGISTERED = array of machine types for the model (local instance) in question
		$MODEL_COUNT_ADJUSTED = the number of machines in the model (local instance)
	*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;
	/*	-- LANGUAGE */
	global $multilang_SPFMODEL_125, $multilang_SPFMODEL_124, $multilang_SPFMODEL_25;

	/* EXECUTE */
	$seer_MODEL_MACHINES_CLEANED_BY = "";
	$seer_MODEL_CONTAINS_SELF_CLEANING_MACHINES = 0;
	$seer_array_index = 0;
	while ( $seer_array_index <= $SPFMODEL_COUNT_ADJUSTED ) {
		$mysql_ENTRY_MACHINENAME_BY_INTEGER = $seer_array_index;
		$SPFMODEL_POLLED_MACHINE_TYPE = $SPFMODEL_MACHINE_TYPE_PREREGISTERED[$mysql_ENTRY_MACHINENAME_BY_INTEGER];
		$SPFMODEL_POLLED_MACHINE_TYPE = strval($SPFMODEL_POLLED_MACHINE_TYPE);

		/* CHECK FOR SELF CLEANING MACHINE */
		$SPFMODEL_CIP_CHECK_FOR_SELFCLEAN = $SPFMODEL_POLLED_MACHINE_TYPE[strlen($SPFMODEL_POLLED_MACHINE_TYPE)-1];

		if ( $SPFMODEL_CIP_CHECK_FOR_SELFCLEAN == '1' ) {
			$seer_MODEL_CONTAINS_SELF_CLEANING_MACHINES = 1;
		} else {
			/* pass */
		}

		/* COMPILE A 'WHAT IS CLEANED BY WHAT' REFERENCE TABLE */
		$seer_MODEL_MACHINES_CLEANED_BY = $seer_MODEL_MACHINES_CLEANED_BY."
											".$SPFMODEL_NAME[$mysql_ENTRY_MACHINENAME_BY_INTEGER]." ".$multilang_SPFMODEL_125." ".$SPFMODEL_CIP_BY[$mysql_ENTRY_MACHINENAME_BY_INTEGER]."<BR>
											";
		$seer_array_index = $seer_array_index + 1;
	}

	/* EXAMINE THE RESULT OF OUR CHECK */

	if ( $seer_MODEL_CONTAINS_SELF_CLEANING_MACHINES == 1 ) {
		/* pass */
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_SPFMODEL_25."<BR>
					<BR>
					<I>".$multilang_SPFMODEL_124."</I><BR>
					<BR>".
					$seer_MODEL_MACHINES_CLEANED_BY."<BR>
					";
	}
}

/* BUILD CONTAINER FOR SPF POWER USAGE DISCRETE INSTANCES */
/* -- builds 4 arrays */
function model_SPF_power_usage_discrete_container_build ($mysql_mod_openopc_query_result,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_NAME)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($power,$power2,$power3,$power4,$discrete_power_instance_count) = model_SPF_power_usage_discrete_container_build($mysql_mod_openopc_query_result,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_NAME); */

	/* CONTAINER FOR POWER DISCRETE INSTANCES */
	/* -- NOTE - as a carryover from the WATER USAGE report, the 'type' variable is set */
	/* 	     In the case of POWER USAGE, this 'type' is statically set as '0', and defined */
	/*	     within this report explicitly */
	/* -- ARRAY #1 */
	/* -- -- power[INDEX]["MACHINE_NAME"] = MACHINE_NAME */
	/* -- -- power[INDEX]["STATE"] = STATE */
	/* -- -- power[INDEX]["DATESTAMPSTART"] = DATESTAMP START */
	/* -- -- power[INDEX]["DATESTAMPEND"] = DATESTAMP END */
	/* -- -- power[INDEX]["POWERSTART"] = POWER METER AT START */
	/* -- -- power[INDEX]["POWEREND"] = POWER METER AT END */
	/* -- -- power[INDEX]["POWERUSED"] = POWER USED */
	/* -- ARRAY #2 */
	/* -- -- power2["MACHINE_NAME"] = last power meter reading for the system named 'MACHINE_NAME' */
	/* -- ARRAY #3 */
	/* -- -- power3["TOTAL"]["MACHINE_NAME"]["POWERTYPE"] = total quantity of power for system name 'MACHINE_NAME' */
	/* -- -- power3["DURATION"]["MACHINE_NAME"]["POWERTYPE"] = total time using each power type for system 'MACHINE_NAME' in unixtime */
	/* -- -- power3["DURATION_HUMAN_READABLE"]["MACHINE_NAME"]["POWERTYPE"] = total time using each power type for system 'MACHINE_NAME' in human readable timne */
	/* -- ARRAY #4 */
	/* -- -- power4["STATE"]["MACHINE_NAME"] = total power used by system named 'MACHINE_NAME' during all instances of state 'STATE' */
	/* -- -- NOTE -- there is a 'MACHINE_NAME' of 'ALL' to identify total system usage. */

	/* -- ESTABLISH ARRAY #1 */
	$power = array();

	/* -- ZERO OUT ARRAY #2 */
	$mysql_query_index = 0;
	while ($mysql_query_index <= $SPFMODEL_COUNT_ADJUSTED ) {
		$MACHINE_NAME = $SPFMODEL_NAME[$mysql_query_index];
		$power2[$MACHINE_NAME] = 0;
		/* -- ZERO OUT ARRAY #3 */
		$mysql_query_internal_index = 0;
		while ($mysql_query_internal_index <= 0 ) {
			$power3["TOTAL"][$MACHINE_NAME][$mysql_query_internal_index] = 0;
			$power3["DURATION"][$MACHINE_NAME][$mysql_query_internal_index] = 0;
			$power3["DURATION_HUMAN_READABLE"][$MACHINE_NAME][$mysql_query_internal_index] = 0;
			$power3["TOTAL"]["ALL"][$mysql_query_internal_index] = 0;
			$power3["DURATION"]["ALL"][$mysql_query_internal_index] = 0;
			$power3["DURATION_HUMAN_READABLE"]["ALL"][$mysql_query_internal_index] = 0;
			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}
		$mysql_query_index = $mysql_query_index + 1;
	}

	/* -- ZERO OUT ARRAY #4 */
	$mysql_query_index = 0;
	while ($mysql_query_index <= $SPFMODEL_COUNT_ADJUSTED) {
		$MACHINE_NAME = $SPFMODEL_NAME[$mysql_query_index];
		$mysql_query_internal_index = 0;
		while ($mysql_query_internal_index <= $SPFMODEL_STATE_COUNT_ADJUSTED) {
			$power4[$mysql_query_internal_index][$MACHINE_NAME] = 0;
			$power4[$mysql_query_internal_index]["ALL"] = 0;
			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}
		$mysql_query_index = $mysql_query_index + 1;
	}

	/* WE HAVE TO ZERO OUT THE 'zero' INSTANCE BUT THIS IS ALLRIGHT BECAUSE */
	/* WE ARE USING N+1 INDEXING */
	/* -- discrete instances of SYSTEM X, LINE Y, using power TYPE Z */
	$POWER_TYPE[0] = "POWER";
	$discrete_power_instance_count = 0;
	$power[$discrete_power_instance_count]["MACHINE_NAME"] = "NULL";
	$power[$discrete_power_instance_count]["STATE"] = 8675309;
	$power[$discrete_power_instance_count]["POWERTYPE"] = 8675309;
	$power[$discrete_power_instance_count]["DATESTAMPSTART"] = "NULL";
	$power[$discrete_power_instance_count]["DATESTAMPEND"] = "NULL";
	$power[$discrete_power_instance_count]["POWERSTART"] = 8675309;
	$power[$discrete_power_instance_count]["POWEREND"] = 8675309;
	
	/* RETURN VARIABLES */
	return array($power,$power2,$power3,$power4,$discrete_power_instance_count);
}

/* REPORT 1 - BUILD BODY */
function model_SPF_build_report_1_body ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_build_report_1_body(); */

	/* GLOBALIZE VARIABLES */

	/*	-- MYSQL */
	global $mysql_query_instance_total_index;

	/*	-- RESULT CONTAINER */
	global $INSTANCE_TOTAL_TIME_HUMAN_READABLE, $INSTANCE_TOTAL_USE, $INSTANCE_TOTAL_TIME_UNIXTIME;

	/* EXECUTE */
	$mysql_query_instance_total_index = 0;
	while ( $mysql_query_instance_total_index <= 0 ) {
		if ( $INSTANCE_TOTAL_TIME_HUMAN_READABLE[$mysql_query_instance_total_index] == '' ) {
			$INSTANCE_TOTAL_TIME_HUMAN_READABLE[$mysql_query_instance_total_index] = "00d_00h_00m_00s";
		} else {
			/* pass */
		}
		if ( $INSTANCE_TOTAL_USE[$mysql_query_instance_total_index] == '' ) {
			$INSTANCE_TOTAL_USE[$mysql_query_instance_total_index] = 0;
		} else {
			/* pass */
		}
		$apache_time_to_convert = $INSTANCE_TOTAL_TIME_UNIXTIME[$mysql_query_instance_total_index];
		$INSTANCE_TOTAL_TIME_HUMAN_READABLE[$mysql_query_instance_total_index] = unixtimeTOrealtime($apache_time_to_convert);

		$INSTANCE_TOTAL_TIME_UNIXTIME[$mysql_query_instance_total_index] = 0;
		$INSTANCE_TOTAL_TIME_HUMAN_READABLE[$mysql_query_instance_total_index] = 0;
		$INSTANCE_TOTAL_USE[$mysql_query_instance_total_index] = 0;
		$mysql_query_instance_total_index = $mysql_query_instance_total_index + 1;
	}
}

/* REPORT 1 - BUILD BODY */
function model_SPF_build_report_1_power_pareto ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_build_report_1_power_pareto(); */

	/* GLOBALIZE VARIABLES */

	/*	-- APACHE */
	global	$apache_REPORT_RECORDENTRY, $apache_pareto_internal_index;

	/*	-- SEER MODEL SPECIFIC */
	global $SPFMODEL_STATE_COUNT_ADJUSTED, $SPFMODEL_STATE;

	/*	-- MYSQL */
	global	$power, $power2, $power3, $power4,$MACHINE_NAME;

	/* EXECUTE */
	$apache_pareto_internal_index = 0;
	while ($apache_pareto_internal_index <= $SPFMODEL_STATE_COUNT_ADJUSTED) {
		$power4_HOLDING_ARRAY1[$apache_pareto_internal_index] = $power4[$apache_pareto_internal_index][$MACHINE_NAME];
		$power4_HOLDING_ARRAY2[$apache_pareto_internal_index] = $apache_pareto_internal_index;
		$apache_pareto_internal_index = $apache_pareto_internal_index + 1;
	}
	$array_sort_retvar = array_multisort($power4_HOLDING_ARRAY1, SORT_DESC, SORT_NUMERIC, $power4_HOLDING_ARRAY2);
	$apache_pareto_internal_index_2 = 0;
	$apache_aggregate_pareto_internal_first_pass = 0;
	while ($apache_pareto_internal_index_2 <= $SPFMODEL_STATE_COUNT_ADJUSTED) {
		$apache_STATE_KEY = $power4_HOLDING_ARRAY2[$apache_pareto_internal_index_2];
		$apache_POWER_KW = $power4_HOLDING_ARRAY1[$apache_pareto_internal_index_2];
		if ($apache_aggregate_pareto_internal_first_pass == 0 ) {
			if ($apache_POWER_KW <= 0) {
				$apache_POWER_SCALE = 100;
			} else  {
				$apache_POWER_SCALE = $apache_POWER_KW;
			}
			$apache_aggregate_pareto_internal_first_pass = 1;
		} else {
			/* pass */
		}
		$apache_POWER_BAR = core_display_horizontal_bar ("500",$apache_POWER_KW,"0",$apache_POWER_SCALE);
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										".$SPFMODEL_STATE[$apache_STATE_KEY]."
									</TD>
									<TD ALIGN='LEFT'>
										".$apache_POWER_KW."
									</TD>
									<TD COLSPAN='4' CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$apache_POWER_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";
		$apache_pareto_internal_index_2 = $apache_pareto_internal_index_2 + 1;
	}

	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' HEIGHT='2' WIDTH='925' ALT='DIVIDER'><BR>
										<BR>
									</TD>
								</TR>
								";
}

/* SOURCE and DESTINATION EFFICIENCY as relates to POWER USAGE */
function model_SPF_efficiency_calculation_1 ($SOURCE_FLOW, $DESTINATION1_FLOW, $DESTINATION2_FLOW, $POWER, $MACHINE_TYPE)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($efficiency_SOURCE,$efficiency_DESTINATION1,$efficiency_DESTINATION2,$percent_injected_error) = model_SPF_efficiency_calculation_1($SOURCE_FLOW, $DESTINATION1_FLOW, $DESTINATION2_FLOW, $POWER); */

	/* EXECUTE */
	$efficiency_SOURCE = varcharTOnumeric2($SOURCE_FLOW / $POWER);
	$efficiency_DESTINATION1 = varcharTOnumeric2($DESTINATION1_FLOW / $POWER);
	if ($MACHINE_TYPE != 5) {
		$efficiency_DESTINATION2 = varcharTOnumeric2($DESTINATION2_FLOW / $POWER);
		$percent_injected_error = percent_error($SOURCE_FLOW, ($DESTINATION1_FLOW + $DESTINATION2_FLOW));
	} else {
		$efficiency_DESTINATION2 = "NOT_APPLICABLE";
		$percent_injected_error = percent_error($SOURCE_FLOW, $DESTINATION1_FLOW);
	}

	/* RETURN VALUES */
	return array($efficiency_SOURCE,$efficiency_DESTINATION1,$efficiency_DESTINATION2,$percent_injected_error);
}

/* TOTALIZER TRACKING - TYPE 1 */
function model_SPF_totalizer_change_since_last_cycle_1 ($WORKING_TOTAL, $HOLDING_TOTAL, $HOLDING_DATESTAMP, $WORKING_DATESTAMP)
{
	/* CALL THIS FUNCTION WITH... */
	/* model_SPF_totalizer_change_since_last_cycle_1($WORKING_TOTAL, $HOLDING_TOTAL, $HOLDING_DATESTAMP, $WORKING_DATESTAMP); */

	/* GLOBALIZE VARIABLES */

	/*	-- MODEL SPECIFIC */
	global $SPFMODEL_TOTALIZER_DEBOUNCE_SLOP_CLEANUP,$SPFMODEL_TOTALIZER_ROLLOVER;

	/* EXECUTE */
	if ($WORKING_TOTAL < $HOLDING_TOTAL) {
		/* TIME SINCE LAST DATA SAMPLE */
		/* -- ALLOWS US TO DO SOME FUZZY LOGIC TO ACCOUNT FOR POSSIBLE FLOW TOTAL VARIANCES */
		list($TIME_SINCE_LAST_DATA,$TIME_SINCE_LAST_DATA_UNIXTIME) = timeDuration($HOLDING_DATESTAMP,$WORKING_DATESTAMP);
		if ($TIME_SINCE_LAST_DATA_UNIXTIME > $SPFMODEL_TOTALIZER_DEBOUNCE_SLOP_CLEANUP) {
			$DIFFERENCE_TOTAL = ($SPFMODEL_TOTALIZER_ROLLOVER - $HOLDING_TOTAL) + $WORKING_TOTAL;
		} else {
			$DIFFERENCE_TOTAL = 0;
		}
	} else {
		$DIFFERENCE_TOTAL = $WORKING_TOTAL - $HOLDING_TOTAL;
	}

	/* RETURN VALUES */
	return $DIFFERENCE_TOTAL;
}

?>
