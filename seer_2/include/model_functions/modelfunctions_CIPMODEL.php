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
S.E.E.R. MODEL FUNCTIONS FILE (CIPMODEL)
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
function model_CIP_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $CIPMODEL_UM_WATER;

	/*	-- LANGUAGE */
	global $multilang_CIPMODEL_68, $multilang_CIPMODEL_18, $multilang_CIPMODEL_37, $multilang_CIPMODEL_69, $multilang_CIPMODEL_70, $multilang_CIPMODEL_71, $multilang_STATIC_DURATION_IN_SECONDS, $multilang_CIPMODEL_74;

	/* EXECUTE */
	/* -- MACHINE, LINE_BEING_CLEANED, WATER_TYPE, DATESTAMP_START, DATESTAMP_END, DURATION, WATER_USED */
	$seer_EXPORT_CONTENT = $multilang_CIPMODEL_68.$seer_CSV_DELINEATION.$multilang_CIPMODEL_18.$seer_CSV_DELINEATION.$multilang_CIPMODEL_37.$seer_CSV_DELINEATION.$multilang_CIPMODEL_69.$seer_CSV_DELINEATION.$multilang_CIPMODEL_70.$seer_CSV_DELINEATION.$multilang_CIPMODEL_71.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION_IN_SECONDS.$seer_CSV_DELINEATION.$multilang_CIPMODEL_74." [".$CIPMODEL_UM_WATER."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_CIP_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_unixtime;

	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global 	$CIPNAME_EXAMINED, $LINEBEINGCLEANED_EXAMINED_FRIENDLY, $WATERTYPE_EXAMINED_FRIENDLY, $DATESTAMPSTART_EXAMINED, $DATESTAMPEND_EXAMINED, $DURATION_EXAMINED, $WATERUSED_EXAMINED;

	/* EXECUTE */
	/* -- MACHINE, LINE_BEING_CLEANED, WATER_TYPE, DATESTAMP_START, DATESTAMP_END, DURATION, DURATION UNIXTIME, WATER_USED */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$CIPNAME_EXAMINED.$seer_CSV_DELINEATION.$LINEBEINGCLEANED_EXAMINED_FRIENDLY.$seer_CSV_DELINEATION.$WATERTYPE_EXAMINED_FRIENDLY.$seer_CSV_DELINEATION.$DATESTAMPSTART_EXAMINED.$seer_CSV_DELINEATION.$DATESTAMPEND_EXAMINED.$seer_CSV_DELINEATION.$DURATION_EXAMINED.$seer_CSV_DELINEATION.$apache_unixtime.$seer_CSV_DELINEATION.$WATERUSED_EXAMINED.$seer_CSV_ENDOFLINE_HOLDING;
}

