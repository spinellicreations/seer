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
S.E.E.R. MODEL FUNCTIONS FILE (COMMON)
-- MODEL SUBROUTINES (FUNCTION BY FORM, SUBROUTINE BY EXECUTION)
-- COMMON TO VARIOUS MODELS
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

/* ALARM FIELD HIGHLIGHT IF ACTIVE */
/* -- given a value, any non-zero value is considered an active alarm */
/*    and highlighted, else, background is alternate color, or white if null */
function alarm_highlight_check ($ALARMVALUE, $ALARMCOLOR="NULL", $ALTCOLOR="NULL", $ALARMMODE="CHECKFORZERO")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_background_color = alarm_highlight_check($ALARMVALUE); */
	/* -- valid modes are "CHECKFORZERO" which compares alarm value against zero, */
	/*    and "CHECKFORNULL" which compares alarm value against the string '' (empty value). */
	/* -- default mode is "CHECKFORZERO" */

	/* EXECUTE */
	if ( $ALARMMODE == "CHECKFORZERO" ) {
		/* CHECK FOR ZERO */
		$ALARMCHECKVAL = 0;
	} else {
		if ( $ALARMMODE == "CHECKFORNULL" ) {
			/* CHECK FOR NULL STRING ( the ''  VALUE ) */
			$ALARMCHECKVAL = '';
		} else {
			/* CATCH ALL ON FAIL */
			$ALARMCHECKVAL = 0;
		}
	}

	if ( $ALARMVALUE != $ALARMCHECKVAL ) {
		if ( $ALARMCOLOR == 'NULL' ) {
			$WORKING_ALARM_BACKGROUND = "BGCOLOR='#FF8866'";
			/* default red */
		} else {
			$WORKING_ALARM_BACKGROUND = $ALARMCOLOR;
			/* your custom color */
		}
	} else {
		if ( $ALTCOLOR == 'NULL' ) {
			$WORKING_ALARM_BACKGROUND = "BGCOLOR='#FFFFFF'";
			/* default white */
		} else {
			$WORKING_ALARM_BACKGROUND = $ALTCOLOR;
			/* your custom color */
		}
	}
	/* RETURN VALUES */
	return $WORKING_ALARM_BACKGROUND;
}
/* IDENTIFY MACHINE LOGICAL VALUE FROM NAME */
/* -- given a machine's name, identify what logical value (integer) */
/*    represents that machine in the local options file */
function model_COMMON_identify_logical_value_from_name ($MACHINENAME,$MODEL_NAME,$MODEL_COUNT_ADJUSTED)
{
	/* CALL THIS FUNCTION WITH... */
	/* $MACHINENAME_BY_INTEGER = model_COMMON_identify_logical_value_from_name($MACHINENAME,$MODEL_NAME,$MODEL_COUNT_ADJUSTED); */
	/* where...
		$MACHINENAME = literal text name of machine
		$MODEL_NAME = array of literal text names for the model (local instance) in question
		$MODEL_COUNT_ADJUSTED = the number of machines in the model (local instance)
		$MACHINENAME_BY_INTEGER = the returned logical value corresponding to the machine's name
	*/

	/* EXECUTE */
	$mysql_ENTRY_MACHINENAME_BY_INTEGER = 0;
	$seer_array_index = 0;
	while ( $seer_array_index <= $MODEL_COUNT_ADJUSTED ) {
		if ( $MODEL_NAME[$seer_array_index] == $MACHINENAME ) {
			$MACHINENAME_BY_INTEGER = $seer_array_index;
		} else {
			/* pass */
		}
		$seer_array_index = $seer_array_index + 1;
	}

	/* RETURN VALUE */
	return $MACHINENAME_BY_INTEGER;
}

/* DEPARTMENT LOCAL SET - REPORT - FAULTS */
/* EXPORT TO CSV - ZERO */
/* -- clear csv content */
function model_COMMON_export_csv_report_3_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_COMMON_export_csv_report_3_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- LANGUAGE */
	global $multilang_CIPMODEL_68, $multilang_CIPMODEL_58, $multilang_CIPMODEL_69, $multilang_CIPMODEL_70, $multilang_CIPMODEL_71, $multilang_CIPMODEL_96;

	/* EXECUTE */
	/* -- MACHINE, FAULT, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME */
	$seer_EXPORT_CONTENT = $multilang_CIPMODEL_68.$seer_CSV_DELINEATION.$multilang_CIPMODEL_58.$seer_CSV_DELINEATION.$multilang_CIPMODEL_69.$seer_CSV_DELINEATION.$multilang_CIPMODEL_70.$seer_CSV_DELINEATION.$multilang_CIPMODEL_71.$seer_CSV_DELINEATION.$multilang_CIPMODEL_96.$seer_CSV_ENDOFLINE_HOLDING;
}

