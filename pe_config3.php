<?php
	$DEBUG = 0;
	$DEBUG_MSGS = "<hr><h3>DEBUG LOG</h3>";
	
	$PRECISION = 1;
	
	$MAX_INDEX = 512;

	include "pe-outcomes1.php";
	include "pe-outcomes2.php";
	include "pe-matches1.php";
	include "pe-matches2.php";

	
	/*									Hex			Bin						Dec					*/
	$AGE1_MASK = 256;		//0x100	100000000			256
	$AGE2_MASK = 128;		//0x80	010000000			128
	$PAIN_MASK = 64;		//0x40	001000000			64
	$HRT_MASK = 64;			//0x40	001000000			64
	$HEMOP_MASK = 32;		//0x20	000100000			32
	$DYSP_MASK = 32;		//0x20	000100000			32
	$SAO2_MASK = 16;		//0x10	000010000			16
	$HR_MASK	 = 8;			//0x8		000001000			8
	$SURG_MASK = 4;			//0x4		000000100			4
	$HIST_MASK = 2;			//0x2		000000010			2
	$SWELL_MASK = 1;		//0x1		000000001			1
	$EMPTY_MASK = 0;		//0x0		000000000			0
	
	$PB_YES = "Yes";
	$PB_NO = "No";
	$PB_NS = "";
	
	$cAge = "";
	$cChestPain = "";
	$cDyspnea = "";
	$cSaO2 = "";
	$cHR = "";
	$cSurgery = "";
	$cHistory = "";
	$cSwelling = "";
	$cHRT = "";
	$cHemop = "";
	
	$giATTMatches = "?";
	$giPEOutcomes = "?";
	
	$gdPTP = "?";
	$gdPTPf = "?";
	$gdCI = "?";
	$gdCIFrom = "?";
	$gdCITo = "?";
	
	$dPostPTPN1 = "?";
  $dPostPTPN2 = "?";
	$dPostPTPN3 = "?";
	$dPostPTPN4 = "?";
	$dPostPTPN5 = "?";
	
	$dPostPTPP1 = "?";
  $dPostPTPP2 = "?";
	$dPostPTPP3 = "?";
	$dPostPTPP4 = "?";
	$dPostPTPP5 = "?";
?>