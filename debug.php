<?
$DEBUG_MSGS = "<hr><h3>DEBUG LOG</h3>";

function debugMsg( $msg ){
	global $DEBUG, $DEBUG_MSGS;
	
	if( $DEBUG ){
		$DEBUG_MSGS = $DEBUG_MSGS . "DEBUG:  $msg<br>";
	}
}

function displayDebugMsgs(){
	global $DEBUG, $DEBUG_MSGS;
	
	if( $DEBUG ){
		print $DEBUG_MSGS;
	}
}
?>