/* REPORT 0 - BUILD BODY */
function model_CIP_build_report_0_body ($CIPMODEL_WATER_TYPE_COUNT_ADJUSTED, $CIPMODEL_WATER_TYPE, $multilang_CIPMODEL_75)
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_build_report_0_body($CIPMODEL_WATER_TYPE_COUNT_ADJUSTED, $CIPMODEL_WATER_TYPE, $multilang_CIPMODEL_75); */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_REPORT_RECORDENTRY_BODY;

	/*	-- MYSQL */
	global $mysql_query_instance_total_index;

	/*	-- RESULT CONTAINER */
	global $INSTANCE_TOTAL_TIME_HUMAN_READABLE, $INSTANCE_TOTAL_USE, $INSTANCE_TOTAL_TIME_UNIXTIME;

	/* EXECUTE */
	$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
								<TR>
									<TD COLSPAN='3' ALIGN='RIGHT'>
										<BR>
										<B><I>".$multilang_CIPMODEL_75."...</I></B>
									</TD>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";
	$mysql_query_instance_total_index = 0;
	while ( $mysql_query_instance_total_index <= $CIPMODEL_WATER_TYPE_COUNT_ADJUSTED ) {
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

		$apache_REPORT_RECORDENTRY_BODY = $apache_REPORT_RECORDENTRY_BODY."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD>
										".$INSTANCE_TOTAL_TIME_HUMAN_READABLE[$mysql_query_instance_total_index]."
									</TD>
									<TD>
										".$CIPMODEL_WATER_TYPE[$mysql_query_instance_total_index]."
									</TD>
									<TD>
										".$INSTANCE_TOTAL_USE[$mysql_query_instance_total_index]."
									</TD>
								</TR>
								";
		$INSTANCE_TOTAL_TIME_UNIXTIME[$mysql_query_instance_total_index] = 0;
		$INSTANCE_TOTAL_TIME_HUMAN_READABLE[$mysql_query_instance_total_index] = 0;
		$INSTANCE_TOTAL_USE[$mysql_query_instance_total_index] = 0;
		$mysql_query_instance_total_index = $mysql_query_instance_total_index + 1;
	}
}

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_CIP_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_export_csv_report_1_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $CIPMODEL_UM_TEMPERATURE;

	/*	-- LANGUAGE */
	global $multilang_CIPMODEL_17, $multilang_CIPMODEL_68, $multilang_CIPMODEL_18, $multilang_CIPMODEL_25, $multilang_CIPMODEL_26, $multilang_STATIC_CERTIFIED, $multilang_STATIC_CERTIFIED_BY, $multilang_STATIC_COMMENT;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, LINE_BEING_CLEANED, STEP, RETURN_TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $multilang_CIPMODEL_17.$seer_CSV_DELINEATION.$multilang_CIPMODEL_68.$seer_CSV_DELINEATION.$multilang_CIPMODEL_18.$seer_CSV_DELINEATION.$multilang_CIPMODEL_25.$seer_CSV_DELINEATION.$multilang_CIPMODEL_26." [".$CIPMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED.$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED_BY.$seer_CSV_DELINEATION.$multilang_STATIC_COMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_CIP_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_export_csv_report_1_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $CIPMODEL_WORKING_LINE_BEING_CLEANED, $CIPMODEL_WORKING_STEP, $mysql_mod_openopc_WORKING_RETURNTEMP, $mysql_mod_openopc_WORKING_CERTIFIED, $MODEL_CERTIFIEDUSERREALNAME, $mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT;

	/* EXECUTE */
	/* -- MACHINE, DATESTAMP, STATE, HRS_SINCE_CLEAN, TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$CIPMODEL_WORKING_LINE_BEING_CLEANED.$seer_CSV_DELINEATION.$CIPMODEL_WORKING_STEP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RETURNTEMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIED.$seer_CSV_DELINEATION.$MODEL_CERTIFIEDUSERREALNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 2 - ZERO */
/* -- clear csv content */
function model_CIP_export_csv_report_2_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_export_csv_report_2_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $CIPMODEL_UM_TEMPERATURE, $CIPMODEL_UM_CONDUCTIVITY, $CIPMODEL_UM_FLOW;

	/*	-- LANGUAGE */
	global $multilang_CIPMODEL_17, $multilang_CIPMODEL_68, $multilang_CIPMODEL_18, $multilang_CIPMODEL_25, $multilang_CIPMODEL_60, $multilang_CIPMODEL_26, $multilang_CIPMODEL_61, $multilang_CIPMODEL_62, $multilang_CIPMODEL_37;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, LINE_BEING_CLEANED, STEP, SUPPLY_TEMP, RETURN_TEMP, SUPPLY_FLOW, RETURN_CONDUCTIVITY, WATER_TYPE */
	$seer_EXPORT_CONTENT = $multilang_CIPMODEL_17.$seer_CSV_DELINEATION.$multilang_CIPMODEL_68.$seer_CSV_DELINEATION.$multilang_CIPMODEL_18.$seer_CSV_DELINEATION.$multilang_CIPMODEL_25.$seer_CSV_DELINEATION.$multilang_CIPMODEL_60." [".$CIPMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_CIPMODEL_26." [".$CIPMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_CIPMODEL_61." [".$CIPMODEL_UM_FLOW."]".$seer_CSV_DELINEATION.$multilang_CIPMODEL_62." [".$CIPMODEL_UM_CONDUCTIVITY."]".$seer_CSV_DELINEATION.$multilang_CIPMODEL_37.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 2 - BUILD */
/* -- add to (build) csv content */
function model_CIP_export_csv_report_2_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_export_csv_report_2_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $CIPMODEL_WORKING_LINE_BEING_CLEANED, $CIPMODEL_WORKING_STEP, $mysql_mod_openopc_WORKING_SUPPLYTEMP, $mysql_mod_openopc_WORKING_RETURNTEMP, $mysql_mod_openopc_WORKING_SUPPLYFLOW, $mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY, $CIPMODEL_WORKING_WATERTYPE;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, HRS_SINCE_CLEAN, TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$CIPMODEL_WORKING_LINE_BEING_CLEANED.$seer_CSV_DELINEATION.$CIPMODEL_WORKING_STEP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_SUPPLYTEMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RETURNTEMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_SUPPLYFLOW.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_RETURNCONDUCTIVITY.$seer_CSV_DELINEATION.$CIPMODEL_WORKING_WATERTYPE.$seer_CSV_ENDOFLINE_HOLDING;
}

