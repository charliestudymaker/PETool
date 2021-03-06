<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<script type="text/javascript" src="modaldbox.js">
</script>
<link rel="stylesheet" href="modaldbox.css" type="text/css" /> 

<script>
 var dataString ="";

   function DoConfirmSubmit()
	{
	hm('mdbox');
	document.peform.acceptdata.value=1;
	document.peform.submit();
	}

   function DoPreT()
	{
	document.peform.getposttest.value=0;
	document.peform.getpretest.value=1;
	// removed post POST-QUAADRIC study with display:none
	if (0)
	{
	if (document.getElementById('StudyID').value.length==0)	
	    {
		document.getElementById('QSID').style.backgroundColor='red';
		alert('You must provide a QUADRIC Study ID');	
		return false;
	    }
	}


	   getPostData(document.peform);
	   ajaxConf("echope.php",dataString);
	sm('mdbox',300,300);

	return false;
	//document.peform.submit();
	}

   function DoPostT()
	{
	document.peform.getpretest.value=0;
	document.peform.getposttest.value=1;


	// removed post POST-QUAADRIC study with display:none
	if (0)
	{
	if (document.getElementById('StudyID').value.length==0)	
	    {
		document.getElementById('QSID').style.backgroundColor='red';
		alert('You must provide a QUADRIC Study ID');	
		return false;
	    }
	}


	   getPostData(document.peform);
	   ajaxConf("echope.php",dataString);
	sm('mdbox',300,300);

	return false;
	//document.peform.submit();
	}


