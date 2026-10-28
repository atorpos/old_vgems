<?php require_once('../../Connections/external.php'); ?>
<?php require_once('../../Connections/stockcode.php');?>
<?php header('content-type: application/json; charset=utf-8');?>
<?php
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

mysql_select_db($database_stockcode, $stockcode);
$query_Bracelet = sprintf("SELECT * FROM prefixcode WHERE `type` = '01' AND `active` ='1' ORDER BY code ASC");
$Bracelet = mysql_query($query_Bracelet, $stockcode) or die(mysql_error());
$row_Bracelet = mysql_fetch_assoc($Bracelet);
$totalRows_Bracelet = mysql_num_rows($Bracelet);
?>

  <?php 
  class Item {
	  public $productID = "";
	  public $SKU = "";
	  public $productname = "";
	  //public $producttype = "";
	  //public $description = "";
	  //public $instock ="";
	  //public $price="";
	  //public $unit="";
	  //public $dimension = "";
  }
  $items = new Item();
  do {
    	$TheproductID = $row_Bracelet['code'];
    	$items->productID[] = utf8_encode($TheproductID);
    	$TheSKU = $row_Bracelet['id'];
    	$items->SKU[] = utf8_encode($TheSKU);
    	$TheproductName = $row_Bracelet['description'];
    	$items->productname[]= utf8_encode($TheproductName);
    	//$Theproducttype = $row_Bracelet['producttype'];
    	//$items->producttype[]= utf8_encode($Theproducttype);
    	//$Thedesceription = $row_Bracelet['description'];
    	//$items->description[]= utf8_encode($Thedesceription);
    	//$Thestock = $row_Bracelet['instock'];
    	//$items->instock[]= utf8_encode($Thestock);
    	//$ThePrice = $row_Bracelet['price'];
    	//$items->price[]= utf8_encode($ThePrice);
    	//$Theunit = $row_Bracelet['unit'];
    	//$items->unit[]= utf8_encode($Theunit);
    	//$Thedimension = $row_Bracelet['dimension'];
    	//$items->dimension[]= utf8_encode($Thedimension);
    	
    } while ($row_Bracelet = mysql_fetch_assoc($Bracelet));
    echo json_encode($items);
?>
<?php
mysql_free_result($Bracelet);
?>
