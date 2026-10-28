<?php require_once('Connections/external.php'); ?>
<?php require_once('Connections/stockcode.php'); ?>
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
$indexfile = "scripts/xml/productlist.xml";
$fh = fopen($indexfile, 'w') or die("can't open file");
mysql_select_db($database_external, $external);
$query_stonelist = "SELECT id, `prefix`, middle, suffix, stocktype, stock, imageloc, price, outlet FROM stock ORDER BY id DESC";
$stonelist = mysql_query($query_stonelist, $external) or die(mysql_error());
$row_stonelist = mysql_fetch_assoc($stonelist);
$totalRows_stonelist = mysql_num_rows($stonelist);
?>
<?php 
    //    The header line forces XML format to the browser
	
	fwrite($fh, "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n");
	
	fwrite($fh, "<products>\n");
	do { 
		
	mysql_select_db($database_stockcode, $stockcode);
	$query_producttype = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_stonelist['prefix']);
	$producttype = mysql_query($query_producttype, $stockcode) or die(mysql_error());
	$row_producttype = mysql_fetch_assoc($producttype);
	$totalRows_producttype = mysql_num_rows($producttype);
	
	mysql_select_db($database_stockcode, $stockcode);
	$query_stonename = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_stonelist['middle']);
	$stonename = mysql_query($query_stonename, $stockcode) or die(mysql_error());
	$row_stonename = mysql_fetch_assoc($stonename);
	$totalRows_stonename = mysql_num_rows($stonename);

		
		fwrite($fh, "<product>\n");
		
		fwrite($fh, "		<productsearch>" .$row_producttype['description']. " " .$row_stonename['description']. " " .$row_stonelist['suffix']. "</productsearch>\n");
		
		fwrite($fh, "		<productlink>http://www.vigorgems.com/detail/product.php?id=" .$row_stonelist['id']. "</productlink>\n");
		
		fwrite($fh, "		<productid>" .$row_stonelist['id']. "</productid>\n");
		
		fwrite($fh, "		<productcode>" .$row_stonelist['prefix'] .$row_stonelist['middle']. "_" .$row_stonelist['suffix']. "</productcode>\n");
		
		fwrite($fh, "		<producttype>" .$row_producttype['description']. "</producttype>\n");
		
		fwrite($fh, "		<productstonename>" .$row_stonename['description']. "</productstonename>\n");
		
		fwrite($fh, "		<productstocktype>" .$row_stonelist['stocktype']. "</productstocktype>\n");
		
		fwrite($fh, "		<productstock>" .$row_stonelist['stock']. "</productstock>\n");
		
		fwrite($fh, "		<productimage>../../images/products/" .strtolower($row_stonelist['prefix']) .strtolower($row_stonelist['middle']). ".jpg</productimage>\n");
		
		fwrite($fh, "		<productprice>" .$row_stonelist['price']. "</productprice>\n");
		
		fwrite($fh, "		<productoutlet>" .$row_stonelist['outlet']. "</productoutlet>\n");
		
		fwrite($fh, "</product>\n");
	} while ($row_stonelist = mysql_fetch_assoc($stonelist));
	
	fwrite($fh, "</products>\n");
	mysql_free_result($stonelist);

mysql_free_result($producttype);

mysql_free_result($stonename);
fclose($fh);
?>
