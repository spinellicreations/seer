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
S.E.E.R. GLOBAL FUNCTIONS FILE
-- PREDEFINED FUNCTIONS FOR SYSTEMS
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

/* DATESTAMP GENERATION */
/* -- GENERIC TO ALL */
/* ------------------------------------------------------------------ */
function stamp_date_now()
{
	$datestamp_to_return = date('Y_md_H:i:s');
	return $datestamp_to_return;
}
$apache_DEFAULTDATESTAMP = stamp_date_now();
/* -- -- DEFAULT DATESTAMP IN MOD_OPENOPC FRIENDLY FORMAT */
$apache_DEFAULTDATESTAMP_UNIXTIME = date('U');
/* -- -- UNIXTIME DATESTAMP, RIGHT NOW */
$apache_CHARTGENERATEDATESTAMP = date('Y_md_H-i-s');
/* -- -- SIMILAR TO DEFAULTDATESTAMP, HOWEVER USES "-" INSTEAD OF ":" */
/*	 BECAUSE ":" CANNOT BE PART OF A FILENAME UNDER WIN BASED OS's */
/*	 THIS IS NOT MOD_OPENOPC FRIENDLY, BUT CAN BE USED FOR SAVING */
/*	 FILES, SUCH AS EXPORTS AND SUCH, AS IT IS INTUITIVE */
$apache_HMIMYSQLSEARCHDATESTAMP = date('Y_md_H');
/* -- -- USED TO BEGIN SEARCH RANGE FOR HMI LIVE VIEW DISPLAYS */
/*	 WHEN LOOKING FOR RECENT RECORDS */
$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED = $apache_DEFAULTDATESTAMP_UNIXTIME - ($seer_HMISQLSEARCHMINIMUMTIMEFRAME * 60);
$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED = date('Y_md_H:i', $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED);
/* -- -- SIMILAR TO ABOVE, BUT MORE REFINED.  USES THE PRESET MINIMUMTIMEFRAME */
/*	 TO DETERMINE HOW FAR BACK WE LOOK. */
/* -- -- TWEAK FOR FASTER PERFORMANCE AND SMALLER QUERY RETURNS */
function apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM_GENERATE ($CUSTOM_TIMEFRAME_MINUTES)
{
	/* CALL THIS FUNCTION WITH */
	/* $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM = apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM_GENERATE($CUSTOM_TIMEFRAME_MINUTES); */
	/* GLOBALIZE VARIABLES */
	/*	-- APACHE */
	global $apache_DEFAULTDATESTAMP_UNIXTIME;

	/* EXECUTE */
	$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM = $apache_DEFAULTDATESTAMP_UNIXTIME - ($CUSTOM_TIMEFRAME_MINUTES * 60);
	$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM = date('Y_md_H:i', $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM);

	/* RETURN VARIABLES */
	return $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM;
}
/* -- -- VERY SIMILAR TO ABOVE, BUT A CUSTOMIZED VERSION ALLOWING */
/*       YOU TO DECLARE THE TIME WINDOW AS YOU WISH. */

/* HTTP USER AGENT DETERMINATION */
/* ------------------------------------------------------------------ */
function browser_info($agent=null) 
{
	/* SPECIAL THANKS TO... */
	/* -- "robert @ broofa.com"
	      for his contribution to the php.net online manual as of
	      July 18, 2009, which this function is wholly based upon.
	*/

	/* CALL THIS FUNCTION WITH */
	/* $apache_HTTP_BROWSER = browser_info(); 
	   $apache_HTTP_BROWSER_ON_LINE = $apache_HTTP_BROWSER['browser'];
	   $apache_HTTP_BROWSER_ON_LINE_VERSION =  $apache_HTTP_BROWSER['version'];
	   $apache_HTTP_BROWSER_ON_LINE_ENGINE =  $apache_HTTP_BROWSER['engine'];
	*/

	/* ENGINES RETURNED MAY BE ONE OF... 
		gecko
		webkit
		presto
		trident
	   BROWSERS RETURNED MAY BE ONE OF...
		msie
		firefox
		safari
		webkit (generic)
		opera
		netscape
		konqueror
		gecko (generic)
		mozilla
		chrome
		chromium
	

	   NOTE - CONDITIONALIZE ONLY IF ABSOLUTELY NECESSARY AND ALL OTHER AVENUES 
		HAVE BEEN EXHAUSTED.  EVEN THEN, ONLY DO SO AROUND BROWSER ENGINES,
		RATHER THAN BROWSER NAMES.  ANYTHING BEYOND THAT, USE YOUR OWN
		DISCRETION.
	/*
		

	/* ZERO OUT THE RETURN */
	$guess = array();
	$guess['engine'] = $multilang_STATIC_UNKNOWN;
	$guess['browser'] = $multilang_STATIC_UNKNOWN;
	$guess['version'] = "0.0";

	/* DECLARE KNOWN BROWSERS TO LOOK FOR */
	$known = array('opera', 'msie', 'chrome', 'chromium', 'safari', 'konqueror', 'webkit', 'netscape', 'firefox', 'mozilla', 'gecko');

	/* CLEAN UP AGENT AND BUILD REGEX THAT MATCHES PHRASES FOR KNOWN BROWSERS */
	/* E.G. "FIREFOX/2.0" OR MSIE 6.0" (THIS ONLY MATCHES THE MAJOR AND MINOR */
	/* VERSION NUMBERS.  E.G. "2.0.0.6" IS PARSED AS SIMPLY "2.0" */
	$agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
	$pattern = '#(?<browser>'.join('|',$known).')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';

	/* FIND ALL PHRASES (OR RETURN EMPTY ARRAY IF NONE FOUND */
	if (!preg_match_all($pattern, $agent, $matches)) {
		return $guess;
	} else {
		/* SINCE SOME UA'S HAVE MORE THAN ONE PHRASE (E.G. FIREFOX HAS GECKO PHRASE, */
		/* OPERA 7,8 HAVE A MSIE PHRASE), USE THE LAST ONE FOUND (THE RIGHT-MOST ONE */
		/* IN THE UA). THAT'S USUALLY THE MOST CORRECT. */
		$i = count($matches['browser'])-1;
		$guess['browser'] = $matches['browser'][$i];
		$guess['version'] = $matches['version'][$i];
		/* DECLARE BROWSER ENGINE IN USE */
		if ( ($guess['browser'] == 'firefox') || ($guess['browser'] == 'netscape') || ($guess['browser'] == 'gecko') || ($guess['browser'] == 'mozilla') ) {
			/* MOZILLA GECKO ENGINE */
			$guess['engine'] = "gecko";
		} else {
			if ( ($guess['browser'] == 'safari') || ($guess['browser'] == 'chrome') || ($guess['browser'] == 'chromium') || ($guess['browser'] == 'konqueror') || ($guess['browser'] == 'webkit') ) {
				/* WEBKIT ENGINE */
				$guess['engine'] = "webkit";
			} else {
				if ($guess['browser'] == 'opera') {
					/* PRESTO ENGINE */
					$guess['engine'] = "presto";
				} else {
					if ($guess['browser'] == 'msie') {
						/* TRITON ENGINE */
						$guess['engine'] = "trident";
					} else {
						/* pass */		
					}
				}
			}
		}
		return $guess;
	}

}

/* BUILTIN FUNCTIONS */
/* ------------------------------------------------------------------ */
/* IS A NUMBER ODD OR EVEN */
function oddOReven ($test)
{
    if ( $test % 2) {
	return "ODD";
    } else {
        return "EVEN";
    }
}

/* CUSTOM MYSQL SEARCH DATESTAMP RANGE */
function generateHMIMYSQLSEARCHDATESTAMP ($apache_OFFERED_START_TWEAKED_CUSTOM, $apache_OFFERED_MINUTES_TWEAKED_CUSTOM) {
	$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM = $apache_OFFERED_START_TWEAKED_CUSTOM - ($apache_OFFERED_MINUTES_TWEAKED_CUSTOM * 60);
	$apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM = date('Y_md_H:i', $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM);
	return $apache_HMIMYSQLSEARCHDATESTAMP_TWEAKED_CUSTOM;
}

/* SANITIZE RANDOM STRING FOR MYSQL USE */
/* -- sometimes we have random user input, such as comments, that may result in the user typing in */
/*    a value that we cannot enter into the database, due to structure.  So, let us sanitize that */
/*    random string by removing the undesireable parts. */
function sanitizeRANDOMcontent ($random_content, $empty_value = "EMPTY", $strict_ABC_123 = "NO")
{
	$is_empty = "YES";
	$random_content_sanitized = "";
	$char_array = str_split($random_content, 1);
	/* -- strip each character into its own variable, in an array */
	foreach ($char_array as &$char) {
		$is_empty = "NO";
		if ( ($char == "\"") || ($char == "'") || ($char == "`") || ($char == "~") || ($char == "$") || ($char == "%") || ($char == "^") || ($char == "&") || ($char == "*") || ($char == "(") || ($char == ")") || ($char == "=") || ($char == "+") || ($char == "\\") || ($char == "|") || ($char == "{") || ($char == "}") || ($char == "[") || ($char == "]") || ($char == ";") || ($char == "<") || ($char == ">") ) {
			/* pass */
		} else {
			if ($strict_ABC_123 == 'STRICT') {
				if ( ($char == "a") || ($char == "A") || ($char == "b") || ($char == "B") || ($char == "c") || ($char == "C") || ($char == "d") || ($char == "D") || ($char == "e") || ($char == "E") || ($char == "f") || ($char == "F") || ($char == "g") || ($char == "G") || ($char == "h") || ($char == "H") || ($char == "i") || ($char == "I") || ($char == "j") || ($char == "J") || ($char == "k") || ($char == "K") || ($char == "l") || ($char == "L") || ($char == "m") || ($char == "M") || ($char == "n") || ($char == "N") || ($char == "o") || ($char == "O") || ($char == "p") || ($char == "P") || ($char == "q") || ($char == "Q") || ($char == "r") || ($char == "R") || ($char == "s") || ($char == "S") || ($char == "t") || ($char == "T") || ($char == "u") || ($char == "U") || ($char == "v") || ($char == "V") || ($char == "w") || ($char == "W") || ($char == "x") || ($char == "X") || ($char == "y") || ($char == "Y") || ($char == "z") || ($char == "Z") || ($char == "0") || ($char == "1") || ($char == "2") || ($char == "3") || ($char == "4") || ($char == "5") || ($char == "6") || ($char == "7") || ($char == "8") || ($char == "9") ) {
					$random_content_sanitized = $random_content_sanitized.$char;
				} else {
					/* pass */
				}
			} else {
				$random_content_sanitized = $random_content_sanitized.$char;
			}
		}
	}
	if ( $is_empty == "YES" ) {
		$random_content_sanitized = $empty_value;
	} else {
		/* pass */
	}
 
	return $random_content_sanitized;
}

/* SANITIZE RANDOM STRING FOR OPC DEVICE USE */
/* -- sometimes we have random user input, such as hmi inputs, that may result in the user typing in */
/*    a value that we cannot be written to an OPC device.  So, let us sanitize that */
/*    random string by removing the undesireable parts. */
/* -- this is by no means comprehensive of all OPC device types, but this will keep the most nefarious */
/*    offenders out. */
/* -- this is a clone of sanitizeRANDOMcontent function */
function sanitizeRANDOMOPCcontent ($random_content, $empty_value = "EMPTY")
{
	$random_content_sanitized = sanitizeRANDOMcontent($random_content,$empty_value);
	return $random_content_sanitized;
}

/* VARCHAR TO NUMERIC */
/* -- strips anything but numeric value from string */
function varcharTOnumeric ($apache_VARCHAR)
{
	$apache_STRIPPED_STRING = "";
	$char_array = str_split($apache_VARCHAR, 1);
	/* -- strip each character into its own variable, in an array */
	foreach ($char_array as &$char) {
		if ( ($char == "0") || ($char == "1") || ($char == "2") || ($char == "3") || ($char == "4") || ($char == "5") || ($char == "6") || ($char == "7") || ($char == "8") || ($char == "9") ) {
			$apache_STRIPPED_STRING = $apache_STRIPPED_STRING.$char;
		} else {
			/* pass */
		}
	}
	return $apache_STRIPPED_STRING;
}

/* VARCHAR TO NUMERIC 2 */
/* -- sort of rounds as best it can, then strips anything but numeric value from string */
/* -- this is a workaround for the failure of php builtin function 'round()' on very large */
/*    numbers */
function varcharTOnumeric2 ($apache_VARCHAR, $apache_round = 0 )
{	
	$apache_VARCHAR = number_format($apache_VARCHAR, $apache_round);
	$apache_STRIPPED_STRING = "";
	$char_array = str_split($apache_VARCHAR, 1);
	/* -- strip each character into its own variable, in an array */
	foreach ($char_array as &$char) {
		if ( ($char == "-") || ($char == ".") || ($char == "0") || ($char == "1") || ($char == "2") || ($char == "3") || ($char == "4") || ($char == "5") || ($char == "6") || ($char == "7") || ($char == "8") || ($char == "9") ) {
			$apache_STRIPPED_STRING = $apache_STRIPPED_STRING.$char;
		} else {
			/* pass */
		}
	}
	return $apache_STRIPPED_STRING;
}

/* PERCENT ERROR */
/* -- determine percent error for a given set of points */
function percent_error ($target, $actual)
{
	$percent_error = 100*(($target - $actual) / $target);
	$percent_error = abs(varcharTOnumeric2($mysql_percent_injected_error, 2));

	return $percent_error;
}

/* DIRECTORY LISTER */
function dirList ($apache_DIRECTORYTOSCAN) 
{
    $apache_DIRECTORYCONTENTS = array();
    $apache_DIRECTORYHANDLER = opendir($apache_DIRECTORYTOSCAN);
    while ($apache_DIRECTORYFILE = readdir($apache_DIRECTORYHANDLER)) {
        if ($apache_DIRECTORYFILE != '.' && $apache_DIRECTORYFILE != '..' && $apache_DIRECTORYFILE != 'index.php' && strpos('~', $apache_DIRECTORYFILE) === FALSE)
            $apache_DIRECTORYCONTENTS[] = $apache_DIRECTORYFILE;
    }
    closedir($apache_DIRECTORYHANDLER);
    return $apache_DIRECTORYCONTENTS;
}

/* LIST ALL FILES IN DIRECTORY RECURSIVELY */
/* -- Sample function to recursively return all files within a directory. */
/* -- http://www.pgregg.com/projects/php/code/recursive_readdir.phps */
/* -- from http://php.net/manual/en/function.readdir.php */
/* -- public domain */
/* -- we give many thanks to this dude for building a function that actually works */
/* -- -- we tried over 10 other implementations that failed after having gone through */
/* -- -- 3 or 4 of our own that were turning out to be more work than we wished for */
function listDirRecurse($apache_directory_to_scan) {
	/* CALL THIS FUNCTION WITH... */
	/* $myfilearray = listDirRecurse($apache_directory_to_scan); */
	/* -- where $apache_directory_to_scan does NOT include trailing slash */
	/* -- allows for quick and dirty unpacking */
	$files = array();
	if (is_dir($apache_directory_to_scan)) {
    		$fh = opendir($apache_directory_to_scan);
    		while (($file = readdir($fh)) !== false) {
			if ( $file != 'index.html' ) {
	      			/* LOOP THROUGH, SKIPPING AND RECURSING AS NEEDED */
	      			if (strcmp($file, '.')==0 || strcmp($file, '..')==0) continue;
					$filepath = $apache_directory_to_scan . '/' . $file;
					if ( is_dir($filepath) ) {
						$files = array_merge($files, listDirRecurse($filepath));
					} else {
						array_push($files, $filepath);
					}
			} else {
				/* pass */
				/* the placeholder index.html should not be included in results */
			}
		}	
    		closedir($fh);
	} else {
		/* FALSE IF THE FUNCTION WAS CALLED WITH AN INVALID NON DIRECTORY ARGUMENT */
		$files = false;
	}
	/* RETURN ARRAY OF FILES WITH FULL PATH NAMES */
	return $files;
}

