<?php

/*
S.E.E.R. - The Warrior module.
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
SETUP THE DECLARED mod_openopc SCHEDULE TABLE population
-- FOR WARRIOR
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('../../config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = "90";
/*	-- kick back to REFERRINGPAGE in 90 seconds */
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO;
/*	-- when we execute functions, send the user back here at end */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_WARRIOR_129." - mod_openopc</B><BR>
								<B><I>".$multilang_WARRIOR_0."</I></B>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* SETUP ACTION */
/* ----------------------------------------------------------------- */
if ( $mod_openopc_setup_PROCEED_SETUPACTION == "YES" ) {
	include($apache_WEBROOT.'/'.$apache_seer_VERSION.'/config/WARRIOR/globaloptions_WARRIOR_0.php');

	$mysql_global_index = 0;
	while ($mysql_global_index <= $seer_WARRIOR_MODEL_COUNT_ADJUSTED) {

		$mysql_WARRIOR_WORKING_OPTIONS_FILE = $apache_WEBROOT."/".$apache_seer_VERSION."/config/WARRIOR/localoptions_WARRIOR_".$mysql_global_index.".php";

		if (file_exists($mysql_WARRIOR_WORKING_OPTIONS_FILE)) {

			include ($mysql_WARRIOR_WORKING_OPTIONS_FILE);

			$mysql_local_index = 0;
			while ($mysql_local_index <= $WARRIOR_COUNT_ADJUSTED) {

				/* CHECK FOR EXISTENCE */
				$mysql_mod_openopc_records = 0;
				$mysql_mod_openopc_query = "SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." WHERE MACHINE LIKE '".$WARRIOR_NAME[$mysql_local_index]."'";
				list($mysql_mod_openopc_query_result,$mysql_mod_openopc_records) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

				if ($mysql_mod_openopc_records >= 1) {
					/* -- IF PRESENT, IGNORE REQUEST -- */
				} else {
					/* -- IF ABSENT, ADD TO SCHEDULE TABLE -- */
					$mysql_mod_openopc_query = "INSERT INTO ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE." (MACHINE, SCHEDULE_NUMBER) VALUES('".$WARRIOR_NAME[$mysql_local_index]."', '0')";
					list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
				}
				/* INDEX */
				$mysql_local_index = $mysql_local_index + 1;
			}
		} else {
			/* pass */
		}
		/* INDEX */
		$mysql_global_index = $mysql_global_index + 1;
	}
} else {
	/* take no action */
}

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
										<I>(".$multilang_SETUP_10." '".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE."', '".$WARRIOR_mysql_mod_openopc_TABLENAME_DATA."'&#38 '".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB."')</I><BR>
										<BR>
										[mysql] SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_SCHEDULE.";<BR>
										<I>(".$multilang_WARRIOR_130.")</I><BR>
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
							<TABLE ALIGN='CENTER' WIDTH='630'>
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
include('../seer_echo_to_html.php');

?>