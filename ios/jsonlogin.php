<?php require_once('Connections/OfficeSQL.php'); ?>
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
?>

<?php
header('Content-type: application/json');
//if($_POST) {
//    if($_POST['username'] == 'dipinkrishna' && $_POST['password'] == 'password') {
//    echo '{"success":1}';
// } else {
//    echo '{"success":0,"error_message":"Username and/or password is invalid."}';
//}
//}else {    echo '{"success":0,"error_message":"Username and/or password is invalid."}';}

if($_POST) {
	$loginUsername = $_POST['username'];
	$loginPasswd = $_POST['password'];
	$LoginRS__query=sprintf("SELECT userid, passwd, role, company_id FROM customerid WHERE userid=%s AND passwd=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($loginPasswd, "text")); 
  $LoginRS = mysql_query($LoginRS__query, $OfficeSQL) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  if ($loginFoundUser) {
	  echo '{"success":1}';
  } else 
  {
	  else {    echo '{"success":0,"error_message":"Username and/or password is invalid."}';}
  }
}
?>