/* CONVERT START AND END DATESTAMP TO DURATION OF TIME */
function timeDuration ($apache_function_STARTTIME, $apache_function_ENDTIME) 
{
	/* CALL THIS FUNCTION WITH... */
	/* list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_function_STARTTIME,$apache_function_ENDTIME); */
	/* -- allows for quick and dirty unpacking */

	/* HANDLE THE START TIME */
	$apache_function_DATESTAMPTOEXPLODE = $apache_function_STARTTIME;
	$apache_function_STARTTIME_EXPLODED = explode("_",$apache_function_DATESTAMPTOEXPLODE);
	$apache_function_STARTTIME_YEAR = $apache_function_STARTTIME_EXPLODED[0];
	$apache_function_STARTTIME_MONTH = substr($apache_function_STARTTIME_EXPLODED[1], 0, 2);
	$apache_function_STARTTIME_DAY = substr($apache_function_STARTTIME_EXPLODED[1], 2, 2);
	$apache_function_STARTTIME_HOUR = substr($apache_function_STARTTIME_EXPLODED[2], 0, 2);
	$apache_function_STARTTIME_MINUTE = substr($apache_function_STARTTIME_EXPLODED[2], 3, 2);
	$apache_function_STARTTIME_SECOND = substr($apache_function_STARTTIME_EXPLODED[2], 6, 2);

	/* REMOVE PRECEEDING ZEROES FROM STAMPS */
	$apache_function_STARTTIME_MONTH_CHECK = substr($apache_function_STARTTIME_MONTH, 0, 1);
	if ( $apache_function_STARTTIME_MONTH_CHECK == "0" ) {
		$apache_function_STARTTIME_MONTH = substr($apache_function_STARTTIME_MONTH, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_STARTTIME_DAY_CHECK = substr($apache_function_STARTTIME_DAY, 0, 1);
	if ( $apache_function_STARTTIME_DAY_CHECK == "0" ) {
		$apache_function_STARTTIME_DAY = substr($apache_function_STARTTIME_DAY, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_STARTTIME_HOUR_CHECK = substr($apache_function_STARTTIME_HOUR, 0, 1);
	if ( $apache_function_STARTTIME_HOUR_CHECK == "0" ) {
		$apache_function_STARTTIME_HOUR = substr($apache_function_STARTTIME_HOUR, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_STARTTIME_MINUTE_CHECK = substr($apache_function_STARTTIME_MINUTE, 0, 1);
	if ( $apache_function_STARTTIME_MINUTE_CHECK == "0" ) {
		$apache_function_STARTTIME_MINUTE = substr($apache_function_STARTTIME_MINUTE, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_STARTTIME_SECOND_CHECK = substr($apache_function_STARTTIME_SECOND, 0, 1);
	if ( $apache_function_STARTTIME_SECOND_CHECK == "0" ) {
		$apache_function_STARTTIME_SECOND = substr($apache_function_STARTTIME_SECOND, 1, 1);
	} else {
		/* pass */
	}

	/* CONVERT TO UNIX TIME */
	$apache_function_STARTTIME_UNIXTIME = mktime($apache_function_STARTTIME_HOUR, $apache_function_STARTTIME_MINUTE, $apache_function_STARTTIME_SECOND, $apache_function_STARTTIME_MONTH, $apache_function_STARTTIME_DAY, $apache_function_STARTTIME_YEAR);

	/* HANDLE THE END TIME */
	$apache_function_DATESTAMPTOEXPLODE = $apache_function_ENDTIME;
	$apache_function_ENDTIME_EXPLODED = explode("_",$apache_function_DATESTAMPTOEXPLODE);
	$apache_function_ENDTIME_YEAR = $apache_function_ENDTIME_EXPLODED[0];
	$apache_function_ENDTIME_MONTH = substr($apache_function_ENDTIME_EXPLODED[1], 0, 2);
	$apache_function_ENDTIME_DAY = substr($apache_function_ENDTIME_EXPLODED[1], 2, 2);
	$apache_function_ENDTIME_HOUR = substr($apache_function_ENDTIME_EXPLODED[2], 0, 2);
	$apache_function_ENDTIME_MINUTE = substr($apache_function_ENDTIME_EXPLODED[2], 3, 2);
	$apache_function_ENDTIME_SECOND = substr($apache_function_ENDTIME_EXPLODED[2], 6, 2);

	/* REMOVE PRECEEDING ZEROES FROM STAMPS */
	$apache_function_ENDTIME_MONTH_CHECK = substr($apache_function_ENDTIME_MONTH, 0, 1);
	if ( $apache_function_ENDTIME_MONTH_CHECK == "0" ) {
		$apache_function_ENDTIME_MONTH = substr($apache_function_ENDTIME_MONTH, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_ENDTIME_DAY_CHECK = substr($apache_function_ENDTIME_DAY, 0, 1);
	if ( $apache_function_ENDTIME_DAY_CHECK == "0" ) {
		$apache_function_ENDTIME_DAY = substr($apache_function_ENDTIME_DAY, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_ENDTIME_HOUR_CHECK = substr($apache_function_ENDTIME_HOUR, 0, 1);
	if ( $apache_function_ENDTIME_HOUR_CHECK == "0" ) {
		$apache_function_ENDTIME_HOUR = substr($apache_function_ENDTIME_HOUR, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_ENDTIME_MINUTE_CHECK = substr($apache_function_ENDTIME_MINUTE, 0, 1);
	if ( $apache_function_ENDTIME_MINUTE_CHECK == "0" ) {
		$apache_function_ENDTIME_MINUTE = substr($apache_function_ENDTIME_MINUTE, 1, 1);
	} else {
		/* pass */
	}
	$apache_function_ENDTIME_SECOND_CHECK = substr($apache_function_ENDTIME_SECOND, 0, 1);
	if ( $apache_function_ENDTIME_SECOND_CHECK == "0" ) {
		$apache_function_ENDTIME_SECOND = substr($apache_function_ENDTIME_SECOND, 1, 1);
	} else {
		/* pass */
	}

	/* CONVERT TO UNIX TIME */
	$apache_function_ENDTIME_UNIXTIME = mktime($apache_function_ENDTIME_HOUR, $apache_function_ENDTIME_MINUTE, $apache_function_ENDTIME_SECOND, $apache_function_ENDTIME_MONTH, $apache_function_ENDTIME_DAY, $apache_function_ENDTIME_YEAR);

	/* HOW LONG DID THE EVENT OCCUR FOR */
	$apache_function_DURATION_UNIXTIME = $apache_function_ENDTIME_UNIXTIME - $apache_function_STARTTIME_UNIXTIME;

	/* CONVERT BACK TO HUMAN READABLE TIME */
	$apache_function_DURATION_MINUTES = floor($apache_function_DURATION_UNIXTIME / 60);
	$apache_function_DURATION_SECONDS_CLEAN = $apache_function_DURATION_UNIXTIME % 60;
	$apache_function_DURATION_HOURS = floor($apache_function_DURATION_MINUTES / 60);
	$apache_function_DURATION_MINUTES_CLEAN = $apache_function_DURATION_MINUTES % 60;
	$apache_function_DURATION_DAYS = floor($apache_function_DURATION_HOURS / 24);
	$apache_function_DURATION_HOURS_CLEAN = $apache_function_DURATION_HOURS % 24;
	$apache_function_DURATION_DAYS_CLEAN = $apache_function_DURATION_DAYS;

	/* ADHERE TO OUR CONVENTION OF A DOUBLE DIGIT NUMBERING SYSTEM */
	$apache_function_DURATION_SECONDS_CLEAN = sprintf("%02d", $apache_function_DURATION_SECONDS_CLEAN);
 	$apache_function_DURATION_MINUTES_CLEAN = sprintf("%02d", $apache_function_DURATION_MINUTES_CLEAN);
	$apache_function_DURATION_HOURS_CLEAN = sprintf("%02d", $apache_function_DURATION_HOURS_CLEAN);
	$apache_function_DURATION_DAYS_CLEAN = sprintf("%02d", $apache_function_DURATION_DAYS_CLEAN);

	/* FINALLY YIELD THE COMPLETED DURATION */
	$apache_function_DURATION_FINAL = $apache_function_DURATION_DAYS_CLEAN."d_".$apache_function_DURATION_HOURS_CLEAN."h_".$apache_function_DURATION_MINUTES_CLEAN."m_".$apache_function_DURATION_SECONDS_CLEAN."s";

	/* TAGS TO RETURN */
	return array($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME);
}

/* CONVERT FROM UNIX TIME TO READABLE TIME */
function unixtimeTOrealtime ($apache_unixtime)
{
	/* CONVERTS AN INTEGER NUMBER REPRESENTING UNIXTIME (SECONDS SINCE 1970) INTO */
	/*	A REALTIME FORMAT WHICH ADHERES TO... */
	/*	XXd_YYh_ZZm_00s	*/
	/*	-- days, hours, minutes, then seconds */

	/* CONVERT BACK TO HUMAN READABLE TIME */
	$apache_function_MINUTES = floor($apache_unixtime / 60);
	$apache_function_SECONDS_CLEAN = $apache_unixtime % 60;
	$apache_function_HOURS = floor($apache_function_MINUTES / 60);
	$apache_function_MINUTES_CLEAN = $apache_function_MINUTES % 60;
	$apache_function_DAYS = floor($apache_function_HOURS / 24);
	$apache_function_HOURS_CLEAN = $apache_function_HOURS % 24;
	$apache_function_DAYS_CLEAN = $apache_function_DAYS;

	/* ADHERE TO OUR CONVENTION OF A DOUBLE DIGIT NUMBERING SYSTEM */
	$apache_function_SECONDS_CLEAN = sprintf("%02d", $apache_function_SECONDS_CLEAN);
 	$apache_function_MINUTES_CLEAN = sprintf("%02d", $apache_function_MINUTES_CLEAN);
	$apache_function_HOURS_CLEAN = sprintf("%02d", $apache_function_HOURS_CLEAN);
	$apache_function_DAYS_CLEAN = sprintf("%02d", $apache_function_DAYS_CLEAN);

	/* FINALLY YIELD THE COMPLETED DURATION */
	$apache_function_REALTIME = $apache_function_DAYS_CLEAN."d_".$apache_function_HOURS_CLEAN."h_".$apache_function_MINUTES_CLEAN."m_".$apache_function_SECONDS_CLEAN."s";

	/* RETURN VALUE */
	return $apache_function_REALTIME;
}

/* ADD TIME TO DATESTAMP */
/* PRESERVE DATESTAMP FORM NATIVE TO SEER and mod_openopc WHILE ADDING TIME TO A DATESTAMP, MAKING A NEW STAMP */
function datestampAddTime ($apache_function_datestamp_start, $apache_function_add_years, $apache_function_add_months, $apache_function_add_days, $apache_function_add_hours, $apache_function_add_minutes, $apache_function_add_seconds="0")
{
	/* CALL THIS FUNCTION WITH ... */
	/* $some_later_time = datestampAddTime($start_datestamp, $yrs_to_add, $months_to_add, $days_to_add, $hrs_to_add, $mins_to_add, $secs_to_add [or blank]); */
	/* -- allows for quick and dirty utilization */
	/* -- assumes and requires the YYYY_mmdd_hh:MM:ss default datestamp format */

	/* WARNING !!! */
	/* -- successful use of this function requires that you never attempt to add more than... */
	/* --   days to add = 31 days max */
	/* --   years to add = (year 9999 minus start year) max */

	/* STRIP OUT OUR STARTING POINT */
	$apache_function_start_year = substr($apache_function_datestamp_start, 0, 4);
	$apache_function_start_month = substr($apache_function_datestamp_start, 5, 2);
	$apache_function_start_day = substr($apache_function_datestamp_start, 7, 2);
	$apache_function_start_hour = substr($apache_function_datestamp_start, 10, 2);
	$apache_function_start_minute = substr($apache_function_datestamp_start, 13, 2);
	$apache_function_start_second = substr($apache_function_datestamp_start, 16, 2);

	/* ADD MINUTES */
	$apache_function_end_second = $apache_function_start_second + $apache_function_add_seconds;
	while ($apache_function_end_second >= 60 ) {
		$apache_function_add_minutes = $apache_function_add_minutes + 1;
		$apache_function_end_second = $apache_function_end_second - 60;
	}
	$apache_function_end_second = sprintf("%02d", $apache_function_end_second);

	/* ADD MINUTES */
	$apache_function_end_minute = $apache_function_start_minute + $apache_function_add_minutes;
	while ($apache_function_end_minute >= 60 ) {
		$apache_function_add_hours = $apache_function_add_hours + 1;
		$apache_function_end_minute = $apache_function_end_minute - 60;
	}
	$apache_function_end_minute = sprintf("%02d", $apache_function_end_minute);

	/* ADD HOURS */
	$apache_function_end_hour = $apache_function_start_hour + $apache_function_add_hours;
	while ($apache_function_end_hour >= 24 ) {
		$apache_function_add_days = $apache_function_add_days + 1;
		$apache_function_end_hour = $apache_function_end_hour - 24;
	}
	$apache_function_end_hour = sprintf("%02d", $apache_function_end_hour);

	/* ADD DAYS */
	$apache_function_day_target = 31;
	if ($apache_function_start_month == 2) {
		$apache_function_day_target = 28;
	} else {
		if ($apache_function_start_month == 9) {
			$apache_function_day_target = 30;
		} else {
			/* pass */
		}
		if ($apache_function_start_month == 4) {
			$apache_function_day_target = 30;
		} else {
			/* pass */
		}
		if ($apache_function_start_month == 6) {
			$apache_function_day_target = 30;
		} else {
			/* pass */
		}
		if ($apache_function_start_month == 11) {
			$apache_function_day_target = 30;
		} else {
			/* pass */
		}
	}
	$apache_function_end_day = $apache_function_start_day + $apache_function_add_days;
	while ($apache_function_end_day > $apache_function_day_target ) {
		$apache_function_add_months = $apache_function_add_months + 1;
		$apache_function_end_day = $apache_function_end_day - $apache_function_day_target;
	}
	$apache_function_end_day = sprintf("%02d", $apache_function_end_day);

	/* ADD MONTHS */
	$apache_function_end_month = $apache_function_start_month + $apache_function_add_months;
	while ($apache_function_end_month > 12 ) {
		$apache_function_add_years = $apache_function_add_years + 1;
		$apache_function_end_month = $apache_function_end_month - 12;
	}
	$apache_function_end_month = sprintf("%02d", $apache_function_end_month);

	/* ADD MONTHS */
	$apache_function_end_year = $apache_function_start_year + $apache_function_add_years;
	$apache_function_end_year = sprintf("%04d", $apache_function_end_year);

	/* FINISH UP THE NEW DATESTAMP */
	$apache_function_returned_datestamp = $apache_function_end_year."_".$apache_function_end_month.$apache_function_end_day."_".$apache_function_end_hour.":".$apache_function_end_minute.":".$apache_function_end_second;

	/* RETURN NEW DATESTAMP */
	return $apache_function_returned_datestamp;

}

/* DISCRETE DATESTAMP AND FORMFILL BUILDER */
function discretedatestamp () 
{

	/* CALL THIS FUNCTION WITH... */
	/* list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestamp(); */
	/* -- allows for quick and dirty unpacking */

	/* DISCRETE DATESTAMP GENERATION */
	$apache_THISYEAR = date('Y');
	$apache_LASTYEAR = $apache_THISYEAR - 1;

	$apache_THISMONTH = date('m');
	$apache_THISDAYOFMONTH = date('d');

	$apache_THISHOUR = date('H');
	$apache_THISMINUTE = date('i');
	$apache_THISSECOND = date('s');

	/* FORMFILL DATESTAMP GENERATION MANUAL RECORD ENTRY */
	$apache_FORMFILL_MANUAL_ENTRY_YEAR = "";
	if ($apache_THISMONTH == "01") {
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = "<OPTION VALUE='".$apache_THISYEAR."'>".$apache_THISYEAR."<OPTION VALUE='".$apache_LASTYEAR."'>".$apache_LASTYEAR;
	} else {
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = "<OPTION VALUE='".$apache_THISYEAR."'>".$apache_THISYEAR;
	}

	$apache_FORMFILL_MANUAL_ENTRY_MONTH = "";
	$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = $apache_THISMONTH;
	$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE < 12 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_MONTH = $apache_FORMFILL_MANUAL_ENTRY_MONTH."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST < 12 ) {
			$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = 1;
		}
	}

	$apache_FORMFILL_MANUAL_ENTRY_DAY = "";
	$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = $apache_THISDAYOFMONTH;
	$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE < 31 ) {
		$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_DAY = $apache_FORMFILL_MANUAL_ENTRY_DAY."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST < 31 ) {
			$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 1;
		}
	}
	
	$apache_FORMFILL_MANUAL_ENTRY_HOUR = "";
	$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = $apache_THISHOUR;
	$apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE < 24 ) {
		$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_HOUR = $apache_FORMFILL_MANUAL_ENTRY_HOUR."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST < 23 ) {
			$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = 0;
		}
	}
	
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE = "";
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = $apache_THISMINUTE;
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE < 60 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE = $apache_FORMFILL_MANUAL_ENTRY_MINUTE."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST < 59 ) {
			$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = 0;
		}
	}
	
	/* TAGS TO RETURN */
	return array($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE);
}

/* LIMITED TO PAST 48 HOURS - DISCRETE DATESTAMP AND FORMFILL BUILDER */
function discretedatestamplast48hr () 
{

	/* CALL THIS FUNCTION WITH... */
	/* list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestamplast48hr(); */
	/* -- allows for quick and dirty unpacking */

	/* DISCRETE DATESTAMP GENERATION */
	$apache_THISYEAR = date('Y');
	$apache_LASTYEAR = $apache_THISYEAR - 1;

	$apache_THISMONTH = date('m');
	$apache_THISDAYOFMONTH = date('d');

	$apache_THISHOUR = date('H');
	$apache_THISMINUTE = date('i');
	$apache_THISSECOND = date('s');

	/* FORMFILL DATESTAMP GENERATION MANUAL RECORD ENTRY */

	/* -- DEAL WITH THE WHOLE 'FIRST OF THE MONTH, FIRST OF THE YEAR' PROBLEM */
	if ( $apache_THISMONTH == 1 ) {
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = "";
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = "<OPTION VALUE='".$apache_THISYEAR."'>".$apache_THISYEAR."<OPTION VALUE='".$apache_LASTYEAR."'>".$apache_LASTYEAR;
	} else {
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = "";
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = "<OPTION VALUE='".$apache_THISYEAR."'>".$apache_THISYEAR;
	}
	if ( $apache_THISDAYOFMONTH == 1 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = 0 - 1;
	} else {
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = 0;
	}
	if ( $apache_THISHOUR < 12  ) {
		$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = 0 - 1;
	} else {
		$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = 0;
	}

	$apache_FORMFILL_MANUAL_ENTRY_MONTH = "";
	$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = $apache_THISMONTH;
	while ( $apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE < 1 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_MONTH = $apache_FORMFILL_MANUAL_ENTRY_MONTH."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST != 1 ) {
			$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST - 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = 12;
		}
	}

	$apache_FORMFILL_MANUAL_ENTRY_DAY = "";
	$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = $apache_THISDAYOFMONTH;
	while ( $apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE < 2 ) {
		$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_DAY = $apache_FORMFILL_MANUAL_ENTRY_DAY."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST != 1 ) {
			$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST - 1;
		} else {
			/* FEBRUARY ONLY, AND ACCOUNTS FOR LEAP YEARS */
			if ( $apache_THISMONTH == 3 ) {
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 29;
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "ABNORMAL";
			} else {
				if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST != 'ABNORMAL' ) {
					$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "NORMAL";
				} else {
					/* pass */
				}
			}
			/* SEPTEMBER ONLY */
			if ( $apache_THISMONTH == 10 ) {
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 30;
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "ABNORMAL";
			} else {
				if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST != 'ABNORMAL' ) {
					$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "NORMAL";
				} else {
					/* pass */
				}
			}
			/* APRIL ONLY */
			if ( $apache_THISMONTH == 5 ) {
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 30;
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "ABNORMAL";
			} else {
				if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST != 'ABNORMAL' ) {
					$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "NORMAL";
				} else {
					/* pass */
				}
			}
			/* JUNE ONLY */
			if ( $apache_THISMONTH == 7 ) {
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 30;
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "ABNORMAL";
			} else {
				if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST != 'ABNORMAL' ) {
					$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "NORMAL";
				} else {
					/* pass */
				}
			}
			/* NOVEMBER ONLY */
			if ( $apache_THISMONTH == 12 ) {
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 30;
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "ABNORMAL";
			} else {
				if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST != 'ABNORMAL' ) {
					$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST = "NORMAL";
				} else {
					/* pass */
				}
			}
			/* ALL OTHER MONTHS */
			if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_REQUEST == 'NORMAL' ) {
				$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 31;
			} else {
				/* pass */
			}
		}
	}
	
	$apache_FORMFILL_MANUAL_ENTRY_HOUR = "";
	$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = 0;
	$apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE < 24 ) {
		$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_HOUR = $apache_FORMFILL_MANUAL_ENTRY_HOUR."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST < 23 ) {
			$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = 0;
		}
	}
	
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE = "";
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = 0;
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE < 60 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE = $apache_FORMFILL_MANUAL_ENTRY_MINUTE."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST < 59 ) {
			$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = 0;
		}
	}
	
	/* TAGS TO RETURN */
	return array($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE);
}

