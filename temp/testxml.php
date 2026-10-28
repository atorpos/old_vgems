<?php require_once('../Connections/external.php'); ?>
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

$maxRows_newitems = 10;
$pageNum_newitems = 0;
if (isset($_GET['pageNum_newitems'])) {
  $pageNum_newitems = $_GET['pageNum_newitems'];
}
$startRow_newitems = $pageNum_newitems * $maxRows_newitems;

mysql_select_db($database_external, $external);
$query_newitems = "SELECT * FROM stock ORDER BY id DESC";
$query_limit_newitems = sprintf("%s LIMIT %d, %d", $query_newitems, $startRow_newitems, $maxRows_newitems);
$newitems = mysql_query($query_limit_newitems, $external) or die(mysql_error());
$row_newitems = mysql_fetch_assoc($newitems);

if (isset($_GET['totalRows_newitems'])) {
  $totalRows_newitems = $_GET['totalRows_newitems'];
} else {
  $all_newitems = mysql_query($query_newitems);
  $totalRows_newitems = mysql_num_rows($all_newitems);
}
$totalPages_newitems = ceil($totalRows_newitems/$maxRows_newitems)-1;




?>


<table border="1">
  <tr>
    <td>prefix</td>
    <td>middle</td>
    <td>suffix</td>
    
  </tr>
  <?php do { ?>
    <tr><td>
    <?php 
		
		mysql_select_db($database_stockcode, $stockcode);
		$query_prefix = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'",$row_newitems['prefix']) ;
		$prefix = mysql_query($query_prefix, $stockcode) or die(mysql_error());
		$row_prefix = mysql_fetch_assoc($prefix);
		$totalRows_prefix = mysql_num_rows($prefix);
		
		mysql_select_db($database_stockcode, $stockcode);
		$query_middle = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'",$row_newitems['middle']) ;
		$middle = mysql_query($query_middle, $stockcode) or die(mysql_error());
		$row_middle = mysql_fetch_assoc($middle);
		$totalRows_middle = mysql_num_rows($middle);
		
		echo $row_newitems['suffix']. " mm " . $row_middle['description']. " " .$row_prefix['description'];

	?></td>
      <td><?php echo $row_newitems['prefix']; ?></td>
      <td><?php echo $row_newitems['middle']; ?></td>
      
    </tr>
    <?php } while ($row_newitems = mysql_fetch_assoc($newitems)); mysql_free_result($prefix); mysql_free_result($middle);mysql_free_result($newitems);?>
</table>
