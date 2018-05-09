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
								<B>".$multilang_BULKMODEL_0.": ".$multilang_BULKMODEL_30."</B><BR>
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
	core_user_date_time_range_input_type_1($multilang_BULKMODEL_29);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, BULKNAME, INVENTORY_PERCENT, INVENTORY_QUANTITY";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$BULKMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (BULKNAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, BULKNAME ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* BUILD TICKET DATA */
		
		/* ZERO OUT CSV FOR EXPORT */
		model_BULK_export_csv_report_1_zero();

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($BULKMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		$mysql_query_index = 1;
		$apache_SWITCH_ROW_COLOR = 0;

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			if ( $mysql_query_index == 1 ) { 
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_BULKNAME = $mysql_mod_openopc_query_row['BULKNAME'];
				$mysql_mod_openopc_WORKING_INVENTORY_PERCENT = round($mysql_mod_openopc_query_row['INVENTORY_PERCENT']);
				$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY = $mysql_mod_openopc_query_row['INVENTORY_QUANTITY'];
	
				/* HORIZONTAL BAR INDICATOR FOR INVENTORY */
				$BULKMODEL_WORKING_BAR_FILL = core_display_horizontal_bar("200",$mysql_mod_openopc_WORKING_INVENTORY_PERCENT,"0","100");	
	
				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* BUILD CSV FOR EXPORT */
				model_BULK_export_csv_report_1_build();

				/* ADD TO THE REPORT BODY */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										".$mysql_mod_openopc_WORKING_INVENTORY_PERCENT."
									</TD>
									<TD CLASS='hmicellborder2' COLSPAN='2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$BULKMODEL_WORKING_BAR_FILL." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER' COLSPAN='2'>
										".$mysql_mod_openopc_WORKING_INVENTORY_QUANTITY."
									</TD>
								</TR>
								";
			} else {	
				/* pass */
			}

			if ( $mysql_query_index == $mysql_query_display_every_x_record ) {
				$mysql_query_index = 1;
			} else {
				$mysql_query_index =  $mysql_query_index + 1;
			}
	
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='135'>
									</TD>
									<TD WIDTH='165'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='50'>
									</TD>
									<TD WIDTH='75'>
									</TD>
									<TD WIDTH='75'>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_BULKMODEL_26."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B><U>".$multilang_BULKMODEL_25." </U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U> [ % ]</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										<BR>
									</TD>
									<TD WIDTH='50'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B><U>".$multilang_BULKMODEL_25." </U></B>
									</TD>
									<TD ALIGN='LEFT'>
										<B><U> [ ".$BULKMODEL_UM_THISMODEL." ]</U></B>
									</TD>
								</TR>			
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_BULKMODEL_13,$BULKMODEL_FORMFILL_NAME)."
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_BULKMODEL_8,$BULKMODEL_FORMFILL_NAME);	
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
