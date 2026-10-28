<?php require_once('Connections/control.php'); ?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');

// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_control = new KT_connection($control, $database_control);

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Passwords do not match.");
  $myThrowError->setField("password");
  $myThrowError->setFieldErrorMsg("The two passwords do not match.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("id", true, "text", "", "", "", "Please enter a valid user name");
$formValidation->addField("password", true, "text", "", "6", "8", "Please enter a 6 to 8 letters password");
$formValidation->addField("email", true, "text", "email", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$userRegistration = new tNG_insert($conn_control);
$tNGs->addTransaction($userRegistration);
// Register triggers
$userRegistration->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$userRegistration->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$userRegistration->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
$userRegistration->registerConditionalTrigger("{POST.password} != {POST.re_password}", "BEFORE", "Trigger_CheckPasswords", 50);
// Add columns
$userRegistration->setTable("staff");
$userRegistration->addColumn("id", "STRING_TYPE", "POST", "id");
$userRegistration->addColumn("password", "STRING_TYPE", "POST", "password");
$userRegistration->addColumn("email", "STRING_TYPE", "POST", "email");
$userRegistration->addColumn("role", "NUMERIC_TYPE", "POST", "role", "1");
$userRegistration->setPrimaryKey("numb", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsstaff = $tNGs->getRecordset("staff");
$row_rsstaff = mysql_fetch_assoc($rsstaff);
$totalRows_rsstaff = mysql_num_rows($rsstaff);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script src="includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="id">Username:</label></td>
      <td><input type="text" name="id" id="id" value="<?php echo KT_escapeAttribute($row_rsstaff['id']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("id");?> <?php echo $tNGs->displayFieldError("staff", "id"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="password">Password:</label></td>
      <td><input type="password" name="password" id="password" value="" size="32" />
        <?php echo $tNGs->displayFieldHint("password");?> <?php echo $tNGs->displayFieldError("staff", "password"); ?></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="re_password">Re-type Password:</label></td>
      <td><input type="password" name="re_password" id="re_password" value="" size="32" /></td>
    </tr>
    <tr>
      <td class="KT_th"><label for="email">Email:</label></td>
      <td><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rsstaff['email']); ?>" size="32" />
        <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("staff", "email"); ?></td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Register" /></td>
    </tr>
  </table>
  <input type="hidden" name="role" id="role" value="<?php echo KT_escapeAttribute($row_rsstaff['role']); ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>