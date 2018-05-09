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
S.E.E.R. LANGUAGE FILE
-- ENGLISH 
-- LAST MODIFIED 2010_1129
-- ALL LANGUAGE FILES SHOULD BE CURRENT AS OF THIS DATE!
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

/* S.E.E.R. LANGUAGE ENTRIES */
/* ------------------------------------------------------------------ */

/* RULES FOR MAKING AND EDITING LANGUAGE FILES */
/* ------------------------------------------------------------------ 	
	Unless otherwise noted, the ENGLISH language file is to be considered the 'Master Copy'
	upon which all other language files are to be based.

	-- If creating a NEW language file, then the file must be named...
		multilang_file_[LANGUAGE].php (located in the /seer_2/language folder)
	   Edit the /config/globaloptions_seer_0.php file to reflect the addition
	        of another available language.
	-- If editing an existing language file, or converting text for a language
		file, then all VARIABLES should be copied from the ENGLISH file, and
		defined appropriately in the OTHER language file(s).
	-- Observe case-sensitivity.
		-- -- If a variable is defined with uppercase-letters in ENGLISH, then
		      it should be defined with uppercase-letters in the translation.
		-- -- Example 1:
			$multilang_STATIC_0 = "Welcome";    (in ENGLISH)
			$multilang_STATIC_0 = "Bienvenido"; (in SPANISH)
		-- -- Example 2:
			$multilang_STATIC_HOURS = "HOURS";	(in ENGLISH)
			$multilang_STATIC_HOURS = "HORAS";	(in SPANISH)
		-- -- Failure to comply with case-sensitivity will result in skewed
		      otherwise odd-looking display behavior (where certain tags 
		      appear out of place).
	-- Observe special characters.
		-- -- If a variable is defined with "_" or "-" or "..." or another other
		      special characters, then they should be included in the
		      translation.
	-- Observe punctuation and capitalization.
		-- -- Some variables are sentences, which may or may-not start with a 
		      capital letter and may or may-not end with a period.  Whichever
		      is the case, carry it over with the translation.
	-- Observe character limits.
		-- -- Some variables are labeled with a limit on character number.  This
		      is because those variables have only a limited space within which
		      to be displayed.  A good example of this is the MENU tags, most of
		      which are limited to 21 characters.  Each is labeled as such.  If
		      you must abbreviate in the translation in order to preserve the
		      character limit, then do so.

	-- Use common sense.
		-- -- Some variables are abbreciations, such as "Temp" for "Temperature", or
		      "MPH" for "Miles per Hour".  Should you come across such a variable,
		      then we ask that you translate the phrase, and then provide an 
		      appropriate abbreviation in the translated language.
		-- -- Try to preserve roughly the same string length for variables.
		      Obviously, for longer sentences or paragraphs, this does not matter at
		      all.  However, tags, flags, and other "one or two word" variables should
		      be replaced with AS SHORT OF A TRANSLATION AS POSSIBLE.  For example,
		      	$multilang_STATIC_2 = "What is It?";	(ENGLISH)
			..., should not be replaced with a 10 word string unless absolutely
			necessary.
	-- Off limits.
		-- -- Any variable that is defined as another variable should not be edited
		      unless you intend to modify the program.  The purpose of these variables
		      acting redundantly is to allow portions of pages to be modified later
		      without major reconstruction if necessary.  That being said, these
		      variables are identified as...
			$master_variable = "SOMETHING";
			$slave_variable = $master variable;
					-- do not edit unless modifying program.
		-- -- DO NOT create additional slave variables, or link any variable
		      to another variable unless it has been done so already in the
		      ENGLISH version (master copy).
   ------------------------------------------------------------------ */

/*	-- STATIC PAGES */
/*	--------------- */
$multilang_STATIC_0 = "Welcome";
$multilang_STATIC_1 = "About";
$multilang_STATIC_2 = "What is It?";
$multilang_STATIC_3 = "is a full featured Human Machine Interface (HMI), with all the features of a modern Supervisory Control and Data Acquisition (SCADA) system, and raises the bar by integrating Report Generation.";
/*			-- to be read as... 'S.E.E.R. is a full featured... etc etc...' */
$multilang_STATIC_4 = "For all intents and purposes, S.E.E.R. is an interface for mod_openopc (the engine behind all live machine OPC communication, data logging, and machine instructions). In most cases, it offers all the features of other expensive, non-cross-platform compatible competitors... S.E.E.R. is all about YOU and YOUR PLANT (or application).";
$multilang_STATIC_5 = "Compatability for Users";
$multilang_STATIC_6 = "We realize that while you may be able to acquire or build a great server, many of your users may have antequated computers with which to login and use the system.  No problem, we've made S.E.E.R. compliant with HTML DTD specification 4.01 Transitional... so it will run on any computer that can open up a standards compliant web-browser.  No plugins, no Java applets, no obscure third party extensions to download.  All work is done server side, and the results displayed as pure HTML.  This means that any person on any operating system can view S.E.E.R.  And, since each browser session is a unique thread over a shared host, an unlimited number of users can simultaneously connect to and use S.E.E.R. ... you can forget about 'client access licenses'.";
$multilang_STATIC_7 = "Open Source for Open Standards";
$multilang_STATIC_8 = "Here's the best part.  S.E.E.R. is built directly for mod_openopc, based upon prior work by the project's main author.  mod_openopc is based upon the fantastic work of Barry Barnreiter for the OpenOPC project.  These three individual tools share a common goal, common hertiage, and common philosophy...";
$multilang_STATIC_9 = "They're all Open Source Projects, licensed under the GNU GPL in one form or another.";
$multilang_STATIC_10 = "What this means is the source code is completely available to you.  So, you can use it as it is, modify it, or do anything else that is necessary in order to make your particular application work!";
$multilang_STATIC_11 = "Server Platforms";
$multilang_STATIC_12 = "mod_openopc is written in pure Python, a cross platform language, and allows you to gather an unlimited number of data points from an unlimited number of OPC connected devices.  Connect to any version 1 / 2 / or 3 OPC Server (such as RSLinx, Kepware, Matrikon, InGear, etc...) with mod_openopc and begin pulling all the machine data you could ever dream of into nice tidy Sun Microsystems MySQL databases, which are then accessible in any way you like (we have simply chosen S.E.E.R. as one way to access that database).";
$multilang_STATIC_13 = "Ultimate Customization";
$multilang_STATIC_14 = "If you're willing to work with PHP (for setting up your custom reports and HMI's for your machines), then S.E.E.R. and mod_openopc can provide you with full plant supervisory control and logging at the fingertips of anyone with a web-browser.";
$multilang_STATIC_15 = "Powered by Penguins";
$multilang_STATIC_16 = "S.E.E.R. is Unix friendly. In fact, S.E.E.R. and mod_openopc were originally developed on Fedora Core Linux (version 8), and later modified to be Windows compatible.  That said, the performance of Apache, PHP, MySQL, and Python under Unices completely eclipses that under Windows.  However, if you are not comfortable moving to a Unix platform, be assured, Win32/64 compatability is included.";
$multilang_STATIC_17 = "Latest News";
$multilang_STATIC_18 = "For more information or news on mod_openopc and S.E.E.R., visit the project page at...";
$multilang_STATIC_19 = "Copyright and License";
$multilang_STATIC_20 = "Free in all Aspects";
$multilang_STATIC_21 = "S.E.E.R. and mod_openopc are FREE software.  If you paid for either, then you are the victim of a crime.  While anyone, anywhere, may (and should) charge a fee for support, troubleshooting, installation, or other technical advice regarding S.E.E.R. or mod_openopc, all persons and entities are PROHIBITED FROM CHARGING A FEE FOR THE SOURCE CODE.";
$multilang_STATIC_22 = "Copyright";
$multilang_STATIC_23 = "License";
$multilang_STATIC_24 = "You may view a copy of that license and its terms here...";
$multilang_STATIC_25 = "Application Documentation";
$multilang_STATIC_26 = "S.E.E.R. Documents";
$multilang_STATIC_27 = "mod_openopc Documents";
$multilang_STATIC_28 = "All system documentation is written in English, which is the same language as all system source code.  We apologize for any inconvenience.";
$multilang_STATIC_29 = "File Export";
$multilang_STATIC_30 = "There was an error while generating the export file.  The content was not specified.";
$multilang_STATIC_31 = "We suggest";
/*			-- to be read as... 'We suggest this fine wine... */
$multilang_STATIC_32 = "for all of your Office needs";
/*			-- to be read as... 'This stapler is for all of your office needs' */
$multilang_STATIC_33 = "Your export file is now available for download...";
$multilang_STATIC_34 = "Simply RIGHT CLICK on the file and select:";
$multilang_STATIC_35 = "SAVE AS to retrieve the file.";
$multilang_STATIC_36 = "Traffic Cop";
/*			-- to be read as... 'Automatic Redirect' or 'Session Handler' */
$multilang_STATIC_37 = "Redirecting to your target...";
/*			-- to be read as... 'Redirecting [you] to your target [desired destination]'... */
$multilang_STATIC_38 = "User Login";
/*			-- to be read as... 'User Login' or 'User Sign On' */
$multilang_STATIC_39 = "Successful Login...";
/*			-- to be read as... 'Successful Login...' or 'Successfully Signed On...' */
$multilang_STATIC_40 = "Failed Login...";
/*			-- to be read as... 'Failed Login...' or 'Failed to Sign On...' */
$multilang_STATIC_41 = "Proceed using the menu at top or bottom.";
$multilang_STATIC_42 = "Please try again. Remember, all usernames and passwords are case sensitive!";
$multilang_STATIC_43 = "We are sorry.  Someone is already logged in from this terminal.";
$multilang_STATIC_44 = "Please LOGOUT before attempting to LOGIN again.";
$multilang_STATIC_45 = "The active user's contact information is...";
$multilang_STATIC_46 = "username:";
/*			-- prompt for login */
$multilang_STATIC_47 = "password:";
/* 			-- prompt for login */
$multilang_STATIC_48 = "If you do not have a username or password, then please contact a system administrator for assistance.";
$multilang_STATIC_49 = "User Logout";
$multilang_STATIC_50 = "User is active or logged in...";
$multilang_STATIC_51 = "Goodbye.";
$multilang_STATIC_52 = "Machine Control and Live Status";
$multilang_STATIC_53 = "Reporting and Summaries";
$multilang_STATIC_54 = "Help and Support Contact";
$multilang_STATIC_55 = "Administrators";
$multilang_STATIC_56 = "General Contact Instructions";
$multilang_STATIC_57 = "Emergency Contact Instructions";
$multilang_STATIC_58 = "Frequently Asked Questions";
$multilang_STATIC_59 = "Backbone System Faults";
$multilang_STATIC_60 = "live at";
/*			-- to be read as 'live at [time]' */
$multilang_STATIC_61 = "Congratulations!";
$multilang_STATIC_62 = "There were 0 (ZERO) faults recorded over the time period you requested.";
$multilang_STATIC_63 = "Datestamp";
$multilang_STATIC_64 = "Fault";
$multilang_STATIC_65 = "Executing";
$multilang_STATIC_66 = "OPC Server";
$multilang_STATIC_67 = "Cleared By";
$multilang_STATIC_68 = "There are currently 0 (ZERO) active faults.  The backbone should be operating normally.";
$multilang_STATIC_69 = "Software Archive";
$multilang_STATIC_70 = "Files found matching your search criteria upon the server.  They are listed below for your review...";
$multilang_STATIC_71 = "NO files were found matching your search criteria upon the server.";
$multilang_STATIC_72 = "Your file search attempt resulted in the following...";
$multilang_STATIC_73 = "Your file upload attempt resulted in the following...";
$multilang_STATIC_74 = "Welcome to the Software Archive.  Here you will find a repository of what is to be considered Mission Critical Backups of HMI, PLC, and other controller logic.  Also, you'll find the backbone software necessary to manipulate and run said programs.";
$multilang_STATIC_75 = "As always, be advised that use of these files is strictly prohibited outside the scope of (and possibly location of) your place of business.  Access to these files is intentionally restricted to Maintenance or Skilled Trades Personnel, for just that reason.  Any software requiring a license key should be installed and [or] used only in accordance with that keying policy.";
$multilang_STATIC_76 = "You may browse by BACKBONE SOFTWARE (operating systems, authoring tools, etc...) or by RUNTIME SOFTWARE (live-to-run controller software).";
$multilang_STATIC_77 = "Lastly, when uploading new files, please choose which category they should be placed in, and OBSERVE THE NAMING CONVENTION.  If you cannot unpack or pack tar files (similar to 'zip' files), the 7-zip freeware utility is included for Windows and Unix.  Maximum web-uploaded-file-size is 50 MB.";
$multilang_STATIC_78 = "Naming Convention";
$multilang_STATIC_79 = "TYPE";
$multilang_STATIC_80 = "CATEGORY";
$multilang_STATIC_81 = "VENDOR-or-MANUFACTURER";
$multilang_STATIC_82 = "NAME";
$multilang_STATIC_83 = "VERSION";
$multilang_STATIC_84 = "DATE-UPLOADED";
$multilang_STATIC_85 = "EXTENSION";
/*			-- to be read as... '[FILE] EXTENSION' */
$multilang_STATIC_86 = "for RUNTIME software, replace 'VENDOR-or-MANUFACTURER' with 'PLANT' or 'LOCATION'";
$multilang_STATIC_87 = "for example...";
$multilang_STATIC_88 = "or";
/*			-- to be read as... '[OPTION A] or [OPTION B]' */
$multilang_STATIC_89 = "File Browse and Search Dialogue";
$multilang_STATIC_90 = "Criteria of FILE on Server...";
$multilang_STATIC_91 = "enter all known fields, leave unknown as default or blank";
$multilang_STATIC_92 = "UPLOADED-BY";
$multilang_STATIC_93 = "Execute FILE Search on Server";
$multilang_STATIC_94 = "ANY";
$multilang_STATIC_95 = "Select FILE for Upload";
$multilang_STATIC_96 = "Name FILE on Server";
$multilang_STATIC_97 = "Upload FILE to Server";
$multilang_STATIC_98 = "Technical Manuals and Documents";
$multilang_STATIC_99 = "Welcome to the Technical Archive.  Here you will find a repository of what is to be considered Mission Critical Backups of Hardware and Software Documentation, covering Mechical and Electrical Devices.";
$multilang_STATIC_100 = "You may browse by 'MECHANICAL', 'ELECTRICAL', CHEMICAL' or 'OTHER'.";
$multilang_STATIC_101 = "File Upload Dialogue";
$multilang_STATIC_102 = "If you would like to try again, click here...";
$multilang_STATIC_103 = "Settings: Add Users";
$multilang_STATIC_104 = "If you would like to add another user, click here...";
$multilang_STATIC_105 = "This user was successfully added to the ACCESS table.";
$multilang_STATIC_106 = "Settings: Remove Users";
$multilang_STATIC_107 = "The USER or GROUP removal you requested was successfully performed. Please review the list below, again, to ensure that you've achieved the desired result.";
$multilang_STATIC_108 = "Be advised that you cannot remove a user who has an ACCESS LEVEL higher than your own.";
$multilang_STATIC_109 = "Be advised that you cannot modify a user who has an ACCESS LEVEL higher than your own.";
$multilang_STATIC_110 = "Training Portal Kiosk";
$multilang_STATIC_111 = "If your upload was successful, be sure to WRITE DOWN the name of the file as it appears here on the screen.  You will need it later to link the file to your course project page within the Wiki.";
$multilang_STATIC_112 = "LINKABLE FILE NAME";
$multilang_STATIC_113 = "This is the Training Portal Kiosk. From here you may enter the Training Portal, or upload data to the Training Reporsitory (requires ADMINISTRATOR or SUPER USER level Access).";
$multilang_STATIC_114 = "Settings: System and Users";
$multilang_STATIC_115 = "Logged in as";
/*                      -- to be read as... 'Logged in as [username]' */
$multilang_STATIC_116 = "Development Platform";
$multilang_STATIC_117 = "Production Server";
$multilang_STATIC_118 = "No user is active at this terminal.";
$multilang_STATIC_119 = "Welcome to...";
/*                      -- to be read as... 'Welcome to... [some place]' */
$multilang_STATIC_120 = "Please LOGIN first; using the button at the top right. Then, use the menu bar, above, to navigate to your destination. If you have any problems, feel free to use the HELP and SUPPORT link, below.";
$multilang_STATIC_121 = "the OPC Power Tool";
$multilang_STATIC_122 = "Settings: Modify Users";
$multilang_STATIC_123 = "Last Activity";
$multilang_STATIC_124 = "WEB-GUEST";
/*			-- to be read as... '[No user is logged in, so you have the default name] 'WEB-GUEST''. */
$multilang_STATIC_125 = "Server Health";
$multilang_STATIC_126 = "SYSINFO";
/*			-- to be read as... '[abbreviation for] System Information' */
$multilang_STATIC_127 = "modified and integrated into S.E.E.R.";
/*			-- to be read as... '[something was] modified and integrated into S.E.E.R.' */
$multilang_STATIC_128 = "Copyright";
/*			-- to be read as... '[something is] Copyright [years]' */
$multilang_STATIC_129 = "Exclusive License";
/*			-- to be interpreted as "there is only one license" */

