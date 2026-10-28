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

$colname_sidbartotal = session_id();
if (isset($_SESSION['sid'])) {
  $colname_sidbartotal = session_id();
}

mysql_select_db($database_external, $external);
$query_sidbartotal = sprintf("SELECT price FROM shopping WHERE sid = %s ORDER BY cid ASC", GetSQLValueString($colname_sidbartotal, "text"));
$sidbartotal = mysql_query($query_sidbartotal, $external) or die(mysql_error());
$row_sidbartotal = mysql_fetch_assoc($sidbartotal);
$totalRows_sidbartotal = mysql_num_rows($sidbartotal);


?>

  <?php  $i = 0; $sumprice=0; do { ?>
    <?php $sumprice = $row_sidbartotal['price']+$sumprice; 
	if($sumprice > 0){
		$i++;
	} else {
		$i = 0;
	}
	
	?>
    
    <?php } while ($row_sidbartotal = mysql_fetch_assoc($sidbartotal)); ?>
    <?php echo "<ul id=\"cart\">your cart<li>" .$i. " items in Cart</li><li>".$_COOKIE["TestCookie"]." " .number_format($sumprice, 1). "0 in total</li><li><a href=\"payment.php\">Check Out</a></li></ul>"; $i =0;?>


<?php
mysql_free_result($sidbartotal);
session_destroy();
?>