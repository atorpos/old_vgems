<?php require_once('../Connections/external.php'); ?><?php require_once('../Connections/external.php');
       require_once('../Connections/stockcode.php');
session_start();
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


$colname_Recordset1 = session_id();
if (isset($_SESSION['sid'])) {
  $colname_Recordset1 = session_id();
}
mysql_select_db($database_external, $external);
$query_Recordset1 = sprintf("SELECT cid FROM shopping WHERE sid = %s ORDER BY cid ASC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_external, $external);
$query_Recordset2 = "SELECT * FROM webinvoice ORDER BY invoiceid DESC";
$Recordset2 = mysql_query($query_Recordset2, $external) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_external, $external);
$query_Recordset3 = sprintf("SELECT type, invoiceid FROM webinvoice WHERE cid = '%s'", $row_Recordset1['cid']);
$Recordset3 = mysql_query($query_Recordset3, $external) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<?php

$superid = $row_Recordset2['invoiceid'] + 4 ;
?>
<?php do { ?>
<? mysql_query("INSERT INTO webinvoice (type, invoiceid, cid, sid) VALUES ('WO','$superid', '{$row_Recordset1['cid']}', '$colname_Recordset1')");?>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 

?>
<? 
mysql_free_result($Recordset1);

?>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset3);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<title>Vigor Gems &amp; Jewellery - Account</title>
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
<script type="text/javascript">
function Shippingcost(cost) {

for (i=0; i < document.all.shipping.length; i++) {

if (document.getElementById("shipping"+i).checked == true) {
document.getElementById("shipcost").innerHTML = "<b>Shipping fee on each item is</b> US " + document.getElementById("shipping"+i).value;

break;
}
}
}
</script>
</head>

<body>
<div id="header"><img src="../images/headerlogo.jpg" />
<div id="navigation" align="justify">
<ul id="mymenu">
	<li><a href="../index.php" onmouseover="javascript:showsubmenu(1)">HOME</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(6)">SEMI-PRECIOUS STONE</a></li>
	<li><a href="#" onmouseover="javascript:showsubmenu(2)">JEWELRY</a></li>
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
        <li><a href="#">BEADS</a></li>
        <li><a href="#">CABOCHON</a></li>     
        <li><a href="#">PENDANT</a></li>
    </ul>
    <ul id="s2">
        <li><a href="#">BRACELET</a></li> <li><a href="#">EARRING</a></li><li><a href="#">NECKLET</a></li><li><a href="#">STREELESS STEEL</a></li>   <li><a href="#">925 SILVER</a></li>
        
        
    </ul>
    <ul id="s3">
        <li><a href="#">GENERAL INFO.</a></li>
        <li><a href="#">SPRING</a></li>
        <li><a href="#">SUMMER</a></li>
        <li><a href="#">FALL</a></li>
        <li><a href="#">OVER SEA</a></li>
    </ul>
     <ul id="s4">
        <li><a href="#">LOCATION</a></li>
    </ul>
    <ul id="s5">
        <li><a href="#">CHECK YOUR STATUS</a></li><li><a href="#">MAKE AN APPOINTMENT</a></li><li><a href="#">ORDER OUR PRODUCT</a></li>
    </ul>
    <ul id="s7">
        <li><a href="aboutus.php">ABOUT US</a></li><li><a href="jobs.php">JOBS</a></li><li><a href="pressbox.php">PRESS BOX</a></li>
    </ul>
    <ul id="s8">
        <li><a href="#">CARVING</a></li></li><li><li><a href="#">GLOBE</a></li>
    </ul>
    
</div>
</div>
<div id="main" align="center">
<div id="outlettop">
  <div align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td><ul><li>beads</li><li>bracelets</li><li>cabochons</li><li>globe</li><li>necklaces</li><li>pendants</li><li>925 silver</li></ul></td><td><div align="right"><ul><li>My Account</li> | <li>My Cart</li></ul></div></td></tr></table>
  </div>
