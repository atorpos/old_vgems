<?php require_once('../Connections/external.php');
session_start()
 ?>
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

$colname_Recordset1 = session_id();
if (isset($_SESSION['sid'])) {
  $colname_Recordset1 = session_id();
}
mysql_select_db($database_external, $external);
$query_Recordset1 = sprintf("SELECT cid FROM shopping WHERE sid = %s ORDER BY cid ASC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_external, $external);
$query_Recordset2 = "SELECT invoiceid FROM webinvoice ORDER BY invoiceid DESC";
$Recordset2 = mysql_query($query_Recordset2, $external) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
<?php echo $row_Recordset2['invoiceid']; 

$superid = $row_Recordset2['invoiceid'] + 12 ;
?>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>cid</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['cid']; ?></td>
    </tr>
    <? mysql_query("INSERT INTO webinvoice (type, invoiceid, cid) VALUES ('W','$superid', '{$row_Recordset1['cid']}')");
  
  ?>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<? 
mysql_free_result($Recordset1);

?>
<?php
mysql_free_result($Recordset2);


?>
