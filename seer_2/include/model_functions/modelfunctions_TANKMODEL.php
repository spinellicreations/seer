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
S.E.E.R. MODEL FUNCTIONS FILE (TANKMODEL)
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

/* EXPORT TO CSV - REPORT 1 - ZERO */
/* -- clear csv content */
function model_TANK_export_csv_report_1_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_1_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $TANKMODEL_UM_TEMPERATURE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_TANKMODEL_15, $multilang_TANKMODEL_92, $multilang_TANKMODEL_42, $multilang_TANKMODEL_20, $multilang_TANKMODEL_22, $multilang_TANKMODEL_97, $multilang_STATIC_CERTIFIED, $multilang_STATIC_CERTIFIED_BY, $multilang_STATIC_COMMENT;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, HRS_SINCE_CLEAN, PRODUCT, LEVEL PERCENT, TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_TANKMODEL_15.$seer_CSV_DELINEATION.$multilang_TANKMODEL_92.$seer_CSV_DELINEATION.$multilang_TANKMODEL_42.$seer_CSV_DELINEATION.$multilang_TANKMODEL_20.$seer_CSV_DELINEATION.$multilang_TANKMODEL_22." [%]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_97." [".$TANKMODEL_UM_TEMPERATURE."]".$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED.$seer_CSV_DELINEATION.$multilang_STATIC_CERTIFIED_BY.$seer_CSV_DELINEATION.$multilang_STATIC_COMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1 - BUILD */
/* -- add to (build) csv content */
function model_TANK_export_csv_report_1_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_1_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $MODEL_WORKING_STATE, $mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN, $MODEL_WORKING_PRODUCT, $mysql_mod_openopc_WORKING_LEVEL_PERCENT, $mysql_mod_openopc_WORKING_TEMPERATURE, $mysql_mod_openopc_WORKING_CERTIFIED, $MODEL_CERTIFIEDUSERREALNAME, $mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT;

	/* EXECUTE */
	/* -- -- MACHINE, DATESTAMP, STATE, HRS_SINCE_CLEAN, PRODUCT, LEVEL PERCENT, TEMP, CERTIFIED, CERTIFIED_BY, COMMENT */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$MODEL_WORKING_STATE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN.$seer_CSV_DELINEATION.$MODEL_WORKING_PRODUCT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_PERCENT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TEMPERATURE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIED.$seer_CSV_DELINEATION.$MODEL_CERTIFIEDUSERREALNAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1-A - ZERO */
/* -- clear csv content */
function model_TANK_export_csv_report_1A_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_1A_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $TANKMODEL_UM_MASS, $TANKMODEL_UM_VOLUME, $TANKMODEL_UM_DENSITY;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_TANKMODEL_15, $multilang_TANKMODEL_92, $multilang_TANKMODEL_20, $multilang_TANKMODEL_42, $multilang_TANKMODEL_22, $multilang_TANKMODEL_45, $multilang_TANKMODEL_19, $multilang_TANKMODEL_46;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, PRODUCT, STATE, HRS_SINCE_CLEAN, LEVEL_PCT, LEVEL_VOLUME, LEVEL_DENSITY, LEVEL_MASS */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_TANKMODEL_15.$seer_CSV_DELINEATION.$multilang_TANKMODEL_92.$seer_CSV_DELINEATION.$multilang_TANKMODEL_20.$seer_CSV_DELINEATION.$multilang_TANKMODEL_42.$seer_CSV_DELINEATION.$multilang_TANKMODEL_22." [%]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_45." [".$TANKMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_19." [".$TANKMODEL_UM_DENSITY."]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_46." [".$TANKMODEL_UM_MASS."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 1-A - BUILD */
/* -- add to (build) csv content */
function model_TANK_export_csv_report_1A_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_1A_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $MODEL_WORKING_STATE, $mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN, $mysql_mod_openopc_WORKING_LEVEL_PCT, $mysql_mod_openopc_WORKING_LEVEL_VOLUME, $mysql_mod_openopc_WORKING_LEVEL_DENSITY, $mysql_mod_openopc_WORKING_LEVEL_MASS, $MODEL_WORKING_PRODUCT;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, PRODUCT, HRS_SINCE_CLEAN, LEVEL_PCT, LEVEL_VOLUME, LEVEL_DENSITY, LEVEL_MASS */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$MODEL_WORKING_STATE.$seer_CSV_DELINEATION.$MODEL_WORKING_PRODUCT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TIME_SINCE_CLEAN.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_PCT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_VOLUME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_DENSITY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_MASS.$seer_CSV_ENDOFLINE_HOLDING;
}

