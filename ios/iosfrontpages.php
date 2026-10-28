<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/Miscsetting.php';
	$getrole = $_GET['rr'];
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
	}if ($getrole != "FFFFFFFFFFFFFF"){
	mysql_select_db($database_Miscsetting, $Miscsetting);
	$query_Recordset2 = "SELECT * FROM productinfo WHERE inactive = 0 ORDER BY pid DESC LIMIT 20";
	$Recordset2 = mysql_query($query_Recordset2, $Miscsetting) or die(mysql_error());
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
		//public $productQR = "";
		//public $productimg = "";
	}
	$items = new Item();
	
	do {
		$theproductname = $row_Recordset2['productname'];
		$theproductsku = $row_Recordset2['sku'];
		$theproducttyp = $row_Recordset2['cataegory'];
		
		$items->productname[] = utf8_encode($theproductname);
		$items->sku[] = utf8_encode($theproductsku);
		$items->producttype[] = utf8_encode($theproducttyp);
		//$items->productimg[] = utf8_encode($Theproductimg);
		
	} while($row_Recordset2= mysql_fetch_assoc($Recordset2));
	echo json_encode($items);
	
	mysql_free_result($Recordset2);
	//mysql_free_result($Recordset3);
	} else {
		
	}
?>