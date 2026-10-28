<?php require_once('../Connections/stockcode.php'); ?>
<?php require_once('../Connections/external.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_external = new KT_connection($external, $database_external);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("prefix", true, "text", "", "", "", "");
$formValidation->addField("middle", true, "text", "", "", "", "");
$formValidation->addField("suffix", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

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
$query_prefix = "SELECT code FROM prefixcode ORDER BY id ASC";
$prefix = mysql_query($query_prefix, $stockcode) or die(mysql_error());
$row_prefix = mysql_fetch_assoc($prefix);
$totalRows_prefix = mysql_num_rows($prefix);

mysql_select_db($database_stockcode, $stockcode);
$query_stonename = "SELECT name FROM stonename ORDER BY id ASC";
$stonename = mysql_query($query_stonename, $stockcode) or die(mysql_error());
$row_stonename = mysql_fetch_assoc($stonename);
$totalRows_stonename = mysql_num_rows($stonename);

mysql_select_db($database_stockcode, $stockcode);
$query_stocktype = "SELECT * FROM stocktype ORDER BY id ASC";
$stocktype = mysql_query($query_stocktype, $stockcode) or die(mysql_error());
$row_stocktype = mysql_fetch_assoc($stocktype);
$totalRows_stocktype = mysql_num_rows($stocktype);

// Make an insert transaction instance
$ins_stock = new tNG_insert($conn_external);
$tNGs->addTransaction($ins_stock);
// Register triggers
$ins_stock->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_stock->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_stock->registerTrigger("END", "Trigger_Default_Redirect", 99, "/index.php");
// Add columns
$ins_stock->setTable("stock");
$ins_stock->addColumn("prefix", "STRING_TYPE", "POST", "prefix");
$ins_stock->addColumn("middle", "STRING_TYPE", "POST", "middle");
$ins_stock->addColumn("suffix", "STRING_TYPE", "POST", "suffix");
$ins_stock->addColumn("name", "STRING_TYPE", "POST", "name");
$ins_stock->addColumn("description", "STRING_TYPE", "POST", "description");
$ins_stock->addColumn("stocktype", "NUMERIC_TYPE", "POST", "stocktype");
$ins_stock->addColumn("unitofmeasure", "NUMERIC_TYPE", "POST", "unitofmeasure");
$ins_stock->addColumn("stock", "NUMERIC_TYPE", "POST", "stock");
$ins_stock->addColumn("imageloc", "STRING_TYPE", "POST", "imageloc");
$ins_stock->addColumn("price", "DOUBLE_TYPE", "POST", "price");
$ins_stock->addColumn("rate", "NUMERIC_TYPE", "POST", "rate");
$ins_stock->addColumn("purchaseprice", "DOUBLE_TYPE", "POST", "purchaseprice");
$ins_stock->addColumn("outlet", "CHECKBOX_1_0_TYPE", "POST", "outlet", "0");
$ins_stock->addColumn("onpage", "CHECKBOX_1_0_TYPE", "POST", "onpage", "0");
$ins_stock->addColumn("dateofadd", "DATE_TYPE", "POST", "dateofadd");
$ins_stock->addColumn("producttype", "NUMERIC_TYPE", "POST", "producttype");
$ins_stock->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsstock = $tNGs->getRecordset("stock");
$row_rsstock = mysql_fetch_assoc($rsstock);
$totalRows_rsstock = mysql_num_rows($rsstock);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="prefix">Prefix:</label></td>
      <td><select name="prefix" id="prefix">
        <?php 
do {  
?>
        <option value="<?php echo $row_prefix['code']?>"<?php if (!(strcmp($row_prefix['code'], $row_rsstock['prefix']))) {echo "SELECTED";} ?>><?php echo $row_prefix['code']?></option>
        <?php
} while ($row_prefix = mysql_fetch_assoc($prefix));
  $rows = mysql_num_rows($prefix);
  if($rows > 0) {
      mysql_data_seek($prefix, 0);
	  $row_prefix = mysql_fetch_assoc($prefix);
  }
?>
      </select>
        <?php echo $tNGs->displayFieldError("stock", "prefix"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="middle">Middle:</label></td>
      <td><select name="middle" id="middle">
        <?php 
do {  
?>
        <option value="<?php echo $row_stonename['name']?>"<?php if (!(strcmp($row_stonename['name'], $row_rsstock['middle']))) {echo "SELECTED";} ?>><?php echo $row_stonename['name']?></option>
        <?php
} while ($row_stonename = mysql_fetch_assoc($stonename));
  $rows = mysql_num_rows($stonename);
  if($rows > 0) {
      mysql_data_seek($stonename, 0);
	  $row_stonename = mysql_fetch_assoc($stonename);
  }
?>
      </select>
        <?php echo $tNGs->displayFieldError("stock", "middle"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="suffix">Suffix:</label></td>
      <td><input type="text" name="suffix" id="suffix" value="<?php echo KT_escapeAttribute($row_rsstock['suffix']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("suffix");?> <?php echo $tNGs->displayFieldError("stock", "suffix"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="description">Description:</label></td>
      <td><input type="text" name="description" id="description" value="<?php echo KT_escapeAttribute($row_rsstock['description']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("description");?> <?php echo $tNGs->displayFieldError("stock", "description"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="stocktype">Stocktype:</label></td>
      <td><select name="stocktype" id="stocktype">
        <?php 
do {  
?>
        <option value="<?php echo $row_stocktype['id']?>"<?php if (!(strcmp($row_stocktype['id'], $row_rsstock['stocktype']))) {echo "SELECTED";} ?>><?php echo $row_stocktype['type']?></option>
        <?php
} while ($row_stocktype = mysql_fetch_assoc($stocktype));
  $rows = mysql_num_rows($stocktype);
  if($rows > 0) {
      mysql_data_seek($stocktype, 0);
	  $row_stocktype = mysql_fetch_assoc($stocktype);
  }
?>
      </select>
        <?php echo $tNGs->displayFieldError("stock", "stocktype"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="unitofmeasure">Unitofmeasure:</label></td>
      <td><input type="text" name="unitofmeasure" id="unitofmeasure" value="<?php echo KT_escapeAttribute($row_rsstock['unitofmeasure']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("unitofmeasure");?> <?php echo $tNGs->displayFieldError("stock", "unitofmeasure"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="stock">Stock:</label></td>
      <td><input type="text" name="stock" id="stock" value="<?php echo KT_escapeAttribute($row_rsstock['stock']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("stock");?> <?php echo $tNGs->displayFieldError("stock", "stock"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="price">Price:</label></td>
      <td><input type="text" name="price" id="price" value="<?php echo KT_escapeAttribute($row_rsstock['price']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("price");?> <?php echo $tNGs->displayFieldError("stock", "price"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="rate">Rate:</label></td>
      <td><input type="text" name="rate" id="rate" value="<?php echo KT_escapeAttribute($row_rsstock['rate']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("rate");?> <?php echo $tNGs->displayFieldError("stock", "rate"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="purchaseprice">Purchaseprice:</label></td>
      <td><input type="text" name="purchaseprice" id="purchaseprice" value="<?php echo KT_escapeAttribute($row_rsstock['purchaseprice']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("purchaseprice");?> <?php echo $tNGs->displayFieldError("stock", "purchaseprice"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="outlet">Outlet:</label></td>
      <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsstock['outlet']),"1"))) {echo "checked";} ?> type="checkbox" name="outlet" id="outlet" value="1" />
        <?php echo $tNGs->displayFieldError("stock", "outlet"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="onpage">Onpage:</label></td>
      <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsstock['onpage']),"1"))) {echo "checked";} ?> type="checkbox" name="onpage" id="onpage" value="1" />
        <?php echo $tNGs->displayFieldError("stock", "onpage"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="producttype">Producttype:</label></td>
      <td><select name="producttype" id="producttype">
        <?php 
do {  
?>
        <option value="<?php echo $row_stocktype['id']?>"<?php if (!(strcmp($row_stocktype['id'], $row_rsstock['producttype']))) {echo "SELECTED";} ?>><?php echo $row_stocktype['type']?></option>
        <?php
} while ($row_stocktype = mysql_fetch_assoc($stocktype));
  $rows = mysql_num_rows($stocktype);
  if($rows > 0) {
      mysql_data_seek($stocktype, 0);
	  $row_stocktype = mysql_fetch_assoc($stocktype);
  }
?>
      </select>
        <?php echo $tNGs->displayFieldError("stock", "producttype"); ?></td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="name" id="name" value="<?php echo KT_escapeAttribute($row_rsstock['name']); ?>" />
  <input type="hidden" name="imageloc" id="imageloc" value="<?php echo KT_escapeAttribute($row_rsstock['imageloc']); ?>" />
  <input type="hidden" name="dateofadd" id="dateofadd" value="<?php echo KT_formatDate($row_rsstock['dateofadd']); ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($prefix);

mysql_free_result($stonename);

mysql_free_result($stocktype);
?>