/* FLAT FORM - START WITH ALL ZERO's AND ONE's - DISCRETE DATESTAMP AND FORMFILL BUILDER */
/* GO BACK RETENTION YEARS */
function discretedatestampZEROBASE ($mysql_mod_openopc_RETENTION_YEARS_WORKING) 
{
	/* CALL THIS FUNCTION WITH... */
	/* list($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE) = discretedatestampZEROBASE($mysql_mod_openopc_RETENTION_YEARS_WORKING); */
	/* -- allows for quick and dirty unpacking */

	$mysql_mod_openopc_RETENTION_YEARS = $mysql_mod_openopc_RETENTION_YEARS_WORKING;

	/* DISCRETE DATESTAMP GENERATION */
	$apache_THISYEAR = date('Y');
	$apache_LASTYEAR = $apache_THISYEAR - 1;

	$apache_THISMONTH = date('m');
	$apache_THISDAYOFMONTH = date('d');

	$apache_THISHOUR = date('H');
	$apache_THISMINUTE = date('i');
	$apache_THISSECOND = date('s');

	/* FORMFILL DATESTAMP GENERATION MANUAL RECORD ENTRY */
	$apache_FORMFILL_MANUAL_ENTRY_YEAR = "";
	$apache_FORMFILL_MANUAL_ENTRY_YEAR_TO_POST = $apache_THISYEAR;
	$apache_FORMFILL_MANUAL_ENTRY_YEAR_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_YEAR_CYCLE <= $mysql_mod_openopc_RETENTION_YEARS ) {
		$apache_FORMFILL_MANUAL_ENTRY_YEAR = $apache_FORMFILL_MANUAL_ENTRY_YEAR."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_YEAR_TO_POST."'>".$apache_FORMFILL_MANUAL_ENTRY_YEAR_TO_POST;
		$apache_FORMFILL_MANUAL_ENTRY_YEAR_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_YEAR_CYCLE + 1;
		$apache_FORMFILL_MANUAL_ENTRY_YEAR_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_YEAR_TO_POST - 1;
	}

	$apache_FORMFILL_MANUAL_ENTRY_MONTH = "";
	$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = 1;
	$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE < 12 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_MONTH = $apache_FORMFILL_MANUAL_ENTRY_MONTH."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_MONTH_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST < 12 ) {
			$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_MONTH_TO_POST = 1;
		}
	}

	$apache_FORMFILL_MANUAL_ENTRY_DAY = "";
	$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 1;
	$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE < 31 ) {
		$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_DAY = $apache_FORMFILL_MANUAL_ENTRY_DAY."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_DAY_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST < 31 ) {
			$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_DAY_TO_POST = 1;
		}
	}
	
	$apache_FORMFILL_MANUAL_ENTRY_HOUR = "";
	$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = 0;
	$apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE < 24 ) {
		$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_HOUR = $apache_FORMFILL_MANUAL_ENTRY_HOUR."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_HOUR_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST < 23 ) {
			$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_HOUR_TO_POST = 0;
		}
	}
	
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE = "";
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = 0;
	$apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE = 0;
	while ( $apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE < 60 ) {
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN = sprintf("%02d", $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST);
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE = $apache_FORMFILL_MANUAL_ENTRY_MINUTE."<OPTION VALUE='".$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN."'>".$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST_CLEAN;
		$apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE = $apache_FORMFILL_MANUAL_ENTRY_MINUTE_CYCLE + 1;
		if ( $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST < 59 ) {
			$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = $apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST + 1;
		} else {
			$apache_FORMFILL_MANUAL_ENTRY_MINUTE_TO_POST = 0;
		}
	}
	
	/* TAGS TO RETURN */
	return array($apache_THISYEAR,$apache_LASTYEAR,$apache_THISMONTH,$apache_THISDAYOFMONTH,$apache_THISHOUR,$apache_THISMINUTE,$apache_THISSECOND,$apache_FORMFILL_MANUAL_ENTRY_YEAR,$apache_FORMFILL_MANUAL_ENTRY_MONTH,$apache_FORMFILL_MANUAL_ENTRY_DAY,$apache_FORMFILL_MANUAL_ENTRY_HOUR,$apache_FORMFILL_MANUAL_ENTRY_MINUTE);
}

/* ZERO THE HERO FORMFILL BUILDER */
function zerothehero ($zerotheheroA,$zerotheheroB,$zerotheheroC) 
{

	/* CALL THIS FUNCTION WITH... */
	/* $myformfill = zerothehero($A,$B,$C); */
	/* -- $A = start number (integer preferably) */
	/* -- $B = end number (integer preferably) */
	/* -- $C = increment (integer preferably) */
	/* -- allows for quick and dirty unpacking */

	$apache_FORMFILL_ZEROTHEHERO = "";
	$apache_FORMFILL_ZEROTHEHERO_TO_POST = $zerotheheroA;
	while ( $apache_FORMFILL_ZEROTHEHERO_TO_POST <= $zerotheheroB ) {
		$apache_FORMFILL_ZEROTHEHERO = $apache_FORMFILL_ZEROTHEHERO."<OPTION VALUE='".$apache_FORMFILL_ZEROTHEHERO_TO_POST."'>".$apache_FORMFILL_ZEROTHEHERO_TO_POST;
		$apache_FORMFILL_ZEROTHEHERO_TO_POST = $apache_FORMFILL_ZEROTHEHERO_TO_POST + $zerotheheroC;
	}

	/* TAGS TO RETURN */
	return $apache_FORMFILL_ZEROTHEHERO;
}

/* STRING TO DCV (DECIMAL CODED VARIABLE) CONVERTER */
function stringTOdcv ($stringTOdcv) 
{

	/* CALL THIS FUNCTION WITH... */
	/* $mydcv = stringTOdcv($mystring); */
	/* -- $A = string (ALPHA NUMERIC - UPPER OR LOWERCASE) */
	/* -- will actually handle any of the 68 characters generated */
	/*    by a standard 101 key QWERTY keyboard */

	$apache_stringTOdcv_OUT = "";
	$stringTOdcv = strtoupper($stringTOdcv);
	/* -- dump all to uppercase to simplify */
	$char_array = str_split($stringTOdcv, 1);
	/* -- strip each character into its own variable, in an array */

	foreach ($char_array as &$char) {
		echo "char in -- ".$char."<BR>";
		/* -- set to process */
		$stringTOdcv_process_char = 1;

		/* -- process character */
		if ( ($char == '0') && ($stringTOdcv_process_char == 1)  ) {
			$char = "90";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '1') && ($stringTOdcv_process_char == 1)  ) {
			$char = "91";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '2') && ($stringTOdcv_process_char == 1)  ) {
			$char = "92";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '3') && ($stringTOdcv_process_char == 1)  ) {
			$char = "93";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '4') && ($stringTOdcv_process_char == 1)  ) {
			$char = "94";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '5') && ($stringTOdcv_process_char == 1)  ) {
			$char = "95";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '6') && ($stringTOdcv_process_char == 1)  ) {
			$char = "96";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '7') && ($stringTOdcv_process_char == 1)  ) {
			$char = "97";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '8') && ($stringTOdcv_process_char == 1)  ) {
			$char = "98";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '9') && ($stringTOdcv_process_char == 1)  ) {
			$char = "99";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'A') && ($stringTOdcv_process_char == 1)  ) {
			$char = "10";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'B') && ($stringTOdcv_process_char == 1)  ) {
			$char = "11";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'C') && ($stringTOdcv_process_char == 1)  ) {
			$char = "12";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'D') && ($stringTOdcv_process_char == 1)  ) {
			$char = "13";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'E') && ($stringTOdcv_process_char == 1)  ) {
			$char = "14";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'F') && ($stringTOdcv_process_char == 1)  ) {
			$char = "15";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'G') && ($stringTOdcv_process_char == 1)  ) {
			$char = "16";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'H') && ($stringTOdcv_process_char == 1)  ) {
			$char = "17";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'I') && ($stringTOdcv_process_char == 1)  ) {
			$char = "18";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'J') && ($stringTOdcv_process_char == 1)  ) {
			$char = "19";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'K') && ($stringTOdcv_process_char == 1)  ) {
			$char = "20";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'L') && ($stringTOdcv_process_char == 1)  ) {
			$char = "21";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'M') && ($stringTOdcv_process_char == 1)  ) {
			$char = "22";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'N') && ($stringTOdcv_process_char == 1)  ) {
			$char = "23";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'O') && ($stringTOdcv_process_char == 1)  ) {
			$char = "24";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'P') && ($stringTOdcv_process_char == 1)  ) {
			$char = "25";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'Q') && ($stringTOdcv_process_char == 1)  ) {
			$char = "26";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'R') && ($stringTOdcv_process_char == 1)  ) {
			$char = "27";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'S') && ($stringTOdcv_process_char == 1)  ) {
			$char = "28";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'T') && ($stringTOdcv_process_char == 1)  ) {
			$char = "29";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'U') && ($stringTOdcv_process_char == 1)  ) {
			$char = "30";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'V') && ($stringTOdcv_process_char == 1)  ) {
			$char = "31";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'W') && ($stringTOdcv_process_char == 1)  ) {
			$char = "32";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'X') && ($stringTOdcv_process_char == 1)  ) {
			$char = "33";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'Y') && ($stringTOdcv_process_char == 1)  ) {
			$char = "34";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == 'Z') && ($stringTOdcv_process_char == 1)  ) {
			$char = "35";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '~') && ($stringTOdcv_process_char == 1)  ) {
			$char = "36";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '!') && ($stringTOdcv_process_char == 1)  ) {
			$char = "37";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '@') && ($stringTOdcv_process_char == 1)  ) {
			$char = "38";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '#') && ($stringTOdcv_process_char == 1)  ) {
			$char = "39";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '$') && ($stringTOdcv_process_char == 1)  ) {
			$char = "40";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '%') && ($stringTOdcv_process_char == 1)  ) {
			$char = "41";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '^') && ($stringTOdcv_process_char == 1)  ) {
			$char = "42";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '&') && ($stringTOdcv_process_char == 1)  ) {
			$char = "43";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '*') && ($stringTOdcv_process_char == 1)  ) {
			$char = "44";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '(') && ($stringTOdcv_process_char == 1)  ) {
			$char = "45";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == ')') && ($stringTOdcv_process_char == 1)  ) {
			$char = "46";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '_') && ($stringTOdcv_process_char == 1)  ) {
			$char = "47";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '+') && ($stringTOdcv_process_char == 1)  ) {
			$char = "48";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '|') && ($stringTOdcv_process_char == 1)  ) {
			$char = "49";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '`') && ($stringTOdcv_process_char == 1)  ) {
			$char = "50";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '-') && ($stringTOdcv_process_char == 1)  ) {
			$char = "51";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '=') && ($stringTOdcv_process_char == 1)  ) {
			$char = "52";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '\\') && ($stringTOdcv_process_char == 1)  ) {
			$char = "53";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '{') && ($stringTOdcv_process_char == 1)  ) {
			$char = "54";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '}') && ($stringTOdcv_process_char == 1)  ) {
			$char = "55";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '[') && ($stringTOdcv_process_char == 1)  ) {
			$char = "56";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == ']') && ($stringTOdcv_process_char == 1)  ) {
			$char = "57";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == ':') && ($stringTOdcv_process_char == 1)  ) {
			$char = "58";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '"') && ($stringTOdcv_process_char == 1)  ) {
			$char = "59";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '\'') && ($stringTOdcv_process_char == 1)  ) {
			$char = "60";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == ';') && ($stringTOdcv_process_char == 1)  ) {
			$char = "61";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == ',') && ($stringTOdcv_process_char == 1)  ) {
			$char = "62";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '.') && ($stringTOdcv_process_char == 1)  ) {
			$char = "63";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '/') && ($stringTOdcv_process_char == 1)  ) {
			$char = "64";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '<') && ($stringTOdcv_process_char == 1)  ) {
			$char = "65";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '>') && ($stringTOdcv_process_char == 1)  ) {
			$char = "66";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '?') && ($stringTOdcv_process_char == 1)  ) {
			$char = "67";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == ' ') && ($stringTOdcv_process_char == 1)  ) {
			$char = "68";
			$stringTOdcv_process_char = 0;
		} else {
			/* pass */
		}
		$apache_stringTOdcv_OUT = $apache_stringTOdcv_OUT.$char;
	}

	/* TAGS TO RETURN */
	return $apache_stringTOdcv_OUT;
}