/* DEPARTMENT LOCAL SET - REPORT - FAULTS */
/* EXPORT TO CSV - BUILD */
/* -- add to (build) csv content */
function model_COMMON_export_csv_report_3_build ($seer_EXPORT_MACHINE,$seer_EXPORT_FAULT,$starttime_container,$MODEL_WORKING_MACHINENAME,$machine_fault_index_container_CYCLE,$endtime_container,$apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME)
{

	/* CALL THIS FUNCTION WITH... */
	/* model_COMMON_export_csv_report_3_build($seer_EXPORT_MACHINE,$seer_EXPORT_FAULT,$starttime_container,$MODEL_WORKING_MACHINENAME,$machine_fault_index_container_CYCLE,$endtime_container,$MODEL_WORKING_MACHINENAME,$machine_fault_index_container_CYCLE,$apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/* EXECUTE */
	/* -- MACHINE, FAULT, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$seer_EXPORT_MACHINE.$seer_CSV_DELINEATION.$seer_EXPORT_FAULT.$seer_CSV_DELINEATION.$starttime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE].$seer_CSV_DELINEATION.$endtime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE].$seer_CSV_DELINEATION.$apache_function_DURATION_FINAL.$seer_CSV_DELINEATION.$apache_function_DURATION_UNIXTIME.$seer_CSV_ENDOFLINE_HOLDING;
}

/* DEPARTMENT LOCAL SET - REPORT - FAULTS */
/* FAULT CONTAINER CREATION */
/* -- pull in faults (whether an alarm / status / state / fault / or just a notice / condition) */
/*    -- we simply call them 'faults' regardless, for sake of simplicity.  'event' would have been */
/*       a better word, but the whole thing is already coded, and we're not going to re-invent the */
/*       wheel here. */
/* -- assign duration to them, and parse out as needed */
function model_COMMON_fault_container_creation_report_3 ($post_DATESTAMP_START,$post_DATESTAMP_END,$post_MODEL_MACHINE_COUNT_ADJUSTED,$post_MODEL_MACHINE_ARRAY,$post_mysql_mod_openopc_TABLENAME,$post_COLUMN_NAME_MACHINENAME,$post_COLUMN_NAME_FAULT,$post_FAULT_CONDITION_QUALIFIER_STRING,$post_FAULT_CONDITION_ARRAY)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime,$machine_fault_index_container,$returned_MACHINE_TO_EXAMINE_index_number) = model_COMMON_fault_container_creation_report_3($post_DATESTAMP_START,$post_DATESTAMP_END,$post_MODEL_MACHINE_COUNT_ADJUSTED,$post_MODEL_MACHINE_ARRAY,$post_mysql_mod_openopc_TABLENAME,$post_COLUMN_NAME_MACHINENAME,$post_COLUMN_NAME_FAULT,$post_FAULT_CONDITION_QUALIFIER_STRING,$post_FAULT_CONDITION_ARRAY,$post_MACHINE_TO_EXAMINE); */
	/* where... 
		-- $post_DATESTAMP_START = mod_openopc friendly datestamp for start time
		-- $post_DATESTAMP_END = mod_openopc friendly datestamp for end time
		-- $post_MODEL_MACHINE_COUNT_ADJUSTED = the adjusted 'count' variable from the model's localoptions[x].opt file
		-- $post_MODEL_MACHINE_ARRAY = name array from the model's localoptions[x].opt file
		-- $post_mysql_mod_openopc_TABLENAME = mod_openopc table name for the data you want to pull
		-- $post_COLUMN_NAME_MACHINENAME = column in that table which designates MACHINE NAME
		-- $post_COLUMN_NAME_FAULT = column in that table which designates the condition of the FAULT, STATE, or EVENT you want to pull
		-- $post_FAULT_CONDITION_QUALIFIER_STRING = a tweaked query string looking for specific fault conditions
		-- $post_FAULT_CONDITION_ARRAY = array from localoptions[x].opt file that indicates the human readable value corresponding to the digital condition fault code
	  for example...
		-- $post_DATESTAMP_START = $mysql_query_START_DATESTAMP
		-- $post_DATESTAMP_END = $mysql_query_END_DATESTAMP
		-- $post_MODEL_MACHINE_COUNT_ADJUSTED = $CIPMODEL_COUNT_ADJUSTED
		-- $post_MODEL_MACHINE_ARRAY = $CIPMODEL_NAME
		-- $post_mysql_mod_openopc_TABLENAME = $CIPMODEL_mysql_mod_openopc_TABLENAME
		-- $post_COLUMN_NAME_MACHINENAME = 'CIPNAME'
		-- $post_COLUMN_NAME_FAULT = 'STATUS'
		-- $post_FAULT_CONDITION_QUALIFIER_STRING = "AND (".$mysql_ENTRY_DISPLAY_UNDER_DECLARED_ALARM_CONDITION_ONLY_SELECT.") AND (STEP ".$CIPMODEL_STEP_REALSTEPS.") "
		       -- BE ADVISED! the above string must start with ... "AND [something something]"
				      and then end with "[something something] ) "
		-- $post_FAULT_CONDITION_ARRAY = $CIPMODEL_STATUS
	*/


	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_SCANTIME_TO_CONSIDER_NEW_RECORD, $seer_ZEROTIMEFAULTS_LOG_AS_ONE_MINUTE;

	/* EXECUTE */
	/* -- ZERO OUT CSV FOR EXPORT */
	model_COMMON_export_csv_report_3_zero();

	/* -- BUILD A CONTAINER FOR FAULTS */
	/* -- -- FORM IS... (note: the following is a 'readable' example, and does not represent proper code) */
	/* -- -- -- $fault_container["machine"][$machine_fault_index_container["machine"]] = fault */
	/* -- -- -- $endtime_container["machine"][$machine_fault_index_container["machine"]] = endtime */
	/* -- -- -- $starttime_container["machine"][$machine_fault_index_container["machine"]] = starttime */
	/* -- -- -- $duration_container_human_readable["machine"][$machine_fault_index_container["machine"]] = duration in h_m_s */
	/* -- -- -- $duration_container_unixtime["machine"][$machine_fault_index_container["machine"]] = duration in seconds */
	/* -- -- -- $machine_fault_index_container["machine"] = count */

	/* ZERO OUT THE CONTAINER */
	$mysql_query_internal_index = 0;
	while ( $mysql_query_internal_index <= $post_MODEL_MACHINE_COUNT_ADJUSTED ) {
		$machine_fault_index_container[$mysql_query_internal_index] = 0;
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}

		/* STATUS ALARMS and FAULTS */
		$mysql_query_global_index = 0;
		while ( $mysql_query_global_index <= $post_MODEL_MACHINE_COUNT_ADJUSTED) {

			$mysql_mod_openopc_query = "DATESTAMP, ".$post_COLUMN_NAME_FAULT;
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$post_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$post_DATESTAMP_START."' AND '".$post_DATESTAMP_END."') AND (".$post_COLUMN_NAME_MACHINENAME." = '".$post_MODEL_MACHINE_ARRAY[$mysql_query_global_index]."') ".$post_FAULT_CONDITION_QUALIFIER_STRING."ORDER BY DATESTAMP DESC, ".$post_COLUMN_NAME_MACHINENAME." ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {

				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row[$post_COLUMN_NAME_FAULT];
	
				/* CONVERT MACHINE NAME TO NUMBER */
				$MODEL_WORKING_MACHINENAME = $mysql_query_global_index;
	
				/* CHECK IF THIS IS AN EXISTING FAULT OR A BRAND NEW ONE */
	
				$fault_key_this_machine = $machine_fault_index_container[$MODEL_WORKING_MACHINENAME];
	
				if ( $fault_container[$MODEL_WORKING_MACHINENAME][$fault_key_this_machine] == $mysql_mod_openopc_WORKING_ALARM ) {
					$mysql_query_fault_existing_and_active = "yes";
	
					/* OK BUT NOW WE HAVE TO CHECK HOW LONG IT HAS BEEN SINCE THE LAST ENTRY WAS POSTED */
					/* IF IT HAS BEEN MORE THAN PREDEFINED SECONDS, THEN WE WILL CONSIDER IT A NEW ENTRY */
					/* CONSIDER THIS 'FUZZY' LOGIC */
					/* -- relies upon -- $seer_SCANTIME_TO_CONSIDER_NEW_RECORD */
	
					$apache_function_ENDTIME = $starttime_container[$MODEL_WORKING_MACHINENAME][$fault_key_this_machine];
					$apache_function_STARTTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
	
					list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_function_STARTTIME,$apache_function_ENDTIME);
	
					if ( $apache_function_DURATION_UNIXTIME > $seer_SCANTIME_TO_CONSIDER_NEW_RECORD ) {
						$mysql_query_fault_existing_and_active = "no";
					} else {
						/* pass */
					}
	
				} else {
					$mysql_query_fault_existing_and_active = "no";
				}
	
				if ( $mysql_query_fault_existing_and_active == "yes" ) {
					/* HOW TO HANDLE IF THIS IS AN EXISTING FAULT */
					$starttime_container[$MODEL_WORKING_MACHINENAME][$fault_key_this_machine] = $mysql_mod_openopc_WORKING_DATESTAMP;
				} else {
					/* HOW TO HANDLE IF THIS IS A BRAND NEW FAULT */
					$machine_fault_index_container[$MODEL_WORKING_MACHINENAME] = $machine_fault_index_container[$MODEL_WORKING_MACHINENAME] + 1;
					$fault_key_this_machine = $machine_fault_index_container[$MODEL_WORKING_MACHINENAME];
					$fault_container[$MODEL_WORKING_MACHINENAME][$fault_key_this_machine] = $mysql_mod_openopc_WORKING_ALARM;
					if ( $seer_ZEROTIMEFAULTS_LOG_AS_ONE_MINUTE == 'YES' ) {
						$PLACEHOLDER_ENDTIME = datestampAddTime($mysql_mod_openopc_WORKING_DATESTAMP, 0, 0, 0, 0, 1);
					} else {
						$PLACEHOLDER_ENDTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
					}
					$endtime_container[$MODEL_WORKING_MACHINENAME][$fault_key_this_machine] = $PLACEHOLDER_ENDTIME;
					$starttime_container[$MODEL_WORKING_MACHINENAME][$fault_key_this_machine] = $mysql_mod_openopc_WORKING_DATESTAMP;
				}

			}
			
			$mysql_query_global_index = $mysql_query_global_index + 1;

		}

		/* CALCULATE DURATION FOR EVERY ALARM STORED IN CONTAINER - All Systems */
		$mysql_query_internal_index = 0;
		while ( $mysql_query_internal_index <= $post_MODEL_MACHINE_COUNT_ADJUSTED ) {

			$MODEL_WORKING_MACHINENAME = $mysql_query_internal_index;
			$machine_fault_index_container_CYCLE = 1;
			while ( $machine_fault_index_container_CYCLE <= $machine_fault_index_container[$MODEL_WORKING_MACHINENAME] ) {

				$apache_function_STARTTIME = $starttime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
				$apache_function_ENDTIME = $endtime_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];

				list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_function_STARTTIME,$apache_function_ENDTIME);

				$duration_container_human_readable[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE] = $apache_function_DURATION_FINAL;
				$duration_container_unixtime[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE] = $apache_function_DURATION_UNIXTIME;

				/* BUILD CSV FOR EXPORT */
				$seer_EXPORT_MACHINE = $post_MODEL_MACHINE_ARRAY[$MODEL_WORKING_MACHINENAME];
				$seer_EXPORT_FAULT = $fault_container[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
				$seer_EXPORT_FAULT = $post_FAULT_CONDITION_ARRAY[$seer_EXPORT_FAULT];
				model_COMMON_export_csv_report_3_build($seer_EXPORT_MACHINE,$seer_EXPORT_FAULT,$starttime_container,$MODEL_WORKING_MACHINENAME,$machine_fault_index_container_CYCLE,$endtime_container,$MODEL_WORKING_MACHINENAME,$machine_fault_index_container_CYCLE,$apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME);

				/* INDEX THE LOOP */
				$machine_fault_index_container_CYCLE = $machine_fault_index_container_CYCLE + 1;

			}

			/* INDEX THE PARENT LOOP */
			$mysql_query_internal_index = $mysql_query_internal_index + 1;

		}

	/* RETURN VARIABLES */
	return array($fault_container,$endtime_container,$starttime_container,$duration_container_human_readable,$duration_container_unixtime,$machine_fault_index_container);
}

