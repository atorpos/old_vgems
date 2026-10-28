<?php require_once('Connections/OfficeSQL.php'); ?>
<?php
	if ($_SERVER['HTTPS'] != "on") { 
    	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
    	header("Location: $url"); 
    	exit; 
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "signupform")) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
	$hash = $salt . $password;
	for ( $i = 0; $i < 100000; $i ++ ) {
		$hash = hash('sha256', $hash);
	}
	$hash = $salt . $hash;

  $updateSQL = sprintf("UPDATE customerid SET userid=%s, passwd=%s, firstlogin=%s WHERE customerid=%s",
                       
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($hash, "text"),
                       GetSQLValueString($_POST['firstlogin'], "int"),
                       GetSQLValueString($_POST['customerid'], "int"));

  mysql_select_db($database_OfficeSQL, $OfficeSQL);
  $Result1 = mysql_query($updateSQL, $OfficeSQL) or die(mysql_error());

  $updateGoTo = "testfirstlogin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_firstchange = "-1";
if (isset($_GET['email'])) {
  $colname_firstchange = $_GET['email'];
  $colname_firstcidh = hexdec($_GET['cid']);
  $colname_firstcid = round($colname_firstcidh/65521);
  $colname_firstpid = $_GET['pid'];
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_firstchange = sprintf("SELECT * FROM customerid WHERE email = %s AND pid = %s AND customerid = %s", GetSQLValueString($colname_firstchange, "text"), GetSQLValueString($colname_firstpid, "text"), GetSQLValueString($colname_firstcid, "text"));
$firstchange = mysql_query($query_firstchange, $OfficeSQL) or die(mysql_error());
$row_firstchange = mysql_fetch_assoc($firstchange);
$totalRows_firstchange = mysql_num_rows($firstchange);
if($row_firstchange['firstlogin'] == 1)
{
	header("Location: /signin.php"); 
}
if(empty($row_firstchange['customerid']))
{
	header("Location: /index.php"); 

}
//echo $colname_firstchange;
//echo $colname_firstcid;
//echo $colname_firstpid;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Account setup</title>

<link rel="stylesheet" type="text/css" media="screen" href="milk.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../jquery.validate.password.css" />

<script type="text/javascript" src="/scripts/javascript/jquery/jquery-1.4.2.js"></script>
<script type="text/javascript" src="/scripts/javascript/jquery/jquery.validate.js"></script>
<script type="text/javascript" src="/scripts/javascript/jquery/jquery.validate.password.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<style type="text/css">
body {
	background-color:#8dccbc;
}
a:link {
	color: #999;
	border:none;
}
a:visited {
	color: #333;
}
a:hover {
	color: #666;
}
a:active {
	color: #999;
}
#header {
	background-image: url(/images/bg_signin_logo.png);
	background-repeat: no-repeat;
	height: 40px;
	width:740px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
}
#main {
	background-image:url(images/bg_signin_main.png);
	background-repeat:no-repeat;
	height:365px;
	width:760px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
}
#main #fillin {
	float: left;
	height: auto;
	width: 405px;
	margin: 5px;
}
#fillin h2 {
	padding-left: 30px;
	font-family: sans-serif;
	letter-spacing: -1;
	font-size: 22pt;
}
#main #moreinfo {
	float: right;
	height: 225px;
	width: 325px;
	float: right;
	padding-top: 110px;
	padding-right: 10px;
	padding-left: 5px;
}

#moreinfo p {
	font-family: sans-serif;
	font-size: 13px;
	color: #000000;
	line-height: 18px;
	padding-right: 10px;
	padding-left: 10px;
	border-bottom: gray;
	font-weight: bold;
	letter-spacing: 1px;	
}
#footer {
	height: 40px;
	width: 740px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
	font-size: 10px;
	font-family: sans-serif;
	color: #f3f3f3;
}

#footer .gf-sosumi { width:auto; padding:0 5px; border:none; }
#footer .gf-sosumi .tos { float:right; }
#footer .gf-sosumi .tos a { color:#069; border-color:#666; }

.tos { display: block; zoom: 1; }
.tos:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.tos li { float: left; display: inline; }
.tos a { border-left: 1px solid #797c80; padding: 0 0 0 0.75em; margin-left: 0.75em; }
.tos a.first { border-left: 0 !important; padding-left: 0; margin-left: 0 !important; }

#footer p { margin-bottom: 1em; }
#footer p.gf-buy { float: left; width: 52%; margin: 18px 0 9px 3px; }
#footer ul.tos a { padding: 0 0 0 1.5em; margin-left: 1.5em; border-left: 1px solid #d0d0d0; }
#footer .gf-links { float: right; margin: 18px 3px 9px 0; }
#footer .gf-sosumi { clear: both; width: 100%; padding-top: 9px; }
#footer .gf-sosumi a { padding: 0 10px; }
#footer .gf-sosumi p { float: left; margin-left: 3px; }


#fillin #loginfo {
	padding-top:5px;
	padding-left:50px;
	padding-right:20px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	line-height:20px;
}
#loginfo td {
	height: 40px;
	vertical-align: text-top;
}
#fillin #textfield {
	margin-left: 10px;
	margin-top:20px;
	width: 400px;
	height: 193px;
	overflow: hidden;
	background-image: url(/images/bg_signin_panel.png);
	background-repeat: no-repeat;
}
#textfield h2 {
	font-weight: bold;
	font-size: 12pt;
}
#signupform {
	font-family: sans-serif;
	font-size: 10pt;
	padding-left: 5px;
	font-weight: bold;
}

