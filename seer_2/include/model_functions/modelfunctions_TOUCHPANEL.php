<?php

/*
S.E.E.R. - incl. Warrior module.
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
S.E.E.R. MODEL FUNCTIONS FILE (TOUCHPANEL)
-- MODEL SUBROUTINES (FUNCTION BY FORM, SUBROUTINE BY EXECUTION)
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is operating system agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* HMI PANEL TO USE DETERMINATION */
/* -- accept incoming panel id */
function model_TOUCHPANEL_what_panel_am_i_using ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TOUCHPANEL_what_panel_am_i_using(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_PANEL_TO_USE;

	/* EXECUTE */
	/* -- this is intentionally nested, do not isolate! */
	/*    It allows us to push a user-generated change via POST */
	/*    but still rely on GET for the auto-refreshing. */
	/* -- without it, we'll always revert to panel 0, which */
	/*    is annoying. */
	if ( $_POST[seer_PANEL_TO_USE] != '' ) {
		$seer_PANEL_TO_USE = $_POST['seer_PANEL_TO_USE'];
	} else {
			if ( $_GET[seer_PANEL_TO_USE] != '' ) {
				$seer_PANEL_TO_USE = $_GET['seer_PANEL_TO_USE'];
			} else {
				$seer_PANEL_TO_USE = 0;
			}
	}
}

