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
MODIFY USER
-- VIEW AND EDIT A USER'S SETTINGS
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "./seer_setup_modifyuser.php";
/*	-- when we execute functions, send the user back here at end */

/* ACCEPT INPUT PASSED FROM REFERRING PAGE*/
/* ------------------------------------------------------------------ */
if ( $_GET[seer_USERTOMODIFY] != '' ) {
	$seer_USERTOMODIFY = $_GET['seer_USERTOMODIFY'];
	$seer_PROCESSSETTING = "YES";
} else {
	$seer_PROCESSSETTING = "NO";
}

/* LEARN EVERYTHING WE KNOW ABOUT THE USERTOMODIFY USER               */
/* ------------------------------------------------------------------ */
$mysql_seer_access_query = "SELECT * FROM access WHERE USERNAME LIKE '".$seer_USERTOMODIFY."'";
list($mysql_seer_access,$mysql_seer_access_row_count) = core_mysql_seer_query_shell($mysql_seer_access_query);

$mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_access);
$mysql_seer_access_WORKING_USERNAME = $mysql_seer_access_row['USERNAME'];
$mysql_seer_access_WORKING_REALNAME = $mysql_seer_access_row['REALNAME'];
$mysql_seer_access_WORKING_PASSWORD = $mysql_seer_access_row['PASSWORD'];
$mysql_seer_access_WORKING_PHONE = $mysql_seer_access_row['PHONE'];
$mysql_seer_access_WORKING_EMAIL = $mysql_seer_access_row['EMAIL'];
$mysql_seer_access_WORKING_COMPANY = $mysql_seer_access_row['COMPANY'];
$mysql_seer_access_WORKING_SITE = $mysql_seer_access_row['SITE'];
$mysql_seer_access_WORKING_DEPARTMENT = $mysql_seer_access_row['DEPARTMENT'];
$mysql_seer_access_WORKING_SUPERVISOR = $mysql_seer_access_row['SUPERVISOR'];
$mysql_seer_access_WORKING_SHIFT = $mysql_seer_access_row['SHIFT'];
$mysql_seer_access_WORKING_ACCESSGRANTED = $mysql_seer_access_row['ACCESSGRANTED'];
$mysql_seer_access_WORKING_ACCESSGRANTEDBY = $mysql_seer_access_row['ACCESSGRANTEDBY'];
$mysql_seer_access_WORKING_LASTMODIFIED = $mysql_seer_access_row['LASTMODIFIED'];
$mysql_seer_access_WORKING_LASTMODIFIEDBY = $mysql_seer_access_row['LASTMODIFIEDBY'];
$mysql_seer_access_WORKING_ACCESSLEVEL = $mysql_seer_access_row['ACCESSLEVEL'];
$mysql_seer_access_WORKING_ACCESSSTATE = $mysql_seer_access_row['ACCESSSTATE'];
if ( $mysql_seer_access_WORKING_ACCESSSTATE == "1" ) {
	$mysql_seer_access_WORKING_ACCESSSTATE_LITERAL = "ON";
} else {
	$mysql_seer_access_WORKING_ACCESSSTATE_LITERAL = "OFF";
}
$mysql_seer_access_WORKING_LASTLOGIN = $mysql_seer_access_row['LASTLOGIN'];
$mysql_seer_access_WORKING_LASTACTIVITY = $mysql_seer_access_row['LASTACTIVITY'];
$mysql_seer_access_WORKING_ACTIVEKEY = $mysql_seer_access_row['ACTIVEKEY'];

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_PROCESSSETTING_INTERNAL] != '' ) {
	$seer_PROCESSSETTING_INTERNAL = $_POST['seer_PROCESSSETTING_INTERNAL'];
	if ( $seer_PROCESSSETTING_INTERNAL == "YES" ) {
		$seer_PROCESSSETTING_INTERNAL5 = "YES";
		$seer_PROCESSSETTING_INTERNAL4 = "YES";
		$seer_PROCESSSETTING_INTERNAL3 = "YES";
		$seer_PROCESSSETTING_INTERNAL2 = "YES";
	} else {
		$seer_PROCESSSETTING_INTERNAL5 = "NO";
		$seer_PROCESSSETTING_INTERNAL4 = "NO";
		$seer_PROCESSSETTING_INTERNAL3 = "NO";
		$seer_PROCESSSETTING_INTERNAL2 = "NO";
	}
} else {
	$seer_PROCESSSETTING_INTERNAL = "NO";
	$seer_PROCESSSETTING_INTERNAL5 = "NO";
	$seer_PROCESSSETTING_INTERNAL4 = "NO";
	$seer_PROCESSSETTING_INTERNAL3 = "NO";
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_PASSWORD] != '' ) {
	$seer_OFFERED_WORKING_PASSWORD = $_POST['seer_OFFERED_WORKING_PASSWORD'];
} else {
	$seer_PROCESSSETTING_INTERNAL5 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_PHONE] != '' ) {
	$seer_OFFERED_WORKING_PHONE = $_POST['seer_OFFERED_WORKING_PHONE'];
} else {
	$seer_PROCESSSETTING_INTERNAL5 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_EMAIL] != '' ) {
	$seer_OFFERED_WORKING_EMAIL = $_POST['seer_OFFERED_WORKING_EMAIL'];
} else {
	$seer_PROCESSSETTING_INTERNAL5 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_ACCESSSTATE_LITERAL] != '' ) {
	$seer_OFFERED_WORKING_ACCESSSTATE_LITERAL = $_POST['seer_OFFERED_WORKING_ACCESSSTATE_LITERAL'];
	if ( $seer_OFFERED_WORKING_ACCESSSTATE_LITERAL == "ON" ) {
		$seer_OFFERED_WORKING_ACCESSSTATE = 1;
	} else {
		$seer_OFFERED_WORKING_ACCESSSTATE = 0;
	}
} else {
	$seer_PROCESSSETTING_INTERNAL5 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_SHIFT] != '' ) {
	$seer_OFFERED_WORKING_SHIFT = $_POST['seer_OFFERED_WORKING_SHIFT'];
} else {
	$seer_PROCESSSETTING_INTERNAL4 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_SUPERVISOR] != '' ) {
	$seer_OFFERED_WORKING_SUPERVISOR = $_POST['seer_OFFERED_WORKING_SUPERVISOR'];
} else {
	$seer_PROCESSSETTING_INTERNAL3 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_ACCESSLEVEL] != '' ) {
	$seer_OFFERED_WORKING_ACCESSLEVEL = $_POST['seer_OFFERED_WORKING_ACCESSLEVEL'];
} else {
	$seer_PROCESSSETTING_INTERNAL3 = "NO";
}
if ( $_POST[mysql_transitional_key_WORKING_USERNAME] != '' ) {
	$mysql_transitional_key_WORKING_USERNAME = $_POST['mysql_transitional_key_WORKING_USERNAME'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_USERNAME] != '' ) {
	$seer_OFFERED_WORKING_USERNAME = $_POST['seer_OFFERED_WORKING_USERNAME'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_REALNAME] != '' ) {
	$seer_OFFERED_WORKING_REALNAME = $_POST['seer_OFFERED_WORKING_REALNAME'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_COMPANY] != '' ) {
	$seer_OFFERED_WORKING_COMPANY = $_POST['seer_OFFERED_WORKING_COMPANY'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_SITE] != '' ) {
	$seer_OFFERED_WORKING_SITE = $_POST['seer_OFFERED_WORKING_SITE'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_DEPARTMENT] != '' ) {
	$seer_OFFERED_WORKING_DEPARTMENT = $_POST['seer_OFFERED_WORKING_DEPARTMENT'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}

/* DECIDE IF WE EVEN DISPLAY THIS PAGE AND IF SO, WHAT 		    */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$seer_PROCESSSETTING = "NO";
	$SEER_PROCESSSETTING_INTERNAL = "NO";
	$seer_PROCESSSETTING_INTERNAL5 = "NO";
	$seer_PROCESSSETTING_INTERNAL4 = "NO";
	$seer_PROCESSSETTING_INTERNAL3 = "NO";
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
	$apache_ERRORFEEDBACK = "
							<P CLASS='INFOREPORT'>
								".$multilang_FAULT_34."<BR>
								<BR>
							</P>
							";
} else {
	if ( $mysql_seer_access_ACCESSLEVEL > $mysql_seer_access_WORKING_ACCESSLEVEL ) {
		$seer_PROCESSSETTING = "NO";
		$SEER_PROCESSSETTING_INTERNAL = "NO";
		$seer_PROCESSSETTING_INTERNAL5 = "NO";
		$seer_PROCESSSETTING_INTERNAL4 = "NO";
		$seer_PROCESSSETTING_INTERNAL3 = "NO";
		$seer_PROCESSSETTING_INTERNAL2 = "NO";
		$apache_ERRORFEEDBACK = "
							<P CLASS='INFOREPORT'>
								".$multilang_STATIC_109."<BR>
								<BR>
							</P>
							";
	} else {
		/* continue */
	}
}

