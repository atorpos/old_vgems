<?php

	header("Content-Type: text/css");
	echo "#header {
	width: 1000px;
	height: auto;
	z-index: 9998;
	margin-top: 40px;
	margin-right: auto;
	margin-left: auto;
	overflow: hidden;
}
#header #applesearch #livesearch
  {
  	font-family: Helvetica, Verdana, Arial, sans-serif;
  	margin:4px;
  	width:204px;
  	z-index: 10000;
 	position: absolute;
	background-color: #FFFFFF;
	padding: 5px;
	font-size: 10px;
	line-height: 14px;
}

#header #staticbar {
	width: 1000px;
}

#staticbar #logoholder {
	width: 600px;
	float: left;
	height: 65px;
}
#staticbar #searchholder {
	text-align: right;
	width: 211px;
	float: right;
	height: 65px;
}
#header #navigation {
	text-align: justify;
}
#txt1
  {
  	margin:0px;
  	
	}
#header #staticbar img {
	padding-bottom: 10px; border: 0px;
}

/* ----------- NAVIGATION----------- */

#header #navigation{ 
	height:15px; 
	margin-left: auto;
	margin-right: auto;
	margin-top: 65px;
	margin-bottom: 0px;
	width:auto; 
	position: relative;
	}
	#navigation ul{
	 height:15px;
	 line-height:15px;	
	}
	#navigation ul li{
		display:inline;
	}
	#navigation ul li a,
	#navigation ul li a:visited {
		padding:0 20px;
		display:block;
		text-decoration:none;
		float:left;
		color:#7a7a7a;
		text-shadow: #ffffff 1px 1px 1px;
	font-size: 11px;
}
	#navigation ul li a:hover{
		color:#1532a5;
	}
/* ----------- SUBLINKS ----------- */
#header #sublinks{
	width:auto;
	margin-left: auto;
	margin-right: auto;
	margin-top: 0px;
	margin-bottom: 0px;
	
	height:20px;
	font-size:11px;
	overflow: hidden;
}	
	#sublinks ul{
	 height:22px;
	 line-height:20px;	
	}
	#sublinks ul li{
		display:inline;
	}
	#sublinks ul li a,
	#sublinks ul li a:visited {
		padding:0 20px;
		display:block;
		text-decoration:none;
		float:left;
		color:#7a7a7a;
	}
	#sublinks ul li a:hover{
		text-decoration:underline;
	}
/* ----------- SUBMENU ----------- */
#s2, #s3{display:none;}


/*--footer--*/
#int_footer {
	margin-right: auto;
	margin-left: auto;
	margin-bottom: 0px;
	border-style: none;
	border-width: 0px;
	background-position: left top;
	margin-top: 20px;
	min-height: 250px;
	width: 100.5%;
	background-color: white;
	background-repeat: repeat-x;
	background-image: url(/images/bg_footer.jpg);
}

#int_footer #footer_content {
	width: 1000px;
	padding-top: 25px;
	margin-right: auto;
	margin-left: auto;
	position: relative;
}
#cola {
	position: relative;
	float: left;
	left: 0px;
	width: 200px;
}
#colb {
	position: relative;
	float: left;
	left: 0px;
	width: 200px;
	
}
#colc {
	position: relative;
	float: left;
	left: 0px;
	width: 200px;
	
}
#cold {
	position: relative;
	float: left;
	left: 0px;
	width: 200px;
	
}
#cole {
	position: relative;
	float: right;
	right: 0px;
	width: 200px;
	
}

#footer_content h3 {
	color: #333; margin: 0; font-size: 1em; line-height: 15px; font-weight: bold; padding-bottom: 4px; 
}
#footer_content span.headline {
	color: #333; margin: 0; font-size: 1em; line-height: 15px; font-weight: bold; padding-bottom: 4px;
}
.group img {
	padding-right: 3px;
}
#footer {
	width: 1000px;
	font-family: \"Helvetica Neue\", Arial, Helvetica, Geneva, sans-serif;
	font-size: 10px;
	line-height: 12px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 50px;
	margin-bottom: 30px;
}

.copyright {
	float: left;
	margin-top: 10px;
	margin-bottom: 30px;
	text-align: left;
}

.usefullink{
	text-align:right; margin-top: 10px;
	margin-bottom: 30px; float: right;

}

";
if($pagetype == "slide") {
	echo "
	.group {
	padding-bottom: 9px;
	margin-bottom: 0px;
	margin-top: 5px;
	margin-left: 0px;
}
.group li {

	padding-left: 0px;
	padding-bottom: 1px;
	padding-right: 0px;
	padding-top: 0px;
	margin: 0px;
	list-style-position: inside;
	list-style: none;
	text-align: left;
	word-spacing: 4px;
	line-height: 14px;
	font-size: 11px;
	font-family: Helvetica, Verdana, Arial, sans-serif;

}
.group_social {
	padding-bottom: 9px;
	margin-bottom: 0px;
	margin-top: 5px;
	margin-left: 0px;
}
.group_social li {
	list-style-type: none;
	list-style-position: inside;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	word-spacing: 2px;
	font-variant: small-caps;
	text-align: left;
	line-height: 24px;
	font-size: 12px;
}
.group_social img {
	padding-right: 3px;
}
	";
} else {
	echo "
	.group {
	padding-bottom: 9px;
	margin-bottom: 0px;
	margin-top: 5px;
	margin-left: -40px;
}
.group li {

	padding-left: 0px;
	padding-bottom: 1px;
	padding-right: 0px;
	padding-top: 0px;
	margin: 0px;
	list-style-position: inside;
	list-style: none;
	text-align: left;
	word-spacing: 4px;
	line-height: 14px;
	font-size: 11px;
	font-family: Helvetica, Verdana, Arial, sans-serif;

}
.group_social {
	padding-bottom: 9px;
	margin-bottom: 0px;
	margin-top: 5px;
	margin-left: -40px;
}
.group_social li {
	list-style-type: none;
	list-style-position: inside;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	word-spacing: 2px;
	font-variant: small-caps;
	text-align: left;
	line-height: 24px;
	font-size: 12px;
}
.group_social img {
	padding-right: 3px;
}
	";
}

?>