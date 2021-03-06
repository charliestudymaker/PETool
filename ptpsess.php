<?php
$ttl = 86400;
ini_set(session.gc_maxlifetime, $ttl);
session_start();

$AuthList = array( "UHSA6419ZA15", // UH San Antonio
		   "B7X1Y7YYQ32",  //texas
                    "clj5174",
		  "demoJ2109"); 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
header("Cache-Control: post-check=0, pre-check=0", false);

PTPSessChk();

DoIDELabel();

function PTPSessChk()
  {  
global $AuthList;

return;


setcookie("PTPAuth","111",time()+60000);

if (isset($_COOKIE["PTPAuth"]))
   return;

if ($_GET["PTPAuth"]=="QUADRIC")
	{
	    setcookie("PTPAuth", $_GET["PTPAuth"],time()+60000);
	     return;
	}

if ($_POST["PTPAuth"])
   {
 foreach($AuthList as  $key =>$value)
	{
	if (strcmp($_POST["PTPAuth"],$value)==0)
	    {
	    setcookie("PTPAuth", $_POST["PTPAuth"],time()+60000);
	     return;
	    }
	}


  }

//return;


 echo ' 

           <title>PE Pretest Probability Assessment</title>
	  <link rel="stylesheet" href="style.css" type="text/css">
';

echo '

	<body>
            <div id="PageWrapper">
		<div class="page">
            <div id="PageHeader">
                <div id="HeaderTitle">
                    <div class="titletext">
                            PE Pretest Probability <br />Assessment
			    <span style="font-size:11px;">( Version 2.1Q )</span>
                    </div>
                    <div class="logo">
                            <img src="ptlogo1.jpg" alt="Pretest Consult" />
                    </div>
                </div> <!-- /HeaderTitle -->
	    <p>';

	if ($_POST["PTPAuth"])
   echo "<font color=red><B>Please retry entering site authorization code</font>";
	else
	    echo "<span style='font-size:  14px;'><B>Please enter Your Site's Authorization Code</span>";

	echo '


	    <form action=pe3.php method=post>
	    <table  style="font-size:  13px;">
            <tr>
	      <td><b>Authorization Code:</td>
	      <td><input name=PTPAuth type=text size=14></td>
	   </tr>
	   <tr>
	     <td colspan=2>
	     <input type=submit value=\'ENTER\'>
	     </td>
	   </tr>
           </table>


	    </div></div></div></body>';

 exit();

       
}

function DoIDELabel()
   {

if ($_GET["IDERead"])
	$_SESSION['IDEShown']=1;

if ($_POST)
	$_SESSION['IDEShown']=1;


if (!$_SESSION["IDEShown"])
	{
  echo '<link rel="stylesheet" href="style.css" type="text/css">';
  echo "<script>
	function ClearIDE()
	    {
		document.DoReload.IDERead.value=1;
		document.DoReload.submit();
	    }
	</script>";

  echo "<body>
<DIV id=IDELAbelDIV style='position:width:600px;display:block;background-Color:white; '>	
			<table>
                        <tr>
			<td>
			<div class='logo'>
				<img src=ptlogo1.JPG>
			</div>
			</td>
			<td width=300>
			<div class='titletext'>
				PE Pretest Probability <br>Assessment
			    <span style='font-size:11px;'>( Version 2.1Q )</span>

			</div>
			</td>
			</tr>
			<td colspan=2>
			<div class='indications'>
				INDICATIONS: The PreTest Consult instrument is intended for prescription use in a hospital, emergency department or urgent care environment by competent health professionals. The PreTest Consult utilizes clinical variables and ECG data to produce numerical score that is the pretest probability of acute cardiac ischemia or pulmonary embolism. It is intended to supplement, not substitute for the physician's decision process. The advice of PreTest Consult should be used as an aid the physician's decision making process for possible or suspected acute cardiac ischemia or pulmonary embolism in conjunction with knowledge of the patient's history, the results of a physical examination and other clinical findings.


			</div>
			</td>
			</tr>
			</table>


<table border=1 >
   <tr><td width=700><center><B>
CAUTION : <U>Investigational device</U>. Limited by federal (or United States) law to investigational use </td>
   </tr>

   <tr><td><B>
Manufacturer:</B> CP Diagnostics LLC 1723 Beverly Drive Charlotte, NC 28207 704-773-7652 </td>
   </tr>


   <tr><td><B>
Warnings and Precautions:</B> Review the most current version of the clinical protocol, short title QUAADRICs, prior to use for instructions for use, contraindications and hazards.  </td>
   </tr>

    <tr>
      <td >
	<span style='float:right;font-weight:bold;'>PTC 2-11 Rev 2.1
      </td>
    </tr>

   <tr><td><center><input style='font-size:16px; font-weight:bold;' type=button value='I have read this Warning Label' onclick=ClearIDE();></td>
   </tr>

</table></DIV>
<form action=pe3.php name=DoReload><input type=hidden name=IDERead></form></body>";
exit();
	}


   }

?>
