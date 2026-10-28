<?php require_once('../../Connections/AppDB.php'); ?>
<?php
header('content-type: application/json; charset=utf-8');
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

$colname_selecteditems = "-1";
if (isset($_GET['SKU'])) {
  $colname_selecteditems = $_GET['SKU'];
}
mysql_select_db($database_AppDB, $AppDB);
$query_selecteditems = sprintf("SELECT * FROM Products WHERE SKU = %s", GetSQLValueString($colname_selecteditems, "int"));
$selecteditems = mysql_query($query_selecteditems, $AppDB) or die(mysql_error());
$row_selecteditems = mysql_fetch_assoc($selecteditems);
$totalRows_selecteditems = mysql_num_rows($selecteditems);
class Item {
	  public $productID = "";
	  public $SKU = "";
	  public $productname = "";
	  
	  public $description = "";
	  public $instock ="";
	  public $price="";
	  public $unit="";
	  public $dimension = "";
  }
  $items = new Item();
do { 
    $TheproductID =  $row_selecteditems['productID'];
    $items->productID[] = utf8_encode($TheproductID);
    $TheSKU =  $row_selecteditems['SKU'];
    $items->SKU[] = utf8_encode($TheSKU);
    $Theproductname =  $row_selecteditems['productname'];
    $items->productname[] = utf8_encode($Theproductname);
    $Thedescription =  $row_selecteditems['description'];
    $items->description[]= utf8_encode($Thedesceription);
    $Thestock =  $row_selecteditems['instock'];
    $items->instock[]= utf8_encode($Thestock);
    $Theprice =  $row_selecteditems['price'];
    $items->price[]= utf8_encode($ThePrice);
    $Theunit =  $row_selecteditems['unit'];
    $items->unit[]= utf8_encode($Theunit);
    $Thedimension =  $row_selecteditems['dimension'];
    $items->dimension[]= utf8_encode($Thedimension);
    } while ($row_selecteditems = mysql_fetch_assoc($selecteditems));
    echo json_encode($items);
    
    mysql_free_result($selecteditems);
?>
