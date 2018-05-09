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
CHECKWEIGHER MODEL MODIFY RECIPE
-- VIEW AND EDIT A RECIPE'S PARAMETERS
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
$seer_REFERRINGPAGE = "/".$apache_seer_VERSION."/include/core_models/CHECKWEIGHERMODEL_setup_modifyrecipe.php";
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
$mysql_mod_openopc_query = "SELECT * FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE LIKE '".$seer_USERTOMODIFY."'";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

$mysql_mod_openopc_result_array = mysqli_fetch_assoc($mysql_mod_openopc_result);
$mysql_mod_openopc_WORKING_USERNAME = $mysql_mod_openopc_result_array['RECIPE'];
$mysql_mod_openopc_WORKING_TARGET = $mysql_mod_openopc_result_array['TARGET'];
$mysql_mod_openopc_WORKING_DELTA_MIN = $mysql_mod_openopc_result_array['DELTA_MIN'];
$mysql_mod_openopc_WORKING_DELTA_MAX = $mysql_mod_openopc_result_array['DELTA_MAX'];
$mysql_mod_openopc_WORKING_TARE = $mysql_mod_openopc_result_array['TARE'];
$mysql_mod_openopc_WORKING_CREATED = $mysql_mod_openopc_result_array['CREATED'];
$mysql_mod_openopc_WORKING_CREATED_BY = $mysql_mod_openopc_result_array['CREATED_BY'];
$mysql_mod_openopc_WORKING_UPDATED = $mysql_mod_openopc_result_array['UPDATED'];
$mysql_mod_openopc_WORKING_UPDATED_BY = $mysql_mod_openopc_result_array['UPDATED_BY'];

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
		$mysql_mod_openopc_query = "SELECT * FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE LIKE '".$seer_OFFERED_WORKING_USERNAME."'";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_result_count) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

		if ($mysql_mod_openopc_result_count > 0) {
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
if ( $_POST[seer_OFFERED_WORKING_TARGET] != '' ) {
	$seer_OFFERED_WORKING_TARGET = $_POST['seer_OFFERED_WORKING_TARGET'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_DELTA_MIN] != '' ) {
	$seer_OFFERED_WORKING_DELTA_MIN = $_POST['seer_OFFERED_WORKING_DELTA_MIN'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_DELTA_MAX] != '' ) {
	$seer_OFFERED_WORKING_DELTA_MAX = $_POST['seer_OFFERED_WORKING_DELTA_MAX'];
} else {
	$seer_PROCESSSETTING_INTERNAL2 = "NO";
}
if ( $_POST[seer_OFFERED_WORKING_TARE] != '' ) {
	$seer_OFFERED_WORKING_TARE = $_POST['seer_OFFERED_WORKING_TARE'];
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

/* UPDATE DB FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_mod_openopc_access_ACCESSLEVEL <= 2 ) {
	/* define the update query for this access level */
	if ( $seer_PROCESSSETTING_INTERNAL2 == "YES" ) {
		$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." SET TARGET='".$seer_OFFERED_WORKING_TARGET."' WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." SET DELTA_MIN='".$seer_OFFERED_WORKING_DELTA_MIN."' WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." SET DELTA_MAX='".$seer_OFFERED_WORKING_DELTA_MAX."' WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." SET TARE='".$seer_OFFERED_WORKING_TARE."' WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." SET UPDATED='".$apache_DEFAULTDATESTAMP."' WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
		$mysql_mod_openopc_query = "UPDATE ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." SET UPDATED_BY='".$mysql_seer_access_USERNAME."' WHERE RECIPE='".$seer_USERTOMODIFY."'";
		core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);
	} else {
		/* no action */
	}

} else {
		/* no action */
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_CHECKWEIGHERMODEL_0."</B><BR>
								<BR>
								<B>".$multilang_CHECKWEIGHERMODEL_23."</B>
								<BR>
								<A HREF='/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* RE-LEARN EVERYTHING WE KNOW ABOUT THE USERTOMODIFY USER               */
/* ------------------------------------------------------------------ */
$mysql_mod_openopc_query = "SELECT * FROM ".$CHECKWEIGHERMODEL_mysql_mod_openopc_TABLENAME_RECIPE." WHERE RECIPE LIKE '".$seer_USERTOMODIFY."'";
list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query);

