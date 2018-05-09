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
CHECKWEIGHER MODEL HMI 1 BODY (INCLUDED TO ALL CHECKWEIGHERMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = 300;
$seer_BOUNCEBACKTIME_THISHMI_0 = 0;
/*	-- time between refreshing this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CHECKWEIGHERMODEL_0.": ".$multilang_CHECKWEIGHERMODEL_36."</B><BR>
								<I>".$CHECKWEIGHERMODEL_SUBPAGETITLE."</I><BR>
								<BR>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_PROCESSRECIPEPUSH] != '' ) {
	$seer_PROCESSRECIPEPUSH = $_POST['seer_PROCESSRECIPEPUSH'];
	if ( $seer_PROCESSRECIPEPUSH == "YES" ) {
		if ( $_POST[seer_CHECKWEIGHERTOPUSH] != '' ) {
			$seer_CHECKWEIGHERTOPUSH = $_POST['seer_CHECKWEIGHERTOPUSH'];
		} else {
			$seer_PROCESSRECIPEPUSH = "NO";
		}
		if ( $_POST[seer_RECIPETOPUSH] != '' ) {
			$seer_RECIPETOPUSH = $_POST['seer_RECIPETOPUSH'];
		} else {
			$seer_PROCESSRECIPEPUSH = "NO";
		}
	} else {
		$seer_PROCESSRECIPEPUSH = "NO";
	}
} else {
	$seer_PROCESSRECIPEPUSH = "NO";
}

if (($seer_PROCESSRECIPEPUSH == "YES") && ($seer_USERACTIVE == "YES")) {
	/* UPDATE CHECKWEIGHER SYPHON TABLE WITH CURRENT RUNNING RECIPE */
	$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_SYPHON." SET RECIPE='".$seer_RECIPETOPUSH."' WHERE MACHINENAME='".$seer_CHECKWEIGHERTOPUSH."'";
	core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_SYPHON." SET OPERATOR='".$mysql_seer_access_USERNAME."' WHERE MACHINENAME='".$seer_CHECKWEIGHERTOPUSH."'";
	core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	/* SLEEP A COUPLE SECONDS SO THAT WHEN WE SCAN FROM THE DB IN A MOMENT, WE GET THE UPDATED VALUES */
	sleep(2);
} else {
	/* pass */
}

/* STANDARD REPORT */
/* ------------------------------------------------------------------ */

$apache_REPORT_FRESHTIME = $apache_DEFAULTDATESTAMP;

/* SCAN RECIPE DATA FROM DATABASE */
$mysql_mod_openopc_query = "SELECT * FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE ((RECIPE LIKE '".$CHECKWEIGHERMODEL_NAME_OF_NULL_RECIPE."') OR (RECIPE LIKE '".$CHECKWEIGHERMODEL_PRESET_PREFIX."%')) ORDER BY RECIPE ASC";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_records) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

$mysql_query_index = 1;
$apache_CHECKWEIGHER_MODIFYRECIPE = "";
while ( ($mysql_query_index <= $mysql_mod_openopc_records) && ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) ) {
	$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];
	$apache_CHECKWEIGHER_MODIFYRECIPE = $apache_CHECKWEIGHER_MODIFYRECIPE."<OPTION VALUE='".$mysql_mod_openopc_WORKING_RECIPE."'>".$mysql_mod_openopc_WORKING_RECIPE;
	$mysql_query_index = $mysql_query_index + 1;
}
$apache_CHECKWEIGHER_MODIFYRECIPE_HOLDING = "<OPTION VALUE=''>".$multilang_CHECKWEIGHERMODEL_54.$apache_CHECKWEIGHER_MODIFYRECIPE;

