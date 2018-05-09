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
WARRIOR REPORT BODY 0 (INCLUDED TO ALL WARRIOR INSTANCES)
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
								<B>".$multilang_WARRIOR_20.": ".$multilang_WARRIOR_73."</B><BR>
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

/* MODIFY REFERRING PAGE FOR JUMPING TO REPORT WARRIOR 2 */
$seer_REFERRINGPAGE_JUMP_TO_REPORT_2 = substr_replace($seer_REFERRINGPAGE,"2",-1);

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

		/* FIRST QUERY - PULL IN ALL DATA FROM DB THAT FALLS BETWEEN THE DATE RANGE */
		$mysql_mod_openopc_query = "DATESTAMP, MACHINE_NAME, CYCLES, PACKAGE_CLASS, PACKAGES_PER_CYCLE, OPERATOR, JOB_NUMBER, SCHEDULE_NUMBER";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."') AND SCHEDULE_NUMBER != '0' AND JOB_NUMBER != '0' ORDER BY MACHINE_NAME ASC, DATESTAMP DESC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* ZERO OUT CSV FOR EXPORT */
		/* -- MACHINE, START OF RUN, END OF RUN, DURATION(UM), OPERATOR, PACKAGE_CLASS, SCHEDULE NUMBER, JOB DESCRIPTION, UNITS(UM), MASS(UM) */
		$seer_EXPORT_CONTENT = $multilang_WARRIOR_81.$seer_CSV_DELINEATION.$multilang_WARRIOR_106.$seer_CSV_DELINEATION.$multilang_WARRIOR_107.$seer_CSV_DELINEATION.$multilang_STATIC_DURATION."[".$multilang_WARRIOR_53."]".$seer_CSV_DELINEATION.$multilang_WARRIOR_30.$seer_CSV_DELINEATION.$multilang_WARRIOR_47.$seer_CSV_DELINEATION.$multilang_WARRIOR_36.$seer_CSV_DELINEATION.$multilang_WARRIOR_6.$seer_CSV_DELINEATION.$multilang_WARRIOR_50." [".$WARRIOR_UM_PACKAGE_UNIT."]".$seer_CSV_DELINEATION.$multilang_WARRIOR_51." [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]".$seer_CSV_ENDOFLINE_HOLDING;

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
			/* -- -- WARRIOR_RUN_CYCLES_END[MACHINE][RUN_ID]	- IDENTIFIES NUMBER OF CYCLES AT END OF THIS RUN ID */
			/* -- -- WARRIOR_RUN_CYCLES_START[MACHINE][RUN_ID]	- IDENTIFIES NUMBER OF CYCLES AT START OF THIS RUN ID */
			/* -- -- WARRIOR_RUN_PACKAGE_CLASS[MACHINE][RUN_ID]	- IDENTIFIES THE PACKAGE BEING RUN DURING THAT RUN */
			/* -- -- WARRIOR_RUN_OPERATOR[MACHINE][RUN_ID]		- IDENTIFIES MACHINE OPERATOR FOR RUN */
			/* -- -- WARRIOR_RUN_JOB_NUMBER[MACHINE][RUN_ID]	- IDENTIFIES JOB NUMBER DURING RUN */
			/* -- -- WARRIOR_RUN_SCHEDULE_NUMBER[MACHINE][RUN_ID]	- IDENTIFIES SCHEDULE NUMBER DURING RUN */
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

				if ($mysql_WORKING_RUN_TEST_RESULT == "PASS") {
					/* PROCESS DATA POINT */
					$mysql_WORKING_RUN_END = $mysql_mod_openopc_query_row['DATESTAMP'];
					$mysql_WORKING_RUN_CYCLES = $mysql_mod_openopc_query_row['CYCLES'];
					$mysql_WORKING_RUN_MACHINE = $mysql_mod_openopc_query_row['MACHINE_NAME'];
					$mysql_WORKING_RUN_PACKAGE_CLASS = $mysql_mod_openopc_query_row['PACKAGE_CLASS'];
					$mysql_WORKING_RUN_JOB_NUMBER = $mysql_mod_openopc_query_row['JOB_NUMBER'];
					$mysql_WORKING_RUN_SCHEDULE_NUMBER = $mysql_mod_openopc_query_row['SCHEDULE_NUMBER'];

					$COUNT_EXAMINED = $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE];
					$COUNT_EXAMINED_MINUS_ONE = $COUNT_EXAMINED - 1;
					if ($COUNT_EXAMINDED_MINUS_ONE == -1) {
						$HOLDING_EXAMINED = 0;
						$HOLDING_PACKAGE_CLASS_EXAMINED = 8675309;
						$HOLDING_JOB_NUMBER_EXAMINED = 8675309;
						$HOLDING_SCHEDULE_NUMBER_EXAMINED = 8675309;
					} else {
						$HOLDING_EXAMINED = $WARRIOR_RUN_CYCLES_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
						$HOLDING_PACKAGE_CLASS_EXAMINED = $WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
						$HOLDING_SCHEDULE_NUMBER_EXAMINED = $WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
						$HOLDING_JOB_NUMBER_EXAMINED = $WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED_MINUS_ONE];
					}
					if (($mysql_WORKING_RUN_SCHEDULE_NUMBER != $HOLDING_SCHEDULE_NUMBER_EXAMINED) || ($mysql_WORKING_RUN_JOB_NUMBER != $HOLDING_JOB_NUMBER_EXAMINED) || ($mysql_WORKING_RUN_CYCLES > $HOLDING_EXAMINED) || ($mysql_JUMP_SHIFT == "YES") || ($mysql_WORKING_RUN_PACKAGE_CLASS != $HOLDING_PACKAGE_CLASS_EXAMINED)) {
	
						/* CREATE NEW RECORD */
						$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_END;
						$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_END;
						$WARRIOR_RUN_CYCLES_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_CYCLES;
						$WARRIOR_RUN_CYCLES_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_CYCLES;
						$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_PACKAGE_CLASS;
						$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_JOB_NUMBER;
						$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_WORKING_RUN_SCHEDULE_NUMBER;
						$WARRIOR_RUN_PACKAGES_PER_CYCLE[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_mod_openopc_query_row['PACKAGES_PER_CYCLE'];
						$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED] = $mysql_mod_openopc_query_row['OPERATOR'];

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

			$mysql_query_index = 0;
			$WARRIOR_RUN_TOTAL_UNITS['ALL'] = 0;
			$WARRIOR_RUN_TOTAL_MASS['ALL'] = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {
				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] = 0;
				$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] = 0;
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
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD CLASS='hmicellborder11'>
										<BR>
									</TD>
									<TD CLASS='hmicellborder11'>
										<B><U>".$multilang_WARRIOR_106."</U></B>
									</TD>
									<TD  CLASS='hmicellborder11'>
										<B><U>".$multilang_WARRIOR_107."</U></B>
									</TD>
									<TD  CLASS='hmicellborder11' COLSPAN='2'>
										<B><U>".$multilang_WARRIOR_94."</U></B>
										[ ".$multilang_WARRIOR_53." ]
									</TD>
								</TR>
								<TR>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B><I>".$multilang_WARRIOR_30."</I></B>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B><I>".$multilang_WARRIOR_47."</I></B>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B><I>".$multilang_WARRIOR_36."</I></B>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER' COLSPAN='2'>
										<B><I>".$multilang_WARRIOR_6."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3' ALIGN='RIGHT'>
										".$multilang_WARRIOR_133."
										<BR>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$multilang_WARRIOR_50."</B> [".$WARRIOR_UM_PACKAGE_UNIT."]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$multilang_WARRIOR_51."</B> [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3' ALIGN='RIGHT'>
										".$multilang_WARRIOR_134."
										<BR>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$multilang_WARRIOR_50."</B> [".$WARRIOR_UM_PACKAGE_UNIT."]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$multilang_WARRIOR_51."</B> [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								";

				$WARRIOR_RUN_COUNT_AT_LEAST_ONE_RUN_PROCESSED = 0;
				if ($WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE] > 0) {
					while ($mysql_query_internal_index < $WARRIOR_RUN_COUNT[$mysql_WORKING_RUN_MACHINE]) {
						/* SORT OUT THE DETAILS */
						$COUNT_EXAMINED = $mysql_query_internal_index;

						list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED]);
						$apache_function_DURATION_UNIXTIME = varcharTOnumeric2($apache_function_DURATION_UNIXTIME / 60);

						$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = model_WARRIOR_friendly_operator($WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
						$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = model_WARRIOR_friendly_jobnumber($WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);

						$WARRIOR_RUN_CYCLES_FINAL[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = varcharTOnumeric2($WARRIOR_RUN_CYCLES_END[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] - $WARRIOR_RUN_CYCLES_START[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
						$WARRIOR_RUN_UNITS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = varcharTOnumeric2($WARRIOR_RUN_CYCLES_FINAL[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] * $WARRIOR_RUN_PACKAGES_PER_CYCLE[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] * $WARRIOR_PACKAGE_UNIT_COUNT[$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]]);

						$PACKAGE_CLASS_EXAMINED = $WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index];
						$WARRIOR_RUN_PACKAGE_CLASS_FRIENDLYNAME[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = $WARRIOR_PACKAGE[$PACKAGE_CLASS_EXAMINED];
						$WARRIOR_RUN_MASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] = varcharTOnumeric2($WARRIOR_RUN_UNITS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index] * $WARRIOR_PACKAGE_UNIT_MASS[$PACKAGE_CLASS_EXAMINED]);

						$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_RUN_UNITS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
						$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE] + $WARRIOR_RUN_MASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);

						$WARRIOR_RUN_TOTAL_UNITS['ALL'] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_UNITS['ALL'] + $WARRIOR_RUN_UNITS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);
						$WARRIOR_RUN_TOTAL_MASS['ALL'] = varcharTOnumeric2($WARRIOR_RUN_TOTAL_MASS['ALL'] + $WARRIOR_RUN_MASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]);

						/* GENERATE LINK TO RUN EFFICIENCY AND DOWNTIME REPORT VIA WARRIOR_seer_report_2_BODY.php */
						$WARRIOR_JUMP_TO_REPORT_2_LINK = "
										<FORM ACTION='".$seer_REFERRINGPAGE_JUMP_TO_REPORT_2."' METHOD='post'>
											<INPUT TYPE='hidden' name='seer_HMIACTION' value='BUILDTICKET'>
											<INPUT TYPE='hidden' name='mysql_JUMP_FROM_REPORT_0' value='YES'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='".$mysql_query_index."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_RUN_IDENTIFICATION' value='".$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]." ---- [".$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."] ---- ".$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_START_YEAR' value='".substr($WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],0,4)."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_END_YEAR' value='".substr($WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],0,4)."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_START_MONTH' value='".substr($WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],5,2)."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_START_DAY' value='".substr($WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],7,2)."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_END_MONTH' value='".substr($WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],5,2)."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_END_DAY' value='".substr($WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],7,2)."'>
											<INPUT TYPE='hidden' name='mysql_DETAIL_LEVEL' value='EXTREME'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_SHIFT' value='99999'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_SHIFT_CUSTOM_START_HOUR' value='".substr($WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],10,8)."'>
											<INPUT TYPE='hidden' name='mysql_ENTRY_SHIFT_CUSTOM_END_HOUR' value='".substr($WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED],10,8)."'>
											<INPUT TYPE='image' name='enter' src='./img/small_clicky_green_3.png'>
										</FORM>
										";

						/* -- FLIP FLOP ROW COLOR */
						$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

						/* REPORT BODY SECTION 2 */
						if ($apache_function_DURATION_UNIXTIME >= $WARRIOR_hmi_MINIMUM_JOB_TIME_REPORTING) {
							$apache_REPORT_RECORDENTRY2 = $apache_REPORT_RECORDENTRY2."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD CLASS='hmicellborder10'>
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='150' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='75'>
													[".$multilang_WARRIOR_62."]
												</TD>
												<TD WIDTH='30'>
													".$WARRIOR_JUMP_TO_REPORT_2_LINK."
												</TD>
												<TD WIDTH='45'>
													<BR>
												</TD>
											</TR>
										</TABLE>
									</TD>
									<TD CLASS='hmicellborder10'>
										".$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED]."
									</TD>
									<TD CLASS='hmicellborder10'>
										".$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED]."
									</TD>
									<TD CLASS='hmicellborder10' COLSPAN='2'>
										".$apache_function_DURATION_UNIXTIME." [".$multilang_WARRIOR_53."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<I>".$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</I>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<I>".$WARRIOR_PACKAGE[$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]]."</I>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<I>".$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</I>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE' ALIGN='CENTER'>
										<I>".$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</I>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3' ALIGN='RIGHT'>
										".$multilang_WARRIOR_133."
										<BR>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".varcharTOnumeric2(($WARRIOR_PACKAGE_TARGET_RATE[$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]] * ($apache_function_DURATION_UNIXTIME / 60)),0)."</B> [".$WARRIOR_UM_PACKAGE_UNIT."]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".varcharTOnumeric2(($WARRIOR_PACKAGE_TARGET_RATE[$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]] * ($apache_function_DURATION_UNIXTIME / 60) * $WARRIOR_PACKAGE_UNIT_MASS[$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]]),0)."</B> [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='3' ALIGN='RIGHT'>
										".$multilang_WARRIOR_134."
										<BR>
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$WARRIOR_RUN_UNITS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</B> [".$WARRIOR_UM_PACKAGE_UNIT."]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$WARRIOR_RUN_MASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]."</B> [".$WARRIOR_UM_PACKAGE_UNIT_MASS."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
									</TD>
								</TR>
								";
							$WARRIOR_RUN_COUNT_AT_LEAST_ONE_RUN_PROCESSED = 1;
						} else {
							/* pass */
						}

						/* BUILD THE EXPORT */
						/* -- MACHINE, START OF RUN, END OF RUN, DURATION(UM), OPERATOR, PACKAGE_CLASS, SCHEDULE NUMBER, JOB DESCRIPTION, UNITS(UM), MASS(UM) */
						$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_RUN_START[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED].$seer_CSV_DELINEATION.$WARRIOR_RUN_END[$mysql_WORKING_RUN_MACHINE][$COUNT_EXAMINED].$seer_CSV_DELINEATION.$apache_function_DURATION_UNIXTIME.$seer_CSV_DELINEATION.$WARRIOR_RUN_OPERATOR[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_PACKAGE[$WARRIOR_RUN_PACKAGE_CLASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index]].$seer_CSV_DELINEATION.$WARRIOR_RUN_SCHEDULE_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_JOB_NUMBER[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_UNITS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$WARRIOR_RUN_MASS[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index].$seer_CSV_DELINEATION.$seer_CSV_ENDOFLINE_HOLDING;

						/* INDEX */
						$mysql_query_internal_index = $mysql_query_internal_index + 1;
					}

				} else {
					/* pass */
				}

				if ($WARRIOR_RUN_COUNT_AT_LEAST_ONE_RUN_PROCESSED = 0) {
					/* ZERO INSTANCE OUTPUT */
					$apache_REPORT_RECORDENTRY2 = $apache_REPORT_RECORDENTRY2."
									<TR>
																		<TR>
										<TD COLSPAN='2'>
											<BR>
										</TD>
										<TD COLSPAN='3'>
											<P CLASS='INFOREPORT'>
												".$multilang_WARRIOR_39."
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

			/* BUILD THE SYNERGISTIC TOTALS SECTION */

			$mysql_query_index = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED) {

				/* -- FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE'>
										".$mysql_WORKING_RUN_MACHINE."
									</TD>
									<TD>
										<BR>
										<BR>
									</TD>
									<TD>
										<BR>
										<BR>
									</TD>
									<TD VALIGN='MIDDLE'>
										".$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE]."
									</TD>
									<TD VALIGN='MIDDLE'>
										".$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE]."
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
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE'>
										".$mysql_WORKING_RUN_MACHINE."
									</TD>
									<TD>
										<BR>
										<BR>
									</TD>
									<TD>
										<BR>
										<BR>
									</TD>
									<TD VALIGN='MIDDLE'>
										".$WARRIOR_RUN_TOTAL_UNITS[$mysql_WORKING_RUN_MACHINE]."
									</TD>
									<TD VALIGN='MIDDLE'>
										".$WARRIOR_RUN_TOTAL_MASS[$mysql_WORKING_RUN_MACHINE]."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='5'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='750' HEIGHT='2' ALT='BAR'><BR>
										<BR>
										<BR>
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
											<B>[".$multilang_WARRIOR_84."]: ".$multilang_WARRIOR_85."</B>...
										</P>
									</TD>
								</TR>
								<TR>
									<TD VALIGN='TOP' COLSPAN='3'>
										<BR>
										<B><U>".$multilang_WARRIOR_81."</U></B>
									</TD>
									<TD VALIGN='TOP'>
										<BR>
										<B><U>".$multilang_WARRIOR_82."</U></B><BR>
										[ ".$WARRIOR_UM_PACKAGE_UNIT." ]
									</TD>
									<TD VALIGN='TOP'>
										<BR>
										<B><U>".$multilang_WARRIOR_83."</U></B><BR>
										[ ".$WARRIOR_UM_PACKAGE_UNIT_MASS." ]
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
									<TD VALIGN='TOP' COLSPAN='5'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											<B>[".$multilang_WARRIOR_86."]: ".$multilang_WARRIOR_87."</B>...
										</P>
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
