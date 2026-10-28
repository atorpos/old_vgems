<?php
session_start();
require("php_outlet_db.php");
require("php_outlet_cart.php");
$sid=session_id();
$cart=new Cart;
$cart->clear_cart($sid);
require("display.php");
$result=$cart->get_cart($sid);
display($result);

?>