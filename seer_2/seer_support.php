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
HELP AND SUPPORT CONTACT
-- WHO YOUR USERS SHOULD GET AHOLD OF IN CASE OF TROUBLES
---------------------------------------------------------------------
*/

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
							<B>".$multilang_STATIC_54."</B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT = "
						<DIV CLASS='INFOREPORT'>
							<P CLASS='INFOREPORT'>
								<B><I>".$multilang_STATIC_55."</I></B><BR>
								<BR>
								".$multilang_STATIC_NAME.": ".$seer_ADMIN0."<BR>
								".$multilang_STATIC_TITLE.": ".$seer_ADMIN0TITLE."<BR>
								".$multilang_STATIC_DEPT.": ".$seer_ADMIN0DIVISION."<BR>
								".$multilang_STATIC_EMAIL.": ".$seer_ADMIN0EMAIL."<BR>
								".$multilang_STATIC_PHONE.": ".$seer_ADMIN0PHONE."<BR>
								<BR>
								".$multilang_STATIC_NAME.": ".$seer_ADMIN1."<BR>
								".$multilang_STATIC_TITLE.": ".$seer_ADMIN1TITLE."<BR>
								".$multilang_STATIC_DEPT.": ".$seer_ADMIN1DIVISION."<BR>
								".$multilang_STATIC_EMAIL.": ".$seer_ADMIN1EMAIL."<BR>
								".$multilang_STATIC_PHONE.": ".$seer_ADMIN1PHONE."<BR>
								<BR>
								".$multilang_STATIC_NAME.": ".$seer_ADMIN2."<BR>
								".$multilang_STATIC_TITLE.": ".$seer_ADMIN2TITLE."<BR>
								".$multilang_STATIC_DEPT.": ".$seer_ADMIN2DIVISION."<BR>
								".$multilang_STATIC_EMAIL.": ".$seer_ADMIN2EMAIL."<BR>
								".$multilang_STATIC_PHONE.": ".$seer_ADMIN2PHONE."<BR>
								<BR>
								<B><I>".$multilang_STATIC_56."</I></B><BR>
								<BR>
								".$seer_GENERALINSTRUCTIONS."<BR>
								<BR>
								<B><I>".$multilang_STATIC_57."</I></B><BR>
								<BR>
								".$seer_EMERGENCYINSTRUCTIONS."<BR>
								<BR>
								<B><I>".$multilang_STATIC_58."</I></B><BR>
								<BR>
								- Q - ".$multilang_FAQ_1Q."<BR>
								<BR>
								- A - <I>".$multilang_FAQ_1A."</I><BR>
								<BR>
								- Q - ".$multilang_FAQ_2Q."<BR>
								<BR>
								- A1 - <I>".$multilang_FAQ_2A_11."...</I><BR>
								-------- <A HREF='http://mozilla.org' TARGET='NEW0'>Mozilla Firefox</A><BR>
								-------- <A HREF='http://www.opera.com' TARGET='NEW0'>Opera</A><BR>
								-------- <A HREF='http://www.apple.com/safari' TARGET='NEW0'>Apple Safari</A><BR>
								-------- <A HREF='http://www.google.com/chrome' TARGET='NEW0'>Google Chrome</A><BR>
								-------- <A HREF='http://konqueror.org' TARGET='NEW0'>Konqueror</A><BR>
								<BR>
								- A2 - <I>".$multilang_FAQ_2A_21."...<BR>
								-------- ".$multilang_FAQ_2A_22."<BR>
								-------- ".$multilang_FAQ_2A_23."<BR>
								-------- ".$multilang_FAQ_2A_24."<BR>
								-------- ".$multilang_FAQ_2A_25."<BR>
								-------- ".$multilang_FAQ_2A_26."<BR>
								-------- ".$multilang_FAQ_2A_27."<BR>
								-------- ".$multilang_FAQ_2A_28."</I><BR>
								<BR>
								- A3 - <I>".$multilang_FAQ_2A_31."<BR>
								-------- ".$multilang_FAQ_2A_32."<BR>
								-------- ".$multilang_FAQ_2A_33."</I><BR>
								<BR>
								- Q - ".$multilang_FAQ_3Q."<BR>
								<BR>
								- A - <I>".$multilang_FAQ_3A_11."...<BR>
								-------- ".$multilang_FAQ_3A_12."<BR>
								-------- ".$multilang_FAQ_3A_13."<BR>
								-------- ".$multilang_FAQ_3A_14."<BR>
								-------- ".$multilang_FAQ_3A_15."<BR>
								-------- ".$multilang_FAQ_3A_16."</I><BR>
								<BR>
								- Q - ".$multilang_FAQ_4Q."<BR>
								<BR>
								- A - <I>".$multilang_FAQ_4A." <A HREF='http://www.damnsmalllinux.org' TARGET='DAMNSMALLLINUX'>Damn Small Linux</A>.</I><BR>
							</P>
						</DIV>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