/* DCV (DECIMAL CODED VARIABLE) TO STRING CONVERTER */
function dcvTOstring ($dcvTOstring) 
{
	/* CALL THIS FUNCTION WITH... */
	/* $mystring = dcvTOstring($mydcv); */
	/* -- $A = decimal coded variable */
	/* -- will actually handle any of the 69 characters generated */
	/*    by a standard 101 key QWERTY keyboard */

	$apache_dcvTOstring_OUT = "";

	/* COVER OUR ASS IN CASE WE STORE AS A FLOAT WITH A DECIMAL POINT AND NEED */
	/* TO STRIP OUT THE DECIMAL POINT AND ALL CHARS AFTER */

	$char_array = str_split($dcvTOstring, 2);
	/* -- strip each dcv-character-pair into its own variable, in an array */

	foreach ($char_array as &$char) {

		/* -- set to process */
		$dcvTOstring_process_char = 1;

		/* -- process character */
		if ( ($char == '90') && ($dcvTOstring_process_char == 1)  ) {
			$char = "0";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '91') && ($dcvTOstring_process_char == 1)  ) {
			$char = "1";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '92') && ($dcvTOstring_process_char == 1)  ) {
			$char = "2";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '93') && ($dcvTOstring_process_char == 1)  ) {
			$char = "3";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '94') && ($dcvTOstring_process_char == 1)  ) {
			$char = "4";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '95') && ($dcvTOstring_process_char == 1)  ) {
			$char = "5";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '96') && ($dcvTOstring_process_char == 1)  ) {
			$char = "6";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '97') && ($dcvTOstring_process_char == 1)  ) {
			$char = "7";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '98') && ($dcvTOstring_process_char == 1)  ) {
			$char = "8";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '99') && ($dcvTOstring_process_char == 1)  ) {
			$char = "9";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '10') && ($dcvTOstring_process_char == 1)  ) {
			$char = "A";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '11') && ($dcvTOstring_process_char == 1)  ) {
			$char = "B";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '12') && ($dcvTOstring_process_char == 1)  ) {
			$char = "C";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '13') && ($dcvTOstring_process_char == 1)  ) {
			$char = "D";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '14') && ($dcvTOstring_process_char == 1)  ) {
			$char = "E";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '15') && ($dcvTOstring_process_char == 1)  ) {
			$char = "F";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '16') && ($dcvTOstring_process_char == 1)  ) {
			$char = "G";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '17') && ($dcvTOstring_process_char == 1)  ) {
			$char = "H";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '18') && ($dcvTOstring_process_char == 1)  ) {
			$char = "I";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '19') && ($dcvTOstring_process_char == 1)  ) {
			$char = "J";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '20') && ($dcvTOstring_process_char == 1)  ) {
			$char = "K";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '21') && ($dcvTOstring_process_char == 1)  ) {
			$char = "L";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '22') && ($dcvTOstring_process_char == 1)  ) {
			$char = "M";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '23') && ($dcvTOstring_process_char == 1)  ) {
			$char = "N";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '24') && ($dcvTOstring_process_char == 1)  ) {
			$char = "O";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '25') && ($dcvTOstring_process_char == 1)  ) {
			$char = "P";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '26') && ($dcvTOstring_process_char == 1)  ) {
			$char = "Q";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '27') && ($dcvTOstring_process_char == 1)  ) {
			$char = "R";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '28') && ($dcvTOstring_process_char == 1)  ) {
			$char = "S";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '29') && ($dcvTOstring_process_char == 1)  ) {
			$char = "T";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '30') && ($dcvTOstring_process_char == 1)  ) {
			$char = "U";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '31') && ($dcvTOstring_process_char == 1)  ) {
			$char = "V";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '32') && ($dcvTOstring_process_char == 1)  ) {
			$char = "W";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '33') && ($dcvTOstring_process_char == 1)  ) {
			$char = "X";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '34') && ($dcvTOstring_process_char == 1)  ) {
			$char = "Y";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '35') && ($dcvTOstring_process_char == 1)  ) {
			$char = "Z";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '36') && ($dcvTOstring_process_char == 1)  ) {
			$char = "~";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '37') && ($dcvTOstring_process_char == 1)  ) {
			$char = "!";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '38') && ($dcvTOstring_process_char == 1)  ) {
			$char = "@";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '39') && ($dcvTOstring_process_char == 1)  ) {
			$char = "#";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '40') && ($dcvTOstring_process_char == 1)  ) {
			$char = "$";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '41') && ($dcvTOstring_process_char == 1)  ) {
			$char = "%";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '42') && ($dcvTOstring_process_char == 1)  ) {
			$char = "^";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '43') && ($dcvTOstring_process_char == 1)  ) {
			$char = "&";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '44') && ($dcvTOstring_process_char == 1)  ) {
			$char = "*";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '45') && ($dcvTOstring_process_char == 1)  ) {
			$char = "(";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '46') && ($dcvTOstring_process_char == 1)  ) {
			$char = ")";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '47') && ($dcvTOstring_process_char == 1)  ) {
			$char = "_";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '48') && ($dcvTOstring_process_char == 1)  ) {
			$char = "+";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '49') && ($dcvTOstring_process_char == 1)  ) {
			$char = "|";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '50') && ($dcvTOstring_process_char == 1)  ) {
			$char = "`";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '51') && ($dcvTOstring_process_char == 1)  ) {
			$char = "-";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '52') && ($dcvTOstring_process_char == 1)  ) {
			$char = "=";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '53') && ($dcvTOstring_process_char == 1)  ) {
			$char = "\\";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '54') && ($dcvTOstring_process_char == 1)  ) {
			$char = "{";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '55') && ($dcvTOstring_process_char == 1)  ) {
			$char = "}";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '56') && ($dcvTOstring_process_char == 1)  ) {
			$char = "[";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '57') && ($dcvTOstring_process_char == 1)  ) {
			$char = "]";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '58') && ($dcvTOstring_process_char == 1)  ) {
			$char = ":";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '59') && ($dcvTOstring_process_char == 1)  ) {
			$char = "\"";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '60') && ($dcvTOstring_process_char == 1)  ) {
			$char = "'";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '61') && ($dcvTOstring_process_char == 1)  ) {
			$char = ";";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '62') && ($dcvTOstring_process_char == 1)  ) {
			$char = ",";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '63') && ($dcvTOstring_process_char == 1)  ) {
			$char = ".";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '64') && ($dcvTOstring_process_char == 1)  ) {
			$char = "/";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '65') && ($dcvTOstring_process_char == 1)  ) {
			$char = "<";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '66') && ($dcvTOstring_process_char == 1)  ) {
			$char = ">";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '67') && ($dcvTOstring_process_char == 1)  ) {
			$char = "?";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		if ( ($char == '68') && ($dcvTOstring_process_char == 1)  ) {
			$char = " ";
			$dcvTOstring_process_char = 0;
		} else {
			/* pass */
		}
		$apache_dcvTOstring_OUT = $apache_dcvTOstring_OUT.$char;
	}

	/* TAGS TO RETURN */
	return $apache_dcvTOstring_OUT;
}

/* GANTT CHART HEADER ROW */
function ganttHeader ($apache_gantt_chart_start, $apache_gantt_chart_end, $build_popup_canvas="NO") 
{
	/* CALL THIS FUNCTION WITH... */
	/* $list($myganttheader,$myganttchartlength) = ganttHeader($chart_start, $chart_end, $build_popup_canvas [POPUP | NO]); */
	/* -- allows for quick and dirty unpacking */
	/* -- following variables must be declared prior to calling this function... */
	/*	-- $seer_GANTT_CHART_WIDTH_IN_PIXELS */
	/*	--  $seer_GANTT_CHART_TICKS */
	/*	-- $seer_GANTT_CHART_TABLE_PIXELS */
	
	/* GLOBALIZE VARIABLES */
	global $seer_GANTT_CHART_WIDTH_IN_PIXELS, $seer_GANTT_CHART_TICKS, $seer_GANTT_CHART_TABLE_PIXELS, $seer_GANTT_CHART_WIDTH_IN_PIXELS_POPUP_CANVAS, $seer_GANTT_CHART_TICKS_POPUP_CANVAS, $seer_GANTT_CHART_TABLE_PIXELS_POPUP_CANVAS;

	/* CHART PARAMETERS TO USE */
	if ($build_popup_canvas != 'POPUP') {
		$seer_GANTT_CHART_WIDTH_IN_PIXELS_TO_USE = $seer_GANTT_CHART_WIDTH_IN_PIXELS;
		$seer_GANTT_CHART_TICKS_TO_USE = $seer_GANTT_CHART_TICKS;
		$seer_GANTT_CHART_TABLE_PIXELS_TO_USE = $seer_GANTT_CHART_TABLE_PIXELS;
	} else {
		$seer_GANTT_CHART_WIDTH_IN_PIXELS_TO_USE = $seer_GANTT_CHART_WIDTH_IN_PIXELS_POPUP_CANVAS;
		$seer_GANTT_CHART_TICKS_TO_USE = $seer_GANTT_CHART_TICKS_POPUP_CANVAS;
		$seer_GANTT_CHART_TABLE_PIXELS_TO_USE = $seer_GANTT_CHART_TABLE_PIXELS_POPUP_CANVAS;
	}

	/* EXECUTE */
	$apache_gantt_chart_ticks = $seer_GANTT_CHART_TICKS_TO_USE;
	$apache_gantt_chart_tick_width = ($seer_GANTT_CHART_TABLE_PIXELS_TO_USE - 250) / $seer_GANTT_CHART_TICKS_TO_USE;

	$gantt_date_to_tick[1] = $apache_gantt_chart_start;
	$gantt_date_to_tick[$apache_gantt_chart_ticks] = $apache_gantt_chart_end;

	list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_gantt_chart_start,$apache_gantt_chart_end);

	$gantt_tick_cell_time_seconds = varcharTOnumeric2($apache_function_DURATION_UNIXTIME / ($apache_gantt_chart_ticks - 1));
	/* 	-- you get a small amount of rounding error here - where the tick time count drifts over the course of the */
	/*	   chart, but that's the nature of the beast */
	$tick_index = 2;
	while ($tick_index < $apache_gantt_chart_ticks) {
		$gantt_date_to_tick[$tick_index] = datestampAddTime($gantt_date_to_tick[($tick_index-1)], 0, 0, 0, 0, 0, $gantt_tick_cell_time_seconds);
		$tick_index = $tick_index + 1;
	}

	$apache_gantt_header_return = "
							<!-- XXXXXXXXXXX -->
							<!-- GANTT CHART -->
							<!-- XXXXXXXXXXX -->

							<TABLE CLASS='SMALL' ALIGN='CENTER' WIDTH='".$seer_GANTT_CHART_TABLE_PIXELS_TO_USE."' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='175' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B><U>Item to Examine</U></B>
									</TD>
									<TD WIDTH='75' ALIGN='CENTER' VALIGN='MIDDLE'>
										<B><U>Frequency</U></B>
									</TD>
									";


	$gantt_index = 1;
	while ( $gantt_index <= $apache_gantt_chart_ticks ) {
		$gantt_date_to_tick_exploded = explode("_",$gantt_date_to_tick[$gantt_index]);
		$gantt_date_to_tick[$gantt_index] = "
										".$gantt_date_to_tick_exploded[0]."<BR>".
										$gantt_date_to_tick_exploded[1]."<BR>".
										$gantt_date_to_tick_exploded[2]."
										";
		$gantt_index = $gantt_index + 1;
	};

	$gantt_index = 1;
	while ( $gantt_index < $apache_gantt_chart_ticks ) {

		$apache_gantt_header_return = $apache_gantt_header_return."
									<TD WIDTH = '".$apache_gantt_chart_tick_width."' ALIGN='LEFT' VALIGN='BOTTOM'>
										".$gantt_date_to_tick[$gantt_index]."<BR>
										<IMG SRC='./img/gantt_tick.png' ALT='tick'>
									</TD>
									";

		$gantt_index = $gantt_index + 1;
	}

	$apache_gantt_header_return = $apache_gantt_header_return."
									<TD WIDTH = '".$apache_gantt_chart_tick_width."' ALIGN='LEFT' VALIGN='BOTTOM'>
										".$gantt_date_to_tick[$apache_gantt_chart_ticks]."<BR>
										<IMG SRC='./img/gantt_tick.png' ALT='tick_end'>
									</TD>
								</TR>
								";

	$apache_gantt_chart_duration = $apache_function_DURATION_UNIXTIME;
	
	/* RETURN VARIABLES */
	return array($apache_gantt_header_return,$apache_gantt_chart_duration);

}

