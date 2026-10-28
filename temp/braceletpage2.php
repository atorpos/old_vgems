<?php require_once('../Connections/stockcode.php');
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

$maxRows_Bracelet = 50;
$pageNum_Bracelet = 1;
if (isset($_GET['pageNum_Bracelet'])) {
  $pageNum_Bracelet = $_GET['pageNum_Bracelet'];
}
$startRow_Bracelet = $pageNum_Bracelet * $maxRows_Bracelet;

mysql_select_db($database_stockcode, $stockcode);
$query_Bracelet = "SELECT code,`id`, `description` FROM prefixcode WHERE `type` = '4' AND  `active` ='1' ORDER BY code ASC";
$query_limit_Bracelet = sprintf("%s LIMIT %d, %d", $query_Bracelet, $startRow_Bracelet, $maxRows_Bracelet);
$Bracelet = mysql_query($query_limit_Bracelet, $stockcode) or die(mysql_error());
$row_Bracelet = mysql_fetch_assoc($Bracelet);

if (isset($_GET['totalRows_Bracelet'])) {
  $totalRows_Bracelet = $_GET['totalRows_Bracelet'];
} else {
  $all_Bracelet = mysql_query($query_Bracelet);
  $totalRows_Bracelet = mysql_num_rows($all_Bracelet);
}
$totalPages_Bracelet = ceil($totalRows_Bracelet/$maxRows_Bracelet)-1;

function getcol() {
 	$coltable = "col". rand(1,5);
 	return $coltable;
 	}
do {
	echo "<div class=\"box ". getcol() ."\"><p>";
	echo "<a href=\"/detail/index.php?id=". $row_Bracelet['id']."\" title=\"".$row_Bracelet['description']. "\"><img src=\"/images/products/". strtolower($row_Bracelet['code']).".jpg\" alt=\"".$row_Bracelet['description']."\" /></a></p>";
	echo "<p>Product code:". $row_Bracelet['code'];
	echo "</p></div>";
	} while ($row_Bracelet = mysql_fetch_assoc($Bracelet));
	mysql_free_result($Bracelet);
?>
