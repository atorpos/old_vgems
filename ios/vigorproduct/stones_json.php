<?php require_once('../../Connections/stockcode.php'); ?>
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

mysql_select_db($database_stockcode, $stockcode);
$query_stonelist = "SELECT name, `description` FROM stonename ORDER BY description ASC";
$stonelist = mysql_query($query_stonelist, $stockcode) or die(mysql_error());
$row_stonelist = mysql_fetch_assoc($stonelist);
$totalRows_stonelist = mysql_num_rows($stonelist);

class Item {
	public $stoneid = "";
	public $stonename = "";
}
$items = new Item();
 do {
	 $thestoneid = $row_stonelist['name'];
	 $items->stoneid[] = utf8_encode($thestoneid);
	 $thestonename = $row_stonelist['description'];
	 $items->stonename[] = utf8_encode($thestonename);
 } while ($row_stonelist = mysql_fetch_assoc($stonelist));
 echo json_encode($items);

mysql_free_result($stonelist);
?>
