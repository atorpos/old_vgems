<?php require_once('../Connections/OfficeSQL.php'); ?>
<?php
$pagename = "Change Password";
$pagetype = "changeform";
$filename = "https://www.vigorgems.com/crm/changepasswd.php";
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

$MM_restrictGoTo = "finished.html";
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$username = $Recordset1['userid'];
	$password = $_POST['password'];
	$salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
	$hash = $salt . $password;
	for ( $i = 0; $i < 100000; $i ++ ) {
		$hash = hash('sha256', $hash);
	}
	$hash = $salt . $hash;
  	$updateSQL = sprintf("UPDATE customerid SET passwd=%s, active=%s WHERE customerid=%s",
                       GetSQLValueString($hash, "text"),
                       GetSQLValueString($_POST['active'], "int"),
                       GetSQLValueString($_POST['customerid'], "int"));

  mysql_select_db($database_OfficeSQL, $OfficeSQL);
  $Result1 = mysql_query($updateSQL, $OfficeSQL) or die(mysql_error());
  
  $updateGoTo = "finished.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_Recordset1 = sprintf("SELECT * FROM customerid WHERE userid = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $OfficeSQL) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Change Password</title>

<script src="/SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="/SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>

<link href="/SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<link href="/SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Register email</td>
      <td><?php echo $row_Recordset1['email']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><span id="sprypassword1">
      <input type="password" name="password" id="password" value="" size="32">
      <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Confirm Password</td>
      <td><span id="spryconfirm1">
        <input type="password" name="password_confirm" id="password_confirm" size="32">
      <span class="confirmRequiredMsg">Password is required.</span><span class="confirmInvalidMsg">The password don't match.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="active" value="<?php echo htmlentities($row_Recordset1['active'], ENT_COMPAT, 'UTF-8'); ?>" size="32">
  <input type="hidden" name="customerid" value="<?php echo $row_Recordset1['customerid']; ?>">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:4, maxChars:12, validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
