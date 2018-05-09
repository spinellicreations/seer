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
SPF MODEL HMI 0 BODY (INCLUDED TO ALL SPFMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 60;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */
referring_page_append_reqd_scada();
/*	-- key manipulation required for pages utilizing scada */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_1."</B><BR>
								<I>".$SPFMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "*";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (MACHINE_NAME LIKE '".$SPFMODEL_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, MACHINE_NAME ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query,($SPFMODEL_COUNT * 2));

/* BUILD THE SPF HMI BODY */
$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $SPFMODEL_COUNT_ADJUSTED ) {			
	$mysql_query_item_ID[$mysql_query_internal_index] = $multilang_STATIC_NO_DATA_AVAILABLE;
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

$mysql_query_master_index = 0;
$mysql_query_limit = $SPFMODEL_COUNT * 2;
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FIRST_PASS = "YES";
while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($mysql_query_master_index <= $mysql_query_limit) ) {
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
	$mysql_mod_openopc_WORKING_POWER = $mysql_mod_openopc_query_row['POWER'];
	$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM = $mysql_mod_openopc_query_row['BOWL_MOTOR_RPM'];
	$mysql_mod_openopc_WORKING_BASELINEPRESSURE = $mysql_mod_openopc_query_row['BASELINEPRESSURE'];
	$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO = $mysql_mod_openopc_query_row['CONCENTRATION_RATIO'];
	$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION = $mysql_mod_openopc_query_row['CONCENTRATION_VALVE_POSITION'];
	$mysql_mod_openopc_WORKING_PRESSURE_RAW = $mysql_mod_openopc_query_row['PRESSURE_RAW'];
	$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE = $mysql_mod_openopc_query_row['PRESSURE_PASTEURIZE'];
	$mysql_mod_openopc_WORKING_TEMPERATURE_INLET = $mysql_mod_openopc_query_row['TEMPERATURE_INLET'];
	$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE = $mysql_mod_openopc_query_row['TEMPERATURE_PASTEURIZE'];
	$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN = $mysql_mod_openopc_query_row['HRS_SINCE_CLEAN'];
	$mysql_mod_openopc_WORKING_CIP_STEP = $mysql_mod_openopc_query_row['CIP_STEP'];
	$mysql_mod_openopc_WORKING_CIP_TEMP = $mysql_mod_openopc_query_row['CIP_TEMP'];
	$mysql_mod_openopc_WORKING_CIP_FLOW = $mysql_mod_openopc_query_row['CIP_FLOW'];
	$mysql_mod_openopc_WORKING_CIP_WATER_TYPE = $mysql_mod_openopc_query_row['CIP_WATER_TYPE'];
	$mysql_mod_openopc_WORKING_CIP_WATER_USAGE = $mysql_mod_openopc_query_row['CIP_WATER_USAGE'];

	/* GENERATE BACKGROUND COLORS */
	$mysql_mod_openopc_WORKING_ALARM_BACKGROUND = alarm_highlight_check($mysql_mod_openopc_WORKING_ALARM);
	$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN_BACKGROUND = model_SPF_time_since_clean_highlight($mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN);

	/* CONVERT NUMERIC VALUES TO LITERAL VALUES */
	$mysql_mod_openopc_WORKING_MACHINE_TYPE_FRIENDLY = $SPFMODEL_MACHINE_TYPE[$mysql_mod_openopc_WORKING_MACHINE_TYPE];
	$mysql_mod_openopc_WORKING_STATE = $SPFMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
	$mysql_mod_openopc_WORKING_ALARM = $SPFMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM]; 
	$mysql_mod_openopc_WORKING_SOURCE = $SPFMODEL_SOURCE[$mysql_mod_openopc_WORKING_SOURCE];
	$mysql_mod_openopc_WORKING_DESTINATION1 = $SPFMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION1];
	$mysql_mod_openopc_WORKING_DESTINATION2 = $SPFMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION2];
	$mysql_mod_openopc_WORKING_CIP_STEP_FRIENDLY = $SPFMODEL_CIP_STEP[$mysql_mod_openopc_WORKING_CIP_STEP];
	$mysql_mod_openopc_WORKING_CIP_WATER_TYPE = $SPFMODEL_CIP_WATER_TYPE[$mysql_mod_openopc_WORKING_CIP_WATER_TYPE];

	/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
	$mysql_mod_openopc_WORKING_TURBIDITY_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_TURBIDITY,$SPFMODEL_RANGE_TURBIDITY_LOW,$SPFMODEL_RANGE_TURBIDITY_HIGH);
	$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_SOURCE_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
	$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_DESTINATION1_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
	$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_DESTINATION2_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
	$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_BASELINEPRESSURE,$SPFMODEL_RANGE_PRESSURE_LOW,$SPFMODEL_RANGE_PRESSURE_HIGH);
	$mysql_mod_openopc_WORKING_PRESSURE_RAW_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_PRESSURE_RAW,$SPFMODEL_RANGE_PRESSURE_LOW,$SPFMODEL_RANGE_PRESSURE_HIGH);
	$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE,$SPFMODEL_RANGE_PRESSURE_LOW,$SPFMODEL_RANGE_PRESSURE_HIGH);
	$mysql_mod_openopc_WORKING_TEMPERATURE_INLET_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_TEMPERATURE_INLET,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
	$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
	$mysql_mod_openopc_WORKING_CIP_TEMP_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_CIP_TEMP,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);
	$mysql_mod_openopc_WORKING_CIP_FLOW_BAR = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_CIP_FLOW,$SPFMODEL_RANGE_FLOW_LOW,$SPFMODEL_RANGE_FLOW_HIGH);
	
	/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH SPF SYSTEM */
	$mysql_query_internal_index = 0;			
	while ( $mysql_query_internal_index <= $SPFMODEL_COUNT_ADJUSTED ) {			
		if ( $mysql_mod_openopc_WORKING_MACHINE_NAME == $SPFMODEL_NAME[$mysql_query_internal_index] ) {
			if ( $mysql_query_item_ID[$mysql_query_internal_index] == $multilang_STATIC_NO_DATA_AVAILABLE ) {
				
				if ( $apache_REPORT_FIRST_PASS == "YES" ) {
					/* DATA FRESHTIME */
					$apache_REPORT_FRESHTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
					$apache_REPORT_FIRST_PASS = "NO";
				} else {
					/* pass */
				}

				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_oddOReven($mysql_query_internal_index);

				$apache_REPORT_mysql_query[$mysql_query_internal_index] = "
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_15.":<BR>
										".$multilang_SPFMODEL_16.": [".$mysql_mod_openopc_WORKING_MACHINE_TYPE."]
									</TD>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$mysql_mod_openopc_WORKING_MACHINE_NAME."</U></B><BR>
										<B><I>".$mysql_mod_openopc_WORKING_STATE."</I></B><BR>
										[".$mysql_mod_openopc_WORKING_MACHINE_TYPE_FRIENDLY."]
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' ".$mysql_mod_openopc_WORKING_ALARM_BACKGROUND.">
										".$multilang_SPFMODEL_17.": <BR><B><I>".$mysql_mod_openopc_WORKING_ALARM."</I></B>
									</TD>
									<TD CLASS='hmicellborder1' BGCOLOR='".$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN_BACKGROUND."' COLSPAN='2'>
										".$multilang_SPFMODEL_18.": <BR><B>".$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN."</B>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='3'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_33.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_POWER."</I> [".$SPFMODEL_UM_POWER_RATE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_27.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_SOURCE."</I>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>									
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_28.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_DESTINATION1."</I>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";

				/* MACHINE STATUS FOR SPECIFIC MACHINE TYPES */
				$SPFMODEL_CHECK_FOR_TYPE = $mysql_mod_openopc_WORKING_MACHINE_TYPE{0};
				if ( $SPFMODEL_CHECK_FOR_TYPE == '1' ) {
					/* ECHO STATUS BODY FOR TYPE - SEPARATOR */
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_36.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM."</I> [".$SPFMODEL_UM_ROTATIONAL_SPEED."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_29.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_DESTINATION2."</I>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_30.": ".$mysql_mod_openopc_WORKING_SOURCE_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_31.": ".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_32.": ".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '2' ) {
					/* ECHO STATUS BODY FOR TYPE - CLARIFIER */
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_36.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_BOWL_MOTOR_RPM."</I> [".$SPFMODEL_UM_ROTATIONAL_SPEED."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_29.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_DESTINATION2."</I>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_30.": ".$mysql_mod_openopc_WORKING_SOURCE_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_31.": ".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_32.": ".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '3' ) {
					/* ECHO STATUS BODY FOR TYPE - UF SYSTEM */
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_29.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_DESTINATION2."</I>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_30.": ".$mysql_mod_openopc_WORKING_SOURCE_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_31.": ".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_32.": ".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_41.": ".$mysql_mod_openopc_WORKING_BASELINEPRESSURE." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_LOW." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_HIGH." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_42." - 
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_43." - 
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO." 
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '4' ) {
					/* ECHO STATUS BODY FOR TYPE - RO SYSTEM */
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='5'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_29.":
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<I>".$mysql_mod_openopc_WORKING_DESTINATION2."</I>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_30.": ".$mysql_mod_openopc_WORKING_SOURCE_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_31.": ".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_32.": ".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION2_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_41.": ".$mysql_mod_openopc_WORKING_BASELINEPRESSURE." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_LOW." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_BASELINEPRESSURE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_HIGH." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_42." - 
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_VALVE_POSITION." [%]
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_43." - 
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_CONCENTRATION_RATIO." / 100
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				if ( $SPFMODEL_CHECK_FOR_TYPE == '5' ) {
					/* ECHO STATUS BODY FOR TYPE - HTST PASTEURIZER */
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_30.": ".$mysql_mod_openopc_WORKING_SOURCE_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_SOURCE_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_31.": ".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_DESTINATION1_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_37.": ".$mysql_mod_openopc_WORKING_TEMPERATURE_INLET." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TEMPERATURE_LOW." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_INLET_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TEMPERATURE_HIGH." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_38.": ".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TEMPERATURE_LOW." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TEMPERATURE_PASTEURIZE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TEMPERATURE_HIGH." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_39.": ".$mysql_mod_openopc_WORKING_PRESSURE_RAW." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_LOW." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_PRESSURE_RAW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_HIGH." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_40.": ".$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_LOW." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_PRESSURE_PASTEURIZE_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_PRESSURE_HIGH." [".$SPFMODEL_UM_PRESSURE."]
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}

				/* TURBIDITY INFO FOR EQUIPPED MACHINES */
				if ( $SPFMODEL_TURBIDITY_SENSOR_PRESENT[$mysql_query_internal_index] == 'YES' ) {
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_34.": ".$mysql_mod_openopc_WORKING_TURBIDITY." [".$SPFMODEL_UM_TURBIDITY."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TURBIDITY_LOW." [".$SPFMODEL_UM_TURBIDITY."]
									</TD>
									<TD CLASS='hmicellborder2full' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_TURBIDITY_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TURBIDITY_HIGH." [".$SPFMODEL_UM_TURBIDITY."]
									</TD>
								</TR>
								";
					if ( $SPFMODEL_UTILIZE_TURBIDITY_CONTROLS == 'YES' ) {
						/* ECHO THE TURBIDITY ALARM ACKNOWLEDGE BUTTON */
						$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_35." - 
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER' VALIGN='MIDDLE'>
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO."&seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$SPFMODEL_PLC_LEAF_TURBIDITY_ACKNOWLEDGE[$mysql_query_internal_index]."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$SPFMODEL_PLC_LEAF_VALUE_TO_ACKNOWLEDGE_TURBIDITY_ALARM."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$SPFMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/small_clicky_blue_2.png'>
										</FORM>
									</TD>
									<TD>
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

				/* CIP STATUS FOR SELF CLEANING MACHINES */
				$SPFMODEL_CIP_CHECK_FOR_SELFCLEAN = $mysql_mod_openopc_WORKING_MACHINE_TYPE[strlen($mysql_mod_openopc_WORKING_MACHINE_TYPE)-1];
				/* ECHO A SPACER FOR ALL */
				$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
				if ( $SPFMODEL_CIP_CHECK_FOR_SELFCLEAN == '1' ) {
					/* ECHO THE CIP FOOTER */
					/* -- for self-cleaning machines */
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_19."
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' BGCOLOR='#FFFFFF'>
										".$multilang_SPFMODEL_20.": <B>[ ".$mysql_mod_openopc_WORKING_CIP_STEP." ]</B><BR><B><I>".$mysql_mod_openopc_WORKING_CIP_STEP_FRIENDLY."</I></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' BGCOLOR='#FFFFFF'>
										".$multilang_SPFMODEL_21.":<BR><B><I>".$mysql_mod_openopc_WORKING_CIP_WATER_TYPE."</I></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='2' BGCOLOR='#FFFFFF'>
										".$multilang_SPFMODEL_22.":<BR><B><I>".$mysql_mod_openopc_WORKING_CIP_WATER_USAGE."</I></B> [".$SPFMODEL_UM_WATER."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_23.": ".$mysql_mod_openopc_WORKING_CIP_TEMP." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TEMPERATURE_LOW." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_CIP_TEMP_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_TEMPERATURE_HIGH." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_24.": ".$mysql_mod_openopc_WORKING_CIP_FLOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_LOW." [".$SPFMODEL_UM_FLOW."]
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$mysql_mod_openopc_WORKING_CIP_FLOW_BAR." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE'>
										".$SPFMODEL_RANGE_FLOW_HIGH." [".$SPFMODEL_UM_FLOW."]
									</TD>
								</TR>
								";
				} else {
					/* ECHO THE 'PLEASE REFER TO [whichever machine] FOR CIP INFO' FOOTER */
					/* -- for machines cleaned by other machines or by CIP systems */
					$SPFMODEL_CLEANING_INFO_REDIRECT = $SPFMODEL_CIP_BY[$mysql_query_internal_index];
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_SPFMODEL_25."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='LEFT' VALIGN='MIDDLE' COLSPAN='7'>
										<I>".$multilang_SPFMODEL_26."</I><BR>
										-- <B>[ ".$SPFMODEL_CLEANING_INFO_REDIRECT." ]</B>
									</TD>
								</TR>
								";
				}
			
				/* ADD A DIVIDER BETWEEN MACHINES */
				$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
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
while ( $mysql_query_internal_index <= $SPFMODEL_COUNT_ADJUSTED ) {	
	if ( $mysql_query_item_ID[$mysql_query_internal_index] != $multilang_STATIC_NO_DATA_AVAILABLE ) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_mysql_query[$mysql_query_internal_index];
	} else {
		$apache_ERROR_MESSAGE_TO_POST = core_indicate_null_return_values_for_items($SPFMODEL_NAME[$mysql_query_internal_index],$multilang_STATIC_NO_DATA_AVAILABLE);
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										".$apache_ERROR_MESSAGE_TO_POST."
										<BR>
									</TD>
								</TR>
								";
	}
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($apache_REPORT_FRESHTIME,"SNAPSHOT");
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
