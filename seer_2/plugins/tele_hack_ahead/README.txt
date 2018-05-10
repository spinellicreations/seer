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
README
---------------------------------------------------------------------

Required Version of SEER --

	Requires build 24, version 1.5.0 minimum.

Purpose --

	tele_hack_ahead is a S.E.E.R. plugin which is intended to 
	overcome lacking features in older web browsers.

	Modern browsers (some better than others) support 'type ahead'
	in drop down (also called "select") HTML forms.  Firefox and
	Opera are especially good at this.  Modern Internet Explorer 
	is also well behaved.

	Older browsers, specifically the widely used, though personally
	loathed MSIE-6, do not.

	This plugin is a java-script hack that implements an admin
	configurable type-ahead buffer.

Source --

	It is based on the work of Dr. Mingyi Liu, Ph.D - who hosts
	a web presence at http://www.mingyi.org

	His work does not bear any stated license, but is instead
	posted in full and indicated as available for free use to
	all.  

	[quote]
		The author hereby grants you license to freely distribute 
		or modify the script for whatever purposes.  For any bug 
		report or feature request, please send email to 
		mingyiliu@yahoo.com
	[/quote]

	For the purposes of this implementation, you should treat
	his work as if it were MIT licensed, and do not use it 
	without citing the source.

How To --

	Simply copy this plugin to /[seer_web_root]/plugins/tele_hack_ahead

	Then, edit the S.E.E.R. global options file, and update the
	plugins array to include "tele_hack_ahead"... for example...

	$seer_PLUGINS_TO_USE = array("some_other_plugin","tele_hack_ahead");

Potential Issues --

	It is far from a perfect implementation - primarily because we're
	trying to fix base level browser issues - or should I say work
	around them.  This is not the 'job' of S.E.E.R., but we have 
	enough users stuck with back-water outdated browsers that we
	thought it prudent to at least offer this work around.

	- trident browsers
		- IE:		v6 and early builds of 7... works well. *1
	- gecko browsers
		- Firefox: 	v2... works well. *1 / *3
		- Netscape	up to 9 (final). *3
	- webkit browsers 
		- safari, etc.	not applied	*2
	- presto browsers
		- opera		not applied

	*1 - gracefully works with newer versions that already implement type ahead.

	*2 - Safari and Konqueror 'half' work.  That is to say that if you click on
	     the drop down selector, and then click it again (or simply tab over to it
	     so that it doesn't actually 'drop'), then the plugin actually works.
	     However, as soon as you actually drop the selector window open, then
	     the plugin will fail to perform as expected (won't do anything, but
	     does not cause harm either).
	
		** NOT USED ON THESE BROWSERS, THEY ALREADY HAVE TYPE AHEAD

	*3 - overcomes / works around a bug in the browser's own implementation
	     of type ahead, to give you a better experience.

	The original S.E.E.R. browser compatability list still applies,
	this is simply 'compatability' of this particular plugin.  That said,
	this plugin is --NOT-- necessary for basic S.E.E.R. compatability with
	any browser listed above (or on the original browser list).  Rather,
	this plugin simply enables 'type ahead' in browsers that do not natively
	support it -- 'type-ahead' is not a required criteria for browser
	compatability.  It's just a very nice feature / ability to have.
	

eof
