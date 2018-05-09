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
CIPMODEL ADVANCED LOCAL-COMMON FILE
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
$CIPMODEL_COUNT_ADJUSTED = $CIPMODEL_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$CIPMODEL_FORMFILL_NAME = "";
$CIPMODEL_COUNT_CYCLE = 0;
while ( $CIPMODEL_COUNT_CYCLE <= $CIPMODEL_COUNT_ADJUSTED ) {
	$CIPMODEL_FORMFILL_NAME = $CIPMODEL_FORMFILL_NAME."<OPTION VALUE='".$CIPMODEL_NAME[$CIPMODEL_COUNT_CYCLE]."'>".$CIPMODEL_NAME[$CIPMODEL_COUNT_CYCLE];
	$CIPMODEL_COUNT_CYCLE = $CIPMODEL_COUNT_CYCLE + 1;
}

/* -- STATUS */
/* --------- */
$CIPMODEL_STATUS_COUNT_ADJUSTED = $CIPMODEL_STATUS_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	WHERE THE GOOD STATUS END AND FAULTS BEGIN */
/*	------------------------------------------ */
$CIPMODEL_STATUS_FAULT = ">= ".$CIPMODEL_STATUS_FAULT_START_INTEGER;

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$CIPMODEL_FORMFILL_STATUS = "";
$CIPMODEL_STATUS_COUNT_CYCLE = 0;
while ( $CIPMODEL_STATUS_COUNT_CYCLE <= $CIPMODEL_STATUS_COUNT_ADJUSTED ) {
	if ( $CIPMODEL_STATUS_COUNT_CYCLE >= $CIPMODEL_STATUS_FAULT_START_INTEGER ) {
/* 		-- status values corresponding to this expression are */
/*		   to be considered as faults... */
/*		-- example... ">= 5" */
/*		   which means any cip status greater than or equal to 5" */
/*		-- -- valid expressions are... */
/*	   		>= [integer] */
		$CIPMODEL_FORMFILL_STATUS = $CIPMODEL_FORMFILL_STATUS."<OPTION VALUE='".$CIPMODEL_STATUS_COUNT_CYCLE."'>".$CIPMODEL_STATUS[$CIPMODEL_STATUS_COUNT_CYCLE];
	} else {
		/* pass */
	}
	$CIPMODEL_STATUS_COUNT_CYCLE = $CIPMODEL_STATUS_COUNT_CYCLE + 1;
}

/* -- LINES BEING CLEANED */
/* ---------------------- */
$CIPMODEL_LINE_BEING_CLEANED_COUNT_ADJUSTED = $CIPMODEL_LINE_BEING_CLEANED_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	WHERE WE START COUNTING AT */
/* 	-------------------------- */
$CIPMODEL_LINE_BEING_CLEANED_REALLINES = ">= ".$CIPMODEL_LINE_BEING_CLEANED_REALLINES_START_INTEGER;

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$CIPMODEL_FORMFILL_LINE_BEING_CLEANED = "";
$CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE = 0;
while ( $CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE <= $CIPMODEL_LINE_BEING_CLEANED_COUNT_ADJUSTED ) {
	if ( $CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE >= $CIPMODEL_LINE_BEING_CLEANED_REALLINES_START_INTEGER ) {
/* 		-- status values corresponding to this expression are */
/*		   to be considered... */
/*		-- example... ">= 5" */
/*		   which means any value greater than or equal to 5" */
/*		-- -- valid expressions are... */
/*	   		>= [integer] */
		$CIPMODEL_FORMFILL_LINE_BEING_CLEANED = $CIPMODEL_FORMFILL_LINE_BEING_CLEANED."<OPTION VALUE='".$CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE."'>".$CIPMODEL_LINE_BEING_CLEANED[$CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE];
	} else {
		/* pass */
	}
	$CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE = $CIPMODEL_LINE_BEING_CLEANED_COUNT_CYCLE + 1;
}

/* -- STEPS */
/* -------- */
$CIPMODEL_STEP_COUNT_ADJUSTED = $CIPMODEL_STEP_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/*	WHERE WE START COUNTING AT */
/* 	-------------------------- */
$CIPMODEL_STEP_REALSTEPS = ">= ".$CIPMODEL_REALSTEPS_START_INTEGER;

