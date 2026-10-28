<?php
	$cartItemCount = count($_SESSION['cart']);
?>
<li>
	<a href="Cart.php" class="customerButton">View Cart<?php echo "({$cartItemCount})";?></a>
</li>