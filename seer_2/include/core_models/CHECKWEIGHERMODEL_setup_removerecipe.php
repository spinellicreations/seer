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
CHECKWEIGHER MODEL REMOVE RECIPE
-- REMOVE RECIPE
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('../../config/globaloptions_seer_0.php');
include('../../config/CHECKWEIGHERMODEL/globaloptions_CHECKWEIGHERMODEL_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "DYNAMIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO;
/*	-- when we execute functions, send the user back here at end */
$seer_BOUNCEBACKTIME = 2;
/*	-- bounce back immediate to referring page after action executed */

/* ACCEPT INPUT PASSED FROM REFERRING PAGE*/
/* ------------------------------------------------------------------ */
if ( $_POST[seer_USERTOMODIFY] != '' ) {
	$seer_USERTOMODIFY = $_POST['seer_USERTOMODIFY'];
	$seer_PROCESSSETTING = "YES";
} else {
	$seer_PROCESSSETTING = "NO";
}

/* DECIDE IF WE EVEN DISPLAY THIS PAGE AND IF SO, WHAT 		      */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$seer_PROCESSSETTING = "NO";
	$apache_ERRORFEEDBACK = "
							<P CLASS='INFOREPORT'>
								".$multilang_FAULT_34."<BR>
								<BR>
							</P>
							";
} else {
	/* continue */
}

if ( $seer_PROCESSSETTING == "YES" ) {
	$seer_PROCESSSETTING_FINAL = "YES";
} else {
	$seer_PROCESSSETTING_FINAL = "NO";
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CHECKWEIGHERMODEL_0."</B><BR>
								<BR>
								<B>".$multilang_CHECKWEIGHERMODEL_21."</B>
								<BR>
								<A HREF='/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* PERMISSION BASED INPUT FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_mod_openopc_access_ACCESSLEVEL < 3 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING == "YES" ) {
		$mysql_mod_openopc_query = "DELETE FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	} else {
		/* no action */
	}

} else {
		/* no action */
}

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSSETTING_FINAL == "YES" ) {
	$apache_REPORT = "
							<P CLASS='INFOREPORT'>
								".$multilang_CHECKWEIGHERMODEL_22."<BR>
								<BR>
							</P>
							";
} else {
	$apache_REPORT = "
							<P CLASS='INFOREPORT'>
								<B><U>".$multilang_FAULT_12."</B></U><BR>
								<BR>
							</P>".
							$apache_ERRORFEEDBACK;
}

$apache_REPORT = "
						<DIV CLASS='USERREPORT'>
							".$apache_REPORT."
						</DIV>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('../seer_echo_to_html.php');

?>
