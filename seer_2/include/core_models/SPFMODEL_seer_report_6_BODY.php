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
SPF REPORT 6 BODY (INCLUDED TO ALL SPFMODELS)
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
								<B>".$multilang_SPFMODEL_0.": ".$multilang_SPFMODEL_11." [".$multilang_STATIC_REGULATORY."]</B><BR>
								<I>".$SPFMODEL_SUBPAGETITLE."</I><BR>
								<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* CHECK IF ANY MACHINE IS SELF-CLEANING */
/* -- REFERENCE THE LOCAL OPTIONS FILE FOR THIS MODEL */
/* ------------------------------------------------------------------ */
model_SPF_check_for_self_cleaning_machines_in_model($SPFMODEL_NAME,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_COUNT_ADJUSTED);

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_SPFMODEL_77);

	/* IDENTIFY MACHINE TYPE, CLEANING METHOD */
	list($MACHINENAME_BY_INTEGER,$MACHINE_TYPE,$MACHINE_CLEANED_BY) = model_SPF_idenfity_machine_type_and_cleaning_method("YES",$mysql_ENTRY_MACHINENAME,$SPFMODEL_NAME,$SPFMODEL_COUNT_ADJUSTED,$SPFMODEL_MACHINE_TYPE_PREREGISTERED,$SPFMODEL_CIP_BY);

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* PREPARE THE QUERY */
		$mysql_mod_openopc_query = "DATESTAMP, CIP_STEP, CIP_TEMP, CERTIFIED, CERTIFIEDBY, CERTIFIEDCOMMENT";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$SPFMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (MACHINE_NAME LIKE '".$mysql_ENTRY_MACHINENAME."') AND (CIP_STEP ".$SPFMODEL_CIP_STEP_REALSTEPS.") ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* SET SOME INITIAL VALUES FOR REPORT */
		$mysql_query_index = 1;
		$MODEL_CERTIFIEDCOMMENT_COUNT = 0;
		$MODEL_CERTIFIEDCOMMENT_INDEX = 0;
		$MODEL_CERTIFIEDSIG_COUNT = 0;
		$MODEL_CERTIFIEDSIG_INDEX = 0;
		$apache_SWITCH_ROW_COLOR = 0;

		/* ZERO OUT CSV FOR EXPORT */
		model_SPF_export_csv_report_5_zero();

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($SPFMODEL_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
		$mysql_rows_to_display_in_window = $SPFMODEL_ROWS_IN_WINDOWS;

		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			if ( $mysql_query_index == 1 ) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_CIP_STEP = $mysql_mod_openopc_query_row['CIP_STEP'];
				$mysql_mod_openopc_WORKING_CIP_TEMP = $mysql_mod_openopc_query_row['CIP_TEMP'];
				$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
				$mysql_mod_openopc_WORKING_CERTIFIEDBY = $mysql_mod_openopc_query_row['CERTIFIEDBY'];
				$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT = $mysql_mod_openopc_query_row['CERTIFIEDCOMMENT'];
				
				/* SAVE AND INDEX SIGNATURES */
				list($MODEL_CERTIFIEDUSERREALNAME,$MODEL_CERTIFIEDSIG_COUNT,$MODEL_CERTIFIEDSIG_INDEX,$MODEL_CERTIFIEDSIG_LABEL,$MODEL_CERTIFIEDSIG_LABEL_THISONE,$MODEL_CERTIFIEDSIG) = core_certification_index_digital_signature($mysql_mod_openopc_WORKING_CERTIFIEDBY,$mysql_mod_openopc_WORKING_CERTIFIED,$MODEL_CERTIFIEDSIG_COUNT,$MODEL_CERTIFIEDSIG_INDEX,$MODEL_CERTIFIEDSIG_LABEL,$MODEL_CERTIFIEDSIG);

				/* SAVE AND INDEX COMMENTS */
				list($MODEL_CERTIFIEDCOMMENT_COUNT,$MODEL_CERTIFIEDCOMMENT_INDEX,$MODEL_CERTIFIEDCOMMENT,$MODEL_CERTIFIEDCOMMENT_LABEL,$MODEL_CERTIFIEDCOMMENT_LABEL_THISONE) = core_certification_index_digital_comment($mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT,$MODEL_CERTIFIEDCOMMENT_COUNT,$MODEL_CERTIFIEDCOMMENT_INDEX,$MODEL_CERTIFIEDCOMMENT,$MODEL_CERTIFIEDCOMMENT_LABEL);

				/* HORIZONTAL BAR INDICATOR FOR TEMPERATURE */
				$MODEL_WORKING_BAR_TEMPERATURE = core_display_horizontal_bar ("325",$mysql_mod_openopc_WORKING_CIP_TEMP,$SPFMODEL_RANGE_TEMPERATURE_LOW,$SPFMODEL_RANGE_TEMPERATURE_HIGH);

				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$MODEL_WORKING_CIP_STEP_FRIENDLY = $SPFMODEL_CIP_STEP[$mysql_mod_openopc_WORKING_CIP_STEP];

				/* ALL RECORDS REQUIRE CERTIFICATION - THIS IS A CIP SYSTEM */
				if ( $mysql_mod_openopc_WORKING_CERTIFIED != '') {
					$SPFMODEL_WORKING_STEP_CELLBACKGROUND = "BGCOLOR='#CCFF66'";
					/* record required to be certified and is certified */
				} else {
					$SPFMODEL_WORKING_STEP_CELLBACKGROUND = "BGCOLOR='#FF8866'";
					/* record requried to be certified and is NOT certified */
				}
	
				/* FLIP FLOP ROW COLOR */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

				/* CYCLE THROUGH THE DATABASE */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_DATESTAMP."
									</TD>
									<TD ALIGN='CENTER' ".$SPFMODEL_WORKING_STEP_CELLBACKGROUND.">
										".$MODEL_WORKING_CIP_STEP_FRIENDLY."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_CIP_TEMP."
									</TD>
									<TD CLASS='hmicellborder5' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$MODEL_WORKING_BAR_TEMPERATURE." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
									<TD ALIGN='CENTER'>
										".$SPFMODEL_CERTIFIEDSIG_LABEL_THISONE."
									</TD>
									<TD ALIGN='CENTER'>
										".$SPFMODEL_CERTIFIEDCOMMENT_LABEL_THISONE."
									</TD>
								</TR>
								";

				/* BUILD CSV FOR EXPORT */
				model_SPF_export_csv_report_5_build();

			} else {	
				/* pass */
			}

			/* INDEX */
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
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP,$multilang_STATIC_CERTIFIED_HIGHLIGHT);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='170'>
									</TD>
									<TD WIDTH='175'>
									</TD>
									<TD WIDTH='120'>
									</TD>
									<TD WIDTH='325'>
									</TD>
									<TD WIDTH='55'>
									</TD>
									<TD WIDTH='55'>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><U>".$multilang_STATIC_DATESTAMP_CAPS."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_67."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_SPFMODEL_68."<BR>
										[".$SPFMODEL_UM_TEMPERATURE."]</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_RANGE.":</U></B><BR>
										".$SPFMODEL_RANGE_TEMPERATURE_LOW." [".$SPFMODEL_UM_TEMPERATURE."] ...through... ".$SPFMODEL_RANGE_TEMPERATURE_HIGH." [".$SPFMODEL_UM_TEMPERATURE."]
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_CERTIFIED."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_STATIC_COMMENT."</U></B>
									</TD>
								</TR>	
								";
		/* -- POST THE CERTIFICATION SIGNATURES */
		core_display_digital_sigatures_type_1($MODEL_CERTIFIEDSIG_COUNT,$MODEL_CERTIFIEDSIG,$MODEL_CERTIFIEDCOMMENT_COUNT,$MODEL_CERTIFIEDCOMMENT);
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='6' ALIGN='CENTER'>
										".$apache_REPORT_CERTIFICATION_SIGNATURES."
									</TD>
								</TR>
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='6'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME)."
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_SPFMODEL_58,$SPFMODEL_FORMFILL_NAME);
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
