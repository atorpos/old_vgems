<?php require_once('../../Connections/external.php'); ?>
<?php require_once('../../Connections/stockcode.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_external, $external);
$query_Recordset1 = sprintf("SELECT * FROM stock WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_POST['pfix'])) {
  $colname_Recordset2 = $_POST['pfix'];
}
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset2 = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_Recordset1['prefix']);
$Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_POST['sname'])) {
  $colname_Recordset3 = $_POST['sname'];
}
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_Recordset1['middle']);
$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$colname_Recordset4 = "-1";
if (isset($_POST['sfix'])) {
  $colname_Recordset4 = $_POST['sfix'];
}
mysql_select_db($database_stockcode, $stockcode);
$query_Recordset4 = sprintf("SELECT code, `description` FROM suffixcode WHERE code = %s", $row_Recordset1['suffix']);
$Recordset4 = mysql_query($query_Recordset4, $stockcode) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>
<?php echo $row_Recordset4['description']; ?><?php echo $row_Recordset2['description']; ?><?php echo $row_Recordset3['description']; ?>