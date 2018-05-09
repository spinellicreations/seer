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
SYSTEM FOOTER
---------------------------------------------------------------------
*/

/* CLOCK ME */
/* -------- */
if ( ($ENABLE_CLOCK_ME_EXECUTION_TIME_STAMP == 'YES') && ($ENABLE_CLOCK_ME_TRAFFIC_COP_ENCOUNTERED == 'YES') ) {
	$CLOCK_ME_END = date('Y_md_H:i:s');
	list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($CLOCK_ME_START,$CLOCK_ME_END);
	$CLOCK_ME_RESULT = "
					<!-- XXXXXXXXXXXXXXXXXXXXXXXX -->
					<!-- PAGE LOAD TIME (SECONDS) -->
					<!-- XXXXXXXXXXXXXXXXXXXXXXXX -->
					<TR>
						<TD COLSPAN='2'>
							<P CLASS='FOOTER1'>
								<B>".$multilang_STATIC_PAGE_LOAD_TIME."</B><BR>
								".$multilang_STATIC_DURATION_IN_SECONDS_SMALL." - ".$apache_function_DURATION_UNIXTIME."
							</P>
						</TD>
					</TR>

					<!-- XXXXXXXXXXXXXXXXXXXXXXXX -->
					";
} else {
	$CLOCK_ME_RESULT = "";
}

/* DOCUMENT BODY SHELL BOTTOM */
/* ------------------------------------------------------------------ */
$apache_BODYSHELLBOTTOM = "";

/* SKIP THIS MARKUP IF USING CANVAS */
if ($seer_enable_CANVAS == 'NO') {
	$apache_BODYSHELLBOTTOM = $apache_BODYSHELLBOTTOM."
						</TD>
					</TR>
				</TABLE>
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

				<TABLE ALIGN='CENTER' CLASS='MENU' WIDTH='875'>
					<TR>
						<TD>
							<P CLASS='BANNER'>
						 		<IMG SRC='".$seer_DEFAULTSUBDIVIDER."' WIDTH='875' ALT='subdivider'>
							</P>
						</TD>
					</TR>
				</TABLE>

				<!-- XXXXXXXXXX -->
				<!-- FOOTER BAR -->
				<!-- XXXXXXXXXX -->

				<TABLE ALIGN='CENTER' CLASS='MENU' WIDTH='875'>
					<TR>
						<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
							<A HREF='/".$apache_seer_VERSION."/index.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_HOME."</A>
						</TD>
						<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
							<A HREF='/".$apache_seer_VERSION."/seer_documents.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_APPLICATION_DOCS."</A>
						</TD>
						<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
							<A HREF='/".$apache_seer_VERSION."/seer_about.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_ABOUT."</A> 
						</TD>
						<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
							<A HREF='/".$apache_seer_VERSION."/seer_support.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_HELP."</A> 
						</TD>
						<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
							<A HREF='/".$apache_seer_VERSION."/seer_copyright.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_COPYRIGHT."</A>
						</TD>
					</TR>
				</TABLE>

				<!-- XXXXXXXXXX -->
				";
} else {
	/* pass */
}

$apache_BODYSHELLBOTTOM = $apache_BODYSHELLBOTTOM."

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
								<IMG SRC='/".$apache_seer_VERSION."/img/clearspace_20px.png' WIDTH='30' ALT='space'><IMG SRC=".$seer_DEFAULTW3C_1." ALT='VALID_HTML'><BR>
								<BR>
								<IMG SRC='/".$apache_seer_VERSION."/img/clearspace_20px.png' WIDTH='30' ALT='space'><IMG SRC=".$seer_DEFAULTW3C_2." ALT='VALID_CSS'>
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
					".$CLOCK_ME_RESULT."
				</TABLE>
			</DIV>
		</DIV>

		<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	</BODY>

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	</HTML>

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	";

/* EXPORT TO HTML */
/* ------------------------------------------------------------------ */
echo $apache_BODYSHELLBOTTOM;

/* CLOSE THE MySQL DB CONNECTION GRACEFULLY */
/* ------------------------------------------------------------------ */
seer_mysql_close();

?>
