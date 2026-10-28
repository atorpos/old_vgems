<!DOCTYPE html>
<html lang="en">
  <!-- http://www.vigorgems.com/events/index_1409.php ->
  <!-- Do not use this HTML file as a start -->
  <!-- Always create your own HTML file and follow steps in basic usage section of documentation -->

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
   

    <title>Vigor Gems and Jewelry LTD</title>

    <meta content="Touch-enabled image gallery and content slider plugin, that focuses on providing great user experience on every desktop and mobile device." name="description">
    <meta name="keywords" content="content slider, gallery, plugin, jquery, banner rotator">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0" />
    <meta name="author" content="Dmitry Semenov">
	<script src="http://www.vigorgems.com/scripts/javascript/retina.js"></script>
    <!-- slider JS files -->
    
    <script class="rs-file" src="http://www.jewelectric.com/temp/scripts/jquery-1.8.3.min.js"></script>
    <script class="rs-file" src="http://www.jewelectric.com/temp/scripts/jquery.royalslider.min.js"></script>
    <link class="rs-file" href="http://www.jewelectric.com/temp/scripts/royalslider.css" rel="stylesheet">
    
    

    
    <!-- syntax highlighter -->
    <script src="http://www.jewelectric.com/temp/scripts/highlight.pack.js"></script>
    <script src="http://www.jewelectric.com/temp/scripts/jquery-ui-1.8.22.custom.min.js"></script>
    <script> hljs.initHighlightingOnLoad();</script>

	<!-- preview-related stylesheets -->
    <link href="http://www.jewelectric.com/temp/scripts/reset.css" rel="stylesheet">
    <link href="http://www.jewelectric.com/temp/scripts/jquery-ui-1.8.22.custom.css" rel="stylesheet">
    <link href="http://www.jewelectric.com/temp/scripts/github.css" rel="stylesheet">

    <!-- slider stylesheets -->
    
     
        <link class="rs-file" href="http://www.jewelectric.com/temp/scripts/rs-minimal-white.css" rel="stylesheet">
     
    
    
    <!-- slider css -->
    <style>
    BODY {
	    min-width: 768px;
	    margin: 0px;
	    background: #f7f7f7;
    }
    @font-face {
		font-family :MyriadPro;
		src: url(/fonts/MyriadPro-Light.otf);
	}
	@font-face {
		font-family: HelveticaNeue;
		src: url(/fonts/HelveticaNeueLTCom-UltLt.ttf);
	}
	img {
		border: none;
	}
    #full-width-slider {
	  width: 100%;
	  color: #000;
	}
	.coloredBlock {
	  padding: 12px;
	  background: rgba(255,0,0,0.6);
	  color: #FFF;
	   width: 200px;
	   left: 20%;
	   top: 5%;
	}
	.infoBlock {
	  position: absolute;
	  top: 100px;
	  right: 150px;
	  left: auto;
	  max-width: 25%;
	  padding-bottom: 0;
	  background: rgba(255,255,255,0.1);
	  overflow: hidden;
	  padding: 20px;
	}
	.infoBlockLeftBlack {
	  color: #050505;
	  background: rgba(0,0,0,0.0);
	  left: 30px;
	  right: auto;
	}
	.infoBlock h4 {
	  font-size: 20px;
	  line-height: 1.2;
	  margin: 0;
	  padding-bottom: 3px;
	}
	.infoBlock p {
	  font-size: 14px;
	  margin: 4px 0 0;
	}
	.infoBlock a {
	  color: #FFF;
	  text-decoration: underline;
	}
	.photosBy {
	  position: absolute;
	  line-height: 24px;
	  font-size: 12px;
	  background: #FFF;
	  color: #000;
	  padding: 0px 10px;
	  position: absolute;
	  left: 12px;
	  bottom: 12px;
	  top: auto;
	  border-radius: 2px;
	  z-index: 25; 
	} 
	.photosBy a {
	  color: #000;
	}
	.fullWidth {
	  max-width: 1920px;
	  margin: 0 auto 1px;
	}
	@media screen and (min-width:800px) and (min-height:650px) {
	  .heroSlider .rsOverflow,
	  .royalSlider.heroSlider {
	      height: 650px !important;
	  }
	}
	
	@media screen and (min-width:800px) and (min-height:1000px) {
	    .heroSlider .rsOverflow,
	    .royalSlider.heroSlider {
	        height: 750px !important;
	    }
	    #overhead #companylogo img {
		  width: 80%;
		  height: 80%;
	  }
	}
	@media screen and (min-width: 320px) and (max-width: 768px) {
	  .royalSlider.heroSlider,
	  .royalSlider.heroSlider .rsOverflow {
	    height: 450px !important;
	  }
	  .infoBlock {
	    padding: 10px;
	    height: auto;
	    max-height: 100%;
	    min-width: 40%;
	    left: 5px;
	    top: 5px;
	    right: auto;
	    font-size: 12px;
	  }
	  .infoBlock h3 {
	     font-size: 14px;
	     line-height: 17px;
	  }
	  #main #overhead{
		  height: 160px !important;
	  }
	  #overhead #companylogo img {
		  width: 50%;
		  height: 50%;
	  }
	  #main .bottomcontain {
	  	  width: 100%;
		  height: 166px;
	  }
	  .bottomcontain .cola {
		  display:inline;
		  width: 256px !important;
		  height: 166px !important;
	  }
	  .bottomcontain .colb {
		  display: inline;
		  width: 256px !important;
		  height: 167px !important;
	  }
	  .bottomcontain .colc {
		  display: inline;
		  width: 256px !important; 
		  height: 166px !important;
	  }
	}
	@media screen and (mini-width: 0px) and (max-width: 320px) {
	  .royalSlider.heroSlider,
	  .royalSlider.heroSlider .rsOverflow {
	    height: 300px !important;
	  }
	  .infoBlock {
	    padding: 10px;
	    height: auto;
	    max-height: 100%;
	    min-width: 40%;
	    left: 5px;
	    top: 5px;
	    right: auto;
	    font-size: 12px;
	  }
	  .infoBlock h3 {
	     font-size: 14px;
	     line-height: 17px;
	  }
	  #overhead #companylogo img {
		  width: 30%;
	  }
	  #main .bottomcontain {
	  	  width: 100%;
		  height: 750px;
	  }
	  .bottomcontain .cola {
	  	  display: inline-block;
		  width: 320px;
		  height: 250px !important;
	  }
	  .bottomcontain .colb {
		  display: block;
		  width: 320px;
		  height: 250px !important;
	  }
	  .bottomcontain .colc {
		  display: block;
		  width: 320px;
		  height: 250px !important;
	  }
	}
	
	#main {
			background-color: white;
			width: 100%;
			min-height: 350px;
			position: absolute;
			margin: 0px;
			overflow: hidden;
			text-align: center;
		}
	#main #overhead {
			background-color: rgba(219,219,219,0.36);
			height: 80px;
			width: 100%;
			min-width: 460px;
			position: absolute;
			top: 0;
			left: 0;
			z-index: 1000;
			text-align: left;
			padding-left: 10px;
		}
		
		#overhead #companylogo {
			float: left;
			display: inline;
		}
		#overhead #topmenu {
			display: inline;
			width: 400px;
			height: 70px;
			padding-top: 10px;
		}
		#topmenu ul {
			text-align: left;
			display: inline;
			margin: 0 auto;
			padding: 5px 4px 5px 0;
			list-style: none;
		}
		#topmenu ul li {
		  font: 100 20px/20px MyriadPro;
		  color: #ececec;
		  display: inline-block;
		  margin-right: -4px;
		  position: relative;
		  padding: 30px 15px;
		  cursor: pointer;
		  -webkit-transition: all 0.2s;
		  -moz-transition: all 0.2s;
		  -ms-transition: all 0.2s;
		  -o-transition: all 0.2s;
		  transition: all 0.2s;
	 }
	#topmenu ul li:hover {
	  background: rgba(84,84,84,0.30);
	  color: #fff;
	}
	#topmenu ul li ul {
	  padding: 0;
	  position: absolute;
	  top: 80px;
	  left: 0;
	  width: 150px;
	  -webkit-box-shadow: none;
	  -moz-box-shadow: none;
	  box-shadow: none;
	  display: none;
	  opacity: 0;
	  visibility: hidden;
	  -webkit-transiton: opacity 0.2s;
	  -moz-transition: opacity 0.2s;
	  -ms-transition: opacity 0.2s;
	  -o-transition: opacity 0.2s;
	  -transition: opacity 0.2s;
	}
	#topmenu ul li ul li { 
	  background: rgba(84,84,84,0.70); 
	  display: block; 
	  color: #fff;
	  padding: 10px 15px;
	  text-shadow: 0 -1px 0 #000;
	}
	#topmenu ul li ul li:hover { background: #666; }
	#topmenu ul li:hover ul {
	  display: block;
	  opacity: 1;
	  visibility: visible;
	}
	#overhead #CSpanel {
		float: right;
		display: inline;
		width: 200px;
		text-align: right;
		padding-right: 10px;
	}
	#CSpanel ul {
			text-align: left;
			display: inline;
			margin: 0 auto;
			padding: 5px 4px 5px 0;
			list-style: none;
		}
	#CSpanel ul li {
	  font: 100 20px/20px MyriadPro;
	  color: #aeaeae;
	  display: inline-block;
	  margin-right: -4px;
	  position: relative;
	  padding: 30px 15px;
	  cursor: pointer;
	  -webkit-transition: all 0.2s;
	  -moz-transition: all 0.2s;
	  -ms-transition: all 0.2s;
	  -o-transition: all 0.2s;
	  transition: all 0.2s;
	 }
	 li img {
	 width: 20px;
	 height: 20px;
	 }
	 
	 #main .contentupper {
		 margin-top: 0px;
		 height: 750px;
		 max-width: 100%;
		 background: url(../images/hero_2014.jpg) no-repeat center center; 
		 -webkit-background-size: cover;
		 -moz-background-size: cover;
		 -o-background-size: cover;
		 background-size: cover;
	 }
	 .innercontents {
		 padding-top: 270px;
		 margin-left: auto;
		 margin-right: auto;
		 vertical-align: middle;
		 width: 80%;
		 height: 400px;
	 }
	 p.title {
		 font-size: 42pt;
		 color: #ffffff;
		 font-family: HelveticaNeue;
	 }
	 p.titleb {
		 font-size: 42pt;
		 color: #1e1e1e;
		 font-family: HelveticaNeue;
	 }
	 p.subtitle {
	 padding-top: 20px;
		 font-size: 24px;
		 color: #f7f7f7;
		 font-family: HelveticaNeue;
	 }
	 p.subtitleb {
	 padding-top: 10px;
		 font-size: 24px;
		 color: #171717;
		 font-family: HelveticaNeue;
	 }
	 p.maintext {
		 padding: 40px;
		 font-size: 36px;
		 color: #f7f7f7;
		 font-family:HelveticaNeue;
	 }
	 p.maintext img {
		 vertical-align: text-bottom;
	 }
	 p.subtext img {
		 padding-left: 10px;
		 padding-right: 10px;
	 }
	 #main .contentmiddle {
		 margin-top: 0px;
		 height: 750px;
		 max-width: 100%;
		 background: url(../images/hero_2014II.jpg) no-repeat center center fixed; 
		 -webkit-background-size: cover;
		 -moz-background-size: cover;
		 -o-background-size: cover;
		 background-size: contain;
	 }
	 .rightblock {
		 float: left;
		 height: 400px;
		 width: 500px;
		 background: rgba(28,28,28,0.50);
	 }
	 .rightblock p.title {
	 	padding-top: 40px;
		 color: #FFF;
		 text-align: center;
		 font-family:HelveticaNeue;
		 font-size:24pt;
		 line-height: 28pt;
	 }
	 .rightblock p.subtitle {
	 	padding-top: 20px;
	 	padding-left: 10px;
	 	padding-right: 10px;
		 color: #cecece;
		 text-align: center;
		 font-family:HelveticaNeue;
		 font-size:18pt;
		 line-height: 24pt;
	 }
	 #main .contentlower {
		 margin-top: 0px;
		 height: 750px;
		 max-width: 100%;
		 background: url(../temp/images/hero_01.jpg) no-repeat center center fixed; 
		 -webkit-background-size: cover;
		 -moz-background-size: cover;
		 -o-background-size: cover;
		 background-size: contain;
	 }
	 #main .bottomstatic {
		 margin-top: 0px;
		 margin-left: auto;
		 margin-right: auto;
		 max-width: 1440px;
		 min-width: 320px;
		 height: 750px;
		 overflow: hidden;
		 padding: 0px;
		 background: url(../images/hero_bottom.jpg);
		 background-repeat: no-repeat;
		 background-position: center center;
	 }
	 .bottomstatic .rightlog {
		 float: right;
		 width: 500px;
		 background: rgba(255,255,255,0.26);
		 padding: 20px;
	 }
	 .rightlog .rowa {
	 	padding-top: 1px;
		 width: 500px;
		 height: 101px;
		 overflow: hidden;
		 border: none;
	 }
	 .rowa .cola {
		 float: left;
		 width: 200px;
		 height: 100px;
		 display: inline;
		 border: none;
		 
	 }
	 .rowa .colb {
		 float: right;
		 width: 299px;
		 height: 100px;
		 padding-left: 1px;
		 display: inline;
		 border: none;
	 }
	 .rowa .colc {
		 float: left;
		 width: 299px;
		 height: 100px;
		 display: inline;
		 border: none;
	 }
	 .rowa .cold {
		 float: right;
		 width: 200px;
		 height: 100px;
		 padding-left: 1px;
		 display: inline;
		 border: none;
	 }
	 .rightlog p.title {
		 padding-top: 40px;
		 color: #343434;
		 text-align: left;
		 font-family:HelveticaNeue;
		 font-size:24pt;
		 line-height: 28pt;
	 }
	 
	 #main .bottomcontain {
	 	 margin-top: 0px;
		 margin-left: auto;
		 margin-right: auto;
		 max-width: 1440px;
		 min-width: 320px;
		 min-height: 250px;
		 overflow: hidden;
		 padding: 0px;
	 }
	 .bottomcontain .cola {
		 float: left;
		 width: calc(100%/3);
		 height: 250px;
		 background-color: rgba(127,123,255,0.97);
		 display: inline;
		 background-image: url(../images/bg_catalog_index.png);
		 background-repeat: no-repeat;
		 background-size: 100% 100%;
	 }
	 .bottomcontain .cola img {
		 height: 98%;
		 width: 98%;
	 }
	 .bottomcontain .colb {
	 	float: left;
	 	width: calc(100%/3);
		 height: 250px;
		 background-color: rgba(129,148,255,0.96);
		 display: inline;
		 background-image: url(../images/bg_onlinestore_index.png);
	 }.bottomcontain .colb img {
		 height: 98%;
		 width: 98%;
	 }
	 .bottomcontain .colc {
	 		float: right;
	 		width: calc(100%/3);
	 		height: 250px;
	 		background-color: rgba(40, 30, 255, 0.90);
	 		display: inline;
	 		background-image: url(../images/bg_event_index.png);
	 }
	 .bottomcontain .colc img {
		 height: 98%;
		 width: 98%;
	 }
	 #main #footer {
		 width: 100%;
		 min-height: 100px;
	 }
	 #footer #footer_content {
		 max-width: 1440px;
		 min-width: 320px;
		 margin-left: auto;
		 margin-right: auto;
		 overflow: auto;
	 }
	 #footer_content .cola {
		 float: left;
		 width: 50%;
		 text-align: left;
	 }
	 #footer_content .colb {
		 float: right;
		 width: 50%;
		 text-align: right;
	 }
	 .footertext {
	 	font: 100 9px/9px MyriadPro;
	 	 margin-left: 10px;
		 font-size: 10pt;
		 margin-right: 10px;
	 }
	 #page-navigation { display: none; }
