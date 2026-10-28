<?php require_once('../Connections/stockcode.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_stockcode = new KT_connection($stockcode, $database_stockcode);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("code", true, "text", "", "", "", "");
$formValidation->addField("description", true, "text", "", "", "", "");
$formValidation->addField("type", true, "numeric", "", "", "", "");
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
$query_Recordset1 = "SELECT * FROM stocktype ORDER BY id ASC";
$Recordset1 = mysql_query($query_Recordset1, $stockcode) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

// Make an insert transaction instance
$ins_prefixcode = new tNG_insert($conn_stockcode);
$tNGs->addTransaction($ins_prefixcode);
// Register triggers
$ins_prefixcode->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_prefixcode->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_prefixcode->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php");
// Add columns
$ins_prefixcode->setTable("prefixcode");
$ins_prefixcode->addColumn("code", "STRING_TYPE", "POST", "code");
$ins_prefixcode->addColumn("description", "STRING_TYPE", "POST", "description");
$ins_prefixcode->addColumn("type", "NUMERIC_TYPE", "POST", "type");
$ins_prefixcode->addColumn("specification", "STRING_TYPE", "POST", "specification");
$ins_prefixcode->addColumn("active", "CHECKBOX_1_0_TYPE", "POST", "active", "1");
$ins_prefixcode->addColumn("longdesc", "STRING_TYPE", "POST", "longdesc");
$ins_prefixcode->addColumn("shipping", "STRING_TYPE", "POST", "shipping");
$ins_prefixcode->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsprefixcode = $tNGs->getRecordset("prefixcode");
$row_rsprefixcode = mysql_fetch_assoc($rsprefixcode);
$totalRows_rsprefixcode = mysql_num_rows($rsprefixcode);
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
      <td class="KT_th"><label for="code">Code:</label></td>
      <td><input type="text" name="code" id="code" value="<?php echo KT_escapeAttribute($row_rsprefixcode['code']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("code");?> <?php echo $tNGs->displayFieldError("prefixcode", "code"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="description">Description:</label></td>
      <td><input type="text" name="description" id="description" value="<?php echo KT_escapeAttribute($row_rsprefixcode['description']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("description");?> <?php echo $tNGs->displayFieldError("prefixcode", "description"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="type">Type:</label></td>
      <td><select name="type" id="type">
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset1['id']?>"<?php if (!(strcmp($row_Recordset1['id'], $row_rsprefixcode['type']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['type']?></option>
        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
      </select>
        <?php echo $tNGs->displayFieldError("prefixcode", "type"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="specification">Specification:</label></td>
      <td><input type="text" name="specification" id="specification" value="<?php echo KT_escapeAttribute($row_rsprefixcode['specification']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("specification");?> <?php echo $tNGs->displayFieldError("prefixcode", "specification"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="active">Active:</label></td>
      <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsprefixcode['active']),"1"))) {echo "checked";} ?> type="checkbox" name="active" id="active" value="1" />
        <?php echo $tNGs->displayFieldError("prefixcode", "active"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="longdesc">Longdesc:</label></td>
      <td><textarea name="longdesc" id="longdesc" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsprefixcode['longdesc']); ?></textarea>
        <?php echo $tNGs->displayFieldHint("longdesc");?> <?php echo $tNGs->displayFieldError("prefixcode", "longdesc"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="shipping">Shipping:</label></td>
      <td><textarea name="shipping" id="shipping" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsprefixcode['shipping']); ?></textarea>
        <?php echo $tNGs->displayFieldHint("shipping");?> <?php echo $tNGs->displayFieldError("prefixcode", "shipping"); ?></td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Insert record" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
