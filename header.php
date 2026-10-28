<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta name="google-site-verification" content="Inik6PgfuXvT0kodeVjYlptttWRagJom69WxcsmqKLI" />
<meta name="y_key" content="bb38e0ce42ebade8" />
<meta name="apple-itunes-app" content="app-id=551379150">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/appicon144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/appicon114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/appicon72.png">
<link rel="apple-touch-icon-precomposed" href="/images/appicon57.png">
<meta name="keywords" content="1E8JZUuzJvRaPhuRZANn5k_bHAo"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Description" content="Vigor Gems and Jewelry LTD is a Hong Kong base semi-precious stones supply over the world. We are providing fine quality of semi-finished, and finished product all over the world " />
<meta name="Keywords" content="Pealrs, Bracelet, Earrings, Pendant, Necklace, CZ, Mother Of Pearl, Fashion Jewelry, Turquoise, Semi-Precious Stone, Pearl, Gemstone bracelet, Gemstone Bracelets, Gemstone Necklaces, Gemstone Ring,Hong Kong Jewellery" />
<meta http-equiv="Content-Security-Policy" content="default-src https:">
<link rel="shortcut icon" href="/elements/icon/logo.ico" />
<link href="/news/?feed=rss2" type="application/rss+xml" rel="alternate" title="News RSS Feed" />
<link href="/rss.php" type="application/rss+xml" rel="alternate" title="New Products RSS Feed" />

	<script src="/scripts/javascript/retina.js"></script>
	<script type="text/javascript" src="/scripts/javascript/applesearch.js" ></script>
	<script type="text/javascript">
		window.onload = function () { applesearch.init(); }
	</script>
	<script src="/scripts/javascript/header.js" type="text/javascript"></script>
	<?php
		if($pagetype == "slide") {
			echo "<link rel=\"stylesheet\" href=\"/scripts/css/index_header.css\" type=\"text/css\" /><link rel=\"stylesheet\" href=\"/scripts/css/base.css\" type=\"text/css\" />
			<link rel=\"stylesheet\" href=\"/scripts/css/meunslide.css\" type=\"text/css\" />
			<script src=\"/scripts/javascript/prototype.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
			<script src=\"/scripts/javascript/scriptaculous_js/src/scriptaculous.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
			<script src=\"/scripts/javascript/browserdetect.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
 			<script src=\"/scripts/javascript/core.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
 			<script src=\"/scripts/javascript/event_mixins.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
 			<script src=\"/scripts/javascript/swap_view.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
 			<script src=\"/scripts/javascript/ac_autogallery.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
 			<script type=\"text/javascript\">
			Event.onDOMReady(function() {
			if (AC.Detector.isFirefox()){
				$$(\"#overview #hero-gallery\")[0].hide();
				setTimeout(function() {
					$$(\"#overview #hero-gallery\")[0].show();
				}, 1000);
				}
			});
	</script>";
		} else {
			echo "<link rel=\"stylesheet\" href=\"/scripts/css/global_header.css\" type=\"text/css\" />
			<style type=\"text/css\">
		<!--
		@import url(\"/scripts/css/index.css\");
		@import url(\"/scripts/css/catalog.css\");
		-->


        .disable_masking
        {
            z-index: 60001;
            position: absolute;
            display: none;
            background-color: #ffffff;
            border: 5px solid #999;
            padding: 20px;
        }
        .closebutton, .myclosebutton
        {
            float: right;
            text-decoration: none;
        }
        .data
        {
           font-size: 12px;
           text-align: justify;
        }
        .viewsiurce
        {
            background-color: #F0F0F0;
            border: 2px dashed #000;
            padding: 20px;
            color: #006633;
            font-size: 15px;


        }
		.form {font-size:10px; font-family:Arial, Helvetica, sans-serif; color:#000000}
.remark{font-family: verdana, Helvetica, sans-serif;
	font-size: 11px;
	color: #F68622;
	font-weight: boldest;
	vertical-align: -2px;}
.title {font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#666666}
</style>


			<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/default.css\" id=\"default\"  />
			<script type=\"text/javascript\" src=\"/scripts/javascript/jquery/jquery-1.4.2.js\" ></script>
    		<script type=\"text/javascript\" src=\"/scripts/javascript/jquery/jquery.floatdialog.js\" ></script>
			<link rel=\"stylesheet\" href=\"/fancybox/fancybox/jquery.fancybox-1.3.4.css\" type=\"text/css\" media=\"screen\" />
    <script type=\"text/javascript\" src=\"/fancybox/fancybox/jquery.fancybox-1.3.4.js\" ></script>
	<script type=\"text/javascript\">
		$(document).ready(function() {

			/* This is basic - uses default settings */

			$(\"a.single_image\").fancybox({
										 	'zoomSpeedIn'		:	500,
											'zoomSpeedOut'		:	500,
											'overlayOpacity'	:	0.1,
											'overlayColor'		:	'#FFF',
											'transitionIn'	:	'elastic',
											'transitionOut'	:	'elastic'

										 });
		    $(\"a.iframe\").fancybox({
		    								'zoomSpeedIn'		:	500,
											'zoomSpeedOut'		:	500,
											'overlayOpacity'	:	0.1,
											'overlayColor'		:	'#000',
											'width'				:	650,
											'height'			:	371

		    });

			/* Using custom settings */

			$(\"a#inline\").fancybox({
				'hideOnContentClick': true
			});

			$(\"a.group\").fancybox({
				'zoomSpeedIn':		300,
				'zoomSpeedOut':	300,
				'overlayShow':		false
			});
			});
	</script>
	<!--Text Checker-->
    <script src=\"/SpryAssets/SpryValidationTextField.js\" type=\"text/javascript\"></script>

	<link href=\"/SpryAssets/SpryValidationTextField.css\" rel=\"stylesheet\" type=\"text/css\" />
			";
		}
		if ($pagetype=="crm")
		{
			echo "<script src=\"../SpryAssets/SpryValidationPassword.js\" type=\"text/javascript\"></script>";
			echo "<link href=\"../SpryAssets/SpryValidationPassword.css\" rel=\"stylesheet\" type=\"text/css\">";
		}
	?>
    <script type="text/javascript" src="/scripts/javascript/inlivesearch.js" ></script>
    <script type="text/javascript" src="/scripts/javascript/livesearch.js" ></script>
    <script type="text/javascript" src="/scripts/javascript/bubble.js" ></script>
	<script type="text/javascript">
$(function () {
    $('ul.spy').simpleSpy();
});

(function ($) {

$.fn.simpleSpy = function (limit, interval) {
    limit = limit || 3;
    interval = interval || 7000;

    return this.each(function () {
        // 1. setup
            // capture a cache of all the list items
            // chomp the list down to limit li elements
        var $list = $(this),
            items = [], // uninitialised
            currentItem = limit,
            total = 0, // initialise later on
            height = $list.find('> li:first').height();

        // capture the cache
        $list.find('> li').each(function () {
            items.push('<li>' + $(this).html() + '</li>');
        });

        total = items.length;

        $list.wrap('<div class="spyWrapper" />').parent().css({ height : height * limit });

        $list.find('> li').filter(':gt(' + (limit - 1) + ')').remove();

        // 2. effect
        function spy() {
            // insert a new item with opacity and height of zero
            var $insert = $(items[currentItem]).css({
                height : 0,
                opacity : 0,
                display : 'none'
            }).prependTo($list);

            // fade the LAST item out
            $list.find('> li:last').animate({ opacity : 0}, 1000, function () {
                // increase the height of the NEW first item
                $insert.animate({ height : height }, 1000).animate({ opacity : 1 }, 1000);

                // AND at the same time - decrease the height of the LAST item
                // $(this).animate({ height : 0 }, 1000, function () {
                    // finally fade the first item in (and we can remove the last)
                    $(this).remove();
                // });
            });

            currentItem++;
            if (currentItem >= total) {
                currentItem = 0;
            }

            setTimeout(spy, interval)
        }

        spy();
    });
};

})(jQuery);



</script>

<title>Vigor Gems &amp; Jewelry LTD - <?php echo $pagename; ?></title>
<?php
	if($pagename == "Vigor Gems and Jewelry LTD - Privacy Policy") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/privacy.css\" id=\"addon\"  />";
	} else if($pagename == "Vigor Gems and Jewelry LTD - Term of Use") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/privacy.css\" id=\"addon\"  />";
	} else if($pagename == "FAQ") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/privacy.css\" id=\"addon\"  />";
	} else if($pagetype =="promotional") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/pomo.css\" id=\"addon\"  />";
	} else if ($pagename == "Terms of Sale") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/privacy.css\" id=\"addon\"  />";
	} else if ($pagetype == "productsvisual") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/nav.css\" id=\"nav\"  />";
	} else if ($pagetype =="crm") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/pomo.css\" id=\"addon\"  />";
	} else if ($pagetype == "promotional_upcoming") {
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/css/pomo2.css\" id=\"addon\"  />";
	}
