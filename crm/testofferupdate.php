<?php require_once('../Connections/OfficeSQL.php'); ?>
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
  $updateSQL = sprintf("UPDATE offeritems SET productcode=%s, `description`=%s, stone=%s, `size`=%s, price=%s, unit=%s, quantity=%s, comments=%s WHERE voffid=%s",
                       GetSQLValueString($_POST['productcode'], "undefined"),
                       GetSQLValueString($_POST['description'], "undefined"),
                       GetSQLValueString($_POST['stone'], "undefined"),
                       GetSQLValueString($_POST['size'], "undefined"),
                       GetSQLValueString($_POST['price'], "undefined"),
                       GetSQLValueString($_POST['unit'], "undefined"),
                       GetSQLValueString($_POST['quantity'], "int"),
                       GetSQLValueString($_POST['comments'], "text"),
                       GetSQLValueString($_POST['voffid'], "int"));

  mysql_select_db($database_OfficeSQL, $OfficeSQL);
  $Result1 = mysql_query($updateSQL, $OfficeSQL) or die(mysql_error());
}

$colname_PreviousOrder = "-1";
if (isset($_GET['tovof'])) {
  $colname_PreviousOrder = $_GET['tovof'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_PreviousOrder = sprintf("SELECT * FROM offeritems WHERE tovof = %s ORDER BY voffid ASC", GetSQLValueString($colname_PreviousOrder, "int"));
$PreviousOrder = mysql_query($query_PreviousOrder, $OfficeSQL) or die(mysql_error());
$row_PreviousOrder = mysql_fetch_assoc($PreviousOrder);
$totalRows_PreviousOrder = mysql_num_rows($PreviousOrder);
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
      <td nowrap align="right">Voffid:</td>
      <td><?php echo $row_PreviousOrder['voffid']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Productcode:</td>
      <td><?php echo htmlentities($row_PreviousOrder['productcode'], ENT_COMPAT, 'UTF-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Description:</td>
      <td><?php echo htmlentities($row_PreviousOrder['description'], ENT_COMPAT, 'UTF-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Stone:</td>
      <td><?php echo htmlentities($row_PreviousOrder['stone'], ENT_COMPAT, 'UTF-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Size:</td>
      <td><?php echo htmlentities($row_PreviousOrder['size'], ENT_COMPAT, 'UTF-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Price:</td>
      <td><?php echo htmlentities($row_PreviousOrder['price'], ENT_COMPAT, 'UTF-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Unit:</td>
      <td><?php echo htmlentities($row_PreviousOrder['unit'], ENT_COMPAT, 'UTF-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Quantity:</td>
      <td><input type="text" name="quantity" value="<?php echo htmlentities($row_PreviousOrder['quantity'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Comments:</td>
      <td><textarea name="comments" cols="50" rows="5"><?php echo htmlentities($row_PreviousOrder['comments'], ENT_COMPAT, 'UTF-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="voffid" value="<?php echo $row_PreviousOrder['voffid']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($PreviousOrder);
?>
