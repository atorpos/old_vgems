
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

$maxRows_ordersummary = 10;
$pageNum_ordersummary = 0;
if (isset($_GET['pageNum_ordersummary'])) {
  $pageNum_ordersummary = $_GET['pageNum_ordersummary'];
}
$startRow_ordersummary = $pageNum_ordersummary * $maxRows_ordersummary;

$colname_ordersummary = session_id();
if (isset($_SESSION['sid'])) {
  $colname_ordersummary = session_id();
}
mysql_select_db($database_external, $external);
$query_ordersummary = sprintf("SELECT * FROM shopping WHERE sid = %s ORDER BY cid ASC", GetSQLValueString($colname_ordersummary, "text"));
$query_limit_ordersummary = sprintf("%s LIMIT %d, %d", $query_ordersummary, $startRow_ordersummary, $maxRows_ordersummary);
$ordersummary = mysql_query($query_limit_ordersummary, $external) or die(mysql_error());
$row_ordersummary = mysql_fetch_assoc($ordersummary);

if (isset($_GET['totalRows_ordersummary'])) {
  $totalRows_ordersummary = $_GET['totalRows_ordersummary'];
} else {
  $all_ordersummary = mysql_query($query_ordersummary);
  $totalRows_ordersummary = mysql_num_rows($all_ordersummary);
}
$totalPages_ordersummary = ceil($totalRows_ordersummary/$maxRows_ordersummary)-1;



$colname_stonenamefinder = "-1";
if (isset($_SERVER['name'])) {
  $colname_stonenamefinder = $_SERVER['name'];
}
mysql_select_db($database_external, $external);
$query_invoicetracker = sprintf("SELECT cid FROM shopping WHERE sid = %s ORDER BY cid ASC", GetSQLValueString($colname_invoicetracker, "text"));
$invoicetracker = mysql_query($query_invoicetracker, $external) or die(mysql_error());
$row_invoicetracker = mysql_fetch_assoc($invoicetracker);
$totalRows_invoicetracker = mysql_num_rows($invoicetracker);
$firstcid = $row_ordersummary['cid'];
?>
<table width="690" border="0" cellpadding="0" cellspacing="0" id="shoppingcart">
<tr><td width="40"><strong>No.</strong></td>
    <td width="81"><strong>Code</strong></td>
    <td width="325"><strong>Item</strong></td><td width="60"><strong>Price</strong></td><td width="80"><strong>Quantity</strong></td><td width="80"><strong>Total</strong></td></tr>

  <?php $i =1; $prototal= 0; do { 
  	
  ?>
    <tr>
      <td><?php echo $i; $i++;?> <!-- No of Product. --></td>
      <?
	  
	  	mysql_select_db($database_external, $external);
		$query_codefinder = sprintf("SELECT * FROM stock WHERE id = '%s'", $row_ordersummary['name']);
		$codefinder = mysql_query($query_codefinder, $external) or die(mysql_error());
		$row_codefinder = mysql_fetch_assoc($codefinder);
		$totalRows_codefinder = mysql_num_rows($codefinder);
	  
	  ?>
       <td><?php echo strtoupper($row_codefinder['prefix']); $eachcodep[$i] = strtoupper($row_codefinder['prefix']);?><?php echo strtoupper($row_codefinder['middle']); $eachcodem[$i] =  strtoupper($row_codefinder['middle']);?>_<?php echo $row_codefinder['suffix']; ?></td>
			<?      
			
			mysql_select_db($database_stockcode, $stockcode);
			$query_stonenamefinder = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_codefinder['middle']);
			$stonenamefinder = mysql_query($query_stonenamefinder, $stockcode) or die(mysql_error());
			$row_stonenamefinder = mysql_fetch_assoc($stonenamefinder);
			$totalRows_stonenamefinder = mysql_num_rows($stonenamefinder);
			
			mysql_select_db($database_stockcode, $stockcode);
			$query_prefixfinder = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_codefinder['prefix']);
			$prefixfinder = mysql_query($query_prefixfinder, $stockcode) or die(mysql_error());
			$row_prefixfinder = mysql_fetch_assoc($prefixfinder);
			$totalRows_prefixfinder = mysql_num_rows($prefixfinder); 
			?>
		
      <td><?php echo $row_codefinder['suffix']; ?> mm <?php echo $row_prefixfinder['description']; ?> <?php echo $row_stonenamefinder['description']; ?><? $eachsuffix[$i] = $row_codefinder['suffix']; $eachprefix[$i] = $row_prefixfinder['description']; $eachstonename[$i] = $row_stonenamefinder['description'];?></td>
      <td><?php echo  "US " .number_format($row_ordersummary['price'], 1). "0"; $eachpri[$i] = $row_ordersummary['price']; ?></td>
      <td><?php echo $row_ordersummary['qty']; $eachqty[$i] = $row_ordersummary['qty']; ?></td>
      <td><?php $eachtoto[$i] = $row_ordersummary['price']*$row_ordersummary['qty']; echo  "US " .number_format($eachtoto[$i], 1). "0";?>
      <? 
	  		
	  	  	$prototal = $prototal + $eachtoto[$i];
	  
	  ?>

    </tr>
    <?php } while ($row_ordersummary = mysql_fetch_assoc($ordersummary)); ?>
</table>



<?php 

		echo $colname_ordersummary; 
	   echo hexdec($colname_ordersummary);
?>
<?php


mysql_free_result($codefinder);

mysql_free_result($prefixfinder);

mysql_free_result($stonenamefinder);


?>
