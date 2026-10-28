<?php
session_start();
require("php_outlet_db.php");
require("php_outlet_cart.php");

$sid=session_id();

$id=$_GET["id"];
$cry=$_GET["currency"];
$qty=$_GET["qty"];
$cart=new Cart;
$cart->add_item($sid,$id,$qty,$cry);
$total = $cart->cart_total($sid);
require("display.php");
$result=$cart->get_cart($sid);
display($result);
echo "</table><div align=\"right\" id=\"top-buttons\">Total: " .$_COOKIE["TestCookie"]. " ".number_format($total,1)."0</div>";
require('../scripts/php/bottomless.php');
?>