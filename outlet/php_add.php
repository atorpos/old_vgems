<?php
	if(!isset($_COOKIE['cart'])) {
		$items = 0;
		setcookie('itemsincart', $items);
		setcookie('cart', '20384950');
	} else {
		$items = $_COOKIE['itemsincart'];
		$items = $items +1;
		setcookie('itemsincart', $items);
	}
	
	echo $_COOKIE['itemsincart'];

?>