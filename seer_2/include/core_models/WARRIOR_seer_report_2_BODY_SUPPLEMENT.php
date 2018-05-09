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
WARRIOR REPORT BODY 2 SUPPLEMENT (INCLUDED TO ALL WARRIOR INSTANCES)
-- PARETO CHARTS, PARETO CHARTS, AND MORE TWEAKED PARETO CHARTS.
---------------------------------------------------------------------
*/


			/* BORDER OFF CSV FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv_export_r2_border_12_column();

			/* BUILD REPORT SECTION - "DOWNTIME PARETO HYBRID ANALYSIS - DOWNTIME" */
			/* ------------------------------------------------------------------------------------------------- */
			if ( $JUMP_FROM_REPORT_0 == 'YES') {
				$mysql_query_index = $mysql_ENTRY_MACHINENAME;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $mysql_ENTRY_MACHINENAME;
			} else {
				$mysql_query_index = 0;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $WARRIOR_COUNT_ADJUSTED;
			}
			$mysql_chart_header_check = 0;

			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED_TO_USE) {

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$mysql_chart_footer_check = 0;

				if ($mysql_chart_header_check == 0) {
					/* POST HEADER ROW */
					$apache_REPORT_RECORDENTRY_3 = "
								<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='75'>
										</TD>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='425'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='TOP' COLSPAN='4'>
											<P CLASS='INFOREPORTBIGTEXT'>
												<BR>
												<B>[".$multilang_WARRIOR_120."]: ".$multilang_WARRIOR_123."</B>...
											</P>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
					$mysql_chart_header_check = 1;
				} else {
					/* pass */
				}

				/* PUT UP A DESCRIPTION BAR */
				$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE' ALIGN='CENTER' COLSPAN='2'>
										<BR>
										<B><U>".$mysql_WORKING_RUN_MACHINE."</U></B><BR>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_118."</U></B><BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_124."</U></B><BR>
										<BR>
										[# - ".$multilang_STATIC_FREQUENCY."]<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_WARRIOR_94."</U></B><BR>
										[ ".$multilang_WARRIOR_53." ]<BR>
										( [ % ] )<BR>
										(( [ % ] ))
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<BR>
										<BR>
										...".$multilang_WARRIOR_131."<BR>
										...".$multilang_WARRIOR_132."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";

				if ($WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] > 0 ) {

					$mysql_chart_footer_check = 1;

					$WARRIOR_HOLDING_ALARM_PARETO_COUNT = 0;
					$WARRIOR_HOLDING_ALARM_IDENTITY = array();
					$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION = array();
					$WARRIOR_HOLDING_ALARM_DURATION = array();
					$WARRIOR_HOLDING_ALARM_FREQUENCY = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME = array();

					$mysql_query_internal_index_1 = 0;
					while ($mysql_query_internal_index_1 <= $WARRIOR_DOWNTIME_and_NONSCHEDULED_CATEGORY_COUNT_ADJUSTED) {
						if ( ($mysql_query_internal_index_1 != 7) && ($mysql_query_internal_index_1 != 8) ) {
							$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_DOWNTIME_and_NONSCHEDULED_CATEGORY[$mysql_query_internal_index_1];
							$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_HYBRID_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1];
							$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_HYBRID_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] * 100 / 60;
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
							$WARRIOR_HOLDING_ALARM_PARETO_COUNT = $WARRIOR_HOLDING_ALARM_PARETO_COUNT + 1;
						} else {
							/* pass */
						}

						/* INDEX */
						$mysql_query_internal_index_1 = $mysql_query_internal_index_1 + 1;
					}
				
					/* SORT BY DURATION */
					$TEST1 = array_multisort($WARRIOR_HOLDING_ALARM_DURATION, SORT_DESC, $WARRIOR_HOLDING_ALARM_FREQUENCY, $WARRIOR_HOLDING_ALARM_IDENTITY, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME);
					$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = 0;
					$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 1;
					while ($WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX < $WARRIOR_HOLDING_ALARM_PARETO_COUNT) {
						if ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] > 0) {
							if ($WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN == 1) {

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* ADD NEXT CSV HEADER */
								/* MACHINE, RANGE, ALARM TYPE, FILLER, DURATION[UM] + 7 FILLER */
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_120.$seer_CSV_DELINEATION.$multilang_WARRIOR_58.$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_81.$seer_CSV_DELINEATION.$multilang_WARRIOR_118.$seer_CSV_DELINEATION.$multilang_WARRIOR_124." [".$multilang_STATIC_FREQUENCY."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION.$multilang_WARRIOR_94."[".$multilang_WARRIOR_53."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* SET PARETO WIDTH */
								$WARRIOR_PARETO_SCALE_BY_ME = varcharTOnumeric2((425 / $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 4);

								/* UNLATCH FIRST RUN */
								$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 0;
							} else {
								/* pass */
							}

							/* -- FLIP FLOP ROW COLOR */
							$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

							$apache_REPORT_PARETO_PLOTWIDTH = varcharTOnumeric2(($WARRIOR_PARETO_SCALE_BY_ME * $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 0);
							if ($apache_REPORT_PARETO_PLOTWIDTH < 1) {
								$apache_REPORT_PARETO_PLOTWIDTH = 1;
							} else {
								if ($apache_REPORT_PARETO_PLOTWIDTH > 425) {
									$apache_REPORT_PARETO_PLOTWIDTH = 425;
								} else {
									/* pass */
								}
							}

			
							$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										".$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX."
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										".$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."<BR>
										<BR>
										[# - ".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]
									</TD>
									<TD VALIGN='MIDDLE' ALIGN='CENTER'>
										<B>".$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."</B><BR>
										<BR>
										( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] )<BR>
										(( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] ))
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$apache_REPORT_PARETO_PLOTWIDTH." HEIGHT='30' ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";

							/* ADD NEXT CSV ENTRY */
							/* MACHINE, RANGE, ALARM TYPE, FILLER, DURATION[UM] + 7 FILLER */
							$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;
						} else {
							/* pass */
						}

						/* INDEX */
						$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = $WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX + 1;
					}

					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";

				} else {
					/* pass */
					/* ... but validate the function performed to ensure data integrity */
					$TEST1 = TRUE;

					/* ZERO FAULT OUTPUT */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_61."<BR>
											".$multilang_STATIC_62."
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";

				}

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;	

				if ($mysql_chart_footer_check == 1) {
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}

				/* BORDER OFF CSV FOR EXPORT */
				/* -- 12 COLUMN BORDER */
				model_WARRIOR_csv_export_r2_border_12_column();

			}

			$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
							</TABLE>
							";

			/* BORDER OFF CSV FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv_export_r2_border_12_column();

			/* DOWNTIME PARETO HYBRID ANALYSIS -- SCHEDULED DOWN */
			/* ------------------------------------------------------------------------------------------------- */
			if ( $JUMP_FROM_REPORT_0 == 'YES') {
				$mysql_query_index = $mysql_ENTRY_MACHINENAME;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $mysql_ENTRY_MACHINENAME;
			} else {
				$mysql_query_index = 0;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $WARRIOR_COUNT_ADJUSTED;
			}
			$mysql_chart_header_check = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED_TO_USE) {

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$mysql_chart_footer_check = 0;

				if ($mysql_chart_header_check == 0) {
					/* POST HEADER ROW */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='75'>
										</TD>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='425'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='TOP' COLSPAN='4'>
											<P CLASS='INFOREPORTBIGTEXT'>
												<BR>
												<B>[".$multilang_WARRIOR_120."]: ".$multilang_WARRIOR_122."</B>...
											</P>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
					$mysql_chart_header_check = 1;
				} else {
					/* pass */
				}

				/* PUT UP A DESCRIPTION BAR */
				$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE' ALIGN='CENTER' COLSPAN='2'>
											<BR>
											<B><U>".$mysql_WORKING_RUN_MACHINE."</U></B><BR>
											<BR>
										</TD>
										<TD COLSPAN='2'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_118."</U></B><BR>
										</TD>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_124."</U></B><BR>
											<BR>
											[ # - ".$multilang_STATIC_FREQUENCY."]<BR>
										</TD>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_94."</U></B><BR>
											[ ".$multilang_WARRIOR_53." ]<BR>
											( [ % ] )<BR>
											(( [ % ] ))
										</TD>
										<TD ALIGN='LEFT' VALIGN='TOP'>
											<BR>
											<BR>
											...".$multilang_WARRIOR_131."<BR>
											...".$multilang_WARRIOR_132."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";

				if ($WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] > 0 ) {

					$mysql_chart_footer_check = 1;

					$WARRIOR_HOLDING_ALARM_PARETO_COUNT = 0;
					$WARRIOR_HOLDING_ALARM_IDENTITY = array();
					$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION = array();
					$WARRIOR_HOLDING_ALARM_DURATION = array();
					$WARRIOR_HOLDING_ALARM_FREQUENCY = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME = array();

					$mysql_query_internal_index_1 = 0;
					while ($mysql_query_internal_index_1 <= $WARRIOR_DOWNTIME_and_NONSCHEDULED_CATEGORY_COUNT_ADJUSTED) {
						if ( ($mysql_query_internal_index_1 == 7) || ($mysql_query_internal_index_1 == 8) ) {
							$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_DOWNTIME_and_NONSCHEDULED_CATEGORY[$mysql_query_internal_index_1];
							$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_HYBRID_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1];
							$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_HYBRID_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] * 100 / 60;
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE];
							$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
							$WARRIOR_HOLDING_ALARM_PARETO_COUNT = $WARRIOR_HOLDING_ALARM_PARETO_COUNT + 1;
						} else {
							/* pass */
						}

						/* INDEX */
						$mysql_query_internal_index_1 = $mysql_query_internal_index_1 + 1;
					}
				
					/* SORT BY DURATION */
					$TEST2 = array_multisort($WARRIOR_HOLDING_ALARM_DURATION, SORT_DESC, $WARRIOR_HOLDING_ALARM_FREQUENCY, $WARRIOR_HOLDING_ALARM_IDENTITY, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME);
					$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = 0;
					$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 1;
					while ($WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX < $WARRIOR_HOLDING_ALARM_PARETO_COUNT) {
						if ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] > 0) {
							if ($WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN == 1) {

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* ADD NEXT CSV HEADER */
								/* MACHINE, RANGE, ALARM TYPE, FILLER, DURATION[UM] + 7 FILLER */
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_120.$seer_CSV_DELINEATION.$multilang_WARRIOR_57.$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_81.$seer_CSV_DELINEATION.$multilang_WARRIOR_118.$seer_CSV_DELINEATION.$multilang_WARRIOR_124." [".$multilang_STATIC_FREQUENCY."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION.$multilang_WARRIOR_94."[".$multilang_WARRIOR_53."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* SET PARETO WIDTH */
								$WARRIOR_PARETO_SCALE_BY_ME = varcharTOnumeric2((425 / $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 4);

								/* UNLATCH FIRST RUN */
								$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 0;
							} else {
								/* pass */
							}

							if ($apache_BGCOLOR_FLIM_FLAM == 0) {
								$apache_REPORT_BGCOLOR_TO_USE = $apache_REPORT_ROW_BGCOLOR_ALT;
								$apache_BGCOLOR_FLIM_FLAM = 1;
							} else {
								$apache_REPORT_BGCOLOR_TO_USE = $apache_REPORT_ROW_BGCOLOR;
								$apache_BGCOLOR_FLIM_FLAM = 0;
							}

							$apache_REPORT_PARETO_PLOTWIDTH = varcharTOnumeric2(($WARRIOR_PARETO_SCALE_BY_ME * $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 0);
							if ($apache_REPORT_PARETO_PLOTWIDTH < 1) {
								$apache_REPORT_PARETO_PLOTWIDTH = 1;
							} else {
								if ($apache_REPORT_PARETO_PLOTWIDTH > 425) {
									$apache_REPORT_PARETO_PLOTWIDTH = 425;
								} else {
									/* pass */
								}
							}

			
							$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR ".$apache_REPORT_BGCOLOR_TO_USE.">
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											".$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX."
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											".$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."<BR>
											<BR>
											[# - ".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]<BR>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<B>".$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."</B><BR>
											<BR>
											( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] )<BR>
											(( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] ))
										</TD>
										<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
											<IMG SRC='./img/horizontal_bar.png' WIDTH=".$apache_REPORT_PARETO_PLOTWIDTH." HEIGHT='30' ALT='HORIZONTAL BAR'>
										</TD>
									</TR>
									";

							/* ADD NEXT CSV ENTRY */
							/* MACHINE, RANGE, ALARM TYPE, FILLER, DURATION[UM] + 7 FILLER */
							$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;
						} else {
							/* pass */
						}

						/* INDEX */
						$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = $WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX + 1;
					}

					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";

				} else {
					/* pass */
					/* ... but validate the function performed to ensure data integrity */
					$TEST2 = TRUE;

					/* ZERO FAULT OUTPUT */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_61."<BR>
											".$multilang_STATIC_62."
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";
				}

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;	

				if ($mysql_chart_footer_check == 1) {
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
				} else {
					/* pass */
				}

				/* BORDER OFF CSV FOR EXPORT */
				/* -- 12 COLUMN BORDER */
				model_WARRIOR_csv_export_r2_border_12_column();

			}

			$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								</TABLE>
								";

			/* BORDER OFF CSV FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv_export_r2_border_12_column();

			/* DOWNTIME PARETO DISCRETE ANALYSIS (LIKE COMBINATIONS OF DOWNTIME AND CORRECTIVE ACTION TOTALIZED) */
			/* ------------------------------------------------------------------------------------------------- */
			if ( $JUMP_FROM_REPORT_0 == 'YES') {
				$mysql_query_index = $mysql_ENTRY_MACHINENAME;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $mysql_ENTRY_MACHINENAME;
			} else {
				$mysql_query_index = 0;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $WARRIOR_COUNT_ADJUSTED;
			}
			$mysql_chart_header_check = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED_TO_USE) {

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$mysql_chart_footer_check = 0;

				if ($mysql_chart_header_check == 0) {
					/* POST HEADER */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='75'>
										</TD>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='425'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='TOP' COLSPAN='4'>
											<P CLASS='INFOREPORTBIGTEXT'>
												<BR>
												<B>[".$multilang_WARRIOR_121."]: ".$multilang_WARRIOR_117."</B>...
											</P>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";

					$mysql_chart_header_check = 1;
				} else {
					/* pass */
				}

				/* PUT UP A DESCRIPTION BAR */
				$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE' ALIGN='CENTER' COLSPAN='2'>
											<BR>
											<B><U>".$mysql_WORKING_RUN_MACHINE."</U></B><BR>
											<BR>
										</TD>
										<TD COLSPAN='2'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_118."</U></B><BR>
										</TD>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_113."</U></B><BR>
											<B><I>".$multilang_WARRIOR_28."</I></B><BR>
											<BR>
											[ # - ".$multilang_STATIC_FREQUENCY."]<BR>
										</TD>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_94."</U></B><BR>
											[ ".$multilang_WARRIOR_53." ]<BR>
											( [ % ] )<BR>
											(( [ % ] ))
										</TD>
										<TD ALIGN='LEFT' VALIGN='TOP'>
											<BR>
											<BR>
											...".$multilang_WARRIOR_131."<BR>
											...".$multilang_WARRIOR_132."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";

				if ($WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE] > 0 ) {

					$mysql_chart_footer_check = 1;

					$WARRIOR_HOLDING_ALARM_PARETO_COUNT = 0;
					$WARRIOR_HOLDING_ALARM_IDENTITY = array();
					$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION = array();
					$WARRIOR_HOLDING_ALARM_DURATION = array();
					$WARRIOR_HOLDING_ALARM_FREQUENCY = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME = array();

					$mysql_query_internal_index_1 = 0;
					while ($mysql_query_internal_index_1 <= $WARRIOR_ALARM_COUNT_ADJUSTED) {
					
						$mysql_query_internal_index_2 = 0;
						while ($mysql_query_internal_index_2 <= $WARRIOR_ACTION_COUNT_ADJUSTED) {
							if (isset($WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2]) && ($WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2] > 0) && ( ($mysql_query_internal_index_2 < 1) || ($mysql_query_internal_index_2 > 3) )) {
								$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_ALARM[$mysql_query_internal_index_1];
								$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_ACTION[$mysql_query_internal_index_2];
								$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2];
								$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] * 100 / 60;
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_DOWNTIME[$mysql_WORKING_RUN_MACHINE];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
								$WARRIOR_HOLDING_ALARM_PARETO_COUNT = $WARRIOR_HOLDING_ALARM_PARETO_COUNT + 1;
							} else {
								/* pass */
							}

							/* INDEX */
							$mysql_query_internal_index_2 = $mysql_query_internal_index_2 + 1;
						}

						/* INDEX */
						$mysql_query_internal_index_1 = $mysql_query_internal_index_1 + 1;
					}
				
					/* SORT BY DURATION */
					$TEST3 = array_multisort($WARRIOR_HOLDING_ALARM_DURATION, SORT_DESC, $WARRIOR_HOLDING_ALARM_FREQUENCY, $WARRIOR_HOLDING_ALARM_IDENTITY, $WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME);
					$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = 0;
					$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 1;
					while ($WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX < $WARRIOR_HOLDING_ALARM_PARETO_COUNT) {
						if ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] > 0) {
							if ($WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN == 1) {

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* ADD NEXT CSV HEADER */
								/* MACHINE, RANGE, ALARM TYPE, CORRECTIVE ACTION, DURATION[UM] + 7 FILLER */
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_121.$seer_CSV_DELINEATION.$multilang_WARRIOR_58.$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_81.$seer_CSV_DELINEATION.$multilang_WARRIOR_118.$seer_CSV_DELINEATION.$multilang_WARRIOR_113." [".$multilang_STATIC_FREQUENCY."]".$seer_CSV_DELINEATION.$multilang_WARRIOR_28.$seer_CSV_DELINEATION.$multilang_WARRIOR_94."[".$multilang_WARRIOR_53."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* SET PARETO WIDTH */
								$WARRIOR_PARETO_SCALE_BY_ME = varcharTOnumeric2((425 / $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 4);

								/* UNLATCH FIRST RUN */
								$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 0;
							} else {
								/* pass */
							}

							/* -- FLIP FLOP ROW COLOR */
							$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

							$apache_REPORT_PARETO_PLOTWIDTH = varcharTOnumeric2(($WARRIOR_PARETO_SCALE_BY_ME * $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 0);
							if ($apache_REPORT_PARETO_PLOTWIDTH < 1) {
								$apache_REPORT_PARETO_PLOTWIDTH = 1;
							} else {
								if ($apache_REPORT_PARETO_PLOTWIDTH > 425) {
									$apache_REPORT_PARETO_PLOTWIDTH = 425;
								} else {
									/* pass */
								}
							}

							/* BUGFIX FOR EMPTY CELL */
							if (isset($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]) && ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] != "") && ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] != " ")) {
								/* proceed */
								if ($WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] != $WARRIOR_ACTION[0]) {
									$CORRECTIVE_ACTION_TO_POST_IN_PARETO = "<B><I>".$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."</I></B><BR>";
								} else {
									$CORRECTIVE_ACTION_TO_POST_IN_PARETO = "";
								}
								$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											".$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX."
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											".$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."<BR>
											".$CORRECTIVE_ACTION_TO_POST_IN_PARETO."
											<BR>
											[# - ".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]<BR>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<B>".$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."</B><BR>
											<BR>
											( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] )<BR>
											(( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] )) 
										</TD>
										<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
											<IMG SRC='./img/horizontal_bar.png' WIDTH=".$apache_REPORT_PARETO_PLOTWIDTH." HEIGHT='30' ALT='HORIZONTAL BAR'>
										</TD>
									</TR>
									";

								/* ADD NEXT CSV ENTRY */
								/* MACHINE, RANGE, ALARM TYPE, CORRECTIVE ACTION, DURATION[UM] + 7 FILLER */
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]".$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION.$seer_CSV_ENDOFLINE_HOLDING;

							} else {
								/* pass */
							}
						} else {
							/* pass */
						}

						/* INDEX */
						$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = $WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX + 1;
					}

					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
				} else {
					/* pass */
					/* ... but validate the function performed to ensure data integrity */
					$TEST3 = TRUE;

					/* ZERO FAULT OUTPUT */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_61."<BR>
											".$multilang_STATIC_62."
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";
				}

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;	

				if ($mysql_chart_footer_check == 1) {
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
				} else {
					/* pass */
				}

				/* BORDER OFF CSV FOR EXPORT */
				/* -- 12 COLUMN BORDER */
				model_WARRIOR_csv_export_r2_border_12_column();

			}

			$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								</TABLE>
								";

			/* BORDER OFF CSV FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv_export_r2_border_12_column();

			/* DOWNTIME PARETO DISCRETE ANALYSIS (LIKE COMBINATIONS OF NOTSCHEDULED AND CORRECTIVE ACTION TOTALIZED) */
			/* ----------------------------------------------------------------------------------------------------- */
			if ( $JUMP_FROM_REPORT_0 == 'YES') {
				$mysql_query_index = $mysql_ENTRY_MACHINENAME;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $mysql_ENTRY_MACHINENAME;
			} else {
				$mysql_query_index = 0;
				$WARRIOR_COUNT_ADJUSTED_TO_USE = $WARRIOR_COUNT_ADJUSTED;
			}
			$mysql_chart_header_check = 0;
			while ($mysql_query_index <= $WARRIOR_COUNT_ADJUSTED_TO_USE) {

				$mysql_WORKING_RUN_MACHINE = $WARRIOR_NAME[$mysql_query_index];
				$mysql_chart_footer_check = 0;

				if ($mysql_chart_header_check == 0) {
					/* POST HEADER ROW */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='75'>
										</TD>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='425'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD VALIGN='TOP' COLSPAN='4'>
											<P CLASS='INFOREPORTBIGTEXT'>
												<BR>
												<B>[".$multilang_WARRIOR_121."]: ".$multilang_WARRIOR_119."</B>...
											</P>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
					$mysql_chart_header_check = 1;
				} else {
					/* pass */
				}

				/* PUT UP A DESCRIPTION BAR */
				$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD CLASS='hmicellborder1_ALT' VALIGN='MIDDLE' ALIGN='CENTER' COLSPAN='2'>
											<BR>
											<B><U>".$mysql_WORKING_RUN_MACHINE."</U></B><BR>
											<BR>
										</TD>
										<TD COLSPAN='2'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_118."</U></B><BR>
										</TD>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_113."</U></B><BR>
											<B><I>".$multilang_WARRIOR_28."</I></B><BR>
											<BR>
											[ # - ".$multilang_STATIC_FREQUENCY."]<BR>
										</TD>
										<TD ALIGN='CENTER' VALIGN='TOP'>
											<B><U>".$multilang_WARRIOR_94."</U></B><BR>
											[ ".$multilang_WARRIOR_53." ]<BR>
											( [ % ] )<BR>
											(( [ % ] ))
										</TD>
										<TD ALIGN='LEFT' VALIGN='TOP'>
											<BR>
											<BR>
											...".$multilang_WARRIOR_131."<BR>
											...".$multilang_WARRIOR_132."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";

				if ($WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] > 0 ) {

					$mysql_chart_footer_check = 1;

					$WARRIOR_HOLDING_ALARM_PARETO_COUNT = 0;
					$WARRIOR_HOLDING_ALARM_IDENTITY = array();
					$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION = array();
					$WARRIOR_HOLDING_ALARM_DURATION = array();
					$WARRIOR_HOLDING_ALARM_FREQUENCY = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME = array();
					$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME = array();

					$mysql_query_internal_index_1 = 0;
					while ($mysql_query_internal_index_1 <= $WARRIOR_ALARM_COUNT_ADJUSTED) {
					
						$mysql_query_internal_index_2 = 0;
						while ($mysql_query_internal_index_2 <= $WARRIOR_ACTION_COUNT_ADJUSTED) {
							if (isset($WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2]) && ($WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2] > 0) && ( ($mysql_query_internal_index_2 >= 2) && ($mysql_query_internal_index_2 <= 3) )) {
								$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_ALARM[$mysql_query_internal_index_1];
								$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_ACTION[$mysql_query_internal_index_2];
								$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_PARETO[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2];
								$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_RUN_ALARM_PARETO_FREQUENCY[$mysql_WORKING_RUN_MACHINE][$mysql_query_internal_index_1][$mysql_query_internal_index_2];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] * 100 / 60;
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] / $WARRIOR_RUN_TOTAL_TIME[$mysql_WORKING_RUN_MACHINE];
								$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT] = varcharTOnumeric2($WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT], 2);
								$WARRIOR_HOLDING_ALARM_PARETO_COUNT = $WARRIOR_HOLDING_ALARM_PARETO_COUNT + 1;
							} else {
								/* pass */
							}

							/* INDEX */
							$mysql_query_internal_index_2 = $mysql_query_internal_index_2 + 1;
						}

						/* INDEX */
						$mysql_query_internal_index_1 = $mysql_query_internal_index_1 + 1;
					}
				
					/* SORT BY DURATION */
					$TEST4 = array_multisort($WARRIOR_HOLDING_ALARM_DURATION, SORT_DESC, $WARRIOR_HOLDING_ALARM_FREQUENCY, $WARRIOR_HOLDING_ALARM_IDENTITY, $WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME, $WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME);
					$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = 0;
					$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 1;
					while ($WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX < $WARRIOR_HOLDING_ALARM_PARETO_COUNT) {
						if ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] > 0) {
							if ($WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN == 1) {
								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* ADD NEXT CSV HEADER */
								/* MACHINE, RANGE, ALARM TYPE, CORRECTIVE ACTION, DURATION[UM] + 7 FILLER */
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_121.$seer_CSV_DELINEATION.$multilang_WARRIOR_57.$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$multilang_WARRIOR_81.$seer_CSV_DELINEATION.$multilang_WARRIOR_118.$seer_CSV_DELINEATION.$multilang_WARRIOR_113." [".$multilang_STATIC_FREQUENCY."]".$seer_CSV_DELINEATION.$multilang_WARRIOR_28.$seer_CSV_DELINEATION.$multilang_WARRIOR_94."[".$multilang_WARRIOR_53."]".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;

								/* BORDER OFF CSV FOR EXPORT */
								/* -- 12 COLUMN BORDER */
								model_WARRIOR_csv_export_r2_border_12_column();

								/* SET PARETO WIDTH */
								$WARRIOR_PARETO_SCALE_BY_ME = varcharTOnumeric2((425 / $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 2);

								/* UNLATCH FIRST RUN */
								$WARRIOR_HOLDING_ALARM_PARETO_FIRST_RUN = 0;
							} else {
								/* pass */
							}

							/* -- FLIP FLOP ROW COLOR */
							$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

							$apache_REPORT_PARETO_PLOTWIDTH = varcharTOnumeric2(($WARRIOR_PARETO_SCALE_BY_ME * $WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]), 0);
							if ($apache_REPORT_PARETO_PLOTWIDTH < 1) {
								$apache_REPORT_PARETO_PLOTWIDTH = 1;
							} else {
								if ($apache_REPORT_PARETO_PLOTWIDTH > 425) {
									$apache_REPORT_PARETO_PLOTWIDTH = 425;
								} else {
									/* pass */
								}
							}

							/* BUGFIX FOR EMPTY CELL */
							if (isset($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]) && ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] != "") && ($WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] != " ")) {
								/* proceed */
								if ($WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX] != $WARRIOR_ACTION[0]) {
									$CORRECTIVE_ACTION_TO_POST_IN_PARETO = "<B><I>".$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."</I></B><BR>";
								} else {
									$CORRECTIVE_ACTION_TO_POST_IN_PARETO = "";
								}
								$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											".$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX."
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											".$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].":<BR>
											".$CORRECTIVE_ACTION_TO_POST_IN_PARETO."
											<BR>
											[# - ".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]<BR>
										</TD>
										<TD VALIGN='MIDDLE' ALIGN='CENTER'>
											<B>".$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."</B><BR>
											<BR>
											( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_DOWNTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] )<BR>
											(( ".$WARRIOR_HOLDING_ALARM_DURATION_PERCENTAGE_OF_TOTALTIME[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [%] ))
										</TD>
										<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
											<IMG SRC='./img/horizontal_bar.png' WIDTH=".$apache_REPORT_PARETO_PLOTWIDTH." HEIGHT='30' ALT='HORIZONTAL BAR'>
										</TD>
									</TR>
									";

								/* ADD NEXT CSV ENTRY */
								/* MACHINE, RANGE, ALARM TYPE, CORRECTIVE ACTION, DURATION[UM] + 7 FILLER */
								$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_WORKING_RUN_MACHINE.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX.$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_IDENTITY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]." [".$WARRIOR_HOLDING_ALARM_FREQUENCY[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX]."]".$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_CORRECTIVE_ACTION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].$seer_CSV_DELINEATION.$WARRIOR_HOLDING_ALARM_DURATION[$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX].$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_DELINEATION."-----".$seer_CSV_ENDOFLINE_HOLDING;

							} else {
								/* pass */
							}
						} else {
							/* pass */
						}

						/* INDEX */
						$WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX = $WARRIOR_HOLDING_ALARM_PARETO_COUNT_INDEX + 1;
					}
				
				} else {
					/* pass */
					/* ... but validate the function performed to ensure data integrity */
					$TEST4 = TRUE;

					/* ZERO FAULT OUTPUT */
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_61."<BR>
											".$multilang_STATIC_62."
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";
				}

				if ( ($WARRIOR_RUN_TOTAL_NOTSCHEDULEDTIME[$mysql_WORKING_RUN_MACHINE] > 0) && ($WARRIOR_HOLDING_ALARM_PARETO_COUNT > 0) ) {
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
				} else {
					/* pass */
				}

				/* INDEX */
				$mysql_query_index = $mysql_query_index + 1;	

				if ($mysql_chart_footer_check == 1) {
					$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
									<TR>
										<TD COLSPAN='4'>
											<BR>
										</TD>
									</TR>
									";
				} else {
					/* pass */
				}

				/* BORDER OFF CSV FOR EXPORT */
				/* -- 12 COLUMN BORDER */
				model_WARRIOR_csv_export_r2_border_12_column();

			}

			$apache_REPORT_RECORDENTRY_3 = $apache_REPORT_RECORDENTRY_3."
								</TABLE>
								";

			/* BORDER OFF CSV FOR EXPORT */
			/* -- 12 COLUMN BORDER */
			model_WARRIOR_csv_export_r2_border_12_column();


?>
