<?php require_once('../Connections/SecOfSQL.php'); ?>
<?php
$pagename = "View Offers";
$pagetype = "promotional";
$filename = "https://www.vigorgems.com/crm/vofer.php";
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

$colname_openorder = "-1";
if (isset($_SESSION['MM_Userid'])) {
  $colname_openorder = $_SESSION['MM_Userid'];
}
mysql_select_db($database_SecOfSQL, $SecOfSQL);
$query_openorder = sprintf("SELECT * FROM offerorder WHERE offertoid = %s ORDER BY viewofferid DESC", GetSQLValueString($colname_openorder, "int"));
$openorder = mysql_query($query_openorder, $SecOfSQL) or die(mysql_error());
$row_openorder = mysql_fetch_assoc($openorder);
$totalRows_openorder = mysql_num_rows($openorder);
?>
<?php include('../header.php'); ?>
<div id="main">
<div id="crm_bigtitle"><div id="beta"></div></div>
<div id="crm_content">
	<div class="crm_brick">
 	<div class="navbar">
	 	<a href="/crm/">YOUR ACCOUNT</a> > VIEW OFFERS
	</div>
 <?php do { ?>
    <div class="invoicewrap">
    	<div class="wapa">
    		Offer Placed:
    		<h2><?php echo $row_openorder['offerdate']; ?></h2>
    		<span class="submenu"><a href="gofit.php?tovof=<?php
    		$showvofnumber = dechex($row_openorder['viewofferid']*257);
    		echo $showvofnumber;
    		?>">Offer details</a></span>
    		<ul>
    			<li>Offer Number:  <span style="font-weight:bold">QU<?php echo str_pad($row_openorder['viewofferid'],6, "0",STR_PAD_LEFT); ?></span></li>
    		</ul>
    	</div>
    	<div class="wapb">
	    	<div class="wapbtitle">
	    		<ul>
	    			<li> Status: 
	    			<?php 
	    				if ($row_openorder['status'] == 0) {
	    					echo "<span style=\"font-weight:bold; color:green\">NEW !</span>";
		    				
	    				} else {
		    				echo "Confirmed";
	    				}
	    			?></li>
	    			<li> Sales: <?php echo $row_openorder['sales']; ?></li>
	    			<li> Offer currency <?php echo $row_openorder['currency']; ?></li>
	    		</ul>
	    	</div>
	    	<ul>
	    		<li>Comments: <span style="color:#ffaf14; font-weight:bold; font-size:x-small;"><?php echo $row_openorder['comments']; ?></span></li></ul>
	    </div>
    </div>
    <?php } while ($row_openorder = mysql_fetch_assoc($openorder)); ?>
</div>
</div>
<div id="events_bottom"></div>
</div>
<?php include('../int_footer.php'); ?>


</body>
</html>
<?php
mysql_free_result($openorder);
?>
