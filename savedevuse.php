<?php

include "dbconf.php";
include "logpe.php";	

$q = "UPDATE peptpquerys SET DevUse = " . $_POST['DevUse'] . " WHERE StudyID='" . $_POST['StudyID'] . "'";

   $res = mysql_query($q, $link);

?>

