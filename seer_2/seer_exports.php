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
EXPORTS PACKAGE
---------------------------------------------------------------------
*/

/* REGARDING THE CALLING OF THIS PACKAGE */
/* ------------------------------------- */
/* -- a call in any SEER page should use the following form in order to request this package */
/*    and build output */
/* <FORM ACTION='./seer_exports.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'> */
/* 	<INPUT TYPE='hidden' name='seer_EXPORT_EXTENSION' value='csv'> */
/*	<INPUT TYPE='hidden' name='seer_EXPORT_CONTENT' value=".$seer_EXPORT_CONTENT."> */
/*	<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'> */
/* </FORM> */
/* -- obviously, replace 'csv' by 'txt', 'ppt', or whatever extension you desire */
/* -- currently handlers are made for only pdf, csv, and txt files... so build your handlers */
/*    in below if desired */
/* -- the export content should be the entire body of the file you wish to dump */

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
							<B>".$multilang_STATIC_29."</B>
						</P>
						";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* PULL IN EXPORT VARIABLES */
/* ------------------------------------------------------------------- */
if ( $_POST[seer_EXPORT_EXTENSION] != '' ) {
	$seer_EXPORT_EXTENSION = $_POST['seer_EXPORT_EXTENSION'];
} else {
	$seer_EXPORT_EXTENSION = "txt";
}
if ( $_POST[seer_EXPORT_CONTENT] != '' ) {
	$seer_EXPORT_CONTENT = $_POST['seer_EXPORT_CONTENT'];
} else {
	$seer_EXPORT_CONTENT = $multilang_STATIC_30;
}
if ( $_POST[seer_EXPORT_PAGETITLE] != '' ) {
	$seer_EXPORT_PAGETITLE = $_POST['seer_EXPORT_PAGETITLE'];
} else {
	$seer_EXPORT_PAGETITLE = "";
}

/* DECLARE LINK ICON */
/* ------------------------------------------------------------------- */
$apache_LINK_ICON = "UNDEFINED";
if ( $seer_EXPORT_EXTENSION == "csv" ) {
	$apache_LINK_ICON = "./img/icon_csv.png";
} else {
	/* pass */
}
if ( $seer_EXPORT_EXTENSION == "txt" ) {
	$apache_LINK_ICON = "./img/icon_txt.png";
} else {
	/* pass */
}
if ( $seer_EXPORT_EXTENSION == "ppt" ) {
	$apache_LINK_ICON = "./img/icon_ppt.png";
} else {
	/* pass */
}
if ( $seer_EXPORT_EXTENSION == "pdf" ) {
	$apache_LINK_ICON = "./img/icon_pdf.png";
} else {
	/* pass */
}
if ( $apache_LINK_ICON == "UNDEFINED" ) {
	$apache_LINK_ICON = "./img/icon_other.png";
} else {
	/* pass */
}

/* CLEAN UP THE EXPORT FOLDER SO WE DON'T HAVE OLD RECORDS LAYING AROUND */
/* -- TRAP */
/* --------------------------------------------------------------------- */
$seer_clean_export_CUTOFF = date('Y_md_H');
$seer_clean_export_CUTOFF = "seer_export_on_".$seer_clean_export_CUTOFF;
/* -- what is the date, down to the hour */
$apache_DIRLIST = "";
$apache_DIRLISTEXPORTS = dirList($apache_DOCPATHEXPORTS);
foreach ($apache_DIRLISTEXPORTS as &$element) {
	if (( $element != 'index.php' ) && ( $element != 'placeholder.xtx' )) {
		/* check for age and if old, delete */
		if ( $element < $seer_clean_export_CUTOFF ) {
			/* delete old files */
			$seer_clean_export_REMFILE = $apache_DOCPATHEXPORTS."/".$element;
			unlink($seer_clean_export_REMFILE);
		} else {
			/* pass on current files */
		}
	} else {
		/* pass */
	}
}
unset($element);

