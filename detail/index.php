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
$query_Recordset0 = sprintf("SELECT * FROM prefixcode WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset0 = mysql_query($query_Recordset0, $external) or die(mysql_error());
$row_Recordset0 = mysql_fetch_assoc($Recordset0);
$totalRows_Recordset0 = mysql_num_rows($Recordset0);

$colname_Recordset3 = "-1";
if (isset($_POST['mdcode'])) {
  $colname_Recordset3 = $_POST['mdcode'];
}

mysql_select_db($database_external, $external);
$query_productlist = sprintf("SELECT middle FROM stock WHERE `prefix` = '%s' ORDER BY middle DESC", $row_Recordset0['code'] );
$productlist = mysql_query($query_productlist, $external) or die(mysql_error());
$row_productlist = mysql_fetch_assoc($productlist);
$totalRows_productlist = mysql_num_rows($productlist);


mysql_select_db($database_external, $external);
$query_productsize = sprintf("SELECT suffix FROM stock WHERE `prefix` = '%s' ORDER BY suffix DESC", $row_Recordset0['code'] );
$productsize = mysql_query($query_productsize, $external) or die(mysql_error());
$row_productsize = mysql_fetch_assoc($productsize);
$totalRows_productsize = mysql_num_rows($productsize);

$pagename= $row_Recordset0['description'];
?><?php include ('../header.php'); ?>
<div id="main" align="center">
<div id="topopup"><?php echo $row_Recordset0['description']; ?></div><table width="999" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="700px" border="0" cellpadding="0" cellspacing="0"><tr><td align="center" width="400px" valign="top">
      <p>
	  <?php
	  	$filename = '../images/products/' .strtolower($row_Recordset0['code']). '.jpg';
		if (file_exists($filename)) {
	  		print "<img src=\"../images/products/" .strtolower($row_Recordset0['code']). ".jpg\" alt=\"". $row_Recordset0['description']. "\"/>";  } 
		else {
		
		print "<img src=\"../images/products/blank.jpg\">";
		
		} ?>
	  
	  
	  <br /><strong>Product Code: <?php echo ucwords($row_Recordset0['code']); ?></strong></p></td><td width="300px" valign="top"><p><img src="../images/bg_detail_top.jpg" width="300" height="84" /></p><div id="productinformation"><ul><li><strong>Product name:</strong><br /><?php echo $row_Recordset0['description']; ?></li><li><strong>Description:</strong><br /></li><li><strong>Specification:</strong><ul><li>Stone Available: <ul>
	  <?php $buffer = NULL; 
	  if(NULL != $row_productlist) {do { 
	  	mysql_select_db($database_stockcode, $stockcode);
		$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_productlist['middle']);
		$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
		$row_Recordset3 = mysql_fetch_assoc($Recordset3);
		$totalRows_Recordset3 = mysql_num_rows($Recordset3);
		if ($buffer != $row_Recordset3['description']) {
		$buffer = $row_Recordset3['description'];
	  	echo "<li>"; 
		echo $row_Recordset3['description']; 
		echo "</li>"; } else {
			echo "";
		}
		} while ($row_productlist = mysql_fetch_assoc($productlist));} else {
			echo "<li>Available on Request</li>";
		}
	?>
    </ul></li><li>Size Available: <ul>
	<?php $presetsize = NULL; 
	if ($row_productsize['suffix'] != NULL) {
	do { 
			
			if ($presetsize != $row_productsize['suffix']) {
				$presetsize = $row_productsize['suffix'];
			echo "<li>"; 
			echo $row_productsize['suffix'];
			echo " mm</li>"; } else {
				echo "";
			}
	} while ($row_productsize = mysql_fetch_assoc($productsize));} else {
		echo "<li>Available on Request</li>";
	}
	?>
    </ul></li></ul></li><li><strong>More Info:</strong><br /><?php if($row_Recordset1['stock'] > 0) { echo "Product In Stock";} else {echo "Please Order";} ?></li><li><strong>Shipping Leadtime:</strong><br /><?php if($row_Recordset1['stock'] > 0) { echo "We can ship it now, or you can order more (take 4 weeks)";} else {echo "4 weeks for production.";} ?></li></ul></div></td></tr></table>
    <td width="249" align="center" valign="top" bgcolor="#383838"><div id="righttitle"><img src="../images/bg_detail_righttitle.png" /></div>
    <div id="rightcontents"></div><div id="cart"></div><div id="internal_adv"></div></td>
</tr></table>Pages: </div>
<? include('../footer.php'); ?></body>
</html>
<?php
mysql_free_result($Recordset0);

mysql_free_result($Recordset1);

mysql_free_result($Recordset3);

mysql_free_result($productlist);

mysql_free_result($productsize);
?>