/* REPORT 2 - BUILD BODY */
function model_CIP_build_report_2_body ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_CIP_build_report_2_body(); */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_REPORT_RECORDENTRY;

	/*	-- APACHE TYPOS */
	global $apache_CURRENT_START_TIME, $apache_CURRENT_END_TIME, $apache_CURRENT_LENGTH_OF_WASH, $apache_CURRENT_ALARM_COUNT, $apache_CURRENT_ALARM_ARRAY, $apache_CURRENT_ALARM_DURING_STEP_ARRAY, $apache_CURRENT_START_TIME, $apache_CURRENT_END_TIME, $apache_CURRENT_LENGTH_OF_WASH, $apache_CURRENT_WATER_USAGE;

	/*	-- MODEL SPECIFIC */
	global $CIPMODEL_UM_WATER;

	/*	-- MYSQL */
	/* NOTE - all of the variables listed for this function under 'APACHE TYPOS' are actually MYSQL generated variables. */
	/*	- inconsistent naming convention during the initial build (different SEER models used inadvertantly different *
	/*	  naming conventions by accident) was the cause, however there is no harm, so we'll leave them both for */
	/*	  posterity, and because renaming would require more reworking of the CIP Model itself. */
	/*	- "but why did they even get the 'APACHE' name to begin with?" ... simple, because rather than */
	/*	  calling them by where they 'came from', the CIP Model referred to variables by what they were */
	/*	  going to be used for, in this case to build markup for display via Apache. */

	/* 	-- LANGUAGE */
	global $multilang_CIPMODEL_75, $multilang_STATIC_START_TIME, $multilang_STATIC_END_TIME, $multilang_CIPMODEL_86, $multilang_CIPMODEL_88, $multilang_CIPMODEL_87;

	/* EXECUTE */
	list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_CURRENT_START_TIME,$apache_CURRENT_END_TIME);
	$apache_CURRENT_LENGTH_OF_WASH = $apache_function_DURATION_FINAL;
	if ( $apache_CURRENT_ALARM_COUNT > 0 ) {
		$apache_REPORT_TOTAL_ALARM_RUNDOWN = "";
		$apache_CURRENT_ALARM_COUNT_index = 1;
		while ( $apache_CURRENT_ALARM_COUNT_index <= $apache_CURRENT_ALARM_COUNT ) {
			$apache_REPORT_TOTAL_ALARM_RUNDOWN = $apache_REPORT_TOTAL_ALARM_RUNDOWN."
										[".$apache_CURRENT_ALARM_COUNT_index."] ".$apache_CURRENT_ALARM_ARRAY[$apache_CURRENT_ALARM_COUNT_index]." - during - ".$apache_CURRENT_ALARM_DURING_STEP_ARRAY[$apache_CURRENT_ALARM_COUNT_index]."<BR>
										";
			$apache_CURRENT_ALARM_COUNT_index = $apache_CURRENT_ALARM_COUNT_index + 1;
		}
	} else {
		$apache_REPORT_TOTAL_ALARM_RUNDOWN = "";
	}
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='4' ALIGN='RIGHT'>
										<BR>
										<I>".$multilang_CIPMODEL_75."...</I>
									</TD>
									<TD COLSPAN='8'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD COLSPAN='3' VALIGN='MIDDLE'>
										<B>".$multilang_STATIC_START_TIME.":</B> ".$apache_CURRENT_START_TIME."<BR>
										<B>".$multilang_STATIC_END_TIME.":</B> ".$apache_CURRENT_END_TIME."<BR>
										<B>".$multilang_CIPMODEL_86.":</B> ".$apache_CURRENT_LENGTH_OF_WASH."<BR>
										<BR>
										<B>".$multilang_CIPMODEL_88.":</B> ".$apache_CURRENT_WATER_USAGE." [".$CIPMODEL_UM_WATER."]<BR>
									</TD>
									<TD COLSPAN='4' VALIGN='MIDDLE'>
										<B>".$multilang_CIPMODEL_87.":</B><BR>
										<BR>
										".$apache_REPORT_TOTAL_ALARM_RUNDOWN."
									</TD>
								</TR>
								";
}