/* SCAN SCALE DATA FROM DATABASE */
$apache_REPORT_RECORDENTRY = "";
$mysql_index = 0;
while ($mysql_index <= $CHECKWEIGHERMODEL_COUNT_ADJUSTED) {

	$apache_CHECKWEIGHER_MODIFYRECIPE = "
								<TR>
									<TD COLSPAN='9' ALIGN='CENTER' VALIGN='MIDDLE'>
										<BR>
										<BR>
										<FORM ACTION='".$seer_REFERRINGPAGE."' METHOD='post'>
										<SELECT NAME='seer_RECIPETOPUSH'>".$apache_CHECKWEIGHER_MODIFYRECIPE_HOLDING."</SELECT><BR>
										<BR>
										<INPUT TYPE='hidden' name='seer_PROCESSRECIPEPUSH' value='YES'>
										<INPUT TYPE='hidden' name='seer_CHECKWEIGHERTOPUSH' value='".$CHECKWEIGHERMODEL_NAME[$mysql_index]."'>
										<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'><BR>
										<BR>
										</FORM>
									</TD>
								</TR>
								";

	/* 1st half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='3' CLASS='hmicellborder1_ALT'>
										<B><U>".$CHECKWEIGHERMODEL_NAME[$mysql_index]."</U></B>
									</TD>
								";

	/* CHECK FOR WEIGHED ITEMS IN SNAPSHOT TIME */
	$mysql_mod_openopc_query = "DATESTAMP";
	$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME." WHERE ( (DATESTAMP >= '".$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED."%') AND (MACHINENAME LIKE '".$CHECKWEIGHERMODEL_NAME[$mysql_index]."') ) ORDER BY DATESTAMP DESC LIMIT 1";
	list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

	if ($mysql_mod_openopc_query_result_rows > 0) {
		$mysql_mod_openopc_query2 = "RECIPE, OPERATOR";
		$mysql_mod_openopc_query2 = "SELECT ".$mysql_mod_openopc_query2." FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_SYPHON." WHERE MACHINENAME LIKE '".$CHECKWEIGHERMODEL_NAME[$mysql_index]."' LIMIT 1";
		list($mysql_mod_openopc_query_result2,$mysql_mod_openopc_query_result_rows2) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query2);

		if ($mysql_mod_openopc_query_result_rows2 > 0) {
			/* WE HAVE WEIGHED ITEMS IN SNAPSHOT AND SCALE EXISTS */
			while ($mysql_mod_openopc_query_row2 = mysqli_fetch_assoc($mysql_mod_openopc_query_result2)) {
				$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row2['RECIPE'];
				$mysql_mod_openopc_WORKING_OPERATOR = $mysql_mod_openopc_query_row2['OPERATOR'];
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
									<TD COLSPAN='9'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								".$apache_CHECKWEIGHER_MODIFYRECIPE."
								<TR>

									<TD COLSPAN='9'>
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
									<TD COLSPAN='9'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								".$apache_CHECKWEIGHER_MODIFYRECIPE."
								<TR>

									<TD COLSPAN='9'>
										<BR>
									</TD>
								</TR>
								";
			}
		} else {
			/* WE HAVE WEIGHED ITEMS IN SNAPSHOT AND SCALE DOES NOT EXIST */
			$mysql_mod_openopc_SYPHON_FAULT = $multilang_CHECKWEIGHERMODEL_37;
			/* 2nd half of HEADER FOR THIS SECTION OF STANDARD REPORT BODY */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
									<TD COLSPAN='6' CLASS='hmicellborder1' BGCOLOR='#FF8866'>
										<B><I>".$multilang_CHECKWEIGHERMODEL_40."</I></B>
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
									<TD COLSPAN='9'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								".$apache_CHECKWEIGHER_MODIFYRECIPE."
								<TR>
									<TD COLSPAN='9'>
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
									<TD COLSPAN='9'>
										<P CLASS='INFOREPORTCENTER'>
											<B>".$multilang_CHECKWEIGHERMODEL_81.":</B> <I>".$mysql_seer_WORKING_REALNAME." [".$mysql_mod_openopc_WORKING_OPERATOR."]</I><BR>
										</P>
									</TD>
								</TR>
								".$apache_CHECKWEIGHER_MODIFYRECIPE."
								<TR>
									<TD COLSPAN='9'>
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
									<TD COLSPAN='9'>
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
								</TR>";

	/* INDEX */
	$mysql_index = $mysql_index + 1;
}

/* HMI TOPPLATE AND ASSEMBLY */
/* ------------------------- */
$apache_REPORT_TOPPLATE = core_hmi_ticket_top_plate($apache_REPORT_FRESHTIME,"SNAPSHOT");
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