/* DEPARTMENT LOCAL SET - REPORT - FAULTS */
/* TOP RATED FAULT CONTAINER CREATION - REPORT 3 */
/* -- categorize faults generated by the function 'model_COMMON_fault_container_creation_report_3' */
/*    a.k.a. 'FAULT CONTAINER CREATION - REPORT 3'
/* -- assign duration to them, and parse out as needed */
function model_COMMON_top_rated_fault_container_creation_report_3 ($post_MODEL_MACHINE_COUNT_ADJUSTED,$post_MACHINE_FAULT_INDEX_CONTAINER,$post_FAULT_CONTAINER,$post_ENDTIME_CONTAINER,$post_STARTTIME_CONTAINER,$post_DURATION_CONTAINER_HUMAN_READABLE,$post_DURATION_CONTAINER_UNIXTIME,$post_bypass_TOPRATED_CHECK_2="NO")
{
	/* CALL THIS FUNCTION WITH... */
	/* list($fault_container_TOPRATED,$machine_fault_index_container_TOPRATED) = model_COMMON_top_rated_fault_container_creation_report_3($post_MODEL_MACHINE_COUNT_ADJUSTED,$post_MACHINE_FAULT_INDEX_CONTAINER,$post_FAULT_CONTAINER,$post_ENDTIME_CONTAINER,$post_STARTTIME_CONTAINER,$post_DURATION_CONTAINER_HUMAN_READABLE,$post_DURATION_CONTAINER_UNIXTIME,$post_bypass_TOPRATED_CHECK_2); */
	/* where... 
		-- $post_MODEL_MACHINE_COUNT_ADJUSTED = the adjusted 'count' variable from the model's localoptions[x].opt file
		-- $post_MACHINE_FAULT_INDEX_CONTAINER = array '$machine_fault_index_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_FAULT_CONTAINER = array '$fault_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_ENDTIME_CONTAINER = array '$endtime_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_STARTTIME_CONTAINER = array '$starttime_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_DURATION_CONTAINER_HUMAN_READABLE = array '$duration_container_human_readable' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_DURATION_CONTAINER_UNIXTIME = array '$duration_container_unixtime' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_bypass_TOPRATED_CHECK_2 == 'ALLOW_FAULT_ID_ZERO' (OR DO NOT DEFINE!) allows a fault (or state or wahtever) with a logical value of '0' to
							be displayed.  Otherwise, only conditions with logical values greater than zero will be displayed (typically this
							is used to eliminate the ALARM / FAULT = "NONE" condition, which is defined most often as logical value '0'. 
							However, there are instances where we may want to display the time when a zero state was observed (such as
							when using this function to determine Tank Occupancy Time, and '0' represents an 'Empty' tank.
	   for example...
		-- $post_MODEL_MACHINE_COUNT_ADJUSTED = $post_MODEL_MACHINE_COUNT_ADJUSTED
		-- $post_MACHINE_FAULT_INDEX_CONTAINER = $machine_fault_index_container
		-- $post_FAULT_CONTAINER = $fault_container
		-- $post_ENDTIME_CONTAINER = $endtime_container
		-- $post_STARTTIME_CONTAINER = $starttime_container
		-- $post_DURATION_CONTAINER_HUMAN_READABLE = $duration_container_human_readable
		-- $post_DURATION_CONTAINER_UNIXTIME = $duration_container_unixtime
	*/

	/* EXECUTE */
	/* -- CREATE A RANKING SYSTEM FOR THE TOP FAULTS - SO WE CAN BUILD A PARETO CHART LATER */
	/* -- -- FORM IS... (note: the following is a 'readable' example, and does not represent proper code) */
	/* -- -- -- $fault_container_TOPRATED["machine"][$machine_fault_index_container_TOPRATED] = machine */
	/* -- -- -- $fault_container_TOPRATED["fault"][$machine_fault_index_container_TOPRATED] = fault */
	/* -- -- -- $fault_container_TOPRATED["endtime"][$machine_fault_index_container_TOPRATED] = endtime */
	/* -- -- -- $fault_container_TOPRATED["starttime"][$machine_fault_index_container_TOPRATED] = starttime */
	/* -- -- -- $fault_container_TOPRATED["duration_human_readable"][$machine_fault_index_container_TOPRATED] = duration in h_m_s */
	/* -- -- -- $fault_container_TOPRATED["duration_unixtime"][$machine_fault_index_container_TOPRATED] = duration in seconds */
	/* -- -- -- $machine_fault_index_container_TOPRATED = count */
	$mysql_query_internal_index = 0;
	$machine_fault_index_container_TOPRATED = 0;
	while ( $mysql_query_internal_index <= $post_MODEL_MACHINE_COUNT_ADJUSTED ) {
		$MODEL_WORKING_MACHINENAME = $mysql_query_internal_index;
		$machine_fault_index_container_CYCLE = 0;
		while ( $machine_fault_index_container_CYCLE <= $post_MACHINE_FAULT_INDEX_CONTAINER[$MODEL_WORKING_MACHINENAME] ) {
			$fault_container_TOPRATED_CHECK = isset($post_FAULT_CONTAINER[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE]);
			if ( $fault_container_TOPRATED_CHECK == TRUE) {
				$fault_container_TOPRATED_CHECK_2 = $post_FAULT_CONTAINER[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
			} else {
				$fault_container_TOPRATED_CHECK_2 = 0;
			}
			if ( ($fault_container_TOPRATED_CHECK == TRUE) && ( ($fault_container_TOPRATED_CHECK_2 != 0) || ($post_bypass_TOPRATED_CHECK_2 == 'ALLOW_FAULT_ID_ZERO') ) ) {
				/* -- UPDATE THE TOPRATED FAULT COUNT */
				$machine_fault_index_container_TOPRATED = $machine_fault_index_container_TOPRATED + 1;
				/* -- PROCESS THE TOPRATED FAULT */
				$fault_container_TOPRATED["machine"][$machine_fault_index_container_TOPRATED] = $MODEL_WORKING_MACHINENAME;
				$fault_container_TOPRATED["fault"][$machine_fault_index_container_TOPRATED] = $post_FAULT_CONTAINER[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
				$fault_container_TOPRATED["endtime"][$machine_fault_index_container_TOPRATED] = $post_ENDTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
				$fault_container_TOPRATED["starttime"][$machine_fault_index_container_TOPRATED] = $post_STARTTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
				$fault_container_TOPRATED["duration_human_readable"][$machine_fault_index_container_TOPRATED] = $post_DURATION_CONTAINER_HUMAN_READABLE[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];
				$fault_container_TOPRATED["duration_unixtime"][$machine_fault_index_container_TOPRATED] = $post_DURATION_CONTAINER_UNIXTIME[$MODEL_WORKING_MACHINENAME][$machine_fault_index_container_CYCLE];					
			} else {
				/* pass */
			}
			/* --INDEX THE LOOP */
			$machine_fault_index_container_CYCLE = $machine_fault_index_container_CYCLE + 1;
		}
		/* -- INDEX THE PARENT LOOP */
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}

	/* RETURN VARIABLES */
	return array($fault_container_TOPRATED,$machine_fault_index_container_TOPRATED);
}

/* DEPARTMENT LOCAL SET - REPORT - FAULTS */
/* PRESORT FAULT ARRAYS PRIOR TO REPORT BODY GENERATION */
/* -- sort faults generated by the function 'model_COMMON_fault_container_creation_report_3', */
/*    which should have then been handled by 'model_COMMON_top_rated_fault_container_creation_report_3' */
function model_COMMON_presort_fault_arrays_report_3 ($post_MACHINE_FAULT_INDEX_CONTAINER_TOPRATED,$post_FAULT_CONTAINER_TOPRATED,$post_MODEL_MACHINE_COUNT_ADJUSTED,$post_MODEL_MACHINE_FAULT_COUNT_ADJUSTED,$post_MACHINE_FAULT_INDEX_CONTAINER,$post_FAULT_CONTAINER,$post_ENDTIME_CONTAINER,$post_STARTTIME_CONTAINER,$post_DURATION_CONTAINER_HUMAN_READABLE,$post_DURATION_CONTAINER_UNIXTIME,$post_bypass_TOPRATED_CHECK_2="NO")
{
	/* CALL THIS FUNCTION WITH... */
	/* list($post_FAULT_CONTAINER_TOTAL_TOPRATED,$post_FAULT_CONTAINER_TOPRATED,$post_FAULT_CONTAINER,$post_ENDTIME_CONTAINER,$post_STARTTIME_CONTAINER,$post_DURATION_CONTAINER_HUMAN_READABLE,$post_DURATION_CONTAINER_UNIXTIME,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE) = model_COMMON_presort_fault_arrays_report_3($post_FAULT_CONTAINER_TOPRATED,$post_FAULT_CONTAINER,$post_ENDTIME_CONTAINER,$post_STARTTIME_CONTAINER,$post_DURATION_CONTAINER_HUMAN_READABLE,$post_DURATION_CONTAINER_UNIXTIME,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE); */
	/* where... 
		-- $post_MACHINE_FAULT_INDEX_CONTAINER_TOPRATED = array '$machine_fault_index_container_TOPRATED' generated by 'model_COMMON_top_rated_fault_container_creation_report_3'
		-- $post_FAULT_CONTAINER_TOPRATED = array '$fault_container_TOPRATED' generated by 'model_COMMON_top_rated_fault_container_creation_report_3'
		-- $post_MODEL_MACHINE_COUNT_ADJUSTED = the adjusted 'count' variable from the model's localoptions[x].opt file
		-- $post_MODEL_MACHINE_FAULT_COUNT_ADJUSTED = the adjusted 'count' variable from the model's localoptions[x].opt file for the number of faults (or status / alarm / event / notification, etc..)
		-- $post_MACHINE_FAULT_INDEX_CONTAINER = array '$machine_fault_index_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_FAULT_CONTAINER = array '$fault_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_ENDTIME_CONTAINER = array '$endtime_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_STARTTIME_CONTAINER = array '$starttime_container' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_DURATION_CONTAINER_HUMAN_READABLE = array '$duration_container_human_readable' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_DURATION_CONTAINER_UNIXTIME = array '$duration_container_unixtime' generated by 'model_COMMON_fault_container_creation_report_3'
		-- $post_bypass_TOPRATED_CHECK_2 == 'ALLOW_FAULT_ID_ZERO' (OR DO NOT DEFINE!) allows a fault (or state or wahtever) with a logical value of '0' to
							be displayed.  Otherwise, only conditions with logical values greater than zero will be displayed (typically this
							is used to eliminate the ALARM / FAULT = "NONE" condition, which is defined most often as logical value '0'. 
							However, there are instances where we may want to display the time when a zero state was observed (such as
							when using this function to determine Tank Occupancy Time, and '0' represents an 'Empty' tank.
	   for example...
		-- $post_MACHINE_FAULT_INDEX_CONTAINER_TOPRATED = $machine_fault_index_container_TOPRATED
		-- $post_FAULT_CONTAINER_TOPRATED = $fault_container_TOPRATED
		-- $post_MODEL_MACHINE_COUNT_ADJUSTED = $CIPMODEL_COUNT_ADJUSTED
		-- $post_MODEL_MACHINE_FAULT_COUNT_ADJUSTED = $CIPMODEL_STATUS_COUNT_ADJUSTED
		-- $post_MACHINE_FAULT_INDEX_CONTAINER = $machine_fault_index_container
		-- $post_FAULT_CONTAINER = $fault_container
		-- $post_ENDTIME_CONTAINER = $endtime_container
		-- $post_STARTTIME_CONTAINER = $starttime_container
		-- $post_DURATION_CONTAINER_HUMAN_READABLE = $duration_container_human_readable
		-- $post_DURATION_CONTAINER_UNIXTIME = $duration_container_unixtime
	*/

	/* EXECUTE */
	/* -- All Systems */

	/* -- -- SORT THE TOPRATED FAULTS IN ORDER OF IMPORTANCE (MOST TIME ACTIVE) */
	/* -- -- note: good luck finding this function documented or referenced by what you might suspect it to be */
	/* --          it's listed for cross-linked arrays, but it works wonderfully for multidimensional arrays */
	/* -- -- chunk of the manpage... */
	/* -- -- 	array_multisort(array1,sorting order,sorting type,array2,array3...) */
	/* -- -- 							 		    */
	/* -- -- 	sorting order ... Optional. Specifies the sorting order. Possible values: */
	/* -- -- 		    		SORT_ASC Default. Sort in ascending order (A-Z) */
	/* -- -- 				SORT_DESC sort in descending order (Z-A) */
	/* -- -- 	sorting type ...  Optional. Specifies the type to use, when comparing elements. Possible values:*/
	/* -- -- 			    	SORT_REGULAR Default. Compare elements normally */
	/* -- -- 				SORT_NUMERIC Compare elements as numeric values */
	/* -- -- 				SORT_STRING Compare elements as string values */

	/* -- SORT THE TOTALS ARRAY */
	$mysql_query_internal_index = 0;
	while ( $mysql_query_internal_index <= $post_MACHINE_FAULT_INDEX_CONTAINER_TOPRATED ) {
		$testarray1[$mysql_query_internal_index] = $post_FAULT_CONTAINER_TOPRATED["machine"][$mysql_query_internal_index];
		$testarray2[$mysql_query_internal_index] = $post_FAULT_CONTAINER_TOPRATED["fault"][$mysql_query_internal_index];
		$testarray3[$mysql_query_internal_index] = $post_FAULT_CONTAINER_TOPRATED["endtime"][$mysql_query_internal_index];
		$testarray4[$mysql_query_internal_index] = $post_FAULT_CONTAINER_TOPRATED["starttime"][$mysql_query_internal_index];
		$testarray5[$mysql_query_internal_index] = $post_FAULT_CONTAINER_TOPRATED["duration_human_readable"][$mysql_query_internal_index];
		$testarray6[$mysql_query_internal_index] = $post_FAULT_CONTAINER_TOPRATED["duration_unixtime"][$mysql_query_internal_index];
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}

	$post_FAULT_CONTAINER_TOPRATED = array();

	$array_sort_retvar = array_multisort($testarray6, SORT_DESC, SORT_NUMERIC, $testarray1, $testarray2, $testarray3, $testarray4, $testarray5);
	if ($array_sort_retvar == TRUE) {
		$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO = "BGCOLOR='#CCFF66'";
	} else {
		$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO = "BGCOLOR='#FF8866'";
	}

	$mysql_query_internal_index = 0;
	while ( $mysql_query_internal_index <= $post_MACHINE_FAULT_INDEX_CONTAINER_TOPRATED ) {
		$post_FAULT_CONTAINER_TOPRATED["machine"][$mysql_query_internal_index] = $testarray1[$mysql_query_internal_index];
		$post_FAULT_CONTAINER_TOPRATED["fault"][$mysql_query_internal_index] = $testarray2[$mysql_query_internal_index];
		$post_FAULT_CONTAINER_TOPRATED["endtime"][$mysql_query_internal_index] = $testarray3[$mysql_query_internal_index];
		$post_FAULT_CONTAINER_TOPRATED["starttime"][$mysql_query_internal_index] = $testarray4[$mysql_query_internal_index];
		$post_FAULT_CONTAINER_TOPRATED["duration_human_readable"][$mysql_query_internal_index] = $testarray5[$mysql_query_internal_index];
		$post_FAULT_CONTAINER_TOPRATED["duration_unixtime"][$mysql_query_internal_index] = $testarray6[$mysql_query_internal_index];
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}
			
	$testarray1 = array();
	$testarray2 = array();
	$testarray3 = array();
	$testarray4 = array();
	$testarray5 = array();
	$testarray6 = array();

	/* -- SORT THE INDIVIDUAL MACHINE ARRAYS */
	$array_sort_retvar_FAULT_DETECTED = "NO";
	$mysql_query_master_index = 0;
	while ( $mysql_query_master_index <= $post_MODEL_MACHINE_COUNT_ADJUSTED ) {
		$MODEL_WORKING_MACHINENAME = $mysql_query_master_index;
		$mysql_query_internal_index = 0;
		while ( $mysql_query_internal_index <= $post_MACHINE_FAULT_INDEX_CONTAINER[$MODEL_WORKING_MACHINENAME] ) {
			$testarray1[$mysql_query_internal_index] = $post_FAULT_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index];
			$testarray2[$mysql_query_internal_index] = $post_ENDTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index];
			$testarray3[$mysql_query_internal_index] = $post_STARTTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index];
			$testarray4[$mysql_query_internal_index] = $post_DURATION_CONTAINER_HUMAN_READABLE[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index];
			$testarray5[$mysql_query_internal_index] = $post_DURATION_CONTAINER_UNIXTIME[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index];
			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}
		$post_FAULT_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = array();
		$post_ENDTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = array();
		$post_STARTTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = array();
		$post_DURATION_CONTAINER_HUMAN_READABLE[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = array();
		$post_DURATION_CONTAINER_UNIXTIME[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = array();
	
		$array_sort_retvar = array_multisort($testarray5, SORT_DESC, SORT_NUMERIC, $testarray1, $testarray2, $testarray3, $testarray4);
		if ($array_sort_retvar == TRUE) {
			$array_sort_retvar_OVERALL = "GOOD";
		} else {
			$array_sort_retvar_FAULT_DETECTED = "YES";
		}
	
		$mysql_query_internal_index = 0;
		while ( $mysql_query_internal_index <= $post_MACHINE_FAULT_INDEX_CONTAINER[$MODEL_WORKING_MACHINENAME] ) {
			$post_FAULT_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = $testarray1[$mysql_query_internal_index];
			$post_ENDTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = $testarray2[$mysql_query_internal_index];
			$post_STARTTIME_CONTAINER[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = $testarray3[$mysql_query_internal_index];
			$post_DURATION_CONTAINER_HUMAN_READABLE[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = $testarray4[$mysql_query_internal_index];
			$post_DURATION_CONTAINER_UNIXTIME[$MODEL_WORKING_MACHINENAME][$mysql_query_internal_index] = $testarray5[$mysql_query_internal_index];
			$mysql_query_internal_index = $mysql_query_internal_index + 1;
		}
				
		$testarray1 = array();
		$testarray2 = array();
		$testarray3 = array();
		$testarray4 = array();
		$testarray5 = array();

		$mysql_query_master_index = $mysql_query_master_index + 1;
			
	}

	if ( ($array_sort_retvar_OVERALL == 'GOOD') && ($array_sort_retvar_FAULT_DETECTED == 'NO') ) {
		$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE = "BGCOLOR='#CCFF66'";
	} else {
		$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE = "BGCOLOR='#FF8866'";
	}

	/* -- TOTALIZE TOP FAULTS - BUILD THE PARETO ARRAY */
	/* -- -- FORM IS... (note: the following is a 'readable' example, and does not represent proper code) */
	/* -- -- -- $post_FAULT_CONTAINER_TOTAL_TOPRATED["fault"][$post_MACHINE_FAULT_INDEX_CONTAINER_TOTAL_TOPRATED] = fault */
	/* -- -- -- $post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_human_readable"][$post_MACHINE_FAULT_INDEX_CONTAINER_TOTAL_TOPRATED] = duration in h_m_s */
	/* -- -- -- $post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_unixtime"][$post_MACHINE_FAULT_INDEX_CONTAINER_TOTAL_TOPRATED] = duration in seconds */
	/* -- -- -- $post_FAULT_CONTAINER_TOTAL_TOPRATED["frequency"][$post_MACHINE_FAULT_INDEX_CONTAINER_TOTAL_TOPRATED] = count per alarm */
	$mysql_query_internal_index = 0;
	while ( $mysql_query_internal_index <= $post_MODEL_MACHINE_FAULT_COUNT_ADJUSTED ) {
		$post_FAULT_CONTAINER_TOTAL_TOPRATED["key"][$mysql_query_internal_index] = $mysql_query_internal_index;
		$post_FAULT_CONTAINER_TOTAL_TOPRATED["fault"][$mysql_query_internal_index] = $mysql_query_internal_index;
		$post_FAULT_CONTAINER_TOTAL_TOPRATED["frequency"][$mysql_query_internal_index] = 0;
		$post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_unixtime"][$mysql_query_internal_index] = 0;
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}
		
	$mysql_query_internal_index = 0;
	while ( $mysql_query_internal_index <= $post_MACHINE_FAULT_INDEX_CONTAINER_TOPRATED ) {

		if ( ($post_FAULT_CONTAINER_TOPRATED["fault"][$mysql_query_internal_index] > 0) || ($post_bypass_TOPRATED_CHECK_2 == 'ALLOW_FAULT_ID_ZERO') ) {			$post_FAULT_CONTAINER_TOPRATED_CHECK = "GOOD";
		} else {
			$post_FAULT_CONTAINER_TOPRATED_CHECK = "BAD";
		}

		if ( $post_FAULT_CONTAINER_TOPRATED_CHECK == 'GOOD' ) {
			$fault_key = $post_FAULT_CONTAINER_TOPRATED["fault"][$mysql_query_internal_index];
			$post_FAULT_CONTAINER_TOTAL_TOPRATED["frequency"][$fault_key] = $post_FAULT_CONTAINER_TOTAL_TOPRATED["frequency"][$fault_key] + 1;
			$post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_unixtime"][$fault_key] = $post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_unixtime"][$fault_key] + $post_FAULT_CONTAINER_TOPRATED["duration_unixtime"][$mysql_query_internal_index];
		} else {
			/* pass */
		}
	
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}

	/* -- CALCULATE DURATION FOR EVERY ALARM STORED IN TOTALIZED TOP FAULT CONTAINER */
	$mysql_query_internal_index = 0;
	while ( $mysql_query_internal_index <= $post_MODEL_MACHINE_FAULT_COUNT_ADJUSTED ) {
		$time_key = $post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_unixtime"][$mysql_query_internal_index];
		$post_FAULT_CONTAINER_TOTAL_TOPRATED["duration_human_readable"][$mysql_query_internal_index] = unixtimeTOrealtime($time_key);
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}

	/* RETURN VARIABLES */
	return array($post_FAULT_CONTAINER_TOTAL_TOPRATED,$post_FAULT_CONTAINER_TOPRATED,$post_FAULT_CONTAINER,$post_ENDTIME_CONTAINER,$post_STARTTIME_CONTAINER,$post_DURATION_CONTAINER_HUMAN_READABLE,$post_DURATION_CONTAINER_UNIXTIME,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_PARETO,$MACHINEMODEL_BGCOLOR_USE_SORT_RESULT_DISCRETE_MACHINE);
}

/* DEPARTMENT LOCAL SET - REPORT - EVENTS (for GANTT CHART) */
/* EVENT CONTAINER FILL */
/* -- pull in faults (whether an alarm / status / state / fault / or just a notice / condition) */
/*    -- we simply call them 'faults' regardless, for sake of simplicity.  'event' would have been */
/*       a better word, but the whole thing is already coded, and we're not going to re-invent the */
/*       wheel here. */
/* -- assign duration to them, and parse out as needed */
function model_COMMON_event_container_fill_report_4 ($post_apache_ZERO_FAULT_DETECTED,$post_mysql_ENTRY_MACHINENAME,$post_mysql_mod_openopc_query_result,$post_EVENT_COLUMN_NAME,$post_EVENT_NAME_ARRAY,$post_gantt_chart_row_color)
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_ZERO_FAULT_DETECTED($post_apache_ZERO_FAULT_DETECTED,$post_mysql_ENTRY_MACHINENAME,$post_mysql_mod_openopc_query_result,$post_EVENT_COLUMN_NAME,$post_EVENT_NAME_ARRAY,$post_gantt_chart_row_color); */
	/* returns...
		$apache_ZERO_FAULT_DETECTED = 0 or 1  (directly)
		$apache_REPORT_RECORDENTRY (as a globalized variable)
	*/
	/* -- be sure the following variables are decalred BEFORE calling... */
	/*	-- $apache_ZERO_FAULT_DETECTED */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_REPORT_RECORDENTRY, $apache_REPORT_RECORDENTRY_POPUP_CANVAS;

	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING, $seer_SCANTIME_TO_CONSIDER_NEW_RECORD;

	/*	-- MySQL */
	global $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP;

	/* EXECUTE */
	while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($post_mysql_mod_openopc_query_result) ) {
		$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
		$mysql_mod_openopc_EVENT = $mysql_mod_openopc_query_row[$post_EVENT_COLUMN_NAME];
		/* -- CHECK IF THIS IS AN EXISTING FAULT OR A BRAND NEW ONE */
		if ( $fault_container[$machine_faultindex_container] == $mysql_mod_openopc_EVENT ) {
			$mysql_query_fault_existing_and_active = "yes";
			/* -- OK BUT NOW WE HAVE TO CHECK HOW LONG IT HAS BEEN SINCE THE LAST ENTRY WAS POSTED */
			/* -- IF IT HAS BEEN MORE THAN PREDEFINED SECONDS, THEN WE WILL CONSIDER IT A NEW ENTRY */
			/* -- CONSIDER THIS 'FUZZY' LOGIC */
			/* -- -- relies upon -- $seer_SCANTIME_TO_CONSIDER_NEW_RECORD */
			$apache_function_STARTTIME = $endtime_container[$machine_faultindex_container];
			$apache_function_ENDTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
			list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_function_STARTTIME,$apache_function_ENDTIME);
			if ( $apache_function_DURATION_UNIXTIME > $seer_SCANTIME_TO_CONSIDER_NEW_RECORD ) {
				$mysql_query_fault_existing_and_active = "no";
			} else {
				/* pass */
			}
		} else {
			$mysql_query_fault_existing_and_active = "no";
		}
		if ( $mysql_query_fault_existing_and_active == "yes" ) {
			/* -- HOW TO HANDLE IF THIS IS AN EXISTING FAULT */
			$endtime_container[$machine_faultindex_container] = $mysql_mod_openopc_WORKING_DATESTAMP;
		} else {
			/* -- HOW TO HANDLE IF THIS IS A BRAND NEW FAULT */
			$post_apache_ZERO_FAULT_DETECTED = 1;
			$machine_faultindex_container = $machine_faultindex_container + 1;
			$machine_faultindex_container_POSITION_OF_LAST_EVENT = $machine_faultindex_container;
			$fault_container[$machine_faultindex_container] = $mysql_mod_openopc_EVENT;
			$endtime_container[$machine_faultindex_container] = $mysql_mod_openopc_WORKING_DATESTAMP;
			$starttime_container[$machine_faultindex_container] = $mysql_mod_openopc_WORKING_DATESTAMP;
		}
	}

	/* -- CALCULATE DURATION FOR EVERY ALARM STORED IN CONTAINER - ALL MACHINES */
	$machine_faultindex_container_CYCLE = 1;
	while ( $machine_faultindex_container_CYCLE <= $machine_faultindex_container ) {
		$apache_function_STARTTIME = $starttime_container[$machine_faultindex_container_CYCLE];
		$apache_function_ENDTIME = $endtime_container[$machine_faultindex_container_CYCLE];
		list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_function_STARTTIME,$apache_function_ENDTIME);
		$duration_container_human_readable[$machine_faultindex_container_CYCLE] = $apache_function_DURATION_FINAL;
		$duration_container_unixtime[$machine_faultindex_container_CYCLE] = $apache_function_DURATION_UNIXTIME;
		/* -- BUILD CSV FOR EXPORT */
		/* -- -- MACHINE, FAULT, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME */
		$seer_EXPORT_MACHINE = $post_mysql_ENTRY_MACHINENAME;
		$seer_EXPORT_FAULT = $fault_container[$machine_faultindex_container_CYCLE];
		$seer_EXPORT_FAULT = $post_EVENT_NAME_ARRAY[$seer_EXPORT_FAULT];
		$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$seer_EXPORT_MACHINE.$seer_CSV_DELINEATION.$seer_EXPORT_FAULT.$seer_CSV_DELINEATION.$starttime_container[$machine_faultindex_container_CYCLE].$seer_CSV_DELINEATION.$endtime_container[$machine_faultindex_container_CYCLE].$seer_CSV_DELINEATION.$apache_function_DURATION_FINAL.$seer_CSV_DELINEATION.$apache_function_DURATION_UNIXTIME.$seer_CSV_ENDOFLINE_HOLDING;
		/* -- INDEX THE LOOP */
		$machine_faultindex_container_CYCLE = $machine_faultindex_container_CYCLE + 1;
	}

	/* -- GANTT ITEM ENTRIES */
	/* -- -- $gantt_item_name[$gantt_item_index] = name */
	/* -- -- $gantt_item_name_friendly[$gantt_item_index] = friendlyname */
	/* -- -- $gantt_item_entryslate[$gantt_item_index] = slate */
	/* -- -- $gantt_item_count = count */
	$gantt_item_count = 0;
	$machine_faultindex_container_CYCLE = 1;
	while ( $machine_faultindex_container_CYCLE <= $machine_faultindex_container_POSITION_OF_LAST_EVENT ) {
		$gantt_entry_exists = 0;
		$gantt_item_CYCLE = 0;
		while ( $gantt_item_CYCLE < $gantt_item_count ) {
			if ( $fault_container[$machine_faultindex_container_CYCLE] == $gantt_item_name[$gantt_item_CYCLE] ) {
				$gantt_entry_exists = 1;
				$gantt_entry_key = $gantt_item_CYCLE;
			} else {
				/* pass */
			}
			$gantt_item_CYCLE = $gantt_item_CYCLE + 1;
			}
		if ( $gantt_entry_exists == 1 ) {
			/* -- EXISTING ENTRY */
			$gantt_item_entryslate[$gantt_entry_key] = $gantt_item_entryslate[$gantt_entry_key]."QWERTYYTREWQ".$starttime_container[$machine_faultindex_container_CYCLE]."DVORAKKAROVD".$endtime_container[$machine_faultindex_container_CYCLE];
		} else {
			/* -- NEW ENTRY */
			$gantt_item_name[$gantt_item_count] = $fault_container[$machine_faultindex_container_CYCLE];
			$gantt_item_name_key = $gantt_item_name[$gantt_item_count];
			$gantt_item_name_friendly[$gantt_item_count] = $post_EVENT_NAME_ARRAY[$gantt_item_name_key];
			$gantt_item_entryslate[$gantt_item_count] = $starttime_container[$machine_faultindex_container_CYCLE]."DVORAKKAROVD".$endtime_container[$machine_faultindex_container_CYCLE];
			$gantt_item_POSITION_OF_LAST_EVENT = $gantt_item_count;
			$gantt_item_count = $gantt_item_count + 1;
		}
		$machine_faultindex_container_CYCLE = $machine_faultindex_container_CYCLE + 1;
	}

	/* -- POST GANTT ENTRIES */
	$gantt_index = 0;
	$gantt_pixel_offset_working = 0;
	$gantt_pixel_offset_working_POPUP_CANVAS = 0;
	while ( $gantt_index < $gantt_item_count ) {
		$apache_gantt_chart_item_name = $gantt_item_name_friendly[$gantt_index];
		$apache_gantt_chart_start = $mysql_query_START_DATESTAMP;
		$apache_gantt_chart_end = $mysql_query_END_DATESTAMP;
		$apache_gantt_chart_entryslate = $gantt_item_entryslate[$gantt_index];
		$apache_gantt_chart_rowcolor = $post_gantt_chart_row_color;
		list($gantt_item_generated_row,$gantt_pixel_offset_add) = ganttRow($apache_gantt_chart_item_name,$apache_gantt_chart_start, $apache_gantt_chart_end, $apache_gantt_chart_entryslate,$apache_gantt_chart_rowcolor,$gantt_pixel_offset_working);
		list($gantt_item_generated_row_POPUP_CANVAS,$gantt_pixel_offset_add_POPUP_CANVAS) = ganttRow($apache_gantt_chart_item_name,$apache_gantt_chart_start, $apache_gantt_chart_end, $apache_gantt_chart_entryslate,$apache_gantt_chart_rowcolor,$gantt_pixel_offset_working_POPUP_CANVAS,"POPUP");
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$gantt_item_generated_row;
		$apache_REPORT_RECORDENTRY_POPUP_CANVAS = $apache_REPORT_RECORDENTRY_POPUP_CANVAS.$gantt_item_generated_row_POPUP_CANVAS;
		$gantt_pixel_offset_working = $gantt_pixel_offset_working + $gantt_pixel_offset_add;
		$gantt_pixel_offset_working_POPUP_CANVAS = $gantt_pixel_offset_working_POPUP_CANVAS + $gantt_pixel_offset_add_POPUP_CANVAS;
		$gantt_index = $gantt_index + 1;
	}

	/* RETURN VARIABLES */
	return $post_apache_ZERO_FAULT_DETECTED;
}

?>
