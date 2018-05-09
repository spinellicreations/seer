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
CHECKWEIGHER MODEL HMI 0 BODY (INCLUDED TO ALL CHECKWEIGHERMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 60;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CHECKWEIGHERMODEL_0.": ".$multilang_CHECKWEIGHERMODEL_32."</B><BR>
								<I>".$CHECKWEIGHERMODEL_SUBPAGETITLE."</I>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* IDENTIFY THE RANGE OF TIME TO LOOK AT FOR DEPARTMENT MONITOR */
/* ------------------------------------------------------------------ */
$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED = apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM_GENERATE($CHECKWEIGHERMODEL_DEPT_MONITOR_SNAPSHOT_TIME_MINUTES);
$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_DURATION_IN_MIN = varcharTOnumeric2(($CHECKWEIGHERMODEL_DEPT_MONITOR_SNAPSHOT_TIME_MINUTES + (date('s')/60)), 2);

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT_RECORDENTRY = "";
$apache_REPORT_FRESHTIME = 0;
$mysql_index = 0;
while ($mysql_index <= $CHECKWEIGHERMODEL_COUNT_ADJUSTED) {
	$apache_FIRST_RUN = 1;
	/* 1st half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$CHECKWEIGHERMODEL_NAME[$mysql_index]."</U></B>
									</TD>
								";

	/* CHECK FOR WEIGHED ITEMS IN SNAPSHOT TIME */
	$mysql_mod_openopc_query = "DATESTAMP, RECIPE, OPERATOR";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (MACHINENAME LIKE '".$CHECKWEIGHERMODEL_NAME[$mysql_index]."') ) ORDER BY DATESTAMP DESC LIMIT 1";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	
	if ($mysql_mod_openopc_query_result_rows > 0) {
		/* WE HAVE WEIGHED ITEMS IN SNAPSHOT */
		while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
			$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];
			$mysql_mod_openopc_WORKING_OPERATOR = $mysql_mod_openopc_query_row['OPERATOR'];
			/* OPERATOR'S NAME */
			$mysql_seer_WORKING_REALNAME = model_CHECKWEIGHER_determine_operator_name ($mysql_mod_openopc_WORKING_OPERATOR);
		}
		if ($mysql_mod_openopc_WORKING_RECIPE == $CHECKWEIGHERMODEL_NAME_OF_NULL_RECIPE) {
			/* SCALE IS SCHEDULED DOWN  or  NOT RUNNING BUT IS RECEIVING DATA */
			$mysql_mod_openopc_SYPHON_FAULT = $multilang_CHECKWEIGHERMODEL_53;
			/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#FFAA33'>
										<B><I>".$multilang_CHECKWEIGHERMODEL_41."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='6'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='7'>
										<BR>
										".$mysql_mod_openopc_SYPHON_FAULT."<BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
		} else {
			/* SCALE IS IN GOOD RUNNING ACTIVE STATE - WE HAVE DATA / WEIGHTS - AND IT A RECIPE IS ENTERED */
			/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#CCFF66'>
										<B><I>".$mysql_mod_openopc_WORKING_RECIPE."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='6'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";

			/* POLL THE CURRENT RECIPE DATA */
			$mysql_mod_openopc_query = "TARGET, DELTA_MIN, DELTA_MAX, TARE";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE LIKE '".$mysql_mod_openopc_WORKING_RECIPE."' LIMIT 1";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
			while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
				$mysql_mod_openopc_WORKING_TARGET = varcharTOnumeric2(($mysql_mod_openopc_query_row['TARGET']), 3);
				$mysql_mod_openopc_WORKING_DELTA_MIN = varcharTOnumeric2(($mysql_mod_openopc_query_row['DELTA_MIN']), 3);
				$mysql_mod_openopc_WORKING_DELTA_MAX = varcharTOnumeric2(($mysql_mod_openopc_query_row['DELTA_MAX']), 3);
				$mysql_mod_openopc_WORKING_MIN = varcharTOnumeric2(($mysql_mod_openopc_WORKING_TARGET - $mysql_mod_openopc_WORKING_DELTA_MIN), 3);
				$mysql_mod_openopc_WORKING_MAX = varcharTOnumeric2(($mysql_mod_openopc_WORKING_TARGET + $mysql_mod_openopc_WORKING_DELTA_MAX), 3);
				$mysql_mod_openopc_WORKING_TARE = varcharTOnumeric2(($mysql_mod_openopc_query_row['TARE']), 3);
			}

			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_12."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_TARGET." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_34."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_TARE." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_44."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MIN." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_45."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MAX." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";

			/* POLL THE CURRENT WEIGHT DATA */
			$mysql_mod_openopc_query = "DATESTAMP, MASS, RECIPE";
			$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (MACHINENAME LIKE '".$CHECKWEIGHERMODEL_NAME[$mysql_index]."') ) ORDER BY DATESTAMP DESC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			$mysql_mod_openopc_WORKING_SAMPLE_index = 0;
			while ($mysql_mod_openopc_WORKING_SAMPLE_index < 10) {
				$mysql_mod_openopc_WORKING_SAMPLE[$mysql_mod_openopc_WORKING_SAMPLE_index] = "null";
				$mysql_mod_openopc_WORKING_SAMPLE_STAMP[$mysql_mod_openopc_WORKING_SAMPLE_index] = "null";
				$mysql_mod_openopc_WORKING_SAMPLE_index = $mysql_mod_openopc_WORKING_SAMPLE_index + 1;
			}
			$mysql_mod_openopc_WORKING_COUNT = 0;
			$mysql_mod_openopc_WORKING_COUNT_REJECTED = 0;
			$mysql_mod_openopc_WORKING_COUNT_ACCEPTED = 0;
			$mysql_mod_openopc_WORKING_MASS_TOTAL = 0;
			$mysql_mod_openopc_WORKING_CHECK_RECIPE = $mysql_mod_openopc_WORKING_RECIPE;
			while ( ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) && ($mysql_mod_openopc_WORKING_RECIPE == $mysql_mod_openopc_WORKING_CHECK_RECIPE) ) {
				$mysql_mod_openopc_WORKING_CHECK_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];
				$mysql_mod_openopc_WORKING_MASS = varcharTOnumeric2(($mysql_mod_openopc_query_row['MASS'] - $mysql_mod_openopc_WORKING_TARE), 2);
				if ($mysql_mod_openopc_WORKING_COUNT < 10) {
					$mysql_mod_openopc_WORKING_SAMPLE[$mysql_mod_openopc_WORKING_COUNT] = $mysql_mod_openopc_WORKING_MASS;
					$mysql_mod_openopc_WORKING_SAMPLE_STAMP[$mysql_mod_openopc_WORKING_COUNT] = substr($mysql_mod_openopc_query_row['DATESTAMP'], 5);
					if ( ($apache_FIRST_RUN == 1) && ($mysql_mod_openopc_query_row['DATESTAMP'] > $apache_REPORT_FRESHTIME) ) {
						$apache_REPORT_FRESHTIME = $mysql_mod_openopc_query_row['DATESTAMP'];
						$apache_FIRST_RUN = 0;
					} else {
						/* pass */
					}
				} else {
					/* pass */
				}
				$mysql_mod_openopc_WORKING_MASS_TOTAL = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_TOTAL + $mysql_mod_openopc_WORKING_MASS), 2);
				$mysql_mod_openopc_WORKING_MASS_TOTAL_LARGE_QTY = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_TOTAL * $CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES_SCALE_FACTOR), 2);
				$mysql_mod_openopc_WORKING_COUNT = $mysql_mod_openopc_WORKING_COUNT + 1;
				if (($mysql_mod_openopc_WORKING_MASS < $mysql_mod_openopc_WORKING_MIN) || ($mysql_mod_openopc_WORKING_MASS > $mysql_mod_openopc_WORKING_MAX)) {
					$mysql_mod_openopc_WORKING_COUNT_REJECTED = $mysql_mod_openopc_WORKING_COUNT_REJECTED + 1;
				} else {
					/* pass */
				}
			}

			$mysql_mod_openopc_WORKING_COUNT_REJECTED = varcharTOnumeric2($mysql_mod_openopc_WORKING_COUNT_REJECTED, 0);
			$mysql_mod_openopc_WORKING_COUNT_REJECTED_PERCENT = varcharTOnumeric2((100 * $mysql_mod_openopc_WORKING_COUNT_REJECTED / $mysql_mod_openopc_WORKING_COUNT), 2);
			$mysql_mod_openopc_WORKING_COUNT_ACCEPTED = varcharTOnumeric2(($mysql_mod_openopc_WORKING_COUNT - $mysql_mod_openopc_WORKING_COUNT_REJECTED), 0);
			$mysql_mod_openopc_WORKING_COUNT_ACCEPTED_PERCENT = varcharTOnumeric2((100 * $mysql_mod_openopc_WORKING_COUNT_ACCEPTED / $mysql_mod_openopc_WORKING_COUNT), 2);

			if ($mysql_mod_openopc_WORKING_COUNT > 0) {
				$mysql_mod_openopc_WORKING_MASS_AVERAGE = varcharTOnumeric2(($mysql_mod_openopc_WORKING_MASS_TOTAL / $mysql_mod_openopc_WORKING_COUNT), 2);
			} else {
				$mysql_mod_openopc_WORKING_MASS_AVERAGE = 0;
			}

			$mysql_mod_openopc_WORKING_RATE = varcharTOnumeric2(($mysql_mod_openopc_WORKING_COUNT / $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_DURATION_IN_MIN), 2);

			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_46."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_COUNT." [".$CHECKWEIGHERMODEL_UM_UNIT."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_47."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_TOTAL_LARGE_QTY." [".$CHECKWEIGHERMODEL_UM_MASS_LARGE_QUANTITIES."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' VALIGN='TOP'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_49."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_RATE." [".$CHECKWEIGHERMODEL_UM_UNIT."/".$multilang_CHECKWEIGHERMODEL_50."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_48."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_MASS_AVERAGE." [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_51."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_COUNT_ACCEPTED." [".$CHECKWEIGHERMODEL_UM_UNIT."]<BR>
										(( ".$mysql_mod_openopc_WORKING_COUNT_ACCEPTED_PERCENT." [%] ))
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='TOP'>
										".$multilang_CHECKWEIGHERMODEL_52."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP'>
										".$mysql_mod_openopc_WORKING_COUNT_REJECTED." [".$CHECKWEIGHERMODEL_UM_UNIT."]<BR>
										(( ".$mysql_mod_openopc_WORKING_COUNT_REJECTED_PERCENT." [%] ))
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD ALIGN='CENTER' VALIGN='TOP' COLSPAN='7'>
										<B><U>".$multilang_CHECKWEIGHERMODEL_55."</U></B><BR>
										<BR>
									</TD>
								</TR>
								<TR BGCOLOR='#DDDDDD'>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 0 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[0]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[0]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 1 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[1]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[1]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR BGCOLOR='#FFFFFF'>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 2 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[2]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[2]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 3 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[3]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[3]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR BGCOLOR='#DDDDDD'>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 4 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[4]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[4]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 5 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[5]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[5]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR BGCOLOR='#FFFFFF'>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 6 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[6]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[6]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 7 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[7]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[7]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR BGCOLOR='#DDDDDD'>
									<TD COLSPAN='2'>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 8 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[8]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[8]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
										[[ 9 ]]
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										".$mysql_mod_openopc_WORKING_SAMPLE_STAMP[9]."
									</TD>
									<TD CLASS='twosizeup' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B>".$mysql_mod_openopc_WORKING_SAMPLE[9]."</B> [".$CHECKWEIGHERMODEL_UM_MASS."]
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
		}
	} else {
		/* WE HAVE NOT WEIGHED ITEMS IN SNAPSHOT */
		$mysql_mod_openopc_query = "RECIPE, OPERATOR";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_SYPHON." WHERE MACHINENAME LIKE '".$CHECKWEIGHERMODEL_NAME[$mysql_index]."' LIMIT 1";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		if ($mysql_mod_openopc_query_result_rows > 0) {
			/* SCALE EXISTS */
			while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
				$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];
				$mysql_mod_openopc_WORKING_OPERATOR = $mysql_mod_openopc_query_row['OPERATOR'];
				/* OPERATOR'S NAME */
				$mysql_seer_WORKING_REALNAME = model_CHECKWEIGHER_determine_operator_name ($mysql_mod_openopc_WORKING_OPERATOR);
			}
			if ($mysql_mod_openopc_WORKING_RECIPE == $CHECKWEIGHERMODEL_NAME_OF_NULL_RECIPE) {
				/* SCALE IS SCHEDULED DOWN  or  NOT RUNNING */
				$mysql_mod_openopc_SYPHON_FAULT = $multilang_CHECKWEIGHERMODEL_38;
				/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#CCCCCC'>
										<B><I>".$multilang_CHECKWEIGHERMODEL_41."</I></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='6'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='7'>
										<BR>
										".$mysql_mod_openopc_SYPHON_FAULT."<BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
			} else {
				/* SCALE IS RUNNING BUT NO WEIGHTS HAVE BEEN MEASURED DURING SNAPSHOT TIME */
				$mysql_mod_openopc_SYPHON_FAULT = $multilang_CHECKWEIGHERMODEL_39;
				/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#FF8866'>
										<B><I>".$mysql_mod_openopc_WORKING_RECIPE."</I></B><BR>
										<I>".$multilang_CHECKWEIGHERMODEL_42."</I>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='3'>
										<BR>
									</TD>
									<TD COLSPAN='6'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='7'>
										<BR>
										".$mysql_mod_openopc_SYPHON_FAULT."<BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
			}
		} else {
			/* SCALE DOES NOT EXIST */
			$mysql_mod_openopc_SYPHON_FAULT = $multilang_CHECKWEIGHERMODEL_37;
			/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#FF8866'>
										<B><I>".$multilang_CHECKWEIGHERMODEL_40."</I></B>
									</TD>
								</TR>
								<TR>
									<TD>
										<BR>
									</TD>
									<TD COLSPAN='7'>
										<BR>
										".$mysql_mod_openopc_SYPHON_FAULT."<BR>
										<BR>
									</TD>
									<TD>
										<BR>
									</TD>
								</TR>
								";
		}

	}

	/* FOOTER FOR THIS SECTION OF STANDARD BODY */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='9'>
										<IMG SRC='./img/horizontal_bar_black.png' WIDTH='900' HEIGHT='2' ALT='BAR'><BR>
									</TD>
								</TR>
								";

	/* INDEX */
	$mysql_index = $mysql_index + 1;
}

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($apache_REPORT_FRESHTIME,"WINDOW",$multilang_CHECKWEIGHERMODEL_50,$CHECKWEIGHERMODEL_DEPT_MONITOR_SNAPSHOT_TIME_MINUTES);
$apache_REPORT_RECORDENTRY = $apache_REPORT_TOPPLATE."
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>
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
								".$apache_REPORT_RECORDENTRY."
								";
/* -- CLOSE OUT TABLE */
$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";

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
