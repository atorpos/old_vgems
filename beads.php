<?php require_once('Connections/external.php'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Expires" content="09-03-2011" />
<link rel="shortcut icon" href="http://vigorgems.com/vigor.ico" />
<style type="text/css">
<!--
@import url("scripts/css/index.css");
@import url("scripts/css/menu.css");

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
<div id="header"><img src="images/headerlogo.jpg" />
<div id="navigation" align="justify">
<ul id="mymenu">
	<li><a href="index.php" onmouseover="javascript:showsubmenu(1)">HOME</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(6)">SEMI-PRECIOUS STONE</a></li>
	<li><a href="#" onmouseover="javascript:showsubmenu(2)">JEWELRY</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(8)">COLLECTIONS</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(3)">EXHIBITION</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(4)">OUR FACTORY</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(5)">CUSTOMER SERVICE</a></li>
	<li><a href="aboutus.php" onmouseover="javascript:showsubmenu(7)">COMPANY INFO</a></li>
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
<div id="topopup">Choose the products</div><table width="999" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include('scripts/php/php_product_producttable.php');?></td>
    <td width="249" align="center" valign="top"><div id="righttitle">Nav</div><div id="rightcontents"></div><div id="cart"></div><div id="internal_adv"></div></td>
  </tr></table>Pages: </div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></td></tr></table>
</div>
</body>
</html>
