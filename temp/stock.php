<?php require_once('../Connections/external.php'); ?>
<?php require_once('../Connections/stockcode.php'); ?>
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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_external, $external);
$query_Recordset1 = "SELECT * FROM stock ORDER BY id ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;






$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id</td>
    <td>prefix</td>
    <td>name from db</td>
    <td>stocktype</td>
    <td>unitofmeasure</td>
    <td>stock</td>
    <td>imageloc</td>
    <td>price</td>
    <td>rate</td>
    <td>purchaseprice</td>
  </tr>
  <?php do {?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['prefix']; ?><?php echo $row_Recordset1['middle']; ?>_<?php echo $row_Recordset1['suffix']; ?></td>
	  	<td><?php echo $row_Recordset1['suffix']; ?> mm 
		<?php 
              $colname_Recordset2 = "-1";
        if (isset($_POST['prefix'])) {
          $colname_Recordset2 = $_POST['prefix'];
        }
        mysql_select_db($database_stockcode, $stockcode);
        $query_Recordset2 = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_Recordset1['prefix']);
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
		$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_Recordset1['middle']);
		$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
		$row_Recordset3 = mysql_fetch_assoc($Recordset3);
		$totalRows_Recordset3 = mysql_num_rows($Recordset3);
		echo $row_Recordset3['description']; 
		?>
		</td>
      <td><?php echo $row_Recordset1['stocktype']; ?></td>
      <td><?php echo $row_Recordset1['unitofmeasure']; ?></td>
      <td><?php echo $row_Recordset1['stock']; ?></td>
      <td><?php echo strtolower($row_Recordset1['prefix']); ?><?php echo strtolower($row_Recordset1['middle']); ?>.jpg</td>
      <td><?php echo $row_Recordset1['price']; ?></td>
      <td><?php echo $row_Recordset1['rate']; ?></td>
      <td><?php echo $row_Recordset1['purchaseprice']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>




Records <?php echo ($startRow_Recordset1 + 1) ?> to <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> of <?php echo $totalRows_Recordset1 ?>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

?>
