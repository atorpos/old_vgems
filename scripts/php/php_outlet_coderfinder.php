<?php require_once('../Connections/external.php'); ?>
<?php require_once('../Connections/stockcode.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
$query_codefinder = sprintf("SELECT * FROM stock WHERE id = '%s'", $name);
$codefinder = mysql_query($query_codefinder, $external) or die(mysql_error());
$row_codefinder = mysql_fetch_assoc($codefinder);
$Rows_codefinder = mysql_num_rows($codefinder);

mysql_select_db($database_stockcode, $stockcode);
$query_prefixfinder = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s' ", $row_codefinder['prefix']);
$prefixfinder = mysql_query($query_prefixfinder, $stockcode) or die(mysql_error());
$row_prefixfinder = mysql_fetch_assoc($prefixfinder);
$Rows_prefixfinder = mysql_num_rows($prefixfinder);

mysql_select_db($database_stockcode, $stockcode);
$query_middlefinder = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_codefinder['middle']);
$middlefinder = mysql_query($query_middlefinder, $stockcode) or die(mysql_error());
$row_middlefinder = mysql_fetch_assoc($middlefinder);
$Rows_middlefinder = mysql_num_rows($middlefinder);
?>
<?php 
	echo $row_codefinder['prefix'].$row_codefinder['middle']."_".$row_codefinder['suffix']. "</td><td>";
	echo " ";
	echo $row_codefinder['suffix'];
	echo " mm ";
	echo $row_prefixfinder['description'];
	echo " ";
	echo $row_middlefinder['description'];

?>

