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
CIP MODEL HMI 0 BODY (INCLUDED TO ALL CIPMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 30;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */
referring_page_append_reqd_scada();
/*	-- key manipulation required for pages utilizing scada */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CIPMODEL_0.": ".$multilang_CIPMODEL_50."</B><BR>
								<I>".$CIPMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* STEP - HOLD CLEANING MENU */
/* ------------------------------------------------------------------ */
if ( $CIPMODEL_UTILIZE_STEP_CONTROLS == "YES" ) {
	$apache_REPORT_STEP_CONTROLS ="
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO."&seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='50'>					
										</TD>
										<TD WIDTH='100'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='6' ALIGN='CENTER'>
											<BR>
											<B>".$multilang_CIPMODEL_51."</B><BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD>
											<BR>
										</TD>
										<TD>
											<B><U>".$multilang_CIPMODEL_43."</B></U>
										</TD>
										<TD>
											<B><U>".$multilang_CIPMODEL_52."</B></U>
										</TD>
										<TD>
											<BR>						
										</TD>
										<TD>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD>
											<B><I>-- ".$multilang_CIPMODEL_53." --</I></B><BR>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_CIPMODEL_36.$CIPMODEL_FORMFILL_PLC_LEAF_FORCE_HOLD."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='radio'  name='mod_openopc_YOURLEAFERS' value='".$CIPMODEL_PLC_WRITE_FORCE_HOLD_VALUE."'><B><I>".$multilang_CIPMODEL_100."</I></B><BR>
											<INPUT TYPE='radio'  name='mod_openopc_YOURLEAFERS' value='".$CIPMODEL_PLC_WRITE_FORCE_HOLD_VALUE_RELEASE."'><B><I>".$multilang_CIPMODEL_102."</I></B><BR>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$CIPMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
										<TD>
											<BR>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO."&seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
											<BR>
										</TD>
										<TD WIDTH='200'>
											<B><I>-- ".$multilang_CIPMODEL_54." --</I></B><BR>
										</TD>
										<TD WIDTH='200'>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_CIPMODEL_36.$CIPMODEL_FORMFILL_PLC_LEAF_FORCE_STEP."</SELECT>
										</TD>
										<TD WIDTH='200'>
											<INPUT TYPE='radio'  name='mod_openopc_YOURLEAFERS' value='".$CIPMODEL_PLC_WRITE_FORCE_STEP_VALUE."'><B><I>".$multilang_CIPMODEL_103."</I></B><BR>
										</TD>
										<TD WIDTH='50'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$CIPMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
										<TD WIDTH='100'>
											<BR>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO."&seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
											<BR>
										</TD>
										<TD WIDTH='200'>
											<B><I>-- ".$multilang_CIPMODEL_55." --</I></B><BR>
											(".$multilang_CIPMODEL_56.")
										</TD>
										<TD WIDTH='200'>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_CIPMODEL_36.$CIPMODEL_FORMFILL_PLC_LEAF_DISABLE_MANUAL_HOLD_AND_STEP."</SELECT>
										</TD>
										<TD WIDTH='200'>
											<INPUT TYPE='radio'  name='mod_openopc_YOURLEAFERS' value='".$CIPMODEL_PLC_WRITE_DISABLE_MANUAL_HOLD_AND_STEP_VALUE."'><B><I>".$multilang_CIPMODEL_104."</I></B><BR>
											<INPUT TYPE='radio'  name='mod_openopc_YOURLEAFERS' value='".$CIPMODEL_PLC_WRITE_DISABLE_MANUAL_HOLD_AND_STEP_VALUE_RELEASE."'><B><I>".$multilang_CIPMODEL_105."</I></B><BR>
										</TD>
										<TD WIDTH='50'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$CIPMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
										<TD WIDTH='100'>
											<BR>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
} else {
	$apache_REPORT_STEP_CONTROLS = "";
}

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "*";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CIPMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (CIPNAME LIKE '".$CIPMODEL_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, CIPNAME ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query,($CIPMODEL_COUNT * 2));

/* BUILD THE CIP HMI BODY */
$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $CIPMODEL_COUNT_ADJUSTED ) {			
	$mysql_query_item_ID[$mysql_query_internal_index] = "NO DATA AVAILABLE";
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

$mysql_query_master_index = 0;
$mysql_query_limit = $CIPMODEL_COUNT * 2;
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FIRST_PASS = "YES";
while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($mysql_query_master_index <= $mysql_query_limit) ) {
	$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	$mysql_mod_openopc_WORKING_CIPNAME = $mysql_mod_openopc_query_row['CIPNAME'];
	$mysql_mod_openopc_WORKING_STATUS = $mysql_mod_openopc_query_row['STATUS'];
	$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED = $mysql_mod_openopc_query_row['LINE_BEING_CLEANED'];
	$mysql_mod_openopc_WORKING_STEP = $mysql_mod_openopc_query_row['STEP'];
	$mysql_mod_openopc_WORKING_SUPPLY_TEMP = round($mysql_mod_openopc_query_row['SUPPLY_TEMP'],2);
	$mysql_mod_openopc_WORKING_RETURN_TEMP = round($mysql_mod_openopc_query_row['RETURN_TEMP'],2);
	$mysql_mod_openopc_WORKING_SUPPLY_FLOW = round($mysql_mod_openopc_query_row['SUPPLY_FLOW'],2);
	$mysql_mod_openopc_WORKING_RETURN_CONDUCTIVITY = round($mysql_mod_openopc_query_row['RETURN_CONDUCTIVITY']);
	$mysql_mod_openopc_WORKING_WATER_USAGE = round($mysql_mod_openopc_query_row['WATER_USAGE']);
	$mysql_mod_openopc_WORKING_WATER_TYPE = $mysql_mod_openopc_query_row['WATER_TYPE'];
	
	/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
	$CIPMODEL_WORKING_STATUS = $CIPMODEL_STATUS[$mysql_mod_openopc_WORKING_STATUS];
	$CIPMODEL_WORKING_LINE_BEING_CLEANED = $CIPMODEL_LINE_BEING_CLEANED[$mysql_mod_openopc_WORKING_LINE_BEING_CLEANED];
	$CIPMODEL_WORKING_STEP = $CIPMODEL_STEP[$mysql_mod_openopc_WORKING_STEP];
	$CIPMODEL_WORKING_WATER_TYPE = $CIPMODEL_WATER_TYPE[$mysql_mod_openopc_WORKING_WATER_TYPE];

	/* HORIZONTAL BAR INDICATOR FOR ANALOG MESUREMENTS */
	/* 	-- SUPPLY_TEMP */
	$CIPMODEL_WORKING_BAR_SUPPLY_TEMP = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_SUPPLY_TEMP,$CIPMODEL_RANGE_TEMPERATURE_LOW,$CIPMODEL_RANGE_TEMPERATURE_HIGH);
	/* 	-- SUPPLY_FLOW */
	$CIPMODEL_WORKING_BAR_SUPPLY_FLOW = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_SUPPLY_FLOW,$CIPMODEL_RANGE_FLOW_LOW,$CIPMODEL_RANGE_FLOW_HIGH);
	/* 	-- RETURN_TEMP */
	$CIPMODEL_WORKING_BAR_RETURN_TEMP = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_RETURN_TEMP,$CIPMODEL_RANGE_TEMPERATURE_LOW,$CIPMODEL_RANGE_TEMPERATURE_HIGH);
	/* 	-- RETURN_CONDUCTIVITY */
	$CIPMODEL_WORKING_BAR_RETURN_CONDUCTIVITY = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_RETURN_CONDUCTIVITY,$CIPMODEL_RANGE_CONDUCTIVITY_LOW,$CIPMODEL_RANGE_CONDUCTIVITY_HIGH);

	/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH CIP SYSTEM */
	$mysql_query_internal_index = 0;			
	while ( $mysql_query_internal_index <= $CIPMODEL_COUNT_ADJUSTED ) {			
		if ( $mysql_mod_openopc_WORKING_CIPNAME == $CIPMODEL_NAME[$mysql_query_internal_index] ) {
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
										".$multilang_CIPMODEL_36.": 
									</TD>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$mysql_mod_openopc_WORKING_CIPNAME."</U></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' BGCOLOR='#FFFFFF'>
										".$multilang_CIPMODEL_63.":<BR><B><I>".$CIPMODEL_WORKING_STATUS."</I></B><BR>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='2' BGCOLOR='#FFFFFF'>
										".$multilang_CIPMODEL_25." # [<B>".$mysql_mod_openopc_WORKING_STEP."</B>]<BR><B>".$CIPMODEL_WORKING_STEP."</B>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='2' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD COLSPAN='6' VALIGN='MIDDLE'>
										<P CLASS='INFOREPORTMEDTEXT'>
										[".$multilang_CIPMODEL_59."]: <B><I>".$CIPMODEL_WORKING_LINE_BEING_CLEANED."</I></B>
										</P>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_CIPMODEL_60." [".$CIPMODEL_UM_TEMPERATURE."]: <B>".$mysql_mod_openopc_WORKING_SUPPLY_TEMP."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$CIPMODEL_RANGE_TEMPERATURE_LOW." ".$CIPMODEL_UM_TEMPERATURE."
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_SUPPLY_TEMP." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$CIPMODEL_RANGE_TEMPERATURE_HIGH." ".$CIPMODEL_UM_TEMPERATURE."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_CIPMODEL_61." [".$CIPMODEL_UM_FLOW."]: <B>".$mysql_mod_openopc_WORKING_SUPPLY_FLOW."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$CIPMODEL_RANGE_FLOW_LOW." ".$CIPMODEL_UM_FLOW."
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_yellow.png' WIDTH=".$CIPMODEL_WORKING_BAR_SUPPLY_FLOW." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$CIPMODEL_RANGE_FLOW_HIGH." ".$CIPMODEL_UM_FLOW."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_CIPMODEL_26." [".$CIPMODEL_UM_TEMPERATURE."]: <B>".$mysql_mod_openopc_WORKING_RETURN_TEMP."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$CIPMODEL_RANGE_TEMPERATURE_LOW." ".$CIPMODEL_UM_TEMPERATURE."
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$CIPMODEL_WORKING_BAR_RETURN_TEMP." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$CIPMODEL_RANGE_TEMPERATURE_HIGH." ".$CIPMODEL_UM_TEMPERATURE."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_CIPMODEL_62." [".$CIPMODEL_UM_CONDUCTIVITY."]: <B>".$mysql_mod_openopc_WORKING_RETURN_CONDUCTIVITY."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										".$CIPMODEL_RANGE_CONDUCTIVITY_LOW." ".$CIPMODEL_UM_CONDUCTIVITY."
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_blue.png' WIDTH=".$CIPMODEL_WORKING_BAR_RETURN_CONDUCTIVITY." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										".$CIPMODEL_RANGE_CONDUCTIVITY_HIGH." ".$CIPMODEL_UM_CONDUCTIVITY."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='4'>
										<BR>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' BGCOLOR='#FFFFFF'>
										".$multilang_CIPMODEL_37.":<BR><B><I>".$CIPMODEL_WORKING_WATER_TYPE."</I></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='2' BGCOLOR='#FFFFFF'>
										".$multilang_CIPMODEL_64.":<BR><B><I>".$mysql_mod_openopc_WORKING_WATER_USAGE."</I></B> [".$CIPMODEL_UM_WATER."]
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
while ( $mysql_query_internal_index <= $CIPMODEL_COUNT_ADJUSTED ) {	
	if ( $mysql_query_item_ID[$mysql_query_internal_index] != "NO DATA AVAILABLE" ) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_mysql_query[$mysql_query_internal_index];
	} else {
		$apache_ERROR_MESSAGE_TO_POST = core_indicate_null_return_values_for_items($CIPMODEL_NAME[$mysql_query_internal_index],$multilang_CIPMODEL_65);
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
$apache_REPORTL4 = $apache_REPORT_STEP_CONTROLS;
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