/* TIME SINCE CLEAN HIGHLIGHT */
/* -- highlights a cell with a background indicative of the time since the tank */
/*    was last cleaned */
function model_TANK_time_since_clean_highlight ($TIMESINCECLEAN)
{
	/* CALL THIS FUNCTION WITH */
	/* $my_background_color = model_TANK_time_since_clean_highlight($TIMESINCECLEAN); */

	/* GLOBALIZE VARIABLES */
	/* 	-- MODEL SPECIFIC */
	global $TANKMODEL_LOCKDOWN_CLEANING_LOCKED, $TANKMODEL_LOCKDOWN_CLEANING_ALARM, $TANKMODEL_LOCKDOWN_CLEANING_WARNING;

	/* EXECUTE */
	if ( $TIMESINCECLEAN <= $TANKMODEL_LOCKDOWN_CLEANING_LOCKED ) {
		$TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#FF8866";
		/* alarm = red */
		if ( $TIMESINCECLEAN <= $TANKMODEL_LOCKDOWN_CLEANING_ALARM ) {
			$TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#FFAA33";
			/* warning = orange or yellow */
			if ( $TIMESINCECLEAN <= $TANKMODEL_LOCKDOWN_CLEANING_WARNING ) {
				$TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#CCFF66";
				/* good = green */
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}
	} else {
		$TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND = "#FF8866";
		/* lockdown = red (formerly black, however issues with font color */
		/* and limited visibility resulted in change to red */
	}

	/* RETURN VALUES */
	return $TANKMODEL_WORKING_TIME_SINCE_CLEAN_BACKGROUND;
}

/* AGITATOR STATE FRIENDLY VALUE */
/* -- clear csv content */
function model_TANK_agitator_state_value_to_friendly ($mysql_mod_openopc_WORKING_AGITATOR_MODE)
{
	/* CALL THIS FUNCTION WITH... */
	/* $MODEL_WORKING_AGITATOR_MODE = model_TANK_agitator_state_value_to_friendly($mysql_mod_openopc_WORKING_AGITATOR_MODE); */

	/*	-- MODEL SPECIFIC */
	global $TANKMODEL_AGITATOR_STATE_GROUP1_COUNT_ADJUSTED, $TANKMODEL_AGITATOR_STATE_GROUP1, $TANKMODEL_AGITATOR_STATE_GROUP1_LOGIC;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NA;

	/* EXECUTE */
	$MODEL_WORKING_AGITATOR_MODE = $multilang_STATIC_NA;
	$TANKMODEL_AGITATOR_STATE_CYCLE_GROUP1 = 0;
	while ( $TANKMODEL_AGITATOR_STATE_CYCLE_GROUP1 <= $TANKMODEL_AGITATOR_STATE_GROUP1_COUNT_ADJUSTED ) {
		$KEY2 = $TANKMODEL_AGITATOR_STATE_GROUP1_LOGIC[$TANKMODEL_AGITATOR_STATE_CYCLE_GROUP1];
		if ( $mysql_mod_openopc_WORKING_AGITATOR_MODE == $KEY2 ) {
			$MODEL_WORKING_AGITATOR_MODE = $TANKMODEL_AGITATOR_STATE_GROUP1[$TANKMODEL_AGITATOR_STATE_CYCLE_GROUP1];
		} else {
			/* pass over */
		}
		$TANKMODEL_AGITATOR_STATE_CYCLE_GROUP1 = $TANKMODEL_AGITATOR_STATE_CYCLE_GROUP1 + 1;
	}

	/* RETURN VALUE */
	return $MODEL_WORKING_AGITATOR_MODE;
}

/* EXPORT TO CSV - REPORT 0 - ZERO */
/* -- clear csv content */
function model_TANK_export_csv_report_0_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_0_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $TANKMODEL_UM_MASS, $TANKMODEL_UM_VOLUME, $TANKMODEL_UM_DENSITY;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_TANKMODEL_15, $multilang_TANKMODEL_20, $multilang_TANKMODEL_92, $multilang_TANKMODEL_25, $multilang_TANKMODEL_21, $multilang_TANKMODEL_23, $multilang_TANKMODEL_22, $multilang_TANKMODEL_28;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, PRODUCT, STATE, AGITATOR_MODE, LEVEL_ON, LEVEL_OFF, TANK_LEVEL, AGITATOR_SPEED */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_TANKMODEL_15.$seer_CSV_DELINEATION.$multilang_TANKMODEL_20.$seer_CSV_DELINEATION.$multilang_TANKMODEL_92.$seer_CSV_DELINEATION.$multilang_TANKMODEL_25.$seer_CSV_DELINEATION.$multilang_TANKMODEL_21.$seer_CSV_DELINEATION.$multilang_TANKMODEL_23." [%]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_22." [%]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_28." [%]".$seer_CSV_ENDOFLINE_HOLDING;

}

