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
TOUCHPANEL ADVANCED OPTIONS FILE
--  EDIT AT YOUR OWN RISK
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

/* ADDITIONAL CONFIG DATA NEEDED TO RUN */
/* 	-- YOU SHOULDN'T NEED TO EDIT THIS AT ALL */
/* ------------------------------------------------------------------ */

/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */
/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */
/*								      */
/*	YOU SHOULD -NOT- HAVE TO EDIT THE FOLLOWING OPTIONS	      */
/*	-- THEY ARE HERE FOR SEVERAL REASONS:			      */
/*								      */
/*		1- FUTURE COMPATABILITY				      */
/*		2- EASE OF PROGRAMMING (LOGICAL PLACE TO PUT THEM     */
/*		   TO ALLOW CALL)				      */
/*		3- IN CASE YOU WANT TO START MODIFYING SEER,          */
/*	           AT WHICH TIME YOU MAY NEED TO CHANGE THESE ITEMS   */
/*								      */
/*	-- OTHER THAN THAT, DON'T MODIFY THEM!			      */
/*								      */
/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */
/* --- WARNING -- -- -- WARNING -- -- -- WARNING -- -- -- WARNING --- */


/* MODEL NAMING or IDENTIFICATION */
/* ------------------------------------------------------------------ */
$MODEL_CODENAME_TO_USE = $TOUCHPANEL_CODENAME;
/*	-- codename of model (as referenced from global options file) */
$MODEL_NAME_TO_USE = $multilang_TOUCHPANEL_0;
/*	-- name (as referenced from language file[s]) to use in titles of pages */
/*	   dealing with this model */
/*	-- typically, this is $multilang_[MODELNAME]_0 */
$MODEL_TABLE_TO_USE[0] = $TOUCHPANEL_mysql_mod_openopc_TABLENAME;
/*	-- array of mod_openopc tables that this model will rely upon */;
/*	   or auto-create via the settings tab in SEER */
/*	-- list these in the same order as the queries listed below, as */
/*	   those queries will be executed upon these tables */
$MODEL_QUERY_TO_RUN[0] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[0]." (DATESTAMP VARCHAR(20), INDEX(DATESTAMP), PANELNAME VARCHAR(30), INDEX(PANELNAME), ALARM VARCHAR(60), CELL11 VARCHAR(60), CELL12 VARCHAR(60), CELL13 VARCHAR(60), CELL14 VARCHAR(60), CELL15 VARCHAR(60), CELL16 VARCHAR(60), CELL21 VARCHAR(60), CELL22 VARCHAR(60), CELL23 VARCHAR(60), CELL24 VARCHAR(60), CELL25 VARCHAR(60), CELL26 VARCHAR(60), CELL31 VARCHAR(60), CELL32 VARCHAR(60), CELL33 VARCHAR(60), CELL34 VARCHAR(60), CELL35 VARCHAR(60), CELL36 VARCHAR(60), CELL41 VARCHAR(60), CELL42 VARCHAR(60), CELL43 VARCHAR(60), CELL44 VARCHAR(60), CELL45 VARCHAR(60), CELL46 VARCHAR(60), CELL51 VARCHAR(60), CELL52 VARCHAR(60), CELL53 VARCHAR(60), CELL54 VARCHAR(60), CELL55 VARCHAR(60), CELL56 VARCHAR(60), CELL61 VARCHAR(60), CELL62 VARCHAR(60), CELL63 VARCHAR(60), CELL64 VARCHAR(60), CELL65 VARCHAR(60), CELL66 VARCHAR(60))";
/*	-- array of mod_openopc table queries to run, specifically for */
/*	   the creation of these tables, which should be listed in the */
/*	   above array in the same order as they are listed in this array */
$MODEL_FORMFILL_MODELS_TO_USE = $seer_TOUCHPANEL_FORMFILL_MODELS;
/*	-- formfill of models (local options instances) as taken from */
/*	   the global options file */

/* DIMENSIONS OF CELLS */
/* ------------------------------------------------------------------ */
$TOUCHPANEL_CELL_HEIGHT = "80";
$TOUCHPANEL_CELL_WIDTH = "148";
/*	-- dimensions in pixels */
/*	-- if these are changed, then the css style sheet with regard to */
/*	   the 'TOUCHPANEL' table class must be updated, in addition to */
/*	   much of the rest of the panel structure layout. */
/*	-- DO NOT EDIT unless modifying program. */

/* PEN COLOR CODES */
/* ------------------------------------------------------------------ */
$TOUCHPANEL_ADVANCED_PEN_COLOR[1] = "default";
/*	-- PEN1 */
$TOUCHPANEL_ADVANCED_PEN_COLOR[2] = "red";
/*	-- PEN2 */
$TOUCHPANEL_ADVANCED_PEN_COLOR[3] = "black";
/*	-- PEN3 */
$TOUCHPANEL_ADVANCED_PEN_COLOR[4] = "green";
/*	-- PEN4 */
$TOUCHPANEL_ADVANCED_PEN_COLOR[5] = "yellow";
/*	-- PEN5 */
$TOUCHPANEL_ADVANCED_PEN_COLOR[6] = "blue";
/*	-- PEN6 */
/*	-- pen colors must one of the following, typed exactly... */
/*	   -- "black" */
/*	   -- "blue" */
/*	   -- "green" */
/*	   -- "red" */
/*	   -- "yellow" */
/*	   -- "default" */
$TOUCHPANEL_ADVANCED_PEN_COLOR[0] = $TOUCHPANEL_ADVANCED_PEN_COLOR[1];

