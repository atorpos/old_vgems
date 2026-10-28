<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
	$postcat = $_GET['catrpost'];
	$postlast = $_GET['lastitem'];
	$postsec = $_GET['secpost'];
	$offsetvalue  = $postlast * 15;
	$itemcount =0;
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
	function GetJSON($fncproductid) {
    	
	}
	mysql_select_db($database_shopSQL, $shopSQL);
	$query_Record = sprintf("SELECT * FROM np_terms WHERE name=%s", GetSQLValueString($postcat, "text"));
	//echo $query_Record;
	$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
	$row_recordset = mysql_fetch_assoc($Recordset);
	$totalRow_Recordset = mysql_num_rows($Recordset);
	//echo $totalRow_Recordset;

	$query_keyword = "SELECT * FROM np_terms";
	$Recordset_keyword = mysql_query($query_keyword, $shopSQL) or die(mysql_error());
	$row_keywork = mysql_fetch_assoc($Recordset_keyword);
	$totalRow_keyword = mysql_num_rows($Recordset_keyword);
	$i = 0;
	do {
		$keywordid[$i] = $row_keywork['term_id'];
		$keywordname[$i] = $row_keywork['name'];
		$i++;
	} while ($row_keywork = mysql_fetch_assoc($Recordset_keyword));
	
	
	class Item {
		public $productname = "";
		public $postcontents = "";
		public $postdate = "";
		public $productimg = "";
		public $keywords = "";
		public $regularprice = "";
		public $saleprice = "";
		public $price = "";
		public $stock = "";
		public $stockrating = "";
		public $productsku = "";
		public $productid ="";
	}
	$items = new Item();
	if ($totalRow_Recordset != 0) {
		do {
			$checkcatid = $row_recordset['term_id'];
			$query_nptermeta = sprintf("SELECT * FROM np_term_taxonomy WHERE term_id=%s AND taxonomy='product_cat'", GetSQLValueString($checkcatid, "int"));
			$metaRecordset = mysql_query($query_nptermeta, $shopSQL) or die(mysql_error());
			$row_metaRecordset = mysql_fetch_assoc($metaRecordset);
			$totalRow_metaRecord = mysql_num_rows($metaRecordset);
			if ($totalRow_metaRecord != 0) {
				do {
					$catid = $row_metaRecordset['term_taxonomy_id'];

					$query_productfound = sprintf("SELECT * FROM np_term_relationships WHERE term_taxonomy_id=%s ORDER BY object_id DESC LIMIT 15 OFFSET %s", GetSQLValueString($catid, "int"), GetSQLValueString($offsetvalue, "int"));
					$metaproductfound = mysql_query($query_productfound, $shopSQL) or die(mysql_error());
					$row_metaproductfound = mysql_fetch_assoc($metaproductfound);
					$totalRow_metaproductfound = mysql_num_rows($metaproductfound);
					if ($totalRow_metaproductfound == 0) {
						echo "no value";
						break;
					} else {
						do {
							if ($postsec == "") {
								$checkproductid = $row_metaproductfound['object_id'];  //grab product id
								//temp check
        							$query_term_taxid = sprintf("SELECT * FROM np_term_relationships WHERE object_id=%s", GetSQLValueString($checkproductid, "int"));
        							$taxidRecordset = mysql_query($query_term_taxid, $shopSQL) or die (mysql_error());
        							$row_taxidfound = mysql_fetch_assoc($taxidRecordset);
        							$totalRow_taxidfound = mysql_num_rows($taxidRecordset);
        							if ($totalRow_taxidfound == 0) {
        								echo'';
        							} else {
        								$keywordresult = '';
        								do {
        									$keyidfound = array_search($row_taxidfound['term_taxonomy_id'], $keywordid);
        									if ($keywordresult == '') {
        										$keywordresult = $keywordname[$keyidfound];
        									} else {
        										$keywordresult = $keywordresult. ', '. $keywordname[$keyidfound];
        									}
        								}while($row_taxidfound = mysql_fetch_assoc($taxidRecordset));
        								$items->keywords[] = utf8_encode($keywordresult);
        							}
        							
        							$query_post = sprintf("SELECT * FROM np_posts WHERE ID= %s AND post_status!='trash'", GetSQLValueString($checkproductid, "int"));
        							$post_Recordset = mysql_query($query_post, $shopSQL) or die(mysql_error());
        							$total_pRecordset = mysql_num_rows($post_Recordset);
        	
        							if ($total_pRecordset) {
        								$row_pRecordset = mysql_fetch_assoc($post_Recordset);
        								$post_title = mysql_result($post_Recordset,0,'post_title');
        								$post_content = mysql_result($post_Recordset, 0, 'post_content');
        								$post_date = mysql_result($post_Recordset, 0, 'post_date');
        								$items->productname[] = utf8_encode($post_title);
        								$items->postcontents[] = utf8_encode($post_content);
        								$items->postdate[] = utf8_encode($post_date);
        							}
        							$items->productid[] = utf8_encode($checkproductid);
        							$query_productmeta = sprintf("SELECT * FROM np_postmeta WHERE post_id=%s", GetSQLValueString($checkproductid, "int"));
        							$productmeta = mysql_query($query_productmeta, $shopSQL) or die(mysql_error());
        							$row_productmeta = mysql_fetch_assoc($productmeta);
        							$totalRow_productmeta = mysql_num_rows($productmeta);
        							if ($totalRow_productmeta != 0) {
        								do{
        									$switch_com = $row_productmeta['meta_key'];
        									switch ($switch_com) {
        										case "_sku": {
        											$items->productsku[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_price": {
        											$items->price[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_stock": {
        											$items->stock[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_regular_price": {
        											$items->regularprice[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_sale_price": {
        											$items->saleprice[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_wc_average_rating": {
        											$items->stockrating[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        									}
        								}while ($row_productmeta = mysql_fetch_assoc($productmeta));
        							}
        							$query_image = sprintf("SELECT * FROM np_posts WHERE post_parent=%s AND post_type='attachment'", GetSQLValueString($checkproductid, "int"));
        							$getiamgeadd = mysql_query($query_image, $shopSQL) or die(mysql_error());
        							$row_getimage = mysql_fetch_assoc($getiamgeadd);
        							$total_getimage = mysql_num_rows($getiamgeadd);
        							if ($total_getimage != 0) {
        								$row_getimage = mysql_fetch_assoc($getiamgeadd);
        								$get_image = mysql_result($getiamgeadd, 0, 'guid');
        								$items->productimg[] = utf8_encode($get_image);
        							} else {
        								$items->productimg[] = "https://www.vigorgems.com/images/bg_cloudquestion.jpg";
        							}
        							$itemcount++;
        							//end temp
							} else {
    							$temcheckprdid = $row_metaproductfound['object_id'];
    							$secondchk = array_search($postsec, $keywordname);  //need to add if array found
    							$secondchkid = $keywordid[$secondchk]; //the id is for refinding products
    							
    							$query_second = sprintf("SELECT * FROM np_term_relationships WHERE object_id=%s AND term_taxonomy_id=%s", GetSQLValueString($temcheckprdid, "int"), GetSQLValueString($secondchkid, "int"));
    							$secondRecordset = mysql_query($query_second, $shopSQL) or die(mysql_error());
    							$row_secondfound = mysql_fetch_assoc($secondRecordset);
    							$totalRow_secfound = mysql_num_rows($secondRecordset);
    							if ($totalRow_secfound != 0) {
        							$checkproductid = $row_metaproductfound['object_id'];
        							//temp check
        							$query_term_taxid = sprintf("SELECT * FROM np_term_relationships WHERE object_id=%s", GetSQLValueString($checkproductid, "int"));
        							$taxidRecordset = mysql_query($query_term_taxid, $shopSQL) or die (mysql_error());
        							$row_taxidfound = mysql_fetch_assoc($taxidRecordset);
        							$totalRow_taxidfound = mysql_num_rows($taxidRecordset);
        							if ($totalRow_taxidfound == 0) {
        								echo'';
        							} else {
        								$keywordresult = '';
        								do {
        									$keyidfound = array_search($row_taxidfound['term_taxonomy_id'], $keywordid);
        									if ($keywordresult == '') {
        										$keywordresult = $keywordname[$keyidfound];
        									} else {
        										$keywordresult = $keywordresult. ', '. $keywordname[$keyidfound];
        									}
        								}while($row_taxidfound = mysql_fetch_assoc($taxidRecordset));
        								$items->keywords[] = utf8_encode($keywordresult);
        							}
        							
        							$query_post = sprintf("SELECT * FROM np_posts WHERE ID= %s", GetSQLValueString($checkproductid, "int"));
        							$post_Recordset = mysql_query($query_post, $shopSQL) or die(mysql_error());
        							$total_pRecordset = mysql_num_rows($post_Recordset);
        	
        							if ($total_pRecordset) {
        								$row_pRecordset = mysql_fetch_assoc($post_Recordset);
        								$post_title = mysql_result($post_Recordset,0,'post_title');
        								$post_content = mysql_result($post_Recordset, 0, 'post_content');
        								$post_date = mysql_result($post_Recordset, 0, 'post_date');
        								$items->productname[] = utf8_encode($post_title);
        								$items->postcontents[] = utf8_encode($post_content);
        								$items->postdate[] = utf8_encode($post_date);
        							}
        							$items->productid[] = utf8_encode($checkproductid);
        							$query_productmeta = sprintf("SELECT * FROM np_postmeta WHERE post_id=%s", GetSQLValueString($checkproductid, "int"));
        							$productmeta = mysql_query($query_productmeta, $shopSQL) or die(mysql_error());
        							$row_productmeta = mysql_fetch_assoc($productmeta);
        							$totalRow_productmeta = mysql_num_rows($productmeta);
        							if ($totalRow_productmeta != 0) {
        								do{
        									$switch_com = $row_productmeta['meta_key'];
        									switch ($switch_com) {
        										case "_sku": {
        											$items->productsku[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_price": {
        											$items->price[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_stock": {
        											$items->stock[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_regular_price": {
        											$items->regularprice[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_sale_price": {
        											$items->saleprice[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        										case "_wc_average_rating": {
        											$items->stockrating[] = utf8_encode($row_productmeta['meta_value']);
        											}
        											break;
        									}
        								}while ($row_productmeta = mysql_fetch_assoc($productmeta));
        							}
        							$query_image = sprintf("SELECT * FROM np_posts WHERE post_parent=%s AND post_type='attachment'", GetSQLValueString($checkproductid, "int"));
        							$getiamgeadd = mysql_query($query_image, $shopSQL) or die(mysql_error());
        							$row_getimage = mysql_fetch_assoc($getiamgeadd);
        							$total_getimage = mysql_num_rows($getiamgeadd);
        							if ($total_getimage != 0) {
        								$row_getimage = mysql_fetch_assoc($getiamgeadd);
        								$get_image = mysql_result($getiamgeadd, 0, 'guid');
        								$items->productimg[] = utf8_encode($get_image);
        							} else {
        								$items->productimg[] = "";
        							}
        							$itemcount ++;
        							//end temp
    							}else {
        							
    							}
								
							}
							  
							
							

						}while ($row_metaproductfound = mysql_fetch_assoc($metaproductfound));
					}
				} while ($row_metaRecordset = mysql_fetch_assoc($metaRecordset));
			}

		} while ($row_recordset = mysql_fetch_assoc($Recordset));
	}
	//echo $itemcount;
	if ($itemcount != 0) {
		echo json_encode($items);
	}else {
    	//echo "no value";
	}

	mysql_free_result($Recordset);

?>