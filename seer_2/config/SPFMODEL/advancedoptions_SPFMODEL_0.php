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
SPFMODEL ADVANCED OPTIONS FILE
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
$MODEL_CODENAME_TO_USE = $SPFMODEL_CODENAME;
/*	-- codename of model (as referenced from global options file) */
$MODEL_NAME_TO_USE = $multilang_SPFMODEL_0;
/*	-- name (as referenced from language file[s]) to use in titles of pages */
/*	   dealing with this model */
/*	-- typically, this is $multilang_[MODELNAME]_0 */
$MODEL_TABLE_TO_USE[0] = $SPFMODEL_mysql_mod_openopc_TABLENAME;
/*	-- array of mod_openopc tables that this model will rely upon */;
/*	   or auto-create via the settings tab in SEER */
/*	-- list these in the same order as the queries listed below, as */
/*	   those queries will be executed upon these tables */
$MODEL_QUERY_TO_RUN[0] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[0]." (DATESTAMP VARCHAR(20), INDEX(DATESTAMP), MACHINE_NAME VARCHAR(30), INDEX(MACHINE_NAME), MACHINE_TYPE TINYINT, INDEX(MACHINE_TYPE), STATE TINYINT, INDEX(STATE), ALARM SMALLINT, INDEX(ALARM), TURBIDITY TINYINT, SOURCE TINYINT, INDEX(SOURCE), DESTINATION1 TINYINT, INDEX(DESTINATION1), DESTINATION2 TINYINT, INDEX(DESTINATION2), SOURCE_FLOW SMALLINT, DESTINATION1_FLOW SMALLINT, DESTINATION2_FLOW SMALLINT, SOURCE_TOTAL_FLOW INT, DESTINATION1_TOTAL_FLOW INT, DESTINATION2_TOTAL_FLOW INT, POWER SMALLINT,POWER_TOTAL INT, BOWL_MOTOR_RPM SMALLINT, BASELINEPRESSURE MEDIUMINT, CONCENTRATION_RATIO SMALLINT, CONCENTRATION_VALVE_POSITION TINYINT, PRESSURE_RAW SMALLINT, PRESSURE_PASTEURIZE SMALLINT, TEMPERATURE_INLET FLOAT(5,2), TEMPERATURE_PASTEURIZE FLOAT(5,2), HRS_SINCE_CLEAN SMALLINT, INDEX(HRS_SINCE_CLEAN), CIP_STEP TINYINT, INDEX(CIP_STEP), CIP_TEMP SMALLINT, CIP_FLOW SMALLINT, CIP_WATER_TYPE TINYINT, INDEX(CIP_WATER_TYPE), CIP_WATER_USAGE MEDIUMINT, CERTIFIED VARCHAR(20), INDEX(CERTIFIED), CERTIFIEDBY VARCHAR(30), INDEX(CERTIFIEDBY), CERTIFIEDCOMMENT VARCHAR(60))";
/*	-- array of mod_openopc table queries to run, specifically for */
/*	   the creation of these tables, which should be listed in the */
/*	   above array in the same order as they are listed in this array */
$MODEL_FORMFILL_MODELS_TO_USE = $seer_SPFMODEL_FORMFILL_MODELS;
/*	-- formfill of models (local options instances) as taken from */
/*	   the global options file */

/* MODEL HMI AND REPORT IDENTIFICATION */
/* ------------------------------------------------------------------ */
$MODEL_HMI_ID[0] = array("hmi_0", $multilang_SPFMODEL_1);
$MODEL_HMI_ID[1] = array("hmi_1", $multilang_SPFMODEL_3);
$MODEL_HMI_ID[2] = array("hmi_2", $multilang_SPFMODEL_4);
/*	-- identify model hmi pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_hmi_0_BODY.php would be */
/*		identified as simply "hmi_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */
$MODEL_REPORT_ID[0] = array("report_0", $multilang_SPFMODEL_5);
$MODEL_REPORT_ID[1] = array("report_1", $multilang_SPFMODEL_6);
$MODEL_REPORT_ID[2] = array("report_2", $multilang_SPFMODEL_7);
$MODEL_REPORT_ID[3] = array("report_3_3-A_4", $multilang_SPFMODEL_8);
$MODEL_REPORT_ID[4] = array("report_5", $multilang_SPFMODEL_10);
$MODEL_REPORT_ID[5] = array("report_6", $multilang_SPFMODEL_11);
$MODEL_REPORT_ID[6] = array("report_7", $multilang_SPFMODEL_12);
$MODEL_REPORT_ID[7] = array("report_8", $multilang_SPFMODEL_13);
$MODEL_REPORT_ID[8] = array("report_9", $multilang_SPFMODEL_14);
/*	-- identify model report pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_report_0_BODY.php would be */
/*		identified as simply "report_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */

?>
