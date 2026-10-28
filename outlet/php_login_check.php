<?php

$id = $_POST["kt_login_user"];
$passwd = $_POST["kt_login_password"];


session _register("user", "pw");
$user = $id;
$pw = $password;

require("php_outlet_dbc.php");
$sql = "SELECT * from user where email='$id' and password = '$password'";
$result = mysql_query($sql);
$num=mysql_num_rows($result);

if ($num == 0 ) {

echo "unknow user or incorrect password";
exit;

}

?>