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
INTRO
---------------------------------------------------------------------
*/

/* INTRO SPLASH SCREEN */
/* ------------------------------------------------------------------ */
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sun, 01 Jan 1990 01:00:00 GMT");
header("Refresh: 5; url=/seer_2/index.php");
$INTRO = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
	<HTML>
		<HEAD>
			<TITLE>
				This is S.E.E.R. ...
			</TITLE>
			<STYLE TYPE='text/css'>
				a {
					outline: none;
				}
				a img {
					border: none;
				}
			</STYLE>
			<META HTTP-EQUIV=\"REFRESH\" CONTENT=6;url=\"/seer_2/index.php\">
		</HEAD>
		<BODY BGCOLOR='#FFFFFF'>
			<P ALIGN='CENTER'>
				<BR>
				<BR>
				<BR>
				<BR>
				<BR>
				<A HREF='/seer_2/index.php'><IMG SRC='/seer_2/img/intro.png' ALT='CLICK TO ENTER'></A>
				<BR>
			</P>
		</BODY>
	</HTML>
	";
echo $INTRO;
?>
