<?php require_once('Connections/stockcode.php'); ?>
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

mysql_select_db($database_stockcode, $stockcode);
$query_stonelist = "SELECT name, `description` FROM stonename ORDER BY name ASC";
$stonelist = mysql_query($query_stonelist, $stockcode) or die(mysql_error());
$row_stonelist = mysql_fetch_assoc($stonelist);
$totalRows_stonelist = mysql_num_rows($stonelist);
?>
<table border="0" cellpadding="0" cellspacing="0">
  <?php $i = 4; $j = 3;echo"<tr>"; do { ?>
  <?php 
  		if ($i > 0) {
			$i = $i - 1;
		  
		  }
		  else {
		  echo "<tr>"; 
		  $i = 3;
		  
		  }
    ?>
      <td width="230" align="center" id="productsq">
      <?php 
	  	$filename = 'images/stone/' .strtolower($row_stonelist['name']). '.gif';
		if (file_exists($filename)) {
	  		print "<img src=\"images/stone/" .strtolower($row_stonelist['name']). ".gif\" />";  } 
		else {
		
		print "<img src=\"images/products/tb_blank.gif\">";
		
		} ?><br /><strong><?php echo $row_stonelist['description']; ?></strong><br></td>
     <?php 
  		if ($j > 0) {
			$j = $j - 1;
		  
		  }
		  else {
		  echo "</tr>"; 
		  $j = 3;
		  
		  }
    ?>
    <?php } while ($row_stonelist = mysql_fetch_assoc($stonelist)); ?>
</table>

<?php
mysql_free_result($stonelist);
?>
