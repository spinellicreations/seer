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
REMOVE USERS
-- REMOVE A SYSTEM USER
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>".$multilang_STATIC_106."</B>
							<BR>
							<A HREF='./seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'>".$multilang_MENU_BACK."</A>
						</P>
						";

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */
$seer_REFERRINGPAGE = "./seer_setup_removeusers.php";
/*	-- when we execute functions, send the user back here at end */

/* ACCEPT INPUT PASSED FROM REFERRING PAGE */
/* ------------------------------------------------------------------ */
if ( $_POST[seer_USERTOREMOVE] != '' ) {
	$seer_USERTOREMOVE = $_POST['seer_USERTOREMOVE'];
	if ( $_POST[seer_PROCESSUSER_REMOVE] != '' ) {
		$seer_PROCESSUSER_REMOVE = $_POST['seer_PROCESSUSER_REMOVE'];
	} else {
		$seer_PROCESSUSER_REMOVE = "NO";
	}
} else {
	$seer_PROCESSUSER_REMOVE = "NO";
}
if ( $_POST[seer_GROUPSEARCH] != '' ) {
	$seer_GROUPSEARCH = $_POST['seer_GROUPSEARCH'];
	if ( $_POST[seer_GROUPDESTROY] != '' ) {
		$seer_GROUPDESTROY = $_POST['seer_GROUPDESTROY'];
		if ( $_POST[seer_PROCESSGROUP_REMOVE] != '' ) {
			$seer_PROCESSGROUP_REMOVE = $_POST['seer_PROCESSGROUP_REMOVE'];
		} else {
			$seer_PROCESSGROUP_REMOVE = "NO";
		}
	} else {
		$seer_PROCESSGROUP_REMOVE = "NO";
	}
} else {
	$seer_PROCESSGROUP_REMOVE = "NO";
}

/* DECIDE IF WE'RE GOING TO DO ANYTHING */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSUSER_REMOVE == "YES" ) {
	$seer_PROCESSANY_REMOVE = "YES";
} else { 
	if ( $seer_PROCESSGROUP_REMOVE == "YES" ) {
		$seer_PROCESSANY_REMOVE = "YES";
	} else {
		$seer_PROCESSANY_REMOVE = "NO";
	}
}

/* DECIDE IF WE EVEN DISPLAY THIS PAGE AND IF SO, WHAT 		    */
/* ------------------------------------------------------------------ */
if ( $seer_USERACTIVE != "YES" ) {
	$seer_PROCESSANY_REMOVE = "FAULT";
	$seer_PROCESSANY_REMOVE_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_34."<BR>
								<BR>
							</P>
							";
} else {
	if ( $mysql_seer_access_ACCESSLEVEL > 2 ) {
	$seer_PROCESSANY_REMOVE = "FAULT";
	$seer_PROCESSANY_REMOVE_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_1."<BR>
								<BR>
								".$multilang_STATIC_ACCESS_ADMIN_SUPER."<BR>
								<BR>
							</P>
							";
	} else {
		/* continue */
	}
}

/* PERFORM USER REMOVE ACTION ON THE DATABASE */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSANY_REMOVE == "YES" ) {
	if ( $seer_PROCESSUSER_REMOVE == "YES" ) {
		/* remove the user */
 		$mysql_seer_access_query = "DELETE FROM access WHERE USERNAME='".$seer_USERTOREMOVE."' AND ACCESSLEVEL >= '".$mysql_seer_access_ACCESSLEVEL."'"; 
		core_mysql_seer_query_shell($mysql_seer_access_query);
	} else {
		/* take no action */
	}
	if ( $seer_PROCESSGROUP_REMOVE == "YES" ) {
		/* remove the group */
		$mysql_seer_access_query = "DELETE FROM access WHERE ".$seer_GROUPSEARCH."='".$seer_GROUPDESTROY."' AND ACCESSLEVEL >= '".$mysql_seer_access_ACCESSLEVEL."'";
		core_mysql_seer_query_shell($mysql_seer_access_query);
	} else {
		/* take no action */
	}
} else {
	/* take no action */
}

/* BUILD AN AVAILABLE USERLIST BASED UPON THIS USER'S CREDENTIALS */
/* ------------------------------------------------------------------ */

$seer_ACTIONSETTING = "DISPLAYALLUSERS";

