<?php
	$host = "www.vigorgems.info";
	$db_name = "ProductsDB";
	$username = "vigorgems";
	$passwd = "Biotherm";
	
	try {
		$conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
	}catch(PDOException $expection) {
		echo "Connection error:" . $expection->getMessage();
	}
?>