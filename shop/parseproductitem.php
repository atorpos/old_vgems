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
		public $productname = "";
		public $postdate = "";
		public $productimg = "";
		public $tempcheck = "";
		public $regularprice = "";
		public $saleprice = "";
		public $price = "";
		public $stock = "";
		public $stockrating = "";
		public $productsku = "";
		public $productid ="";
		public $descriptions ="";
		public $weight = "";
		public $length = "";
		public $width = "";
		public $height = "";
		public $reviewcount = "";
		public $reviewrate = "";
		public $quantity = "";
		public $size = "";
		public $stone = "";
		public $guid = "";
		
	}
	$items = new Item();
	$items->productid[] = utf8_encode($postid);
	do {
		switch ($row_recordset['meta_key']) {
			case "_weight":
				$items->weight[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_length":
				$items->length[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_width":
				$items->width[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_height":
				$items->height[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_sku":
				$items->productsku[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_regular_price":
				$items->regularprice[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_sale_price":
				$items->saleprice[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_price":
				$items->price[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_stock":
				$items->stock[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_wc_review_count":
				$items->reviewcount[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "_wc_average_rating":
				$items->reviewrate[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "quantity":
				$items->quantity[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "size":
				$items->size[] = utf8_encode($row_recordset['meta_value']);
				break;
			case "stone":
				$items->stone[] = utf8_encode($row_recordset['meta_value']);
				break;
		}
	} while ($row_recordset = mysql_fetch_assoc($Recordset));
	
	$query_posts = sprintf("SELECT * FROM np_posts WHERE ID=%s", GetSQLValueString($postid, "int"));
	$items->tempcheck[] = utf8_encode($query_posts);
	$postRecordset = mysql_query($query_posts, $shopSQL) or die(mysql_error());
	$row_posts = mysql_fetch_assoc($postRecordset);
	$totalRow_post = mysql_num_rows($postRecordset);
	do {
		$items->descriptions[] = utf8_encode($row_posts['post_excerpt']);
		$items->productname[] = utf8_encode($row_posts['post_title']);
		$items->productcontents[] = utf8_encode($row_posts['post_content']);
		$items->postdate[] = utf8_encode($row_posts['post_date']);
		$items->guid[] = utf8_encode($row_posts['guid']);
	}while ($row_posts = mysql_fetch_assoc($postRecordset));
	
	$query_postr = sprintf("SELECT * FROM np_posts WHERE post_parent=%s AND post_type='attachment'", GetSQLValueString($postid, "int"));
	$postrRecordset = mysql_query($query_postr, $shopSQL) or die(mysql_error());
	$row_postr = mysql_fetch_assoc($postrRecordset);
	$totalRow_postr = mysql_num_rows($postrRecordset);
	do {
		$items->productimg[] = utf8_encode($row_postr['guid']);
	}while ($row_postr = mysql_fetch_assoc($postrRecordset));
	if(empty($stone[0])) {
		$items->stone[] = utf8_encode("Not Defined");
	}
	if(empty($size[0])) {
		$items->size[] = utf8_encode("Not Defined");
	}
	if(empty($quantity[0])) {
		$items->quantity[] = utf8_encode("Not Defined");
	}
	echo json_encode($items);
	mysql_free_result($Recordset);

?>