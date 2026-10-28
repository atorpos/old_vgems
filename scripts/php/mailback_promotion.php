<!--contain: business,company,ints, name, name2, title, country, address, 
countrycode, areacode, number, email, website, checkbox, request -->

<?php
	$mailTo="vigorgem@vigorgems.com";
	$mailSubject ="Message from Promotion Page";
	/* Compnay */
	$spacebus = "Company Name: ";
	$business = $_GET["name"];
	$spacec = "\n Contact Person: ";
	$company = $_GET["contact"];
	/* Contact Person */
	$spacen = "\n Email: ";
	$email = $_GET["email"] ;
	$space = " ";
	$spacetit = "\n Phone No: ";
	$phone = $_GET["phone"];
	$spacecb = "\n Checked item(s): ";
	$spacen ="\n";
	$bc020onb = $_GET["bc020onb"];
	$bf059avg = $_GET["bf059avg"];
	$bc501onb = $_GET["bc501onb"];
	$others = $_GET["others"];
	
	
	$mailBody = "$spacebus $business $spacec $company $spacen $email $space  $spacetit $phone $spacecb $bc020onb $spacen $bf059avg $spacen $bc501onb $spacen $others";
	
	
	$mailHeaders ="Form: PHP Script".
		"<php@{$_SERVER["SERVER_NAME"]}>\r\n";
		
	if(mail($mailTo, $mailSubject, $mailBody, $mailHeaders))
		{
			print("Mail sent sucessfully to Vigor Gems and Jewellery!<br><a href=http://www.vigorgems.com/promotion/>back</a>");
			$insertGoTo = "http://www.vigorgems.com/promotion/";
		}
		else
		{
			print("Mail failed! Please call Vigor Gems Web Administrator");
			 $insertGoTo = "http://www.vigorgems.com";
		}
?>