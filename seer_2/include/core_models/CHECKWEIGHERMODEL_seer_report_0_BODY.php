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
CHECKWEIGHER REPORT 0 BODY (INCLUDED TO ALL CHECKWEIGHER MODELS)
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
								<B>".$multilang_CHECKWEIGHERMODEL_0.": ".$multilang_CHECKWEIGHERMODEL_33."</B><BR>
								<I>".$CHECKWEIGHERMODEL_SUBPAGETITLE."</I><BR>
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
	core_user_date_time_range_input_type_1($multilang_CHECKWEIGHERMODEL_59,$multilang_FAULT_30);
	/* -- ADDITIONAL OPTIONS */
	$mysql_ENTRY_DISPLAY_REJECTS = $mysql_ENTRY_OPTIONNAME;

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		/* -- CHECKWEIGHER, OPERATOR, DATESTAMP_START, DATESTAMP_END, RUNTIME_MINUTES, RECIPE, TARGET, TARE, MIN, MAX, QUANTITY, QUANTITY_ACCEPTED, QUANTITY_REJECTED, TOTAL_MASS, TOTAL_MASS_ACCEPTED, TOTAL_MASS_REJECTED, RATE, RATE_ACCEPTED, MEAN_MASS, MEAN_MASS_ACCEPTED, MEAN_MASS_REJECTED, EXPECTED_ACCEPTED_PRODUCTION, ACTUAL_ACCEPTED_PRODUCTION, DIFFERENCE, GIVEAWAY, TAKEAWAY, STANDARD_DEVIATION */
		model_CHECKWEIGHER_export_csv_report_0_zero();

		/* RUN THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, MASS, RECIPE, OPERATOR";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME." WHERE ((DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINENAME LIKE '".$mysql_ENTRY_MACHINENAME."')) ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		/* -- CONFIGURATION */
		$SIGMA_BAR_GRAPH_HEIGHT = 300;
		$apache_REPORT_RECORDENTRY = "";
		$mysql_mod_openopc_HOLDING_RECIPE = "NO_RECIPE_HAS_YET_BEEN_FOUND_ON_THE_SYSTEM_0123456789";
		$mysql_mod_openopc_HOLDING_OPERATOR = "NONE_AS_OF_YET_0123456789";
		/* -- ZERO OUT HOLDING VALUES */
		$apache_SWITCH_ROW_COLOR = 0;
		$mysql_query_FIRST_RUN = 1;
		$mysql_seer_HOLDING_REALNAME = "THIS_SHOULD_NEVER_SHOW_UP";
		$mysql_mod_openopc_WORKING_MASS_ARRAY = array();
		$mysql_mod_openopc_WORKING_MASS_TOTAL = 0;
		$mysql_mod_openopc_WORKING_COUNT = 0;
		$mysql_mod_openopc_WORKING_RATE = 0;
		$mysql_mod_openopc_WORKING_RATE_ACCEPTED = 0;
		$mysql_mod_openopc_WORKING_MASS_AVERAGE = 0;
		$mysql_mod_openopc_WORKING_DATESTAMP_START = 0;
		$mysql_mod_openopc_WORKING_DATESTAMP_END = 0;
		$mysql_mod_openopc_WORKING_DURATION_MINUTES = 0;
		$mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED = 0;
		$mysql_mod_openopc_WORKING_MASS_ACCEPTED = 0;
		$mysql_mod_openopc_WORKING_MASS_AVERAGE = 0;
		$mysql_mod_openopc_WORKING_COUNT_ACCEPTED = 0;
		$mysql_mod_openopc_WORKING_COUNT_REJECTED = 0;
		$mysql_mod_openopc_WORKING_MASS_REJECTED = 0;
		$mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED = 0;
		$mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS = array();
		$mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP = array();
		$mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS[0] = 0;
		$mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP[0] = "THIS_SHOULD_NEVER_SHOW_UP";
		$mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION = 0;
		$mysql_mod_openopc_WORKING_TAKEAWAY = 0;
		$mysql_mod_openopc_WORKING_GIVEAWAY = 0;

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {

			/* BATCH STATUS, NEW OR OLD */
			$mysql_mod_openopc_WORKING_OPERATOR = $mysql_mod_openopc_query_row['OPERATOR'];
			$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];
			$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
			$mysql_mod_openopc_WORKING_MASS = $mysql_mod_openopc_query_row['MASS'];

			/* REAL DATA OR GARBAGE DATA ? */
			if ($mysql_mod_openopc_WORKING_RECIPE == $CHECKWEIGHERMODEL_NAME_OF_NULL_RECIPE) {
				/* NULL RECIPE ENTERED - SKIP RECORD */
				$mysql_mod_openopc_FORCE_CLOSE_OUT_BATCH = 1;
			} else {
				/* REAL DATA, PROCEED */
				if ( $mysql_mod_openopc_WORKING_OPERATOR == NULL ) {
					/* BACKWARDS COMPATABILITY FOR DATABASES UPGRADED FROM CHECKWEIGHERMODEL */
					/* VERSION 1 */
					$mysql_mod_openopc_WORKING_OPERATOR = $multilang_STATIC_UNKNOWN;
				} else {
					/* pass */
				}

				if ( ($mysql_mod_openopc_WORKING_OPERATOR != $mysql_mod_openopc_HOLDING_OPERATOR) || ($mysql_mod_openopc_WORKING_RECIPE != $mysql_mod_openopc_HOLDING_RECIPE) || ($mysql_mod_openopc_FORCE_CLOSE_OUT_BATCH == 1) ) {
					if ($mysql_query_FIRST_RUN == 1) {
						$mysql_query_FIRST_RUN = 0;
					} else {
						/* CLOSE OUT THE PREVIOUS BATCH */
						model_CHECKWEIGHER_push_to_report_0();
					}

					/* UPDATE SOME STATUS TAGS (HOLDING RECIPE, OPERATOR, FIRST RUN) */
					$mysql_query_FIRST_RUN = 0;
					$mysql_mod_openopc_HOLDING_RECIPE = $mysql_mod_openopc_WORKING_RECIPE;
					$mysql_mod_openopc_HOLDING_OPERATOR = $mysql_mod_openopc_WORKING_OPERATOR;

					/* PULL THE RECIPE PARAMETERS FROM THE DB ONCE, THEN MAINTAIN THEM UNTIL THE RECIPE CHANGES */
					/* -- THIS CUTS DOWN ON DB QUERIES AND LOAD */
					$mysql_mod_openopc_query2 = "TARGET, DELTA_MIN, DELTA_MAX, TARE";
					$mysql_mod_openopc_query2 = "SELECT ".$mysql_mod_openopc_query2." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE LIKE '".$mysql_mod_openopc_WORKING_RECIPE."' LIMIT 1";
					list($mysql_mod_openopc_query_result2,$mysql_mod_openopc_num_rows2) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query2);
					if ($mysql_mod_openopc_num_rows2 < 1) {
						/* FAULT - WHERE IS THE RECIPE AT ?!? ITS MISSING !!! */
						$seer_HMIACTION_FAULT = 1;
						$seer_FAULT_TYPE = "RECIPE_TABLE_CORRUPT_OR_MISSING_DATA!";
					} else {
						/* RECIPE FOUND - PROCEED */
						while ($mysql_mod_openopc_query_row2 = mysqli_fetch_assoc($mysql_mod_openopc_query_result2)) {
							$mysql_mod_openopc_WORKING_TARGET = varcharTOnumeric2(($mysql_mod_openopc_query_row2['TARGET']), 3);
							$mysql_mod_openopc_WORKING_DELTA_MIN = varcharTOnumeric2(($mysql_mod_openopc_query_row2['DELTA_MIN']), 3);
							$mysql_mod_openopc_WORKING_DELTA_MAX = varcharTOnumeric2(($mysql_mod_openopc_query_row2['DELTA_MAX']), 3);
							$mysql_mod_openopc_WORKING_MIN = varcharTOnumeric2(($mysql_mod_openopc_WORKING_TARGET - $mysql_mod_openopc_WORKING_DELTA_MIN), 3);
							$mysql_mod_openopc_WORKING_MAX = varcharTOnumeric2(($mysql_mod_openopc_WORKING_TARGET + $mysql_mod_openopc_WORKING_DELTA_MAX), 3);
							$mysql_mod_openopc_WORKING_TARE = varcharTOnumeric2(($mysql_mod_openopc_query_row2['TARE']), 3);
						}
					}

					/* UPDATE BATCH SUMMARY INFO */
					$mysql_mod_openopc_WORKING_MASS_NET = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS - $mysql_mod_openopc_WORKING_TARE), 2);
					$mysql_mod_openopc_WORKING_MASS_TOTAL = varcharTOnumeric2($mysql_mod_openopc_WORKING_MASS_NET, 2);
					$mysql_mod_openopc_WORKING_COUNT = 1;
					$mysql_mod_openopc_WORKING_MASS_ARRAY[$mysql_mod_openopc_WORKING_COUNT] = $mysql_mod_openopc_WORKING_MASS_NET;
					$mysql_mod_openopc_WORKING_RATE = 0;
					$mysql_mod_openopc_WORKING_RATE_ACCEPTED = 0;
					$mysql_mod_openopc_WORKING_MASS_AVERAGE = 0;
					$mysql_mod_openopc_WORKING_DATESTAMP_START = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_mod_openopc_WORKING_DATESTAMP_END = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_mod_openopc_WORKING_DURATION_MINUTES = 0;
					$mysql_mod_openopc_WORKING_MASS_AVERAGE_ACCEPTED = 0;
					$mysql_mod_openopc_WORKING_MASS_ACCEPTED = 0;
					$mysql_mod_openopc_WORKING_MASS_AVERAGE = 0;
					$mysql_mod_openopc_WORKING_COUNT_ACCEPTED = 0;
					$mysql_mod_openopc_WORKING_COUNT_REJECTED = 0;
					$mysql_mod_openopc_WORKING_MASS_REJECTED = 0;
					$mysql_mod_openopc_WORKING_MASS_AVERAGE_REJECTED = 0;
					$mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS = array();
					$mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP = array();
					$mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS[0] = 0;
					$mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP[0] = "THIS_SHOULD_NEVER_SHOW_UP";
					$mysql_mod_openopc_WORKING_EXPECTED_PRODUCTION = 0;
					$mysql_mod_openopc_WORKING_TAKEAWAY = 0;
					$mysql_mod_openopc_WORKING_GIVEAWAY = 0;

					/* SET PENDING EXPORT TO REPORT */
					$mysql_mod_openopc_EXPORT_ME_PLEASE = 1;

				} else {

					/* IF THIS IS AN EXISTING BATCH, THEN PROCESS */
					$mysql_mod_openopc_WORKING_MASS_NET = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS - $mysql_mod_openopc_WORKING_TARE), 3);
					$mysql_mod_openopc_WORKING_MASS_ARRAY[$mysql_mod_openopc_WORKING_COUNT] = $mysql_mod_openopc_WORKING_MASS_NET;
					$mysql_mod_openopc_WORKING_DATESTAMP_END = $mysql_mod_openopc_WORKING_DATESTAMP;
					$mysql_mod_openopc_WORKING_MASS_TOTAL = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_NET + $mysql_mod_openopc_WORKING_MASS_TOTAL), 3);
					$mysql_mod_openopc_WORKING_COUNT = $mysql_mod_openopc_WORKING_COUNT + 1;
				}

				if ( ($mysql_mod_openopc_WORKING_MASS_NET < $mysql_mod_openopc_WORKING_MIN) || ($mysql_mod_openopc_WORKING_MASS_NET > $mysql_mod_openopc_WORKING_MAX) ) {
					/* UNIT WAS REJECTED */
					$mysql_mod_openopc_WORKING_COUNT_REJECTED = $mysql_mod_openopc_WORKING_COUNT_REJECTED + 1;
					$mysql_mod_openopc_WORKING_MASS_REJECTED = $mysql_mod_openopc_WORKING_MASS_REJECTED + $mysql_mod_openopc_WORKING_MASS_NET;
					if ($mysql_ENTRY_DISPLAY_REJECTS == 'YES') {
					$mysql_mod_openopc_WORKING_REJECT_ARRAY_MASS[$mysql_mod_openopc_WORKING_COUNT_REJECTED] = $mysql_mod_openopc_WORKING_MASS_NET;
					$mysql_mod_openopc_WORKING_REJECT_ARRAY_DATESTAMP[$mysql_mod_openopc_WORKING_COUNT_REJECTED] = $mysql_mod_openopc_WORKING_DATESTAMP;
					} else {
						/* pass */
					}
				} else {
					/* UNIT WAS ACCEPTED */
					/* pass */
				}
			}
		}

		/* PICK UP THE STRAGGLERS */
		if ($mysql_mod_openopc_EXPORT_ME_PLEASE == 1) {
			if ($mysql_query_FIRST_RUN == 1) {
				$mysql_query_FIRST_RUN = 0;
			} else {
				/* PUSH MARKUP INTO REPORT */
				model_CHECKWEIGHER_push_to_report_0();
			}
		} else {
			/* pass */
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- OPTION FULFILLMENT */
		$custom_array_of_option_names="<OPTION VALUE='NO'>".$multilang_STATIC_NO."<OPTION VALUE='YES'>".$multilang_STATIC_YES;
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_CHECKWEIGHERMODEL_57,$CHECKWEIGHERMODEL_FORMFILL_NAME,$multilang_CHECKWEIGHERMODEL_80,$custom_array_of_option_names)."
									</TD>
								</TR>
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
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
	/* OPTION FULFILLMENT */
	$custom_array_of_option_names="<OPTION VALUE='NO'>".$multilang_STATIC_NO."<OPTION VALUE='YES'>".$multilang_STATIC_YES;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_CHECKWEIGHERMODEL_57,$CHECKWEIGHERMODEL_FORMFILL_NAME,"NULL",$multilang_STATIC_REPORT_TIME,"NULL","NULL",$multilang_CHECKWEIGHERMODEL_80,$custom_array_of_option_names);
}
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY;
$apache_REPORTL6 = "";
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
