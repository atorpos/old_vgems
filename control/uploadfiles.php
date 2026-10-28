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
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("Filedata");
  $uploadObj->setDbFieldName("imageloc");
  $uploadObj->setFolder("../images/products/");
  $uploadObj->setResize("true", 400, 400);
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_Redirect trigger
//remove this line if you want to edit the code by hand
function Trigger_Redirect(&$tNG) {
  $redObj = new tNG_Redirect($tNG);
  $redObj->setURL(KT_getFullUri());
  $redObj->setKeepURLParams(false);
  return $redObj->Execute();
}
//end Trigger_Redirect trigger

// Make an insert transaction instance
$ins_stock = new tNG_insert($conn_external);
$tNGs->addTransaction($ins_stock);
// Register triggers
$ins_stock->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_stock->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_stock->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "FILES", "Filedata");
$ins_stock->registerConditionalTrigger("{GET.isFlash} != 1", "END", "Trigger_Redirect", 90);
$ins_stock->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$ins_stock->registerConditionalTrigger("{GET.isFlash} == 1", "ERROR", "Trigger_Default_MUploadError", 10);
// Add columns
$ins_stock->setTable("stock");
$ins_stock->addColumn("prefix", "STRING_TYPE", "VALUE", "");
$ins_stock->addColumn("middle", "STRING_TYPE", "VALUE", "");
$ins_stock->addColumn("suffix", "STRING_TYPE", "VALUE", "");
$ins_stock->addColumn("name", "STRING_TYPE", "VALUE", "");
$ins_stock->addColumn("description", "STRING_TYPE", "VALUE", "");
$ins_stock->addColumn("stocktype", "NUMERIC_TYPE", "VALUE", "");
$ins_stock->addColumn("unitofmeasure", "NUMERIC_TYPE", "VALUE", "");
$ins_stock->addColumn("stock", "NUMERIC_TYPE", "VALUE", "");
$ins_stock->addColumn("price", "DOUBLE_TYPE", "VALUE", "");
$ins_stock->addColumn("rate", "NUMERIC_TYPE", "VALUE", "");
$ins_stock->addColumn("purchaseprice", "DOUBLE_TYPE", "VALUE", "");
$ins_stock->addColumn("outlet", "CHECKBOX_1_0_TYPE", "VALUE", "");
$ins_stock->addColumn("onpage", "CHECKBOX_1_0_TYPE", "VALUE", "");
$ins_stock->addColumn("dateofadd", "DATE_TYPE", "VALUE", "");
$ins_stock->addColumn("producttype", "NUMERIC_TYPE", "VALUE", "");
$ins_stock->addColumn("imageloc", "FILE_TYPE", "FILES", "Filedata");
$ins_stock->setPrimaryKey("imageloc", "STRING_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsstock = $tNGs->getRecordset("stock");
$row_rsstock = mysql_fetch_assoc($rsstock);
$totalRows_rsstock = mysql_num_rows($rsstock);

// Multiple Upload Helper Object
$muploadHelper = new tNG_MuploadHelper("../", 32);
$muploadHelper->setMaxSize(1500);
$muploadHelper->setMaxNumber(0);
$muploadHelper->setExistentNumber(0);
$muploadHelper->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
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
<?php echo $tNGs->displayValidationRules();?><?php echo $muploadHelper->getScripts(); ?>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<?php
// Multiple Upload Helper
echo $tNGs->getSavedErrorMsg();
echo $muploadHelper->Execute();
?>
</body>
</html>