/*	-- FAQ */
/*	------ */
$multilang_FAQ_1Q = "After I've updated a value or pressed a button, it seems like it takes a minute to show up on my screen.  Why is it so slow?";
$multilang_FAQ_1A = "Actually, your update or command was immediately sent to the machine.  However, data is gathered every 'X' seconds (10, 30, 60, or whichever seconds).  So you will not actually 'see' the result until the next batch of data has been gathered and your page automatically refreshes.";
$multilang_FAQ_2Q = "My display appears a little bit 'off' in Microsoft Internet Explorer 6, or sometimes it just doesn't work right.  Why?";
$multilang_FAQ_2A_11 = "S.E.E.R. was developed for stanards compliant browsers conforming to HTML DTD Specification 4.01 Transitional.  This is an open standard that is cross-platform compatible (works on any operating system).  Sadly, MS IE-6 is not standards compliant.  We recommend that you use S.E.E.R. with a robust and full featured browser such as";
$multilang_FAQ_2A_12 = "If you absolutely must use a non-standards compliant browser, such as MS IE, then, in the least, please upgrade to MS IE version 8, which, while still not ideal, performs much better than earlier versions of IE.";
$multilang_FAQ_2A_21 = "S.E.E.R. has been tested and proven against";
$multilang_FAQ_2A_22 = "Apple Safari v.3 and 4 [Excellent]";
$multilang_FAQ_2A_23 = "Konqueror v.3.5.x [Excellent]";
$multilang_FAQ_2A_24 = "Opera v.10 [Good]";
$multilang_FAQ_2A_25 = "Mozilla Firefox v.3.0.x [Excellent - Standard for Comparison]";
$multilang_FAQ_2A_26 = "Google Chrome v.4.0.249 (Beta) [Good]";
$multilang_FAQ_2A_27 = "Microsoft IE v.6 [Poor display, some reports will not display]";
$multilang_FAQ_2A_28 = "Microsoft IE v.7 & 8 [Good -(image scaling is poor)]";
$multilang_FAQ_2A_31 = "S.E.E.R. has been tested and failed against...";
$multilang_FAQ_2A_32 = "Opera v.9 and earlier [Un-viewable - browser not properly handling block level objects]";
$multilang_FAQ_2A_33 = "Microsoft IE v.5.5 [Un-viewable - lack of CSS 2 support, many other problems]";
$multilang_FAQ_3Q = "I am using Microsoft Internet Explorer 8 or greater, and all of the text input fields (user Login, manual data entry, etc...) appear as very tiny fields, with very tiny letters and numbers.  How do I fix this?";
$multilang_FAQ_3A_11 = "This is a bug / breach of compliance within MSIE.  It is attempting to apply visual styles upon form elements without having been asked to by the S.E.E.R. system.  To fix this, from inside MSIE, go to";
/*			-- read as '... go to [and then instructions to follow]' */
$multilang_FAQ_3A_12 = "TOOLS";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_13 = "INTERNET OPTIONS";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_14 = "ADVANCED";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_15 = "BROWSING";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_16 = "and ensure that ENABLE VISUAL STYLES ON BUTTONS AND CONTROLS is OFF [NOT-Checked!]";
/*			-- MSIE v8 menu item */
$multilang_FAQ_4Q = "If I upgrade my computer, will S.E.E.R. run better, faster, etc.?";
$multilang_FAQ_4A = "No.  S.E.E.R. runs 100% 'server side', which means all of the work is being done on a remote server, and not on your local computer.  All your PC is actually doing is displaying a simple web page.  This allows S.E.E.R. to effectively be used by clients on hardware as old as the Pentium II generation (circa 1995).  Typically, any computer that can run a modern web browser can effectively utilize S.E.E.R. functioniality.  Wondering how to get a modern browser onto old hardware?... Take a look at";
/*			-- last part of the statment is to read as... 'Take a look at [Damn Small Linux]'.  Link is embedded in source. */
/* 	-- FLAGS */
/*	-------- */
$multilang_STATIC_START = "START";
$multilang_STATIC_END = "END";
$multilang_STATIC_LEVEL = "LEVEL";
/*			-- to be read as '[Access] LEVEL' or 'LEVEL [of Access]' */
$multilang_STATIC_NOTE = "NOTE";
$multilang_STATIC_DENIED = "Access Denied";
$multilang_STATIC_ACCESS_SKILLED_TRADES = "RESTRICTED TO SKILLED TRADES PERSONNEL.";
$multilang_STATIC_ACCESS_ADMIN_SUPER = "RESTRICTED TO ADMINISTRATORS AND SUPER USERS.";
$multilang_STATIC_ACCESS_LEVEL_LOW = "You are not LOGGED IN or your ACCESS LEVEL is not sufficient to view this section.  If you believe this is an error, please contact your SYSTEM ADMINISTRATOR.";
$multilang_STATIC_YES = "YES";
$multilang_STATIC_NO = "NO";
$multilang_STATIC_MODEL_ID = "Model Identification";
$multilang_STATIC_REPORT = "Report";
$multilang_STATIC_HMI = "HMI";
$multilang_STATIC_NAME = "name";
$multilang_STATIC_TITLE = "title";
$multilang_STATIC_DEPT = "department";
$multilang_STATIC_EMAIL = "email";
$multilang_STATIC_PHONE = "telephone";
$multilang_STATIC_YEAR = "YEAR";
$multilang_STATIC_MONTH = "MONTH";
$multilang_STATIC_DAY = "DAY";
$multilang_STATIC_HOUR = "HOUR";
$multilang_STATIC_MINUTE = "MINUTE";
$multilang_STATIC_DATESTAMP = "Datestamp";
$multilang_STATIC_DATESTAMP_CAPS = "DATESTAMP";
$multilang_STATIC_START_OF_LOG = "Start of Log";
$multilang_STATIC_END_OF_LOG = "End of Log";
$multilang_STATIC_SELECT = "SELECT";
$multilang_STATIC_DISPLAY_REPORT_TICKET = "Display Report Ticket";
$multilang_STATIC_EXPORT_HEADER = "Export and Save Report Data";
$multilang_STATIC_EXPORT_REPORT = "Export the data from this report as a CSV file (for Office Spreadsheet use)";
$multilang_STATIC_NONE = "NONE";
$multilang_STATIC_AGGREGATE = "AGGREGATE";
$multilang_STATIC_DISCRETE = "DISCRETE";
$multilang_STATIC_SYNERGISTIC = "SYNERGISTIC";
$multilang_STATIC_SNAPSHOT_LENGTH = "Snapshot Length";
$multilang_STATIC_SNAPSHOT = "Snapshot";
$multilang_STATIC_YEARS = "YEARS";
$multilang_STATIC_MONTHS = "MONTHS";
$multilang_STATIC_DAYS = "DAYS";
$multilang_STATIC_HOURS = "HOURS";
$multilang_STATIC_MINUTES = "MINUTES";
$multilang_STATIC_RANGE = "RANGE";
$multilang_STATIC_CERTIFIED = "CERTIFIED";
$multilang_STATIC_CERTIFIED_BY = "CERTIFIED BY";
$multilang_STATIC_COMMENT = "COMMENT";
$multilang_STATIC_CERTIFIED_HIGHLIGHT = "records which require CERTIFICATION are HIGHLIGHTED.  Those which ARE CERTIFIED have been highlighted in GREEN.  Those which ARE NOT CERTIFIED have been highlighted in RED.";
$multilang_STATIC_REPORT_TICKET_FOR = "Report Ticket for";
$multilang_STATIC_AS_USER = "as user";
/*		-- to be read as... '[event XYZ -- Joe Smith -- ] as user [jsmith1]' */
/*		-- also acceptable... '[something] identified by [something else] */
$multilang_STATIC_DNE = "UNKNOWN or NO LONGER EXISTS";
$multilang_STATIC_NA = "N/A";
$multilang_STATIC_UNKNOWN = "UNKNOWN";
/*			-- to be read as... [abbreviation for] 'Not Applicable' */
$multilang_STATIC_REGULATORY = "Regulatory";
$multilang_STATIC_AUTO_SCALE_DISPLAY = "Auto-scale Report Display?";
/*			-- to be read as... 'Auto[matically] scale the Report Display' [YES OR NO] */
$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY = "Data Recorded during System Alarms Only?";
/*			-- to be read as... '[Display] Data Recorded during System Alarms Only[any alarms]?' */
$multilang_STATIC_Y_OR_N = "Y or N";
/*			-- to be read as... [abbreviation for] 'YES or NO' */
$multilang_STATIC_YES = "YES";
$multilang_STATIC_NO = "NO";
$multilang_STATIC_AUTO = "AUTO";
$multilang_STATIC_MANUAL = "MANUAL";
$multilang_STATIC_START_TIME = "Start Time";
$multilang_STATIC_START_TIME_CAPS = "START TIME";
$multilang_STATIC_END_TIME = "End Time";
$multilang_STATIC_END_TIME_CAPS = "END TIME";
$multilang_STATIC_REPORT_TIME = "be advised, this report requires a few moments to generate.  Please be patient, and do not navigate away from this page, or you will be logged out.";
$multilang_STATIC_ITEMIZED = "itemization";
$multilang_STATIC_RANK = "RANK";
$multilang_STATIC_FREQUENCY = "FREQUENCY";
$multilang_STATIC_SYNERGISTIC_PARETO = "Synergistic Pareto";
$multilang_STATIC_DISCRETE_PARETO = "Discrete Pareto";
$multilang_STATIC_DISCRETE_ITEMS = "Discrete Items";
$multilang_STATIC_SORTING_STATUS = "Sorting Status";
$multilang_STATIC_CONGRATULATIONS = "Congratulations!";
$multilang_STATIC_ITEM = "ITEM";
$multilang_STATIC_ITEM_LOWER = "Item";
$multilang_STATIC_RERUN_REPORT = "Run this Report on another Item or System over the same time period";
$multilang_STATIC_NEXT_ITEM_ID = "Next Item ID";
$multilang_STATIC_ERROR_CALL_ADMIN = "If you believe this is an error, please contact an Administrator for assistance.";
$multilang_STATIC_DATA_TICKET = "Data Ticket";
$multilang_STATIC_NO_DATA_AVAILABLE = "NO DATA AVAILABLE";
$multilang_STATIC_RECORD_MANUALLY_ADDED = "Record was Manually Added";
$multilang_STATIC_CERTIFICATION_TICKET = "Certification Ticket";
$multilang_STATIC_NUMBER_OF_RECORDS = "Number of Records";
$multilang_STATIC_SERVER = "Server";
$multilang_STATIC_DB_TABLE = "Database Table";
$multilang_STATIC_DATE_RANGE = "Date Range";
$multilang_STATIC_YOUR_USERNAME = "Your Username";
$multilang_STATIC_CURRENT_TIME = "Current Time";
$multilang_STATIC_SERVER_TIME = "Server Time";
$multilang_STATIC_CONFIRMATION_OF_TICKET = "Confirmation of Data Ticket";
$multilang_STATIC_AUTO_CERT_BY = "Automatically Certified by";
$multilang_STATIC_CERT_STAMP = "Certification Stamp";
$multilang_STATIC_CERT_COMMENT = "Certification Comment";
$multilang_STATIC_INPUT_MORE_RECORDS = "To input more records, click here.";
$multilang_STATIC_CERT_INSPECT_LIST = "You should inspect this list (or print it for your records), and be sure that all of the records that you wanted to enter have actually gone through.  The system will auto-drop (ignore) any records for which 'bad' or incomplete data bas been entered.  You can always go back and add more records, if this is the case.";
$multilang_STATIC_DISPLAY_RECORDS_FOR_CERT = "Display Records Eligible for Certification";
$multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER = "Save Data Ticket to Server";
$multilang_STATIC_ACTION_IS_PERMANENT = "this action is permanent!";
$multilang_STATIC_MAN_RECORDS_INPUT_EVERY = "Manual records must be entered at an interval (in minutes) of...";
$multilang_STATIC_MAN_RECORDS_COUNT = "Number of entries that you wish to input...";
$multilang_STATIC_ENTRIES_CAPS = "ENTRIES";
$multilang_STATIC_BUILD_DATA_TICKET = "Build a Data Ticket";
$multilang_STATIC_REVIEW_CERT = "Review of Certification Ticket";
$multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN = "records previously certified (by any user) or manually entered shall appear with a highlighted (red) background.  These records cannot be re-certified, as they are now 'locked'.  If you choose to certify a ticket where some records have been previously certified, then your certification shall only apply to those records which have NOT been previously certified (are not 'locked' / not highlighted).";
$multilang_STATIC_CERT_TIME_LIMIT = "records should be certified regularly, such as every shift.  However, you may go back as far as 2 days (48 hours) to certify older records.  By design, records older than this cannot be signed, to ensure integrity and honesty in the signature process.";
$multilang_STATIC_TICKET_COMMENT_ENTRY = "Ticket Comments";
$multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT = "select your ITEM from the drop down, then enter your START time and END time.  A modest report shall be displayed, which will auto-scale to the time period you've selected.  If you would like to see higher precision (less time between records), simply choose START and END times that are closer together.";
$multilang_STATIC_SELECT_FROM_DROPDOWN_BRIEF = "enter your START time and END time, using the drop down fields.  A summary of activity shall be displayed.";
$multilang_STATIC_SELECT_FROM_DROPDOWN = "select your ITEM from the drop down, then enter your START time and END time.  A summary shall be displayed, covering this thime period.";
$multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT = "enter your START date and time, then your desired SNAPSHOT length (duration of time from the start of the log that you wish to examine).";
$multilang_STATIC_CERT_NO_COMMENTS = "There were no COMMENTS offered for the records that have been displayed.";
$multilang_STATIC_CERT_SIGNATURE_HEADER = "Certification Signature";
$multilang_STATIC_CERT_NO_SIGS = "There were no SIGNATURES registered for the records that have been displayed.";
$multilang_STATIC_DURATION = "Duration";
$multilang_STATIC_DURATION_CAPS = "DURATION";
$multilang_STATIC_DURATION_IN_SECONDS = "DURATION in SECONDS";
$multilang_STATIC_DURATION_IN_SECONDS_SMALL = "Duration in Seconds";
$multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL = "Detail Rundown - Individual Systems or Items";
$multilang_STATIC_DETAIL_RUNDOWN_ALL = "Detail Rundown - Top Rated - All Systems or Items";
$multilang_STATIC_PARETO_FREQUENCY_ALL = "Pareto Analysis of Frequency - All Systems or Items";
$multilang_STATIC_PARETO_DURATION_ALL = "Pareto Analysis of Duration - All Systems or Items";
$multilang_STATIC_PARETO_EXPLAIN = "Pareto Analysis Plots shall display the total time incurred for each alarm or fault state, as well as frequency (one is analyzed by duration, the other by frequency).  A breakdown of the top individual faults can be seen in the Top Rated Detail Rundown, followed by a full list of alarms and faults for Individual Systems, all of which are sorted in order of longest duration (greatest impact).";
$multilang_STATIC_SORTING_STATUS_EXPLAIN = "sorting status for each associated array is indicated by 'Green' for successful or 'Red' for failed... Successful sorting is required for accurate identification of event and time.";
$multilang_STATIC_NO_FAULTS_IN_SNAPSHOT = "There were zero (0) recorded faults during the SNAPSHOT time period that you requested.";
$multilang_STATIC_EVENT = "EVENT";
$multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY = "Select whether you would like to view CURRENT or HISTORICAL Inventory Levels.  If you choose HISTORICAL, then enter your SNAPSHOT time.  All known inventory at THAT time shall be displayed.  If you choose CURRENT, then you DO NOT have to enter a SNAPSHOT time.";
$multilang_STATIC_INVENTORY_TYPE = "Inventory Type";
$multilang_STATIC_CURRENT_BLIP = "Current";
$multilang_STATIC_HISTORICAL_BLIP = "Historical";
$multilang_STATIC_DATA_WITHIN_15 = "data is accurate within 15 minutes of Ticket time.";
$multilang_STATIC_DATESTAMP_START = "DATESTAMP START";
$multilang_STATIC_DATESTAMP_END = "DATESTAMP END";
$multilang_STATIC_DST_NOT_IN_EFFECT = "Be advised, this server does NOT utilize Daylight Savings Time, or any other time-shifting means.  The time displayed is GMT [plus or minus the timezone offset of the server's deployed location].";
$multilang_STATIC_HOLD = "HOLD";
/*			-- to be read as... 'HOLD' or 'PAUSE' */
$multilang_STATIC_STEP = "JUMP STEP";
/*			-- to be read as... 'JUMP STEP' or 'SKIP STEP' */
$multilang_STATIC_LOCKOUT_CAPS = "LOCKOUT";
/*			-- to be read as... 'LOCKOUT' or 'DISABLE' */
$multilang_STATIC_DISABLES_MANUAL_FUNCTIONS = "disables manual functions";
$multilang_STATIC_FORCE_HOLD = "Force Hold";
$multilang_STATIC_RELEASE_HOLD = "Release Hold";
$multilang_STATIC_FORCE_STEP = "Force Step";
$multilang_STATIC_LOCKOUT = "Lockout";
$multilang_STATIC_RELEASE = "Release";
$multilang_STATIC_FAULTS_CAPS = "FAULTS";
$multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE = "select YES or NO for 'Auto Scale Report Display'... selecting YES will trim the report down so that it fits onto 2 or 3 pages (when printed).  The totalized data (flow total / power total / etc.) will still be correct.  Selecting NO will display every gathered record, but entails a much longer and larger report.  If you select NO, then it is highly suggested that you do not attempt a SNAPSHOT LENGTH of longer than 3 Days (72 hours).";
$multilang_STATIC_DISPLAY = "Display";
$multilang_STATIC_HIDE = "Hide";
$multilang_STATIC_SHOW_DISCRETE_ALARM_INSTANCES = "by default, Alarm instances are counted, but not individually displayed.  Choosing to display discrete Alarm instances may result in a vastly longer report.";
$multilang_STATIC_ALARMS = "Alarms";
$multilang_STATIC_HIGH_PRECISION = "High Precision";
$multilang_STATIC_EXAMINATION_WINDOW = "Examination Window";
/*		-- to be read as "examination window [of time]" */
$multilang_STATIC_PAGE_LOAD_TIME = "Page Load Time";
$multilang_STATIC_BROWSER_ENGINE = "Engine";
$multilang_STATIC_BROWSER_NAME = "Name";
$multilang_STATIC_BROWSER_VERSION = "Version";
$multilang_STATIC_THEME = "Theme";
$multilang_STATIC_PLUGINS = "Plugins";
$multilang_STATIC_EXPORT_PDF_HEADER = "Export Report as PDF File";
$multilang_STATIC_EXPORT_PDF_DESCRIPTION = "Print this report as a PDF file (for uncontrolled archival and sharing)";

