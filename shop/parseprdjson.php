<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
	$postcat = $_POST['catrpost'];
	$offsetvalue  = $postlast * 20;
	$itemcount =0;
	$postarray = explode(',', $postcat);
	$noofitem = count($postarray);
	
	//echo $postcat;
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
	class Item {
		public $productname = "";
		public $postcontents = "";
		public $postdate = "";
		public $productimg = "";
		public $productid ="";
		public $productsku = "";
		public $regularprice ="";
		public $saleprice = "";
		public $price = "";
		public $stock = "";
	
	}
	$items = new Item();
	if ($noofitem != 0) {
		$k = 0;
		mysql_select_db($database_shopSQL, $shopSQL);
		for ($i=0;$i<$noofitem;$i++) {
			$query_Record = sprintf("SELECT * FROM np_term_relationships WHERE term_taxonomy_id = %s", GetSQLValueString($postarray[$i], "int"));
			$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
			$row_recordset = mysql_fetch_assoc($Recordset);
			$totalRow_Recordset = mysql_num_rows($Recordset);
			do {
				$objectid_found = $row_recordset['object_id'];
				if (in_array($objectid_found, $objectidarray)) {
						
				} else {
					$objectidarray[$k] = $row_recordset['object_id'];
				$k++;
				}
			}while ($row_recordset = mysql_fetch_assoc($Recordset));
		}
	}
	//echo '<pre>';
	//print_r($objectidarray);
	//echo '</pre>';
	for ($j=0;$j<$k;$j++) {
		$query_recordproduct = sprintf("SELECT * FROM np_posts WHERE ID = %s", GetSQLValueString($objectidarray[$j], "int"));
		$Recordsetproduct = mysql_query($query_recordproduct, $shopSQL) or die(mysql_error());
		$row_recordsetproduct = mysql_fetch_array($Recordsetproduct);
		$totalRow_Recordsetproduct = mysql_num_rows($Recordsetproduct);
		do {
			$query_recordpdimg = sprintf("SELECT * FROM np_posts WHERE post_parent = %s AND post_type = 'attachment'", GetSQLValueString($objectidarray[$j], "int"));
			$Recordsetpdimg = mysql_query($query_recordpdimg, $shopSQL) or die(mysql_error());
			$row_recordsetpdimg = mysql_fetch_array($Recordsetpdimg);
			$totalRow_Recordsetpdimg = mysql_num_rows($Recordsetpdimg);
			if ($totalRow_Recordsetpdimg != 0) {
				$get_image = mysql_result($Recordsetpdimg, 0, 'guid');
				$get_sku = mysql_result($Recordsetpdimg, 0, 'post_title');
			} else {
				$get_image = 'dummy.png';
			}
			$query_recordmeta = sprintf("SELECT * FROM np_postmeta WHERE post_id=%s", GetSQLValueString($objectidarray[$j], "int"));
			$Recordsetmeta = mysql_query($query_recordmeta, $shopSQL) or die(mysql_error());
			$row_recordsetmeta = mysql_fetch_array($Recordsetmeta);
			$totalRow_Recordsetmeta = mysql_num_rows($Recordsetmeta);
			
			$items->productsku[] = utf8_encode($get_sku);
			$items->productname[] = utf8_encode($row_recordsetproduct['post_title']);
			$items->postcontents[] = utf8_encode($row_recordsetproduct['post_content']);
			$items->postdate[] = utf8_encode($row_recordsetproduct['post_date']);
			$items->productimg[] = utf8_encode($get_image);
			$items->productid[] = utf8_encode($row_recordsetproduct['ID']);
			$itemcount ++;
			//echo $row_recordsetproduct['post_title'] . ' ' .$get_image;
		} while ($row_recordsetproduct = mysql_fetch_assoc($Recordsetproduct));
		
		do {
				if($row_recordsetmeta['meta_key'] == "_regular_price") {
					$items->regularprice[] = utf8_encode($row_recordsetmeta['meta_value']);
				} else if ($row_recordsetmeta['meta_key'] == "_sale_price") {
					$items->saleprice[] = utf8_encode($row_recordsetmeta['meta_value']);
				} else if ($row_recordsetmeta['meta_key'] == "_price") {
					$items->price[] = utf8_encode($row_recordsetmeta['meta_value']);
				} else if ($row_recordsetmeta['meta_key'] == "_stock") {
					$items->stock[] = utf8_encode($row_recordsetmeta['meta_value']);
				}
					
			} while ($row_recordsetmeta = mysql_fetch_assoc($Recordsetmeta));

		//echo $query_recordproduct;
	}
	//print_r($items);
	if ($itemcount != 0) {
		echo json_encode($items);
	}else {
    	echo "no value";
	}
?>