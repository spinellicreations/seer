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
SETTINGS
-- EVERYTHING FROM SETUP TO PASSWORDS AND ALL PLACES IN BETWEEN
-- NOW WITH ADDED FIBRE!  CARDBOARD NO, DELISCIOUS YES!
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "./seer_settings.php";
/*	-- when we execute functions, send the user back here at end */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_STATIC_114."</B>
							</P>
							";

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_PROCESSSETTING] != '' ) {
	$seer_PROCESSSETTING = $_POST['seer_PROCESSSETTING'];
} else {
	$seer_PROCESSSETTING = "NO";
}
if ( $_POST[seer_ACTIONSETTING] != '' ) {
	$seer_ACTIONSETTING = $_POST['seer_ACTIONSETTING'];
} else {
	$seer_ACTIONSETTING = "NONE";
}

/* CORE MODEL IMPORT */
/* ------------------------------------------------------------------ */

/* ---------- */
/* TANK MODEL */
/* ---------- */
if ( ($seer_ENABLE_TANKMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('C:/Apache24/Apache24/htdocs/seer_2/config/TANKMODEL/globaloptions_TANKMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_TANKMODEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=TANKMODEL"."'>[ ".$multilang_TANKMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_TANKMODEL_FILL = "[ ".$multilang_TANKMODEL_0." ] ".$multilang_FAULT_47;
}

/* --------- */
/* SPF MODEL */
/* --------- */
if ( ($seer_ENABLE_SPFMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/SPFMODEL/globaloptions_SPFMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_SPFMODEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=SPFMODEL"."'>[ ".$multilang_SPFMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_SPFMODEL_FILL = "[ ".$multilang_SPFMODEL_0." ] ".$multilang_FAULT_47;
}

/* --------- */
/* CIP MODEL */
/* --------- */
if ( ($seer_ENABLE_CIPMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/CIPMODEL/globaloptions_CIPMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_CIPMODEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=CIPMODEL"."'>[ ".$multilang_CIPMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_CIPMODEL_FILL = "[ ".$multilang_CIPMODEL_0." ] ".$multilang_FAULT_47;
}

/* --------------------- */
/* TTY PERFORMANCE MODEL */
/* --------------------- */
if ( ($seer_ENABLE_TTYPERFORMANCEMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/TTYPERFORMANCEMODEL/globaloptions_TTYPERFORMANCEMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_TTYPERFORMANCEMODEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=TTYPERFORMANCE"."'>[ ".$multilang_TTYPERFORMANCEMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_TTYPERFORMANCEMODEL_FILL = "[ ".$multilang_TTYPERFORMANCEMODEL_0." ] ".$multilang_FAULT_47;
}

/* ---------- */
/* BULK MODEL */
/* ---------- */
if ( ($seer_ENABLE_BULKMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/BULKMODEL/globaloptions_BULKMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_BULKMODEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=BULKMODEL"."'>[ ".$multilang_BULKMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_BULKMODEL_FILL = "[ ".$multilang_BULKMODEL_0." ] ".$multilang_FAULT_47;
}

/* ---------- */
/* TOUCHPANEL */
/* ---------- */
if ( ($seer_ENABLE_TOUCHPANEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/TOUCHPANEL/globaloptions_TOUCHPANEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_TOUCHPANEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=TOUCHPANEL"."'>[ ".$multilang_TOUCHPANEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_TOUCHPANEL_FILL = "[ ".$multilang_TOUCHPANEL_0." ] ".$multilang_FAULT_47;
}

/* --------- */
/* THINCHART */
/* --------- */
if ( ($seer_ENABLE_THINCHART == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/THINCHART/globaloptions_THINCHART_0.php');
	$apache_REPORTL1_MODEL_SETUP_THINCHART_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=THINCHART"."'>[ ".$multilang_THINCHART_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_THINCHART_FILL = "[ ".$multilang_THINCHART_0." ] ".$multilang_FAULT_47;
}

/* ----------------- */
/* ATMOSPHERIC MODEL */
/* ----------------- */
if ( ($seer_ENABLE_ATMOSPHERICMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/ATMOSPHERICMODEL/globaloptions_ATMOSPHERICMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_ATMOSPHERICMODEL_FILL = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=ATMOSPHERICMODEL"."'>[ ".$multilang_ATMOSPHERICMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
} else {
	$apache_REPORTL1_MODEL_SETUP_ATMOSPHERICMODEL_FILL = "[ ".$multilang_ATMOSPHERICMODEL_0." ] ".$multilang_FAULT_47;
}

/* ------- */
/* WARRIOR */
/* ------- */
if ( ($seer_ENABLE_WARRIOR == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/WARRIOR/globaloptions_WARRIOR_0.php');
	$apache_REPORTL1_MODEL_SETUP_WARRIOR_FILL_1 = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=WARRIOR"."'>[ <IMG SRC='./img/warrior_textsize_0.png' BORDER='0' ALT='WARRIOR'> ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
	$apache_REPORTL1_MODEL_SETUP_WARRIOR_FILL_2 = "<A HREF='./include/core_models/WARRIOR_mod_openopc_setup_populatescheduletable.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>[ <IMG SRC='./img/warrior_textsize_0.png' BORDER='0' ALT='WARRIOR'> ] ".$multilang_WARRIOR_128."</A>";
	if ($seer_ENABLE_WARRIOR == "YES") {
		/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
		/* ------------------------------------------------------------------ */
		if (($seer_USERACTIVE == "YES") && ($seer_WARRIOR_ENABLE_LABELING_PLUGIN == 'YES')) {
			/* INITIALIZE THE PLUGIN */
			require($seer_WARRIOR_apache_ROOT_LABELING_PLUGIN.'/labeling_plugin_initialize.php');
		} else {
			/* -- don't waste resources on random page hits */
			/* pass */
		}
		if ( $mysql_seer_access_ACCESSLEVEL <= 3 ) {
			/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
			/* ------------------------------------------ */
			if ($seer_WARRIOR_AUTO_POLL_JOBS == 'YES') {
				$mysql_mod_openopc_query = "SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." ORDER BY JOB_NUMBER ASC";
				list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

				$mysql_query_index = 1;
				$apache_REPORTL3_WARRIOR_BODY_FILL = "";
				while ( ($mysql_query_index <= $mysql_mod_openopc_num_rows) && ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) ) {
					$mysql_mod_openopc_WORKING_JOBNUMBER = $mysql_mod_openopc_query_row['JOB_NUMBER'];
					$mysql_mod_openopc_WORKING_DESCRIPTION = $mysql_mod_openopc_query_row['JOB_DESCRIPTION'];
					$apache_REPORTL3_WARRIOR_MODIFYJOBDESCRIPTION = $apache_REPORTL3_WARRIOR_MODIFYJOBDESCRIPTION."<OPTION VALUE='".$mysql_mod_openopc_WORKING_JOBNUMBER."'>".$mysql_mod_openopc_WORKING_JOBNUMBER." - ".$mysql_mod_openopc_WORKING_DESCRIPTION;
					$mysql_query_index = $mysql_query_index + 1;
				}
				$apache_REPORTL3_WARRIOR_BODY_FILL = $apache_REPORTL3_WARRIOR_MODIFYJOBDESCRIPTION."</SELECT>";
			} else {
				$apache_REPORTL3_WARRIOR_BODY_FILL = $WARRIOR_FORMFILL_BY_JOB_NUMBER."</SELECT>";
			}
		} else {
			/* continue */
		}
		$apache_REPORTL2_WARRIOR_BODY_FILL = "
											<P CLASS='INFOREPORTRIGHT'>
												<B><U><IMG SRC='./img/warrior_textsize_1.png' BORDER='0' ALT='WARRIOR'></U></B><BR>
											</P>
											<FORM ACTION='./include/core_models/WARRIOR_setup_removejob.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
												<P CLASS='INFOREPORTRIGHT'>
													".$multilang_WARRIOR_16.":  <SELECT CLASS='SMALL' NAME='seer_USERTOMODIFY'><OPTION VALUE=''>".$multilang_WARRIOR_19.$apache_REPORTL3_WARRIOR_MODIFYJOBDESCRIPTION." [01]<BR>
												</P>
												<TABLE ALIGN='RIGHT' WIDTH='100%'>
													<TR>
														<TD WIDTH='*'>
														</TD>
														<TD ALIGN='CENTER' VALIGN='middle' WIDTH='150'>
															<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
															<BR>
														</TD>
													</TR>
												</TABLE>
											</FORM>
											<BR>
											";
		$apache_REPORTL3_WARRIOR_BODY_FILL = "
												<P CLASS='INFOREPORTRIGHT'>
													<A HREF='./include/core_models/WARRIOR_setup_addjobdescription.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_WARRIOR_1."</A> [01]<BR>
												</P>
												<FORM ACTION='./include/core_models/WARRIOR_setup_modifyjobdescription.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
													<P CLASS='INFOREPORTRIGHT'>
														".$multilang_WARRIOR_2.": <SELECT CLASS='SMALL' NAME='seer_USERTOMODIFY'><OPTION VALUE=''>".$multilang_WARRIOR_18.$apache_REPORTL3_WARRIOR_BODY_FILL." [02]
													</P>
													<P ALIGN='RIGHT'>
														<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
													</P>
												</FORM>
												";
		/* W.A.R.R.I.O.R. LABELING PLUGIN INTEGRATION */
		/* ------------------------------------------------------------------ */
		if (($seer_USERACTIVE == "YES") && ($seer_WARRIOR_ENABLE_LABELING_PLUGIN == 'YES')) {
			/* DEINITIALIZE THE PLUGIN */
			require($seer_WARRIOR_apache_ROOT_LABELING_PLUGIN.'/labeling_plugin_deinitialize.php');
		} else {
			/* -- don't waste resources on random page hits */
			/* pass */
		}
	} else {
	$apache_REPORTL2_WARRIOR_BODY_FILL = "
											<P CLASS='INFOREPORTRIGHT'>"
												.$multilang_FAULT_47."
											</P>
											";
	$apache_REPORTL3_WARRIOR_BODY_FILL = "
											<P CLASS='INFOREPORTRIGHT'>"
												.$multilang_FAULT_47."
											</P>
											";
	}
} else {
	/* RESPOND INDICATING THAT THE MODEL IS NOT ENABLED */
	$apache_REPORTL1_MODEL_SETUP_WARRIOR_FILL_1 = "[ <IMG SRC='./img/warrior_textsize_0.png' BORDER='0' ALT='WARRIOR'> ] ".$multilang_FAULT_47;
	$apache_REPORTL1_MODEL_SETUP_WARRIOR_FILL_2 = "[ <IMG SRC='./img/warrior_textsize_0.png' BORDER='0' ALT='WARRIOR'> ] ".$multilang_FAULT_47;
	$apache_REPORTL2_WARRIOR_BODY_FILL = "
											<P CLASS='INFOREPORTRIGHT'>"
												.$multilang_FAULT_47."
											</P>
											";
	$apache_REPORTL3_WARRIOR_BODY_FILL = "
											<P CLASS='INFOREPORTRIGHT'>"
												.$multilang_FAULT_47."
											</P>
											";
}

/* ------------------ */
/* CHECKWEIGHER MODEL */
/* ------------------ */
if ( ($seer_ENABLE_CHECKWEIGHERMODEL == "YES") || ($seer_settings_FIRSTRUN == 'YES') ) {
	include('./config/CHECKWEIGHERMODEL/globaloptions_CHECKWEIGHERMODEL_0.php');
	$apache_REPORTL1_MODEL_SETUP_CHECKWEIGHERMODEL_FILL_1 = "<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=CHECKWEIGHERMODEL"."'>[ ".$multilang_CHECKWEIGHERMODEL_0." ] ".$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE."</A>";
	$apache_REPORTL1_MODEL_SETUP_CHECKWEIGHERMODEL_FILL_2 = "<A HREF='./include/core_models/CHECKWEIGHERMODEL_mod_openopc_setup_populatesyphontable.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>[ ".$multilang_CHECKWEIGHERMODEL_0." ] ".$multilang_CHECKWEIGHERMODEL_30."</A>";
	if ($seer_ENABLE_CHECKWEIGHERMODEL == "YES") {
		if ( $mysql_seer_access_ACCESSLEVEL <= 2 ) {

			$mysql_mod_openopc_query = "SELECT * FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." ORDER BY RECIPE ASC";
			list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			$mysql_query_index = 1;
			$apache_REPORTL2_CHECKWEIGHER_BODY_FILL = "";
			while ( ($mysql_query_index <= $mysql_mod_openopc_num_rows) && ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) ) {
				$mysql_mod_openopc_WORKING_RECIPE = $mysql_mod_openopc_query_row['RECIPE'];
				$apache_REPORTL2_CHECKWEIGHER_BODY_FILL = $apache_REPORTL2_CHECKWEIGHER_BODY_FILL."<OPTION VALUE='".$mysql_mod_openopc_WORKING_RECIPE."'>".$mysql_mod_openopc_WORKING_RECIPE;
				$mysql_query_index = $mysql_query_index + 1;
			}
			$apache_REPORTL2_CHECKWEIGHER_BODY_FILL = $apache_REPORTL2_CHECKWEIGHER_BODY_FILL."</SELECT>";
		} else {
			/* continue */
		}

		if ($CHECKWEIGHERMODEL_WORMIFY_RECIPE_DB == 'NO') {
			$apache_REPORTL1_CW_REMOVE_RECIPE_BODY = "
												<FORM ACTION='./include/core_models/CHECKWEIGHERMODEL_setup_removerecipe.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
													<P CLASS='INFOREPORTRIGHT'>
														".$multilang_CHECKWEIGHERMODEL_3.":  <SELECT CLASS='SMALL' NAME='seer_USERTOMODIFY'><OPTION VALUE=''>".$multilang_CHECKWEIGHERMODEL_4.$apache_REPORTL2_CHECKWEIGHER_BODY_FILL."<BR>
													</P>
													<P ALIGN='RIGHT'>
														<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
													</P>
												</FORM>
												";
		} else {
			$apache_REPORTL1_CW_REMOVE_RECIPE_BODY = "
												<P CLASS='INFOREPORTRIGHT'>
													".$multilang_CHECKWEIGHERMODEL_4.": ".$multilang_FAULT_48."
												</P>
												";
		}
	
		$apache_REPORTL2_CW_ADD_RECIPE_BODY = "
												<P CLASS='INFOREPORTRIGHT'>
													<A HREF='./include/core_models/CHECKWEIGHERMODEL_setup_addrecipe.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_CHECKWEIGHERMODEL_5."</A>
												</P>
												";
		if ($CHECKWEIGHERMODEL_WORMIFY_RECIPE_DB == 'NO') {
			$apache_REPORTL2_CW_MODIFY_RECIPE_BODY = "
												<FORM ACTION='./include/core_models/CHECKWEIGHERMODEL_setup_modifyrecipe.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
													<P CLASS='INFOREPORTRIGHT'>
													".$multilang_CHECKWEIGHERMODEL_1.": <SELECT CLASS='SMALL' NAME='seer_USERTOMODIFY'><OPTION VALUE=''>".$multilang_CHECKWEIGHERMODEL_2.$apache_REPORTL2_CHECKWEIGHER_BODY_FILL."<BR>
													</P>
													<P ALIGN='RIGHT'>
														<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
													</P>
												</FORM>
												";
		} else {
			$apache_REPORTL2_CW_MODIFY_RECIPE_BODY = "
												<P CLASS='INFOREPORTRIGHT'>
													".$multilang_CHECKWEIGHERMODEL_1.": ".$multilang_FAULT_48."
												</P>
												";
		}
	} else {
		$apache_REPORTL1_CW_REMOVE_RECIPE_BODY = "
												<P CLASS='INFOREPORTRIGHT'>
													".$multilang_CHECKWEIGHERMODEL_4.": ".$multilang_FAULT_47."
												</P>
												";
		$apache_REPORTL2_CW_ADD_RECIPE_BODY = "
												<P CLASS='INFOREPORTRIGHT'>
													".$multilang_CHECKWEIGHERMODEL_5.": ".$multilang_FAULT_47."
												</P>
												";
		$apache_REPORTL2_CW_MODIFY_RECIPE_BODY = "
												<P CLASS='INFOREPORTRIGHT'>
													".$multilang_CHECKWEIGHERMODEL_1.": ".$multilang_FAULT_47."
												</P>
												";
	}		
} else {
	$apache_REPORTL1_MODEL_SETUP_CHECKWEIGHERMODEL_FILL_1 = "[ ".$multilang_CIPMODEL_0." ] ".$multilang_FAULT_47;
	$apache_REPORTL1_MODEL_SETUP_CHECKWEIGHERMODEL_FILL_2 = "[ ".$multilang_CIPMODEL_0." ] ".$multilang_FAULT_47;
	$apache_REPORTL1_CW_REMOVE_RECIPE_BODY = "
											<P CLASS='INFOREPORTRIGHT'>
												".$multilang_CHECKWEIGHERMODEL_4.": ".$multilang_FAULT_47."
											</P>
											";
	$apache_REPORTL2_CW_ADD_RECIPE_BODY = "
											<P CLASS='INFOREPORTRIGHT'>
												".$multilang_CHECKWEIGHERMODEL_5.": ".$multilang_FAULT_47."
											</P>
											";
	$apache_REPORTL2_CW_MODIFY_RECIPE_BODY = "
											<P CLASS='INFOREPORTRIGHT'>
												".$multilang_CHECKWEIGHERMODEL_1.": ".$multilang_FAULT_47."
											</P>
											";
}

/* USER LEVEL IMPORT */
/* ------------------------------------------------------------------ */
$apache_LINK_WRAPPER_START = "
								<TABLE CLASS='STANDARD' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='250'>
										</TD>
										<TD WIDTH='250'>
										</TD>
									</TR>
								";

$apache_LINK_WRAPPER_END = "
								</TABLE>
								";

/* LEVEL 0 ACCESS - INSTALLER */
/* ------------------------------------------------------------------ */
$apache_REPORTL0_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORT'>
												<B><I>".$multilang_STATIC_LEVEL." [ 0 ]</I></B><BR>
												".$multilang_SETTINGS_INSTALLERS_ONLY."<BR>
												".$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_1."<BR>
												".$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_2."<BR>
											</P>
										</TD>
									</TR>
									";

/* ---------------- */
/* -- INITIAL SETUP */
/* ---------------- */
$apache_REPORTL0_INITIAL_SETUP_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_SETTINGS_INITIAL_INSTALLATION."</U></B><BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL0_INITIAL_SETUP_BODY = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<A HREF='./seer_setup_createdb.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>S.E.E.R. ".$multilang_SETTINGS_CREATE_BASIC_DATABASE."</A> [01]<BR>
												<BR>
												<A HREF='./mod_openopc_setup_createdb_negotiation.php".$seer_REFERRINGPAGE_ADDKEYINFO.";mod_openopc_MODEL_IN_QUESTION=mod_openopc_base"."'>mod_openopc ".$multilang_SETTINGS_CREATE_BASIC_DATABASE."</A> [02]<BR>
											</P>
										</TD>
									</TR>
									";

/* LEVEL 1 ACCESS - ADMINISTRATOR */
/* ------------------------------------------------------------------ */
$apache_REPORTL1_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORT'>
												<B><I>".$multilang_STATIC_LEVEL." [ 1 ]</I></B><BR>
												".$multilang_SETTINGS_ADMINISTRATORS_ONLY."<BR>
											</P>
										</TD>
									</TR>
									";

/* -------------- */
/* -- MODEL SETUP */
/* -------------- */
$apache_REPORTL1_MODEL_SETUP_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_SETTINGS_CORE_MODEL_SETUP."</U></B><BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL1_MODEL_SETUP_BODY = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												".$apache_REPORTL1_MODEL_SETUP_TANKMODEL_FILL." [01]<BR>
												".$apache_REPORTL1_MODEL_SETUP_SPFMODEL_FILL." [02]<BR>
												".$apache_REPORTL1_MODEL_SETUP_CIPMODEL_FILL." [03]<BR>
												".$apache_REPORTL1_MODEL_SETUP_TTYPERFORMANCEMODEL_FILL." [04]<BR>
												".$apache_REPORTL1_MODEL_SETUP_BULKMODEL_FILL." [05]<BR>
												".$apache_REPORTL1_MODEL_SETUP_TOUCHPANEL_FILL." [06]<BR>
												".$apache_REPORTL1_MODEL_SETUP_THINCHART_FILL." [07]<BR>
												".$apache_REPORTL1_MODEL_SETUP_ATMOSPHERICMODEL_FILL." [08]<BR>
												".$apache_REPORTL1_MODEL_SETUP_WARRIOR_FILL_1." [09]<BR>
												".$apache_REPORTL1_MODEL_SETUP_WARRIOR_FILL_2." [10]<BR>
												".$apache_REPORTL1_MODEL_SETUP_CHECKWEIGHERMODEL_FILL_1." [11]<BR>
												".$apache_REPORTL1_MODEL_SETUP_CHECKWEIGHERMODEL_FILL_2." [12]<BR>
											</P>
										</TD>
									</TR>
									";

/* ------------------------------------- */
/* -- CHECKWEIGHER MODEL - REMOVE RECIPE */
/* ------------------------------------- */
$apache_REPORTL1_CW_REMOVE_RECIPE_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_CHECKWEIGHERMODEL_0."</U></B><BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL1_CW_REMOVE_RECIPE = "
									<TR>
										<TD COLSPAN='2'>
											".$apache_REPORTL1_CW_REMOVE_RECIPE_BODY."
										</TD>
									</TR>
									";

/* LEVEL 2 ACCESS - SUPER USER */
/* ------------------------------------------------------------------ */
$apache_REPORTL2_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORT'>
												<B><I>".$multilang_STATIC_LEVEL." [ 2 ]</I></B><BR>
												".$multilang_SETTINGS_SUPER_USERS_ONLY."<BR>
											</P>
										</TD>
									</TR>
									";

/* ------------------------------------------------- */
/* -- CHECKWEIGHER MODEL - RECIPE LIST MODIFICATIONS */
/* ------------------------------------------------- */
$apache_REPORTL2_CW_MODIFY_RECIPE_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_CHECKWEIGHERMODEL_0."</U></B><BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL2_CW_MODIFY_RECIPE = "
									<TR>
										<TD COLSPAN='2'>
											".$apache_REPORTL2_CW_ADD_RECIPE_BODY."
											".$apache_REPORTL2_CW_MODIFY_RECIPE_BODY."
										</TD>
									</TR>
									";

/* ---------------------------------- */
/* -- USER ACCESS ADD or REMOVE USERS */
/* ---------------------------------- */
$apache_REPORTL2_ADDREMOVE_USERS_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_SETTINGS_ADD_AND_REMOVE_USERS."</U></B><BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL2_ADDREMOVE_USERS_BODY = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<A HREF='./seer_setup_addusers.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_SETTINGS_ADD_SYSTEM_USERS."</A> [01]<BR>
												<A HREF='./seer_setup_removeusers.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_SETTINGS_REMOVE_SYSTEM_USERS."</A> [02]<BR>
											</P>
										</TD>
									</TR>
									";

/* ----------------------- */
/* -- USER ACCESS LOCKDOWN */
/* ----------------------- */
/*	-- PARSE INPUT */
$apache_LOCKDOWN_MSG = "";
if ( $seer_ACTIONSETTING == "REENABLEALLUSERS" ) {
	/* scroll through all users */
	$mysql_seer_query = "SELECT * FROM access WHERE ACCESSLEVEL > '2'";
	list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query);
	/* query the username and the accessstate, then decrement accessstate by 10 */
	/*	and re-write accessstate to table */
	while ( $mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_query_result)) {
		$mysql_seer_access_WORKING_USERNAME = $mysql_seer_access_row['USERNAME'];
		$mysql_seer_access_WORKING_ACCESSSTATE = $mysql_seer_access_row['ACCESSSTATE'];
		if ( $mysql_seer_access_WORKING_ACCESSSTATE >= 10 ) {
			$mysql_seer_access_WORKING_ACCESSSTATE = $mysql_seer_access_WORKING_ACCESSSTATE - 10;
		} else {
			/* pass */
		}
		$mysql_seer_query_2 = "UPDATE access SET ACCESSSTATE='".$mysql_seer_access_WORKING_ACCESSSTATE."' WHERE USERNAME='".$mysql_seer_access_WORKING_USERNAME."'";
		list($mysql_seer_query_result_2,$mysql_seer_num_rows_2) = core_mysql_seer_query_shell($mysql_seer_query_2);
	}
	$seer_PROCESSSETTING_REENABLEALLUSERS = "YES";
	$apache_LOCKDOWN_MSG = " - ".$multilang_SETTINGS_LOCKDOWN_RELEASED;
} else {
	/* no action */
	$seer_PROCESSSETTING_REENABLEALLUSERS = "NO";	
}

if ( $seer_ACTIONSETTING == "LOCKDOWNALLUSERS" ) {
	/* scroll through all users */
	$mysql_seer_query = "SELECT * FROM access WHERE ACCESSLEVEL > '2'";
	list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query);
	/* query the username and the accessstate, then increment accessstate by 10 */
	/*	and re-write accessstate to table */
	while ( $mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_query_result)) {
		$mysql_seer_access_WORKING_USERNAME = $mysql_seer_access_row['USERNAME'];
		$mysql_seer_access_WORKING_ACCESSSTATE = $mysql_seer_access_row['ACCESSSTATE'];
		if ( $mysql_seer_access_WORKING_ACCESSSTATE < 10 ) {
			$mysql_seer_access_WORKING_ACCESSSTATE = $mysql_seer_access_WORKING_ACCESSSTATE + 10;
		} else {
			/* pass */
		}
		$mysql_seer_query_2 = "UPDATE access SET ACCESSSTATE='".$mysql_seer_access_WORKING_ACCESSSTATE."' WHERE USERNAME='".$mysql_seer_access_WORKING_USERNAME."'";
		list($mysql_seer_query_result_2,$mysql_seer_num_rows_2) = core_mysql_seer_query_shell($mysql_seer_query_2);
	}
	$seer_PROCESSSETTING_LOCKDOWNALLUSERS = "YES";
	$apache_LOCKDOWN_MSG = " - ".$multilang_SETTINGS_LOCKDOWN_IN_EFFECT;
} else {
	/* no action */
	$seer_PROCESSSETTING_LOCKDOWNALLUSERS = "NO";	
}

/*	-- DIALOGUE */
$apache_REPORTL2_LOCKDOWN_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_SETTINGS_LOCKDOWN_CONTROL."</U><I>".$apache_LOCKDOWN_MSG."</I></B><BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL2_LOCKDOWN_BODY = "
									<TR>
										<TD COLSPAN='2'>
											<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
												<P CLASS='INFOREPORTRIGHT'>
													<INPUT TYPE='radio' name='seer_ACTIONSETTING' value='LOCKDOWNALLUSERS'>".$multilang_SETTINGS_LOCKDOWN_DISABLE_ACCESS." [01]<BR>
													<INPUT TYPE='radio' name='seer_ACTIONSETTING' value='REENABLEALLUSERS'>".$multilang_SETTINGS_LOCKDOWN_ENABLE_ACCESS." [02]<BR>
													<INPUT TYPE='hidden' name='seer_PROCESSSETTING' value='YES'>
												</P>
												<P ALIGN='RIGHT'>
													<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
												</P>
											</FORM>
										</TD>
									</TR>
									";

/* LEVEL 3 ACCESS - MANAGER */
/* ------------------------------------------------------------------ */
$apache_REPORTL3_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORT'>
												<B><I>".$multilang_STATIC_LEVEL." [ 3 ]</I></B><BR>
												".$multilang_SETTINGS_MANAGERS_ONLY.".<BR>
											</P>
										</TD>
									</TR>
									";

$apache_REPORTL3_WARRIOR_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U><IMG SRC='./img/warrior_textsize_1.png' BORDER='0' ALT='WARRIOR'></U></B><BR>
											</P>
									</TR>
									";

$apache_REPORTL3_WARRIOR_BODY = "
									<TR>
										<TD COLSPAN='2'>
											".$apache_REPORTL3_WARRIOR_BODY_FILL."
										</TD>
									</TR>
									";

/* LEVEL 4 ACCESS - SUPERVISOR */
/* ------------------------------------------------------------------ */
/* ------------------------------ */
/* -- NOTHING UNIQUE AT THIS TIME */
/* ------------------------------ */

/* LEVEL 5 ACCESS - LEAD PERSON */
/* ------------------------------------------------------------------ */
$apache_REPORTL5_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORT'>
												<B><I>".$multilang_STATIC_LEVEL." [ 5 ]</I></B><BR>
												".$multilang_SETTINGS_LEAD_PERSONS_ONLY.".<BR>
											</P>
										</TD>
									</TR>
									";

/* --------------------- */
/* -- USERLIST TO MODIFY */
/* --------------------- */
$apache_REPORT_L5_USER_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_SETTINGS_MODIFY_USER_ACCESS_AND_INFORMATION."</U></B><BR>
											</P>
									</TR>
									";

/*	-- PARSE INPUT */
if ( $seer_ACTIONSETTING == "DISPLAYALLUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '2' ) {	
		$seer_ACTIONSETTING = "DISPLAYSITEUSERS";
	} else {
		$mysql_seer_query = "SELECT * FROM access ORDER BY USERNAME ASC";
		/* continue */
	}
}
if ( $seer_ACTIONSETTING == "DISPLAYSITEUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '3' ) {	
		$seer_ACTIONSETTING = "DISPLAYDEPTUSERS";
	} else {
		$mysql_seer_query = "SELECT * FROM access WHERE SITE='".$mysql_seer_access_SITE."' ORDER BY USERNAME ASC";
		/* continue */
	}
}
if ( $seer_ACTIONSETTING == "DISPLAYDEPTUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '4' ) {	
		$seer_ACTIONSETTING = "DISPLAYSHIFTUSERS";
	} else {
		$mysql_seer_query = "SELECT * FROM access WHERE COMPANY='".$mysql_seer_access_COMPANY."' AND SITE='".$mysql_seer_access_SITE."' AND DEPARTMENT='".$mysql_seer_access_DEPARTMENT."' ORDER BY USERNAME ASC";
		/* continue */
	}
}
if ( $seer_ACTIONSETTING == "DISPLAYSHIFTUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '5' ) {	
		$seer_PROCESSSETTING = "NO";
	} else {
		/* continue */
		$mysql_seer_query = "SELECT * FROM access WHERE COMPANY='".$mysql_seer_access_COMPANY."' AND SITE='".$mysql_seer_access_SITE."' AND DEPARTMENT='".$mysql_seer_access_DEPARTMENT."' AND SHIFT='".$mysql_seer_access_SHIFT."' ORDER BY USERNAME ASC";
	}
}

if ( $seer_PROCESSSETTING == "YES" ) {
	list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query);
	$apache_REPORTL5_USER_OUTPUT = "
									<TR>
										<TD COLSPAN='2'>
											<TABLE CLASS='STANDARD' ALIGN='RIGHT' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
												<TR>
													<TD WIDTH='110'>
													</TD>
													<TD WIDTH='120'>
													</TD>
													<TD WIDTH='120'>
													</TD>
													<TD WIDTH='110'>
													</TD>
													<TD WIDTH='40'>
													</TD>
												</TR>
												<TR>
													<TD COLSPAN='5'>
														<BR>
													</TD>
												</TR>
												<TR>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><U>".$multilang_SETTINGS_USERNAME."</U></B>
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><U>".$multilang_SETTINGS_REALNAME."</U></B>
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><U>".$multilang_SETTINGS_SITE."</U></B>
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><U>".$multilang_SETTINGS_DEPARTMENT."</U></B>
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														<B><U>".$multilang_SETTINGS_SHIFT."</U></B>
													</TD>
												</TR>
									";

	while ( $mysql_seer_row = mysqli_fetch_assoc($mysql_seer_query_result)) {
		$mysql_seer_access_WORKING_USERNAME = $mysql_seer_row['USERNAME'];
		$mysql_seer_access_WORKING_REALNAME = $mysql_seer_row['REALNAME'];
		$mysql_seer_access_WORKING_SITE = $mysql_seer_row['SITE'];
		$mysql_seer_access_WORKING_DEPARTMENT = $mysql_seer_row['DEPARTMENT'];
		$mysql_seer_access_WORKING_SHIFT = $mysql_seer_row['SHIFT'];
				
		$apache_REPORTL5_USER_OUTPUT = $apache_REPORTL5_USER_OUTPUT."
												<TR>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														<A HREF='./seer_setup_modifyuser.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_USERTOMODIFY=".$mysql_seer_access_WORKING_USERNAME."'>".$mysql_seer_access_WORKING_USERNAME."</A>
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														".$mysql_seer_access_WORKING_REALNAME."
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														".$mysql_seer_access_WORKING_SITE."
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														".$mysql_seer_access_WORKING_DEPARTMENT."
													</TD>
													<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
														".$mysql_seer_access_WORKING_SHIFT."
													</TD>
												</TR>
												";
	}

	$apache_REPORTL5_USER_OUTPUT = $apache_REPORTL5_USER_OUTPUT."
											</TABLE>
										</TD>
									</TR>
									";
	
	$seer_PROCESSSETTING_DISPLAYXUSERS = "YES";

} else {
	/* no action */
	$seer_PROCESSSETTING_DISPLAYXUSERS = "NO";	
}

