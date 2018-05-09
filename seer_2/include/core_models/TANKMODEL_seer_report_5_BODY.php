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
MACHINE REPORT 5 BODY (INCLUDED TO ALL MACHINEMODELS)
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
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_11."</B><BR>
								<I>".$MACHINEMODEL_SUBPAGETITLE."</I><BR>
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
	core_user_date_time_range_input_type_1($multilang_TANKMODEL_75);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* ZERO OUT CSV FOR EXPORT */
		/* -- MACHINE, ITEM, STARTTIME, ENDTIME, DURATION READABLE, DURATION UNIXTIME */
		model_COMMON_export_csv_report_3_zero();

		/* BUILD A CONTAINER FOR FAULTS */
		/* -- FORM IS... (note: the following is a 'readable' example, and does not represent proper code) */
		/* -- -- $fault_container[$machine_faultindex_container]] = fault */
		/* -- -- $endtime_container[$machine_faultindex_container] = endtime */
		/* -- -- $starttime_container[$machine_faultindex_container] = starttime */
		/* -- -- $duration_container_human_readable[$machine_faultindex_container] = duration in h_m_s */
		/* -- -- $duration_container_unixtime[$machine_faultindex_container] = duration in seconds */
		/* -- -- $machine_faultindex_container = count */

		/* ZERO OUT THE CONTAINER */
		$machine_faultindex_container = 0;
		$machine_faultindex_container_POSITION_OF_LAST_EVENT = 0;
		$apache_ZERO_FAULT_DETECTED = 0;

		/* PULL IN DATA FOR TANK STATE */
		/* -- QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, STATE";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (SILONAME = '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		/* -- ADD TO EVENT CONTAINER */
		$apache_ZERO_FAULT_DETECTED = model_COMMON_event_container_fill_report_4($apache_ZERO_FAULT_DETECTED,$mysql_ENTRY_MACHINENAME,$mysql_mod_openopc_query_result,"STATE",$TANKMODEL_STATE,"0");

		/* PULL IN DATA FOR TANK FAULTS */
		$mysql_mod_openopc_query = "DATESTAMP, ALARM";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (SILONAME = '".$mysql_ENTRY_MACHINENAME."') AND (ALARM > '0') ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		/* -- ADD TO EVENT CONTAINER */
		$apache_ZERO_FAULT_DETECTED = model_COMMON_event_container_fill_report_4($apache_ZERO_FAULT_DETECTED,$mysql_ENTRY_MACHINENAME,$mysql_mod_openopc_query_result,"ALARM",$TANKMODEL_ALARM,"2");

		/* SO AFTER ALL THIS, DO WE EVEN HAVE ANY FAULTS TO DISPLAY ?!?! */
		if ( $apache_ZERO_FAULT_DETECTED == 0 ) {
			/* PROCEED TO A ZEROFAULT OUTPUT */
			$apache_ZERO_FAULT_OUTPUT = "YES";
			$apache_REPORT_RECORDENTRY = core_zero_fault_output();
			$apache_REPORT_RECORDENTRY_POPUP_CANVAS = $apache_REPORT_RECORDENTRY;
		} else {
			/* PROCEED TO A REPORT OUTPUT */
			$apache_ZERO_FAULT_OUTPUT = "NO";
			/* -- GANT HEADER */
			list($apache_REPORT_GANTT_HEADER,$apache_REPORT_GANTT_CHART_LENGTH_UNIXTIME) = ganttHeader($mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP);
			list($apache_REPORT_GANTT_HEADER_POPUP_CANVAS,$apache_REPORT_GANTT_CHART_LENGTH_UNIXTIME) = ganttHeader($mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, "POPUP");
			/* -- ADD GANTT BODY */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_GANTT_HEADER.$apache_REPORT_RECORDENTRY;
			$apache_REPORT_RECORDENTRY_POPUP_CANVAS = $apache_REPORT_GANTT_HEADER_POPUP_CANVAS.$apache_REPORT_RECORDENTRY_POPUP_CANVAS;
			/* -- GANT FOOTER */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.ganttEnd();
			$apache_REPORT_RECORDENTRY_POPUP_CANVAS = $apache_REPORT_RECORDENTRY_POPUP_CANVAS.ganttEnd();
		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* ---------------------------- */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_TOPPLATE_EXTENSION = core_report_ticket_top_plate_extension_popup_canvas($seer_LANGUAGE,$mysql_ENTRY_MACHINENAME."<BR>".$mysql_query_START_DATESTAMP." -- ".$mysql_query_END_DATESTAMP,$apache_REPORT_RECORDENTRY_POPUP_CANVAS,$seer_GANTT_CHART_TABLE_PIXELS_POPUP_CANVAS);
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='900' ALIGN='CENTER'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_TANKMODEL_13,$TANKMODEL_FORMFILL_NAME)."
									</TD>
								</TR>
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_TOPPLATE_EXTENSION."
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_TANKMODEL_13,$TANKMODEL_FORMFILL_NAME,"NULL",$multilang_STATIC_REPORT_TIME);
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
