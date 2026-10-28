<?php require_once('../Connections/stockcode.php'); ?>
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
$query_beadrecode = "SELECT code, `description`, type FROM prefixcode WHERE type = 01 ORDER BY code ASC";
$beadrecode = mysql_query($query_beadrecode, $stockcode) or die(mysql_error());
$row_beadrecode = mysql_fetch_assoc($beadrecode);
$totalRows_beadrecode = mysql_num_rows($beadrecode);
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
    <td>code</td>
    <td>description</td>
    <td>type</td>
    <td>images</td>
  </tr>
  <?php $i= 0; do { ?>
    <tr>
      <td><?php echo $row_beadrecode['code']; ?></td>
      <td><?php echo $row_beadrecode['description']; ?></td>
      <td><?php echo $row_beadrecode['type']; ?></td>
      <td><img src="../images/products/tb_<?php echo strtolower($row_beadrecode['code']); ?>.gif"  /></td>
    </tr>
    <?php $i++; } while ($row_beadrecode = mysql_fetch_assoc($beadrecode)); ?>
</table>
<? echo $i; ?>
</body>
</html>
<?php
mysql_free_result($beadrecode);
?>
