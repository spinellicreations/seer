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
LOGIN
-- USER LOGIN AND LOAD PERMISSIONS BY GENERATING ACTIVE KEY
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "./seer_login.php";
/*	-- this page, self-submit for form processing */

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_PROCESSLOGIN] != '' ) {
	$seer_PROCESSLOGIN = $_POST['seer_PROCESSLOGIN'];
} else {
	$seer_PROCESSLOGIN = "NO";
}
if ( $_POST[seer_OFFEREDPASSWORD] != '' ) {
	$seer_OFFEREDPASSWORD = $_POST['seer_OFFEREDPASSWORD'];
} else {
	$seer_OFFEREDPASSWORD = "NONE-or-FAKE";
}
if ( $_POST[seer_OFFEREDUSERNAME] != '' ) {
	$seer_OFFEREDUSERNAME = $_POST['seer_OFFEREDUSERNAME'];
} else {
	$seer_OFFEREDUSERNAME = "NONE-or-FAKE";
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_38."</B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSLOGIN == "YES" ) {
	/* check the data to see if we have a username and password match */
	$mysql_seer_access_query = "SELECT * FROM access WHERE USERNAME LIKE '".$seer_OFFEREDUSERNAME."'";
	$mysql_seer_access = mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);
	$mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_access);

	$mysql_seer_access_USERNAME = $mysql_seer_access_row['USERNAME'];
	$mysql_seer_access_PASSWORD = $mysql_seer_access_row['PASSWORD'];

	if ( $mysql_seer_access_PASSWORD == $seer_OFFEREDPASSWORD ) {
		$seer_PROCESSLOGINCONFIRMED = "YES";
	} else {
		$seer_PROCESSLOGINCONFIRMED = "NO";
	}
	if ( $seer_PROCESSLOGINCONFIRMED == "YES" ) {
		/* generate new activekey */
		$seer_ACTIVEKEY0 = rand(0,32768);
		$seer_ACTIVEKEY1 = rand(0,32768);
		$seer_ACTIVEKEY2 = rand(0,32768);
		$seer_ACTIVEKEY3 = rand(0,32768);
		$seer_ACTIVEKEY4 = rand(0,32768);
		$seer_ACTIVEKEY5 = rand(0,32768);
		$seer_ACTIVEKEY_PENDING = $seer_ACTIVEKEY0.$seer_ACTIVEKEY1.$seer_ACTIVEKEY2.$seer_ACTIVEKEY3.$seer_ACTIVEKEY4.$seer_ACTIVEKEY5;
		/* update the user access table, rollover access table ACTIVEKEY */
		$mysql_seer_access_query = "UPDATE access SET ACTIVEKEY='".$seer_ACTIVEKEY_PENDING."' WHERE USERNAME='".$seer_OFFEREDUSERNAME."'";
		mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);
		/* rollover S.E.E.R. webpage ACTIVEKEY */
		$seer_ACTIVEKEY = $seer_ACTIVEKEY_PENDING;
		$seer_REFERRINGPAGE_ADDKEYINFO = "?seer_USERNAME=".$seer_OFFEREDUSERNAME.";seer_LANGUAGE=".$seer_LANGUAGE.";seer_ACTIVEKEY=".$seer_ACTIVEKEY;
		$seer_REFERRINGPAGE = $seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO;
		/* update LASTACTIVITY filed in access table of seer db */
		$mysql_seer_access_query = "UPDATE access SET LASTLOGIN='".$apache_DEFAULTDATESTAMP."' WHERE USERNAME='".$seer_OFFEREDUSERNAME."'";
		mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);

		$apache_REPORT_RIGHTPANEL = "
									<P CLASS='INFOREPORT'>
										<B></I>".$multilang_STATIC_39."</I></B><BR>
										<BR>
										".$multilang_STATIC_41."<BR>
									</P>
									";
	} else {
		$apache_REPORT_RIGHTPANEL = "
									<P CLASS='INFOREPORT'>
										<B></I>".$multilang_STATIC_40."</I></B><BR>
										<BR>
										".$multilang_STATIC_42."<BR>
									</P>
									";
	}
} else {
	if ( $seer_USERACTIVE == "YES" ) {
		$apache_REPORT_RIGHTPANEL = "
									<P CLASS='INFOREPORT'>
										".$multilang_STATIC_43."<BR>
										<BR>
										".$multilang_STATIC_44."<BR>
										<BR>
										".$multilang_STATIC_45."<BR>
										<BR>
										".$mysql_seer_access_REALNAME."<BR>
										".$mysql_seer_access_COMPANY."<BR>
										".$mysql_seer_access_SITE."<BR>
										".$mysql_seer_access_DEPARTMENT."<BR>
										".$mysql_seer_access_PHONE."<BR>
									</P>
									";
	} else {
		$apache_REPORT_RIGHTPANEL = "
						<FORM ACTION='./seer_login.php' METHOD='post'>
							<TABLE ALIGN='LEFT' WIDTH='250' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD ALIGN='LEFT' VALIGN='middle' WIDTH='100'>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_46."
										</P>
									</TD>
									<TD ALIGN='LEFT' VALIGN='middle' WIDTH='150'>
										<INPUT TYPE='text' size='15' maxlength='30' name='seer_OFFEREDUSERNAME'>
									</TD>
								</TR>
								<TR>
									<TD ALIGN='LEFT' VALIGN='middle' WIDTH='100'>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_47.
										"</P>
									</TD>
									<TD ALIGN='LEFT' VALIGN='middle' WIDTH='150'>
										<INPUT TYPE='password' size='15' maxlength='30' name='seer_OFFEREDPASSWORD'>
									</TD>
								</TR>
								<TR>
									<TD>
										<INPUT TYPE='hidden' name='seer_PROCESSLOGIN' value='YES'>
										<INPUT TYPE='hidden' name='seer_LANGUAGE' value='".$seer_LANGUAGE."'>
									</TD>
									<TD ALIGN='CENTER'>
										<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2'>
										<P CLASS='INFOREPORT'>
											".$multilang_STATIC_48."
										</P>
									</TD>
								</TR>
							</TABLE>
						</FORM>
						<BR>
						";
	}	
}

$apache_REPORT = "
						<TABLE ALIGN='CENTER' WIDTH='630' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='380' ALIGN='CENTER' VALIGN='MIDDLE'>
									<IMG SRC='".$seer_DEFAULTHOMELOGO."' ALT='logo'>
								</TD>
								<TD WIDTH='250'>
									".$apache_REPORT_RIGHTPANEL."
								</TD>
							</TR>
						</TABLE>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
