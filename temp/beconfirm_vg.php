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
	$tokenamount = $_POST['paymentamount'];
	$tokencurrency = $_POST['paymentcurrency'];
	$tokendescription = $_POST['transdetail'];
	$tokenemail =$_POST['email'];
	$tokennumber = $_POST['pnumber'];
	$shippingstreet = $_POST['shipstreet'];
	$shippingcity = $_POST['shipcity'];
	$shippingstate = $_POST['shipstate'];
	$shippingpostal = $_POST['shippostal'];
	$shippingcountry = $_POST['shipcountry'];
	$tokenfirstname = $_POST['firstname'];
	$tokenlastname = $_POST['lastname'];
	$shipdiscount = $_POST['cartdisc'];
	$combinqty = $_POST['combinqty'];
	$combincost = $_POST['combincost'];
	$paymentmethod = $_POST['paymethod'];
	$postip = $_SERVER['REMOTE_ADDR'];
	$postagent = $_SERVER['HTTP_USER_AGENT'];


	$itemsarray = explode(',', $tokendescription);
	$itemqtyarray = explode(',', $combinqty);
	$itemcostarray = explode(',', $combincost);
	mysql_select_db($database_shopSQL, $shopSQL);
	$postsinsert = sprintf("INSERT INTO np_posts(post_author,post_date,post_date_gmt,post_title,post_status,comment_status,ping_status,post_password,post_name,post_modified,post_parent,guid,menu_order,post_type,comment_count) VALUES ('1',%s,%s,%s,'wc-processing','closed','closed',%s,%s,%s,'0',%s,0,'shop_order',0)", GetSQLValueString($postdate, "text"), GetSQLValueString($postdate, "text"), GetSQLValueString($posttitle, "text"), GetSQLValueString($postpassword, "text"), GetSQLValueString($postname, "text"), GetSQLValueString($postdate, "text"), GetSQLValueString($postguid, "text"));
	$runinsert = mysql_query($postsinsert, $shopSQL) or die(mysql_error());
	
	
	$getlastinsert = sprintf("SELECT * FROM np_posts ORDER BY `ID` DESC");
	$Recordset = mysql_query($getlastinsert, $shopSQL) or die(mysql_error());
	$grabid = mysql_result($Recordset, 0, 'ID');
	$uppercurrency = strtoupper($tokencurrency);
	$stripefee =  $tokenamount * 0.034 +2.35;
	$netRev = $ordertotal - $stripefee;
	$postmetainsert = sprintf("INSERT INTO np_postmeta (post_id, meta_key, meta_value) VALUES (%s,'_order_currency',%s), (%s,'_prices_include_tax', 'no'), (%s,'_customer_ip_address',%s),(%s,'_customer_user_agent',%s), (%s, '_customer_user','0'),(%s, '_created_via', 'AppCheckout'),(%s,'_order_version','2.0.1'),(%s,'_billing_first_name',%s),(%s, '_billing_last_name', %s), (%s, '_billing_email', %s), (%s, '_billing_phone', %s), (%s, '_billing_country', %s), (%s, '_billing_address_1', %s), (%s, '_billing_city', %s), (%s, '_billing_state', %s),(%s,'_shipping_first_name',%s),(%s, '_shipping_last_name', %s), (%s, '_shipping_country', %s), (%s, '_shipping_address_1', %s), (%s, '_shipping_city', %s), (%s, '_shipping_state', %s), (%s, '_shipping_postcode', %s), (%s, '_billing_postcode', %s), (%s, '_payment_method',%s), (%s, '_payment_method_title',%s), (%s, '_order_total', %s), (%s, 'Stripe Fee', %s), (%s, 'Net Revenue From Stripe', %s), (%s, '_stripe_card_id', %s), (%s, '_store_note', %s), (%s, '_cart_discount', %s),(%s, '_order_shipping','0'),(%s,'_order_tax','0')", GetSQLValueString($grabid, "text"), GetSQLValueString($uppercurrency, "text"), GetSQLValueString($grabid, "text"), GetSQLValueString($grabid, "text"), GetSQLValueString($postip, "text"), GetSQLValueString($grabid, "text"), GetSQLValueString($postagent, "text"), GetSQLValueString($grabid, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokenfirstname, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokenlastname, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokenemail, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokennumber, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingcountry, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingstreet, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingcity, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingstate, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokenfirstname, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokenlastname, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingcountry, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingstreet, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingcity, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingstate, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingpostal, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shippingpostal, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($paymentmethod, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($paymentmethod, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokenamount, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($stripefee, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($netRev, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($token, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($tokendescription, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($shipdiscount, "text"),GetSQLValueString($grabid, "text"),GetSQLValueString($grabid, "text"));
	$runpostmeta = mysql_query($postmetainsert, $shopSQL) or die(mysql_error());
	$k = count($itemsarray);
	$j = 0;
	do {
		$itemnumber = $itemsarray[$j];
		$itemquantity = $itemqtyarray[$j];
		$itemcost = $itemcostarray[$j];
		$itemsubtotal = $itemcost* $itemquantity;
		$getlineitem = sprintf("SELECT * FROM np_posts WHERE ID = %s", GetSQLValueString($itemnumber, "text"));
		$lineitemRecord = mysql_query($getlineitem, $shopSQL) or die(mysql_error());
		$itemname = mysql_result($lineitemRecord, 0, 'post_title');
		
		$postwooorderitems = sprintf("INSERT INTO np_woocommerce_order_items (order_item_name, order_item_type, order_id) VALUES (%s, 'line_item', %s)", GetSQLValueString($itemname, "text"), GetSQLValueString($grabid, "text"));
		$runpostwoo = mysql_query($postwooorderitems, $shopSQL) or die(mysql_error());
		
		$getlastwooinsert = sprintf("SELECT * FROM np_woocommerce_order_items ORDER BY `order_item_id` DESC LIMIT 1");
		$wooinsertRecord = mysql_query($getlastwooinsert, $shopSQL) or die(mysql_error());
		$grab_itemid = mysql_result($wooinsertRecord, 0, 'order_item_id');
		
		$postwooordermeta = sprintf("INSERT INTO np_woocommerce_order_itemmeta (order_item_id, meta_key, meta_value) VALUES (%s,'_qty', %s),(%s,'_tax_class',''),(%s,'_product_id',%s),(%s,'_variation_id','0'),(%s,'_line_subtotal',%s),(%s,'_line_total',%s),(%s,'_line_subtotal_tax','0'),(%s,'_line_tax','0'),(%s,'_line_tax_data','a:2:{s:5:\"total\";a:0:{}s:8:\"subtotal\";a:0:{}}')", GetSQLValueString($grab_itemid, "text"), GetSQLValueString($itemquantity, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($itemnumber, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($itemsubtotal, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($itemsubtotal, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($grab_itemid, "text"), GetSQLValueString($grab_itemid, "text"));
		
		$runpostwoometa = mysql_query($postwooordermeta, $shopSQL) or die(mysql_error());
		$j++;
	} while ($k > $j);
	
	
	mysql_close($shopSQL);
	// Create the charge on Stripe's servers - this will charge the user's card
	    //$save = \Stripe\Customer::create(array(
    	//    "card" => $token,
    	//    "email" => strip_tags(trim($tokenemail))
    	    
	    //));
    $success = $runpostwoometa;
    echo '{"success":'.$success .', "message": "'.$grabid.' , ' .$tokenemail. '"}' ;
	    //echo $success;
?>