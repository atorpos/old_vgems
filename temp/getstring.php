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
	$cnamearray = array();
	$countryarray = array();
	$keywordarray = array();
	$bnumarray = array();
	$linkarray = array();
	for ($j=88; $j<89;$j++) {
		
	
		$url = "http://m.hktdc.com/fair/exlist/hkdgp-en/HKTDC-Hong-Kong-International-Diamond--Gem---Pearl-Show/List-Of-Exhibitors.htm?bookmark=true&query=&breadcrumb=&page=". $j."&advanced=false&code=hkdgp&language=en";
		$content = file_get_contents($url);
		$sepersting = explode('<div class="productListHolder">', $content);
		$secsepsting = explode('<div class="tit noMarginB">', $sepersting[1]);
		
		for ($i=1; $i<=17; $i++) {
			$fsublink = explode('<a href="', $secsepsting[$i]);
			$tsublink = explode('" target="_blank">', $fsublink[1]);
			$linkarray[] = "http://m.hktdc.com" .$tsublink[0];
			
			$fcomname = explode('target="_blank">', $secsepsting[$i]);
			$comname = explode('</a>', $fcomname[1]);
			$cnamearray[] = $comname[0];
			
			$fcountry = explode('<div class="comLoca">', $secsepsting[$i]);
			$country = explode('</div>', $fcountry[1]);
			$countryarray[] = $country[0];
			
			$fpkeyword = explode('<div class="prodCat"><span>Product Categories :</span><br>', $secsepsting[$i]);
			$pkeyword = explode('</div>', $fpkeyword[1]);
			$keywordarray[] = $pkeyword[0];
			
			$fbnum = explode(';return false;" href="#">', $secsepsting[$i]);
			$bnum = explode('</a>', $fbnum[1]);
			$bnumarray[] = $bnum[0];
	
	
		}
	
	}
	
	$arrayno = count($cnamearray);
	echo $arrayno;
	for ($k = 0; $k<$arrayno; $k++) {
		//echo $linkarray[$k];
		$insertsql = sprintf("INSERT INTO exhibitionlist(companyname,country,productkeyword,boothno,exsession, permlink) VALUES (%s,%s,%s,%s,'HKTDC2017', %s)", GetSQLValueString($cnamearray[$k], "text"),GetSQLValueString($countryarray[$k], "text"),GetSQLValueString($keywordarray[$k], "text"),GetSQLValueString($bnumarray[$k], "text"),GetSQLValueString($linkarray[$k], "text"));
	$runpostkey = mysql_query($insertsql, $shopSQL) or die(mysql_error());
	//echo $insertsql. ' ';
	}
	
		
?>