</style> 
</head>
 <body>
  	<div id="main">
  	<div id="overhead">
			<!-- header of the page -->
				<div id="companylogo"><img src="../temp/images/logo_resize.png" alt="logo"></div>
				<div id="topmenu"><ul>
					<li>Products
						<ul>
							<li><a href="/beads/">Beads</a></li>
							<li><a href="/bracelets/">Bracelets</a></li>
							<li><a href="/necklet/">Necklaces</a></li>
							<li>Silvers</li>
							<li>Others</li>
						</ul>
					</li>
					<li>Events
						<ul>
							<li>Special Event</li>
							<li>Exhibitions</li>
						</ul>
					</li>
					<li>About Us
						<ul>
							<li>Our Company</li>
							<li>Our Goal</li>
							<li>Reach Us</li>
						</ul>
					</li>
					
				</ul>
				</div>
				<div id="CSpanel">
				<ul>
					<li>Login</li>
				</ul>
				</div>
  	</div>
  	
  	<div class="contentupper">
  		<div class="innercontents">
  			<p class="title">2014 Hong Kong Jewellery and Gem Fair</p>
  			<p class="subtitle"> 15 - 19 September 2014 AsiaWorld Expo Hong Kong</p>
  			<p class="maintext">Come and Visit us at Asiaworld Expo <img src="../images/badge_exhib_booth.png" alt="booth" alt="3B18"></p>
  			<p class="subtext"><a href="#products"><img src="../images/button_exhib_top01.png" alt="achor01"></a><a href="#special"><img src="../images/button_exhib_top02.png" alt="achor02"></a><a href="#AboutExhib"><img src="../images/button_exhib_top03.png" alt="achor02"></a><br><a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.vigorgems.com%2Fevents%2Findex.php&media=http%3A%2F%2Fwww.vigorgems.com%2Fimages%2Fhero_2014II.jpg&description=Vigor%20Events!" data-pin-do="buttonPin" data-pin-config="none"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script> <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=219041981460080&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><div class="fb-like" data-href="http://www.vigorgems.com/events/index.php" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div></p>
  		</div>
  	</div>
  	<div class="contentmiddle"><a id="products"></a>
  		<div class="innercontents">
  			<div class="rightblock">
  				<p class="title">We have more 1000's styles<br>More than 100 kind of stones</p>
  				<p class="subtitle"> You can go to our website to sign in for more details<br><a href="../bracelet/"><img src="../images/button_foundoutmore.png" alt="foundoutmore"></a></p>
  			</div>
  		</div>
  	</div>
  	<div class="contentlower"><a id="special"></a>
  		<div class="innercontents">
  			<p class="titleb">For more detail of promotion!</p>
  			<p class="subtitleb">Contact us for details!<br><img src="../images/button_contactus.png" alt="contactus"></p>
  		</div>
  	</div>
  	<div class="bottomstatic">
  		<a id="AboutExhib"> </a>
  		<div class="rightlog">
  			<p class="title">About Exhibition</p>
  			<div class="rowa"><img src="../images/bg_exhibition.png" alt="title"></div>
  			<div class="rowa">
  				<div class="cola"><img src="../images/bg_exhib_loc.png" alt="location"></div>
  				<div class="colb"><img src="../images/bg_exhib_locA.png" alt="location"></div>
  			</div>
  			<div class="rowa"><img src="../images/bg_exhib_time.png" alt="time"></div>
  			<div class="rowa">
  				<div class="colc"><img src="../images/bg_exhib_twit.png" alt="pin"></div>
  				<div class="cold"><img src="../images/bg_exhib_pin.png" alt="twitte"></div>
  			</div>
  		</div>
  	</div>
  	<div id="footer">
  		<div id="footer_content">
  		 	<div class="cola"><span class="footertext">Shop and order at our online <a href="http://vgems.co">store</a>, or visit our showroom.</span></div>
  		 	<div class="colb"><span class="footertext">Site Map | Hot News | Our Responsibility | Jobs | Contact Us | </span></div>
  		 	<div class="cola"><span class="footertext">Copyright © 2014 Vigor Gems and Jewelry LTD. All rights reserved. Terms of Use| Privacy Policy</span></div>
  		</div>
	</div>
  	</div>
  </body>
</html>