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
TTYPERFORMANCE MODEL HMI 1 BODY_SUPPLEMENT 
	(INCLUDED TO ALL TTYPERFORMANCEMODELS)
---------------------------------------------------------------------
*/

/* THIS FILE PROVIDES THE 'GUTS' OF HMI_0 (DEPARTMENT MONITOR) */
/* AND REPORT_0 (RUNTIME ANALYSIS) */
/* MODIFICATIONS TO THIS FILE WILL AFFECT BOTH OF THEM. */

/* SANITIZE BAD FLAGS */
foreach ($TTYPERFORMANCEMODEL_BAD_FLAGS as $key_bad_flag_to_test => $bad_flag_to_test) {
	$TTYPERFORMANCEMODEL_BAD_FLAGS[$key_bad_flag_to_test] = sanitizeRANDOMcontent($bad_flag_to_test, $multilang_STATIC_NONE, 'STRICT');
}

/* SCAN TTY DATA FROM DATABASE */
$apache_REPORT_RECORDENTRY = "";
$mysql_index = 0;
$mysql_mod_openopc_BAD_DATA_COUNT_INCLUDED_DEVICES = 0;
$mysql_mod_openopc_BAD_DATA_COUNT_EXCLUDED_DEVICES = 0;
$mysql_mod_openopc_TOTAL_DATA_COUNT_INCLUDED_DEVICES = 0;
$mysql_mod_openopc_TOTAL_DATA_COUNT_EXCLUDED_DEVICES = 0;
$apache_device_priority_included_color_setting = "BGCOLOR='#CCFF66'";
$apache_device_priority_excluded_color_setting = "BGCOLOR='#ABABAB'";
while ($mysql_index <= $TTYPERFORMANCEMODEL_COUNT_ADJUSTED) {

	/* DEVICE HIGHLIGHT COLOR TO INDICATE IF IT IS A PRIORITY (INCLUDE IN GRADING) DEVICE OR NOT */
	if ($TTYPERFORMANCEMODEL_INCLUDE_IN_PERFORMANCE_GRADING[$mysql_index] == 'YES') {
		/* GREEN */
		$apache_device_priority_highlight_bgcolor = $apache_device_priority_included_color_setting;
	} else {
		/* GREY */
		$apache_device_priority_highlight_bgcolor = $apache_device_priority_excluded_color_setting;
	}

	/* 1st half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
	if ($apache_BODY_SUPPLEMENT_USE == 'REPORT_0') {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1' ".$apache_device_priority_highlight_bgcolor.">
										<B>".$TTYPERFORMANCEMODEL_NAME[$mysql_index]."</B>
									</TD>
								";
	} else {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$TTYPERFORMANCEMODEL_NAME[$mysql_index]."</U></B>
									</TD>
								";
	}

	/* CHECK FOR ENTRIES IN SNAPSHOT TIME */
	$mysql_mod_openopc_query = "DATESTAMP";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TTYPERFORMANCEMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINENAME LIKE '".$TTYPERFORMANCEMODEL_NAME[$mysql_index]."') ) ORDER BY DATESTAMP DESC LIMIT 1";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
		$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	}

	if ($mysql_mod_openopc_query_result_rows > 0) {
		/* UPDATE DATAFRESH TIME */
		if ($apache_REPORT_FRESHTIME == $multilang_STATIC_NONE) {
			$apache_REPORT_FRESHTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
		} else {
			if ($mysql_mod_openopc_WORKING_DATESTAMP > $apache_REPORT_FRESHTIME) {
				$apache_REPORT_FRESHTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
			} else {
				/* pass */
			}
		}
		/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
		if ($apache_BODY_SUPPLEMENT_USE != 'REPORT_0') {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' ".$apache_device_priority_highlight_bgcolor.">
										<B><I>".$multilang_TTYPERFORMANCEMODEL_6." - ".$mysql_mod_openopc_WORKING_DATESTAMP."</I></B><BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
		} else {
			/* pass */
		}
		$mysql_mod_openopc_query2 = "DATESTAMP, TTY";
		$mysql_mod_openopc_query2 = "SELECT ".$mysql_mod_openopc_query2." FROM ".$TTYPERFORMANCEMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINENAME LIKE '".$TTYPERFORMANCEMODEL_NAME[$mysql_index]."') ) ORDER BY DATESTAMP DESC";
		list($mysql_mod_openopc_query_result2,$mysql_mod_openopc_query_result_rows2) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query2);
		$mysql_mod_openopc_BAD_DATA_COUNT = 0;
		$apache_items_per_row = 2;
		$apache_item_active_in_row = 0;
		$apache_item_active_in_query = 0;
		$apache_SWITCH_ROW_COLOR = 0;
		if ($TTYPERFORMANCEMODEL_DEPT_MONITOR_SNAPSHOT_LIMIT_RECORDS >= $mysql_mod_openopc_query_result_rows2) {
			/* pass */
		} else {
			$apache_item_in_query_limit = $TTYPERFORMANCEMODEL_DEPT_MONITOR_SNAPSHOT_LIMIT_RECORDS;
		}
		while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result2)) {
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_TTY = sanitizeRANDOMcontent($mysql_mod_openopc_query_row['TTY'], $multilang_STATIC_NONE, 'STRICT');

			# INDEX ACTIVE ITEM COUNT
			$apache_item_active_in_row = $apache_item_active_in_row + 1;
			$apache_item_active_in_query = $apache_item_active_in_query + 1;

			if ($apache_BODY_SUPPLEMENT_USE == 'REPORT_0') {
				if ($TTYPERFORMANCEMODEL_INCLUDE_IN_PERFORMANCE_GRADING[$mysql_index] == 'YES') {
					$mysql_mod_openopc_TOTAL_DATA_COUNT_INCLUDED_DEVICES = 	$mysql_mod_openopc_TOTAL_DATA_COUNT_INCLUDED_DEVICES + 1;
				} else {
					$mysql_mod_openopc_TOTAL_DATA_COUNT_EXCLUDED_DEVICES = 	$mysql_mod_openopc_TOTAL_DATA_COUNT_EXCLUDED_DEVICES + 1;
				}
			} else {
				/* pass */
			}

			# TEST FOR QUALITY (GOOD OR BAD DATA ENTRY)
			$apache_BAD_FLAG_FOUND = "NO";
			# -- CHECK FOR NUMERIC IF REQUIRED
			if ($TTYPERFORMANCEMODEL_REQUIRE_NUMERIC == 'YES') {
				if (is_numeric($mysql_mod_openopc_WORKING_TTY)) {
					/* pass */
				} else {
					if ($apache_BAD_FLAG_FOUND == 'NO') {
						$mysql_mod_openopc_BAD_DATA_COUNT = $mysql_mod_openopc_BAD_DATA_COUNT + 1;
						$apache_BAD_FLAG_FOUND = "YES";
					} else {
						/* pass */
					}
				}
			} else {
				/* pass */
			}
			# -- CHECK FOR LENGTH
			if ( (strlen($mysql_mod_openopc_WORKING_TTY) >= $TTYPERFORMANCEMODEL_REQUIRE_LENGTH_MIN) && ( strlen($mysql_mod_openopc_WORKING_TTY) <= $TTYPERFORMANCEMODEL_REQUIRE_LENGTH_MAX) ) {
				/* pass */
			} else {
				if ($apache_BAD_FLAG_FOUND == 'NO') {
					$mysql_mod_openopc_BAD_DATA_COUNT = $mysql_mod_openopc_BAD_DATA_COUNT + 1;
					$apache_BAD_FLAG_FOUND = "YES";
				} else {
					/* pass */
				}
			}
			# -- CHECK FOR BAD FLAGS
			foreach ($TTYPERFORMANCEMODEL_BAD_FLAGS as &$bad_flag_to_test) {
				if ( ($apache_BAD_FLAG_FOUND == 'NO') && (substr_count($mysql_mod_openopc_WORKING_TTY, $bad_flag_to_test) > 0) ) {
					$mysql_mod_openopc_BAD_DATA_COUNT = $mysql_mod_openopc_BAD_DATA_COUNT + 1;
					$apache_BAD_FLAG_FOUND = "YES";
				} else {
					/* pass */
				}
			}

			# BUILD A DISPLAY ROW
			if ( ($apache_item_active_in_query <= $apache_item_in_query_limit) && ($apache_BODY_SUPPLEMENT_USE == "HMI_0") ) {
				# -- FIRST ITEM IN A ROW
				if ($apache_item_active_in_row == '1') {
					$apache_REPORT_ENTRY_BGCOLOR_USE = core_row_color_flip_flop();
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD>
										<BR>
									</TD>
									";
				} else {
					/* pass */
				}
				# -- GENERAL DISPLAY FOR ALL ITEMS IN ANY ROW
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ALIGN='CENTER' ".$apache_REPORT_ENTRY_BGCOLOR_USE.">
										<B>[ ".$apache_item_active_in_query." ]</B><BR>
									</TD>
									<TD ALIGN='CENTER' ".$apache_REPORT_ENTRY_BGCOLOR_USE.">
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ".$apache_REPORT_ENTRY_BGCOLOR_USE.">
										<BR>
									</TD>
									<TD ALIGN='LEFT' ".$apache_REPORT_ENTRY_BGCOLOR_USE.">
										<I>".$mysql_mod_openopc_WORKING_TTY."</I>
									</TD>
									";

				# -- LAST ITEM IN A ROW
				if ($apache_item_active_in_row == $apache_items_per_row) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								</TR>
								";
					$apache_item_active_in_row = 0;
				} else {
					# -- LAST ITEM FOR A DEVICE IN GIVEN TIME PERIOD AND NOT LAST IN ROW
					if ($apache_item_active_in_query == $mysql_mod_openopc_query_result_rows2) {
						$apache_FILLER_COLSPAN = 4 * ($apache_items_per_row - $apache_item_active_in_row);
						$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='".$apache_FILLER_COLSPAN."' ".$apache_REPORT_ENTRY_BGCOLOR_USE.">
										<BR>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}
				}
				if ($apache_item_active_in_query == $mysql_mod_openopc_query_result_rows2) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
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
		}

		/* SUMMARIZE */
		if ($apache_BODY_SUPPLEMENT_USE == 'REPORT_0') {
			if ($TTYPERFORMANCEMODEL_INCLUDE_IN_PERFORMANCE_GRADING[$mysql_index] == 'YES') {
				$mysql_mod_openopc_BAD_DATA_COUNT_INCLUDED_DEVICES = $mysql_mod_openopc_BAD_DATA_COUNT_INCLUDED_DEVICES + $mysql_mod_openopc_BAD_DATA_COUNT;
			} else {
				$mysql_mod_openopc_BAD_DATA_COUNT_EXCLUDED_DEVICES = $mysql_mod_openopc_BAD_DATA_COUNT_EXCLUDED_DEVICES + $mysql_mod_openopc_BAD_DATA_COUNT;
			}
		} else {
			/* pass */
		}
		$mysql_mod_openopc_BAD_DATA_PERCENT = varcharTOnumeric2((100 - (100 * ($mysql_mod_openopc_BAD_DATA_COUNT / $mysql_mod_openopc_query_result_rows2))), 2);
		if ($apache_BODY_SUPPLEMENT_USE == 'HMI_0') {
			$apache_REPORT_ENTRY_BGCOLOR_USE_2 = "";
			$apache_text_to_place_before_discrete_fault_count = "<I><B>".$multilang_TTYPERFORMANCEMODEL_7."</B></I>";
			$apache_text_to_place_before_discrete_performance_percentage = "<I><B>".$multilang_WARRIOR_60."</B></I>";
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									";
		} else {
			$apache_REPORT_ENTRY_BGCOLOR_USE_2 = core_row_color_oddOReven($mysql_index);
			$apache_text_to_place_before_discrete_fault_count = "";
			$apache_text_to_place_before_discrete_performance_percentage = "";
			model_TTYPERFORMANCE_export_csv_report_0_build();
		}
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ALIGN='LEFT' ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										".$apache_text_to_place_before_discrete_fault_count."
									</TD>
									<TD ALIGN='CENTER' ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										<B>".$mysql_mod_openopc_BAD_DATA_COUNT." / ".$mysql_mod_openopc_query_result_rows2."</B>
									</TD>
									<TD ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										<BR>
									</TD>
									<TD ALIGN='LEFT' ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										".$apache_text_to_place_before_discrete_performance_percentage."
									</TD>
									<TD ALIGN='CENTER' ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										<B>".$mysql_mod_openopc_BAD_DATA_PERCENT." &#37</B>
									</TD>
									<TD ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
	} else {
		/* DEVICE HAS NO ENTRIES REPORTED DURING SNAPSHOT TIME */
		/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
		if ($apache_BODY_SUPPLEMENT_USE != 'REPORT_0') {
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#FF8866'>
										<B><I>".$multilang_TTYPERFORMANCEMODEL_4."</I></B><BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='7' ALIGN='CENTER'>
										".$multilang_TTYPERFORMANCEMODEL_12."
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
								";
		} else {
			$apache_REPORT_ENTRY_BGCOLOR_USE_2 = core_row_color_oddOReven($mysql_index);
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										<BR>
									</TD>
									<TD COLSPAN='4' ALIGN='CENTER' ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
										<I>".$multilang_TTYPERFORMANCEMODEL_12."</I>
									</TD>
									<TD ".$apache_REPORT_ENTRY_BGCOLOR_USE_2.">
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
	}

	/* FOOTER FOR THIS SECTION OF STANDARD BODY */
	if ($apache_BODY_SUPPLEMENT_USE != 'REPORT_0') {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
									</TD>
								</TR>";
	} else {
		/* pass */
	}

	/* INDEX */
	$mysql_index = $mysql_index + 1;
}

?>