/* GANTT CHART ROW ENTRY */
function ganttRow ($apache_gantt_chart_item_name, $apache_gantt_chart_start, $apache_gantt_chart_end, $apache_gantt_chart_entryslate, $apache_gantt_chart_rowcolor, $apache_gantt_chart_offset, $build_popup_canvas="NO") 
{
	/* CALL THIS FUNCTION WITH... */
	/* list ($myganttrowentry,$pixeloffsetnextrow) = ganttRow($apache_gantt_chart_item_name,$apache_gantt_chart_start, $apache_gantt_chart_end, $apache_gantt_chart_entryslate, $apache_gantt_chart_rowcolor, $apache_gantt_chart_offset, $build_popup_canvas [POPUP | NO]); */
	/* -- offset is pixels in positive X direction */
	/* -- row color can be identified by an integer, 0 through 5 */
	/* -- allows for quick and dirty unpacking */
	/* -- following variables must be declared prior to calling this function... */
	/*	-- $seer_GANTT_CHART_WIDTH_IN_PIXELS_TO_USE */
	/*	--  $seer_GANTT_CHART_TICKS_TO_USE */
	/*	-- $seer_GANTT_CHART_TABLE_PIXELS_TO_USE */

	/* GLOBALIZE VARIABLES */
	global $seer_GANTT_CHART_WIDTH_IN_PIXELS, $seer_GANTT_CHART_TICKS, $seer_GANTT_CHART_TABLE_PIXELS, $seer_GANTT_CHART_WIDTH_IN_PIXELS_POPUP_CANVAS, $seer_GANTT_CHART_TICKS_POPUP_CANVAS, $seer_GANTT_CHART_TABLE_PIXELS_POPUP_CANVAS;

	/* CHART PARAMETERS TO USE */
	if ($build_popup_canvas != 'POPUP') {
		$seer_GANTT_CHART_WIDTH_IN_PIXELS_TO_USE = $seer_GANTT_CHART_WIDTH_IN_PIXELS;
		$seer_GANTT_CHART_TICKS_TO_USE = $seer_GANTT_CHART_TICKS;
		$seer_GANTT_CHART_TABLE_PIXELS_TO_USE = $seer_GANTT_CHART_TABLE_PIXELS;
	} else {
		$seer_GANTT_CHART_WIDTH_IN_PIXELS_TO_USE = $seer_GANTT_CHART_WIDTH_IN_PIXELS_POPUP_CANVAS;
		$seer_GANTT_CHART_TICKS_TO_USE = $seer_GANTT_CHART_TICKS_POPUP_CANVAS;
		$seer_GANTT_CHART_TABLE_PIXELS_TO_USE = $seer_GANTT_CHART_TABLE_PIXELS_POPUP_CANVAS;
	}

	/* IDENTIFY ROW COLOR REQUESTED */
	if ( $apache_gantt_chart_rowcolor == '' ) {
		$apache_gantt_chart_rowcolor = 0;
	} else {
		/* pass */
	}
	if ( $apache_gantt_chart_rowcolor == 0 ) {
		/* STOCK_COLOR (typically powder blue) */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar.png';
	} else {
		/* pass */
	}
	if ( $apache_gantt_chart_rowcolor == 1 ) {
		/* GREEN */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar_green.png';
	} else {
		/* pass */
	}
	if ( $apache_gantt_chart_rowcolor == 2 ) {
		/* RED */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar_red.png';
	} else {
		/* pass */
	}
	if ( $apache_gantt_chart_rowcolor == 3 ) {
		/* BLUE (navy blue) */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar_blue.png';
	} else {
		/* pass */
	}
	if ( $apache_gantt_chart_rowcolor == 4 ) {
		/* BLACK */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar_black.png';
	} else {
		/* pass */
	}
	if ( $apache_gantt_chart_rowcolor == 5 ) {
		/* YELLOW */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar_yellow.png';
	} else {
		/* pass */
	}

	/* FORCE GREEN FOR CIP CLEANING CYCLES */
	global $seer_WORD_ID_CLEANING;
	if ( $apache_gantt_chart_item_name == $seer_WORD_ID_CLEANING ) {
		/* GREEN */
		$apache_gantt_PLOT_IMAGE = './img/horizontal_bar_green.png';
	} else {
		/* pass */
	}

	/* SEPARATE ENTRYSLATE INTO PAIRS OF START AND END TIMES */
	$apache_gantt_chart_entryslate = explode("QWERTYYTREWQ",$apache_gantt_chart_entryslate);

	/* SEPARATE ENTRYSLATE EXPLODED PAIRS INTO DISCRETE START AND END TIMES */
	$apache_gantt_chart_entryslate_count = 0;
	foreach( $apache_gantt_chart_entryslate as $value ) {
		$value = explode("DVORAKKAROVD",$value);
		$apache_gantt_chart_entryslate_EXPLODED_START[$apache_gantt_chart_entryslate_count] = $value[0];
		$apache_gantt_chart_entryslate_EXPLODED_END[$apache_gantt_chart_entryslate_count] = $value[1];
		$apache_gantt_chart_entryslate_count = $apache_gantt_chart_entryslate_count + 1;
	}

	/* MANIPULATE DISCRETE ENTRIES */
	$apache_gantt_chart_DISPLAY_FILL_COLS = ($seer_GANTT_CHART_TICKS_TO_USE - 1);
	$apache_gantt_chart_FINAL_RECORD_ENTRY = "
								<TR>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										<B><I>".$apache_gantt_chart_item_name."</I></B>
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										<B><I>".$apache_gantt_chart_entryslate_count."</I></B>
									</TD>
									<TD CLASS='hmicellborder2nowrap' COLSPAN='".$apache_gantt_chart_DISPLAY_FILL_COLS."' ALIGN='LEFT' VALIGN='MIDDLE' CELLPADDING=0 CELLSPACING=0>
									";

	/* CONVERT CHART WIDTH TO PIXELS FROM UNIXTIME */
	list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_gantt_chart_start,$apache_gantt_chart_end);

	$apache_gantt_chart_WIDTH_UNIXTIME = $apache_function_DURATION_UNIXTIME;
	$apache_gantt_chart_WIDTH_PIXELS = $seer_GANTT_CHART_WIDTH_IN_PIXELS_TO_USE;

	$apache_gantt_chart_TOTAL_RECORD_UNIXTIME = 0;
	$apache_gantt_chart_index = 0;
	$apache_gantt_chart_first_pass = 0;
	$apache_gantt_last_record_end_point = $apache_gantt_chart_start;
	while ( $apache_gantt_chart_index < $apache_gantt_chart_entryslate_count ) {

		/* DEFINE START POINT FOR RECORD (SPACE WIDTH FROM LAST RECORD) */
		$apache_gantt_chart_start = $apache_gantt_last_record_end_point;
		$apache_gantt_chart_end = $apache_gantt_chart_entryslate_EXPLODED_START[$apache_gantt_chart_index];

		list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_gantt_chart_start,$apache_gantt_chart_end);

		$apache_gantt_chart_PLOTWIDTH_WHITESPACE_UNIXTIME =  $apache_function_DURATION_UNIXTIME;

		$apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS = $apache_gantt_chart_PLOTWIDTH_WHITESPACE_UNIXTIME * ($apache_gantt_chart_WIDTH_PIXELS / $apache_gantt_chart_WIDTH_UNIXTIME);

		/* DEFINE END POINT FOR RECORD (SPACE WIDTH FROM START POINT OF THIS RECORD) */
		$apache_gantt_chart_start = $apache_gantt_chart_entryslate_EXPLODED_START[$apache_gantt_chart_index];
		$apache_gantt_chart_end = $apache_gantt_chart_entryslate_EXPLODED_END[$apache_gantt_chart_index];

		list($apache_function_DURATION_FINAL,$apache_function_DURATION_UNIXTIME) = timeDuration($apache_gantt_chart_start,$apache_gantt_chart_end);

		$apache_gantt_chart_PLOTWIDTH_RECORD_UNIXTIME =  $apache_function_DURATION_UNIXTIME;
		$apache_gantt_chart_TOTAL_RECORD_UNIXTIME = $apache_gantt_chart_TOTAL_RECORD_UNIXTIME + $apache_gantt_chart_PLOTWIDTH_RECORD_UNIXTIME;

		/* CONVERT UNIXTIME TO PIXELS */
		$apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS = varcharTOnumeric2($apache_gantt_chart_PLOTWIDTH_WHITESPACE_UNIXTIME * ($apache_gantt_chart_WIDTH_PIXELS / $apache_gantt_chart_WIDTH_UNIXTIME));
		if ( $apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS >= 0 ) {
		 	if ( $apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS < 1 ) {
				$apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS = 0;
			} else {
				/* pass */
			} 
		} else {
			$apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS = 0;
		}

		$apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS = varcharTOnumeric2($apache_gantt_chart_PLOTWIDTH_RECORD_UNIXTIME * ($apache_gantt_chart_WIDTH_PIXELS / $apache_gantt_chart_WIDTH_UNIXTIME));
		if ( $apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS >= 0 ) {
			if ( $apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS < 1 ) {
				$apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS = 0;
			} else {
				/* pass */
			} 
		} else {
			$apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS = 0;
		}

		/* ACCOUNT FOR PASSED VARIABLE OF OFFSET PIXELS */
		if ( $apache_gantt_chart_first_pass == 0 ) {
			$apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS = $apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS + $apache_gantt_chart_offset;
			$apache_gantt_chart_first_pass = 1;
		} else {
			/* pass */
		}

		/* NOW PLACE THE IMAGES STRATEGICALLY */
		/* -- WARNING!!!! */
		/* -- =======!!!! */
		/* 	While your HTML will not be 'pretty printed' for this section, it is essential not to change the format */
		/*	of this code. When building a gantt chart, we cannot afford to have any spacing or borders whatsoever */
		/*	around images, and having code whitespace will insert whitespace into the markup, and result in */
		/*	whitespace being rendered. */
		/*	LEAVE THIS AS ONE UGLY STRING!  It works this way! (and damn well too) */
		if ($apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS > 0) {	
			$apache_gantt_chart_FINAL_RECORD_ENTRY = $apache_gantt_chart_FINAL_RECORD_ENTRY."<IMG CLASS='ABSOLUTEPLACEMENT' SRC='./img/clearspace_20px_gray.png' WIDTH='".$apache_gantt_chart_PLOTWIDTH_WHITESPACE_PIXELS."' HEIGHT='40' ALT='GANTT_CHART'>";
		} else {

		}
		if ($apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS > 0) {	
			$apache_gantt_chart_FINAL_RECORD_ENTRY = $apache_gantt_chart_FINAL_RECORD_ENTRY."<IMG CLASS='ABSOLUTEPLACEMENT' SRC='".$apache_gantt_PLOT_IMAGE."' WIDTH='".$apache_gantt_chart_PLOTWIDTH_RECORD_PIXELS."' HEIGHT='40' ALT='GANTT_CHART'>";
		} else {

		}

		/* INDEX TO NEXT ONE */
		$apache_gantt_last_record_end_point = $apache_gantt_chart_end;
		$apache_gantt_chart_index = $apache_gantt_chart_index + 1;
	}

	/* DETERMINE TOTAL DURATION */
	$apache_gantt_chart_TOTAL_RECORD_FRIENDLYTIME = unixtimeTOrealtime($apache_gantt_chart_TOTAL_RECORD_UNIXTIME);

	/* FINALIZE THE ROW */
	$apache_gantt_chart_FINAL_RECORD_ENTRY = $apache_gantt_chart_FINAL_RECORD_ENTRY."		
									</TD>
									<TD ALIGN='CENTER' VALIGN='MIDDLE'>
										<B><I>".$apache_gantt_chart_TOTAL_RECORD_FRIENDLYTIME."</I></B>
									</TD>
								</TR>
								";
	/* -- REMOVED */
	/* -- THIS SNIPPET WOULD INSERT AN EMPTY ROW BETWEEN EACH ROW */
	/*    MUCH LIKE WHEN YOU WISH TO 'DOUBLE SPACE' A TEXT DOCUMENT. */
	/*    HOWEVER IT IS BELIEVED THAT MOST USERS DISLIKE THIS, SO WE'RE */
	/*    CUTTING IT OUT... TO RE-ENABLE, SIMPLY UNCOMMENT AND APPEND */
	/*    TO THE VARIABLE FOR FINAL_RECORD_ENTRY, ABOVE. */
							/*	<TR>			*/
							/*		<TD COLSPAN='2'>			*/
							/*			<BR>			*/
							/*		</TD>			*/
							/*		<TD CLASS='hmicellborder2' COLSPAN='".$apache_gantt_chart_DISPLAY_FILL_COLS."'>			*/
							/*			<BR>			*/
							/*		</TD>			*/
							/*		<TD>			*/
							/*			<BR>			*/
							/*		</TD>			*/
							/*	</TR>			*/
							/*	";			*/

	/* RETURN THE ROW */
	return array($apache_gantt_chart_FINAL_RECORD_ENTRY,'0');

}

/* GANTT CHART ROW END */
function ganttEnd () 
{
	/* CALL THIS FUNCTION WITH... */
	/* $myganttrowend = ganttEnd () ; */
	/* -- allows for quick and dirty unpacking */

	/* EXECUTE */
	$apache_gantt_footer_return = "
							</TABLE>

							<!-- XXXXXXXXXXX -->
							";

	/* RETURN THE ROW */
	return $apache_gantt_footer_return;
}

/* APPEND REFERRING PAGE WHEN REGENERATED */
/* -- required for self-regenerating pages with scada functionality */
function referring_page_append_reqd_scada ($NEWAPPENDAGE="NULL") 
{
	/* CALL THIS FUNCTION WITH... */
	/* referring_page_append_reqd_scada($NEWAPPENDAGE); */

	/* GLOBALIZE VARIABLES */
	/*	-- SEER */
	global $seer_REFERRINGPAGE_APPEND, $seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP;

	/* EXECUTE */
	if ( isset($seer_REFERRINGPAGE_APPEND) ) {
		$seer_REFERRINGPAGE_APPEND_FROM_TRAFFIC_COP = $seer_REFERRINGPAGE_APPEND;
	} else {
		/* pass */
	}
	if ($NEWAPPENDAGE != 'NULL') {
		$seer_REFERRINGPAGE_APPEND = $NEWAPPENDAGE;
		/* what would you like to append to the REFERRINGPAGE after keys have been generated */
	} else {
		$seer_REFERRINGPAGE_APPEND = "";
		/* else empty the variable */
	}
}

/* SEARCH FOR SUBSTRING IN ARRAY OF VALUES */
/* -- Return new array with all values containing the substring variable */
function searchForSubstringInArray ($apache_array_to_examine,$apache_substring)
{

	/* CALL THIS FUNCTION WITH... */
	/* list($myfilearray,$myfilearray_count) = searchForSubstringInArray($apache_array_to_examine,$apache_substring); */
	/* -- allows for quick and dirty unpacking */

	$apache_array_to_examine_COUNT = count($apache_array_to_examine);
	$apache_SUBSTR_TEST_KEY = $apache_substring;

	$apache_array_to_examine_COUNT_INDEX = 0;
	$apache_SEARCH_RESULT_COUNT = 0;

	while ( $apache_array_to_examine_COUNT_INDEX < $apache_array_to_examine_COUNT ) {

		$apache_SEARCH_RESULT_TEST = substr_count($apache_array_to_examine[$apache_array_to_examine_COUNT_INDEX], $apache_SUBSTR_TEST_KEY);

		if ( $apache_SEARCH_RESULT_TEST > 0 ) {
			$apache_SEARCH_RESULT[$apache_SEARCH_RESULT_COUNT] = $apache_array_to_examine[$apache_array_to_examine_COUNT_INDEX];
			$apache_SEARCH_RESULT_COUNT = $apache_SEARCH_RESULT_COUNT + 1;
		} else {
			/* pass */
		}

		$apache_array_to_examine_COUNT_INDEX = $apache_array_to_examine_COUNT_INDEX + 1;
	}

	/* RETURN NEW ARRAY AND ITEM COUNT FOR ARRAY */
	return array($apache_SEARCH_RESULT,$apache_SEARCH_RESULT_COUNT);

}

/* GENERATE MACHINE CONTROL MENU FOR A MODEL */
/* -- Return markup for the menu */
function machinecontrol_menu_markup ($seer_model_to_examine)
{
	/* CALL THIS FUNCTION WITH... */
	/* $mymarkup_this_model = machinecontrol_menu_markup($seer_model_to_examine); */
	/* -- be sure following variables are decalred BEFORE calling... */
	/*	-- */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $apache_WEBROOT, $apache_seer_VERSION, $seer_language_file;

	/*	-- NAVIGATION */
	global $seer_REFERRINGPAGE_ADDKEYINFO;

	/* PULL THE LANGUAGE FILE */
	require($seer_language_file);

	/* PULL THE MODEL'S GLOBAL OPTIONS FILE */
	require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/config/'.$seer_model_to_examine.'/globaloptions_'.$seer_model_to_examine.'_0.php');

	/* COUNT LINKS (HMI OR REPORT) */
	$seer_model_to_examine_LINK_COUNT = 0;
	foreach ($MODEL_HMI_ID as &$MODEL_HMI_ID_EXAMINED) {
		$seer_model_to_examine_LINK_COUNT = $seer_model_to_examine_LINK_COUNT + 1;
	}

	/* HEADER */
	$seer_model_to_examine_LINK_MARKUP = "
								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
								<!-- GENERATED LINK MACHINECONTROL MENU MARKUP FOR A MODEL --> 
								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

								<TR>
									<TD>
										<FORM ACTION='./seer_traffic_cop.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='700' CELLPADDING=0 CELLSPACING=0>
										<TR>
											<TD COLSPAN='4'>
												<BR>
												<P CLASS='INFOREPORTBIGTEXT'>
												".$MODEL_NAME_TO_USE.": [<I>".$MODEL_CODENAME_TO_USE."</I>]
												</P>
												<INPUT TYPE='HIDDEN' NAME='seer_TRAFFIC_COP_OPTION_2' VALUE='".$seer_model_to_examine."'>
												<INPUT TYPE='HIDDEN' NAME='seer_TRAFFIC_COP_TARGET' VALUE='./seer_traffic_cop_option_negotiation.php'>
											</TD>
										</TR>
										<TR>
											<TD COLSPAN='3'>
												<B><I>".$multilang_STATIC_MODEL_ID.": </I></B><BR><BR>
												<SELECT NAME='seer_TRAFFIC_COP_OPTION'><OPTION VALUE=''>".$multilang_STATIC_SELECT.$multilang_MENU_SELECT_MODEL.$MODEL_FORMFILL_MODELS_TO_USE."</SELECT><BR>
												<BR>
											</TD>
											<TD VALIGN='MIDDLE'>
												<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
											</TD>
										</TR>
										";

	/* LINKS */
	$seer_model_to_examine_LINK_CYCLE_COUNT = 0;
	$seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING = 0;
	$seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "NO";
	foreach ($MODEL_HMI_ID as &$MODEL_HMI_ID_EXAMINED) {
		if ($seer_model_to_examine_LINK_CYCLE_COUNT == 0) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										<TR>
										";
			$seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "YES";
		} else {
			/* pass */
		}
		$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
											<TD WIDTH='175' VALIGN='TOP'>
												<INPUT TYPE='RADIO' NAME='seer_TRAFFIC_COP_OPTION_3' VALUE='".$MODEL_HMI_ID_EXAMINED[0]."'>".$multilang_STATIC_HMI."[".$seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING."]<BR>- ".$MODEL_HMI_ID_EXAMINED[1]."<BR>
											</TD>
											";
		if ($seer_model_to_examine_LINK_CYCLE_COUNT == 3) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										</TR>
										<TR>
											<TD COLSPAN='4'>
												<BR>
											</TD>
										</TR>
										";
			$seer_model_to_examine_LINK_CYCLE_COUNT = 0;
			$seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "NO";
		} else {
			$seer_model_to_examine_LINK_CYCLE_COUNT = $seer_model_to_examine_LINK_CYCLE_COUNT + 1;
		}
		$seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING = $seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING + 1;
	}

	if ($seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "YES") {
		if ($seer_model_to_examine_LINK_CYCLE_COUNT == 0) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										<TR>
										";
		} else {
			/* pass */
		}
		while ($seer_model_to_examine_LINK_CYCLE_COUNT <= 3) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
											<TD>
												<BR>
											</TD>
											";
			$seer_model_to_examine_LINK_CYCLE_COUNT = $seer_model_to_examine_LINK_CYCLE_COUNT + 1;
		}
		$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										</TR>
										<TR>
											<TD COLSPAN='4'>
												<BR>
											</TD>
										</TR>
										";
	} else {
		/* pass */
	}

	/* FOOTER */
	$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										<TR>
											<TD COLSPAN='4'>
												<IMG SRC='./img/horizontal_bar_black.png' WIDTH='700' HEIGHT='2' ALT='BAR'><BR>
												<BR>
											</TD>
										</TR>
										</TABLE>
										</FORM>
									</TD>
								</TR>

								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
								";

	/* RETURN MARKUP */
	return $seer_model_to_examine_LINK_MARKUP;
}