/*	-- USER LIST DIALOGUE */
$apache_REPORT_L5_USER_BODY = "
									<TR>
										<TD>
											<BR>
										</TD>
										<TD>
											<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
												<P CLASS='INFOREPORTRIGHTSMALL'>
													<INPUT TYPE='radio' name='seer_ACTIONSETTING' value='DISPLAYALLUSERS'>".$multilang_SETTINGS_DISPLAY_ALL_USERS." [01]<BR>
													<INPUT TYPE='radio' name='seer_ACTIONSETTING' value='DISPLAYSITEUSERS'>".$multilang_SETTINGS_DISPLAY_SITE_USERS." [02]<BR>
													<INPUT TYPE='radio' name='seer_ACTIONSETTING' value='DISPLAYDEPTUSERS'>".$multilang_SETTINGS_DISPLAY_DEPARTMENT_USERS." [03]<BR>
													<INPUT TYPE='radio' name='seer_ACTIONSETTING' value='DISPLAYSHIFTUSERS'>".$multilang_SETTINGS_DISPLAY_SHIFT_USERS." [04]<BR>
													<INPUT TYPE='hidden' name='seer_PROCESSSETTING' value='YES'>
												</P>
												<P ALIGN='RIGHT'>
													<INPUT TYPE='image' NAME='enter' SRC='./img/form_submit_0.png'><BR>
												</P>
											</FORM>
										</TD>
									</TR>
									";