if ( $seer_ACTIONSETTING == "DISPLAYALLUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '2' ) {	
		$seer_ACTIONSETTING = "DISPLAYSITEUSERS";
	} else {
		$mysql_seer_access_query = "SELECT * FROM access ORDER BY USERNAME ASC";
		/* continue */
	}
}
if ( $seer_ACTIONSETTING == "DISPLAYSITEUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '3' ) {	
		$seer_ACTIONSETTING = "DISPLAYDEPTUSERS";
	} else {
		$mysql_seer_access_query = "SELECT * FROM access WHERE COMPANY='".$mysql_seer_access_COMPANY."' AND SITE='".$mysql_seer_access_SITE."' ORDER BY USERNAME ASC";
		/* continue */
	}
}
if ( $seer_ACTIONSETTING == "DISPLAYDEPTUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '4' ) {	
		$seer_ACTIONSETTING = "DISPLAYSHIFTUSERS";
	} else {
		$mysql_seer_access_query = "SELECT * FROM access WHERE COMPANY='".$mysql_seer_access_COMPANY."' AND SITE='".$mysql_seer_access_SITE."' AND DEPARTMENT='".$mysql_seer_access_DEPARTMENT."' ORDER BY USERNAME ASC";
		/* continue */
	}
}
if ( $seer_ACTIONSETTING == "DISPLAYSHIFTUSERS" ) {
	/* CHECK ACCESSLEVEL AND DEPRECATE DISPLAY LEVEL IF NEEDED */
	if ( $mysql_seer_access_ACCESSLEVEL > '5' ) {	
		$seer_PROCESSSETTING = "NO";
	} else {
		/* continue */
		$mysql_seer_access_query = "SELECT * FROM access WHERE COMPANY='".$mysql_seer_access_COMPANY."' AND SITE='".$mysql_seer_access_SITE."' AND DEPARTMENT='".$mysql_seer_access_DEPARTMENT."' AND SHIFT='".$mysql_seer_access_SHIFT."' ORDER BY USERNAME ASC";
	}
}

list($mysql_seer_access_result,$mysql_seer_access_row_count) = core_mysql_seer_query_shell($mysql_seer_access_query);

$apache_REPORT_USERLIST = "
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='900' CELLPADDING=0 CELLSPACING=0>	
								<TR>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='100'>
										<B><U>".$multilang_SETTINGS_USERNAME."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='120'>
										<B><U>".$multilang_SETTINGS_REALNAME."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='120'>
										<B><U>".$multilang_SETTINGS_SITE."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='120'>
										<B><U>".$multilang_SETTINGS_DEPARTMENT."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='100'>
										<B><U>".$multilang_SETTINGS_SUPERVISOR."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='40'>
										<B><U>".$multilang_SETTINGS_SHIFT."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='115'>
										<B><U>".$multilang_SETTINGS_ACCESS_GRANTED_BY."</U></B>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle' WIDTH='105'>
										<B><U>".$multilang_SETTINGS_LAST_MODIFIED_BY."</U></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='middle' WIDTH='80'>
										<B><U>".$multilang_SETTINGS_ACCESS_LEVEL."</U></B>
									</TD>
								</TR>
								";

				while ( $mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_access_result)) {
					$mysql_seer_access_WORKING_USERNAME = $mysql_seer_access_row['USERNAME'];
					$mysql_seer_access_WORKING_REALNAME = $mysql_seer_access_row['REALNAME'];
					$mysql_seer_access_WORKING_SITE = $mysql_seer_access_row['SITE'];
					$mysql_seer_access_WORKING_DEPARTMENT = $mysql_seer_access_row['DEPARTMENT'];
					$mysql_seer_access_WORKING_SUPERVISOR = $mysql_seer_access_row['SUPERVISOR'];
					$mysql_seer_access_WORKING_SHIFT = $mysql_seer_access_row['SHIFT'];
					$mysql_seer_access_WORKING_ACCESSGRANTEDBY = $mysql_seer_access_row['ACCESSGRANTEDBY'];
					$mysql_seer_access_WORKING_LASTMODIFIEDBY = $mysql_seer_access_row['LASTMODIFIEDBY'];
					$mysql_seer_access_WORKING_ACCESSLEVEL = $mysql_seer_access_row['ACCESSLEVEL'];
				
					$apache_REPORT_USERLIST = $apache_REPORT_USERLIST."
								<TR>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										<A HREF='./seer_setup_modifyuser.php".$seer_REFERRINGPAGE_ADDKEYINFO.";seer_USERTOMODIFY=".$mysql_seer_access_WORKING_USERNAME."'>".$mysql_seer_access_WORKING_USERNAME."</A>
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_REALNAME."
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_SITE."
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_DEPARTMENT."
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_SUPERVISOR."
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_SHIFT."
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_ACCESSGRANTEDBY."
									</TD>
									<TD ALIGN='RIGHT' VALIGN='middle'>
										".$mysql_seer_access_WORKING_LASTMODIFIEDBY."
									</TD>
									<TD ALIGN='CENTER' VALIGN='middle'>
										".$mysql_seer_access_WORKING_ACCESSLEVEL."
									</TD>
								</TR>
								";
				}
	
				$apache_REPORT_USERLIST = $apache_REPORT_USERLIST."
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";

