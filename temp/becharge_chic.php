<?php
	header('Content-type: application/json');
	require_once '../scripts/stripe-php/init.php';
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey("sk_live_1uVZ3ibKbtLUXgGtaJv4zFG4");

	// Get the credit card details submitted by the form
	$token = $_POST['stripeToken'];
	$tokenamount = $_POST['paymentamount'];
	$tokencurrency = $_POST['paymentcurrency'];
	$stripeAPI = $_POST['stripeAPI'];
	$tokendescription = $_POST['transdetail'];
	$tokenemail =$_POST['email'];

	// Create the charge on Stripe's servers - this will charge the user's card
	try {

		$charge = \Stripe\Charge::create(array(
	 		"amount" => $tokenamount, // amount in cents, again
	 		"currency" => $tokencurrency,
	 		"source" => $token,
	 		"description" => $tokendescription,
	 		"receipt_email" => $tokenemail
	    ));
	    //$save = \Stripe\Customer::create(array(
    	//    "card" => $token,
    	//    "email" => strip_tags(trim($tokenemail))
    	    
	    //));
	    $success = "Your card details have been updated!";
	    echo '{"success":1, "message": "'.$success. '-'.$tokendescription. '"}' ;
	    //echo $success;
	}
	catch(\Stripe\Error\Card $e) {
	  // The card has been declined
	  $body = $e->getJsonBody();
	  $err  = $body['error'];
	  $error = $err['message'];
	}
?>