/*	-- USERLIST TO DISPLAY (or NONE) */
if ( $seer_PROCESSSETTING_DISPLAYXUSERS == "YES" ) {
	/* pass */
} else {
	$apache_REPORTL5_USER_OUTPUT = "";
}

/* LEVEL 6 ACCESS - MAINTENANCE and SKILLED TRADES */
/* ------------------------------------------------------------------ */
/* ------------------------------ */
/* -- NOTHING UNIQUE AT THIS TIME */
/* ------------------------------ */

/* LEVEL 7 ACCESS - OPERATOR */
/* ------------------------------------------------------------------ */
$apache_REPORTL7_HEADER = "

									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORT'>
												<B><I>".$multilang_STATIC_LEVEL." [ 7 ]</I></B><BR>
												".$multilang_SETTINGS_OPERATORS_ONLY.".<BR>
											</P>
										</TD>
									</TR>
									";

/* -------------------------------- */
/* -- USER PASSWORD CHANGE / UPDATE */
/* -------------------------------- */
$apache_REPORTL7_PW_HEADER = "
									<TR>
										<TD COLSPAN='2'>
											<P CLASS='INFOREPORTRIGHT'>
												<B><U>".$multilang_SETTINGS_CHANGE_YOUR_PASSWORD."</U></B><BR>
											</P>
										</TD>
									</TR>
									";

