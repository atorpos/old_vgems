<!--contain: business,company,ints, name, name2, title, country, address, 
countrycode, areacode, number, email, website, checkbox, request -->

<!--  http://www.vigorgems.com/scripts/php/mailback.php?messagetitle=Message+from+Vigorgems+lock.php+Page&filename=http%3A%2F%2Fwww.vigorgems.com%2Fspecial%2Flock.php&ints=Mr.&name=test&name2=tester&title=teg&business=wholesale&company=ajfjkaj&city=&state=&country=USA&countrycode=613&areacode=262&number=4142&email=osjar%40gadfd.com&website=http%3A%2F%2F&checkbox=key&checkbox=lock&checkbox=gemsilver&checkbox=giftbox&request=  -->

<?php header("location:http://www.vigorgems.com/index.php");?>
<?php 
mysql_connect("localhost","vigorgemscom","Pingu1x");
mysql_select_db("messagesystem");
?>
<?php
	$mailTo="vigorgem@vigorgems.com.cn";
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
	$redireced = $_GET["filename"];
	
	$mailBody = "$spacebus $business $spacec $company $spacetit $title $spacen $ints $space $fname $space $lname  
				 $spcaeco $address $space $state $country $spacep $countrycode $space $areacode $space $phone $spacem $mail 
				 $spaceweb $website $spacecb $checkbox $spacer $command";
	
	$mailHeaders = $mail;
	
	
	$sql = "INSERT fromweb (id, email, `time`, title, contents) VALUE (NULL, '$mail', now(), '$mailSubject', '$mailBody')";
	mysql_query($sql);
	
	
?>