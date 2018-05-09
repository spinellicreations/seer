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
TTYPERFORMANCEMODEL REPORT 1 BODY 
	(INCLUDED TO ALL TTYPERFORMANCE MODELS)
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
								<B>".$multilang_TTYPERFORMANCEMODEL_0.": ".$multilang_TTYPERFORMANCEMODEL_2."</B><BR>
								<I>".$TTYPERFORMANCEMODEL_SUBPAGETITLE."</I><BR>
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
	core_user_date_time_range_input_type_1($multilang_TTYPERFORMANCEMODEL_22);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		$apache_REPORT_RECORDENTRY = "";
		$apache_SWITCH_ROW_COLOR = 0;

		/* ZERO OUT CSV FOR EXPORT */
		model_TTYPERFORMANCE_export_csv_report_1_zero();

		/* RUN REPORT */
		/* ---------- */

		/* CHECK FOR ENTRIES IN SNAPSHOT TIME */
		$mysql_mod_openopc_query = "DATESTAMP";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TTYPERFORMANCEMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINENAME LIKE '".$mysql_ENTRY_MACHINENAME."') ) ORDER BY DATESTAMP DESC LIMIT 1";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		if ($mysql_mod_openopc_query_result_rows > 0) {
			$mysql_mod_openopc_query2 = "DATESTAMP, TTY";
			$mysql_mod_openopc_query2 = "SELECT ".$mysql_mod_openopc_query2." FROM ".$TTYPERFORMANCEMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINENAME LIKE '".$mysql_ENTRY_MACHINENAME."') ) ORDER BY DATESTAMP DESC LIMIT ".$TTYPERFORMANCEMODEL_ROWS_IN_WINDOWS_LARGE;
			list($mysql_mod_openopc_query_result2,$mysql_mod_openopc_query_result_rows2) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query2);
			$apache_items_per_row = 2;
			$apache_item_active_in_row = 0;
			$apache_item_active_in_query = 0;
			$apache_SWITCH_ROW_COLOR = 0;
			while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result2)) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_TTY = sanitizeRANDOMcontent($mysql_mod_openopc_query_row['TTY'], $multilang_STATIC_NONE, 'STRICT');
				model_TTYPERFORMANCE_export_csv_report_1_build();

				# INDEX ACTIVE ITEM COUNT
				$apache_item_active_in_row = $apache_item_active_in_row + 1;
				$apache_item_active_in_query = $apache_item_active_in_query + 1;

				# -- FIRST ITEM IN A ROW
				if ($apache_item_active_in_row == '1') {
					$apache_REPORT_ENTRY_BGCOLOR_USE = core_row_color_flip_flop();
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ENTRY_BGCOLOR_USE.">
									<TD>
										<BR>
									</TD>
									";
				} else {
					/* pass */
				}

				# -- GENERAL DISPLAY FOR ALL ITEMS IN ANY ROW
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD ALIGN='CENTER'>
										<B>[ ".$apache_item_active_in_query." ]</B><BR>
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='LEFT'>
										<I>".$mysql_mod_openopc_WORKING_TTY."</I>
									</TD>
									";

				# -- LAST ITEM IN A ROW
				if ($apache_item_active_in_row == $apache_items_per_row) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								</TR>
								";
					$apache_item_active_in_row = 0;
				} else {
					# -- LAST ITEM FOR A DEVICE IN GIVEN TIME PERIOD AND NOT LAST IN ROW
					if ($apache_item_active_in_query == $mysql_mod_openopc_query_result_rows2) {
						$apache_FILLER_COLSPAN = 4 * ($apache_items_per_row - $apache_item_active_in_row);
						$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='".$apache_FILLER_COLSPAN."'>
										<BR>
									</TD>
								</TR>
								";
					} else {
						/* pass */
					}
				}
				if ($apache_item_active_in_query == $mysql_mod_openopc_query_result_rows2) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
			}

		} else {
			/* DEVICE HAS NO ENTRIES REPORTED DURING SNAPSHOT TIME */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='7' ALIGN='CENTER'>
										".$multilang_TTYPERFORMANCEMODEL_12."
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
		}






		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
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
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_DATESTAMP."<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_ITEM."<BR>
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_DATESTAMP."<BR>
									</TD>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_ITEM."<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
									</TD>
								</TR>
								";
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_TTYPERFORMANCEMODEL_13,$TTYPERFORMANCEMODEL_FORMFILL_NAME)."
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
	/* CALL TYPE 1 PROMPT */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_TTYPERFORMANCEMODEL_13,$TTYPERFORMANCEMODEL_FORMFILL_NAME,$multilang_TTYPERFORMANCEMODEL_21,$multilang_STATIC_REPORT_TIME);
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
