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
SYSTEM HEADER
---------------------------------------------------------------------
*/

/* HANDLING VARIABLES SWAPPED ACROSS PAGES */
/* ------------------------------------------------------------------ */
/*   --- S.E.E.R. VARIABLES */
/*       ------------------ */
if ( $_POST[seer_REFERRINGPAGE] != '' ) {
	$seer_REFERRINGPAGE = $_POST['seer_REFERRINGPAGE'].$seer_REFERRINGPAGE_ADDKEYINFO;
} else {
	/* use default value from global variable file */
	/* or value declared in page */
}
if ( $seer_TRAFFIC_COP_OPTION >= 0 ) {
	$seer_REFERRINGPAGE = $seer_REFERRINGPAGE.";seer_TRAFFIC_COP_OPTION=".$seer_TRAFFIC_COP_OPTION;
} else {
	/* pass */
}
if ( isset($seer_REFERRINGPAGE_APPEND) ) {
	$seer_REFERRINGPAGE = $seer_REFERRINGPAGE.$seer_REFERRINGPAGE_APPEND;
} else {
	/* pass */
}
if ( $_POST[seer_BOUNCEBACKTIME] != '' ) {
	$seer_BOUNCEBACKTIME = $_POST['seer_BOUNCEBACKTIME'];
} else {
	/* use default value from global variable file */
	/* or value declared in page */
}

/* DELETE THE REMFILE FROM PREVIOUS OPERATION IF NECESSARY */
/* -- STRAGGLERS WILL BE KILLED BY WEEKLY DIRECTORY CLEANUP */
/* ------------------------------------------------------------------ */
if ( $_GET[seer_REMFILE] != '' ) {
	$seer_REMFILE = $_GET['seer_REMFILE'];
} else {
	$seer_REMFILE = "NONE";	
}

if ( $seer_REMFILE != "NONE" ) {
	unlink($seer_REMFILE);
} else {
	/* pass */
}

/* HTML SPEC DOCUMENT TYPE DECLARATION */
/* ------------------------------------------------------------------ */
$apache_DOCTYPE = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
            \"http://www.w3.org/TR/html4/loose.dtd\">

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	<!-- LICENSE - FAIR USE - AND WHAT THE DEAL IS... -->
	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	<!-- SEER (INCL. WARRIOR) AND mod_openopc (ALONG WITH ITS MODULES) ARE FREE (AS IN FREEDOM AND BEER) SOFTWARE, LICENSED UNDER THE GNU GENERAL PUBLIC LICENSE (V3), -->
	<!-- AND THE GNU AFFERO GENERAL PUBLIC LICENSE (AGPL V3).  VARIOUS PORTIONS CARRY OTHER FREE LICENSES, INCLUDING THE LANGUAGE FILES, MOST OF WHICH ARE CREATIVE COMMONS -->
	<!-- LICENSES (ALL FREE). -->
	<!-- IF YOU PAID FOR SEER (INCL. WARRIOR) OR mod_openopc (OR ITS MODULES) YOU HAVE BEEN THE VICTIM OF A CRIME, AND SHOULD CONTACT THE FOLLOWING... -->
	<!-- A, YOUR LOCAL LAW ENFORCEMENT AGENCY -->
	<!-- B, PROCURE LEGAL COUNSEL TO REGAIN ANY MONIES USED IN THE PURCHASE -->
	<!-- C, LET US KNOW UPSTREAM AT http://spinellicreations.com, http://www.sorrentolactalis.com AND http://www.harperintl.com -->

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	<!-- HTML 4.01 TRANSITIONAL, AMERICAN ENGLISH CODED -->
	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	<HTML>
	";
/* -- -- SEE NOTE ON BUGFIX BELOW - DO NOT REMOVE ESCAPED DOUBLE QUOTE */