if ( $seer_PROCESSSETTING == "YES" ) {
	$seer_PROCESSSETTING_FINAL = "YES";
} else {
	if ( $seer_PROCESSSETTING_INTERNAL == "YES" ) {
		$seer_PROCESSSETTING_FINAL = "YES";
	} else {
		$seer_PROCESSSETTING_FINAL = "NO";
	}
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_122."</B>
							<BR>
							<A HREF='./seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
						</P>
						";

/* PERMISSION BASED INPUT FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_seer_access_ACCESSLEVEL < 6 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING_INTERNAL5 == "YES" ) {
		$mysql_seer_access_query = "UPDATE access SET PASSWORD='".$seer_OFFERED_WORKING_PASSWORD."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET PHONE='".$seer_OFFERED_WORKING_PHONE."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET EMAIL='".$seer_OFFERED_WORKING_EMAIL."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET ACCESSSTATE='".$seer_OFFERED_WORKING_ACCESSSTATE."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET LASTMODIFIED='".$apache_DEFAULTDATESTAMP."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET LASTMODIFIEDBY='".$mysql_seer_access_USERNAME."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
	} else {
		/* no action */
	}

} else {
		/* no action */
}
if ( $mysql_seer_access_ACCESSLEVEL < 5 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING_INTERNAL4 == "YES" ) {
		$mysql_seer_access_query = "UPDATE access SET SHIFT='".$seer_OFFERED_WORKING_SHIFT."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
	} else {
		/* no action */
	}

} else {
		/* no action */
}
if ( $mysql_seer_access_ACCESSLEVEL < 4 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING_INTERNAL3 == "YES" ) {
		$mysql_seer_access_query = "UPDATE access SET SUPERVISOR='".$seer_OFFERED_WORKING_SUPERVISOR."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET ACCESSLEVEL='".$seer_OFFERED_WORKING_ACCESSLEVEL."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
	} else {
		/* no action */
	}

} else {
		/* no action */
}
if ( $mysql_seer_access_ACCESSLEVEL < 3 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING_INTERNAL2 == "YES" ) {
		$mysql_seer_access_query = "UPDATE access SET REALNAME='".$seer_OFFERED_WORKING_REALNAME."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET COMPANY='".$seer_OFFERED_WORKING_COMPANY."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET SITE='".$seer_OFFERED_WORKING_SITE."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET DEPARTMENT='".$seer_OFFERED_WORKING_DEPARTMENT."' WHERE USERNAME='".$seer_OFFERED_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$mysql_seer_access_query = "UPDATE access SET USERNAME='".$seer_OFFERED_WORKING_USERNAME."' WHERE USERNAME='".$mysql_transitional_key_WORKING_USERNAME."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
		$seer_USERTOMODIFY = $seer_OFFERED_WORKING_USERNAME;
		$mysql_transitional_key_WORKING_USERNAME = $seer_OFFERED_WORKING_USERNAME;
	} else {
		/* no action */
	}

} else {
		/* no action */
}

