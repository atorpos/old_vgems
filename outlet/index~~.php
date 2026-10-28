<?php require_once('../Connections/currency.php'); ?>
<?php require_once('../Connections/external.php');
session_start(); ?>
<?php require_once('../Connections/stockcode.php'); ?>
<?php
$set_currency=$_GET["set_currency"];
switch ($set_currency) {
		 case NULL :
				$set_currency = "USD";
				break;
		 case "USD" :
				$set_currency = "USD";
				break;
		 case "CAD" :
		 		$set_currency = "CAD";
				break;
		 case "HKD" :
		 		$set_currency = "HKD";;
				break;
		 case "GBP" :
		 		$set_currency = "GBP";
				break;
		 case "EUR" :
		 		$set_currency = "EUR";
				break;
		 case "CNY" :
		 		$set_currency = "CNY";
				break;
		 case "JPY" :
		 		$set_currency = "JPY";
				break;
		}
setcookie("TestCookie", $set_currency);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title><?php echo "Vigor Gems and Jewelry LTD - ". $productcode; ?></title>
		<link rel="stylesheet" href="/scripts/javascript/galleriffic/css/basic.css" type="text/css" />
		<link rel="stylesheet" href="/scripts/javascript/galleriffic/css/galleriffic-2.css" type="text/css" />
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/jquery-2.0.0.min.js"></script>
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/jquery.galleriffic.js"></script>
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/jquery.opacityrollover.js"></script>
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/custom.js"></script>
		<script src="/scripts/javascript/modernizr.custom.28809.js"></script>
		<script src="/scripts/javascript/retina.js"></script>
		<link rel="stylesheet" media="all" type="text/css" href="/scripts/css/details.css"><link rel="stylesheet" href="/scripts/css/global_header.css" type="text/css" />
		<!-- We only want the thunbnails to display when javascript is disabled -->
		<script type="text/javascript">
			document.write('<style>.noscript { display: none; }</style>');
		</script>
		<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$("a").hover(function(e) {
    $($(this).data("tooltip")).css({
        left: e.pageX + 1,
        top: e.pageY + 1
    }).stop().show(100);
   }, function() {
    $($(this).data("tooltip")).hide();
});

});//]]>  

</script>
	</head>
<body>
<div id="header"><?php
			include($_SERVER["DOCUMENT_ROOT"] . "/scripts/php/php_header.php");
		?>
		<?php 
			include($_SERVER["DOCUMENT_ROOT"] . "/scripts/php/php_menu.php");
		?></div>
<div id="main" align="center">
<div id="outletop">
  <ul><li><a href="index.php?producttype=10">accessory</a></li><li><a href="index.php">beads</a></li><li><a href="index.php?producttype=04">bracelets</a></li><li><a href="index.php?producttype=09">globe</a></li><li><a href="index.php?producttype=06">necklaces</a></li></ul>
</div><table width="1000" border="0" cellpadding="0" cellspacing="0">
  <tr><td valign="top" align="center"><?php include('../scripts/php/producttable.php');?>
</td>
  <td width="250" align="center" valign="top" bgcolor="#383838"><div id="righttitle"><img src="../images/bg_outlet_righttitle.png" /></div>
  <div id="rightcontents" align="left"><ul>beads<li>5 strings item</li>
					<li>10 Strings  item</li>
					<li>20 dollars less items</li>
					</ul>
					  <?php include('../scripts/php/php_misc_sidebartotal.php'); ?>
					</div><div id="internal_adv">special items<p>product img</p><p> More information</p></div></td>
  </tr></table><div id="bottommenu">Pages: </div>
</div>
<?php include('../int_footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($currency);
?>
<?php include('../scripts/xml/storelist.php');?>