/* GENERATE REPORT MENU FOR A MODEL */
/* -- Return markup for the menu */
function report_menu_markup ($seer_model_to_examine)
{
	/* CALL THIS FUNCTION WITH... */
	/* $mymarkup_this_model = report_menu_markup($seer_model_to_examine); */
	/* -- be sure following variables are decalred BEFORE calling... */
	/*	-- */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $apache_WEBROOT, $apache_seer_VERSION, $seer_language_file;

	/*	-- NAVIGATION */
	global $seer_REFERRINGPAGE_ADDKEYINFO;

	/* PULL THE LANGUAGE FILE */
	require($seer_language_file);

	/* PULL THE MODEL'S GLOBAL OPTIONS FILE */
	require($apache_WEBROOT.'/'.$apache_seer_VERSION.'/config/'.$seer_model_to_examine.'/globaloptions_'.$seer_model_to_examine.'_0.php');

	/* COUNT LINKS (HMI OR REPORT) */
	$seer_model_to_examine_LINK_COUNT = 0;
	foreach ($MODEL_HMI_ID as &$MODEL_HMI_ID_EXAMINED) {
		$seer_model_to_examine_LINK_COUNT = $seer_model_to_examine_LINK_COUNT + 1;
	}

	/* HEADER */
	$seer_model_to_examine_LINK_MARKUP = "
								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
								<!-- GENERATED LINK REPORT MARKUP FOR A MODEL -->
								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

								<TR>
									<TD>
										<FORM ACTION='./seer_traffic_cop.php".$seer_REFERRINGPAGE_ADDKEYINFO."' METHOD='post'>
										<TABLE CLASS='STANDARD' ALIGN='LEFT' WIDTH='700' CELLPADDING=0 CELLSPACING=0>
										<TR>
											<TD COLSPAN='4'>
												<BR>
												<P CLASS='INFOREPORTBIGTEXT'>
												".$MODEL_NAME_TO_USE.": [<I>".$MODEL_CODENAME_TO_USE."</I>]
												</P>
												<INPUT TYPE='HIDDEN' NAME='seer_TRAFFIC_COP_OPTION_2' VALUE='".$seer_model_to_examine."'>
												<INPUT TYPE='HIDDEN' NAME='seer_TRAFFIC_COP_TARGET' VALUE='./seer_traffic_cop_option_negotiation.php'>
											</TD>
										</TR>
										<TR>
											<TD COLSPAN='3'>
												<B><I>".$multilang_STATIC_MODEL_ID.": </I></B><BR><BR>
												<SELECT NAME='seer_TRAFFIC_COP_OPTION'><OPTION VALUE=''>".$multilang_STATIC_SELECT.$multilang_MENU_SELECT_MODEL.$MODEL_FORMFILL_MODELS_TO_USE."</SELECT><BR>
												<BR>
											</TD>
											<TD VALIGN='MIDDLE'>
												<INPUT TYPE='image' name='enter' src='./img/form_submit_0.png'>
											</TD>
										</TR>
										";

	/* LINKS */
	$seer_model_to_examine_LINK_CYCLE_COUNT = 0;
	$seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING = 0;
	$seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "NO";
	foreach ($MODEL_REPORT_ID as &$MODEL_REPORT_ID_EXAMINED) {
		if ($seer_model_to_examine_LINK_CYCLE_COUNT == 0) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										<TR>
										";
			$seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "YES";
		} else {
			/* pass */
		}
		$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
											<TD WIDTH='175' VALIGN='TOP'>
												<INPUT TYPE='RADIO' NAME='seer_TRAFFIC_COP_OPTION_3' VALUE='".$MODEL_REPORT_ID_EXAMINED[0]."'>".$multilang_STATIC_REPORT."[".$seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING."]<BR>- ".$MODEL_REPORT_ID_EXAMINED[1]."<BR>
											</TD>
											";
		if ($seer_model_to_examine_LINK_CYCLE_COUNT == 3) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										</TR>
										<TR>
											<TD COLSPAN='4'>
												<BR>
											</TD>
										</TR>
										";
			$seer_model_to_examine_LINK_CYCLE_COUNT = 0;
			$seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "NO";
		} else {
			$seer_model_to_examine_LINK_CYCLE_COUNT = $seer_model_to_examine_LINK_CYCLE_COUNT + 1;
		}
		$seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING = $seer_model_to_examine_LINK_CYCLE_COUNT_NON_ROLLING + 1;
	}

	if ($seer_model_to_examine_LINK_CYCLE_COUNT_CLOSE_TAG_REQUIRED = "YES") {
		while ($seer_model_to_examine_LINK_CYCLE_COUNT <= 3) {
			$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
											<TD WIDTH='175' VALIGN='TOP'>
												<BR>
											</TD>
											";
			$seer_model_to_examine_LINK_CYCLE_COUNT = $seer_model_to_examine_LINK_CYCLE_COUNT + 1;
		}
		$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										</TR>
										<TR>
											<TD COLSPAN='4'>
												<BR>
											</TD>
										</TR>
										";
	} else {
		/* pass */
	}

	/* FOOTER */
	$seer_model_to_examine_LINK_MARKUP = $seer_model_to_examine_LINK_MARKUP."
										<TR>
											<TD COLSPAN='4'>
												<IMG SRC='./img/horizontal_bar_black.png' WIDTH='700' HEIGHT='2' ALT='BAR'><BR>
												<BR>
											</TD>
										</TR>
										</TABLE>
										</FORM>
									</TD>
								</TR>

								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
								";

	/* RETURN MARKUP */
	return $seer_model_to_examine_LINK_MARKUP;
}

/* UPDATE USER STATUS */
function seer_update_user_status ()
{
	/* GLOBALIZE VARIABLES */

	/* 	-- SEER */
	global $seer_USERACTIVE, $mysql_seer_CONNECT, $mysql_seer_access_USERNAME;

	/*	-- APACHE */
	global $apache_DEFAULTDATESTAMP;

	/* UPDATE */
	if ( $seer_USERACTIVE == "YES" ) {
		/* update LASTACTIVITY filed in access table of seer db */
		$mysql_seer_access_query = "UPDATE access SET LASTACTIVITY='".$apache_DEFAULTDATESTAMP."' WHERE USERNAME='".$mysql_seer_access_USERNAME."'";
		mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);
	} else {
		/* no action necessary */
	}
}

/* LANGUAGE BAR DISPLAY */
/* -- SCROLLS THROUGH ENABLED LANGUAGES AND OFFERS ABILITY TO SWITCH BETWEEN */
/*    DEFAULT LANGUAGE AND OTHER AVAILABLE / ENABLED ONES */
function seer_language_bar ()
{
	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $apache_seer_VERSION, $seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME, $seer_ENABLE_MULTILINGUAL, $seer_ENABLE_MULTILINGUAL_LANG;


	/* ZERO OUT THE OUTPUT */
	$apache_display_language_bar = "";
	$lang_count = 0;

	/* IF IN MULTILANGUAGE MODE, BUILD THE LANGUAGE BAR */
	if ( $seer_ENABLE_MULTILINGUAL == "YES" ) {
		/* DISPLAY FULL BANNER */
		/* -- DEFAULT language */
		$apache_display_language_bar = $apache_display_language_bar."
						<TD WIDTH='40' ALIGN='RIGHT'>
							<FORM ACTION='".$seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION."/index.php' METHOD='post'>
								<INPUT TYPE='hidden' name='seer_LANGUAGE' value='DEFAULT'>
								<INPUT TYPE='image' name='enter' src='/".$apache_seer_VERSION."/img/language_select_DEFAULT.png'>
							</FORM>
						</TD>
						";
		$lang_count = 1;
		/* -- SCROLL THROUGH AVAILABLE LANGUAGES */
		foreach ($seer_ENABLE_MULTILINGUAL_LANG as &$seer_ENABLE_MULTILINGUAL_LANG_EXAMINED) {
			if ($seer_ENABLE_MULTILINGUAL_LANG_EXAMINED[1] == "YES") {
				$apache_display_language_bar = $apache_display_language_bar."
						<TD WIDTH='40' ALIGN='RIGHT'>
							<FORM ACTION='".$seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION."/index.php' METHOD='post'>
								<INPUT TYPE='hidden' name='seer_LANGUAGE' value='".$seer_ENABLE_MULTILINGUAL_LANG_EXAMINED[0]."'>
								<INPUT TYPE='image' name='enter' src='/".$apache_seer_VERSION."/img/language_select_".$seer_ENABLE_MULTILINGUAL_LANG_EXAMINED[0].".png'>
							</FORM>
						</TD>
						";
				$lang_count = $lang_count + 1;
			} else {
				/* pass */
			}
		}

	} else {
		/* ONLY DISPLAY BANNER FOR DEFAULT */
		$apache_display_language_bar = $apache_display_language_bar."
						<TD WIDTH='40' ALIGN='RIGHT'>
							<FORM ACTION='".$seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION."/index.php' METHOD='post'>
								<INPUT TYPE='hidden' name='seer_LANGUAGE' value='DEFAULT'>
								<INPUT TYPE='image' name='enter' src='/".$apache_seer_VERSION."/img/language_select_DEFAULT.png'>
							</FORM>
						</TD>
						";
		$lang_count = 1;
	}

	/* PUT ALL LANGUAGE BUTTONS INTO A SINGLE BAR THAT IS ALIGNED RIGHT */
	$lang_margin_width = (930 - ($lang_count * 40)) - 20;
	$apache_display_language_bar = "
				<!-- XXXXXXXXXXXX -->
				<!-- LANGUAGE BAR -->
				<!-- XXXXXXXXXXXX -->

				<TABLE CLASS='STANDARD' WIDTH='930' CELLPADDING=0 CELLSPACING=0>
					<TR ALIGN='RIGHT'>
						<TD WIDTH='".$lang_margin_width."'>
							<BR>
						</TD>
						".$apache_display_language_bar."
						<TD WIDTH='20'>
							<BR>
						</TD>
					</TR>
				</TABLE>

				<!-- XXXXXXXXXXXX -->
				";

	/* RETURN MARKUP */
	echo $apache_display_language_bar;
}

/* SYSTEM FAULT DB QUERY */
/* -- CHECKS FOR UN-ACKNOWLEDGED FAULTS WITHIN mod_openopc */
/*    DISPLAYS DATA AND FAULT PILOT LIGHTS IN THE TOP BANNER */

function mod_openopc_status_check ()
{
	/* GLOBALIZE VARIABLES */

	/* 	-- SEER */
	global $seer_settings_FIRSTRUN, $seer_PILOT_DATA_DISPLAY_ONLY, $seer_DEFAULTPILOT_ALARM_ON, $seer_DEFAULTPILOT_ALARM_OFF, $seer_DEFAULTPILOT_DATA_ON, $seer_DEFAULTPILOT_DATA_OFF, $seer_DEFAULTPILOT_ALARM_WARN, $seer_DEFAULTPILOT_DATA_WARN;

	/*	-- SEER (RETURNED) */
	global $seer_PILOT_ALARM, $seer_PILOT_DATA;

	/*	-- mod_openopc */
	global $mysql_mod_openopc_CONNECT, $mod_openopc_WARN_FAULT_COUNT;

	/* SYSTEM FAULT DB QUERY */
	if ( $seer_settings_FIRSTRUN == 'NO' ) {
		$mysql_mod_openopc_query = "SELECT DATESTAMP, ACKNOWLEDGED FROM system_faults WHERE ACKNOWLEDGED IS NULL";
		$mysql_mod_openopc_query_result = mysqli_query($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_query);
		if (!$mysql_mod_openopc_query_result) die("Something's not right... couldn't execute query to system_fault data.");
		$mysql_mod_openopc_ACTIVE_FAULT_COUNT = mysqli_num_rows($mysql_mod_openopc_query_result);
	} else {
		$mysql_mod_openopc_ACTIVE_FAULT_COUNT = 0;
	}

	/* RETURN VARIABLES */
	if ( $seer_PILOT_DATA_DISPLAY_ONLY == 'YES' ) {
		$seer_DEFAULTPILOT_DATA_OFF = $seer_DEFAULTPILOT_ALARM_ON;
	} else {
		/* pass */
	} 

	/* FAULT UPDATE */
	if ( $mysql_mod_openopc_ACTIVE_FAULT_COUNT == 0 ) {
		/* ALL SYSTEMS GO */
		$seer_PILOT_ALARM = $seer_DEFAULTPILOT_ALARM_OFF;
		$seer_PILOT_DATA = $seer_DEFAULTPILOT_DATA_ON;
	} else {
		if ( $mysql_mod_openopc_ACTIVE_FAULT_COUNT <= $mod_openopc_WARN_FAULT_COUNT ) {
			/* WARNING CONDITION */
			$seer_PILOT_ALARM = $seer_DEFAULTPILOT_ALARM_WARN;
			$seer_PILOT_DATA = $seer_DEFAULTPILOT_DATA_WARN;
		} else {
			/* FAULT CONDITION */
			$seer_PILOT_ALARM = $seer_DEFAULTPILOT_ALARM_ON;
			$seer_PILOT_DATA = $seer_DEFAULTPILOT_DATA_OFF;
		}
	}
}

