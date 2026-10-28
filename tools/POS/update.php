<?php require_once('../../Connections/OfficeSQL.php'); ?>
<?php
date_default_timezone_set('America/Los_Angeles');
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
  $updatedate = date('Ymd');
  $insertSQL = sprintf("INSERT INTO stockflow (inputdate, type, sku, amount) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($updatedate),
                       GetSQLValueString($_POST['type'], "int"),
                       GetSQLValueString($_POST['sku'], "int"),
                       GetSQLValueString($_POST['amount'], "int"));
  $updatetype = $_POST['type'];
  $updatesku = $_POST['sku'];
  $updateamount = $_POST['amount'];
  mysql_select_db($database_OfficeSQL, $OfficeSQL);
  $query_update = sprintf("SELECT * FROM stockinfo WHERE (%s) ORDER BY `prefix` ASC", $updatesku);
  $update = mysql_query($query_update, $OfficeSQL) or die(mysql_error());
  $row_update = mysql_fetch_assoc($update);
  
  if ($updatetype == 0 ) {
	  
	  $updatedstock = $row_update['stock'] + $updateamount;
	  
  }else {
	  
	  $updatedstock = $row_update['stock'] - $updateamount;
	  if ($updatedstock <= -1) {
		  $updatedstock = $row_update['stock'];
		  echo "Can't update";
	  } else {
	    echo "Updated Stock" .$updatedstock;
	  }
  }
  $insertUpdate = sprintf("UPDATE stockinfo SET stock=%s WHERE sku=%s", GetSQLValueString($updatedstock, "int"), GETSQLValueString($updatesku, "int"));
  $Resultupdate = mysql_query($insertUpdate, $OfficeSQL) or die(mysql_error());
  $Result1 = mysql_query($insertSQL, $OfficeSQL) or die(mysql_error());
}

mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_sku = "SELECT * FROM stockinfo ORDER BY `prefix` ASC";
$sku = mysql_query($query_sku, $OfficeSQL) or die(mysql_error());
$row_sku = mysql_fetch_assoc($sku);
$totalRows_sku = mysql_num_rows($sku);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php echo date('Ymd'); ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Type:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="type" value="0" >
            Stock in</td>
        </tr>
        <tr>
          <td><input type="radio" name="type" value="1" >
            Stock out</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Sku:</td>
      <td><select name="sku">
        <?php 
do {  
?>
        <option value="<?php echo $row_sku['sku']?>" ><?php echo $row_sku['prefix'].$row_sku['stonename'].$row_sku['size'];?></option>
        <?php
} while ($row_sku = mysql_fetch_assoc($sku));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">Amount:</td>
      <td><input type="text" name="amount" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="inputdate" value="">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($update);
mysql_free_result($sku);
?>
