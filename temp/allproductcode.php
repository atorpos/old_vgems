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
$query_Recordset2 = "SELECT * FROM prefixcode ORDER BY code ASC";
$Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>id</td>
    <td>code</td>
    <td>description</td>
    <td>type</td>
    <td>specification</td>
    <td>active</td>
    <td>longdesc</td>
    <td>shipping</td>
    <td>exclusive</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset2['id']; ?></td>
      <td><?php echo $row_Recordset2['code']; ?></td>
      <td><?php echo $row_Recordset2['description']; ?></td>
      <td><?php echo $row_Recordset2['type']; ?></td>
      <td><?php echo $row_Recordset2['specification']; ?></td>
      <td><?php echo $row_Recordset2['active']; ?></td>
      <td><?php echo $row_Recordset2['longdesc']; ?></td>
      <td><?php echo $row_Recordset2['shipping']; ?></td>
      <td><?php echo $row_Recordset2['exclusive']; ?></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset2);
?>
