<?php

	$host = 'localhost';
	$user = 'peacs';
	$pass = 'notoregon';
	$db = 'peacs';


//date("Y-m-d H:i:s")
/*****************************************************************************************************/
function logConn($app, $test){
	global $host, $user, $pass, $db;
	
	$ip = $_SERVER["REMOTE_ADDR"];
	$time = date("Y-m-d H:i:s");
	
	$query = "select * from log where ip = '$ip' and app = '$app'";
	
	if( !$res = queryDB( $host, $user, $pass, $db, $query ) ){
		errMsg( "ERROR:  Could not read log from database (" . getErrorDB() . ")");
	}else{
		if( @ mysql_num_rows($res) != 0 ){
			//The ip was found in the log so increment the count
			$row = @mysql_fetch_array($res);
			$count = $row["count"]+1;
			
			$query = "update log set count = $count, timestamp = '$time' where id = " . $row["id"];
		}else{
			//The ip was not found so add the ip
			$count = 1;
			$query = "insert into log (ip,app,count,timestamp) values ('$ip','$app',$count,'$time')";
		}
		
		if( !$res = queryDB( $host, $user, $pass, $db, $query ) ){
			errMsg( "ERROR:  Could not update log (" . getErrorDB() . ")");
		}
	}
	
	return $count;
}

function setChecked( $name, $val, $bdefault){
	$ret = "";
	
	//debugMsg( "setChecked:  name=$name, val=$val, _POST[name]=" . $_POST["$name"]);
	
	if( $_POST["$name"] == $val ){
		$ret = "checked";
		//debugMsg( "setChecked:  POST value matched");
	}else if( $bdefault && $val == "No" && $_POST["$name"] != "Yes" ){
		//Set No as the default
		$ret = "checked";
		//debugMsg( "setChecked:  Setting default value");
	}
	
	return $ret;
}

function setSelChecked($name, $val, $default, $aother){
	$ret = "";
	
	//debugMsg( "setSelChecked:  name=$name, val=$val, default=$default, _POST[name]=" . $_POST["$name"]);
	
	if( $_POST["$name"] == $val ){
		$ret = "selected";
		//debugMsg( "setSelChecked:  POST value matched");
	}else if( $val == $default && !in_array( $_POST["$name"], $aother) ){
		//Set No as the default
		$ret = "selected";
		//debugMsg( "setSelChecked:  Setting default value");
	}
	
	return $ret;
}

function PostTestCalc(&$dPostPTPN, &$dPostPTPP, $dPTP, $dNVal, $dPVal)
{
	$dPostOdds = 0;
	
	$dPostOdds = ($dNVal * $dPTP ) / ( 1 - $dPTP );
	$dPostPTPN = ($dPostOdds * 100 ) / ( 1 + $dPostOdds);
	$dPostOdds = ($dPVal * $dPTP ) / ( 1 - $dPTP );
	$dPostPTPP = ($dPostOdds * 100 ) / ( 1 + $dPostOdds);
}

function err($str){
	print "<div class=\"errtext\">$str<br></div>";
}

function LimitPct($val,$x)
 {
 if ($val < 1)
   return " < 1.0";
 else
   return number_format($val,1);
}

?>