/*	-- PARSE INPUT */
if ( $seer_ACTIONSETTING == "UPDATEUSERPASSWORD" ) {
	/* ACCEPT INCOMING VARIABLES */
	if ( $_POST[seer_OFFEREDNEWPASSWORD] != '' ) {	
		$seer_OFFEREDNEWPASSWORD = $_POST['seer_OFFEREDNEWPASSWORD'];
	} else {
		$seer_PROCESSSETTING = "NO";
	}
	if ( $_POST[seer_OFFEREDOLDPASSWORD] != '' ) {
		$seer_OFFEREDOLDPASSWORD = $_POST['seer_OFFEREDOLDPASSWORD'];
	} else {
		$seer_PROCESSSETTING = "NO";
	}
	/* CHECK IF PASSWORD IS GOOD (EXISTING) */
	if ( $seer_OFFEREDOLDPASSWORD == $mysql_seer_access_PASSWORD ) {
		/* continue */
	} else {
		/* bad password */
		$seer_PROCESSSETTING = "NO";
	}
	/* FINAL CHECK AND THEN EXECUTE ACTION IF OK */
	if ( $seer_PROCESSSETTING == "YES" ) {
		$seer_PROCESSSETTING_UPDATEUSERPASSWORD = "YES";
		/* update user password function */
		$mysql_seer_query = "UPDATE access SET PASSWORD='".$seer_OFFEREDNEWPASSWORD."' WHERE USERNAME='".$mysql_seer_access_USERNAME."'";
		list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query,"1");
		$mysql_seer_query = "UPDATE access SET LASTMODIFIED='".$apache_DEFAULTDATESTAMP."' WHERE USERNAME='".$mysql_seer_access_USERNAME."'";
		list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query,"1");
		$mysql_seer_query = "UPDATE access SET LASTMODIFIEDBY='".$mysql_seer_access_USERNAME."' WHERE USERNAME='".$mysql_seer_access_USERNAME."'";
		list($mysql_seer_query_result,$mysql_seer_num_rows) = core_mysql_seer_query_shell($mysql_seer_query,"1");
	} else {
		/* no action */
		$seer_PROCESSSETTING_UPDATEUSERPASSWORD = "NO";
	}
} else {
	/* no action */
	$seer_PROCESSSETTING_UPDATEUSERPASSWORD = "NO";
}


