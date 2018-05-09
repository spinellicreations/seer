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
CHECKWEIGHER REPORT 1 BODY (INCLUDED TO ALL CHECKWEIGHER MODELS)
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
								<B>".$multilang_CHECKWEIGHERMODEL_0.": ".$multilang_CHECKWEIGHERMODEL_56."</B><BR>
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
	core_user_date_time_range_input_type_1($multilang_CHECKWEIGHERMODEL_59,$multilang_CHECKWEIGHERMODEL_68);
	/* -- ADDITIONAL OPTIONS */
	$mysql_ENTRY_METHOD = $mysql_ENTRY_OPTIONNAME;

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		/* SET SOME INITIAL VALUES FOR REPORT VARIABLES */
		$apache_REPORT_RECORDENTRY = "";
		$apache_SWITCH_ROW_COLOR = 0;
		/* -- ZERO OUT HOLDING VALUES */
		$mysql_query_HOLDING_RECIPE = "NO_RECIPE_HAS_YET_BEEN_FOUND_ON_THE_SYSTEM_0123456789";
		$mysql_query_HOLDING_OPERATOR = "NO_OPERATOR_AS_OF_YET_0123456789";

		/* ZERO OUT CSV FOR EXPORT */
		model_CHECKWEIGHER_export_csv_report_1_zero();

		/* RUN THE QUERY */
		$mysql_mod_openopc_query = "*";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME." WHERE ((DATESTAMP BETWEEN '".$mysql_query_START_DATESTAMP."' AND '".$mysql_query_END_DATESTAMP."') AND (MACHINENAME LIKE '".$mysql_ENTRY_MACHINENAME."')) ORDER BY DATESTAMP ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		/* DISPLAY ONE RECORD EVERY X RECORDS */
		if ( $mysql_ENTRY_METHOD == "ALL" ) {
			/* EVERY RECORD */
			$apache_identify_report_type = $multilang_CHECKWEIGHERMODEL_67;
			$mysql_query_display_every_x_record = 1;
		} else {
			if ( $mysql_ENTRY_METHOD == "LARGESAMPLE" ) {
				/* LARGE SAMPLE */
				$apache_identify_report_type = $multilang_CHECKWEIGHERMODEL_69;
				$mysql_rows_to_display_in_window = $CHECKWEIGHERMODEL_ROWS_IN_WINDOWS_LARGE;
			} else {
				/* SMALL SAMPLE */
				$apache_identify_report_type = $multilang_CHECKWEIGHERMODEL_66;
				$mysql_rows_to_display_in_window = $CHECKWEIGHERMODEL_ROWS_IN_WINDOWS;
			}
			$mysql_query_display_every_x_record = core_display_one_row_for_every_x_rows($mysql_rows_to_display_in_window,$mysql_mod_openopc_num_rows);
		}

		$mysql_query_index = 1;
		while ( $mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result) ) {
			/* AUTO SCALE DISPLAY */
			if ( $mysql_query_index == 1 ) {

				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_MACHINENAME = $mysql_mod_openopc_query_row['MACHINENAME'];
				$mysql_mod_openopc_WORKING_OPERATOR = $mysql_mod_openopc_query_row['OPERATOR'];
				if ($mysql_mod_openopc_WORKING_OPERATOR == NULL) {
					/* BACKWARDS COMPATABILITY FOR DATABASES UPGRADED FROM CHECKWEIGHERMODEL */
					/* VERSION 1 */
					$mysql_mod_openopc_WORKING_OPERATOR = $multilang_STATIC_UNKNOWN;
				} else {
					/* pass */
				}
				$mysql_mod_openopc_WORKING_MASS = $mysql_mod_openopc_query_row['MASS'];
				$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];

				if ($mysql_mod_openopc_WORKING_OPERATOR != $mysql_query_HOLDING_OPERATOR) {
					/* PULL THE OPERATOR INFO FROM THE DB AND THROW UP A BANNER WITH THEIR NAME */
					if ($mysql_mod_openopc_WORKING_OPERATOR != $multilang_STATIC_UNKNOWN) {
						/* BACKWARDS COMPATABILITY FOR DATABASES UPGRADED FROM CHECKWEIGHERMODEL */
						/* VERSION 1 */
						$mysql_seer_query = "REALNAME";
						$mysql_seer_query = "SELECT ".$mysql_seer_query." FROM access WHERE USERNAME LIKE '".$mysql_mod_openopc_WORKING_OPERATOR."' LIMIT 1";
						list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query);
						if ($mysql_seer_num_rows != 0) {
							while ($mysql_seer_query_row = mysqli_fetch_assoc($mysql_seer_query_result)) {
								$mysql_seer_WORKING_REALNAME = $mysql_seer_query_row['REALNAME'];
							}
						} else {
							$mysql_seer_WORKING_REALNAME = $multilang_STATIC_UNKNOWN;
						}
					} else {
						$mysql_seer_WORKING_REALNAME = $multilang_STATIC_UNKNOWN;
					}

					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TR CLASS='hmirowborder1_ALT_NOBORDER'>
								<TD COLSPAN='2'>
									<BR>
								</TD>
								<TD COLSPAN='5' ALIGN='RIGHT' VALIGN='MIDDLE'>
									<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='RIGHT'>
										<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME."</I> [".$mysql_mod_openopc_WORKING_OPERATOR."]
									</P>
								</TD>
								<TD COLSPAN='2'>
									<BR>
								</TD>
							</TR>
							";
					/* UPDATE THE HOLDING OPERATOR WITH VALUE FROM CURRENT OPERATOR */
					$mysql_query_HOLDING_OPERATOR = $mysql_mod_openopc_WORKING_OPERATOR;
				} else {
					/* pass */
				}
				
				if ($mysql_mod_openopc_WORKING_RECIPE != $mysql_query_HOLDING_RECIPE) {
					/* PULL THE RECIPE PARAMTERS FROM THE DB ONCE, THEN MAINTAIN THEM UNTIL THE RECIPE CHANGES */
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
						/* UPDATE THE HOLDING RECIPE WITH VALUE FROM CURRENT RECIPE */
						$mysql_query_HOLDING_RECIPE = $mysql_mod_openopc_WORKING_RECIPE;
					}
				} else {
					/* pass */
				}

				$mysql_mod_openopc_WORKING_MASS_NET = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS - $mysql_mod_openopc_WORKING_TARE), 3);
				if ( ($mysql_mod_openopc_WORKING_MASS_NET < $mysql_mod_openopc_WORKING_MIN) || ($mysql_mod_openopc_WORKING_MASS_NET > $mysql_mod_openopc_WORKING_MAX) ) {
					/* UNIT WAS REJECTED */
					$mysql_mod_openopc_WORKING_RESULT = $multilang_CHECKWEIGHERMODEL_52;			
					$mysql_mod_openopc_WORKING_RESULT_BGCOLOR = "BGCOLOR='#FF8866'";
				} else {
					/* UNIT WAS ACCEPTED */
					$mysql_mod_openopc_WORKING_RESULT = $multilang_CHECKWEIGHERMODEL_51;
					$mysql_mod_openopc_WORKING_RESULT_BGCOLOR = "BGCOLOR='#CCFF66'";
				}

				/* BUILD CSV FOR EXPORT */
				model_CHECKWEIGHER_export_csv_report_1_build();

				/* BUILD THE REPORT DISPLAY */
				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_DATESTAMP."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_MACHINENAME."
								</TD>
								<TD ALIGN='LEFT' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_RECIPE."
								</TD>
								<TD ALIGN='CENTER' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_MASS."
								</TD>
								<TD ALIGN='CENTER' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_TARE."
								</TD>
								<TD ALIGN='CENTER' VALIGN='TOP' ".$mysql_mod_openopc_WORKING_RESULT_BGCOLOR.">
									".$mysql_mod_openopc_WORKING_MASS_NET."
								</TD>
								<TD ALIGN='CENTER' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_MIN."
								</TD>
								<TD ALIGN='CENTER' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_MAX."
								</TD>
								<TD ALIGN='CENTER' VALIGN='TOP'>
									".$mysql_mod_openopc_WORKING_RESULT."
								</TD>
							</TR>
							";
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
		$mysql_ENTRY_MACHINENAME_TO_POST_AT_TOP = $mysql_ENTRY_MACHINENAME." [".$apache_identify_report_type."]";
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link($mysql_ENTRY_MACHINENAME_TO_POST_AT_TOP,"csv",$mysql_query_START_DATESTAMP,$mysql_query_END_DATESTAMP);
		$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION = "
							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER'  CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='175'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='65'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_STATIC_DATESTAMP."</U></B>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_63."</U></B>
									</TD>
									<TD ALIGN='LEFT' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_6."</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_60."<BR>[ ".$CHECKWEIGHERMODEL_UM_MASS." ]</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_34."<BR>[ ".$CHECKWEIGHERMODEL_UM_MASS." ]</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_61."<BR>[ ".$CHECKWEIGHERMODEL_UM_MASS." ]</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_14."<BR>[ ".$CHECKWEIGHERMODEL_UM_MASS." ]</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_16."<BR>[ ".$CHECKWEIGHERMODEL_UM_MASS." ]</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_62."</U></B>
									</TD>
								</TR>
								";
		/* -- GIVE USER OPTION TO RE-RUN REPORT */
		/* -- -- ALL */
		/* -- CLOSE OUT REPORT */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										".core_user_date_time_range_rerun_type_1("BUILDTICKET",$multilang_CHECKWEIGHERMODEL_57,$CHECKWEIGHERMODEL_FORMFILL_NAME)."
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
	$custom_array_of_option_names="<OPTION VALUE='SAMPLE'>".$multilang_CHECKWEIGHERMODEL_66."<OPTION VALUE='LARGESAMPLE'>".$multilang_CHECKWEIGHERMODEL_69."<OPTION VALUE='ALL'>".$multilang_CHECKWEIGHERMODEL_67;
	/* CALL TYPE 1 PROMPT - USE OF OPTION FULFILLMENT REQUIRES LONG FORM CALL */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names); */
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_1("BUILDTICKET",$multilang_CHECKWEIGHERMODEL_57,$CHECKWEIGHERMODEL_FORMFILL_NAME,$multilang_TANKMODEL_106,$multilang_STATIC_REPORT_TIME,$multilang_CHECKWEIGHERMODEL_64,"NULL",$multilang_CHECKWEIGHERMODEL_65,$custom_array_of_option_names);
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
