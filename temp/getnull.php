<?php
	header('Content-type: application/json; charset=utf-8');
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
	$query_info = sprintf("SELECT * FROM exhibitionlist LIMIT 1000 OFFSET 4000");
	$recordinfo = mysql_query($query_info, $shopSQL) or die(mysql_error());
	$row_recordinfo = mysql_fetch_assoc($recordinfo);
	$totalRow_recordinfo = mysql_num_rows($recordinfo);
	do {
		$detaillink = utf8_encode($row_recordinfo['permlink']);
		
		$content = file_get_contents($detaillink);
		$seperatestring = explode('<div class="profileHolder">', $content);
		
		$secsepstring = explode('Nature of Business:</div>
							<div class="col-xs-7 col-sm-7 col-md-7">', $seperatestring[1]);
		
		$indvalue = explode('</div>', $secsepstring[1]);
		
		$indstring = preg_replace('/\s+/', ' ', $indvalue[0]);
		$stringofinst = str_replace('&#130;', ', ', $indstring);
		$updaterecord_query = sprintf("UPDATE exhibitionlist SET natofbusiness=%s WHERE id=%s",GetSQLValueString($stringofinst, "text"),GetSQLValueString($row_recordinfo['id'], "int"));
		
		//echo $secsepstring[1];
		$updatelist = mysql_query($updaterecord_query, $shopSQL) or die(mysql_error());
		
	}while ($row_recordinfo = mysql_fetch_assoc($recordinfo));
	//echo $totalRow_recordinfo;
	mysql_free_result($recordinfo);
	
	
?>