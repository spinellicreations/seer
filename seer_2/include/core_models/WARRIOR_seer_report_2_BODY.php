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
WARRIOR REPORT BODY 2 (INCLUDED TO ALL WARRIOR INSTANCES)
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
								<IMG SRC='./img/warrior_menu_0.png' BORDER='0' ALT='WARRIOR'><BR>
								<BR>
								<B>".$multilang_WARRIOR_20.": ".$multilang_WARRIOR_102."</B><BR>
								<I>".$WARRIOR_SUBPAGETITLE."</I><BR>
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
	/* HANDLE ANY CORRECTIVE ACTION POST MORTUM UPDATES IF USER REQUESTED THEM */
	model_WARRIOR_corrective_action_post_mortum();

	/* PULL IN VARIABLES */
	model_WARRIOR_user_date_time_range_input_type_w1("YES");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* BGCOLOR DECLARATION */
		$apache_REPORT_ROW_BGCOLOR = "";
		$apache_REPORT_ROW_BGCOLOR_ALT = "BGCOLOR='#DDDDDD'";
		$apache_SWITCH_ROW_COLOR = 0;
		$BLACK_CELL_COLOR = "BGCOLOR='#000000'";
		$PURPLE_CELL_COLOR = "BGCOLOR='#8D38C9'";
		$RED_CELL_COLOR = "BGCOLOR='#FF8866'";
		$YELLOW_CELL_COLOR = "BGCOLOR='#FFF380'";

		/* FIRST QUERY - PULL IN ALL DATA FROM DB THAT FALLS BETWEEN THE DATE RANGE */
		$mysql_mod_openopc_query = "DATESTAMP, MACHINE_NAME, CYCLES, PACKAGE_CLASS";
		if ( $JUMP_FROM_REPORT_0 == 'YES') {
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE ((DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINE_NAME LIKE '".$WARRIOR_NAME[$mysql_ENTRY_MACHINENAME]."')) ORDER BY MACHINE_NAME ASC, DATESTAMP DESC";	
		} else {
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE ((DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINE_NAME LIKE '".$WARRIOR_PRESET_PREFIX."%')) ORDER BY MACHINE_NAME ASC, DATESTAMP DESC";
		}

		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* ACCOUNT FOR NON EXISTENT DATA */
		if ($mysql_mod_openopc_query_result_count < 10 ) {

			/* DONT BUILD THE STATUS DISPLAY */
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_WARRIOR_39;

		} else {

			/* BUILD THE STATUS DISPLAY */
			
			/* BUILD ARRAY 1 */
			/* -- ARRAY STRUCTURE */
			/* -- -- WARRIOR_RUN_END[MACHINE][RUN_ID] 					- IDENTIFIES RUN_END for MACHINE AND WHICH RUN INDEX WE'RE ON */
			/* -- -- WARRIOR_RUN_START[MACHINE][RUN_ID] 					- IDENTIFIES RUN_START for MACHINE AND WHICH RUN INDEX WE'RE ON */
			/* -- -- WARRIOR_RUN_CYCLES_END[MACHINE][RUN_ID]				- IDENTIFIES NUMBER OF CYCLES AT END OF THIS RUN ID */
			/* -- -- WARRIOR_RUN_CYCLES_START[MACHINE][RUN_ID]				- IDENTIFIES NUMBER OF CYCLES AT START OF THIS RUN ID */
			/* -- -- WARRIOR_RUN_PACKAGE_CLASS[MACHINE][RUN_ID]				- IDENTIFIES THE PACKAGE BEING RUN DURING THAT RUN */
			/* -- -- WARRIOR_RUN_OPERATOR[MACHINE][RUN_ID]					- IDENTIFIES MACHINE OPERATOR FOR RUN */
			/* -- -- WARRIOR_RUN_JOB_NUMBER[MACHINE][RUN_ID]				- IDENTIFIES JOB NUMBER DURING RUN */
			/* -- -- WARRIOR_RUN_SCHEDULE_NUMBER[MACHINE][RUN_ID]				- IDENTIFIES SCHEDULE NUMBER DURING RUN */
			/* -- -- WARRIOR_RUN_ALARM_COUNT[$mysql_WORKING_RUN_MACHINE]					*/
			/* -- -- WARRIOR_RUN_ALARM_FLAG_COLOR[ALARM_ID][$mysql_WORKING_RUN_MACHINE]	- IDENTIFIES ALARM AS SCHEDULED DOWN, LUNCH OR BREAK, MAINT MODE, OR BREAKDOWN */
			/* -- -- WARRIOR_RUN_ALARM_START[ALARM_ID][$mysql_WORKING_RUN_MACHINE]				*/
			/* -- -- WARRIOR_RUN_ALARM_END[ALARM_ID][$mysql_WORKING_RUN_MACHINE]				*/
			/* -- -- WARRIOR_RUN_ALARM_DURATION[ALARM_ID][$mysql_WORKING_RUN_MACHINE]	- IDENTIFIES ALARM DURATION IN MINUTES */
			/* -- -- WARRIOR_RUN_ALARM_ALARM[ALARM_ID][$mysql_WORKING_RUN_MACHINE]				*/
			/* -- -- WARRIOR_RUN_ALARM_CORRECTIVE_ACTION[ALARM_ID][$mysql_WORKING_RUN_MACHINE]		*/
			/* -- -- WARRIOR_RUN_ALARM_SCHEDULE_NUMBER[ALARM_ID][$mysql_WORKING_RUN_MACHINE]		*/
			/* -- -- WARRIOR_RUN_ALARM_PACKAGE_CLASS[ALARM_ID][$mysql_WORKING_RUN_MACHINE]			*/
			/* -- -- WARRIOR_RUN_ALARM_JOB_DESCRIPTION[ALARM_ID][$mysql_WORKING_RUN_MACHINE]		*/
			/* -- -- WARRIOR_RUN_ALARM_OPERATOR[ALARM_ID][$mysql_WORKING_RUN_MACHINE]			*/
			/* -- -- WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE]					*/
			/* -- -- WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE]					*/
			/* -- -- WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE]					*/
			/* -- -- WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE]				*/
			/* -- -- WARRIOR_RUN_TOTAL_OEE_AVAILABILITY[$mysql_WORKING_RUN_MACHINE] 			*/
			/* -- -- WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] 				*/
			/* -- -- WARRIOR_RUN_TOTAL_OEE_OEE[$mysql_WORKING_RUN_MACHINE] 					*/
			/* -- -- WARRIOR_RUN_TOTAL_TEEP_LOADING[$mysql_WORKING_RUN_MACHINE]				*/
			/* -- -- WARRIOR_RUN_TOTAL_TEEP_TEEP[$mysql_WORKING_RUN_MACHINE] 				*/
			/* -- -- THERE ARE A FEW OTHERS LITTERED THROUGHOUT, BUT YOU GET THE GENERAL IDEA... 		*/
			/* -- -- THERE IS ALSO A SIMILAR, NON RUN-ID DELINEATED ARRAY, FOR THE TOTALIZATION OF VALUES ACROSS */
			/*	 	ALL LINES IN THE DEPARTMENT */
			/* -- -- WARRIOR_RUN_COUNT[MACHINE]			- IDENTIFIES HOW MANY UNIQUE CYCLES WE HAVE FOR EACH MACHINE */

			/* ZERO OUT HYBRID ARRAY */
			$mysql_query_index = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];

				$mysql_query_internal_index_1 = 0;
				while ($mysql_query_internal_index_1 <= $WARRIOR_DOWNTIME_and_NONSCHEDULED_CATEGORY_COUNT_ADJUSTED) {
					
					$WARRIOR_RUN_ALARM_HYBRID_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1] = 0;
					$WARRIOR_RUN_ALARM_HYBRID_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1] = 0;

					/* INDEX */
					$mysql_query_internal_index_1 = $mysql_query_internal_index_1 + 1;
				}

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;
			}

			/* ZERO OUT STANDARD ALARM ARRAY */
			$mysql_query_index = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];

				$mysql_query_internal_index_1 = 0;
				while ($mysql_query_internal_index_1 <= $WARRIOR_ALARM_COUNT_ADJUSTED) {

					while ($mysql_query_internal_index_2 <= $WARRIOR_ACTION_COUNT_ADJUSTED) {
						$WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2] = 0;
						$WARRIOR_RUN_ALARM_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2] = 0;

						/* INDEX */
						$mysql_query_internal_index_2 = $mysql_query_internal_index_2 + 1;
					}

					/* INDEX */
					$mysql_query_internal_index_1 = $mysql_query_internal_index_1 + 1;
				}

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;
			}

			/* ZERO OUT ARRAY 1 COUNTS */
			$mysql_query_index = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {
				$WARRIOR_EXAMINED = $WARRIOR_NAME[$mysql_query_index]; 
				$WARRIOR_RUN_COUNT[$WARRIOR_EXAMINED] = 0;
				$mysql_query_index = $mysql_query_index + 1;
			}

			/* ACCOUNT FOR SHIFT GAPS DUE TO HOUR SELECTION */
			$mysql_JUMP_SHIFT = "NO";
			
			/* IS START HOUR LESS THAN END HOUR */
			$mysql_START_HOUR_TRIMMED_TEST = $mysql_ENTRY_START_HOUR_MINUTE_COMBO;
			$mysql_END_HOUR_TRIMMED_TEST = $mysql_ENTRY_END_HOUR_MINUTE_COMBO;

			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {

				/* CHECK FOR THE HOUR OF THE DAY WINDOW -- SHIFT WINDOW */
				$mysql_WORKING_RUN_TEST = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_WORKING_RUN_TEST = substr($mysql_WORKING_RUN_TEST, -8);
				$mysql_WORKING_RUN_TEST = substr($mysql_WORKING_RUN_TEST, 0, -3);

				if ($mysql_START_HOUR_TRIMMED_TEST < $mysql_END_HOUR_TRIMMED_TEST) {
					/* IF START HOUR IS LESS THAN END HOUR CHOSEN, CHECK WITH THIS METHOD */
					if ( ($mysql_WORKING_RUN_TEST >= $mysql_START_HOUR_TRIMMED_TEST) && ($mysql_WORKING_RUN_TEST <= $mysql_END_HOUR_TRIMMED_TEST) ) {
						$mysql_WORKING_RUN_TEST_RESULT = "PASS";
					} else {
						$mysql_WORKING_RUN_TEST_RESULT = "FAIL";
					}
				} else {
					/* IF START HOUR IS GREATER THAN END HOUR CHOSEN, CHECK WITH THIS METHOD */
					if ( ($mysql_WORKING_RUN_TEST >= $mysql_START_HOUR_TRIMMED_TEST) || ($mysql_WORKING_RUN_TEST <= $mysql_END_HOUR_TRIMMED_TEST) ) {
						$mysql_WORKING_RUN_TEST_RESULT = "PASS";
					} else {
						$mysql_WORKING_RUN_TEST_RESULT = "FAIL";
					}
				}

				/* BUGFIX 20130101 */
				/* -- Normally, we want to check for whether or not the data point falls within the */
				/*    desired work shift.  However, when we jump from report 0 (GROSS THROUGHPUT), we */
				/*    already know that the data point is within the work shift, and we want to look */
				/*    at every single data point. */
				/*    Prior to this fix, issues were observed when running report over 24 hours in */
				/*    length. */
				if (($mysql_WORKING_RUN_TEST_RESULT == "PASS") || ($JUMP_FROM_REPORT_0 == 'YES')) {

					/* PROCESS DATA POINT */
					$mysql_WORKING_RUN_END = $mysql_mod_openopc_query_row['DATESTAMP'];
					$mysql_WORKING_RUN_CYCLES = $mysql_mod_openopc_query_row['CYCLES'];
					$mysql_WORKING_RUN_MACHINE = $mysql_mod_openopc_query_row['MACHINE_NAME'];
					$mysql_WORKING_RUN_PACKAGE_CLASS = $mysql_mod_openopc_query_row['PACKAGE_CLASS'];

					$COUNT_EXAMINED = $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE];
					$COUNT_EXAMINED_MINUS_ONE = $COUNT_EXAMINED - 1;
					if ($COUNT_EXAMINDED_MINUS_ONE == -1) {
						$HOLDING_EXAMINED = 0;
						$HOLDING_PACKAGE_CLASS_EXAMINED = 8675309;
					} else {
						$HOLDING_EXAMINED = $WARRIOR_RUN_CYCLES_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
						$HOLDING_PACKAGE_CLASS_EXAMINED = $WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
					}
					if ( ($mysql_WORKING_RUN_CYCLES > $HOLDING_EXAMINED) || ($mysql_JUMP_SHIFT == 'YES') || ($mysql_WORKING_RUN_PACKAGE_CLASS != $HOLDING_PACKAGE_CLASS_EXAMINED)) {

						/* CREATE NEW RECORD */
						$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_END;
						$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_END;
						$WARRIOR_RUN_CYCLES_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_CYCLES;
						$WARRIOR_RUN_CYCLES_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_CYCLES;
						$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_PACKAGE_CLASS;

						/* INDEX MACHINE RUN COUNT */
						$WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE] + 1;
						
						/* UNLATCH JUMP SHIFT */
						$mysql_JUMP_SHIFT = "NO";


					} else {

						/* UPDATE EXISTING RECORD */
						$WARRIOR_RUN_CYCLES_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE] = $mysql_WORKING_RUN_CYCLES;
						$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE] = $mysql_WORKING_RUN_END;
					}

				} else {
					/* ACCOUNT FOR SHIFT GAPS DUE TO HOUR SELECTION */
					$mysql_JUMP_SHIFT = "YES";
				}

			}

			/* CYCLE THROUGH ARRAY 1 */
			/* -- HEADER FOR SECTION "DISCRETE TOTALS - INDIVIDUAL ALARM AND DOWNTIME INSTANCES" */
			/* -- -- BLACK CELL INDICATES SCHEDULDED DOWN */
			/* -- -- PURPLE CELL INDICATES A BREAK OR REST PERIOD FOR OPERATOR */
			/* -- -- RED CELL INDICATES DOWNTIME */
			$apache_REPORT_RECORDENTRY_2 = "
							<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='125'>
									</TD>
									<TD WIDTH='300'>
									</TD>
									<TD WIDTH='75'>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='5'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											<B>[".$multilang_WARRIOR_86."]: ".$multilang_WARRIOR_105."</B>...
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ".$BLACK_CELL_COLOR.">
										<BR>
									</TD>
									<TD COLSPAN='3'>
										-- ".$multilang_WARRIOR_114."
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ".$PURPLE_CELL_COLOR.">
										<BR>
									</TD>
									<TD COLSPAN='3'>
										-- ".$multilang_WARRIOR_115."
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ".$RED_CELL_COLOR.">
										<BR>
									</TD>
									<TD COLSPAN='3'>
										-- ".$multilang_WARRIOR_116."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

			/* ZERO OUT CSV FOR EXPORT */
			model_WARRIOR_csv_and_csv2_zero_r2();

			/* BORDER OFF CSV2 FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv2_export_r2_border_12_column();

			$mysql_query_index = 0;
			$WARRIOR_RUN_TOTAL_UNITS['ALL'] = 0;
			$WARRIOR_RUN_TOTAL_MASS['ALL'] = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {
				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$apache_DISCRETE_OCCURRANCE_HEADER[$mysql_WORKING_RUN_MACHINE] = "PENDING";
				$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_OEE_AVAILABILITY[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_OEE_OEE[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_TEEP_LOADING[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_TEEP_TEEP[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_ALARM_COUNT[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_ALARM_PRINTER_NEED_HEADER = 1;
				$WARRIOR_ALARM_PRINTER_INDEX = 1;
				$mysql_query_internal_index = 0;
				while ($mysql_query_internal_index < $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE]) {

				/* REGARDING THE CONTENT OF THIS WHILE LOOP */
				/* ---------------------------------------- */
				/* THE FOLLOWING IS MOSTLY TAKEN FROM WARRIOR_seer_HMI_0_BODY, WHICH IS ALL FINE AND WELL */
				/*     HOWEVER IT IS PRUDENT TO NOTE THAT, BASICALLY, THIS REPORT (2) IS QUITE DIFFICULT TO PARSE */
				/*     -- WE'VE GOT TO FIRST DETERMINE WHAT OUR INDIVIDUAL 'RUN' INSTANCES ARE, AND THEN DEFINE THEM BY */
				/*        START AND END TIMES... WELL THAT'S ONE QUERY */
				/*     -- THEN WE HAVE TO GO BACK AND RE-QUERY EACH INDIVIDUAL 'RUN' INSTANCE AND ANALYZE THE DATA CONTAINED */
				/*	  WITHIN FOR IT */
				/*     -- THEN, WE HAVE TO TOTALIZE OVER THE ANALYSIS OF THOSE INDIVIDUAL 'RUN' INSTANCES */
				/*	IT WOULD HAVE BEEN MUCH MORE ELOQUENT TO DO THIS WITH ONE QUERY, BUT THE AMOUNT OF HOOKS AND SWITCHES */
				/*      NECESSARY TO PULL IT OFF WERE BECOMING GREATER AND GREATER BY THE MINUTE.  ULTIMATELY, I GAVE UP, AND */
				/*      HAVE REVERTED TO THIS METHOD.  IT EFFECTIVELY INCREASES DATABASE LOAD BY WHAT I'D ESTIMATE TO BE ABOUT */
				/*      50 PERCENT ABOVE THE 'SINGLE QUERY' METHOD... SO THE REPORT WILL TAKE ABOUT THAT MUCH LONGER TO GENERATE */
				/*      BUT THE CODE IS CLEANER, WILL MAKE TREMENDOUSLY MORE SENSE, AND WILL BE EASIER TO BUILD UPON IN THE FUTURE */
				/*      AGAIN, MY APOLOGIES FOR THE REDUNDANT QUERYING, BUT IT IS WHAT IT IS */

					$mysql_mod_openopc_query = "*";
					$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE ( (DATESTAMP BETWEEN '".$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."' AND '".$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."') AND (MACHINE_NAME LIKE '".$mysql_WORKING_RUN_MACHINE."') ) ORDER BY DATESTAMP DESC";

					list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

					/* ACCOUNT FOR NON EXISTENT DATA */
					$apache_REPORT_RECORDENTRY = "";

					/* PREP */
					model_WARRIOR_hmi_report_body_prep();

						while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($WARRIOR_EXAMINE_RECENT_HISTORY == 1) ) {

							if ($WARRIOR_RESULT_FIRSTRUN == 1) {

								/* SPECIAL BEHAVIOR IF FIRST RUN */
								/* -- ZERO DOWNTIME ACTIVITY */
								$WARRIOR_DOWNTIME_ACTIVE = 0;
								$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE = 0;
								/* -- QUERY RESULTS */
								$WARRIOR_RESULT_CURRENT_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
								$WARRIOR_RESULT_CURRENT_DATESTAMP_START = $WARRIOR_RESULT_CURRENT_DATESTAMP;
								$WARRIOR_RESULT_CURRENT_OPERATOR = $mysql_mod_openopc_query_row['OPERATOR'];
								$WARRIOR_RESULT_CURRENT_STATE = $mysql_mod_openopc_query_row['STATE'];
								$WARRIOR_RESULT_CURRENT_ALARM = $mysql_mod_openopc_query_row['ALARM'];
								$WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION = $mysql_mod_openopc_query_row['CORRECTIVE_ACTION'];
								$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS = $mysql_mod_openopc_query_row['PACKAGE_CLASS'];
								$WARRIOR_RESULT_CURRENT_PACKAGES_PER_CYCLE = $mysql_mod_openopc_query_row['PACKAGES_PER_CYCLE'];
								$WARRIOR_RESULT_CURRENT_CYCLES_END = $mysql_mod_openopc_query_row['CYCLES'];
								$WARRIOR_RESULT_CURRENT_CYCLES_START = $mysql_mod_openopc_query_row['CYCLES'];
								$WARRIOR_RESULT_CURRENT_JOB_NUMBER = $mysql_mod_openopc_query_row['JOB_NUMBER'];
								$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER = $mysql_mod_openopc_query_row['SCHEDULE_NUMBER'];
								$WARRIOR_RESULT_TEST_PACKAGE_CLASS = $mysql_mod_openopc_query_row['PACKAGE_CLASS'];

								/* UPDATE CHECKSTOPS */
								$WARRIOR_CHECKSTOP_JOB_NUMBER = $WARRIOR_RESULT_CURRENT_JOB_NUMBER;
								$WARRIOR_CHECKSTOP_SCHEDULE_NUMBER = $WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER;
								$WARRIOR_CHECKSTOP_CORRECTIVE_ACTION = $WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION;
								$WARRIOR_CHECKSTOP_ALARM = $WARRIOR_RESULT_CURRENT_ALARM;
								$WARRIOR_CHECKSTOP_STATE = $WARRIOR_RESULT_CURRENT_STATE;
								$WARRIOR_CHECKSTOP_DATESTAMP_END = $WARRIOR_RESULT_CURRENT_DATESTAMP;
								$WARRIOR_CHECKSTOP_DATESTAMP_START = $WARRIOR_RESULT_CURRENT_DATESTAMP;
								$WARRIOR_CHECKSTOP_CYCLES = $WARRIOR_RESULT_CURRENT_CYCLES_END;

								/* CONVERT TO FRIENDLY NAMES */
								$WARRIOR_FLAG_CORRECTIVE_ACTION = 0;
								$WARRIOR_FLAG_MAINT_MODE = 0;

								/* -- STATE */
								/* -------- */
								list($WARRIOR_RESULT_CURRENT_STATE_FRIENDLYNAME,$apache_REPORT_ROW_BGCOLOR_CURRENT_STATE,$WARRIOR_FLAG_MAINT_MODE,$WARRIOR_FLAG_CORRECTIVE_ACTION) = model_WARRIOR_friendly_state_with_highlight_color($WARRIOR_RESULT_CURRENT_STATE);
								/* -- CURRENT ALARM */
								/* ---------------- */
								$WARRIOR_RESULT_CURRENT_ALARM_FRIENDLYNAME = $WARRIOR_ALARM[$WARRIOR_RESULT_CURRENT_ALARM];
								/* -- CURRENT CORRECTIVE ACTION */
								/* ---------------------------- */
								list($WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION_FRIENDLYNAME,$apache_REPORT_ROW_BGCOLOR_CURRENT_STATE) = model_WARRIOR_friendly_action($WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION,$WARRIOR_RESULT_CURRENT_STATE,$WARRIOR_FLAG_MAINT_MODE,$apache_REPORT_ROW_BGCOLOR_CURRENT_STATE);
								/* -- CURRENT PACKAGE CLASS */
								/* ------------------------ */
								$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS_FRIENDLYNAME = $WARRIOR_PACKAGE[$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS];
								$WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_COUNT = $WARRIOR_PACKAGE_UNIT_COUNT[$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS];
								$WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_MASS = $WARRIOR_PACKAGE_UNIT_MASS[$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS];
								/* -- CURRENT PACKAGES PER CYCLE */
								/* ----------------------------- */
								$WARRIOR_RESULT_CURRENT_PACKAGES_END = $WARRIOR_RESULT_CURRENT_CYCLES_END * $WARRIOR_RESULT_CURRENT_PACKAGES_PER_CYCLE;
								$WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_END = $WARRIOR_RESULT_CURRENT_PACKAGES_END * $WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_COUNT;
								$WARRIOR_RESULT_CURRENT_MASS_END = varcharTOnumeric2($WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_END * $WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_MASS);
								/* -- CURRENT OPERATOR */
								/* ------------------- */
								$WARRIOR_RESULT_CURRENT_OPERATOR_FRIENDLYNAME = model_WARRIOR_friendly_operator($WARRIOR_RESULT_CURRENT_OPERATOR);
								/* -- CURRENT JOB NUMBER */
								/* --------------------- */
								$WARRIOR_RESULT_CURRENT_JOB_NUMBER_FRIENDLYNAME = model_WARRIOR_friendly_jobnumber($WARRIOR_RESULT_CURRENT_JOB_NUMBER);

								/* DEACTIVE FIRST RUN */
								$WARRIOR_RESULT_FIRSTRUN = 0;

							} else {
								/* STANDARD BEHAVIOR FOR SUBSEQUENT RUNS */
								$WARRIOR_RESULT_CURRENT_DATESTAMP_START = $mysql_mod_openopc_query_row['DATESTAMP'];
								$WARRIOR_RESULT_CURRENT_CYCLES_START = $mysql_mod_openopc_query_row['CYCLES'];
								$WARRIOR_RESULT_CURRENT_STATE = $mysql_mod_openopc_query_row['STATE'];
								$WARRIOR_RESULT_CURRENT_ALARM = $mysql_mod_openopc_query_row['ALARM'];
								$WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION = $mysql_mod_openopc_query_row['CORRECTIVE_ACTION'];
								$WARRIOR_RESULT_CURRENT_CYCLES_START = $mysql_mod_openopc_query_row['CYCLES'];
								$WARRIOR_RESULT_CURRENT_JOB_NUMBER = $mysql_mod_openopc_query_row['JOB_NUMBER'];
								$WARRIOR_RESULT_CURRENT_SCHEDULE_NUMBER = $mysql_mod_openopc_query_row['SCHEDULE_NUMBER'];
								$WARRIOR_RESULT_TEST_PACKAGE_CLASS = $mysql_mod_openopc_query_row['PACKAGE_CLASS'];

								/* ASSESS CONDITION OF DOWNTIME */
								model_WARRIOR_assess_condition_of_downtime();

								/* UPDATE DOWNTIME CHECKSTOPS */
								if ($WARRIOR_CONDITION_ACTIVE_THIS_DATA_DOWNTIME == 1) {
									if ($WARRIOR_DOWNTIME_ACTIVE == 1) {
										$WARRIOR_DOWNTIME_ACTIVE_START = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
										$WARRIOR_DOWNTIME_ACTIVE_IDENTITY = $WARRIOR_RESULT_CURRENT_ALARM;
									} else {
										$WARRIOR_DOWNTIME_ACTIVE_IDENTITY = $WARRIOR_RESULT_CURRENT_ALARM;
										$WARRIOR_DOWNTIME_ACTIVE_CORRECTIVE_ACTION = $WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION;
										$WARRIOR_DOWNTIME_ACTIVE_START = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
										$WARRIOR_DOWNTIME_ACTIVE_END = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
										/* MACHINE IS DOWN HARD -- RED */
										$WARRIOR_RESULT_CURRENT_ALARM_FLAG_BGCOLOR = $RED_CELL_COLOR;
									}
									if ($WARRIOR_SCHEDULED_DOWNTIME_ACTIVE == 1) {
										$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_START = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
									} else {
										/* pass */
									}
									$WARRIOR_DOWNTIME_ACTIVE = 1;
									/* BUGFIX 20110705 */
									/* $WARRIOR_SCHEDULED_DOWNTIME_ACTIVE = 0; */
									$WARRIOR_CONDITION_ACTIVE_THIS_DATA_DOWNTIME = 0;
								} else {
									if ($WARRIOR_DOWNTIME_ACTIVE == 1) {
										$WARRIOR_PROCESS_DOWNTIME_ACTIVE = 1;
									} else {
										$WARRIOR_PROCESS_DOWNTIME_ACTIVE = 0;
									}
									$WARRIOR_DOWNTIME_ACTIVE = 0;
								}
								if ($WARRIOR_CONDITION_ACTIVE_THIS_DATA_SCHEDULED_DOWNTIME == 1) {
									if ($WARRIOR_SCHEDULED_DOWNTIME_ACTIVE == 1) {
										$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_START = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
									} else {
										$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_IDENTITY = $WARRIOR_RESULT_CURRENT_ALARM;
										$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_CORRECTIVE_ACTION = $WARRIOR_RESULT_CURRENT_CORRECTIVE_ACTION;
										$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_START = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
										$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_END = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
										if ($WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_CORRECTIVE_ACTION == 2) {
											/* MACHINE IS SCHEDULED DOWN  -- BLACK*/
											$WARRIOR_RESULT_CURRENT_SCH_ALARM_FLAG_BGCOLOR = $BLACK_CELL_COLOR;
										} else {
											if ($WARRIOR_SCHEDULED_DOWNTIME_ACTIVE_CORRECTIVE_ACTION == 3) {
												/* OPERATOR IS ON BREAK -- PURPLE */
												$WARRIOR_RESULT_CURRENT_SCH_ALARM_FLAG_BGCOLOR = $PURPLE_CELL_COLOR;
											} else {
												/* MACHINE IS DOWN HARD -- RED */
												$WARRIOR_RESULT_CURRENT_SCH_ALARM_FLAG_BGCOLOR = $RED_CELL_COLOR;
											}
										}
									}
									if ($WARRIOR_DOWNTIME_ACTIVE == 1) {
										$WARRIOR_DOWNTIME_ACTIVE_START = $WARRIOR_RESULT_CURRENT_DATESTAMP_START;
									} else {
										/* pass */
									}
									$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE = 1;
									/* BUGFIX 20110705 */
									/* $WARRIOR_DOWNTIME_ACTIVE = 0; */
									$WARRIOR_CONDITION_ACTIVE_THIS_DATA_SCHEDULED_DOWNTIME = 0;
								} else {
									if ($WARRIOR_SCHEDULED_DOWNTIME_ACTIVE == 1) {
										$WARRIOR_PROCESS_SCHEDULED_DOWNTIME_ACTIVE = 1;
									} else {
										$WARRIOR_PROCESS_SCHEDULED_DOWNTIME_ACTIVE = 0;
									}
									$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE = 0;
								}

								/* UPDATE DOWNTIME TOTALS */
								model_WARRIOR_update_downtime_totals("LONGFORM");

								/* SCRUTINIZE HISTORY */
								model_WARRIOR_scrutinize_history_REV2();
							}
						}

						/* BEFORE WE PICK UP THE STRAGGLERS, MAKE SURE THAT ANY ACTIVE */
						/* DOWNTIME WILL BE PROCESSED */
						/* -- BUGFIX 20110704 */
						/* DOWNTIME */
						if ($WARRIOR_DOWNTIME_ACTIVE == 1) {
							$WARRIOR_PROCESS_DOWNTIME_ACTIVE = 1;
						} else {
							$WARRIOR_PROCESS_DOWNTIME_ACTIVE = 0;
						}
						$WARRIOR_DOWNTIME_ACTIVE = 0;
						/* SCHEDULED DOWNTIME */
						if ($WARRIOR_SCHEDULED_DOWNTIME_ACTIVE == 1) {
							$WARRIOR_PROCESS_SCHEDULED_DOWNTIME_ACTIVE = 1;
						} else {
							$WARRIOR_PROCESS_SCHEDULED_DOWNTIME_ACTIVE = 0;
						}
						$WARRIOR_SCHEDULED_DOWNTIME_ACTIVE = 0;

						/* PICK UP THE STRAGGLERS */
						model_WARRIOR_update_downtime_totals("LONGFORM");

						/* TOTALIZE */
						$WARRIOR_TOTAL_CYCLES = $WARRIOR_RESULT_CURRENT_CYCLES_END - $WARRIOR_CHECKSTOP_CYCLES;
						$WARRIOR_TOTAL_PACKAGES = $WARRIOR_TOTAL_CYCLES * $WARRIOR_RESULT_CURRENT_PACKAGES_PER_CYCLE;
						$WARRIOR_TOTAL_UNITS = $WARRIOR_TOTAL_PACKAGES * $WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_COUNT;
						$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_TOTAL_UNITS;
						$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE]);
						$WARRIOR_TOTAL_MASS = varcharTOnumeric2($WARRIOR_TOTAL_UNITS * $WARRIOR_RESULT_CURRENT_PACKAGE_UNIT_MASS);
						$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_TOTAL_MASS;
						$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE]);

						/* DURATION of RUN (THUS FAR, AND REMEMBER, WE ONLY LOOK AT [TIME WINDOW] SO */
						/* IT IS BETTER STATED AS 'DURATION OF RUN WITHIN TIME WINDOW') */
						$apache_function_STARTTIME = $WARRIOR_CHECKSTOP_DATESTAMP_START;
						$apache_function_ENDTIME = $WARRIOR_CHECKSTOP_DATESTAMP_END;
						list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_function_STARTTIME,$apache_function_ENDTIME);
						$WARRIOR_TOTAL_DURATION_READABLE = $apache_function_DURATION_FINAL;
						$WARRIOR_TOTAL_DURATION_UNIXTIME = $apache_function_DURATION_UNIXTIME;
						$WARRIOR_TOTAL_DURATION_MINUTES = $WARRIOR_TOTAL_DURATION_UNIXTIME / 60;
						$WARRIOR_TOTAL_DURATION_MINUTES = varcharTOnumeric2($WARRIOR_TOTAL_DURATION_MINUTES, 2);
						$WARRIOR_TOTAL_DURATION_HOURS = $WARRIOR_TOTAL_DURATION_UNIXTIME / 3600;
						$WARRIOR_TOTAL_DURATION_HOURS = varcharTOnumeric2($WARRIOR_TOTAL_DURATION_HOURS, 2);

						$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_TOTAL_DURATION_HOURS;
						$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE], 2);

						/* TOTALS FINALIZED */
						if (isset($WARRIOR_TOTAL_DOWNTIME_UNIXTIME)) {
							/* pass */
						} else {
							$WARRIOR_TOTAL_DOWNTIME_UNIXTIME = 0;
						}
						if (isset($WARRIOR_TOTAL_SCHEDULED_DOWNTIME_UNIXTIME)) {
							/* pass */
						} else {
							$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_UNIXTIME = 0;
						}
						$WARRIOR_TOTAL_DOWNTIME_MINUTES = $WARRIOR_TOTAL_DOWNTIME_UNIXTIME / 60;
						$WARRIOR_TOTAL_DOWNTIME_MINUTES = varcharTOnumeric2($WARRIOR_TOTAL_DOWNTIME_MINUTES, 2);
						$WARRIOR_TOTAL_DOWNTIME_HOURS = $WARRIOR_TOTAL_DOWNTIME_UNIXTIME / 3600;
						$WARRIOR_TOTAL_DOWNTIME_HOURS = varcharTOnumeric2($WARRIOR_TOTAL_DOWNTIME_HOURS, 2);
						$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_TOTAL_DOWNTIME_HOURS;
						$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE], 2);
						$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_MINUTES = $WARRIOR_TOTAL_SCHEDULED_DOWNTIME_UNIXTIME / 60;
						$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_MINUTES = varcharTOnumeric2($WARRIOR_TOTAL_SCHEDULED_DOWNTIME_MINUTES, 2);
						$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_HOURS = $WARRIOR_TOTAL_SCHEDULED_DOWNTIME_UNIXTIME / 3600;
						$WARRIOR_TOTAL_SCHEDULED_DOWNTIME_HOURS = varcharTOnumeric2($WARRIOR_TOTAL_SCHEDULED_DOWNTIME_HOURS, 2);
						$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_TOTAL_SCHEDULED_DOWNTIME_HOURS;
						$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE], 2);
						$WARRIOR_TOTAL_RUN_MINUTES = $WARRIOR_TOTAL_DURATION_MINUTES - ($WARRIOR_TOTAL_DOWNTIME_MINUTES + $WARRIOR_TOTAL_SCHEDULED_DOWNTIME_MINUTES);
						$WARRIOR_TOTAL_RUN_MINUTES = varcharTOnumeric2($WARRIOR_TOTAL_RUN_MINUTES, 2);
						$WARRIOR_TOTAL_RUN_HOURS = $WARRIOR_TOTAL_DURATION_HOURS - ($WARRIOR_TOTAL_DOWNTIME_HOURS + $WARRIOR_TOTAL_SCHEDULED_DOWNTIME_HOURS);
						$WARRIOR_TOTAL_RUN_HOURS = varcharTOnumeric2($WARRIOR_TOTAL_RUN_HOURS, 2);
						$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_TOTAL_RUN_HOURS;
						$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE], 2);

						/* PERFORMANCE */
						$WARRIOR_PERFORMANCE_RATE_UNITS = varcharTOnumeric2(($WARRIOR_TOTAL_UNITS * 60 / $WARRIOR_TOTAL_RUN_MINUTES), 2);
						$WARRIOR_PERFORMANCE_RATE_MASS = varcharTOnumeric2(($WARRIOR_TOTAL_MASS * 60 / $WARRIOR_TOTAL_RUN_MINUTES));
						$WARRIOR_PERFORMANCE_OEE = ($WARRIOR_PERFORMANCE_RATE_UNITS / $WARRIOR_PACKAGE_TARGET_RATE[$WARRIOR_RESULT_CURRENT_PACKAGE_CLASS]) * 100;
						$WARRIOR_PERFORMANCE_OEE = varcharTOnumeric2($WARRIOR_PERFORMANCE_OEE, 2);
		
						/* AVAILABILITY */
						$WARRIOR_AVAILABILITY_OEE = ( $WARRIOR_TOTAL_RUN_MINUTES / ( $WARRIOR_TOTAL_DURATION_MINUTES - $WARRIOR_SCHEDULED_DOWNTIME_MINUTES ) ) * 100;
						$WARRIOR_AVAILABILITY_OEE = varcharTOnumeric2($WARRIOR_AVAILABILITY_OEE, 2);
						$WARRIOR_AVAILABILITY_RATE_UNITS = varcharTOnumeric2(($WARRIOR_TOTAL_UNITS * 60 / ($WARRIOR_TOTAL_RUN_MINUTES + $WARRIOR_TOTAL_DOWNTIME_MINUTES)), 2);
						$WARRIOR_AVAILABILITY_RATE_MASS = varcharTOnumeric2(($WARRIOR_TOTAL_MASS * 60 / ($WARRIOR_TOTAL_RUN_MINUTES + $WARRIOR_TOTAL_DOWNTIME_MINUTES)));

						/* LOADING */
						$WARRIOR_LOADING_TEEP = (( $WARRIOR_TOTAL_DURATION_MINUTES - $WARRIOR_SCHEDULED_DOWNTIME_MINUTES ) / $WARRIOR_TOTAL_DURATION_MINUTES ) * 100;
						$WARRIOR_LOADING_TEEP = varcharTOnumeric2($WARRIOR_LOADING_TEEP, 2);

						/* OEE */
						$WARRIOR_OEE = ($WARRIOR_AVAILABILITY_OEE * $WARRIOR_PERFORMANCE_OEE) / 100;
						$WARRIOR_OEE = varcharTOnumeric2($WARRIOR_OEE, 2);

						/* TEEP */
						$WARRIOR_TEEP = ($WARRIOR_OEE * $WARRIOR_LOADING_TEEP) / 100;
						$WARRIOR_TEEP = varcharTOnumeric2($WARRIOR_TEEP, 2);

						/* PUSH OUT TO OVERALL TOTALS */
						$WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] + varcharTOnumeric2(($WARRIOR_PERFORMANCE_OEE * $WARRIOR_TOTAL_RUN_HOURS), 4);

						/* POST THE ALARMS AND SCHEDULED_DOWN OCCURRANCES */
						$apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED_HOLDING = "8675309";
						if ($mysql_DETAIL_LEVEL != "SUMMARY") {
							/* RECORDENTRY_2 STRUCTURE AND HEADER */
							if ($apache_DISCRETE_OCCURRANCE_HEADER[$mysql_WORKING_RUN_MACHINE] != 'DONE' ) {
								$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
								<TR>
									<TD COLSPAN='5'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE' ALIGN='CENTER' COLSPAN='2'>
										<BR>
										<B><U>".$mysql_WORKING_RUN_MACHINE."</U></B><BR>
										<BR>
									</TD>
									<TD COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_106."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_107."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_94."</U></B><BR>
										[ ".$multilang_WARRIOR_53." ]
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_45."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_113."</U></B>
									</TD>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><I>".$multilang_WARRIOR_46."</I></B>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
										<BR>
									</TD>
								</TR>
								";
								$apache_DISCRETE_OCCURRANCE_HEADER[$mysql_WORKING_RUN_MACHINE] = "DONE";
							} else {
								/* pass */
							}
							while ($WARRIOR_ALARM_PRINTER_INDEX <= $WARRIOR_RUN_ALARM_COUNT[$mysql_WORKING_RUN_MACHINE]) {
								if ($WARRIOR_ALARM_PRINTER_NEED_HEADER == 1) {
									/* ZERO BREAKPOINT HOLDING REGISTERS */
									$apache_HOLDING_REPORT_RECORDENTRY_2_OPERATOR = "gutentag";
									$apache_HOLDING_REPORT_RECORDENTRY_2_JOB_DESCRIPTION = "gutentag";
									$apache_HOLDING_REPORT_RECORDENTRY_2_PACKAGE_CLASS = "gutentag";
									$apache_HOLDING_REPORT_RECORDENTRY_2_SCHEDULE_NUMBER = "gutentag";
									/* BUILD BODY OF SECTION "DISCRETE TOTALS: INDIVIDUAL ALARM AND DOWNTIME INSTANCES" */
									/* UNLATCH HEADER FOR MACHINE */
									$WARRIOR_ALARM_PRINTER_NEED_HEADER = 0;
								} else {
									/* pass */
								}
								/* VARYING REPORT DETAIL BASED UPON INPUT FROM USER */
								if ($mysql_DETAIL_LEVEL == "EXTREME") {
									$WARRIOR_ALARM_POST_IF_VALUE_HIGHER_THAN = 0;
								} else {
									if ($mysql_DETAIL_LEVEL == "HIGH") {
										$WARRIOR_ALARM_POST_IF_VALUE_HIGHER_THAN = 4.99;
									} else {
										if ($mysql_DETAIL_LEVEL == "MEDIUM") {
											$WARRIOR_ALARM_POST_IF_VALUE_HIGHER_THAN = 9.99;
										} else {
											$WARRIOR_ALARM_POST_IF_VALUE_HIGHER_THAN = 0;
										}
									}
								}
								/* BUILD THE ARRAY FOR THE DISCRETE PARETO */
								$apache_REPORT_RECORDENTRY_2_OPERATOR = $WARRIOR_RUN_ALARM_OPERATOR[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE];
								$apache_REPORT_RECORDENTRY_2_JOB_DESCRIPTION = $WARRIOR_RUN_ALARM_JOB_DESCRIPTION[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE];
								if ( ($apache_HOLDING_REPORT_RECORDENTRY_2_OPERATOR != $apache_REPORT_RECORDENTRY_2_OPERATOR) || ($apache_HOLDING_REPORT_RECORDENTRY_2_JOB_DESCRIPTION != $apache_REPORT_RECORDENTRY_2_JOB_DESCRIPTION) || ($apache_HOLDING_REPORT_RECORDENTRY_2_PACKAGE_CLASS != $WARRIOR_RUN_ALARM_PACKAGE_CLASS[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE]) || ($apache_HOLDING_REPORT_RECORDENTRY_2_SCHEDULE_NUMBER != $WARRIOR_RUN_ALARM_SCHEDULE_NUMBER[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE]) ) {
									/* POST A BREAKPOINT BAR TO IDENTIFY OPERATOR, SCHEDULE NUMBER, */
									/* JOB DESCRIPTION, AND PACKAGE CLASS OF LISTED DOWNTIME INSTANCES */
									/* -- CLEAN UP SOME TAGS FIRST */
									/* -- -- PACKAGE CLASS */
									$apache_REPORT_RECORDENTRY_2_PACKAGE_CLASS = $WARRIOR_RUN_ALARM_PACKAGE_CLASS[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE];
									/* -- -- OPERATOR NAME */
									$apache_REPORT_RECORDENTRY_2_OPERATOR_FRIENDLYNAME = model_WARRIOR_friendly_operator($apache_REPORT_RECORDENTRY_2_OPERATOR);
									/* -- -- JOB DESCRIPTION */
									$apache_REPORT_RECORDENTRY_2_JOB_DESCRIPTION_FRIENDLYNAME = model_WARRIOR_friendly_jobnumber($apache_REPORT_RECORDENTRY_2_JOB_DESCRIPTION);
									/* -- -- INSERTION */
									$apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED = "
								<TR CLASS='hmirowborder1_ALT_NOBORDER'>
									<TD COLSPAN='3' VALIGN='MIDDLE'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<B>".$multilang_WARRIOR_36.":</B> <I>".$WARRIOR_RUN_ALARM_SCHEDULE_NUMBER[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE]."</I><BR>
											<B>".$multilang_WARRIOR_47.":</B> <I>".$WARRIOR_PACKAGE[$apache_REPORT_RECORDENTRY_2_PACKAGE_CLASS]."</I><BR>
											<B>".$multilang_WARRIOR_30.":</B> <I>".$apache_REPORT_RECORDENTRY_2_OPERATOR_FRIENDLYNAME."</I>
										</P>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='CENTER'>
											<B>".$multilang_WARRIOR_6.":</B> <BR><I>".$apache_REPORT_RECORDENTRY_2_JOB_DESCRIPTION_FRIENDLYNAME."</I>
										</P>
									</TD>
								</TR>
								";
									/* UPDATE BREAKPOINT HOLDING REGISTERS */
									$apache_HOLDING_REPORT_RECORDENTRY_2_OPERATOR = $apache_REPORT_RECORDENTRY_2_OPERATOR;
									$apache_HOLDING_REPORT_RECORDENTRY_2_JOB_DESCRIPTION = $apache_REPORT_RECORDENTRY_2_JOB_DESCRIPTION;
									$apache_HOLDING_REPORT_RECORDENTRY_2_PACKAGE_CLASS = $WARRIOR_RUN_ALARM_PACKAGE_CLASS[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE];
									$apache_HOLDING_REPORT_RECORDENTRY_2_SCHEDULE_NUMBER = $WARRIOR_RUN_ALARM_SCHEDULE_NUMBER[$WARRIOR_WORKING_WITH_ALARM][$mysql_WORKING_RUN_MACHINE];
								} else {
									/* pass */
								}
								$apache_REPORT_RECORDENTRY_2_ALARM = $WARRIOR_RUN_ALARM_ALARM[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE];
								$apache_REPORT_RECORDENTRY_2_ACTION = $WARRIOR_RUN_ALARM_CORRECTIVE_ACTION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE];
								$WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$apache_REPORT_RECORDENTRY_2_ALARM][$apache_REPORT_RECORDENTRY_2_ACTION] = varcharTOnumeric2(($WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$apache_REPORT_RECORDENTRY_2_ALARM][$apache_REPORT_RECORDENTRY_2_ACTION] + $WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]), 2);
								if ($WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE] > 0) {
									$WARRIOR_RUN_ALARM_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$apache_REPORT_RECORDENTRY_2_ALARM][$apache_REPORT_RECORDENTRY_2_ACTION] = $WARRIOR_RUN_ALARM_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$apache_REPORT_RECORDENTRY_2_ALARM][$apache_REPORT_RECORDENTRY_2_ACTION] + 1;
								} else {
									/* pass */
								}
								/* BUILD THE ARRAY FOR THE HYBRID PARETO */
								$WARRIOR_HYBRID_ID = 0;
									/* IDENTIFY WHICH CLASSIFICATION EACH ALARM FALLS INTO */
									if ($apache_REPORT_RECORDENTRY_2_ACTION > 1) {
										$WARRIOR_HYBRID_ID = $WARRIOR_ACTION_ASSIGNED_CATEGORY[$apache_REPORT_RECORDENTRY_2_ACTION];
									} else {
										if ($WARRIOR_ALARM_ASSIGNED_CATEGORY[$apache_REPORT_RECORDENTRY_2_ALARM] <= 1) {
											$WARRIOR_HYBRID_ID = $WARRIOR_ACTION_ASSIGNED_CATEGORY[$apache_REPORT_RECORDENTRY_2_ACTION];
										} else {
											$WARRIOR_HYBRID_ID = $WARRIOR_ALARM_ASSIGNED_CATEGORY[$apache_REPORT_RECORDENTRY_2_ALARM];
										}
									}
								$WARRIOR_RUN_ALARM_HYBRID_PARETO[$mysql_WORKING_RUN_MACHINE][$WARRIOR_HYBRID_ID] = varcharTOnumeric2(($WARRIOR_RUN_ALARM_HYBRID_PARETO[$mysql_WORKING_RUN_MACHINE][$WARRIOR_HYBRID_ID] + $WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]), 2);
								if ($WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE] > 0) {
									$WARRIOR_RUN_ALARM_HYBRID_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$WARRIOR_HYBRID_ID] = $WARRIOR_RUN_ALARM_HYBRID_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$WARRIOR_HYBRID_ID] + 1;
								} else {
									/* pass */
								}
								
								/* POST OUR ALARM INSTANCES PER OUR USER'S INPUT AS TO DETAIL LEVEL */
								if ($WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE] > $WARRIOR_ALARM_POST_IF_VALUE_HIGHER_THAN ) {
									if ($apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED != $apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED_HOLDING) {
										$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2.$apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED;
										$apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED_HOLDING = $apache_REPORT_RECORDENTRY_2_INSERT_IF_DETAIL_LEVEL_SATISFIED;
									} else {
										/* pass */
									}
									
									/* -- FLIP FLOP ROW COLOR */
									$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop("#FFFFFF","#DDDDDD");
									if ($apache_REPORT_ROW_BGCOLOR_USE == '') {
										$apache_REPORT_ROW_BGCOLOR_USE_EMBEDDED_CSS = "#FFFFFF";
									} else {
										$apache_REPORT_ROW_BGCOLOR_USE_EMBEDDED_CSS = $apache_REPORT_ROW_BGCOLOR_USE;
									}
									$apache_REPORT_ROW_BGCOLOR_USE = "BGCOLOR='".$apache_REPORT_ROW_BGCOLOR_USE."'";

									$apache_REPORT_RECORDENTRY_2_CORRECTIVE_ACTION = $WARRIOR_RUN_ALARM_CORRECTIVE_ACTION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE];
									if ($apache_REPORT_RECORDENTRY_2_CORRECTIVE_ACTION != 0) {
										$CORRECTIVE_ACTION_TO_POST_IN_DISCRETE_RUNDOWN = "<B><I>".$WARRIOR_ACTION[$apache_REPORT_RECORDENTRY_2_CORRECTIVE_ACTION]."</I></B><BR>";
									} else {
										$CORRECTIVE_ACTION_TO_POST_IN_DISCRETE_RUNDOWN = "";
									}
									$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$WARRIOR_RUN_ALARM_START[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$WARRIOR_RUN_ALARM_END[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
									";
									if ( ($JUMP_FROM_REPORT_0 == 'YES') && ($mysql_seer_access_ACCESSLEVEL <= $WARRIOR_MIMIMUM_USER_LEVEL_MODIFY_POST_MORTUM) && (($CORRECTIVE_ACTION_TO_POST_IN_DISCRETE_RUNDOWN == '') || ($WARRIOR_ALLOW_MODIFY_POST_MORTUM_IF_CA_EXISTS == 'YES')) ) {
										/* ALLOW USERS AT OR ABOVE SPECIFIED LEVEL TO MODIFY CORRECTIVE ACTION POST MORTUM */
										/* -- ONLY ALLOW IF USER HAS COME HERE FROM A LINK IN REPORT_0, WHICH MEANS */
										/*    THEY ARE SPECIFICALLY LOOKING TO MICROANALYZE THIS RUN ... OTHERWISE, THEY */
										/*    AREN'T BEING SPECIFIC ENOUGH TO KNOW WHAT THEY'RE DOING, SO DON'T LET THEM SEE IT */
										$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
										<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='300' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD WIDTH='260' VALIGN='TOP' ALIGN='RIGHT'>
														<INPUT TYPE='hidden' name='seer_HMIACTION' value='BUILDTICKET'>
														<INPUT TYPE='hidden' name='mysql_JUMP_FROM_REPORT_0' value='".$JUMP_FROM_REPORT_0."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='".$mysql_ENTRY_MACHINENAME."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_RUN_IDENTIFICATION' value='".$mysql_ENTRY_RUN_IDENTIFICATION."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_YEAR' value='".$mysql_ENTRY_START_YEAR."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_YEAR' value='".$mysql_ENTRY_END_YEAR."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_MONTH' value='".$mysql_ENTRY_START_MONTH."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_DAY' value='".$mysql_ENTRY_START_DAY."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_MONTH' value='".$mysql_ENTRY_END_MONTH."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_DAY' value='".$mysql_ENTRY_END_DAY."'>
														<INPUT TYPE='hidden' name='mysql_DETAIL_LEVEL' value='".$mysql_DETAIL_LEVEL."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_SHIFT' value='".$mysql_ENTRY_SHIFT."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_SHIFT_CUSTOM_START_HOUR' value='".$mysql_ENTRY_SHIFT_CUSTOM_START_HOUR."'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_SHIFT_CUSTOM_END_HOUR' value='".$mysql_ENTRY_SHIFT_CUSTOM_END_HOUR."'>
														<INPUT TYPE='hidden' name='post_CA_POST_MORTUM_REQUEST_HMIACTION' value='YES'>
														<INPUT TYPE='hidden' name='post_CA_POST_MORTUM_MACHINE_NAME' value='".$mysql_WORKING_RUN_MACHINE."'>
														<INPUT TYPE='hidden' name='post_CA_POST_MORTUM_DATESTAMP_START' value='".$WARRIOR_RUN_ALARM_START[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]."'>
														<INPUT TYPE='hidden' name='post_CA_POST_MORTUM_DATESTAMP_END' value='".$WARRIOR_RUN_ALARM_END[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE]."'>
														<SELECT NAME='post_CA_POST_MORTUM_VALUE_TO_OVERWRITE' CLASS='SMALL' STYLE='background-color: ".$apache_REPORT_ROW_BGCOLOR_USE_EMBEDDED_CSS."'><OPTION VALUE=''>".$WARRIOR_ALARM[$apache_REPORT_RECORDENTRY_2_ALARM]."<OPTION VALUE=''>----".$WARRIOR_FORMFILL_ACTION."</SELECT><BR>
														".$CORRECTIVE_ACTION_TO_POST_IN_DISCRETE_RUNDOWN."
													</TD>
													<TD WIDTH='40' VALIGN='MIDDLE' ALIGN='CENTER'>
														<INPUT TYPE='image' name='enter' src='./img/small_clicky_purple_3.png' HEIGHT='16'>
													</TD>
												</TR>
											</TABLE>
										</FORM>
										";
									} else {
										/* STANDARD DISPLAY FOR EVERYONE ELSE */
										$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='300' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='260' VALIGN='TOP' ALIGN='RIGHT'>
													".$WARRIOR_ALARM[$apache_REPORT_RECORDENTRY_2_ALARM]."<BR>
													".$CORRECTIVE_ACTION_TO_POST_IN_DISCRETE_RUNDOWN."
												</TD>
												<TD WIDTH='40'>
													<BR>
												</TD>
											</TR>
										</TABLE>
										";
									}
									$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' ".$WARRIOR_RUN_ALARM_FLAG_COLOR[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE].">
										<BR>
									<TD>
								</TR>
								";

									/* PUSH OUT CSV 2 FOR EXPORT */
									/* -- MACHINE, START, END, DURATION[UM], ALARM, CORRECTIVE ACTION + 6 FILLER */
									$seer_EXPORT_CONTENT2 = $seer_EXPORT_CONTENT2.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_RUN_ALARM_START[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_ALARM_END[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_ALARM_DURATION[$WARRIOR_ALARM_PRINTER_INDEX][$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_ALARM[$apache_REPORT_RECORDENTRY_2_ALARM].$seer_CSV_DELINEATION.$WARRIOR_ACTION[$apache_REPORT_RECORDENTRY_2_CORRECTIVE_ACTION].$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION.$seer_CSV_ENDOFLINE_HOLDING;

								} else {
									/* pass */
									/* -- don't print the one's that have a duration of zero */
								}

								/* INDEX THE ALARM PRINTER */
								$WARRIOR_ALARM_PRINTER_INDEX = $WARRIOR_ALARM_PRINTER_INDEX + 1;
							}
						} else {
							/* pass */
						}

					/* INDEX */
					$mysql_query_internal_index = $mysql_query_internal_index + 1;
				}

				/* BORDER OFF CSV2 FOR EXPORT */
				/* -- 12 COLUMN BORDER */
				model_WARRIOR_csv2_export_r2_border_12_column();

				/* NO BORDER FOR MARKUP IF ZERO FAULT OUTPUT */
				if ($WARRIOR_RUN_ALARM_COUNT[$mysql_WORKING_RUN_MACHINE] == 0) {
					/* pass */
				} else {
					$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
								<TR>
									<TD COLSPAN='5'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='750' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								";
				}
				
				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;
			}

			/* BORDER OFF CSV2 FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv2_export_r2_border_12_column();


			$apache_REPORT_RECORDENTRY_2 = $apache_REPORT_RECORDENTRY_2."
							</TABLE>
							";

			/* BUILD HEADER ROW - "SYNERGISTIC TOTALS: OVERALL DEPARTMENT PERFORMANCE" */
			$apache_REPORT_RECORDENTRY = "
								<TR>
									<TD VALIGN='TOP' COLSPAN='5'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											<B>[".$multilang_WARRIOR_84."]: ".$multilang_WARRIOR_103."</B>...
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

			/* -- CYCLE THROUGH ARRAY 1 AGAIN */
			if ( $JUMP_FROM_REPORT_0 == 'YES') {
				$mysql_query_index = $mysql_ENTRY_MACHINENAME;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $mysql_ENTRY_MACHINENAME;
			} else {
				$mysql_query_index = 0;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $WARRIOR_COUNT_ADJUSTED;
			}
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED_TO_USE) {

				/* -- FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];

				/* ROUND OFF TOTALS FOR PRETTY PRINTING */
				$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE], 2);
				$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE], 2);
				$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE], 2);
				$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE], 2);
				$WARRIOR_RUN_TOTAL_OEE_AVAILABILITY[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2(($WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE] * 100 / ( $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] - $WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] ) ), 2);
				$WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2(($WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] / $WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE]), 2);
				$WARRIOR_RUN_TOTAL_OEE_OEE[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2(($WARRIOR_RUN_TOTAL_OEE_AVAILABILITY[$mysql_WORKING_RUN_MACHINE] * $WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE] / 100), 2);
				$WARRIOR_RUN_TOTAL_TEEP_LOADING[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2(((($WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE] - $WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE]) / $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE]) * 100), 2);
				$WARRIOR_RUN_TOTAL_TEEP_TEEP[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2(($WARRIOR_RUN_TOTAL_TEEP_LOADING[$mysql_WORKING_RUN_MACHINE] * $WARRIOR_RUN_TOTAL_OEE_OEE[$mysql_WORKING_RUN_MACHINE] / 100), 2);

				/* BAR GRAPH FILL */
				$WARRIOR_BAR_GRAPH_HEIGHT = 450;
				$WARRIOR_BAR_GRAPH_RUN[$mysql_WORKING_RUN_MACHINE] = core_display_horizontal_bar($WARRIOR_BAR_GRAPH_HEIGHT,$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE],"0",$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE]);
				$WARRIOR_BAR_GRAPH_SCHEDULED_DOWNTIME[$mysql_WORKING_RUN_MACHINE] = core_display_horizontal_bar($WARRIOR_BAR_GRAPH_HEIGHT,$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE],"0",$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE]);
				$WARRIOR_BAR_GRAPH_DOWNTIME[$mysql_WORKING_RUN_MACHINE] = core_display_horizontal_bar($WARRIOR_BAR_GRAPH_HEIGHT,$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE],"0",$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE]);

				/* BUILD BODY OF REPORT SECTION - "SYNERGISTIC TOTALS: OVERALL DEPARTMENT PERFORMANCE" */
				/* -- POST TOTALS */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE'>
										".$mysql_WORKING_RUN_MACHINE."
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_61."</U></B><BR>
										".$WARRIOR_RUN_TOTAL_OEE_AVAILABILITY[$mysql_WORKING_RUN_MACHINE]." [%]
									</TD>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_60."</U></B><BR>
										".$WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE]." [%]
									</TD>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_62."</U></B><BR>
										".$WARRIOR_RUN_TOTAL_OEE_OEE[$mysql_WORKING_RUN_MACHINE]." [%]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_64."</U></B><BR>
										".$WARRIOR_RUN_TOTAL_TEEP_LOADING[$mysql_WORKING_RUN_MACHINE]." [%]
									</TD>
									<TD VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_63."</U></B><BR>
										".$WARRIOR_RUN_TOTAL_TEEP_TEEP[$mysql_WORKING_RUN_MACHINE]." [%]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										<B><I>".$multilang_WARRIOR_73."</I></B>
									</TD>
									<TD VALIGN='TOP' COLSPAN='2' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE]." [ ".$WARRIOR_UM_PACKAGE_UNIT." ] @ ".$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE]." [ ".$WARRIOR_UM_PACKAGE_UNIT_MASS." ]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='RIGHT'>
										<B><I>".$multilang_WARRIOR_104."</I></B>
									</TD>
									<TD VALIGN='TOP' COLSPAN='2' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE]." [ ".$multilang_WARRIOR_101." ]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										".$multilang_WARRIOR_55." [".$multilang_WARRIOR_101."]: <B>".$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE]."</B>
									</TD>
								<TD CLASS='hmicellborder2top' COLSPAN='3' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_green.png' WIDTH=".$WARRIOR_BAR_GRAPH_RUN[$mysql_WORKING_RUN_MACHINE]." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										".$multilang_WARRIOR_58." [".$multilang_WARRIOR_101."]: <B>".$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE]."</B>
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='3' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_red.png' WIDTH=".$WARRIOR_BAR_GRAPH_DOWNTIME[$mysql_WORKING_RUN_MACHINE]." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='RIGHT' VALIGN='MIDDLE' COLSPAN='2'>
										".$multilang_WARRIOR_57." [".$multilang_WARRIOR_101."]: <B>".$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE]."</B>
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='3' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH=".$WARRIOR_BAR_GRAPH_SCHEDULED_DOWNTIME[$mysql_WORKING_RUN_MACHINE]." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

				/* PUSH TO CSV FOR EXPORT */
				/* -- MACHINE, AVAILABILITY[UM], PERFORMANCE[UM], OEE[UM], LOADING[UM], TEEP[UM], GROSS THROUGHPUT UNIT[UM], GROSS THROUGHPUT MASS[UM], TIME PERIOD[UM], RUNTIME[UM], DOWN TIME[UM], NOT SCHEDULED[UM] */
				$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_OEE_AVAILABILITY[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_OEE_PERFORMANCE[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_OEE_OEE[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_TEEP_LOADING[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_TEEP_TEEP[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_RUNTIME[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE].$seer_CSV_DELINEATION.$seer_CSV_ENDOFLINE_HOLDING;
				

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;	
			}

			/* PULL IN THE PARETO CHARTS */
			require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/core_models/WARRIOR_seer_report_2_BODY_SUPPLEMENT.php');

			/* BORDER OFF CSV FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv_export_r2_border_12_column();

			/* ADVISE IF ANY ARRAY SORTING OPERATIONS FAILED */
			if ( ($TEST1 == TRUE) && ($TEST2 == TRUE) ) {
				$WARRIOR_BGCOLOR_USE_SORT_RESULT_HYBRID = "BGCOLOR='#CCFF66'";
			} else {
				$WARRIOR_BGCOLOR_USE_SORT_RESULT_HYBRID = "BGCOLOR='#FF8866'";
			}
			if ( ($TEST3 == TRUE) && ($TEST4 == TRUE) ) {
				$WARRIOR_BGCOLOR_USE_SORT_RESULT_DISCRETE = "BGCOLOR='#CCFF66'";
			} else {
				$WARRIOR_BGCOLOR_USE_SORT_RESULT_DISCRETE = "BGCOLOR='#FF8866'";
			}

			/* REPORT TOPPLATE AND ASSEMBLY */
			/* ---------------------------- */
			/* -- JOIN THE TWO EXPORTS */
			$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$seer_EXPORT_CONTENT2;
			/* -- CLEAN UP CSV FOR EXPORT */
			core_export_csv_sanitize();
			/* -- CUSTOM NOTE */
			$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE = $multilang_SETTINGS_SHIFT.": <I>".$WARRIOR_TITLE_REPORT_SHIFT_ID."</I>";
			/* -- BUILD THE TOP PLATE */
			if ($JUMP_FROM_REPORT_0 == 'YES') {
				$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE,$mysql_ENTRY_RUN_IDENTIFICATION,$multilang_STATIC_PARETO_EXPLAIN,$multilang_STATIC_SORTING_STATUS_EXPLAIN);
			} else {
				$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE,$multilang_STATIC_PARETO_EXPLAIN,$multilang_STATIC_SORTING_STATUS_EXPLAIN);
			}
			$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><I>".$multilang_STATIC_SORTING_STATUS.":</I></B>
									</TD>
									<TD CLASS='hmicellborder1' ALIGN='CENTER' ".$WARRIOR_BGCOLOR_USE_SORT_RESULT_HYBRID.">
										<B>".$multilang_WARRIOR_120."</B>
									</TD>
									<TD CLASS='hmicellborder1'  ALIGN='CENTER' ".$WARRIOR_BGCOLOR_USE_SORT_RESULT_DISCRETE.">
										<B>".$multilang_WARRIOR_121."</B>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";

			if ($mysql_DETAIL_LEVEL != "SUMMARY") {
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							".$apache_REPORT_RECORDENTRY_3."<BR>
							".$apache_REPORT_RECORDENTRY_2."
							";
			} else {
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>";
			}
			/* -- USER OPTION TO RE-RUN REPORT */
			if ($JUMP_FROM_REPORT_0 == 'YES') {
				/* pass */
			} else {
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_user_date_time_range_rerun_type_w1("YES");
			}
			/* -- TOPPLATE EXTENSIONS */
			$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_TOPPLATE_EXTENSION."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
			/* -- ADD THE BODY */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY;
		}

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
	model_WARRIOR_user_date_time_range_prompt_type_w1("YES");
}


/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = "";; 
$apache_REPORTL6 = $apache_REPORT_RECORDENTRY;
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
