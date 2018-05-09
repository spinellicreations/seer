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
SPF REPORT 3, 3A, 4 BODY (INCLUDED TO ALL SPFMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_8."</B><BR>
								<I>".$SPFMODEL_SUBPAGETITLE."</I><BR>
								<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_SPFMODEL_77,$multilang_STATIC_UNKNOWN,$multilang_STATIC_UNKNOWN);
	/* -- ADDITIONAL OPTIONS */
	$seer_AUTOSCALE_REPORT = $mysql_ENTRY_OPTIONNAME;
	$seer_DISPLAY_ALARMS = $mysql_ENTRY_OPTIONNAME_2;

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* CONVERT SPFNAME TO MACHINE ID NUMBER */
		$mysql_MACHINE_ID_NUMBER = model_COMMON_identify_logical_value_from_name($mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED);

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, MACHINE_NAME, MACHINE_TYPE, STATE, ALARM, TURBIDITY, SOURCE, DESTINATION1, DESTINATION2, SOURCE_FLOW, DESTINATION1_FLOW, DESTINATION2_FLOW, SOURCE_TOTAL_FLOW, DESTINATION1_TOTAL_FLOW, DESTINATION2_TOTAL_FLOW, POWER, POWER_TOTAL, BOWL_MOTOR_RPM, BASELINEPRESSURE, CONCENTRATION_RATIO, CONCENTRATION_VALVE_POSITION, PRESSURE_RAW, PRESSURE_PASTEURIZE, TEMPERATURE_INLET, TEMPERATURE_PASTEURIZE, HRS_SINCE_CLEAN";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* ZERO OUT CSV FOR EXPORT */
		model_SPF_export_csv_report_3_zero();

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		if ( $seer_AUTOSCALE_REPORT == 'YES' ) {
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($SPFMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		} else {
			$mysql_query_display_every_x_record = 1;
		}
		
		/* ZERO OUT OUR HOLDING AND INDEXING KEYS and SET SOME VARIABLES */
		$apache_REPORT_RECORDENTRY = "";
		$apache_SWITCH_ROW_COLOR = 0;
		$mysql_FIRST_RUN = 1;
		$mysql_query_index = 1;
		$mysql_CIP_CYCLE_ACTIVE = 0;
		$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 0;
		$mysql_holding_SOURCE = "8675309";
		$mysql_holding_DESTINATION1 = "8675309";
		$mysql_holding_DESTINATION2 = "8675309";
		$mysql_holding_SOURCE_FLOW = 0;
		$mysql_holding_DESTINATION1_FLOW = 0;
		$mysql_holding_DESTINATION2_FLOW = 0;
		$mysql_difference_SOURCE_FLOW = 0;
		$mysql_difference_DESTINATION1_FLOW = 0;
		$mysql_difference_DESTINATION2_FLOW = 0;
		$mysql_holding_POWER_TOTAL = 0;
		$mysql_totalized_SOURCE_FLOW = 0;
		$mysql_totalized_DESTINATION1_FLOW = 0;
		$mysql_totalized_DESTINATION2_FLOW = 0;
		$mysql_totalized_POWER = 0;
		$mysql_holding_CYCLE_START = 0;
		$mysql_holding_CYCLE_END = 0;
		$mysql_holding_DATESTAMP = 0;
		$mysql_holding_FIRST_CYCLE = 1;
		$apache_REPORT_RECORDENTRY_RECORD_GUTS = "";
		/* -- COLUMN WIDTH FOR HORIZONTAL BAR INDICATORS FOR ANALOG MEASUREMENTS */
		$apache_COLUMN_WIDTH_ANALOG = 75;

		/* ZERO OUT ALARM ARRAY */
		/* $alarm_DATESTAMP_START[X] = datestamp start of alarm id X */
		/* $alarm_DATESTAMP_END[X] = datestamp end of alarm id X */
		/* $alarm_NAME[X] = friendlyname of alarm id X */
		/* $alarm_COUNT = number of alarms, index from 1 */
		$alarm_DATESTAMP_START[0] = "NONE";
		$alarm_DATESTAMP_END[0] = "NONE";
		$alarm_NAME[0] = "NONE";
		$alarm_COUNT = 0;
		$mysql_ALARM_CYCLE_ACTIVE = 0;

		/* CYCLE THROUGH THE QUERY */
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_MACHINE_NAME = $mysql_mod_openopc_query_row['MACHINE_NAME'];
			$mysql_mod_openopc_WORKING_MACHINE_TYPE = $mysql_mod_openopc_query_row['MACHINE_TYPE'];
			$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
			$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row['ALARM'];
			$mysql_mod_openopc_WORKING_TURBIDITY = $mysql_mod_openopc_query_row['TURBIDITY'];
			$mysql_mod_openopc_WORKING_SOURCE = $mysql_mod_openopc_query_row['SOURCE'];
			$mysql_mod_openopc_WORKING_DESTINATION1 = $mysql_mod_openopc_query_row['DESTINATION1'];
			$mysql_mod_openopc_WORKING_DESTINATION2 = $mysql_mod_openopc_query_row['DESTINATION2'];
			$mysql_mod_openopc_WORKING_SOURCE_FLOW = $mysql_mod_openopc_query_row['SOURCE_FLOW'];
			$mysql_mod_openopc_WORKING_DESTINATION1_FLOW = $mysql_mod_openopc_query_row['DESTINATION1_FLOW'];
			$mysql_mod_openopc_WORKING_DESTINATION2_FLOW = $mysql_mod_openopc_query_row['DESTINATION2_FLOW'];
			$mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW = $mysql_mod_openopc_query_row['SOURCE_TOTAL_FLOW'];
			$mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW = $mysql_mod_openopc_query_row['DESTINATION1_TOTAL_FLOW'];
			$mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW = $mysql_mod_openopc_query_row['DESTINATION2_TOTAL_FLOW'];
			$mysql_mod_openopc_WORKING_POWER = $mysql_mod_openopc_query_row['POWER'];
			$mysql_mod_openopc_WORKING_POWER_TOTAL = $mysql_mod_openopc_query_row['POWER_TOTAL'];
			$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM = $mysql_mod_openopc_query_row['BOWL_MOTOR_RPM'];
			$mysql_mod_openopc_WORKING_BASELINEPRESSURE = $mysql_mod_openopc_query_row['BASELINEPRESSURE'];
			$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO = $mysql_mod_openopc_query_row['CONCENTRATION_RATIO'];
			$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION = $mysql_mod_openopc_query_row['CONCENTRATION_VALVE_POSITION'];
			$mysql_mod_openopc_WORKING_PRESSURE_RAW = $mysql_mod_openopc_query_row['PRESSURE_RAW'];
			$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = $mysql_mod_openopc_query_row['PRESSURE_PASTEURIZE'];
			$mysql_mod_openopc_WORKING_TEMPERATURE_INLET = $mysql_mod_openopc_query_row['TEMPERATURE_INLET'];
			$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = $mysql_mod_openopc_query_row['TEMPERATURE_PASTEURIZE'];
			$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN = $mysql_mod_openopc_query_row['HRS_SINCE_CLEAN'];

			/* CIP CYCLE */
			if ($mysql_CIP_CYCLE_ACTIVE == 1) {
				$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 0;
			} else {
				/* pass */
			}
			if ( ($mysql_CIP_CYCLE_ACTIVE == 0) && ($mysql_mod_openopc_WORKING_STATE == $SPFMODEL_STATE_CLEANING) ) {
				$mysql_CIP_CYCLE_ACTIVE = 1;
				$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 1;
			} else {
				/* pass */
			}
			if ( ($mysql_CIP_CYCLE_ACTIVE == 1) && ($mysql_mod_openopc_WORKING_STATE != $SPFMODEL_STATE_CLEANING) ) {
				$mysql_CIP_CYCLE_ACTIVE = 0;
				$mysql_CIP_CYCLE_ACTIVE_ONE_SHOT = 0;
				/* CYCLE START AND END DATESTAMP */
				$mysql_holding_CYCLE_START = $mysql_mod_openopc_WORKING_DATESTAMP;
				$mysql_holding_CYCLE_END = $mysql_mod_openopc_WORKING_DATESTAMP;
				/* BUGFIX */
				/* -- CLEAR OUT ANY CIP ANAMOLIES */
				$mysql_holding_DATESTAMP = $mysql_mod_openopc_WORKING_DATESTAMP;
				$mysql_holding_SOURCE = $mysql_mod_openopc_WORKING_SOURCE;
				$mysql_holding_DESTINATION1 = $mysql_mod_openopc_WORKING_DESTINATION1;
				$mysql_holding_DESTINATION2 = $mysql_mod_openopc_WORKING_DESTINATION2;
				$mysql_holding_SOURCE_FLOW = $mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW;
				$mysql_holding_DESTINATION1_FLOW = $mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW;
				$mysql_holding_DESTINATION2_FLOW = $mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW;
				$mysql_holding_POWER_TOTAL = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				$mysql_totalized_SOURCE_FLOW = 0;
				$mysql_totalized_DESTINATION1_FLOW = 0;
				$mysql_totalized_DESTINATION2_FLOW = 0;
				$mysql_totalized_POWER = 0;
				$alarm_DATESTAMP_START[0] = "NONE";
				$alarm_DATESTAMP_END[0] = "NONE";
				$alarm_NAME[0] = "NONE";
				$alarm_COUNT = 0;
				$mysql_ALARM_CYCLE_ACTIVE = 0;
				$apache_REPORT_RECORDENTRY_RECORD_GUTS = "";
				$mysql_holding_FIRST_CYCLE = 1;
			} else {
				/* pass */
			}

			/* CHECK IF OUR SOURCE AND DESTINATIONS ARE THE SAME */
			if ( ($mysql_holding_SOURCE != $mysql_mod_openopc_WORKING_SOURCE) || ($mysql_holding_DESTINATION1 != $mysql_mod_openopc_WORKING_DESTINATION1) || ($mysql_holding_DESTINATION2 != $mysql_mod_openopc_WORKING_DESTINATION2) || ($mysql_CIP_CYCLE_ACTIVE_ONE_SHOT == 1) ) {

				/* IF SOURCE OR DEST HAS CHANGED, POST TOTALS */
				if ($mysql_FIRST_RUN != 1) {
					model_SPF_build_report_3_body();
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='13' ALIGN='CENTER'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								";
					$mysql_FIRST_RUN = 0;
				}

				if ($mysql_CIP_CYCLE_ACTIVE == 0) {
					/* CYCLE START AND END DATESTAMP */
					$mysql_holding_CYCLE_START = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_holding_CYCLE_END = $mysql_mod_openopc_WORKING_DATESTAMP;
					/* IF SOURCE OR DEST HAS CHANGED, RECYCLE OUR SYSTEM DATA */
					$mysql_totalized_SOURCE_FLOW = 0;
					$mysql_totalized_DESTINATION1_FLOW = 0;
					$mysql_totalized_DESTINATION2_FLOW = 0;
					$mysql_totalized_POWER = 0;
					$alarm_DATESTAMP_START[0] = "NONE";
					$alarm_DATESTAMP_END[0] = "NONE";
					$alarm_NAME[0] = "NONE";
					$alarm_COUNT = 0;
					$mysql_ALARM_CYCLE_ACTIVE = 0;
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = "";
				} else {
					/* pass */
				}

				/* IF SOURCE OR DEST HAS CHANGED, RECYCLE OUR SYSTEM DATA */
				$mysql_holding_DATESTAMP = $mysql_mod_openopc_WORKING_DATESTAMP;
				$mysql_holding_SOURCE = $mysql_mod_openopc_WORKING_SOURCE;
				$mysql_holding_DESTINATION1 = $mysql_mod_openopc_WORKING_DESTINATION1;
				$mysql_holding_DESTINATION2 = $mysql_mod_openopc_WORKING_DESTINATION2;
				$mysql_holding_SOURCE_FLOW = $mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW;
				$mysql_holding_DESTINATION1_FLOW = $mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW;
				$mysql_holding_DESTINATION2_FLOW = $mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW;
				$mysql_holding_POWER_TOTAL = $mysql_mod_openopc_WORKING_POWER_TOTAL;
				$mysql_totalized_SOURCE_FLOW = 0;
				$mysql_totalized_DESTINATION1_FLOW = 0;
				$mysql_totalized_DESTINATION2_FLOW = 0;
				$mysql_totalized_POWER = 0;
				$alarm_DATESTAMP_START[0] = "NONE";
				$alarm_DATESTAMP_END[0] = "NONE";
				$alarm_NAME[0] = "NONE";
				$alarm_COUNT = 0;
				$mysql_ALARM_CYCLE_ACTIVE = 0;
				$apache_REPORT_RECORDENTRY_RECORD_GUTS = "";
				$mysql_holding_FIRST_CYCLE = 1;

			} else {
				if ($mysql_CIP_CYCLE_ACTIVE == 0) {

					/* CYCLE START AND END DATESTAMP */
					$mysql_holding_CYCLE_END = $mysql_mod_openopc_WORKING_DATESTAMP;

					/* CALCULATE CHANGE SINCE LAST SAMPLE */
					$mysql_difference_SOURCE_FLOW = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW, $mysql_holding_SOURCE_FLOW, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);
					$mysql_difference_DESTINATION1_FLOW = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW, $mysql_holding_DESTINATION1_FLOW, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);
					$mysql_difference_DESTINATION2_FLOW = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW, $mysql_holding_DESTINATION2_FLOW, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);
					$mysql_difference_POWER_TOTAL = model_SPF_totalizer_change_since_last_cycle_1($mysql_mod_openopc_WORKING_POWER_TOTAL, $mysql_holding_POWER_TOTAL, $mysql_holding_DATESTAMP, $mysql_mod_openopc_WORKING_DATESTAMP);

					/* UPDATE TOTALS */
					$mysql_totalized_SOURCE_FLOW = $mysql_totalized_SOURCE_FLOW + $mysql_difference_SOURCE_FLOW;
					$mysql_totalized_DESTINATION1_FLOW = $mysql_totalized_DESTINATION1_FLOW + $mysql_difference_DESTINATION1_FLOW;
					$mysql_totalized_DESTINATION2_FLOW = $mysql_totalized_DESTINATION2_FLOW + $mysql_difference_DESTINATION2_FLOW;
					$mysql_totalized_POWER = $mysql_totalized_POWER + $mysql_difference_POWER_TOTAL;

					/* UPDATE HOLDING VALUES */
					$mysql_holding_DATESTAMP = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_holding_SOURCE_FLOW = $mysql_mod_openopc_WORKING_SOURCE_TOTAL_FLOW;
					$mysql_holding_DESTINATION1_FLOW = $mysql_mod_openopc_WORKING_DESTINATION1_TOTAL_FLOW;
					$mysql_holding_DESTINATION2_FLOW = $mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW;
					$mysql_holding_POWER_TOTAL = $mysql_mod_openopc_WORKING_POWER_TOTAL;

					/* LOG ALARMS */
					if ($mysql_mod_openopc_WORKING_ALARM != 0) {
						if ( ($mysql_ALARM_CYCLE_ACTIVE == 1) && ($alarm_NAME[$alarm_COUNT] == $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM]) ) {
							$alarm_DATESTAMP_END[$alarm_COUNT] = $mysql_mod_openopc_WORKING_DATESTAMP;
						} else {
							$alarm_COUNT = $alarm_COUNT + 1;
							$alarm_DATESTAMP_START[$alarm_COUNT] = $mysql_mod_openopc_WORKING_DATESTAMP;
							$alarm_DATESTAMP_END[$alarm_COUNT] = $mysql_mod_openopc_WORKING_DATESTAMP;
							$alarm_NAME[$alarm_COUNT] = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];
						}
						$mysql_ALARM_CYCLE_ACTIVE = 1;
					} else {
						$mysql_ALARM_CYCLE_ACTIVE = 0;
					}
				} else {
					/* pass */
				}
			}

			if (($mysql_query_index == 1) && ($mysql_CIP_CYCLE_ACTIVE == 0)) {

				/* CONVERT NUMERIC VALUES TO LITERAL VALUES */
				$mysql_mod_openopc_WORKING_MACHINE_TYPE_FRIENDLY = $SPFMODEL_MACHINE_TYPE[$mysql_mod_openopc_WORKING_MACHINE_TYPE];
				$mysql_mod_openopc_WORKING_STATE_FRIENDLY = $SPFMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
				$mysql_mod_openopc_WORKING_ALARM_FRIENDLY = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM]; 
				$mysql_mod_openopc_WORKING_SOURCE_FRIENDLY = $SPFMODEL_SOURCE[$mysql_mod_openopc_WORKING_SOURCE];
				$mysql_mod_openopc_WORKING_DESTINATION1_FRIENDLY = $SPFMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION1];
				$mysql_mod_openopc_WORKING_DESTINATION2_FRIENDLY = $SPFMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION2];

				/* APPLY NOT APPLICABLE VALUE TO TURBIDITY FIELDS FOR MACHINES WITHOUT TURBIDITY MONITORING  */
				$SPFMODEL_CHECK_FOR_TURBIDITY_SENSOR_ON_THIS_MACHINE = $SPFMODEL_TURBIDITY_SENSOR_PRESENT[$mysql_MACHINE_ID_NUMBER];
				if ($SPFMODEL_CHECK_FOR_TURBIDITY_SENSOR_ON_THIS_MACHINE != 'YES') {
					$$mysql_mod_openopc_WORKING_TURBIDITY = "NOT_APPLICABLE";
				} else {
					/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
					$mysql_mod_openopc_WORKING_TURBIDITY_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_TURBIDITY,$SPFMODEL_RANGE_TURBIDITY_LOW,$SPFMODEL_RANGE_TURBIDITY_HIGH);
				}

				/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
				$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_SOURCE_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
				$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_DESTINATION1_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);

				/* APPLY NOT APPLICABLE VALUE TO UNNEEDED FIELDS - AND TOTALIZE ROLLING COUNTERS */
				$SPFMODEL_CHECK_FOR_TYPE = $mysql_mod_openopc_WORKING_MACHINE_TYPE{0};
				if ( $SPFMODEL_CHECK_FOR_TYPE == '1' ) {
					/* TYPE - SEPARATOR */
					$mysql_mod_openopc_WORKING_BASELINEPRESSURE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_RAW = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_INLET = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = "NOT_APPLICABLE";
					/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
					$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_DESTINATION2_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '2' ) {
					/* TYPE - CLARIFIER */
					$mysql_mod_openopc_WORKING_BASELINEPRESSURE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_RAW = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_INLET = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = "NOT_APPLICABLE";
					/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
					$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_DESTINATION2_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '3' ) {
					/* TYPE - ULTRA FILTRATION */
					$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_RAW = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_INLET = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = "NOT_APPLICABLE";
					/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
					$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_DESTINATION2_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
					$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_BASELINEPRESSURE,$SPFMODEL_RANGE_PRESSURE_LOW,$SPFMODEL_RANGE_PRESSURE_HIGH);
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '4' ) {
					/* TYPE - REVERSE OSSMOSIS */
					$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_RAW = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_INLET = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = "NOT_APPLICABLE";
					/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
					$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_DESTINATION2_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
					$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_BASELINEPRESSURE,$SPFMODEL_RANGE_PRESSURE_LOW,$SPFMODEL_RANGE_PRESSURE_HIGH);
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '5' ) {
					/* TYPE - HTST PASTEURIZER */
					$mysql_mod_openopc_WORKING_DESTINATION2_FRIENDLY = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_DESTINATION2_FLOW = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_DESTINATION2_TOTAL_FLOW = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_BASELINEPRESSURE = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO = "NOT_APPLICABLE";
					$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION = "NOT_APPLICABLE";
					/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
					$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL = $mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE - $mysql_mod_openopc_WORKING_PRESSURE_RAW;
					$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL,$SPFMODEL_RANGE_PRESSURE_LOW,$SPFMODEL_RANGE_PRESSURE_HIGH);
					$mysql_mod_openopc_WORKING_TEMPERATURE_INLET_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_TEMPERATURE_INLET,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
					$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR = core_display_horizontal_bar ($apache_COLUMN_WIDTH_ANALOG,$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
				} else {
					/* pass */
				}

				/* PUSH TO CSV FOR EXPORT */
				model_SPF_export_csv_report_3_build();

				/* MACHINE STATUS HEADER ROW */
				if ($mysql_holding_FIRST_CYCLE == 1) {
					/* MACHINE STATUS HEADER ROW FOR ALL TYPES */
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
								<TR>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_DATESTAMP_CAPS."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_69."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_18."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_30." <BR>[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_31." <BR>[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									";
					/* MACHINE STATUS HEADER ROW FOR SPECIFIC MACHINE TYPES */
					$SPFMODEL_CHECK_FOR_TYPE = $mysql_mod_openopc_WORKING_MACHINE_TYPE{0};
					if ( $SPFMODEL_CHECK_FOR_TYPE == '1' ) {
						/* ECHO ENTRIES FOR TYPE - SEPARATOR */
						$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_32." <BR>[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_36." <BR>[".$SPFMODEL_UM_ROTATIONAL_SPEED."]</U></B>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '2' ) {
						/* ECHO ENTRIES FOR TYPE - CLARIFIER */
						$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_32." <BR>[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_36." <BR>[".$SPFMODEL_UM_ROTATIONAL_SPEED."]</U></B>
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '3' ) {
						/* ECHO ENTRIES FOR TYPE - ULTRA FILTRATION */
						$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_32." <BR>[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_41." <BR>[".$SPFMODEL_UM_PRESSURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_42."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_43."</U></B>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '4' ) {
						/* ECHO ENTRIES FOR TYPE - REVERSE OSSMOSIS */
						$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_32." <BR>[".$SPFMODEL_UM_FLOW."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_41." <BR>[".$SPFMODEL_UM_PRESSURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_42."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_43."</U></B>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}
					if ( $SPFMODEL_CHECK_FOR_TYPE == '5' ) {
						/* ECHO ENTRIES FOR TYPE - HTST PASTEURIZER */
						$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_149." <BR>[".$SPFMODEL_UM_PRESSURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_37." <BR>[".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT' COLSPAN='2'>
										<B><U>".$multilang_SPFMODEL_38." <BR>[".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}

					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
								<TR>
									<TD COLSPAN='13'>
										<BR>
									</TD>
								</TR>
								";

					$mysql_holding_FIRST_CYCLE = 0;
				} else {
					/* pass */
				}

				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* MACHINE STATUS FOR ALL TYPES */
				$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='TOP' ALIGN='LEFT'>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_STATE_FRIENDLY."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN."
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_SOURCE_FLOW."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									";

				/* MACHINE STATUS FOR SPECIFIC MACHINE TYPES */
				$SPFMODEL_CHECK_FOR_TYPE = $mysql_mod_openopc_WORKING_MACHINE_TYPE{0};
				if ( $SPFMODEL_CHECK_FOR_TYPE == '1' ) {
					/* ECHO ENTRIES FOR TYPE - SEPARATOR */
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM."
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '2' ) {
					/* ECHO ENTRIES FOR TYPE - CLARIFIER */
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM."
									</TD>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '3' ) {
					/* ECHO ENTRIES FOR TYPE - ULTRA FILTRATION */
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_BASELINEPRESSURE."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO."
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '4' ) {
					/* ECHO ENTRIES FOR TYPE - REVERSE OSSMOSIS */
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_BASELINEPRESSURE."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO." / ".$SPFMODEL_CONCENTRATION_RATIO_DIVIDED_BY."
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '5' ) {
					/* ECHO ENTRIES FOR TYPE - HTST PASTEURIZER */
					$apache_REPORT_RECORDENTRY_RECORD_GUTS = $apache_REPORT_RECORDENTRY_RECORD_GUTS."
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_PRESSURE_DIFFERENTIAL_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_TEMPERATURE_INLET."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_INLET_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE."
									</TD>
									<TD CLASS='hmicellborder4' VALIGN='TOP'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
			} else {	
				/* pass */
			}

			/* INDEX THE QUERY - FOR AUTO SCALING REPORT SIZE */
			if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
				$mysql_query_index = 1;
			} else {
				$mysql_query_index =  $mysql_query_index + 1;
			}
		}

		/* PICK UP STRAGGLER RECORD */
		/* -- ONLY PICK UP A STRAGGLER IF IT HAS CONTENT */
		if ($apache_REPORT_RECORDENTRY_RECORD_GUTS != "") {
			model_SPF_build_report_3_body();
		} else {
			/* pass */
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='90'>
									</TD>
									<TD WIDTH='105'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='30'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='60'>
									</TD>
									<TD WIDTH='75'>
									</TD>
								</TR>		
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- OPTION FULFILLMENT */
		$custom_array_of_option_names="<OPTION VALUE='YES'>".$multilang_STATIC_YES."<OPTION VALUE='NO'>".$multilang_STATIC_NO;
		$custom_array_of_option_names2="<OPTION VALUE='NO'>".$multilang_STATIC_HIDE."<OPTION VALUE='YES'>".$multilang_STATIC_DISPLAY;
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='13'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_STATIC_AUTO_SCALE_DISPLAY,$custom_array_of_option_names,$multilang_STATIC_ALARMS,$custom_array_of_option_names2)."
									</TD>
								</TR>
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE BODY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY;
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* HANDLE FAULTS */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION_FAULT == 1 ) {
	$seer_HMIACTION = "DISPLAY_FAULT_PAGE";
} else {
	/* pass */
}

/* FAULT PAGE */
/* -- SOMETHING DIDN'T GO RIGHT, SO LET THE USER KNOW */
/* ------------------------------------------------------------------ */
core_user_conditionally_executed_fault_page_body();

/* START PAGE */
/* -- REPORT TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	/* OPTION FULFILLMENT */
	$custom_array_of_option_names="<OPTION VALUE='YES'>".$multilang_STATIC_YES."<OPTION VALUE='NO'>".$multilang_STATIC_NO;
	$custom_array_of_option_names2="<OPTION VALUE='NO'>".$multilang_STATIC_HIDE."<OPTION VALUE='YES'>".$multilang_STATIC_DISPLAY;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME,$multilang_SPFMODEL_110,$multilang_SPFMODEL_119,$multilang_STATIC_SHOW_DISCRETE_ALARM_INSTANCES,$multilang_STATIC_REPORT_TIME,$multilang_STATIC_AUTO_SCALE_DISPLAY,$custom_array_of_option_names,$multilang_STATIC_ALARMS,$custom_array_of_option_names2);
}
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY;
$apache_REPORTL6 = "";
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
