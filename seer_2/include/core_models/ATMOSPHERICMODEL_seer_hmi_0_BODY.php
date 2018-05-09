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
ATMOSPHERIC MODEL HMI 0 BODY (INCLUDED TO ALL ATMOSPHERICMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 60;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_ATMOSPHERICMODEL_0.": ".$multilang_ATMOSPHERICMODEL_1."</B><BR>
								<I>".$ATMOSPHERICMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM = apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM_GENERATE($ATMOSPHERICMODEL_DEPT_MONITOR_SNAPSHOT_TIME_MINUTES);
$mysql_mod_openopc_query = "*";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$ATMOSPHERICMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM."%') AND (MACHINENAME LIKE '".$ATMOSPHERICMODEL_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, MACHINENAME ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

/* BUILD THE HMI BODY */
$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $ATMOSPHERICMODEL_COUNT_ADJUSTED ) {			
	$mysql_query_item_ID[$mysql_query_internal_index] = $multilang_STATIC_NO_DATA_AVAILABLE;
	$mysql_query_item_AVERAGE_TEMPERATURE[$mysql_query_internal_index] = 0;
	$mysql_query_item_AVERAGE_HUMIDITY[$mysql_query_internal_index] = 0;
	$mysql_query_item_AVERAGE_PRESSURE[$mysql_query_internal_index] = 0;
	$mysql_query_item_NOW_TEMPERATURE[$mysql_query_internal_index] = 0;
	$mysql_query_item_NOW_HUMIDITY[$mysql_query_internal_index] = 0;
	$mysql_query_item_NOW_PRESSURE[$mysql_query_internal_index] = 0;
	$mysql_query_item_NOW_DATESTAMP[$mysql_query_internal_index] = 0;
	$mysql_query_item_records_examined[$mysql_query_internal_index] = 0;
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

$mysql_query_master_index = 0;
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FIRST_PASS = "YES";
while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
	$mysql_mod_openopc_WORKING_MACHINENAME = $mysql_mod_openopc_query_row['MACHINENAME'];
	$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	$mysql_mod_openopc_WORKING_TEMPERATURE = $mysql_mod_openopc_query_row['TEMPERATURE'];
	$mysql_mod_openopc_WORKING_HUMIDITY = $mysql_mod_openopc_query_row['HUMIDITY'];
	$mysql_mod_openopc_WORKING_PRESSURE = $mysql_mod_openopc_query_row['PRESSURE'];

	/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH ZONE DISPLAYED */
	$mysql_query_internal_index = 0;			
	while ( $mysql_query_internal_index <= $ATMOSPHERICMODEL_COUNT_ADJUSTED ) {	
		
		if ( $mysql_mod_openopc_WORKING_MACHINENAME == $ATMOSPHERICMODEL_NAME[$mysql_query_internal_index] ) {
			$mysql_query_item_records_examined[$mysql_query_internal_index] = $mysql_query_item_records_examined[$mysql_query_internal_index] + 1;
			$mysql_query_item_AVERAGE_TEMPERATURE[$mysql_query_internal_index] = $mysql_query_item_AVERAGE_TEMPERATURE[$mysql_query_internal_index] + $mysql_mod_openopc_WORKING_TEMPERATURE;
			$mysql_query_item_AVERAGE_HUMIDITY[$mysql_query_internal_index] = $mysql_query_item_AVERAGE_HUMIDITY[$mysql_query_internal_index] + $mysql_mod_openopc_WORKING_HUMIDITY;
			$mysql_query_item_AVERAGE_PRESSURE[$mysql_query_internal_index] = $mysql_query_item_AVERAGE_PRESSURE[$mysql_query_internal_index] + $mysql_mod_openopc_WORKING_PRESSURE;

			if ( $mysql_query_item_ID[$mysql_query_internal_index] == $multilang_STATIC_NO_DATA_AVAILABLE ) {
				$mysql_query_item_NOW_DATESTAMP[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_DATESTAMP;
				$mysql_query_item_NOW_TEMPERATURE[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_TEMPERATURE;
				$mysql_query_item_NOW_HUMIDITY[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_HUMIDITY;
				$mysql_query_item_NOW_PRESSURE[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_PRESSURE;

				/* HORIZONTAL BAR INDICATOR FOR TEMPERATURE HUMIDITY AND PRESSURE */
				$mysql_mod_openopc_NOW_TEMPERATURE_BAR[$mysql_query_internal_index] = core_display_horizontal_bar("300",$mysql_query_item_NOW_TEMPERATURE[$mysql_query_internal_index],$ATMOSPHERICMODEL_TEMPERATURE_LOW,$ATMOSPHERICMODEL_TEMPERATURE_HIGH);
				$mysql_mod_openopc_NOW_HUMIDITY_BAR[$mysql_query_internal_index] = core_display_horizontal_bar("300",$mysql_query_item_NOW_HUMIDITY[$mysql_query_internal_index],$ATMOSPHERICMODEL_HUMIDITY_LOW,$ATMOSPHERICMODEL_HUMIDITY_HIGH);
				$mysql_mod_openopc_NOW_PRESSURE_BAR[$mysql_query_internal_index] = core_display_horizontal_bar("300",$mysql_query_item_NOW_PRESSURE[$mysql_query_internal_index],$ATMOSPHERICMODEL_PRESSURE_LOW,$ATMOSPHERICMODEL_PRESSURE_HIGH);

				/* REPORT FRESHTIME */
				if ( $apache_REPORT_FIRST_PASS == "YES" ) {
					$apache_REPORT_FRESHTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
					$apache_REPORT_FIRST_PASS = "NO";
				} else {
					/* pass */
				}

				$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index] = core_row_color_oddOReven($mysql_query_internal_index);
				$mysql_query_item_ID[$mysql_query_internal_index] = "DONE";
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}
	$mysql_query_master_index = $mysql_query_master_index + 1;
}

$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $ATMOSPHERICMODEL_COUNT_ADJUSTED ) {	
	if ( $mysql_query_item_ID[$mysql_query_internal_index] != $multilang_STATIC_NO_DATA_AVAILABLE ) {
		/* CRUNCH THE NUMBERS FOR THE AVERAGES */
		$mysql_query_item_AVERAGE_TEMPERATURE[$mysql_query_internal_index] = varcharTOnumeric2(($mysql_query_item_AVERAGE_TEMPERATURE[$mysql_query_internal_index] / $mysql_query_item_records_examined[$mysql_query_internal_index]), 2);
		$mysql_query_item_AVERAGE_HUMIDITY[$mysql_query_internal_index] = varcharTOnumeric2(($mysql_query_item_AVERAGE_HUMIDITY[$mysql_query_internal_index] / $mysql_query_item_records_examined[$mysql_query_internal_index]), 2);
		$mysql_query_item_AVERAGE_PRESSURE[$mysql_query_internal_index] = varcharTOnumeric2(($mysql_query_item_AVERAGE_PRESSURE[$mysql_query_internal_index] / $mysql_query_item_records_examined[$mysql_query_internal_index]), 2);
		/* ADD TO REPORT BODY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$ATMOSPHERICMODEL_NAME[$mysql_query_internal_index]."</U></B>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_ATMOSPHERICMODEL_8."</U></B><BR>
										<B>[".$ATMOSPHERICMODEL_UM_TEMPERATURE."]</B>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_ATMOSPHERICMODEL_9."</U></B><BR>
										<B>[".$ATMOSPHERICMODEL_UM_HUMIDITY."]</B>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_ATMOSPHERICMODEL_10."</U></B><BR>
										<B>[".$ATMOSPHERICMODEL_UM_PRESSURE."]</B>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD COLSPAN='3' ALIGN='CENTER'>
										".$mysql_query_item_NOW_DATESTAMP[$mysql_query_internal_index]."<BR>
										".$multilang_ATMOSPHERICMODEL_11.": ".$mysql_query_item_records_examined[$mysql_query_internal_index]."
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><I>".$mysql_query_item_AVERAGE_TEMPERATURE[$mysql_query_internal_index]."</B></I>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><I>".$mysql_query_item_AVERAGE_HUMIDITY[$mysql_query_internal_index]."</B></I>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><I>".$mysql_query_item_AVERAGE_PRESSURE[$mysql_query_internal_index]."</B></I>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD ALIGN='CENTER' COLSPAN='2'>
										".$multilang_ATMOSPHERICMODEL_12.":
									</TD>
									<TD ALIGN='LEFT' COLSPAN='2'>
										<B>".$mysql_query_item_NOW_TEMPERATURE[$mysql_query_internal_index]."</B> [".$ATMOSPHERICMODEL_UM_TEMPERATURE."]	
									</TD>
									<TD ALIGN='RIGHT'>
										".$ATMOSPHERICMODEL_TEMPERATURE_LOW."
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='3' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_NOW_TEMPERATURE_BAR[$mysql_query_internal_index]." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$ATMOSPHERICMODEL_TEMPERATURE_HIGH."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD ALIGN='CENTER' COLSPAN='2'>
										".$multilang_ATMOSPHERICMODEL_13.":
									</TD>
									<TD ALIGN='LEFT' COLSPAN='2'>
										<B>".$mysql_query_item_NOW_HUMIDITY[$mysql_query_internal_index]."</B> [".$ATMOSPHERICMODEL_UM_HUMIDITY."]	
									</TD>
									<TD ALIGN='RIGHT'>
										".$ATMOSPHERICMODEL_HUMIDITY_LOW."
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='3' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_yellow.png' WIDTH=".$mysql_mod_openopc_NOW_HUMIDITY_BAR[$mysql_query_internal_index]." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$ATMOSPHERICMODEL_HUMIDITY_HIGH."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD ALIGN='CENTER' COLSPAN='2'>
										".$multilang_ATMOSPHERICMODEL_14.":
									</TD>
									<TD ALIGN='LEFT' COLSPAN='2'>
										<B>".$mysql_query_item_NOW_PRESSURE[$mysql_query_internal_index]."</B> [".$ATMOSPHERICMODEL_UM_PRESSURE."]	
									</TD>
									<TD ALIGN='RIGHT'>
										".$ATMOSPHERICMODEL_PRESSURE_LOW."
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='3' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH=".$mysql_mod_openopc_NOW_PRESSURE_BAR[$mysql_query_internal_index]." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$ATMOSPHERICMODEL_PRESSURE_HIGH."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE[$mysql_query_internal_index].">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'>
									</TD>
								</TR>
								";
	} else {
		$apache_ERROR_MESSAGE_TO_POST = core_indicate_null_return_values_for_items($ATMOSPHERICMODEL_NAME[$mysql_query_internal_index],$multilang_STATIC_NO_DATA_AVAILABLE);
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										".$apache_ERROR_MESSAGE_TO_POST."
									</TD>
								</TR>
								";
	}
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($apache_REPORT_FRESHTIME,"WINDOW",$multilang_ATMOSPHERICMODEL_16,$ATMOSPHERICMODEL_DEPT_MONITOR_SNAPSHOT_TIME_MINUTES);
$apache_REPORT_RECORDENTRY = $apache_REPORT_TOPPLATE."
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								".$apache_REPORT_RECORDENTRY."
								";
/* -- IMAGE MAP IF REQUESTED */
if ( $seer_ATMOSPHERICMODEL_ENABLE_IMAP[$seer_TRAFFIC_COP_OPTION] == "YES" ) {
	/* display image map of zone location */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9' ALIGN='CENTER' VALIGN='MIDDLE'>
										<P VALIGN='CENTER'>
											<IMG SRC='./config/ATMOSPHERICMODEL/localoptions_ATMOSPHERICMODEL_".$seer_TRAFFIC_COP_OPTION."_IMAP.png' ALT='IMAP'>
										</P>
									</TD>
								</TR>
								";
} else {
	/* pass */
}
/* -- CLOSE OUT TABLE */
$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";

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