/* EXPORT TO CSV - REPORT 0 - BUILD */
/* -- add to (build) csv content */
function model_TANK_export_csv_report_0_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_0_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_ENTRY_MACHINENAME, $MODEL_WORKING_PRODUCT, $MODEL_WORKING_STATE, $MODEL_WORKING_AGITATOR_MODE, $mysql_mod_openopc_WORKING_AGITATOR_LEVEL_ON, $mysql_mod_openopc_WORKING_AGITATOR_LEVEL_OFF, $mysql_mod_openopc_WORKING_LEVEL_PERCENT, $mysql_mod_openopc_WORKING_AGITATOR_SPEED;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, PRODUCT, STATE, AGITATOR_MODE, LEVEL_ON, LEVEL_OFF, TANK_LEVEL, AGITATOR_SPEED */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_ENTRY_MACHINENAME.$seer_CSV_DELINEATION.$MODEL_WORKING_PRODUCT.$seer_CSV_DELINEATION.$MODEL_WORKING_STATE.$seer_CSV_DELINEATION.$MODEL_WORKING_AGITATOR_MODE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_AGITATOR_LEVEL_ON.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_AGITATOR_LEVEL_OFF.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_PERCENT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_AGITATOR_SPEED.$seer_CSV_ENDOFLINE_HOLDING;

}

/* EXPORT TO CSV - REPORT 3 - ZERO */
/* -- clear csv content */
function model_TANK_export_csv_report_3_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_3_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $TANKMODEL_UM_VOLUME, $TANKMODEL_UM_MASS;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP_CAPS, $multilang_TANKMODEL_105, $multilang_TANKMODEL_95, $multilang_TANKMODEL_107, $multilang_TANKMODEL_109, $multilang_TANKMODEL_110;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, PRODUCT, LEVEL_MASS, LEVEL_VOLUME */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP_CAPS.$seer_CSV_DELINEATION.$multilang_TANKMODEL_105.$seer_CSV_DELINEATION.$multilang_TANKMODEL_95.$seer_CSV_DELINEATION.$multilang_TANKMODEL_107.$seer_CSV_DELINEATION.$multilang_TANKMODEL_109." [".$TANKMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_110." [".$TANKMODEL_UM_VOLUME."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 3 - BUILD */
/* -- add to (build) csv content */
function model_TANK_export_csv_report_3_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_3_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_SILONAME, $MODEL_WORKING_STATE, $MODEL_WORKING_PRODUCT, $mysql_mod_openopc_WORKING_LEVEL_MASS, $mysql_mod_openopc_WORKING_LEVEL_VOLUME;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, PRODUCT, LEVEL_MASS, LEVEL_VOLUME */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_SILONAME.$seer_CSV_DELINEATION.$MODEL_WORKING_STATE.$seer_CSV_DELINEATION.$MODEL_WORKING_PRODUCT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_MASS.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_VOLUME.$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 7 - ZERO */
/* -- clear csv content */
function model_TANK_export_csv_report_7_zero ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_7_zero(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MODEL SPECIFIC */
	global $TANKMODEL_UM_TEMPERATURE, $TANKMODEL_UM_DENSITY, $TANKMODEL_UM_MASS, $TANKMODEL_UM_VOLUME;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DATESTAMP, $multilang_TANKMODEL_25, $multilang_TANKMODEL_28, $multilang_STATIC_ALARMS, $multilang_TANKMODEL_45, $multilang_TANKMODEL_19, $multilang_TANKMODEL_46, $multilang_TANKMODEL_43, $multilang_TANKMODEL_44, $multilang_TANKMODEL_15, $multilang_TANKMODEL_92, $multilang_TANKMODEL_42, $multilang_TANKMODEL_20, $multilang_TANKMODEL_22, $multilang_TANKMODEL_97, $multilang_STATIC_CERTIFIED, $multilang_STATIC_CERTIFIED_BY, $multilang_STATIC_COMMENT;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, SOURCE, DESTINATION, ALARM, PRODUCT, LEVEL DENSITY, LEVEL PERCENT, LEVEL MASS, LEVEL VOLUME, HRS_SINCE_CLEAN, AGITATOR MODE, AGITATOR SPEED, TEMPERATURE */
	$seer_EXPORT_CONTENT = $multilang_STATIC_DATESTAMP.$seer_CSV_DELINEATION.$multilang_TANKMODEL_15.$seer_CSV_DELINEATION.$multilang_TANKMODEL_92.$seer_CSV_DELINEATION.$multilang_TANKMODEL_43.$seer_CSV_DELINEATION.$multilang_TANKMODEL_44.$seer_CSV_DELINEATION.$multilang_STATIC_ALARMS.$seer_CSV_DELINEATION.$multilang_TANKMODEL_20.$seer_CSV_DELINEATION.$multilang_TANKMODEL_19." [".$TANKMODEL_UM_DENSITY."]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_22." [%]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_46." [".$TANKMODEL_UM_MASS."]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_45." [".$TANKMODEL_UM_VOLUME."]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_42.$seer_CSV_DELINEATION.$multilang_TANKMODEL_25.$seer_CSV_DELINEATION.$multilang_TANKMODEL_28." [%]".$seer_CSV_DELINEATION.$multilang_TANKMODEL_97." [".$TANKMODEL_UM_TEMPERATURE."]".$seer_CSV_ENDOFLINE_HOLDING;
}

