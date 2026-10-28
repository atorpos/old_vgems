<?php require_once('../Connections/external.php'); ?>
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

$maxRows_getprevinvoice = 10;
$pageNum_getprevinvoice = 0;
if (isset($_GET['pageNum_getprevinvoice'])) {
  $pageNum_getprevinvoice = $_GET['pageNum_getprevinvoice'];
}
$startRow_getprevinvoice = $pageNum_getprevinvoice * $maxRows_getprevinvoice;

mysql_select_db($database_external, $external);
$query_getprevinvoice = "SELECT type, invoiceid FROM webinvoice WHERE type = 'W' ORDER BY type DESC";
$query_limit_getprevinvoice = sprintf("%s LIMIT %d, %d", $query_getprevinvoice, $startRow_getprevinvoice, $maxRows_getprevinvoice);
$getprevinvoice = mysql_query($query_limit_getprevinvoice, $external) or die(mysql_error());
$row_getprevinvoice = mysql_fetch_assoc($getprevinvoice);

if (isset($_GET['totalRows_getprevinvoice'])) {
  $totalRows_getprevinvoice = $_GET['totalRows_getprevinvoice'];
} else {
  $all_getprevinvoice = mysql_query($query_getprevinvoice);
  $totalRows_getprevinvoice = mysql_num_rows($all_getprevinvoice);
}
$totalPages_getprevinvoice = ceil($totalRows_getprevinvoice/$maxRows_getprevinvoice)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>type</td>
    <td>invoiceid</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_getprevinvoice['type']; ?></td>
      <td><?php echo $row_getprevinvoice['invoiceid']; ?></td>
    </tr>
    <?php } while ($row_getprevinvoice = mysql_fetch_assoc($getprevinvoice)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($getprevinvoice);
?>
