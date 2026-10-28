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

mysql_select_db($database_stockcode, $stockcode);
$query_Stonetype = "SELECT code, `description` FROM prefixcode ORDER BY code ASC";
$Stonetype = mysql_query($query_Stonetype, $stockcode) or die(mysql_error());
$row_Stonetype = mysql_fetch_assoc($Stonetype);
$totalRows_Stonetype = mysql_num_rows($Stonetype);
?>
<? header("Content-Type: text/xml");
    //    The header line forces XML format to the browser
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
	echo "<items>\n";
	 do {
	echo "<item>\n";
	echo "<productcode>" .$row_Stonetype['code']. "</productcode>\n";
	echo "<description>" .$row_Stonetype['description']. "</description>\n";
	echo "</item>\n";
	} while ($row_Stonetype = mysql_fetch_assoc($Stonetype));
	echo "</items>\n";
	mysql_free_result($Stonetype);
?>