/*	-- MENU */
/*	------- */

/*	-- -- SIZE LIMITED VARIABLES */
/*	---------------------------- */
/*			-- ALL VARIABLES IN THIS BLOCK ARE... 20 characters MAX */
$multilang_MENU_MACHINE_CONTROL = "Machine Control";
$multilang_MENU_REPORTING = "Reporting";
$multilang_MENU_SETTINGS = "Settings";
$multilang_MENU_LOGIN = "Login";
$multilang_MENU_LOGOUT = "Logout";
$multilang_MENU_HOME = "Home";
$multilang_MENU_APPLICATION_DOCS = "Application Doc's";
$multilang_MENU_ABOUT = "About";
$multilang_MENU_HELP = "Help and Support";
$multilang_MENU_COPYRIGHT = "Copyright & License";
$multilang_MENU_TRAINING = "Training Portal";
$multilang_MENU_TECHNICAL = "Technical Archive";
$multilang_MENU_SOFTWARE = "Software Archive";
/*			-- ALL VARIABLES IN THIS BLOCK ARE... 20 characters MAX */

/*	-- -- STANDARD VARIABLES */
/*	------------------------ */
$multilang_MENU_BACK = "Go BACK";
$multilang_MENU_POWERED_BY = "Powered By";
$multilang_MENU_BUILT_WITH = "Built With";
$multilang_MENU_FOOTER_1 = "S.E.E.R. and mod_openopc are OPEN SOURCE software for L.A.M.P.P. and *.A.M.P.P. platforms.";
$multilang_MENU_CONFIDENTIAL = "All data is Confidential";
$multilang_MENU_NO_PIRATES = "This report may not be used in whole or part without the expressed permission of";
$multilang_MENU_DATACOPYRIGHTPOLICY = "The machine, device, or equipment data (including the results of calculations and permutations based upon that data) included within this display or generated by this display are the property of the person, persons, organization, company, or entity having implemented the S.E.E.R. system.  This, of course, excludes third party data bearing its own license or copyright (for example, the S.E.E.R. system itself, manufacturer authored equipment manuals, and other such linked-to-files).";

/*	-- SETTINGS DESCRIPTIONS */
/*	------------------------ */
$multilang_SETTINGS_USERNAME = "USERNAME";
$multilang_SETTINGS_USERNAME_D = "a unique username";
$multilang_SETTINGS_REALNAME = "REALNAME";
$multilang_SETTINGS_REALNAME_D = "user's real first, then last name";
$multilang_SETTINGS_PASSWORD = "PASSWORD";
$multilang_SETTINGS_PASSWORD_D = "password for access";
$multilang_SETTINGS_PHONE = "PHONE";
$multilang_SETTINGS_PHONE_D = "user's phone number, or NONE";
$multilang_SETTINGS_EMAIL = "EMAIL";
$multilang_SETTINGS_EMAIL_D = "user's email address, or NONE";
$multilang_SETTINGS_COMPANY = "COMPANY";
$multilang_SETTINGS_COMPANY_D = "company name, eg. 'Lactalis American Group'";
$multilang_SETTINGS_SHIFT = "SHIFT";
$multilang_SETTINGS_SHIFT_D = "user's work shift";
$multilang_SETTINGS_SITE = "SITE";
$multilang_SETTINGS_SITE_D = "company site, eg. 'Sorrento(Buffalo, NY)'";
$multilang_SETTINGS_DEPARTMENT = "DEPARTMENT";
$multilang_SETTINGS_DEPARTMENT_D = "company department, eg. 'Mozzarella Production'";
$multilang_SETTINGS_SUPERVISOR = "SUPERVISOR";
$multilang_SETTINGS_SUPERVISOR_D = "username of this user's supervisor";
$multilang_SETTINGS_ACCESS_LEVEL = "ACCESS LEVEL";
$multilang_SETTINGS_ACCESS_LEVEL_D = "user's access level";
$multilang_SETTINGS_ACCESS_STATE = "ACCESS STATE";
$multilang_SETTINGS_ACCESS_STATE_D = "user's access state";
$multilang_SETTINGS_COMMIT_USER_ADD = "Commit User Addition";
$multilang_SETTINGS_ACCESS_GRANTED = "ACCESS GRANTED";
$multilang_SETTINGS_ACCESS_GRANTED_BY = "ACCESS GRANTED BY";
$multilang_SETTINGS_LAST_MODIFIED = "LAST MODIFIED";
$multilang_SETTINGS_LAST_MODIFIED_BY = "LAST MODIFIED BY";
$multilang_SETTINGS_LAST_LOGIN = "LAST LOGIN";
$multilang_SETTINGS_LAST_ACTIVITY = "LAST ACTIVITY";
$multilang_SETTINGS_HASH_KEY = "HASH KEY";
$multilang_SETTINGS_REMOVE_SINGLE_USER = "Remove a Single User";
$multilang_SETTINGS_COMMIT_USER_REMOVE = "Commit User Removal";
$multilang_SETTINGS_REMOVE_GROUP_OF_USERS = "Remove a Group of Users";
$multilang_SETTINGS_GROUP_ID_BY = "Group identified by...";
$multilang_SETTINGS_COMMIT_GROUP_REMOVE = "Commit Group Removal";
$multilang_SETTINGS_COMMIT_USER_CHANGES = "Commit User Changes";
$multilang_SETTINGS_INSTALLERS_ONLY = "INSTALLERS ONLY";
$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_1 = "USE WITH EXTREME CAUTION!";
$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_2 = "THERE IS NO RECOVERY FROM THIS POINT!";
$multilang_SETTINGS_INITIAL_INSTALLATION = "Initial Installation";
$multilang_SETTINGS_WARNING_ERASES_ALL_DATA = "WARNING: erases ALL data.";
$multilang_SETTINGS_CREATE_BASIC_DATABASE = "create basic database from scratch";
$multilang_SETTINGS_DESTROY_DATABASE = "destroy existing database and all data";
$multilang_SETTINGS_CREATE_TRAINING_PORTAL_DATABASE = "create Training Portal database from scratch";
$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE = "create Core Model table";
$multilang_SETTINGS_ADMINISTRATORS_ONLY = "ADMNISTRATORS ONLY";
$multilang_SETTINGS_CORE_MODEL_SETUP = "Core Model Setup";
$multilang_SETTINGS_SUPER_USERS_ONLY = "SUPER USERS ONLY";
$multilang_SETTINGS_ADD_AND_REMOVE_USERS = "Add and Remove Users";
$multilang_SETTINGS_ADD_SYSTEM_USERS = "add system users";
$multilang_SETTINGS_REMOVE_SYSTEM_USERS = "remove system users";
$multilang_SETTINGS_LOCKDOWN_CONTROL = "Lockdown Control";
$multilang_SETTINGS_LOCKDOWN_IN_EFFECT = "All system users with an ACCESS LEVEL below 2 (SUPER USER) have been LOCKED OUT of the system.  Thank You.";
$multilang_SETTINGS_LOCKDOWN_RELEASED = "All system users with an ACCESS LEVEL below 2 (SUPER USER) have been RETURNED to their previous ACCESS STATE.  Thank You.";
$multilang_SETTINGS_LOCKDOWN_ENABLE_ACCESS = "enable access, return users to previous access status";
$multilang_SETTINGS_LOCKDOWN_DISABLE_ACCESS = "lockdown all users - disable all access";
$multilang_SETTINGS_LEAD_PERSONS_ONLY = "LEAD PERSONS ONLY";
$multilang_SETTINGS_MODIFY_USER_ACCESS_AND_INFORMATION = "Modify User Access and Information";
$multilang_SETTINGS_DISPLAY_ALL_USERS = "display all system users";
$multilang_SETTINGS_DISPLAY_SITE_USERS = "display all users registered to your SITE";
$multilang_SETTINGS_DISPLAY_DEPARTMENT_USERS = "display all users registered to your DEPARTMENT";
$multilang_SETTINGS_DISPLAY_SHIFT_USERS = "display all users registered to your SHIFT";
$multilang_SETTINGS_OPERATORS_ONLY = "OPERATORS ONLY";
$multilang_SETTINGS_CHANGE_YOUR_PASSWORD = "Change Your System Password";
$multilang_SETTINGS_PASSWORD_UPDATED = "Your password has been updated.  Thank You.";
$multilang_SETTINGS_OLD_PASSWORD = "old password";
$multilang_SETTINGS_NEW_PASSWORD = "new password";
$multilang_SETTINGS_DATA_FRESH_AS_OF = "Data Fresh as Of";
$multilang_SETTINGS_SUPERVISORS_ONLY = "SUPERVISORS ONLY";
$multilang_SETTINGS_MANAGERS_ONLY = "MANAGERS ONLY";

