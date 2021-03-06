<?php

echo "<table>";

 $labels = array();
 $labels["age=0"] = " < 35 ";
 $labels["age=1"] = " 35 - 49";
 $labels["age=2"] = " > 50 ";
 foreach( $_POST as $key=>$TheValue)
	{
        $vuse=0;
	if ($TheValue=="Yes")
	   $value="<font color=red>Yes</font>";
	else
		$value=$TheValue;
	
	
	switch($key) { 
	     case 'age': 
		echo "<tr><td><b>";
		echo "Age";
		echo "</td><td><B>";
		echo $labels[$key . "=" . $TheValue];
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
		echo "<U>Personal</U> History of DVT/PE";
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


echo "</table>";

?>
