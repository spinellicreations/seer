<?php

/*
---------------------------------------------------------------------
---------------------------------------------------------------------
GROUPE LACTALIS (USA) tele_hack_ahead FOR S.E.E.R.
---------------------------------------------------------------------
---------------------------------------------------------------------
COPYRIGHT

 THE FOLLOWING 34 LINES MAY NOT BE REMOVED, but may be
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
DEPENDANCY COPYRIGHT

 This file is a dependancy, required by tele_hack_ahead,
 and is the sole work of Mingyi Liu 2004-06.

 This script is freeware by author Mingyi Liu and comes with no 
 warranty whatsoever. In no case should the author be held liable for 
 anything including loss/damage of any kind as the result of using this
 script.
 The author hereby grants you license to freely distribute or modify 
 the script for whatever purposes.

 This version is 1.1.
	... http://www.mingyi.org
---------------------------------------------------------------------
---------------------------------------------------------------------
CONTACT		
		Author			V. Spinelli
				Email:	Vince@SpinelliCreations.com
				Site:	http://spinellicreations.com
				Handle:	PoweredByDodgeV8

		Dependancy Author	Dr. Mingyi Liu, Ph.D
				Email: 	mingyiliu@yahoo.com
				Site:	http://www.mingyi.org

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
---------------------------------------------------------------------
tele_hack_ahead PLUGIN - EXECUTION
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
/* EXECUTE FIND AND REPLACE */
/* ------------------------------------------------------------------ */
/* ------------------------------------------------------------------ */

$THA_old_html_form_select_open = "<SELECT ";

$THA_new_html_form_select_open = "<SELECT onFocus='ml_autocomplete.populate(event)' onKeyDown='ml_autocomplete.setSelection(event)' onkeypress='return ml_autocomplete.cancel(event)' ";

$apache_REPORT = str_replace($THA_old_html_form_select_open, $THA_new_html_form_select_open, $apache_REPORT);

?>