function ajaxConf(url, vars){
 
        if (window.XMLHttpRequest){
                var request = new XMLHttpRequest();
        }else{
                var request = new ActiveXObject("MSXML2.XMLHTTP.3.0");
        }
 
        request.open("POST", url, true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
 
        request.onreadystatechange = function(){
 
                if (request.readyState == 4 && request.status == 200) {
 
                        if (request.responseText)
			{
			document.getElementById('confText').innerHTML=request.responseText;
                        }
                }
        }
        request.send(vars);
}

  
function addParam(name, value) {

        dataString += (dataString.length > 0 ? "&" : "")
            + escape(name).replace(/\+/g, "%2B") + "="
            + escape(value ? value : "").replace(/\+/g, "%2B");

    }

function getPostData(form) {

    var elemArray = form.elements;

    for (var i = 0; i < elemArray.length; i++) 
	{
        var element = elemArray[i];
        var elemType = element.type.toUpperCase();
        var elemName = element.name;

        if (elemName) {
            if (elemType == "TEXT"
                    || elemType == "TEXTAREA"
                    || elemType == "PASSWORD"
                    || elemType == "HIDDEN")
                addParam(elemName, element.value);
            else if (elemType == "CHECKBOX")
		  {
 		    if (element.checked)
	               addParam(elemName,element.value ? element.value : "On");
		    else
	               addParam(elemName,'0');
		  }		
            else if (elemType == "RADIO" && element.checked)
                addParam(elemName, element.value);
            else if (elemType.indexOf("SELECT") != -1)
                for (var j = 0; j < element.options.length; j++) {
                    var option = element.options[j];
                    if (option.selected)
                        addParam(elemName,
                            option.value ? option.value : option.text);
                }
        }
    }
    return dataString;
}



</script>

<?php

if ($_POST["WebService"])
   {}
else
	include "ptpsess.php";	

	include "ptpFuns.php";	
	include('pe_config3.php');
	include('common.php');
	include('debug.php');

	
$_SESSION['AcceptedData']=1;

	// NEW AUTHENTICATION

if ($_POST['StudyID'])
	$_SESSION['StudyID']=$_POST['StudyID'];
if ($_GET["StudyID"])
	    $_SESSION['StudyID']=$_GET["StudyID"];



$bdoPost = 0;
		
if( $_POST["getpretest"] )
	{
	DoCmdGet45DayRisk();
	//DoCmdGet45DayRisk();
	$CLIENTIP=$_SERVER['REMOTE_ADDR'];
	$CLIENTDOMAIN=gethostbyaddr($CLIENTIP);
	// removed post POST-QUAADRIC study with display:none
	//logPEPTPQuery($link,$CLIENTDOMAIN,$CLIENTIP);

		        //$_SESSION['AcceptedData']=0;
	}
else if( $_POST["getposttest"])
	{
			$bdoPost = 1;
			DoCmdGet45DayRisk();
			$CLIENTIP=$_SERVER['REMOTE_ADDR'];
			$CLIENTDOMAIN=gethostbyaddr($CLIENTIP);
	// removed post POST-QUAADRIC study with display:none
			//logPEPTPQuery($link,$CLIENTDOMAIN,$CLIENTIP);
		}



 foreach( $_POST as $key=>$value)
	{
	//echo $key . "=" . $value . "<br>";
	}

	$count=0;
	if( $count > 100000 ){
		?>
		<script language="JavaScript">
			<!--
			alert('You have exceeded that maximum number of usages for this page.');
			self.location = 'http://www.pretestconsult.com/site/ascatalog.php';
			-->	
		</script>
		<?php
		exit;
	}
?>
<html>
	<head>
		<script language="JavaScript" src="common2.js"></script>
		<script type="text/javascript" src="overlib/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>

<script language="Javascript1.2">
<!-- 
function doPrint()
    {

	// removed post POST-QUAADRIC study with display:none
    if (0)
    {
    if ((document.getElementById('DevUse1').checked==true)
	|| (document.getElementById('DevUse2').checked==true)
	|| (document.getElementById('DevUse3').checked==true))
	{
	UseQ=1;
	}
    else
	{
	alert("The study protocol requires that you answer the question 'Do you plan to use the results of this device ?' before printing the results.");
	return;
	}
     }


    if (document.peform.giATTMatches)
    {
    if (document.peform.giATTMatches.value=="?")
	{
	alert("You must first do 'Get Pretest Prob' to calculate the Pretest probability before doing the PRINT RESULTS operation ");
	return;
	}
    }
    else
	{
	alert("Please click the 'Get Pretest Prob' to calculate the Pretest probability JUST PRIOR to doing the PRINT RESULTS operation ");
	return;
	}

    document.peform.action='peprint.php';
    document.peform.submit();
    }

function PopHeparin()
  {
  var props = 'scrollBars=yes,resizable=yes,toolbar=no,menubar=yes,location=no,directories=no,width=700,height=450';
 url = "http://www.pretestconsult.com/webversions/HoggEmpiricHeparin.pdf";
 popWindow = window.open(url, "popHep", props);
 popWindow.focus();

  }


-->
</script>


	  <link rel="stylesheet" href="style.css" type="text/css">
	  <LINK REL="SHORTCUT ICON" HREF="favicon.ico">
	  <title>PREtestConsultPE (Dec 3,2007 UPDATE)</title>
	</head>
	<body >

<div id="mdbox" class="dialog">
<div style="text-align:center"><span id="txt">
<table><tr><td colspan=2><DIV id=confText></DIV></td></tr>
<tr><td>
<button onclick=DoConfirmSubmit();>Confirm Values</button>
</td>
<td>
<button onclick="hm('mdbox');">CANCEL</button>
</td></tr></table>
</div>
</div> 


	<?php
		$old_precision = ini_set("precision", $PRECISION);
		
		if( $DEBUG ){
			error_reporting(E_ALL);
			debugMsg("Error reporting set to E_ALL");
		}else{
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
		}
		
		
		drawPage( $bdoPost );
		ini_set("precision", $old_precision);



?>



	</body>
<?php
		displayDebugMsgs();
	?>
<?php
/*********************************************************************************************/
//Get the number of PE outcomes from the lookup table
// -1 denotes an error
function GetPEOutcomes($iFrmVal, $iModel )
{
	global $MAX_INDEX;
	global $gPEOutcomes1, $gPEOutcomes2;
	
	if( $iFrmVal < $MAX_INDEX ){
		if( 1 == $iModel )
			return $gPEOutcomes1[$iFrmVal];
		else
			return $gPEOutcomes2[$iFrmVal];
	}else
		return -1;
}

function DoPTPForm(){
	global $giATTMatches, $giPEOutcomes;
	global $gdPTP, 	$gdPTPf, 	$gdCI, 	$gdCIFrom, 	$gdCITo;
	global $dPostPTPN1, $dPostPTPN2, $dPostPTPN3, $dPostPTPN4, $dPostPTPN5;
	global $dPostPTPP1, $dPostPTPP2, $dPostPTPP3, $dPostPTPP4, $dPostPTPP5;
	
	//Calculate PTP & CI %s
	if( $giATTMatches > 0 ){
		$gdPTP = ( $giPEOutcomes * 100 ) / $giATTMatches;
		$gdPTPf = $gdPTP / 100;
		$gdCI = ((($gdPTPf * (1-$gdPTPf)) / sqrt($giATTMatches)) * 1.96) * 100;
		$gdCIFrom = $gdPTP - $gdCI;
		$gdCITo = $gdPTP + $gdCI;
	}else{
		$gdPTP = 0;
		$gdPTPf = 0;
		$gdCI = 0;
	}
	
	//CLJ-Sept 10,2004 - per Jeff Request
	// in cases where the outcomes are 0, Jeff wants this adjustment of the CI
	if ($giPEOutcomes==0)
		{
		switch ($giATTMatches/10)
		 
    	{
    	case 0:             //0 -10
    		$gdCI=35;
    		break;
    	case 1:             //10 -20
    		if ($giATTMatches<16)
    			$gdCI=20;
    		else
    			$gdCI=16;
    		break;
    	case 2:             //20 -30
    		$gdCI=11;
    		break;
    	case 3:             //30 -40
    		$gdCI=9;
    		break;
    	case 4:             //40 -50
    		$gdCI=7;
    		break;
    	default:   //>50
    		$gdCI=5;
    		break;	
    	}
    	$gdCIFrom = $gdPTP - $gdCI;
		$gdCITo = $gdPTP + $gdCI;
    	if ($gdCIFrom<0)
    		$gdCIFrom=0;
    	if ($gdCITo>100)
    		$gdCITo=100;
    	
		}
		
		debugMsg( "gdPTPf=$gdPTPf");
		debugMsg( "gdCI=$gdCI");
		debugMsg( "gdCIFrom=$gdCIFrom");
		debugMsg( "gdCITo=$gdCITo");
		
		PostTestCalc( $dPostPTPN1, $dPostPTPP1, $gdPTPf, 0.17, 1.5);
  	PostTestCalc( $dPostPTPN2, $dPostPTPP2, $gdPTPf, 0.14, 1.75);
		PostTestCalc( $dPostPTPN3, $dPostPTPP3, $gdPTPf, 0.28, 2.1);
		PostTestCalc( $dPostPTPN4, $dPostPTPP4, $gdPTPf, 0.25, 1.9);	
		PostTestCalc( $dPostPTPN5, $dPostPTPP5, $gdPTPf, 0.18, 9.0);
}

//Get the number of ATT matches from the lookup table
// -1 denotes an error
function GetATTMatches($iFrmVal, $iModel )
{
	global $MAX_INDEX;
	global $gATTMatches1, $gATTMatches2;
	
	if( $iFrmVal < $MAX_INDEX ){
		if( 1 == $iModel )
			return $gATTMatches1[$iFrmVal];
		else
			return $gATTMatches2[$iFrmVal];
	}else
		return -1;
}

function DoCmdGet45DayRisk(){
	global $MAX_INDEX, $gPEOutcomes1, $gPEOutcomes2, $gATTMatches1, $gATTMatches2;
	global $AGE1_MASK, $AGE2_MASK, $PAIN_MASK, $HRT_MASK, $HEMOP_MASK, $DYSP_MASK, $SAO2_MASK, $HR_MASK, $SURG_MASK, $HIST_MASK,  $SWELL_MASK, $EMPTY_MASK;
	global $PB_YES, $PB_NO, $PB_NS;
	global $cAge, $cChestPain, $cDyspnea, $cSaO2, $cHR, $cSurgery, $cHistory, $cSwelling, $cHRT, $cHemop;
	global $giATTMatches, $giPEOutcomes;
	global $gdPTP, 	$gdPTPf, 	$gdCI, 	$gdCIFrom, 	$gdCITo;
        global $iModel;

	$iFrmVals = $EMPTY_MASK;
	$iModel1 = $EMPTY_MASK;
	$iModel2 = $EMPTY_MASK;
	
	//Read raw form values
	$iAge = $_POST['age'];
	$iChestPain =	$_POST['chestpain'];
	$iDyspnea = $_POST['dyspnea'];
	$iSaO2 = $_POST['sao2'];
	$iHR = $_POST['hr'];
	$iSurgery = $_POST['surgery'];
	$iHistory = $_POST['hist'];
	$iSwelling = $_POST['swell'];
	$iHRT =  $_POST['hrt'];
	$iHemop = $_POST['hemop'];

	include "algomods.php";
	
	if( $iAge == "")
	{
		err("ERROR:  Age not specified.");
	}else
	{
		/*
		Bit 1 & 2 set 		= Age 1
		Bit 1 set 			= Age 2
		Bit 2 set 			= Age 3
		Neither 1 nor 2 set = Not Used
		*/
		if( $iAge == 0 )
		{
			$iModel1 |= $AGE1_MASK;
			$iModel1 |= $AGE2_MASK;
			
			$iModel2 |= $AGE1_MASK;
			$iModel2 |= $AGE2_MASK;
			
			$cAge = "< 35";
		}else if( $iAge == 1 )
		{
			$iModel1 |= $AGE1_MASK;
			$iModel2 |= $AGE1_MASK;		
			
			$cAge = "35 - 50";	
		}else if( $iAge == 2 )
		{
			$iModel1 |= $AGE2_MASK;
			$iModel2 |= $AGE2_MASK;
			
			$cAge = "< 50";
		}else
			MsgBox( NULL, "ERROR:  Unexpected age value." );
	}
	if( $iChestPain == $PB_NS)
	{
		err("ERROR:  Chest Pain not specified.");
	}else
	{
		//We assume that the user must select one of the two possible values.
		//Thus the bit is set if the first item (Male) is selected and unset if the second item
		//is selected.
		if( $iChestPain == $PB_YES ){
			$iModel2 |= $PAIN_MASK;
			$cChestPain = "Yes";
		}else{
			$cChestPain = "No";
		}
		if( $iDyspnea == $PB_NS)
		{
			err("ERROR:  Dyspnea not specified.");
		}else
		{
			if( $iDyspnea == $PB_YES){
				$iModel2 |= $DYSP_MASK;
				$cDyspnea = "Yes";
			}else{
				$cDyspnea = "No";
			}
		}
		if( $iSaO2 == $PB_NS)
		{
			err("ERROR:  SaO2 not specified.");
		}else
		{
			if( $iSaO2 == $PB_YES){
				$iModel1 |= $SAO2_MASK;
				$iModel2 |= $SAO2_MASK;
				$cSaO2 = "Yes";
			}else{
				$cSaO2 = "Yes";		
			}
		}
		if( $iHR == $PB_NS)
		{
			err("ERROR:  HR not specified.");
		}else
		{
			if( $iHR == $PB_YES ){
				$iModel1 |= $HR_MASK;
				$iModel2 |= $HR_MASK;
				$cHR = "Yes";
			}else{
				$cHR = "No";
			}
		}	
		if( $iSurgery == $PB_NS)
		{
			err("ERROR:  Surgery not specified.");
		}else
		{
			if( $iSurgery == $PB_YES ){
				$iModel1 |= $SURG_MASK;
				$iModel2 |= $SURG_MASK;
				$cSurgery = "Yes";
			}else{
				$cSurgery = "No";
			}
		}	
		if( $iHistory == $PB_NS)
		{
			err("ERROR:  History not specified.");	
		}else
		{
			if( $iHistory == $PB_YES ){
				$iModel1 |= $HIST_MASK;
				$iModel2 |= $HIST_MASK;
				$cHistory = "Yes";
			}else{
				$cHistory = "No";
			}
		}	
		if( $iSwelling == $PB_NS)
		{
			err("ERROR:  Swelling not specified.");	
		}else
		{
			if( $iSwelling == $PB_YES ){
				$iModel1 |= $SWELL_MASK;
				$iModel2 |= $SWELL_MASK;
				$cSwelling = "Yes";
			}else{
				$cSwelling = "No";
			}
		}
		if( $iHRT == $PB_NS ){
			err("ERROR:  HRT not specified.");	
		}else{
			if( $iHRT == $PB_YES ){
				$iModel1 |= $HRT_MASK;
				$cHRT = "Yes";
			}else{
				$cHRT = "No";
			}
		}
		if( $iHemop == $PB_NS ){
			err("ERROR:  Hemop not specified.");	
		}else{
			if( $iHemop == $PB_YES ){
				$iModel1 |= $HEMOP_MASK;
				$cHemop = "Yes";
			}else{
				$cHemop = "No";
			}
		}
	}	
	
	$iModel = -1;
	$iATTMatches = -1;
	$iPEOutcomes = -1;
	
	if( $iSaO2 == $PB_NO && $iHR == $PB_NO ){
		$iModel = 2;
	}else{
		$iModel = 1;
	}

	if( ($iSaO2 == $PB_NO) && ($iHR == $PB_NO) && ($cDyspnea == "No")&& ($cChestPain == "No" )) {
		$iModel = 1;
      }

	//echo $iModel;
	
	if( $iSaO2 == $PB_YES && $iHR == $PB_YES && $iAge == 1 ){
		$iModel = 2;
	}else{
		if( $iHemop == $PB_YES || $iHRT == $PB_YES ){
			$iModel = 1;
		}
	}
	
	if( 1 == $iModel )
		$iFrmVals = $iModel1;
	else if( 2 == $iModel )
		$iFrmVals = $iModel2;

//echo "Using Model " . $iModel;
		
	$giATTMatches = $iATTMatches = GetATTMatches( $iFrmVals, $iModel);
	$giPEOutcomes = $iPEOutcomes = GetPEOutcomes( $iFrmVals, $iModel);
	
	if( 1 == $iModel ){
			//If Model 1 has fewer than 20 matches, use Model 2
			if($giATTMatches < 20 ){
				$giATTMatches = GetATTMatches( $iFrmVals, 2);
				$giPEOutcomes = GetPEOutcomes( $iFrmVals, 2);
				
				if( $giATTMatches < 15 ){
					//TODO?
					//Display a warning?
				}
				
				//If Model 2 generates fewer matches than Model 1,
				//switch back to Model 1
				if( $giATTMatches < $iATTMatches ){
					$giATTMatches = $iATTMatches;
					$giPEOutcomes = $iPEOutcomes;
				}
			}
		}
		
		debugMsg( "giATTMatches=$giATTMatches");
		debugMsg( "giPEOutcomes=$giPEOutcomes");


		DoPTPForm();

	if ($_POST["WebService"])		
	   {
	   //echo "ATTMatches=" . $giATTMatches . "|||";
	   //echo "PEOutcomes=" . $giPEOutcomes . "|||";
	   //echo "PTP=" . $gdPTP .  "|||";
	$CLIENTIP=$_SERVER['REMOTE_ADDR'];
	$CLIENTDOMAIN=gethostbyaddr($CLIENTIP);
	// removed post POST-QUAADRIC study with display:none
	//logPEPTPQuery($link,$CLIENTDOMAIN,$CLIENTIP);
	   exit();
	   }

}

function PERCNegative()
    {
 	//foreach( $_POST as $key=>$value)
	//  echo $key . "=" . $value . "<br>";

    if (   ($_POST["sao2"] == "No")
	&& ($_POST["hr"] == "No")
	&& ($_POST["hrt"] == "No")
	&& ($_POST["hist"] == "No")
	&& ($_POST["swell"] == "No")
	&& ($_POST["hemop"] == "No")
	&& ($_POST["surgery"] == "No")
	&& ($_POST["age"] < 2))
	return 1;
    else
	return 0;
    }

function GenGudiance($PTP,$matches)
	{

  if (($_POST["getpretest"]) || ($_POST["getposttest"]))
    {}
  else
     return;

if ( $_POST["FromSubmitted"])
 {
	echo "<table border=1>
	      <tr><td><B>";

	if (($matches < 15))
		{
		echo "Recommendation :<P>Match size <span class=blueresult>insufficient</span> for accurate pretest probability assessment. The patient should be considered intermediate risk with a pretest probability of <span class=blueresult>approximately 10%</span>";
	echo "</td></tr></table>";
	return;		
		}
	if ($PTP < 2.5)
	 {
	if (PERCNegative())
		echo "Recommendation :<P>Current Pretest Probability (<span class=blueresult>" . number_format($PTP,1) . "</span>) is <span class=blueresult>below</span> the test threshold (2.5%) for PE <B>AND</B> the <span class=blueresult>PERC(-) exclusion rule</span> is satisfied. If your gestalt clinical suspicion for PE is low, and the patient has available follow-up medical care, <span class=blueresult>no further testing</span> is indicated at this time.";
	else

	echo "Recommendation :<P>Current Pretest Probability (<span class=blueresult>" . number_format($PTP,1) . "</span>) is <span class=blueresult>below</span> the test threshold (2.5%) for PE. If your clinical suspicion for PE is low, and the patient has available follow-up medical care, <span class=blueresult>no further testing</span> is indicated at this time.";
	echo "</td></tr></table>";
	return;
	}

	if ($PTP < 10.1)
	{
	echo "Recommendation :<P>Order a high-sensitivity, quantitative D-dimer and if below reference level for normal, no further testing needed.";
	echo "</td></tr></table>";
	return;
	}	

	if ($PTP > 20.0)
	{
	echo "Recommendation :<P>Order pulmonary vascular imaging and consider empiric heparin in absence of contraindications.";
	echo "</td></tr></table>";
	return;
	}	

	if ($PTP > 10.1)
	{
	echo "Recommendation :<P>Order pulmonary vascular imaging.";
	echo "</td></tr></table>";
	return;
	}	

}
	
	}

function drawPage( $bdoPost ){
		global $giATTMatches, $giPEOutcomes;
		global $gdPTP, 	$gdPTPf, 	$gdCI, 	$gdCIFrom, 	$gdCITo;
		global $dPostPTPN1, $dPostPTPN2, $dPostPTPN3, $dPostPTPN4, $dPostPTPN5;
		global $dPostPTPP1, $dPostPTPP2, $dPostPTPP3, $dPostPTPP4, $dPostPTPP5;
		global $PRETEST_PRECISION, $POSTTEST_PRECISION;
		
		debugMsg( "drawPage:  Begin");
?>
	<div class="page">
		<div class="titlebox">
			<div class="titletext">
				PE Pretest Probability <br>Assessment <span style='font-size:10px;'>( Version 2.1Q )</span>
			</div>
			<div class="logo">
				<img src="images/logosmall.GIF" >
			</div>
			<div class="indications">
				INDICATIONS:
The PreTest Consult instrument is intended for prescription use in a hospital, emergency department or urgent care environment by competent health professionals. The PreTest Consult utilizes clinical variables and ECG data to produce a numerical score that is the pretest probability of acute cardiac ischemia or pulmonary embolism. It is intended to supplement, not substitute for the physician’s decision-making process. The advice of PreTest Consult should be used as an aid to the physician’s decision-making process for possible or suspected acute cardiac ischemia or pulmonary embolism in conjunction with knowledge of the patient’s history, the results of a physical examination and other clinical findings. 
			</div>
			<form name="peform" action="pe3.php" method="post" onsubmit='return validatePEForm();' >
		        <input type=hidden name=acceptdata>
		        <input type=hidden name=FromSubmitted value=1>
			<div class="peform">
				<table>
					<tr>
							<td class="formtext">Age</td>
							<td>

<?php
   if (intval($_GET["age"])>50)
	$ageDefault="2";
   else
	{
	   if (intval($_GET["age"])>34)	
		$ageDefault="1";		
	   else
		$ageDefault="0";		
	}

  if ($_POST['age'])
	{
	$ageDefault=$_POST["age"];
	}



	  
?>
								<select name="age" class="formeltext" size=3>
									<option value="0" <?php echo setSelChecked( "age", "0",$ageDefault, array("0","2")) ?>>< 35
									<option value="1" <?php echo setSelChecked( "age", "1", $ageDefault, array("0","2")) ?>>35 - 49
									<option value="2" <?php echo setSelChecked( "age", "2", $ageDefault, array("0","2")) ?>>> 50
								</select>
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'dyspnea');" onmouseout="return nd();">Dyspnea</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="dyspnea" value="Yes" <?php echo setChecked("dyspnea", "Yes", 1) ?>>Yes
								<input type="radio" name="dyspnea" value="No"  <?php echo setChecked("dyspnea", "No", 1) ?>>No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'chestpain');" onmouseout="return nd();">Pleuritic Chest Pain</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="chestpain" value="Yes" <?php echo setChecked("chestpain", "Yes", 1) ?>>Yes
								<input type="radio" name="chestpain" value="No" <?php echo setChecked("chestpain", "No", 1) ?>>No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'sao2');" onmouseout="return nd();">SaO2% < 95%</a></td>
							<td class="formeltext formitembox">

