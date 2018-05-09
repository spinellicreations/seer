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
CHECKWEIGHERMODEL ADVANCED OPTIONS FILE
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
$MODEL_CODENAME_TO_USE = $CHECKWEIGHERMODEL_CODENAME;
/*	-- codename of model (as referenced from global options file) */
$MODEL_NAME_TO_USE = $multilang_CHECKWEIGHERMODEL_0;
/*	-- name (as referenced from language file[s]) to use in titles of pages */
/*	   dealing with this model */
/*	-- typically, this is $multilang_[MODELNAME]_0 */
$MODEL_TABLE_TO_USE[0] = $CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME;
$MODEL_TABLE_TO_USE[1] = $CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE;
$MODEL_TABLE_TO_USE[2] = $CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_SYPHON;
/*	-- array of mod_openopc tables that this model will rely upon */;
/*	   or auto-create via the settings tab in SEER */
/*	-- list these in the same order as the queries listed below, as */
/*	   those queries will be executed upon these tables */
$MODEL_QUERY_TO_RUN[0] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[0]." (DATESTAMP VARCHAR(20), INDEX(DATESTAMP), MACHINENAME VARCHAR(30), INDEX(MACHINENAME), MASS FLOAT(9,3), RECIPE VARCHAR(30), OPERATOR VARCHAR(30))";
$MODEL_QUERY_TO_RUN[1] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[1]." (RECIPE VARCHAR(30), INDEX(RECIPE), TARGET FLOAT(9,3), DELTA_MIN FLOAT(9,3), DELTA_MAX FLOAT(9,3), TARE FLOAT(9,3), CREATED VARCHAR(20), CREATED_BY VARCHAR(30), UPDATED VARCHAR(20), UPDATED_BY VARCHAR(30))";
$MODEL_QUERY_TO_RUN[2] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[2]." (MACHINENAME VARCHAR(30), INDEX(MACHINENAME), RECIPE VARCHAR(30), OPERATOR VARCHAR(30))";
/*	-- array of mod_openopc table queries to run, specifically for */
/*	   the creation of these tables, which should be listed in the */
/*	   above array in the same order as they are listed in this array */
$MODEL_FORMFILL_MODELS_TO_USE = $seer_CHECKWEIGHERMODEL_FORMFILL_MODELS;
/*	-- formfill of models (local options instances) as taken from */
/*	   the global options file */

/* NOTE - THIS MODULE HAS ADDITIONAL mod_openopc DATABASE TABLE SETUP TASKS, AS */
/*	  DEFINED IN THE setup_createdb_negotiation FILE. */
$MODEL_QUERY_FOR_NULL = "SELECT * FROM ".$MODEL_TABLE_TO_USE[1]." WHERE RECIPE LIKE '".$CHECKWEIGHERMODEL_NAME_OF_NULL_RECIPE."'";
$MODEL_QUERY_TO_CREATE_NULL = "INSERT INTO ".$MODEL_TABLE_TO_USE[1]." VALUES('".$CHECKWEIGHERMODEL_NAME_OF_NULL_RECIPE."','10','1','1','1','".$apache_DEFAULTDATESTAMP."','SEER_AUTO','none','none')";

/* MODEL HMI AND REPORT IDENTIFICATION */
/* ------------------------------------------------------------------ */
$MODEL_HMI_ID[0] = array("hmi_0", $multilang_CHECKWEIGHERMODEL_32);
$MODEL_HMI_ID[1] = array("hmi_1", $multilang_CHECKWEIGHERMODEL_36);
/*	-- identify model hmi pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_hmi_0_BODY.php would be */
/*		identified as simply "hmi_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */
$MODEL_REPORT_ID[0] = array("report_0", $multilang_CHECKWEIGHERMODEL_33);
$MODEL_REPORT_ID[1] = array("report_1", $multilang_CHECKWEIGHERMODEL_56);
/*	-- identify model report pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_report_0_BODY.php would be */
/*		identified as simply "report_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */

?>