/* EMPTY COLOR CODES */
/* ------------------------------------------------------------------ */
$TOUCHPANEL_ADVANCED_EMPTY = "BGCOLOR='#FFFFFF'";
/*	-- EMPTY */
/*	-- default is FFFFFF (white) */
$TOUCHPANEL_ADVANCED_EMPTY_INVERSE = "BGCOLOR='#444444'";
/*	-- EMPTY INVERSE */
/*	-- default is 000000 (black) */

/* ALARM HIGHLIGHT COLOR CODES */
/* ------------------------------------------------------------------ */
$TOUCHPANEL_ADVANCED_ALARM_ON = "BGCOLOR='#FF4433'";
/*	-- ALARM 'ON' */
/*	-- default is FF4466 (soft red) */
$TOUCHPANEL_ADVANCED_ALARM_OFF = "BGCOLOR='#66EE99'";
/*	-- ALARM 'OFF' */
/*	-- default is 66EE99 (soft green) */

/* ON - OFF BUTTON COLOR CODES */
/* ------------------------------------------------------------------ */
$TOUCHPANEL_ADVANCED_BUTTON_ON = "BGCOLOR='#66EE99'";
/*	-- BUTTON 'ON' */
/*	-- default is 66EE99 (soft green) */
$TOUCHPANEL_ADVANCED_BUTTON_OFF = "BGCOLOR='#FF4433'";
/*	-- BUTTON 'OFF' */
/*	-- default is #FF4433 (soft red) */
$TOUCHPANEL_ADVANCED_BUTTON_ERROR = "BGCOLOR='#DDDDDD'";
/*	-- BUTTON 'ERROR' */
/*	-- default is #DDDDDD (light grey) */

/* MULTISTATE BUTTON COLOR CODES */
/* ------------------------------------------------------------------ */
$TOUCHPANEL_ADVANCED_MULTISTATE[0] = "BGCOLOR='#FFBB33'";
/*	-- MULTISTATE '0' */
/*	-- default is #FFBB33 (soft orange) */
$TOUCHPANEL_ADVANCED_MULTISTATE[1] = "BGCOLOR='#FFEE88'";
/*	-- MULTISTATE '1' */
/*	-- default is #FFEE88 (soft yellow) */
$TOUCHPANEL_ADVANCED_MULTISTATE[2] = "BGCOLOR='#FFAACC'";
/*	-- MULTISTATE '2' */
/*	-- default is #FFAACC (soft pink) */
$TOUCHPANEL_ADVANCED_MULTISTATE[3] = "BGCOLOR='#CCEEFF'";
/*	-- MULTISTATE '3' */
/*	-- default is #CCEEFF (soft blue) */
$TOUCHPANEL_ADVANCED_MULTISTATE[4] = "BGCOLOR='#99FF33'";
/*	-- MULTISTATE '4' */
/*	-- default is #99FF33 (flourescent green) */
$TOUCHPANEL_ADVANCED_MULTISTATE[5] = "BGCOLOR='#9988FF'";
/*	-- MULTISTATE '5' */
/*	-- default is #9988FF (light purple) */
$TOUCHPANEL_ADVANCED_MULTISTATE[6] = "BGCOLOR='#00CCFF'";
/*	-- MULTISTATE '6' */
/*	-- default is #00CCFF (bright blue) */
$TOUCHPANEL_ADVANCED_MULTISTATE[7] = "BGCOLOR='#996600'";
/*	-- MULTISTATE '7' */
/*	-- default is #996600 (light brown) */
$TOUCHPANEL_ADVANCED_MULTISTATE[8] = "BGCOLOR='#888888'";
/*	-- MULTISTATE '8' */
/*	-- default is #888888 (dark grey) */
$TOUCHPANEL_ADVANCED_MULTISTATE[9] = "BGCOLOR='#FF00EE'";
/*	-- MULTISTATE '9' */
/*	-- default is #FF00EE (hot pink) */

/* MODEL HMI AND REPORT IDENTIFICATION */
/* ------------------------------------------------------------------ */
$MODEL_HMI_ID[0] = array("hmi_0", $multilang_TOUCHPANEL_1);
/*	-- identify model hmi pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_hmi_0_BODY.php would be */
/*		identified as simply "hmi_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */
$MODEL_REPORT_ID[0] = array("report_0", $multilang_TOUCHPANEL_2);
/*	-- identify model report pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_report_0_BODY.php would be */
/*		identified as simply "report_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */

?>