/* EXPORT FILE PREP */
/* ------------------------------------------------------------------- */
$seer_export_ID_NUMBER_1 = rand(0,2000);
$seer_export_ID_NUMBER_2 = rand(0,2000);
$seer_export_ID_NUMBER_3 = rand(0,2000);
$seer_export_ID_NUMBER_4 = rand(0,2000);
$seer_EXPORT_FILENAME_TEMP = "/exports/seer_export_on_".$apache_CHARTGENERATEDATESTAMP."_EXPORT_ID_".$seer_export_ID_NUMBER_1.$seer_export_ID_NUMBER_2."_".$seer_export_ID_NUMBER_3.$seer_export_ID_NUMBER_4."_TEMP";
$seer_EXPORT_FILENAME = "/exports/seer_export_on_".$apache_CHARTGENERATEDATESTAMP."_EXPORT_ID_".$seer_export_ID_NUMBER_1.$seer_export_ID_NUMBER_2."_".$seer_export_ID_NUMBER_3.$seer_export_ID_NUMBER_4;
$seer_EXPORT_FILENAME_TEMP_HTM = $seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION.$seer_EXPORT_FILENAME_TEMP.".htm";
$seer_EXPORT_FILENAME_HTM = $seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION.$seer_EXPORT_FILENAME.".".$seer_EXPORT_EXTENSION;
$seer_EXPORT_FILENAME_TEMP = ".".$seer_EXPORT_FILENAME_TEMP.".htm";
$seer_EXPORT_FILENAME_ABS = $apache_WEBROOT.'/'.$apache_seer_VERSION.$seer_EXPORT_FILENAME.".".$seer_EXPORT_EXTENSION;
$seer_EXPORT_FILENAME = ".".$seer_EXPORT_FILENAME.".".$seer_EXPORT_EXTENSION;

