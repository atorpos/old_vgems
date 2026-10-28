<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "/index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php  $pagename="catalogs";?>
<?php include('../header.php'); ?>
<div id="main">
<img src="http://www.vigorgems.com/images/info_title.gif" alt="Vigor Gems' Products Info" width="980" height="60" />
<!--<div id="informationtitlebar" align="center"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('PDF','','http://www.vigorgems.com/images/info_button_o_03.gif',1)"><img src="http://www.vigorgems.com/images/info_button_03.gif" alt="PDF files' page" name="PDF" width="148" height="35" border="0" id="PDF" /></a><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('media','','http://www.vigorgems.com/images/info_button_o_04.gif',1)"><img src="http://www.vigorgems.com/images/info_button_04.gif" alt="media" name="media" width="144" height="35" border="0" id="media" /></a><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('FAQ','','http://www.vigorgems.com/images/info_button_o_05.gif',1)"><img src="http://www.vigorgems.com/images/info_button_05.gif" alt="FAQ's" name="FAQ" width="144" height="35" border="0" id="FAQ" /></a><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Contact Us','','http://www.vigorgems.com/images/info_button_o_06.gif',1)"><img src="http://www.vigorgems.com/images/info_button_06.gif" alt="contact Us" name="Contact Us" width="149" height="35" border="0" id="Contact Us" /></a></div>-->
<div id="infocontent">
<img src="http://www.vigorgems.com/images/info_catalog.gif" width="800" height="40" />
<p><img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#a">Beads</a>
<img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#b">Pendant</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#c">Carving</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#d">Silver</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#e">Cabochon</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#f">Gems Jewellery</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#g">Globe</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> <a href="#h">Special Products</a> <img src="http://www.vigorgems.com/images/info_arrow.gif" width="5" height="8" /> Seasonal Products <hr align="center" size="1" /> 
</p>
<table width="800" border="0" cellpadding="0" cellspacing="0"  id="info_title_top">
<tr>
<td valign="top">
<h1><a name="h" id="h">Special Product Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li><a href="http://www.vigorgems.com/pdf/Bracelet10.pdf">NEW BRACELET Catalogue - Sep 10</a></li><li><a href="http://www.vigorgems.com/pdf/WinterCollection.pdf">NEW WINTER's Catalogue - Oct 09</a></li></ul><br /></td>
<td valign="top">
<h1>Special Product catalog</h1>
<hr align="left" width="300" size="1"/>
<img src="http://www.vigorgems.com/images/items/PJS806JBP.jpg" width="129" height="144" align="left" alt="New Collection"/>
<p>Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/2011.pdf">Download</a>(Sept 11) - NEW!<br>
  <a href="http://www.vigorgems.com/pdf/collection2009.pdf">Download</a>(Mar09)</p></td>
</tr>
<tr>
<td valign="top">
  <h1><a name="a">Beads Information</a></h1>
<hr align="left" width="300" size="1"/>
Recent Releases:<ul><li><a href="http://www.vigorgems.com/pomo/index.php" target="_blank">Moonkatie Jasper Promotion!</a><br />
</li></ul></td>
<td valign="top">
<h1>Beads catalog</h1>
<hr align="left" width="300" size="1"/>
<p><img src="http://www.vigorgems.com/images/info_beads.jpg" alt="info beads" width="144" height="144" align="left" />Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/BEADID2008.pdf">Download</a>(Nov08)</p></td>
</tr>
<tr>
<td valign="top">
<h1><a name="b">Pendant Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li></li></ul><br /></td>
<td valign="top">
<h1>Pendant catalog</h1>
<hr align="left" width="300" size="1"/>
<p><img src="http://www.vigorgems.com/images/info_pendant.gif" align="left" />Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/C_Pendant.pdf">Download</a>(Jan09)</p></td>
</tr>
<tr>
<td valign="top">
<h1><a name="c">Caving Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li><a href="http://www.vigorgems.com/pdf/mass.pdf" target="_blank">Hot Stone and Massage</a></li></ul><br /></td>
<td valign="top">
<h1>Caving catalog</h1>
<hr align="left" width="300" size="1"/><p><img src="http://www.vigorgems.com/images/items/DC019Tumble.jpg" height="144" width="144" align="left" />Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/Carving08.pdf">Download</a>(Jan09)</p></td>
</tr>
<tr>
<td valign="top">
<h1><a name="d">Silver Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li></li></ul><br /></td>
<td valign="top">
<h1>Silver catalog</h1>
<hr align="left" width="300" size="1"/><img src="http://www.vigorgems.com/images/items/JSR18Garnet.jpg" width="110" height="144" align="left" />
<p>Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/Silver.pdf">Download</a>(Mar08)</p></td>
</tr>
<tr>
<td valign="top">
<h1><a name="e">Carbochon Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li></li></ul><br /></td>
<td valign="top">
<h1>Carbochon catalog</h1>
<hr align="left" width="300" size="1"/><img src="http://www.vigorgems.com/images/items/CBF21.jpg" width="144" height="74" align="left" />
<p>Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/Cabachons.pdf">Download</a>(Oct08)</p></td>
</tr>
<tr>
<td valign="top">
<h1><a name="f">Gems Jewellery Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li><a href="http://www.vigorgems.com/pomo/index.php" target="_blank">Moonkatie Jasper Promotion!</a></li></ul><br /></td>
<td valign="top">
<h1>Gems Jewellery catalog</h1>
<hr align="left" width="300" size="1"/><img src="http://www.vigorgems.com/images/items/BL32.jpg" width="144" height="142" align="left" />
<p>Bracelet PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/Bracelet10.pdf">Download</a>(Oct08)</p></td>
</tr>
<tr>
<td valign="top">
<h1><a name="g">Globe Information</a></h1>
<hr align="left" width="300" size="1" />
Recent Releases:<ul><li></li></ul><br /></td>
<td valign="top">
<h1>Globe catalog</h1>
<hr align="left" width="300" size="1"/>
<img src="http://www.vigorgems.com/images/items/IG3S.jpg" width="128" height="144" align="left" />
<p>Recent PDF catalog<br />
  <a href="http://www.vigorgems.com/pdf/Globe.pdf">Download</a>(Nov06)</p></td>
</tr>

</table>
</div>
</div>
<?php include('../footer.php'); ?>

</body>
</html>
