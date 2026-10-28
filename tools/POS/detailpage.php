<?php require_once('../../Connections/OfficeSQL.php'); ?>
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

mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_detailpage = "SELECT * FROM stockinfo ORDER BY sku ASC";
$detailpage = mysql_query($query_detailpage, $OfficeSQL) or die(mysql_error());
$row_detailpage = mysql_fetch_assoc($detailpage);
$totalRows_detailpage = mysql_num_rows($detailpage);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<table border="1" align="center">
  <tr>
    <td>sku</td>
    <td>prefix</td>
    <td>stonename</td>
    <td>size</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="details.php?recordID=<?php echo $row_detailpage['sku']; ?>"> <?php echo $row_detailpage['sku']; ?>&nbsp; </a></td>
      <td><?php echo $row_detailpage['prefix']; ?>&nbsp; </td>
      <td><?php echo $row_detailpage['stonename']; ?>&nbsp; </td>
      <td><?php echo $row_detailpage['size']; ?>&nbsp; </td>
    </tr>
    <?php } while ($row_detailpage = mysql_fetch_assoc($detailpage)); ?>
</table>
<br>
<?php echo $totalRows_detailpage ?> Records Total
</body>
</html>
<?php
mysql_free_result($detailpage);
?>
