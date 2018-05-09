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
TANK MODEL HMI 0 BODY (INCLUDED TO ALL TANKMODELS)
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
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_1."</B><BR>
								<I>".$TANKMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* LOCKDOWN CLEANING MENU */
/* ------------------------------------------------------------------ */
if ( $mysql_seer_access_ACCESSLEVEL <= 2 && $TANKMODEL_UTILIZE_LOCKDOWN_CLEANING == "YES" ) {
	$apache_REPORT_LOCKDOWNCLEANINGCONTROLS ="
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4' ALIGN='CENTER'>
											<BR>
											<B>".$multilang_TANKMODEL_12."</B><BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD>
											<B><U>".$multilang_TANKMODEL_13."</U></B>
										</TD>
										<TD>
											<B><U>".$multilang_TANKMODEL_14."</U></B>
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
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_15.$TANKMODEL_FORMFILL_PLC_LEAF_RELEASE_LOCKDOWN_CLEANING."</SELECT>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_TANKMODEL_16."...".$TANKMODEL_FORMFILL_RELEASE_LOCKDOWN_CLEANING_LOGIC."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
} else {
	$apache_REPORT_LOCKDOWNCLEANINGCONTROLS = "";
}

/* CONTROLS MENU */
/* ------------------------------------------------------------------ */
$apache_REPORT_LOWERCONTROLS = "
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4' ALIGN='CENTER'>
											<B>".$multilang_TANKMODEL_29."</B><BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD>
											<B><U>".$multilang_TANKMODEL_13."</U></B>
										</TD>
										<TD>
											<B><U>".$multilang_TANKMODEL_18."</U></B>
										</TD>
										<TD>
											<BR>						
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_TANKMODEL_19."
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_15.$TANKMODEL_FORMFILL_PLC_LEAF_DENSITY."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='text' size='10' maxlength='6' name='mod_openopc_YOURLEAFERS'>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_TANKMODEL_20."
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_15.$TANKMODEL_FORMFILL_PLC_LEAF_PRODUCT."</SELECT>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_TANKMODEL_20.$TANKMODEL_FORMFILL_PRODUCT."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
if ( $mysql_seer_access_ACCESSLEVEL <= 4 && $TANKMODEL_UTILIZE_AGITATOR_CONTROL == "YES" ) {
	$apache_REPORT_LOWERCONTROLS = $apache_REPORT_LOWERCONTROLS."
							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_TANKMODEL_21."
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_24.$TANKMODEL_FORMFILL_PLC_LEAF_AGITATOR_SPEED_ON_LEVEL."</SELECT>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_TANKMODEL_22." pct".$TANKMODEL_FORMFILL_AGITATOR_ON_LEVEL."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_TANKMODEL_23."
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_24.$TANKMODEL_FORMFILL_PLC_LEAF_AGITATOR_SPEED_OFF_LEVEL."</SELECT>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_TANKMODEL_22." pct".$TANKMODEL_FORMFILL_AGITATOR_OFF_LEVEL."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_TANKMODEL_25."
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_24.$TANKMODEL_FORMFILL_MEMBERS_AGITATOR_GROUP1."</SELECT>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_TANKMODEL_25.$TANKMODEL_FORMFILL_AGITATOR_STATE_GROUP1."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='650' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='50'>						
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_TANKMODEL_26."
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURPLC'><OPTION VALUE=''>".$multilang_TANKMODEL_27.$TANKMODEL_FORMFILL_PLC_LEAF_AGITATOR_PRESET_SPEED."</SELECT>
										</TD>
										<TD>
											<SELECT NAME='mod_openopc_YOURLEAFERS'><OPTION VALUE=''>".$multilang_TANKMODEL_28." pct".$TANKMODEL_FORMFILL_AGITATOR_SELECT_SPEED."</SELECT>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TANKMODEL_mod_openopc_WRITEDAEMON."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
} else {
	/* pass */
}