<?php
if ($_GET["sao2"])
   {
   if (intval($_GET["sao2"])<95)
	   $SaO2Def=0;
  else
	   $SaO2Def=1;
   }
else
   $SaO2Def=1;


if ($_POST["sao2"])
   {
   if ($_POST["sao2"]=="Yes")
	   $SaO2Def=0;
   else
   	   $SaO2Def=1;
   }


//echo intval($GET["sao2"]) . " " . $Sao2Def;

if ($SaO2Def==0)
  {
  $YesChecked =" checked";	
  $NoChecked =" ";	
  }
else
  {
  $NoChecked =" checked";	
  $YesChecked =" ";	
  }
?>

								<input type="radio" name="sao2" value="Yes" <?php echo $YesChecked; ?>  >Yes
								<input type="radio" name="sao2" value="No" <?php echo $NoChecked ?> >No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'hr');" onmouseout="return nd();">HR > 99</a></td>
							<td class="formeltext formitembox">


<?php


if ($_GET["hr"])
   {
   if (intval($_GET["hr"]) > 99)
	   $SaO2Def=0;
  else
	   $SaO2Def=1;

   }
else
   $SaO2Def=1;


if ($_POST["hr"])
   {
   if ($_POST["hr"]=="Yes")
	   $SaO2Def=0;
  else
	   $SaO2Def=1;
   }


