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
WARRIOR MODIFY JOB
-- VIEW AND EDIT A JOB's INFO
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
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/include/core_models/WARRIOR_setup_modifyjobdescription.php";
/*	-- when we execute functions, send the user back here at end */

/* ACCEPT INPUT PASSED FROM REFERRING PAGE*/
/* ------------------------------------------------------------------ */
if ( $_POST[seer_USERTOMODIFY] != '' ) {
	$seer_USERTOMODIFY = $_POST['seer_USERTOMODIFY'];
	$seer_PROCESSSETTING = "YES";
} else {
	$seer_PROCESSSETTING = "NO";
}

/* LEARN EVERYTHING WE KNOW ABOUT THE USERTOMODIFY USER               */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." WHERE JOB_NUMBER LIKE '".$seer_USERTOMODIFY."'";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

$mysql_mod_openopc_query_result_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result);
$mysql_mod_openopc_WORKING_USERNAME = $mysql_mod_openopc_query_result_row['JOB_NUMBER'];
$mysql_mod_openopc_WORKING_REALNAME = $mysql_mod_openopc_query_result_row['JOB_DESCRIPTION'];

/* ACCEPT FORM PROCESSING ARGUMENTS */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_PROCESSSETTING_INTERNAL] != '' ) {
	$seer_PROCESSSETTING_INTERNAL = $_POST['seer_PROCESSSETTING_INTERNAL'];
	if ( $seer_PROCESSSETTING_INTERNAL == "YES" ) {
		$seer_PROCESSSETTING_INTERNAL2 = "YES";
	} else {
		$seer_PROCESSSETTING_INTERNAL2 = "NO";
	}
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_USERNAME] != '' ) {
	$seer_OFFERED_WORKING_USERNAME = $_POST['seer_OFFERED_WORKING_USERNAME'];
	/* CHECK FOR EXISTING JOB WITH SAME NUMBER -- MUST BE UNIQUE! */
	/* ---------------------------------------------------------- */
	if ($seer_USERTOMODIFY != $seer_OFFERED_WORKING_USERNAME) {
		$mysql_mod_openopc_query = "SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." WHERE JOB_NUMBER LIKE '".$seer_OFFERED_WORKING_USERNAME."'";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_query_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		if ($mysql_mod_openopc_query_result_count > 0) {
			$seer_PROCESSSETTING_INTERNAL = "NO";
			$seer_PROCESSSETTING_INTERNAL2 = "NO";
		} else {
			/* pass */
		}
	} else {
		/* pass */
	}
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_REALNAME] != '' ) {
	$seer_OFFERED_WORKING_REALNAME = $_POST['seer_OFFERED_WORKING_REALNAME'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}


/* DECIDE IF WE EVEN DISPLAY THIS PAGE AND IF SO, WHAT 		      */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$seer_PROCESSSETTING = "NO";
	$SEER_PROCESSSETTING_INTERNAL = "NO";
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
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
								<IMG SRC='/".$apache_seer_VERSION."/img/warrior_menu_0.png' BORDER='0' ALT='WARRIOR'><BR>
								<BR>
								<B>".$multilang_WARRIOR_14."</B>
								<BR>
								<A HREF='/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* PERMISSION BASED INPUT FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_mod_openopc_access_ACCESSLEVEL < 4 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING_INTERNAL2 == "YES" ) {
		$mysql_mod_openopc_query = "UPDATE ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." SET JOB_NUMBER='".$seer_OFFERED_WORKING_USERNAME."' WHERE JOB_NUMBER='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		$seer_USERTOMODIFY = $seer_OFFERED_WORKING_USERNAME;
		$mysql_mod_openopc_query = "UPDATE ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." SET JOB_DESCRIPTION='".$seer_OFFERED_WORKING_REALNAME."' WHERE JOB_NUMBER='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	} else {
		/* no action */
	}

} else {
		/* no action */
}

/* RE-LEARN EVERYTHING WE KNOW ABOUT THE USERTOMODIFY USER               */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "SELECT * FROM ".$WARRIOR_mysql_mod_openopc_TABLENAME_JOB." WHERE JOB_NUMBER LIKE '".$seer_USERTOMODIFY."'";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

$mysql_mod_openopc_query_result_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result);
$mysql_mod_openopc_WORKING_USERNAME = $mysql_mod_openopc_query_result_row['JOB_NUMBER'];
$mysql_mod_openopc_WORKING_REALNAME = $mysql_mod_openopc_query_result_row['JOB_DESCRIPTION'];

/* PERMISSION BASED INPUT FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_mod_openopc_access_ACCESSLEVEL < 4 ) {
	$apache_input_field_USERNAME = "<INPUT TYPE='text' size='50' maxlength='35' name='seer_OFFERED_WORKING_USERNAME' value='".$mysql_mod_openopc_WORKING_USERNAME."'>";
	$apache_input_field_REALNAME = "<INPUT TYPE='text' size='50' maxlength='35' name='seer_OFFERED_WORKING_REALNAME' value='".$mysql_mod_openopc_WORKING_REALNAME."'>";
} else {
	$apache_input_field_USERNAME = "";
	$apache_input_field_REALNAME = "";
}

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSSETTING_FINAL == "YES" ) {
	$apache_REPORT = "
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='750'>
									<TR>
										<TD WIDTH='150'>
											".$multilang_WARRIOR_4."
										</TD>
										<TD WIDTH='300'>
											".$mysql_mod_openopc_WORKING_USERNAME."
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
											".$mysql_mod_openopc_WORKING_REALNAME."
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_REALNAME."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD ALIGN='RIGHT' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_PROCESSSETTING_INTERNAL' value='YES'>
											".$multilang_WARRIOR_15.": 
										</TD>
										<TD VALIGN='MIDDLE' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_USERTOMODIFY' value='".$seer_USERTOMODIFY."'>
											<INPUT TYPE='image' name='enter' src='/".$apache_seer_VERSION."/img/form_submit_0.png'>
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
