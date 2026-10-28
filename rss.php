<?php require_once('Connections/external.php'); ?>
<?php require_once('Connections/stockcode.php'); ?>
<?php 
	date_default_timezone_set('UTC');
	header("Content-Type: text/xml");
    //    The header line forces XML format to the browser
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
	echo "<rss version=\"2.0\">\n";
	echo "<channel>\n";
	echo "<title>Vigor Gems' Latest Products</title>\n";
	echo "<link>http://www.vigorgems.com/</link>\n";
	echo "<description>Our latest Products feed</description>\n";
	echo "<language>en-us</language>\n";
	echo "<pubDate>" .date(DATE_RFC822). "</pubDate>\n";
	echo "<lastBuildDate>" .date(DATE_RFC822). "</lastBuildDate>\n";
	echo "<docs>http://cyber.law.harvard.edu/rss</docs>\n";
	echo "<generator>PHP 5.0</generator>\n";
	echo "<managingEditor>atropos@altawoz.com</managingEditor>\n";
	echo "<webMaster>atropos@vigorgems.com</webMaster>\n";
	echo "<ttl>5</ttl>\n";
?>
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

$maxRows_latestitem = 10;
$pageNum_latestitem = 0;
if (isset($_GET['pageNum_latestitem'])) {
  $pageNum_latestitem = $_GET['pageNum_latestitem'];
}
$startRow_latestitem = $pageNum_latestitem * $maxRows_latestitem;

mysql_select_db($database_external, $external);
$query_latestitem = "SELECT id, `prefix`, middle, suffix, `description`, stocktype, imageloc, dateofadd FROM stock ORDER BY dateofadd DESC";
$query_limit_latestitem = sprintf("%s LIMIT %d, %d", $query_latestitem, $startRow_latestitem, $maxRows_latestitem);
$latestitem = mysql_query($query_limit_latestitem, $external) or die(mysql_error());
$row_latestitem = mysql_fetch_assoc($latestitem);

if (isset($_GET['totalRows_latestitem'])) {
  $totalRows_latestitem = $_GET['totalRows_latestitem'];
} else {
  $all_latestitem = mysql_query($query_latestitem);
  $totalRows_latestitem = mysql_num_rows($all_latestitem);
}
$totalPages_latestitem = ceil($totalRows_latestitem/$maxRows_latestitem)-1;


do { 
	mysql_select_db($database_stockcode, $stockcode);
	$query_producttype = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_latestitem['prefix']);
	$producttype = mysql_query($query_producttype, $stockcode) or die(mysql_error());
	$row_producttype = mysql_fetch_assoc($producttype);
	$totalRows_producttype = mysql_num_rows($producttype);
	
	mysql_select_db($database_stockcode, $stockcode);
	$query_stonename = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_latestitem['middle']);
	$stonename = mysql_query($query_stonename, $stockcode) or die(mysql_error());
	$row_stonename = mysql_fetch_assoc($stonename);
	$totalRows_stonename = mysql_num_rows($stonename);
	echo "<item>\n";
    echo "<title>" . $row_latestitem['suffix']. " mm ".$row_producttype['description']. " " .$row_stonename['description']  ;
	echo $row_latestitem['name']. "</title>\n"; 
	echo "<link>http://www.vigorgems.com/detail/product.php?id=" .$row_latestitem['id']. "</link>";
	echo "<description>&lt;p&gt;Code: ";
	print $row_latestitem['prefix']. $row_latestitem['middle']. $row_latestitem['suffix']; 
	print"&lt;/p&gt;&lt;p&gt; Description: ";
	print $row_latestitem['description'];
	print "&lt;p&gt;&lt;img height=\"300\" width=\"300\" alt=\"";
	print $row_latestitem['suffix']. " mm ".$row_producttype['description']. " " .$row_stonename['description']. "\" src=\"images/products/" .strtolower($row_latestitem['prefix']). strtolower($row_latestitem['middle']). ".jpg\"/&gt;&lt;/p&gt;";
	print "&lt;/p&gt;</description>\n";
	echo "<pubDate>" .date('r', strtotime($row_latestitem['dateofadd'])). "</pubDate>\n";
	echo "<guid>http://www.vigorgems.com/detail/product.php?id=" .$row_latestitem['id']. "</guid>\n";
	echo "</item>\n";
} while ($row_latestitem = mysql_fetch_assoc($latestitem));

	echo "</channel>\n";
	echo "</rss>\n";
mysql_free_result($latestitem);
?>

