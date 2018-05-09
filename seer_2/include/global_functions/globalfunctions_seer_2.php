<?php

/*
S.E.E.R. - incl. Warrior module.
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
S.E.E.R. GLOBAL FUNCTIONS FILE (2)
-- CORE MODEL SUBROUTINES (FUNCTION BY FORM, SUBROUTINE BY EXECUTION)
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is operating system agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* HMI and REPORT ACTION MODE INITIAL DETERMINATION */
/* -- set mode based upon posted info */
function core_action_mode_initial_determination ()
{
	/* CALL THIS FUNCTION WITH... */
	/* core_action_mode_initial_determination(); */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_HMIACTION, $seer_HMIACTION_FAULT;

	/* EXECUTE */
	if ( $_POST[seer_HMIACTION] != '' ) {
		$seer_HMIACTION = $_POST['seer_HMIACTION'];
		$seer_HMIACTION_FAULT = 0;
	} else {
		$seer_HMIACTION = "DISPLAY_START_PAGE";
	}
}

/* DISPLAY ONE ROW FOR EVERY 'X' ROWS RETURNED AS A RESULT OF A QUERY */
/* -- scales report size to fit in a resonable window */
function core_display_one_row_for_every_x_rows ($MODEL_ROWS_IN_WINDOWS,$QUERY_RESULT_NUM_ROWS)
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_result_display_records_every_x_row = core_display_one_row_for_every_x_rows($MODEL_ROWS_IN_WINDOWS,$QUERY_RESULT_NUM_ROWS); */

	/* EXECUTE */
	if ( $QUERY_RESULT_NUM_ROWS <= $MODEL_ROWS_IN_WINDOWS ) {
		$QUERY_RESULT_DISPLAY_RECORD_EVERY_X_ROWS = 1;
	} else {
		$QUERY_RESULT_DISPLAY_RECORD_EVERY_X_ROWS = round($QUERY_RESULT_NUM_ROWS / $MODEL_ROWS_IN_WINDOWS);
	}

	/* RETURN VARIABLES */
	return $QUERY_RESULT_DISPLAY_RECORD_EVERY_X_ROWS;
}

/* MIN and MAX FINDER */
/* -- compare a value to a stored min or max and update as necessary */
function core_min_max_finder ($post_run_min_or_max,$post_null_variable,$post_min_or_max,$post_test_new_min_or_max)
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_min_or_max = core_min_max_finder($post_run_min_or_max,$post_null_variable,$post_min_or_max,$post_test_new_min_or_max); */
	/* -- valid values for $post_run_min_or_max are ONLY 'min' or 'max' */
	/* -- other values will result in no action */

	/* EXECUTE */
	/* -- MIN */
	if ($post_run_min_or_max == 'min') {
		if ($post_min_or_max == $post_null_variable) {
			$post_min_or_max = $post_test_new_min_or_max;
		} else {
			if ($post_test_new_min_or_max < $post_min_or_max) {
				$post_min_or_max = $post_test_new_min_or_max;
			} else {
				/* pass */
			}
		}
	} else {
		/* pass */
	}
	/* -- MAX */
	if ($post_run_min_or_max == 'max') {
		if ($post_min_or_max == $post_null_variable) {
			$post_min_or_max = $post_test_new_min_or_max;
		} else {
			if ($post_test_new_min_or_max > $post_min_or_max) {
				$post_min_or_max = $post_test_new_min_or_max;
			} else {
				/* pass */
			}
		}
	} else {
		/* pass */
	}

	/* RETURN VARIABLES */
	return $post_min_or_max;
}

/* DISPLAY HORIZONTAL BAR */
/* -- return a bar width for a horizontal bar graph entry */
function core_display_horizontal_bar ($post_cell_max_width,$post_WORKING_NUMERIC_VALUE,$post_cell_value_low,$post_cell_value_high)
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_horizontal_bar_width = core_display_horizontal_bar($post_cell_max_width,$post_WORKING_NUMERIC_VALUE,$post_cell_value_low,$post_cell_value_high); */

	/* EXECUTE */
	$post_WORKING_BAR = round( ( $post_cell_max_width * ( ($post_WORKING_NUMERIC_VALUE - $post_cell_value_low) / ($post_cell_value_high - $post_cell_value_low) ) ) );
	if ( $post_WORKING_BAR <= 1 ) {
		$post_WORKING_BAR = 1;
	} else {
		/* continue */
	}
	if ( $post_WORKING_BAR >= $post_cell_max_width ) {
		$post_WORKING_BAR = $post_cell_max_width;
	} else {
		/* continue */
	}

	/* RETURN VARIABLES */
	return $post_WORKING_BAR;
}

/* DISPLAY REPORT CERTIFICATION SIGNATURES */
/* TYPE 1 */
/* -- displays digital signatures and comments for certified reports */
/* -- typical of most temperature bar graphs and such */
function core_display_digital_sigatures_type_1 ($post_CERT_SIG_COUNT,$post_CERT_SIG_ARRAY,$post_CERT_COMMENT_COUNT,$post_CERT_COMMENT_ARRAY)
{
	/* CALL THIS FUNCTION WITH... */
	/* core_display_digital_sigatures_type_1($post_CERT_SIG_COUNT,$post_CERT_SIG_ARRAY,$post_CERT_COMMENT_COUNT,$post_CERT_COMMENT_ARRAY); */

	/* GLOBALIZE VARIABLES */

	/* 	-- APACHE */
	global $apache_REPORT_CERTIFICATION_SIGNATURES;

	/*	-- LANGUAGE */
	global $multilang_STATIC_CERT_SIGNATURE_HEADER, $multilang_STATIC_CERT_NO_SIGS, $multilang_STATIC_CERT_COMMENT, $multilang_STATIC_CERT_NO_COMMENTS;

	/* EXECUTE */
	/* -- POST SIGNATURES */
	$apache_REPORT_CERTIFICATION_SIGNATURES = "
										<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
										<!-- REPORT DIGITAL SIGNATURE BLOCK FOR CERTIFIED RECORDS -->
										<!-- TYPE 1 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
										<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

										<TABLE CLASS='STANDARD' WIDTH='605' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='300'>
												</TD>
												<TD WIDTH='5'>
												</TD>
												<TD WIDTH='300'>
												</TD>
											</TR>
											<TR>
												<TD COLSPAN='3'>
													<BR>
												</TD>
											</TR>
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<P CLASS='STANDARDTABLETEXTSIZE'>
														<B><U>".$multilang_STATIC_CERT_SIGNATURE_HEADER."</U></B>:
													</P>
												</TD>
											</TR>
											";
	if ( $post_CERT_SIG_COUNT != 0 ) {
		$post_CERT_SIG_INDEX = 0;
		while ( $post_CERT_SIG_INDEX < $post_CERT_SIG_COUNT ) {
			$apache_REPORT_CERTIFICATION_SIGNATURES = $apache_REPORT_CERTIFICATION_SIGNATURES."
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<P CLASS='STANDARDTABLETEXTSIZE'>
														<A NAME='SIGNATURE".$post_CERT_SIG_INDEX."'><B>SIG - #".$post_CERT_SIG_INDEX."</B></A> -- <I>".$post_CERT_SIG_ARRAY[$post_CERT_SIG_INDEX]."</I>
													</P>
												</TD>
											</TR>
											";
			$post_CERT_SIG_INDEX = $post_CERT_SIG_INDEX + 1;
		}
	} else {
		$apache_REPORT_CERTIFICATION_SIGNATURES = $apache_REPORT_CERTIFICATION_SIGNATURES."
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<P CLASS='STANDARDTABLETEXTSIZE'>
														<I>".$multilang_STATIC_CERT_NO_SIGS."</I>
													</P>
												<TD>
											</TR>
											";
	}
	/* -- POST COMMENTS */
	$apache_REPORT_CERTIFICATION_SIGNATURES = $apache_REPORT_CERTIFICATION_SIGNATURES."
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<BR>
												</TD>
											</TR>
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<P CLASS='STANDARDTABLETEXTSIZE'>
													<B><U>".$multilang_STATIC_CERT_COMMENT."</U></B>:
													</P>
												</TD>
											</TR>
											";
	if ( $post_CERT_COMMENT_COUNT != 0 ) {
		$post_CERT_COMMENT_INDEX = 0;
		while ( $post_CERT_COMMENT_INDEX < $post_CERT_COMMENT_COUNT ) {
			$apache_REPORT_CERTIFICATION_SIGNATURES = $apache_REPORT_CERTIFICATION_SIGNATURES."
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<P CLASS='STANDARDTABLETEXTSIZE'>
													<A NAME='COMMENT".$post_CERT_COMMENT_INDEX."'><B>C - #".$post_CERT_COMMENT_INDEX."</B></A> -- <I>".$post_CERT_COMMENT_ARRAY[$post_CERT_COMMENT_INDEX]."</I>
													</P>
												</TD>
											</TR>
											";
			$post_CERT_COMMENT_INDEX = $post_CERT_COMMENT_INDEX + 1;
		}
	} else {
		$apache_REPORT_CERTIFICATION_SIGNATURES = $apache_REPORT_CERTIFICATION_SIGNATURES."
											<TR>
												<TD COLSPAN='3' ALIGN='LEFT'>
													<P CLASS='STANDARDTABLETEXTSIZE'>
														<I>".$multilang_STATIC_CERT_NO_COMMENTS."</I>
													</P>
												</TD>
											</TR>
											";
	}
	/* -- CLOSE OUT */
	$apache_REPORT_CERTIFICATION_SIGNATURES = $apache_REPORT_CERTIFICATION_SIGNATURES."
											<TR>
												<TD COLSPAN='3'>
													<BR>
												</TD>
											</TR>
										</TABLE>

										<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
										";
}

