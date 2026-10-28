<?php require_once('../Connections/OfficeSQL.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "/index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_PreviousOrder = "-1";
if (isset($_GET['toinvoice'])) {
  $colname_PreviousOrder = $_GET['toinvoice'];
  $colname_PreviousOrder = hexdec($colname_PreviousOrder)/257;
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_PreviousOrder = sprintf("SELECT * FROM orderitems WHERE toinvoice = %s ORDER BY orderitemid ASC", GetSQLValueString($colname_PreviousOrder, "int"));
$PreviousOrder = mysql_query($query_PreviousOrder, $OfficeSQL) or die(mysql_error());
$row_PreviousOrder = mysql_fetch_assoc($PreviousOrder);
$totalRows_PreviousOrder = mysql_num_rows($PreviousOrder);

$colname_getitemdetail = "-1";
if (isset($row_PreviousOrder['sku'])) {
  $colname_getitemdetail = $row_PreviousOrder['sku'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_getitemdetail = sprintf("SELECT * FROM productid WHERE sku = %s", GetSQLValueString($colname_getitemdetail, "int"));
$getitemdetail = mysql_query($query_getitemdetail, $OfficeSQL) or die(mysql_error());
$row_getitemdetail = mysql_fetch_assoc($getitemdetail);
$totalRows_getitemdetail = mysql_num_rows($getitemdetail);
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>Order items ID</td>
    <td>Product No.</td>
    <td>Product Name</td>
    <td>Invoice Price</td>
    <td>Quantity</td>
    <td>Sub Total</td>
  </tr>
  <?php 
   $i = 0;
   $j = 0;
   class Item {
   	   public $orderid = "";
	   public $itemid = "";
	   public $itemname = "";
	   
	   
   }
   $items = new Item();
   
   
  do { 
  			$colname_getitemdetail = "-1";
			if (isset($row_PreviousOrder['sku'])) {
  				$colname_getitemdetail = $row_PreviousOrder['sku'];
			}
			mysql_select_db($database_OfficeSQL, $OfficeSQL);
			$query_getitemdetail = sprintf("SELECT * FROM productid WHERE sku = %s", GetSQLValueString($colname_getitemdetail, "int"));
			$getitemdetail = mysql_query($query_getitemdetail, $OfficeSQL) or die(mysql_error());
			$row_getitemdetail = mysql_fetch_assoc($getitemdetail);
			$totalRows_getitemdetail = mysql_num_rows($getitemdetail);
  ?>
  	<?php 
  		$theorderid = $row_PreviousOrder['orderitemid'];
  		$items->orderid[] = $theorderid;
		$thesku = $row_PreviousOrder['sku'];
		$items->itemid[] = $thesku;
		$theprice = number_format ($row_PreviousOrder['price'],2);
		$thequantity = $row_PreviousOrder['quantity'];
		$subtotal = $theprice*$thequantity;
		$j = $j+$thequantity;
   	do { 
		$thepartid = $row_getitemdetail['partid'];
		$thedescription =  $row_getitemdetail['description'];
		$items->itemname[] = $thedescription;
		
		$i++;
		echo "<tr><td>".$i."</td><td>".$thepartid."</td><td>".$thedescription."</td><td>".$theprice."</td><td>".$thequantity."</td><td>".number_format($subtotal,2)."</td></tr>";
		} while ($row_getitemdetail = mysql_fetch_assoc($getitemdetail));
		/*print json_encode($row);*/
		
	?>
    <?php json_encode($items);} while ($row_PreviousOrder = mysql_fetch_assoc($PreviousOrder)); 
	?>
</table>
<p>
<?php 
	echo "items counted ". $j; 
	echo json_encode($items);
	
?>
</p>
</body>
</html>
<?php
mysql_free_result($PreviousOrder);

mysql_free_result($getitemdetail);
?>