/* GLOBAL INTERFACE TITLE */
/* ------------------------------------------------------------------ */
/* -- SADLY THE REALLY 'COOL' TITLES ARE ABANDONED AS OF 2010_0108 */
/*    IN WHAT I CAN ONLY DESCRIBE AS AN ATTEMPT TO LOOK 'POLITE', CEST LA VIE */
/*    BUT ALAS, THEY MAY LIVE AGAIN ONE DAY... EDIT GLOBAL OPTIONS FOR 'MEAN' */
/*    TITLE PLACEMENT */

if ( $seer_USE_CUSTOM_TITLE_USE == 'YES' ) {
	/* CUSTOM TITLE USE */
	$apache_TITLE = "
		<TITLE>
			".$seer_USE_CUSTOM_TITLE_DECLARATION."
		</TITLE>
		";

} else {
	/* DEFAULT TITLE */
	$apache_TITLE = "
		<TITLE>
			-= S.E.E.R. =- ".$multilang_STATIC_121."
		</TITLE>
		";
}

/* TRAFFIC COP IMPLEMENTATION */
/* ------------------------------------------------------------------ */
if ( $seer_TRAFFIC_COP_ACTIVE == 'YES' ) {
	$apache_PAGETYPE = "DYNAMIC";
	$seer_BOUNCEBACKTIME = 1;
	$seer_REFERRINGPAGE = $seer_TRAFFIC_COP_DESTINATION;
} else {
	/* pass */
}

/* DOCUMENT HEAD */
/* ------------------------------------------------------------------ */
/* 	-- apache_PAGETYPE decides whether we will auto refresh or not  */

/* -- -- SEE NOTE ON BUGFIX BELOW - DO NOT REMOVE ESCAPED DOUBLE QUOTE FOR META DATA */
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sun, 01 Jan 1990 01:00:00 GMT");
$apache_HEADER = "
	<!-- XXXXXXXXXXXXX -->
	<!-- DOCUMENT HEAD -->
	<!-- XXXXXXXXXXXXX -->

	<HEAD>
		".$apache_TITLE."
		<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; CHARSET=UTF-8\"> 
		<META NAME=\"robots\" CONTENT=\"all\">
		";
if ( $apache_PAGETYPE == "DYNAMIC" ) {
	/* EXAMINE REFERRINGPAGE AND SANITIZE AS NEEDED */
	if (substr($seer_REFERRINGPAGE, 0, 1) === ".") {
		/* RELATIVE PATH (w/ respect to SERVER) */
		$seer_REFERRINGPAGE_TO_USE_IN_REFRESH = $apache_URIROOT.substr($seer_REFERRINGPAGE, 1);
	} else {
		if (substr($seer_REFERRINGPAGE, 0, 1) === "/") {
			/* ABSOLUTE PATH (w/ respect to SERVER) */
			$seer_REFERRINGPAGE_TO_USE_IN_REFRESH = $apache_URIROOT.$seer_REFERRINGPAGE;
		} else {
			/* OTHER PATH OR TRUE URI, NOT TO BE FIDDLED WITH */
			$seer_REFERRINGPAGE_TO_USE_IN_REFRESH = $seer_REFERRINGPAGE;
		}
	}

	if ( $apache_FALLBACK_TO_DEPRECATED_META_REFRESH != "YES" ) {
		/* UTILIZE NEWER SEMI-STANDARDIZED php header 'refresh' INSTRUCTION */
		/* -- condition = 'NO' or 'GRACEFUL' */
		header("Refresh: $seer_BOUNCEBACKTIME; url=\"$seer_REFERRINGPAGE_TO_USE_IN_REFRESH\"");
	} else {
		/* pass */
	}
	if ( $apache_FALLBACK_TO_DEPRECATED_META_REFRESH != "NO" ) {
		/* UTILIZE OLD AND DEPRECATED META REFRESH DUE TO MSIE-6 NOT PICKING */
		/*   UP ON THE php header 'refresh' INSTRUCTION */
		/* -- condition = 'YES' or 'GRACEFUL' */
		if ( $apache_FALLBACK_TO_DEPRECATED_META_REFRESH == "GRACEFUL" ) {
			/* ADD 1 SECOND TO BOUNCEBACK TIME IN ORDER TO ENSURE FUNCTIONALITY */
			/*   WHEN USING BOTH REFRESH METHODS. */
			/* -- condition = 'GRACEFUL' */
			$seer_BOUNCEBACKTIME_META_REFRESH_ONLY = $seer_BOUNCEBACKTIME + 1;
		} else {
			$seer_BOUNCEBACKTIME_META_REFRESH_ONLY = $seer_BOUNCEBACKTIME;
		}
		$apache_HEADER = $apache_HEADER."
		<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"".$seer_BOUNCEBACKTIME_META_REFRESH_ONLY.";URL='".$seer_REFERRINGPAGE_TO_USE_IN_REFRESH."'\">
		";
	} else {
		/* pass */
	}
} else {
	/* pass */
}
$apache_HEADER = $apache_HEADER."
		<LINK REL=\"shortcut icon\" HREF=\"http://".$apache_SERVER_NAME_OR_IP."/".$apache_seer_VERSION."/favicon.ico\" TYPE=\"image/vnd.microsoft.icon\">
		";
