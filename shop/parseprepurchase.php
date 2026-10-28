<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
	$postid = $_POST['postid'];
	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each
	 * a unique prefix. Only numbers, letters, and underscores please!
	 */
	$table_prefix  = 'np_';
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
	$query_Record = sprintf("SELECT * FROM np_postmeta WHERE post_id=%s", GetSQLValueString($postid, "int"));
	//echo $query_Record;
	$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
	$row_recordset = mysql_fetch_assoc($Recordset);
	$totalRow_Recordset = mysql_num_rows($Recordset);
	//echo $totalRow_Recordset;

	class Item {
		public $guid = "";
		public $postdate = "";
		public $ordercurrency = "";
		public $princtax = "";
		public $shipfirst = "";
		public $shiplast = "";
		public $shipcountry = "";
		public $shipaddress = "";
		public $shipcity = "";
		public $shipstate = "";
		public $shippostal = "";
		public $paymethod = "";
		public $ordertotal = "";
		public $storenote = "";
		public $cartdiscount = "";
		public $subtotal = "";
		public $ordership = "";
		public $ordertax = "";
		public $itemname = "";
		public $lineqty = "";
		public $lineptid = "";
		public $linetotal = "";
		public $linesubtax = "";
		public $linetax = "";
		public $linesubtot = "";
		public $noofproduct = "";
		public $odstatus = "";
	}
	$items = new Item();
	$items->productid[] = utf8_encode($postid);
	$invsubtotal = 0;
	do {
		switch ($row_recordset['meta_key']) {
			case "_order_currency":
				$items->ordercurrency[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_prices_include_tax":
				$items->princtax[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_first_name":
				$items->shipfirst[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_last_name":
				$items->shiplast[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_country":
				$items->shipcountry[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_address_1":
				$items->shipaddress[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_city":
				$items->shipcity[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_state":
				$items->shipstate[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_shipping_postcode":
				$items->shippostal[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_payment_method":
				$items->paymethod[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_order_total":
				$items->ordertotal[] = utf8_encode($row_recordset['meta_value']);
				$temptotal = $row_recordset['meta_value'];
				break;
			case "_store_note":
				$items->storenote[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_cart_discount":
				$items->cartdiscount[] = utf8_encode($row_recordset['meta_value']);
				$tempdisc = $row_recordset['meta_value'];
				break;
			case "_order_shipping":
				$items->ordership[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_order_tax":
				$items->ordertax[] = utf8_encode($row_recordset['meta_value']);
				break;
		}
	} while ($row_recordset = mysql_fetch_assoc($Recordset));
	
	
	$query_posts = sprintf("SELECT * FROM np_posts WHERE ID=%s", GetSQLValueString($postid, "int"));
	$items->tempcheck[] = utf8_encode($query_posts);
	$postRecordset = mysql_query($query_posts, $shopSQL) or die(mysql_error());
	$row_posts = mysql_fetch_assoc($postRecordset);
	$totalRow_post = mysql_num_rows($postRecordset);
	do {
		$items->postdate[] = utf8_encode($row_posts['post_date']);
		$items->guid[] = utf8_encode($row_posts['guid']);
		switch ($row_posts['post_status']) {
			case "wc-on-hold":
				$items->odstatus[] = utf8_encode("Holding");
			break;
			case "wc-processing":
				$items->odstatus[] = utf8_encode("Processing");
			break;
			case "wc-completed":
				$items->odstatus[] = utf8_encode("Completed");
			break;
			
		}
	}while ($row_posts = mysql_fetch_assoc($postRecordset));
	
	$query_postr = sprintf("SELECT * FROM np_woocommerce_order_items WHERE order_id=%s AND `order_item_type` ='line_item'", GetSQLValueString($postid, "int"));
	$postrRecordset = mysql_query($query_postr, $shopSQL) or die(mysql_error());
	$row_postr = mysql_fetch_assoc($postrRecordset);
	$totalRow_postr = mysql_num_rows($postrRecordset);
	do {
		$items->itemname[] = utf8_encode($row_postr['order_item_name']);
		$getorderitemid = $row_postr['order_item_id'];
		
		$query_woo_itemmeta = sprintf("SELECT * FROM np_woocommerce_order_itemmeta WHERE order_item_id=%s", GetSQLValueString($getorderitemid, "int"));
		$postmetaRecordset = mysql_query($query_woo_itemmeta, $shopSQL) or die(mysql_error());
		$row_postmeta = mysql_fetch_assoc($postmetaRecordset);
		$totalRow_postmeta = mysql_num_rows($postmetaRecordset);
		
		do {
			switch ($row_postmeta['meta_key']) {
				case "_qty":
					$items->lineqty[] = utf8_encode($row_postmeta['meta_value']);
					break;
				case "_product_id":
					$items->lineptid[] = utf8_encode($row_postmeta['meta_value']);
					break;
				case "_line_subtotal":
					$items->linesubtot[] = utf8_encode($row_postmeta['meta_value']);
					break;
				case "_line_total":
					$items->linetotal[] = utf8_encode($row_postmeta['meta_value']);
					$invsubtotal = $invsubtotal + $row_postmeta['meta_value'];
					break;
				case "_line_subtotal_tax":
					$items->linesubtax[] = utf8_encode($row_postmeta['meta_value']);
					break;
				case "_line_tax":
					$items->linetax[] = utf8_encode($row_postmeta['meta_value']);
					break;
			}
		}while ($row_postmeta = mysql_fetch_assoc($postmetaRecordset));
	
	}while ($row_postr = mysql_fetch_assoc($postrRecordset));
	$items->noofproduct[] = utf8_encode($totalRow_postr);
	$items->subtotal[] = utf8_encode($invsubtotal);
	if(empty($storenote[0])) {
		$items->storenote[] = utf8_encode("N/A");
	}
	if(empty($ordership[0])) {
		$items->ordership[] = utf8_encode("0");
	}
	if(empty($ordertax[0])) {
		$items->ordertax[] = utf8_encode("0");
	}
	echo json_encode($items);
	mysql_free_result($Recordset);

?>