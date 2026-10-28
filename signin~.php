<?php require_once('Connections/OfficeSQL.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['userid'])) {
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "/crm/";
  $MM_redirectLoginFailed = "/index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_OfficeSQL, $OfficeSQL);

  $loginUsername=$_POST['userid'];
  $password=$_POST['password'];
  $sql = 'SELECT * FROM `customerid` WHERE `userid` = "' .mysql_real_escape_string($loginUsername).'" LIMIT 1;';
  $r = mysql_fetch_assoc(mysql_query($sql));
  $salt = substr($r['passwd'], 0, 64);
  $hash = $salt . $password;

  for ( $i = 0; $i < 100000; $i ++ ) {
  	$hash = hash('sha256', $hash);
  }

  $hash = $salt . $hash;

  $LoginRS__query=sprintf("SELECT userid, passwd FROM `customerid` WHERE userid=%s AND passwd=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($hash, "text"));

  $LoginRS = mysql_query($LoginRS__query, $OfficeSQL) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";

	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    $_SESSION['MM_Userid'] = $r['customerid'];
    $_SESSION['MM_showexe'] = 1;

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Sign in with your Vigor ID</title>
<style type="text/css">
body {
	background-color:#272d32;
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
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="header" onclick="window.location = 'http://www.vigorgems.com';"></div>
<div id="main">
	<div id="fillin">
	<h2>Sign in with your Vigor ID</h2>
	<div id="textfield">
	<h2>Enter your Vigor ID and Password</h2>
	<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" id="loginfo">
	<table>
	<tr>
		<td>
	<label><strong> Vigor ID</strong></label></td>
	<td>
    	<span id="sprytextfield1">
	    	<input name="userid" type="text" size="30" maxlength="52">
	    	<span class="textfieldRequiredMsg">Login id is required.</span></span>
	</td>
	</tr>
    <tr>
    	<td>
    		<label><strong> Password</strong></label>
    	</td>
    	<td>
    		<span id="sprypassword1">
	    	<input name="password" type="password" size="30" maxlength="16">
	    	<span class="passwordRequiredMsg">Password is required.</span></span>
    	</td>
    </tr>
    <tr>
    	<td></td>
    	<td style="text-align:right">
    		<input name="submit" type="submit" value="submit">
    	</td>
    </tr>
	</table>
    		</form>
    		</div>
	</div>
	<div id="moreinfo">
	<p>To access more information about our products and serives, you must enter the Vigor ID and password you used to register as an Vigor Customer.</p>
	<p>Need register? <a href="mailto:info@vigorgems.com">Contact us now</a></p>
	</div>
</div>
<div id="footer">
<div class="gf-sosumi">
	<p>Copyright &copy; 2012 AltaWoz Dev. &amp; Vigor Gems and Jewelry LTD All rights reserved</p>

	<ul class="tos">
				<li><a href="https://www.vigorgems.com/tou.php" class="first">Terms of Use</a></li>
				<li><a href="https://www.vigorgems.com/privacy.php">Privacy Policy</a></li>
			</ul>
</div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>