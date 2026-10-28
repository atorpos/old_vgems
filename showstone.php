<?php require_once('Connections/external.php'); ?>
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

mysql_select_db($database_external, $external);
$query_productlist = "SELECT middle FROM stock WHERE `prefix` = '$row_Recordset1['prefix'] '";
$productlist = mysql_query($query_productlist, $external) or die(mysql_error());
$row_productlist = mysql_fetch_assoc($productlist);
$totalRows_productlist = mysql_num_rows($productlist);

mysql_free_result($productlist);
?>

<table border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td>middle</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_productlist['middle']; ?></td>
    </tr>
    <?php } while ($row_productlist = mysql_fetch_assoc($productlist)); ?>
</table>
