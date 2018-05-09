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
LOGOUT
-- USER LOGOUT AND REMOVE PERMISSIONS BY DEPRECATING ACTIVE KEY IN DB
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_49."</B>
						</P>
						";

/* FORCE UPDATE OF HASH KEY IN ACCESS TABLE */
/* ------------------------------------------------------------------ */
$seer_ACTIVEKEY0 = rand(0,32768);
$seer_ACTIVEKEY1 = rand(0,32768);
$seer_ACTIVEKEY2 = rand(0,32768);
$seer_ACTIVEKEY3 = rand(0,32768);
$seer_ACTIVEKEY4 = rand(0,32768);
$seer_ACTIVEKEY5 = rand(0,32768);
$seer_ACTIVEKEY_PENDING = $seer_ACTIVEKEY0.$seer_ACTIVEKEY1.$seer_ACTIVEKEY2.$seer_ACTIVEKEY3.$seer_ACTIVEKEY4.$seer_ACTIVEKEY5;
/* update the user access table, rollover access table ACTIVEKEY */
if ($seer_USERNAME_DISCARD != 'WEB_GUEST') {
	$mysql_seer_access_query = "UPDATE access SET ACTIVEKEY='".$seer_ACTIVEKEY_PENDING."' WHERE USERNAME='".$seer_USERNAME_DISCARD."'";
	mysqli_select_db($mysql_seer_CONNECT, $mysql_seer_DBNAME);
	mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);
} else {
	/* pass */
}

/* REPORT */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE == 'NO' ) {
	$seer_LOGOUT_CONFIRMATION = $multilang_STATIC_NO;
} else {
	$seer_LOGOUT_CONFIRMATION = $multilang_STATIC_YES;
}

$apache_REPORT = "
						<TABLE ALIGN='CENTER' WIDTH='630' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='380' ALIGN='CENTER' VALIGN='MIDDLE'>
									<IMG SRC='".$seer_DEFAULTHOMELOGO."' ALT='logo'>
								</TD>
								<TD WIDTH='250'>
									<P CLASS='INFOREPORT'>
										<B>".$multilang_STATIC_50."</B><BR>
										...".$seer_LOGOUT_CONFIRMATION."<BR>
										<BR>
										".$multilang_STATIC_51."
									</P>
								</TD>
							</TR>
						</TABLE>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
