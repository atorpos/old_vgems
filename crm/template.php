<?php
	if ($_SERVER['HTTPS'] != "on") { 
    	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
    	header("Location: $url"); 
    	exit; 
    }
	$pagename = "Your Account";
	$pagetype = "promotional";
	$filename = "https://www.vigorgems.com/crm/index.php";
?>
<?php include('../header.php'); ?>
<div id="main">
<div id="crm_bigtitle"></div>
<div id="crm_content">
	
</div>
<div id="events_bottom"></div>
</div>
<?php include('../int_footer.php');?>
</body>
</html>