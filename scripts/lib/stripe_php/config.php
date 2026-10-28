<?php
require_once('./lib/Stripe.php');

$stripe = array(
  "secret_key"      => "sk_test_3EggaEjRgsPAHMwsHPGryITC",
  "publishable_key" => "pk_test_NlG9pPsP60idVDyeNQ7b1JVR"
);

Stripe::setApiKey($stripe['secret_key']);
?>