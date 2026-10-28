<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once('../Connections/login.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_login = new KT_connection($login, $database_login);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("kt_login_user", true, "text", "", "", "", "");
$formValidation->addField("kt_login_password", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make a login transaction instance
$loginTransaction = new tNG_login($conn_login);
$tNGs->addTransaction($loginTransaction);
// Register triggers
$loginTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "kt_login1");
$loginTransaction->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$loginTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
// Add columns
$loginTransaction->addColumn("kt_login_user", "STRING_TYPE", "POST", "kt_login_user");
$loginTransaction->addColumn("kt_login_password", "STRING_TYPE", "POST", "kt_login_password");
$loginTransaction->addColumn("kt_login_rememberme", "CHECKBOX_1_0_TYPE", "POST", "kt_login_rememberme", "0");
// End of login transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
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
  <tr><td width="150"><img src="../images/bg_cart_yourcart.gif" width="150" height="30" /></td><td align="right" valign="bottom" width="540"><img src="../images/tap_cart_01.gif" width="133" height="20" /><img src="../images/tap_cart_02_onpage.gif" /><img src="../images/tap_cart_03.gif" /><img src="../images/tap_cart_04.gif" /></td>
  </tr></table><br /><table width="690" border="0" cellpadding="0" cellspacing="0" ><tr><td><table width="340" border="0" cellpadding="0" cellspacing="0" id="login">
    <tr><td width="340" bgcolor="#006600"><strong>Returning customers</strong></td></tr><tr><td width="340" valign="top"><p><strong>Returning customers: Please enter your Login ID and password.</strong></p><p><span id="formdescp">Use your Login ID</span></p><?php
	echo $tNGs->getLoginMsg();
?>
<?php
	echo $tNGs->getErrorMsg();
?>
      <div  id="formlable">Login ID</div><form method="post" id="form1" class="KT_tngformerror" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>"><input type="text" name="kt_login_user" id="kt_login_user" value="<?php echo KT_escapeAttribute($row_rscustom['kt_login_user']); ?>" size="16" /><?php echo $tNGs->displayFieldHint("kt_login_user");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_user"); ?> 
       <span id="formdescp">Example:oskar@vigorgems.com</span><div  id="formlable">Password</div><input type="password" name="kt_login_password" id="kt_login_password" value="" size="16" /><?php echo $tNGs->displayFieldHint("kt_login_password");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_password"); ?> 
       <a href="forgot_password.php"><img src="../images/bg_outlet_forget.gif" width="100" height="20" align="absmiddle" border="0"/></a><br /><input type="image"  src="../images/bg_outlet_signin.gif"  name="kt_login1" id="kt_login1" value="Login" width="100" height="20" border="0" alt="Submit Form"></form></td>
    </tr></table></td><td width="10"></td><td valign="top"><table width="340" border="0" cellpadding="0" cellspacing="0" id="login">
        <tr><td width="340" bgcolor="#006600"><strong>New customers</strong></td></tr><tr><td width="340" valign="top"><p><strong>New customers:</strong></p><p><span id="formdescp">If you're new to the Vigor Gems' Online, we'll walk you through the checkout process.</span></p>
        <div  id="formlable">Create an account</div>
        <a href="create.php"><img src="../images/bg_outlet_creat.gif" width="100" height="20" border="0" /></a>
        <div  id="formlable">Quick Buy ( Don't need to set up an account )</div><a href="create.php"><img src="../images/button_create_quickbuy.gif" width="100" height="20" border="0" /></a>
        
        </td>
        </tr></table></td>
  </tr></table>
  <td width="250" align="center" valign="top"><div id="righttitle">Your Account Page</div><div id="rightcontents" align="left"><ul>Your Name<li>General Information</li>
					<li>Payment Information</li>
					<li>Purchase History</li>
					</ul>
					  <ul id="cart">your cart<li>echo items</li><li>echo total</li><li>check out</li></ul>
					</div><div id="internal_adv">special items<p>product img</p><p> More information</p></div></td>
  </tr></table><div id="bottommenu">Pages: </div>
</div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td><div align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></div></td></tr></table>
</div>
</body>
</html>
