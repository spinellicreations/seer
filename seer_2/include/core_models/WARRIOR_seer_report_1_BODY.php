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
WARRIOR REPORT BODY 1 (INCLUDED TO ALL WARRIOR INSTANCES)
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
								<B>".$multilang_WARRIOR_20.": ".$multilang_WARRIOR_91."</B><BR>
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
	/* PULL IN VARIABLES */
	model_WARRIOR_user_date_time_range_input_type_w1("NO");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* BGCOLOR DECLARATION */
		$apache_REPORT_ROW_BGCOLOR = "";
		$apache_REPORT_ROW_BGCOLOR_ALT = "BGCOLOR='#DDDDDD'";
		$apache_SWITCH_ROW_COLOR = 0;
		$BLACK_CELL_COLOR = "BGCOLOR='#000000'";
		$PURPLE_CELL_COLOR = "BGCOLOR='#8D38C9'";
		$RED_CELL_COLOR = "BGCOLOR='#F62817'";
		$YELLOW_CELL_COLOR = "BGCOLOR='#FFF380'";
		$apache_DOWNTIME_BGCOLOR_BREAKDOWN = $RED_CELL_COLOR;
		$apache_DOWNTIME_BGCOLOR_SCHEDULED = $YELLOW_CELL_COLOR;

		/* FIRST QUERY - PULL IN ALL DATA FROM DB THAT FALLS BETWEEN THE DATE RANGE */
		$mysql_mod_openopc_query = "DATESTAMP, STATE, MACHINE_NAME, CORRECTIVE_ACTION";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."' ORDER BY MACHINE_NAME ASC, DATESTAMP DESC";
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
			/* -- -- WARRIOR_RUN_END[MACHINE][RUN_ID] 		- IDENTIFIES RUN_END for MACHINE AND WHICH RUN INDEX WE'RE ON */
			/* -- -- WARRIOR_RUN_START[MACHINE][RUN_ID] 		- IDENTIFIES RUN_START for MACHINE AND WHICH RUN INDEX WE'RE ON */
			/* -- -- WARRIOR_RUN_DURATION[MACHINE][RUN_ID] 		- IDENTIFIES DURATION FOR RUN INDEX WE'RE ON */
			/* -- -- WARRIOR_RUN_CORRECTIVE_ACTION[MACHINE][RUN_ID]	- IDENTIFIES MACHINE CORRECTIVE_ACTION FOR RUN */			
			/* -- -- WARRIOR_RUN_OPERATOR[MACHINE][RUN_ID]		- IDENTIFIES MACHINE OPERATOR FOR RUN */
			/* -- -- WARRIOR_RUN_JOB_NUMBER[MACHINE][RUN_ID]	- IDENTIFIES JOB NUMBER DURING RUN */
			/* -- -- WARRIOR_RUN_SCHEDULE_NUMBER[MACHINE][RUN_ID]	- IDENTIFIES SCHEDULE NUMBER DURING RUN */
			/* -- -- WARRIOR_RUN_TYPE[MACHINE][RUN_ID] 		- IDENTIFIES RUN TYPE AS 'BREAKDOWN' or 'SCHEDULED DOWN' */
			/* -- -- THERE ARE A FEW OTHERS LITTERED THROUGHOUT, BUT YOU GET THE GENERAL IDEA... */
			/* -- -- THERE IS ALSO A SIMILAR, NON RUN-ID DELINEATED ARRAY, FOR THE TOTALIZATION OF VALUES ACROSS */
			/*	 	ALL LINES IN THE DEPARTMENT */
			/* -- -- WARRIOR_RUN_COUNT[MACHINE]			- IDENTIFIES HOW MANY UNIQUE CYCLES WE HAVE FOR EACH MACHINE */

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

				/* CHECK FOR SEQUENTIAL STATE */
				$mysql_WORKING_RUN_STATE = $mysql_mod_openopc_query_row['STATE'];

				if ($mysql_START_HOUR_TRIMMED_TEST < $mysql_END_HOUR_TRIMMED_TEST) {
					/* IF START HOUR IS LESS THAN END HOUR CHOSEN, CHECK WITH THIS METHOD */
					if ( ($mysql_WORKING_RUN_TEST >= $mysql_START_HOUR_TRIMMED_TEST) && ($mysql_WORKING_RUN_TEST <= $mysql_END_HOUR_TRIMMED_TEST) && ($mysql_WORKING_RUN_STATE == 2)) {
						$mysql_WORKING_RUN_TEST_RESULT = "PASS";
					} else {
						$mysql_WORKING_RUN_TEST_RESULT = "FAIL";
					}
				} else {
					/* IF START HOUR IS GREATER THAN END HOUR CHOSEN, CHECK WITH THIS METHOD */
					if ( ( ($mysql_WORKING_RUN_TEST >= $mysql_START_HOUR_TRIMMED_TEST) && ($mysql_WORKING_RUN_STATE == 2) ) || ( ($mysql_WORKING_RUN_TEST <= $mysql_END_HOUR_TRIMMED_TEST) && ($mysql_WORKING_RUN_STATE == 2) ) ) {
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
					$mysql_WORKING_RUN_CORRECTIVE_ACTION = $mysql_mod_openopc_query_row['CORRECTIVE_ACTION'];
					$mysql_WORKING_RUN_MACHINE = $mysql_mod_openopc_query_row['MACHINE_NAME'];

					$COUNT_EXAMINED = $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE];
					$COUNT_EXAMINED_MINUS_ONE = $COUNT_EXAMINED - 1;
					if ($COUNT_EXAMINDED_MINUS_ONE == -1) {
						$HOLDING_EXAMINED = "THESE ARE NOT THE CORRECTIVE ACTIONS YOU ARE LOOKING FOR";
						/* yes, it's a star wars reference */
					} else {
						$HOLDING_EXAMINED = $WARRIOR_RUN_CORRECTIVE_ACTION[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
					}
					if ( ($mysql_JUMP_SHIFT == "YES") || ($mysql_WORKING_RUN_CORRECTIVE_ACTION != $HOLDING_EXAMINED)) {

						/* CREATE NEW RECORD */
						$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_END;
						$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_END;
						$WARRIOR_RUN_CORRECTIVE_ACTION[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_CORRECTIVE_ACTION;

						/* INDEX MACHINE RUN COUNT */
						$WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE] + 1;
						
						/* UNLATCH JUMP SHIFT */
						$mysql_JUMP_SHIFT = "NO";

					} else {

						/* UPDATE EXISTING RECORD */
						$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE] = $mysql_WORKING_RUN_END;
					}

				} else {
					/* ACCOUNT FOR SHIFT GAPS DUE TO HOUR SELECTION */
					$mysql_JUMP_SHIFT = "YES";
				}

			}

			/* CYCLE THROUGH ARRAY 1 */

			/* ZERO OUT CSV FOR EXPORT */
			/* -- MACHINE, MAINT START, MAINT END, MAINT TYPE, DURATION[UM], OPERATOR OR TRADESMAN, SCHEDULE NUMBER, JOB DESCRIPTION */
			$seer_EXPORT_CONTENT = $multilang_WARRIOR_81.$seer_CSV_DELINEATION.$multilang_WARRIOR_92.$seer_CSV_DELINEATION.$multilang_WARRIOR_93.$seer_CSV_DELINEATION.$multilang_WARRIOR_95.$seer_CSV_DELINEATION.$multilang_WARRIOR_94."[".$multilang_WARRIOR_53."]".$seer_CSV_DELINEATION.$multilang_WARRIOR_30.$seer_CSV_DELINEATION.$multilang_WARRIOR_36.$seer_CSV_DELINEATION.$multilang_WARRIOR_6.$seer_CSV_DELINEATION.$seer_CSV_ENDOFLINE_HOLDING;

			$mysql_query_index = 0;
			$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES['ALL'] = 0;
			$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES['ALL'] = 0;
			$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES['ALL'] = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {
				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE] = 0;
				$mysql_query_internal_index = 0;

				/* IDENTIFY THE MACHINE IN INDIVIDUAL INSTANCE SECTION */
				$apache_REPORT_RECORDENTRY2 = $apache_REPORT_RECORDENTRY2."
								<TR>
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE'>
										".$mysql_WORKING_RUN_MACHINE."
									</TD>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_92."</U></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_93."</U></B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><U>".$multilang_WARRIOR_94."</U></B>
										[ ".$multilang_WARRIOR_53." ]
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
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><I>".$multilang_WARRIOR_30."</I></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<B><I>".$multilang_WARRIOR_36."</I></B>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2'>
										<B><I>".$multilang_WARRIOR_6."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

				while ($mysql_query_internal_index < $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE]) {
					/* QUERY DB FOR THE DETAILS */
					$mysql_mod_openopc_query = "OPERATOR, JOB_NUMBER, SCHEDULE_NUMBER";
					$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE (MACHINE_NAME LIKE '".$mysql_WORKING_RUN_MACHINE."') AND (DATESTAMP LIKE '".$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."')";
										
					$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
					$mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result);

					$COUNT_EXAMINED = $mysql_query_internal_index;

					$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = $mysql_mod_openopc_query_row['OPERATOR'];
					$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = model_WARRIOR_friendly_operator($WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
					$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = $mysql_mod_openopc_query_row['JOB_NUMBER'];
					$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = model_WARRIOR_friendly_jobnumber($WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
					$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = $mysql_mod_openopc_query_row['SCHEDULE_NUMBER'];

					list($apache_function_DURATION_FINAL,$WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]) = timeDuration($WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index], $WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
					$WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = varcharTOnumeric2($WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] / 60);

					/* DETERMINE TYPE OF RUN */
					/* if ( $WARRIOR_RUN_CORRECTIVE_ACTION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] == 2 ) { */
					/* -- old test - deprecated prior to v-4.37-RC2 2011-06230 V. Spinelli */
					if ( $WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] == 0 ) {
					/* -- new test, corresponds with decision that anytime a machine is 'Scheduled Down' or 'Cleaning', the Operator */
					/*    must set the 'JOB' to 'None' (which is the '0' value Job) common to any installation of SEER */
						/* SCHEDULED OR OTHERWISE NON INVASIVE DOWNTIME */
						$apache_DOWNTIME_BGCOLOR_TO_USE = $apache_DOWNTIME_BGCOLOR_SCHEDULED;
						$WARRIOR_RUN_TYPE[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = "SCHEDULED";
						$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];
						$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES['ALL'] = $WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES['ALL'] + $WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];
					} else {
						/* BREAKDOWN OR FAULT DOWNTIME */
						$apache_DOWNTIME_BGCOLOR_TO_USE = $apache_DOWNTIME_BGCOLOR_BREAKDOWN;
						$WARRIOR_RUN_TYPE[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = "BREAKDOWN";
						$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];
						$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES['ALL'] = $WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES['ALL'] + $WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];
					}

					$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE] = $WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];
					$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES['ALL'] = $WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES['ALL'] + $WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];

					/* -- FLIP FLOP ROW COLOR */
					$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

					$apache_REPORT_RECORDENTRY2 = $apache_REPORT_RECORDENTRY2."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ".$apache_DOWNTIME_BGCOLOR_TO_USE.">
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED]."
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED]."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										".$WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]." [".$multilang_WARRIOR_53."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ".$apache_DOWNTIME_BGCOLOR_TO_USE.">
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' VALIGN='TOP'>
										<I>".$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</I>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<I>".$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</I>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER' COLSPAN='2' >
										<I>".$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</I>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

					/* PUSH TO CSV FOR EXPORT */
					/* -- MACHINE, MAINT START, MAINT END, MAINT TYPE, DURATION[UM], OPERATOR OR TRADESMAN, SCHEDULE NUMBER, JOB DESCRIPTION */
					$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED].$seer_CSV_DELINEATION.$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED].$seer_CSV_DELINEATION.$WARRIOR_RUN_TYPE[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_DURATION[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$seer_CSV_ENDOFLINE_HOLDING;

					/* INDEX */
					$mysql_query_internal_index = $mysql_query_internal_index + 1;
				}

				/* ZERO INSTANCE OUTPUT */
				if ($mysql_query_internal_index == 0) {
					$apache_REPORT_RECORDENTRY2 = $apache_REPORT_RECORDENTRY2."
								<TR>
																	<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD COLSPAN='3'>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_61."<BR>
											".$multilang_STATIC_62."
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}

				$apache_REPORT_RECORDENTRY2 = $apache_REPORT_RECORDENTRY2."
								<TR>
									<TD COLSPAN='5'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='750' HEIGHT='2' ALT='BAR'><BR>
										<BR>
									</TD>
								</TR>
								";

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;
			}

			/* CYCLE THROUGH ARRAY 1 AGAIN */
			$mysql_query_index = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {

				/* -- FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE] = ($WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE] / 60);
				$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE], 2);
				$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE] = ($WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE] / 60);
				$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE], 2);
				$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE] = ($WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE] / 60);
				$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE], 2);

				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE'>
										".$mysql_WORKING_RUN_MACHINE."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='CENTER' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_53."]<BR>
										(( ".$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_101."] ))
									</TD>
									<TD VALIGN='CENTER' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_53."]<BR>
										(( ".$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_101."] ))
									</TD>
									<TD VALIGN='CENTER' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_53."]<BR>
										(( ".$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_101."] ))
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;	
			}

			/* -- FLIP FLOP ROW COLOR */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

			$mysql_WORKING_RUN_MACHINE = "ALL";
			$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE] = ($WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE] / 60);
			$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE], 2);
			$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE] = ($WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE] / 60);
			$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE], 2);
			$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE] = ($WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE] / 60);
			$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE], 2);

			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE'>
										".$mysql_WORKING_RUN_MACHINE."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='CENTER' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_MINUTES[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_53."]<BR>
										(( ".$WARRIOR_RUN_TOTAL_TIME_BREAKDOWN_HOURS[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_101."] ))
									</TD>
									<TD VALIGN='CENTER' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_MINUTES[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_53."]<BR>
										(( ".$WARRIOR_RUN_TOTAL_TIME_SCHEDULED_HOURS[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_101."] ))
									</TD>
									<TD VALIGN='CENTER' ALIGN='CENTER'>
										".$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_MINUTES[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_53."]<BR>
										(( ".$WARRIOR_RUN_TOTAL_TIME_ALL_TYPES_HOURS[$mysql_WORKING_RUN_MACHINE]." [".$multilang_WARRIOR_101."] ))
									</TD>
								</TR>
								";

			/* REPORT TOPPLATE AND ASSEMBLY */
			/* ---------------------------- */
			/* -- CLEAN UP CSV FOR EXPORT */
			core_export_csv_sanitize();
			/* -- CUSTOM NOTE */
			$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE = $multilang_SETTINGS_SHIFT.": <I>".$WARRIOR_TITLE_REPORT_SHIFT_ID."</I>";
			/* -- BUILD THE TOP PLATE */
			$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$apache_REPORT_RECORDENTRY_TOPPLATE_CUSTOM_NOTE);
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
									<TD VALIGN='TOP' COLSPAN='5'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											<B>[".$multilang_WARRIOR_84."]: ".$multilang_WARRIOR_97."</B>...
										</P>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
										<B><U>".$multilang_WARRIOR_81."</U></B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
										<B><U>".$multilang_WARRIOR_98."</U></B><BR>
										[ ".$multilang_WARRIOR_53." ]<BR>
										(( ".$multilang_WARRIOR_101." ))
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
										<B><U>".$multilang_WARRIOR_99."</U></B><BR>
										[ ".$multilang_WARRIOR_53." ]<BR>
										(( ".$multilang_WARRIOR_101." ))
									</TD>
									<TD VALIGN='TOP' ALIGN='CENTER'>
										<BR>
										<B><U>".$multilang_WARRIOR_100."</U></B><BR>
										[ ".$multilang_WARRIOR_53." ]<BR>
										(( ".$multilang_WARRIOR_101." ))
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

			/* -- ASSEMBLE REPORT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='5'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='750' HEIGHT='2' ALT='BAR'><BR>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='5'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<B>[".$multilang_WARRIOR_86."]: ".$multilang_WARRIOR_96."</B>...
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
									<TD ".$YELLOW_CELL_COLOR.">
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
								".$apache_REPORT_RECORDENTRY2."
							</TABLE>
							";
			/* -- USER OPTION TO RE-RUN REPORT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_user_date_time_range_rerun_type_w1("NO");
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
	model_WARRIOR_user_date_time_range_prompt_type_w1("NO");
}

/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = "";
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