?>
<?php if($mapinv==1) {
	echo "<script src=\"http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAdhwT678eJtlZcAuC8TV2hBQrOJ8cx7GWWDxCd1TNgJQGWSktNRQujWjpuTJz8KkfxTPwJduwAhni4Q\" type=\"text/javascript\" /> ";
}else {
	echo " ";
}?>

</head>

<?php if($mapinv==1) {
	echo "<body onload=\"initialize()\" onunload=\"GUnload()\">";
} else if($pagetype == "slide") {
		echo "<body id=\"overview\">";
	} else {
		echo "<body>";
	}
?>
<?php $pagename = "Message from Vigorgems index Page";?>
<script type="text/javascript">
    $("#demo1").floatdialog("dialog1");
</script>
<!--<div id="notification" align="center">New Site is currently in Beta testing (0.9 beta) | <a href="/old/">&gt;Click Here to Go back to Old Site&lt;</a></div>-->
<div id="header">
	<div id="staticbar">
		<div id="logoholder">
			<a href="/"><img src="/images/header_logo@2x.png" alt="vigor gems and jewelry ltd" width="450" height="64"/></a>
		</div>
		<div id="searchholder">
			<ul id="headnav">

				<li>Hi,<span style="font-weight:bold">
					<?php
						if (!isset($_SESSION['MM_Username'])) {
							echo "Guest ";
						} else {
							$colname_Recordset1 = $_SESSION['MM_Username'];
							echo "<a href=\"/crm/\">" .$colname_Recordset1 ."</a>";
						}
					?>
				</span> </li>
				<li class="press"><a href="/news/">Press</a></li>
				<!-- <li class="miscnav">Register</li> -->
				<li class="miscnav">
				<?php

				if (!isset($_SESSION['MM_Username'])) {
					echo "<a href=\"https://www.vigorgems.com/signin.php\">Log in</a>";

				} else {
					echo "<a href=\"https://www.vigorgems.com/scripts/php/php_logout.php\">Log out</a>";
				}

				?>
				</li>
				<li class="miscnav"><a href="//t2.phplivesupport.com/atropos/phplive.php?d=1" target="new"><img src="//t2.phplivesupport.com/atropos/ajax/image.php?d=1" border="0" align="middle" alt="livehelp"/> Live help</a>
					<div id="d3" style="display:none;">
						<div style="background-color:#ffffff;width:650px;border:1px solid gray;padding:1px;z-index:10000;">
							<iframe src="/sendquestion.html" style="border:none; width:650px; height:375px; z-index:10001;"></iframe>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>

