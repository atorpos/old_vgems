<?php
	if ($_SERVER['HTTPS'] != "on") { 
    	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
    	header("Location: $url"); 
    	exit; 
    }
	$pagename = "Your Account";
	$pagetype = "promotional";
	$filename = "https://www.vigorgems.com/crm/index.php";
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

$MM_restrictGoTo = "/signin.php";
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
<?php include('../header.php'); ?>
<div id="main">
<div id="crm_bigtitle"><div id="beta"></div></div>
<div id="crm_content">
	<div class="crm_brick">
		<div class="crma">
			<div class="sumuptitle">Orders</div><span class="desctitle">Add, modify and see orders</span>
			<img src="/images/bg_crm_shipping.png">
		</div>
		<div class="crmb">
		
		<ul><h1>Order History</h1>
			<li>Add new orders <span style="color:red;"> - Order App will available on iPad in winter!</span></li>
			<li>Get quotation <span style="color:red;"> - Order App will available on iPad in winter!</span></li>
			<li><a href="vofer.php">View offers</a></li>
			<li><a href="opord.php">View open orders</a></li>
			<li><a href="previnvoice.php">Check previous orders</a></li>
		</ul>
		</div>
	</div>
	<div class="crm_brick">
		<div class="crma">
			<div class="sumuptitle">Products Light table</div><span class="desctitle">Fastest way to browser our products</span>
			<img src="/images/bg_crm_lighttable.png">
		</div>
		<div class="crmb">
		
		<ul><h1>Products Light-table</h1>
			<li><a href="/lighttable/bracelets.php">Bracelets' Light table</a></li>
			<li><a href="/lighttable/beads.php">Beads' Light table</a></li>
			<li>Necklaces' Light table <span style="color:red;"> - Will available soon!</span></li>
			<li>Earrings' Light table <span style="color:red;"> - Will available soon!</span></li>
			<li>Ring's Light table <span style="color:red;"> - Will available soon!</span></li>
		</ul>
		</div>
	</div>
	<div class="crm_brick">
		<div class="crma">
		<div class="sumuptitle">Settings</div><span class="desctitle">Change, view password, email,</span><br/><span class="desctitle">shipping and contact.</span>
		</div>
		<div class="crmb">
		
		<ul><h1>Account Settings</h1>
			<li><a class="iframe" href="changepasswd.php">Change account password</a></li>
			<li><a class="iframe" href="changemail.php">Change account email</a></li>
			<li><a href="viewandchangeaddress.php">View and change shipping address</a></li>
			<li>Add new user <span style="color:red;"> - Will available soon!</span></li>
			<li>View and change contact information</li>
			<li>Wish list</li>
		</ul>
		</div>
	</div>
</div>
<div id="events_bottom"></div>
</div>
<?php include('../int_footer.php');?>
</body>
</html>