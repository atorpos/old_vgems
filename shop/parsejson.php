<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
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
	$query_Record = sprintf("SELECT * FROM np_posts WHERE post_type='product' AND post_status='publish'");
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
	}
	$items = new Item();
	do {
		$items->productname[] = utf8_encode($row_recordset['post_title']);
		$items->postdate[] = utf8_encode($row_recordset['post_date']);
		$pirmaryid = $row_recordset['ID'];
		$queryparent = sprintf("SELECT * FROM np_posts WHERE post_parent = %s AND post_type = 'attachment' AND post_mime_type='image/jpeg' LIMIT 1", GetSQLValueString($pirmaryid, "int"));

		$attachmentset = mysql_query($queryparent, $shopSQL) or die(mysql_error());
		$row_attachment = mysql_fetch_assoc($attachmentset);
		$attach_found = mysql_num_rows($attachmentset);

		if($attach_found) {
			$attachedimage = mysql_result($attachmentset, 0, 'guid');
			$items->productimg[] = utf8_encode($attachedimage);
		} else {
			$items->productimg[] = utf8_encode("dummy.png");
		}
		mysql_free_result($attachmentset);
		$query_pricemeta = sprintf("SELECT * FROM np_postmeta WHERE post_id=%s", GetSQLValueString($pirmaryid, "int"));
		$items->tempcheck[] = utf8_decode($query_pricemeta);
		$pricemetaset = mysql_query($query_pricemeta, $shopSQL) or die(mysql_error());
		$pricemeta_found = mysql_num_rows($pricemetaset);
		$row_pricemeta = mysql_fetch_assoc($pricemetaset);
		do {
			switch($row_pricemeta['meta_key']) {
				case "_regular_price":
				$items->regularprice[] = utf8_encode($row_pricemeta['meta_value']);
				break;
				case "_sale_price":
				$items->saleprice[] = utf8_encode($row_pricemeta['meta_value']);
				break;
				case "_price":
				$items->price[] = utf8_encode($row_pricemeta['meta_value']);
				break;
				case "_stock":
				$items->stock[] = utf8_encode($row_pricemeta['meta_value']);
				break;
			}
		}while($row_pricemeta = mysql_fetch_assoc($pricemetaset));

		$querycomment = sprintf("SELECT * FROM np_comments WHERE comment_post_ID = %s AND comment_approved = '1'", GetSQLValueString($pirmaryid, "int"));
		$commentset = mysql_query($querycomment, $shopSQL) or die(mysql_error());
		$row_comment = mysql_fetch_assoc($commentset);
		$comment_found = mysql_num_rows($commentset);
		$avgrating = 0;
		$totalrating = 0;
		$i = 0;
		if($comment_found) {
			do {
				$queryrating = sprintf("SELECT * FROM np_commentmeta WHERE comment_id=%s AND meta_key='rating'", GetSQLValueString($row_comment['comment_ID'], "int"));
				$ratingset = mysql_query($queryrating, $shopSQL) or die(mysql_error());
				$row_rating = mysql_fetch_assoc($ratingset);
				$rating_found = mysql_num_rows($ratingset);
				if ($rating_found) {
					do {
						$totalrating = $totalrating + $row_rating['meta_value'];
						$i++;
					}while ($row_rating = mysql_fetch_assoc($ratingset));
				}
				
				
			}while($row_comment = mysql_fetch_assoc($commentset));
		}
		$avgrating = $totalrating/$i;
		$items->stockrating[] = utf8_encode($avgrating);

	} while ($row_recordset = mysql_fetch_assoc($Recordset));
	echo json_encode($items);
	mysql_free_result($Recordset);

?>