//echo intval($GET["sao2"]) . " " . $Sao2Def;

if ($SaO2Def==0)
  {
  $YesChecked =" checked";	
  $NoChecked =" ";	
  }
else
  {
  $NoChecked =" checked";	
  $YesChecked =" ";	
  }
?>



								<input type="radio" name="hr" value="Yes" <?php echo $YesChecked; ?>>Yes
								<input type="radio" name="hr" value="No" <?php echo $NoChecked; ?>>No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'hrt');" onmouseout="return nd();">HRT/OCP</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="hrt" value="Yes" <?php echo setChecked("hrt", "Yes", 1) ?>>Yes
								<input type="radio" name="hrt" value="No" <?php echo setChecked("hrt", "No", 1) ?>>No
							</td>
					</tr>



					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'hist');" onmouseout="return nd();"><U>Personal</U> History of DVT/PE</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="hist" value="Yes" <?php echo setChecked("hist", "Yes", 1) ?>>Yes
								<input type="radio" name="hist" value="No" <?php echo setChecked("hist", "No", 1) ?>>No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'swell');" onmouseout="return nd();">Unilateral Leg Swelling</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="swell" value="Yes" <?php echo setChecked("swell", "Yes", 1) ?>>Yes
								<input type="radio" name="swell" value="No" <?php echo setChecked("swell", "No", 1) ?>>No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'hemop');" onmouseout="return nd();">Hemoptysis</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="hemop" value="Yes" <?php echo setChecked("hemop", "Yes", 1) ?>>Yes
								<input type="radio" name="hemop" value="No" <?php echo setChecked("hemop", "No", 1) ?>>No
							</td>
					</tr>
					<tr>
							<td class="formtext"><a class="tooltip" href="javascript:void(0);" onmouseover="return tooltip('pe', 'surgery');" onmouseout="return nd();">Trauma/Surgery</a></td>
							<td class="formeltext formitembox">
								<input type="radio" name="surgery" value="Yes" <?php echo setChecked("surgery", "Yes", 1) ?>>Yes
								<input type="radio" name="surgery" value="No" <?php echo setChecked("surgery", "No", 1) ?>>No
							</td>
					</tr>

	
				</table>
			</div>
		</div>



		<div class="pretestprob">
	<div class=pretestprobbox>
	    <table>
	       <tr style='display:none;'>
	         <td><span id=QSID style='font-weight:bold;background-Color:white;'>QUAADRICs StudyID</span>
	         </td>
	         <td>
		<input type=text size=14 name=StudyID id=StudyID
			value='<?php echo $_SESSION['StudyID']; ?>'
			<?php
			   //if ($_SESSION['AcceptedData'])
			     //echo " readonly";
			?>
			>		
	         </td>
	       </tr>
	    </table>
	</div>

			<div class="pretestprobbox">