/* BUILD CONTAINER FOR CIP WATER USAGE DISCRETE INSTANCES */
/* -- builds 3 arrays */
function model_CIP_water_usage_discrete_container_build ($mysql_mod_openopc_query_result,$CIPMODEL_COUNT_ADJUSTED,$CIPMODEL_NAME,$CIPMODEL_WATER_TYPE_COUNT_ADJUSTED)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($water,$water2,$water3,$discrete_water_instance_count) = model_CIP_water_usage_discrete_container_build($mysql_mod_openopc_query_result,$CIPMODEL_COUNT_ADJUSTED,$CIPMODEL_NAME,$CIPMODEL_WATER_TYPE_COUNT_ADJUSTED); */

	/* EXECUTE */

	/* -- CONTAINER FOR CIP WATER DISCRETE INSTANCES */
	/* -- -- ARRAY #1 */
	/* -- -- -- water[INDEX]["CIPNAME"] = CIPNAME */
	/* -- -- -- water[INDEX]["LINEBEINGCLEANED"] = LINE BEING CLEANED */
	/* -- -- -- water[INDEX]["WATERTYPE"] = WATER TYPE */
	/* -- -- -- water[INDEX]["DATESTAMPSTART"] = DATESTAMP START */
	/* -- -- -- water[INDEX]["DATESTAMPEND"] = DATESTAMP END */
	/* -- -- -- water[INDEX]["WATERSTART"] = WATER METER AT START */
	/* -- -- -- water[INDEX]["WATEREND"] = WATER METER AT END */
	/* -- -- -- water[INDEX]["WATERUSED"] = WATER USED */
	/* -- -- ARRAY #2 */
	/* -- -- -- water2["CIPNAME"] = last water meter reading for the system named 'CIPNAME' */
	/* -- -- ARRAY #3 */
	/* -- -- -- water3["TOTAL"]["CIPNAME"]["WATERTYPE"] = total quantity of water for system name 'CIPNAME' */
	/* -- -- -- water3["DURATION"]["CIPNAME"]["WATERTYPE"] = total time using each water type for system 'CIPNAME' in unixtime */
	/* -- -- -- water3["DURATION_HUMAN_READABLE"]["CIPNAME"]["WATERTYPE"] = total time using each water type for system 'CIPNAME' in human readable timne */

	/* -- ZERO OUT ARRAY #2 */
	$mysql_query_index = 0;
	while ($mysql_query_index <= $CIPMODEL_COUNT_ADJUSTED ) {
		$CIPNAME = $CIPMODEL_NAME[$mysql_query_index];
		$water2[$CIPNAME] = 0;
		/* -- ZERO OUT ARRAY #3 */
		$mysql_query_internal_index = 0;
		while ($mysql_query_internal_index <= $CIPMODEL_WATER_TYPE_COUNT_ADJUSTED) {
			$water3["TOTAL"][$CIPNAME][$mysql_query_internal_index] = 0;
			$water3["DURATION"][$CIPNAME][$mysql_query_internal_index] = 0;
			$water3["DURATION_HUMAN_READABLE"][$CIPNAME][$mysql_query_internal_index] = 0;
			$water3["TOTAL"]["ALL"][$mysql_query_internal_index] = 0;
			$water3["DURATION"]["ALL"][$mysql_query_internal_index] = 0;
			$water3["DURATION_HUMAN_READABLE"]["ALL"][$mysql_query_internal_index] = 0;
			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}
		$mysql_query_index = $mysql_query_index + 1;
	}

	/* -- WE HAVE TO ZERO OUT THE 'zero' INSTANCE BUT THIS IS ALLRIGHT BECAUSE */
	/*    WE ARE USING N+1 INDEXING */
	/* -- -- discrete instances of SYSTEM X, LINE Y, using WATER TYPE Z */
	$discrete_water_instance_count = 0;
	$water[$discrete_water_instance_count]["CIPNAME"] = "8675309";
	$water[$discrete_water_instance_count]["LINEBEINGCLEANED"] = "8675309";
	$water[$discrete_water_instance_count]["WATERTYPE"] = "8675309";
	$water[$discrete_water_instance_count]["DATESTAMPSTART"] = "8675309";
	$water[$discrete_water_instance_count]["DATESTAMPEND"] = "8675309";
	$water[$discrete_water_instance_count]["WATERSTART"] = "8675309";
	$water[$discrete_water_instance_count]["WATEREND"] = "8675309";

	/* RETURN VARIABLES */
	return array($water,$water2,$water3,$discrete_water_instance_count);
}

?>
