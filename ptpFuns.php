<?php

function getDomainName($host)
    {
	$dot_num = substr_count($host, '.');
	$dot_pos = 0;
	if ($dot_num > 1)
		{	
		for($i=1; $i < $dot_num; $i++)
			{
			$dot_pos = strpos($host, '.', $dot_pos) + 1;
			}
		}

	$domain = substr($host, $dot_pos);
	return $domain;
    }

function DoReg($link)
   {
     $q = "INSERT into betasites (SiteName,Contact,ContactEmail,ContactTel,Domain,IPAddr,RegDate) VALUES ('";
     $q .= addslashes($_POST["hospName"]) . "'";
     $q .= ",'" . addslashes($_POST["contactName"]) . "'";
     $q .= ",'" . $_POST["contactEmail"] . "'";
     if ($_POST["contactTel"])
	     $q .= ",'" . $_POST["contactTel"] . "'";
     else
	     $q .= ",'na'";
     $qtt=$q;

     $q .= ",'" . $_POST["domain"] . "'";
     $q .= ",'" . $_POST["ipaddr"] . "'";
     $q .= ",Now())";
     //echo $q;
     $res = mysql_query($q, $link);   

     $q = "SELECT * from betasites WHERE Domain='" . $_POST["domain"] . "'";
     $res = mysql_query($q, $link);
     $failed=0;
     if (!$res)
	$failed=1;
     else
	{
	     if (mysql_num_rows($res)==0)
	  	$failed=1;
	}

     if ($failed==1)
	{
        $q = $qtt . ",'" . $_POST["ipaddr"] . "'";
     	$q .= ",'" . $_POST["ipaddr"] . "'";
     	$q .= ",Now())";
     	$res = mysql_query($q, $link);   
        $q = str_replace("INSERT into betasites","INSERT into betasitecookies",$q); 
     	$res = mysql_query($q, $link);   
	$tdom = addslashes($_POST["hospName"]);
	//set cookie for 90 days
        setcookie("ptpUserDomain", $tdom, time()+60*60*24*90);
	include "ptpRegAckSingle.htm";
	//echo $q;
	}
      else
	  include "ptpRegAck.htm";
   }

function isReg($link,$reqDom,$ipaddr)
    {
     $q = "SELECT * from betasites WHERE Domain='" . $reqDom . "'";
     $res = mysql_query($q, $link);
     if (!$res)
	return 0;

     if (mysql_num_rows($res)==0)
	{
     	if ($_POST["domain"])
        	 DoReg($link);
	else
		return 0;
	}

     $row = mysql_fetch_array($res, MYSQL_ASSOC);

    return 1;
    }


?>
