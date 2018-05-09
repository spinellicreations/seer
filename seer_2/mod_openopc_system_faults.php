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
mod_openopc SYSTEM FAULTS VIEWER AND ACKNOWLEDGEMENT
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "./mod_openopc_system_faults.php".$seer_REFERRINGPAGE_ADDKEYINFO;
/*	-- send user back here after they execute actions */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_59."</B><BR>
							<I>".$multilang_STATIC_60."...<BR>
							 ".$apache_DEFAULTDATESTAMP."</I>
						</P>
						";

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_HMIACTION] != '' ) {
	$seer_HMIACTION = $_POST['seer_HMIACTION'];
	$seer_HMIACTION_FAULT = 0;
} else {
	$seer_HMIACTION = "DISPLAY_START_PAGE";
}

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$mysql_seer_access_ACCESSLEVEL = 9999;
	$seer_HMIACTION_FAULT = 1;
	$seer_FAULT_TYPE = $multilang_FAULT_1;
} else {
	/* proceed */
}

/* CLEAR FAULTS AS REQUESTED */
/* ------------------------------------------------------------------ */
if ( ($seer_HMIACTION == 'CLEARFAULTS') && ($mysql_seer_access_ACCESSLEVEL <= 2) ) {
	$mysql_mod_openopc_query = "UPDATE system_faults SET ACKNOWLEDGED='".$mysql_seer_access_USERNAME."' WHERE ACKNOWLEDGED IS NULL";
	mysqli_select_db($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_DBNAME);	
	mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
	$seer_HMIACTION = "DISPLAY_START_PAGE";
} else {
	/* pass */
}

/* ZERO OUT THE BODY CONTAINER */
/* ------------------------------------------------------------------ */
$apache_REPORT_BODY = "";

/* FILE TICKET BUILDER */
/* ------------------------------------------------------------------ */

/* SEARCH FUNCTION */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "SELECT * FROM system_faults WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') ORDER BY DATESTAMP DESC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_REPORT_FAULT_COUNT) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* DISPLAY A BACK BUTTON */
		$apache_REPORT_BODY = "
						<P CLASS='PAGETITLE'>
							<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A><BR>
							<BR>
						</P>
						";

		/* BUILD TICKET DATA */
		$apache_REPORT_BODY = $apache_REPORT_BODY."
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='930' CELLPADDING=0 CELLSPACING=0>
					";

		if ( $mysql_mod_openopc_REPORT_FAULT_COUNT == 0 ) {
			/* ALL SYSTEMS GO */
			$apache_REPORT_BODY = $apache_REPORT_BODY."
							<TR>
								<TD WIDTH='150'>
									<BR>
								</TD>
								<TD>
									".$multilang_STATIC_61."<BR>
									<BR>
									".$multilang_STATIC_62."<BR>
								</TD>
								<TD WIDTH='150'>
									<BR>
								</TD>
							</TR>
							";
		} else {
			/* FAULT OR WARNING CONDITION */
			$apache_REPORT_BODY = $apache_REPORT_BODY."
							<TR>
								<TD WIDTH='140' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_63."</U></B>
								</TD>
								<TD WIDTH='130' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_64."</U></B>
								</TD>
								<TD WIDTH='300' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_65."</U></B>
								</TD>
								<TD WIDTH='240' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_66."</U></B>
								</TD>
								<TD WIDTH='120' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_67."</U></B>
								</TD>
							</TR>
							";
	
			/* CYCLE THROUGH FAULTS */
			$apache_REPORT_ROW_BGCOLOR = "";
			$apache_REPORT_ROW_BGCOLOR_ALT = "BGCOLOR='#DDDDDD'";
			$apache_REPORT_ROW_INDEX = 0;
			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_TYPE = $mysql_mod_openopc_query_row['TYPE'];
				$mysql_mod_openopc_WORKING_ROUTINE = $mysql_mod_openopc_query_row['ROUTINE'];
				$mysql_mod_openopc_WORKING_PARTNER = $mysql_mod_openopc_query_row['PARTNER'];
				$mysql_mod_openopc_WORKING_ACKNOWLEDGED = $mysql_mod_openopc_query_row['ACKNOWLEDGED'];

				if ( $apache_REPORT_ROW_INDEX == 0 ) {
					$apache_REPORT_ROW_BGCOLOR_USE = $apache_REPORT_ROW_BGCOLOR;
					$apache_REPORT_ROW_INDEX = 1;
				} else {
					$apache_REPORT_ROW_BGCOLOR_USE = $apache_REPORT_ROW_BGCOLOR_ALT;
					$apache_REPORT_ROW_INDEX = 0;
				}

				/* ECHO BACK EACH */
				$apache_REPORT_BODY = $apache_REPORT_BODY."
							<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_DATESTAMP."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_TYPE."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_ROUTINE."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_PARTNER."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_ACKNOWLEDGED."
								</TD>
							</TR>
							";

			}

		}

		$apache_REPORT_BODY = $apache_REPORT_BODY."
						</TABLE>
						";

	} else {
		/* pass */
	}
} else {
	/* pass */
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
if ( $seer_HMIACTION == "DISPLAY_FAULT_PAGE" ) {
	core_user_conditionally_executed_fault_page_body();
}

/* LOWER CONTROLS */
/* -- CLEAR FAULT DIALOGUE */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	$apache_REPORT_LOWER_CONTROLS = "
						<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
							";

	$apache_REPORT_LOWER_CONTROLS = $apache_REPORT_LOWER_CONTROLS."
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
											<B><I>".$multilang_FAULT_16."...</I></B><BR>
										</P>
									</TD>
								</TR>
								<TR>
							<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B><I>".$multilang_FAULT_17."</I></B>
									</TD>
									<TD>
										<INPUT TYPE='hidden' name='seer_HMIACTION' value='CLEARFAULTS'>
										<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE."'>
										<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
									</TD>
							<TD>
										<BR>
									</TD>
								</TR>
								";

	$apache_REPORT_LOWER_CONTROLS = $apache_REPORT_LOWER_CONTROLS."
							</TABLE>
						</FORM>
						";
} else {
	/* pass */
}