/* HMI and REPORT DATE START and END USER INPUT FIELDS (ASK FOR) */
/* -- prompt user for input and build the form for submission */
/* -- TYPE 1 */
function core_user_date_time_range_prompt_type_1 ($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use="NULL",$post_note_to_use_2="NULL",$post_note_to_use_3="NULL",$post_note_to_use_4="NULL",$custom_term_for_option_name="NULL",$custom_array_of_option_names="NULL",$custom_term_for_option_name2="NULL",$custom_array_of_option_names2="NULL",$mode="REPORT")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_recordentry = core_user_date_time_range_prompt_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4,$custom_term_for_option_name,$custom_array_of_option_names,$custom_term_for_option_name2="NULL",$custom_array_of_option_names2="NULL",$mode="REPORT"); */
	/* -- to disable entry field for machine name (or to effectively run a */
	/*    report against all machines in a local instance), set the following */
	/*    variable to the following string (exactly)... */
	/*     -- $custom_term_for_machine_name = 'ENTIRE_MODEL_LOCAL_INSTANCE' */
	/* -- valid values for $mode are "REPORT" and "CERTIFICATION" */
	/*     -- default is "REPORT" */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_REFERRINGPAGE;

	/*	-- MySQL */
	global $mysql_mod_openopc_RETENTION_YEARS;

	/*	-- APACHE */
	global $apache_THISYEAR, $apache_LASTYEAR,$apache_THISMONTH, $apache_THISDAYOFMONTH, $apache_THISHOUR, $apache_THISMINUTE, $apache_THISSECOND, $apache_FORMFILL_MANUAL_ENTRY_YEAR, $apache_FORMFILL_MANUAL_ENTRY_MONTH, $apache_FORMFILL_MANUAL_ENTRY_DAY, $apache_FORMFILL_MANUAL_ENTRY_HOUR, $apache_FORMFILL_MANUAL_ENTRY_MINUTE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NOTE, $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT, $multilang_STATIC_YEAR, $multilang_STATIC_MONTH, $multilang_STATIC_DAY, $multilang_STATIC_HOUR, $multilang_STATIC_MINUTE, $multilang_STATIC_DATESTAMP, $multilang_STATIC_START_OF_LOG, $multilang_STATIC_END_OF_LOG, $multilang_STATIC_DISPLAY_REPORT_TICKET;


	/* EXECUTE */
	if ( $mode != 'CERTIFICATION' ) {
		/* REPORT MODE DATE BUILDER */
		list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestampZEROBASE($mysql_mod_openopc_RETENTION_YEARS);
	} else {
		/* CERTIFICATION MODE DATE BUILDER */
		list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestamplast48hr();
	}

	if ( $post_note_to_use == 'NULL' ) {
		$post_note_to_use = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
	} else {
		/* pass */
	}
	
	$post_form_to_display = "
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						<!-- HMI and REPORT DATE START and END USER INPUT FIELDS (ASK FOR) -->
						<!-- TYPE 1 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

						<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='100'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use."
										</P>
									</TD>
								</TR>
								";
	if ($post_note_to_use_2 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_2."
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	if ($post_note_to_use_3 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_3."
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	if ($post_note_to_use_4 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_4."
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	if ( $custom_term_for_machine_name != 'ENTIRE_MODEL_LOCAL_INSTANCE' ) {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD>
										<B><I>".$custom_term_for_machine_name."</I></B>
									</TD>
									<TD COLSPAN='3'>
										<SELECT NAME='mysql_ENTRY_MACHINENAME'><OPTION VALUE=''>".$custom_term_for_machine_name.$custom_array_of_machine_names."</SELECT>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	if ( $custom_term_for_option_name != 'NULL' ) {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD>
										<B><I>".$custom_term_for_option_name."</I></B>
									</TD>
									<TD COLSPAN='3'>
										<SELECT NAME='mysql_ENTRY_OPTIONNAME'>".$custom_array_of_option_names."</SELECT>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	if ( $custom_term_for_option_name2 != 'NULL' ) {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD>
										<B><I>".$custom_term_for_option_name2."</I></B>
									</TD>
									<TD COLSPAN='3'>
										<SELECT NAME='mysql_ENTRY_OPTIONNAME_2'>".$custom_array_of_option_names2."</SELECT>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	$post_form_to_display = $post_form_to_display."
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='3'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_YEAR."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_MONTH."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_DAY."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_HOUR."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_MINUTE."</B>
												</TD>
											</TR>
										</TABLE>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><I>".$multilang_STATIC_DATESTAMP."<BR>
										[".$multilang_STATIC_START_OF_LOG."]</I></B>
									</TD>
									<TD COLSPAN='3'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_YEAR'><OPTION VALUE=''>".$multilang_STATIC_YEAR.$apache_FORMFILL_MANUAL_ENTRY_YEAR."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_MONTH'><OPTION VALUE=''>".$multilang_STATIC_MONTH.$apache_FORMFILL_MANUAL_ENTRY_MONTH."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_DAY'><OPTION VALUE=''>".$multilang_STATIC_DAY.$apache_FORMFILL_MANUAL_ENTRY_DAY."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_HOUR'><OPTION VALUE=''>".$multilang_STATIC_HOUR.$apache_FORMFILL_MANUAL_ENTRY_HOUR."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_MINUTE'><OPTION VALUE=''>".$multilang_STATIC_MINUTE.$apache_FORMFILL_MANUAL_ENTRY_MINUTE."</SELECT>
												</TD>
											</TR>
										</TABLE>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><I>".$multilang_STATIC_DATESTAMP."<BR>
										[".$multilang_STATIC_END_OF_LOG."]</I></B>
									</TD>
									<TD COLSPAN='3'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_END_YEAR'><OPTION VALUE=''>".$multilang_STATIC_YEAR.$apache_FORMFILL_MANUAL_ENTRY_YEAR."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_END_MONTH'><OPTION VALUE=''>".$multilang_STATIC_MONTH.$apache_FORMFILL_MANUAL_ENTRY_MONTH."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_END_DAY'><OPTION VALUE=''>".$multilang_STATIC_DAY.$apache_FORMFILL_MANUAL_ENTRY_DAY."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_END_HOUR'><OPTION VALUE=''>".$multilang_STATIC_HOUR.$apache_FORMFILL_MANUAL_ENTRY_HOUR."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_END_MINUTE'><OPTION VALUE=''>".$multilang_STATIC_MINUTE.$apache_FORMFILL_MANUAL_ENTRY_MINUTE."</SELECT>
												</TD>
											</TR>
										</TABLE>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B><I>".$multilang_STATIC_DISPLAY_REPORT_TICKET."</I></B>
									</TD>
									<TD>
										<INPUT TYPE='hidden' name='seer_HMIACTION' value='".$custom_action_on_submit."'>
										<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
							</TABLE>
						</FORM>

						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						";

	/* RETURN VARIABLES */
	return $post_form_to_display;
}

/* HMI and REPORT DATE START and END USER INPUT ACCEPTANCE */
/* -- handle input, throw a fault if bad, and */
/* -- indicate fault status as present or not */
/* -- TYPE 1 */
function core_user_date_time_range_input_type_1 ($custom_fault_for_missing_variable_machinename,$custom_fault_for_missing_variable_optionname="NULL",$custom_fault_for_missing_variable_optionname2="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* core_user_date_time_range_input_type_1($custom_fault_for_missing_variable_machinename,$custom_fault_for_missing_variable_optionname); */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_HMIACTION, $seer_FAULT_TYPE;

	/*	-- MySQL */
	global $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, $mysql_query_START_DATESTAMP_CERT, $mysql_query_END_DATESTAMP_CERT, $mysql_ENTRY_MACHINENAME, $mysql_ENTRY_OPTIONNAME, $mysql_ENTRY_OPTIONNAME_2, $mysql_ENTRY_START_YEAR, $mysql_ENTRY_START_MONTH, $mysql_ENTRY_START_DAY, $mysql_ENTRY_START_HOUR, $mysql_ENTRY_START_MINUTE, $mysql_ENTRY_END_YEAR, $mysql_ENTRY_END_MONTH, $mysql_ENTRY_END_DAY, $mysql_ENTRY_END_HOUR, $mysql_ENTRY_END_MINUTE;

	/*	-- LANGUAGE */
	global $multilang_FAULT_1, $multilang_FAULT_2, $multilang_FAULT_3, $multilang_FAULT_4, $multilang_FAULT_5, $multilang_FAULT_6, $multilang_FAULT_7, $multilang_FAULT_8, $multilang_FAULT_9, $multilang_FAULT_10, $multilang_FAULT_11;

	/* EXECUTE */
	/* -- PULL IN POST VARIABLES */
	if ( $custom_fault_for_missing_variable_machinename != 'ENTIRE_MODEL_LOCAL_INSTANCE' ) {
		if ( $_POST[mysql_ENTRY_MACHINENAME] != '' ) {
			$mysql_ENTRY_MACHINENAME = $_POST['mysql_ENTRY_MACHINENAME'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $custom_fault_for_missing_variable_machinename;
		}
	} else {
		/* pass */
	}
	if ( $custom_fault_for_missing_variable_optionname != 'NULL' ) {
		if ( $_POST[mysql_ENTRY_OPTIONNAME] != '' ) {
			$mysql_ENTRY_OPTIONNAME = $_POST['mysql_ENTRY_OPTIONNAME'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $custom_fault_for_missing_variable_optionname;
		}
	} else {
		/* pass */
	}
	if ( $custom_fault_for_missing_variable_optionname2 != 'NULL' ) {
		if ( $_POST[mysql_ENTRY_OPTIONNAME_2] != '' ) {
			$mysql_ENTRY_OPTIONNAME_2 = $_POST['mysql_ENTRY_OPTIONNAME_2'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $custom_fault_for_missing_variable_optionname2;
		}
	} else {
		/* pass */
	}
	if ($seer_HMIACTION == 'SAVETICKET') {
		if ( isset($_POST[mysql_query_START_DATESTAMP_CERT]) && ($_POST[mysql_query_START_DATESTAMP_CERT] != '') ) {
			/* -- CERT DATESTAMPS ARE DECLARED IN WHOLE */
			if ( $_POST[mysql_query_START_DATESTAMP_CERT] != '' ) {
				$mysql_query_START_DATESTAMP_CERT = $_POST['mysql_query_START_DATESTAMP_CERT'];
			} else {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_FAULT_2;
			}
			if ( $_POST[mysql_query_END_DATESTAMP_CERT] != '' ) {
				$mysql_query_END_DATESTAMP_CERT = $_POST['mysql_query_END_DATESTAMP_CERT'];
			} else {
				$seer_HMIACTION_FAULT = 1;
				$seer_FAULT_TYPE = $multilang_FAULT_7;
			}
			/* -- CHECK TO MAKE SURE USER DID NOT ACCIDENTLY FLIP FLOP THE */
			/*    START AND END RADIO BUTTONS FOR DATESTAMPS, AND IF THEY DID */
			/*    THEN AUTO CORRECT IT. */
			if ($seer_HMIACTION_FAULT == 0) {
				/* CHECK */
				if ($mysql_query_START_DATESTAMP_CERT > $mysql_query_END_DATESTAMP_CERT) {
					/* AUTO CORRECT */
					$flip_flop = $mysql_query_START_DATESTAMP_CERT;
					$mysql_query_START_DATESTAMP_CERT = $mysql_query_END_DATESTAMP_CERT;
					$mysql_query_END_DATESTAMP_CERT = $flip_flop;
				} else {
					/* pass */
				}
			} else {
				/* IGNORE - WE HAVE MORE SERIOUS PROBLEMS */
			}
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_2;
		}
	} else {
		/* pass */
	}
	if ( $_POST[mysql_ENTRY_START_YEAR] != '' ) {
		$mysql_ENTRY_START_YEAR = $_POST['mysql_ENTRY_START_YEAR'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_2;
	}
	if ( $_POST[mysql_ENTRY_START_MONTH] != '' ) {
		$mysql_ENTRY_START_MONTH = $_POST['mysql_ENTRY_START_MONTH'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_3;
	}
	if ( $_POST[mysql_ENTRY_START_DAY] != '' ) {
		$mysql_ENTRY_START_DAY = $_POST['mysql_ENTRY_START_DAY'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_4;
	}
	if ( $_POST[mysql_ENTRY_START_HOUR] != '' ) {
		$mysql_ENTRY_START_HOUR = $_POST['mysql_ENTRY_START_HOUR'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_5;
	}
	if ( $_POST[mysql_ENTRY_START_MINUTE] != '' ) {
		$mysql_ENTRY_START_MINUTE = $_POST['mysql_ENTRY_START_MINUTE'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_6;
	}
	if ( $_POST[mysql_ENTRY_END_YEAR] != '' ) {
		$mysql_ENTRY_END_YEAR = $_POST['mysql_ENTRY_END_YEAR'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_7;
	}
	if ( $_POST[mysql_ENTRY_END_MONTH] != '' ) {
		$mysql_ENTRY_END_MONTH = $_POST['mysql_ENTRY_END_MONTH'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_8;
	}
	if ( $_POST[mysql_ENTRY_END_DAY] != '' ) {
		$mysql_ENTRY_END_DAY = $_POST['mysql_ENTRY_END_DAY'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_9;
	}
	if ( $_POST[mysql_ENTRY_END_HOUR] != '' ) {
		$mysql_ENTRY_END_HOUR = $_POST['mysql_ENTRY_END_HOUR'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_10;
	}
	if ( $_POST[mysql_ENTRY_END_MINUTE] != '' ) {
		$mysql_ENTRY_END_MINUTE = $_POST['mysql_ENTRY_END_MINUTE'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_FAULT_11;
	}
	/* -- PREP THE START AND END DATESTAMPS FOR USE IN DATABASE QUERIES */
	if ( $seer_HMIACTION_FAULT == 0 ) {
		$mysql_query_START_DATESTAMP = $mysql_ENTRY_START_YEAR."_".$mysql_ENTRY_START_MONTH.$mysql_ENTRY_START_DAY."_".$mysql_ENTRY_START_HOUR.":".$mysql_ENTRY_START_MINUTE;
		$mysql_query_END_DATESTAMP = $mysql_ENTRY_END_YEAR."_".$mysql_ENTRY_END_MONTH.$mysql_ENTRY_END_DAY."_".$mysql_ENTRY_END_HOUR.":".$mysql_ENTRY_END_MINUTE;
	} else {
		/* pass */
	}
}

/* HMI and REPORT DATE START and END USER RE-RUN THE JOB FORM */
/* -- prompt user for input and build the form for submission */
/* -- TYPE 1 */
function core_user_date_time_range_rerun_type_1 ($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$custom_term_for_option_name="NULL",$custom_array_of_option_names="NULL",$custom_term_for_option_name2="NULL",$custom_array_of_option_names2="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_recordentry = core_user_date_time_range_rerun_type_1($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$custom_term_for_option_name="NULL",$custom_array_of_option_names="NULL",$custom_term_for_option_name2="NULL",$custom_array_of_option_names2="NULL"); */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_REFERRINGPAGE;

	/*	-- MySQL */
	global $mysql_ENTRY_OPTIONNAME, $mysql_ENTRY_OPTIONNAME_2, $mysql_ENTRY_START_YEAR, $mysql_ENTRY_START_MONTH, $mysql_ENTRY_START_DAY, $mysql_ENTRY_START_HOUR, $mysql_ENTRY_START_MINUTE, $mysql_ENTRY_END_YEAR, $mysql_ENTRY_END_MONTH, $mysql_ENTRY_END_DAY, $mysql_ENTRY_END_HOUR, $mysql_ENTRY_END_MINUTE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_RERUN_REPORT, $multilang_STATIC_NEXT_ITEM_ID;


	/* EXECUTE */
	list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestampZEROBASE($mysql_mod_openopc_RETENTION_YEARS);
	
	$post_form_to_display = "
									<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
									<!-- HMI and REPORT DATE START and END RE-RUN THE JOB INPUT FIELDS -->
									<!-- TYPE 1 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
									<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

									<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
										<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='750'>
													<BR>
												</TD>
											</TR>
											<TR>
												<TD CLASS='hmicellborder1'>
													<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
														<TR>
															<TD WIDTH='350'>
															</TD>
															<TD WIDTH='50'>
															</TD>
															<TD WIDTH='350'>
															</TD>
														</TR>
														<TR>
															<TD COLSPAN='3'>
																<BR>
															</TD>
														</TR>
														<TR>
															<TD ALIGN='RIGHT' VALIGN='TOP'>
																<B><I>".$multilang_STATIC_RERUN_REPORT."... </I></B><BR>
															</TD>
															<TD>
																<BR>
															</TD>
															<TD ALIGN='LEFT' VALIGN='TOP'>
															";
	if ( ($custom_term_for_machine_name != 'NULL') && ($custom_array_of_machine_names != 'NULL') && ($mysql_ENTRY_MACHINENAME != 'ENTIRE_MODEL_LOCAL_INSTANCE') ) {
		$post_form_to_display = $post_form_to_display."
																<I>".$multilang_STATIC_NEXT_ITEM_ID."...</I><BR>
																<SELECT NAME='mysql_ENTRY_MACHINENAME'><OPTION VALUE=''>".$custom_term_for_machine_name.$custom_array_of_machine_names."</SELECT><BR>
																";
	} else {
		$post_form_to_display = $post_form_to_display."
																<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='".$mysql_ENTRY_MACHINENAME."'>
																";
	}
	if ( ($custom_term_for_option_name != 'NULL') && ($custom_array_of_option_names != 'NULL') ) {
		if ( ($custom_term_for_machine_name != 'NULL') && ($custom_array_of_machine_names != 'NULL') && ($mysql_ENTRY_MACHINENAME != 'ENTIRE_MODEL_LOCAL_INSTANCE') ) {
			$post_form_to_display = $post_form_to_display."
																<BR>
																";
		} else {
			/* pass */
		}
		$post_form_to_display = $post_form_to_display."
																<I>".$custom_term_for_option_name."...</I><BR>
																<SELECT NAME='mysql_ENTRY_OPTIONNAME'>".$custom_array_of_option_names."</SELECT><BR>
																";
	} else {
		$post_form_to_display = $post_form_to_display."
																<INPUT TYPE='hidden' name='mysql_ENTRY_OPTIONNAME' value='".$mysql_ENTRY_OPTIONNAME."'>
																";
	}
	if ( ($custom_term_for_option_name2 != 'NULL') && ($custom_array_of_option_names2 != 'NULL') ) {
		if ( ($custom_term_for_option_name != 'NULL') && ($custom_array_of_option_names != 'NULL') && ($custom_term_for_machine_name2 != 'NULL') && ($custom_array_of_machine_names2 != 'NULL') && ($mysql_ENTRY_MACHINENAME != 'ENTIRE_MODEL_LOCAL_INSTANCE') ) {
			$post_form_to_display = $post_form_to_display."
																<BR>
																";
		} else {
			/* pass */
		}
		$post_form_to_display = $post_form_to_display."
																<I>".$custom_term_for_option_name2."...</I><BR>
																<SELECT NAME='mysql_ENTRY_OPTIONNAME_2'>".$custom_array_of_option_names2."</SELECT><BR>
																";
	} else {
		$post_form_to_display = $post_form_to_display."
																<INPUT TYPE='hidden' name='mysql_ENTRY_OPTIONNAME_2' value='".$mysql_ENTRY_OPTIONNAME_2."'>
																";
	}
	$post_form_to_display = $post_form_to_display."
																<INPUT TYPE='hidden' name='seer_HMIACTION' value='".$custom_action_on_submit."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_START_YEAR' value='".$mysql_ENTRY_START_YEAR."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_START_MONTH' value='".$mysql_ENTRY_START_MONTH."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_START_DAY' value='".$mysql_ENTRY_START_DAY."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_START_HOUR' value='".$mysql_ENTRY_START_HOUR."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_START_MINUTE' value='".$mysql_ENTRY_START_MINUTE."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_END_YEAR' value='".$mysql_ENTRY_END_YEAR."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_END_MONTH' value='".$mysql_ENTRY_END_MONTH."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_END_DAY' value='".$mysql_ENTRY_END_DAY."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_END_HOUR' value='".$mysql_ENTRY_END_HOUR."'>
																<INPUT TYPE='hidden' name='mysql_ENTRY_END_MINUTE' value='".$mysql_ENTRY_END_MINUTE."'>
															</TD>
														</TR>
														<TR>
															<TD COLSPAN='3'>
																<BR>
															</TD>
														</TR>
														<TR>
															<TD>
																<BR>
															</TD>
															<TD>
																<BR>
															</TD>
															<TD ALIGN='LEFT'>
																<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
															</TD>
														</TR>
														<TR>
															<TD COLSPAN='3'>
																<BR>
															</TD>
														</TR>
													</TABLE>
												</TD>
											</TR>
										</TABLE>
									</FORM>

									<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
									";


	/* RETURN VARIABLES */
	return $post_form_to_display;
}

/* HMI and REPORT DATE START and END USER INPUT FIELDS (ASK FOR) */
/* -- prompt user for input and build the form for submission */
/* -- TYPE 2 */
/* -- -- 'current' and 'historical' inventory options */
function core_user_date_time_range_prompt_type_2 ($custom_action_on_submit,$post_note_to_use="NULL",$post_note_to_use_2="NULL",$post_note_to_use_3="NULL",$post_note_to_use_4="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_recordentry = core_user_date_time_range_prompt_type_2($custom_action_on_submit,$post_note_to_use,$post_note_to_use_2,$post_note_to_use_3,$post_note_to_use_4); */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_REFERRINGPAGE;

	/*	-- MySQL */
	global $mysql_mod_openopc_RETENTION_YEARS;

	/*	-- APACHE */
	global $apache_THISYEAR, $apache_LASTYEAR,$apache_THISMONTH, $apache_THISDAYOFMONTH, $apache_THISHOUR, $apache_THISMINUTE, $apache_THISSECOND, $apache_FORMFILL_MANUAL_ENTRY_YEAR, $apache_FORMFILL_MANUAL_ENTRY_MONTH, $apache_FORMFILL_MANUAL_ENTRY_DAY, $apache_FORMFILL_MANUAL_ENTRY_HOUR, $apache_FORMFILL_MANUAL_ENTRY_MINUTE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NOTE, $multilang_STATIC_SNAPSHOT, $multilang_STATIC_HISTORICAL_BLIP, $multilang_STATIC_CURRENT_BLIP, $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY, $multilang_STATIC_INVENTORY_TYPE, $multilang_STATIC_YEAR, $multilang_STATIC_MONTH, $multilang_STATIC_DAY, $multilang_STATIC_HOUR, $multilang_STATIC_MINUTE, $multilang_STATIC_DATESTAMP, $multilang_STATIC_START_OF_LOG, $multilang_STATIC_END_OF_LOG, $multilang_STATIC_DISPLAY_REPORT_TICKET;


	/* EXECUTE */
	list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestampZEROBASE($mysql_mod_openopc_RETENTION_YEARS);

	if ( $post_note_to_use == 'NULL' ) {
		$post_note_to_use = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
	} else {
		/* pass */
	}
	
	$post_form_to_display = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- HMI and REPORT DATE START and END USER INPUT FIELDS (ASK FOR) -->
							<!-- TYPE 2 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='100'>
											<BR>
										</TD>
										<TD WIDTH='200'>
											<BR>
										</TD>
										<TD WIDTH='200'>
											<BR>
										</TD>
										<TD WIDTH='100'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<P CLASS='INFOREPORT'>
											<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use."
											</P>
										</TD>
									</TR>
									";
	if ($post_note_to_use_2 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
									<TR>
										<TD COLSPAN='4'>
											<P CLASS='INFOREPORT'>
											<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_2."
											</P>
										</TD>
									</TR>
									";
	} else {
		/* pass */
	}
	if ($post_note_to_use_3 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
									<TR>
										<TD COLSPAN='4'>
											<P CLASS='INFOREPORT'>
											<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_3."
											</P>
										</TD>
									</TR>
									";
	} else {
		/* pass */
	}
	if ($post_note_to_use_4 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
									<TR>
										<TD COLSPAN='4'>
											<P CLASS='INFOREPORT'>
											<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_4."
											</P>
										</TD>
									</TR>
									";
	} else {
		/* pass */
	}
	$post_form_to_display = $post_form_to_display."
									<TR>
										<TD>
											<B><I>".$multilang_STATIC_INVENTORY_TYPE."</I></B>
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='radio' NAME='mysql_ENTRY_SNAPSHOT_SELECTION' value='CURRENT'>".$multilang_STATIC_CURRENT_BLIP."
										</TD>
										<TD ALIGN='CENTER'>
											<INPUT TYPE='radio' NAME='mysql_ENTRY_SNAPSHOT_SELECTION' value='HISTORICAL'>".$multilang_STATIC_HISTORICAL_BLIP."
										</TD>
										<TD>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD COLSPAN='3'>
											<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD WIDTH='100'>
														<B>".$multilang_STATIC_YEAR."</B>
													</TD>
													<TD WIDTH='100'>
														<B>".$multilang_STATIC_MONTH."</B>
													</TD>
													<TD WIDTH='100'>
														<B>".$multilang_STATIC_DAY."</B>
													</TD>
													<TD WIDTH='100'>
														<B>".$multilang_STATIC_HOUR."</B>
													</TD>
													<TD WIDTH='100'>
														<BR>
													</TD>
												</TR>
											</TABLE>
										</TD>
									</TR>
									<TR>
										<TD>
											<B><I>".$multilang_STATIC_SNAPSHOT."</I></B>
										</TD>
										<TD COLSPAN='3'>
											<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD WIDTH='100'>
														<SELECT NAME='mysql_ENTRY_SNAPSHOT_YEAR'><OPTION VALUE=''>".$multilang_STATIC_YEAR.$apache_FORMFILL_MANUAL_ENTRY_YEAR."</SELECT>
													</TD>
													<TD WIDTH='100'>
														<SELECT NAME='mysql_ENTRY_SNAPSHOT_MONTH'><OPTION VALUE=''>".$multilang_STATIC_MONTH.$apache_FORMFILL_MANUAL_ENTRY_MONTH."</SELECT>
													</TD>
													<TD WIDTH='100'>
														<SELECT NAME='mysql_ENTRY_SNAPSHOT_DAY'><OPTION VALUE=''>".$multilang_STATIC_DAY.$apache_FORMFILL_MANUAL_ENTRY_DAY."</SELECT>
													</TD>
													<TD WIDTH='100'>
														<SELECT NAME='mysql_ENTRY_SNAPSHOT_HOUR'><OPTION VALUE=''>".$multilang_STATIC_HOUR.$apache_FORMFILL_MANUAL_ENTRY_HOUR."</SELECT>
													</TD>
													<TD WIDTH='100'>
														<BR>
													</TD>
												</TR>
											</TABLE>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='4'>
											<BR>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD>
											<BR>
										</TD>
										<TD ALIGN='RIGHT'>
											<B><I>".$multilang_STATIC_DISPLAY_REPORT_TICKET."</I></B>
										</TD>
										<TD>
											<INPUT TYPE='hidden' name='seer_HMIACTION' value='".$custom_action_on_submit."'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
										<TD>
											<BR>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN VARIABLES */
	return $post_form_to_display;
}

/* HMI and REPORT DATE START and END USER INPUT ACCEPTANCE */
/* -- handle input, throw a fault if bad, and */
/* -- indicate fault status as present or not */
/* -- TYPE 2 */
/* -- -- 'current' and 'historical' options */
function core_user_date_time_range_input_type_2 ()
{
	/* CALL THIS FUNCTION WITH... */
	/* core_user_date_time_range_input_type_2(); */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;

	/*	-- MySQL */
	global $mysql_mod_openopc_RETENTION_YEARS, $mysql_query_SNAPSHOT_DATESTAMP_START, $mysql_query_SNAPSHOT_DATESTAMP_END, $mysql_ENTRY_SNAPSHOT_SELECTION, $mysql_ENTRY_SNAPSHOT_YEAR, $mysql_ENTRY_SNAPSHOT_MONTH, $mysql_ENTRY_SNAPSHOT_DAY, $mysql_ENTRY_SNAPSHOT_HOUR;

	/*	-- LANGUAGE */
	global $multilang_FAULT_38, $multilang_FAULT_2, $multilang_FAULT_3, $multilang_FAULT_4, $multilang_FAULT_5;

	/* EXECUTE */
	/* -- PULL IN POST VARIABLES */
	if ( $_POST[mysql_ENTRY_SNAPSHOT_SELECTION] != '' ) {
		$mysql_ENTRY_SNAPSHOT_SELECTION = $_POST['mysql_ENTRY_SNAPSHOT_SELECTION'];
	} else {
		if ( $mysql_ENTRY_SNAPSHOT_SELECTION == 'HISTORICAL' ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_38;
		} else {
			/* pass */
		}
	}
	if ( $_POST[mysql_ENTRY_SNAPSHOT_YEAR] != '' ) {
		$mysql_ENTRY_SNAPSHOT_YEAR = $_POST['mysql_ENTRY_SNAPSHOT_YEAR'];
	} else {
		if ( $mysql_ENTRY_SNAPSHOT_SELECTION == 'HISTORICAL' ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_2;
		} else {
			/* pass */
		}
	}
	if ( $_POST[mysql_ENTRY_SNAPSHOT_MONTH] != '' ) {
		$mysql_ENTRY_SNAPSHOT_MONTH = $_POST['mysql_ENTRY_SNAPSHOT_MONTH'];
	} else {
		if ( $mysql_ENTRY_SNAPSHOT_SELECTION == 'HISTORICAL' ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_3;
		} else {
			/* pass */
		}
	}
	if ( $_POST[mysql_ENTRY_SNAPSHOT_DAY] != '' ) {
		$mysql_ENTRY_SNAPSHOT_DAY = $_POST['mysql_ENTRY_SNAPSHOT_DAY'];
	} else {
		if ( $mysql_ENTRY_SNAPSHOT_SELECTION == 'HISTORICAL' ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_4;
		} else {
			/* pass */
		}
	}
	if ( $_POST[mysql_ENTRY_SNAPSHOT_HOUR] != '' ) {
		$mysql_ENTRY_SNAPSHOT_HOUR = $_POST['mysql_ENTRY_SNAPSHOT_HOUR'];
	} else {
		if ( $mysql_ENTRY_SNAPSHOT_SELECTION == 'HISTORICAL' ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_5;
		} else {
			/* pass */
		}
	}

	/* -- PREP THE START AND END DATESTAMPS FOR USE IN DATABASE QUERIES */
	if ( $seer_HMIACTION_FAULT == 0 ) {
		/* -- DISCRETE DATESTAMP TAGS */
		list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestampZEROBASE($mysql_mod_openopc_RETENTION_YEARS);
	
		/* SET UP THE SNAPSHOT TIME */
		/* -- IF HISTORICAL, USE THE VALUES PROVIDED BY USER */
		/* -- IF CURRENT, WE HAVE TO MAKE THE VALUES HERE */
		if ( $mysql_ENTRY_SNAPSHOT_SELECTION == 'CURRENT' ) {
			$mysql_ENTRY_SNAPSHOT_YEAR = $apache_THISYEAR;
			$mysql_ENTRY_SNAPSHOT_MONTH = sprintf("%02d", $apache_THISMONTH);
			$mysql_ENTRY_SNAPSHOT_DAY = sprintf("%02d", $apache_THISDAYOFMONTH);
			$mysql_ENTRY_SNAPSHOT_HOUR = sprintf("%02d", $apache_THISHOUR);
			$mysql_ENTRY_SNAPSHOT_MIN = sprintf("%02d", $apache_THISMINUTE);
		} else {
			$mysql_ENTRY_SNAPSHOT_MIN = 0;
			$mysql_ENTRY_SNAPSHOT_MIN = sprintf("%02d", $mysql_ENTRY_SNAPSHOT_MIN);
		}
		$mysql_ENTRY_SNAPSHOT_LASTYEAR = $mysql_ENTRY_SNAPSHOT_YEAR;
		$mysql_ENTRY_SNAPSHOT_LASTMONTH = $mysql_ENTRY_SNAPSHOT_MONTH;
		$mysql_ENTRY_SNAPSHOT_LASTDAY = $mysql_ENTRY_SNAPSHOT_DAY;
		$mysql_ENTRY_SNAPSHOT_LASTHOUR = $mysql_ENTRY_SNAPSHOT_HOUR - 1;
		$mysql_ENTRY_SNAPSHOT_LASTHOUR = sprintf("%02d", $mysql_ENTRY_SNAPSHOT_LASTHOUR);
		if ( $mysql_ENTRY_SNAPSHOT_LASTHOUR < 0 ) {
			$mysql_ENTRY_SNAPSHOT_LASTHOUR = 23;
			$mysql_ENTRY_SNAPSHOT_LASTDAY = $mysql_ENTRY_SNAPSHOT_LASTDAY - 1;
			$mysql_ENTRY_SNAPSHOT_LASTDAY = sprintf("%02d", $mysql_ENTRY_SNAPSHOT_LASTDAY);
			if ( $mysql_ENTRY_SNAPSHOT_LASTDAY < 1 ) {
				if ( ($mysql_ENTRY_LASTMONTH == 10) || ($mysql_ENTRY_LASTMONTH == 5) || ($mysql_ENTRY_LASTMONTH == 7) || ($mysql_ENTRY_LASTMONTH == 12) ) {
					$pushback_month = "no";					
					$pushback_month_special = "yes";
					$pushback_feb = "no";
				} else {
					if ( $mysql_ENTRY_LASTMONTH == 3) {
						$pushback_month = "no";
						$pushback_month_special = "no";
						$pushback_feb = "yes";
					} else {
						$pushback_month = "yes";
						$pushback_month_special = "no";
						$pushback_feb = "no";
					}
				}
				if ( $pushback_month == "yes" ) {
					$mysql_ENTRY_SNAPSHOT_LASTDAY = 31;
					$mysql_ENTRY_SNAPSHOT_LASTMONTH = $mysql_ENTRY_SNAPSHOT_LASTMONTH - 1;
					$mysql_ENTRY_SNAPSHOT_LASTMONTH = sprintf("%02d", $mysql_ENTRY_SNAPSHOT_LASTMONTH);
				} else {
					/* pass */
				}
				if ( $pushback_month_special == "yes" ) {
					$mysql_ENTRY_SNAPSHOT_LASTDAY = 30;
					$mysql_ENTRY_SNAPSHOT_LASTMONTH = $mysql_ENTRY_SNAPSHOT_LASTMONTH - 1;
					$mysql_ENTRY_SNAPSHOT_LASTMONTH = sprintf("%02d", $mysql_ENTRY_SNAPSHOT_LASTMONTH);
				} else {
					/* pass */
				}
				if ( $pushback_feb == "yes" ) {
					$mysql_ENTRY_SNAPSHOT_LASTDAY = 28;
					$mysql_ENTRY_SNAPSHOT_LASTMONTH = $mysql_ENTRY_SNAPSHOT_LASTMONTH - 1;
					$mysql_ENTRY_SNAPSHOT_LASTMONTH = sprintf("%02d", $mysql_ENTRY_SNAPSHOT_LASTMONTH);
				} else {
					/* pass */
				}
			} else {
				/* pass */
			}
			if ( $mysql_ENTRY_LASTMONTH < 1 ) {
				$mysql_ENTRY_LASTMONTH = 12;
				$mysql_ENTRY_LASTYEAR = $mysql_ENTRY_LASTYEAR - 1;
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}

		$mysql_query_SNAPSHOT_DATESTAMP_END = $mysql_ENTRY_SNAPSHOT_YEAR."_".$mysql_ENTRY_SNAPSHOT_MONTH.$mysql_ENTRY_SNAPSHOT_DAY."_".$mysql_ENTRY_SNAPSHOT_HOUR.":".$mysql_ENTRY_SNAPSHOT_MIN.":00";
		$mysql_query_SNAPSHOT_DATESTAMP_START = $mysql_ENTRY_SNAPSHOT_LASTYEAR."_".$mysql_ENTRY_SNAPSHOT_LASTMONTH.$mysql_ENTRY_SNAPSHOT_LASTDAY."_".$mysql_ENTRY_SNAPSHOT_LASTHOUR.":30:00";

	} else {
		/* pass */
	}
}

/* HMI and REPORT DATE START and END USER INPUT FIELDS (ASK FOR) */
/* -- prompt user for input and build the form for submission */
/* -- TYPE 3 */
function core_user_date_time_range_prompt_type_3 ($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_ENTRY_DEFAULT_INTERVAL_NOTE,$post_note_to_use="NULL",$post_note_to_use_2="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_recordentry = core_user_date_time_range_prompt_type_3($custom_action_on_submit,$custom_term_for_machine_name,$custom_array_of_machine_names,$post_ENTRY_DEFAULT_INTERVAL_NOTE,$post_note_to_use="NULL",$post_note_to_use_2="NULL"); */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_REFERRINGPAGE;

	/*	-- APACHE */
	global $apache_THISYEAR, $apache_LASTYEAR,$apache_THISMONTH, $apache_THISDAYOFMONTH, $apache_THISHOUR, $apache_THISMINUTE, $apache_THISSECOND, $apache_FORMFILL_MANUAL_ENTRY_YEAR, $apache_FORMFILL_MANUAL_ENTRY_MONTH, $apache_FORMFILL_MANUAL_ENTRY_DAY, $apache_FORMFILL_MANUAL_ENTRY_HOUR, $apache_FORMFILL_MANUAL_ENTRY_MINUTE;

	/*	-- LANGUAGE */
	global $multilang_TANKMODEL_72, $multilang_TANKMODEL_73, $multilang_SPFMODEL_56, $multilang_SPFMODEL_57, $multilang_STATIC_NOTE, $multilang_STATIC_YEAR, $multilang_STATIC_MONTH, $multilang_STATIC_DAY, $multilang_STATIC_HOUR, $multilang_STATIC_MINUTE, $multilang_STATIC_DATESTAMP, $multilang_STATIC_START_OF_LOG, $multilang_STATIC_DISPLAY_REPORT_TICKET;


	/* EXECUTE */
	/* -- DISCRETE DATESTAMP TAGS */
	list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestamp();
	/* -- ZEROTHEHERO 0 to 200 */
	$apache_FORMFILL_ENTRIES_FOR_10_HOURS = zerothehero(1,120,1);

	$post_form_to_display = "
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						<!-- HMI and REPORT DATE START and END USER INPUT FIELDS (ASK FOR) -->
						<!-- TYPE 3 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

						<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='100'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_SPFMODEL_56." [".$post_ENTRY_DEFAULT_INTERVAL_NOTE."]. ".$multilang_SPFMODEL_57."
										</P>
									</TD>
								</TR>
								";
	if ($post_note_to_use != 'NULL') {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use."
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	if ($post_note_to_use_2 != 'NULL') {
		$post_form_to_display = $post_form_to_display."
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
										<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$post_note_to_use_2."
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	$post_form_to_display = $post_form_to_display."
								<TR>
									<TD>
										<B><I>".$custom_term_for_machine_name."</I></B>
									</TD>
									<TD COLSPAN='3'>
										<SELECT NAME='mysql_ENTRY_MACHINENAME'><OPTION VALUE=''>".$custom_term_for_machine_name.$custom_array_of_machine_names."</SELECT>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><I>".$multilang_TANKMODEL_72."</I></B>
									</TD>
									<TD COLSPAN='3'>
										<SELECT NAME='mysql_ENTRY_COUNT_REQUEST'><OPTION VALUE=''>".$multilang_TANKMODEL_72.$apache_FORMFILL_ENTRIES_FOR_10_HOURS."</SELECT>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='3'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_YEAR."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_MONTH."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_DAY."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_HOUR."</B>
												</TD>
												<TD WIDTH='100'>
													<B>".$multilang_STATIC_MINUTE."</B>
												</TD>
											</TR>
										</TABLE>
									</TD>
								</TR>
								<TR>
									<TD>
										<B><I>".$multilang_STATIC_DATESTAMP."<BR>
										[".$multilang_STATIC_START_OF_LOG."]</I></B>
									</TD>
									<TD COLSPAN='3'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_YEAR'><OPTION VALUE=''>".$multilang_STATIC_YEAR.$apache_FORMFILL_MANUAL_ENTRY_YEAR."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_MONTH'><OPTION VALUE=''>".$multilang_STATIC_MONTH.$apache_FORMFILL_MANUAL_ENTRY_MONTH."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_DAY'><OPTION VALUE=''>".$multilang_STATIC_DAY.$apache_FORMFILL_MANUAL_ENTRY_DAY."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_HOUR'><OPTION VALUE=''>".$multilang_STATIC_HOUR.$apache_FORMFILL_MANUAL_ENTRY_HOUR."</SELECT>
												</TD>
												<TD WIDTH='100'>
													<SELECT NAME='mysql_ENTRY_START_MINUTE'><OPTION VALUE=''>".$multilang_STATIC_MINUTE.$apache_FORMFILL_MANUAL_ENTRY_MINUTE."</SELECT>
												</TD>
											</TR>
										</TABLE>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT'>
										<B><I>".$multilang_TANKMODEL_73."</I></B>
									</TD>
									<TD>
										<INPUT TYPE='hidden' name='seer_HMIACTION' value='".$custom_action_on_submit."'>
										<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
							</TABLE>
						</FORM>

						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						";

	/* RETURN VARIABLES */
	return $post_form_to_display;
}

/* HMI and REPORT DATE START and END USER INPUT ACCEPTANCE */
/* -- handle input, throw a fault if bad, and */
/* -- indicate fault status as present or not */
/* -- TYPE 3 */
function core_user_date_time_range_input_type_3 ($custom_fault_for_missing_variable_machinename,$omit_datestamp="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* core_user_date_time_range_input_type_3($custom_fault_for_missing_variable_machinename); */
	/* -- to omit datestamp variable pull in, set $omitdatestamp = "OMITDATESTAMP"; */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;

	/*	-- MySQL */
	global $mysql_query_START_DATESTAMP, $mysql_ENTRY_MACHINENAME, $mysql_ENTRY_COUNT_REQUEST, $mysql_ENTRY_START_YEAR, $mysql_ENTRY_START_MONTH, $mysql_ENTRY_START_DAY, $mysql_ENTRY_START_HOUR, $mysql_ENTRY_START_MINUTE;

	/*	-- LANGUAGE */
	global $multilang_TANKMODEL_71, $multilang_FAULT_2, $multilang_FAULT_3, $multilang_FAULT_4, $multilang_FAULT_5, $multilang_FAULT_6;

	/* EXECUTE */
	/* -- PULL IN POST VARIABLES */
	if ( $_POST[mysql_ENTRY_MACHINENAME] != '' ) {
		$mysql_ENTRY_MACHINENAME = $_POST['mysql_ENTRY_MACHINENAME'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $custom_fault_for_missing_variable_machinename;
	}
	if ( $_POST[mysql_ENTRY_COUNT_REQUEST] != '' ) {
		$mysql_ENTRY_COUNT_REQUEST = $_POST['mysql_ENTRY_COUNT_REQUEST'];
	} else {
		$seer_HMIACTION_FAULT = 1;
		$seer_FAULT_TYPE = $multilang_TANKMODEL_71;
	}
	if ( $omit_datestamp != 'OMITDATESTAMP') {
		if ( $_POST[mysql_ENTRY_START_YEAR] != '' ) {
			$mysql_ENTRY_START_YEAR = $_POST['mysql_ENTRY_START_YEAR'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_2;
		}
		if ( $_POST[mysql_ENTRY_START_MONTH] != '' ) {
			$mysql_ENTRY_START_MONTH = $_POST['mysql_ENTRY_START_MONTH'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_3;
		}
		if ( $_POST[mysql_ENTRY_START_DAY] != '' ) {
			$mysql_ENTRY_START_DAY = $_POST['mysql_ENTRY_START_DAY'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_4;
		}
		if ( $_POST[mysql_ENTRY_START_HOUR] != '' ) {
			$mysql_ENTRY_START_HOUR = $_POST['mysql_ENTRY_START_HOUR'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_5;
		}
		if ( $_POST[mysql_ENTRY_START_MINUTE] != '' ) {
			$mysql_ENTRY_START_MINUTE = $_POST['mysql_ENTRY_START_MINUTE'];
		} else {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_6;
		}
	} else {
		/* pass */
	}
}

/* CERTIFICATION ACTION (RESULT) OUTPUT REPORT */
/* -- notifies the user of the result of their attempt to certify records. */
function core_user_certification_result_display ($custom_term_machinename, $custom_array_machine_names, $custom_mod_openopc_table_name)
{
	/* CALL THIS FUNCTION WITH */
	/* $markup = core_user_certification_result_display($custom_term_machinename, $custom_array_machine_names, $custom_mod_openopc_table_name); */

	/* GLOBALIZE VARIABLES */
	/* 	-- LANGUAGE */
	global $multilang_STATIC_RERUN_REPORT, $multilang_TANKMODEL_76, $multilang_TANKMODEL_77, $multilang_TANKMODEL_78, $multilang_TANKMODEL_79, $multilang_TANKMODEL_80, $multilang_TANKMODEL_81, $multilang_TANKMODEL_82, $multilang_TANKMODEL_83, $multilang_TANKMODEL_84, $multilang_TANKMODEL_38;

	/*	-- MYSQL */
	global $mysql_ENTRY_START_YEAR, $mysql_ENTRY_START_MONTH, $mysql_ENTRY_START_DAY, $mysql_ENTRY_START_HOUR, $mysql_ENTRY_START_MINUTE, $mysql_ENTRY_END_YEAR,$mysql_ENTRY_END_MONTH, $mysql_ENTRY_END_DAY, $mysql_ENTRY_END_HOUR, $mysql_ENTRY_END_MINUTE, $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, $mysql_query_START_DATESTAMP_CERT, $mysql_query_END_DATESTAMP_CERT, $mysql_ENTRY_MACHINENAME, $mysql_mod_openopc_HOST, $mysql_mod_openopc_DBNAME, $mysql_seer_access_USERNAME;

	/*	-- APACHE */
	global $apache_DEFAULTDATESTAMP;

	/* 	-- SEER */
	global $seer_REFERRINGPAGE;

	/* EXECUTE */
	$post_MARKUP = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- CERTIFICATION of RECORDS, RESULTS OF SUBMISSION -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' WIDTH='600' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='600'>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='CENTER'>
										<BR>
										".$multilang_TANKMODEL_76.": <B><I>".$mysql_ENTRY_MACHINENAME."</I></B>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
										<B>".$multilang_TANKMODEL_78.":</B> ... ".$mysql_ENTRY_MACHINENAME."<BR>
										<B>".$multilang_TANKMODEL_79.":</B> ... ".$mysql_mod_openopc_HOST."<BR>
										<B>".$multilang_TANKMODEL_80.": </B> ... ".$mysql_mod_openopc_DBNAME." - ".$custom_mod_openopc_table_name."<BR>
										<B>".$multilang_TANKMODEL_81.":</B> ... ".$mysql_query_START_DATESTAMP_CERT." -- ".$mysql_query_END_DATESTAMP_CERT."<BR>
										<BR>
										<B>".$multilang_TANKMODEL_82.":</B> ... ".$mysql_seer_access_USERNAME."<BR>
										<B>".$multilang_TANKMODEL_38.": </B> ... ".$apache_DEFAULTDATESTAMP."<BR>
										<BR>
									</TD>
								</TR>
							</TABLE>
							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD CLASS='hmicellborder1'>
											<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD WIDTH='350'>
													</TD>
													<TD WIDTH='50'>
													</TD>
													<TD WIDTH='350'>
													</TD>
												</TR>
												<TR>
													<TD COLSPAN='3'>
														<BR>
													</TD>
												</TR>
												<TR>
													<TD ALIGN='RIGHT' VALIGN='TOP'>
														<B><I>".$multilang_STATIC_RERUN_REPORT."... </I></B><BR>
													</TD>
													<TD>
														<BR>
													</TD>
													<TD ALIGN='LEFT'>
														<I>".$multilang_TANKMODEL_84."...</I><BR>
														<SELECT NAME='mysql_ENTRY_MACHINENAME'><OPTION VALUE=''>".$custom_term_machinename.$custom_array_machine_names."</SELECT>
														<INPUT TYPE='hidden' name='seer_HMIACTION' value='BUILDTICKET'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_YEAR' value='$mysql_ENTRY_START_YEAR'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_MONTH' value='$mysql_ENTRY_START_MONTH'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_DAY' value='$mysql_ENTRY_START_DAY'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_HOUR' value='$mysql_ENTRY_START_HOUR'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_START_MINUTE' value='$mysql_ENTRY_START_MINUTE'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_YEAR' value='$mysql_ENTRY_END_YEAR'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_MONTH' value='$mysql_ENTRY_END_MONTH'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_DAY' value='$mysql_ENTRY_END_DAY'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_HOUR' value='$mysql_ENTRY_END_HOUR'>
														<INPUT TYPE='hidden' name='mysql_ENTRY_END_MINUTE' value='$mysql_ENTRY_END_MINUTE'>
														<INPUT TYPE='hidden' name='mysql_query_START_DATESTAMP' value='$mysql_query_START_DATESTAMP'>
														<INPUT TYPE='hidden' name='mysql_query_END_DATESTAMP' value='$mysql_query_END_DATESTAMP'>
													</TD>
												</TR>
												<TR>
													<TD COLSPAN='3'>
														<BR>
													</TD>
												</TR>
												<TR>
													<TD COLSPAN='2'>
													</TD>
													<TD ALIGN='LEFT'>
														<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
													</TD>
												</TR>
												<TR>
													<TD COLSPAN='3'>
														<BR>
													</TD>
												</TR>
											</TABLE>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN MARKUP */
	return $post_MARKUP;
}

/* CERTIFICATION SUBMISSION FORM GENERATOR */
/* -- using a common layout for certificatied records, this form submits */
/*    user criteria and data variables */
function core_user_certification_submit_form ()
{
	/* CALL THIS FUNCTION WITH */
	/* $markup = core_user_certification_submit_form(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE;

	/*	-- LANGUAGE */
	global $multilang_TANKMODEL_67, $multilang_TANKMODEL_68, $multilang_TANKMODEL_90, $multilang_STATIC_NONE;

	/*	-- MYSQL */
	global $mysql_ENTRY_START_YEAR, $mysql_ENTRY_START_MONTH, $mysql_ENTRY_START_DAY, $mysql_ENTRY_START_HOUR, $mysql_ENTRY_START_MINUTE, $mysql_ENTRY_END_YEAR,$mysql_ENTRY_END_MONTH, $mysql_ENTRY_END_DAY, $mysql_ENTRY_END_HOUR, $mysql_ENTRY_END_MINUTE, $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, $mysql_ENTRY_MACHINENAME;

	/* EXECUTE */
	$post_MARKUP = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- CERTIFICATION of RECORDS, USER FORM for SUBMISSION -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
								<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='150'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='7'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='7' ALIGN='CENTER'>
											<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD CLASS='hmicellborder1'>
														<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
															<TR>
																<TD WIDTH='350'>
																</TD>
																<TD WIDTH='50'>
																</TD>
																<TD WIDTH='350'>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='3'>
																	<BR>
																</TD>
															</TR>															<TR>
																<TD ALIGN='RIGHT' VALIGN='TOP'>
																	<B><I>".$multilang_TANKMODEL_67."... </I></B><BR>
																	...".$multilang_TANKMODEL_68."
																</TD>
																<TD>
																	<BR>
																</TD>
																<TD ALIGN='LEFT'>
																	<B>".$multilang_TANKMODEL_90.":</B><BR>
																	<INPUT TYPE='text' size='30' maxlength='60' name='mysql_ENTRY_COMMENT' value='".$multilang_STATIC_NONE."'>
																	<INPUT TYPE='hidden' name='seer_HMIACTION' value='SAVETICKET'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_YEAR' value='$mysql_ENTRY_START_YEAR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_MONTH' value='$mysql_ENTRY_START_MONTH'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_DAY' value='$mysql_ENTRY_START_DAY'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_HOUR' value='$mysql_ENTRY_START_HOUR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_MINUTE' value='$mysql_ENTRY_START_MINUTE'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_YEAR' value='$mysql_ENTRY_END_YEAR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_MONTH' value='$mysql_ENTRY_END_MONTH'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_DAY' value='$mysql_ENTRY_END_DAY'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_HOUR' value='$mysql_ENTRY_END_HOUR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_MINUTE' value='$mysql_ENTRY_END_MINUTE'>
																	<INPUT TYPE='hidden' name='mysql_query_START_DATESTAMP' value='$mysql_query_START_DATESTAMP'>
																	<INPUT TYPE='hidden' name='mysql_query_END_DATESTAMP' value='$mysql_query_END_DATESTAMP'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='$mysql_ENTRY_MACHINENAME'>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='3'>
																	<BR>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='2'>
																</TD>
																<TD ALIGN='LEFT'>
																	<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='3'>
																	<BR>
																</TD>
															</TR>
														</TABLE>
													</TD>
												</TR>
											</TABLE>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN MARKUP */
	return $post_MARKUP;
}

/* CERTIFICATION SUBMISSION FORM GENERATOR VERSION 2 */
/* -- using a common layout for certificatied records, this form submits */
/*    user criteria and data variables */
/* -- version 2 for submissions where start / end datestamps are selectable */
function core_user_certification_submit_form_version_2 ()
{
	/* CALL THIS FUNCTION WITH */
	/* core_user_certification_submit_form_version_2(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE;

	/*	-- APACHE */
	global $apache_REPORT_RECORDENTRY;

	/*	-- LANGUAGE */
	global $multilang_TANKMODEL_67, $multilang_TANKMODEL_68, $multilang_TANKMODEL_90, $multilang_STATIC_NONE;

	/*	-- MYSQL */
	global $mysql_ENTRY_START_YEAR, $mysql_ENTRY_START_MONTH, $mysql_ENTRY_START_DAY, $mysql_ENTRY_START_HOUR, $mysql_ENTRY_START_MINUTE, $mysql_ENTRY_END_YEAR, $mysql_ENTRY_END_MONTH, $mysql_ENTRY_END_DAY, $mysql_ENTRY_END_HOUR, $mysql_ENTRY_END_MINUTE, $mysql_query_START_DATESTAMP, $mysql_query_END_DATESTAMP, $mysql_query_START_DATESTAMP_CERT, $mysql_query_END_DATESTAMP_CERT, $mysql_ENTRY_MACHINENAME;

	/* EXECUTE */
	$apache_REPORT_RECORDENTRY = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- CERTIFICATION of RECORDS, USER FORM for SUBMISSION -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>

							<!-- XXXX START - NAUGHTY INDENTATION DUE TO CODE WORKAROUND XX -->

							".$apache_REPORT_RECORDENTRY."

							<!-- XXXX END - NAUGHTY INDENTATION DUE TO CODE WORKAROUND XXXX -->

								<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='100'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='50'>
										</TD>
										<TD WIDTH='200'>
										</TD>
										<TD WIDTH='150'>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='7'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='7' ALIGN='CENTER'>
											<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD CLASS='hmicellborder1'>
														<TABLE CLASS='SMALL' WIDTH='750' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
															<TR>
																<TD WIDTH='350'>
																</TD>
																<TD WIDTH='50'>
																</TD>
																<TD WIDTH='350'>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='3'>
																	<BR>
																</TD>
															</TR>															<TR>
																<TD ALIGN='RIGHT' VALIGN='TOP'>
																	<B><I>".$multilang_TANKMODEL_67."... </I></B><BR>
																	...".$multilang_TANKMODEL_68."
																</TD>
																<TD>
																	<BR>
																</TD>
																<TD ALIGN='LEFT'>
																	<B>".$multilang_TANKMODEL_90.":</B><BR>
																	<INPUT TYPE='text' size='30' maxlength='60' name='mysql_ENTRY_COMMENT' value='".$multilang_STATIC_NONE."'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_YEAR' value='$mysql_ENTRY_START_YEAR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_MONTH' value='$mysql_ENTRY_START_MONTH'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_DAY' value='$mysql_ENTRY_START_DAY'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_HOUR' value='$mysql_ENTRY_START_HOUR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_START_MINUTE' value='$mysql_ENTRY_START_MINUTE'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_YEAR' value='$mysql_ENTRY_END_YEAR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_MONTH' value='$mysql_ENTRY_END_MONTH'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_DAY' value='$mysql_ENTRY_END_DAY'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_HOUR' value='$mysql_ENTRY_END_HOUR'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_END_MINUTE' value='$mysql_ENTRY_END_MINUTE'>
																	<INPUT TYPE='hidden' name='mysql_query_START_DATESTAMP' value='$mysql_query_START_DATESTAMP'>
																	<INPUT TYPE='hidden' name='mysql_query_END_DATESTAMP' value='$mysql_query_END_DATESTAMP'>
																	<INPUT TYPE='hidden' name='seer_HMIACTION' value='SAVETICKET'>
																	<INPUT TYPE='hidden' name='mysql_ENTRY_MACHINENAME' value='$mysql_ENTRY_MACHINENAME'>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='3'>
																	<BR>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='2'>
																</TD>
																<TD ALIGN='LEFT'>
																	<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
																</TD>
															</TR>
															<TR>
																<TD COLSPAN='3'>
																	<BR>
																</TD>
															</TR>
														</TABLE>
													</TD>
												</TR>
											</TABLE>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN MARKUP */
	/* -- WE'RE NOT RETURNING ANYTHING */
	/* -- -- MODIFICATIN OF $apache_REPORT_RECORDENTRY ACCOMPLISHES THE JOB */
	/*       OF WHAT THE ORIGINAL FORM OF THIS FUNCTION UNDERTOOK. */
}

/* LABEL COLUMN ROWS EVERY SO OFTEN */
/* -- simply throws up a row of column labels every so often */
function label_columns_as_a_row ($apache_COLUMN_LABEL_ROW,$label_every_x_rows="09")
{
	/* CALL THIS FUNCTION WITH */
	/* $apache_REPORT_RECORDENTRY_ROW_ID = label_columns_as_a_row($apache_COLUMN_LABEL_ROW,$label_every_x_rows); */

	/* GLOBALIZE VARIABLES */
	/* 	-- MYSQL */
	global $mysql_COLUMN_LABEL_INDEX;

	/* EXECUTE */
	$apache_REPORT_RECORDENTRY_ROW_ID = "";

	/* LABEL THE COLUMNS EVERY SO OFTEN */
	if ( $mysql_COLUMN_LABEL_INDEX == 0 ) {
		$apache_REPORT_RECORDENTRY_ROW_ID = $apache_COLUMN_LABEL_ROW;
	} else { 
		/* pass */
	}
	if ( $mysql_COLUMN_LABEL_INDEX == $label_every_x_rows ) {
		$mysql_COLUMN_LABEL_INDEX = 0;
	} else {
		$mysql_COLUMN_LABEL_INDEX = $mysql_COLUMN_LABEL_INDEX + 1;
	}

	/* RETURN VALUES */
	return $apache_REPORT_RECORDENTRY_ROW_ID;
}

/* AUTO FILL MANUAL RECORD ENTRY DATESTAMP FIELDS */
/* -- generates datestamps for automatic fill of manual record entry fields */
function auto_fill_manual_record_entry_datestamp_fields ($mysql_ENTRY_COUNT_REQUEST,$mysql_ENTRY_INTERVAL_MINUTES,$mysql_ENTRY_START_YEAR,$mysql_ENTRY_START_MONTH,$mysql_ENTRY_START_DAY,$mysql_ENTRY_START_HOUR,$mysql_ENTRY_START_MINUTE)
{
	/* CALL THIS FUNCTION WITH */
	/* $mysql_DATESTAMP = auto_fill_manual_record_entry_datestamp_fields($mysql_ENTRY_COUNT_REQUEST,$mysql_ENTRY_INTERVAL_MINUTES,$mysql_ENTRY_START_YEAR,$mysql_ENTRY_START_MONTH,$mysql_ENTRY_START_DAY,$mysql_ENTRY_START_HOUR,$mysql_ENTRY_START_MINUTE); */
	/* ... where $mysql_DATESTAMP is an array of datestamps */

	/* EXECUTE */
	/* -- MANIPULATE VARIABLES FOR DATESTAMPS */
	$mysql_ENTRY_YEAR = $mysql_ENTRY_START_YEAR;
	$mysql_ENTRY_MONTH = $mysql_ENTRY_START_MONTH;
	$mysql_ENTRY_DAY = $mysql_ENTRY_START_DAY;
	$mysql_ENTRY_HOUR = $mysql_ENTRY_START_HOUR;
	$mysql_ENTRY_MINUTE = $mysql_ENTRY_START_MINUTE;

	$mysql_ENTRY_INDEX = 1;
	while ( $mysql_ENTRY_INDEX <= $mysql_ENTRY_COUNT_REQUEST ) {

		/* -- BUILD THE UNIQUE DATESTAMP */
		$mysql_DATESTAMP[$mysql_ENTRY_INDEX] = $mysql_ENTRY_YEAR."_".$mysql_ENTRY_MONTH.$mysql_ENTRY_DAY."_".$mysql_ENTRY_HOUR.":".$mysql_ENTRY_MINUTE.":00";

		/* -- PREP FOR NEXT SEQUENTIAL UNIQUE DATESTAMP */
		$mysql_ENTRY_MINUTE = sprintf("%02d", ($mysql_ENTRY_MINUTE + $mysql_ENTRY_INTERVAL_MINUTES) );
		if ( $mysql_ENTRY_MINUTE > 59 ) {
			$mysql_ENTRY_MINUTE = sprintf("%02d", ($mysql_ENTRY_MINUTE - 60) );
			$mysql_ENTRY_HOUR = sprintf("%02d", ($mysql_ENTRY_HOUR + 1) );
		} else {
			/* pass */
		}

		if ( $mysql_ENTRY_HOUR > 23 ) {
			$mysql_ENTRY_HOUR = sprintf("%02d", ($mysql_ENTRY_HOUR - 24) );
			$mysql_ENTRY_DAY = sprintf("%02d", ($mysql_ENTRY_DAY + 1) );
		} else {
			/* pass */
		}

		if ( ($mysql_ENTRY_DAY > 28) && ($mysql_ENTRY_MONTH == 2) ) {
			/* -- JUST FEBRUARY */
			$mysql_ENTRY_DAY = sprintf("%02d", ($mysql_ENTRY_DAY - 28) );
			$mysql_ENTRY_MONTH = sprintf("%02d", ($mysql_ENTRY_MONTH + 1) );
			$mysql_ENTRY_DAY_CYCLING_METHOD = 'ABNORMAL';
		} else {
			if ( $mysql_ENTRY_DAY_CYCLING_METHOD != 'ABNORMAL' ) {
				$mysql_ENTRY_DAY_CYCLING_METHOD = 'NORMAL';
			} else {
				/* pass */
			}
		}

		if ( ($mysql_ENTRY_DAY > 30) && ( ($mysql_ENTRY_MONTH == 9) || ($mysql_ENTRY_MONTH == 4) || ($mysql_ENTRY_MONTH == 6) || ($mysql_ENTRY_MONTH == 11) ) ) {
			/* -- JUST SEPTEMBER APRIL JUNE AND NOVEMBER */
			$mysql_ENTRY_DAY = sprintf("%02d", (01) );
			$mysql_ENTRY_MONTH = sprintf("%02d", ($mysql_ENTRY_MONTH + 1) );
			$mysql_ENTRY_DAY_CYCLING_METHOD = 'ABNORMAL';
		} else {	
			if ( $mysql_ENTRY_DAY_CYCLING_METHOD != 'ABNORMAL' ) {
				$mysql_ENTRY_DAY_CYCLING_METHOD = 'NORMAL';
			} else {
				/* pass */
			}
		}
			
		if ( $mysql_ENTRY_DAY_CYCLING_METHOD == 'NORMAL' && $mysql_ENTRY_DAY > 31 ) {
			/* -- ALL THE OTHER MONTHS */
			$mysql_ENTRY_DAY = sprintf("%02d", ($mysql_ENTRY_DAY - 31) );
			$mysql_ENTRY_MONTH = sprintf("%02d", ($mysql_ENTRY_MONTH + 1) );
		} else {
			/* pass */
		}

		if ( $mysql_ENTRY_MONTH > 12 ) {
			$mysql_ENTRY_MONTH = sprintf("%02d", ($mysql_ENTRY_MONTH - 12) );
			$mysql_ENTRY_YEAR = $mysql_ENTRY_YEAR + 1;
		} else {
			/* pass */
		}

		/* -- INCREMENT */
		$mysql_ENTRY_INDEX = $mysql_ENTRY_INDEX + 1;

	}

	/* RETURN VALUES */
	return $mysql_DATESTAMP;
}

/* VERIFICATION ARRAY OF NULL VALUES FOR ITEMS */
/* -- allows setting all items in a set to 'no data available' (or something else) */
/*    in order to later be able to assign valid variables only to those that are */
/*    present, whilst the rest are not left undefined */
function core_verification_array_of_null_values_for_items ($post_null_value_to_fill_with,$index_start,$index_end)
{
	/* CALL THIS FUNCTION WITH... */
	/* core_verification_array_of_null_values_for_items($post_null_value_to_fill_with,$index_start,$index_end); */

	/* EXECUTE */
	$index = $index_start;
	while ( $index <= $index_end ) {			
		$item_array[$index] = $post_null_value_to_fill_with;
		$index = $index + 1;
	}

	/* RETURN VALUES */
	return $item_array;
}

/* NULL RETURN VALUE */
/* -- indicate that the item to be posted has resulted in a null */
/*    return value and cannot be analyzed or posted */
function core_indicate_null_return_values_for_items ($post_item,$post_error_message="NULL",$post_error_title="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_message_to_post = core_indicate_null_return_values_for_items($post_item,$post_error_message="NULL",$post_error_title="NULL"); */

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global $multilang_STATIC_ERROR_CALL_ADMIN, $multilang_STATIC_NO_DATA_AVAILABLE;

	/* HANDLE DEFAULT VARS */
	if ( $post_error_message == 'NULL' ) {
		$post_error_message = $multilang_STATIC_ERROR_CALL_ADMIN;
	} else {
		/* pass */
	}
	if ( $post_error_title == 'NULL' ) {
		$post_error_title = $multilang_STATIC_NO_DATA_AVAILABLE;
	} else {
		/* pass */
	}

	/* EXECUTE */
	$post_error_message = "
									<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
									<!-- GENERATED ERROR MESSAGE FOR ITEM THAT HAS RETURNED NULL VALUES -->
									<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

									-----------------------------------------------------------------------<BR>
									<B>".$post_item."</B> -- ".$post_error_title."<BR>
									".$post_error_message."<BR>
									<BR>
									-----------------------------------------------------------------------<BR>

									<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
									";

	/* RETURN VALUES */
	return $post_error_message;
}

/* ROW BACKGROUND COLOR via ODD OR EVEN MEASURE */
/* -- alternates background row colors */
function core_row_color_oddOReven ($post_VALUE_TO_MEASURE,$post_ROW_BGCOLOR="",$post_ROW_BGCOLOR_ALT="BGCOLOR='#DDDDDD'")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_row_bgcolor_to_use = core_row_color_oddOReven($post_VALUE_TO_MEASURE,$post_ROW_BGCOLOR,$post_ROW_BGCOLOR_ALT); */

	/* GLOBALIZE VARIABLES */
	/* 	-- APACHE */
	global $apache_SWITCH_ROW_COLOR;

	/* EXECUTE */
	$test = oddOReven($post_VALUE_TO_MEASURE);
	if ( $test == 'ODD' ) {
		$post_ROW_BGCOLOR_USE = $post_ROW_BGCOLOR;
	} else {
		/* pass */
	}
	if ( $test == 'EVEN' ) {
		$post_ROW_BGCOLOR_USE = $post_ROW_BGCOLOR_ALT;
	} else {
		/* pass */
	}

	/* RETURN VALUES */
	return $post_ROW_BGCOLOR_USE;
}

/* ROW BACKGROUND COLOR FLIP FLOPPER */
/* -- alternates background row colors */
function core_row_color_flip_flop ($post_ROW_BGCOLOR="",$post_ROW_BGCOLOR_ALT="BGCOLOR='#DDDDDD'")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_row_bgcolor_to_use = core_row_color_flip_flop($post_ROW_BGCOLOR,$post_ROW_BGCOLOR_ALT); */
	/* -- be sure the following variables are declared BEFORE calling... */
	/*	-- */

	/* GLOBALIZE VARIABLES */
	/* 	-- APACHE */
	global $apache_SWITCH_ROW_COLOR;

	/* EXECUTE */
	if ( $apache_SWITCH_ROW_COLOR == 1 ) {
		$post_ROW_BGCOLOR_USE = $post_ROW_BGCOLOR;
		$apache_SWITCH_ROW_COLOR = 0;
	} else {
		$post_ROW_BGCOLOR_USE = $post_ROW_BGCOLOR_ALT;
		$apache_SWITCH_ROW_COLOR = 1;
	}

	/* RETURN VALUES */
	return $post_ROW_BGCOLOR_USE;
}

/* SEER SYSTEM FAULT PAGE BODY */
/* -- if something goes wrong in a setup or backbone user */
/*    operation, we'll display it in this container */
function core_system_fault_page_body ($post_fault)
{
	/* CALL THIS FUNCTION WITH... */
	/* core_fault_page_body($post_fault); */
	/* -- be sure the following variables are declared BEFORE calling... */
	/*	-- */

	/* EXECUTE */
	$post_fault = "

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- FAULT OCCURRANCE ILLITRATION (SYSTEM) -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='100'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										".$post_fault."
									</TD>
								</TR>
							</TABLE>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";
	/* RETURN VARIABLES */
	return $post_fault;
}

/* ALIAS FOR ABOVE */
/* -- quick typographic fix... somehow a large portion of code was written with this function */
/*    defined in two different ways, so, this takes care of that. */
function core_fault_page_body ($post_fault) {

	/* EXECUTE */
	$post_fault = core_system_fault_page_body($post_fault);

	/* RETURN VARIABLES */
	return $post_fault;
}

/* HMI FAULT PAGE BODY */
/* -- if something goes wrong, whether it be bad user */
/*    input, or whatever, we throw a fault, and display */
/*    it in this container */
function core_user_conditionally_executed_fault_page_body ()
{
	/* CALL THIS FUNCTION WITH... */
	/* core_user_conditionally_executed_fault_page_body(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION, $seer_FAULT_TYPE;

	/*	-- APACHE */
	global $apache_REPORT_RECORDENTRY;

	/*	-- LANGUAGE */
	global $multilang_FAULT_12, $multilang_FAULT_13, $multilang_FAULT_14, $multilang_FAULT_15;

	/* EXECUTE */
	if ( $seer_HMIACTION == "DISPLAY_FAULT_PAGE" ) {
		
		$apache_REPORT_RECORDENTRY = "

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- FAULT OCCURRANCE ILLITRATION -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='200'>
										<BR>
									</TD>
									<TD WIDTH='100'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
											<B><U>".$multilang_FAULT_12.":</U></B> ".$multilang_FAULT_13."<BR>
											<BR>
											".$multilang_FAULT_14."<BR>
											<BR>
											<B><U>".$multilang_FAULT_15.":</U></B> ... ".$seer_FAULT_TYPE."
										</P>
									</TD>
								</TR>
							</TABLE>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";
	}
}

/* EXPORT TO CSV - SANTITIZE */
/* -- character replacement for invalid chars when */
/*    finishing up the export content for a csv */
function core_export_csv_sanitize ()
{
	/* CALL THIS FUNCTION WITH... */
	/* core_export_csv_sanitize(); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_EXPORT_CONTENT, $seer_CSV_WHITESPACE_HOLDING;

	/* EXECUTE */
	$seer_EXPORT_CONTENT = str_replace(" ", $seer_CSV_WHITESPACE_HOLDING, $seer_EXPORT_CONTENT);
}

/* MySQL MOD_OPENOPC QUERY SHELL */
/* -- run all db operations by the numbers, so to speak */
/*    and provide uniform return regardless of model */
function core_mysql_mod_openopc_query_shell ($shell_query,$shell_query_minimum_rows_ensure_good_query="0")
{
	/* CALL THIS FUNCTION WITH... */
	/* list($some_query_result,$some_query_row_count) = core_mysql_mod_openopc_query_shell($shell_query,$shell_query_minimum_rows_ensure_good_query); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;

	/*	-- MySQL */
	global $mysql_mod_openopc_CONNECT;

	/*	-- LANGUAGE */
	global $multilang_FAULT_39;

	/* EXECUTE */
	/* -- QUERY */
	mysqli_select_db($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_DBNAME);
	$shell_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $shell_query);
	if (!$shell_query_result) trigger_error("Something's not right... couldn't execute query to scan mod_openopc data. ----- ".$shell_query,E_USER_WARNING);
	if (is_bool($shell_query_result)) {
		$shell_query_num_rows = 0;
	} else {
		$shell_query_num_rows = mysqli_num_rows($shell_query_result);
	}
	/* -- MAKE SURE WE HAVE ENOUGH DATA TO RUN A VALID REPORT */
	if ( $shell_query_minimum_rows_ensure_good_query != 0 ) {
		if ( $shell_query_num_rows < $shell_query_minimum_rows_ensure_good_query ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_39;
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}

	/* RETURN VARIABLES */
	return array($shell_query_result,$shell_query_num_rows);
}

/* MySQL SEER QUERY SHELL */
/* -- run all db operations by the numbers, so to speak */
/*    and provide uniform return regardless of model */
function core_mysql_seer_query_shell ($shell_query,$shell_query_minimum_rows_ensure_good_query="0")
{
	/* CALL THIS FUNCTION WITH... */
	/* list($some_query_result,$some_query_row_count) = core_mysql_seer_query_shell($shell_query,$shell_query_minimum_rows_ensure_good_query); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_HMIACTION_FAULT, $seer_FAULT_TYPE;

	/*	-- MySQL */
	global $mysql_seer_CONNECT;

	/*	-- LANGUAGE */
	global $multilang_FAULT_39;

	/* EXECUTE */
	/* -- QUERY */

	mysqli_select_db($mysql_seer_CONNECT, $mysql_seer_DBNAME);
	$shell_query_result = mysqli_query($mysql_seer_CONNECT, $shell_query);
	if (!$shell_query_result) trigger_error("Something's not right... couldn't execute query to scan S.E.E.R. data. ----- ".$shell_query,E_USER_WARNING);
	if (is_bool($shell_query_result)) {
		$shell_query_num_rows = 0;
	} else {
		$shell_query_num_rows = mysqli_num_rows($shell_query_result);
	}
	/* -- MAKE SURE WE HAVE ENOUGH DATA TO RUN A VALID REPORT */
	if ( $shell_query_minimum_rows_ensure_good_query != 0 ) {
		if ( $shell_query_num_rows < $shell_query_minimum_rows_ensure_good_query ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_39;
			return null;
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}

	/* RETURN VARIABLES */
	return array($shell_query_result,$shell_query_num_rows);
}

/* MySQL SEER QUERY - WHAT IS THE USER'S REAL NAME */
/* -- return user's real name, provided username only */
function core_mysql_seer_whats_my_real_name ($post_USERNAME)
{
	/* CALL THIS FUNCTION WITH... */
	/* $users_real_name = core_mysql_seer_whats_my_real_name($post_USERNAME); */

	/* GLOBALIZE VARIABLES */
	/*	-- MYSQL */
	global $mysql_seer_CONNECT;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DNE, $multilang_STATIC_NA;

	/* EXECUTE */
	$mysql_seer_query = "SELECT REALNAME FROM access WHERE USERNAME LIKE '".$post_USERNAME."'";
	mysqli_select_db($mysql_seer_CONNECT, $mysql_seer_DBNAME);
	$mysql_seer_query_result = mysqli_query( $mysql_seer_CONNECT, $mysql_seer_query);
	list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query);

	if ( $mysql_seer_num_rows == 1 ) {
		$seer_USER_QUERY_INDEX = 0;
		while ( ($mysql_seer_query_row = mysqli_fetch_assoc($mysql_seer_query_result)) && ($seer_USER_QUERY_INDEX == 0) ) {
			if ( $mysql_seer_query_row['REALNAME'] != '' ) {
				$post_REALNAME = $mysql_seer_query_row['REALNAME'];
			} else {
				$post_REALNAME = $multilang_STATIC_DNE;
			}
			$seer_USER_QUERY_INDEX = $seer_USER_QUERY_INDEX + 1;
		}
	} else {
		if ( $post_USERNAME == '' ) {
			$post_REALNAME = $multilang_STATIC_NA;
		} else {
			$post_REALNAME = $multilang_STATIC_DNE;
		}
	}

	/* RETURN VARIABLES */
	return $post_REALNAME;
}

/* REGARDING CERTIFIED RECORDS - INDEXING THE DIGITAL SIGNATURES */
/* -- parse, sanitize, and pretty-print digital signatures into */
/*    a useable index. */
function core_certification_index_digital_signature ($post_CERT_USER,$post_CERT_DATESTAMP,$post_CERT_COUNT,$post_CERT_INDEX,$post_CERT_LABEL,$post_CERT_SIG)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($post_CERTIFIEDUSERREALNAME,$post_CERT_COUNT,$post_CERT_INDEX,$post_CERT_LABEL,$post_CERT_LABEL_THISONE,$post_CERT_SIG) = core_certification_index_digital_signature($post_CERT_USER,$post_CERT_DATESTAMP,$post_CERT_COUNT,$post_CERT_INDEX,$post_CERT_LABEL,$post_CERT_SIG); */
	/* ---------------------------------------------------------------------------------- */
	/* -- where 	$post_CERT_USER is the username field from the SEER access table */
	/* 		$post_CERT_DATESTAMP is the mod_openopc friendly datestamp of certification */
	/*		$post_CERT_COUNT is the current number of unique certifications */
	/*		$post_CERT_LABEL is the array of certification hyperlinks (same page) */
	/*		$post_CERT_SIG is the array of actual certification signatures */
	/* ---------------------------------------------------------------------------------- */
	/* -- returns	$post CERTIFIEDUSERREALNAME is the user's REALNAME entry in the SEER access table */
	/* 		$post_CERT_COUNT is the updated number of unique certifications */
	/*		$post_CERT_LABEL is the updated array of certification hyperlinks (same page) */
	/*		$post_CERT_LABEL_THISONE is the certification hyperlink for this very record */
	/*		$post_CERT_SIG is the updated array of actual certification signatures */
	/* ---------------------------------------------------------------------------------- */

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global $multilang_STATIC_AS_USER;

	/* EXECUTE */
	$post_CERTIFIEDUSERREALNAME = core_mysql_seer_whats_my_real_name($post_CERT_USER);

	$MODEL_CERTIFIEDSIG_FLUX = $post_CERT_USER." _@_ ".$post_CERT_DATESTAMP;
	$post_CERT_LABEL_THISONE = "";

	if ( $MODEL_CERTIFIEDSIG_FLUX != " _@_ " ) {
		$MODEL_CERTIFIEDSIG_FLUX = $post_CERTIFIEDUSERREALNAME." _".$multilang_STATIC_AS_USER."_ ".$MODEL_CERTIFIEDSIG_FLUX;
		$post_CERT_LABEL_THISONE_STATUS = "NEW";
		$MODEL_CERTIFIEDSIG_TEST_INDEX = 0;
		while ( $MODEL_CERTIFIEDSIG_TEST_INDEX < $post_CERT_COUNT ) {
			if ( $MODEL_CERTIFIEDSIG_FLUX == $post_CERT_SIG[$MODEL_CERTIFIEDSIG_TEST_INDEX] ) {						
				$post_CERT_LABEL_THISONE = $post_CERT_LABEL[$MODEL_CERTIFIEDSIG_TEST_INDEX];
				$post_CERT_LABEL_THISONE_STATUS = "EXISTING";
			} else {
				/* pass */							
			}
			$MODEL_CERTIFIEDSIG_TEST_INDEX = $MODEL_CERTIFIEDSIG_TEST_INDEX + 1;
		}
		if ( $post_CERT_LABEL_THISONE_STATUS == 'NEW' ) {
			$post_CERT_SIG[$post_CERT_INDEX] = $MODEL_CERTIFIEDSIG_FLUX;
			$post_CERT_LABEL[$post_CERT_INDEX] = "<A HREF='#SIGNATURE".$post_CERT_INDEX."'>SIG - #".$post_CERT_INDEX."</A>";
			$post_CERT_LABEL_THISONE = $post_CERT_LABEL[$post_CERT_INDEX];
			$post_CERT_INDEX = $post_CERT_INDEX + 1;
			$post_CERT_COUNT = $post_CERT_COUNT + 1;
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}

	/* RETURN VARIABLES */
	return array($post_CERTIFIEDUSERREALNAME,$post_CERT_COUNT,$post_CERT_INDEX,$post_CERT_LABEL,$post_CERT_LABEL_THISONE,$post_CERT_SIG);
}

/* REGARDING CERTIFIED RECORDS - INDEXING THE DIGITAL COMMENTS */
/* -- parse, sanitize, and pretty-print digital comments into */
/*    a useable index. */
function core_certification_index_digital_comment ($post_CERTIFIEDCOMMENT,$post_CERTIFIEDCOMMENT_COUNT,$post_CERTIFIEDCOMMENT_INDEX,$post_CERTIFIEDCOMMENT_ARRAY,$post_CERTIFIEDCOMMENT_LABEL_ARRAY)
{
	/* CALL THIS FUNCTION WITH... */
	/* list($post_CERTIFIEDCOMMENT_COUNT,$post_CERTIFIEDCOMMENT_INDEX,$post_CERTIFIEDCOMMENT_ARRAY,$post_CERTIFIEDCOMMENT_LABEL_ARRAY,$post_CERTIFIEDCOMMENT_LABEL_THISONE) = core_certification_index_digital_comment($post_CERTIFIEDCOMMENT,$post_CERTIFIEDCOMMENT_COUNT,$post_CERTIFIEDCOMMENT_INDEX,$post_CERTIFIEDCOMMENT_ARRAY,$post_CERTIFIEDCOMMENT_LABEL_ARRAY); */
	/* -- this is much like the above "... digitial signature" function */

	/* EXECUTE */
	$post_CERTIFIEDCOMMENT_LABEL_THISONE = "";
	if ( $post_CERTIFIEDCOMMENT != '' ) {
		$post_CERTIFIEDCOMMENT_LABEL_THISONE_STATUS = "NEW";
		$MODEL_CERTIFIEDCOMMENT_TEST_INDEX = 0;
		while ( $MODEL_CERTIFIEDCOMMENT_TEST_INDEX < $post_CERTIFIEDCOMMENT_COUNT ) {
			if ( $post_CERTIFIEDCOMMENT == $post_CERTIFIEDCOMMENT_ARRAY[$MODEL_CERTIFIEDCOMMENT_TEST_INDEX] ) {						
				$post_CERTIFIEDCOMMENT_LABEL_THISONE = $post_CERTIFIEDCOMMENT_LABEL_ARRAY[$MODEL_CERTIFIEDCOMMENT_TEST_INDEX];
				$post_CERTIFIEDCOMMENT_LABEL_THISONE_STATUS = "EXISTING";
			} else {
				/* pass */							
			}
			$MODEL_CERTIFIEDCOMMENT_TEST_INDEX = $MODEL_CERTIFIEDCOMMENT_TEST_INDEX + 1;
		}

		if ( $post_CERTIFIEDCOMMENT_LABEL_THISONE_STATUS == 'NEW' ) {
			$post_CERTIFIEDCOMMENT_ARRAY[$post_CERTIFIEDCOMMENT_INDEX] = $post_CERTIFIEDCOMMENT;
			$post_CERTIFIEDCOMMENT_LABEL_ARRAY[$post_CERTIFIEDCOMMENT_INDEX] = "<A HREF='#COMMENT".$post_CERTIFIEDCOMMENT_INDEX."'>C - #".$post_CERTIFIEDCOMMENT_INDEX."</A>";
			$post_CERTIFIEDCOMMENT_LABEL_THISONE = $post_CERTIFIEDCOMMENT_LABEL_ARRAY[$post_CERTIFIEDCOMMENT_INDEX];
			$post_CERTIFIEDCOMMENT_INDEX = $post_CERTIFIEDCOMMENT_INDEX + 1;
			$post_CERTIFIEDCOMMENT_COUNT = $post_CERTIFIEDCOMMENT_COUNT + 1;
		} else {
			/* pass */
		}

	} else {
		/* pass */
	}

	/* RETURN VARIABLES */
	return array($post_CERTIFIEDCOMMENT_COUNT,$post_CERTIFIEDCOMMENT_INDEX,$post_CERTIFIEDCOMMENT_ARRAY,$post_CERTIFIEDCOMMENT_LABEL_ARRAY,$post_CERTIFIEDCOMMENT_LABEL_THISONE);
}

/* HMI TICKET TOP PLATE */
/* -- display the time range and current data freshness of the hmi as well as some */
/*    indication of what machine or device it is on */
function core_hmi_ticket_top_plate ($freshtime,$time_window_type,$time_window_UM="NULL",$time_window_length="NULL",$hmi_NOTE_1="NULL",$hmi_NOTE_2="NULL",$hmi_NOTE_3="NULL",$hmi_NOTE_4="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($freshtime,$time_window_type,$time_window_UM,$time_window_length,$hmi_NOTE_1="NULL",$hmi_NOTE_2="NULL",$hmi_NOTE_3="NULL",$hmi_NOTE_4="NULL"); */
	/* -- where $time_window_type is a string matching "WINDOW", "SNAPSHOT" */

	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_DEFAULTDATESTAMP;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NOTE, $multilang_STATIC_CURRENT_TIME, $multilang_SETTINGS_DATA_FRESH_AS_OF,$multilang_STATIC_EXAMINATION_WINDOW;

	/* EXECUTE */
	$post_topplate_to_return = "
							<!-- XXXXXXXXXXXX -->
							<!-- HMI TOPPLATE -->
							<!-- XXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
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
									<TD COLSPAN='4' ALIGN='CENTER'>
										".$multilang_STATIC_CURRENT_TIME.": ...<B>".$apache_DEFAULTDATESTAMP."</B>
									</TD> 
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='4' ALIGN='CENTER'>
										".$multilang_SETTINGS_DATA_FRESH_AS_OF.": ...<B>".$freshtime."</B>
									</TD>
								</TR>
								";
	if ($time_window_type == 'WINDOW') {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD COLSPAN='5' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD COLSPAN='4' ALIGN='CENTER'>
										".$multilang_STATIC_EXAMINATION_WINDOW.": ...<B>".$time_window_length." [".$time_window_UM."]</B>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}
	$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD COLSPAN='9'>
										<BR>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'>
									</TD>
								</TR>
								";

	if ( $hmi_NOTE_1 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD COLSPAN='9' ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$hmi_NOTE_1."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	if ( $hmi_NOTE_2 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD COLSPAN='9' ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$hmi_NOTE_2."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	if ( $hmi_NOTE_3 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD COLSPAN='9' ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$hmi_NOTE_3."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	if ( $hmi_NOTE_4 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD COLSPAN='9' ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$hmi_NOTE_4."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	$post_topplate_to_return = $post_topplate_to_return."
							</TABLE>

							<!-- XXXXXXXXXXXX -->
							";

	/* RETURN VARIABLES */
	return $post_topplate_to_return;
}

/* REPORT TICKET TOP PLATE WITH EXPORT HEADER INCLUDED */
/* -- display a start and end range for the report as well as some */
/*    indication of what machine or device it is on */
/* -- include the link to retrieve export content */
function core_report_ticket_top_plate_and_export_link ($export_MACHINENAME,$export_type,$export_START_DATESTAMP,$export_END_DATESTAMP,$export_NOTE_1="NULL",$export_NOTE_2="NULL",$export_NOTE_3="NULL",$export_NOTE_4="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_REPORT_TOPPLATE = core_report_ticket_top_plate_and_export_link($export_MACHINENAME,$export_type,$export_START_DATESTAMP,$export_END_DATESTAMP,$export_NOTE_1,$export_NOTE_2,$export_NOTE_3,$export_NOTE_4); */
	/* -- where $export_type is a string matching "csv", "txt", etc... */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO, $seer_EXPORT_CONTENT;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NOTE, $multilang_STATIC_REPORT_TICKET_FOR, $multilang_STATIC_EXPORT_HEADER, $multilang_STATIC_EXPORT_REPORT;

	/* EXECUTE */
	$post_topplate_to_return = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- REPORT TOPPLATE WITH EXPORT LINK INCLUDED -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD CLASS='reportticketlabel'>
										<BR>
										".$multilang_STATIC_REPORT_TICKET_FOR.": <B><I>".$export_MACHINENAME."</I></B><BR>
										<B><I>".$export_START_DATESTAMP."</I></B> -- <B><I>".$export_END_DATESTAMP."</I></B><BR>
									</TD>
								</TR>
								";

	if ( $export_NOTE_1 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$export_NOTE_1."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	if ( $export_NOTE_2 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$export_NOTE_2."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	if ( $export_NOTE_3 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$export_NOTE_3."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	if ( $export_NOTE_4 != 'NULL' ) {
		$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD ALIGN='LEFT'>
										<P CLASS='STANDARDTABLETEXTSIZE' ALIGN='LEFT'>
											<BR>
											<B>".$multilang_STATIC_NOTE."</B>: ".$export_NOTE_4."<BR>
										</P>
									</TD>
								</TR>
								";
	} else {
		/* pass */
	}

	$post_topplate_to_return = $post_topplate_to_return."
								<TR>
									<TD>
										<P CLASS='INFOREPORT'>
											<BR>
											<B><U>".$multilang_STATIC_EXPORT_HEADER.":</U></B><BR>
											<IMG SRC='./img/clearspace_20px.png'>".$multilang_STATIC_EXPORT_REPORT."...<BR>
											<FORM ACTION='./seer_exports.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
												<INPUT TYPE='hidden' name='seer_EXPORT_EXTENSION' value='".$export_type."'>
												<INPUT TYPE='hidden' name='seer_EXPORT_CONTENT' value='".$seer_EXPORT_CONTENT."'>
												<IMG SRC='./img/clearspace_20px.png' WIDTH='60'><INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
											</FORM>
										</P>
									</TD>
								</TR>
							</TABLE>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN VARIABLES */
	return $post_topplate_to_return;
}

/* REPORT TICKET TOP PLATE EXTENSION - ADDITIONAL EXPORT */
/* -- include the link to display additional export options */
function core_report_ticket_top_plate_extension_additional_export ($EXPORT_HEADER, $EXPORT_DESCRIPTION, $export_type, $seer_EXPORT_PAGETITLE, $seer_EXPORT_CONTENT)
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_REPORT_TOPPLATE_EXTENSION = core_report_ticket_top_plate_extension_additional_export($EXPORT_HEADER, $EXPORT_DESCRIPTION, $export_type, $seer_EXPORT_PAGETITLE, $seer_EXPORT_CONTENT); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_ADDKEYINFO;

	/* EXECUTE */
	$MARKUP_TO_RETURN = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- ADDITIONAL EXPORT GENERATED MARKUP -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<FORM ACTION='./seer_exports.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
								<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD>
											<P CLASS='INFOREPORT'>
												<B><U>".$EXPORT_HEADER.":</U></B><BR>
												<IMG SRC='./img/clearspace_20px.png'>".$EXPORT_DESCRIPTION."...<BR>
												<INPUT TYPE='hidden' name='seer_EXPORT_EXTENSION' value='".$export_type."'>
												<INPUT TYPE='hidden' name='seer_EXPORT_CONTENT' value=\"".$seer_EXPORT_CONTENT."\">
												<INPUT TYPE='hidden' name='seer_EXPORT_PAGETITLE' value=\"".$seer_EXPORT_PAGETITLE."\">
												<IMG SRC='./img/clearspace_20px.png' WIDTH='60'><INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'><BR>
											</P>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN MARKUP */
	return $MARKUP_TO_RETURN;
}

/* REPORT TICKET TOP PLATE EXTENSION - PopUP Canvas */
/* -- include the link to display content in PopUP Canvas */
function core_report_ticket_top_plate_extension_popup_canvas ($LANGUAGE_TO_USE="NULL",$TITLE_TO_USE="NULL",$CONTENT_TO_USE="NULL",$CANVAS_SIZE_TO_USE="NULL")
{
	/* CALL THIS FUNCTION WITH... */
	/* $apache_REPORT_TOPPLATE_EXTENSION = core_report_ticket_top_plate_extension_popup_canvas($LANGUAGE_TO_USE,$TITLE_TO_USE,$CONTENT_TO_USE,[$CANVAS_SIZE_TO_USE | or BLANK]); */

	/* GLOBALIZE VARIABLES */
	/* 	-- APACHE */
	global $apache_SERVER_NAME_OR_IP, $apache_seer_VERSION;
	/*	-- LANGUAGE */
	global $multilang_CANVAS_4, $multilang_STATIC_DISPLAY;

	/* EXECUTE */
	if ( ($LANGUAGE_TO_USE != 'NULL') && ($TITLE_TO_USE != 'NULL') && ($CONTENT_TO_USE != 'NULL') ) {
		if ($CANVAS_SIZE_TO_USE == 'NULL') {
			/* ALLOW CANVAS SIZE SELECTION BY USER */
			$CANVAS_SIZE_FORM_MARKUP = "
											".$multilang_STATIC_DISPLAY.": <SELECT NAME='seer_CANVAS_SIZE'><OPTION VALUE='1750'>--1750--<OPTION VALUE='250'>250<OPTION VALUE='500'>500<OPTION VALUE='750'>750<OPTION VALUE='1000'>1000<OPTION VALUE='1250'>1250<OPTION VALUE='1500'>1500<OPTION VALUE='1750'>1750<OPTION VALUE='2000'>2000<OPTION VALUE='2250'>2250<OPTION VALUE='2500'>2500<OPTION VALUE='2750'>2750<OPTION VALUE='3000'>3000<OPTION VALUE='3250'>3250<OPTION VALUE='3500'>3500<OPTION VALUE='3750'>3750<OPTION VALUE='4000'>4000</SELECT>
											";
		} else {
			/* PREDECLARED CANVAS SIZE */
			$CANVAS_SIZE_FORM_MARKUP = "
											<INPUT TYPE='hidden' name='seer_CANVAS_SIZE' value='".$CANVAS_SIZE_TO_USE."'>
											";
		}
		$MARKUP_TO_RETURN = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- CANVAS PopUP GENERATED MARKUP -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<FORM ACTION='http://".$apache_SERVER_NAME_OR_IP."/".$apache_seer_VERSION."/seer_canvas.php?seer_LANGUAGE=".$LANGUAGE_TO_USE."' METHOD='post' TARGET='PopUP_CANVAS'>
								<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD>
											<P CLASS='INFOREPORT'>
												<B><U>".$multilang_CANVAS_4.":</U></B><BR>
												<IMG SRC='./img/clearspace_20px.png' WIDTH='60'>".$CANVAS_SIZE_FORM_MARKUP."<BR>
												<INPUT TYPE='hidden' name='seer_CANVAS_TITLE' value='".$TITLE_TO_USE."'>
												<INPUT TYPE='hidden' name='seer_CANVAS_CONTENT' value=\"".$CONTENT_TO_USE."\">
												<IMG SRC='./img/clearspace_20px.png' WIDTH='60'><INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'><BR>
											</P>
										</TD>
									</TR>
								</TABLE>
							</FORM>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";
	} else {
		$MARKUP_TO_RETURN = "
							<P>
								FATAL EXCEPTION GENERATING PopUP CANVAS MARKUP!
							</P>
							";
	}

	/* RETURN MARKUP */
	return $MARKUP_TO_RETURN;
}

/* ZERO FAULT OUTPUT */
/* -- generic output when no faults are found for a report */
/* -- that is actually looking for faults */
function core_zero_fault_output ()
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_report = core_zero_fault_output(); */

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global $multilang_STATIC_CONGRATULATIONS, $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;

	/* EXECUTE */
	$post_MARKUP = "
							<!-- XXXXXXXXXXXXXXXXX -->
							<!-- ZERO FAULT OUTPUT -->
							<!-- XXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<BR>
									</TD>
									<TD WIDTH='600'>
										<P CLASS='INFOREPORT'>
											<B><U>".$multilang_STATIC_CONGRATULATIONS."</U></B><BR>
											<BR>
											".$multilang_STATIC_NO_FAULTS_IN_SNAPSHOT."<BR>
										</P>
									</TD>
									<TD WIDTH='150'>
										<BR>
									</TD>
								</TR>
							</TABLE>

							<!-- XXXXXXXXXXXXXXXXX -->
							";

	/* RETURN VARIABLES */
	return $post_MARKUP;
}

/* PLOT - GENERIC PLOT TITLE (HEADER) */
/* -- generic plot title or header, also used to indicate the */
/*    beginning of a new portion of a report */
function core_generic_plot_header ($post_TITLE,$post_DESCRIPTION)
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_report = core_generic_plot_header($post_TITLE,$post_DESCRIPTION); */

	/* EXECUTE */
	$post_MARKUP = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- PLOT - GENERIC HEADER or TITLE BREAK -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD>
										<P CLASS='INFOREPORTBIGTEXT'>
											<BR>
											[".$post_TITLE."] ".$post_DESCRIPTION."...
										</P>
									</TD>
								</TR>
							</TABLE>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN VARIABLES */
	return $post_MARKUP;
}

/* PLOT - PARETO */
/* -- determine limits and range of pareto */
/* -- plot in order from highest to lowest */
function core_pareto_determination_and_plot ($post_RANK_METHOD="DURATION",$post_NAME_ENTRY_COLUMN, $post_POTENTIAL_ENTRIES_COUNT, $post_POTENTIAL_ENTRIES_ARRAY, $post_ACTUAL_ITEM_ARRAY, $post_NO_ALARM_STATE="NO")
{
	/* CALL THIS FUNCTION WITH... */
	/* $my_pareto_plot_html_markup = core_pareto_determination_and_plot ($post_NAME_ENTRY_COLUMN, $post_POTENTIAL_ENTRIES_COUNT, $post_POTENTIAL_ENTRIES_ARRAY, $post_ACTUAL_ITEM_ARRAY, $post_NO_ALARM_STATE="NO") */
	/* -- where (for example)...
		$post_RANK_METHOD = "DURATION" or "FREQUENCY" (no other available choices)
		$post_NAME_ENTRY_COLUMN = $multilang_CIPMODEL_58 (ex. 'FAULT' or 'STATUS')
		$post_POTENTIAL_ENTRIES_COUNT = $CIPMODEL_STATUS_COUNT_ADJUSTED
		$post_POTENTIAL_ENTRIES_ARRAY = $CIPMODEL_STATUS
		$post_ACTUAL_ITEM_ARRAY = $fault_container_TOTAL_TOPRATED
			requires subarrays...
			-- "frequency"
			-- "fault"	(even if it's a status or something else, the subarray
					must be called "fault")
			-- "duration_unixtime"
			-- "duration_human_readable" 
		$post_NO_ALARM_STATE="YES" or "NO", default is "NO" */

	/* GLOBALIZE VARIABLES */
	/*	-- LANGUAGE */
	global $multilang_STATIC_RANK, $multilang_STATIC_UNKNOWN, $multilang_STATIC_DURATION;

	/* EXECUTE */
	$post_PARETO_PLOT = $post_PARETO_PLOT."
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- PARETO RANKED ITEM PLOT (TYPICALLY FAULT, STATE, OR INCIDENT) -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<TABLE CLASS='SMALL' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='50'>
										<B><U>".$multilang_STATIC_RANK."</U></B>
									</TD>
									<TD WIDTH='50'>
										<B><U>&#35</U></B>
									</TD>
									<TD WIDTH='200'>
										<B><U>".$post_NAME_ENTRY_COLUMN."</U></B>
									</TD>
									<TD WIDTH='100' ALIGN='RIGHT'>
										<B><U>".$multilang_STATIC_DURATION."</U></B>
									</TD>
									<TD WIDTH='25'>
										<BR>
									</TD>
									<TD WIDTH='475'>
										<BR>
									</TD>
								</TR>				
								";

	$mysql_query_internal_index = 0;
	$MACHINEMODEL_WORKING_POST_PARETO_RANK = 1;
	$mysql_query_first_pass = 0;
	while ( $mysql_query_internal_index <= $post_POTENTIAL_ENTRIES_COUNT ) {
		
		$fault_container_TOPRATED_CHECK = $post_ACTUAL_ITEM_ARRAY["frequency"][$mysql_query_internal_index];
		
		if ( $fault_container_TOPRATED_CHECK >= 0 ) {
		
			$MACHINEMODEL_WORKING_POST_FREQUENCY = $post_ACTUAL_ITEM_ARRAY["frequency"][$mysql_query_internal_index];
			$MACHINEMODEL_WORKING_POST_FAULT = $post_ACTUAL_ITEM_ARRAY["fault"][$mysql_query_internal_index];
			$MACHINEMODEL_WORKING_POST_DURATION = $post_ACTUAL_ITEM_ARRAY["duration_human_readable"][$mysql_query_internal_index];
			if ($post_RANK_METHOD == 'FREQUENCY') {
				$MACHINEMODEL_WORKING_POST_DURATION_FOR_PLOT = $post_ACTUAL_ITEM_ARRAY["frequency"][$mysql_query_internal_index];
			} else {
				$MACHINEMODEL_WORKING_POST_DURATION_FOR_PLOT = $post_ACTUAL_ITEM_ARRAY["duration_unixtime"][$mysql_query_internal_index];
			}

			if ( $mysql_query_first_pass == 0 ) {
						
				/* DECLARE THE LIMITS OF OUR PLOTTING RANGE BASED ON THE MAGNITUDE */
				/* OF THE MOST SIGNIFICANT ENTRY */
				$MACHINEMODEL_PARETO_SCALE_FACTOR = (475 / $MACHINEMODEL_WORKING_POST_DURATION_FOR_PLOT);

				/* COMPLETE FIRST PASS */
				$mysql_query_first_pass = 1;

			} else {
				/* pass */
			}

			/* SCALE DURATION FOR PLOT */
			$MACHINEMODEL_WORKING_POST_DURATION_FOR_PLOT = round($MACHINEMODEL_PARETO_SCALE_FACTOR * $MACHINEMODEL_WORKING_POST_DURATION_FOR_PLOT);
			/* GENERATE THE PLOT IMAGE */
			$MACHINEMODEL_WORKING_POST_PARETO_ENTRY = "<IMG SRC='./img/horizontal_bar.png' WIDTH=".$MACHINEMODEL_WORKING_POST_DURATION_FOR_PLOT." HEIGHT=10 ALT='HORIZONTAL BAR'>";

			/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
			$MACHINEMODEL_WORKING_POST_FAULT = $post_POTENTIAL_ENTRIES_ARRAY[$MACHINEMODEL_WORKING_POST_FAULT];
			if ( $MACHINEMODEL_WORKING_POST_FAULT == '' ) {
				$MACHINEMODEL_WORKING_POST_FAULT = ".$multilang_STATIC_UNKNOWN.";
			} else {
				/* pass */
			} 

			/* DONT POST 'NO ALARM' STATE */
			if ( ($MACHINEMODEL_WORKING_POST_FAULT != $post_POTENTIAL_ENTRIES_ARRAY[0]) || ($post_NO_ALARM_STATE == 'YES') ) {

				$post_PARETO_PLOT = $post_PARETO_PLOT."
								<TR>
									<TD>
										".$MACHINEMODEL_WORKING_POST_PARETO_RANK."
									</TD>
									<TD>
										".$MACHINEMODEL_WORKING_POST_FREQUENCY."
									</TD>
									<TD>
										".$MACHINEMODEL_WORKING_POST_FAULT."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MACHINEMODEL_WORKING_POST_DURATION."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										".$MACHINEMODEL_WORKING_POST_PARETO_ENTRY."
									</TD>
								</TR>				
								";

				$MACHINEMODEL_WORKING_POST_PARETO_RANK = $MACHINEMODEL_WORKING_POST_PARETO_RANK + 1;

			} else {
				/* pass */
			}
		
		} else {
			/* pass */
		}
		
		$mysql_query_internal_index = $mysql_query_internal_index + 1;
	}
			
	$post_PARETO_PLOT = $post_PARETO_PLOT."
							</TABLE>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";

	/* RETURN VARIABLES */
	return $post_PARETO_PLOT;
}

/* PLOT - STANDARD DEVIATION */
/* -- determine the standard deviation from target */
/* -- plot 3 over and 3 under sigma with overrange */
function core_standard_deviation_determination_and_plot ()
{
	/* CALL THIS FUNCTION WITH... */
	/* list($apache_REPORT_STDEV_PLOT_XYZ,$apache_REPORT_STDEV_XYZ) = core_standard_deviation_determination_and_plot(); */
	/* -- returns pretty print HTML for the plot */
	/* -- be sure following variables are decalred BEFORE calling... */
	/*	-- 	$post_BAR_GRAPH_TITLE
			$post_BAR_GRAPH_HEIGHT
			$post_RECORDS_EXAMINED
			$recycle_array_ITEM
			$post_TARGET_TO_MEASURE_DEVIATION_FROM
	*/

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $post_RECORDS_EXAMINED, $recycle_array_ITEM, $post_TARGET_TO_MEASURE_DEVIATION_FROM, $post_BAR_GRAPH_TITLE, $post_BAR_GRAPH_HEIGHT;

	/* EXECUTE */
	/* -- DETERMINE STANDARD DEVIATION */
	$post_ITEM_WORKING_DEVIATION_SQUARED_TOTAL = 0;
	$post_index = 1;
	while ($post_index <= $post_RECORDS_EXAMINED) {

		$post_ITEM_WORKING_DEVIATION[$post_index] = varcharTOnumeric2(($recycle_array_ITEM[$post_index] - $post_TARGET_TO_MEASURE_DEVIATION_FROM), 6);
		$post_ITEM_WORKING_DEVIATION_SQUARED = abs($post_ITEM_WORKING_DEVIATION[$post_index]);
		$post_ITEM_WORKING_DEVIATION_SQUARED = pow($post_ITEM_WORKING_DEVIATION_SQUARED, 2);
		$post_ITEM_WORKING_DEVIATION_SQUARED_TOTAL = varcharTOnumeric2(($post_ITEM_WORKING_DEVIATION_SQUARED_TOTAL + $post_ITEM_WORKING_DEVIATION_SQUARED), 6);

		$post_index = $post_index + 1;

		}

	$post_ITEM_WORKING_DEVIATION_STANDARD = varcharTOnumeric2((sqrt($post_ITEM_WORKING_DEVIATION_SQUARED_TOTAL / $post_RECORDS_EXAMINED)), 6);

	/* -- DETERMINE SIX SIGMA PLOT RANGE */
	$post_ITEM_sigma_minus_3x = $post_ITEM_WORKING_DEVIATION_STANDARD * (-3);
	$post_ITEM_sigma_minus_2x = $post_ITEM_WORKING_DEVIATION_STANDARD * (-2);
	$post_ITEM_sigma_minus_1x = $post_ITEM_WORKING_DEVIATION_STANDARD * (-1);
	$post_ITEM_sigma_plus_1x = $post_ITEM_WORKING_DEVIATION_STANDARD * (1);
	$post_ITEM_sigma_plus_2x = $post_ITEM_WORKING_DEVIATION_STANDARD * (2);
	$post_ITEM_sigma_plus_3x = $post_ITEM_WORKING_DEVIATION_STANDARD * (3);

	/* -- CATEGORIZE EACH DEVIATION INTO ONE OF THE SIX PRIMARY or TWO OUTLYING GROUPS */
	$sigma_index = 1;
	while ($sigma_index <= $post_RECORDS_EXAMINED) {
		if ($post_ITEM_WORKING_DEVIATION[$sigma_index] < $post_ITEM_sigma_minus_3x) {
				$post_ITEM_sigma_COUNT_minus_BEYOND3x = $post_ITEM_sigma_COUNT_minus_BEYOND3x + 1;
			} else {
				if ( ($post_ITEM_WORKING_DEVIATION[$sigma_index] >= $post_ITEM_sigma_minus_3x) && ($post_ITEM_WORKING_DEVIATION[$sigma_index] < $post_ITEM_sigma_minus_2x) ) {
					$post_ITEM_sigma_COUNT_minus_3x = $post_ITEM_sigma_COUNT_minus_3x + 1;
				} else {
					if ( ($post_ITEM_WORKING_DEVIATION[$sigma_index] >= $post_ITEM_sigma_minus_2x) && ($post_ITEM_WORKING_DEVIATION[$sigma_index] < $post_ITEM_sigma_minus_1x) ) {
						$post_ITEM_sigma_COUNT_minus_2x = $post_ITEM_sigma_COUNT_minus_2x + 1;
					} else {
						if ( ($post_ITEM_WORKING_DEVIATION[$sigma_index] >= $post_ITEM_sigma_minus_1x) && ($post_ITEM_WORKING_DEVIATION[$sigma_index] < 0) ) {
							$post_ITEM_sigma_COUNT_minus_1x = $post_ITEM_sigma_COUNT_minus_1x + 1;
						} else {
							if ( ($post_ITEM_WORKING_DEVIATION[$sigma_index] > 0) && ($post_ITEM_WORKING_DEVIATION[$sigma_index] <= $post_ITEM_sigma_plus_1x) ) {
								$post_ITEM_sigma_COUNT_plus_1x = $post_ITEM_sigma_COUNT_plus_1x + 1;
							} else {
								if ( ($post_ITEM_WORKING_DEVIATION[$sigma_index] > $post_ITEM_sigma_plus_1x) && ($post_ITEM_WORKING_DEVIATION[$sigma_index] <= $post_ITEM_sigma_plus_2x) ) {
									$post_ITEM_sigma_COUNT_plus_2x = $post_ITEM_sigma_COUNT_plus_2x + 1;
								} else {
									if ( ($post_ITEM_WORKING_DEVIATION[$sigma_index] > $post_ITEM_sigma_plus_2x) && ($post_ITEM_WORKING_DEVIATION[$sigma_index] <= $post_ITEM_sigma_plus_3x) ) {
										$post_ITEM_sigma_COUNT_plus_3x = $post_ITEM_sigma_COUNT_plus_3x + 1;
									} else {
										if ($post_ITEM_WORKING_DEVIATION[$sigma_index] > $post_ITEM_sigma_plus_3x) {
											$post_ITEM_sigma_COUNT_plus_BEYOND3x = $post_ITEM_sigma_COUNT_plus_BEYOND3x + 1;
										} else {
											if ($post_ITEM_WORKING_DEVIATION[$sigma_index] == 0) {
												$post_ITEM_sigma_COUNT_plus_ZERO = $post_ITEM_sigma_COUNT_plus_ZERO + 1;
											} else {
												/* pass */
											}
										}
									}
								}
							}
						}
					}
				}
			}
			
			/* INDEX */
			$sigma_index = $sigma_index + 1;
		}

		/* -- CONSIDER THE VALUES WE ARRIVED AT ABOVE IN TERMS OF PERCENT OF TOTAL VALUES */
		$post_ITEM_sigma_COUNT_minus_BEYOND3x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_minus_BEYOND3x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_minus_3x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_minus_3x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_minus_2x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_minus_2x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_minus_1x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_minus_1x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_plus_ZERO = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_plus_ZERO / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_plus_1x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_plus_1x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_plus_2x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_plus_2x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_plus_3x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_plus_3x / $post_RECORDS_EXAMINED), 2);
		$post_ITEM_sigma_COUNT_plus_BEYOND3x = varcharTOnumeric2((100 * $post_ITEM_sigma_COUNT_plus_BEYOND3x / $post_RECORDS_EXAMINED), 2);

		$post_ITEM_sigma_COUNT_minus_BEYOND3x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_minus_BEYOND3x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_minus_3x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_minus_3x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_minus_2x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_minus_2x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_minus_1x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_minus_1x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_plus_ZERO_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_plus_ZERO * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_plus_1x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_plus_1x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_plus_2x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_plus_2x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_plus_3x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_plus_3x * $post_BAR_GRAPH_HEIGHT / 100), 2);
		$post_ITEM_sigma_COUNT_plus_BEYOND3x_PLOT = varcharTOnumeric2(($post_ITEM_sigma_COUNT_plus_BEYOND3x * $post_BAR_GRAPH_HEIGHT / 100), 2);

		/* -- SANITY CHECK */
		/* -- -- we display as an image the bar graph */
		/* -- -- images cannot have a dimensional value of '0', so all must be at least '1' */
		if ($post_ITEM_sigma_COUNT_minus_BEYOND3x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_minus_BEYOND3x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_minus_3x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_minus_3x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_minus_2x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_minus_2x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_minus_1x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_minus_1x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_ZERO_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_plus_ZERO_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_1x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_plus_1x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_2x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_plus_2x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_3x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_plus_3x_PLOT = 1;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_BEYOND3x_PLOT <= 1) {
			$post_ITEM_sigma_COUNT_plus_BEYOND3x_PLOT = 1;
		} else {
			/* pass */
		}

		/* -- SANITY CHECK */
		/* -- -- we display as an image the bar graph */
		/* -- -- images cannot have a dimensional value of greater than 100 percent */
		/*       of the graph height */
		if ($post_ITEM_sigma_COUNT_minus_BEYOND3x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_minus_BEYOND3x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_minus_3x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_minus_3x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_minus_2x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_minus_2x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_minus_1x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_minus_1x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_ZERO_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_plus_ZERO_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_1x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_plus_1x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_2x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_plus_2x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_3x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_plus_3x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}
		if ($post_ITEM_sigma_COUNT_plus_BEYOND3x_PLOT >= $post_BAR_GRAPH_HEIGHT) {
			$post_ITEM_sigma_COUNT_plus_BEYOND3x_PLOT = $post_BAR_GRAPH_HEIGHT;
		} else {
			/* pass */
		}

		/* -- PLOT */
		$post_ITEM_STDEV_PLOT = "
											<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
											<!-- SIX SIGMA PLUS OVERRANGE STANDARD DEVIATION PLOT -->
											<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

											<BR>
											<B><U>".$post_BAR_GRAPH_TITLE."</U></B><BR>
											<BR>
											<IMG SRC='./img/sigma.png' ALT='SIGMA'> = ".$post_ITEM_WORKING_DEVIATION_STANDARD."<BR>
											<BR>
											<BR>
											<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
												<TR BGCOLOR='#DDDDDD'>
													<TD WIDTH='7' ALIGN='RIGHT' VALIGN='TOP'>
														<IMG SRC='./img/horizontal_bar_black.png' WIDTH='4' HEIGHT='".$post_BAR_GRAPH_HEIGHT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar_red.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_minus_BEYOND3x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_minus_3x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_minus_2x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_minus_1x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar_green.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_plus_ZERO_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_plus_1x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_plus_2x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_plus_3x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='65' ALIGN='CENTER' VALIGN='BOTTOM'>
														<IMG SRC='./img/horizontal_bar_red.png' WIDTH='65' HEIGHT='".$post_ITEM_sigma_COUNT_plus_BEYOND3x_PLOT."' ALT='bar_graph'>
													</TD>
													<TD WIDTH='7' ALIGN='LEFT' VALIGN='TOP'>
														<IMG SRC='./img/horizontal_bar_black.png' WIDTH='4' HEIGHT='".$post_BAR_GRAPH_HEIGHT."' ALT='bar_graph'>
													</TD>
												</TR>
												<TR>
													<TD>
														<BR>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>&#60;= -4 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>-3 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>-2 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>-1 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B><IMG SRC='./img/mu.png' ALT='MU'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>1 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>2 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>3 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTMEDTEXT'><B>&#62;= 4 <IMG SRC='./img/sigma.png' ALT='SIGMA'></B></P>
													</TD>
													<TD>
														<BR>
													</TD>
												</TR>
												<TR>
													<TD>
														<BR>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_minus_BEYOND3x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_minus_3x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_minus_2x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_minus_1x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_plus_ZERO." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_plus_1x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_plus_2x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_plus_3x." [%]</B></P>
													</TD>
													<TD ALIGN='CENTER' VALIGN='MIDDLE'>
														<P CLASS='INFOREPORTTEXT'><B>".$post_ITEM_sigma_COUNT_plus_BEYOND3x." [%]</B></P>
													</TD>
													<TD>
														<BR>
													</TD>
												</TR>
											</TABLE>

											<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
											";

	/* RETURN VARIABLES */
	return array($post_ITEM_STDEV_PLOT,$post_ITEM_WORKING_DEVIATION_STANDARD);
}

?>
