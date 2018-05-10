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
DEFAULT S.E.E.R. II Theme
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is Operating System agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
/* R_E_Q_U_I_R_E_D  O_F  A_L_L  T_H_E_M_E_S ! */
/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */

/* BASIC S.E.E.R. DISPLAY SETTINGS */
/* ------------------------------------------------------------------ */
$seer_CSS_SHEET_TO_USE = "/".$apache_seer_VERSION."/plugins/themes/default/css_seer_0.css";
/*	-- CSS style sheet to use */
$seer_CSS_SHEET_TO_USE_CANVAS = "/".$apache_seer_VERSION."/plugins/themes/default/css_seer_1.css";
/*	-- CSS style sheet to use for CANVAS*/
$seer_DEFAULTBANNER = "/".$apache_seer_VERSION."/plugins/themes/default/banner_seer_0.png";
/*	-- top page banner */
$seer_DEFAULTDIVIDER = "/".$apache_seer_VERSION."/img/divider_seer_0.png";
/*	-- page section divider */
$seer_DEFAULTSUBDIVIDER = "/".$apache_seer_VERSION."/img/divider_seer_1.png";
/*	-- sub page section divider */
$seer_DEFAULTHOMELOGO = "/".$apache_seer_VERSION."/img/home_milk_glass.png";
/*	-- home page logo */
$seer_DEFAULTSETUPLOGO = "/".$apache_seer_VERSION."/img/seer_setup_image.png";
/*	-- setup logo */
$seer_DEFAULTEXPORTLOGO = "/".$apache_seer_VERSION."/img/seer_export_image.png";
/*	-- export logo */
$seer_DEFAULTTRAFFICCOPLOGO = "/".$apache_seer_VERSION."/img/seer_traffic_cop.png";
/*	-- traffic cop logo */
$seer_DEFAULTMENUITEMSUBBULLET = "/".$apache_seer_VERSION."/img/seer_menu_item_bullet.png";
/*	-- menu item sub bullet icon */
$seer_DEFAULTDBDUMPLOGO = "/".$apache_seer_VERSION."/img/seer_dbdump_image.png";
/*	-- dbdump logo */
$seer_DEFAULTW3C_1 = "/".$apache_seer_VERSION."/img/w3c_valid_html.png";
$seer_DEFAULTW3C_2 = "/".$apache_seer_VERSION."/img/w3c_valid_css.png";
/*	-- w3c tags */
$seer_DEFAULTPILOT_DATA_OFF = "/".$apache_seer_VERSION."/img/pilot_data_off_LARGE.png";
$seer_DEFAULTPILOT_DATA_WARN = "/".$apache_seer_VERSION."/img/pilot_data_warn_LARGE.png";
$seer_DEFAULTPILOT_DATA_ON = "/".$apache_seer_VERSION."/img/pilot_data_on_LARGE.png";
$seer_DEFAULTPILOT_ALARM_OFF = "/".$apache_seer_VERSION."/img/pilot_fault_off_LARGE.png";
$seer_DEFAULTPILOT_ALARM_WARN = "/".$apache_seer_VERSION."/img/pilot_fault_warn_LARGE.png";
$seer_DEFAULTPILOT_ALARM_ON = "/".$apache_seer_VERSION."/img/pilot_fault_alarm_LARGE.png";
/* 	-- pilot lights indicate runtime and fault status to any user */
/*	   at all times */
$seer_USE_CUSTOM_TITLE_USE = "NO";
/*	-- use a custom title for the html header.  If set to 'YES', */
/*	   then use title defined by $seer_USE_CUTOM_TITLE_DECLARATION = "something" */
/*	-- if set to 'NO', then use default title */
$seer_USE_CUSTOM_TITLE_DECLARATION = "Some Custom Title Goes Here";

/* SECURITY CONTROL */
/* ------------------------------------------------------------------ */
$seer_SECURITY_LEVEL = "MEDIUM";
/*	-- valid options are "HIGH", "MEDIUM", "LOW" */
/*	-- preferred option is "HIGH" from an admin perspective, however */
/*	   many users will prefer the "MEDIUM" level */
/*	-- -- HIGH = originally intended mode of operation, a new user hash */
/*			key is generated with every page click or refresh, */
/*			which makes it impossible for a user to be logged in */
/*			from more than one location or with more than one */
/*			instance.  The browser 'back' button results in an */
/*			immediate log-out; and the internal menu is the only */
/*			allowed form of navigation. If your users have modern */
/*			browsers (with tabbed browsing), then this may be */
/*			perfect for you. */
/*	-- -- MEDIUM = fallback mode of operation, a new user hash key is */
/*			generated each time a user logs in.  Allows a user */
/*			to be logged in from one location only, but will allow */
/*			that user to have multiple instances open from that one */
/*			location.  This is good for users who need to view */
/*			multiple pages or displays at the same time from one */
/*			terminal, users who do not have tabbed browsing and */
/*			inadvertantly keep pressing the browser 'back' button */
/*			after they've accidently navigated away from SEER. */
/*	-- -- LOW = no real-time security checks.  The user's hash key is */
/*			ignored completely, and not re-generated.  The user's */
/*			identity is only confirmed by their plain-text login, */
/*			and a user can log in as many times as they want (which */
/*			means both multiple instances and logins from multiple */
/*			locations simultaneously).  Also, simply expressing any */
/*			valid username on the address line, without ever supplying */
/*			a password, will get you in... in short, DO NOT USE THIS */
/*			SECURITY LEVEL UNLESS YOU ARE DEBUGGING. */

/* GENERAL CONTACT INSTRUCTIONS */
/* ------------------------------------------------------------------ */
$seer_GENERALINSTRUCTIONS = "Questions or concerns should be directed through the IT support group. 
					Questions related specifically to S.E.E.R. may be directed
					through one of the personnel listed above.  Your questions
					will be addressed in a timely manner.";

/* EMERGENCY CONTACT INSTRUCTIONS */
/* ------------------------------------------------------------------ */
$seer_EMERGENCYINSTRUCTIONS = "In the event of an emergency (system outage, etc.), 
					please contact one of the above listed personnel as 
					soon as possible.";

/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */
/* O_P_T_I_O_N_A_L  A_R_G_U_M_E_N_T_S ! */
/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */

/* -- Here you may insert any variable from the globaloptions_seer_0
      file.  Your choices here will OVERRIDE those in the globaloptions
      file, effectively giving you thematic carte-blanche.
*/

?>
