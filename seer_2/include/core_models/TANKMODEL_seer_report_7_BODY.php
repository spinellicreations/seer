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
TANK REPORT 7 BODY (INCLUDED TO ALL TANKMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_128."</B><BR>
								<I>".$TANKMODEL_SUBPAGETITLE."</I><BR>
								<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO CSV FOR EXPORT */
		model_TANK_export_csv_report_7_zero();

		/* LOOP INDEX */
		$TANKMODEL_LOOP_INDEX = 0;

		/* CYCLICALLY PROCESS EACH MACHINE IN MODEL LOCAL INSTANCE */
		foreach ($TANKMODEL_NAME as &$MACHINE_TO_EXAMINE) {

			/* PREPARE THE QUERY */
			$mysql_mod_openopc_query = "DATESTAMP, SILONAME, STATE, SOURCE, DESTINATION, ALARM, PRODUCT, LEVEL_DENSITY, LEVEL_PERCENT, LEVEL_MASS, LEVEL_VOLUME, AGITATOR_MODE, AGITATOR_SPEED, TIME_SINCE_CLEAN, TEMPERATURE";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME." WHERE ((DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (SILONAME = '".$MACHINE_TO_EXAMINE."')) ORDER BY DATESTAMP ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* DISPLAY ONE RECORD EVERY X RECORDS */
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($TANKMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);

			/* PROCESS RESULTS */
			$mysql_query_index = 1;
			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				if ($mysql_query_index == 1) { 
					$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
					$mysql_mod_openopc_WORKING_MACHINENAME = $mysql_mod_openopc_query_row['SILONAME'];
					$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
					$mysql_mod_openopc_WORKING_SOURCE = $mysql_mod_openopc_query_row['SOURCE'];
					$mysql_mod_openopc_WORKING_DESTINATION = $mysql_mod_openopc_query_row['DESTINATION'];
					$mysql_mod_openopc_WORKING_ALARM = $mysql_mod_openopc_query_row['ALARM'];
					$mysql_mod_openopc_WORKING_PRODUCT = $mysql_mod_openopc_query_row['PRODUCT'];
					$mysql_mod_openopc_WORKING_LEVEL_DENSITY = $mysql_mod_openopc_query_row['LEVEL_DENSITY'];
					$mysql_mod_openopc_WORKING_LEVEL_PERCENT = $mysql_mod_openopc_query_row['LEVEL_PERCENT'];
					$mysql_mod_openopc_WORKING_LEVEL_MASS = $mysql_mod_openopc_query_row['LEVEL_MASS'];
					$mysql_mod_openopc_WORKING_LEVEL_VOLUME = $mysql_mod_openopc_query_row['LEVEL_VOLUME'];
					$mysql_mod_openopc_WORKING_AGITATOR_MODE = $mysql_mod_openopc_query_row['AGITATOR_MODE'];
					$mysql_mod_openopc_WORKING_AGITATOR_SPEED = $mysql_mod_openopc_query_row['AGITATOR_SPEED'];
					$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN = $mysql_mod_openopc_query_row['TIME_SINCE_CLEAN'];
					$mysql_mod_openopc_WORKING_TEMPERATURE = $mysql_mod_openopc_query_row['TEMPERATURE'];

					/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
					$mysql_mod_openopc_WORKING_STATE = $TANKMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
					$mysql_mod_openopc_WORKING_SOURCE = $TANKMODEL_SOURCE[$mysql_mod_openopc_WORKING_SOURCE];
					$mysql_mod_openopc_WORKING_DESTINATION = $TANKMODEL_DESTINATION[$mysql_mod_openopc_WORKING_DESTINATION];
					$mysql_mod_openopc_WORKING_ALARM = $TANKMODEL_ALARM[$mysql_mod_openopc_WORKING_ALARM];
					$mysql_mod_openopc_WORKING_PRODUCT = $TANKMODEL_PRODUCT[$mysql_mod_openopc_WORKING_PRODUCT];
					$mysql_mod_openopc_WORKING_LEVEL_PERCENT = varcharTOnumeric2($mysql_mod_openopc_WORKING_LEVEL_PERCENT);
					if (($TANKMODEL_UTILIZE_AGITATOR_CONTROL == 'YES') && ($TANKMODEL_PLC_LEAF_AGITATOR_STATE[$TANKMODEL_LOOP_INDEX] != 'NONE')) {
						$LOGIC_INDEX = 0;
						foreach ($TANKMODEL_AGITATOR_STATE_GROUP1_LOGIC as &$LOGIC_TO_EXAMINE) {
							if ($LOGIC_TO_EXAMINE == $mysql_mod_openopc_WORKING_AGITATOR_MODE) {
								$mysql_mod_openopc_WORKING_AGITATOR_MODE = $TANKMODEL_AGITATOR_STATE_GROUP1[$LOGIC_INDEX];
							} else {
								/* pass */
							}
							$LOGIC_INDEX = $LOGIC_INDEX + 1;
						}
					} else {
						$mysql_mod_openopc_WORKING_AGITATOR_MODE = $multilang_STATIC_NONE;
					}
					$mysql_mod_openopc_WORKING_AGITATOR_SPEED = varcharTOnumeric2($mysql_mod_openopc_WORKING_AGITATOR_SPEED);
					$mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN = varcharTOnumeric2($mysql_mod_openopc_WORKING_HRS_SINCE_CLEAN);
					$mysql_mod_openopc_WORKING_TEMPERATURE = varcharTOnumeric2($mysql_mod_openopc_WORKING_TEMPERATURE, 2);

					/* -- BUILD CSV FOR EXPORT */
					model_TANK_export_csv_report_7_build();
				} else {	
					/* pass */
				}
				/* -- INDEX TO NEXT */
				if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
					$mysql_query_index = 1;
				} else {
					$mysql_query_index =  $mysql_query_index + 1;
				}
			}

			/* LOOP INDEX INCREMENT */
			$TANKMODEL_LOOP_INDEX = $TANKMODEL_LOOP_INDEX + 1;
		}

		$apache_REPORT_RECORDENTRY = "
						<TABLE ALIGN='CENTER' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD ALIGN='CENTER' WIDTH='250'>
									<IMG SRC=".$seer_DEFAULTDBDUMPLOGO." ALT='DBDUMP'>
								</TD>
								<TD WIDTH='250'>
									<P CLASS='INFOREPORT'>
										".$multilang_TANKMODEL_129."
									</P>
								</TD>
							</TR>
						</TABLE>
						";

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		/* -- ADD THE BODY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY;
	} else {
		/* FAULT OUT TO START PAGE */
	}
}

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

/* START PAGE */
/* -- REPORT TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL","NULL","NULL");
}
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = "";
$apache_REPORTL6 = $apache_REPORT_RECORDENTRY; 
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
