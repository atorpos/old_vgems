<?php
	//for general serach database
	header('Content-type: application/json; charset=utf-8');
	$hostname_OfficeSQL = "118.142.99.234";
	$database_OfficeSQL = "demoproduct";
	$username_OfficeSQL = "vigorDB";
	$password_OfficeSQL = "Simeon1st";
	$OfficeSQL = mysql_pconnect($hostname_OfficeSQL, $username_OfficeSQL, $password_OfficeSQL) or trigger_error(mysql_error($this->db_link),E_USER_ERROR);

	//require_once '../../Connections/VGOfficeAM.php';
	mysql_select_db($database_OfficeSQL, $OfficeSQL);
	$query_Recordset2 = "SELECT * FROM productinfo WHERE inactive = 0 ORDER BY pid DESC LIMIT 100";
	$Recordset2 = mysql_query($query_Recordset2, $OfficeSQL) or die(mysql_error($this->db_link));

	$row_Recordset2 = mysql_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysql_num_rows($Recordset2);


	class Item {
		public $productname = "";
		public $sku = "";
		public $producttype ="";
		//public $shape = "";
		//public $norf = "";
		//public $sbygram = "";
		//public $productcompname = "";
		public $productQR = "";
		public $productimg = "";
		public $orgprice = "";
		public $produnit = "";
	}
	$items = new Item();

	do {
		$psku = $row_Recordset2['sku'];
		$items->sku[] = $psku;
		$theproducttype = $row_Recordset2['cataegory'];
		$Theproductname = $row_Recordset2['productname'];
		$items->productname[] = utf8_encode($Theproductname);
		$items->producttype[] = utf8_encode($theproducttype);
		$TheproductQR = "http://hydagems.info/vinternal/contents/QRimgs/final".md5($psku).".png";
		$items->productQR[] = utf8_encode($TheproductQR);
		if($row_Recordset2['price'] == NULL) {
			$theprice = "0.00";
		} else {
			$theprice = $row_Recordset2['price'];
		}
		$items->produnit[] = $row_Recordset2['unit'];
		$items->orgprice[] = number_format($theprice, 2, '.', '');
		$Theproductimg = $row_Recordset2['proimg'];
		if ($Theproductimg == NULL) {
			$Theproductimg = "http://hydagems.info/vinternal/contents/products/dummyproduct.png";
		} else {
			$Theproductimg = "http://hydagems.info/vinternal/contents/products/" .$Theproductimg;
		}
		$items->productimg[] = utf8_encode($Theproductimg);

	} while($row_Recordset2= mysql_fetch_assoc($Recordset2));
	echo json_encode($items);

	mysql_free_result($Recordset2);

	//mysql_free_result($Recordset3);
?>