/* FINAL REPORT ASSEMBLY */
/* -- MOST REPORTS OR HMI'S THAT REQUIRE CREDENTIAL BASED DISPLAY UTILIZE THIS SUBROUTINE */
function seer_final_report ()
{
	/* GLOBALIZE VARIABLES */

	/* 	-- SEER */
	global $mysql_seer_access_DEPARTMENT, $seer_USERACTIVE, $mysql_seer_access_ACCESSLEVEL, $seer_settings_ADMINALWAYSVIEWINSTALLOPTIONS, $seer_settings_FIRSTRUN, $seer_REFERRINGPAGE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_DENIED, $multilang_STATIC_ACCESS_LEVEL_LOW;

	/*	-- CONTENT */
	global  $apache_REPORTL7, $apache_REPORTL6, $apache_REPORTL5, $apache_REPORTL4, $apache_REPORTL3, $apache_REPORTL2, $apache_REPORTL1, $apache_REPORTL0, $apache_REPORT;

	/*	-- MODEL SPECIFIC */
	global $MODEL_INSTANCE_DEPT_ALLOW_ALL, $MODEL_INSTANCE_DEPT_ARRAY;
	
	/* 	-- LAYOUT SPECIFIC */
	global $MODEL_MENUMACHINECONTROL_ENABLE, $MODEL_INFOREPORT_ENABLE, $MODEL_USERREPORT_ENABLE, $MODEL_ASSEMBLE_REPORT_BACKWARDS;

	/* ZERO OUT THE REPORT DISPLAY */
	$apache_REPORT = "";

	/* CHECK FOR DEPARTMENT ACCESS */
	/* -- USER LEVEL 7, 5, 4 ONLY */
	$MODEL_INSTANCE_DEPT_CHECK_OK = 0;
	if ( $MODEL_INSTANCE_DEPT_ALLOW_ALL != "YES" ) {
		foreach ($MODEL_INSTANCE_DEPT_ARRAY as &$MODEL_INSTANCE_DEPT_COMPARE) {
			if ($MODEL_INSTANCE_DEPT_COMPARE == $mysql_seer_access_DEPARTMENT) {
				$MODEL_INSTANCE_DEPT_CHECK_OK = 1;
			} else {
				/* pass */
			}
		}
		/* HARD OVERRIDE - ALLOWS USERS WHO ARE MEMBERS OF THE GLOBAL OPTINS */
		/* LISTED "MAINTENANCE" DEPARTMENT TO BE ABLE TO SEE EVERYTHING */
		if ($seer_DEPT_ID_MAINTENANCE == $mysql_seer_access_DEPARTMENT) {
			$MODEL_INSTANCE_DEPT_CHECK_OK = 1;
		} else {
			/* pass */
		}
	} else {
		/* IF WE ALLOW ALL, THEN SIMPLY SET THE CHECK BIT TO 1 */
		$MODEL_INSTANCE_DEPT_CHECK_OK = 1;
	}

	/* ASSEMBLE THE REPORT BASED UPON USER LEVEL AND CREDENTIALS */
	if ( $seer_USERACTIVE == "YES" ) {
		if ( $MODEL_ASSEMBLE_REPORT_BACKWARDS == "YES" ) {
			if ( ($mysql_seer_access_ACCESSLEVEL == 6) || ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <= 7) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
				$apache_REPORT = $apache_REPORTL7.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( ($mysql_seer_access_ACCESSLEVEL == 6) || ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <=6) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
					$apache_REPORT = $apache_REPORTL6.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <= 5) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
						$apache_REPORT = $apache_REPORTL5.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <= 4) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
							$apache_REPORT = $apache_REPORTL4.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( $mysql_seer_access_ACCESSLEVEL <= 3 ) {
								$apache_REPORT = $apache_REPORTL3.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( $mysql_seer_access_ACCESSLEVEL <= 2 ) {
									$apache_REPORT = $apache_REPORTL2.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( $mysql_seer_access_ACCESSLEVEL <= 1 ) {
										$apache_REPORT = $apache_REPORTL1.$apache_REPORT;
			} else {
				/* continue */
			}
			if ( (($mysql_seer_access_ACCESSLEVEL <=1) && ($seer_settings_ADMINALWAYSVIEWINSTALLOPTIONS == "YES")) || ($seer_settings_FIRSTRUN == "YES") ) {
											$apache_REPORT = $apache_REPORTL0.$apache_REPORT;
			} else {
				/* continue */
			}
		} else {
			if ( ($mysql_seer_access_ACCESSLEVEL == 6) || ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <= 7) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
				$apache_REPORT = $apache_REPORT.$apache_REPORTL7;
			} else {
				/* continue */
			}
			if ( ($mysql_seer_access_ACCESSLEVEL == 6) || ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <=6) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
					$apache_REPORT = $apache_REPORT.$apache_REPORTL6;
			} else {
				/* continue */
			}
			if ( ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <= 5) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
						$apache_REPORT = $apache_REPORT.$apache_REPORTL5;
			} else {
				/* continue */
			}
			if ( ($mysql_seer_access_ACCESSLEVEL <= 3) || (($mysql_seer_access_ACCESSLEVEL <= 4) && ($MODEL_INSTANCE_DEPT_CHECK_OK == 1)) ) {
							$apache_REPORT = $apache_REPORT.$apache_REPORTL4;
			} else {
				/* continue */
			}
			if ( $mysql_seer_access_ACCESSLEVEL <= 3 ) {
								$apache_REPORT = $apache_REPORT.$apache_REPORTL3;
			} else {
				/* continue */
			}
			if ( $mysql_seer_access_ACCESSLEVEL <= 2 ) {
									$apache_REPORT = $apache_REPORT.$apache_REPORTL2;
			} else {
				/* continue */
			}
			if ( $mysql_seer_access_ACCESSLEVEL <= 1 ) {
										$apache_REPORT = $apache_REPORT.$apache_REPORTL1;
			} else {
				/* continue */
			}
			if ( (($mysql_seer_access_ACCESSLEVEL <=1) && ($seer_settings_ADMINALWAYSVIEWINSTALLOPTIONS == "YES")) || ($seer_settings_FIRSTRUN == "YES") ) {
											$apache_REPORT = $apache_REPORT.$apache_REPORTL0;
			} else {
				/* continue */
			}
		}
	} else {
		/* pass */
	}

	/* REJECT THE INVALID / NOT LOGGED IN / NOT IN THEIR PROPER */
	/* DEPARTMENT - USER LEVELS 7 THROUGH 4, EXCLUDING 3 AND UP */
	if ( $apache_REPORT == "" ) {
		if ( ($seer_settings_FIRSTRUN == "YES") && ($seer_REFERRINGPAGE == "./seer_settings.php") ) {
			$apache_REPORT = $apache_REPORT.$apache_REPORTL0;
		} else {
			/* if you don't even have operator access level */
			/* then you shouldn't be here */
			$apache_REPORT = $apache_REPORT."
								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
								<!-- ACCESS DENIED - HARD - BY seer_final_report() -->
								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

								<TABLE ALIGN='CENTER' WIDTH='500' CELLPADDING=0 CELLSPACING=0>
									<TR>
										<TD WIDTH='500'>
											<P CLASS='INFOREPORT'>
											<BR>
											<B><I>".$multilang_STATIC_DENIED."</I></B>.<BR>
											<BR>
											".$multilang_STATIC_ACCESS_LEVEL_LOW."<BR>
											<BR>
											</P>
										</TD>
									</TR>
								</TABLE>

								<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
								";
		}
	} else {
		/* pass */
	}

	/* LAYOUT CHECK */
	/* 	-- MENUMACHINECONTROL BLOCK DEVICE */
	if ( $MODEL_MENUMACHINECONTROL_ENABLE == "YES" ) {
		$apache_REPORT = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- LAYOUT TYPE - MENUMACHINECONTROL BLOCK -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<DIV CLASS='MENUMACHINECONTROL'>
								".$apache_REPORT."
								<P CLASS='INFOREPORT'>
									<BR>
								</P>
							</DIV>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";
	} else {
		/* pass */
	}
	/* 	-- INFOREPORT BLOCK DEVICE */
	if ( $MODEL_INFOREPORT_ENABLE == "YES" ) {
		$apache_REPORT = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- LAYOUT TYPE - INFOREPORT BLOCK -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<DIV CLASS='INFOREPORT'>
								".$apache_REPORT."
							</DIV>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";
	} else {
		/* pass */
	}
	/*	-- USERREPORT BLOCK DEVICE */
	if ( $MODEL_USERREPORT_ENABLE == "YES" ) {
		$apache_REPORT = "
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							<!-- LAYOUT TYPE - USERREPORT BLOCK -->
							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

							<DIV CLASS='USERREPORT'>
								".$apache_REPORT."
							</DIV>

							<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
							";
	} else {
		/* pass */
	}
}

/* SEER MYSQL CONNECT */
/* -- OPEN CONNECTIONS TO OUR MYSQL DATABASES */
function seer_mysql_connect ()
{
	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	/*	-- -- MAIN */
	global $mysql_seer_DBNAME, $mysql_seer_CONNECT, $mysql_seer_HOST, $mysql_seer_USER, $mysql_seer_PASSWORD, $seer_SECURITY_LEVEL;

	/*	-- SEER */
	/*	-- -- REFERRING PAGE and KEY INFO */
	global $seer_REFERRINGPAGE, $seer_REFERRINGPAGE_ADDKEYINFO, $seer_REFERRINGPAGE_ADDKEYINFO_APPEND;

	/*	-- SEER */
	/*	-- -- USER DEPENDANT */
	global $seer_USERACTIVE, $seer_USERNAME, $seer_USERNAME_DISCARD, $seer_ACTIVEKEY, $mysql_seer_USERNAME, $mysql_seer_access_USERNAME, $mysql_seer_access_UID, $mysql_seer_access_REALNAME, $mysql_seer_access_PASSWORD, $mysql_seer_access_PHONE, $mysql_seer_access_EMAIL, $mysql_seer_access_COMPANY, $mysql_seer_access_SITE, $mysql_seer_access_DEPARTMENT, $mysql_seer_access_SUPERVISOR, $mysql_seer_access_SHIFT, $mysql_seer_access_ACCESSGRANTED, $mysql_seer_access_ACCESSGRANTEDBY, $mysql_seer_access_LASTMODIFIED, $mysql_seer_access_LASTMODIFIEDBY, $mysql_seer_access_ACCESSLEVEL, $mysql_seer_access_ACCESSSTATE, $mysql_seer_access_LASTLOGIN, $mysql_seer_access_LASTACTIVITY, $mysql_seer_access_ACTIVEKEY;

	/*	-- SEER */
	/*	-- -- LANGUAGE CONTROLS */
	global $seer_LANGUAGE, $seer_DEFAULT_LANGUAGE, $seer_ENABLE_MULTILINGUAL;

	/*	-- mod_openopc */
	global $mysql_mod_openopc_DBNAME, $mysql_mod_openopc_CONNECT, $mysql_mod_openopc_HOST, $mysql_mod_openopc_USER, $mysql_mod_openopc_PASSWORD;

	/*	-- PHP INTERNAL */
	global $_GET, $_POST;

	/* PARAMETERS GOVERNING THE CONNECTION TO MySQL */
	/*	via mysqldb PHP PLUGIN */
	$mysql_mod_openopc_CONNECT = mysqli_connect($mysql_mod_openopc_HOST, $mysql_mod_openopc_USER, $mysql_mod_openopc_PASSWORD) or die ('FATAL ERROR CONNECTING TO MYSQL DB mod_openopc - S.E.E.R. WILL NOT FUNCTION PROPERLY OR AT ALL');
	$mysql_seer_CONNECT = mysqli_connect($mysql_seer_HOST, $mysql_seer_USER, $mysql_seer_PASSWORD, $mysql_seer_DBNAME) or die ('FATAL ERROR CONNECTING TO MYSQL DB mod_openopc - S.E.E.R. WILL NOT FUNCTION PROPERLY OR AT ALL');
	/*	-- when opening multiple database server connections with */
	/*		a single page instance, the first follows normal syntax */
	/*		but all subsequent instances REQUIRE the 'true' flag to */
	/*		be added to their call, otherwise PHP will attempt to */
	/*		reuse the previous connection. */
	mysqli_select_db($mysql_mod_openopc_CONNECT, $mysql_mod_openopc_DBNAME);
	mysqli_select_db($mysql_seer_CONNECT, $mysql_seer_DBNAME);

	/* PULL IN USER INFORMATION (WHO IS LOGGED IN, THEIR LANGUAGE, */
	/* AND PRIVILEGES) */
	if ( $_GET['seer_USERNAME'] != '' ) {
		$seer_USERNAME = $_GET['seer_USERNAME'];
	} else {
		if ( $_POST['seer_USERNAME'] != '' ) {
			$seer_USERNAME = $_POST['seer_USERNAME'];
		} else {
			$seer_USERNAME = "WEB_GUEST";
		}
	}

	if ( $_POST['seer_USERNAME_DISCARD'] != '' ) {
		/* for logout function, who are we discarding privilege for */
		$seer_USERNAME_DISCARD = $_POST['seer_USERNAME_DISCARD'];
	} else {
		$seer_USERNAME_DISCARD = "WEB_GUEST";
	}

	if ( $_POST['seer_LANGUAGE'] != '' ) {
		/* defer to POST declaration which allows user on-the-fly change */
		$seer_LANGUAGE = $_POST['seer_LANGUAGE'];
	} else {
		if ( $_GET['seer_LANGUAGE'] != '' ) {
			$seer_LANGUAGE = $_GET['seer_LANGUAGE'];
		} else {
			$seer_LANGUAGE = $seer_DEFAULT_LANGUAGE;
		}
	}

	if ( $seer_LANGUAGE == 'DEFAULT') {
		$seer_LANGUAGE = $seer_DEFAULT_LANGUAGE;
	} else {
		/* pass */
	}

	if ( $seer_ENABLE_MULTILINGUAL == 'YES' ) {
		/* pass */
	} else {
		$seer_LANGUAGE = $seer_DEFAULT_LANGUAGE;
	}

	if ( $_GET['seer_ACTIVEKEY'] != '' ) {
		$seer_ACTIVEKEY = $_GET['seer_ACTIVEKEY'];
		if ( $seer_ACTIVEKEY == 'NEW' ) {
			$seer_ACTIVEKEY = "NONE-or-FAKE".rand(0,32768);
		} else {
			/* a legitimate key, possibly an old one, but at least it is */
			/* legitimate, has been provided... we'll check for freshness */
			/* a few lines down the page */
		}
	} else {
		if ( $_POST['seer_ACTIVEKEY'] != '' ) {
			$seer_ACTIVEKEY = $_POST['seer_ACTIVEKEY'];
			if ( $seer_ACTIVEKEY == 'NEW' ) {
				$seer_ACTIVEKEY = "NONE-or-FAKE".rand(0,32768);
			} else {
				/* a legitimate key, possibly an old one, but at least it is */
				/* legitimate, has been provided... we'll check for freshness */
				/* a few lines down the page */
			}
		} else {
			$seer_ACTIVEKEY = "NONE-or-FAKE".rand(0,32768);
		}
	}

	$mysql_seer_USERNAME = $seer_USERNAME;

	if ( $mysql_seer_USERNAME != 'WEB_GUEST' ) {
		$mysql_seer_access_query = "SELECT * FROM access WHERE USERNAME LIKE '".$mysql_seer_USERNAME."'";
		mysqli_select_db($mysql_seer_CONNECT, $mysql_seer_DBNAME);		
		$mysql_seer_access = mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);
		$mysql_seer_access_row = mysqli_fetch_assoc($mysql_seer_access);

		$mysql_seer_access_USERNAME = $mysql_seer_access_row['USERNAME'];
		$mysql_seer_access_UID = $mysql_seer_access_row['UID'];
		$mysql_seer_access_REALNAME = $mysql_seer_access_row['REALNAME'];
		$mysql_seer_access_PASSWORD = $mysql_seer_access_row['PASSWORD'];
		$mysql_seer_access_PHONE = $mysql_seer_access_row['PHONE'];
		$mysql_seer_access_EMAIL = $mysql_seer_access_row['EMAIL'];
		$mysql_seer_access_COMPANY = $mysql_seer_access_row['COMPANY'];
		$mysql_seer_access_SITE = $mysql_seer_access_row['SITE'];
		$mysql_seer_access_DEPARTMENT = $mysql_seer_access_row['DEPARTMENT'];
		$mysql_seer_access_SUPERVISOR = $mysql_seer_access_row['SUPERVISOR'];
		$mysql_seer_access_SHIFT = $mysql_seer_access_row['SHIFT'];
		$mysql_seer_access_ACCESSGRANTED = $mysql_seer_access_row['ACCESSGRANTED'];
		$mysql_seer_access_ACCESSGRANTEDBY = $mysql_seer_access_row['ACCESSGRANTEDBY'];
		$mysql_seer_access_LASTMODIFIED = $mysql_seer_access_row['LASTMODIFIED'];
		$mysql_seer_access_LASTMODIFIEDBY = $mysql_seer_access_row['LASTMODIFIEDBY'];
		$mysql_seer_access_ACCESSLEVEL = $mysql_seer_access_row['ACCESSLEVEL'];
		$mysql_seer_access_ACCESSSTATE = $mysql_seer_access_row['ACCESSSTATE'];
		$mysql_seer_access_LASTLOGIN = $mysql_seer_access_row['LASTLOGIN'];
		$mysql_seer_access_LASTACTIVITY = $mysql_seer_access_row['LASTACTIVITY'];
		$mysql_seer_access_ACTIVEKEY = $mysql_seer_access_row['ACTIVEKEY'];
		if ( $mysql_seer_access_ACCESSLEVEL != '' ) {
			$seer_USERACTIVE = "YES";
			if ( $mysql_seer_access_ACCESSSTATE < 1 ) {
				$seer_USERACTIVE = "NO";
			} else {
				/* user is active and access state is turned on (1) */
			}
				/* hash key based security on 3 levels, HIGH, MEDIUM, and LOW */
				/* -- see globaloptions file for details */
				if ( ($mysql_seer_access_ACTIVEKEY != $seer_ACTIVEKEY) && ($seer_SECURITY_LEVEL != 'LOW') ) {
					/* if the keys do not match, and we're in HIGH or MEDIUM mode */
					$seer_USERACTIVE = "NO";
				} else {
					/* if the keys match, or we're in LOW mode */
					/* user is presumed authentic */
					/* generate new activekey */				
					$seer_ACTIVEKEY0 = rand(0,32768);
					$seer_ACTIVEKEY1 = rand(0,32768);
					$seer_ACTIVEKEY2 = rand(0,32768);
					$seer_ACTIVEKEY3 = rand(0,32768);
					$seer_ACTIVEKEY4 = rand(0,32768);
					$seer_ACTIVEKEY5 = rand(0,32768);
					$seer_ACTIVEKEY_PENDING = $seer_ACTIVEKEY0.$seer_ACTIVEKEY1.$seer_ACTIVEKEY2.$seer_ACTIVEKEY3.$seer_ACTIVEKEY4.$seer_ACTIVEKEY5;
					if ( ($seer_SECURITY_LEVEL == 'HIGH') || (($seer_SECURITY_LEVEL == 'MEDIUM') && ($seer_PROCESSLOGIN == 'YES')) ) {
						/* update the user access table, rollover access table ACTIVEKEY */
						$mysql_seer_access_query = "UPDATE access SET ACTIVEKEY='".$seer_ACTIVEKEY_PENDING."' WHERE USERNAME='".$mysql_seer_access_USERNAME."'";
						mysqli_query($mysql_seer_CONNECT, $mysql_seer_access_query);
						/* rollover S.E.E.R. webpage ACTIVEKEY and LANGUAGE */
						$seer_ACTIVEKEY = $seer_ACTIVEKEY_PENDING;
					} else {
						/* pass */
					}
					$seer_REFERRINGPAGE_ADDKEYINFO = "?seer_USERNAME=".$mysql_seer_USERNAME.";seer_LANGUAGE=".$seer_LANGUAGE.";seer_ACTIVEKEY=".$seer_ACTIVEKEY;
					$seer_REFERRINGPAGE_ADDKEYINFO_APPEND = ";seer_USERNAME=".$mysql_seer_USERNAME.";seer_LANGUAGE=".$seer_LANGUAGE.";seer_ACTIVEKEY=".$seer_ACTIVEKEY;
					$seer_REFERRINGPAGE = $seer_REFERRINGPAGE.$seer_REFERRINGPAGE_ADDKEYINFO;
				}

		} else {
			$seer_USERACTIVE = "NO";
		}
	} else {
		$seer_USERACTIVE = "NO";
	}

	if ( $seer_USERACTIVE == "NO" ) {
		$seer_REFERRINGPAGE_ADDKEYINFO = "?seer_LANGUAGE=".$seer_LANGUAGE;
		$seer_REFERRINGPAGE_ADDKEYINFO_APPEND = ";seer_LANGUAGE=".$seer_LANGUAGE;
		/* strip the REFERRINGPAGE_ADDKEYINFO from the end of all URL links */
	} else {
		/* allow seer_REFERRINGPAGE_ADDKEYINFO to be appended to links */
	}
}

