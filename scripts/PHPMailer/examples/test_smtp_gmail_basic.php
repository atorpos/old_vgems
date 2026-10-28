<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = $_GET["content"]; //file_get_contents('http://www.vigorgems.com/edm/12edm/aprilpromo.html');
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

$mail->Subject    = $_GET["subject"];

$mail->AltBody    = "Testing Testing!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "vgrsales@vigorgems.com";
$mail->AddAddress($address, "vigor gems");

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
