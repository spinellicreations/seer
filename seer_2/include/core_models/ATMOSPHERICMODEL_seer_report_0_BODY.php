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
ATMOSPHERIC MODEL REPORT 0 BODY (INCLUDED TO ALL ATMOSPHERICMODELS)
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
								<B>".$multilang_ATMOSPHERICMODEL_0.": ".$multilang_ATMOSPHERICMODEL_2."</B><BR>
								<I>".$ATMOSPHERICMODEL_SUBPAGETITLE."</I><BR>
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
	core_user_date_time_range_input_type_1($multilang_ATMOSPHERICMODEL_3);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, TEMPERATURE, HUMIDITY, PRESSURE";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$ATMOSPHERICMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINENAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		
		/* ZERO OUT CSV FOR EXPORT */
		model_ATMOSPHERIC_export_csv_report_0_zero();

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($ATMOSPHERICMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		$mysql_query_index = 1;
		$apache_SWITCH_ROW_COLOR = 0;
		$mysql_mod_openopc_AVERAGE_TEMPERATURE = 0;
		$mysql_mod_openopc_AVERAGE_HUMIDITY = 0;
		$mysql_mod_openopc_AVERAGE_PRESSURE = 0;
		$mysql_mod_openopc_MIN_TEMPERATURE = "NULLVAR";
		$mysql_mod_openopc_MIN_TEMPERATURE = "NULLVAR";
		$mysql_mod_openopc_MIN_HUMIDITY = "NULLVAR";
		$mysql_mod_openopc_MAX_HUMIDITY = "NULLVAR";
		$mysql_mod_openopc_MIN_PRESSURE = "NULLVAR";
		$mysql_mod_openopc_MAX_PRESSURE = "NULLVAR";
		$mysql_mod_openopc_records_examined = 0;

		/* CYCLE THROUGH THE QUERY RESULTS */
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				$mysql_mod_openopc_WORKING_TEMPERATURE = $mysql_mod_openopc_query_row['TEMPERATURE'];
				$mysql_mod_openopc_WORKING_HUMIDITY = $mysql_mod_openopc_query_row['HUMIDITY'];
				$mysql_mod_openopc_WORKING_PRESSURE = $mysql_mod_openopc_query_row['PRESSURE'];

				/* MINS AND MAXES */
				$mysql_mod_openopc_MIN_TEMPERATURE = core_min_max_finder("min","NULLVAR",$mysql_mod_openopc_MIN_TEMPERATURE,$mysql_mod_openopc_WORKING_TEMPERATURE);
				$mysql_mod_openopc_MAX_TEMPERATURE = core_min_max_finder("max","NULLVAR",$mysql_mod_openopc_MAX_TEMPERATURE,$mysql_mod_openopc_WORKING_TEMPERATURE);
				$mysql_mod_openopc_MIN_PRESSURE = core_min_max_finder("min","NULLVAR",$mysql_mod_openopc_MIN_HUMIDITY,$mysql_mod_openopc_WORKING_HUMIDITY);
				$mysql_mod_openopc_MAX_PRESSURE = core_min_max_finder("max","NULLVAR",$mysql_mod_openopc_MAX_HUMIDITY,$mysql_mod_openopc_WORKING_HUMIDITY);
				$mysql_mod_openopc_MIN_HUMIDITY = core_min_max_finder("min","NULLVAR",$mysql_mod_openopc_MIN_PRESSURE,$mysql_mod_openopc_WORKING_PRESSURE);
				$mysql_mod_openopc_MAX_HUMIDITY = core_min_max_finder("max","NULLVAR",$mysql_mod_openopc_MAX_PRESSURE,$mysql_mod_openopc_WORKING_PRESSURE);
		
				/* CRUNCH DATA FOR AVERAGES */
				$mysql_mod_openopc_records_examined = $mysql_mod_openopc_records_examined + 1;
				$mysql_mod_openopc_AVERAGE_TEMPERATURE = $mysql_mod_openopc_AVERAGE_TEMPERATURE + $mysql_mod_openopc_WORKING_TEMPERATURE;
				$mysql_mod_openopc_AVERAGE_HUMIDITY = $mysql_mod_openopc_AVERAGE_HUMIDITY + $mysql_mod_openopc_WORKING_HUMIDITY;
				$mysql_mod_openopc_AVERAGE_PRESSURE = $mysql_mod_openopc_AVERAGE_PRESSURE + $mysql_mod_openopc_WORKING_PRESSURE;
	
				/* DATA FOR POST ANALYSIS */
				$recycle_array_TEMPERATURE[$mysql_mod_openopc_records_examined] = $mysql_mod_openopc_WORKING_TEMPERATURE;
				$recycle_array_HUMIDITY[$mysql_mod_openopc_records_examined] = $mysql_mod_openopc_WORKING_HUMIDITY;
				$recycle_array_PRESSURE[$mysql_mod_openopc_records_examined] = $mysql_mod_openopc_WORKING_PRESSURE;

			/* POST A RECORD EVERY X ROWS */
			if ( $mysql_query_index == 1 ) { 
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];

				/* HORIZONTAL BAR INDICATOR FOR TEMPERATURE HUMIDITY AND PRESSURE */
				$mysql_mod_openopc_WORKING_TEMPERATURE_BAR = core_display_horizontal_bar("270",$mysql_mod_openopc_WORKING_TEMPERATURE,$ATMOSPHERICMODEL_TEMPERATURE_LOW,$ATMOSPHERICMODEL_TEMPERATURE_HIGH);
				$mysql_mod_openopc_WORKING_HUMIDITY_BAR = core_display_horizontal_bar("135",$mysql_mod_openopc_WORKING_HUMIDITY,$ATMOSPHERICMODEL_HUMIDITY_LOW,$ATMOSPHERICMODEL_HUMIDITY_HIGH);
				$mysql_mod_openopc_WORKING_PRESSURE_BAR = core_display_horizontal_bar("135",$mysql_mod_openopc_WORKING_PRESSURE,$ATMOSPHERICMODEL_PRESSURE_LOW,$ATMOSPHERICMODEL_PRESSURE_HIGH);

				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* BUILD CSV FOR EXPORT */
				model_ATMOSPHERIC_export_csv_report_0_build();

				/* BUILD THE ACTUAL ROW TO POST AND ADD TO THE RECORDENTRY (BODY) */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_TEMPERATURE."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_HUMIDITY."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_HUMIDITY_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PRESSURE."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_PRESSURE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";
			} else {	
				/* pass */
			}

			if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
				$mysql_query_index = 1;
			} else {
				$mysql_query_index =  $mysql_query_index + 1;
			}
	
		}

		/* FINALIZE AVERAGES*/
		$mysql_mod_openopc_AVERAGE_TEMPERATURE = varcharTOnumeric2(($mysql_mod_openopc_AVERAGE_TEMPERATURE / $mysql_mod_openopc_records_examined), 2);
		$mysql_mod_openopc_AVERAGE_HUMIDITY = varcharTOnumeric2(($mysql_mod_openopc_AVERAGE_HUMIDITY / $mysql_mod_openopc_records_examined), 2);
		$mysql_mod_openopc_AVERAGE_PRESSURE = varcharTOnumeric2(($mysql_mod_openopc_AVERAGE_PRESSURE / $mysql_mod_openopc_records_examined), 2);

		/* POST ANALYSIS */
		/* ------------- */
		/* -- TEMPERATURE */
		$post_BAR_GRAPH_TITLE = $multilang_ATMOSPHERICMODEL_5;
		$post_BAR_GRAPH_HEIGHT = 150;
		$post_RECORDS_EXAMINED = $mysql_mod_openopc_records_examined;
		$recycle_array_ITEM = &$recycle_array_TEMPERATURE;
		$post_TARGET_TO_MEASURE_DEVIATION_FROM = $mysql_mod_openopc_AVERAGE_TEMPERATURE;
		list($apache_REPORT_STDEV_PLOT_TEMPERATURE,$apache_REPORT_STDEV_TEMPERATURE) = core_standard_deviation_determination_and_plot();
		/* -- HUMIDITY */
		$post_BAR_GRAPH_TITLE = $multilang_ATMOSPHERICMODEL_6;
		$post_BAR_GRAPH_HEIGHT = 150;
		$post_RECORDS_EXAMINED = $mysql_mod_openopc_records_examined;
		$recycle_array_ITEM = &$recycle_array_HUMIDITY;
		$post_TARGET_TO_MEASURE_DEVIATION_FROM = $mysql_mod_openopc_AVERAGE_HUMIDITY;
		list($apache_REPORT_STDEV_PLOT_HUMIDITY,$apache_REPORT_STDEV_HUMIDITY) = core_standard_deviation_determination_and_plot();
		/* -- PRESSURE */
		$post_BAR_GRAPH_TITLE = $multilang_ATMOSPHERICMODEL_7;
		$post_BAR_GRAPH_HEIGHT = 150;
		$post_RECORDS_EXAMINED = $mysql_mod_openopc_records_examined;
		$recycle_array_ITEM = &$recycle_array_PRESSURE;
		$post_TARGET_TO_MEASURE_DEVIATION_FROM = $mysql_mod_openopc_AVERAGE_PRESSURE;
		list($apache_REPORT_STDEV_PLOT_PRESSURE,$apache_REPORT_STDEV_PRESSURE) = core_standard_deviation_determination_and_plot();


		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='135'>
									</TD>
									<TD WIDTH='75' ALIGN='CENTER'>
									</TD>
									<TD WIDTH='270'>
									</TD>
									<TD WIDTH='75' ALIGN='CENTER'>
									</TD>
									<TD WIDTH='135'>
									</TD>
									<TD WIDTH='75' ALIGN='CENTER'>
									</TD>
									<TD WIDTH='135'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR CLASS='hmirowborder1_ALT'>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT'>
										<B>".$multilang_ATMOSPHERICMODEL_8."<BR></B>
										<B>".$multilang_ATMOSPHERICMODEL_9."<BR></B>
										<B>".$multilang_ATMOSPHERICMODEL_10."<BR></B>
										<B>".$multilang_ATMOSPHERICMODEL_11."<BR></B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='3' ALIGN='LEFT'>
										".$mysql_mod_openopc_AVERAGE_TEMPERATURE." [".$ATMOSPHERICMODEL_UM_TEMPERATURE."] -- (".$mysql_mod_openopc_MIN_TEMPERATURE." - ".$mysql_mod_openopc_MAX_TEMPERATURE.")<BR>
										".$mysql_mod_openopc_AVERAGE_HUMIDITY." [".$ATMOSPHERICMODEL_UM_HUMIDITY."] -- (".$mysql_mod_openopc_MIN_HUMIDITY." - ".$mysql_mod_openopc_MAX_HUMIDITY.")<BR>
										".$mysql_mod_openopc_AVERAGE_PRESSURE." [".$ATMOSPHERICMODEL_UM_PRESSURE."] -- (".$mysql_mod_openopc_MIN_PRESSURE." - ".$mysql_mod_openopc_MAX_PRESSURE.")<BR>
										".$mysql_mod_openopc_records_examined."<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7' ALIGN='CENTER'>
										".$apache_REPORT_STDEV_PLOT_TEMPERATURE."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7' ALIGN='CENTER'>
										".$apache_REPORT_STDEV_PLOT_HUMIDITY."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7' ALIGN='CENTER'>
										".$apache_REPORT_STDEV_PLOT_PRESSURE."
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_ATMOSPHERICMODEL_5." [".$ATMOSPHERICMODEL_TEMPERATURE_LOW." - ".$ATMOSPHERICMODEL_TEMPERATURE_HIGH." ".$ATMOSPHERICMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_ATMOSPHERICMODEL_6." [".$ATMOSPHERICMODEL_HUMIDITY_LOW." - ".$ATMOSPHERICMODEL_HUMIDITY_HIGH." ".$ATMOSPHERICMODEL_UM_HUMIDITY."]</U></B>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_ATMOSPHERICMODEL_7." [".$ATMOSPHERICMODEL_PRESSURE_LOW." - ".$ATMOSPHERICMODEL_PRESSURE_HIGH." ".$ATMOSPHERICMODEL_UM_PRESSURE."]</U></B>
									</TD>
								</TR>				
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TR>
								<TD COLSPAN='7'>
									".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_ATMOSPHERICMODEL_4,$ATMOSPHERICMODEL_FORMFILL_NAME)."
								</TD>
							</TR>
						</TABLE>
						";
		/* -- TACK ON THE IMAP IMAGE */
		$apache_REPORT_RECORDENTRY = model_ATMOSPHERIC_tack_on_imap($seer_TRAFFIC_COP_OPTION,$apache_REPORT_RECORDENTRY);
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE BODY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY;
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

/* HANDLE FAUTLS */
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_ATMOSPHERICMODEL_4,$ATMOSPHERICMODEL_FORMFILL_NAME);
	$apache_REPORT_RECORDENTRY = model_ATMOSPHERIC_tack_on_imap($seer_TRAFFIC_COP_OPTION,$apache_REPORT_RECORDENTRY);
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
