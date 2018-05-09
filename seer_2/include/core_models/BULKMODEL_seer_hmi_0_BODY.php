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
BULK MODEL HMI 0 BODY (INCLUDED TO ALL BULKMODELS)
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
								<B>".$multilang_BULKMODEL_0.": ".$multilang_BULKMODEL_4."</B><BR>
								<I>".$BULKMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */

/* SCAN BULK DATA FROM DATABASE */
$mysql_mod_openopc_query = "*";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$BULKMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (BULKNAME LIKE '".$BULKMODEL_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, BULKNAME ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

/* BUILD THE BULK HMI BODY */
$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $BULKMODEL_COUNT_ADJUSTED ) {			
	$mysql_query_item_ID[$mysql_query_internal_index] = $multilang_BULKMODEL_5;
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

$mysql_query_master_index = 0;
$mysql_query_limit = $BULKMODEL_COUNT * 2;
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FIRST_PASS = "YES";
while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($mysql_query_master_index <= $mysql_query_limit) ) {
	$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	$mysql_mod_openopc_WORKING_BULKNAME = $mysql_mod_openopc_query_row['BULKNAME'];
	$mysql_mod_openopc_WORKING_INVENTORY_PERCENT = $mysql_mod_openopc_query_row['INVENTORY_PERCENT'];
	$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY = $mysql_mod_openopc_query_row['INVENTORY_QUANTITY'];
	
	/* INVENTORY ALERT HIGHLIGHTS */
	$BULKMODEL_WORKING_FILL_BACKGROUND = model_BULK_highlight_inventory_level($mysql_mod_openopc_WORKING_INVENTORY_PERCENT);

	/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
	/* 	-- STOCK INVENTORY IN PERCENT */
	$BULKMODEL_WORKING_BAR_INVENTORY_PERCENT = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_INVENTORY_PERCENT,"0","100");
	
	/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH BULK SYSTEM */
	$mysql_query_internal_index = 0;			
	while ( $mysql_query_internal_index <= $BULKMODEL_COUNT_ADJUSTED ) {			
		if ( $mysql_mod_openopc_WORKING_BULKNAME == $BULKMODEL_NAME[$mysql_query_internal_index] ) {
			if ( $mysql_query_item_ID[$mysql_query_internal_index] == $multilang_BULKMODEL_5 ) {

				/* REPORT FRESHTIME */				
				if ( $apache_REPORT_FIRST_PASS == "YES" ) {
					$apache_REPORT_FRESHTIME = $mysql_mod_openopc_WORKING_DATESTAMP;
					$apache_REPORT_FIRST_PASS = "NO";
				} else {
					/* pass */
				}

				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_oddOReven($mysql_query_internal_index);
				$apache_REPORT_mysql_query[$mysql_query_internal_index] = "
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$multilang_BULKMODEL_8.": 
									</TD>
									<TD COLSPAN='4' CLASS='hmicellborder1_ALT'>
										<B><U>".$mysql_mod_openopc_WORKING_BULKNAME."</U></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='4' ".$BULKMODEL_WORKING_FILL_BACKGROUND.">
										".$multilang_BULKMODEL_9.":<BR><B><I>".$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY."</I> [".$BULKMODEL_UM_THISMODEL."]</B>
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
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_BULKMODEL_10." [%]: <B>".$mysql_mod_openopc_WORKING_INVENTORY_PERCENT."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										0 %
									</TD>
									<TD CLASS='hmicellborder4' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$BULKMODEL_WORKING_BAR_INVENTORY_PERCENT." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										100 %
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
while ( $mysql_query_internal_index <= $BULKMODEL_COUNT_ADJUSTED ) {	
	if ( $mysql_query_item_ID[$mysql_query_internal_index] != $multilang_BULKMODEL_5 ) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_mysql_query[$mysql_query_internal_index];
	} else {
		$apache_ERROR_MESSAGE_TO_POST = core_indicate_null_return_values_for_items($BULKMODEL_NAME[$mysql_query_internal_index],$multilang_STATIC_NO_DATA_AVAILABLE);
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
