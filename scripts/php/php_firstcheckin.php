<?php require_once('../../Connections/OfficeSQL.php'); ?>
<?php
	if ($_SERVER['HTTPS'] != "on") { 
    	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
    	header("Location: $url"); 
    	exit; 
    }

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "signupform")) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
	$hash = $salt . $password;
	for ( $i = 0; $i < 100000; $i ++ ) {
		$hash = hash('sha256', $hash);
	}
	$hash = $salt . $hash;

  $updateSQL = sprintf("UPDATE customerid SET userid=%s, passwd=%s, firstlogin=%s WHERE customerid=%s",
                       
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($hash, "text"),
                       GetSQLValueString($_POST['firstlogin'], "int"),
                       GetSQLValueString($_POST['customerid'], "int"));

  mysql_select_db($database_OfficeSQL, $OfficeSQL);
  $Result1 = mysql_query($updateSQL, $OfficeSQL) or die(mysql_error());

  $updateGoTo = "testfirstlogin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_firstchange = "-1";
if (isset($_GET['email'])) {
  $colname_firstchange = $_GET['email'];
  $colname_firstcidh = hexdec($_GET['cid']);
  $colname_firstcid = round($colname_firstcidh/65521);
  $colname_firstpid = $_GET['pid'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_firstchange = sprintf("SELECT * FROM customerid WHERE email = %s AND pid = %s AND customerid = %s", GetSQLValueString($colname_firstchange, "text"), GetSQLValueString($colname_firstpid, "text"), GetSQLValueString($colname_firstcid, "text"));
$firstchange = mysql_query($query_firstchange, $OfficeSQL) or die(mysql_error());
$row_firstchange = mysql_fetch_assoc($firstchange);
$totalRows_firstchange = mysql_num_rows($firstchange);
if($row_firstchange['firstlogin'] == 1)
{
	header("Location: /signin.php"); 
}
if(empty($row_firstchange['customerid']))
{
	header("Location: /index.php"); 

}
//echo $colname_firstchange;
//echo $colname_firstcid;
//echo $colname_firstpid;
?>
