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
SETUP THE DECLARED S.E.E.R. DATABASE
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$seer_BOUNCEBACKTIME = "90";
/*	-- kick back to REFERRINGPAGE in 90 seconds */
$seer_REFERRINGPAGE = "./seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO;
/*	-- when we execute functions, send the user back here at end */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_SETUP_0." - S.E.E.R.</B>
						</P>
						";

/* DECIDE WHETHER TO PROCEED - PREVENT OVERRUNNING ACTIVE TABLES */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* SETUP ACTION */
/* ----------------------------------------------------------------- */

if ( $seer_setup_PROCEED_SETUPACTION == "YES" ) {
	$mysql_seer_query = "CREATE DATABASE IF NOT EXISTS ".$mysql_seer_DBNAME;
	$mysql_seer= mysqli_query($mysql_seer_CONNECT, $mysql_seer_query);
	mysqli_select_db($mysql_seer_CONNECT, $mysql_seer_DBNAME);
	$mysql_seer_query = "CREATE TABLE IF NOT EXISTS access(USERNAME VARCHAR(30), PRIMARY KEY(USERNAME), INDEX(USERNAME), UID BIGINT NOT NULL AUTO_INCREMENT, INDEX(UID), PASSWORD VARCHAR(30) NOT NULL, REALNAME VARCHAR(60) NOT NULL, INDEX(REALNAME), PHONE VARCHAR(30) NOT NULL, EMAIL VARCHAR(60) NOT NULL, COMPANY VARCHAR(30) NOT NULL, INDEX(COMPANY), SITE VARCHAR(30) NOT NULL, INDEX(SITE), DEPARTMENT VARCHAR(30) NOT NULL, INDEX(DEPARTMENT), SUPERVISOR VARCHAR(30) NOT NULL, INDEX(SUPERVISOR), SHIFT INT NOT NULL, INDEX(SHIFT), ACCESSGRANTED VARCHAR(20) NOT NULL, ACCESSGRANTEDBY VARCHAR(30) NOT NULL, LASTMODIFIED VARCHAR(20) NOT NULL, LASTMODIFIEDBY VARCHAR(30) NOT NULL, ACCESSLEVEL INT NOT NULL, INDEX(ACCESSLEVEL), ACCESSSTATE INT NOT NULL, INDEX(ACCESSSTATE), LASTLOGIN VARCHAR(20) NOT NULL, INDEX(LASTLOGIN), LASTACTIVITY VARCHAR(20) NOT NULL, INDEX(LASTACTIVITY), ACTIVEKEY VARCHAR(30) NOT NULL)";
	if ( $mysql_USE_INNODB_ENGINE == 'YES' ) {
		$mysql_seer_query = $mysql_seer_query." ENGINE=InnoDB";
	} else {
		/* leave tables as default */
	}
	$mysql_seer= mysqli_query($mysql_seer_CONNECT, $mysql_seer_query);	
	$mysql_seer_query = "INSERT INTO access VALUES('administrator', '0', 'administrator', 'Firstname Lastname', '999-999-9999 x999', 'admin@mysite.com', 'My Business', 'My Location', 'My Department', 'Head of My Department', '1', '".$apache_DEFAULTDATESTAMP."', 'CONSOLE', 'NEVER', 'NOONE', '1', '1', 'NEVER', 'NEVER', '1')";
	echo $mysql_seer_query;
	$mysql_seer= mysqli_query($mysql_seer_CONNECT, $mysql_seer_query);
} else {
	/* take no action */
	echo "No Action Taken";
}

/* REPORT */
/* ------------------------------------------------------------------ */

if ( $seer_setup_PROCEED_SETUPACTION == "YES" ) {
	$apache_REPORT_RIGHTPANEL = "
										".$multilang_SETUP_9."<BR>
										<BR>
										[mysql] SHOW DATABASES;<BR> 
										<I>(".$multilang_SETUP_10." '".$mysql_seer_DBNAME."')</I><BR>
										<BR>
										[mysql] USE ".$mysql_seer_DBNAME.";<BR>
										[mysql] SHOW TABLES FROM ".$mysql_seer_DBNAME.";<BR>
										<I>(".$multilang_SETUP_10." 'access')</I><BR>
										<BR>
										[mysql] SELECT * FROM access;<BR>
										<I>(".$multilang_SETUP_16." 'administrator')</I><BR>
										<BR>
										".$multilang_SETUP_11."<BR>
										<BR>
										".$multilang_SETUP_12."<BR>
										<BR>
										".$multilang_SETUP_17."<BR>
										<BR>
										<B>".$multilang_SETUP_18.":</B> administrator<BR>
										<B>".$multilang_SETUP_19.":</B> administrator<BR>
										<BR>
										".$multilang_SETUP_20."
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
include('./include/seer_echo_to_html.php');

?>