/* FILE HANDLER - TXT and CSV */
/* ------------------------------------------------------------------- */
/* WORK WITH THE FILE */
if ( $seer_EXPORT_EXTENSION == "csv" || "txt" ) {
	/* CLEAN UP THE PASSED CONTENT */
	$seer_EXPORT_CONTENT = str_replace($seer_CSV_WHITESPACE_HOLDING, $seer_CSV_WHITESPACE_ACTUAL, $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace($seer_CSV_ENDOFLINE_HOLDING, $seer_CSV_ENDOFLINE_ACTUAL, $seer_EXPORT_CONTENT);

	/* CREATE THE FILE */
	$seer_WORKING_FILE = fopen($seer_EXPORT_FILENAME, 'w');
	fwrite($seer_WORKING_FILE, $seer_EXPORT_CONTENT);

	/* CLOSE THE FILE */
	fclose($seer_WORKING_FILE);
} else {
	/* pass */
}

/* FILE HANDLER - PDF */
/* ------------------------------------------------------------------- */
/* WORK WITH THE FILE */
if ( $seer_EXPORT_EXTENSION == "pdf" ) {
	/* -- BUILD A HEADER */
	$apache_HEADER = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
            \"http://www.w3.org/TR/html4/loose.dtd\">

	<HTML>

	<!-- XXXXXXXXXXXXX -->
	<!-- DOCUMENT HEAD -->
	<!-- XXXXXXXXXXXXX -->

	<HEAD>
		<TITLE>
			-= S.E.E.R. =- ".$multilang_STATIC_121."
		</TITLE>
		<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; CHARSET=UTF-8\"> 
		<LINK REL=\"shortcut icon\" HREF=\"http://".$apache_SERVER_NAME_OR_IP."/".$apache_seer_VERSION."/favicon.ico\" TYPE=\"image/vnd.microsoft.icon\">
		<LINK REL=\"stylesheet\" TYPE=\"text/css\" HREF=\"http://".$apache_SERVER_NAME_OR_IP.$seer_CSS_SHEET_TO_USE."\">
		";
	/* -- CSS INJECTION */
	$apache_HEADER = $apache_HEADER."
		<STYLE TYPE=\"text/css\">
			#CONTAINER_SHELL, #CONTAINER, #CONTAINER_REVEAL, DIV, dt, dl, dd, ul, li, SELECT, INPUT, table, tr, td, P {
				-webkit-text-size-adjust: none;
				}
		</STYLE>
			";
	/* -- SUPPORT HEADER MODIFICATION FOR PLUGINS (PULL IN) */
	/* -- -- THIS IS PRIMARILY INTENDED TO ALLOW SCRIPT BASED PLUGINS */
	/*	 TO ADD THE APPROPRIATE REFERENCES TO THE "HEAD" SECTION OF */
	/*	 TO GENERATED MARKUP */
	$apache_plugin_process_active = "HEADER";
	foreach ($seer_PLUGINS_TO_USE as $selected_PLUGIN) {
		include($apache_WEBROOT.'/'.$apache_seer_VERSION.'/plugins/'.$selected_PLUGIN.'/options.php');
	}
	$apache_plugin_process_active = "NONE";
	/*	-- DO NOT EDIT */
	/*	-- all plugins should be placed in /[seer_webroot]/plugins/[plugin_name]/ */
	/*	   and contain an 'options.php' file */
	$apache_HEADER = $apache_HEADER."
	</HEAD>

	<!-- XXXXXXXXXXXXX -->
	";
	
	/* -- ADD HEADER TO BODY */
	/* -- -- APPEND USER STATUS DISPLAY FIRST */
	/* -- -- THEN ADD A FOOTER */
	$seer_EXPORT_CONTENT = $apache_HEADER."
	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	<!-- DOCUMENT BODY (AKA - REPORT BODY) -->
	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	<BODY>

		<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
		<!-- SOME CSS AUTO-MAGIC CENTERS CONTENT (BOUNDED LATER) IN USER'S WINDOW -->
		<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

		<DIV ID='CONTAINER_SHELL'>
			<DIV ID='CONTAINER'>

				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				<!-- PAGE BANNER WITH LOGO, STATUS LIGHT(S), AND ALL THAT GOOD STUFF -->
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

				<TABLE ALIGN='CENTER' CLASS='MENU' WIDTH='875'>
					<TR>
						<TD>
							<P CLASS='BANNER'>
								<IMG STYLE='border:0' WIDTH='60' SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/pilot_data_off.png' ALT='data'></A><IMG SRC='/".$apache_seer_VERSION."/img/clearspace_20px.png' WIDTH='20' ALT='space'>
								<IMG SRC='".$seer_DEFAULTBANNER."' WIDTH='".$apache_PAGEBANNER_DEFAULTBANNER_WIDTH."' ALT='banner'>
						    		<BR>
						    		<IMG SRC='".$seer_DEFAULTDIVIDER."' WIDTH='875' ALT='divider'>
							</P>
						</TD>
					</TR>
				</TABLE>

				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				".seer_display_user_status("RETURN").$seer_EXPORT_PAGETITLE.$seer_EXPORT_CONTENT."
						</TD>
					</TR>
				</TABLE>
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

				<TABLE ALIGN='CENTER' CLASS='MENU' WIDTH='875'>
					<TR>
						<TD WIDTH='200'>
						</TD>
						<TD WIDTH='675'>
						</TD>
					</TR>
					<TR>
						<TD COLSPAN='2'>
							<P CLASS='BANNER'>
								<IMG SRC='".$seer_DEFAULTDIVIDER."' WIDTH='875' ALT='divider'>
							</P>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- NOTICE OF CONFIDENTIALITY OF DISPLAYED DATA AND CONTENT ANALYSIS -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<P CLASS='FOOTER1'>
								<B>".$multilang_MENU_CONFIDENTIAL."</B><BR>
								<BR>
								".$multilang_MENU_DATACOPYRIGHTPOLICY."<BR>
								<BR>
								".$multilang_MENU_NO_PIRATES.":<BR>
								<BR>
								".$seer_DATACOPYRIGHTHOLDER."
							</P>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<P CLASS='BANNER'>
								<IMG SRC='".$seer_DEFAULTSUBDIVIDER."' WIDTH='875' ALT='subdivider'>
							</P>
						</TD>
					</TR>
					<TR>

						<!-- XXXXXXXXXXXXXXXXXX -->
						<!-- VALID HTML AND CSS -->
						<!-- XXXXXXXXXXXXXXXXXX -->

						<TD VALIGN='MIDDLE'>
							<P CLASS='INFOREPORT'>
								<IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/clearspace_20px.png' WIDTH='30' ALT='space'><IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/w3c_valid_html.png' ALT='VALID_HTML'><BR>
								<BR>
								<IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/clearspace_20px.png' WIDTH='30' ALT='space'><IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/w3c_valid_css.png' ALT='VALID_CSS'>
							</P>
						</TD>

						<!-- XXXXXXXXXXXXXXXXXX -->

						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
						<!-- POWERED BY OPEN SOURCE GOODIES -->
						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

						<TD VALIGN='TOP'>
							<P CLASS='FOOTER1'>
								".$multilang_MENU_FOOTER_1."<BR>
								<BR>
								<B>".$multilang_MENU_POWERED_BY.":</B><BR>
								<A HREF='http://apache.org' TARGET='NEW0'>Apache HTTPD</A>, <A HREF='http://dev.mysql.com' TARGET='NEW0'>Sun MySQL</A>, <A HREF='http://python.org' TARGET='NEW0'>Python</A><BR>
								<A HREF='http://php.net' TARGET='NEW0'>PHP</A>, <A HREF='http://www.spinellicreations.com/spark/project_modopenopc.php' TARGET='NEW0'>mod_openopc</A>, <A HREF='http://www.spinellicreations.com/spark/project_syphon.php' TARGET='NEW0'>syphon</A><BR>
								<BR>
								<B>".$multilang_MENU_BUILT_WITH.":</B><BR>
								<A HREF='http://projects.gnome.org/gedit' TARGET='NEW0'>gEdit</A>, <A HREF='http://www.gimp.org' TARGET='NEW0'>the Gimp</A><BR>
							</P>
						</TD>

						<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

					</TR>
				</TABLE>
			</DIV>
		</DIV>

		<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	</BODY>

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	</HTML>

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	";

	/* SANITIZE CONTENT */
	/* -- ADD FULL PATH TO IMAGE FILE CALLS */
	$seer_EXPORT_CONTENT = str_replace("<IMG SRC='./img/", "<IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("<IMG SRC='/$apache_seer_version/img/", "<IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("src='./img/", "src='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("SRC='./img/", "SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/img/", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("<IMG SRC='./", "<IMG SRC='http://$apache_SERVER_NAME_OR_IP/$apache_seer_VERSION/", $seer_EXPORT_CONTENT);

	/* -- RIP OUT HYPERLINKS BY THEIR TEETH */
	$seer_EXPORT_CONTENT = preg_replace('#(<A.*?HREF).*?(>)#', '$1$2', $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = preg_replace('#(<a.*?href).*?(>)#', '$1$2', $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("<A HREF>", "", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("<a href>", "", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("</A>", "", $seer_EXPORT_CONTENT);
	$seer_EXPORT_CONTENT = str_replace("</a>", "", $seer_EXPORT_CONTENT);

	/* -- REZERO THE HEADER FOR USE BY THE 'REAL' PAGE */
	$apache_HEADER = "";

	/* PUSH CONTENT TO TEMPORARY HTM FILE */
	/* -- CREATE THE FILE */
	$seer_WORKING_FILE = fopen($seer_EXPORT_FILENAME_TEMP, 'w');
	fwrite($seer_WORKING_FILE, $seer_EXPORT_CONTENT);
	/* -- CLOSE THE FILE */
	fclose($seer_WORKING_FILE);

	/* PUSH TO EXTERNAL HANDLER */
	$wkhtmltopdf_cmd_to_execute = $seer_system_cmd_wkhtmltopdf." ".$seer_system_cmd_wkhtmltopdf_default_options." ".$seer_EXPORT_FILENAME_TEMP_HTM." ".$seer_EXPORT_FILENAME_ABS;
	exec($wkhtmltopdf_cmd_to_execute);
	/* -- WAIT ABOUT 10 SECONDS BECAUSE IT MAY TAKE A MOMENT TO GENERATE PDF */
	sleep(10);
} else {
	/* pass */
}

/* DELETE TEMPORARY FILE IF EXISTS */
/* ------------------------------------------------------------------ */
if (file_exists($seer_EXPORT_FILENAME_TEMP)) {
	unlink($seer_EXPORT_FILENAME_TEMP);
} else {
	/* pass */
}

/* PROVISION FOR AUTO DELETING EXPORT AFTER USE */
/* ------------------------------------------------------------------ */
if ( $apache_REMFILE_ACTION = "STANDARD" ) {
	$seer_REFERRINGPAGE_ADDKEYINFO = $seer_REFERRINGPAGE_ADDKEYINFO.";seer_REMFILE=".$seer_EXPORT_FILENAME;
} else {
	$seer_REFERRINGPAGE_ADDKEYINFO = $seer_REFERRINGPAGE_ADDKEYINFO."?seer_REMFILE=".$seer_EXPORT_FILENAME;
}
/*	-- alter links and navigation */
/*	-- this will get rid of the bulk of exports after use, however */
/*	   any that sneak by will get caught by the trap listed above. */

/* REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT_RECORDENTRY = "
						<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='630' CELLPADDING=0 CELLSPACING=0>
							<TR>
								<TD WIDTH='380' ALIGN='CENTER' VALIGN='MIDDLE'>
									<IMG SRC='".$seer_DEFAULTEXPORTLOGO."' ALT='export'>
									<BR>
									".$multilang_STATIC_31." <A HREF='http://www.libreoffice.org' TARGET='NEWOFC'>Libre Office</A> &#38 <A HREF='http://www.ghostscript.com' TARGET='NEWOFC'>GhostScript</A><BR>
									".$multilang_STATIC_32.".<BR>
								</TD>
								<TD WIDTH='250'>
									<P CLASS='INFOREPORT'><B>".$multilang_STATIC_33."</B><BR>
										<BR>
										".$multilang_STATIC_34."<BR>
										".$multilang_STATIC_35."
									</P>
									<BR>
									<A HREF='".$seer_EXPORT_FILENAME."' TARGET='EXPORTWINDOW'><IMG STYLE='border:0' SRC='".$apache_LINK_ICON."' ALT='EXPORTFILELINKICON'><BR>[Link] Your Export File</A><BR>
								</TD>
							</TR>
						</TABLE>
						";

/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY; 
$apache_REPORTL6 = "";
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
