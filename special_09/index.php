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
    <style>


        .disable_masking
        {
            z-index: 6001;
            position: absolute;
            display: none;
            background-color: #ffffff;
            border: 5px solid #999;
            padding: 20px;
        }
        .closebutton, .myclosebutton
        {
            float: right;
            text-decoration: none;
        }
        .data
        {
           font-size: 12px;
           text-align: justify;
        }
        .viewsiurce
        {
            background-color: #F0F0F0;
            border: 2px dashed #000;
            padding: 20px;
            color: #006633;
            font-size: 15px;


        }
		.form {font-size:10px; font-family:Arial, Helvetica, sans-serif; color:#000000}
.remark{font-family: verdana, Helvetica, sans-serif; 
	font-size: 11px; 
	color: #F68622; 
	font-weight: boldest;
	vertical-align: -2px;}
.title {font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#666666}



    </style>
<title>Vigor Gems &amp; Jewellery - Specials</title>


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
<script type="text/javascript" src="../scripts/javascript/applesearch.js" /></script>
<script type="text/javascript">
	//<![CDATA[
		window.onload = function () { applesearch.init(); }
	//]]>
	</script>
    <script type="text/javascript" src="../scripts/javascript/inlivesearch.js"></script>
    <script type="text/javascript" src="../scripts/javascript/jquery/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="../scripts/javascript/jquery/jquery.floatdialog.js"></script>
    <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function formValidation(form){
	if(notEmpty(form.business)){
		if(notEmpty(form.company)){
			if(notEmpty(form.ints)){
				if(notEmpty(form.name)){
					if(notEmpty(form.name2)){
						if(notEmpty(form.country)){
							if(notEmpty(form.countrycode)){
								if(notEmpty(form.areacode)){
										if(notEmpty(form.number)){
											if(notEmpty(form.email)){
												if(notEmpty(form.checkbox)){
												return true;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return false;
}

function notEmpty(elem){
	var str = elem.value;
	if(str.length == 0){
		alert("You must fill in all required fields (*)");
		return false;
	} else {
		return true;
	}

}
//-->
</script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php $pagename = "Message from Vigorgems key.php Page"; $filename = "http://www.vigorgems.com/special/index.php";?>
<div id="header">
<table width="1000"><tr><td width="80%"><img src="../images/headerlogo.jpg" /></td><td width="20%" align="right"><img src="../images/bg_search.jpg" width="211" height="30" /><form>
  <div id="applesearch">
		<span class="sbox_l"></span><span class="sbox"><input type="text"  placeholder="Search..." autosave="applestyle_srch" results="5"id="txt1" size="30" onKeyUp="showResult(this.value)" /></span><span class="sbox_r" id="srch_clear"></span>
	<div id="livesearch"></div></div></form></td></tr></table><div id="navigation" align="justify">
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
        <li><a href="../beads">BEADS</a></li>
        <li><a href="../cabochon">CABOCHON</a></li>     
        
    </ul>
    <ul id="s2">
        <li><a href="../accessory">ACCESSORY</a></li><li><a href="../bracelet">BRACELET</a></li><li><a href="../earring">EARRING</a></li><li><a href="../necklet">NECKLET</a></li><li><a href="../ring">RING</a></li> 
    </ul>
    <ul id="s3">
        <li><a href="../exhibitions">GENERAL INFO.</a></li>
        <li><a href="../exhibitions">SPRING</a></li>
        <li><a href="../exhibitions">SUMMER</a></li>
        <li><a href="../exhibitions">FALL</a></li>
        <li><a href="../exhibitions">OVER SEA</a></li>
    </ul>
     <ul id="s4">
        <li><a href="../factory">LOCATION</a></li>
    </ul>
    <ul id="s5">
        <li><a href="../customers/status.php">CHECK YOUR STATUS</a></li><li><a href="../customers/mapp.php">MAKE AN APPOINTMENT</a></li><li><a href="../customers/interact.php">ORDER OUR PRODUCT</a></li>
    </ul>
    <ul id="s7">
        <li><a href="../aboutus.php">ABOUT US</a></li><li><a href="../jobs.php">JOBS</a></li><li><a href="../pressbox.php">PRESS BOX</a></li>
    </ul>
    <ul id="s8">
        <li><a href="../carving">CARVING</a></li><li><a href="../globe">GLOBE</a></li>
    </ul>
    
</div>
</div>
<div id="main" align="center">
<div id="newproducts"><div id="win09"><ul id="nav"><li id="key"><a href="index.php">Key</a></li><li id="lock"><a href="lock.php">Lock</a></li><li id="box"><a href="box.php">Box</a></li><li id="rings"><a href="rings.php">Ring</a></li><li id="pred"><a href="pred.php">Pred</a></li></ul></div><div id="09content"><img src="../images/bg_special_banner.jpg" />
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="390px" align="center"><img src="../images/products/sj004.jpg" width="350" height="350" /></td><td width="290px" valign="top"><img src="../images/bg_specialkey_title.jpg" /><p>Heart Shape 925 Silver Key Pendant, 55 mm long key with gemstone inside the heart shape.</p><p>Gemstone available: <ul><li>Rose Quartz</li><li>Lavender Amethyst</li><li>Spark Crystal</li></ul> Other Gemstone is available by request, for more available gemstone please visit our <a href="../stonelist.php" target="_blank">gemstone list</a></td><td width="170px"><br /><img src="../images/bg_product_save.gif" width="20" height="20" align="absmiddle" />Save for Later<br /><img src="../images/bg_product_print.gif" width="20" height="20" align="absmiddle" />Print This Item<br /><img src="../images/bg_product_email.gif" width="20" height="20" align="absmiddle" />Email This Item<br /><img src="../images/bg_product_phone.gif" width="20" height="20" align="absmiddle" />
<a id="demo1" href="javascript:void(0);">Contact Us</a>
<div id="dialog1">
    <a href="javascript:void(0);" class="closebutton">X</a>
    <h2>General Enquiry Forms</h2>
    <form method="get" name="form1" action="../scripts/php/mailback.php" onSubmit="return formValidation(this)">
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form"><span class="remark">*</span>Contact Person: </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%" class="title">&nbsp;</td>
    <td width="39%" class="title"><input type="hidden" name="messagetitle" value="<?php echo $pagename; ?>"/><input type="hidden" name="filename" value="<?php echo $filename; ?>"/>First: </td>
    <td width="46%" class="title"> Last: </td>
  </tr>
  <tr>
    <td><select name="ints">
      <option value="Mr." selected="selected">Mr.</option>
      <option value="Ms.">Ms.</option>
      <option value="Dr.">Dr.</option>
    </select></td>
    <td><span id="sprytextfield1">
      <input name="name" type="text" id="name" size="18" />
      <span class="textfieldRequiredMsg">Please Fill in your name.</span></span></td>
    <td><span id="sprytextfield2">
      <input name="name2" type="text" id="name2" size="15" />
      <span class="textfieldRequiredMsg">Please Fill in your name.</span></span></td>
  </tr>
</table></td>
    </tr>
    <tr>
    	<td width="100" height="25" align="left" valign="middle" class="form">Job title:</td>
    	 <td width="5" height="25" class="form">&nbsp;</td>
    	<td height="25" align="left" valign="middle" class="form"><input name="title" type="text" id="title" size="20" /></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form"><span class="remark">*</span>Type of Business:</td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><label>
        <select name="business">
          <option value="">Type of Business</option>
		  <option value="wholesale">Whole Sale</option>
		  <option value="retailer">Retailer</option>
		  <option value="others">Others</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form"><span class="remark">*</span>Company Name: </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><span id="sprytextfield3">
        <input name="company" type="text" id="company" size="20" />
      <span class="textfieldRequiredMsg">Please fill in your company name</span></span></td>
    </tr>
    
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form">Business address:</td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" height="10" class="title">City</td>
            <td width="50%" class="title">State</td>
          </tr>
          <tr>
            <td><input name="city" type="text" id="city" size="22" /></td>
            <td><input name="state" type="text" id="state" size="22" /></td>
          </tr>
        </table></td>
    </tr>
	<tr>
      <td width="100" height="25" align="left" valign="middle" class="form"><span class="remark">*</span>Country:</td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><select name="country">
        <option selected value="">(Select a Country)</option>
                <option value="USA">United States of America</option>
                <option value="CAN">Canada</option>
                <option value="DEU">Germany</option>
                <option value="FRA">France</option>
                <option value="GBR">United Kingdom</option>
                <option value="IND">India</option>
                <option value="">--------</option>
                <option value="AFG">Afghanistan</option>
                <option value="ALB">Albania</option>
                <option value="DZA">Algeria</option>
                <option value="ASM">American Samoa</option>
                <option value="AND">Andorra</option>
                <option value="AGO">Angola</option>
                <option value="AIA">Anguilla</option>
                <option value="ATA">Antarctica</option>
                <option value="ATG">Antigua and Barbuda</option>
                <option value="ARG">Argentina</option>
                <option value="ARM">Armenia</option>
                <option value="ABW">Aruba</option>
                <option value="AUS">Australia</option>
                <option value="AUT">Austria</option>
                <option value="AZE">Azerbaijan</option>
                <option value="BHS">Bahamas</option>
                <option value="BHR">Bahrain</option>
                <option value="BGD">Bangladesh</option>
                <option value="BRB">Barbados</option>
                <option value="BLR">Belarus</option>
                <option value="BEL">Belgium</option>
                <option value="BLZ">Belize</option>
                <option value="BEN">Benin</option>
                <option value="BMU">Bermuda</option>
                <option value="BTN">Bhutan</option>
                <option value="BOL">Bolivia</option>
                <option value="BIH">Bosnia and Herzegowina</option>
                <option value="BWA">Botswana</option>
                <option value="BVT">Bouvet Island</option>
                <option value="BRA">Brazil</option>
                <option value="IOT">British Indian Ocean Territory</option>
                <option value="BRN">Brunei Darussalam</option>
                <option value="BGR">Bulgaria</option>
                <option value="BFA">Burkina Faso</option>
                <option value="BDI">Burundi</option>
                <option value="KHM">Cambodia</option>
                <option value="CMR">Cameroon</option>
                <option value="CPV">Cape Verde</option>
                <option value="CYM">Cayman Islands</option>
                <option value="CAF">Central African Republic</option>
                <option value="TCD">Chad</option>
                <option value="CHL">Chile</option>
                <option value="CHN">China</option>
                <option value="CXR">Christmas Island</option>
                <option value="CCK">Cocoa (Keeling) Islands</option>
                <option value="COL">Colombia</option>
                <option value="COM">Comoros</option>
                <option value="COG">Congo</option>
                <option value="COK">Cook Islands</option>
                <option value="CRI">Costa Rica</option>
                <option value="CIV">Cote Divoire</option>
                <option value="HRV">Croatia (local name: Hrvatska)</option>
                <option value="CUB">Cuba</option>
                <option value="CYP">Cyprus</option>
                <option value="CZE">Czech Republic</option>
                <option value="DNK">Denmark</option>
                <option value="DJI">Djibouti</option>
                <option value="DMA">Dominica</option>
                <option value="DOM">Dominican Republic</option>
                <option value="TMP">East Timor</option>
                <option value="ECU">Ecuador</option>
                <option value="EGY">Egypt</option>
                <option value="SLV">El Salvador</option>
                <option value="GNQ">Equatorial Guinea</option>
                <option value="ERI">Eritrea</option>
                <option value="EST">Estonia</option>
                <option value="ETH">Ethiopia</option>
                <option value="FLK">Falkland Islands (Malvinas)</option>
                <option value="FRO">Faroe Islands</option>
                <option value="FJI">Fiji</option>
                <option value="FIN">Finland</option>
                <option value="FXX">France, Metropolitan</option>
                <option value="GUF">French Guiana</option>
                <option value="PYF">French Polynesia</option>
                <option value="ATF">French Southern Territories</option>
                <option value="GAB">Gabon</option>
                <option value="GMB">Gambia</option>
                <option value="GEO">Georgia</option>
                <option value="GHA">Ghana</option>
                <option value="GIB">Gibraltar</option>
                <option value="GRC">Greece</option>
                <option value="GRL">Greenland</option>
                <option value="GRD">Grenada</option>
                <option value="GLP">>Guadeloupe</option>
                <option value="GUM">Guam</option>
                <option value="GTM">Guatemala</option>
                <option value="GIN">Guinea</option>
                <option value="GNB">Guinea-Bissau</option>
                <option value="GUY">Guyana</option>
                <option value="HTI">Haiti</option>
                <option value="HMD">Heard and Mc Donald Islands</option>
                <option value="HND">Honduras</option>
                <option value="HKG">Hong Kong</option>
                <option value="HUN">Hungary</option>
                <option value="ISL">Iceland</option>
                <option value="IDN">Indonesia</option>
                <option value="IRN">Iran (Islamic Republic of)</option>
                <option value="IRQ">Iraq</option>
                <option value="IRL">Ireland</option>
                <option value="ISR">Israel</option>
                <option value="ITA">Italy</option>
                <option value="JAM">Jamaica</option>
                <option value="JPN">Japan</option>
                <option value="JOR">Jordan</option>
                <option value="KAZ">Kazakhstan</option>
                <option value="KEN">Kenya</option>
                <option value="KIR">Kiribati</option>
                <option value="PRK">Korea, Democratic Peoples Republic of</option>
                <option value="KOR">Korea, Republic of</option>
                <option value="KWT">Kuwait</option>
                <option value="KGZ">Kyrgyzstan</option>
                <option value="LAO">Lao Peoples Democratic Republic</option>
                <option value="LVA">Latvia</option>
                <option value="LBN">Lebanon</option>
                <option value="LSO">Lesotho</option>
                <option value="LBR">Liberia</option>
                <option value="LBY">Libyan Arab Jamahiriya</option>
                <option value="LIE">Liechtenstein</option>
                <option value="LTU">Lithuania</option>
                <option value="LUX">Luxembourg</option>
                <option value="MAC">Macau</option>
                <option value="MKD">Macedonia, The Former Yugoslav Republic of</option>
                <option value="MDG">Madagascar</option>
                <option value="MWI">Malawi</option>
                <option value="MYS">Malaysia</option>
                <option value="MDV">Maldives</option>
                <option value="MLI">Mali</option>
                <option value="MLT">Malta</option>
                <option value="MHL">Marshall Islands</option>
                <option value="MTQ">Martinique</option>
                <option value="MRT">Mauritania</option>
                <option value="MVS">Mauritius</option>
                <option value="MYT">Mayotte</option>
                <option value="MEX">Mexico</option>
                <option value="FSM">Micronesia, Federated States of</option>
                <option value="MDA">Moldova, Republic of</option>
                <option value="MCO">Monaco</option>
                <option value="MNG">Mongolia</option>
                <option value="MSR">Montserrat</option>
                <option value="MAR">Morocco</option>
                <option value="MOZ">Mozambique</option>
                <option value="MMR">Myanmar</option>
                <option value="NAM">Namibia</option>
                <option value="NRU">Nauru</option>
                <option value="NPL">Nepal</option>
                <option value="NLD">Netherlands</option>
                <option value="ANT">Netherlands Antilles</option>
                <option value="NCL">New Caledonia</option>
                <option value="NZL">New Zealand</option>
                <option value="NIC">Nicaragua</option>
                <option value="NER">Niger</option>
                <option value="NGA">Nigeria</option>
                <option value="NIU">Niue</option>
                <option value="NFK">Norfolk Island</option>
                <option value="MNP">Northern Mariana Islands</option>
                <option value="MOR">Norway</option>
                <option value="OMN">Oman</option>
                <option value="PAK">Pakistan</option>
                <option value="PLW">Palau</option>
                <option value="PAN">Panama</option>
                <option value="PNG">Papua New Guinea</option>
                <option value="PRY">Paraguay</option>
                <option value="PER">Peru</option>
                <option value="PHL">Philippines</option>
                <option value="PCN">Pitcairn</option>
                <option value="POL">Poland</option>
                <option value="PRT">Portugal</option>
                <option value="PRI">Puerto Rico</option>
                <option value="QAT">Qatar</option>
                <option value="REU">Reunion</option>
                <option value="ROM">Romania</option>
                <option value="RUS">Russian Federation</option>
                <option value="RWA">Rwanda</option>
                <option value="KNA">Saint Kitts and Nevis</option>
                <option value="LCA">Saint Lucia</option>
                <option value="VCT">Saint Vincent and the Grenadines</option>
                <option value="WSM">Samoa</option>
                <option value="SMR">San Marino</option>
                <option value="STP">Sao Tome and Principe</option>
                <option value="SAU">Saudi Arabia</option>
                <option value="SEN">Senegal</option>
                <option value="SYC">Seychelles</option>
                <option value="SLE">Sierra Leone</option>
                <option value="SGP">Singapore</option>
                <option value="SVK">Slovakia (Slovak Republic)</option>
                <option value="SVN">Slovenia</option>
                <option value="SLB">Solomon Islands</option>
                <option value="SOM">Somalia</option>
                <option value="ZAF">South Africa</option>
                <option value="SGS">South Georgia and the South Sandwich Islands</option>
                <option value="ESP">Spain</option>
                <option value="LKA">Sri Lanka</option>
                <option value="SHN">St. Helena</option>
                <option value="SPM">St. Pierre and Miquelon</option>
                <option value="SDN">Sudan</option>
                <option value="SUR">Suriname</option>
                <option value="SJM">Svalbard and Jan Mayen Islands</option>
                <option value="SWZ">Swaziland</option>
                <option value="SWE">Sweden</option>
                <option value="CHE">Switzerland</option>
                <option value="SYR">Syrian Arab Republic</option>
                <option value="TWN">Taiwan</option>
                <option value="TJK">Tajikistan</option>
                <option value="TZA">Tanzania, United Republic of</option>
                <option value="THA">Thailand</option>
                <option value="TGO">Togo</option>
                <option value="TKL">Tokelau</option>
                <option value="TON">Tonga</option>
                <option value="TTO">Trinidad and Tobago</option>
                <option value="TUN">Tunisia</option>
                <option value="TUR">Turkey</option>
                <option value="TKM">Turkmenistan</option>
                <option value="TCA">Turks and Caicos Islands</option>
                <option value="TUV">Tuvalu</option>
                <option value="UGA">Uganda</option>
                <option value="UKR">Ukraine</option>
                <option value="ARE">United Arab Emirates</option>
                <option value="UMI">United States Minor Outlying Islands</option>
                <option value="URY">Uruguay</option>
                <option value="UZB">Uzbekistan</option>
                <option value="VUT">Vanuatu</option>
                <option value="VAT">Vatican City State (Holy See)</option>
                <option value="VEN">Venezuela</option>
                <option value="VNM">Viet Nam</option>
                <option value="VGB">Virgin Islands (British)</option>
                <option value="VIR">Virgin Islands (U.S.)</option>
                <option value="WLF">Wallisw and Futuna Islands</option>
                <option value="ESH">Western Sahara</option>
                <option value="YEM">Yeman</option>
                <option value="YUG">Yugoslavia</option>
                <option value="ZAR">Zaire</option>
                <option value="ZMB">Zambia</option>
                <option value="ZWE">Zimbabwe</option>
                <option value="UNK">Not Listed___________________________</option>
      </select></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form"><span class="remark">*</span>Telephone: </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="19%" class="title">Courtry Code</td>
          <td width="19%" class="title">Area Code</td>
          <td width="62%" class="title">Number</td>
        </tr>
        <tr>
          <td><input name="countrycode" type="text" size="6" maxlength="6" />
- </td>
          <td><input name="areacode" type="text" id="areacode" size="6" maxlength="6" />
-</td>
          <td><input name="number" type="text" id="number" size="12" maxlength="12" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form"><span class="remark">*</span>Business Email:  </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><span id="sprytextfield4">
      <input name="email" type="text" id="email" size="28" />
      <span class="textfieldRequiredMsg">Please fill in your eamil address</span><span class="textfieldInvalidFormatMsg">Email is Invalid.</span></span></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form">company website: </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><input name="website" type="text" id="website" value="http://" size="28" /></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form">Interesting product(s): </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33%"><input type="checkbox" name="checkbox" value="key" id="checkbox"/>
Key</td>
          <td width="33%"><input type="checkbox" name="checkbox" value="lock" id="checkbox"/>
Lock</td>
          <td width="33%"><input type="checkbox" name="checkbox" value="3rings" id="checkbox"/>
3 Rings</td>
        </tr>
        <tr>
          <td width="33%"><input type="checkbox" name="checkbox" value="gemsilver" id="checkbox"/>
Gemsilver Set</td>
          <td width="33%"><input type="checkbox" name="checkbox" value="giftbox" id="checkbox"/>
Gift Box</td>
          <td width="33%"><input type="checkbox" name="checkbox" value="others" id="checkbox"/>
Others</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="100" height="25" align="left" valign="middle" class="form">Additional Request: </td>
      <td width="5" height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><textarea name="request" cols="25" rows="4"></textarea></td>
    </tr>
    <tr>
      <td height="25" align="right" valign="middle" class="form">&nbsp;</td>
      <td height="25" class="form">&nbsp;</td>
      <td height="25" align="left" valign="middle" class="form"><input type="reset" name="Reset" value="Reset" /> 
      <input type="submit" value="submit" class="closebutton"></td>
    </tr>
  </table>
</form><b><a class="closebutton">Close button</a></b>
    
</div>
<script>
    $("#demo1").floatdialog("dialog1");
</script></td></tr></table></div></div>
</div>
<div id="footer" align="center"><table width="100%" cellpadding="0" cellspacing="0">
  <tr><td>&copy; Copyright 2009 Vigor Gems &amp; Jewelery Designed By AltaWoz Dev.</td><td align="right"><a href="/footer-pages/accessibility" title="Accessiblity information" accesskey="x">Accessiblity</a> &nbsp;|&nbsp; <a href="/footer-pages/sitemap" title="Site map" accesskey="v">Site map</a> &nbsp;|&nbsp; <a href="/footer-pages/terms-and-conditions" title="Terms &amp; conditions" accesskey="k">Terms &amp; conditions</a> &nbsp;|&nbsp; <a href="/footer-pages/privacy-policy" title="Privacy Policy" accesskey="q">Privacy policy</a> &nbsp;|&nbsp; <a href="/contact-us/faqs" title="FAQs" accesskey="j">FAQs</a></td></tr></table>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($style);

mysql_free_result($stone);
?>
