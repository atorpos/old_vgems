<html>
<head>
<title>PHPMailer - Transmit</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	$mailSubject = "Message from webpage";
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
	$spacecom = "\n Comments: ";
	$comments = $_GET["comment"];
	
	$mailBody = "$spacebus $business $spacec $company $spacen $email $space  $spacetit $phone $spacecom $comments";

//get value from page

$mail             = new PHPMailer();

$body             = $mailBody; //file_get_contents('http://www.vigorgems.com/edm/12edm/aprilpromo.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "vigorgems@gmail.com";  // GMAIL username
$mail->Password   = "edozlh44";            // GMAIL password

$mail->SetFrom('vigorgems@gmail.com', 'tester machine');

$mail->AddReplyTo("vigorgems@gmail.com","tester machine");

$mail->Subject    = $mailSubject;

$mail->AltBody    = "Testing Testing!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "vgrsales@vigorgems.com";
$mail->AddAddress($address, "vigor gems");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://www.vigorgems.com/finishquest.html">';  //redirect back to page.  
}

?>

</body>
</html>
