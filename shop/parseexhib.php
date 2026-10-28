<?php
	header('Content-type: application/json; charset=utf-8');
	$postlocation = $_POST['exhbloc'];
	require_once '../Connections/VGshop.php';
	if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
		{
			if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  		}

  		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  		switch ($theType) {
  		case "text":
  			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
  			break;
  			case "long":
  			case "int":
  				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
  			break;
  			case "double":
  				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
  			break;
  			case "date":
  				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
  			break;
  			case "defined":
  				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
  			break;
  		}
  		return $theValue;
	}
	}
	class Item {
		public $companyname = "";
		public $compcountry = "";
		public $compkeyword = "";
		public $comperlink = "";
		public $boothlocation ="";
		public $boothhall = "";
		public $boothno ="";
		public $recid = "";
		public $exsession = "";
	}
	
	mysql_select_db($database_shopSQL, $shopSQL);
	if (isset($postlocation)) {
		$query_info = sprintf("SELECT * FROM exhibitionlist WHERE boothlocation=%s ORDER BY companyname ASC", GetSQLValueString($postlocation, "text"));
	} else {
		$query_info = sprintf("SELECT * FROM exhibitionlist ORDER BY companyname ASC");
	}
	$recordinfo = mysql_query($query_info, $shopSQL) or die(mysql_error());
	$row_recordinfo = mysql_fetch_assoc($recordinfo);
	$totalRow_recordinfo = mysql_num_rows($recordinfo);
	do {
		$items->companyname[] = utf8_encode($row_recordinfo['companyname']);
		$items->compcountry[] = utf8_encode($row_recordinfo['country']);
		$items->compkeyword[] = utf8_encode($row_recordinfo['productkeyword']);
		$items->comperlink[] = utf8_encode($row_recordinfo['permlink']);
		$items->boothlocation[] = utf8_encode($row_recordinfo['boothlocation']);
		$items->boothhall[] = utf8_encode($row_recordinfo['boothhall']);
		$items->boothno[] = utf8_encode($row_recordinfo['boothnumber']);
		$items->recid[] = $row_recordinfo['id'];
		$items->exsession[] = utf8_encode($row_recordinfo['exsession']);
		
	}while ($row_recordinfo = mysql_fetch_assoc($recordinfo));
	$txt = json_encode($items);
	echo $txt;
	
	//$myfile = fopen("exhiblist.json", "w") or die("Unable to open file!");
	//fwrite($myfile, $txt);
	//fclose($myfile);
	mysql_free_result($recordinfo);
	
	
?>