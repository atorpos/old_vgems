<?php
	header('Content-type: application/json');
	require_once '../Connections/VGshop.php';
	date_default_timezone_set("Asia/Hong_Kong");
	$postdate = date("Y-m-d H:i:s"); 
	$posttitle = "Order &ndash; ". date("F d, Y @ h:i:s A");
	$postpassword = "order_". md5($postdate);
	$postname = "order-" .strtolower(date("M-d-Y-hi-a"));
	$postguid = "https://panbear.chicboite.com/?post_type=shop_order&#038";
	
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

	// Get the credit card details submitted by the form
	$userid = $_POST['userid'];
	$bfirstname = $_POST['bfirstname'];
	$blastname = $_POST['blastname'];
	$bcompanyname =$_POST['bcompanyname'];
	$baddress1 = $_POST['baddress1'];
	$baddress2 = $_POST['baddress2'];
	$bstate = $_POST['bstate'];
	$btown = $_POST['btown'];
	$bpostal = $_POST['bpostal'];
	$bcountry = $_POST['bcountry'];
	$bphone = $_POST['bphone'];
	$bemail = $_POST['bemail'];
	$sfirstname = $_POST['sfirstname'];
	$slastname = $_POST['slastname'];
	$scompanyname = $_POST['scompanyname'];
	$saddress1 = $_POST['saddress1'];
	$saddress2 = $_POST['saddress2'];
	$stown = $_POST['stown'];
	$sstate = $_POST['sstate'];
	$spostal = $_POST['spostal'];
	$scountry = $_POST['scountry'];
	$postip = $_SERVER['REMOTE_ADDR'];
	$postagent = $_SERVER['HTTP_USER_AGENT'];

	$redotext = str_replace('"','', $baddress2);
	mysql_select_db($database_shopSQL, $shopSQL);
	
	// update or insert billing first name
	if ($bfirstname != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_first_name'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bfirstname), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_first_name',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bfirstname), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	//update or insert billing last name
	if ($blastname != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_last_name'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $blastname), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_last_name',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $blastname), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	//update or insert company name
	if ($bcompanyname != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_company'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bcompanyname), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_company',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bcompanyname), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	//update or insert address 1 
	if ($baddress1 != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_address_1'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $baddress1), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_address_1',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $baddress1), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert address 2 
	if ($baddress2 != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_address_2'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $baddress2), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_address_2',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $baddress2), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert bill state 
	if ($bstate != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_state'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bstate), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_state',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bstate), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert bill town 
	if ($btown != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_city'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $btown), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_city',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $btown), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert bill postal 
	if ($bpostal != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_postcode'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bpostal), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_postcode',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bpostal), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert bill country 
	if ($bcountry != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_country'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bcountry), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_country',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bcountry), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert bill phone 
	if ($bphone != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_phone'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bphone), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_phone',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bphone), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert bill email 
	if ($bemail != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='billing_email'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $bemail), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'billing_email',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $bemail), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	// update or insert shipping first name
	if ($sfirstname != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_first_name'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $sfirstname), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_first_name',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $sfirstname), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	//update or insert shipping last name
	if ($slastname != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_last_name'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $slastname), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_last_name',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $slastname), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	//update or insert company name
	if ($scompanyname != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_company'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $scompanyname), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_company',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $scompanyname), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	
	//update or insert shiping address 1 
	if ($saddress1 != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_address_1'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $saddress1), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_address_1',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $saddress1), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert ship address 2 
	if ($saddress2 != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_address_2'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $saddress2), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_address_2',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $saddress2), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert ship state 
	if ($sstate != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_state'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $sstate), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_state',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $sstate), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert shipping town
	if ($stown != "") {
		$searchctownmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_city'", GetSQLValueString($userid, "int"));
		$townmetaRecord = mysql_query($searchctownmeta, $shopSQL) or die(mysql_error());
		$row_townmeta = mysql_fetch_assoc($townmetaRecord);
		$totalRow_townmeta = mysql_num_rows($townmetaRecord);
		if ($totalRow_townmeta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $stown), "text"), GetSQLValueString($row_townmeta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_city',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $stown), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert ship postal 
	if ($spostal != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_postcode'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $spostal), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_postcode',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $spostal), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}
	//update or insert ship country 
	if ($scountry != "") {
		$searchmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s AND meta_key='shipping_country'", GetSQLValueString($userid, "int"));
		$metaRecord = mysql_query($searchmeta, $shopSQL) or die(mysql_error());
		$row_meta = mysql_fetch_assoc($metaRecord);
		$totalRow_meta = mysql_num_rows($metaRecord);
		if ($totalRow_meta != 0) {
			$updatebfirst = sprintf("UPDATE np_usermeta SET meta_value=%s WHERE umeta_id=%s", GetSQLValueString(str_replace('"','', $scountry), "text"), GetSQLValueString($row_meta['umeta_id'], "int"));
		} else {
			$updatebfirst = sprintf("INSERT INTO np_usermeta(userid, meta_key, meta_value) VALUES(%s,'shipping_country',%s)", GetSQLValueString($userid, "int"), GetSQLValueString(str_replace('"','', $scountry), "text"));
		}
		$runbfirst = mysql_query($updatebfirst, $shopSQL) or die(mysql_error());
	}

	
	mysql_close($shopSQL);
	// Create the charge on Stripe's servers - this will charge the user's card
	    //$save = \Stripe\Customer::create(array(
    	//    "card" => $token,
    	//    "email" => strip_tags(trim($tokenemail))
    	    
	    //));
    $success = $runbfirst;
    echo '{"success":'.$success .', "message": "'.$postip.' , ' .$postagent. '"}' ;
	    //echo $success;
?>