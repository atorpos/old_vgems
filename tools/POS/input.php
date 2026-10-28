<?php require_once('../../Connections/stockcode.php'); ?>
<?php require_once('../../Connections/OfficeSQL.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO stockinfo (`prefix`, stonename, `size`, type, `description`, price, stock, refill) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['prefix'], "text"),
                       GetSQLValueString($_POST['stonename'], "text"),
                       GetSQLValueString($_POST['size'], "text"),
                       GetSQLValueString($_POST['type'], "int"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['price'], "double"),
                       GetSQLValueString($_POST['stock'], "int"),
                       GetSQLValueString($_POST['refill'], "int"));

  mysql_select_db($database_OfficeSQL, $OfficeSQL);
  $Result1 = mysql_query($insertSQL, $OfficeSQL) or die(mysql_error());
}

mysql_select_db($database_stockcode, $stockcode);
$query_Recordset1 = "SELECT * FROM prefixcode ORDER BY code ASC";
$Recordset1 = mysql_query($query_Recordset1, $stockcode) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_stockcode, $stockcode);
$query_Recordset2 = "SELECT * FROM stonename ORDER BY name ASC";
$Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Prefix:</td>
      <td><select name="prefix">
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset1['code']?>" ><?php echo $row_Recordset1['code']; ?></option>
        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">Stonename:</td>
      <td><select name="stonename">
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset2['name']?>" ><?php echo $row_Recordset2['name']; ?></option>
        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">Size:</td>
      <td><input type="text" name="size" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Type:</td>
      <td><select name="type">
        <option value="01" <?php if (!(strcmp(01, ""))) {echo "SELECTED";} ?>>Beads</option>
        <option value="02" <?php if (!(strcmp(02, ""))) {echo "SELECTED";} ?>>Cabochon</option>
        <option value="03" <?php if (!(strcmp(03, ""))) {echo "SELECTED";} ?>>Pendant</option>
        <option value="04" <?php if (!(strcmp(04, ""))) {echo "SELECTED";} ?>>Bracelet</option>
        <option value="05" <?php if (!(strcmp(05, ""))) {echo "SELECTED";} ?>>Earring</option>
        <option value="06" <?php if (!(strcmp(06, ""))) {echo "SELECTED";} ?>>Necklace</option>
        <option value="07" <?php if (!(strcmp(07, ""))) {echo "SELECTED";} ?>>Ring</option>
        <option value="08" <?php if (!(strcmp(08, ""))) {echo "SELECTED";} ?>>Carving</option>
        <option value="09" <?php if (!(strcmp(09, ""))) {echo "SELECTED";} ?>>Globe</option>
        <option value="10" <?php if (!(strcmp(10, ""))) {echo "SELECTED";} ?>>Accessory</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Description (optional):</td>
      <td><input type="text" name="description" value="*Optional" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Price:</td>
      <td><input type="text" name="price" value="0.0" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Stock:</td>
      <td><input type="text" name="stock" value="0" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Refill:</td>
      <td><input type="text" name="refill" value="1" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