/*	-- FAULTS */
/*	--------- */
$multilang_FAULT_1 = "ACCESS LEVEL is not sufficient to view this page.";
$multilang_FAULT_2 = "missing variable - 'START YEAR'";
$multilang_FAULT_3 = "missing variable - 'START MONTH'";
$multilang_FAULT_4 = "missing variable - 'START DAY'";
$multilang_FAULT_5 = "missing variable - 'START HOUR'";
$multilang_FAULT_6 = "missing variable - 'START MINUTE'";
$multilang_FAULT_7 = "missing variable - 'END YEAR'";
$multilang_FAULT_8 = "missing variable - 'END MONTH'";
$multilang_FAULT_9 = "missing variable - 'END DAY'";
$multilang_FAULT_10 = "missing variable - 'END HOUR'";
$multilang_FAULT_11 = "missing variable - 'END MINUTE'";
$multilang_FAULT_12 = "Display Failure or Fault";
$multilang_FAULT_13 = "we've encountered a fault trying to process the information you've provided.";
$multilang_FAULT_14 = "Common causes include empty or missing data fields, drop-down boxes left blank.  Typically, the system will ignore errors, skipping over the 'bad' records, and displaying only the good ones.";
$multilang_FAULT_15 = "Fault Registered As";
/*			-- to be read as... 'Fault Registered As [some fault]' */
$multilang_FAULT_16 = "Administrator or Super User Fault Acknowledgement";
$multilang_FAULT_17 = "Clear All Active Faults";
$multilang_FAULT_18 = "Current Active Faults and Notifications";
$multilang_FAULT_19 = "Fault History Search";
$multilang_FAULT_20 = "clearing a fault does not remove it from the system.  It simply pushes it into history, where any user can later view any and all faults registered between a selected time period (as well as the usernames of whomever cleared those faults).";
$multilang_FAULT_21 = "once a SYSTEM ADMINISTRATOR has corrected the cause of the faults, an ADMINISTRATOR or SUPER USER may then clear the faults, using a form that will appear below any active faults.  This form is only visible to Level 2 and Level 1 users, so do not be alarmed if you do not see it.";
$multilang_FAULT_22 = "S.E.E.R. is brought to life by an autonomous backbone data input and output system (mod_openopc).  In the event of a problem, a fault will be thrown by the backbone and logged in data storage.  All CURRENTLY ACTIVE faults are listed below.";
$multilang_FAULT_23 = "missing variable - 'FILE TYPE'";
$multilang_FAULT_24 = "missing variable - 'FILE CATEGORY'";
$multilang_FAULT_25 = "missing variable - 'FILE VENDOR or SITE'";
$multilang_FAULT_26 = "missing variable - 'FILE NAME'";
$multilang_FAULT_27 = "missing variable - 'FILE REVISION'";
$multilang_FAULT_28 = "missing variable - 'FILE EXTENSION'";
$multilang_FAULT_29 = "ALREADY EXISTS on the server.  You may not overwrite! (This should never happen, unless the server clock was intentionally altered to illegally force an overwrite.)";
$multilang_FAULT_30 = "FAILED TO POST to the server.";
/*			-- to be read as... '[something] FAILED TO POST to the server.' */
$multilang_FAULT_31 = "was successfully uploaded to the server.";
/*			-- to be read as... '[something] was successfully uploaded to the server.' */
$multilang_FAULT_32 = "The desired USERNAME already exists!  If you wish to add a new record you must first delete the existing user.";
$multilang_FAULT_33 = "All user variable fields must be filled out completely before a user can be added. Please review the form, complete it, and resubmit.";
$multilang_FAULT_34 = "You are not LOGGED IN.  You must be an AUTHORIZED SYSTEM USER to access this page.";
$multilang_FAULT_35 = "Unknown system fault.  Please contact an ADMINISTRATOR if this persists.";
$multilang_FAULT_36 = "UNKNOWN Runtime Environment";
$multilang_FAULT_37 = "This is unacceptable.  See file -globaloptions_seer_0- for more information.";
$multilang_FAULT_38 = "missing variable - 'SNAPSHOT SELECTION'";
$multilang_FAULT_39 = "No data is available for the SNAPSHOT time specified.  If you chose CURRENT then the system may be down (please contact an Administrator), otherwise, you've entered an incorrect HISTORICAL time, or the system was down during the time you specified.";
$multilang_FAULT_40 = "missing variable - 'START DATESTAMP'";
$multilang_FAULT_41 = "missing variable - 'END DATESTAMP'";
$multilang_FAULT_42 = "missing variable - 'ENTRY COMMENT'";
$multilang_FAULT_43 = "missing variable - 'AUTO-SCALE REPORT'";
$multilang_FAULT_44 = "There was no recorded activity during the SNAPSHOT time you requested.";
$multilang_FAULT_45 = "Either the SYSTEMS in this MODEL are out of service for the time period requested, OR, you may have selected a date in the future.";
$multilang_FAULT_46 = "CIP cleaning functions, listed above, apply only to equipment and machines that are SELF-CLEANING.  CIP cleaning information for all other equipment can be viewed using the reports generated by the CIP MODEL, and accessing the appropriate cleaning system.";
$multilang_FAULT_47 = "The model in question is not enabled on this sytem.";
$multilang_FAULT_48 = "The database is WORM protected.";

/*	-- SETUP */
/*	-------- */
$multilang_SETUP_0 = "DATABASE SETUP";
$multilang_SETUP_1 = "We've encountered an error!";
$multilang_SETUP_2 = "It appears that one of the following conditions is true, and is preventing us from setting up the database or table...";
$multilang_SETUP_3 = " - the database or table was already created, and still exists.";
$multilang_SETUP_4 = " - you have entered improper username or password credentials for the MySQL database.";
$multilang_SETUP_5 = " - you have entered an improper IP address or database name for the MySQL database.";
$multilang_SETUP_6 = "Please see your file -globaloptions_seer_0- and have your administrator review the database via console if necessary.";
$multilang_SETUP_7 = "Do not navigate away from this page!";
$multilang_SETUP_8 = "Read the message below, and you will be sent back to the SETUP menu in 90 seconds.";
$multilang_SETUP_9 = "The database should now be installed and ready to use.  You can check this by opening MySQL via console and issuing the following queries...";
$multilang_SETUP_10 = "output must include";
$multilang_SETUP_11 = "If the above outputs are not present, then review your file -globaloptions_seer_0-.";
$multilang_SETUP_12 = "If you have already installed the database table, then you must remove it before you can install it again.";
$multilang_SETUP_13 = "DATABASE DESTROY";
$multilang_SETUP_14 = "The database should now be destroyed and removed.  You can check this by opening MySQL via console and issuing the following queries...";
$multilang_SETUP_15 = "output should NOT include";
$multilang_SETUP_16 = "output should include ONLY the default user";
$multilang_SETUP_17 = "Your default LOGIN information is as follows...";
$multilang_SETUP_18 = "DEFAULT ADMINISTRATOR";
$multilang_SETUP_19 = "DEFAULT PASSWORD";
$multilang_SETUP_20 = "You should change these as soon as possible by LOGGING IN, and then changing then changing the password in the SETTINGS menu.";

/* PHPSYSINFO */
/* ------------------------------------------------------------------ */
$multilang_PHPSYSINFO_0 = 'System Information';
$multilang_PHPSYSINFO_1 = 'System Vital';
$multilang_PHPSYSINFO_2 = 'Canonical Hostname';
$multilang_PHPSYSINFO_3 = 'Listening IP';
$multilang_PHPSYSINFO_4 = 'Kernel Version';
$multilang_PHPSYSINFO_5 = 'Distro Name';
$multilang_PHPSYSINFO_6 = 'Uptime';
$multilang_PHPSYSINFO_7 = 'Current Users';
$multilang_PHPSYSINFO_8 = 'Load Averages';
$multilang_PHPSYSINFO_9 = 'Hardware Information';
$multilang_PHPSYSINFO_10 = 'Processors';
$multilang_PHPSYSINFO_11 = 'Model';
$multilang_PHPSYSINFO_12 = 'CPU Speed';
$multilang_PHPSYSINFO_13 = 'BUS Speed';
$multilang_PHPSYSINFO_14 = 'Cache Size';
$multilang_PHPSYSINFO_15 = 'System Bogomips';
$multilang_PHPSYSINFO_16 = 'PCI Devices';
$multilang_PHPSYSINFO_17 = 'IDE Devices';
$multilang_PHPSYSINFO_18 = 'SCSI Devices';
$multilang_PHPSYSINFO_19 = 'USB Devices';
$multilang_PHPSYSINFO_20 = 'Network Usage';
$multilang_PHPSYSINFO_21 = 'Device';
$multilang_PHPSYSINFO_22 = 'Received';
$multilang_PHPSYSINFO_23 = 'Sent';
$multilang_PHPSYSINFO_24 = 'Err/Drop';
/*			-- to be read as... '[abbreviation for] Errors/Dropped [packets]' */
$multilang_PHPSYSINFO_25 = 'Established Network Connections';
$multilang_PHPSYSINFO_26 = 'Memory Usage';
$multilang_PHPSYSINFO_27 = 'Physical Memory';
$multilang_PHPSYSINFO_28 = 'Disk Swap';
$multilang_PHPSYSINFO_29 = 'Mounted Filesystems';
$multilang_PHPSYSINFO_30 = 'Mount';
$multilang_PHPSYSINFO_31 = 'Partition';
$multilang_PHPSYSINFO_32 = 'Percent Capacity';
$multilang_PHPSYSINFO_33 = 'Type';
$multilang_PHPSYSINFO_34 = 'Free';
$multilang_PHPSYSINFO_35 = 'Used';
$multilang_PHPSYSINFO_36 = 'Size';
$multilang_PHPSYSINFO_37 = 'Totals';
$multilang_PHPSYSINFO_38 = 'KB';
/*			-- to be read as... '[abbreviation for] Kilobytes' */
$multilang_PHPSYSINFO_39 = 'MB';
/*			-- to be read as... '[abbreviation for] Megabytes' */
$multilang_PHPSYSINFO_40 = 'GB';
/*			-- to be read as... '[abbreviation for] Gigabytes' */
$multilang_PHPSYSINFO_41 = 'none';
$multilang_PHPSYSINFO_42 = 'Capacity'; 
$multilang_PHPSYSINFO_43 = 'Template';
$multilang_PHPSYSINFO_44 = 'Language';
$multilang_PHPSYSINFO_45 = 'Submit';
$multilang_PHPSYSINFO_46 = 'Created by';
$multilang_PHPSYSINFO_47 = 'en_US';
/*			-- DO NOT EDIT $multilang_PHPSYSINFO_47 */
/*			-- SHOULD REMAIN THE SAME FOR ALL LANGUAGES */
/*			-- THIS IS A 'HACK' OF SORTS */
$multilang_PHPSYSINFO_48 = '%b %d, %Y @ %I:%M %p';
/*			-- DO NOT EDIT $multilang_PHPSYSINFO_48 */
/*			-- SHOULD REMAIN THE SAME FOR ALL LANGUAGES */
/*			-- THIS IS A 'HACK' OF SORTS */
$multilang_PHPSYSINFO_49 = 'days';
$multilang_PHPSYSINFO_50 = 'hours';
$multilang_PHPSYSINFO_51 = 'minutes';
$multilang_PHPSYSINFO_52 = 'Temperature';
$multilang_PHPSYSINFO_53 = 'Voltage';
$multilang_PHPSYSINFO_54 = 'Fans';
$multilang_PHPSYSINFO_55 = 'Value';
$multilang_PHPSYSINFO_56 = 'Min';
/*			-- to be read as... '[abbreviation for] Minimum' */
$multilang_PHPSYSINFO_57 = 'Max';
/*			-- to be read as... '[abbreviation for] Maximum' */
$multilang_PHPSYSINFO_58 = 'Hysteresis';
$multilang_PHPSYSINFO_59 = 'Limit';
$multilang_PHPSYSINFO_60 = 'Label';
$multilang_PHPSYSINFO_61 = 'C';
/*			-- to be read as... '[abbreviation for] Celsius' */
$multilang_PHPSYSINFO_62 = 'F';
/*			-- to be read as... '[abbreviation for] Farenheit' */
$multilang_PHPSYSINFO_63 = 'V';
/*			-- to be read as... '[abbreviation for] Voltage' */
$multilang_PHPSYSINFO_64 = 'RPM';
/*			-- to be read as... '[abbreviation for] Rotations per Minute' */
$multilang_PHPSYSINFO_65 = 'Kernel & Applications';
$multilang_PHPSYSINFO_66 = 'Buffers';
$multilang_PHPSYSINFO_67 = 'Cached';
$multilang_PHPSYSINFO_68 = 'deg';
/*			-- to be read as... '[abbreviation for] degrees' */

/* MODOPENOPC PLUGINS */
/* ------------------------------------------------------------------ */
$multilang_MODOPENOPC_SUCCESS = "SUCCESS";
$multilang_MODOPENOPC_FAILURE = "FAILURE";
$multilang_MODOPENOPC_OPERATION_TYPE = "OPERATION TYPE";
$multilang_MODOPENOPC_DAEMON_FILE_CREATION = "... event file creation via S.E.E.R. builtin integration.";
$multilang_MODOPENOPC_READ_DAEMON_FUNCTION_PRESET = "All READ_DAEMON functions are PRESET based.";
$multilang_MODOPENOPC_DATESTAMP = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_MODOPENOPC_CURRENT_DATESTAMP = "The current system date and time are";
$multilang_MODOPENOPC_ACTION_DATA = "ACTION DATA";
/*			-- to be read as... 'ACTION DATA' or 'RESULTS OF ACTION' */
$multilang_MODOPENOPC_SEER_AUTO_GENERATED = "This action report has been automatically generated by S.E.E.R.";
$multilang_MODOPENOPC_DEBUG = "DEBUGGING DATA";
$multilang_MODOPENOPC_ERROR = "ERROR!";
$multilang_MODOPENOPC_BAD_INPUT = "BAD FORM INPUT DATA";
$multilang_MODOPENOPC_BAD_INPUT_REASON = "This is typically caused by an incorrectly-formed referring-webpage.  Please close your browser, navigate back to the page you were just at, and retry the same operation again.  If you get this error more than once, then you should take the following action:";
$multilang_MODOPENOPC_BAD_INPUT_REASON_1 = "Write down the address of the page you were just on.";
$multilang_MODOPENOPC_BAD_INPUT_REASON_2 = "Print this page so that you have a record of the data below.";
$multilang_MODOPENOPC_BAD_INPUT_REASON_3 = "Contact your SYSTEM ADMINISTRATOR with this information.";
$multilang_MODOPENOPC_BAD_INPUT_REASON_4 = "Do NOT continue to attempt to force this operation again.";
$multilang_MODOPENOPC_WRITE_DAEMON_FUNCTION_PRESET = "Write type for utilizing this function should be PRESET.";
$multilang_MODOPENOPC_WRITE_DAEMON_FUNCTION_PRESET = "Write type for utilizing this function should be DECLARED.";


/* MODEL LANGUAGE ENTRIES */
/* ------------------------------------------------------------------ */

