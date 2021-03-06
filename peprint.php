<?php
$ttl = 86400;
ini_set(session.gc_maxlifetime, $ttl);
session_start();

if ($_POST["deviceuse"])
  {
	if ($_POST["deviceuse"] =="No")
	   {
			include "qcontrol.php";
			exit();
	   }
  }

$_SESSION['AcceptedData']=0;

function PERCNegative()
    {
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
if (1)
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

?>

<link rel="stylesheet" href="style.css" type="text/css">
<body onload=pagePrint();>
<form action=pe3.php>
<table>
<tr><td>
     <img src="images/logo.gif">
<span style='font-size:10px;'>( Version 2.1Q )</span>
    </td>
    <td><DIV id=navOps>
	<!-- <input type=submit value='Pre Test Form'>  -->
	<input type=button value='Print Results' onclick=pagePrint();>        
        </DIV>
    </td>
</tr>
</table>

<table>
<tr><td valign=top>
45 Day PE Pretest Probability Result 
</td>
<td valign=top style='display:none;'>
	<table border=1>
		<tr><td><B>QUADRIC STUDY ID</td>
		    <td><span class=blueresult><?php echo $_SESSION['StudyID']; ?></td>
	        </tr>
		<tr>
		     <td>Time : </td>
		     <td><B> <?php echo date("H:i    m/d/y"); ?>
		</tr>
        </table>
</td>
</tr>
</table>

<div class="pretestprobboxprint">
<table>
<tr><td class="lineitem"># of PE Outcomes</td><td class="result">
<?php echo $_POST["giPEOutcomes"]; ?></td></tr>
<tr><td class="lineitem"># of Matched Patients</td><td class="result">
<?php echo $_POST["giATTMatches"]; ?></td></tr>
</table>
<hr>
<table>
<tr><td class="lineitem">
45 Day PE Pretest Probability
</td>
 <td class="result" colspan=3>
  <?php
        if (intval($_POST["giATTMatches"])>14)
		echo $_POST["gdPTP"] . "%"; 
	else
		echo "<span style='font-size:11px;'>see recommendation below</span>";

   ?>
</td></tr>
<tr>
<td class="lineitem">95% CI</td>
<td class="result">(<?php if (intval($_POST["giATTMatches"])>14) echo $_POST["gdCIFrom"]; ?></td>
<td>to</td>
<td class="result"><?php if (intval($_POST["giATTMatches"])>14) echo $_POST["gdCITo"]; ?>)</td>
</tr>
</table>
<table border=2>
<tr><td>
<table>
<?php
 $labels = array();
 $labels["age=0"] = " < 35 ";
 $labels["age=1"] = " 35 - 49";
 $labels["age=2"] = " > 50 ";
 foreach( $_POST as $key=>$value)
	{
	//echo $key . "=" . $value . "<br>";
        $vuse=0;
	switch($key) { 
	     case 'age': 
		echo "<tr><td><b>";
		echo "Age";
		echo "</td><td><B>";
		echo $labels[$key . "=" . $value];
	        $vuse=1;
		break;
	     case 'dyspnea': 
		echo "<tr><td><b>";
		echo "Dyspnea";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
	     case 'chestpain' :
		echo "<tr><td><b>";
		echo "Pleuritic Chest Pain";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
	     case 'sao2' :
	echo "<tr><td><b>";
		echo "SaO2 < 95%";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
	     case 'hr' :
	echo "<tr><td><b>";
		echo "HR > 99";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
     case 'hrt' :
	echo "<tr><td><b>";
		echo "HRT/OCP";
		echo "</td><td><B>";
		echo $value;
	        $vuse=0;
		echo "</td></tr></table></td><td valign=top><table>";
		break;
     case 'hist' :
	echo "<tr><td><b>";
		echo "History of DVT/PE";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
       case 'swell' :
	echo "<tr><td><b>";
		echo "Unilateral Leg Swelling";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
	case 'hemop' :
		echo "<tr><td><b>";
		echo "Hemoptysis";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
	case 'surgery' :
		echo "<tr><td><b>";
		echo "Trauma/Surgery";
		echo "</td><td><B>";
		echo $value;
	        $vuse=1;
		break;
              }

        if ($vuse==1)
		echo "</td></tr>";

		
//		echo $key . "=" . $value . "<p>";
	}

?>
</table>
</table>


<table border=1>
<tr>
   <td colspan=2 width=400>
   <?php GenGudiance($_POST["gdPTP"],$_POST["giATTMatches"]); ?>
   </td>
</tr>

</table>

</body>
<script>

function pagePrint()
   {
    saveHTML = document.getElementById('navOps').innerHTML;
    document.getElementById('navOps').innerHTML='';
    window.print();
    document.getElementById('navOps').innerHTML=saveHTML;
    }
</script>