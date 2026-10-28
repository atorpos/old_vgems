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
	$query_info = sprintf("SELECT * FROM exhibitionlist LIMIT 200 OFFSET 4000");
	$recordinfo = mysql_query($query_info, $shopSQL) or die(mysql_error());
	$row_recordinfo = mysql_fetch_assoc($recordinfo);
	$totalRow_recordinfo = mysql_num_rows($recordinfo);
	do {
		$detaillink = utf8_encode($row_recordinfo['permlink']);
		
		$content = file_get_contents($detaillink);
		$seperatestring = explode('<div class="profileHolder">', $content);
		
		$secsepstring = explode('<div class="col-xs-7 col-sm-7 col-md-7">', $seperatestring[1]);
		
		$companyaddress = explode('</div>', $secsepstring[2]);
		
		$naturofbusiness = explode('</div>', $secsepstring[4]);
		$string = preg_replace('/\s+/', '', $naturofbusiness[0]);
		$stringnatofbusiness = str_replace('&#130;', ', ', $string);
		
		$industries = explode('</div>', $secsepstring[5]);
		$instring = preg_replace('/\s+/', '', $industries[0]);
		$stringofinst = str_replace('&#130;', ', ', $instring);
		
		$psrvalue = explode('</div>', $secsepstring[6]);
		//echo $psrvalue[0];
		
		$telvalue = explode('</div>', $secsepstring[8]);
		//echo $telvalue[0];
		
		$faxvalue = explode('</div>', $secsepstring[9]);
		//echo $faxvalue[0];
		
		$swebvalues = explode('<div>Website:</div>', $secsepstring[9]);
		$webvalues = explode('</div>', $swebvalues[1]);
		$webstring = preg_replace('/\s+/', ' ', $webvalues[0]);
		
		$updaterecord_query = sprintf("UPDATE exhibitionlist SET address=%s, natofbusiness=%s, industry=%s, psrvalue=%s, tel=%s, fax=%s, webvalue=%s WHERE id=%s", GetSQLValueString($companyaddress[0], "text"),GetSQLValueString($stringnatofbusiness, "text"),GetSQLValueString($stringofinst, "text"),GetSQLValueString($psrvalue[0], "text"),GetSQLValueString($telvalue[0], "text"),GetSQLValueString($faxvalue[0], "text"),GetSQLValueString($webstring, "text"),GetSQLValueString($row_recordinfo['id'], "int"));
		//echo $seperatestring[1];
		
		$updatelist = mysql_query($updaterecord_query, $shopSQL) or die(mysql_error());
	}while ($row_recordinfo = mysql_fetch_assoc($recordinfo));
	mysql_free_result($recordinfo);
	
	
?>