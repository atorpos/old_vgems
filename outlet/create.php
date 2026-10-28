<?php


// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');
require_once('../Connections/login.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_login = new KT_connection($login, $database_login);

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

//start Trigger_WelcomeEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_WelcomeEmail(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{KT_defaultSender}");
  $emailObj->setTo("{email}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("Welcome");
  //FromFile method
  $emailObj->setContentFile("../includes/mailtemplates/welcome.html");
  $emailObj->setEncoding("ISO-8859-1");
  $emailObj->setFormat("HTML/Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_WelcomeEmail trigger

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

mysql_select_db($database_login, $login);
$query_getid = "SELECT codeprefix, codesuffix FROM customerfiles WHERE codeprefix = 'OUT'";
$getid = mysql_query($query_getid, $login) or die(mysql_error());
$row_getid = mysql_fetch_assoc($getid);
$totalRows_getid = mysql_num_rows($getid);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("firstname", true, "text", "", "", "", "");
$formValidation->addField("lastname", true, "text", "", "", "", "");
$formValidation->addField("address", true, "text", "", "", "", "");
$formValidation->addField("city", true, "text", "", "", "", "");
$formValidation->addField("state", true, "text", "", "", "", "");
$formValidation->addField("zip", true, "text", "", "", "", "");
$formValidation->addField("country", true, "text", "", "", "", "");
$formValidation->addField("tel", true, "text", "", "", "", "");
$formValidation->addField("email", true, "text", "", "", "", "");
$formValidation->addField("password", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$userRegistration = new tNG_insert($conn_login);
$tNGs->addTransaction($userRegistration);
// Register triggers
$userRegistration->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$userRegistration->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$userRegistration->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
$userRegistration->registerConditionalTrigger("{POST.password} != {POST.re_password}", "BEFORE", "Trigger_CheckPasswords", 50);
$userRegistration->registerTrigger("AFTER", "Trigger_WelcomeEmail", 40);
// Add columns
$userRegistration->setTable("customerfiles");
$userRegistration->addColumn("codeprefix", "STRING_TYPE", "POST", "codeprefix");
$userRegistration->addColumn("codesuffix", "NUMERIC_TYPE", "POST", "codesuffix");
$userRegistration->addColumn("companyname", "STRING_TYPE", "POST", "companyname");
$userRegistration->addColumn("prefix", "STRING_TYPE", "POST", "prefix");
$userRegistration->addColumn("firstname", "STRING_TYPE", "POST", "firstname");
$userRegistration->addColumn("lastname", "STRING_TYPE", "POST", "lastname");
$userRegistration->addColumn("address", "STRING_TYPE", "POST", "address");
$userRegistration->addColumn("city", "STRING_TYPE", "POST", "city");
$userRegistration->addColumn("state", "STRING_TYPE", "POST", "state");
$userRegistration->addColumn("zip", "STRING_TYPE", "POST", "zip");
$userRegistration->addColumn("country", "STRING_TYPE", "POST", "country");
$userRegistration->addColumn("tel", "STRING_TYPE", "POST", "tel");
$userRegistration->addColumn("fax", "STRING_TYPE", "POST", "fax");
$userRegistration->addColumn("otherphone", "STRING_TYPE", "POST", "otherphone");
$userRegistration->addColumn("email", "STRING_TYPE", "POST", "email");
$userRegistration->addColumn("website", "STRING_TYPE", "POST", "website");
$userRegistration->addColumn("username", "STRING_TYPE", "POST", "username");
$userRegistration->addColumn("password", "STRING_TYPE", "POST", "password");
$userRegistration->addColumn("sfirstname", "STRING_TYPE", "POST", "sfirstname");
$userRegistration->addColumn("slastname", "STRING_TYPE", "POST", "slastname");
$userRegistration->addColumn("scompany", "STRING_TYPE", "POST", "scompany");
$userRegistration->addColumn("sphone", "STRING_TYPE", "POST", "sphone");
$userRegistration->addColumn("saddress", "STRING_TYPE", "POST", "saddress");
$userRegistration->addColumn("scity", "STRING_TYPE", "POST", "scity");
$userRegistration->addColumn("sstate", "STRING_TYPE", "POST", "sstate");
$userRegistration->addColumn("szip", "STRING_TYPE", "POST", "szip");
$userRegistration->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustomerfiles = $tNGs->getRecordset("customerfiles");
$row_rscustomerfiles = mysql_fetch_assoc($rscustomerfiles);
$totalRows_rscustomerfiles = mysql_num_rows($rscustomerfiles);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Expires" content="09-03-2011" />
<link rel="shortcut icon" href="http://vigorgems.com/vigor.ico" />
<style type="text/css">
<!--
@import url("../scripts/css/index.css");
@import url("../scripts/css/shop.css");
@import url("../scripts/css/menu.css");
-->
</style> 
<title>Vigor Gems &amp; Jewellery - Account</title><link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../includes/common/js/base.js" type="text/javascript"></script><script src="../includes/common/js/utility.js" type="text/javascript"></script><script src="../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?>
<script type="text/javascript">
function showsubmenu(id){
	submenu=document.getElementById('s'+id);
	for(i=1;i<=8;i++){
		if(i==id){
			submenu.style.display="block";
		} else{
			document.getElementById('s'+i).style.display="none";
		}
	}
}
</script>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<div id="header"><img src="../images/headerlogo.jpg" />
<div id="navigation" align="justify">
<ul id="mymenu">
	<li><a href="../index.php" onmouseover="javascript:showsubmenu(1)">HOME</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(6)">SEMI-PRECIOUS STONE</a></li>
	<li><a href="#" onmouseover="javascript:showsubmenu(2)">JEWELRY</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(8)">COLLECTIONS</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(3)">EXHIBITION</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(4)">OUR FACTORY</a></li>
    <li><a href="#" onmouseover="javascript:showsubmenu(5)">CUSTOMER SERVICE</a></li>
	<li><a href="../aboutus.php" onmouseover="javascript:showsubmenu(7)">COMPANY INFO</a></li>
</ul>
</div>
<div id="sublinks">
<ul id="s1">
        <li></li>
    </ul>
	<ul id="s6">
        <li><a href="#">BEADS</a></li>
        <li><a href="#">CABOCHON</a></li>     
        <li><a href="#">PENDANT</a></li>
    </ul>
    <ul id="s2">
        <li><a href="#">BRACELET</a></li> <li><a href="#">EARRING</a></li><li><a href="#">NECKLET</a></li><li><a href="#">STREELESS STEEL</a></li>   <li><a href="#">925 SILVER</a></li>
        
        
    </ul>
    <ul id="s3">
        <li><a href="#">GENERAL INFO.</a></li>
        <li><a href="#">SPRING</a></li>
        <li><a href="#">SUMMER</a></li>
        <li><a href="#">FALL</a></li>
        <li><a href="#">OVER SEA</a></li>
    </ul>
     <ul id="s4">
        <li><a href="#">LOCATION</a></li>
    </ul>
    <ul id="s5">
        <li><a href="#">CHECK YOUR STATUS</a></li><li><a href="#">MAKE AN APPOINTMENT</a></li><li><a href="#">ORDER OUR PRODUCT</a></li>
    </ul>
    <ul id="s7">
        <li><a href="aboutus.php">ABOUT US</a></li><li><a href="jobs.php">JOBS</a></li><li><a href="pressbox.php">PRESS BOX</a></li>
    </ul>
    <ul id="s8">
        <li><a href="#">CARVING</a></li></li><li><li><a href="#">GLOBE</a></li>
    </ul>
    
</div>
</div>
<div id="main" align="center">
<div id="outlettop">
  <div align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td><ul><li>beads</li><li>bracelets</li><li>cabochons</li><li>globe</li><li>necklaces</li><li>pendants</li><li>925 silver</li></ul></td><td><div align="right"><ul><li>My Account</li> | <li>My Cart</li></ul></div></td></tr></table>
  </div>
</div><table width="1000" border="0" cellpadding="0" cellspacing="0">
  <tr><td valign="top" align="center"><div id="shopnav" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td width="50%"><img src="../images/bg_outlet_welcomesign.gif" /></td><td width="50%" align="right">Call Back | Tel: +852-23562083</td>
    </tr><tr><td></td><td align="right"></td></tr></table></div><table width="690" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="150"><img src="../images/bg_cart_yourcart.gif" width="150" height="30" /></td><td align="right" valign="bottom" width="540"><img src="../images/tap_cart_01.gif" width="133" height="20" /><img src="../images/tap_cart_02_onpage.gif" /><img src="../images/tap_cart_03.gif" /><img src="../images/tap_cart_04.gif" /></td>
  </tr></table><br /><table width="690" border="0" cellpadding="0" cellspacing="0" ><tr>
    <td><form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>"><img src="../images/bg_create_title.gif" /><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr><td><div id="billdiv"><strong>Billing Address</strong><hr size="1"  /><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td><div id="formlable">First Name</div><input type="text" name="firstname" id="firstname" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['firstname']); ?>" size="16" />
          <?php echo $tNGs->displayFieldHint("firstname");?> <?php echo $tNGs->displayFieldError("customerfiles", "firstname"); ?></td><td><div id="formlable">Last Name</div><input type="text" name="lastname" id="lastname" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['lastname']); ?>" size="16" />
          <?php echo $tNGs->displayFieldHint("lastname");?> <?php echo $tNGs->displayFieldError("customerfiles", "lastname"); ?></td></tr></table>
      <div id="formlable">Company Name (if purchase by Company )</div><input type="text" name="companyname" id="companyname" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['companyname']); ?>" size="25" /><?php echo $tNGs->displayFieldHint("companyname");?> <?php echo $tNGs->displayFieldError("customerfiles", "companyname"); ?><div id="formlable">Address<br />(We cannot ship to PO boxes.)</div>
      <input type="text" name="address" id="address" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['address']); ?>" size="35" />
          <?php echo $tNGs->displayFieldHint("address");?> <?php echo $tNGs->displayFieldError("customerfiles", "address"); ?><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td width="30%"><div id="formlable">City</div></td><td width="20%"><div id="formlable">State</div></td><td width="20%"><div id="formlable">Zip/Postal</div></td></tr><tr><td><input type="text" name="city" id="city" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['city']); ?>" size="10" />
          <?php echo $tNGs->displayFieldHint("city");?> <?php echo $tNGs->displayFieldError("customerfiles", "city"); ?></td><td><input type="text" name="state" id="state" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['state']); ?>" size="3" />
          <?php echo $tNGs->displayFieldHint("state");?> <?php echo $tNGs->displayFieldError("customerfiles", "state"); ?></td><td><input type="text" name="zip" id="zip" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['zip']); ?>" size="6" />
          <?php echo $tNGs->displayFieldHint("zip");?> <?php echo $tNGs->displayFieldError("customerfiles", "zip"); ?></td></tr></table><div id="formlable">Country</div><select name="country">
           <option value="0">Afghanistan</option>
          <option value="1">Albania</option>
          <option value="2">Algeria</option>
          <option value="3">American Samoa</option>
          <option value="4">Andorra</option>
          <option value="5" selected="selected">Angola</option>
          <option value="6">Anguilla</option>
          <option value="7">Antarctica</option>
          <option value="8">Antigua And Barbuda</option>
          <option value="9">Argentina</option>
          <option value="10">Armenia</option>
          <option value="11">Aruba</option>
          <option value="12">Australia</option>
          <option value="13">Austria</option>
          <option value="14">Azerbaijan</option>
          <option value="15">Bahamas</option>
          <option value="16">Bahrain</option>
          <option value="17">Bangladesh</option>
          <option value="18">Barbados</option>
          <option value="19">Belarus</option>
          <option value="20">Belgium</option>
          <option value="21">Belize</option>
          <option value="22">Benin</option>
          <option value="23">Bermuda</option>
          <option value="24">Bhutan</option>
          <option value="25">Bolivia</option>
          <option value="26">Bosnia And Herzegovina</option>
          <option value="27">Botswana</option>
          <option value="28">Bouvet Island</option>
          <option value="29">Brazil</option>
          <option value="30">British Indian Ocean Territory</option>
          <option value="31">Brunei Darussalam</option>
          <option value="32">Bulgaria</option>
          <option value="33">Burkina Faso</option>
          <option value="34">Burundi</option>
          <option value="35">Cambodia</option>
          <option value="36">Cameroon</option>
          <option value="37">Canada</option>
          <option value="38">Cape Verde</option>
          <option value="39">Cayman Islands</option>
          <option value="40">Central African Republic</option>
          <option value="41">Chad</option>
          <option value="42">Chile</option>
          <option value="43">China</option>
          <option value="44">Christmas Island</option>
          <option value="45">Cocos (Keeling) Islands</option>
          <option value="46">Colombia</option>
          <option value="47">Comorian</option>
          <option value="48">Congo</option>
          <option value="49">Congo Democratic Republic</option>
          <option value="50">Cook Islands</option>
          <option value="51">Costa Rica</option>
          <option value="52">Cote DIvoire</option>
          <option value="53">Croatia</option>
          <option value="54">Cyprus</option>
          <option value="55">Czech Republic</option>
          <option value="112">Democratic R Of Lao People S </option>
          <option value="56">Denmark</option>
          <option value="57">Djibouti</option>
          <option value="58">Dominica</option>
          <option value="59">Dominican Republic</option>
          <option value="60">East Timor</option>
          <option value="61">Ecuador</option>
          <option value="62">Egypt</option>
          <option value="63">El Salvador</option>
          <option value="64">Equatorial Guinea</option>
          <option value="65">Eritrea</option>
          <option value="66">Estonia</option>
          <option value="67">Ethiopia</option>
          <option value="68">Falkland Islands Malvinas</option>
          <option value="69">Faroe Islands</option>
          <option value="70">Fiji</option>
          <option value="71">Finland</option>
          <option value="72">France</option>
          <option value="73">French Guiana</option>
          <option value="74">French Polynesia</option>
          <option value="75">French Southern Territories</option>
          <option value="76">Gabon</option>
          <option value="77">Gambia</option>
          <option value="79">Germany</option>
          <option value="80">Ghana</option>
          <option value="81">Gibraltar</option>
          <option value="82">Greece</option>
          <option value="83">Greenland</option>
          <option value="84">Grenada</option>
          <option value="85">Guadeloupe</option>
          <option value="86">Guam</option>
          <option value="87">Guatemala</option>
          <option value="88">Guinea</option>
          <option value="89">Guinea Bissau</option>
          <option value="90">Guyana</option>
          <option value="91">Haiti</option>
          <option value="92">Heard And Mc Donald Islands</option>
          <option value="93">Honduras</option>
          <option value="94">Hong Kong</option>
          <option value="95">Hungary</option>
          <option value="96">Iceland</option>
          <option value="97">India</option>
          <option value="98">Indonesia</option>
          <option value="99">Iraq</option>
          <option value="100">Ireland</option>
          <option value="101">Israel</option>
          <option value="102">Italy</option>
          <option value="103">Jamaica</option>
          <option value="104">Japan</option>
          <option value="105">Jordan</option>
          <option value="106">Kazakhstan</option>
          <option value="107">Kenya</option>
          <option value="108">Kiribati</option>
          <option value="110">Kuwait</option>
          <option value="111">Kyrgyzstan</option>
          <option value="113">Latvia</option>
          <option value="114">Lebanon</option>
          <option value="115">Lesotho</option>
          <option value="116">Liberia</option>
          <option value="117">Liechtenstein</option>
          <option value="118">Lithuania</option>
          <option value="119">Luxembourg</option>
          <option value="120">Macau</option>
          <option value="121">Macedonia</option>
          <option value="122">Madagascar</option>
          <option value="123">Malawi</option>
          <option value="124">Malaysia</option>
          <option value="125">Maldives</option>
          <option value="126">Mali</option>
          <option value="127">Malta</option>
          <option value="128">Marshall Islands</option>
          <option value="129">Martinique</option>
          <option value="130">Mauritania</option>
          <option value="131">Mauritius</option>
          <option value="132">Mayotte</option>
          <option value="133">Mexico</option>
          <option value="134">Micronesia</option>
          <option value="136">Monaco</option>
          <option value="137">Mongolia</option>
          <option value="138">Montserrat</option>
          <option value="139">Morocco</option>
          <option value="140">Mozambique</option>
          <option value="141">Myanmar</option>
          <option value="142">Namibia</option>
          <option value="143">Nauru</option>
          <option value="144">Nepal</option>
          <option value="145">Netherlands</option>
          <option value="146">Netherlands Antilles</option>
          <option value="147">New Caledonia</option>
          <option value="148">New Zealand</option>
          <option value="149">Nicaragua</option>
          <option value="150">Niger</option>
          <option value="151">Nigeria</option>
          <option value="152">Niue</option>
          <option value="153">Norfolk Island</option>
          <option value="154">Northern Mariana Islands</option>
          <option value="155">Norway</option>
          <option value="156">Oman</option>
          <option value="157">Pakistan</option>
          <option value="158">Palau</option>
          <option value="159">Palestinian Territory</option>
          <option value="160">Panama</option>
          <option value="161">Papua New Guinea</option>
          <option value="162">Paraguay</option>
          <option value="163">Peru</option>
          <option value="164">Philippines</option>
          <option value="165">Pitcairn</option>
          <option value="166">Poland</option>
          <option value="167">Portugal</option>
          <option value="168">Puerto Rico</option>
          <option value="169">Qatar</option>
          <option value="78">Republic of Georgia</option>
          <option value="109">Republic Of Korea</option>
          <option value="135">Republic of Moldova</option>
          <option value="170">Reunion</option>
          <option value="171">Romania</option>
          <option value="172">Russian Federation</option>
          <option value="173">Rwanda</option>
          <option value="174">S Georgia &amp; The S Sandwich Isl</option>
          <option value="175">Saint Kitts And Nevis</option>
          <option value="176">Saint Lucia</option>
          <option value="177">Saint Vincent &amp; The Grenadines</option>
          <option value="178">San Marino</option>
          <option value="179">Sao Tome And Principe</option>
          <option value="180">Saudi Arabia</option>
          <option value="181">Scotland</option>
          <option value="182">Senegal</option>
          <option value="183">Seychelles</option>
          <option value="184">Sierra Leone</option>
          <option value="185">Singapore</option>
          <option value="186">Slovakia</option>
          <option value="187">Slovenia</option>
          <option value="188">Solomon Islands</option>
          <option value="189">Somalia</option>
          <option value="190">South Africa</option>
          <option value="191">Spain</option>
          <option value="192">Sri Lanka</option>
          <option value="193">St. Helena</option>
          <option value="194">St. Pierre And Miquelon</option>
          <option value="195">Suriname</option>
          <option value="196">Svalbard And Jan Mayen Islands</option>
          <option value="197">Swaziland</option>
          <option value="198">Sweden</option>
          <option value="199">Switzerland</option>
          <option value="200">Taiwan</option>
          <option value="201">Tajikistan</option>
          <option value="202">Tanzania, United Republic Of</option>
          <option value="203">Thailand</option>
          <option value="204">Togo</option>
          <option value="205">Tokelau</option>
          <option value="206">Tonga</option>
          <option value="207">Trinidad And Tobago</option>
          <option value="208">Tunisia</option>
          <option value="209">Turkey</option>
          <option value="210">Turkmenistan</option>
          <option value="211">Turks And Caicos Islands</option>
          <option value="212">Tuvalu</option>
          <option value="213">Uganda</option>
          <option value="214">Ukraine</option>
          <option value="215">United Arab Emirates</option>
          <option value="216">United Kingdom</option>
          <option value="217">United States</option>
          <option value="218">United States Minor Outlying</option>
          <option value="219">Uruguay</option>
          <option value="220">Uzbekistan</option>
          <option value="221">Vanuatu</option>
          <option value="222">Vatican City State (Holy See)</option>
          <option value="223">Venezuela</option>
          <option value="224">Viet Nam</option>
          <option value="225">Virgin Islands (British)</option>
          <option value="226">Virgin Islands (US)</option>
          <option value="227">Wallis And Futuna Islands</option>
          <option value="228">Western Sahara</option>
          <option value="229">Yemen</option>
          <option value="230">Yugoslavia</option>
          <option value="231">Zambia</option>
          <option value="232">Zimbabwe</option>
                </select><?php echo $tNGs->displayFieldHint("country");?> <?php echo $tNGs->displayFieldError("customerfiles", "country"); ?>
        <div id="formlable">Phone +1-613-2150027</div><input type="text" name="tel" id="tel" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['tel']); ?>" size="24" />
          <?php echo $tNGs->displayFieldHint("tel");?> <?php echo $tNGs->displayFieldError("customerfiles", "tel"); ?><div id="formlable">email</div><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['email']); ?>" size="24" />
          <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("customerfiles", "email"); ?><div id="formlable"><input name="same" type="checkbox" value="checksame" checked />Shipping address same as billing address</div>
      </div></td><td valign="top"><div id="shipdiv"><strong>Shipping Address</strong><hr size="1" /><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td><div id="formlable">First Name</div><input type="text" name="sfirstname" id="sfirstname" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['sfirstname']); ?>" size="16" />
          <?php echo $tNGs->displayFieldHint("sfirstname");?> <?php echo $tNGs->displayFieldError("customerfiles", "sfirstname"); ?></td><td><div id="formlable">Last Name</div><input type="text" name="slastname" id="slastname" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['slastname']); ?>" size="25" />
          <?php echo $tNGs->displayFieldHint("slastname");?> <?php echo $tNGs->displayFieldError("customerfiles", "slastname"); ?> </td></tr></table><div id="formlable">Company Name (if purchase by Company )</div><input type="text" name="scompany" id="scompany" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['scompany']); ?>" size="25" />
          <?php echo $tNGs->displayFieldHint("scompany");?> <?php echo $tNGs->displayFieldError("customerfiles", "scompany"); ?><div id="formlable">Address<br />(We cannot ship to PO boxes.)</div>
      <input type="text" name="saddress" id="saddress" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['saddress']); ?>" size="35" />
          <?php echo $tNGs->displayFieldHint("saddress");?> <?php echo $tNGs->displayFieldError("customerfiles", "saddress"); ?><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td width="30%"><div id="formlable">City</div></td><td width="20%"><div id="formlable">State</div></td><td width="20%"><div id="formlable">Zip/Postal</div></td></tr><tr><td><input type="text" name="scity" id="scity" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['scity']); ?>" size="10" />
          <?php echo $tNGs->displayFieldHint("scity");?> <?php echo $tNGs->displayFieldError("customerfiles", "scity"); ?></td><td><input type="text" name="sstate" id="sstate" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['sstate']); ?>" size="3" />
          <?php echo $tNGs->displayFieldHint("sstate");?> <?php echo $tNGs->displayFieldError("customerfiles", "sstate"); ?></td><td><input type="text" name="szip" id="szip" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['szip']); ?>" size="6" />
          <?php echo $tNGs->displayFieldHint("szip");?> <?php echo $tNGs->displayFieldError("customerfiles", "szip"); ?></td></tr></table><div id="formlable">Country</div><select name="scountry">
          <option value="0">Afghanistan</option>
          <option value="1">Albania</option>
          <option value="2">Algeria</option>
          <option value="3">American Samoa</option>
          <option value="4">Andorra</option>
          <option value="5" selected="selected">Angola</option>
          <option value="6">Anguilla</option>
          <option value="7">Antarctica</option>
          <option value="8">Antigua And Barbuda</option>
          <option value="9">Argentina</option>
          <option value="10">Armenia</option>
          <option value="11">Aruba</option>
          <option value="12">Australia</option>
          <option value="13">Austria</option>
          <option value="14">Azerbaijan</option>
          <option value="15">Bahamas</option>
          <option value="16">Bahrain</option>
          <option value="17">Bangladesh</option>
          <option value="18">Barbados</option>
          <option value="19">Belarus</option>
          <option value="20">Belgium</option>
          <option value="21">Belize</option>
          <option value="22">Benin</option>
          <option value="23">Bermuda</option>
          <option value="24">Bhutan</option>
          <option value="25">Bolivia</option>
          <option value="26">Bosnia And Herzegovina</option>
          <option value="27">Botswana</option>
          <option value="28">Bouvet Island</option>
          <option value="29">Brazil</option>
          <option value="30">British Indian Ocean Territory</option>
          <option value="31">Brunei Darussalam</option>
          <option value="32">Bulgaria</option>
          <option value="33">Burkina Faso</option>
          <option value="34">Burundi</option>
          <option value="35">Cambodia</option>
          <option value="36">Cameroon</option>
          <option value="37">Canada</option>
          <option value="38">Cape Verde</option>
          <option value="39">Cayman Islands</option>
          <option value="40">Central African Republic</option>
          <option value="41">Chad</option>
          <option value="42">Chile</option>
          <option value="43">China</option>
          <option value="44">Christmas Island</option>
          <option value="45">Cocos (Keeling) Islands</option>
          <option value="46">Colombia</option>
          <option value="47">Comorian</option>
          <option value="48">Congo</option>
          <option value="49">Congo Democratic Republic</option>
          <option value="50">Cook Islands</option>
          <option value="51">Costa Rica</option>
          <option value="52">Cote DIvoire</option>
          <option value="53">Croatia</option>
          <option value="54">Cyprus</option>
          <option value="55">Czech Republic</option>
          <option value="112">Democratic R Of Lao People S </option>
          <option value="56">Denmark</option>
          <option value="57">Djibouti</option>
          <option value="58">Dominica</option>
          <option value="59">Dominican Republic</option>
          <option value="60">East Timor</option>
          <option value="61">Ecuador</option>
          <option value="62">Egypt</option>
          <option value="63">El Salvador</option>
          <option value="64">Equatorial Guinea</option>
          <option value="65">Eritrea</option>
          <option value="66">Estonia</option>
          <option value="67">Ethiopia</option>
          <option value="68">Falkland Islands Malvinas</option>
          <option value="69">Faroe Islands</option>
          <option value="70">Fiji</option>
          <option value="71">Finland</option>
          <option value="72">France</option>
          <option value="73">French Guiana</option>
          <option value="74">French Polynesia</option>
          <option value="75">French Southern Territories</option>
          <option value="76">Gabon</option>
          <option value="77">Gambia</option>
          <option value="79">Germany</option>
          <option value="80">Ghana</option>
          <option value="81">Gibraltar</option>
          <option value="82">Greece</option>
          <option value="83">Greenland</option>
          <option value="84">Grenada</option>
          <option value="85">Guadeloupe</option>
          <option value="86">Guam</option>
          <option value="87">Guatemala</option>
          <option value="88">Guinea</option>
          <option value="89">Guinea Bissau</option>
          <option value="90">Guyana</option>
          <option value="91">Haiti</option>
          <option value="92">Heard And Mc Donald Islands</option>
          <option value="93">Honduras</option>
          <option value="94">Hong Kong</option>
          <option value="95">Hungary</option>
          <option value="96">Iceland</option>
          <option value="97">India</option>
          <option value="98">Indonesia</option>
          <option value="99">Iraq</option>
          <option value="100">Ireland</option>
          <option value="101">Israel</option>
          <option value="102">Italy</option>
          <option value="103">Jamaica</option>
          <option value="104">Japan</option>
          <option value="105">Jordan</option>
          <option value="106">Kazakhstan</option>
          <option value="107">Kenya</option>
          <option value="108">Kiribati</option>
          <option value="110">Kuwait</option>
          <option value="111">Kyrgyzstan</option>
          <option value="113">Latvia</option>
          <option value="114">Lebanon</option>
          <option value="115">Lesotho</option>
          <option value="116">Liberia</option>
          <option value="117">Liechtenstein</option>
          <option value="118">Lithuania</option>
          <option value="119">Luxembourg</option>
          <option value="120">Macau</option>
          <option value="121">Macedonia</option>
          <option value="122">Madagascar</option>
          <option value="123">Malawi</option>
          <option value="124">Malaysia</option>
          <option value="125">Maldives</option>
          <option value="126">Mali</option>
          <option value="127">Malta</option>
          <option value="128">Marshall Islands</option>
          <option value="129">Martinique</option>
          <option value="130">Mauritania</option>
          <option value="131">Mauritius</option>
          <option value="132">Mayotte</option>
          <option value="133">Mexico</option>
          <option value="134">Micronesia</option>
          <option value="136">Monaco</option>
          <option value="137">Mongolia</option>
          <option value="138">Montserrat</option>
          <option value="139">Morocco</option>
          <option value="140">Mozambique</option>
          <option value="141">Myanmar</option>
          <option value="142">Namibia</option>
          <option value="143">Nauru</option>
          <option value="144">Nepal</option>
          <option value="145">Netherlands</option>
          <option value="146">Netherlands Antilles</option>
          <option value="147">New Caledonia</option>
          <option value="148">New Zealand</option>
          <option value="149">Nicaragua</option>
          <option value="150">Niger</option>
          <option value="151">Nigeria</option>
          <option value="152">Niue</option>
          <option value="153">Norfolk Island</option>
          <option value="154">Northern Mariana Islands</option>
          <option value="155">Norway</option>
          <option value="156">Oman</option>
          <option value="157">Pakistan</option>
          <option value="158">Palau</option>
          <option value="159">Palestinian Territory</option>
          <option value="160">Panama</option>
          <option value="161">Papua New Guinea</option>
          <option value="162">Paraguay</option>
          <option value="163">Peru</option>
          <option value="164">Philippines</option>
          <option value="165">Pitcairn</option>
          <option value="166">Poland</option>
          <option value="167">Portugal</option>
          <option value="168">Puerto Rico</option>
          <option value="169">Qatar</option>
          <option value="78">Republic of Georgia</option>
          <option value="109">Republic Of Korea</option>
          <option value="135">Republic of Moldova</option>
          <option value="170">Reunion</option>
          <option value="171">Romania</option>
          <option value="172">Russian Federation</option>
          <option value="173">Rwanda</option>
          <option value="174">S Georgia &amp; The S Sandwich Isl</option>
          <option value="175">Saint Kitts And Nevis</option>
          <option value="176">Saint Lucia</option>
          <option value="177">Saint Vincent &amp; The Grenadines</option>
          <option value="178">San Marino</option>
          <option value="179">Sao Tome And Principe</option>
          <option value="180">Saudi Arabia</option>
          <option value="181">Scotland</option>
          <option value="182">Senegal</option>
          <option value="183">Seychelles</option>
          <option value="184">Sierra Leone</option>
          <option value="185">Singapore</option>
          <option value="186">Slovakia</option>
          <option value="187">Slovenia</option>
          <option value="188">Solomon Islands</option>
          <option value="189">Somalia</option>
          <option value="190">South Africa</option>
          <option value="191">Spain</option>
          <option value="192">Sri Lanka</option>
          <option value="193">St. Helena</option>
          <option value="194">St. Pierre And Miquelon</option>
          <option value="195">Suriname</option>
          <option value="196">Svalbard And Jan Mayen Islands</option>
          <option value="197">Swaziland</option>
          <option value="198">Sweden</option>
          <option value="199">Switzerland</option>
          <option value="200">Taiwan</option>
          <option value="201">Tajikistan</option>
          <option value="202">Tanzania, United Republic Of</option>
          <option value="203">Thailand</option>
          <option value="204">Togo</option>
          <option value="205">Tokelau</option>
          <option value="206">Tonga</option>
          <option value="207">Trinidad And Tobago</option>
          <option value="208">Tunisia</option>
          <option value="209">Turkey</option>
          <option value="210">Turkmenistan</option>
          <option value="211">Turks And Caicos Islands</option>
          <option value="212">Tuvalu</option>
          <option value="213">Uganda</option>
          <option value="214">Ukraine</option>
          <option value="215">United Arab Emirates</option>
          <option value="216">United Kingdom</option>
          <option value="217">United States</option>
          <option value="218">United States Minor Outlying</option>
          <option value="219">Uruguay</option>
          <option value="220">Uzbekistan</option>
          <option value="221">Vanuatu</option>
          <option value="222">Vatican City State (Holy See)</option>
          <option value="223">Venezuela</option>
          <option value="224">Viet Nam</option>
          <option value="225">Virgin Islands (British)</option>
          <option value="226">Virgin Islands (US)</option>
          <option value="227">Wallis And Futuna Islands</option>
          <option value="228">Western Sahara</option>
          <option value="229">Yemen</option>
          <option value="230">Yugoslavia</option>
          <option value="231">Zambia</option>
          <option value="232">Zimbabwe</option>
                </select><div id="formlable">Phone +1-613-2150027</div><input type="text" name="sphone" id="sphone" value="<?php echo KT_escapeAttribute($row_rscustomerfiles['sphone']); ?>" size="24" />
          <?php echo $tNGs->displayFieldHint("sphone");?> <?php echo $tNGs->displayFieldError("customerfiles", "sphone"); ?> 
                <input name="codeprefix" type="hidden" value="<?php echo $row_getid['codeprefix']; ?>" /><input name="codesuffix" type="hidden" value="<?php echo $row_getid['codesuffix']+1; ?>" />     </div></td></tr></table><div id="billdiv"><strong>Create Password</strong><hr /><div id="formlable">When you come back to the outlet Store, you can use your email address and a password to access your account information.</div><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td><div id="formlable">Password</div></td><td><div id="formlable">Re-enter Password</div></td></tr><tr><td><input type="password" name="password" id="password" value="" size="24" />
          <?php echo $tNGs->displayFieldHint("password");?> <?php echo $tNGs->displayFieldError("customerfiles", "password"); ?> </td><td><input type="password" name="re_password" id="re_password" value="" size="24" /></td></tr></table><hr /><p align="right"><input  type="image" src="../images/button_create_con.gif" name="KT_Insert1" id="KT_Insert1" value="Register" /></p>
        <br /></div></form></td>
    
  </tr></table>
  <td width="250" align="center" valign="top" bgcolor="#4E4E4E"><div id="righttitle">Your Account Page</div><div id="rightcontents" align="left"><ul>Your Name<li>General Information</li>
					<li>Payment Information</li>
					<li>Purchase History</li>
					</ul>
					  <ul id="cart">your cart<li>echo items</li><li>echo total</li><li>check out</li></ul>
	  </div><div id="internal_adv">special items<p>product img</p><p> More information</p></div></td>
  </tr></table><div id="bottommenu">Pages: </div>
</div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td><div align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></div></td></tr></table>
</div>
</body>
</html>
<?php
mysql_free_result($getid);
?>
