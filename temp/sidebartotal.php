<?php require_once('../Connections/external.php'); 
session_start();
?>

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

$colname_Recordset1 = session_id();
if (isset($_SESSION['sid'])) {
  $colname_Recordset1 = session_id();
}

mysql_select_db($database_external, $external);
$query_Recordset1 = sprintf("SELECT price FROM shopping WHERE sid = %s ORDER BY cid ASC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


?>

  <?php  $i = 0; $sumprice=0; do { ?>
    <?php $sumprice = $row_Recordset1['price']+$sumprice; $i++;?>
    
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <?php echo "<ul id=\"cart\">your cart<li>" .$i. " items</li><li>".$_COOKIE["TestCookie"]. " " .$sumprice. " total</li><li>Check Out</li></ul>"; $i =0;?>


<?php
mysql_free_result($Recordset1);
?>