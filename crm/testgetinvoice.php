<?php require_once('../Connections/OfficeSQL.php'); ?>
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

$colname_getinvoice = "-1";
if (isset($_GET['customerid'])) {
  $colname_getinvoice = hexdec($_GET['customerid'])/13;
}

mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_getinvoice = sprintf("SELECT * FROM invoiceid WHERE customerid = %s ORDER BY invoiceid DESC", GetSQLValueString($colname_getinvoice, "text"));
$getinvoice = mysql_query($query_getinvoice, $OfficeSQL) or die(mysql_error());
$row_getinvoice = mysql_fetch_assoc($getinvoice);
$totalRows_getinvoice = mysql_num_rows($getinvoice);
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
    <td>Invoice No</td>
    <td>Date</td>
    <td>Total Amount</td>
    <td>Currency</td>
    <td>More</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_getinvoice['invoiceid']; ?></td>
      <td><?php echo $row_getinvoice['date']; ?></td>
      <td><?php echo $row_getinvoice['total']; ?></td>
      <td><?php echo $row_getinvoice['currency']; ?></td>
      <td><a href="testgetitems.php?toinvoice=<?php echo $row_getinvoice['invoiceid']; ?>">Check ordered item</a></td>
    </tr>
    <?php } while ($row_getinvoice = mysql_fetch_assoc($getinvoice)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($getinvoice);
?>
