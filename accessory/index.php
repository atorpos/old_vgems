<?php require_once('../Connections/external.php'); ?>
<?php require_once('../Connections/stockcode.php');?>
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

mysql_select_db($database_stockcode, $stockcode);
$query_style = "SELECT code, `description` FROM prefixcode ORDER BY code ASC";
$style = mysql_query($query_style, $stockcode) or die(mysql_error());
$row_style = mysql_fetch_assoc($style);
$totalRows_style = mysql_num_rows($style);

mysql_select_db($database_stockcode, $stockcode);
$query_stone = "SELECT name, `description` FROM stonename";
$stone = mysql_query($query_stone, $stockcode) or die(mysql_error());
$row_stone = mysql_fetch_assoc($stone);
$totalRows_stone = mysql_num_rows($stone);

$pagename = "Accessory Products";
$pagetype = "productsvisual";
$sidebarname = $pagename;
?>
<?php include('../header.php'); ?>
<div id="main" align="center">

<table width="999" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><?php include('../scripts/php/php_product_silvstable.php');?></td>
    <td width="249" align="center" valign="top" bgcolor="#383838"><div id="righttitle"><img src="../images/bg_accessory_title.png" /></div>
    <?php include('../sidepanel.php');?></td>
  </tr></table></div>
<?php include('../footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($style);

mysql_free_result($stone);
?>