/* SEER MYSQL CLOSE */
/* -- GRACEFULLY BREAK DB CONNECTION */

function seer_mysql_close ()
{
	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $mysql_seer_CONNECT;

	/*	-- mod_openopc */
	global $mysql_mod_openopc_CONNECT;

	/* UPDATE USER STATUS IN access TABLE OF SEER DB */
	/*	PRIOR TO CLOSING CONNECTION */
	seer_update_user_status();

	/* CONTROLLED CLOSE OF CONNECTION */
	mysqli_close($mysql_mod_openopc_CONNECT);
	mysqli_close($mysql_seer_CONNECT);
}

/* SEER DISPLAY USER STATUS */
/* -- DISPLAY USER STATUS AND SERVER ENVINRONMENT */
/* -- DISPLAYS THE USER STATUS FOR A GIVEN BROWSER INSTANCE */
/* -- DISPLAYS SERVER ENVIRONMENT FOR THIS INSTANCE */
function seer_display_user_status ($return_rather_than_echo="NO")
{

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_enable_CANVAS, $seer_PLUGINS_TO_USE, $seer_THEME_TO_USE, $seer_ENVIRONMENT_SERVER_MODE, $seer_ENVIRONMENT_SERVER_NAME, $seer_USERACTIVE, $mysql_seer_access_REALNAME, $seer_REFERRINGPAGE_ADDKEYINFO;

	/*	-- mod_openopc */
	global $mod_openopc_OBSERVE_DST;

	/*	-- APACHE */
	global $apache_seer_VERSION, $apache_DEFAULTDATESTAMP, $apache_HTTP_BROWSER_ON_LINE, $apache_HTTP_BROWSER_ON_LINE_VERSION, $apache_HTTP_BROWSER_ON_LINE_ENGINE;

	/*	-- LANGUAGE */
	global $multilang_STATIC_NONE, $multilang_STATIC_115, $multilang_STATIC_116, $multilang_STATIC_117, $multilang_STATIC_118, $multilang_STATIC_124, $multilang_STATIC_125, $multilang_STATIC_126, $multilang_FAULT_36, $multilang_FAULT_37, $multilang_STATIC_DST_NOT_IN_EFFECT, $multilang_STATIC_BROWSER_ENGINE, $multilang_STATIC_BROWSER_NAME, $multilang_STATIC_BROWSER_VERSION, $multilang_STATIC_THEME, $multilang_STATIC_PLUGINS;

	/* SERVER ENVIRONMENT DETERMINATION */
	if ( $seer_ENVIRONMENT_SERVER_MODE == 'DEVELOPMENT' ) {
		/* identify the server environment as development */
		$apache_display_server_envinronment = "-- <I>".$multilang_STATIC_116.":</I>  <B>".$seer_ENVIRONMENT_SERVER_NAME."</B>";
	} else {
		if ( $seer_ENVIRONMENT_SERVER_MODE == 'PRODUCTION' ) {
			/* identify the server environment as production */
			$apache_display_server_envinronment = "-- <I>".$multilang_STATIC_117.":</I>  <B>".$seer_ENVIRONMENT_SERVER_NAME."</B>";
		} else {
			/* identify the server environment as UNKNOWN */
			$apache_display_server_envinronment = "<I>".$multilang_FAULT_36."</I><BR>".$multilang_FAULT_37;
		}
	}

	/* ACTIVE PLUGIN LIST */
	$apache_display_active_plugins_list_nonzero = 0;
	$apache_display_active_plugins_list_count = 0;
	foreach ($seer_PLUGINS_TO_USE as $selected_PLUGIN) {
		$apache_display_active_plugins_list_nonzero = 1;
		if ($apache_display_active_plugins_list_count == 0) {
			$apache_display_active_plugins_list = $apache_display_active_plugins_list.$selected_PLUGIN;
			$apache_display_active_plugins_list_count = 1;
		} else {
			$apache_display_active_plugins_list = $apache_display_active_plugins_list.", ".$selected_PLUGIN;
			$apache_display_active_plugins_list_count = $apache_display_active_plugins_list_count + 1;
			if ($apache_display_active_plugins_list_count == 3) {
				$apache_display_active_plugins_list = $apache_display_active_plugins_list."<BR>
					";
				$apache_display_active_plugins_list_count = 0;
			} else {
				/* pass */
			}
		}
	}
	if ($apache_display_active_plugins_list_nonzero == 0) {
		$apache_display_active_plugins_list = $multilang_STATIC_NONE;
	} else {
		/* pass */
	}

	/* DAYLIGHT SAVINGS TIME NOTIFICATION */
	if ( $mod_openopc_OBSERVE_DST == 'YES' ) {
		/* display nothing */
		$apache_display_server_dst = "";
	} else {
		/* notify user that the server does not utilize DST */
		$apache_display_server_dst = $multilang_STATIC_DST_NOT_IN_EFFECT;
	}

	/* SKIP THIS MARKUP IF USING CANVAS */
	if ($seer_enable_CANVAS == 'NO') {
		/* IS ANYONE LOGGED IN */
		if ( $seer_USERACTIVE == "YES" ) {
			/* greet the unique user */
			$apache_display_user_status = "
					<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
					<!-- ALERT - USER STATUS - UNIQUE USER -->
					<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

					<P CLASS='USERSTATUS'>
						<B>".$multilang_STATIC_115.":</B><I> ".$mysql_seer_access_REALNAME."</I> @ ".$apache_DEFAULTDATESTAMP." - ".$multilang_STATIC_BROWSER_ENGINE.": ".$apache_HTTP_BROWSER_ON_LINE_ENGINE." / ".$multilang_STATIC_BROWSER_NAME.": ".$apache_HTTP_BROWSER_ON_LINE." / ".$multilang_STATIC_BROWSER_VERSION.": ".$apache_HTTP_BROWSER_ON_LINE_VERSION."<BR>
						".$apache_display_server_envinronment." -- <I>".$multilang_STATIC_125.":</I> <A HREF='/".$apache_seer_VERSION."/seer_sysinfo.php' TARGET='vitals_self_tab'>[".$multilang_STATIC_126."]</A> &#38 <A HREF='/".$apache_seer_VERSION."/php.php' TARGET='vitals_self_tab'>[pHp info()]</A><BR>
						-- ".$multilang_STATIC_THEME.": ".$seer_THEME_TO_USE."<BR>
						-- ".$multilang_STATIC_PLUGINS.": ".$apache_display_active_plugins_list."<BR>
					</P>

					<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
					";
		} else {
			/* stock greeting */
			$apache_display_user_status = "
					<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
					<!-- ALERT - USER STATUS - STOCK OR NO USER -->
					<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

					<P CLASS='USERSTATUS'>
						".$multilang_STATIC_124." -- ".$multilang_STATIC_118."<BR>
						".$apache_display_server_envinronment."<BR>					
					</P>

					<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
					";
		}
	} else {
		/* pass */
	}
	$apache_display_user_status = $apache_display_user_status."
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				<!-- ALERT - DAYLIGHT SAVINGS TIME ENABLED OR DISABLED -->
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

				<TABLE ALIGN='CENTER' WIDTH='930' CELLPADDING=0 CELLSPACING=0>
					<TR>
						<TD WIDTH='430'>
							<BR>
						</TD>
						<TD WIDTH='500'>
							<P CLASS='DST_WARNING'>
								".$apache_display_server_dst."
							</P>
						</TD>
					</TR>
				</TABLE>

				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				";
	if ($seer_enable_CANVAS == 'NO') {
		$apache_display_user_status = $apache_display_user_status."

				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				<!-- PSUEDOCONTAINER - RESTRAINS DISPLAY CONTENT -->
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

				<TABLE CLASS='PSUEDOCONTAINER' WIDTH='930' CELLPADDING=0 CELLSPACING=0>
					<TR>
						<TD>
						";
	} else {
		/* pass */
		/* -- skip PSUEDOCONTAINER if we are using CANVAS */
	}

	/* ECHO TO HTML */
	if ($return_rather_than_echo == "NO") {
		echo $apache_display_user_status;
	} else {
		return $apache_display_user_status;
	}
}

/* SEER MENU 0 */
/* -- FIRST LEVEL MENU FOR SITE NAVIGATION */
function seer_menu_0 ()
{

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_DEFAULTMENUITEMSUBBULLET, $seer_USERNAME, $seer_LANGUAGE, $seer_REFERRINGPAGE_ADDKEYINFO, $seer_DEFAULTSUBDIVIDER, $seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME;

	/*	-- APACHE */
	global $apache_seer_VERSION;

	/*	-- LANGUAGE */
	global $multilang_MENU_MACHINE_CONTROL, $multilang_MENU_REPORTING, $multilang_MENU_SETTINGS, $multilang_MENU_LOGIN, $multilang_MENU_LOGOUT;

	/* BUILD THE MENU */
	$apache_menu_0 = "
				<!-- XXXXXXXXXXXXXXXXXXXXXX -->
				<!-- MENU IN THE HEADER BAR -->
				<!-- XXXXXXXXXXXXXXXXXXXXXX -->

				<FORM ACTION='/".$apache_seer_VERSION."/seer_logout.php?seer_LANGUAGE=".$seer_LANGUAGE."' METHOD='post'>
					<TABLE ALIGN='CENTER' CLASS='MENU' WIDTH='875' CELLPADDING=0 CELLSPACING=0>
						<TR>
							<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
								<A HREF='/".$apache_seer_VERSION."/seer_machinecontrol.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_MACHINE_CONTROL."</A>
							</TD>
							<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
								<A HREF='/".$apache_seer_VERSION."/seer_reporting.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_REPORTING."</A>
							</TD>
							<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
								<A HREF='/".$apache_seer_VERSION."/seer_settings.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_SETTINGS."</A>
							</TD>
							<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
								<A HREF='".$seer_ENVIRONMENT_FULLY_QUALIFIED_DOMAIN_NAME."/".$apache_seer_VERSION."/seer_login.php".$seer_REFERRINGPAGE_ADDKEYINFO."'><IMG SRC=".$seer_DEFAULTMENUITEMSUBBULLET." BORDER='0' ALT='bullet'> ".$multilang_MENU_LOGIN."</A>
							</TD>
							<TD CLASS='menu' ALIGN='CENTER' VALIGN='MIDDLE'>
								<INPUT TYPE='hidden' name='seer_USERNAME_DISCARD' value='".$seer_USERNAME."'>
								<INPUT TYPE='image' name='enter' src='/".$apache_seer_VERSION."/img/click_x_out.png'> ".$multilang_MENU_LOGOUT." <INPUT TYPE='image' name='enter' SRC='/".$apache_seer_VERSION."/img/click_x_out.png'>
							</TD>
						</TR>
					</TABLE>
				</FORM>
				<P CLASS='BANNER'>
					<IMG SRC='".$seer_DEFAULTSUBDIVIDER."' WIDTH='875' ALT='subdivider'>
				</P>

				<!-- XXXXXXXXXXXXXXXXXXXXXX -->
				";

	/* ECHO TO HTML */
	echo $apache_menu_0;
}

/* TEST FOR USER ACTIVITY (ENCAPSULATES LOGIN / ACTIVITY / AND ACCESS LEVEL) */
/* -- sanitize access level */
function core_user_active_or_dead ()
{
	/* CALL THIS FUNCTION WITH... */
	/* core_user_active_or_dead(); */
	/* -- be sure following variables are decalred BEFORE calling... */
	/*	-- */

	/* GLOBALIZE VARIABLES */

	/*	-- SEER */
	global $seer_USERACTIVE, $mysql_seer_access_ACCESSLEVEL, $seer_settings_FIRSTRUN, $seer_setup_PROCEED_SETUPACTION, $seer_PROCESSUSER_ADD, $seer_PROCESSUSER_ADD_FAULT;

	/*	-- LANGUAGE */
	global $multilang_FAULT_34, $multilang_FAULT_1, $multilang_STATIC_ACCESS_ADMIN_SUPER;

	/*	-- MOD_OPENOPC */
	global $mod_openopc_setup_PROCEED_SETUPACTION;

	/* EXECUTE */
	if ( $seer_USERACTIVE != "YES" ) {
		$mysql_seer_access_ACCESSLEVEL = 9999;
		if ( $seer_settings_FIRSTRUN == "YES" ) {
			$seer_setup_PROCEED_SETUPACTION = "YES";
		} else {
			$seer_setup_PROCEED_SETUPACTION = "NO";
		}
		$seer_PROCESSUSER_ADD = "FAULT";
		$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_34."<BR>
								<BR>
							</P>
							";
	} else {
		if ( $seer_USERACTIVE == "YES" ) {
			if ( $mysql_seer_access_ACCESSLEVEL <= 1 ) {
				$seer_setup_PROCEED_SETUPACTION = "YES";
				$mod_openopc_setup_PROCEED_SETUPACTION = "YES";
			} else {
				$seer_setup_PROCEED_SETUPACTION = "NO";
				$mod_openopc_setup_PROCEED_SETUPACTION = "NO";
			}
			if ( $seer_settings_FIRSTRUN == "YES" ) {
				$seer_setup_PROCEED_SETUPACTION = "YES";
				$mod_openopc_setup_PROCEED_SETUPACTION = "YES";
			} else {
				/* pass */
			}
			if ( $mysql_seer_access_ACCESSLEVEL > 2 ) {
			$seer_PROCESSUSER_ADD = "FAULT";
			$seer_PROCESSUSER_ADD_FAULT = "
							<P CLASS='INFOREPORT'>".$multilang_FAULT_1."<BR>
								<BR>
								".$multilang_STATIC_ACCESS_ADMIN_SUPER."<BR>
								<BR>
							</P>
							";
			} else {
				/* pass */
			}
		} else {
			/* pass */
		}
	}
}

?>
