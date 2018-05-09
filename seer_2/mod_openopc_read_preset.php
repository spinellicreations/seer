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
mod_openopc INTEGRATION
-- REQUEST READ SUBROUTINE BE RUN UPON A PRESET (myread).PRE FILE
---------------------------------------------------------------------
*/

/* PULL IN GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
include('./config/globaloptions_seer_0.php');

/* PULL IN INPUT AND PERFORM SANITY CHECK */
/* ------------------------------------------------------------------ */
mod_openopc_input_and_sanity_check("READ_PRESET");

/* BEGIN ---------- PROCEED ONLY IF INPUT FROM REFERRING PAGE GOOD */
/* ------------------------------------------------------------------ */
if ( $apache_EXECUTETHISFUNCTION == "YES" ) {
	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is operating system agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/
	
	/* FILE SYSTEM FUNCTIONS */
	/* ----------------------------------------------------------- */
	/*   --- IDENFITY mod_openopc gwcomm DIRECTORY */
	/*       AND BUILD A FILENAME
	/*       ------------------------------------- */
	$mod_openopc_EVENTFILE_DATESTAMP = date('Y_md_H-i-s');
		/* WINDOWS CANNOT HANDLE FILENAMES WITH COLONS IN THEM SO */
		/*	WE HAVE TO USE SLASHES FOR UNIVERSAL COMPATABILITY */
	$mod_openopc_EVENTFILE_ID1 = rand();
	$mod_openopc_EVENTFILE_ID2 = rand();
	$mod_openopc_EVENTFILE_NAME = $mod_openopc_EVENTFILE_DATESTAMP."_ID-".$mod_openopc_EVENTFILE_ID1."-".$mod_openopc_EVENTFILE_ID2."_READDAEMON.event";
	$mod_openopc_TEMPDAEMONFILE = $mod_openopc_TEMPDIR."/".$mod_openopc_EVENTFILE_NAME;
	$mod_openopc_FINALDAEMONFILE = $mod_openopc_GWCOMMDIR."/".$mod_openopc_READDAEMON."/".$mod_openopc_EVENTFILE_NAME;
	
	/*   --- BUILD STRUCTURE OF OUR EVENT FILE */
	/*       --------------------------------- */
	$mod_openopc_EVENTFILE_LINE1 = "# START READ_DAEMON EVENT FILE FROM S.E.E.R.\n";
	$mod_openopc_EVENTFILE_LINE2 = "[your_read]\n";
	$mod_openopc_EVENTFILE_LINE3 = "YOURREAD:".$mod_openopc_YOURREAD."\n";
	$mod_openopc_EVENTFILE_LINE4 = "#-- READ PRESET FROM FILE\n";
	$mod_openopc_EVENTFILE_LINE5 = "# END OF FILE\n";
	$mod_openopc_EVENTFILE_LINEALL = $mod_openopc_EVENTFILE_LINE1.$mod_openopc_EVENTFILE_LINE2.$mod_openopc_EVENTFILE_LINE3.$mod_openopc_EVENTFILE_LINE4.$mod_openopc_EVENTFILE_LINE5;
	
	/*   --- OPEN THE EVENT FILE AND WRITE TO */
	/*       -------------------------------- */
	$mod_openopc_EVENTFILE_ACTIVE = fopen($mod_openopc_TEMPDAEMONFILE, "w");
	fwrite($mod_openopc_EVENTFILE_ACTIVE, $mod_openopc_EVENTFILE_LINEALL);
	
	/*   --- CLOSE THE EVENT FILE AND MOVE IT FROM TEMP STORAGE TO */
	/*	   DAEMON ACTIVE DIRECTORY */
	/*       ----------------------------------------------------- */
	fclose($mod_openopc_EVENTFILE_ACTIVE);
	rename($mod_openopc_TEMPDAEMONFILE, $mod_openopc_FINALDAEMONFILE);

	/* GENERATE GOOD REPORT IF WE DON'T HAVE A PROBLEM */
	/* ----------------------------------------------- */
	$apache_GOODDATESTAMP = date('Y_md_H:i:s');
	$apache_REPORT = "
						<DIV CLASS='DAEMONREPORT'>
							<P CLASS='DAEMONREPORT'>
								<B><U>".$multilang_MODOPENOPC_SUCCESS."</U><BR>
								<BR>
								<B><I>".$multilang_MODOPENOPC_OPERATION_TYPE."</I></B><BR>
								<BR>
								mod_openopc - READ_DAEMON ".$multilang_MODOPENOPC_DAEMON_FILE_CREATION."<BR>
								".$multilang_MODOPENOPC_READ_DAEMON_FUNCTION_PRESET."<BR>
								<BR>
								<B><I>".$multilang_MODOPENOPC_DATESTAMP."</I></B><BR>
								<BR>
								".$multilang_MODOPENOPC_CURRENT_DATESTAMP." ... ".$apache_GOODDATESTAMP."<BR>
								<BR>
								<B><I>".$multilang_MODOPENOPC_ACTION_DATA."</I></B><BR>
								<BR>
								mod_openopc_GWCOMMDIR ... ".$mod_openopc_GWCOMMDIR."<BR>
								mod_openopc_TEMPDIR ... ".$mod_openopc_TEMPDIR."<BR>
								mod_openopc_READDAEMON ... ".$mod_openopc_READDAEMON."<BR>
								mod_openopc_YOURREAD ... ".$mod_openopc_YOURREAD."<BR>
								apache_EXECUTETHISFUNCTION ... ".$apache_EXECUTETHISFUNCTION."<BR>
								<BR>
								".$multilang_MODOPENOPC_SEER_AUTO_GENERATED."<BR>
								<BR> 
							</P>
						</DIV>
						";

/* END ------------ PROCEED ONLY IF INPUT FROM REFERRING PAGE GOOD */
/* ------------------------------------------------------------------ */
} else {
	/* GENERATE ERROR REPORT IF WE HAVE A PROBLEM */
	/* -------------------------------------------- */
	$apache_PAGETYPE = "STATIC";
	/*	-- do not auto refresh this page */
	$apache_ERRORDATESTAMP = date('Y_md_H:i:s');
	$apache_REPORT = "
						<DIV CLASS='DAEMONREPORT'>
							<P CLASS='DAEMONREPORT'>
								<B><U>".$multilang_MODOPENOPC_ERROR."</U><BR>
								<BR>
								<I>".$multilang_MODOPENOPC_BAD_INPUT."</I></B><BR>
								<BR>
								".$multilang_MODOPENOPC_BAD_INPUT_REASON."<BR>
								<BR>
								-- 1 -- ".$multilang_MODOPENOPC_BAD_INPUT_REASON_1."<BR>
								-- 2 -- ".$multilang_MODOPENOPC_BAD_INPUT_REASON_2."<BR>
								-- 3 -- ".$multilang_MODOPENOPC_BAD_INPUT_REASON_3." (1 and 2)<BR>
								-- 4 -- ".$multilang_MODOPENOPC_BAD_INPUT_REASON_4."<BR>
								<BR>
								<B><I>".$multilang_MODOPENOPC_OPERATION_TYPE."</I></B><BR>
								<BR>
								mod_openopc - READ_DAEMON ".$multilang_MODOPENOPC_DAEMON_FILE_CREATION."<BR>
								".$multilang_MODOPENOPC_READ_DAEMON_FUNCTION_PRESET."<BR>
								<BR>
								<B><I>".$multilang_MODOPENOPC_DATESTAMP."</I></B><BR>
								<BR>
								".$multilang_MODOPENOPC_CURRENT_DATESTAMP." ... ".$apache_ERRORDATESTAMP."<BR>
								<BR>
								<B><I>".$multilang_MODOPENOPC_DEBUG."</I></B><BR>
								<BR>
								mod_openopc_GWCOMMDIR ... ".$mod_openopc_GWCOMMDIR."<BR>
								mod_openopc_TEMPDIR ... ".$mod_openopc_TEMPDIR."<BR>
								mod_openopc_READDAEMON ... ".$mod_openopc_READDAEMON."<BR>
								mod_openopc_YOURREAD ... ".$mod_openopc_YOURREAD."<BR>
								apache_EXECUTETHISFUNCTION ... ".$apache_EXECUTETHISFUNCTION."<BR>
								<BR>
								".$multilang_MODOPENOPC_SEER_AUTO_GENERATED."<BR>
								<BR> 
							</P>
						</DIV>
						";
}

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
						<P CLASS='PAGETITLE'>
							<B>mod_openopc</B><BR>
							<B><I>read_preset</I></B>
						</P>
						";

/* ECHO TO HTML */
/* ------------------------------------------------------------------ */
include('./include/seer_echo_to_html.php');

?>