/*	-- TANKMODEL */
/* 	------------ */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TANKMODEL_0 = "TANK MODEL";
$multilang_TANKMODEL_1 = "Main Monitor";
$multilang_TANKMODEL_2 = "Agitator Drive Monitors";
$multilang_TANKMODEL_3 = "Manual Record Entry";
$multilang_TANKMODEL_4 = "Record Certification";
$multilang_TANKMODEL_5 = "Agitation Rundown";
$multilang_TANKMODEL_6 = "Temperature Chart";
$multilang_TANKMODEL_7 = "Level Chart";
$multilang_TANKMODEL_8 = "Product Inventory";
$multilang_TANKMODEL_9 = "Tank Occupancy";
$multilang_TANKMODEL_10 = "Alarm History";
$multilang_TANKMODEL_11 = "Activity Gantt";
$multilang_TANKMODEL_12 = "RELEASE TANK FROM CLEANING LOCKDOWN";
$multilang_TANKMODEL_13 = "Tank Identification";
$multilang_TANKMODEL_14 = "Release?";
/*			-- to be read as... '[shall we] Release [this tank]?' */
$multilang_TANKMODEL_15 = "Tank or Silo";
$multilang_TANKMODEL_16 = "Lockdown Control";
/*			-- to be read as... '[system] Lockdown Control' */
$multilang_TANKMODEL_17 = "MODIFY TANK PARAMETERS";
$multilang_TANKMODEL_18 = "New Value";
$multilang_TANKMODEL_19 = "Density";
$multilang_TANKMODEL_20 = "Product";
$multilang_TANKMODEL_21 = "Agitator ON Level";
/* 			-- to be read as... 'Agitator [to turn] ON [at product] Level [in percent]' */
$multilang_TANKMODEL_22 = "Level";
/*			-- to be read as... 'Level [in tank]' */
$multilang_TANKMODEL_23 = "Agitator OFF Level";
/*			-- to be read as... 'Agitator [to turn] OFF [at product] Level [in percent]' */
$multilang_TANKMODEL_24 = "Tanks in Group";
$multilang_TANKMODEL_25 = "Agitator Mode";
$multilang_TANKMODEL_26 = "Agitator Preset";
/*			-- to be read as... 'Agitator Preset [or Recipe]' */
$multilang_TANKMODEL_27 = "Group Preset";
/*			-- to be read as... 'Group Preset [or Recipe]' */
$multilang_TANKMODEL_28 = "Agitator Speed";
$multilang_TANKMODEL_29 = "MODIFY TANK or SILO PARAMETERS";
$multilang_TANKMODEL_30 = "AGITATOR PRESET REPORT";
$multilang_TANKMODEL_31 = "Agitation Group ID";
$multilang_TANKMODEL_33 = "Preset Name";
$multilang_TANKMODEL_34 = "High Speed";
$multilang_TANKMODEL_35 = "Low Speed";
$multilang_TANKMODEL_37 = "SINGLE SPEED";
$multilang_TANKMODEL_40 = "Tank";
$multilang_TANKMODEL_42 = "HRS Since Clean";
/*			-- to be read as... 'HRS [Hours] Since [Tank was] Clean[ed]' */
$multilang_TANKMODEL_43 = "Source";
$multilang_TANKMODEL_44 = "Destination";
$multilang_TANKMODEL_45 = "Volume";
$multilang_TANKMODEL_46 = "Mass";
$multilang_TANKMODEL_47 = "FILL";
/*			-- to be read as... 'FILL [or LEVEL in percent]' */
$multilang_TANKMODEL_48 = "TEMP.";
/*			-- to be read as... 'TEMP [abbreviation for TEMPERATURE in degrees] */
$multilang_TANKMODEL_51 = "VFD Manufacturer & Model";
/*			-- to be read as... '[Variable Frequency] Drive Manufacturer and Model [Number]' */
$multilang_TANKMODEL_52 = "The drive's builtin http status display will open in a separate window.  When you wish to come back to S.E.E.R., simply close the newly created window.";
$multilang_TANKMODEL_53 = "select your tank agitator's variable frequency drive below.";
$multilang_TANKMODEL_54 = "This sub-model does not have Agitation Control enabled.  This is usually because the agitators included in the model may not have dynamic speed control.  Therefore, this screen cannot be displayed.";
$multilang_TANKMODEL_65 = "TANK STATE";
$multilang_TANKMODEL_70 = "Select your tank or silo from the drop down, then enter your START TIME for manual entries.  Each subsequent entry's DATESTAMP will automatically be incremented by the required interval.";
$multilang_TANKMODEL_75 = "missing variable - 'TANK NAME'";
$multilang_TANKMODEL_78 = "Machine";
$multilang_TANKMODEL_88 = "Select your tank from the drop down menu, and then enter a START and END time range.  Any records that are available for CERTIFICATION will be displayed to you.";
$multilang_TANKMODEL_92 = "State";
$multilang_TANKMODEL_93 = "Agitator Level ON / OFF";
$multilang_TANKMODEL_95 = "STATE";
$multilang_TANKMODEL_96 = "HRS SINCE CLEAN";
/*			-- to be read as... 'HRS [Hours] SINCE [Tank was] CLEAN[ED]' */
$multilang_TANKMODEL_97 = "Temperature";
$multilang_TANKMODEL_105 = "TANK";
$multilang_TANKMODEL_107 = "PRODUCT";
$multilang_TANKMODEL_108 = "DISCRETE OCCUPATIONS";
$multilang_TANKMODEL_109 = "MASS";
$multilang_TANKMODEL_110 = "VOLUME";
$multilang_TANKMODEL_116 = "any product that shows up in an 'Empty' Tank, or has a positive inventory level listed under 'Empty', is to be considered <B><I>Unknown</I></B>.  Product type is manually entered by machine operators throughout the day; product showing up in an 'Empty' Tank is typically caused by operator error (failure to change the product type in the tank after beginning a tank fill).";
$multilang_TANKMODEL_117 = "Distribution by Product";
$multilang_TANKMODEL_118 = "PERCENT of TOTAL INVENTORY";
$multilang_TANKMODEL_119 = "STORED in TANKS";
$multilang_TANKMODEL_120 = "TOTAL MASS";
$multilang_TANKMODEL_121 = "TOTAL VOLUME";
$multilang_TANKMODEL_122 = "Distribution by Tank";
$multilang_TANKMODEL_123 = "PERCENT of PRODUCT INVENTORY";
$multilang_TANKMODEL_124 = "Containment Failure";
$multilang_TANKMODEL_125 = "only records indicating a product level above the minimum appreciable level are displayed.  Minimum appreciable level is";
$multilang_TANKMODEL_126 = "determination of containment failure is based upon product temperature outside of acceptable range, which is defined as";
$multilang_TANKMODEL_127 = "only containment failures spanning greater than the minimum failure threshold are displayed. The minimum failure threshold is";
$multilang_TANKMODEL_128 = "Database Dump";
$multilang_TANKMODEL_129 = "Database dump is complete.  You may access the download using the Export and Save Button, above.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_TANKMODEL_32 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_TANKMODEL_36 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_TANKMODEL_38 = $multilang_STATIC_CURRENT_TIME;
$multilang_TANKMODEL_39 = $multilang_TANKMODEL_32;
$multilang_TANKMODEL_41 = $multilang_STATIC_ALARMS;
$multilang_TANKMODEL_49 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_TANKMODEL_50 = $multilang_STATIC_DISPLAY;
$multilang_TANKMODEL_55 = $multilang_TANKMODEL_2;
$multilang_TANKMODEL_56 = $multilang_TANKMODEL_3;
$multilang_TANKMODEL_66 = $multilang_STATIC_DATA_TICKET;
$multilang_TANKMODEL_67 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_TANKMODEL_68 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_TANKMODEL_69 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_TANKMODEL_57 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_TANKMODEL_58 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_TANKMODEL_59 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_TANKMODEL_60 = $multilang_STATIC_CERT_STAMP;
$multilang_TANKMODEL_61 = $multilang_STATIC_CERT_COMMENT;
$multilang_TANKMODEL_62 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_TANKMODEL_63 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_TANKMODEL_64 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_TANKMODEL_66 = $multilang_STATIC_DATA_TICKET;
$multilang_TANKMODEL_67 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_TANKMODEL_68 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_TANKMODEL_69 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_TANKMODEL_71 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_TANKMODEL_72 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_TANKMODEL_73 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_TANKMODEL_74 = $multilang_TANKMODEL_4;
$multilang_TANKMODEL_76 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_TANKMODEL_77 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_TANKMODEL_79 = $multilang_STATIC_SERVER;
$multilang_TANKMODEL_80 = $multilang_STATIC_DB_TABLE;
$multilang_TANKMODEL_81 = $multilang_STATIC_DATE_RANGE;
$multilang_TANKMODEL_82 = $multilang_STATIC_YOUR_USERNAME;
$multilang_TANKMODEL_83 = $multilang_STATIC_RERUN_REPORT;
$multilang_TANKMODEL_84 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_TANKMODEL_85 = $multilang_STATIC_REVIEW_CERT;
$multilang_TANKMODEL_86 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_TANKMODEL_87 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_TANKMODEL_89 = $multilang_STATIC_DISPLAY_RECORDS_FOR_CERT;
$multilang_TANKMODEL_90 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_TANKMODEL_91 = $multilang_TANKMODEL_5;
$multilang_TANKMODEL_94 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_TANKMODEL_98 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_TANKMODEL_99 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_TANKMODEL_100 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_TANKMODEL_101 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_TANKMODEL_102 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_TANKMODEL_103 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_TANKMODEL_104 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_TANKMODEL_106 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_TANKMODEL_111 = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
$multilang_TANKMODEL_112 = $multilang_STATIC_INVENTORY_TYPE;
$multilang_TANKMODEL_113 = $multilang_STATIC_CURRENT_BLIP;
$multilang_TANKMODEL_114 = $multilang_STATIC_HISTORICAL_BLIP;
$multilang_TANKMODEl_115 = $multilang_STATIC_DATA_WITHIN_15;
/*			-- do not edit this block unless modifying program */

/*	-- SPFMODEL */
/* 	----------- */

/*	-- -- NEW VARIABLES */
/*	---------------------- */
$multilang_SPFMODEL_0 = "SPF MODEL";
/*		-	-- where SPF stands for 'SEPARATION, PASTEURIZATION, and FILTRATION' */
$multilang_SPFMODEL_1 = "Main Monitor";
$multilang_SPFMODEL_2 = "Machine Settings";
$multilang_SPFMODEL_3 = "Manual Record Entry";
$multilang_SPFMODEL_4 = "Record Certification";
$multilang_SPFMODEL_5 = "Production Summary";
$multilang_SPFMODEL_6 = "Power Usage";
$multilang_SPFMODEL_7 = "Drain Turbidity Chart";
$multilang_SPFMODEL_8 = "Production Analysis";
/* $multilang_SPFMODEL_9 -- DELETED */
$multilang_SPFMODEL_10 = "CIP Water Usage";
$multilang_SPFMODEL_11 = "CIP Temperature Chart";
$multilang_SPFMODEL_12 = "CIP Full Performance Chart";
$multilang_SPFMODEL_13 = "Alarm History";
$multilang_SPFMODEL_14 = "Activity Gantt";
$multilang_SPFMODEL_15 = "Machine_ID";
/*			-- to be read as... 'Machine_[Identification - abbreviation]' */
$multilang_SPFMODEL_16 = "Type";
$multilang_SPFMODEL_18 = "HRS Since Clean";
$multilang_SPFMODEL_19 = "Self-Cleaning Machine";
$multilang_SPFMODEL_20 = "CIP Step";
$multilang_SPFMODEL_21 = "Water Type";
$multilang_SPFMODEL_22 = "Water Usage";
$multilang_SPFMODEL_23 = "TEMP.";
$multilang_SPFMODEL_24 = "FLOW";
$multilang_SPFMODEL_25 = "CIP via Other Source";
$multilang_SPFMODEL_26 = "This machine is cleaned by another machine, or by a CIP washing system.  Please refer to the following source for information regarding this machine's cleaning status or history...";
$multilang_SPFMODEL_27 = "Source";
$multilang_SPFMODEL_28 = "Destination_1";
$multilang_SPFMODEL_29 = "Destination_2";
$multilang_SPFMODEL_30 = "Source FLOW";
$multilang_SPFMODEL_31 = "Dest_1 FLOW";
$multilang_SPFMODEL_32 = "Dest_2 FLOW";
$multilang_SPFMODEL_33 = "Power Rate";
$multilang_SPFMODEL_34 = "Drain Turbidity";
$multilang_SPFMODEL_35 = "Aknowledge Turbidity Alarm";
$multilang_SPFMODEL_36 = "Bowl Speed";
$multilang_SPFMODEL_37 = "Inlet TEMP.";
$multilang_SPFMODEL_38 = "Pasteurize TEMP.";
$multilang_SPFMODEL_39 = "Raw PRESSURE";
$multilang_SPFMODEL_40 = "Pasteurize PRESSURE";
$multilang_SPFMODEL_41 = "Baseline PRESS";
/*			-- to be read as '[abbreviation for] Baseline PRESS[URE]' */
$multilang_SPFMODEL_42 = "Concentration Valve Position";
$multilang_SPFMODEL_43 = "Concentration Ratio";
$multilang_SPFMODEL_44 = "MANUAL HOLD and STEPPING CONTROLS";
$multilang_SPFMODEL_45 = "Manual Action";
$multilang_SPFMODEL_46 = "Machine";
$multilang_SPFMODEL_57 = "Select your machine from the drop down, then enter your START TIME for manual entries.  Each subsequent entry's DATESTAMP will automatically be incremented by the required interval.";
$multilang_SPFMODEL_58 = "Machine Identification";
$multilang_SPFMODEL_62 = "for Pasteurizers";
$multilang_SPFMODEL_63 = "for all other Machines";
$multilang_SPFMODEL_65 = "The Machine you have selected does not require certified records.  Therefore, Manual Record Entry has been disabled for this Machine.";
$multilang_SPFMODEL_67 = "CIP_STEP";
$multilang_SPFMODEL_68 = "CIP_TEMP";
$multilang_SPFMODEL_69 = "STATE";
$multilang_SPFMODEL_77 = "missing variable - 'SPF NAME'";
$multilang_SPFMODEL_93 = "Differential Pressure";
$multilang_SPFMODEL_95 = "Select your Machine (regardless of type) from the drop down menu, and then enter a START and END time range.  Any records that are available for CERTIFICATION will be displayed to you.";
$multilang_SPFMODEL_109 = "TURBIDITY";
$multilang_SPFMODEL_111 = "missing variable - 'DISPLAY_UNDER_ALARM_CONDITION_ONLY'";
$multilang_SPFMODEL_112 = "select YES or NO for 'Data Recorded during System Alarms Only'... selecting YES will trim the report down so that Turbidity readings are displayed only when a Machine Alarm Event has occurred.  This could be any type of Alarm, not limited to Turbidity Alarms (Alarms are identified by name for disambiguation).";
$multilang_SPFMODEL_113 = "The Machine you have selected does NOT have a Turbidity Sensor installed.  Therefore, this report cannot be generated.  If you believe this is in error, contact your System Administrator, and ask them to review the --localoptions file-- for this Model.";
$multilang_SPFMODEL_114 = "STEP";
$multilang_SPFMODEL_115 = "TOTALS for this Wash Instance";
$multilang_SPFMODEL_117 = "Alarms and Faults (if any)";
$multilang_SPFMODEL_118 = "Total Water Usage";
$multilang_SPFMODEL_120 = "usage is broken down by unique combinations of SELF-CLEANING SYSTEM and WASH INSTANCE (in sequence). Each WATER TYPE is displayed and totalized for each instance.  Then each WATER TYPE is totalized for each SYSTEM.";
$multilang_SPFMODEL_121 = "Global Rundown - Overall Water Usage by Machine and Type";
$multilang_SPFMODEL_122 = "Detail Rundown - Individual MACHINE and WATER TYPE Instances, Sequential";
$multilang_SPFMODEL_123 = "ALL_SELF-CLEAN_SYSTEMS";
$multilang_SPFMODEL_124 = "None of the Machines in this particular MODEL Instance are Self-Cleaning.  All are cleaned by other Machines or by Cleaning Systems.  Therefore, a report will not be generated form this point.  Please refer to the following table for more information...";
$multilang_SPFMODEL_125 = "... is cleaned by ...";
$multilang_SPFMODEL_126 = "LINE";
$multilang_SPFMODEL_127 = "TOTALS for this Machine";
$multilang_SPFMODEL_128 = "Global Rundown - Overall POWER Usage by MACHINE";
$multilang_SPFMODEL_129 = "Detail Rundown - Individual MACHINE and STATE Instances, Sequential";
$multilang_SPFMODEL_130 = "usage is broken down by unique combinations of MACHINE and STATE (in sequence). Then POWER is totalized for each SYSTEM.";
$multilang_SPFMODEL_131 = "POWER_USAGE";
$multilang_SPFMODEL_132 = "ALL_POWERED_SYSTEMS";
$multilang_SPFMODEL_133 = "Detail Pareto - Individual Machine POWER Use.";
$multilang_SPFMODEL_134 = "Pareto Chart - Power Use [This Machine]";
$multilang_SPFMODEL_135 = "Global Pareto - Overall POWER Use by STATE";
$multilang_SPFMODEL_136 = "Percent of Total Power Use [All Machines]";
/*			- to be read as '[machine A] ... is cleaned by ... [machine b]' */
$multilang_SPFMODEL_137 = "TOTALS for this Production Cycle";
$multilang_SPFMODEL_138 = "ALARMS for this Production Cycle";
$multilang_SPFMODEL_139 = "Congratulations - No Alarms Present.";
$multilang_SPFMODEL_140 = "Source FLOW TOTAL";
$multilang_SPFMODEL_141 = "Dest_1 FLOW TOTAL";
$multilang_SPFMODEL_142 = "Dest_2 FLOW TOTAL";
$multilang_SPFMODEL_143 = "Source DELTA";
$multilang_SPFMODEL_144 = "Dest_1 DELTA";
$multilang_SPFMODEL_145 = "Dest_2 DELTA";
$multilang_SPFMODEL_146 = "Material Flow";
$multilang_SPFMODEL_147 = "Efficiency";
$multilang_SPFMODEL_148 = "Utility";
/*			-- to be read as '[building] Utility [such as steam or power]' */
$multilang_SPFMODEL_149 = "Differential Pressure";
$multilang_SPFMODEL_150 = "Summary Math Error";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_SPFMODEL_17 = $multilang_STATIC_ALARMS;
$multilang_SPFMODEL_47 = $multilang_STATIC_HOLD;
$multilang_SPFMODEL_48 = $multilang_STATIC_STEP;
$multilang_SPFMODEL_49 = $multilang_STATIC_LOCKOUT_CAPS;
$multilang_SPFMODEL_50 = $multilang_STATIC_DISABLES_MANUAL_FUNCTIONS;
$multilang_SPFMODEL_51 = $multilang_STATIC_FORCE_HOLD;
$multilang_SPFMODEL_52 = $multilang_STATIC_RELEASE_HOLD;
$multilang_SPFMODEL_53 = $multilang_STATIC_FORCE_STEP;
$multilang_SPFMODEL_54 = $multilang_STATIC_LOCKOUT;
$multilang_SPFMODEL_55 = $multilang_STATIC_RELEASE;
$multilang_SPFMODEL_56 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_SPFMODEL_59 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_SPFMODEL_60 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_SPFMODEL_61 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_SPFMODEL_64 = $multilang_STATIC_DATA_TICKET;
$multilang_SPFMODEL_66 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_SPFMODEL_70 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_SPFMODEL_71 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_SPFMODEL_72 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_SPFMODEL_73 = $multilang_STATIC_CERT_STAMP;
$multilang_SPFMODEL_74 = $multilang_STATIC_CERT_COMMENT;
$multilang_SPFMODEL_75 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_SPFMODEL_76 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_SPFMODEL_78 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_SPFMODEL_79 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_SPFMODEL_80 = $multilang_SPFMODEL_46;
$multilang_SPFMODEL_81 = $multilang_STATIC_SERVER;
$multilang_SPFMODEL_82 = $multilang_STATIC_DB_TABLE;
$multilang_SPFMODEL_83 = $multilang_STATIC_DATE_RANGE;
$multilang_SPFMODEL_84 = $multilang_STATIC_YOUR_USERNAME;
$multilang_SPFMODEL_85 = $multilang_STATIC_CURRENT_TIME;
$multilang_SPFMODEL_86 = $multilang_STATIC_RERUN_REPORT;
$multilang_SPFMODEL_87 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_SPFMODEL_88 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_SPFMODEL_89 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_SPFMODEL_90 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_SPFMODEL_91 = $multilang_STATIC_REVIEW_CERT;
$multilang_SPFMODEL_92 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_SPFMODEL_94 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_SPFMODEL_96 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_SPFMODEL_97 = $multilang_STATIC_FAULTS_CAPS;
$multilang_SPFMODEL_98 = $multilang_STATIC_DATESTAMP_START;
$multilang_SPFMODEL_99 = $multilang_STATIC_DATESTAMP_END;
$multilang_SPFMODEL_100 = $multilang_STATIC_DURATION_CAPS;
$multilang_SPFMODEL_101 = $multilang_STATIC_DURATION_IN_SECONDS;
$multilang_SPFMODEL_102 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_SPFMODEL_103 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_SPFMODEL_104 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_SPFMODEL_105 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_SPFMODEL_106 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_SPFMODEL_107 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_SPFMODEL_108 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_SPFMODEL_110 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_SPFMODEL_116 = $multilang_STATIC_DURATION;
$multilang_SPFMODEL_119 = $multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE;
/*			-- do not edit this block unless modifying program */

