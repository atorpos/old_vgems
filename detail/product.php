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

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_external, $external);
$query_Recordset1 = sprintf("SELECT * FROM stock WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_stockcode, $stockcode);
$query_prefix = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_Recordset1['prefix'] );
$prefix = mysql_query($query_prefix, $external) or die(mysql_error());
$row_prefix = mysql_fetch_assoc($prefix);
$totalRows_prefix = mysql_num_rows($prefix);

mysql_select_db($database_stockcode, $stockcode);
$query_productname = sprintf("SELECT name, `description` FROM stonename WHERE `name` = '%s'", $row_Recordset1['middle'] );
$productname = mysql_query($query_productname, $external) or die(mysql_error());
$row_productname = mysql_fetch_assoc($productname);
$totalRows_productname = mysql_num_rows($productname);

$pagename= $row_Recordset1['suffix']. " mm ". $row_productname['description']. " ". $row_prefix['description'];
?><?php include ('../header.php'); ?>
<div id="main" align="center">
<div id="topopup"><?php echo $row_Recordset1['suffix']. " mm ". $row_productname['description']. " ". $row_prefix['description']; ?></div><table width="999" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="700px" border="0" cellpadding="0" cellspacing="0"><tr><td align="center" width="400px" valign="top">
      <p>
	  <?php
	  	$filename = '../images/products/' .strtolower($row_Recordset1['prefix']). strtolower($row_Recordset1['middle']). '.jpg';
		if (file_exists($filename)) {
	  		print "<img src=\"../images/products/". strtolower($row_Recordset1['prefix']). strtolower($row_Recordset1['middle']). ".jpg\" alt=\"". $row_Recordset1['description']. "\"/>";  } 
		else {
		
		print "<img src=\"../images/products/blank.jpg\">";
		
		} ?>
	  
	  
	  <br /><strong>Product Code: <?php echo ucwords($row_Recordset1['prefix']). ucwords($row_Recordset1['middle']). "_". $row_Recordset1['suffix'] ; ?></strong></p></td><td width="300px" valign="top"><p><img src="../images/bg_detail_top.jpg" width="300" height="84" /></p><div id="productinformation"><ul><li><strong>Product name:</strong><br /><?php echo $row_Recordset1['suffix']. " mm ". $row_productname['description']. " ". $row_prefix['description']; ?></li><li><strong>Description:</strong><br /><?php echo $row_Recordset1['description']; ?> </li><li><strong>Specification:</strong><ul><li>Stone: <ul>
	  <li><?php echo $row_productname['description']; ?></li>
    </ul></li><li>Size: <ul>
	<?php echo $row_Recordset1['suffix']. " mm"; ?>
    </ul></li></ul></li><li><strong>More Info:</strong><br /><?php if($row_Recordset1['stock'] > 0) { echo "Product In Stock";} else {echo "Please Order";} ?></li><li><strong>Shipping Leadtime:</strong><br /><?php if($row_Recordset1['stock'] > 0) { echo "We can ship it now, or you can order more (take 4 weeks)";} else {echo "4 weeks for production.";} ?></li></ul></div></td></tr></table>
    <td width="249" align="center" valign="top" bgcolor="#383838"><div id="righttitle"><img src="../images/bg_detail_righttitle.png" /></div>
    <div id="rightcontents"></div><div id="cart"></div><div id="internal_adv"></div></td>
</tr></table>Pages: </div>
<? include('../footer.php'); ?></body>
</html>
<?php

mysql_free_result($Recordset1);

mysql_free_result($prefix);

mysql_free_result($productname);
?>
