<?php require_once('../../Connections/external.php'); ?>
<?php require_once('../../Connections/stockcode.php'); ?>
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

mysql_select_db($database_external, $external);
$query_stockfiles = "SELECT id, `prefix`, middle, suffix, name, `description`, stocktype, unitofmeasure, stock, imageloc, outlet, onpage, dateofadd, producttype FROM stock ORDER BY id DESC";
$stockfiles = mysql_query($query_stockfiles, $external) or die(mysql_error());
$row_stockfiles = mysql_fetch_assoc($stockfiles);
$totalRows_stockfiles = mysql_num_rows($stockfiles);
?>
 <?php 
 	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	echo "<products>\n";
	do { 
		mysql_select_db($database_stockcode, $stockcode);
		$query_producttype = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_stockfiles['prefix']);
		$producttype = mysql_query($query_producttype, $stockcode) or die(mysql_error());
		$row_producttype = mysql_fetch_assoc($producttype);
		$totalRows_producttype = mysql_num_rows($producttype);
		
		mysql_select_db($database_stockcode, $stockcode);
		$query_stonename = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_stockfiles['middle']);
		$stonename = mysql_query($query_stonename, $stockcode) or die(mysql_error());
		$row_stonename = mysql_fetch_assoc($stonename);
		$totalRows_stonename = mysql_num_rows($stonename);
		
		mysql_select_db($database_stockcode, $stockcode);
		$query_stocktype = sprintf("SELECT id,  `type` FROM stocktype WHERE id = '%s'", $row_stockfiles['producttype']);
		$stocktype = mysql_query($query_stocktype, $stockcode) or die(mysql_error());
		$row_stocktype = mysql_fetch_assoc($stocktype);
		$totalRows_stocktype = mysql_num_rows($stocktype);
?>
      <?php echo "<product>\n"; ?> 
      <?php echo "<productid>". $row_stockfiles['id']. "</productid>\n"; ?>
      <?php echo "<productcode>". $row_stockfiles['prefix']. $row_stockfiles['middle']. "_". $row_stockfiles['suffix']. "</productcode>\n"; ?>
      <?php echo "<productname>".$row_producttype['description']. " " .$row_stonename['description']. " " .$row_stockfiles['suffix']. "</productname>\n"; ?>
      <?php echo "<productdescription>". $row_stockfiles['description']. "</productdescription>\n"; ?>
      <?php echo "<producttype>". $row_stocktype['type']. "</producttype>\n"; ?>
      <?php echo "<productmeasure>". $row_stockfiles['unitofmeasure']. "</productmeasure>\n"; ?>
      <?php echo "<productstock>". $row_stockfiles['stock']. "</productstock>\n"; ?>
      <?php echo "<productimage>/images/products/" .strtolower($row_stonefiles['prefix']) .strtolower($row_stonefiles['middle']). ".jpg</productimage>\n"; ?>
      <?php 
	 	switch ($row_stockfiles['outlet']) {
			case 0:
				$onoutlet = "no";
				break;
			case 1:
				$onoutlet = "yes";
				break;	
			
		}
	  	echo "<productoutlet>". $onoutlet. "</productoutlet>\n"; 
	  ?>
      <?php //echo $row_stockfiles['onpage']; ?>
      <?php echo "<productdate>". $row_stockfiles['dateofadd']. "</productdate>\n"; ?>
      <?php echo "</product>\n"; ?>
<?php 

	} while ($row_stockfiles = mysql_fetch_assoc($stockfiles)); 
echo "</products>\n";
	
?>

<?php
mysql_free_result($stockfiles);

mysql_free_result($producttype);
mysql_free_result($stocktype);
mysql_free_result($stonename);

?>