/*	-- CIPMODEL */
/* 	----------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CIPMODEL_0 = "CIP MODEL";
$multilang_CIPMODEL_1 = "Main Monitor";
$multilang_CIPMODEL_2 = "Manual Record Entry";
$multilang_CIPMODEL_3 = "Record Certification";
$multilang_CIPMODEL_4 = "Water Usage";
$multilang_CIPMODEL_5 = "Temperature Chart";
$multilang_CIPMODEL_6 = "Full Performance Chart";
/*			-- read as 'Full Report' or 'Full System Analysis' */
$multilang_CIPMODEL_7 = "Alarm History";
$multilang_CIPMODEL_8 = "Activity Gantt";
$multilang_CIPMODEL_18 = "LINE";
$multilang_CIPMODEL_23 = "Select your CIP system from the drop down, then enter your START TIME for manual entries.  Each subsequent entry's DATESTAMP will automatically be incremented by the required interval.";
$multilang_CIPMODEL_25 = "STEP";
$multilang_CIPMODEL_26 = "RETURN TEMP";
/*			-- to be read as... 'RETURN TEMP[erature]' */
$multilang_CIPMODEL_29 = "System Identification";
$multilang_CIPMODEL_33 = "Select your CIP system from the drop down menu, and then enter a START and END time range.  Any records that are available for CERTIFICATION will be displayed to you.";
$multilang_CIPMODEL_36 = "System";
$multilang_CIPMODEL_37 = "WATER TYPE";
$multilang_CIPMODEL_38 = "missing variable - 'CIP NAME'";
$multilang_CIPMODEL_51 = "MANUAL HOLD and STEPPING CONTROLS";
$multilang_CIPMODEL_52 = "Manual Action";
$multilang_CIPMODEL_59 = "Line Being Cleaned";
$multilang_CIPMODEL_60 = "SUPPLY TEMP";
/*			-- to be read as... 'SUPPLY TEMP[erature]' */
$multilang_CIPMODEL_61 = "SUPPLY FLOW";
$multilang_CIPMODEL_62 = "RETURN CONDUCTIVITY";
$multilang_CIPMODEL_63 = "OPERATIONAL STATUS";
$multilang_CIPMODEL_64 = "WATER USAGE";
$multilang_CIPMODEL_68 = "SYSTEM";
$multilang_CIPMODEL_72 = "WATER START";
$multilang_CIPMODEL_73 = "WATER END";
$multilang_CIPMODEL_74 = "WATER USED";
$multilang_CIPMODEL_75 = "TOTALS for this Wash Instance";
$multilang_CIPMODEL_76 = "ALL_CIP_SYSTEMS";
$multilang_CIPMODEL_77 = "usage is broken down by unique combinations of CIP SYSTEM, WATER TYPE, and LINE CIRCUIT. Then each WATER TYPE is totalized for each SYSTEM.";
$multilang_CIPMODEL_78 = "Global Rundown - Overall Water Usage by System and Type";
$multilang_CIPMODEL_79 = "Detail Rundown - Individual SYSTEM, LINE, and WATER TYPE Instances";
$multilang_CIPMODEL_87 = "Alarms and Faults (if any)";
$multilang_CIPMODEL_88 = "Total Water Usage";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_CIPMODEL_9 = $multilang_CIPMODEL_2;
$multilang_CIPMODEL_10 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_CIPMODEL_11 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_CIPMODEL_12 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_CIPMODEL_13 = $multilang_STATIC_CERT_STAMP;
$multilang_CIPMODEL_14 = $multilang_STATIC_CERT_COMMENT;
$multilang_CIPMODEL_15 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_CIPMODEL_16 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_CIPMODEL_17 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_CIPMODEL_19 = $multilang_STATIC_DATA_TICKET;
$multilang_CIPMODEL_20 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_CIPMODEL_21 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_CIPMODEL_22 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_CIPMODEL_24 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_CIPMODEL_27 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_CIPMODEL_28 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_CIPMODEL_30 = $multilang_STATIC_REVIEW_CERT;
$multilang_CIPMODEL_31 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_CIPMODEL_32 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_CIPMODEL_34 = $multilang_STATIC_DISPLAY_RECORDS_FOR_CERT;
$multilang_CIPMODEL_35 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_CIPMODEL_39 = $multilang_STATIC_RERUN_REPORT;
$multilang_CIPMODEL_40 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_CIPMODEL_41 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_CIPMODEL_42 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_CIPMODEL_43 = $multilang_CIPMODEL_36;
$multilang_CIPMODEL_44 = $multilang_STATIC_SERVER;
$multilang_CIPMODEL_45 = $multilang_STATIC_DB_TABLE;
$multilang_CIPMODEL_46 = $multilang_STATIC_DATE_RANGE;
$multilang_CIPMODEL_47 = $multilang_STATIC_YOUR_USERNAME;
$multilang_CIPMODEL_48 = $multilang_STATIC_CURRENT_TIME;
$multilang_CIPMODEL_49 = $multilang_CIPMODEL_3;
$multilang_CIPMODEL_50 = $multilang_CIPMODEL_1;
$multilang_CIPMODEL_53 = $multilang_STATIC_HOLD;
$multilang_CIPMODEL_54 = $multilang_STATIC_STEP;
$multilang_CIPMODEL_55 = $multilang_STATIC_LOCKOUT_CAPS;
$multilang_CIPMODEL_56 = $multilang_STATIC_DISABLES_MANUAL_FUNCTIONS;
$multilang_CIPMODEL_57 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_CIPMODEL_58 = $multilang_STATIC_FAULTS_CAPS;
$multilang_CIPMODEL_65 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_CIPMODEL_66 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_CIPMODEL_67 = $multilang_CIPMODEL_4;
$multilang_CIPMODEL_69 = $multilang_STATIC_DATESTAMP_START;
$multilang_CIPMODEL_70 = $multilang_STATIC_DATESTAMP_END;
$multilang_CIPMODEL_71 = $multilang_STATIC_DURATION_CAPS;
$multilang_CIPMODEL_80 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_CIPMODEL_81 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_CIPMODEL_82 = $multilang_STATIC_CERT_NO_COMMENTS;
$multilang_CIPMODEL_83 = $multilang_STATIC_CERT_SIGNATURE_HEADER;
$multilang_CIPMODEL_84 = $multilang_STATIC_CERT_NO_SIGS;
$multilang_CIPMODEL_85 = $multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE;
$multilang_CIPMODEL_86 = $multilang_STATIC_DURATION;
$multilang_CIPMODEL_89 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_CIPMODEL_90 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_CIPMODEL_91 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_CIPMODEL_92 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_CIPMODEL_93 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_CIPMODEL_94 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_CIPMODEL_95 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_CIPMODEL_96 = $multilang_STATIC_DURATION_IN_SECONDS;
$multilang_CIPMODEL_100 = $multilang_STATIC_FORCE_HOLD;
$multilang_CIPMODEL_102 = $multilang_STATIC_RELEASE_HOLD;
$multilang_CIPMODEL_103 = $multilang_STATIC_FORCE_STEP;
$multilang_CIPMODEL_104 = $multilang_STATIC_LOCKOUT;
$multilang_CIPMODEL_105 = $multilang_STATIC_RELEASE;

/*	-- BULKMODEL */
/* 	------------ */

/*	-- -- NEW VARIABLES */
/*	---------------------- */
$multilang_BULKMODEL_0 = "BULK MODEL";
$multilang_BULKMODEL_1 = "Main Monitor";
$multilang_BULKMODEL_2 = "Stores Inventory";
$multilang_BULKMODEL_3 = "Stores Item Rundown";
$multilang_BULKMODEL_4 = "Inventory Summary";
$multilang_BULKMODEL_9 = "Volume";
/*			-- to be read as... 'Volume [measure of quantity, typically liquid or mass]' */
$multilang_BULKMODEL_10 = "Percent Stock";
/*			-- to be read as... 'Percent Stock [of Capacity]' */
$multilang_BULKMODEL_12 = "Historical Inventory Snapshot";
$multilang_BULKMODEL_14 = "INVENTORY PERCENT";
$multilang_BULKMODEL_15 = "INVENTORY QUANTITY";
$multilang_BULKMODEL_23 = "Snapshot Time";
$multilang_BULKMODEL_25 = "Inventory";
$multilang_BULKMODEL_29 = "missing variable - 'BULK NAME'";
$multilang_BULKMODEL_30 = "Single Item History";
$multilang_BULKMODEL_31 = "Item Usage";
$multilang_BULKMODEL_33 = "Quantity Used";
$multilang_BULKMODEL_34 = "this item usage report utilizes 'fuzzy logic' to account for inventory restocking (which is not recorded) and commonly used bulk material sensors (with typically a 2 to 5 percent discrepancy in accuracy).  As a result, this report should be accurate within 5 percent, but may vary.  It is intended to be used as an 'estimate', not suitable for billing or commercial sales.  If you suspect an unreasonable discrepancy, then use REPORT-1 (ITEM RUNDOWN) to view the actual sensor readings over the time period requested.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_BULKMODEL_5 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_BULKMODEL_6 = $multilang_STATIC_CURRENT_TIME;
$multilang_BULKMODEL_7 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_BULKMODEL_8 = $multilang_STATIC_ITEM_LOWER;
$multilang_BULKMODEL_11 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_BULKMODEL_16 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_BULKMODEL_17 = $multilang_STATIC_REPORT_TICKET_FOR;
$multilang_BULKMODEL_13 = $multilang_STATIC_ITEM;
$multilang_BULKMODEL_18 = $multilang_STATIC_DATA_WITHIN_15;
$multilang_BULKMODEL_19 = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
$multilang_BULKMODEL_20 = $multilang_STATIC_INVENTORY_TYPE;
$multilang_BULKMODEL_21 = $multilang_STATIC_CURRENT_BLIP;
$multilang_BULKMODEL_22 = $multilang_STATIC_HISTORICAL_BLIP;
$multilang_BULKMODEL_24 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_BULKMODEL_26 = $multilang_STATIC_DATESTAMP;
$multilang_BULKMODEL_27 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_BULKMODEL_28 = $multilang_STATIC_RERUN_REPORT;
$multilang_BULKMODEL_32 = $multilang_STATIC_SELECT_FROM_DROPDOWN;
/*			-- do not edit this block unless modifying program */

