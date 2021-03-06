<?php

	foreach( $_POST as $key=>$value)
	{
	//echo $key . "=" . $value . "<BR>";
	}


        // J. Kline requested modification to reconcile with PERC 
	if (($iAge==0)
	     && ($iHRT=="No")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSaO2=="No")
	     && ($iHR=="No")
	     && ($iSwelling=="No")
	     && ($iSurgery=="No")
	     && ($iHemop=="No")
	     && ($iHistory=="No")
	   )
	  $iAge=1;

        // ADDITIONAL MOD done 4-9-2011 to reconcile with PERC for CP=1 and all other PERC vars=0 
	// J. Kline requested modification to reconcile with PERC 
	if (($iAge==1)
	     && ($iHRT=="No")
	     && ($iDyspnea=="No")
	     && ($iChestPain=="Yes")
	     && ($iSaO2=="No")
	     && ($iHR=="No")
	     && ($iSwelling=="No")
	     && ($iSurgery=="No")
	     && ($iHemop=="No")
	     && ($iHistory=="No")
	   )
	   $iDyspnea="Yes";

	if (($iAge==0)
	     && ($iHRT=="No")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="No")
	     && ($iSaO2=="No")
	     && ($iHR=="No")
	     && ($iSwelling=="No")
	     && ($iSurgery=="No")
	     && ($iHemop=="No")
	     && ($iHistory=="Yes")
	   )
	   $iChestPain = "Yes";

	if (($iAge==0)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
//	     && ($iChestPain=="No")
	     && ($iSaO2=="Yes")
	     && ($iHR=="No")
	     && ($iSwelling=="No")
	     && ($iSurgery=="No")
	     && ($iHemop=="No")
	     && ($iHistory=="No")
	   )
	   $iHRT = "No";

	if (($iAge==0)
	     && ($iHRT=="No")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
//	     && ($iSaO2=="No")
//	     && ($iHR=="No")
	     && ($iSwelling=="Yes")
	     && ($iSurgery=="No")
	     && ($iHemop=="No")
	     && ($iHistory=="Yes")
	   )
	  {
	   $iHistory = "No";
	   $iSaO2="No";
	   $iHR="No";
	  }

	if (($iAge==0)
	     && ($iHRT=="No")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="Yes")
	   )
	  {
	   $iHistory = "No";
	   $iSwelling="No";
	   $iSaO2="No";
	  }

	if (($iAge==0)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="Yes")
	   )
	  {
	   $iHistory = "No";
	   $iSwelling="No";
	   $iSaO2="No";
	   $iHR="No";
	  }


	if (($iAge==0)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="No")
	     && ($iSwelling=="No")
	     && ($iHemop=="No")
	     && ($iHR=="Yes")
	     && ($iSaO2=="Yes")
	     && ($iHistory=="No")
	   )
	  {
	   $iHR="No";
	   $iHRT="No";
	  }


	if (($iAge==0)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iHistory=="Yes")
	     && ($iSurgery=="No")
	     && ($iSwelling=="No")
	     && ($iHemop=="No")
//	     && ($iHR=="Yes")
//	     && ($iSaO2=="Yes")
	   )
	  {
	   $iHR="No";
	   $iSaO2="No";
	  }


	if (($iAge==0)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="No")
	     && ($iSwelling=="Yes")
	     && ($iHemop=="No")
	  //   && ($iHR=="Yes")
	    // && ($iSaO2=="Yes")
	     && ($iHistory=="Yes")
	   )
	  {
	   $iSwelling="No";
	   $iHR="No";
	   $iSaO2="No";
	  }

	if (($iAge==0)
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="No")
	     && ($iSwelling=="Yes")
	     && ($iHemop=="No")
	  //   && ($iHR=="Yes")
	    // && ($iSaO2=="Yes")
	     && ($iHistory=="No")
	   )
	  {
	   $iHR="No";
	   $iHRT="No";
	   $iSaO2="No";
	   $iHistory="No";
	  }


	if (($iAge==1)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="No")
	     && ($iSwelling=="No")
	     && ($iHemop=="No")
	     //&& ($iHR=="Yes")
	     && ($iSaO2=="Yes")
	     && ($iHistory=="Yes")
	   )
	  {
	   //$iHR="No";
	   $iSaO2="No";
	  }



	if (($iAge==2)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="Yes")
	     && ($iSwelling=="No")
	     && ($iHemop=="No")
	     && ($iHR=="Yes")
	     && ($iSaO2=="Yes")
	     && ($iHistory=="No")
	   )
	  {
	    $iHRT="No";
	  }

	if (($iAge==2)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="No")
	     && ($iSwelling=="No")
	     && ($iHemop=="No")
	     && ($iHR=="Yes")
	     && ($iSaO2=="Yes")
	     && ($iHistory=="No")
	   )
	  {
	    $iHRT="No";
	  }

	if (($iAge==2)
	     && ($iHRT=="Yes")
	     && ($iDyspnea=="Yes")
	     && ($iChestPain=="Yes")
	     && ($iSurgery=="Yes")
//	     && ($iSwelling=="Yes")
//	     && ($iHemop=="Yes")
	     && ($iHR=="Yes")
	     && ($iSaO2=="Yes")
	     && ($iHistory=="Yes")
	   )
	  {

	   $iHistory="No";
	   $iSwelling="No";
	   $iHemop="No";
	    $iHRT="No";

	  }
if (0)
{
echo 	$iAge . "<br>";
echo 	$iChestPain . "<br>";
echo 	$iDyspnea . "<br>";
echo 	$iSaO2 . "<br>";
echo 	$iHR . "<br>";
echo "HRT=" . 	$iHRT . "<br>";
echo 	$iHistory . "<br>";
echo 	$iSwelling . "<br>";
echo 	$iHemop . "<br>";
echo 	$iSurgery . "<br>";
}






?>
