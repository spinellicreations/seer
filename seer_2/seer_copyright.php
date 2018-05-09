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
COPYRIGHT
-- STATEMENT OF OPEN SOURCE
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
							<B>".$multilang_STATIC_19."</B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */
/* NOTE - THE FOLLOWING LINES (remainder of this doc) MAY NOT BE */
/*        REMOVED OR OTHERWISE SETUP SUCH THAT THE CONTENT IS NOT VISIBLE */
/* 	  FROM THE WEBSITE.  NOR SHOULD THEY BE ALTERED IN A MANNER THAT CHANGES */
/*	  THE CONTEXT OF THE MESSAGE */
/*	  FAILURE TO ADHERE TO THIS SHALL CONSTITUTE A VIOLATION OF THE */
/*	  THE LICENSE AGREEMENT, AS DISPLAY OF THE CONTENT ORIGIN IS TO BE (AS */
/*	  OF THIS NOTICE) A REQUIREMENT OF THE AGREEMENT. */
/*	  OF COURSE, THE FOLLOWING MAY BE APPENDED OR ADDED TO AS IS */
/*	  APPROPRIATE FOR ADDITIONAL CONTENT. */
$apache_REPORT = "
						<DIV CLASS='INFOREPORT'>
							<P CLASS='INFOREPORT'>
								<B><I>".$multilang_STATIC_20."</I> | <I>".$multilang_STATIC_23."</I></B><BR>
								<BR>
								".$multilang_STATIC_21."<BR>
								<BR>
								<B><I>".$multilang_STATIC_22."</I></B><BR>
								<BR>
								<B>S.E.E.R. (incl. W.A.R.R.I.O.R.) ".$multilang_STATIC_128." 2008 - 2014.</B><BR>
								GNU Affero GPL (AGPL) version 3 -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_agpl.png' ALT='AGPL'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_agpl_3.txt' TARGET='NEW0'>AGPL v3</A><BR>
								2008 - 2013 -- Vince Spinelli for Sorrento Lactalis, Inc.<BR>
								2013 -- Vince Spinelli for SpinelliCreations.com<BR>
								2014 -- Vince Spinelli for Harper International, Corp.<BR>
								2016 -- Vince Spinelli and Jon Trembley for RS Automation, LLC<BR>
								... http://spinellicreations.com<BR>
								... http://sorrentolactalis.com<BR>
								... http://www.harperintl.com<BR>
								... httpL//www.rsautomation.net<BR>
								** ".$multilang_WARRIOR_125."<BR>
								** ".$multilang_WARRIOR_126."<BR>
								... http://ultimatewarrior.com<BR>
								<BR>
								<B>S.E.E.R. Translation - French ".$multilang_STATIC_128." 2010 - 2012.</B><BR>
								Creative Commons (cc by-sa) Share Alike version 3.0 Unported -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_ccbysa.png' ALT='CREATIVE_COMMONS_SA'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_ccbysa_3_unported.pdf' TARGET='NEW0'>cc by-sa</A><BR>
								Hakan Koni and Associates for SpinelliCreations.<BR>
								... http://spinellicreations.com<BR>
								<BR>
								<B>S.E.E.R. Translation - Spanish ".$multilang_STATIC_128." 2010 - 2012.</B><BR>
								Creative Commons (cc by-sa) Share Alike version 3.0 Unported -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_ccbysa.png' ALT='CREATIVE_COMMONS_SA'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_ccbysa_3_unported.pdf' TARGET='NEW0'>cc by-sa</A><BR>
								Hakan Koni and Associates for SpinelliCreations.<BR>
								... http://spinellicreations.com<BR>
								<BR>
								<B>mod_openopc ".$multilang_STATIC_128." 2008 - 2016.</B><BR>
								GNU GPL (GPL) version 3 -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_gpl.png' ALT='GPL'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_gpl_3.txt' TARGET='NEW0'>GPL v3</A><BR>
								2008 - 2013 -- Vince Spinelli for Sorrento Lactalis, Inc.<BR>
								2013 -- Vince Spinelli for SpinelliCreations.com<BR>
								2014 -- Vince Spinelli for Harper International, Corp.<BR>
								2016 -- Vince Spinelli and Jon Trembley for RS Automation, LLC <BR>
								... http://spinellicreations.com<BR>
								... http://sorrentolactalis.com<BR>
								... http://www.harperintl.com<BR>
								... http://www.rsautomation.net<BR>
								<BR>
								<B>phpSysInfo ".$multilang_STATIC_128." 1999 - 2012, 2016.</B><BR>
								GNU GPL (GPL) version 2 -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_gpl_old.png' ALT='GPL_OLD'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_gpl_2.txt' TARGET='NEW0'>GPL v2</A><BR>
								1999 - 2008 -- Uriah Welcome,<BR>
								1999 - 2009 -- Matthew Snelham &#38 Michael Cramer,<BR>
								2007 - 2008 -- Audun Larsen,<BR>
								2010 - 2012 -- Damien Roth,<BR>
								2007 - 2014 -- Erkan Valentin,<BR>
								2009 - 2014 -- Mieczyslaw Nalewaj.<BR>
								... http://phpsysinfo.sourceforge.net (legacy)<BR>
								... http://phpsysinfo.github.io/phpsysinfo (current)<BR>
								".$multilang_STATIC_NOTE.": v. 2.5.4 [".$multilang_STATIC_127."] ( < SEER v.1.5.4-a ).<BR>
								".$multilang_STATIC_NOTE.": v. 3.0.20 vanilla ( > SEER v.1.5.4-a ).<BR>
								".$multilang_STATIC_NOTE.": v. 3.2.7 ( >SEER v. 1.6.0 ).<BR>
								<BR>
								<B>Mingyi's Auto-Complete ".$multilang_STATIC_128." 2004 - 2006, 2010.</B><BR>
								MIT Expat License<BR>
								<IMG SRC='./img/tag_mit.png' ALT='MIT_EXPAT'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_mit_license.pdf' TARGET='NEW0'>MIT Expat</A><BR>
								Dr. Mingyi Liu, Ph.D<BR>
								... http://mingyi.org<BR>
								".$multilang_STATIC_NOTE.": v. 1.1 [".$multilang_STATIC_127."]<BR>
								<BR>
								<B>wkhtmltopdf ".$multilang_STATIC_128." 2009 - 2012, 2016.</B><BR>
								GNU Lesser GPL (LGPL) version 3 -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_lgpl' ALT='LGPL'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_lgpl_3.txt' TARGET='NEW0'>LGPL v3</A><BR>
								Jan Habermann,<BR>
								Christian Sciberras,<BR>
								&#38 Jakob Truelsen;<BR>
								... http://code.google.com/p/wkhtmltopdf<BR>
								... http://mandalgo.au.dk/~jakobt<BR>
								".$multilang_STATIC_NOTE.": v. 0.11-rc1 [".$multilang_STATIC_127."]<BR>
								".$multilang_STATIC_NOTE.": v. 0.12.3.2 [".$multilang_STATIC_127."} ( > SEER v. 1.6.0).<BR>
								<BR>
								<B>fontconfig ".$multilang_STATIC_128." 2000 - 2009.</B><BR>
								Custom Free License (no version) -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_custom.png' ALT='CUSTOM'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_fontconfig.txt' TARGET='NEW0'>Custom Free License</A><BR>
								Keith Packard,<BR>
								Patrick Lam,<BR>
								Roozbeh Pournader,<BR>
								Danilo Segan,<BR>
								&#38 Red Hat, Inc.;<BR>
								... http://www.fontconfig.org<BR>
								... http://www.freedesktop.org/wiki/Software/fontconfig<BR>
								".$multilang_STATIC_NOTE.": v. 2.9.0 [".$multilang_MENU_SOFTWARE."]<BR>
								<BR>
								<B>fontsquirrel_open-sans ".$multilang_STATIC_128." 2012.</B><BR>
								Apache License version 2 -- [".$multilang_STATIC_129."]<BR>
								<IMG SRC='./img/tag_apache_2.png' ALT='APACHE'><BR>
								".$multilang_STATIC_24." <A HREF='./download/license_file_type_apache_2.txt' TARGET='NEW0'>APACHE v2</A><BR>
								Ascender Fonts by Monotype Imaging.<BR>
								... http://www.ascenderfonts.com<BR>
								... http://www.fontsquirrel.com<BR>
								".$multilang_STATIC_NOTE.": v. retrieved_20120704 [".$multilang_STATIC_127."]<BR>
								<BR>
							</P>
						</DIV>
						";


/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
