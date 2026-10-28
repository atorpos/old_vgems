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
$indexfile = "stone.xml";
$fh = fopen($indexfile, 'w') or die("can't open file");
mysql_select_db($database_stockcode, $stockcode);
$query_stonename = "SELECT name, `description` FROM stonename ORDER BY name ASC";
$stonename = mysql_query($query_stonename, $stockcode) or die(mysql_error());
$row_stonename = mysql_fetch_assoc($stonename);
$totalRows_stonename = mysql_num_rows($stonename);
?>

  <?php 
  	 //    The header line forces XML format to the browser
	
	fwrite($fh, "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n");
	
	fwrite($fh, "<stones>\n");
	do { 
    	fwrite($fh, "<stone>\n");
    	fwrite($fh, "		<name>" .$row_stonename['name']. "</name>\n");
    	fwrite($fh, "       <description>" .$row_stonename['description']. "</description>\n");
    	fwrite($fh, "		<image>/images/stone/" .strtolower($row_stonename['name']).  ".gif</image>\n");
		fwrite($fh, "</stone>\n");
	} while ($row_stonename = mysql_fetch_assoc($stonename));
	fwrite($fh, "</stones>\n");
	
	?>
<?php
mysql_free_result($stonename);
?>
