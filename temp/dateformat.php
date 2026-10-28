<?php
	date_default_timezone_set("Asia/Hong_Kong");
	$currentdate = date("Y-m-d H:i:s"); 
	$posttitle = "Order &ndash; ". date("F d, Y @ h:i:s A");
	$postpassword = "order_". md5($postdate);
	$postname = "order-" .strtolower(date("M-d-Y-hi-a"));
	
	echo $currentdate . "\n";
	echo $posttitle. "\n";
	echo $postpassword. "\n";
	echo $postname;
	echo number_format(10000/100,2,'.',',');
	
?>