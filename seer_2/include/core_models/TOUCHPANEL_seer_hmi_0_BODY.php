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
TOUCHPANEL HMI 0 BODY (INCLUDED TO ALL TOUCHPANELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 60;
/*	-- time between refreshing this page */
/* */
if ( isset($seer_BOUNCEBACKTIME_THISHMI_0) ) {
	/* pass */
} else {
	$seer_BOUNCEBACKTIME_THISHMI_0 = 10;
	/*	-- time between pushing an external function and returning to this page */
}
/* -- this is now declared in the local options file for the model */
/*    ... however we also offer this as a 'patch' for legacy config */
/*    and options files, so that the page will not 'break'. */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_TOUCHPANEL_0.": ".$multilang_TOUCHPANEL_1."</B><BR>
								<I>".$TOUCHPANEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* WHAT PANEL ARE WE USING */
/* ------------------------------------------------------------------ */
model_TOUCHPANEL_what_panel_am_i_using();

/* SCADA PAGES REQUIRE MODIFICATION TO REFERRING PAGE PARAMETER */
/* ------------------------------------------------------------------ */
referring_page_append_reqd_scada(";seer_PANEL_TO_USE=".$seer_PANEL_TO_USE);
/*	-- key manipulation required for pages utilizing scada */

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */

/* SCAN PANEL DATA FROM DATABASE */
$mysql_mod_openopc_query = "*";
$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TOUCHPANEL_mysql_mod_openopc_TABLENAME." WHERE (PANELNAME = '".$TOUCHPANEL_NAME[$seer_PANEL_TO_USE]."') LIMIT 1";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query,0);

$mysql_FIRST_RUN = 0;
while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
	$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
	$mysql_mod_openopc_WORKING_PANELNAME = $mysql_mod_openopc_query_row['PANELNAME'];
	$mysql_mod_openopc_WORKING_ALARM = round($mysql_mod_openopc_query_row['ALARM']);
	$mysql_mod_openopc_WORKING_CELL[1][1] = $mysql_mod_openopc_query_row['CELL11'];
	$mysql_mod_openopc_WORKING_CELL[1][2] = $mysql_mod_openopc_query_row['CELL12'];
	$mysql_mod_openopc_WORKING_CELL[1][3] = $mysql_mod_openopc_query_row['CELL13'];
	$mysql_mod_openopc_WORKING_CELL[1][4] = $mysql_mod_openopc_query_row['CELL14'];
	$mysql_mod_openopc_WORKING_CELL[1][5] = $mysql_mod_openopc_query_row['CELL15'];
	$mysql_mod_openopc_WORKING_CELL[1][6] = $mysql_mod_openopc_query_row['CELL16'];
	$mysql_mod_openopc_WORKING_CELL[2][1] = $mysql_mod_openopc_query_row['CELL21'];
	$mysql_mod_openopc_WORKING_CELL[2][2] = $mysql_mod_openopc_query_row['CELL22'];
	$mysql_mod_openopc_WORKING_CELL[2][3] = $mysql_mod_openopc_query_row['CELL23'];
	$mysql_mod_openopc_WORKING_CELL[2][4] = $mysql_mod_openopc_query_row['CELL24'];
	$mysql_mod_openopc_WORKING_CELL[2][5] = $mysql_mod_openopc_query_row['CELL25'];
	$mysql_mod_openopc_WORKING_CELL[2][6] = $mysql_mod_openopc_query_row['CELL26'];
	$mysql_mod_openopc_WORKING_CELL[3][1] = $mysql_mod_openopc_query_row['CELL31'];
	$mysql_mod_openopc_WORKING_CELL[3][2] = $mysql_mod_openopc_query_row['CELL32'];
	$mysql_mod_openopc_WORKING_CELL[3][3] = $mysql_mod_openopc_query_row['CELL33'];
	$mysql_mod_openopc_WORKING_CELL[3][4] = $mysql_mod_openopc_query_row['CELL34'];
	$mysql_mod_openopc_WORKING_CELL[3][5] = $mysql_mod_openopc_query_row['CELL35'];
	$mysql_mod_openopc_WORKING_CELL[3][6] = $mysql_mod_openopc_query_row['CELL36'];
	$mysql_mod_openopc_WORKING_CELL[4][1] = $mysql_mod_openopc_query_row['CELL41'];
	$mysql_mod_openopc_WORKING_CELL[4][2] = $mysql_mod_openopc_query_row['CELL42'];
	$mysql_mod_openopc_WORKING_CELL[4][3] = $mysql_mod_openopc_query_row['CELL43'];
	$mysql_mod_openopc_WORKING_CELL[4][4] = $mysql_mod_openopc_query_row['CELL44'];
	$mysql_mod_openopc_WORKING_CELL[4][5] = $mysql_mod_openopc_query_row['CELL45'];
	$mysql_mod_openopc_WORKING_CELL[4][6] = $mysql_mod_openopc_query_row['CELL46'];
	$mysql_mod_openopc_WORKING_CELL[5][1] = $mysql_mod_openopc_query_row['CELL51'];
	$mysql_mod_openopc_WORKING_CELL[5][2] = $mysql_mod_openopc_query_row['CELL52'];
	$mysql_mod_openopc_WORKING_CELL[5][3] = $mysql_mod_openopc_query_row['CELL53'];
	$mysql_mod_openopc_WORKING_CELL[5][4] = $mysql_mod_openopc_query_row['CELL54'];
	$mysql_mod_openopc_WORKING_CELL[5][5] = $mysql_mod_openopc_query_row['CELL55'];
	$mysql_mod_openopc_WORKING_CELL[5][6] = $mysql_mod_openopc_query_row['CELL56'];
	$mysql_mod_openopc_WORKING_CELL[6][1] = $mysql_mod_openopc_query_row['CELL61'];
	$mysql_mod_openopc_WORKING_CELL[6][2] = $mysql_mod_openopc_query_row['CELL62'];
	$mysql_mod_openopc_WORKING_CELL[6][3] = $mysql_mod_openopc_query_row['CELL63'];
	$mysql_mod_openopc_WORKING_CELL[6][4] = $mysql_mod_openopc_query_row['CELL64'];
	$mysql_mod_openopc_WORKING_CELL[6][5] = $mysql_mod_openopc_query_row['CELL65'];
	$mysql_mod_openopc_WORKING_CELL[6][6] = $mysql_mod_openopc_query_row['CELL66'];
	$mysql_FIRST_RUN = 1;
}
if ($mysql_FIRST_RUN == 0) {
	$mysql_mod_openopc_WORKING_ALARM = 0;
} else {
	/* pass */
}