/* RE-LEARN EVERYTHING WE KNOW ABOUT THE USERTOMODIFY USER               */
/* ------------------------------------------------------------------ */
$mysql_seer_access_query = "SELECT * FROM access WHERE USERNAME LIKE '".$seer_USERTOMODIFY."'";
list($mysql_seer_access,$mysql_seer_access_row_count) = core_mysql_seer_query_shell($mysql_seer_access_query);

$mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_access);
$mysql_seer_access_WORKING_USERNAME = $mysql_seer_access_row['USERNAME'];
$mysql_seer_access_WORKING_REALNAME = $mysql_seer_access_row['REALNAME'];
$mysql_seer_access_WORKING_PASSWORD = $mysql_seer_access_row['PASSWORD'];
$mysql_seer_access_WORKING_PHONE = $mysql_seer_access_row['PHONE'];
$mysql_seer_access_WORKING_EMAIL = $mysql_seer_access_row['EMAIL'];
$mysql_seer_access_WORKING_COMPANY = $mysql_seer_access_row['COMPANY'];
$mysql_seer_access_WORKING_SITE = $mysql_seer_access_row['SITE'];
$mysql_seer_access_WORKING_DEPARTMENT = $mysql_seer_access_row['DEPARTMENT'];
$mysql_seer_access_WORKING_SUPERVISOR = $mysql_seer_access_row['SUPERVISOR'];
$mysql_seer_access_WORKING_SHIFT = $mysql_seer_access_row['SHIFT'];
$mysql_seer_access_WORKING_ACCESSGRANTED = $mysql_seer_access_row['ACCESSGRANTED'];
$mysql_seer_access_WORKING_ACCESSGRANTEDBY = $mysql_seer_access_row['ACCESSGRANTEDBY'];
$mysql_seer_access_WORKING_LASTMODIFIED = $mysql_seer_access_row['LASTMODIFIED'];
$mysql_seer_access_WORKING_LASTMODIFIEDBY = $mysql_seer_access_row['LASTMODIFIEDBY'];
$mysql_seer_access_WORKING_ACCESSLEVEL = $mysql_seer_access_row['ACCESSLEVEL'];
$mysql_seer_access_WORKING_ACCESSSTATE = $mysql_seer_access_row['ACCESSSTATE'];
if ( $mysql_seer_access_WORKING_ACCESSSTATE == "1" ) {
	$mysql_seer_access_WORKING_ACCESSSTATE_LITERAL = "ON";
} else {
	$mysql_seer_access_WORKING_ACCESSSTATE_LITERAL = "OFF";
}
$mysql_seer_access_WORKING_LASTLOGIN = $mysql_seer_access_row['LASTLOGIN'];
$mysql_seer_access_WORKING_LASTACTIVITY = $mysql_seer_access_row['LASTACTIVITY'];
$mysql_seer_access_WORKING_ACTIVEKEY = $mysql_seer_access_row['ACTIVEKEY'];