$mysql_mod_openopc_result_row = mysqli_fetch_assoc($mysql_mod_openopc_result);
$mysql_mod_openopc_WORKING_USERNAME = $mysql_mod_openopc_result_row['RECIPE'];
$mysql_mod_openopc_WORKING_TARGET = $mysql_mod_openopc_result_row['TARGET'];
$mysql_mod_openopc_WORKING_DELTA_MIN = $mysql_mod_openopc_result_row['DELTA_MIN'];
$mysql_mod_openopc_WORKING_DELTA_MAX = $mysql_mod_openopc_result_row['DELTA_MAX'];
$mysql_mod_openopc_WORKING_TARE = $mysql_mod_openopc_result_row['TARE'];
$mysql_mod_openopc_WORKING_CREATED = $mysql_mod_openopc_result_row['CREATED'];
$mysql_mod_openopc_WORKING_CREATED_BY = $mysql_mod_openopc_result_row['CREATED_BY'];
$mysql_mod_openopc_WORKING_UPDATED = $mysql_mod_openopc_result_row['UPDATED'];
$mysql_mod_openopc_WORKING_UPDATED_BY = $mysql_mod_openopc_result_row['UPDATED_BY'];

/* PERMISSION BASED INPUT FIELDS */
/* ------------------------------------------------------------------ */
if ( $mysql_mod_openopc_access_ACCESSLEVEL <= 2 ) {
	$apache_input_field_USERNAME = $mysql_mod_openopc_WORKING_USERNAME;
	$apache_input_field_TARGET = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_TARGET' value='".$mysql_mod_openopc_WORKING_TARGET."'>";
	$apache_input_field_DELTA_MIN = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_DELTA_MIN' value='".$mysql_mod_openopc_WORKING_DELTA_MIN."'>";
	$apache_input_field_DELTA_MAX = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_DELTA_MAX' value='".$mysql_mod_openopc_WORKING_DELTA_MAX."'>";
	$apache_input_field_TARE = "<INPUT TYPE='text' size='50' maxlength='10' name='seer_OFFERED_WORKING_TARE' value='".$mysql_mod_openopc_WORKING_TARE."'>";
	$apache_input_field_CREATED = $mysql_mod_openopc_WORKING_CREATED;
	$apache_input_field_CREATED_BY = $mysql_mod_openopc_WORKING_CREATED_BY;
	$apache_input_field_UPDATED = $mysql_mod_openopc_WORKING_UPDATED;
	$apache_input_field_UPDATED_BY = $mysql_mod_openopc_WORKING_UPDATED_BY;
} else {
	$apache_input_field_USERNAME = "";
	$apache_input_field_TARGET = "";
	$apache_input_field_DELTA_MIN = "";
	$apache_input_field_DELTA_MAX = "";
	$apache_input_field_TARE = "";
	$apache_input_field_CREATED = "";
	$apache_input_field_CREATED_BY = "";
	$apache_input_field_UPDATED = "";
	$apache_input_field_UPDATED_BY = "";
}

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSSETTING_FINAL == "YES" ) {
	$apache_REPORT = "
							<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
								<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='750'>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_10."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_CHECKWEIGHERMODEL_11."]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_USERNAME."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_12."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_CHECKWEIGHERMODEL_13." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_TARGET."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_14."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_CHECKWEIGHERMODEL_15." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_DELTA_MIN."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_16."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_CHECKWEIGHERMODEL_17." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_DELTA_MAX."
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_34."
										</TD>
										<TD WIDTH='300'>
											[".$multilang_CHECKWEIGHERMODEL_35." - {".$CHECKWEIGHERMODEL_UM_MASS."}]
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_TARE."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='3'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_25."
										</TD>
										<TD WIDTH='300'>
											<BR>
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_CREATED."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='3'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_26."
										</TD>
										<TD WIDTH='300'>
											<BR>
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_CREATED_BY."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='3'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_27."
										</TD>
										<TD WIDTH='300'>
											<BR>
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_UPDATED."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='3'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
											".$multilang_CHECKWEIGHERMODEL_28."
										</TD>
										<TD WIDTH='300'>
											<BR>
										</TD>
										<TD WIDTH='300'>
											".$apache_input_field_UPDATED_BY."
										</TD>
									</TR>
									<TR>
										<TD COLSPAN='3'>
											<BR>
										</TD>
									</TR>
									<TR>
										<TD WIDTH='150'>
										</TD>
										<TD ALIGN='RIGHT' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_PROCESSSETTING_INTERNAL' value='YES'>
											".$multilang_CHECKWEIGHERMODEL_24.": 
										</TD>
										<TD VALIGN='MIDDLE' WIDTH='300'>
											<INPUT TYPE='hidden' name='seer_OFFERED_WORKING_USERNAME' value='".$mysql_mod_openopc_WORKING_USERNAME."'>
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