/* ZERO OUT CELLS */
$skeleton_row_count = 1;
$skeleton_column_count = 1;
while ($skeleton_row_count < 7) {
	while ($skeleton_column_count < 7) {
		$WORKING_CELL_TYPE = $TOUCHPANEL_CELL_TYPE[$seer_PANEL_TO_USE][$skeleton_row_count][$skeleton_column_count];
		$WORKING_CELL_OPTION = $TOUCHPANEL_CELL_OPTION[$seer_PANEL_TO_USE][$skeleton_row_count][$skeleton_column_count];
		$WORKING_CELL_VALUE = $mysql_mod_openopc_WORKING_CELL[$skeleton_row_count][$skeleton_column_count];
		$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = "
										<BR>
										";
		/* CELL TYPE - EMPTY */
		if ($WORKING_CELL_TYPE == "EMPTY") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_EMPTY($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - EMPTY_INVERSE */
		if ($WORKING_CELL_TYPE == "EMPTY_INVERSE") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_EMPTY_INVERSE($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - DISPLAY_TEXT */
		if ($WORKING_CELL_TYPE == "DISPLAY_TEXT") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_DISPLAY_TEXT($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - DISPLAY_VALUE */
		if ($WORKING_CELL_TYPE == "DISPLAY_VALUE") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_DISPLAY_VALUE($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - DISPLAY_VALUE_EDIT */
		if ($WORKING_CELL_TYPE == "DISPLAY_VALUE_EDIT") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_DISPLAY_VALUE_EDIT($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - DISPLAY_VALUE_EDIT */
		if ($WORKING_CELL_TYPE == "MULTISTATE_IND_TOGGLE") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_MULTISTATE_IND_TOGGLE($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - DISPLAY_VALUE_EDIT */
		if ($WORKING_CELL_TYPE == "MULTISTATE_IND") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_MULTISTATE_IND($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - LEVEL */
		if ($WORKING_CELL_TYPE == "LEVEL") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_LEVEL($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - LEVEL_HIGH_WARN */
		if ($WORKING_CELL_TYPE == "LEVEL_HIGH_WARN") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_LEVEL_HIGH_WARN($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - LEVEL */
		if ($WORKING_CELL_TYPE == "LEVEL_LOW_WARN") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_LEVEL_LOW_WARN($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - ON_OFF_IND_TOGGLE */
		if ($WORKING_CELL_TYPE == "ON_OFF_IND_TOGGLE") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_TOGGLE($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - ON_OFF_IND_TOGGLE */
		if ($WORKING_CELL_TYPE == "ON_OFF_IND_TOGGLE_INVERSE") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_TOGGLE_INVERSE($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - ON_OFF_IND_MOMENTARY */
		if ($WORKING_CELL_TYPE == "ON_OFF_IND_MOMENTARY") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_MOMENTARY($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - ON_OFF_IND */
		if ($WORKING_CELL_TYPE == "ON_OFF_IND") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - ON_OFF_IND_INVERSE */
		if ($WORKING_CELL_TYPE == "ON_OFF_IND_INVERSE") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_INVERSE($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		/* CELL TYPE - BUTTON_MOMENTARY */
		if ($WORKING_CELL_TYPE == "BUTTON_MOMENTARY") {
			$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count] = model_TOUCHPANEL_CELL_TYPE_BUTTON_MOMENTARY($seer_PANEL_TO_USE,$skeleton_column_count,$skeleton_row_count,$WORKING_CELL_VALUE,$WORKING_CELL_OPTION);
		} else {
			/* pass */
		}
		$skeleton_column_count = $skeleton_column_count + 1;
	}
	$skeleton_row_count = $skeleton_row_count + 1;
	$skeleton_column_count = 1;
}

/* SKELETON OF PANEL */
$skeleton_row_count = 1;
$skeleton_column_count = 1;
while ($skeleton_row_count < 7) {
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
								";
	while ($skeleton_column_count < 7) {
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD CLASS='CELL' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."'>
										".$apache_REPORT_CONTENT_OF_CELL[$skeleton_row_count][$skeleton_column_count]."
									</TD>
									";		
		$skeleton_column_count = $skeleton_column_count + 1;
	}
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								</TR>
								";
	$skeleton_row_count = $skeleton_row_count + 1;
	$skeleton_column_count = 1;
}

/* ALARM BANNER */
if ($TOUCHPANEL_DISPLAY_ALARM_BANNER == "YES" ) {
	$apache_REPORT_CONTENT_OF_ALARM_BANNER = model_TOUCHPANEL_ALARM_BANNER($seer_PANEL_TO_USE,$mysql_mod_openopc_WORKING_ALARM);
} else {
	$apache_REPORT_CONTENT_OF_ALARM_BANNER = "";
}

/* PANEL SELECTOR FOR USER */
/* ----------------------- */
$apache_REPORT_PANEL_SELECTOR = "
								<TR>
									<TD COLSPAN='6'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='6' ALIGN='CENTER'>
										<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
											<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD WIDTH='150'>
													</TD>
													<TD WIDTH='50'>
													</TD>
													<TD WIDTH='225'>
													</TD>
													<TD WIDTH='150'>
													</TD>
													<TD WIDTH='50'>
													</TD>
													<TD WIDTH='225'>
													</TD>
												</TR>
												<TR>
													<TD CLASS='twosizeup' ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><I>".$multilang_TOUCHPANEL_4.":</I></B>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<IMG SRC='./img/seer_gear_small.png' ALIGN='middle' WIDTH='30' HEIGHT='30'>
													</TD>
													<TD CLASS='twosizeup' ALIGN='LEFT' VALIGN='MIDDLE'>
														<U>".$TOUCHPANEL_NAME_FRIENDLY[$seer_PANEL_TO_USE]."</U>
													</TD>
													<TD CLASS='twosizeup' ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><I>".$multilang_TOUCHPANEL_6.":</I></B>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png' align='middle'>
													</TD>
													<TD CLASS='twosizeup' ALIGN='LEFT' VALIGN='MIDDLE'>
														<SELECT NAME='seer_PANEL_TO_USE'><OPTION VALUE=''>".$multilang_TOUCHPANEL_5.$TOUCHPANEL_FORMFILL_BYNUMBER."</SELECT>
													</TD>
												</TR>
											</TABLE>
										</FORM>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='6'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'>
									</TD>
								</TR>
							";

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($mysql_mod_openopc_WORKING_DATESTAMP,"SNAPSHOT");
$apache_REPORT_RECORDENTRY = $apache_REPORT_TOPPLATE."
							<TABLE CLASS='TOUCHPANEL' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
									<TD WIDTH='150'>
									</TD>
								</TR>
								".$apache_REPORT_PANEL_SELECTOR."
								".$apache_REPORT_CONTENT_OF_ALARM_BANNER."
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
