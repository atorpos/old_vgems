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

$colname_currency = "-1";
if (isset($_GET['set_currency'])) {
  $colname_currency = $_GET['set_currency'];
}
mysql_select_db($database_currency, $currency);
$query_currency = sprintf("SELECT * FROM ratecard WHERE set_currency = %s", GetSQLValueString($colname_currency, "text"));
$currency = mysql_query($query_currency, $currency) or die(mysql_error());
$row_currency = mysql_fetch_assoc($currency);
$totalRows_currency = mysql_num_rows($currency);
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 18;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['producttype'])) {
  $colname_Recordset1 = $_GET['producttype'];
  
}

mysql_select_db($database_external, $external);
if ($colname_Recordset1 != "-1") {
	$bushname = $colname_Recordset1;
	$query_Recordset1 = sprintf("SELECT * FROM stock WHERE `outlet` = '1' AND  `producttype` LIKE %s ORDER BY producttype DESC", GetSQLValueString($colname_Recordset1, "text"));
	} else {
	$bushname = 01;
	$query_Recordset1 = "SELECT * FROM stock WHERE `outlet` = '1' && `producttype` = '01' ORDER BY id DESC";
}
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
?>
<div id="shopnav" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td width="50%"><img src="../images/bg_outlet_welcomesign.gif" /></td><td width="50%" align="right">Call Back | Tel: +852-23562083</td>
    </tr><tr>
      <td>Our Laterst 
	  <?php
      	switch ($bushname) {
			case 01:
				echo " beads ";
				break;
			case 02:
				echo " carbochon ";
				break;
			case 05:
				echo " earring ";
				break;
			case 04:
				echo " bracelet ";
				break;
			case 06:
				echo " necklace ";
				break;case 07:
				echo " ring ";
				break;
			case 08:
				echo " carving ";
				break;case 09:
				echo " earth ";
				break;
			case 10:
				echo " accessory ";
				break;
			default:
				NULL;
		}
	  ?>
	  items</td><td align="right"></td></tr></table>
  </div>
<div align="right">
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="../images/button_page_first.png" border="0" /></a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="../images/button_page_prev.png" border="0" /></a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="../images/button_page_next.png" border="0" /></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="../images/button_page_last.png" border="0" /></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</div>
<table border="0" cellpadding="0" cellspacing="0">
  <?php $i = 3; $j = 2;echo"<tr>"; do { ?>
  <?php 
  		if ($i > 0) {
			$i = $i - 1;
		  
		  }
		  else {
		  echo "<tr>"; 
		  $i = 2;
		  
		  }
    ?>
      <td width="230" align="center" id="productsq"><a href="detail.php?id=<?php echo $row_Recordset1['id'];?>&set_currency=<? echo $row_currency['set_currency'];?>"><img src="../images/products/tb_<?php echo strtolower($row_Recordset1['prefix']); ?><?php echo strtolower($row_Recordset1['middle']); ?>.gif" border="0"/></a><br />SKU: <?php echo $row_Recordset1['id']; ?><br />In Stock: 
	  
	  <?php $currentstock = $row_Recordset1['stock']; 
	  		if ( $currentstock > 0) { 
				echo $currentstock; 
			} else { 
				echo "<b> Out Of Stock </b>"; 
				$currentstock = 0;
			} 
	  ?>
      <br /><strong>Price: 
	  <?php

if ($row_currency['rate'] == NULL)
{
	echo "USD ";
	echo number_format($row_Recordset1['price']*1.2, 1);
}else 
{
	echo $row_currency['set_currency'];
	echo " ";
	echo number_format($row_Recordset1['price']*1.2*$row_currency['rate'], 1);
}

?>0</strong><br /><div id="moreinfobuy"><a href="detail.php?id=<?php echo $row_Recordset1['id'];?>&set_currency=<? echo $row_currency['set_currency'];?>">More Info</a> <em>|</em> <a href="php_outlet_add.php?id=<?php echo $row_Recordset1['id']. "&currency=" .$row_currency['set_currency']; ?>&qty=1">Buy</a></div></td>
      
      <?php 
  		if ($j > 0) {
			$j = $j - 1;
		  
		  }
		  else {
		  echo "</tr>"; 
		  $j = 2;
		  
		  }
    ?>
      
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<?php
mysql_free_result($Recordset1);
?>
<div align="right">
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
</table></div>