/* EXPORT TO CSV - REPORT 7 - BUILD */
/* -- add to (build) csv content */
function model_TANK_export_csv_report_7_build ()
{
	/* CALL THIS FUNCTION WITH... */
	/* model_TANK_export_csv_report_7_build(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_DELINEATION, $seer_CSV_ENDOFLINE_HOLDING;

	/*	-- MySQL */
	global $mysql_mod_openopc_WORKING_DATESTAMP, $mysql_mod_openopc_WORKING_MACHINENAME, $mysql_mod_openopc_WORKING_STATE, $mysql_mod_openopc_WORKING_SOURCE, $mysql_mod_openopc_WORKING_DESTINATION, $mysql_mod_openopc_WORKING_ALARM, $mysql_mod_openopc_WORKING_PRODUCT, $mysql_mod_openopc_WORKING_LEVEL_DENSITY, $mysql_mod_openopc_WORKING_LEVEL_PERCENT, $mysql_mod_openopc_WORKING_LEVEL_MASS, $mysql_mod_openopc_WORKING_LEVEL_VOLUME, $mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN, $mysql_mod_openopc_WORKING_AGITATOR_MODE, $mysql_mod_openopc_WORKING_AGITATOR_SPEED, $mysql_mod_openopc_WORKING_TEMPERATURE;

	/* EXECUTE */
	/* -- DATESTAMP, MACHINE, STATE, SOURCE, DESTINATION, ALARM, PRODUCT, LEVEL DENSITY, LEVEL PERCENT, LEVEL MASS, LEVEL VOLUME, HRS_SINCE_CLEAN, AGITATOR MODE, AGITATOR SPEED, TEMPERATURE */
	$seer_EXPORT_CONTENT = $seer_EXPORT_CONTENT.$mysql_mod_openopc_WORKING_DATESTAMP.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_MACHINENAME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_STATE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_SOURCE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_DESTINATION.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_ALARM.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_PRODUCT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_DENSITY.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_PERCENT.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_MASS.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_LEVEL_VOLUME.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_AGITATOR_MODE.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_AGITATOR_SPEED.$seer_CSV_DELINEATION.$mysql_mod_openopc_WORKING_TEMPERATURE.$seer_CSV_ENDOFLINE_HOLDING;
}

?>
