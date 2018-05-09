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
BULK MODEL REPORT 1 BODY (INCLUDED TO ALL BULKMODELS)
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
								<B>".$multilang_BULKMODEL_0.": ".$multilang_BULKMODEL_31."</B><BR>
								<I>".$BULKMODEL_SUBPAGETITLE."</I><BR>
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

		/* RESULTS ARRAY */
		/* $results[machine id number] = total use over the time period */

		/* ZERO OUT RESULTS ARRAY */
		$results_index = 0;
		while ($results_index <= $BULKMODEL_COUNT_ADJUSTED) {
			$results[$results_index] = 0;
			$results_index = $results_index + 1;
		}

		/* ZERO OUT CSV FOR EXPORT */
		model_BULK_export_csv_report_2_zero();

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		$apache_SWITCH_ROW_COLOR = 0;
		$APPRECIABLE_SCALE_FACTOR_USE = 1 - ($BULKMODEL_APPRECIABLE_CHANGE_PERCENT / 100);
		$APPRECIABLE_SCALE_FACTOR_USE_ERROR = 1 - ($BULKMODEL_APPRECIABLE_CHANGE_ERROR / 100);
		$APPRECIABLE_SCALE_FACTOR_RESTOCK = 1 + ($BULKMODEL_APPRECIABLE_CHANGE_PERCENT_RESTOCK / 100);

		/* QUERY EACH ITEM */
		$results_index = 0;
		while ($results_index <= $BULKMODEL_COUNT_ADJUSTED) {

			/* RESET INDIVIDUAL ITEM QUERY KEYS */
			$mysql_ENTRY_MACHINENAME = $BULKMODEL_NAME[$results_index];
			$mysql_ENTRY_START_TOTAL = 0;
			$mysql_ENTRY_END_TOTAL = 0;
			$mysql_ENTRY_FINAL_TOTAL = 0;
			$mysql_ENTRY_INTERIM_TOTAL = 0;
			$mysql_ENTRY_FIRST_RUN = 1;
			$mysql_ENTRY_USE_POSSIBLE = 0;
			$mysql_ENTRY_RESTOCK_POSSIBLE = 0;

			/* EXECUTE QUERY */
			$mysql_mod_openopc_query = "INVENTORY_QUANTITY";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$BULKMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (BULKNAME = '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, BULKNAME ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* PROCESS QUERY */
			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY = $mysql_mod_openopc_query_row['INVENTORY_QUANTITY'];
			
				/* REFERENCE POINT FOR START OF OUR TOTALIZATION */
				if ($mysql_ENTRY_FIRST_RUN == 1) {
					$mysql_ENTRY_START_TOTAL = $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;
					$mysql_ENTRY_END_TOTAL = $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;
					$mysql_ENTRY_FIRST_RUN = 0;
				} else {
					/* pass */
				}

				/* DEFINE WHAT AN APPRECIABLE CHANGE IS */
				$mysql_APPRECIABLE_CHAGE_USE = $mysql_ENTRY_END_TOTAL * $APPRECIABLE_SCALE_FACTOR_USE;
				$mysql_APPRECIABLE_CHANGE_USE_ERROR = $mysql_ENTRY_END_TOTAL * $APPRECIABLE_SCALE_FACTOR_USE_ERROR;
				$mysql_APPRECIABLE_CHANGE_RESTOCK = $mysql_ENTRY_END_TOTAL * $APPRECIABLE_SCALE_FACTOR_RESTOCK;

				/* TRACK THE DROP IN ITEM INVENTORY */
				if ( ($mysql_mod_openopc_WORKING_INVENTORY_QUANTITY < $mysql_APPRECIABLE_CHAGE_USE) && ($mysql_mod_openopc_WORKING_INVENTORY_QUANTITY > $mysql_APPRECIABLE_CHANGE_USE_ERROR) ){
					$mysql_ENTRY_USE_POSSIBLE = $mysql_ENTRY_USE_POSSIBLE + 1;
					$mysql_ENTRY_RESTOCK_POSSIBLE = 0;
				} else {
					if ($mysql_mod_openopc_WORKING_INVENTORY_QUANTITY > $mysql_APPRECIABLE_CHANGE_RESTOCK) {
						$mysql_ENTRY_RESTOCK_POSSIBLE = $mysql_ENTRY_RESTOCK_POSSIBLE + 1;
						$mysql_ENTRY_USE_POSSIBLE = 0;
					} else {
						/* pass */
					}
				}

				/* ACCOUNT FOR CONFIRMED ITEM USE */
				if (($mysql_ENTRY_USE_POSSIBLE == $BULKMODEL_DEBOUNCE_CYCLES_REQUIRED) && ($mysql_mod_openopc_WORKING_INVENTORY_QUANTITY > $mysql_APPRECIABLE_CHANGE_USE_ERROR) ){
					$mysql_ENTRY_END_TOTAL = $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;
					$mysql_ENTRY_INTERIM_TOTAL = $mysql_ENTRY_START_TOTAL - $mysql_ENTRY_END_TOTAL;
					$mysql_ENTRY_USE_POSSIBLE = 0;
				} else {
					/* pass */
				}

				/* ACCOUNT FOR CONFIRMED ITEM RESTOCKING */
				if ($mysql_ENTRY_RESTOCK_POSSIBLE == $BULKMODEL_DEBOUNCE_CYCLES_REQUIRED) {
					$mysql_ENTRY_FINAL_TOTAL = $mysql_ENTRY_FINAL_TOTAL + $mysql_ENTRY_INTERIM_TOTAL;
					$mysql_ENTRY_START_TOTAL = $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;
					$mysql_ENTRY_END_TOTAL = $mysql_mod_openopc_WORKING_INVENTORY_QUANTITY;
					$mysql_ENTRY_INTERIM_TOTAL = 0;
					$mysql_ENTRY_RESTOCK_POSSIBLE = 0;
				} else {
					/* pass */
				}

			}

			/* TOTALIZE FINAL */
			$mysql_ENTRY_FINAL_TOTAL = $mysql_ENTRY_FINAL_TOTAL + $mysql_ENTRY_INTERIM_TOTAL;

			/* FLIP FLOP ROW COLOR */
			$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='250' ALIGN='CENTER'>
										".$mysql_ENTRY_MACHINENAME."
									</TD>
									<TD WIDTH='250' ALIGN='CENTER'>
										".$mysql_ENTRY_FINAL_TOTAL."
									</TD>
									<TD WIDTH='200' ALIGN='LEFT'>
										<BR>
									</TD>
								</TR>	
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>		
								";

			/* EXPORT TO CSV */
			/* -- BULKNAME, DATESTAMP_START, DATESTAMP_END, USE */
			model_BULK_export_csv_report_2_build();

			$results_index = $results_index + 1;
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$multilang_BULKMODEL_34);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='250'>
									</TD>
									<TD WIDTH='250'>
									</TD>
									<TD WIDTH='200'>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_BULKMODEL_13." </U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_BULKMODEL_33." [".$BULKMODEL_UM_THISMODEL."] </U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<BR>
									</TD>
								</TR>			
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>			
								";
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_STATIC_SELECT_FROM_DROPDOWN);	
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