</div><table width="1000" border="0" cellpadding="0" cellspacing="0">
  <tr><td valign="top" align="center"><div id="shopnav" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td width="50%"><img src="../images/bg_outlet_welcomesign.gif" /></td><td width="50%" align="right">Call Back | Tel: +852-23562083</td>
    </tr><tr><td></td><td align="right"></td></tr></table></div><table width="690" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="150"><img src="../images/bg_cart_yourcart.gif" width="150" height="30" /></td><td align="right" valign="bottom" width="540"><img src="../images/tap_cart_01.gif" width="133" height="20" /><img src="../images/tap_cart_02.gif" /><img src="../images/tap_cart_03_onpage.gif" /><img src="../images/tap_cart_04.gif" /></td>
  </tr></table><br /><table width="690" border="0" cellpadding="0" cellspacing="0" ><tr>
    <td><img src="../images/bg_payment_title.gif" />
      <div id="billdiv"><strong>Payment Method - Web Order Number <? echo $row_Recordset3['type']; ?><? echo $row_Recordset3['invoiceid']; ?></strong><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <label>
            <input type="radio" name="payment" value="paypal" id="payment_2" />
            PayPal(Visa, Master, AMEX) We only accept paypal.</label>
         
          <br />
          <hr /><strong>Shipping Address</strong><p>You can input it into the paypal page, or you can email us at vgrsales@vigorgems.com for shipping instruction.<hr /><strong>Shipping Method</strong>
      		<p>We only provide Express shipping now, The express shipping cost 5.00 USD pre items.</p> 
        <!--<p> 
          <label>
            <input type="radio" id="shipping0" name="shipping" value="0.00" onclick="Shippingcost(this.value)" checked />
            Standard</label>
          (take aound 1 to 2 weeks on delievery) - Free for charge<br />
          <label>
            <input type="radio" id="shipping1" name="shipping" value="5.00"  onclick="Shippingcost(this.value)"  />
            Express</label>
           (take aroung 3-5 days of delievery) - Extra charge may apply<br />
                  </p>
-->      <span id="shipcost"><b>Shipping fee on each item is</b> US 5.00</span><?php echo $shipvalue; ?>
      <hr /><strong>Order Summary</strong><hr /><?php include('../scripts/php/php_payment_summary.php');?>
        <hr /><p align="right"><div id="Payment_Amount"><strong> Total: US<? echo number_format($prototal, 1);?>0</strong>
          
          <p></p>
        </div></p>
        
        
<input type="hidden" name="cmd" value="_cart"/>
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="paypal@vigorgems.com"/>
<?php $j = 2; do { ?>
<input type="hidden" name="item_name_<?php echo $j-1; ?>" value="<? echo $eachsuffix[$j]; ?> mm <? echo $eachprefix[$i]; echo " "; echo $eachstonename[$j]; ?>"/>
<input type="hidden" name="item_number_<?php echo $j-1; ?>" value="<? echo $eachcodep[$j]; echo $eachcodem[$j]. "_" .$eachsuffix[$j];?>" />
<input type="hidden" name="quantity_<?php echo $j-1; ?>" value="<? echo $eachqty[$j]; ?>" />
<input type="hidden" name="amount_<?php echo $j -1; ?>" value=" <? echo $eachpri[$j];?>"/>
<input type="hidden" name="shipping_<?php echo $j -1; ?>" value="5.00" />
<? $j++; $i--;} while ($i > 1); ?>

<input type="submit" value="Pay Now!">
</form>
        <br /></div></td>
    
  </tr></table>
  <td width="250" align="center" valign="top" bgcolor="#4E4E4E"><div id="righttitle">Your Account Page</div><div id="rightcontents" align="left">
					  <ul id="cart">your cart<li>echo items</li><li>echo total</li></ul>
	  </div><div id="internal_adv">special items<p><?php include('../../scripts/php/random.php');?></p></div></td>
  </tr></table><div id="bottommenu">Pages: </div>
</div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td><div align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></div></td></tr></table>
</div>
</body>
</html>
<?
	mysql_free_result($ordersummary);
?>