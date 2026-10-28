
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

$maxRows_Recordset4 = 5;
$pageNum_Recordset4 = 0;
if (isset($_GET['pageNum_Recordset4'])) {
  $pageNum_Recordset4 = $_GET['pageNum_Recordset4'];
}
$startRow_Recordset4 = $pageNum_Recordset4 * $maxRows_Recordset4;

$colname_Recordset4 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset4 = $_GET['id'];
}
mysql_select_db($database_external, $external);
$query_Recordset4 = sprintf("SELECT * FROM stock WHERE id <> %s AND `outlet` = '1' ORDER BY id ASC", GetSQLValueString($colname_Recordset4, "int"));
$query_limit_Recordset4 = sprintf("%s LIMIT %d, %d", $query_Recordset4, $startRow_Recordset4, $maxRows_Recordset4);
$Recordset4 = mysql_query($query_limit_Recordset4, $external) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);

if (isset($_GET['totalRows_Recordset4'])) {
  $totalRows_Recordset4 = $_GET['totalRows_Recordset4'];
} else {
  $all_Recordset4 = mysql_query($query_Recordset4);
  $totalRows_Recordset4 = mysql_num_rows($all_Recordset4);
}
$totalPages_Recordset4 = ceil($totalRows_Recordset4/$maxRows_Recordset4)-1;

$queryString_Recordset4 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset4") == false && 
        stristr($param, "totalRows_Recordset4") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset4 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset4 = sprintf("&totalRows_Recordset4=%d%s", $totalRows_Recordset4, $queryString_Recordset4);


?><div align="right">
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset4 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset4=%d%s", $currentPage, 0, $queryString_Recordset4); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset4 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset4=%d%s", $currentPage, max(0, $pageNum_Recordset4 - 1), $queryString_Recordset4); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset4 < $totalPages_Recordset4) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset4=%d%s", $currentPage, min($totalPages_Recordset4, $pageNum_Recordset4 + 1), $queryString_Recordset4); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset4 < $totalPages_Recordset4) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset4=%d%s", $currentPage, $totalPages_Recordset4, $queryString_Recordset4); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table></div>
<table width="100%"><tr>
<?php do { ?>
  <td width="20%" valign="top"><a href="detail.php?id=<?php echo $row_Recordset4['id']; ?>"><img src="../images/products/tb_<?php echo strtolower($row_Recordset4['prefix']); ?><?php echo strtolower($row_Recordset4['middle']); ?>.gif" border="0"/></a><br />
    <?php echo $row_Recordset4['suffix']; ?>mm 
      <?php 
	  	$colname_Recordset3 = "-1";
		if (isset($_POST['name'])) {
		  $colname_Recordset3 = $_POST['name'];
		}
		mysql_select_db($database_stockcode, $stockcode);
		$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_Recordset4['middle']);
		$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
		$row_Recordset3 = mysql_fetch_assoc($Recordset3);
		$totalRows_Recordset3 = mysql_num_rows($Recordset3);
		echo $row_Recordset3['description']; 
		?>
	  
	  <?php 
              $colname_Recordset2 = "-1";
        if (isset($_POST['prefix'])) {
          $colname_Recordset2 = $_POST['prefix'];
        }
        mysql_select_db($database_stockcode, $stockcode);
        $query_Recordset2 = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_Recordset4['prefix']);
        $Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
        $row_Recordset2 = mysql_fetch_assoc($Recordset2);
        $totalRows_Recordset2 = mysql_num_rows($Recordset2);
        echo $row_Recordset2['description']; 
		?></td>
  <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?></tr></table>
<?
mysql_free_result($Recordset4);
?>