/*	-- ATMOSPHERICMODEL */
/* 	------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_ATMOSPHERICMODEL_0 = "ATMOSPHERIC MODEL";
$multilang_ATMOSPHERICMODEL_1 = "Main Monitor";
$multilang_ATMOSPHERICMODEL_2 = "Environmental Chart & Summary";
$multilang_ATMOSPHERICMODEL_3 = "missing variable - 'ZONE NAME'";
$multilang_ATMOSPHERICMODEL_4 = "Zone";
$multilang_ATMOSPHERICMODEL_5 = "Temperature";
$multilang_ATMOSPHERICMODEL_6 = "Humidity";
$multilang_ATMOSPHERICMODEL_7 = "Pressure";
$multilang_ATMOSPHERICMODEL_8 = "AVERAGE TEMPERATURE";
$multilang_ATMOSPHERICMODEL_9 = "AVERAGE HUMIDITY";
$multilang_ATMOSPHERICMODEL_10 = "AVERAGE PRESSURE";
$multilang_ATMOSPHERICMODEL_11 = "RECORDS EXAMINED";
$multilang_ATMOSPHERICMODEL_12 = "CURRENT TEMPERATURE";
$multilang_ATMOSPHERICMODEL_13 = "CURRENT HUMIDITY";
$multilang_ATMOSPHERICMODEL_14 = "CURRENT PRESSURE";
$multilang_ATMOSPHERICMODEL_16 = "min.";
$multilang_ATMOSPHERICMODEL_17 = "DEFROST RUNNING";
/*		-- to be read as "[abbreviation for] minutes" */

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_ATMOSPHERICMODEL_15 = $multilang_STATIC_EXAMINATION_WINDOW;
/*			-- do not edit this block unless modifying program */

/*	-- CHECKWEIGHERMODEL */
/* 	-------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CHECKWEIGHERMODEL_0 = "CHECKWEIGHER MODEL";
$multilang_CHECKWEIGHERMODEL_1 = "modify RECIPE";
$multilang_CHECKWEIGHERMODEL_2 = "RECIPE to MODIFY";
$multilang_CHECKWEIGHERMODEL_3 = "remove RECIPE";
$multilang_CHECKWEIGHERMODEL_4 = "RECIPE to REMOVE";
$multilang_CHECKWEIGHERMODEL_5 = "add RECIPE and parameters";
$multilang_CHECKWEIGHERMODEL_6 = "RECIPE";
$multilang_CHECKWEIGHERMODEL_7 = "All RECIPE variable fields must be filled out completely before a RECIPE can be added. Please review the form, complete it, and resubmit.";
$multilang_CHECKWEIGHERMODEL_8 = "RESTRICTED TO ADMINISTRATORS and SUPER USERS.";
$multilang_CHECKWEIGHERMODEL_9 = "Settings: add RECIPE";
$multilang_CHECKWEIGHERMODEL_10 = "RECIPE NAME";
$multilang_CHECKWEIGHERMODEL_11 = "a unique name for the recipe";
$multilang_CHECKWEIGHERMODEL_12 = "TARGET";
$multilang_CHECKWEIGHERMODEL_13 = "desired mass";
$multilang_CHECKWEIGHERMODEL_14 = "DELTA MIN";
$multilang_CHECKWEIGHERMODEL_15 = "reject at this amount BELOW TARGET";
$multilang_CHECKWEIGHERMODEL_16 = "DELTA MAX";
$multilang_CHECKWEIGHERMODEL_17 = "reject at this amount ABOVE TARGET";
$multilang_CHECKWEIGHERMODEL_18 = "Commit RECIPE addition";
$multilang_CHECKWEIGHERMODEL_19 = "This RECIPE was successfully added to the Database.";
$multilang_CHECKWEIGHERMODEL_20 = "If you would like to add another RECIPE, click here...";
$multilang_CHECKWEIGHERMODEL_21 = "remove RECIPE";
$multilang_CHECKWEIGHERMODEL_22 = "The recipe has been removed, as you requested.  You should have been automatically redirected to the SEER settings page already... if not, navigate there using the Menu, at the top of the page.";
$multilang_CHECKWEIGHERMODEL_23 = "Settings: modify RECIPE";
$multilang_CHECKWEIGHERMODEL_24 = "Commit RECIPE modification";
$multilang_CHECKWEIGHERMODEL_25 = "CREATED DATE";
$multilang_CHECKWEIGHERMODEL_26 = "CREATED BY";
$multilang_CHECKWEIGHERMODEL_27 = "UPDATED DATE";
$multilang_CHECKWEIGHERMODEL_28 = "UPDATED BY";
$multilang_CHECKWEIGHERMODEL_29 = "POPULATE SYPHON TABLE";
$multilang_CHECKWEIGHERMODEL_30 = "populate SYPHON table";
$multilang_CHECKWEIGHERMODEL_31 = "The output should include an entry for each machine listed in each of your localoptions files.";
$multilang_CHECKWEIGHERMODEL_32 = "Department Monitor";
$multilang_CHECKWEIGHERMODEL_33 = "Runtime Analysis and Summary";
$multilang_CHECKWEIGHERMODEL_34 = "TARE";
$multilang_CHECKWEIGHERMODEL_35 = "non-product mass";
$multilang_CHECKWEIGHERMODEL_36 = "Recipe Control";
$multilang_CHECKWEIGHERMODEL_37 = "The checkweigher you are looking for does not exist in the syphon machine database.  Check with your System Administrator, and be sure that he or she has run the command 'Populate SYPHON Table' from the 'Settings' tab in SEER.";
$multilang_CHECKWEIGHERMODEL_38 = "The checkweigher is scheduled out of service or not in use at the present time.";
$multilang_CHECKWEIGHERMODEL_39 = "The checkweigher is in service, however no item weights have been recorded during the snapshot time (recent history).  Typically this indicates that the production line is down for some reason.  However, if it is running, then this indicates that the checkweigher's communication with syphon is down and must be corrected (contact a System Administrator).";
$multilang_CHECKWEIGHERMODEL_40 = "DOES NOT EXIST!";
$multilang_CHECKWEIGHERMODEL_41 = "Idle / Out of Service";
$multilang_CHECKWEIGHERMODEL_42 = "Idle / In Service but No Activity";
$multilang_CHECKWEIGHERMODEL_43 = "Recent History time Window";
$multilang_CHECKWEIGHERMODEL_44 = "Minimum";
$multilang_CHECKWEIGHERMODEL_45 = "Maximum";
$multilang_CHECKWEIGHERMODEL_46 = "Quantity";
$multilang_CHECKWEIGHERMODEL_47 = "Total Mass";
$multilang_CHECKWEIGHERMODEL_48 = "Mean Mass";
$multilang_CHECKWEIGHERMODEL_49 = "Scale Rate";
$multilang_CHECKWEIGHERMODEL_50 = "min.";
/*			-- to be read as abbreviation for 'minute' */
$multilang_CHECKWEIGHERMODEL_51 = "Accepted";
$multilang_CHECKWEIGHERMODEL_52 = "Rejected";
$multilang_CHECKWEIGHERMODEL_53 = "The checkweigher is scheduled out of service or not in use at the present time - however the checkweigher is reporting data to the recording system.  This typically occurs when the line is actually running, but the Operator has neglected to enter the current Checkweigher Recipe into SEER.  You are advised to inspect the checkweigher in person and determine if this is the case.";
$multilang_CHECKWEIGHERMODEL_54 = "RECIPE to PUSH to CheckWeigher / Update RUNNING RECIPE";
$multilang_CHECKWEIGHERMODEL_55 = "Last 10 Samples";
$multilang_CHECKWEIGHERMODEL_56 = "Individual Weight Output";
$multilang_CHECKWEIGHERMODEL_57 = "Scale to Examine";
$multilang_CHECKWEIGHERMODEL_58 = "Checkweigher";
$multilang_CHECKWEIGHERMODEL_59 = "SCALE TO EXAMINE was not selected.  You must select the checkweigher that you wish to examine before you may generate a report.  Please go back to the previous menu, and fill the form out completely.";
$multilang_CHECKWEIGHERMODEL_60 = "GROSS MASS";
$multilang_CHECKWEIGHERMODEL_61 = "NET MASS";
$multilang_CHECKWEIGHERMODEL_62 = "RESULT";
$multilang_CHECKWEIGHERMODEL_63 = "CHECKWEIGHER";
$multilang_CHECKWEIGHERMODEL_64 = "you may choose to view only a sampling of the records returned (Large or Small), spread out evenly over time; or, you may choose to view each and every record.  Be advised, viewing every record is a massive report, and if you select more than an hour or so (depening on how many products per minute your scale can run), you may lock up your browser.  The recommended method is to view a 'sampling', and then go back and view 'every record' only for those periods of time that showed interest in the 'sampling'.";
$multilang_CHECKWEIGHERMODEL_65 = "Report Method";
$multilang_CHECKWEIGHERMODEL_66 = "Small Periodic Sample";
$multilang_CHECKWEIGHERMODEL_67 = "Examine Every Record";
$multilang_CHECKWEIGHERMODEL_68 = "REPORT METHOD was not selected.  You must select the reporting method you wish to use before you may generate a report.  Please go back to the previous menu, and fill the form out completely.";
$multilang_CHECKWEIGHERMODEL_69 = "Large Periodic Sample";
$multilang_CHECKWEIGHERMODEL_70 = "Rate";
$multilang_CHECKWEIGHERMODEL_71 = "Standard Deviation";
$multilang_CHECKWEIGHERMODEL_72 = "PLOT OF THE NORMAL DISTRIBUTION";
$multilang_CHECKWEIGHERMODEL_73 = "UNIT REJECTIONS RECORDED DURING THIS RECIPE INSTANCE";
$multilang_CHECKWEIGHERMODEL_74 = "GIVEAWAY or TAKEAWAY";
$multilang_CHECKWEIGHERMODEL_75 = "Giveaway";
$multilang_CHECKWEIGHERMODEL_76 = "Takeaway";
$multilang_CHECKWEIGHERMODEL_77 = "Expected Accepted Production";
$multilang_CHECKWEIGHERMODEL_78 = "Actual Accepted Production";
$multilang_CHECKWEIGHERMODEL_79 = "Difference";
$multilang_CHECKWEIGHERMODEL_80 = "Display Rejects";
$multilang_CHECKWEIGHERMODEL_81 = "OPERATOR";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
/*	-- none as of yet */
/*			-- do not edit this block unless modifying program */

