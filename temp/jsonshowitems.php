<?php
	$readget = $_GET['featured'];
	$jsonurl = "../shop/site_parserecentjson.php?ftd=".$readget;
	
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Testing</title>
		<!-- CSS style -->
		<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
	</head>
	<body>
		testing
		<div id="placeholder"></div>
		<script type="text/javascript">
			$.getJSON('<?php echo $jsonurl; ?>', function(data) {
        var output="<div id=\"specialitems\" align=\"left\">";
        for (var i in data.postcontents) {
	        
        	output+="<div class=\"imgcontainer\"><img class=\"lazy\" data-src=\"images/loading.gif\" src=\"" + data.productimg[i] + "\">" + "</div><div class=\"itemcola\"><div class=\"imgcontainer\">" + data.productname[i] + "--" + data.productsku[i] + "</span></div></div>";
        }
        output+="</div>";
        document.getElementById("placeholder").innerHTML=output;
  });
		</script>

	</body>
</html>