/* START PAGE */
/* -- CURRENT FAULTS AND REPORT TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {

	/* SYSTEM FAULT DB QUERY */
	$mysql_mod_openopc_query = "SELECT * FROM system_faults WHERE ACKNOWLEDGED IS NULL ORDER BY DATESTAMP DESC";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_ACTIVE_FAULT_COUNT) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

	/* BUILD RUNDOWN OF CURRENT AND ACTIVE */
	$apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN = "
						<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='850' CELLPADDING=0 CELLSPACING=0>
						";

	if ( $mysql_mod_openopc_ACTIVE_FAULT_COUNT == 0 ) {
		/* ALL SYSTEMS GO */
		$apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN = $apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN."
							<TR>
								<TD WIDTH='150'>
									<BR>
								</TD>
								<TD>
									".$multilang_STATIC_61."<BR>
									<BR>
									".$multilang_STATIC_68."<BR>
								</TD>
								<TD WIDTH='150'>
									<BR>
								</TD>
							</TR>
							";
	} else {
		/* FAULT OR WARNING CONDITION */
		$apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN = $apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN."
							<TR>
								<TD WIDTH='150' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_63."</U></B>
								</TD>
								<TD WIDTH='150' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_64."</U></B>
								</TD>
								<TD WIDTH='300' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_65."</U></B>
								</TD>
								<TD WIDTH='250' ALIGN='LEFT' VALIGN='MIDDLE'>
									<B><U>".$multilang_STATIC_66."</U></B>
								</TD>
							</TR>
							";
	
		/* CYCLE THROUGH FAULTS */
		$apache_SWITCH_ROW_COLOR = 0;
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_TYPE = $mysql_mod_openopc_query_row['TYPE'];
			$mysql_mod_openopc_WORKING_ROUTINE = $mysql_mod_openopc_query_row['ROUTINE'];
			$mysql_mod_openopc_WORKING_PARTNER = $mysql_mod_openopc_query_row['PARTNER'];

			/* FLIP FLOP ROW COLOR */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

			/* ECHO BACK EACH */
			$apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN = $apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN."
							<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_DATESTAMP."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_TYPE."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_ROUTINE."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_PARTNER."
								</TD>
							</TR>
							";

		}

	}

	$apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN = $apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN."
						</TABLE>
						";

	/* BUILD FAULT HISTORY SEARCH DIALOGUE */
	if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
		$apache_REPORT_FAULT_HISTORY_SEARCH = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_FAULT_22,$multilang_FAULT_21,$multilang_FAULT_20);	
	}

	/* BODY */
	$apache_REPORT_BODY = $apache_REPORT_BODY."
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='600'>
									<P CLASS='INFOREPORT'>
									<B><I>".$multilang_FAULT_18."...</I></B><BR>
									</P>
								</TD>
							</TR>
						</TABLE>
						".$apache_REPORT_CURRENT_ACTIVE_FAULT_RUNDOWN."
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='600'>
									<P CLASS='INFOREPORT'>
										<BR>
										<B><I>".$multilang_FAULT_19."...</I></B>
									</P>
								</TD>
							</TR>
						</TABLE>
						".$apache_REPORT_FAULT_HISTORY_SEARCH."
						";

} else {
	/* pass */
}

/* -- SUPPORT FAULT VIEWER FOR PLUGINS (PULL IN) */
/* -- -- RESTRICTED TO SUPER USER LEVEL OR HIGHER */
/* -- -- NO ONE ELSE SHOULD BE TINKERING WITH YOUR PLUGIN FAULT LOGS */
$apache_plugin_process_active = "FAULTS";
$apache_REPORT_PLUGIN_ADDON = "";
foreach ($seer_PLUGINS_TO_USE as $selected_PLUGIN) {
	if ( $seer_HMIACTION_FAULT != 1 ) {
		include($apache_WEBROOT.'/'.$apache_seer_VERSION.'/plugins/'.$selected_PLUGIN.'/options.php');
	} else {
		/* pass */
	}
}
$apache_REPORT_PLUGIN_ADDON = $apache_REPORT_PLUGIN_ADDON."
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD>
									<BR>
									<IMG SRC='./img/horizontal_bar_black.png' WIDTH='600' HEIGHT='2' ALT='BAR'><BR>
									<BR>
								</TD>
							</TR>
						</TABLE>";
$apache_plugin_process_active = "NONE";
/*	-- DO NOT EDIT */
/*	-- all plugins should be placed in /[seer_webroot]/plugins/[plugin_name]/ */
/*	   and contain an 'options.php' file */
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL1 = ""; 
$apache_REPORTL2 = $apache_REPORT_LOWER_CONTROLS.$apache_REPORT_PLUGIN_ADDON;
$apache_REPORTL3 = "";
$apache_REPORTL4 = "";
$apache_REPORTL5 = "";
$apache_REPORTL6 = "";
$apache_REPORTL7 = $apache_REPORT_BODY;

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
