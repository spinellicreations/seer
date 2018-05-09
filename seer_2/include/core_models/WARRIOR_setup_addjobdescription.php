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
ADD JOB DESCRIPTION
-- ADD JOB DESCRIPTION TO THE WARRIOR MODULE
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('../../config/globaloptions_seer_0.php');
include('../../config/WARRIOR/globaloptions_WARRIOR_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/include/core_models/WARRIOR_setup_addjobdescription.php";
/*	-- when we execute functions, send the user back here at end */

/* ACCEPT INPUT PASSED FROM REFERRING PAGE */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_USERTOADD] != '' ) {
	$seer_USERTOADD = $_POST['seer_USERTOADD'];
	$seer_PROCESSUSER_ADD = "YES";
} else {
	$seer_PROCESSUSER_ADD = "NO";
}

/* CHECK FOR AN EXISTING USER BY THAT NAME */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." WHERE JOB_NUMBER LIKE '".$seer_USERTOADD."'";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

$mysql_mod_openopc_result_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result);
$mysql_mod_openopc_access_WORKING_USERNAME = $mysql_mod_openopc_result_row['JOB_NUMBER'];

if ( $seer_PROCESSUSER_ADD == "YES" ) {
	if ( $mysql_mod_openopc_access_WORKING_USERNAME == $seer_USERTOADD ) {
		$seer_PROCESSUSER_ADD = "FAULT";
		$seer_PROCESSUSER_ADD_FAULT = "<P CLASS='INFOREPORT'>".$multilang_WARRIOR_9."<BR>
							<BR>
							".$multilang_STATIC_102." <A HREF='/".$apache_seer_VERSION."/include/core_models/WARRIOR_setup_addjobdescription.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>";
	} else {
		/* continue */
	}
} else {
	/* continue */
}

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSUSER_ADD == "YES" ) {
	$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_WARRIOR_10."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='/".$apache_seer_VERSION."/include/core_models/WARRIOR_setup_addjobdescription.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>
							";
	$seer_OFFERED_WORKING_USERNAME = $seer_USERTOADD;
	if ( $_POST[seer_OFFERED_WORKING_REALNAME] != '' ) {
		$seer_OFFERED_WORKING_REALNAME = $_POST['seer_OFFERED_WORKING_REALNAME'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
} else {
	/* continue */
}
	
/* DECIDE IF WE EVEN DISPLAY THIS PAGE AND IF SO, WHAT 		    */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$seer_PROCESSUSER_ADD = "FAULT";
	$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_34."<BR>
								<BR>
							</P>
							";
} else {
	if ( $mysql_mod_openopc_access_ACCESSLEVEL > 3 ) {
	$seer_PROCESSUSER_ADD = "FAULT";
	$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_1."<BR>
								<BR>
								".$multilang_WARRIOR_11."<BR>
								<BR>
							</P>
							";
	} else {
		/* continue */
	}
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<IMG SRC='/".$apache_seer_VERSION."/img/warrior_menu_0.png' BORDER='0' ALT='WARRIOR'><BR>
								<BR>
								<B>".$multilang_WARRIOR_3."</B>
								<BR>
								<A HREF='/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* INPUT FIELDS */
/* ------------------------------------------------------------------ */

$apache_input_field_USERNAME = "<INPUT TYPE='text' size='50' maxlength='35' name='seer_USERTOADD'>";
$apache_input_field_REALNAME = "<INPUT TYPE='text' size='50' maxlength='35' name='seer_OFFERED_WORKING_REALNAME'>";

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSUSER_ADD == "NO" ) {
	$apache_REPORT = "
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO.";seer_USERTOMODIFY=".$seer_USERTOMODIFY."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='750'>
									<TR>
										<TD WIDTH='150'>
											".$multilang_WARRIOR_4."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_WARRIOR_5."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_USERNAME."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_WARRIOR_6."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_WARRIOR_7."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_REALNAME."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD ALIGN='RIGHT' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_PROCESSUSER_ADD' value='YES'>
											".$multilang_WARRIOR_8.": 
										</TD>
										<TD VALIGN='MIDDLE' WIDTH='300'>
											<INPUT TYPE='image' name='enter' src='/".$apache_seer_VERSION."/img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
} else {
	if ( $seer_PROCESSUSER_ADD == "FAULT" ) {
		$apache_REPORT = $seer_PROCESSUSER_ADD_FAULT;
	} else {
		if ( $seer_PROCESSUSER_ADD == "YES" ) {
			/* add the user */
			$mysql_mod_openopc_query = "INSERT INTO ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." VALUES('".$seer_USERTOADD."', '', '".$seer_OFFERED_WORKING_REALNAME."')";
			core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* display a report of what was done */
			$apache_REPORT = "
							<P CLASS='INFOREPORT'>".$seer_USERTOADD." ".$multilang_WARRIOR_12."<BR>
								<BR>
								".$multilang_WARRIOR_13." <A HREF='/".$apache_seer_VERSION."/include/core_models/WARRIOR_setup_addjobdescription.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
								<BR>
							</P>
							";
		} else {
			$apache_REPORT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_35."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='/".$apache_seer_VERSION."/include/core_models/WARRIOR_setup_addjobdescription.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>
							";
		}
	}
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
