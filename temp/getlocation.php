<?php
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
	
	mysql_select_db($database_shopSQL, $shopSQL);
	$query_info = sprintf("SELECT * FROM exhibitionlist");
	$recordinfo = mysql_query($query_info, $shopSQL) or die(mysql_error());
	$row_recordinfo = mysql_fetch_assoc($recordinfo);
	$totalRow_recordinfo = mysql_num_rows($recordinfo);
	do {
		$rawinfo = $row_recordinfo['boothno'];
		
		$loloc = explode(" ", $rawinfo);
		
		$lohall = explode("-", $loloc[1]);
		
		
		$update_query = sprintf("UPDATE exhibitionlist SET boothlocation=%s, boothhall=%s, boothnumber=%s WHERE id=%s", GetSQLValueString($loloc[0], "text"), GetSQLValueString($lohall[0], "text"), GetSQLValueString($lohall[1], "text"), GetSQLValueString($row_recordinfo['id'], "int"));
		$updatelist = mysql_query($update_query, $shopSQL) or die(mysql_error());
		echo $update_query;
	}while ($row_recordinfo = mysql_fetch_assoc($recordinfo));
	
	
?>