/* REPORT CONTENT */
/* ------------------------------------------------------------------ */
$apache_REPORT_CONTROLS = "
						<TABLE CLASS='STANDARD' WIDTH='400' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>	
							<TR>
								<TD VALIGN='TOP'>
									<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
										<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='200' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD>
													<B><U>".$multilang_SETTINGS_REMOVE_SINGLE_USER."</U></B>
												</TD>
											</TR>
											<TR>
												<TD>
													<INPUT TYPE='text' name='seer_USERTOREMOVE' size='20' maxlength='30' VALUE='".$multilang_SETTINGS_USERNAME."'><BR>
												</TD>
											</TR>
											<TR>
												<TD>
													<INPUT TYPE='hidden' name='seer_PROCESSUSER_REMOVE' value='YES'>
													<BR>
													".$multilang_SETTINGS_COMMIT_USER_REMOVE.": <BR>
													<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
												</TD>
											</TR>
										</TABLE>
									</FORM>
								</TD>
								<TD VALIGN='TOP'>
									<FORM ACTION='".$seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
										<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='200' CELLPADDING=0 CELLSPACING=0>
											<TR>
												<TD>
													<B><U>".$multilang_SETTINGS_REMOVE_GROUP_OF_USERS."</U></B>
												</TD>
											</TR>
											<TR>
												<TD>
													<SELECT NAME='seer_GROUPSEARCH'>
														<OPTION VALUE=''>".$multilang_SETTINGS_GROUP_ID_BY."
														<OPTION VALUE='COMPANY'>".$multilang_SETTINGS_COMPANY."
														<OPTION VALUE='SITE'>".$multilang_SETTINGS_SITE."
														<OPTION VALUE='DEPARTMENT'>".$multilang_SETTINGS_DEPARTMENT."
														<OPTION VALUE='SUPERVISOR'>".$multilang_SETTINGS_SUPERVISOR."
														<OPTION VALUE='ACCESSGRANTEDBY'>".$multilang_SETTINGS_ACCESS_GRANTED_BY."
														<OPTION VALUE='LASTMODIFIEDBY'>".$multilang_SETTINGS_LAST_MODIFIED_BY."
													</SELECT><BR>
													<BR>
													<INPUT TYPE='text' name='seer_GROUPDESTROY' size='20' maxlength='60' VALUE='removal criteria'><BR>
												</TD>
											</TR>
											<TR>
												<TD>
													<INPUT TYPE='hidden' name='seer_PROCESSGROUP_REMOVE' value='YES'>
													<BR>
													".$multilang_SETTINGS_COMMIT_GROUP_REMOVE.": <BR>
													<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
												</TD>
											</TR>
										</TABLE>
									</FORM>
								</TD>
							</TR>
						</TABLE>
						";


/* REPORT ASSEMBLY */
/* ------------------------------------------------------------------ */
if ( $seer_PROCESSANY_REMOVE == "NO" ) {
	$apache_REPORT = $apache_REPORT_USERLIST.$apache_REPORT_CONTROLS;
} else {
	if ( $seer_PROCESSANY_REMOVE == "FAULT" ) {
		$apache_REPORT = $seer_PROCESSANY_REMOVE_FAULT;
		$apache_REPORT = core_fault_page_body($apache_REPORT);
	} else {
		if ( $seer_PROCESSANY_REMOVE == "YES" ) {
			$apache_REPORT = "
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='700' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='700'>
									<P CLASS='INFOREPORT'>".$multilang_STATIC_107."<BR>
										<BR>
										".$multilang_STATIC_108."
									</P>
								</TD>
							</TR>
						</TABLE>
						".$apache_REPORT_USERLIST.$apache_REPORT_CONTROLS;								
		} else {
			$apache_REPORT = "
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='700' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='700'>
									<P CLASS='INFOREPORT'>".$multilang_FAULT_35."<BR>
								<BR>
							</P>
								</TD>
							</TR>
						</TABLE>
						";
		}
	}
}

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
$MODEL_USERREPORT_ENABLE = "YES";
include('./include/seer_echo_to_html.php');

?>