<?php
 if ($_POST["getposttest"])
   echo "45 Day PE Post test Probability";
 else
   echo "45 Day PE Pretest Probability";
?>
			<table>
			<?php
				if( !$bdoPost ){
					//Display normal PreTest Probs
			?>
				<tr><td class="lineitem"># of PE Outcomes</td><td class="result"><?php echo "$giPEOutcomes" ?></td></tr>
<input type=hidden name=giPEOutcomes value=<?php echo $giPEOutcomes; ?>>
<input type=hidden name=giATTMatches value=<?php echo $giATTMatches; ?>>

				<tr><td class="lineitem"># of Matched Patients</td><td class="result">
<?php 

  if (($_POST["getpretest"]) || ($_POST["getposttest"]))
     {
	if (($giATTMatches<15) )
	        {
if ( $_POST["FromSubmitted"])
		echo $giATTMatches . "<font color=red size=-2><B>(see recommendation)</b></font>"; 
		}
	else
		echo "$giATTMatches"; 
     }
	?>
</td></tr>
			</table>
			<hr>
			<table>
				<tr><td class="lineitem">
<?php
 if ($_POST["getposttest"])
   echo "45 Day PE Post test Probability";
 else
   echo "45 Day PE Pretest Probability";
?>
</td><td class="result" colspan=3>

<?php 

  if (($_POST["getpretest"]) || ($_POST["getposttest"]))
  { 
  if (0) //$gdPTP>25)
	{
	echo "<table><tr><td class='result'>";
	echo number_format($gdPTP,1) . "%";
	echo "</td><td>";
	echo "<font size=-2 color=#ff0000>Empiric administration of heparin prior to pulmonary vascular imaging indicated.</font>";
	echo "<br>";
	echo "<a href=javascript:PopHeparin();><font size=-2>Click for Publication</a></td></tr></table>";

	}
   else
	{


	if ($giATTMatches>11)
		echo number_format($gdPTP,1) . "%";
	else
	        {
if ( $_POST["FromSubmitted"])
		echo "<font color=red size=-2><b>see recommendation</b></font>";
		}

	}

  }

   echo "<input type=hidden name=gdPTP value='" . number_format($gdPTP,1) . "'>";
   echo "<input type=hidden name=gdCIFrom value='" . number_format($gdCIFrom,1) . "'>";
   echo "<input type=hidden name=gdCITo value='" . number_format($gdCITo,1) . "'>";

?>

</td></tr>
<?php
   if ( $_POST["FromSubmitted"])
	echo "<tr>";
   else 
	echo "<tr style='display:none;'>";
?>
					<td class="lineitem">95% CI</td>
					<td class="result">(<?php 
						if ($giATTMatches > 14)
						 echo number_format($gdCIFrom,1); ?></td>
					<td>to</td>
					<td class="result"><?php if ($giATTMatches > 14) 
								    echo number_format($gdCITo,1); 
							    ?>)</td>
					</tr>
			        <tr>
				  <td colspan=4>
				<?php GenGudiance($gdPTP,$giATTMatches); ?>
				  </td>
				</tr>
				</table>
				<?php
			}else{
					//Display PostTest <a name=""></a>Probs
				?>
				<table>
				<tr><td></td><td class="lineitem">Neg.</td><td width=20></td><td class="lineitem">Pos.</td></tr>
						<tr><td class="lineitem">Rapid ELISA D-dimer</td><td class="result"><?php echo LimitPct($dPostPTPN1,1) . "%"; ?></td><td></td><td class="result"><?php echo number_format($dPostPTPP1,1) . "%"; ?></td></tr>
					<tr><td class="lineitem">Turbidimetric D-dimer</td><td class="result"><?php echo LimitPct($dPostPTPN2,1) . "%"; ?></td><td></td><td class="result"><?php echo number_format($dPostPTPP2) . "%"; ?></td></tr>
						<tr><td class="lineitem">SimpliRED D-dimer</td><td class="result"><?php echo LimitPct($dPostPTPN3,1) . "%"; ?></td><td></td><td class="result"><?php echo number_format($dPostPTPP3,1) . "%"; ?></td></tr>
						<tr><td class="lineitem">Simplify D-dimer</td><td class="result"><?php echo LimitPct($dPostPTPN4,1) . "%"; ?></td><td></td><td class="result"><?php echo number_format($dPostPTPP4) . "%"; ?></td></tr>
						<tr><td class="lineitem">CT Angiogram</td><td class="result"><?php echo number_format($dPostPTPN5) . "%"; ?></td><td></td><td class="result"><?php echo number_format($dPostPTPP5,1) . "%"; ?></td></tr>
				</table>
				<?php
			}
				?>
		</div>

			<div class="peform">
				<table>
	
