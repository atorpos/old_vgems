<?php require_once('../../Connections/AppDB.php'); ?>
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

mysql_select_db($database_AppDB, $AppDB);
$query_Bracelet = "SELECT * FROM Products WHERE producttype = 'Bracelet' ORDER BY productID DESC";
$Bracelet = mysql_query($query_Bracelet, $AppDB) or die(mysql_error());
$row_Bracelet = mysql_fetch_assoc($Bracelet);
$totalRows_Bracelet = mysql_num_rows($Bracelet);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<table border="0">
  <tr>
    <td>productID</td>
    <td>SKU</td>
    <td>productname</td>
    <td>producttype</td>
    <td>description</td>
    <td>instock</td>
    <td>price</td>
    <td>unit</td>
    <td>dimension</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Bracelet['productID']; ?></td>
      <td><?php echo $row_Bracelet['SKU']; ?></td>
      <td><?php echo $row_Bracelet['productname']; ?></td>
      <td><?php echo $row_Bracelet['producttype']; ?></td>
      <td><?php echo $row_Bracelet['description']; ?></td>
      <td><?php echo $row_Bracelet['instock']; ?></td>
      <td><?php echo $row_Bracelet['price']; ?></td>
      <td><?php echo $row_Bracelet['unit']; ?></td>
      <td><?php echo $row_Bracelet['dimension']; ?></td>
    </tr>
    <?php } while ($row_Bracelet = mysql_fetch_assoc($Bracelet)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Bracelet);
?>
