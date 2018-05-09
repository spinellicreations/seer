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
THINCHART HMI 0 BODY (INCLUDED TO ALL THINCHARTS)
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
								<B>".$multilang_THINCHART_0.": ".$multilang_THINCHART_1."</B><BR>
								<I>".$THINCHART_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* PEN COLOR DETERMINATION */
/* ------------------------------------------------------------------ */
if ($THINCHART_PEN1_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN1_COLOR = $THINCHART_ADVANCED_OP_PEN1_COLOR;
} else {
	$THINCHART_UTILIZED_PEN1_COLOR = $THINCHART_PEN1_COLOR;
}
if ($THINCHART_PEN2_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN2_COLOR = $THINCHART_ADVANCED_OP_PEN2_COLOR;
} else {
	$THINCHART_UTILIZED_PEN2_COLOR = $THINCHART_PEN2_COLOR;
}
if ($THINCHART_PEN3_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN3_COLOR = $THINCHART_ADVANCED_OP_PEN3_COLOR;
} else {
	$THINCHART_UTILIZED_PEN3_COLOR = $THINCHART_PEN3_COLOR;
}

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "*";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$THINCHART_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (CHARTNAME LIKE '".$THINCHART_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, CHARTNAME ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

/* BUILD THE HMI BODY */
$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $THINCHART_COUNT_ADJUSTED ) {			
	$mysql_query_item_ID[$mysql_query_internal_index] = "NO DATA AVAILABLE";
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

$mysql_query_master_index = 0;
$mysql_query_limit = $THINCHART_COUNT * 2;
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FIRST_PASS = "YES";
while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($mysql_query_master_index <= $mysql_query_limit) ) {
	$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	$mysql_mod_openopc_WORKING_CHARTNAME = $mysql_mod_openopc_query_row['CHARTNAME'];
	$mysql_mod_openopc_WORKING_PEN1 = $mysql_mod_openopc_query_row['PEN1'];
	$mysql_mod_openopc_WORKING_PEN2 = $mysql_mod_openopc_query_row['PEN2'];
	$mysql_mod_openopc_WORKING_PEN3 = $mysql_mod_openopc_query_row['PEN3'];
	$mysql_mod_openopc_WORKING_EVENT = $mysql_mod_openopc_query_row['EVENT'];
	$mysql_mod_openopc_WORKING_NOTIFICATION = $mysql_mod_openopc_query_row['NOTIFICATION'];
	if ($mysql_mod_openopc_WORKING_NOTIFICATION == '') {
		$mysql_mod_openopc_WORKING_NOTIFICATION = 0;
	} else {
		/* pass */
	}

	/* IDENTIFY CHART */
	$mysql_query_name_id = model_THINCHART_identify_chart($mysql_mod_openopc_WORKING_CHARTNAME);

	/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
	model_THINCHART_chart_parameters($mysql_query_name_id);
	if ($mysql_mod_openopc_WORKING_EVENT < 1) {
		$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_OFF;
	} else {
		$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_ON;
	}
	$mysql_mod_openopc_WORKING_NOTIFICATION = $THINCHART_NOTIFICATION[$mysql_mod_openopc_WORKING_NOTIFICATION];

	/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
	/* 	-- PEN1 */
	$THINCHART_WORKING_BAR_PEN1 = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_PEN1,$THINCHART_WORKING_PEN1_PENRANGE_LOW,$THINCHART_WORKING_PEN1_PENRANGE_HIGH);
	/* 	-- PEN2 */
	$THINCHART_WORKING_BAR_PEN2 = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_PEN2,$THINCHART_WORKING_PEN2_PENRANGE_LOW,$THINCHART_WORKING_PEN2_PENRANGE_HIGH);
	/* 	-- PEN3 */
	$THINCHART_WORKING_BAR_PEN3 = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_PEN3,$THINCHART_WORKING_PEN3_PENRANGE_LOW,$THINCHART_WORKING_PEN3_PENRANGE_HIGH);

	/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH CHART */
	$mysql_query_internal_index = 0;			
	while ( $mysql_query_internal_index <= $THINCHART_COUNT_ADJUSTED ) {			
		if ( $mysql_mod_openopc_WORKING_CHARTNAME == $THINCHART_NAME[$mysql_query_internal_index] ) {
			if ( $mysql_query_item_ID[$mysql_query_internal_index] == "NO DATA AVAILABLE" ) {
				
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
									<TD>
										".$multilang_CIPMODEL_36.": <BR>
										<BR>
									</TD>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$mysql_mod_openopc_WORKING_CHARTNAME."</U></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' ALIGN='CENTER' VALIGN='MIDDLE'>
										".$multilang_STATIC_NOTE.": <I><B>".$mysql_mod_openopc_WORKING_NOTIFICATION."</B></I><BR>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='2' ".$THINCHART_WORKING_EVENT_BGCOLOR.">
										<B>".$THINCHART_WORKING_EVENT_NAME."</B>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='3'>
										".$mysql_mod_openopc_WORKING_DATESTAMP."<BR>
									</TD>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$THINCHART_WORKING_PEN1_NAME." [".$THINCHART_WORKING_PEN1_UM."]: <B>".$mysql_mod_openopc_WORKING_PEN1."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$THINCHART_WORKING_PEN1_PENRANGE_LOW." ".$THINCHART_WORKING_PEN1_UM."
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN1_COLOR.".png' WIDTH=".$THINCHART_WORKING_BAR_PEN1." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$THINCHART_WORKING_PEN1_PENRANGE_HIGH." ".$THINCHART_WORKING_PEN1_UM."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$THINCHART_WORKING_PEN2_NAME." [".$THINCHART_WORKING_PEN2_UM."]: <B>".$mysql_mod_openopc_WORKING_PEN2."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$THINCHART_WORKING_PEN2_PENRANGE_LOW." ".$THINCHART_WORKING_PEN2_UM."
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN2_COLOR.".png' WIDTH=".$THINCHART_WORKING_BAR_PEN2." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$THINCHART_WORKING_PEN2_PENRANGE_HIGH." ".$THINCHART_WORKING_PEN2_UM."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$THINCHART_WORKING_PEN3_NAME." [".$THINCHART_WORKING_PEN3_UM."]: <B>".$mysql_mod_openopc_WORKING_PEN3."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$THINCHART_WORKING_PEN3_PENRANGE_LOW." ".$THINCHART_WORKING_PEN3_UM."
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN3_COLOR.".png' WIDTH=".$THINCHART_WORKING_BAR_PEN3." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$THINCHART_WORKING_PEN3_PENRANGE_HIGH." ".$THINCHART_WORKING_PEN3_UM."
									</TD>
								</TR>
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
while ( $mysql_query_internal_index <= $THINCHART_COUNT_ADJUSTED ) {	
	if ( $mysql_query_item_ID[$mysql_query_internal_index] != "NO DATA AVAILABLE" ) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_mysql_query[$mysql_query_internal_index];
	} else {
		$apache_ERROR_MESSAGE_TO_POST = core_indicate_null_return_values_for_items($THINCHART_NAME[$mysql_query_internal_index],$multilang_CIPMODEL_65);
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
