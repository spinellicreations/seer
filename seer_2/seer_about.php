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
ABOUT S.E.E.R.
-- YOU LIKE'A DA SAUCE?
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
							<B>".$multilang_STATIC_1."</B>
						</P>
						";

/* REPORT */
/* ------------------------------------------------------------------ */
$apache_REPORT = "
						<DIV CLASS='INFOREPORT'>
							<P CLASS='INFOREPORT'>
								<B><I>".$multilang_STATIC_2."</I></B><BR>
								<BR>
								S.E.E.R. (System and Environment Effective Reports) ".$multilang_STATIC_3."<BR>
								<BR>
								".$multilang_STATIC_4."<BR>
								<BR>
								<B><I>".$multilang_STATIC_5."</I></B><BR>
								<BR>
								".$multilang_STATIC_6."<BR>
								<BR>
								<B><I>".$multilang_STATIC_7."</I></B><BR>
								<BR>
								".$multilang_STATIC_8."<BR>
								<BR>
								<I>".$multilang_STATIC_9."</I><BR>
								<BR>
								".$multilang_STATIC_10."<BR>
								<BR>
								<B><I>".$multilang_STATIC_11."</I></B><BR>
								<BR> 
								".$multilang_STATIC_12."<BR>
								<BR>
								<B><I>".$multilang_STATIC_13."</I></B><BR>
								<BR>
								".$multilang_STATIC_14."<BR>
								<BR>
								<B><I>".$multilang_STATIC_15."</I></B><BR>
								<BR>
								".$multilang_STATIC_16."<BR>
								<BR>
								<B><I>".$multilang_STATIC_17."</I></B><BR>
								<BR>
								".$multilang_STATIC_18."<BR>
								<A HREF='http://www.spinellicreations.com/spark/projects.php' TARGET='NEW0'>
								http://SpinelliCreations.com</A>.
								<BR>
							</P>
						</DIV>
						";


/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
