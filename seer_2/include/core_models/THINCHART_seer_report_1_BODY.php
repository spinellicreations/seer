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
THINCHART REPORT 1 BODY (INCLUDED TO ALL THINCHARTS)
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
								<B>".$multilang_THINCHART_0.": ".$multilang_THINCHART_11."</B><BR>
								<I>".$THINCHART_SUBPAGETITLE."</I><BR>
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
		$seer_EXPORT_CONTENT = "";

		/* LOOP INDEX */
		$THINCHART_LOOP_INDEX = 0;

		/* CYCLICALLY PROCESS EACH MACHINE IN MODEL LOCAL INSTANCE */
		foreach ($THINCHART_NAME as &$MACHINE_TO_EXAMINE) {

			/* PREPARE THE QUERY */
			$mysql_mod_openopc_query = "DATESTAMP, CHARTNAME, PEN1, PEN2, PEN3, EVENT, NOTIFICATION";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$THINCHART_mysql_mod_openopc_TABLENAME." WHERE ((DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (CHARTNAME = '".$MACHINE_TO_EXAMINE."')) ORDER BY DATESTAMP ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* DISPLAY ONE RECORD EVERY X RECORDS */
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($THINCHART_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);

			/* COLUMN LABEL FOR CHART INSTANCE */
			model_THINCHART_export_csv_report_1_zero();

			/* PROCESS RESULTS */
			$mysql_query_index = 1;
			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				if ($mysql_query_index == 1) { 
					$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
					$mysql_mod_openopc_WORKING_MACHINENAME = $mysql_mod_openopc_query_row['CHARTNAME'];
					$mysql_mod_openopc_WORKING_PEN1 = $mysql_mod_openopc_query_row['PEN1'];
					$mysql_mod_openopc_WORKING_PEN2 = $mysql_mod_openopc_query_row['PEN2'];
					$mysql_mod_openopc_WORKING_PEN3 = $mysql_mod_openopc_query_row['PEN3'];
					$mysql_mod_openopc_WORKING_EVENT = $mysql_mod_openopc_query_row['EVENT'];
					$mysql_mod_openopc_WORKING_NOTIFICATION = $mysql_mod_openopc_query_row['NOTIFICATION'];

					/* CONVERT TO FRIENDLY VALUES */
					$mysql_mod_openopc_WORKING_PEN1 = varcharTOnumeric2($mysql_mod_openopc_WORKING_PEN1, 2);
					$mysql_mod_openopc_WORKING_PEN2 = varcharTOnumeric2($mysql_mod_openopc_WORKING_PEN2, 2);
					$mysql_mod_openopc_WORKING_PEN3 = varcharTOnumeric2($mysql_mod_openopc_WORKING_PEN3, 2);
					if ($mysql_mod_openopc_WORKING_EVENT == 0) {
						$mysql_mod_openopc_WORKING_EVENT = $multilang_STATIC_NONE;
					} else {
						$mysql_mod_openopc_WORKING_EVENT = $THINCHART_PENNAME_[$THINCHART_LOOP_INDEX]['EVENT'];
					}
					$mysql_mod_openopc_WORKING_NOTIFICATION = $THINCHART_NOTIFICATION[$mysql_mod_openopc_WORKING_NOTIFICATION];

					/* -- BUILD CSV FOR EXPORT */
					model_THINCHART_export_csv_report_1_build();
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
			$THINCHART_LOOP_INDEX = $THINCHART_LOOP_INDEX + 1;
		}

		$apache_REPORT_RECORDENTRY = "
						<TABLE ALIGN='CENTER' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD ALIGN='CENTER' WIDTH='250'>
									<IMG SRC=".$seer_DEFAULTDBDUMPLOGO." ALT='DBDUMP'>
								</TD>
								<TD WIDTH='250'>
									<P CLASS='INFOREPORT'>
										".$multilang_THINCHART_12."
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
