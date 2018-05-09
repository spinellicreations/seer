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
TANK HMI 0-A BODY (INCLUDED TO ALL TANKMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* APPEND THE REFERRING PAGE WHEN GENERATED VIA */
/*    seer_REFERRINGPAGE_THISHMI_0 */
/* ------------------------------------------------------------------ */
$seer_REFERRINGPAGE_APPEND = "";
/*	-- what would you like to append to the REFERRINGPAGE after keys have been generated */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_55."</B><BR>
								<I>".$TANKMODEL_SUBPAGETITLE."</I><BR>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DOES THIS MODEL HAVE AGITATION CONTROL ENABLED */
/* ------------------------------------------------------------------ */
/* -- if so, proceed */
/* -- if not, echo error and direct back */
if ( $TANKMODEL_UTILIZE_AGITATOR_CONTROL == 'YES' ) {
	/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
	$seer_HMIACTION = "DISPLAY_START_PAGE";
	$seer_HMIACTION_FAULT = 0;
} else {
	$seer_HMIACTION_FAULT = 1;
	$seer_FAULT_TYPE = "<I>".$TANKMODEL_SUBPAGETITLE."</I> -- ".$multilang_TANKMODEL_54;
}

/* HANDLE FAULTS */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION_FAULT == 1 ) {
	$seer_HMIACTION = "DISPLAY_FAULT_PAGE";
} else {
	/* pass */
}

/* FAULT PAGE */
/* -- SOMETHING DIDN'T GO RIGHT, SO LET THE USER KNOW */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_FAULT_PAGE" ) {
	core_user_conditionally_executed_fault_page_body();
}

/* START PAGE */
/* -- REPORT TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	
	/* HEADER FOR THIS SCREEN */
	$apache_REPORT_RECORDENTRY = "
							<TABLE CLASS='STANDARD' ALIGN='CENTER' WIDTH='600' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='100'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='200'>
									</TD>
									<TD WIDTH='100'>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<P CLASS='INFOREPORT'>
											<B><U>".$multilang_STATIC_NOTE.":</U></B> ".$multilang_TANKMODEL_53."<BR>
											<BR>
											".$multilang_TANKMODEL_52."
										</P>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='2' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_13."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_51."</U></B>
									</TD>
									<TD ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_50."</U></B>
									</TD>
								</TR>
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
								";
	/* BODY OF THE SCREEN */
	$TANKMODEL_AGITATOR_BUILTINHTTP_GROUP1_CYCLE = 0;
	$apache_SWITCH_ROW_COLOR = 0;
	while ( $TANKMODEL_AGITATOR_BUILTINHTTP_GROUP1_CYCLE <= $TANKMODEL_MEMBERS_AGITATOR_GROUP1_ADJUSTED ) {
		/* FLIP FLOP ROW COLOR */
		$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();
		$KEY = $TANKMODEL_AGITATOR_GROUP1[$TANKMODEL_AGITATOR_BUILTINHTTP_GROUP1_CYCLE];
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD COLSPAN='2' ALIGN='CENTER'>
										".$TANKMODEL_NAME[$KEY]."
									</TD>
									<TD ALIGN='CENTER'>
										".$TANKMODEL_AGITATOR_MFGMODEL_GROUP1[$KEY]."
									</TD>
									<TD ALIGN='CENTER' BGCOLOR='#FFFFFF'>
										<A HREF='".$TANKMODEL_AGITATOR_BUILTINHTTP_GROUP1[$KEY]."' TARGET='AGITATOR_BUILTINHTTP_WINDOW'><IMG STYLE='border:0' SRC='./img/form_submit_0.png' ALT='display drive status'></A>
									</TD>
								</TR>
								";
		$TANKMODEL_AGITATOR_BUILTINHTTP_GROUP1_CYCLE = $TANKMODEL_AGITATOR_BUILTINHTTP_GROUP1_CYCLE + 1;
	}	
	/* FOOTER FOR THE SCREEN */
	$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							</TABLE>
							";
}

/* HANDLE FAULTS */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION_FAULT == 1 ) {
	$seer_HMIACTION = "DISPLAY_FAULT_PAGE";
} else {
	/* pass */
}

/* FAULT PAGE */
/* -- SOMETHING DIDN'T GO RIGHT, SO LET THE USER KNOW */
/* ------------------------------------------------------------------ */
core_user_conditionally_executed_fault_page_body();
	
/* ACCESS LEVEL DEPENDANT REPORT SECTIONS */
/* ------------------------------------------------------------------ */
$apache_REPORTL7 = $apache_REPORT_RECORDENTRY; 
$apache_REPORTL6 = "";
$apache_REPORTL5 = "";
$apache_REPORTL4 = "";
$apache_REPORTL3 = "";
$apache_REPORTL2 = "";
$apache_REPORTL1 = "";

/* FINISHED REPORT */
/* ------------------------------------------------------------------ */
seer_final_report();

?>