<div id="navigation">
	<ul id="mymenu">
		<li><a href="/index.php" onmouseover="javascript:showsubmenu(1)">HOME</a></li>
    	<li><a href="/jewelry.php" onmouseover="javascript:showsubmenu(2)">JEWELRY</a></li>
    	<li><a href="/stone.php" onmouseover="javascript:showsubmenu(6)">SEMI-FINISHED ITEM</a></li>

    	<li><a href="/collection.php" onmouseover="javascript:showsubmenu(8)">COLLECTIONS</a></li>
    	<li><a href="/exhibitions/" onmouseover="javascript:showsubmenu(3)">EXHIBITION</a></li>
    	<li><a href="/factory/responsibility.php#factory" onmouseover="javascript:showsubmenu(4)">OUR FACTORY</a></li>
    	<li><a href="/care.php" onmouseover="javascript:showsubmenu(5)">CUSTOMER SERVICE</a></li>
		<li><a href="/info.php" onmouseover="javascript:showsubmenu(7)">COMPANY INFO</a></li>
	</ul>
</div>
<div id="sublinks">
	<ul id="s1">
        <li></li>
    </ul>
	<ul id="s6">
        <li><a href="/beads">BEADS</a></li>
        <li><a href="/cabochon">CABOCHON</a></li>

    </ul>
    <ul id="s2">
        <li><a href="/accessory">ACCESSORY</a></li><li><a href="/bracelet">BRACELET</a></li> <li><a href="/earring">EARRING</a></li><li><a href="/necklet">NECKLET</a></li><li><a href="/ring">RING</a></li>
    </ul>
    <ul id="s3">
        <li><a href="/exhibitions">GENERAL INFO.</a></li>
        <li><a href="/exhibitions/spring.php">SPRING</a></li>
        <li><a href="/exhibitions/summer.php">SUMMER</a></li>
        <li><a href="/exhibitions/fall.php">FALL</a></li>
        <li><a href="/exhibitions/oversea.php">OVER SEA</a></li>
    </ul>
     <ul id="s4">
        <li><a href="/factory/location.php">LOCATION</a></li>
    </ul>
    <ul id="s5">
        <li><a href="/customer/status.php">CHECK YOUR STATUS</a></li><li><a href="/customer/mapp.php">MAKE AN APPOINTMENT</a></li><li><a href="/custmoer/interact.php">ORDER OUR PRODUCT</a></li>
    </ul>
    <ul id="s7">
        <li><a href="/aboutus.php">ABOUT US</a></li><li><a href="/jobs.php">JOBS</a></li><li><a href="/pressbox.php">PRESS BOX</a></li>
    </ul>
    <ul id="s8">
        <li><a href="/carving">CARVING</a></li><li><a href="/globe">GLOBE</a></li>
    </ul>

</div>
</div>