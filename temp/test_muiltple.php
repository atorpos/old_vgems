<?php require_once('../Connections/external.php'); ?>
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
$colname_Recordset1 = "-1";
if (isset($_GET['producttype'])) {
  $colname_Recordset1 = $_GET['producttype'];
}
mysql_select_db($database_external, $external);
if ($colname_Recordset1 = "-1") {
		$query_Recordset1 = sprintf("SELECT * FROM stock WHERE `outlet` = '0' ORDER BY id DESC");
} else {
$query_Recordset1 = sprintf("SELECT * FROM stock WHERE `outlet` = '1' && producttype = %s ORDER BY id DESC", GetSQLValueString($colname_Recordset1, "int"));
}
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id</td>
    <td>prefix</td>
    <td>middle</td>
    <td>suffix</td>
    <td>name</td>
    <td>description</td>
    <td>stocktype</td>
    <td>unitofmeasure</td>
    <td>stock</td>
    <td>imageloc</td>
    <td>price</td>
    <td>rate</td>
    <td>purchaseprice</td>
    <td>outlet</td>
    <td>onpage</td>
    <td>dateofadd</td>
    <td>producttype</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['prefix']; ?></td>
      <td><?php echo $row_Recordset1['middle']; ?></td>
      <td><?php echo $row_Recordset1['suffix']; ?></td>
      <td><?php echo $row_Recordset1['name']; ?></td>
      <td><?php echo $row_Recordset1['description']; ?></td>
      <td><?php echo $row_Recordset1['stocktype']; ?></td>
      <td><?php echo $row_Recordset1['unitofmeasure']; ?></td>
      <td><?php echo $row_Recordset1['stock']; ?></td>
      <td><?php echo $row_Recordset1['imageloc']; ?></td>
      <td><?php echo $row_Recordset1['price']; ?></td>
      <td><?php echo $row_Recordset1['rate']; ?></td>
      <td><?php echo $row_Recordset1['purchaseprice']; ?></td>
      <td><?php echo $row_Recordset1['outlet']; ?></td>
      <td><?php echo $row_Recordset1['onpage']; ?></td>
      <td><?php echo $row_Recordset1['dateofadd']; ?></td>
      <td><?php echo $row_Recordset1['producttype']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
