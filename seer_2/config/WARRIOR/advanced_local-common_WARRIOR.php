<?php

/*
S.E.E.R. - The Warrior Module.
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
WARRIOR ADVANCED LOCAL-COMMON FILE
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


/* MODIFICATIONS TO LOCALOPTIONS AS NEEDED TO PREP FOR USE BY SEER */
/* ------------------------------------------------------------------ */
/* -- COUNT */
/* -------- */
$WARRIOR_COUNT_ADJUSTED = $WARRIOR_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$WARRIOR_FORMFILL_NAME = "";
$WARRIOR_COUNT_CYCLE = 0;
while ( $WARRIOR_COUNT_CYCLE <= $WARRIOR_COUNT_ADJUSTED ) {
	$WARRIOR_FORMFILL_NAME = $WARRIOR_FORMFILL_NAME."<OPTION VALUE='".$WARRIOR_COUNT_CYCLE."'>".$WARRIOR_NAME[$WARRIOR_COUNT_CYCLE];
	$WARRIOR_COUNT_CYCLE = $WARRIOR_COUNT_CYCLE + 1;
}

/* -- SHIFT */
/* -------- */
$WARRIOR_SHIFT_COUNT_ADJUSTED = $WARRIOR_SHIFT_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$WARRIOR_FORMFILL_SHIFT_NAME = "";
$WARRIOR_COUNT_CYCLE = 0;
while ( $WARRIOR_COUNT_CYCLE <= $WARRIOR_SHIFT_COUNT_ADJUSTED ) {
	$WARRIOR_FORMFILL_SHIFT_NAME = $WARRIOR_FORMFILL_SHIFT_NAME."<OPTION VALUE='".$WARRIOR_COUNT_CYCLE."'>".$WARRIOR_SHIFT_NAME[$WARRIOR_COUNT_CYCLE];
	$WARRIOR_COUNT_CYCLE = $WARRIOR_COUNT_CYCLE + 1;
}

/* -- ALARMS */
/* --------- */
$WARRIOR_ALARM_COUNT_ADJUSTED = $WARRIOR_ALARM_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

$WARRIOR_FORMFILL_ALARM = "";
$WARRIOR_COUNT_CYCLE = 2;	/* -- ignore 'no alarms' and 'maintenance mode' */
while ( $WARRIOR_COUNT_CYCLE <= $WARRIOR_ALARM_COUNT_ADJUSTED ) {
	$WARRIOR_FORMFILL_ALARM = $WARRIOR_FORMFILL_ALARM."<OPTION VALUE='".$WARRIOR_COUNT_CYCLE."'>".$WARRIOR_ALARM[$WARRIOR_COUNT_CYCLE];
	$WARRIOR_COUNT_CYCLE = $WARRIOR_COUNT_CYCLE + 1;
}

/* -- CORRECTIVE ACTIONS */
/* --------------------- */
$WARRIOR_ACTION_COUNT_ADJUSTED = $WARRIOR_ACTION_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

$WARRIOR_FORMFILL_ACTION = "";
$WARRIOR_COUNT_CYCLE = 0;	/* -- ignore 'no corrective action' and 'maintenance mode' */
while ( $WARRIOR_COUNT_CYCLE <= $WARRIOR_ACTION_COUNT_ADJUSTED ) {
	if ($WARRIOR_COUNT_CYCLE != 1) {
		$WARRIOR_FORMFILL_ACTION = $WARRIOR_FORMFILL_ACTION."<OPTION VALUE='".$WARRIOR_COUNT_CYCLE."'>".$WARRIOR_ACTION[$WARRIOR_COUNT_CYCLE];
	} else {
		/* pass */
	}
	$WARRIOR_COUNT_CYCLE = $WARRIOR_COUNT_CYCLE + 1;
}

/* -- PACKAGE CLASSES */
/* ------------------ */
$WARRIOR_PACKAGE_COUNT_ADJUSTED = $WARRIOR_PACKAGE_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

$WARRIOR_FORMFILL_PACKAGE = "";
$WARRIOR_COUNT_CYCLE = 0;
while ( $WARRIOR_COUNT_CYCLE <= $WARRIOR_PACKAGE_COUNT_ADJUSTED ) {
	$WARRIOR_FORMFILL_PACKAGE = $WARRIOR_FORMFILL_PACKAGE."<OPTION VALUE='".$WARRIOR_COUNT_CYCLE."'>".$WARRIOR_PACKAGE[$WARRIOR_COUNT_CYCLE];
	$WARRIOR_COUNT_CYCLE = $WARRIOR_COUNT_CYCLE + 1;
}


?>