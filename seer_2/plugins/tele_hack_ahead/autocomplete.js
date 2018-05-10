/* 
---------------------------------------------------------------------
---------------------------------------------------------------------
GROUPE LACTALIS (USA) tele_hack_ahead FOR S.E.E.R.
---------------------------------------------------------------------
---------------------------------------------------------------------
COPYRIGHT

 THE FOLLOWING 26 LINES MAY NOT BE REMOVED, but may be
     appended with additional contributor info.
 tele_hack_ahead (plugin) Copyright (C) 2011
 V. Spinelli for Sorrento Lactalis American Group
 This program comes with ABSOLUTELY NO WARRANTY;
 As this program is based on [and has dependancies]
 the content of GPL, AGPL, and LGPL works, GPL is 
 preserved. This is open software, released under GNU 
 Affero GPL (AGPL) v3, and you are welcome to redistribute 
 it, with this tag in tact.
	... http://www.sorrentolactalis.com
	... http://www.spinellicreations.com
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
---------------------------------------------------------------------
---------------------------------------------------------------------
AUTOCOMPLETE JAVASCRIPT IMPLEMENTATION
---------------------------------------------------------------------
*/

var ml_autocomplete = {
  keyTime : null,
  keyStr : '',
  allOpts : null,
  lastElement : null,
  onChange : null, /* callback function reference */
  delay : 3500,
	/* do type-ahead if two keys were pressed within 
	   3500 milliseconds (3.5 second, one can change 
	   this value for customization)
	   note: mingyi's original recommended value was 500 ms
	   (0.5 seconds), which we have decided to increas to
	   one full second.
	*/
  
  populate : function(srcEvent)
  {
    var element = (srcEvent)? ((srcEvent.target)? srcEvent.target : srcEvent.srcElement) : window.event.srcElement;
    if(this.lastElement != element)
    {
      this.allOpts = new Array();
      for(var i = 0; i < element.options.length; i++)
        this.allOpts[i] = element.options[i].text.toLowerCase();
      this.lastElement = element;
    }
  },
  setSelection : function(srcEvent)
  {
    var myEvent = (srcEvent)? srcEvent : window.event;
    var element = (myEvent.target)? myEvent.target : myEvent.srcElement;
    var keyCode = myEvent.keyCode;
    if(keyCode == 13 && this.onChange)
    {
      this.onChange(element.value);
      this.keyTime = null; /* reset time after enter key's pressed */
      return;
    }
	/* 
	messy JS keycodes force me to preprocess. 
	note: I use a US keyboard, other keyboards may vary? 
	*/
    if((keyCode > 47 && keyCode < 58) || (keyCode > 64 && keyCode < 91 || keyCode == 32)) ; 
	/* space or alphanumerical characters, leave them alone */
    else if(keyCode > 95 && keyCode < 106) keyCode -= 48; 
	/* keypad numbers */
    else if(keyCode > 105 && keyCode < 112) keyCode -= 64; 
	/* keypad '+', '-', '/', '*', '.' */
    else if(keyCode > 187 && keyCode < 192) keyCode -= 144; 
	/* '/', '.', ',', '-' */
    else if(keyCode > 218 && keyCode < 222) keyCode -= 128; 
	/* '\', '[', ']' */
    else
    {
      switch(keyCode)
      {
        case 187: keyCode = 61; break; // '='
        case 222: keyCode = 39; break; // '''
        case 192: keyCode = 96; break; // '`'
        case 186: keyCode = 59; break; // ';'
        default: return; 
	/* 
	do not process non printable characters 
	(unfortunately backspace cannot be supported 
	because browsers like IE interpret backspace 
	as go back a page in history) 
	*/
      }
    }
    var currentKey = String.fromCharCode(keyCode).toLowerCase();
    var idx, currentSIdx = element.selectedIndex, useOld = false;
    var newTime = new Date().getTime();
    if(this.keyTime != null && newTime - this.keyTime < this.delay) 
    {
      this.keyStr += currentKey;
      idx = this.findIdx(currentSIdx);
      if(idx == -1)
      {
        this.keyTime = newTime;
        return; /* not found, keep current selection then (leave the incorrect keyStr alone) */
      }
    }
    else /* handle default browser behavior */
    {
      this.keyStr = currentKey;
      idx = this.findIdx(currentSIdx);
    }
    if(idx >= 0) // if keyStr is found in an option, select the option
    {
      if(currentSIdx >= 0) element.options[currentSIdx].selected = false;
	/*
         gecko-based browsers have a very strange bug that strikes when user presses
         the same character multiple times (like 'AAA', 'BBBB'), which could be "fixed"
         in a strange way too (actually the idx > 0 test is not even necessary!)
         first make a pattern to check if it's same character multiple times 
	*/
      var pattern = new RegExp('^' + this.keyStr.charAt(0) + '+$', "i");
      if((navigator.userAgent.toLowerCase().indexOf("gecko") != -1 && navigator.userAgent.toLowerCase().indexOf("chrome") == -1) && pattern.test(this.keyStr) && idx > 0) element.options[idx-1].selected = true;
      else element.options[idx].selected = true;
    }
    this.keyTime = newTime;
  },
  findIdx : function(currentSIdx)
  {
    /* full scan to find the smallest idx that match string keyStr (case-insensitive) */
    var len = this.keyStr.length;
    var startidx = (currentSIdx < 0)? 0 : ((len == 1)? currentSIdx + 1 : currentSIdx);
    for(var i = startidx; i < this.allOpts.length; i++)
      if(this.allOpts[i].length >= len && this.allOpts[i].substring(0, len) == this.keyStr)
        return i;
    for(var i = 0; i < startidx; i++)
      if(this.allOpts[i].length >= len && this.allOpts[i].substring(0, len) == this.keyStr)
        return i;
    return -1;
  },
  cancel : function(srcEvent)
  {
    var myEvent = (srcEvent)? srcEvent : window.event;
    if(myEvent.keyCode == 9) return true;
    else return false;
  }
};
