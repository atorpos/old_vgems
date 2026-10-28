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
$query_prefixml = "SELECT id, code, `description`, type, specification, longdesc, shipping FROM prefixcode WHERE active = 1 ORDER BY id DESC";
$prefixml = mysql_query($query_prefixml, $stockcode) or die(mysql_error());
$row_prefixml = mysql_fetch_assoc($prefixml);
$totalRows_prefixml = mysql_num_rows($prefixml);

	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<products>\n";
 do { 
 	echo "<product>\n<id>";
    echo $row_prefixml['id']; 
	echo "</id>\n<code>";
    echo $row_prefixml['code'];
	echo "</code>\n<name>";
    echo $row_prefixml['description'];
	echo "</name>\n<type>";
    echo $row_prefixml['type'];
	echo "</type>\n<spec>";
    echo $row_prefixml['specification'];
	echo "</spec>\n<longdes>";
    echo $row_prefixml['longdesc'];
	echo "</longdes>\n<imgloc>";
	echo "http://web.me.com/atorpos/images/products/tb_" .strtolower($row_prefixml['code']). ".gif</imgloc>\n<shipping>";
    echo $row_prefixml['shipping'];
	echo "</shipping>\n</product>\n";
} while ($row_prefixml = mysql_fetch_assoc($prefixml)); 
echo "</products>\n";
	 
	mysql_free_result($prefixml);
	 ?>