<?php 
	require_once('../Connections/OfficeSQL.php');
	require_once('../Connections/SecOfSQL.php');
?>
<?php
$pagename = "Your Previous Order";
$pagetype = "promotional";
$filename = "https://www.vigorgems.com/crm/previnvoice.php";
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

$maxRows_converid = 1;
$pageNum_converid = 0;
if (isset($_GET['pageNum_converid'])) {
  $pageNum_converid = $_GET['pageNum_converid'];
}
$startRow_converid = $pageNum_converid * $maxRows_converid;

if (isset($_SESSION['MM_Username'])) {
  $colname_converid = $_SESSION['MM_Username'];
}

mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_converid = sprintf("SELECT * FROM customerid WHERE userid = %s", GetSQLValueString($colname_converid, "text"));
$converid = mysql_query($query_converid, $OfficeSQL) or die(mysql_error());
$row_converid = mysql_fetch_assoc($converid);
$totalRows_converid = mysql_num_rows($converid);

$colname_getinvoices = "-1";
if (isset($row_converid['customerid'])) {
  $colname_getinvoices =$row_converid['customerid'];
}

mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_getinvoices = sprintf("SELECT * FROM invoiceid WHERE customerid = %s ORDER BY invoiceid DESC", GetSQLValueString($colname_getinvoices, "text"));
$getinvoices = mysql_query($query_getinvoices, $OfficeSQL) or die(mysql_error());
$row_getinvoices = mysql_fetch_assoc($getinvoices);
$totalRows_getinvoices = mysql_num_rows($getinvoices);

?>
<?php include('../header.php'); ?>
<div id="main">
<div id="crm_bigtitle"><div id="beta"></div></div>
<div id="crm_content">
	<div class="crm_brick">
	<?php
		echo "HELLO " .$colname_converid;
 	?>
 	<div class="navbar">
	 	<a href="/crm/">YOUR ACCOUNT</a> > YOUR ORDERS
	</div>
  <?php 
  	mysql_select_db($database_SecOfSQL, $SecOfSQL);
  	do { 
  $detailinvoice = $row_getinvoices['invoiceid'];
  $query_getdetailinvoice = sprintf("SELECT * FROM detailinvoice WHERE invoiceid = %s", GetSQLValueString($detailinvoice,"text"));
  $query_limit_getdetailinvoice = sprintf("%s LIMIT %d, %d", $query_getdetailinvoice, 0, 1);
  $getdetailinvoice = mysql_query($query_limit_getdetailinvoice, $SecOfSQL) or die(mysql_error());
  $row_getdetailinvoice = mysql_fetch_assoc($getdetailinvoice);
  
  $getcompany = $row_getinvoices['customerid'];
  $query_companyinfo = sprintf("SELECT * FROM cusinf WHERE customerid = %s", GetSQLValueString($getcompany, "text"));
  $query_limit_companyinfo = sprintf("%s LIMIT %d, %d", $query_companyinfo, 0, 1);
  $companyinfo = mysql_query($query_limit_companyinfo, $SecOfSQL) or die(mysql_error());
  $row_companyinfo = mysql_fetch_assoc($companyinfo);

  ?>
  <div class="invoicewrap">
    <div class="wapa">
    Order Placed:
    	<h2><?php echo $row_getinvoices['date']; ?></h2>
    	<span class="submenu"><a href="testgetitems.php?toinvoice=<?php 
      $showinvoicenumber = dechex($row_getinvoices['invoiceid']*257);
      echo $showinvoicenumber;
      ?>">Order detail</a> | View Invoice</span>
    	<ul>
    	<li>Order Number: <span style="font-weight:bold">SI<?php echo str_pad($row_getinvoices['invoiceid'],6,"0",STR_PAD_LEFT); ?></span></li>
        <li>Recipient: <?php echo $row_companyinfo['company']; ?></li>
        <li>Order Total: <span style="color:#ffaf14; font-weight:bold;"><?php echo number_format($row_getinvoices['total'],2, '.',','); ?></span> in <?php echo $row_getinvoices['currency']; ?></li>
    	</ul>
    </div>
    
    <div class="wapb">
    	<div class="wapbtitle">
    		<p>Shipping Date: <?php echo $row_getdetailinvoice['shipdate']; ?></p>
    		<p>Status: <span style="font-weight:bold; font-size:18px; color:#ffaf14;"><?php echo $row_getdetailinvoice['status']; ?></span></p>
    	</div>
    	<h2>Notes</h2>
    </div>
    
    </div>
    <?php } while ($row_getinvoices = mysql_fetch_assoc($getinvoices)); ?>
</div>
</div>
<div id="events_bottom"></div>
</div>
<?php include('../int_footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($converid);

mysql_free_result($getinvoices);

mysql_free_result($getdetailinvoice);

mysql_free_result($companyinfo);
?>
