<?php require_once('../Connections/external.php');session_start(); ?>
<?php require_once('../Connections/stockcode.php');?>
<?php require_once('../Connections/currency.php');?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_external, $external);
$query_Recordset1 = sprintf("SELECT * FROM stock WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Expires" content="09-03-2011" />
<link rel="shortcut icon" href="http://vigorgems.com/vigor.ico" />
<style type="text/css">
<!--
@import url("../scripts/css/index.css");
@import url("../scripts/css/catalog.css");
-->
</style> 
<title>Outlet Store - <?php include('../scripts/php/productname.php');?></title>
<script src="../scripts/javascript/SpryTabbedPanels.js" type="text/javascript"></script>
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
<script type="text/javascript" src="../scripts/javascript/storelivesearch.js"></script>
<link href="../scripts/javascript/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header"><table width="1000"><tr><td width="80%"><img src="../images/header_logo.jpg" alt="Vigor Gems" width="450" height="90" /></td><td width="20%" align="right"><form>
  <div id="applesearch">
		<span class="sbox_l"></span><span class="sbox"><input type="text"  placeholder="Search..." autosave="applestyle_srch" results="5"id="txt1" size="30" onKeyUp="showResult(this.value)" /></span><span class="sbox_r" id="srch_clear"></span>
	<div id="livesearch"></div></div></form></td></tr></table>
<div id="navigation" align="justify">
<ul id="mymenu">
	<li><a href="../index.php" onmouseover="javascript:showsubmenu(1)">HOME</a></li><li><a href="#" onmouseover="javascript:showsubmenu(2)">JEWELRY</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(6)">SEMI-PRECIOUS STONE</a></li>
	
    <li><a href="#" onmouseover="javascript:showsubmenu(8)">COLLECTIONS</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(3)">EXHIBITION</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(4)">OUR FACTORY</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(5)">CUSTOMER SERVICE</a></li>
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
        
    </ul>
    <ul id="s2">
        <li><a href="../accessory">ACCESSORY</a></li><li><a href="../bracelet">BRACELET</a></li><li><a href="../earring">EARRING</a></li><li><a href="../necklet">NECKLET</a></li><li><a href="../ring">RING</a></li> 
    </ul>
    <ul id="s3">
        <li><a href="../exhibitions">GENERAL INFO.</a></li>
        <li><a href="../exhibitions">SPRING</a></li>
        <li><a href="../exhibitions">SUMMER</a></li>
        <li><a href="../exhibitions">FALL</a></li>
        <li><a href="../exhibitions">OVER SEA</a></li>
    </ul>
     <ul id="s4">
        <li><a href="../factory">LOCATION</a></li>
    </ul>
    <ul id="s5">
        <li><a href="../customers/status.php">CHECK YOUR STATUS</a></li><li><a href="../customers/mapp.php">MAKE AN APPOINTMENT</a></li><li><a href="../customers/interact.php">ORDER OUR PRODUCT</a></li>
    </ul>
    <ul id="s7">
        <li><a href="../aboutus.php">ABOUT US</a></li><li><a href="../jobs.php">JOBS</a></li><li><a href="../pressbox.php">PRESS BOX</a></li>
    </ul>
    <ul id="s8">
        <li><a href="../carving">CARVING</a></li><li><a href="../globe">GLOBE</a></li>
    </ul>
    
</div>
</div>
<div id="main" align="center">
<div id="outletop">
  <ul><li><a href="index.php?producttype=10">accessory</a></li><li><a href="index.php">beads</a></li><li><a href="index.php?producttype=04">bracelets</a></li><li><a href="index.php?producttype=09">globe</a></li><li><a href="index.php?producttype=06">necklaces</a></li></ul
></div><table width="1000" border="0" cellpadding="0" cellspacing="0">
  <tr><td valign="top" align="center"><div id="shopnav" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td width="50%"><img src="../images/bg_outlet_welcomesign.gif" /></td><td width="50%" align="right">Call Back | Tel: +852-23562083</td>
    </tr><tr><td>Back</td><td align="right">Pages:</td></tr></table>
  </div><div id="itembigtitle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr><td width="60%"><?php include('../scripts/php/productname.php');?></td>
    <td width="40%" align="right">Price:  <?php if ($row_currency['rate'] == NULL)
{
	echo "USD ";
	echo number_format($row_Recordset1['price']*1.2, 1);
}else 
{
	echo $row_currency['set_currency'];
	echo " ";
	echo number_format($row_Recordset1['price']*1.2*$row_currency['rate'], 1);
} ?>0 | <a href="php_outlet_add.php?id=<?php echo $row_Recordset1['id']. "&currency=" .$row_currency['set_currency']; ?>&qty=1">Add to cart</a></td>
    </tr></table></div><div id="itempicture"><table width="100%"><tr><td width="60%" align="center"><img src="../images/products/<?php echo strtolower($row_Recordset1['prefix']); ?><?php echo strtolower($row_Recordset1['middle']); ?>.jpg" border="0"/></td><td width="40%" valign="top"><div id="TabbedPanels1" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Description</li>
          <li class="TabbedPanelsTab" tabindex="0">Specifications</li>
          <li class="TabbedPanelsTab" tabindex="0">Shipping</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent"><?php echo $row_Recordset1['description'];?></div>
          <div class="TabbedPanelsContent">Color Range:</div>
          <div class="TabbedPanelsContent">Shipping</div>
        </div>
      </div></td></tr></table></div><div id="itemdescription" align="left"><hr id="hairliner" />
        <img src="../images/bg_store_otherproducts.gif" width="200" height="30" /><br />
        <?php include('../scripts/php/php_detail_sub.php');?>
      
    </div>
    <div id="buymore"><strong>US Price: <?php echo number_format($row_Recordset1['price']*1.2, 1); ?>0 | <a href="php_outlet_add.php?id=<?php echo $row_Recordset1['id']. "&currency=" .$row_currency['set_currency']; ?>&qty=1">ADD TO CART</a></strong></div></td>
  <td width="250" align="center" valign="top" bgcolor="#4E4E4E"><div id="righttitle"><img src="../images/bg_righttitle_det.png" /></div><div id="rightcontents" align="left"><ul>beads<li>10 strings item</li>
					<li>100 dollars less items</li>
					<li>100 dollars more items</li>
					</ul>
					  <?php include('../scripts/php/php_misc_sidebartotal.php'); ?>
					</div><div id="internal_adv">special items<p>product img</p><p>> More information</p></div></td>
  </tr></table><div id="bottommenu"></div>
</div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td><div align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></div></td></tr></table>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