if ($seer_enable_CANVAS == 'NO') {
	$apache_HEADER = $apache_HEADER."
		<LINK REL=\"stylesheet\" TYPE=\"text/css\" HREF=\"http://".$apache_SERVER_NAME_OR_IP.$seer_CSS_SHEET_TO_USE."\">
		";
	/* -- standard CSS sheet */
} else {
	$apache_HEADER = $apache_HEADER."
		<LINK REL=\"stylesheet\" TYPE=\"text/css\" HREF=\"http://".$apache_SERVER_NAME_OR_IP.$seer_CSS_SHEET_TO_USE_CANVAS."\">
		";
	/* -- CANVAS friendly CSS sheet */
}

/* -- ALLOW CSS INJECTION */
/* -- -- MODIFIES (TYPICALLY APPENDS, BUT CAN ALSO REPLACE) EXISTING STYLE SHEET ELEMENTS */
if ($seer_CSS_INJECTION != '') {
	$apache_HEADER = $apache_HEADER."
		<STYLE TYPE=\"text/css\">
		".$seer_CSS_INJECTION."
		</STYLE>
		";
} else {
	/* pass */
}

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
/* -- -- SEE NOTE ON BUGFIX BELOW - DO NOT REMOVE ESCAPED DOUBLE QUOTE FOR TARGET URL */

	/* WTF HAPPENED TO MY GODDAMN URI'S ?!? */
	/* NOTE - THIS IS A BUGFIX */
	/* ------------------------------------ */
	/*    */
	/* -- We should have been able to use single hashes for a lot of things in the above */
	/*    50 lines or so, however, the DTD was being 'randomly' rejected or not found by */
	/*    validator, so we escaped that and used a double quote to fix it.  As far as the */
	/*    auto-refresh goes, Opera 10 rev 5 and up have problems with taking a single quoted */
	/*    php header refresh / redirect command if it has anything but the expected "&" for */
	/*    subsequent inline variables.  We moved to ";" in order to pass the validator, and it */
	/*    took a while to figure out why we suddenly weren't working with Opera... long story */
	/*    short, the escaped double quotes around the header redirect / refresh solves the problem. */
	/*    */
	/* -- Why this is the case?  I've no idea.  Older builds of SEER used a META refresh */
	/*    as opposed to a php header declaration.  Something got lost in the translation, */
	/*    so to speak. */
	/*    */
	/* -- As of writing this note, the current method uses both a php header refresh (supported */
	/*    on newer browsers, but non-standard tag) in conjunction with a META refresh (time is */
	/*    refresh + 1 second, so if it misses the header method, it'll pick up via META refresh) */
	/*    This can be set to php header refresh, meta refresh, or BOTH (gracefully degrades), by */
	/*    editing $apache_FALLBACK_TO_DEPRECATED_META_REFRESH in the SEER advanced_options_0 file. */
	/*    */
	/*	- Vince 11/30/2010 */

