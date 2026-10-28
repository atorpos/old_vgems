<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<form action="becharge.php" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_hv5I6dN89TQrXwsjL8TIsSUr"
    data-amount="<?php $currentamount="300000"; echo $currentamount; ?>"
    data-name="Chicboite limited"
    data-description="Widget"
    data-image="/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-currency="<?php $currency="usd"; echo $currency; ?>">
  </script>
  <input type="hidden" name="paymentamount" value="<?php echo $currentamount; ?>"><input type="hidden" name="paymentcurrency" value="<?php echo $currency; ?>">
</form></body>

</html>