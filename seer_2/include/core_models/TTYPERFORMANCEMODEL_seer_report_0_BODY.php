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
TTYPERFORMANCEMODEL REPORT 0 BODY 
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
								<B>".$multilang_TTYPERFORMANCEMODEL_0.": ".$multilang_TTYPERFORMANCEMODEL_1."</B><BR>
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
	core_user_date_time_range_input_type_1("ENTIRE_MODEL_LOCAL_INSTANCE");

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		$apache_REPORT_RECORDENTRY = "";
		$apache_SWITCH_ROW_COLOR = 0;

		/* ZERO OUT CSV FOR EXPORT */
		model_TTYPERFORMANCE_export_csv_report_0_zero();

		/* CALL SUPPLEMENT AND DECLARE WHAT WE INTEND TO USE IT FOR */
		/* ------------------------------------------------------------------ */
		$apache_BODY_SUPPLEMENT_USE = "REPORT_0";
		require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/include/core_models/TTYPERFORMANCEMODEL_seer_hmi_0_BODY_SUPPLEMENT.php');

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$mysql_ENTRY_MACHINENAME_TO_POST_AT_TOP = $mysql_ENTRY_MACHINENAME." [".$multilang_TTYPERFORMANCEMODEL_11."]";
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME_TO_POST_AT_TOP,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
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
									<TD VALIGN='TOP' COLSPAN='9'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											<B>[".$multilang_TTYPERFORMANCEMODEL_17."]: ".$multilang_TTYPERFORMANCEMODEL_20."</B>...
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3' ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_TTYPERFORMANCEMODEL_13."</U></B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_TTYPERFORMANCEMODEL_7." / ".$multilang_TTYPERFORMANCEMODEL_14."</U></B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_TTYPERFORMANCEMODEL_8."</U></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1' ".$apache_device_priority_included_color_setting.">
										<B>".$multilang_TTYPERFORMANCEMODEL_18."</B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER'>
										<B>".$mysql_mod_openopc_BAD_DATA_COUNT_INCLUDED_DEVICES." / ".$mysql_mod_openopc_TOTAL_DATA_COUNT_INCLUDED_DEVICES."</B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER'>
										<B>".varcharTOnumeric2((100 - (100 * ($mysql_mod_openopc_BAD_DATA_COUNT_INCLUDED_DEVICES / $mysql_mod_openopc_TOTAL_DATA_COUNT_INCLUDED_DEVICES))), 2)." &#37</B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1' ".$apache_device_priority_excluded_color_setting.">
										<B>".$multilang_TTYPERFORMANCEMODEL_19."</B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER'>
										<B>".$mysql_mod_openopc_BAD_DATA_COUNT_EXCLUDED_DEVICES." / ".$mysql_mod_openopc_TOTAL_DATA_COUNT_EXCLUDED_DEVICES."</B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER'>
										<B>".varcharTOnumeric2((100 - (100 * ($mysql_mod_openopc_BAD_DATA_COUNT_EXCLUDED_DEVICES / $mysql_mod_openopc_TOTAL_DATA_COUNT_EXCLUDED_DEVICES))), 2)." &#37</B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = "
								<TR>
									<TD VALIGN='TOP' COLSPAN='9'>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											<B>[".$multilang_TTYPERFORMANCEMODEL_15."]: ".$multilang_TTYPERFORMANCEMODEL_16."</B>...
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3' ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_TTYPERFORMANCEMODEL_13."</U></B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_TTYPERFORMANCEMODEL_7." / ".$multilang_TTYPERFORMANCEMODEL_14."</U></B>
									</TD>
									<TD COLSPAN='3' ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_TTYPERFORMANCEMODEL_8."</U></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								".$apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<BR>
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
	/* CALL TYPE 1 PROMPT FOR ENTIRE_MODEL_LOCAL_INSTANCE */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET","ENTIRE_MODEL_LOCAL_INSTANCE","NULL",$multilang_TTYPERFORMANCEMODEL_10,$multilang_STATIC_REPORT_TIME);
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
