<!--contain: business,company,ints, name, name2, title, country, address, 
countrycode, areacode, number, email, website, checkbox, request -->
<?php
require_once('Connections/message.php');
?>
<?php
	$mailTo="vigorgem@vigorgems.com";
	$mailSubject = "\"" .$_GET["messagetitle"]. "\"";
	/* Compnay */
	$spacebus = "Type of Business: ";
	$business = $_GET["business"];
	$spacec = "\n Company: ";
	$company = $_GET["company"];
	/* Contact Person */
	$spacen = "\n Name: ";
	$fname = $_GET["name"] ;
	$space = " ";
	$lname = $_GET["name2"];
	$ints = $_GET["ints"];
	$spacetit = "\n Title: ";
	$title = $_GET["title"];
	/* Contact Address */
	$spcaeco = "\n Address: ";
	$address = $_GET["city"];
	$state = $_GET["state"];
	$country = $_GET["country"] ;
	/* Contact number */
	$spacep = "\n phone: ";
	$countrycode = $_GET["countrycode"];
	$areacode = $_GET["areacode"];
	$phone = $_GET["number"];
	/* Contact email */
	$spacem = "\n Email: ";
	$mail = $_GET["email"] ;
	$spaceweb = "\n Web: ";
	$website = $_GET["website"];
	/* Product Interesting */
	$spacecb = "\n Checked item(s): ";
	$checkbox = $_GET["checkbox"];
	$spacer ="\n Request: ";
	$command = $_GET["request"] ;
	
	$mailBody = "$spacebus $business $spacec $company $spacetit $title $spacen $ints $space $fname $space $lname  
				 $spcaeco $address $space $state $country $spacep $countrycode $space $areacode $space $phone $spacem $mail 
				 $spaceweb $website $spacecb $checkbox $spacer $command";
	
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO fromweb (email, title, contents) VALUES (%s, %s, %s)",
                       GetSQLValueString($mail, "text"),
                       GetSQLValueString($mailSubject, "text"),
                       GetSQLValueString($mailBody, "text"));

  mysql_select_db($database_message, $message);
  $Result1 = mysql_query($insertSQL, $message) or die(mysql_error());
}
	$mailHeaders = $mail;
		
	if(mail($mailTo, $mailSubject, $mailBody, $mailHeaders))
		{
			print("Mail sent sucessfully to Vigor Gems and Jewellery!");
			
			header( 'Location: http://www.vigorgems.com/special/' ) ;
		}
		else
		{
			print("Mail failed! Please call Vigor Gems Web Administrator");
			
		}
?>