/*	-- PASSWORD CHANGE DIALOGUE */
if ( $seer_PROCESSSETTING_UPDATEUSERPASSWORD == "YES" ) {
	$apache_REPORTL7_PW_BODY = "
									<TR>
										</TD>
											<P CLASS='INFOREPORTRIGHT'>
												".$multilang_SETTINGS_PASSWORD_UPDATED."<BR>
											</P>
										</TD>
									</TR>
									";
} else {
	$apache_REPORTL7_PW_BODY = "
									<TR>
										<TD>
											<BR>
										</TD>
										<TD>
											<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
												<TABLE CLASS='STANDARD' ALIGN='RIGHT' WIDTH='250' CELLPADDING=0 CELLSPACING=0>
													<TR>
														<TD WIDTH='100'>
														</TD>
														<TD WIDTH='150'>
														</TD>
													</TR>
													<TR>
														<TD ALIGN='LEFT' VALIGN='MIDDLE'>
															<P CLASS='INFOREPORT'>
																".$multilang_SETTINGS_OLD_PASSWORD.":
															</P>
														</TD>
														<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
															<INPUT TYPE='password' size='15' maxlength='30' NAME='seer_OFFEREDOLDPASSWORD'>
														</TD>
													</TR>
													<TR>
														<TD ALIGN='LEFT' VALIGN='MIDDLE'>
															<P CLASS='INFOREPORT'>
																".$multilang_SETTINGS_NEW_PASSWORD.":
															</P>
														</TD>
														<TD ALIGN='RIGHT' VALIGN='MIDDLE'>
															<INPUT TYPE='password' size='15' maxlength='30' NAME='seer_OFFEREDNEWPASSWORD'>
														</TD>
													</TR>
													<TR>
														<TD>
															<INPUT TYPE='hidden' NAME='seer_PROCESSSETTING' VALUE='YES'>
															<INPUT TYPE='hidden' NAME='seer_ACTIONSETTING' VALUE='UPDATEUSERPASSWORD'>
														</TD>
														<TD ALIGN='RIGHT'>
															<P ALIGN='RIGHT'>
																<INPUT TYPE='image' NAME='enter' SRC='./img/form_submit_0.png'>
															</P>
														</TD>
													</TR>
												</TABLE>
											</FORM>
										</TD>
									</TR>
									";
}

