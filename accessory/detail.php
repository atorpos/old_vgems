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
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset1 = sprintf("SELECT * FROM prefixcode WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_POST['pfcode'])) {
  $colname_Recordset2 = $_POST['pfcode'];
}
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset2 = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_Recordset1['prefix']);
$Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_POST['mdcode'])) {
  $colname_Recordset3 = $_POST['mdcode'];
}
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_Recordset1['middle']);
$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$colname_Recordset4 = "-1";
if (isset($_POST['sfcode'])) {
  $colname_Recordset4 = $_POST['sfcode'];
}
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset4 = sprintf("SELECT code, `description` FROM suffixcode WHERE code = '%s'", $row_Recordset1['suffix']);
$Recordset4 = mysql_query($query_Recordset4, $stockcode) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Expires" content="09-03-2011" />
<link rel="shortcut icon" href="http://vigorgems.com/vigor.ico" />
<style type="text/css">
<!--
@import url("../scripts/css/index.css");
@import url("../scripts/css/shop.css");
@import url("../scripts/css/menu.css");
-->
</style> 
<title>Vigor Beads</title>
<script type="text/javascript">
function showsubmenu(id){
	submenu=document.getElementById('s'+id);
	for(i=1;i<=8;i++){
		if(i==id){
			submenu.style.display="block";
		} else{
			document.getElementById('s'+i).style.display="none";
		}
	}
}
</script>
</head>

<body>
<div id="header">
<table width="1000"><tr><td width="80%"><img src="../images/headerlogo.jpg" /></td><td width="20%" align="right"><form>
  <div id="applesearch">
		<span class="sbox_l"></span><span class="sbox"><input type="search" id="srch_fld" placeholder="Search..." autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" /></span><span class="sbox_r" id="srch_clear"></span>
	</div></form></td></tr></table><div id="navigation" align="justify">
<ul id="mymenu">
	<li><a href="../index.php" onmouseover="javascript:showsubmenu(1)">HOME</a></li>
    <li><a href="../stone.php" onmouseover="javascript:showsubmenu(6)">SEMI-PRECIOUS STONE</a></li>
	<li><a href="../jewelry.php" onmouseover="javascript:showsubmenu(2)">JEWELRY</a></li>
    <li><a href="../collection.php" onmouseover="javascript:showsubmenu(8)">COLLECTIONS</a></li>
    <li><a href="../exhibition" onmouseover="javascript:showsubmenu(3)">EXHIBITION</a></li>
    <li><a href="../factory" onmouseover="javascript:showsubmenu(4)">OUR FACTORY</a></li>
    <li><a href="../care.php" onmouseover="javascript:showsubmenu(5)">CUSTOMER SERVICE</a></li>
	<li><a href="../aboutus.php" onmouseover="javascript:showsubmenu(7)">COMPANY INFO</a></li>
</ul>
</div>
<div id="sublinks">
<ul id="s1">
      <li></li>
    </ul>
	<ul id="s6">
      <li><a href="../beads">BEADS</a></li>
      <li><a href="../cabochon">CABOCHON</a></li>     
      <li><a href="../pendant">PENDANT</a></li>
    </ul>
    <ul id="s2">
      <li><a href="../bracelet">BRACELET</a></li> <li><a href="../earring">EARRING</a></li><li><a href="../necklet">NECKLET</a></li><li><a href="../steel">STRESSLESS STEEL</a></li>   <li><a href="../ silver">925 SILVER</a></li>   
    </ul>
    <ul id="s3">
      <li><a href="../exhibition">GENERAL INFO.</a></li>
      <li><a href="../exhibition/spring.php">SPRING</a></li>
      <li><a href="../exhibition/summer.php">SUMMER</a></li>
        <li><a href="../exhibition/fall.php">FALL</a></li>
      <li><a href="../exhibition/oversea.php">OVER SEA</a></li>
    </ul>
     <ul id="s4">
       <li><a href="../factory">LOCATION</a></li>
    </ul>
    <ul id="s5">
        <li><a href="../customer/status.php">CHECK YOUR STATUS</a></li><li><a href="../customer/appointment">MAKE AN APPOINTMENT</a></li><li><a href="../custmoer/order.php">ORDER OUR PRODUCT</a></li>
    </ul>
    <ul id="s7">
        <li><a href="../aboutus.php">ABOUT US</a></li><li><a href="../jobs.php">JOBS</a></li><li><a href="../pressbox.php">PRESS BOX</a></li>
    </ul>
    <ul id="s8">
        <li><a href="../carving">CARVING</a></li></li><li><li><a href="../globe">GLOBE</a></li>
    </ul>
</div>
</div>
<div id="main" align="center">
<div id="topopup">Choose the products</div><table width="999" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><p><strong>Product Name: <?php echo $row_Recordset1['description']; ?></strong></p>
      <p>
	  <? 
	  	$filename = '../images/products/' .strtolower($row_Recordset1['code']). '.jpg';
		if (file_exists($filename)) {
	  		print "<img src=\"../images/products/" .strtolower($row_Recordset1['code']). ".jpg\" />";  } 
		else {
		
		print "<img src=\"../images/products/blank.jpg\">";
		
		} ?>
	  
	  
	  <br />Product Code: <?php echo ucwords($row_Recordset1['code']); ?></p></td>
    <td width="249" align="center" valign="top" bgcolor="#383838"><div id="righttitle"><img src="../images/bg_detail_righttitle.png" /></div>
    <div id="rightcontents"></div><div id="cart"></div><div id="internal_adv"></div></td>
</tr></table>Pages: </div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></td></tr></table>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>