/* MARKUP - GENERATE ALARM BANNER */
/* -- generate markup for cell */
function model_TOUCHPANEL_ALARM_BANNER ($post_PANEL_ID,$post_ALARM)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_ALARM_BANNER($post_PANEL_ID,$post_ALARM)*/

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global	$multilang_STATIC_ALARMS;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_ALARM, $TOUCHPANEL_ADVANCED_ALARM_ON, $TOUCHPANEL_ADVANCED_ALARM_OFF;

	/* EXECUTE */
	if ( ($post_ALARM > 0) && ($TOUCHPANEL_ALARM[$post_ALARM] !== "NONE") ) {
		$bgcolor_to_use = $TOUCHPANEL_ADVANCED_ALARM_ON;
	} else {
		$bgcolor_to_use = $TOUCHPANEL_ADVANCED_ALARM_OFF;
	}

	/* --SANITIZE ALARM */
	$post_ALARM = varcharTOnumeric2($post_ALARM,0);

	/* -- GENERATE MARKUP */
	$markup_to_return = "
								<TR ".$bgcolor_to_use.">
									<TD CLASS='ALARM_BANNER' COLSPAN='6' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$multilang_STATIC_ALARMS.":</B> [&#35 ".$post_ALARM."] <I>".$TOUCHPANEL_ALARM[$post_ALARM]."</I>
									</TD>
								</TR>
								";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - EMPTY CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_EMPTY ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_EMPTY($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $TOUCHPANEL_ADVANCED_EMPTY;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT;

	/* EXECUTE */
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
											<TR ".$TOUCHPANEL_ADVANCED_EMPTY.">
												<TD HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."'>
													<BR>
												</TD>
											</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - EMPTY INVERSE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_EMPTY_INVERSE ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_EMPTY_INVERSE($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $TOUCHPANEL_ADVANCED_EMPTY_INVERSE;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT;

	/* EXECUTE */
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
											<TR ".$TOUCHPANEL_ADVANCED_EMPTY_INVERSE.">
												<TD HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."'>
													<BR>
												</TD>
											</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - DISPLAY_TEXT CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_DISPLAY_TEXT ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_DISPLAY_TEXT($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION;

	/* EXECUTE */
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."'>
													<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
												</TD>
											</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - DISPLAY_VALUE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_DISPLAY_VALUE ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_DISPLAY_VALUE($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION;

	/* EXECUTE */
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD HEIGHT='25'>
													<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
												</TD>
											</TR>
											<TR>
												<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 25)."'>
													<B>".$post_CELL_DB_VALUE."</B>
												</TD>
											</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - DISPLAY_VALUE_EDIT CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_DISPLAY_VALUE_EDIT ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_DISPLAY_VALUE_EDIT($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_TRAFFIC_COP_OPTION, $seer_REFERRINGPAGE_THISHMI_0, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME_THISHMI_0;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_mod_openopc_WRITEDAEMON, $TOUCHPANEL_DICTIONARY_NOTIFICATION;

	/* EXECUTE */
	$markup_to_return = "
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='25'>
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 50)."' ALIGN='CENTER' VALIGN='MIDDLE'>
														<INPUT TYPE='text' size='20' name='mod_openopc_YOURLEAFERS' value='".$post_CELL_DB_VALUE."'>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='25' ALIGN='CENTER' VALIGN='MIDDLE'>
														<INPUT TYPE='image' name='enter' src='./img/small_clicky_blue_2.png' width='22' height='22'>
													</TD>
												</TR>
											</TABLE>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$post_CELL_OPTIONS[1]."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TOUCHPANEL_mod_openopc_WRITEDAEMON."'>
										</FORM>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - MULTISTATE_IND_TOGGLE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_MULTISTATE_IND_TOGGLE ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_MULTISTATE_IND_TOGGLE($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_TRAFFIC_COP_OPTION, $seer_REFERRINGPAGE_THISHMI_0, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME_THISHMI_0;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_mod_openopc_WRITEDAEMON, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_MULTISTATE;

	/* EXECUTE */
	$post_CELL_INDEX_VALUE_NEXT = $post_CELL_DB_VALUE + 1;
	$post_CELL_INDEX_VALUE_NEXT_EXISTS = "NO";
	foreach ($TOUCHPANEL_ADVANCED_MULTISTATE as $i) {
		if ($post_CELL_INDEX_VALUE_NEXT == $i) {
			$post_CELL_INDEX_VALUE_NEXT_EXISTS = "YES";
		} else {
			/* pass */
		}	
	}
	if ($post_CELL_INDEX_VALUE_NEXT_EXISTS == "YES") {
		/* pass */
	} else {
		$post_CELL_INDEX_VALUE_NEXT = 0;
	}
	$post_CELL_DB_VALUE_TO_USE = $post_CELL_DB_VALUE + $post_CELL_OPTIONS[0];
	$markup_to_return = "
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 25)."'>
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_DB_VALUE_TO_USE]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='25' ALIGN='CENTER' VALIGN='MIDDLE'>
														<INPUT TYPE='image' name='enter' src='./img/small_clicky_blue_2.png' width='22' height='22'>
													</TD>
												</TR>
											</TABLE>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$post_CELL_OPTIONS[1]."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$post_CELL_INDEX_VALUE_NEXT."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TOUCHPANEL_mod_openopc_WRITEDAEMON."'>
										</FORM>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - MULTISTATE_IND_TOGGLE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_MULTISTATE_IND ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_MULTISTATE_IND($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_MULTISTATE;

	/* EXECUTE */
	$post_CELL_DB_VALUE_TO_USE = $post_CELL_DB_VALUE + $post_CELL_OPTIONS[0];
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."'>
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_DB_VALUE_TO_USE]."</B>
													</TD>
												</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - LEVEL CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_LEVEL ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_LEVEL($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_PEN_COLOR;

	/* EXECUTE */
	$bar_width_to_use = core_display_horizontal_bar("150",$post_CELL_DB_VALUE,$post_CELL_OPTIONS[1],$post_CELL_OPTIONS[2]);
	$bar_color_to_use = "./img/horizontal_bar_".$post_CELL_OPTIONS[3].".png";
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 43)."'>
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='23' CLASS='hmicellborder2full' >
														<IMG SRC='".$bar_color_to_use."' WIDTH='".$bar_width_to_use."' HEIGHT='19' ALT='HORIZONTAL BAR'>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='20' CLASS='hmicellborder2full' >
														[ <I>".$post_CELL_DB_VALUE."</I> ]
													</TD>
												</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - LEVEL_HIGH_WARN CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_LEVEL_HIGH_WARN ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_LEVEL_HIGH_WARN($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION;

	/* EXECUTE */
	$bar_width_to_use = core_display_horizontal_bar("150",$post_CELL_DB_VALUE,$post_CELL_OPTIONS[1],$post_CELL_OPTIONS[2]);
	if ( $post_CELL_DB_VALUE >= ($post_CELL_OPTIONS[3] * 1.05) ) {
		$bar_color_to_use = "./img/horizontal_bar_red.png";
	} else {
		if ( ($post_CELL_DB_VALUE < ($post_CELL_OPTIONS[3] * 1.05)) && ($post_CELL_DB_VALUE >= ($post_CELL_OPTIONS[3] * 0.95)) ) {
			$bar_color_to_use = "./img/horizontal_bar_yellow.png";
		} else {
			$bar_color_to_use = "./img/horizontal_bar_green.png";
		}
	}
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 43)."'>
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='23' CLASS='hmicellborder2full' >
														<IMG SRC='".$bar_color_to_use."' WIDTH='".$bar_width_to_use."' HEIGHT='19' ALT='HORIZONTAL BAR'>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='20' CLASS='hmicellborder2full' >
														[ <I>".$post_CELL_DB_VALUE."</I> ]
													</TD>
												</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - LEVEL_LOW_WARN CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_LEVEL_LOW_WARN ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_LEVEL_LOW_WARN($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION;

	/* EXECUTE */
	$bar_width_to_use = core_display_horizontal_bar("150",$post_CELL_DB_VALUE,$post_CELL_OPTIONS[1],$post_CELL_OPTIONS[2]);
	if ( $post_CELL_DB_VALUE >= ($post_CELL_OPTIONS[3] * 1.05) ) {
		$bar_color_to_use = "./img/horizontal_bar_green.png";
	} else {
		if ( ($post_CELL_DB_VALUE < ($post_CELL_OPTIONS[3] * 1.05)) && ($post_CELL_DB_VALUE >= ($post_CELL_OPTIONS[3] * 0.95)) ) {
			$bar_color_to_use = "./img/horizontal_bar_yellow.png";
		} else {
			$bar_color_to_use = "./img/horizontal_bar_red.png";
		}
	}
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 43)."'>
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='23' CLASS='hmicellborder2full' >
														<IMG SRC='".$bar_color_to_use."' WIDTH='".$bar_width_to_use."' HEIGHT='19' ALT='HORIZONTAL BAR'>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='20' CLASS='hmicellborder2full' >
														[ <I>".$post_CELL_DB_VALUE."</I> ]
													</TD>
												</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - ON_OFF_IND CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_BUTTON_ON, $TOUCHPANEL_ADVANCED_BUTTON_OFF, $TOUCHPANEL_ADVANCED_BUTTON_ERROR;

	/* EXECUTE */
	if (isset($post_CELL_DB_VALUE)) {
		if ($post_CELL_DB_VALUE == 0) {
			$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_OFF;
		} else {
			if ($post_CELL_DB_VALUE == 1) {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ON;
			} else {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
			}
		}
	} else {
		$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
	}
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."' ".$cell_bgcolor_to_use.">
													<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
												</TD>
											</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - ON_OFF_IND_INVERSE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_INVERSE ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_INVERSE($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_BUTTON_ON, $TOUCHPANEL_ADVANCED_BUTTON_OFF, $TOUCHPANEL_ADVANCED_BUTTON_ERROR;

	/* EXECUTE */
	if (isset($post_CELL_DB_VALUE)) {
		if ($post_CELL_DB_VALUE == 0) {
			$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ON;
		} else {
			if ($post_CELL_DB_VALUE == 1) {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_OFF;
			} else {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
			}
		}
	} else {
		$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
	}
	$markup_to_return = "
										<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD HEIGHT='".$TOUCHPANEL_CELL_HEIGHT."' ".$cell_bgcolor_to_use.">
													<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
												</TD>
											</TR>
										</TABLE>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - ON_OFF_IND_MOMENTARY CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_MOMENTARY ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_MOMENTARY($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_TRAFFIC_COP_OPTION, $seer_REFERRINGPAGE_THISHMI_0, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME_THISHMI_0;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_mod_openopc_WRITEDAEMON, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_BUTTON_ON, $TOUCHPANEL_ADVANCED_BUTTON_OFF, $TOUCHPANEL_ADVANCED_BUTTON_ERROR;

	/* EXECUTE */
	$post_CELL_INDEX_VALUE_NEXT = "1";
	if (isset($post_CELL_DB_VALUE)) {
		if ($post_CELL_DB_VALUE == 0) {
			$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_OFF;
			$cell_button_to_use = "./img/small_clicky_green.png";
		} else {
			if ($post_CELL_DB_VALUE == 1) {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ON;
				$cell_button_to_use = "./img/small_clicky_red.png";
			} else {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
				$cell_button_to_use = "./img/small_clicky_grey.png";
			}
		}
	} else {
		$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
		$cell_button_to_use = "./img/small_clicky_grey.png";
	}
	$markup_to_return = "
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 25)."' ".$cell_bgcolor_to_use.">
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='25' ALIGN='CENTER' VALIGN='MIDDLE' ".$cell_bgcolor_to_use.">
														<INPUT TYPE='image' name='enter' src='".$cell_button_to_use."' width='22' height='22'>
													</TD>
												</TR>
											</TABLE>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$post_CELL_OPTIONS[1]."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$post_CELL_INDEX_VALUE_NEXT."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TOUCHPANEL_mod_openopc_WRITEDAEMON."'>
										</FORM>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - ON_OFF_IND_TOGGLE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_TOGGLE ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_TOGGLE($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_TRAFFIC_COP_OPTION, $seer_REFERRINGPAGE_THISHMI_0, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME_THISHMI_0;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_mod_openopc_WRITEDAEMON, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_BUTTON_ON, $TOUCHPANEL_ADVANCED_BUTTON_OFF, $TOUCHPANEL_ADVANCED_BUTTON_ERROR;

	/* EXECUTE */
	if (isset($post_CELL_DB_VALUE)) {
		if ($post_CELL_DB_VALUE == 0) {
			$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_OFF;
			$cell_button_to_use = "./img/small_clicky_green.png";
			$post_CELL_INDEX_VALUE_NEXT = "1";
		} else {
			if ($post_CELL_DB_VALUE == 1) {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ON;
				$cell_button_to_use = "./img/small_clicky_red.png";
				$post_CELL_INDEX_VALUE_NEXT = "0";
			} else {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
				$cell_button_to_use = "./img/small_clicky_grey.png";
				$post_CELL_INDEX_VALUE_NEXT = "0";
			}
		}
	} else {
		$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
		$cell_button_to_use = "./img/small_clicky_grey.png";
		$post_CELL_INDEX_VALUE_NEXT = "0";
	}
	$markup_to_return = "
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 25)."' ".$cell_bgcolor_to_use.">
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='25' ALIGN='CENTER' VALIGN='MIDDLE' ".$cell_bgcolor_to_use.">
														<INPUT TYPE='image' name='enter' src='".$cell_button_to_use."' width='22' height='22'>
													</TD>
												</TR>
											</TABLE>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$post_CELL_OPTIONS[1]."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$post_CELL_INDEX_VALUE_NEXT."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TOUCHPANEL_mod_openopc_WRITEDAEMON."'>
										</FORM>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - ON_OFF_IND_TOGGLE_INVERSE CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_TOGGLE_INVERSE ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_ON_OFF_IND_TOGGLE_INVERSE($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_TRAFFIC_COP_OPTION, $seer_REFERRINGPAGE_THISHMI_0, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME_THISHMI_0;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_mod_openopc_WRITEDAEMON, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_BUTTON_ON, $TOUCHPANEL_ADVANCED_BUTTON_OFF, $TOUCHPANEL_ADVANCED_BUTTON_ERROR;

	/* EXECUTE */
	if (isset($post_CELL_DB_VALUE)) {
		if ($post_CELL_DB_VALUE == 0) {
			$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ON;
			$cell_button_to_use = "./img/small_clicky_red.png";
			$post_CELL_INDEX_VALUE_NEXT = "1";
		} else {
			if ($post_CELL_DB_VALUE == 1) {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_OFF;
				$cell_button_to_use = "./img/small_clicky_green.png";
				$post_CELL_INDEX_VALUE_NEXT = "0";
			} else {
				$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
				$cell_button_to_use = "./img/small_clicky_grey.png";
				$post_CELL_INDEX_VALUE_NEXT = "0";
			}
		}
	} else {
		$cell_bgcolor_to_use = $TOUCHPANEL_ADVANCED_BUTTON_ERROR;
		$cell_button_to_use = "./img/small_clicky_grey.png";
		$post_CELL_INDEX_VALUE_NEXT = "0";
	}
	$markup_to_return = "
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 25)."' ".$cell_bgcolor_to_use.">
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='25' ALIGN='CENTER' VALIGN='MIDDLE' ".$cell_bgcolor_to_use.">
														<INPUT TYPE='image' name='enter' src='".$cell_button_to_use."' width='22' height='22'>
													</TD>
												</TR>
											</TABLE>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$post_CELL_OPTIONS[1]."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$post_CELL_INDEX_VALUE_NEXT."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TOUCHPANEL_mod_openopc_WRITEDAEMON."'>
										</FORM>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

/* MARKUP - BUTTON_MOMENTARY CELL */
/* -- generate markup for cell */
function model_TOUCHPANEL_CELL_TYPE_BUTTON_MOMENTARY ($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $markup_for_cell = model_TOUCHPANEL_CELL_TYPE_BUTTON_MOMENTARY($post_PANEL_ID,$post_COLUMN_ID,$post_ROW_ID,$post_CELL_DB_VALUE,$post_CELL_OPTIONS)*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_TRAFFIC_COP_OPTION, $seer_REFERRINGPAGE_THISHMI_0, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME_THISHMI_0;

	/*	-- TOUCHPANEL MODEL */
	global $TOUCHPANEL_CELL_WIDTH, $TOUCHPANEL_CELL_HEIGHT, $TOUCHPANEL_mod_openopc_WRITEDAEMON, $TOUCHPANEL_DICTIONARY_NOTIFICATION, $TOUCHPANEL_ADVANCED_MULTISTATE;

	/* EXECUTE */
	$markup_to_return = "
										<FORM ACTION='./mod_openopc_write_declared.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION."' METHOD='post'>
											<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$TOUCHPANEL_CELL_WIDTH."' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD HEIGHT='".($TOUCHPANEL_CELL_HEIGHT - 25)."' ".$TOUCHPANEL_ADVANCED_MULTISTATE[$post_CELL_OPTIONS[3]].">
														<B>".$TOUCHPANEL_DICTIONARY_NOTIFICATION[$post_CELL_OPTIONS[0]]."</B>
													</TD>
												</TR>
												<TR>
													<TD HEIGHT='25' ALIGN='CENTER' VALIGN='MIDDLE' ".$TOUCHPANEL_ADVANCED_MULTISTATE[$post_CELL_OPTIONS[3]].">
														<INPUT TYPE='image' name='enter' src='./img/small_clicky_blue_2.png' width='22' height='22'>
													</TD>
												</TR>
											</TABLE>
											<INPUT TYPE='hidden' name='mod_openopc_YOURPLC' value='".$post_CELL_OPTIONS[1]."'>
											<INPUT TYPE='hidden' name='mod_openopc_YOURLEAFERS' value='".$post_CELL_OPTIONS[2]."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE' value='".$seer_REFERRINGPAGE_THISHMI_0."'>
											<INPUT TYPE='hidden' name='seer_REFERRINGPAGE_APPEND' value='".$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP.$seer_REFERRINGPAGE_APPEND."'>
											<INPUT TYPE='hidden' name='seer_BOUNCEBACKTIME' value='".$seer_BOUNCEBACKTIME_THISHMI_0."'>
											<INPUT TYPE='hidden' name='mod_openopc_JOINMYWRITE' value='YES'>
											<INPUT TYPE='hidden' name='mod_openopc_WRITEDAEMON' value='".$TOUCHPANEL_mod_openopc_WRITEDAEMON."'>
										</FORM>
										";

	/* RETURN VARS */
	return $markup_to_return;
}

?>
