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
SPFMODEL ADVANCED LOCAL-COMMON FILE
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
$SPFMODEL_COUNT_ADJUSTED = $SPFMODEL_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$SPFMODEL_FORMFILL_NAME = "";
$SPFMODEL_COUNT_CYCLE = 0;
while ( $SPFMODEL_COUNT_CYCLE <= $SPFMODEL_COUNT_ADJUSTED ) {
	$SPFMODEL_FORMFILL_NAME = $SPFMODEL_FORMFILL_NAME."<OPTION VALUE='".$SPFMODEL_NAME[$SPFMODEL_COUNT_CYCLE]."'>".$SPFMODEL_NAME[$SPFMODEL_COUNT_CYCLE];
	$SPFMODEL_COUNT_CYCLE = $SPFMODEL_COUNT_CYCLE + 1;
}

/*	FORM FILL FOR SELF-CIP */
/*	---------------------- */
$SPFMODEL_FORMFILL_SELF_CIP = "";
$SPFMODEL_TABLE_NOT_SELF_CIP = "";
$SPFMODEL_COUNT_CYCLE = 0;
while ( $SPFMODEL_COUNT_CYCLE <= $SPFMODEL_COUNT_ADJUSTED ) {
	if ( $SPFMODEL_CIP_BY[$SPFMODEL_COUNT_CYCLE] == 'SELFCLEAN' ) {
		$SPFMODEL_FORMFILL_SELF_CIP = $SPFMODEL_FORMFILL_SELF_CIP."<OPTION VALUE='".$SPFMODEL_NAME[$SPFMODEL_COUNT_CYCLE]."'>".$SPFMODEL_NAME[$SPFMODEL_COUNT_CYCLE];
	} else {
		$SPFMODEL_TABLE_NOT_SELF_CIP = $SPFMODEL_TABLE_NOT_SELF_CIP."<TR>
								<TD>
									".$SPFMODEL_NAME[$SPFMODEL_COUNT_CYCLE]."
								</TD>
								<TD>
									".$SPFMODEL_CIP_BY[$SPFMODEL_COUNT_CYCLE]."
								</TD>
							</TR>
							";
	}
	$SPFMODEL_COUNT_CYCLE = $SPFMODEL_COUNT_CYCLE + 1;
}

/* -- STATES */
/* --------- */
$SPFMODEL_STATE_COUNT_ADJUSTED = $SPFMODEL_STATE_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$SPFMODEL_FORMFILL_STATE = "";
$SPFMODEL_STATE_COUNT_CYCLE = 0;
while ( $SPFMODEL_STATE_COUNT_CYCLE <= $SPFMODEL_STATE_COUNT_ADJUSTED ) {
	$SPFMODEL_FORMFILL_STATE = $SPFMODEL_FORMFILL_STATE."<OPTION VALUE='".$SPFMODEL_STATE_COUNT_CYCLE."'>".$SPFMODEL_STATE[$SPFMODEL_STATE_COUNT_CYCLE];
	$SPFMODEL_STATE_COUNT_CYCLE = $SPFMODEL_STATE_COUNT_CYCLE + 1;
}

/* -- ALARMS */
/* --------- */
$SPFMODEL_ALARM_COUNT_ADJUSTED = $SPFMODEL_ALARM_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$SPFMODEL_FORMFILL_ALARM = "";
$SPFMODEL_ALARM_COUNT_CYCLE = 1;
while ( $SPFMODEL_ALARM_COUNT_CYCLE <= $SPFMODEL_ALARM_COUNT_ADJUSTED ) {
	$SPFMODEL_FORMFILL_ALARM = $SPFMODEL_FORMFILL_ALARM."<OPTION VALUE='".$SPFMODEL_ALARM_COUNT_CYCLE."'>".$SPFMODEL_ALARM[$SPFMODEL_ALARM_COUNT_CYCLE];
	$SPFMODEL_ALARM_COUNT_CYCLE = $SPFMODEL_ALARM_COUNT_CYCLE + 1;
}

/* -- SELF CIP */
/* ----------- */
/* -- -- STEPS */
/* ----------- */
$SPFMODEL_STEP_COUNT_ADJUSTED = $SPFMODEL_STEP_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	WHERE WE START COUNTING AT */
/* 	-------------------------- */
$SPFMODEL_CIP_STEP_REALSTEPS = ">= ".$SPFMODEL_CIP_REALSTEPS_START_INTEGER;

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$SPFMODEL_FORMFILL_STEP = "";
$SPFMODEL_STEP_COUNT_CYCLE = 0;
while ( $SPFMODEL_STEP_COUNT_CYCLE <= $SPFMODEL_STEP_COUNT_ADJUSTED ) {
	if ( $SPFMODEL_STEP_COUNT_CYCLE >= $SPFMODEL_CIP_REALSTEPS_START_INTEGER ) {
/* 		-- status values corresponding to this expression are */
/*		   to be considered... */
/*		-- example... ">= 5" */
/*		   which means any value greater than or equal to 5" */
/*		-- -- valid expressions are... */
/*	   		>= [integer] */
		$SPFMODEL_FORMFILL_STEP = $SPFMODEL_FORMFILL_STEP."<OPTION VALUE='".$SPFMODEL_STEP_COUNT_CYCLE."'>".$SPFMODEL_CIP_STEP[$SPFMODEL_STEP_COUNT_CYCLE];
	} else {
		/* pass */
	}
	$SPFMODEL_STEP_COUNT_CYCLE = $SPFMODEL_STEP_COUNT_CYCLE + 1;
}

/*	WATER TYPES */
/* 	----------- */
$SPFMODEL_WATER_TYPE_COUNT_ADJUSTED = $SPFMODEL_WATER_TYPE_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/* -- TURBIDITY CONTROLS */
/* --------------------- */
if ( $SPFMODEL_UTILIZE_TURBIDITY_CONTROLS == "YES" ) {
	/*	FORM FILL FOR ACK */
	/*	----------------- */
	$SPFMODEL_FORMFILL_PLC_LEAF_TURBIDITY_ACKNOWLEDGE = "";
	$SPFMODEL_COUNT_CYCLE = 0;
	while ( $SPFMODEL_COUNT_CYCLE <= $SPFMODEL_COUNT_ADJUSTED ) {
		if ( $SPFMODEL_TURBIDITY_SENSOR_PRESENT[$SPFMODEL_COUNT_CYCLE] == "YES" ) {
			$SPFMODEL_FORMFILL_PLC_LEAF_TURBIDITY_ACKNOWLEDGE = $SPFMODEL_FORMFILL_PLC_LEAF_TURBIDITY_ACKNOWLEDGE."<OPTION VALUE='".$SPFMODEL_PLC_LEAF_TURBIDITY_ACKNOWLEDGE[$SPFMODEL_COUNT_CYCLE]."'>".$SPFMODEL_NAME[$SPFMODEL_COUNT_CYCLE];
		} else {
			/* pass */
		}
		$SPFMODEL_COUNT_CYCLE = $SPFMODEL_COUNT_CYCLE + 1;
	}
} else {
	/* pass */
}

?>
