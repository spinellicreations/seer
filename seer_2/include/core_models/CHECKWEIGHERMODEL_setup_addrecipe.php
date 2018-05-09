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
CHECKWEIGHER MODEL ADD RECIPE
-- ADD RECIPE
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('../../config/globaloptions_seer_0.php');
include('../../config/CHECKWEIGHERMODEL/globaloptions_CHECKWEIGHERMODEL_0.php');

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/include/core_models/CHECKWEIGHERMODEL_setup_addrecipe.php";
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
$mysql_mod_openopc_query = "SELECT * FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE LIKE '".$seer_USERTOADD."'";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
$mysql_mod_openopc_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result);

$mysql_mod_openopc_access_WORKING_USERNAME = $mysql_mod_openopc_row['RECIPE'];

if ( $seer_PROCESSUSER_ADD == "YES" ) {
	if ( $mysql_mod_openopc_access_WORKING_USERNAME == $seer_USERTOADD ) {
		$seer_PROCESSUSER_ADD = "FAULT";
		$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_CHECKWEIGHERMODEL_6."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
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
							<P CLASS='INFOREPORT'>".$multilang_CHECKWEIGHERMODEL_7."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
							</P>
							";
	$seer_OFFERED_WORKING_USERNAME = $seer_USERTOADD;
	if ( $_POST[seer_OFFERED_WORKING_TARGET] != '' ) {
		$seer_OFFERED_WORKING_TARGET = $_POST['seer_OFFERED_WORKING_TARGET'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_DELTA_MIN] != '' ) {
		$seer_OFFERED_WORKING_DELTA_MIN = $_POST['seer_OFFERED_WORKING_DELTA_MIN'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_DELTA_MAX] != '' ) {
		$seer_OFFERED_WORKING_DELTA_MAX = $_POST['seer_OFFERED_WORKING_DELTA_MAX'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
	if ( $_POST[seer_OFFERED_WORKING_TARE] != '' ) {
		$seer_OFFERED_WORKING_TARE = $_POST['seer_OFFERED_WORKING_TARE'];
	} else {
		$seer_PROCESSUSER_ADD = "FAULT";
	}
} else {
	/* continue */
}
	
/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CHECKWEIGHERMODEL_0."</B><BR>
								<BR>
								<B>".$multilang_CHECKWEIGHERMODEL_9."</B>
								<BR>
								<A HREF='/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* INPUT FIELDS */
/* ------------------------------------------------------------------ */

$apache_input_field_USERNAME = "<INPUT TYPE='text' size='50' maxlength='30' name='seer_USERTOADD'>";
$apache_input_field_TARGET = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_TARGET'>";
$apache_input_field_DELTA_MIN = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_DELTA_MIN'>";
$apache_input_field_DELTA_MAX = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_DELTA_MAX'>";
$apache_input_field_TARE = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_TARE'>";

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSUSER_ADD == "NO" ) {
	$apache_REPORT = "
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO.";seer_USERTOMODIFY=".$seer_USERTOMODIFY."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='750' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD WIDTH='300'>
										</TD>
										<TD WIDTH='300'>
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_CHECKWEIGHERMODEL_10."
										</TD>
										<TD>
											[".$multilang_CHECKWEIGHERMODEL_11."]
										</TD>
										<TD>
											".$apache_input_field_USERNAME."
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_CHECKWEIGHERMODEL_12."
										</TD>
										<TD>
											[".$multilang_CHECKWEIGHERMODEL_13." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD>
											".$apache_input_field_TARGET."
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_CHECKWEIGHERMODEL_14."
										</TD>
										<TD>
											[".$multilang_CHECKWEIGHERMODEL_15." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD>
											".$apache_input_field_DELTA_MIN."
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_CHECKWEIGHERMODEL_16."
										</TD>
										<TD>
											[".$multilang_CHECKWEIGHERMODEL_17." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD>
											".$apache_input_field_DELTA_MAX."
										</TD>
									</TR>
									<TR>
										<TD>
											".$multilang_CHECKWEIGHERMODEL_34."
										</TD>
										<TD>
											[".$multilang_CHECKWEIGHERMODEL_35." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD>
											".$apache_input_field_TARE."
										</TD>
									</TR>
									<TR>
										<TD>
										</TD>
										<TD ALIGN='RIGHT'>
											<INPUT TYPE='hidden' name='seer_PROCESSUSER_ADD' value='YES'>
											".$multilang_CHECKWEIGHERMODEL_18.": 
										</TD>
										<TD VALIGN='MIDDLE'>
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

			$mysql_mod_openopc_query = "INSERT INTO ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." VALUES('".$seer_USERTOADD."', '".$seer_OFFERED_WORKING_TARGET."', '".$seer_OFFERED_WORKING_DELTA_MIN."', '".$seer_OFFERED_WORKING_DELTA_MAX."', '".$seer_OFFERED_WORKING_TARE."', '".$apache_DEFAULTDATESTAMP."', '".$mysql_seer_access_USERNAME."', 'none', 'none')";
			core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

			/* display a report of what was done */
			$apache_REPORT = "
							<P CLASS='INFOREPORT'>".$seer_USERTOADD." ".$multilang_CHECKWEIGHERMODEL_19."<BR>
								<BR>
								".$multilang_CHECKWEIGHERMODEL_20." <A HREF='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
								<BR>
							</P>
							";
		} else {
			$apache_REPORT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_35."<BR>
								<BR>
								".$multilang_STATIC_102." <A HREF='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>.
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