<?php

if( $_POST["acceptdata"] )
   {
   $_SESSION['AcceptedData']=1;
   }


if ($_SESSION['AcceptedData'])
   {
   }
else
   echo "<tr><td class=submit valign=top><input class='submit2' type='submit' name=acceptdatabutton value='ACCEPT DATA'></td> <td>I have reviewed the clinical data selections for accuracy  </td></tr>";



if ($_SESSION['AcceptedData'])
  {
   if( $_POST["acceptdata"] )

   if (0)
    echo "<tr><td colspan=2>Your clinical data selections have been <span class=blueresult>ACCEPTED</span><BR>
                           You may now use the 'Get Pretest Prob' button</td></tr>";
   echo '<tr>
<td><input class="submit" onclick=DoPreT(); type=button name="getpretestbutton" value="Get Pretest Prob"></td>

<input type=hidden name=getpretest>
<input type=hidden name=getposttest>

<td>
<input class="submit" type="button" onclick=DoPostT();  name="getposttestbutton" value="Get Post Test Probs">
</td>
</tr>';

  if (($_POST["getpretest"]) || ($_POST["getposttest"]))
   {
   if ($_POST["DevUse"]=="Y")
	$YC = " checked";
   if ($_POST["DevUse"]=="N")
	$NC = " checked";
   if ($_POST["DevUse"]=="M")
	$MC = " checked";

// removed post POST-QUAADRIC study with display:none
if (0)
{
echo "<tr><td bgcolor=red><B>Do you plan to use the results of this device?</td>
	  <td><table border=1>
	      <tr>

                <td><B>Yes<input id=DevUse1 onclick=SavePEDevUse(1); type=radio name=DevUse value=Y " . $YC . ">  </td>
                <td><B>No<input id=DevUse2 onclick=SavePEDevUse(2); type=radio name=DevUse value=N " . $NC . ">  </td>
                <td><B>Maybe<input id=DevUse3  type=radio name=DevUse value=M " . $MC . " onclick=SavePEDevUse(3);>  </td>
	      </tr>
	      </table>
	  </td>
     </tr>";
}
	
echo '<tr>
   <td>
    <input onclick=doPrint(); class="submit" type="button" name="print" value="PRINT RESULTS">
		   </td>
    <td></td></tr>';

   }

  }

?>

				</table>
			</div>

		</div>
		</form>
	</div>



	<div class="footer">
		Copyright 2008 PRETESTCONSULT, LLC <br>
	</div>

<?php
}
?>

	


</html>