/* PERMISSION BASED INPUT FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_seer_access_ACCESSLEVEL < 6 ) {
	$apache_input_field_USERNAME = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_USERNAME' value='".$mysql_seer_access_WORKING_USERNAME."'>";
	$apache_input_field_PASSWORD = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_PASSWORD' value='".$mysql_seer_access_WORKING_PASSWORD."'>";
	$apache_input_field_PHONE = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_PHONE' value='".$mysql_seer_access_WORKING_PHONE."'>";
	$apache_input_field_EMAIL = "<INPUT TYPE='text' size='50' maxlength='60' name='seer_OFFERED_WORKING_EMAIL' value='".$mysql_seer_access_WORKING_EMAIL."'>";
	$apache_input_field_ACCESSSTATE_LITERAL = "<INPUT TYPE='text' size='50' maxlength='3' name='seer_OFFERED_WORKING_ACCESSSTATE_LITERAL' value='".$mysql_seer_access_WORKING_ACCESSSTATE_LITERAL."'>";
} else {
	$apache_input_field_USERNAME = "";
	$apache_input_field_PASSWORD = "";
	$apache_input_field_PHONE = "";
	$apache_input_field_EMAIL = "";
	$apache_input_field_ACCESSSTATE_LITERAL = "";
}
if ( $mysql_seer_access_ACCESSLEVEL < 5 ) {
	$apache_input_field_SHIFT = "<INPUT TYPE='text' size='50' maxlength='11' name='seer_OFFERED_WORKING_SHIFT' value='".$mysql_seer_access_WORKING_SHIFT."'>";
} else {
	$apache_input_field_SHIFT = "";
}
if ( $mysql_seer_access_ACCESSLEVEL < 4 ) {
	$apache_input_field_SUPERVISOR = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_SUPERVISOR' value='".$mysql_seer_access_WORKING_SUPERVISOR."'>";
	$apache_input_field_ACCESSLEVEL = "<INPUT TYPE='text' size='50' maxlength='11' name='seer_OFFERED_WORKING_ACCESSLEVEL' value='".$mysql_seer_access_WORKING_ACCESSLEVEL."'>";
} else {
	$apache_input_field_SUPERVISOR = "";
	$apache_input_field_ACCESSLEVEL = "";
}
if ( $mysql_seer_access_ACCESSLEVEL < 3 ) {
	$apache_input_field_REALNAME = "<INPUT TYPE='text' size='50' maxlength='60' name='seer_OFFERED_WORKING_REALNAME' value='".$mysql_seer_access_WORKING_REALNAME."'>";
	$apache_input_field_COMPANY = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_COMPANY' value='".$mysql_seer_access_WORKING_COMPANY."'>";
	$apache_input_field_SITE = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_SITE' value='".$mysql_seer_access_WORKING_SITE."'>";
	$apache_input_field_DEPARTMENT = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_OFFERED_WORKING_DEPARTMENT' value='".$mysql_seer_access_WORKING_DEPARTMENT."'>";
} else {
	$apache_input_field_REALNAME = "";
	$apache_input_field_COMPANY = "";
	$apache_input_field_SITE = "";
	$apache_input_field_DEPARTMENT = "";
}

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSSETTING_FINAL == "YES" ) {
	$apache_REPORT = "
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO.";seer_USERTOMODIFY=".$seer_USERTOMODIFY."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_USERNAME."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_USERNAME."
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
											".$mysql_seer_access_WORKING_REALNAME."
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
											".$mysql_seer_access_WORKING_PASSWORD."
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
											".$mysql_seer_access_WORKING_PHONE."
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
											".$mysql_seer_access_WORKING_EMAIL."
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
											".$mysql_seer_access_WORKING_COMPANY."
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
											".$mysql_seer_access_WORKING_SITE."
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
											".$mysql_seer_access_WORKING_DEPARTMENT."
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
											".$mysql_seer_access_WORKING_SUPERVISOR."
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
											".$mysql_seer_access_WORKING_SHIFT."
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_SHIFT."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_ACCESS_GRANTED."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_ACCESSGRANTED."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_ACCESS_GRANTED_BY."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_ACCESSGRANTEDBY."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_LAST_MODIFIED."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_LASTMODIFIED."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_LAST_MODIFIED_BY."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_LASTMODIFIEDBY."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_ACCESS_LEVEL."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_ACCESSLEVEL."
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
											".$mysql_seer_access_WORKING_ACCESSSTATE_LITERAL."
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_ACCESSSTATE_LITERAL."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_LAST_LOGIN."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_LASTLOGIN."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_LAST_ACTIVITY."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_LASTACTIVITY."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_SETTINGS_HASH_KEY."
										</TD>
										<TD WIDTH='300'>
											".$mysql_seer_access_WORKING_ACTIVEKEY."
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD ALIGN='RIGHT' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_PROCESSSETTING_INTERNAL' value='YES'>
											<INPUT TYPE='hidden' name='mysql_transitional_key_WORKING_USERNAME' value='".$mysql_seer_access_WORKING_USERNAME."'>
											".$multilang_SETTINGS_COMMIT_USER_CHANGES.": 
										</TD>
										<TD VALIGN='MIDDLE' WIDTH='300'>
											<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
										</TD>
									</TR>
								</TABLE>
							</FORM>
							";
} else {
	$apache_REPORT = "
							<P CLASS='INFOREPORT'>
								<B><U>".$multilang_FAULT_12."</B></U><BR>
								<BR>
							</P>
							".$apache_ERRORFEEDBACK;
	$apache_REPORT = core_fault_page_body($apache_REPORT);
}

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
$MODEL_USERREPORT_ENABLE = "YES";
include('./include/seer_echo_to_html.php');

?>
