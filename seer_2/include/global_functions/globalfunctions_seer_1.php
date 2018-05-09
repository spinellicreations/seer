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
S.E.E.R. GLOBAL FUNCTIONS FILE (1_mod_openopc_specific)
-- SYSTEM SUBROUTINES (FUNCTION BY FORM, SUBROUTINE BY EXECUTION)
---------------------------------------------------------------------
*/

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

/* MOD_OPENOPC INPUT ACCEPTANCE AND SANITY CHECK */
/* -- accepts input on behalf of mod_openopc integration and */
/*    checks that it is acceptable */
/* -- also pulls in traffic cop variables and other stuff needed */
/*    (in common) by the integration routines */
function mod_openopc_input_and_sanity_check ($mod_openopc_integration_type)
{
	/* CALL THIS FUNCTION WITH... */
	/* mod_openopc_input_and_sanity_check($mod_openopc_integration_type); */
	/* -- valid values for integration type are... */
	/* --   -- "READ_PRESET" */
	/* --   -- "WRITE_PRESET" */
	/* --   -- "WRITE_DECLARED" */
	/* --   -- no other values are allowed! */

	/* GLOBALIZE VARIABLES */
	/* 	-- SEER */
	global $seer_REFERRINGPAGE, $seer_REFERRINGPAGE_APPEND, $seer_BOUNCEBACKTIME, $seer_TRAFFIC_COP_OPTION;

	/*	-- MOD_OPENOPC */
	global $mod_openopc_GWCOMMDIR, $mod_openopc_TEMPDIR, $mod_openopc_WRITEDAEMON, $mod_openopc_YOURWRITEPRESET, $mod_openopc_YOURLEAFERS, $mod_openopc_READDAEMON, $mod_openopc_YOURREAD;

	/*	-- APACHE */
	global $apache_EXECUTETHISFUNCTION;

	/* EXECUTION CONTROL */
	$apache_EXECUTETHISFUNCTION = "YES";

	/* ACCEPT INPUT FROM CALLING WEB-FORM AND SANITY CHECK */
	if ( $mod_openopc_GWCOMMDIR != '' ) {
		/* this is a global option */
	} else {
		$mod_openopc_GWCOMMDIR = "UNDEFINED or INVALID";
		$apache_EXECUTETHISFUNCTION = "NO";
	}
	if ( $mod_openopc_TEMPDIR != '' ) {
		/* this is a global option */
	} else {
		$mod_openopc_TEMPDIR = "UNDEFINED or INVALID";
		$apache_EXECUTETHISFUNCTION = "NO";
	}
	if ( ($mod_openopc_integration_type == 'WRITE_PRESET') || ($mod_openopc_integration_type == 'WRITE_DECLARED') ) {
		if ( $_POST[mod_openopc_WRITEDAEMON] != '' ) {
			$mod_openopc_WRITEDAEMON = $_POST['mod_openopc_WRITEDAEMON'];
		} else {
			$mod_openopc_WRITEDAEMON = "INVALID";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
	} else {
		/* pass */
	}
	if ( $mod_openopc_integration_type == 'WRITE_PRESET' ) {
		if ( $_POST[mod_openopc_YOURWRITEPRESET] != '' ) {
			$mod_openopc_YOURWRITEPRESET = $_POST['mod_openopc_YOURWRITEPRESET'];
		} else {
			$mod_openopc_YOURWRITEPRESET = "INVALID";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
	} else {
		/* pass */
	}
	if ( $mod_openopc_integration_type == 'WRITE_DECLARED' ) {
		if ( $_POST[mod_openopc_YOURLEAFERS] != '' ) {
			$mod_openopc_YOURLEAFERS = $_POST['mod_openopc_YOURLEAFERS'];
			$mod_openopc_YOURLEAFERS = sanitizeRANDOMOPCcontent($mod_openopc_YOURLEAFERS,"LEAF_IS_EMPTY");
			if ($mod_openopc_YOURLEAFERS == 'LEAF_IS_EMPTY') {
				$mod_openopc_YOURLEAFERS = "INVALID";
				$apache_EXECUTETHISFUNCTION = "NO";
			} else {
				/* pass */
			}
		} else {
			$mod_openopc_YOURLEAFERS = "INVALID";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
	} else {
		/* pass */
	}
	if ( $mod_openopc_integration_type == 'READ_PRESET' ) {
		if ( $_POST[mod_openopc_READDAEMON] != '' ) {
			$mod_openopc_READDAEMON = $_POST['mod_openopc_READDAEMON'];
		} else {
			$mod_openopc_READDAEMON = "INVALID";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
		if ( $_POST[mod_openopc_YOURREAD] != '' ) {
			$mod_openopc_YOURREAD = $_POST['mod_openopc_YOURREAD'];
		} else {
			$mod_openopc_YOURREAD = "INVALID";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
	} else {
		/* pass */
	}

	/* HOW DID WE GET HERE AND HOW DO WE GET BACK */
	if ( $_POST[seer_REFERRINGPAGE] != '' ) {
		$seer_REFERRINGPAGE = $_POST['seer_REFERRINGPAGE'];
		if ( $_POST[seer_REFERRINGPAGE_APPEND] != '' ) {
			$seer_REFERRINGPAGE_APPEND = $_POST['seer_REFERRINGPAGE_APPEND'];
		} else {
			$seer_REFERRINGPAGE_APPEND = "";
		}
	} else {
		/* use default */
	}
	if ( $_POST[seer_BOUNCEBACKTIME] != '' ) {
		$seer_BOUNCEBACKTIME = $_POST['seer_BOUNCEBACKTIME'];
	} else {
		/* use default */
	}

	/* PULL IN TRAFFIC COP VARIABLES */
	if ( $_GET[seer_TRAFFIC_COP_OPTION] != '' ) {
		$seer_TRAFFIC_COP_OPTION = $_GET['seer_TRAFFIC_COP_OPTION'];
	} else {
		/* pass */
	}

}

/* MOD_OPENOPC CREATE WRITE DAEMON FILE */
/* -- CUT FROM mod_openopc_write_declared.php */
/*    AND BASTARDIZED FOR PURPOSE OF IN-STREAM WRITE */
function mod_openopc_fudge_write_daemon_event_file ($mod_openopc_GWCOMMDIR,$mod_openopc_TEMPDIR,$mod_openopc_WRITEDAEMON,$mod_openopc_JOINMYWRITE,$mod_openopc_YOURPLC,$mod_openopc_YOURLEAFERS) 
{
	/*  -- -- -- mod_openopc VARIABLES */
	/*  ------------------------------ */
	$apache_EXECUTETHISFUNCTION = "YES";
	if ( $mod_openopc_GWCOMMDIR != '' ) {
		/* this is a global option */
	} else {
		$mod_openopc_GWCOMMDIR = "UNDEFINED or INVALID";
		$apache_EXECUTETHISFUNCTION = "NO";
	}
	if ( $mod_openopc_TEMPDIR != '' ) {
		/* this is a global option */
	} else {
		$mod_openopc_TEMPDIR = "UNDEFINED or INVALID";
		$apache_EXECUTETHISFUNCTION = "NO";
	}
	if ( $mod_openopc_WRITEDAEMON != '' ) {
		/* pass */
	} else {
		$mod_openopc_WRITEDAEMON = "INVALID";
		$apache_EXECUTETHISFUNCTION = "NO";
	}
	if ( $mod_openopc_JOINMYWRITE == "YES" ) {
		/* -- -- -- -- ACCEPT PIECEMEAL LEAFERS */
		if ( $mod_openopc_YOURPLC != '' ) {
			$mod_openopc_YOURLEAFERS = $mod_openopc_YOURPLC."&".$mod_openopc_YOURLEAFERS."&|";
		} else {
			$mod_openopc_YOURPLC = "NONE";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
		/* allows us to declare the value to be written as a separate variable */
		/* its shitty but it works */
	} else {
		if ( $mod_openopc_YOURLEAFERS != '' ) {
			/* pass */
		} else {
			$mod_openopc_YOURLEAFERS = "INVALID";
			$apache_EXECUTETHISFUNCTION = "NO";
		}
	}

	/* -- -- -- PROCEED IF WE PASS THE SANITY CHECKS ABOVE */
	/* --------------------------------------------------- */
	if ( $apache_EXECUTETHISFUNCTION == "YES" ) {
		/* -- -- -- NOTE
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
		$mod_openopc_EVENTFILE_NAME = $mod_openopc_EVENTFILE_DATESTAMP."_ID-".$mod_openopc_EVENTFILE_ID1."-".$mod_openopc_EVENTFILE_ID2."_WRITEDAEMON.event";
		$mod_openopc_TEMPDAEMONFILE = $mod_openopc_TEMPDIR."/".$mod_openopc_EVENTFILE_NAME;
		$mod_openopc_FINALDAEMONFILE = $mod_openopc_GWCOMMDIR."/".$mod_openopc_WRITEDAEMON."/".$mod_openopc_EVENTFILE_NAME;
		/*   --- BUILD STRUCTURE OF OUR EVENT FILE */
		/*       --------------------------------- */
		$mod_openopc_EVENTFILE_LINE1 = "# START WRITE_DAEMON EVENT FILE FROM S.E.E.R.\n";
		$mod_openopc_EVENTFILE_LINE2 = "[your_write_type]\n";
		$mod_openopc_EVENTFILE_LINE3 = "YOURWRITETYPE:DECLARED\n";
		$mod_openopc_EVENTFILE_LINE4 = "# -- WRITE DECLARED VALUES TO OPC TARGET\n";
		$mod_openopc_EVENTFILE_LINE5 = "[your_leafers]\n";
		$mod_openopc_EVENTFILE_LINE6 = "YOURLEAFERS:".$mod_openopc_YOURLEAFERS."\n";
		$mod_openopc_EVENTFILE_LINE7 = "YOURWRITEPRESET:NONE\n";
		$mod_openopc_EVENTFILE_LINE8 = "# -- NAME OF PRESET FILE TO WRITE\n";
		$mod_openopc_EVENTFILE_LINE9 = "# END OF FILE\n";
		$mod_openopc_EVENTFILE_LINEALL = $mod_openopc_EVENTFILE_LINE1.$mod_openopc_EVENTFILE_LINE2.$mod_openopc_EVENTFILE_LINE3.$mod_openopc_EVENTFILE_LINE4.$mod_openopc_EVENTFILE_LINE5.$mod_openopc_EVENTFILE_LINE6.$mod_openopc_EVENTFILE_LINE7.$mod_openopc_EVENTFILE_LINE8.$mod_openopc_EVENTFILE_LINE9;
		/*   --- OPEN THE EVENT FILE AND WRITE TO */
		/*       -------------------------------- */
		$mod_openopc_EVENTFILE_ACTIVE = fopen($mod_openopc_TEMPDAEMONFILE, "w");
		fwrite($mod_openopc_EVENTFILE_ACTIVE, $mod_openopc_EVENTFILE_LINEALL);
		/*   --- CLOSE THE EVENT FILE AND MOVE IT FROM TEMP STORAGE TO */
		/*	   DAEMON ACTIVE DIRECTORY */
		/*       ----------------------------------------------------- */
		fclose($mod_openopc_EVENTFILE_ACTIVE);
		rename($mod_openopc_TEMPDAEMONFILE, $mod_openopc_FINALDAEMONFILE);
		sleep(1);
	} else {
		/* pass */
	}

	/* -- -- -- RETURN SUCCESS OR FAILURE STATUS */
	/* ----------------------------------------- */
	return $apache_EXECUTETHISFUNCTION;
	/* 'YES' or 'NO' */
}

?>
