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
TANK REPORT 2 BODY (INCLUDED TO ALL TANKMODELS)
---------------------------------------------------------------------
*/

/* CHANGES TO GLOBAL OPTIONS */
/* ------------------------------------------------------------------ */
$apache_PAGETYPE = "STATIC";
/*	-- do not auto refresh this page */

/* PAGE TITLE */
/* ------------------------------------------------------------------ */
$apache_PAGETITLE = "
							<P CLASS='PAGETITLE'>
								<B>".$multilang_TANKMODEL_0.": ".$multilang_TANKMODEL_8."</B><BR>
								<I>".$TANKMODEL_SUBPAGETITLE."</I><BR>
								<A HREF='".$seer_REFERRINGPAGE."'>".$multilang_MENU_BACK."</A>
							</P>
							";

/* HANDLE ACTIVE OR DEAD USERS */
/* ------------------------------------------------------------------ */
core_user_active_or_dead();

/* DETERMINE WHICH ACTION MODE WE'RE FUNCTIONING IN */
/* ------------------------------------------------------------------ */
core_action_mode_initial_determination();

/* REPORT TICKET BUILDER */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == 'BUILDTICKET' ) {
	/* PULL IN VARIABLES */
	core_user_date_time_range_input_type_2();

	/* PROCEED IF ALL VARIABLES AVAILABLE AND NO FAULTS */
	if ( $seer_HMIACTION_FAULT == 0 ) {

		$mysql_mod_openopc_query = "DATESTAMP, SILONAME, STATE, PRODUCT, LEVEL_MASS, LEVEL_VOLUME";
		$mysql_mod_openopc_query = "SELECT ".$mysql_mod_openopc_query." FROM ".$TANKMODEL_mysql_mod_openopc_TABLENAME." WHERE (DATESTAMP BETWEEN '".$mysql_query_SNAPSHOT_DATESTAMP_START."' AND '".$mysql_query_SNAPSHOT_DATESTAMP_END."') AND (SILONAME LIKE '".$TANKMODEL_PRESET_PREFIX."%') ORDER BY DATESTAMP DESC, SILONAME ASC";
		list($mysql_mod_openopc_query_result,$mysql_mod_openopc_num_rows) = core_mysql_mod_openopc_query_shell($mysql_mod_openopc_query,$BULKMODEL_COUNT);

		/* ENSURE WE HAVE ENOUGH DATA TO BUILD A GOOD REPORT, ELSE FAULT */
		$mysql_minimum_rows_to_ensure_good_query = $TANKMODEL_COUNT * 2;
		if ( $mysql_mod_openopc_num_rows < $mysql_minimum_rows_to_ensure_good_query ) {
			$seer_HMIACTION_FAULT = 1;
			$seer_FAULT_TYPE = $multilang_FAULT_39;
		} else {
			/* BUILD TICKET DATA */

			/* ZERO OUT CSV FOR EXPORT */
			model_TANK_export_csv_report_3_zero();

			/* GATHER DATA FROM THE RETURNED RECORDS */
			$mysql_query_item_ID = core_verification_array_of_null_values_for_items($multilang_STATIC_NO_DATA_AVAILABLE,"0",$TANKMODEL_COUNT_ADJUSTED);

			/* SET SOME DEFAULT DATA VALUES */
			$mysql_query_master_index = 0;
			$apache_REPORT_RECORDENTRY = "";
			$MODEL_TOTAL_MASS = 0;
			$MODEL_TOTAL_VOLUME = 0;

			$mysql_query_internal_index = 0;
			while ( $mysql_query_internal_index <= $TANKMODEL_PRODUCT_COUNT_ADJUSTED ) {			
				$MODEL_PRODUCT_TOTAL_MASS[$mysql_query_internal_index] = 0;
				$MODEL_PRODUCT_TOTAL_VOLUME[$mysql_query_internal_index] = 0;
				$TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index] = "";
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}

			/* CYCLE THROUGH THE DATABASE */
			while ($mysql_mod_openopc_query_row = mysqli_fetch_assoc($mysql_mod_openopc_query_result)) {
				$mysql_mod_openopc_WORKING_DATESTAMP = $mysql_mod_openopc_query_row['DATESTAMP'];
				$mysql_mod_openopc_WORKING_SILONAME = $mysql_mod_openopc_query_row['SILONAME'];
				$mysql_mod_openopc_WORKING_STATE = $mysql_mod_openopc_query_row['STATE'];
				$mysql_mod_openopc_WORKING_PRODUCT = $mysql_mod_openopc_query_row['PRODUCT'];
				$mysql_mod_openopc_WORKING_LEVEL_MASS = $mysql_mod_openopc_query_row['LEVEL_MASS'];
				$mysql_mod_openopc_WORKING_LEVEL_VOLUME = $mysql_mod_openopc_query_row['LEVEL_VOLUME'];
	
				/* CONVERT LOGICAL VALUES TO FRIENDLY VALUES */
				$MODEL_WORKING_STATE = $TANKMODEL_STATE[$mysql_mod_openopc_WORKING_STATE];
				$MODEL_WORKING_PRODUCT = $TANKMODEL_PRODUCT[$mysql_mod_openopc_WORKING_PRODUCT];

				/* BE SURE WE ONLY GET ONE SET OF DATA FOR EACH TANK OR SILO */
				$mysql_query_internal_index = 0;			
				while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {			
					if ( $mysql_mod_openopc_WORKING_SILONAME == $TANKMODEL_NAME[$mysql_query_internal_index] ) {
						if ( $mysql_query_item_ID[$mysql_query_internal_index] == $multilang_STATIC_NO_DATA_AVAILABLE ) {
								$mysql_mod_openopc_WORKING_DATESTAMP_MACHINEARRAY[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_DATESTAMP;
								$mysql_mod_openopc_WORKING_SILONAME_MACHINEARRAY[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_SILONAME;
								$mysql_mod_openopc_WORKING_STATE_MACHINEARRAY[$mysql_query_internal_index] = $MODEL_WORKING_STATE;
								$mysql_mod_openopc_WORKING_PRODUCT_MACHINEARRAY[$mysql_query_internal_index] = $MODEL_WORKING_PRODUCT;
								$mysql_mod_openopc_WORKING_PRODUCT_NUMBER_MACHINEARRAY[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_PRODUCT;
								$mysql_mod_openopc_WORKING_LEVEL_MASS_MACHINEARRAY[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_LEVEL_MASS;
								$mysql_mod_openopc_WORKING_LEVEL_VOLUME_MACHINEARRAY[$mysql_query_internal_index] = $mysql_mod_openopc_WORKING_LEVEL_VOLUME;

								$MODEL_PRODUCT_TOTAL_MASS[$mysql_mod_openopc_WORKING_PRODUCT] = $MODEL_PRODUCT_TOTAL_MASS[$mysql_mod_openopc_WORKING_PRODUCT] + $mysql_mod_openopc_WORKING_LEVEL_MASS;
								$MODEL_PRODUCT_TOTAL_VOLUME[$mysql_mod_openopc_WORKING_PRODUCT] = $MODEL_PRODUCT_TOTAL_VOLUME[$mysql_mod_openopc_WORKING_PRODUCT] + $mysql_mod_openopc_WORKING_LEVEL_VOLUME;
								$MODEL_TOTAL_MASS = $MODEL_TOTAL_MASS + $mysql_mod_openopc_WORKING_LEVEL_MASS;
								$MODEL_TOTAL_VOLUME = $MODEL_TOTAL_VOLUME + $mysql_mod_openopc_WORKING_LEVEL_VOLUME;

								/* BUILD CSV FOR EXPORT */
								model_TANK_export_csv_report_3_build();
								$mysql_query_item_ID[$mysql_query_internal_index] = "DONE";
						} else {
							/* pass on the ID item */
						}
					} else {
						/* pass on the ID item */
					}
					$mysql_query_internal_index = $mysql_query_internal_index + 1;
				}
				$mysql_query_master_index = $mysql_query_master_index + 1;
			}

			/* SECTION FOR DISTRIBUTION BY PRODUCT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_SYNERGISTIC,$multilang_TANKMODEL_117);
		
			/* -- PLOT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<B><U>".$multilang_TANKMODEL_107."</U></B>
									</TD>
									<TD WIDTH='50'>
										<BR>
									</TD>
									<TD WIDTH='50' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD WIDTH='650'>
										<B><U>".$multilang_TANKMODEL_118 ."</U></B>
									</TD>
								</TR>				
								";

			$mysql_query_internal_index = 0;
			while ( $mysql_query_internal_index <= $TANKMODEL_PRODUCT_COUNT_ADJUSTED ) {	

				$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY = ($MODEL_PRODUCT_TOTAL_MASS[$mysql_query_internal_index] / $MODEL_TOTAL_MASS) * 100;
				$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY = varcharTOnumeric2($MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY); 

				/* HORIZONTAL BAR INDICATOR FOR PERCENTAGE */
				$MODEL_WORKING_BAR_PERCENT = core_display_horizontal_bar("650",$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY,"0","100");

				if ( $MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY > 0 ) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD>
										".$TANKMODEL_PRODUCT[$mysql_query_internal_index]."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										".$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$MODEL_WORKING_BAR_PERCENT." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}

				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
		
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";
				
			/* -- TABLE */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<B><U>".$multilang_TANKMODEL_107."</U></B>
									</TD>
									<TD WIDTH='300' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_119."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>$multilang_TANKMODEL_120<BR>
										[".$TANKMODEL_UM_MASS."]</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='RIGHT'>
										<B><U>".$multilang_TANKMODEL_121."<BR>
										[".$TANKMODEL_UM_VOLUME."]</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_118."</U></B>
									</TD>
								</TR>				
								";

			$mysql_query_internal_index = 0;
			$apache_SWITCH_ROW_COLOR = 0;
			while ( $mysql_query_internal_index <= $TANKMODEL_PRODUCT_COUNT_ADJUSTED ) {

				$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();	

				$mysql_query_internal_index2 = 0;
				$apache_TANKS_STORING_oneinrow = "no";
				$apache_TANKS_STORING_newrow = "no";
				while ( $mysql_query_internal_index2 <= $TANKMODEL_COUNT_ADJUSTED ) {

					if ( $mysql_mod_openopc_WORKING_PRODUCT_NUMBER_MACHINEARRAY[$mysql_query_internal_index2] == $mysql_query_internal_index ) {
						if ( $apache_TANKS_STORING_oneinrow == 'yes' ) {
							$TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index] = $TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index].", ".$mysql_mod_openopc_WORKING_SILONAME_MACHINEARRAY[$mysql_query_internal_index2];
							$apache_TANKS_STORING_oneinrow = "no";
							$apache_TANKS_STORING_newrow = "yes";
						} else {
							$TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index] = $TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index].$mysql_mod_openopc_WORKING_SILONAME_MACHINEARRAY[$mysql_query_internal_index2];
							$apache_TANKS_STORING_oneinrow = "yes";
							$apache_TANKS_STORING_newrow = "no";
						}
						if ( $apache_TANKS_STORING_newrow == 'yes' ) {
							$TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index] = $TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index].",
										<BR>
										";
							$apache_TANKS_STORING_newrow = "no";
						} else {
							/* pass */
						}
					} else {
						/* pass */
					}

					$mysql_query_internal_index2 = $mysql_query_internal_index2 + 1;
				}

				$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY = ($MODEL_PRODUCT_TOTAL_MASS[$mysql_query_internal_index] / $MODEL_TOTAL_MASS) * 100;
				$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY = varcharTOnumeric2($MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY); 

				$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$TANKMODEL_PRODUCT[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='CENTER'>
										".$TANKMODEL_TANKS_STORING_PRODUCT[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MODEL_PRODUCT_TOTAL_MASS[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='RIGHT'>
										".$MODEL_PRODUCT_TOTAL_VOLUME[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='CENTER'>
										".$MODEL_PRODUCT_PERCENT_OF_TOTAL_INVENTORY."
									</TD>
								</TR>
								";

				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
			
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='5'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";

			/* SECTION FOR DISTRIBUTION BY TANK */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY.core_generic_plot_header($multilang_STATIC_DISCRETE,$multilang_TANKMODEL_122);
		
			/* -- PLOT */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<B><U>".$multilang_TANKMODEL_105."</U></B>
									</TD>
									<TD WIDTH='50'>
										<BR>
									</TD>
									<TD WIDTH='50' ALIGN='CENTER'>
										<BR>
									</TD>
									<TD WIDTH='650'>
										<B><U>".$multilang_TANKMODEL_118."</U></B>
									</TD>
								</TR>				
								";

			$mysql_query_internal_index = 0;
			while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {	

				$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY = ($mysql_mod_openopc_WORKING_LEVEL_MASS_MACHINEARRAY[$mysql_query_internal_index] / $MODEL_TOTAL_MASS) * 100;
				$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY = varcharTOnumeric2($MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY); 

				/* HORIZONTAL BAR INDICATOR FOR PERCENTAGE */
				$MODEL_WORKING_BAR_PERCENT = core_display_horizontal_bar("650",$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY,"0","100");

				if ( $MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY > 0 ) {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD>
										".$mysql_mod_openopc_WORKING_SILONAME_MACHINEARRAY[$mysql_query_internal_index]."
									</TD>
									<TD>
										<BR>
									</TD>
									<TD ALIGN='CENTER'>
										".$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY."
									</TD>
									<TD CLASS='hmicellborder2' ALIGN='LEFT' VALIGN='MIDDLE'>
										<IMG SRC='./img/horizontal_bar.png' WIDTH=".$MODEL_WORKING_BAR_PERCENT." HEIGHT=10 ALT='HORIZONTAL BAR'>
									</TD>
								</TR>
								";
				} else {
					/* pass */
				}
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
		
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='4'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";

			/* -- TABLE */
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
							<TABLE CLASS='STANDARD' WIDTH='900' ALIGN='CENTER' CELLPADDING=0 CELLSPACING=0>
								<TR>
									<TD WIDTH='150'>
										<B><U>".$multilang_TANKMODEL_105."</U></B>
									</TD>
									<TD WIDTH='100' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_95."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_107."</U></B>
									</TD>
									<TD WIDTH='100' ALIGN='RIGHT'>
										<B><U>".$multilang_TANKMODEL_109." [".$TANKMODEL_UM_MASS."]</U></B>
									</TD>
									<TD WIDTH='100' ALIGN='RIGHT'>
										<B><U>".$multilang_TANKMODEL_110." [".$TANKMODEL_UM_VOLUME."]</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_123."</U></B>
									</TD>
									<TD WIDTH='150' ALIGN='CENTER'>
										<B><U>".$multilang_TANKMODEL_118."</U></B>
									</TD>
								</TR>				
								";

			$mysql_query_internal_index = 0;
			$apache_SWITCH_ROW_COLOR = 0;
			while ( $mysql_query_internal_index <= $TANKMODEL_COUNT_ADJUSTED ) {	
				if ( $mysql_query_item_ID[$mysql_query_internal_index] != $multilang_STATIC_NO_DATA_AVAILABLE ) {

					$apache_REPORT_ROW_BGCOLOR_USE = core_row_color_flip_flop();

					$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY = ($mysql_mod_openopc_WORKING_LEVEL_MASS_MACHINEARRAY[$mysql_query_internal_index] / $MODEL_TOTAL_MASS) * 100;
					$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY = varcharTOnumeric2($MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY); 

					$TANKMODEL_PRODUCT_KEY = $mysql_mod_openopc_WORKING_PRODUCT_NUMBER_MACHINEARRAY[$mysql_query_internal_index];
					$MODEL_TANK_PERCENT_OF_PRODUCT_INVENTORY = ($mysql_mod_openopc_WORKING_LEVEL_MASS_MACHINEARRAY[$mysql_query_internal_index] / $MODEL_PRODUCT_TOTAL_MASS[$TANKMODEL_PRODUCT_KEY]) * 100;
					$MODEL_TANK_PERCENT_OF_PRODUCT_INVENTORY = varcharTOnumeric2($MODEL_TANK_PERCENT_OF_PRODUCT_INVENTORY);

					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR ".$apache_REPORT_ROW_BGCOLOR_USE.">
									<TD>
										".$mysql_mod_openopc_WORKING_SILONAME_MACHINEARRAY[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_STATE_MACHINEARRAY[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='CENTER'>
										".$mysql_mod_openopc_WORKING_PRODUCT_MACHINEARRAY[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_LEVEL_MASS_MACHINEARRAY[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='RIGHT'>
										".$mysql_mod_openopc_WORKING_LEVEL_VOLUME_MACHINEARRAY[$mysql_query_internal_index]."
									</TD>
									<TD ALIGN='CENTER'>
										".$MODEL_TANK_PERCENT_OF_PRODUCT_INVENTORY."
									</TD>
									<TD ALIGN='CENTER'>
										".$MODEL_TANK_PERCENT_OF_TOTAL_INVENTORY."
									</TD>
								</TR>
								";
				} else {
					$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<B>".$TANKMODEL_NAME[$mysql_query_internal_index]."</B> -- ".$multilang_STATIC_NO_DATA_AVAILABLE.".<BR>
										".$multilang_STATIC_ERROR_CALL_ADMIN."<BR>
										<BR>
									</TD>
								</TR>
								";
				}
				$mysql_query_internal_index = $mysql_query_internal_index + 1;
			}
			
			$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY."
								<TR>
									<TD COLSPAN='7'>
										<BR>
									</TD>
								</TR>
							</TABLE>
							";

		}

		/* REPORT TOPPLATE AND ASSEMBLY */
		/* -- CLEAN UP CSV FOR EXPORT */
		core_export_csv_sanitize();
		/* -- BUILD THE TOP PLATE */
		$apache_REPORT_RECORDENTRY_TOPPLATE = core_report_ticket_top_plate_and_export_link("","csv","n/a",$mysql_query_SNAPSHOT_DATESTAMP_END,$multilang_TANKMODEl_115,$multilang_TANKMODEL_116);
		$apache_REPORT_TOPPLATE_EXTENSION = "";
		/* -- TOPPLATE EXTENSIONS */
		$apache_REPORT_RECORDENTRY_TOPPLATE = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_TOPPLATE_EXTENSION."
							".core_report_ticket_top_plate_extension_additional_export ($multilang_STATIC_EXPORT_PDF_HEADER, $multilang_STATIC_EXPORT_PDF_DESCRIPTION, "pdf", $apache_PAGETITLE, $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION.$apache_REPORT_RECORDENTRY).$apache_REPORT_RECORDENTRY_TOPPLATE_EXTENSION;
		/* -- ADD THE BODY */
		$apache_REPORT_RECORDENTRY = $apache_REPORT_RECORDENTRY_TOPPLATE.$apache_REPORT_RECORDENTRY;

	} else {
		/* FAULT OUT TO START PAGE */
	}
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

/* START PAGE */
/* -- REPORT TICKET CREATOR */
/* ------------------------------------------------------------------ */
if ( $seer_HMIACTION == "DISPLAY_START_PAGE" ) {
	$apache_REPORT_RECORDENTRY = core_user_date_time_range_prompt_type_2("BUILDTICKET");
}
	
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
