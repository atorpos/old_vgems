<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$ses_id = session_id();

foreach($_SESSION as $key => $value)
{
	echo $key . " = " .$value . "<br>";
}
echo $_SESSION['MM_Username'];

?>