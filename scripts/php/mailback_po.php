<!--contain: business,company,ints, name, name2, title, country, address, 
countrycode, areacode, number, email, website, checkbox, request -->

<?php
	$mailTo="vigorgem@vigorgems.com";
	$mailSubject ="Message from Pomo Page";
	/* Compnay */
	$spacec = "\n Company: ";
	$company = $_GET["company"];
	/* Contact Person */
	$spacen = "\n Name: ";
	$fname = $_GET["contact"] ;
	$space = " ";
	/* Contact Address */
	$spcaeco = "\n Address: ";
	$country = $_GET["country"] ;
	/* Contact number */
	$spacep = "\n phone: ";
	$phone = $_GET["phone"];
	/* Contact email */
	$spacem = "\n Email: ";
	$mail = $_GET["email"] ;
	/* Product Interesting */
	$spacecb = "\n Checked item(s): ";
	$checkbox = $_GET["braclet"];
	$checkbox1 = $_GET["necklet"];
	$checkbox2 = $_GET["beads"];
	$checkbox3 = $_GET["others"];
	
	$mailBody = "$spacec $company $spacen $space $fname  
				 $spcaeco $country $spacep $phone $spacem $email 
				 $spacecb $checkbox $spacecb $checkbox1 $spacecb $checkbox2 $spacecb $checkbox3";
	
	
	$mailHeaders ="Form: PHP Script".
		"<php@{$_SERVER["SERVER_NAME"]}>\r\n";
		
	if(mail($mailTo, $mailSubject, $mailBody, $mailHeaders))
		{
			print("Mail sent sucessfully to Vigor Gems and Jewellery!");
			$insertGoTo = "http://www.vigorgems.com/pomo/";
		}
		else
		{
			print("Mail failed! Please call Vigor Gems Web Administrator");
			 $insertGoTo = "http://www.vigorgems.com";
		}
?>