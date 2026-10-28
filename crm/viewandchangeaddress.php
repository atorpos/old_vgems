<?php require_once('../Connections/SecOfSQL.php'); ?>
<?php require_once('../Connections/OfficeSQL.php'); ?>
<?php
$pagename = "Your Address";
$pagetype = "promotional";
$filename = "https://www.vigorgems.com/crm/viewandchangeaddress.php";
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

$MM_restrictGoTo = "index.php";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO address (relatedid, type, street, city, `state`, zip, country, receipt) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['relatedid'], "int"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['street'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['receipt'], "text"));

  mysql_select_db($database_SecOfSQL, $SecOfSQL);
  $Result1 = mysql_query($insertSQL, $SecOfSQL) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
$colname_getcid = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_getcid = $_SESSION['MM_Username'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_getcid = sprintf("SELECT customerid FROM customerid WHERE userid = %s", GetSQLValueString($colname_getcid, "text"));
$getcid = mysql_query($query_getcid, $OfficeSQL) or die(mysql_error());
$row_getcid = mysql_fetch_assoc($getcid);
$totalRows_getcid = mysql_num_rows($getcid);

$colname_viewAddress = "-1";
if (isset($row_getcid['customerid'])) {
	$colname_viewAddress = $row_getcid['customerid'];
}
$startRow_viewAddress = 0;

mysql_select_db($database_SecOfSQL, $SecOfSQL);
$query_viewAddress = sprintf("SELECT * FROM cusinf WHERE customerid = %s", GetSQLValueString($colname_viewAddress, "text"));
$query_limit_viewAddress = sprintf("%s LIMIT %d, %d", $query_viewAddress, 0, 1);
$viewAddress = mysql_query($query_limit_viewAddress, $SecOfSQL) or die(mysql_error());
$row_viewAddress = mysql_fetch_assoc($viewAddress);

$colname_Recordset1 = "-1";
if (isset($row_getcid['customerid'])) {
  $colname_Recordset1 = $row_getcid['customerid'];
}
mysql_select_db($database_SecOfSQL, $SecOfSQL);
$query_Recordset1 = sprintf("SELECT * FROM address WHERE relatedid = %s ORDER BY addressid DESC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $SecOfSQL) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if (isset($_GET['totalRows_viewAddress'])) {
  $totalRows_viewAddress = $_GET['totalRows_viewAddress'];
} else {
  $all_viewAddress = mysql_query($query_viewAddress);
  $totalRows_viewAddress = mysql_num_rows($all_viewAddress);
}
$totalPages_viewAddress = ceil($totalRows_viewAddress/1)-1;
?>
<!DOCTYPE HTML>
<?php include('../header.php'); ?>
<div id="main">
<div id="crm_bigtitle"><div id="beta"></div></div>
<div id="crm_content">
	<div class="crm_brick">
	<div class="navbar">
	 	<a href="/crm/">YOUR ACCOUNT</a> > YOUR ADRESS
	</div>
  <?php do { ?>
  <div class="invoicewrap">
  	<div class="wapa"><h2>Primany Address:</h2>
  		<ul>
  		<li>Modify record</li>
  		</ul>
  	</div>
  	<div class="wapb">
    <ul>Address:
      <li><?php echo $row_viewAddress['streetadd']; ?></li>
      <li><?php echo $row_viewAddress['city']; ?>, <?php echo $row_viewAddress['state']; ?></li>
      <li><?php echo $row_viewAddress['pstco']; ?>, <?php echo $row_viewAddress['country']; ?></li>
    </ul>
    <ul>Phone Number:
    <li>
      <?php echo $row_viewAddress['phone']; ?>
    </li>
    </ul>
  	</div>
  </div>
    <?php 
    	$getcustid = $row_viewAddress['customerid'];
    	setcookie("cookieid", $getcustid, time()+360);
    	} while ($row_viewAddress = mysql_fetch_assoc($viewAddress)); 
    ?>
	
   <?php do { ?>
   <div class="invoicewrap">
   	<div class="wapa"><h2><?php echo $row_Recordset1['type']; ?> Address</h2>
   		<ul>
  		<li>Modify record</li><li>Delete record</li>
  		</ul>
   	</div>
   	<div class="wapb">
    <ul>Address:
      <li><?php echo $row_Recordset1['street']; ?></li>
      <li><?php echo $row_Recordset1['city']; ?>, <?php echo $row_Recordset1['state']; ?></li>
      <li><?php echo $row_Recordset1['zip']; ?>, <?php echo $row_Recordset1['country']; ?></li>
    </ul>
    <ul> Receipter Name:
      <li><?php echo $row_Recordset1['receipt']; ?></li>
    </ul>
   	</div>
   </div>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
	</div>
</div>
<div id="events_bottom"></div>
</div>
<?php include('../int_footer.php');?>
</body>
</html>
<?php
mysql_free_result($viewAddress);

mysql_free_result($getcid);
mysql_free_result($Recordset1);
?>
