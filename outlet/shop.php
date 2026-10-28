<?php require_once('../Connections/external.php'); ?>
<?php require_once('../Connections/stockcode.php'); ?>
<<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>LS</title>
</head>


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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_stocklist = 100;
$pageNum_stocklist = 0;
if (isset($_GET['pageNum_stocklist'])) {
  $pageNum_stocklist = $_GET['pageNum_stocklist'];
}
$startRow_stocklist = $pageNum_stocklist * $maxRows_stocklist;

mysql_select_db($database_external, $external);
$query_stocklist = "SELECT id, `prefix`, middle, suffix, name, stocktype, unitofmeasure, stock, price, rate, purchaseprice FROM stock ORDER BY `prefix` ASC";
$query_limit_stocklist = sprintf("%s LIMIT %d, %d", $query_stocklist, $startRow_stocklist, $maxRows_stocklist);
$stocklist = mysql_query($query_limit_stocklist, $external) or die(mysql_error());
$row_stocklist = mysql_fetch_assoc($stocklist);

if (isset($_GET['totalRows_stocklist'])) {
  $totalRows_stocklist = $_GET['totalRows_stocklist'];
} else {
  $all_stocklist = mysql_query($query_stocklist);
  $totalRows_stocklist = mysql_num_rows($all_stocklist);
}
$totalPages_stocklist = ceil($totalRows_stocklist/$maxRows_stocklist)-1;

$queryString_stocklist = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_stocklist") == false && 
        stristr($param, "totalRows_stocklist") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_stocklist = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_stocklist = sprintf("&totalRows_stocklist=%d%s", $totalRows_stocklist, $queryString_stocklist);
?>

<body>
<table><tr><td>name</td><td>price</td><td>add</td></tr>
<?php do { ?>
    <tr>
      <td><?php echo $row_stocklist['suffix']; ?> mm 
		<?php 
              $colname_Recordset2 = "-1";
        if (isset($_POST['prefix'])) {
          $colname_Recordset2 = $_POST['prefix'];
        }
        mysql_select_db($database_stockcode, $stockcode);
        $query_Recordset2 = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_stocklist['prefix']);
        $Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
        $row_Recordset2 = mysql_fetch_assoc($Recordset2);
        $totalRows_Recordset2 = mysql_num_rows($Recordset2);
        echo $row_Recordset2['description']; 
		?> 
		<?php 
	  	$colname_Recordset3 = "-1";
		if (isset($_POST['name'])) {
		  $colname_Recordset3 = $_POST['name'];
		}
		mysql_select_db($database_stockcode, $stockcode);
		$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_stocklist['middle']);
		$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
		$row_Recordset3 = mysql_fetch_assoc($Recordset3);
		$totalRows_Recordset3 = mysql_num_rows($Recordset3);
		echo $row_Recordset3['description']; 
		?></td>
      <td>USD <?php echo $row_stocklist['price']; ?> pre <?php echo $row_stocklist['unitofmeasure']; ?></td>
      <td><a href=php_outlet_add.php?id=<?php echo $row_stocklist['id']; ?>&qty=1>add</a></td>
     </tr>
    <?php } while ($row_stocklist = mysql_fetch_assoc($stocklist)); ?>

</table>
<?php
mysql_free_result($stocklist);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
</body>
</html>
