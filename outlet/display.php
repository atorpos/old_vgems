

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
    </tr></table>
  </div><div id="carttitle"><table width="690" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="150"><img src="../images/bg_cart_yourcart.gif" width="150" height="30" /></td><td align="right" valign="bottom" width="540"><img src="../images/tap_cart_01_onpage.gif" width="133" height="20" /><img src="../images/tap_cart_02.gif" /><img src="../images/tap_cart_03.gif" /><img src="../images/tap_cart_04.gif" /></td>
  </tr></table></div>
	
    
    
    
    
    <?php
	function display($result)
	{
		$row=mysql_num_rows($result);
		if ($row==0) {
			echo "<p><a href=\"index.php\"><img src=\"../images/button_cart_contshop.gif\" border=\"0\" /></a></p>";
			die ("your cart is empty");
			
			}
		else {
			echo "<div align=\"right\" id=\"top-buttons\"><p><a href=\"index.php?set_currency=".$_COOKIE["TestCookie"]. "\"><img src=\"../images/button_cart_contshop.gif\" border=\"0\" /></a><a href=\"payment.php\"><img src=\"../images/button_cart_checkout.gif\" border=\"0\"/></a></p>";
			echo"<p><a href=\"php_outlet_clear.php\"><img src=\"../images/button_display_clean.gif\" border=\"0\" /></a></p></div>";
			echo "<table width=\"690\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"shoppingcart\">
    <tr><td width=\"40\"><strong>No.</strong></td>
    <td width=\"81\"><strong>Code</strong></td>
    <td width=\"325\"><strong>Item</strong></td><td width=\"60\"><strong>Price</strong></td><td width=\"80\"><strong>Quantity</strong></td><td width=\"64\"><strong>Total</strong></td><td width=\"30\"><strong>Action</strong></td>";
			$i =1;
			while (list($cid, $sid, $name, $price, $qty, $currency)=mysql_fetch_row($result))
			{
				echo "<tr><td>" .$i;
				$i++;
				echo "</td><td>";
				include('../scripts/php/php_outlet_coderfinder.php');
				/*include('../scripts/php/php_outlet_codefinder.php');*/
				echo "</td><td>" .$currency. " " .number_format($price,1). "0"; 
				$eachtoto = $qty*$price;
				
				echo "<form name=\"form1\" method=\"get\" action=\"php_outlet_modify.php\">
					  <input type=\"hidden\" name=\"cid\" value=\"$cid\"></td>
					  <td><input type=\"text\" size=\"3\" name=\"qty\" value=\"$qty\">
					  <input type=\"submit\" name=\"Submit\" value=\"change\"></form></td>";
					  echo "</td><td>".$currency. " ".number_format($eachtoto,1). "0";
				echo"<td><a href=\"php_outlet_del.php?cid=$cid\">cancel</a></td></tr>";
			}
			}
	}
	?>
    
    <!--<div>
    <form action="slist.php" method="post" >
      <input type="reset" name="Reset" id="button" value="Reset" />
    
      <label>
      <input type="submit" name="button2" id="button2" value="Save" />
      </label>
      </form>
    </div>
    </td>
  <td width="250" align="center" valign="top"><div id="righttitle">ECHO Page</div><div id="rightcontents" align="left"><ul>beads<li>10 strings item</li>
					<li>100 dollars less items</li>
					<li>100 dollars more items</li>
					</ul>
					  <ul id="cart">your cart<li>echo items</li><li>echo total</li><li>check out</li></ul>
					</div><div id="internal_adv">special items<p>product img</p><p>> More information</p></div></td>
  </tr></table><div id="bottommenu">Pages: </div>
</div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td><div align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></div></td></tr></table>
</div>
-->