.password-meter {
	position:relative;
	width: 120px;
}
.password-meter-message {
	text-align: right;
	font-weight: bold;
	color: #676767;
}
.password-meter-bg, .password-meter-bar {
	height: 4px;
}
.password-meter-bg {
	top: 8px;
	background: #e0e0e0;
}

.password-meter-message-very-weak {
	color: #aa0033;
}
.password-meter-message-weak {
	color: #f5ac00;
}
.password-meter-message-good {
	color: #6699cc;
}
.password-meter-message-strong {
	color: #008000;
}

.password-meter-bg .password-meter-very-weak {
	background: #aa0033;
	width: 20px;
}
.password-meter-bg .password-meter-weak {
	background: #f5ac00;
	width: 40px;
}
.password-meter-bg .password-meter-good {
	background: #6699cc;
	width: 80px;
}
.password-meter-bg .password-meter-strong {
	background: #008000;
	width: 120px;
}
.fieldWrapper{
      width: 100%;
    }
.fieldlWrapper form{
      background-color: #ffc;
      border: 1px solid #cc9;
      padding: 10px;
      font-family: verdana;
      width: 75%;
      font-size: 1em;
    }
.inputfield{
      margin: 2px 0 2px 0;
      padding: 0;
    }
.fieldWrapper label{
      float: left;
      text-align: right;
      margin: 0 5px 0 0;
      width: 30%;
    }
.fieldWrapper input{
      width: 200px;
      border: 1px solid #cc9;
    }
.confirmMessage{
      margin: 0;
      padding: 0;
      font-size: .8em;
    }

</style>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header" onclick="window.location = 'http://www.vigorgems.com/';"></div>

<div id="main">
	<div id="fillin">
	<h2>One Step to setup</h2>
	<div id="textfield">
		<h2>Choose your own username and password</h2>
		<div class="fieldWrapper">
      		<form id="signupform" name="signupform" autocomplete="off" method="post" action="<?php echo $editFormAction; ?>">
	  		  <div class="inputfield">
	  			<label id="lusername" for="username">Username</label>
	  			<span id="sprytextfield1">
                <input id="username" name="username" type="text" value="" maxlength="32" /><br />
                <span class="textfieldRequiredMsg">Username is required.</span><span class="textfieldMinCharsMsg">At least 4 characters.</span><span class="textfieldMaxCharsMsg">Maximum characters is 10.</span></span></div>
	  		  <div class="inputfield">
	  			<label id="lpassword" for="password">Password</label>
	  			<span id="sprypassword1">
                <input id="password" name="password" type="password" maxlength="32" value=""/><br />
                <span class="passwordRequiredMsg">Password is required.</span><span class="passwordMinCharsMsg">At least 4 characters.</span><span class="passwordMaxCharsMsg">Maximum characters is 10.</span></span></div>
	  		  <div class="inputfield">
	  			<label id="lpassword_confirm" for="password_confirm">Confirm Password</label>
	  			<span id="spryconfirm1">
	  			<input id="password_confirm" name="password_confirm" type="password" maxlength="32" value=""/><br />
	  			<span class="confirmRequiredMsg">Password confirm is required.</span><span class="confirmInvalidMsg">The password don't match.</span></span><span id="confirmMessage" class="confirmMessage"></span>
	  		  </div>
	  		  <div class="inputfield">
	  			<label id="lsignupsubmit" for="signupsubmit">Signup</label>
	  			<input type="hidden" name="firstlogin" value="1">
	            <input id="signupsubmit" name="signup" type="submit" value="Signup" />
	            <input type="hidden" name="MM_update" value="signupform">
	            <input type="hidden" name="customerid" value="<?php echo $row_firstchange['customerid']; ?>">
	  		  </div>
          </form>
		</div>
      </div>
	</div>
<div id="moreinfo">
	<p>Halo!</p>
	<p>This registration was sended to <?php echo $row_firstchange['email']?>. Please choose your id and password to access your sales portal.</p>
	<p>Need help? <a href="mailto:info@vigorgems.com">Contact us now</a></p>
	</div>
</div>
<div id="footer">
<div class="gf-sosumi">
	<p>Copyright &copy; 2012 AltaWoz Dev. &amp; Vigor Gems and Jewelry LTD All rights reserved</p>

	<ul class="tos">
				<li><a href="http://www.vigorgems.com/tou.php" class="first">Terms of Use</a></li>
				<li><a href="http://www.vigorgems.com/privacy.php">Privacy Policy</a></li>
			</ul>
</div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], minChars:4, maxChars:10});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:4, maxChars:12, validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($firstchange);
?>