/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL0 = $apache_LINK_WRAPPER_START.$apache_REPORTL0_HEADER.$apache_REPORTL0_INITIAL_SETUP_HEADER.$apache_REPORTL0_INITIAL_SETUP_BODY.$apache_LINK_WRAPPER_END; 
$apache_REPORTL1 = $apache_LINK_WRAPPER_START.$apache_REPORTL1_HEADER.$apache_REPORTL1_MODEL_SETUP_HEADER.$apache_REPORTL1_MODEL_SETUP_BODY.$apache_REPORTL1_CW_REMOVE_RECIPE_HEADER.$apache_REPORTL1_CW_REMOVE_RECIPE.$apache_LINK_WRAPPER_END;
$apache_REPORTL2 = $apache_LINK_WRAPPER_START.$apache_REPORTL2_HEADER.$apache_REPORTL2_ADDREMOVE_USERS_HEADER.$apache_REPORTL2_ADDREMOVE_USERS_BODY.$apache_REPORTL2_LOCKDOWN_HEADER.$apache_REPORTL2_LOCKDOWN_BODY.$apache_REPORTL2_CW_MODIFY_RECIPE_HEADER.$apache_REPORTL2_CW_MODIFY_RECIPE.$apache_LINK_WRAPPER_END;
$apache_REPORTL3 = $apache_LINK_WRAPPER_START.$apache_REPORTL3_HEADER.$apache_REPORTL3_WARRIOR_HEADER.$apache_REPORTL3_WARRIOR_BODY.$apache_LINK_WRAPPER_END;
$apache_REPORTL4 = "";
$apache_REPORTL5 = $apache_LINK_WRAPPER_START.$apache_REPORTL5_HEADER.$apache_REPORT_L5_USER_HEADER.$apache_REPORT_L5_USER_BODY.$apache_REPORTL5_USER_OUTPUT.$apache_LINK_WRAPPER_END;
$apache_REPORTL6 = "";
$apache_REPORTL7 = $apache_LINK_WRAPPER_START.$apache_REPORTL7_HEADER.$apache_REPORTL7_PW_HEADER.$apache_REPORTL7_PW_BODY.$apache_LINK_WRAPPER_END;

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
$MODEL_ASSEMBLE_REPORT_BACKWARDS = "YES";
$MODEL_MENUMACHINECONTROL_ENABLE = "YES";
	/*	-- use the MENUMACHINECONTROL block device for layout */
seer_final_report();

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
