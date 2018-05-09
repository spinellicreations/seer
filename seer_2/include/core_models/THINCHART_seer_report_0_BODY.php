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
THINCHART REPORT 0 BODY (INCLUDED TO ALL THINCHARTS)
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
								<B>".$multilang_THINCHART_0.": ".$multilang_THINCHART_4."</B><BR>
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

/* WORKAROUND TO ALLOW FULL MODEL REPORTS */
/* ------------------------------------------------------------------ */
if ($THINCHART_ALLOW_USER_SELECT_FULL_MODEL == 'YES') {
	$THINCHART_FORMFILL_NAME = "<OPTION VALUE='FULL_MODEL'>".$multilang_THINCHART_13.$THINCHART_FORMFILL_NAME;
} else {
	/* pass */
}

/* PEN COLOR DETERMINATION */
/* ------------------------------------------------------------------ */
if ($THINCHART_PEN1_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN1_COLOR = $THINCHART_ADVANCED_OP_PEN1_COLOR;
} else {
	$THINCHART_UTILIZED_PEN1_COLOR = $THINCHART_PEN1_COLOR;
}
if ($THINCHART_PEN2_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN2_COLOR = $THINCHART_ADVANCED_OP_PEN2_COLOR;
} else {
	$THINCHART_UTILIZED_PEN2_COLOR = $THINCHART_PEN2_COLOR;
}
if ($THINCHART_PEN3_COLOR == 'STANDARD') {
	$THINCHART_UTILIZED_PEN3_COLOR = $THINCHART_ADVANCED_OP_PEN3_COLOR;
} else {
	$THINCHART_UTILIZED_PEN3_COLOR = $THINCHART_PEN3_COLOR;
}

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* WORKAROUND TO ALLOW FULL MODEL REPORTS */
	$first_run_full_model_report = 1;
	$last_run_full_model_report = 0;
	$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "";

	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_1($multilang_THINCHART_5);

	/* FULL MODEL OR SINGLE */
	if ($mysql_ENTRY_MACHINENAME == 'FULL_MODEL') {
		/* -- FULL MODEL */
		$full_model_report_count = $THINCHART_COUNT;
		$full_model_report_mode = "YES";
	} else {
		/* -- SINGLE MACHINE */
		$full_model_report_count = 1;
		$full_model_report_mode = "NO";
	}

	$actual_model_report_count = 0;
	while ( ($actual_model_report_count < $full_model_report_count) && ($seer_HMIACTION_FAULT == 0) ) {

		/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
		if ( $seer_HMIACTION_FAULT == 0) {
			if ($full_model_report_mode == 'YES') {
				$mysql_ENTRY_MACHINENAME = $THINCHART_NAME[$actual_model_report_count];
				if ( ($actual_model_report_count + 1) == $THINCHART_COUNT ) {
					$last_run_full_model_report = 1;
				} else {
					/* pass */
				}
				$first_notification_full_model_report = 1;
			} else {
				$last_run_full_model_report = 1;
			}
			/* IDENTIFY CHART */
			$mysql_query_name_id = model_THINCHART_identify_chart($mysql_ENTRY_MACHINENAME,"YES");
			$first_notification_full_model_report = 1;
			$apache_REPORT_RECORDENTRY_FULL_REPORT = "";
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_STATIC_UNKNOWN." [1]";
		}

		if ( $seer_HMIACTION_FAULT == 0 ) {
			/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
			model_THINCHART_chart_parameters($mysql_query_name_id);

			/* PREPARE THE QUERY */
			$mysql_mod_openopc_query = "*";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$THINCHART_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."%' AND '".$mysql_query_END_DATESTAMP."%') AND (CHARTNAME LIKE '".$mysql_ENTRY_MACHINENAME."') ORDER BY DATESTAMP ASC, CHARTNAME ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* SET SOME INITIAL VALUES FOR REPORT */
			if ($first_run_full_model_report == 1) {
				$MODEL_CERTIFIEDCOMMENT_COUNT = 0;
				$MODEL_CERTIFIEDCOMMENT_INDEX = 0;
				$MODEL_CERTIFIEDSIG_COUNT = 0;
				$MODEL_CERTIFIEDSIG_INDEX = 0;
				$apache_SWITCH_ROW_COLOR = 0;
				$mysql_mod_openopc_WORKING_NOTIFICATION_HOLDING = 8675309;
			} else {
				/* pass */
			} 

			/* ZERO OUT CSV FOR EXPORT */
			model_THINCHART_export_csv_report_0_zero();

			/* DISPLAY ONE RECORD EVERY X RECORDS */
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($THINCHART_ROWS_IN_WINDOWS,$mysql_mod_openopc_num_rows);
			$mysql_rows_to_display_in_window = $THINCHART_ROWS_IN_WINDOWS;

			$mysql_query_index = 1;
			while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
				if ( $mysql_query_index == 1 ) { 
					$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
					$mysql_mod_openopc_WORKING_CHARTNAME = $mysql_mod_openopc_query_row['CHARTNAME'];
					$mysql_mod_openopc_WORKING_PEN1 = $mysql_mod_openopc_query_row['PEN1'];
					$mysql_mod_openopc_WORKING_PEN2 = $mysql_mod_openopc_query_row['PEN2'];
					$mysql_mod_openopc_WORKING_PEN3 = $mysql_mod_openopc_query_row['PEN3'];
					$mysql_mod_openopc_WORKING_EVENT = $mysql_mod_openopc_query_row['EVENT'];
					$mysql_mod_openopc_WORKING_CERTIFIED = $mysql_mod_openopc_query_row['CERTIFIED'];
					$mysql_mod_openopc_WORKING_CERTIFIEDBY = $mysql_mod_openopc_query_row['CERTIFIEDBY'];
					$mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT = $mysql_mod_openopc_query_row['CERTIFIEDCOMMENT'];
					if ($mysql_mod_openopc_WORKING_EVENT < 1) {
						$mysql_mod_openopc_WORKING_EVENT_FRIENDLYNAME = $multilang_STATIC_NONE;
						$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_OFF;
					} else {
						$mysql_mod_openopc_WORKING_EVENT_FRIENDLYNAME = $THINCHART_WORKING_EVENT_NAME;
						$THINCHART_WORKING_EVENT_BGCOLOR = $THINCHART_ADVANCED_OP_EVENT_COLOR_CODE_ON;
					}
					$mysql_mod_openopc_WORKING_NOTIFICATION = $mysql_mod_openopc_query_row['NOTIFICATION'];
					if ($mysql_mod_openopc_WORKING_NOTIFICATION == '') {
						$mysql_mod_openopc_WORKING_NOTIFICATION = 0;
					} else {
						/* pass */
					}
					$mysql_mod_openopc_WORKING_NOTIFICATION = $THINCHART_NOTIFICATION[$mysql_mod_openopc_WORKING_NOTIFICATION];
					
					/* SAVE AND INDEX SIGNATURES */
					list($MODEL_CERTIFIEDUSERREALNAME,$MODEL_CERTIFIEDSIG_COUNT,$MODEL_CERTIFIEDSIG_INDEX,$MODEL_CERTIFIEDSIG_LABEL,$MODEL_CERTIFIEDSIG_LABEL_THISONE,$MODEL_CERTIFIEDSIG) = core_certification_index_digital_signature($mysql_mod_openopc_WORKING_CERTIFIEDBY,$mysql_mod_openopc_WORKING_CERTIFIED,$MODEL_CERTIFIEDSIG_COUNT,$MODEL_CERTIFIEDSIG_INDEX,$MODEL_CERTIFIEDSIG_LABEL,$MODEL_CERTIFIEDSIG);

					/* SAVE AND INDEX COMMENTS */
					list($MODEL_CERTIFIEDCOMMENT_COUNT,$MODEL_CERTIFIEDCOMMENT_INDEX,$MODEL_CERTIFIEDCOMMENT,$MODEL_CERTIFIEDCOMMENT_LABEL,$MODEL_CERTIFIEDCOMMENT_LABEL_THISONE) = core_certification_index_digital_comment($mysql_mod_openopc_WORKING_CERTIFIEDCOMMENT,$MODEL_CERTIFIEDCOMMENT_COUNT,$MODEL_CERTIFIEDCOMMENT_INDEX,$MODEL_CERTIFIEDCOMMENT,$MODEL_CERTIFIEDCOMMENT_LABEL);

					/* HORIZONTAL BAR INDICATORS */
					$MODEL_WORKING_BAR_PEN1 = core_display_horizontal_bar ("165",$mysql_mod_openopc_WORKING_PEN1,$THINCHART_WORKING_PEN1_PENRANGE_LOW,$THINCHART_WORKING_PEN1_PENRANGE_HIGH);
					$MODEL_WORKING_BAR_PEN2 = core_display_horizontal_bar ("165",$mysql_mod_openopc_WORKING_PEN2,$THINCHART_WORKING_PEN2_PENRANGE_LOW,$THINCHART_WORKING_PEN2_PENRANGE_HIGH);
					$MODEL_WORKING_BAR_PEN3 = core_display_horizontal_bar ("165",$mysql_mod_openopc_WORKING_PEN3,$THINCHART_WORKING_PEN3_PENRANGE_LOW,$THINCHART_WORKING_PEN3_PENRANGE_HIGH);
		
					/* FLIP FLOP ROW COLOR */
					$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

					/* IF NOTIFICATION HAS CHANGED, POST IT */
					if ( ($mysql_mod_openopc_WORKING_NOTIFICATION == $mysql_mod_openopc_WORKING_NOTIFICATION_HOLDING) && ($first_notification_full_model_report == 0) ) {
						/* pass */
					} else {
						$apache_REPORT_RECORDENTRY_FULL_REPORT = $apache_REPORT_RECORDENTRY_FULL_REPORT."
									<TR CLASS='hmirowborder1_ALT_NOBORDER'>
										<TD COLSPAN='8' ALIGN='RIGHT' VALIGN='MIDDLE'>
											<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='RIGHT'>
												<B>".$multilang_STATIC_NOTE.":</B> <I>".$mysql_mod_openopc_WORKING_NOTIFICATION."</I>
											</P>
										</TD>
										<TD COLSPAN='2'>
											<BR>
										</TD>
									</TR>
									";
						/* UPDATE HOLDING VALUE */
						$mysql_mod_openopc_WORKING_NOTIFICATION_HOLDING = $mysql_mod_openopc_WORKING_NOTIFICATION;
						/* UPDATE FIRST NOTIFICATION FLAG */
						$first_notification_full_model_report = 0;
					}

					/* CYCLE THROUGH THE DATABASE */
					/* -- POST DATA FROM THIS ENTRY */
					$apache_REPORT_RECORDENTRY_FULL_REPORT = $apache_REPORT_RECORDENTRY_FULL_REPORT."
									<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
										<TD>
											".$mysql_mod_openopc_WORKING_DATESTAMP."
										</TD>
										<TD CLASS='hmicellborder1' ".$THINCHART_WORKING_EVENT_BGCOLOR.">
											<BR>
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_mod_openopc_WORKING_PEN1."
										</TD>
										<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
											<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN1_COLOR.".png' WIDTH=".$MODEL_WORKING_BAR_PEN1." HEIGHT=10 ALT='HORIZONTAL BAR'>
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_mod_openopc_WORKING_PEN2."
										</TD>
										<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
											<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN2_COLOR.".png' WIDTH=".$MODEL_WORKING_BAR_PEN2." HEIGHT=10 ALT='HORIZONTAL BAR'>
										</TD>
										<TD ALIGN='CENTER'>
											".$mysql_mod_openopc_WORKING_PEN3."
										</TD>
										<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
											<IMG SRC='./img/horizontal_bar_".$THINCHART_UTILIZED_PEN3_COLOR.".png' WIDTH=".$MODEL_WORKING_BAR_PEN3." HEIGHT=10 ALT='HORIZONTAL BAR'>
										</TD>
										<TD ALIGN='CENTER'>
											".$MODEL_CERTIFIEDSIG_LABEL_THISONE."
										</TD>
										<TD ALIGN='CENTER'>
											".$MODEL_CERTIFIEDCOMMENT_LABEL_THISONE."
										</TD>
									</TR>
									";
					/* -- BUILD CSV FOR EXPORT */
					model_THINCHART_export_csv_report_0_build();
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

			/* REPORT TOPPLATE AND ASSEMBLY */
			/* ---------------------------- */
			if ($last_run_full_model_report == 1) {
				if ($full_model_report_mode == 'YES') {
					$mysql_ENTRY_MACHINENAME = $multilang_THINCHART_13;
				} else {
					/* pass */
				}
				/* -- CLEAN UP CSV FOR EXPORT */
				core_export_csv_sanitize();
				/* -- BUILD THE TOP PLATE */
				$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
			} else {
				/* pass */
			}
			if ($full_model_report_mode == 'YES') {
				$apache_REPORT_RECORDENTRY_FULL_REPORT_CAP = "
									<TR>
										<TD COLSPAN='10'>
											<BR>
											<BR>
											<BR>
											<U><B>".$multilang_THINCHART_6.":</B></U> <I>".$THINCHART_NAME[$actual_model_report_count]."</I><BR>
											<BR>
										</TD>
									</TR>
									";
			} else {
				$apache_REPORT_RECORDENTRY_FULL_REPORT_CAP = "";
			}
			$apache_REPORT_RECORDENTRY_FULL_REPORT = $apache_REPORT_RECORDENTRY_FULL_REPORT_CAP."
									<TR>
										<TD COLSPAN='10'>
											<U><B>".$multilang_THINCHART_8.":</B></U> <I>".$THINCHART_WORKING_EVENT_NAME."</I><BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<B><U>".$multilang_STATIC_DATESTAMP_CAPS."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_THINCHART_9."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<BR>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN1_NAME.":</U></B><BR>
											".$THINCHART_WORKING_PEN1_PENRANGE_LOW." [".$THINCHART_WORKING_PEN1_UM."] ..... ".$THINCHART_WORKING_PEN1_PENRANGE_HIGH." [".$THINCHART_WORKING_PEN1_UM."]
										</TD>
										<TD ALIGN='CENTER'>
											<BR>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN2_NAME.":</U></B><BR>
											".$THINCHART_WORKING_PEN2_PENRANGE_LOW." [".$THINCHART_WORKING_PEN2_UM."] ..... ".$THINCHART_WORKING_PEN2_PENRANGE_HIGH." [".$THINCHART_WORKING_PEN2_UM."]
										</TD>
										<TD ALIGN='CENTER'>
											<BR>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$THINCHART_WORKING_PEN3_NAME.":</U></B><BR>
											".$THINCHART_WORKING_PEN3_PENRANGE_LOW." [".$THINCHART_WORKING_PEN3_UM."] ..... ".$THINCHART_WORKING_PEN3_PENRANGE_HIGH." [".$THINCHART_WORKING_PEN3_UM."]
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_STATIC_CERTIFIED."</U></B>
										</TD>
										<TD ALIGN='CENTER'>
											<B><U>".$multilang_STATIC_COMMENT."</U></B>
										</TD>
									</TR>						
									".$apache_REPORT_RECORDENTRY_FULL_REPORT;
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.$apache_REPORT_RECORDENTRY_FULL_REPORT;
			/* -- UNSET FULL MODEL INSTANCE REPORT FIRST RUN */
			$first_run_full_model_report = 0;
			/* -- INDEX ACTUAL MODEL REPORT COUNT */
			$actual_model_report_count = $actual_model_report_count + 1;
		} else {
			/* pass */
			$seer_FAULT_TYPE = $multilang_STATIC_UNKNOWN." [2]";
		}
	}

	if ( $seer_HMIACTION_FAULT == 0 ) {
		/* -- RECORD ENTRY NEEDS A TABLE BEGINNING */
		$apache_REPORT_RECORDENTRY = "
								<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='95'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='165'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='165'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='165'>
										</TD>
										<TD WIDTH='55'>
										</TD>
										<TD WIDTH='55'>
										</TD>
									</TR>
									".$apache_REPORT_RECORDENTRY;

		/* -- POST THE CERTIFICATION SIGNATURES */
		core_display_digital_sigatures_type_1($MODEL_CERTIFIEDSIG_COUNT,$MODEL_CERTIFIEDSIG,$MODEL_CERTIFIEDCOMMENT_COUNT,$MODEL_CERTIFIEDCOMMENT);
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='10' ALIGN='CENTER'>
										".$apache_REPORT_CERTIFICATION_SIGNATURES."
									</TD>
								</TR>
								";

		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- AND */
		/* -- CLOSE OUT REPORT */	
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='10'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_THINCHART_7,$THINCHART_FORMFILL_NAME)."
									</TD>
								</TR>
							</TABLE>
							";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE BODY TO TOPPLATE */
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
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_THINCHART_7,$THINCHART_FORMFILL_NAME,"NULL","NULL");
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
