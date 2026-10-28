<?php require_once('../Connections/currency.php'); ?>
<?php require_once('../Connections/external.php');
session_start(); ?>
<?php require_once('../Connections/stockcode.php'); ?>
<?php
$expire=time()+60*60*24*30;
$location = "2";
setcookie("location", $location, $expire);
$jsonurl = "/scripts/lib/json_frontstore_class.php?location=". $location;
if ($location== 1) {
	$currentstone = "Hong Kong";
} else if($location ==2) {
	$currentstone = "United States";
}
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
		<title>Vigor Gems and Jewelry LTD - Wholesale Online Store - <?php echo $currentstone;?></title>
		<link rel="stylesheet" href="/scripts/javascript/galleriffic/css/special_basic.css" type="text/css" />
		<link rel="stylesheet" href="/scripts/javascript/galleriffic/css/galleriffic-2.css" type="text/css" />
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/jquery-2.0.0.min.js"></script>
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/jquery.galleriffic.js"></script>
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/jquery.opacityrollover.js"></script>
		<script type="text/javascript" src="/scripts/javascript/galleriffic/js/custom.js"></script>
		<!--<script type="text/javascript" src="/scripts/javascript/jquery/jquery-1.4.2.js"></script>-->
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
			//$("img.lazy").lazyload({
			//	effect: "fadeIn"
			//})
		</script>
	</head>
<body>
<div id="header"><?php
			include($_SERVER["DOCUMENT_ROOT"] . "/scripts/php/php_header.php");
		?>
		<?php 
			include($_SERVER["DOCUMENT_ROOT"] . "/scripts/php/php_menu.php");
		?>
</div>
<div id="main">
	<div id="section_menu">
	</div>
		<div id="specialitemtop"><h2>VigorGems Online Store</h2></div>
		<div id="placeholder"></div>
		<script type="text/javascript">
			$.getJSON('<?php echo $jsonurl; ?>', function(data) {
        var output="<div id=\"specialitems\" align=\"left\">";
        for (var i in data.bracelets) {
        	output+="<div class=\"itemcola\"><div class=\"imgcontainer\"><a href=\"products.awz?code="+data.bracelets[i].code+"\"><img src=\"/images/products/" + data.bracelets[i].code + "/" + data.bracelets[i].stone + "_279.jpg\"></a></div><div class=\"subline\"><span class=\"headline\">" + " <a href=\"products.awz?code="+data.bracelets[i].code+"\">" + data.bracelets[i].name + "</a></span><span class=\"sku\">" + data.bracelets[i].code +  "--" +data.bracelets[i].quantityinpackage +" Pieces Pack</span><span class=\"regprice\">$ " + data.bracelets[i].packageprice  + " for one pack</span><span class=\"sku\">Average $ " + data.bracelets[i].averageprice  + " for each piece</span></div></div>";
        }
        output+="</div>";
        document.getElementById("placeholder").innerHTML=output;
  });
		</script>
		<div id="specialitembot"></div>
</div>
<?php include('../int_footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($currency);
?>
<?php include('../scripts/xml/storelist.php');?>