/*	-- WARRIOR */
/*	---------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_WARRIOR_0 = "WARRIOR";
$multilang_WARRIOR_1 = "add RESOURCE and description";
$multilang_WARRIOR_2 = "modify RESOURCE";
$multilang_WARRIOR_3 = "Settings: add RESOURCE";
$multilang_WARRIOR_4 = "RESOURCE NUMBER";
$multilang_WARRIOR_5 = "a unique resource number";
$multilang_WARRIOR_6 = "RESOURCE DESCRIPTION";
$multilang_WARRIOR_7 = "a description of the resource";
$multilang_WARRIOR_8 = "Commit RESOURCE Addition";
$multilang_WARRIOR_9 = "The desired RESOURCE NUMBER already exists!  If you wish to add a new record you must first delete the existing RESOURCE.";
$multilang_WARRIOR_10 = "All RESOURCE variable fields must be filled out completely before a RESOURCE can be added. Please review the form, complete it, and resubmit.";
$multilang_WARRIOR_11 = "RESTRICTED TO ADMINISTRATORS, SUPER USERS, and MANAGERS.";
$multilang_WARRIOR_12 = "This RESOURCE was successfully added to the Database.";
$multilang_WARRIOR_13 = "If you would like to add another RESOURCE, click here...";
$multilang_WARRIOR_14 = "Settings: modify RESOURCE";
$multilang_WARRIOR_15 = "Commit RESOURCE Modification";
$multilang_WARRIOR_16 = "remove RESOURCE";
$multilang_WARRIOR_17 = "The resource has been removed, as you requested.  You should have been automatically redirected to the SEER settings page already... if not, navigate there using the Menu, at the top of the page.";
$multilang_WARRIOR_18 = "RESOURCE Number to MODIFY";
$multilang_WARRIOR_19 = "RESOURCE Number to REMOVE";
$multilang_WARRIOR_20 = "O.E.E.";
$multilang_WARRIOR_21 = "Main Monitor & Control";
$multilang_WARRIOR_22 = "SELECT MACHINE";
$multilang_WARRIOR_23 = "Launch Console";
$multilang_WARRIOR_24 = "Machine Identification";
$multilang_WARRIOR_25 = "select your Machine from the drop down menu, and launch the Live Console.";
$multilang_WARRIOR_26 = "Operations";
$multilang_WARRIOR_27 = "SELECT";
$multilang_WARRIOR_28 = "CORRECTIVE ACTION";
$multilang_WARRIOR_29 = "Update";
$multilang_WARRIOR_30 = "OPERATOR or TRADESMAN";
$multilang_WARRIOR_31 = "Abandon Machine";
$multilang_WARRIOR_32 = "Assume Control of Machine";
$multilang_WARRIOR_33 = "MAINTENANCE MODE";
$multilang_WARRIOR_34 = "Enter Maintenance Mode";
$multilang_WARRIOR_35 = "Release to Production";
$multilang_WARRIOR_36 = "SCHEDULE NUMBER";
$multilang_WARRIOR_37 = "An Operator must Assume Control of a machine before they may modify the SCHEDULE_NUMBER, RESOURCE_NUMBER, or CORRECTIVE_ACTION.  Similarly, Skilled Tradesmen must assume control of a machine before they may put it into MAINTENANCE_MODE (or RELEASE_TO_PRODUCTION).";
$multilang_WARRIOR_38 = "Machine Status";
$multilang_WARRIOR_39 = "Status cannot be determined at this time due to lack of sufficient data.  If you believe this to be an error, please contact a SYSTEM ADMINISTRATOR for assistance.";
$multilang_WARRIOR_40 = "DATA FRESH AS OF";
$multilang_WARRIOR_41 = "CURRENT OPERATOR";
$multilang_WARRIOR_44 = "MACHINE STATUS";
$multilang_WARRIOR_45 = "ALARM STATUS";
$multilang_WARRIOR_47 = "PACKAGE CLASS";
$multilang_WARRIOR_48 = "PACKAGES PER CYCLE";
$multilang_WARRIOR_49 = "CYCLES [this resource & schedule]";
$multilang_WARRIOR_50 = "UNITS";
$multilang_WARRIOR_51 = "MASS";
$multilang_WARRIOR_52 = "Recent Production Summary";
$multilang_WARRIOR_53 = "min.";
/*			-- to be read as [abbreviation for] 'minutes' */
$multilang_WARRIOR_54 = "RESOURCE Time";
$multilang_WARRIOR_55 = "RUN Time";
$multilang_WARRIOR_56 = "Recent UNITS";
$multilang_WARRIOR_57 = "NOT SCHEDULED";
$multilang_WARRIOR_58 = "DOWN Time";
$multilang_WARRIOR_59 = "hour";
$multilang_WARRIOR_60 = "PERFORMANCE";
$multilang_WARRIOR_61 = "AVAILABILITY";
$multilang_WARRIOR_62 = "O.E.E.";
$multilang_WARRIOR_63 = "T.E.E.P.";
$multilang_WARRIOR_64 = "LOADING";
$multilang_WARRIOR_65 = "RUN";
$multilang_WARRIOR_66 = "DOWN";
$multilang_WARRIOR_68 = "Department Monitor";
$multilang_WARRIOR_69 = "Line";
/*			-- to be read as... [production]'line' */
$multilang_WARRIOR_70 = "EFFECTIVE LINE RATE";
$multilang_WARRIOR_71 = "TARGET LINE RATE";
$multilang_WARRIOR_72 = "TOTALS, THIS SCHEDULED RESOURCE";
$multilang_WARRIOR_73 = "Gross Throughput";
$multilang_WARRIOR_74 = "enter your START date and END date.  You may choose to view data for ALL shifts, a particular shift, or select a CUSTOM time (shift) range.  If you choose to use a CUSTOM shift, then you must select a CUSTOM START HOUR and a CUSTOM END HOUR, otherwise, you may leave these fields blank.";
$multilang_WARRIOR_75 = "SHIFT";
$multilang_WARRIOR_76 = "CUSTOM";
$multilang_WARRIOR_77 = "ALL";
$multilang_WARRIOR_78 = "Custom START Hour";
$multilang_WARRIOR_79 = "Custom END Hour";
$multilang_WARRIOR_80 = "When selecting the 'CUSTOM' work shift, you must specify a START and END Hour as a time range to be examined.  One of these is blank.";
$multilang_WARRIOR_81 = "Machine";
$multilang_WARRIOR_82 = "TOTAL Units";
$multilang_WARRIOR_83 = "TOTAL Mass";
$multilang_WARRIOR_84 = "SYNERGISTIC TOTALS";
$multilang_WARRIOR_85 = "overall department production";
$multilang_WARRIOR_86 = "DISCRETE TOTALS";
$multilang_WARRIOR_87 = "individual machine SCHEDULED RESOURCE instances";
$multilang_WARRIOR_88 = "End of Run";
$multilang_WARRIOR_89 = "the START and END hours can NOT be the same; this results in a shift duration of zero hours.";
$multilang_WARRIOR_90 = "this totalizer has tested within 0.15% accuracy, results are promised within 0.25% accuracy; this small deviation is due to 'rounding' time up or down at shift change points.";
$multilang_WARRIOR_91 = "Maintenance Mode History";
$multilang_WARRIOR_92 = "Maintenance START";
$multilang_WARRIOR_93 = "Maintenance END";
$multilang_WARRIOR_94 = "Duration";
$multilang_WARRIOR_95 = "Maintenance Type";
$multilang_WARRIOR_96 = "individual machine MAINTENANCE MODE instances";
$multilang_WARRIOR_97 = "overall department MAINTENANCE MODE statistics";
$multilang_WARRIOR_98 = "TOTAL Breakdown Time";
$multilang_WARRIOR_99 = "TOTAL Scheduled Time";
$multilang_WARRIOR_100 = "TOTAL Maintenance Time";
$multilang_WARRIOR_101 = "hrs.";
/*			-- to be read as [abbreviation for] 'hours' */
$multilang_WARRIOR_102 = "O.E.E., T.E.E.P., & Downtime Analysis";
$multilang_WARRIOR_103 = "overall department performance";
$multilang_WARRIOR_104 = "Time Period";
/*			-- to be read as 'length of time' or 'time period' */
$multilang_WARRIOR_105 = "individual Alarm and Downtime instances";
$multilang_WARRIOR_108 = "Low detail - SUMMARY ONLY";
$multilang_WARRIOR_109 = "Medium detail - Incident Report for Occurrances lasting longer than 10 minutes";
$multilang_WARRIOR_110 = "High detail - Incident Report for Occurrances lasting longer than 5 minutes";
$multilang_WARRIOR_111 = "Extreme detail - Incident Report for ALL Occurrances (regardless of duration)";
$multilang_WARRIOR_112 = "DETAIL LEVEL";
$multilang_WARRIOR_113 = "ALARM Type";
$multilang_WARRIOR_114 = "machine down as scheduled";
$multilang_WARRIOR_115 = "machine down for lunch or other work break";
$multilang_WARRIOR_116 = "machine down due to fault or breakdown";
$multilang_WARRIOR_117 = "individual machine PARETO of DOWNTIME occurrances";
$multilang_WARRIOR_118 = "RANK";
$multilang_WARRIOR_119 = "individual machine PARETO of NOT SCHEDULED occurrances";
$multilang_WARRIOR_120 = "HYBRID ANALYSIS";
$multilang_WARRIOR_121 = "DISCRETE ANALYSIS";
$multilang_WARRIOR_122 = "individual machine PARETO of CLASSIFIED NOT SCHEDULED occurances";
$multilang_WARRIOR_123 = "individual machine PARETO of CLASSIFIED DOWNTIME occurances";
$multilang_WARRIOR_124 = "ALARM Class";
$multilang_WARRIOR_125 = "The name, 'WARRIOR', is a trademark / copyright of Ultimate Creations, Inc. 1997 - 2010";
$multilang_WARRIOR_126 = "The eponymous naming of the S.E.E.R. Overall Equipment Efficiency / Total Equipment Effective Performance module is a combination of several things -- an acronym ([W]orkplace [A]uthenticated [R]esource [R]untime [I]nput and [O]utput [R]eporter), a comment on the circumstances surrounding the module's creation and what it represents to the author, as well as an homage to the man (of the same name) who brings focus and inspiration to so many.";
$multilang_WARRIOR_127 = "sorting status for each associated array is indicated by 'Green' for successful or 'Red' for failed... Successful sorting is required for accurate identification of event and time.";
$multilang_WARRIOR_128 = "populate SCHEDULE table";
$multilang_WARRIOR_129 = "POPULATE SCHEDULE TABLE";
$multilang_WARRIOR_130 = "The output should include an entry for each machine listed in each of your localoptions files.";
$multilang_WARRIOR_131 = "percentage of DOWNTIME";
$multilang_WARRIOR_132 = "percentage of TOTAL TIME";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_WARRIOR_42 = $multilang_WARRIOR_36;
$multilang_WARRIOR_43 = $multilang_WARRIOR_4;
$multilang_WARRIOR_46 = $multilang_WARRIOR_28;
$multilang_WARRIOR_67 = $multilang_WARRIOR_57;
$multilang_WARRIOR_106 = $multilang_STATIC_START;
$multilang_WARRIOR_107 = $multilang_STATIC_END;
$multilang_WARRIOR_133 = $multilang_CHECKWEIGHERMODEL_12;
$multilang_WARRIOR_134 = $multilang_WARRIOR_60;
$multilang_WARRIOR_135 = $multilang_CHECKWEIGHERMODEL_81;
$multilang_WARRIOR_136 = $multilang_CIPMODEL_18;
/*			-- do not edit this block unless modifying program */

/*	-- WARRIOR FOR LABEL PLUGINS */
/*	---------------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_WARRIOR_LABEL_1 = "PRINTING";
$multilang_WARRIOR_LABEL_2 = "STOPPED";
$multilang_WARRIOR_LABEL_3 = "REQUEST NEW LABELS";
$multilang_WARRIOR_LABEL_4 = "CANCEL LABELS";
$multilang_WARRIOR_LABEL_5 = "BATCH";
$multilang_WARRIOR_LABEL_6 = "Current Status";
$multilang_WARRIOR_LABEL_12 = "DATE CODE";
$multilang_WARRIOR_LABEL_13 = "Palletization End of Run Status";
$multilang_WARRIOR_LABEL_14 = "END of RUN";
$multilang_WARRIOR_LABEL_15 = "PENDING END of RUN";
$multilang_WARRIOR_LABEL_16 = "invalid schedule number";
$multilang_WARRIOR_LABEL_17 = "Error or Info Messages";
$multilang_WARRIOR_LABEL_18 = "labels cancelled";
$multilang_WARRIOR_LABEL_19 = "label request successful";
$multilang_WARRIOR_LABEL_20 = "invalid user input data";
$multilang_WARRIOR_LABEL_21 = "MODIFY LABELS";
$multilang_WARRIOR_LABEL_22 = "label update successful";
$multilang_WARRIOR_LABEL_23 = "failed to change batch number";
$multilang_WARRIOR_LABEL_24 = "PRODUCTION DATE";
$multilang_WARRIOR_LABEL_25 = "failed to start labeling system";
$multilang_WARRIOR_LABEL_26 = "FORCE CANCEL";
$multilang_WARRIOR_LABEL_27 = "failed to cancel labeling system action";
$multilang_WARRIOR_LABEL_28 = "current status of labeling system cannot be determined, no feedback";
$multilang_WARRIOR_LABEL_29 = "error number generated by labeling system";
$multilang_WARRIOR_LABEL_30 = "failed to communicate properly with labeling system server";
$multilang_WARRIOR_LABEL_31 = "FORCE ALL CANCEL";
$multilang_WARRIOR_LABEL_32 = "pending action in progress!";
$multilang_WARRIOR_LABEL_33 = "APlus plugin actions are logged.  This includes both user command buttons and the plugin's resulting system actions.  Due to the serialization of actions, it is not useful to display only faults.  Rather, you should select a time range to view, and all actions will be displayed over that time range.";
$multilang_WARRIOR_LABEL_34 = "Action History Search";
$multilang_WARRIOR_LABEL_35 = "missing variable - 'LINE'";
$multilang_WARRIOR_LABEL_36 = "fallback";
$multilang_WARRIOR_LABEL_37 = "labeling system does not answer request to confirm system status, contact administrator";
$multilang_WARRIOR_LABEL_38 = "labeling system reports an unexpected runtime status change, labeling has been re-synchronized";
$multilang_WARRIOR_LABEL_39 = "Package Destination Counter";
$multilang_WARRIOR_LABEL_40 = "HAND STACK PALLET WEIGHT";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_WARRIOR_LABEL_7 = $multilang_TANKMODEL_95;
$multilang_WARRIOR_LABEL_8 = $multilang_WARRIOR_36;
$multilang_WARRIOR_LABEL_9 = $multilang_WARRIOR_4;
$multilang_WARRIOR_LABEL_10 = $multilang_WARRIOR_LABEL_5;
$multilang_WARRIOR_LABEL_11 = $multilang_CHECKWEIGHERMODEL_81;
/*			-- do not edit this block unless modifying program */

/*	-- THIN CHART */
/* 	------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_THINCHART_0 = "THIN CHART";
$multilang_THINCHART_4 = "Plotted Chart";
$multilang_THINCHART_5 = "missing variable - 'CHART NAME'";
$multilang_THINCHART_8 = "EVENT Name";
$multilang_THINCHART_9 = "EVENT";
$multilang_THINCHART_10 = "Select your System from the drop down menu, and then enter a START and END time range.  Any records that are available for CERTIFICATION will be displayed to you.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_THINCHART_1 = $multilang_TANKMODEL_1;
$multilang_THINCHART_2 = $multilang_TANKMODEL_3;
$multilang_THINCHART_3 = $multilang_TANKMODEL_4;
$multilang_THINCHART_6 = $multilang_CIPMODEL_68;
$multilang_THINCHART_7 = $multilang_CIPMODEL_36;
$multilang_THINCHART_11 = $multilang_TANKMODEL_128;
$multilang_THINCHART_12 = $multilang_TANKMODEL_129;
$multilang_THINCHART_13 = $multilang_WARRIOR_77;
/*			-- do not edit this block unless modifying program */

/*	-- TOUCH PANEL */
/* 	-------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TOUCHPANEL_0 = "TOUCH PANEL";
$multilang_TOUCHPANEL_1 = "Launch";
$multilang_TOUCHPANEL_2 = "Notice";
$multilang_TOUCHPANEL_3 = "This S.E.E.R. model consists only of 'hmi' interfaces.  Please use the 'Machine Control' tab to navigate.  Thank you.";
$multilang_TOUCHPANEL_4 = "Active Screen";
$multilang_TOUCHPANEL_5 = "panel";
$multilang_TOUCHPANEL_6 = "Switch to Screen";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */

/*			-- do not edit this block unless modifying program */

/*	-- CANVAS */
/* 	--------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CANVAS_0 = "PopUP CANVAS";
$multilang_CANVAS_1 = "ERROR - content of canvas has not been declared.";
$multilang_CANVAS_2 = "Close this PopUP window or tab to return to your session.";
$multilang_CANVAS_3 = "ERROR - title not declared";
$multilang_CANVAS_4 = "Scale PopUP for Precision View";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */

/*			-- do not edit this block unless modifying program */

/*	-- TTY PERFORMANCE MODEL */
/* 	------------------------ */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TTYPERFORMANCEMODEL_0 = "TTY PERFORMANCE MODEL";
$multilang_TTYPERFORMANCEMODEL_2 = "Individual Entry Output";
$multilang_TTYPERFORMANCEMODEL_16 = "individual device performance";
$multilang_TTYPERFORMANCEMODEL_18 = "ALL INCLUDED DEVICES";
$multilang_TTYPERFORMANCEMODEL_19 = "EXCLUDED DEVICES";
$multilang_TTYPERFORMANCEMODEL_22 = "missing variable - 'MACHINE_ID'";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_TTYPERFORMANCEMODEL_1 = $multilang_CHECKWEIGHERMODEL_33;
$multilang_TTYPERFORMANCEMODEL_3 = $multilang_CHECKWEIGHERMODEL_32;
$multilang_TTYPERFORMANCEMODEL_4 = $multilang_CHECKWEIGHERMODEL_42;
$multilang_TTYPERFORMANCEMODEL_5 = $multilang_FAULT_39;
$multilang_TTYPERFORMANCEMODEL_6 = $multilang_STATIC_123;
$multilang_TTYPERFORMANCEMODEL_7 = $multilang_STATIC_FAULTS_CAPS;
$multilang_TTYPERFORMANCEMODEL_8 = $multilang_WARRIOR_60;
$multilang_TTYPERFORMANCEMODEL_9 = $multilang_SPFMODEL_46;
$multilang_TTYPERFORMANCEMODEL_10 = $multilang_STATIC_SELECT_FROM_DROPDOWN_BRIEF;
$multilang_TTYPERFORMANCEMODEL_11 = $multilang_CHECKWEIGHERMODEL_67;
$multilang_TTYPERFORMANCEMODEL_12 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_TTYPERFORMANCEMODEL_13 = $multilang_SPFMODEL_15;
$multilang_TTYPERFORMANCEMODEL_14 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_TTYPERFORMANCEMODEL_15 = $multilang_WARRIOR_86;
$multilang_TTYPERFORMANCEMODEL_17 = $multilang_WARRIOR_84;
$multilang_TTYPERFORMANCEMODEL_20 = $multilang_WARRIOR_103;
$multilang_TTYPERFORMANCEMODEL_21 = $multilang_STATIC_SELECT_FROM_DROPDOWN;
/*			-- do not edit this block unless modifying program */

?>
