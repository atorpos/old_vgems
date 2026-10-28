<?php require_once('../Connections/OfficeSQL.php'); ?>
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

$maxRows_Firstlogin = 10;
$pageNum_Firstlogin = 0;
if (isset($_GET['pageNum_Firstlogin'])) {
  $pageNum_Firstlogin = $_GET['pageNum_Firstlogin'];
}
$startRow_Firstlogin = $pageNum_Firstlogin * $maxRows_Firstlogin;

$colname_Firstlogin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Firstlogin = $_SESSION['MM_Username'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_Firstlogin = sprintf("SELECT * FROM customerid WHERE email = %s", GetSQLValueString($colname_Firstlogin, "text"));
$query_limit_Firstlogin = sprintf("%s LIMIT %d, %d", $query_Firstlogin, $startRow_Firstlogin, $maxRows_Firstlogin);
$Firstlogin = mysql_query($query_limit_Firstlogin, $OfficeSQL) or die(mysql_error());
$row_Firstlogin = mysql_fetch_assoc($Firstlogin);

if (isset($_GET['totalRows_Firstlogin'])) {
  $totalRows_Firstlogin = $_GET['totalRows_Firstlogin'];
} else {
  $all_Firstlogin = mysql_query($query_Firstlogin);
  $totalRows_Firstlogin = mysql_num_rows($all_Firstlogin);
}
$totalPages_Firstlogin = ceil($totalRows_Firstlogin/$maxRows_Firstlogin)-1;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>customerid</td>
    <td>pid</td>
    <td>email</td>
    <td>userid</td>
    <td>passwd</td>
    <td>salt</td>
    <td>lastlogin</td>
    <td>firstlogin</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Firstlogin['customerid']; ?></td>
      <td><?php echo $row_Firstlogin['pid']; ?></td>
      <td><?php echo $row_Firstlogin['email']; ?></td>
      <td><?php echo $row_Firstlogin['userid']; ?></td>
      <td><?php echo $row_Firstlogin['passwd']; ?></td>
      <td><?php echo $row_Firstlogin['salt']; ?></td>
      <td><?php echo $row_Firstlogin['lastlogin']; ?></td>
      <td><?php echo $row_Firstlogin['firstlogin']; ?></td>
    </tr>
    <?php } while ($row_Firstlogin = mysql_fetch_assoc($Firstlogin)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Firstlogin);
?>
