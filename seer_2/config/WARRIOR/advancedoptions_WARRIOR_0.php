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
WARRIOR ADVANCED OPTIONS FILE
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
$MODEL_CODENAME_TO_USE = $WARRIOR_CODENAME;
/*	-- codename of model (as referenced from global options file) */
$MODEL_NAME_TO_USE = $multilang_WARRIOR_0;
/*	-- name (as referenced from language file[s]) to use in titles of pages */
/*	   dealing with this model */
/*	-- typically, this is $multilang_[MODELNAME]_0 */
$MODEL_TABLE_TO_USE[0] = $WARRIOR_mysql_mod_openopc_TABLENAME_DATA;
$MODEL_TABLE_TO_USE[1] = $WARRIOR_mysql_mod_openopc_TABLENAME_JOB;
$MODEL_TABLE_TO_USE[2] = $WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE;
/*	-- array of mod_openopc tables that this model will rely upon */;
/*	   or auto-create via the settings tab in SEER */
/*	-- list these in the same order as the queries listed below, as */
/*	   those queries will be executed upon these tables */
$MODEL_QUERY_TO_RUN[0] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[0]." (DATESTAMP VARCHAR(20), INDEX(DATESTAMP), MACHINE_NAME VARCHAR(30), INDEX(MACHINE_NAME), OPERATOR MEDIUMINT, INDEX(OPERATOR), STATE TINYINT, INDEX(STATE), ALARM SMALLINT, INDEX(ALARM), CORRECTIVE_ACTION TINYINT, INDEX(CORRECTIVE_ACTION), PACKAGE_CLASS MEDIUMINT, INDEX(PACKAGE_CLASS), PACKAGES_PER_CYCLE SMALLINT, CYCLES BIGINT, JOB_NUMBER BIGINT, INDEX(JOB_NUMBER), SCHEDULE_NUMBER VARCHAR(35), INDEX(SCHEDULE_NUMBER))";
$MODEL_QUERY_TO_RUN[1] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[1]." (JOB_NUMBER VARCHAR(35), PRIMARY KEY(JOB_NUMBER), INDEX(JOB_NUMBER), JOB_PLCSAFE_NUMBER BIGINT AUTO_INCREMENT NOT NULL, INDEX(JOB_PLCSAFE_NUMBER), JOB_DESCRIPTION VARCHAR(35))";
$MODEL_QUERY_TO_RUN[2] = "CREATE TABLE IF NOT EXISTS ".$MODEL_TABLE_TO_USE[2]." (MACHINE VARCHAR(30), INDEX(MACHINE), SCHEDULE_NUMBER VARCHAR(35), INDEX(SCHEDULE_NUMBER))";
/*	-- array of mod_openopc table queries to run, specifically for */
/*	   the creation of these tables, which should be listed in the */
/*	   above array in the same order as they are listed in this array */
$MODEL_FORMFILL_MODELS_TO_USE = $seer_WARRIOR_FORMFILL_MODELS;
/*	-- formfill of models (local options instances) as taken from */
/*	   the global options file */

/* NOTE - THIS MODULE HAS ADDITIONAL mod_openopc DATABASE TABLE SETUP TASKS, AS */
/*	  DEFINED IN THE setup_createdb_negotiation FILE. */
$MODEL_QUERY_FOR_NULL = "SELECT * FROM ".$MODEL_TABLE_TO_USE[1]." WHERE JOB_DESCRIPTION LIKE '".$WARRIOR_mysql_mod_openopc_NULL_JOB."'";
$MODEL_QUERY_TO_CREATE_NULL = "INSERT INTO ".$MODEL_TABLE_TO_USE[1]." VALUES('0', '', '".$WARRIOR_mysql_mod_openopc_NULL_JOB."')";
$MODEL_QUERY_TO_FIX_NULL = "UPDATE ".$MODEL_TABLE_TO_USE[1]." SET JOB_PLCSAFE_NUMBER='0' WHERE JOB_NUMBER LIKE '0'";

/* MODEL HMI AND REPORT IDENTIFICATION */
/* ------------------------------------------------------------------ */
$MODEL_HMI_ID[0] = array("hmi_0", $multilang_WARRIOR_21);
$MODEL_HMI_ID[1] = array("hmi_1", $multilang_WARRIOR_68);
/*	-- identify model hmi pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_hmi_0_BODY.php would be */
/*		identified as simply "hmi_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */
$MODEL_REPORT_ID[0] = array("report_0", $multilang_WARRIOR_73);
$MODEL_REPORT_ID[1] = array("report_1", $multilang_WARRIOR_91);
$MODEL_REPORT_ID[2] = array("report_2", $multilang_WARRIOR_102);
/*	-- identify model report pages in an array */
/*	-- syntax must match that of the ...BODY.php file */
/*	   for example: */
/*		MYMODEL_seer_report_0_BODY.php would be */
/*		identified as simply "report_0" */
/*	-- the second half of this array is the textual */
/*	   description, as defined as a language file variable */

?>
