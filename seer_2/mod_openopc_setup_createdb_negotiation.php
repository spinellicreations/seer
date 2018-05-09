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
SETUP THE DECLARED mod_openopc DATABASE
-- GENERIC FOR ANY MODEL
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* PULL IN PASSED VARIABLES */
/* ------------------------------------------------------------------ */
$mod_openopc_setup_PROCEED_SETUPACTION = "NO";
if ( $_GET[mod_openopc_MODEL_IN_QUESTION] != '' ) {
	$MODEL_IN_QUESTION = $_GET['mod_openopc_MODEL_IN_QUESTION'];
	$mod_openopc_setup_PROCEED_SETUPACTION = "YES";
	echo "you are here";
} else {
	$mod_openopc_setup_PROCEED_SETUPACTION = "NO";
	echo "you passed";
}

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = "90";
/*	-- kick back to REFERRINGPAGE in 90 seconds */
$seer_REFERRINGPAGE = "./seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO;
/*	-- when we execute functions, send the user back here at end */

/* DECIDE WHETHER TO PROCEED - PREVENT OVERRUNNING ACTIVE TABLES */
/* ------------------------------------------------------------------ */
if ( $mod_openopc_setup_PROCEED_SETUPACTION == "YES" ) {
	core_user_active_or_dead();
	
} else {
	/* pass */
	
}

/* SETUP ACTION */
/* ----------------------------------------------------------------- */

if ( $mod_openopc_setup_PROCEED_SETUPACTION == "YES" ) {

	if ($MODEL_IN_QUESTION == "mod_openopc_base") {

		/* IF AND ONLY IF THIS IS A CALL FOR THE mod_openopc DATABASE BUILD */
		/* ---------------------------------------------------------------- */
		$MODEL_TABLE_TO_USE[0] = $mod_openopc_1st_LEVEL_DB_CREATION_Q03;
		echo $mod_openopc_1st_LEVEL_DB_CREATION_Q01;
		$mysql_mod_openopc_query = $mod_openopc_1st_LEVEL_DB_CREATION_Q01;
		mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
		mysqli_select_db($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_DBNAME);
		$mysql_mod_openopc_query = $mod_openopc_1st_LEVEL_DB_CREATION_Q02;
		if ( $mysql_USE_INNODB_ENGINE == 'YES' ) {
			$mysql_mod_openopc_query = $mysql_mod_openopc_query." ENGINE=InnoDB";
		} else {
			/* leave tables as default */
		}
		mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);

	} else {

		/* -- TASKS COMMON TO ALL MODELS / MODULES */
		/* --------------------------------------- */
		include('./config/'.$MODEL_IN_QUESTION.'/globaloptions_'.$MODEL_IN_QUESTION.'_0.php');
		foreach ($MODEL_QUERY_TO_RUN as &$MODEL_QUERY_TO_RUN_EXAMINED) {
			$mysql_mod_openopc_query = $MODEL_QUERY_TO_RUN_EXAMINED;
			if ( $mysql_USE_INNODB_ENGINE == 'YES' ) {
				$mysql_mod_openopc_query = $mysql_mod_openopc_query." ENGINE=InnoDB";
			} else {
				/* leave tables as default */
			}
			mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
		}

		/* -- EXTRA TASKS SPECIFIC TO THE CHECKWEIGHER MODEL */
		/* -------------------------------------------------------------------- */
		if ( $MODEL_IN_QUESTION == "CHECKWEIGHERMODEL" ) {
			/* insert a record for the null job */
			$mysql_mod_openopc_query = $MODEL_QUERY_FOR_NULL;
			$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
			$mysql_mod_openopc_query_result_count = mysqli_num_rows($mysql_mod_openopc_query_result);
			if ($mysql_mod_openopc_query_result_count < 1) {
				$mysql_mod_openopc_query = $MODEL_QUERY_TO_CREATE_NULL;
				mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
			} else {
				/* already exists, pass */
			}
		} else {
			/* pass */
		}
		/* -- EXTRA TASKS SPECIFIC TO THE WARRIOR MODULE */
		/* -------------------------------------------------------------------- */
		if ( $MODEL_IN_QUESTION == "WARRIOR" ) {
			/* insert a record for the null job */
			$mysql_mod_openopc_query = $MODEL_QUERY_FOR_NULL;
			$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
			$mysql_mod_openopc_query_result_count = mysqli_num_rows($mysql_mod_openopc_query_result);
			if ($mysql_mod_openopc_query_result_count < 1) {
				$mysql_mod_openopc_query = $MODEL_QUERY_TO_CREATE_NULL;
				mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
				$mysql_mod_openopc_query = $MODEL_QUERY_TO_FIX_NULL;
				mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
			} else {
				/* already exists, pass */
			}
		} else {
			/* pass */
		}
	}

} else {
	/* take no action */
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_SETUP_0." - mod_openopc</B><BR>
							<B><I>".$MODEL_NAME_TO_USE."</I></B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */

if ( $mod_openopc_setup_PROCEED_SETUPACTION == "YES" ) {
	$apache_REPORT_RIGHTPANEL = "
										".$multilang_SETUP_9."<BR>
										<BR>
										[mysql] SHOW DATABASES;<BR> 
										<I>(".$multilang_SETUP_10." '".$mysql_mod_openopc_DBNAME."')</I><BR>
										<BR>
										[mysql] USE ".$mysql_mod_openopc_DBNAME.";<BR>
										[mysql] SHOW TABLES FROM ".$mysql_mod_openopc_DBNAME.";<BR>
										<I>(".$multilang_SETUP_10." ";

	foreach ($MODEL_TABLE_TO_USE as &$MODEL_TABLE_TO_USE_EXAMINED) {
		$apache_REPORT_RIGHTPANEL = $apache_REPORT_RIGHTPANEL."'".$MODEL_TABLE_TO_USE_EXAMINED."', ";
	}

	$apache_REPORT_RIGHTPANEL = $apache_REPORT_RIGHTPANEL.")</I><BR>
										<BR>
										".$multilang_SETUP_11."<BR>
										<BR>
										".$multilang_SETUP_12."<BR>
										";
} else {
	$apache_REPORT_RIGHTPANEL = "
										".$multilang_SETUP_0."<BR>
										<BR>
										".$multilang_SETUP_1."<BR>
										<BR>
										".$multilang_SETUP_2."<BR>
										<BR>
										".$multilang_SETUP_3."<BR>
										".$multilang_SETUP_4."<BR>
										".$multilang_SETUP_5."<BR>
										<BR>
										".$multilang_SETUP_6."<BR>
										";
}

$apache_REPORT = "
						<TABLE ALIGN='CENTER' WIDTH='630' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='330' ALIGN='CENTER' VALIGN='MIDDLE'>
									<IMG SRC='".$seer_DEFAULTSETUPLOGO."' ALT='setup'>
								</TD>
								<TD WIDTH='300'>
									<P CLASS='INFOREPORT'>
										<I>".$multilang_SETUP_7."<BR>
										<BR>
										".$multilang_SETUP_8."</I><BR>
										<BR>
										".$apache_REPORT_RIGHTPANEL."
									</P>
								</TD>
							</TR>
						</TABLE>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