/*	FORM FILL FOR ABOVE */
/*	------------------- */
$CIPMODEL_FORMFILL_STEP = "";
$CIPMODEL_STEP_COUNT_CYCLE = 0;
while ( $CIPMODEL_STEP_COUNT_CYCLE <= $CIPMODEL_STEP_COUNT_ADJUSTED ) {
	if ( $CIPMODEL_STEP_COUNT_CYCLE >= $CIPMODEL_REALSTEPS_START_INTEGER ) {
/* 		-- status values corresponding to this expression are */
/*		   to be considered... */
/*		-- example... ">= 5" */
/*		   which means any value greater than or equal to 5" */
/*		-- -- valid expressions are... */
/*	   		>= [integer] */
		$CIPMODEL_FORMFILL_STEP = $CIPMODEL_FORMFILL_STEP."<OPTION VALUE='".$CIPMODEL_STEP_COUNT_CYCLE."'>".$CIPMODEL_STEP[$CIPMODEL_STEP_COUNT_CYCLE];
	} else {
		/* pass */
	}
	$CIPMODEL_STEP_COUNT_CYCLE = $CIPMODEL_STEP_COUNT_CYCLE + 1;
}

/* -- WATER TYPES */
/* -------------- */
$CIPMODEL_WATER_TYPE_COUNT_ADJUSTED = $CIPMODEL_WATER_TYPE_COUNT - 1;
/*	-- this offsets by 1 for array construction */
/*	-- do not edit */

/* -- STEP CONTROLS */
/* ---------------- */
if ( $CIPMODEL_UTILIZE_STEP_CONTROLS == "YES" ) {
	/*	FORM FILL FOR FORCING HOLD */
	/*	-------------------------- */
	$CIPMODEL_FORMFILL_PLC_LEAF_FORCE_HOLD = "";
	$CIPMODEL_COUNT_CYCLE = 0;
	while ( $CIPMODEL_COUNT_CYCLE <= $CIPMODEL_COUNT_ADJUSTED ) {
		$CIPMODEL_FORMFILL_PLC_LEAF_FORCE_HOLD = $CIPMODEL_FORMFILL_PLC_LEAF_FORCE_HOLD."<OPTION VALUE='".$CIPMODEL_PLC_LEAF_FORCE_HOLD[$CIPMODEL_COUNT_CYCLE]."'>".$CIPMODEL_NAME[$CIPMODEL_COUNT_CYCLE];
		$CIPMODEL_COUNT_CYCLE = $CIPMODEL_COUNT_CYCLE + 1;
	}
	/*	FORM FILL FOR FORCING STEPS*/
	/*	-------------------------- */
	$CIPMODEL_FORMFILL_PLC_LEAF_FORCE_STEP = "";
	$CIPMODEL_COUNT_CYCLE = 0;
	while ( $CIPMODEL_COUNT_CYCLE <= $CIPMODEL_COUNT_ADJUSTED ) {
		$CIPMODEL_FORMFILL_PLC_LEAF_FORCE_STEP = $CIPMODEL_FORMFILL_PLC_LEAF_FORCE_STEP."<OPTION VALUE='".$CIPMODEL_PLC_LEAF_FORCE_STEP[$CIPMODEL_COUNT_CYCLE]."'>".$CIPMODEL_NAME[$CIPMODEL_COUNT_CYCLE];
		$CIPMODEL_COUNT_CYCLE = $CIPMODEL_COUNT_CYCLE + 1;
	}
	/*	FORM FILL FOR HOLD AND STEP */
	/*	--------------------------- */
	$CIPMODEL_FORMFILL_PLC_LEAF_DISABLE_MANUAL_HOLD_AND_STEP = "";
	$CIPMODEL_COUNT_CYCLE = 0;
	while ( $CIPMODEL_COUNT_CYCLE <= $CIPMODEL_COUNT_ADJUSTED ) {
		$CIPMODEL_FORMFILL_PLC_LEAF_DISABLE_MANUAL_HOLD_AND_STEP = $CIPMODEL_FORMFILL_PLC_LEAF_DISABLE_MANUAL_HOLD_AND_STEP."<OPTION VALUE='".$CIPMODEL_PLC_LEAF_DISABLE_MANUAL_HOLD_AND_STEP[$CIPMODEL_COUNT_CYCLE]."'>".$CIPMODEL_NAME[$CIPMODEL_COUNT_CYCLE];
		$CIPMODEL_COUNT_CYCLE = $CIPMODEL_COUNT_CYCLE + 1;
	}
} else {
	/* pass */
}

?>