/* PULL IN DATA FOR AGITATOR PRESETS */
/* ------------------------------------------------------------------ */
if ( $TANKMODEL_UTILIZE_AGITATOR_CONTROL == "YES" ) {

	/* SCAN AGITATOR PRESETS FROM DATABASE */
	$mysql_mod_openopc_query = "SELECT * FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME_AGITATOR." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (PRESETNAME LIKE '".$TANKMODEL_AGITATOR_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, PRESETNAME ASC";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query,($CIPMODEL_COUNT * 2));
	/* BUILD THE AGITATION HMI BODY */
	$apache_REPORT_AGITATION_FIRSTSCAN = 0;
	$apache_REPORT_AGITATION_BODY = "";
	$mysql_query_limit = $TANKMODEL_AGITATOR_PRESET_SPEED_PRESET_COUNT;
	/* -- EDITED TO COUNT = COUNT FROM COUNT = 2x COUNT DUE TO ARRAY OVERRUN */
	/* $mysql_query_limit = $TANKMODEL_AGITATOR_PRESET_SPEED_PRESET_COUNT * 2; */
	while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
		if ( $apache_REPORT_AGITATION_FIRSTSCAN == 0 ) {
			$mysql_mod_openopc_AGITATOR_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
		} else {
			/* pass */
		}
		$mysql_mod_openopc_AGITATOR_WORKING_PRESETNAME = $mysql_mod_openopc_query_row['PRESETNAME'];
		$mysql_mod_openopc_AGITATOR_WORKING_HIGHSPEED = $mysql_mod_openopc_query_row['HIGHSPEED'];
		$mysql_mod_openopc_AGITATOR_WORKING_LOWSPEED = $mysql_mod_openopc_query_row['LOWSPEED'];
	
		$mysql_query_internal_index = 0;			
	
		while ( $mysql_query_internal_index <= $mysql_query_limit ) {
			
			if ( $mysql_mod_openopc_AGITATOR_WORKING_PRESETNAME == $TANKMODEL_AGITATOR_PRESET_NAME[$mysql_query_internal_index] ) {
				if ( $mysql_query_item_ID[$mysql_query_internal_index] != "DONE" ) {
					$apache_REPORT_AGITATION_BODY = $apache_REPORT_AGITATION_BODY."
								<TR>
									<TD>
										".$mysql_mod_openopc_AGITATOR_WORKING_PRESETNAME."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										".$mysql_mod_openopc_AGITATOR_WORKING_HIGHSPEED."
									</TD>
									<TD>
										".$mysql_mod_openopc_AGITATOR_WORKING_LOWSPEED."
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
		$apache_REPORT_AGITATION_FIRSTSCAN = $apache_REPORT_AGITATION_FIRSTSCAN + 1;
	}

	$apache_REPORT_AGITATION = "
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4' ALIGN='CENTER'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4' ALIGN='CENTER'>
										<B>".$multilang_TANKMODEL_30."</B><BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
										<B><I>".$multilang_TANKMODEL_31."... </I></B><BR>
										".$TANKMODEL_FRIENDLYNAME_AGITATOR_GROUP1."<BR>
										<BR>
									</TD>
									<TD COLSPAN='2'>
										<BR>
										<B><I>".$multilang_TANKMODEL_32."... </I></B><BR>
										".$mysql_mod_openopc_AGITATOR_DATESTAMP."<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_TANKMODEL_33."</U></B>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD>
										<B><U>".$multilang_TANKMODEL_34."</U></B>
									</TD>
									<TD>
										<B><U>".$multilang_TANKMODEL_35."</U></B>
									</TD>
								</TR>
								".$apache_REPORT_AGITATION_BODY."
							</TABLE>
							";
} else {
	$apache_REPORT_AGITATION = "";
}

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */

/* SCAN TANK DATA FROM DATABASE */
$mysql_mod_openopc_query = "DATESTAMP, SILONAME, STATE, SOURCE, DESTINATION, ALARM, PRODUCT, LEVEL_DENSITY, LEVEL_PERCENT, LEVEL_MASS, LEVEL_VOLUME, TEMPERATURE, TIME_SINCE_CLEAN, AGITATOR_MODE, AGITATOR_LEVEL_ON, AGITATOR_LEVEL_OFF, AGITATOR_SPEED";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (SILONAME LIKE '".$TANKMODEL_PRESET_PREFIX."%') ) ORDER BY DATESTAMP DESC, SILONAME ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query,($TANKMODEL_COUNT * 2));

/* BUILD THE TANK HMI BODY */
$mysql_query_internal_index = 0;
while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {			
	$mysql_query_item_ID[$mysql_query_internal_index] = $multilang_TANKMODEL_36;
	$mysql_query_internal_index = $mysql_query_internal_index + 1;
}

$mysql_query_master_index = 0;
$mysql_query_limit = $TANKMODEL_COUNT * 2;
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FIRST_PASS = "YES";
while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($mysql_query_master_index <= $mysql_query_limit) ) {
	$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	$mysql_mod_openopc_WORKING_SILONAME = $mysql_mod_openopc_query_row['SILONAME'];
	$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
	$mysql_mod_openopc_WORKING_SOURCE = $mysql_mod_openopc_query_row['SOURCE'];
	$mysql_mod_openopc_WORKING_DESTINATION = $mysql_mod_openopc_query_row['DESTINATION'];
	$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row['ALARM'];
	$mysql_mod_openopc_WORKING_PRODUCT = $mysql_mod_openopc_query_row['PRODUCT'];
	$mysql_mod_openopc_WORKING_LEVEL_DENSITY = $mysql_mod_openopc_query_row['LEVEL_DENSITY'];
	$mysql_mod_openopc_WORKING_LEVEL_PERCENT = round($mysql_mod_openopc_query_row['LEVEL_PERCENT']);
	$mysql_mod_openopc_WORKING_LEVEL_MASS = $mysql_mod_openopc_query_row['LEVEL_MASS'];
	$mysql_mod_openopc_WORKING_LEVEL_VOLUME = $mysql_mod_openopc_query_row['LEVEL_VOLUME'];
	$mysql_mod_openopc_WORKING_TEMPERATURE = round($mysql_mod_openopc_query_row['TEMPERATURE'],2);
	$mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN = $mysql_mod_openopc_query_row['TIME_SINCE_CLEAN'];
	$mysql_mod_openopc_WORKING_AGITATOR_MODE = $mysql_mod_openopc_query_row['AGITATOR_MODE'];
	$mysql_mod_openopc_WORKING_AGITATOR_LEVEL_ON = $mysql_mod_openopc_query_row['AGITATOR_LEVEL_ON'];
	$mysql_mod_openopc_WORKING_AGITATOR_LEVEL_OFF = $mysql_mod_openopc_query_row['AGITATOR_LEVEL_OFF'];
	$mysql_mod_openopc_WORKING_AGITATOR_SPEED = $mysql_mod_openopc_query_row['AGITATOR_SPEED'];
	
	/* HORIZONTAL BAR INDICATOR FOR LEVEL AND TEMPERATURE */
	$TANKMODEL_WORKING_BAR_FILL = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_LEVEL_PERCENT,"0","100");
	$TANKMODEL_WORKING_BAR_TEMPERATURE = core_display_horizontal_bar("400",$mysql_mod_openopc_WORKING_TEMPERATURE,$TANKMODEL_RANGE_TEMPERATURE_LOW,$TANKMODEL_RANGE_TEMPERATURE_HIGH);

	/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
	$TANKMODEL_WORKING_STATE = $TANKMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
	$TANKMODEL_WORKING_SOURCE = $TANKMODEL_SOURCE[$mysql_mod_openopc_WORKING_SOURCE];
	$TANKMODEL_WORKING_DESTINATION = $TANKMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION];
	$TANKMODEL_WORKING_ALARM = $TANKMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];
	$TANKMODEL_WORKING_ALARM_BACKGROUND = alarm_highlight_check($mysql_mod_openopc_WORKING_ALARM);
	$TANKMODEL_WORKING_PRODUCT = $TANKMODEL_PRODUCT[$mysql_mod_openopc_WORKING_PRODUCT];

	/* HANDLE FRIENDLY VALUE AGITATOR STATES FOR THE GROUPS */
	$TANKMODEL_WORKING_AGITATOR_MODE = model_TANK_agitator_state_value_to_friendly($mysql_mod_openopc_WORKING_AGITATOR_MODE);

	/* HANDLE FRIENDLY VALUE CIP TIME SINCE CLEAN */
	$TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = model_TANK_time_since_clean_highlight($mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN);

	/* CYCLE THROUGH THE DATABASE BUT BE SURE WE ONLY GET ONE SET OF DATA FOR EACH TANK OR SILO */
	$mysql_query_internal_index = 0;			
	while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {			
		if ( $mysql_mod_openopc_WORKING_SILONAME == $TANKMODEL_NAME[$mysql_query_internal_index] ) {
			if ( $mysql_query_item_ID[$mysql_query_internal_index] == $multilang_TANKMODEL_36 ) {
				
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
										".$multilang_TANKMODEL_40.": 
									</TD>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$mysql_mod_openopc_WORKING_SILONAME." -- ".$TANKMODEL_WORKING_STATE."</U></B>
									</TD>
									<TD CLASS='hmicellborder1' COLSPAN='3' ".$TANKMODEL_WORKING_ALARM_BACKGROUND.">
										".$multilang_TANKMODEL_41.": <B><I>".$TANKMODEL_WORKING_ALARM."</I></B>
									</TD>
									<TD CLASS='hmicellborder1' BGCOLOR='".$TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND."' COLSPAN='2'>
										".$multilang_TANKMODEL_42.": <B>".$mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN."</B>
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
										".$multilang_TANKMODEL_43.": <I>".$TANKMODEL_WORKING_SOURCE."</I>
									</TD>
									<TD COLSPAN='3'>
										".$multilang_TANKMODEL_44.": <I>".$TANKMODEL_WORKING_DESTINATION."</I>
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$multilang_TANKMODEL_20.": 
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										<I>".$TANKMODEL_WORKING_PRODUCT."</I>
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										".$multilang_TANKMODEL_19.": ".$mysql_mod_openopc_WORKING_LEVEL_DENSITY." ".$TANKMODEL_UM_DENSITY."
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										".$multilang_TANKMODEL_45.": ".$mysql_mod_openopc_WORKING_LEVEL_VOLUME." ".$TANKMODEL_UM_VOLUME."
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										".$multilang_TANKMODEL_46.": ".$mysql_mod_openopc_WORKING_LEVEL_MASS." ".$TANKMODEL_UM_MASS."
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_TANKMODEL_47." [%]: <B>".$mysql_mod_openopc_WORKING_LEVEL_PERCENT."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										0 %
									</TD>
									<TD CLASS='hmicellborder2top' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$TANKMODEL_WORKING_BAR_FILL." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										100 %
									</TD>
								</TR>
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' VALIGN='MIDDLE' COLSPAN='3'>
										".$multilang_TANKMODEL_48." [".$TANKMODEL_UM_TEMPERATURE."]: <B>".$mysql_mod_openopc_WORKING_TEMPERATURE."</B>
									</TD>
									<TD ALIGN='RIGHT'>
										 ".$TANKMODEL_RANGE_TEMPERATURE_LOW." ".$TANKMODEL_UM_TEMPERATURE." 
									</TD>
									<TD CLASS='hmicellborder2bottom' COLSPAN='4' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar_yellow.png' WIDTH=".$TANKMODEL_WORKING_BAR_TEMPERATURE." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='LEFT'>
										 ".$TANKMODEL_RANGE_TEMPERATURE_HIGH." ".$TANKMODEL_UM_TEMPERATURE." 
									</TD>
								</TR>
								";
			
				if ( $TANKMODEL_UTILIZE_AGITATOR_CONTROL == "YES" ) {
					$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD ALIGN='CENTER' COLSPAN='3'>
										".$multilang_TANKMODEL_28." [%]: ".$mysql_mod_openopc_WORKING_AGITATOR_SPEED."
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										".$multilang_TANKMODEL_25.": ".$TANKMODEL_WORKING_AGITATOR_MODE."
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										".$multilang_TANKMODEL_21." [%]: ".$mysql_mod_openopc_WORKING_AGITATOR_LEVEL_ON."
									</TD>
									<TD CLASS='hmicellborder9' COLSPAN='2'>
										".$multilang_TANKMODEL_23." [%]: ".$mysql_mod_openopc_WORKING_AGITATOR_LEVEL_OFF."
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}

				/* ADD A DIVIDER BETWEEN TANKS */
				$apache_REPORT_mysql_query[$mysql_query_internal_index] = $apache_REPORT_mysql_query[$mysql_query_internal_index]."
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
while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {	
	if ( $mysql_query_item_ID[$mysql_query_internal_index] != $multilang_TANKMODEL_36 ) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_mysql_query[$mysql_query_internal_index];
	} else {
		$apache_ERROR_MESSAGE_TO_POST = core_indicate_null_return_values_for_items($TANKMODEL_NAME[$mysql_query_internal_index],$multilang_TANKMODEL_36);
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
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY.$apache_REPORT_AGITATION; 
$apache_REPORTL6 = "";
$apache_REPORTL5 = $apache_REPORT_LOWERCONTROLS;
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = $apache_REPORT_LOCKDOWNCLEANINGCONTROLS;
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
