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
ADD USERS
-- ADD A SYSTEM USER
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "./seer_setup_addusers.php";
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
$mysql_seer_access_query = "SELECT * FROM access WHERE USERNAME LIKE '".$seer_USERTOADD."'";
list($mysql_seer_access,$mysql_seer_access_row_count) = core_mysql_seer_query_shell($mysql_seer_access_query);

$mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_access);
$mysql_seer_access_WORKING_USERNAME = $mysql_seer_access_row['USERNAME'];

if ( $seer_PROCESSUSER_ADD == "YES" ) {
	if ( $mysql_seer_access_WORKING_USERNAME == $seer_USERTOADD ) {
		$seer_PROCESSUSER_ADD = "FAULT";
		$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_32."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='./seer_setup_addusers.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>
							";
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
							<P CLASS='INFOREPORT'>".$multilang_FAULT_33."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='./seer_setup_addusers.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>
							";
	if ( $_POST[seer_OFFERED_WORKING_PASSWORD] != '' ) {
		$seer_OFFERED_WORKING_PASSWORD = $_POST['seer_OFFERED_WORKING_PASSWORD'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_PHONE] != '' ) {
		$seer_OFFERED_WORKING_PHONE = $_POST['seer_OFFERED_WORKING_PHONE'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_EMAIL] != '' ) {
		$seer_OFFERED_WORKING_EMAIL = $_POST['seer_OFFERED_WORKING_EMAIL'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_ACCESSSTATE_LITERAL] != '' ) {
		$seer_OFFERED_WORKING_ACCESSSTATE_LITERAL = $_POST['seer_OFFERED_WORKING_ACCESSSTATE_LITERAL'];
		if ( $seer_OFFERED_WORKING_ACCESSSTATE_LITERAL == "ON" ) {
			$seer_OFFERED_WORKING_ACCESSSTATE = 1;
		} else {
			$seer_OFFERED_WORKING_ACCESSSTATE = 0;
		}
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_SHIFT] != '' ) {
		$seer_OFFERED_WORKING_SHIFT = $_POST['seer_OFFERED_WORKING_SHIFT'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_SUPERVISOR] != '' ) {
		$seer_OFFERED_WORKING_SUPERVISOR = $_POST['seer_OFFERED_WORKING_SUPERVISOR'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_ACCESSLEVEL] != '' ) {
		$seer_OFFERED_WORKING_ACCESSLEVEL = $_POST['seer_OFFERED_WORKING_ACCESSLEVEL'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	$seer_OFFERED_WORKING_USERNAME = $seer_USERTOADD;
	if ( $_POST[seer_OFFERED_WORKING_REALNAME] != '' ) {
		$seer_OFFERED_WORKING_REALNAME = $_POST['seer_OFFERED_WORKING_REALNAME'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_COMPANY] != '' ) {
		$seer_OFFERED_WORKING_COMPANY = $_POST['seer_OFFERED_WORKING_COMPANY'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_SITE] != '' ) {
		$seer_OFFERED_WORKING_SITE = $_POST['seer_OFFERED_WORKING_SITE'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_DEPARTMENT] != '' ) {
		$seer_OFFERED_WORKING_DEPARTMENT = $_POST['seer_OFFERED_WORKING_DEPARTMENT'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
} else {
	/* continue */
}
	
/* DECIDE IF WE EVEN DISPLAY THIS PAGE AND IF SO, WHAT 		    */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_103."</B>
							<BR>
							<A HREF='./seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
						</P>
						";

/* INPUT FIELDS */
/* ------------------------------------------------------------------ */

$apache_input_field_USERNAME = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_USERTOADD'>";
$apache_input_field_PASSWORD = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_PASSWORD'>";
$apache_input_field_PHONE = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_PHONE'>";
$apache_input_field_EMAIL = "<INPUT TYPE='text' size='50' maxlength='60' name='seer_OFFERED_WORKING_EMAIL'>";
$apache_input_field_ACCESSSTATE_LITERAL = "<INPUT TYPE='text' size='50' maxlength='3' name='seer_OFFERED_WORKING_ACCESSSTATE_LITERAL'  VALUE='ON'>";
$apache_input_field_SHIFT = "<INPUT TYPE='text' size='50' maxlength='11' name='seer_OFFERED_WORKING_SHIFT'>";
$apache_input_field_SUPERVISOR = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_SUPERVISOR'>";
$apache_input_field_ACCESSLEVEL = "<INPUT TYPE='text' size='50' maxlength='11' name='seer_OFFERED_WORKING_ACCESSLEVEL'>";
$apache_input_field_REALNAME = "<INPUT TYPE='text' size='50' maxlength='60' name='seer_OFFERED_WORKING_REALNAME'>";
$apache_input_field_COMPANY = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_COMPANY'  VALUE='".$seer_DEFAULT_COMPANY_ID."'>";
$apache_input_field_SITE = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_SITE'  VALUE='".$seer_DEFAULT_SITE_ID."'>";
$apache_input_field_DEPARTMENT = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_DEPARTMENT'>";

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSUSER_ADD == "NO" ) {
	$apache_REPORT = "
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO.";seer_USERTOMODIFY=".$seer_USERTOMODIFY."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_USERNAME."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_USERNAME_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_USERNAME."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_REALNAME."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_REALNAME_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_REALNAME."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_PASSWORD."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_PASSWORD_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_PASSWORD."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_PHONE."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_PHONE_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_PHONE."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_EMAIL."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_EMAIL_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_EMAIL."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_COMPANY."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_COMPANY_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_COMPANY."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_SITE."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_SITE_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_SITE."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_DEPARTMENT."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_DEPARTMENT_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_DEPARTMENT."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_SUPERVISOR."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_SUPERVISOR_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_SUPERVISOR."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_SHIFT."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_SHIFT_D." (1-3)]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_SHIFT."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_ACCESS_LEVEL."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_ACCESS_LEVEL_D."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_ACCESSLEVEL."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_ACCESS_STATE."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_SETTINGS_ACCESS_STATE_D." (ON / OFF)]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_ACCESSSTATE_LITERAL."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD ALIGN='RIGHT' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_PROCESSUSER_ADD' value='YES'>
											".$multilang_SETTINGS_COMMIT_USER_ADD.": 
										</TD>
										<TD VALIGN='MIDDLE' WIDTH='300'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
} else {
	if ( $seer_PROCESSUSER_ADD == "FAULT" ) {
		$apache_REPORT = $seer_PROCESSUSER_ADD_FAULT;
		$apache_REPORT = core_fault_page_body($apache_REPORT);
	} else {
		if ( $seer_PROCESSUSER_ADD == "YES" ) {
			/* add the user */

			$mysql_seer_query = "INSERT INTO access VALUES('".$seer_USERTOADD."', '0', '".$seer_OFFERED_WORKING_PASSWORD."', '".$seer_OFFERED_WORKING_REALNAME."', '".$seer_OFFERED_WORKING_PHONE."', '".$seer_OFFERED_WORKING_EMAIL."', '".$seer_OFFERED_WORKING_COMPANY."', '".$seer_OFFERED_WORKING_SITE."', '".$seer_OFFERED_WORKING_DEPARTMENT."', '".$seer_OFFERED_WORKING_SUPERVISOR."', '".$seer_OFFERED_WORKING_SHIFT."', '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', 'NEVER', 'NONE', '".$seer_OFFERED_WORKING_ACCESSLEVEL."', '".$seer_OFFERED_WORKING_ACCESSSTATE."', 'NEVER', 'NEVER', '8675309')";
			core_mysql_seer_query_shell($mysql_seer_query);

			/* display a report of what was done */
			$apache_REPORT = "
							<P CLASS='INFOREPORT'>".$seer_USERTOADD." ".$multilang_STATIC_105."<BR>
								<BR>
								".$multilang_STATIC_104." <A HREF='./seer_setup_addusers.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
								<BR>
							</P>
							";
			$apache_REPORT = core_fault_page_body($apache_REPORT);
		} else {
			$apache_REPORT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_35."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='./seer_setup_addusers.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>
							";
			$apache_REPORT = core_fault_page_body($apache_REPORT);
		}
	}
}

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
$MODEL_USERREPORT_ENABLE = "YES";
include('./include/seer_echo_to_html.php');

?>