/* DOCUMENT BODY SHELL TOP */
/* ------------------------------------------------------------------ */
$apache_BODYSHELLTOP = "
	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	<!-- DOCUMENT BODY (AKA - REPORT BODY) -->
	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

	<BODY>

		<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
		<!-- SOME CSS AUTO-MAGIC CENTERS CONTENT (BOUNDED LATER) IN USER'S WINDOW -->
		<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

		<DIV ID='CONTAINER_SHELL'>
			<DIV ID='CONTAINER'>
	";

/* CHECK FOR UN-ACKNOWLEDGED SYSTEM FAULTS (mod_openopc) */
/* ------------------------------------------------------------------ */
mod_openopc_status_check();

/* PAGE BANNER */
/* ------------------------------------------------------------------ */
$apache_PAGEBANNER = "
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				<!-- PAGE BANNER WITH LOGO, STATUS LIGHT(S), AND ALL THAT GOOD STUFF -->
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

				<TABLE ALIGN='CENTER' CLASS='MENU' WIDTH='875'>
					<TR>
						<TD>
							<P CLASS='BANNER'>
							";

if ( $seer_PILOT_DATA_DISPLAY_ONLY == 'YES' ) {
		$apache_PAGEBANNER = $apache_PAGEBANNER."
								<A HREF='/".$apache_seer_VERSION."/mod_openopc_system_faults.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG STYLE='border:0' WIDTH='60' SRC='".$seer_PILOT_DATA."' ALT='data'></A><IMG SRC='/".$apache_seer_VERSION."/img/clearspace_20px.png' WIDTH='20' ALT='space'>
								";
		$apache_PAGEBANNER_DEFAULTBANNER_WIDTH = 760;
} else {
		$apache_PAGEBANNER = $apache_PAGEBANNER."
								<A HREF='/".$apache_seer_VERSION."/mod_openopc_system_faults.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG STYLE='border:0' WIDTH='60' SRC='".$seer_PILOT_DATA."' ALT='data'><IMG STYLE='border:0' WIDTH='60' SRC='".$seer_PILOT_ALARM."' ALT='alarm'></A><IMG SRC='/".$apache_seer_VERSION."/img/clearspace_20px.png' ALT='space'>
								";
		$apache_PAGEBANNER_DEFAULTBANNER_WIDTH = 700;
}		

if ( $seer_SECURITY_LEVEL != 'HIGH' ) {
	$RANDOM_NEW_WINDOW = rand(0,9999);
	$RANDOM_NEW_WINDOW = "random_new_win_".$RANDOM_NEW_WINDOW;
	$apache_PAGEBANNER = $apache_PAGEBANNER."
								<A HREF='".$seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION."/seer_login.php".$seer_REFERRINGPAGE_ADDKEYINFO."' TARGET='".$RANDOM_NEW_WINDOW."'><IMG STYLE='border:0' WIDTH='".$apache_PAGEBANNER_DEFAULTBANNER_WIDTH."' SRC='".$seer_DEFAULTBANNER."' ALT='banner'></A>
								";
} else {
	$apache_PAGEBANNER = $apache_PAGEBANNER."
								<IMG SRC='".$seer_DEFAULTBANNER."' WIDTH='".$apache_PAGEBANNER_DEFAULTBANNER_WIDTH."' ALT='banner'>
								";
}

$apache_PAGEBANNER = $apache_PAGEBANNER."
						    		<BR>
						    		<IMG SRC='".$seer_DEFAULTDIVIDER."' WIDTH='875' ALT='divider'>
							</P>
						</TD>
					</TR>
				</TABLE>

				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				";

/* EXPORT TO HTML */
/* ------------------------------------------------------------------ */
echo $apache_DOCTYPE;
echo $apache_HEADER;
echo $apache_BODYSHELLTOP;
echo $apache_PAGEBANNER;

/* INCLUDE THE TOP MENU (S.E.E.R. BUILTIN) */
/* ------------------------------------------------------------------ */
if ($seer_enable_CANVAS == 'NO') {
	seer_menu_0();
	seer_language_bar();
} else {
	/* pass */
}
seer_display_user_status();

?>
