<?php
	//$readget = $_GET['featured'];
	//if (isset($readget)) {
	//	$jsonurl = "../shop/site_parserecentjson.php?ftd=".$readget;
	//} else {
	//	$jsonurl = "../shop/site_parserecentjson.php?ftd=YES";
	//}
	
	$readget = $_GET['type'];
	if (isset($readget)) {
		$jsonurl = "../shop/site_parsetypejson.php?catrpost=".$readget;
	} else {
		$jsonurl = "../shop/site_parserecentjson.php?ftd=YES";
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Products</title>
	
    <!-- Bootstrap core CSS -->
    <link href="../scripts/css/bootstrap.min.css" rel="stylesheet">
	<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <script src="jquery.infinitescroll.min.js"></script>
    <script data-require="masonry@*" data-semver="2.1.0-7" src="//cdnjs.cloudflare.com/ajax/libs/masonry/2.1.07/jquery.masonry.min.js"></script>
    <link href="album.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="https://www.vigorgems.com/">Vigor Gems</a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
          	<div class="dropdown">
			  <a class="btn btn-secondary dropdown-toggle" href="https://www.vigorgems.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Semi-Finishing Products
			  </a>
			
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="https://www.vigorgems.com/shop/index.php/product-category/gemstone-beads/">Beads</a>
			    <a class="dropdown-item" href="https://www.vigorgems.com/shop/index.php/product-category/cabochon/">Cabochon</a>
			    <a class="dropdown-item" href="#">Carving</a>
			  </div>
			</div>
          </li>
          <li class="nav-item">
			<div class="dropdown">
			  <a class="btn btn-secondary dropdown-toggle" href="https://www.vigorgems.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Finishing Products
			  </a>
			
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="https://www.vigorgems.com/shop/index.php/product-category/gemstone-beads/">Bracelet</a>
			    <a class="dropdown-item" href="#">Necklace</a>
			    <a class="dropdown-item" href="#">Ring</a>
				<a class="dropdown-item" href="#">Earrings</a>
			  </div>
			</div>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Stones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Account</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> 
        &middot;
        <a class="btn" href="#" role="button">Log In</a>
      </div>
    </nav>


    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Feature <?PHP echo $readget; ?></h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary">Main call to action</a>
          <a href="#" class="btn btn-secondary">Secondary action</a>
        </p>
      </div>
    </section>

    <div class="album text-muted">
	    
      <div class="container">
	  	<script type="text/javascript">
			$.getJSON('<?php echo $jsonurl; ?>', function(data) {
        var output="";
        for (var i in data.postcontents) {
	        
        	output+="<div class=\"card\"><img data-src=\"images/loading.gif\" src=\"" + data.productimg[i] + "\">" + "<p class=\"card-text\">" + data.productname[i] + "<br />SKU: " + data.productsku[i] + "</p><a href=\"#\" class=\"btn btn-secondary\">View Details</a></div>";
        }
        output+="";
        document.getElementById("placeholder").innerHTML=output;
  });
		</script>

        <div class="row" id="placeholder">
          <!-- 1 -->
			<div class="loader loader--style1" title="0">
			  <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			   width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
			  <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
			    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
			    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
			  <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
			    C22.32,8.481,24.301,9.057,26.013,10.047z">
			    <animateTransform attributeType="xml"
			      attributeName="transform"
			      type="rotate"
			      from="0 20 20"
			      to="360 20 20"
			      dur="0.5s"
			      repeatCount="indefinite"/>
			    </path>
			  </svg>
			</div>
        </div>
      </div>
    </div>
    <footer class="text-muted">
      <div class="container">
        <p>&copy; 2017 Vigor Gems and Jewelry Ltd. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </div>
     <div id="loading">
            Loading
     </div>
     <?php printf("<script src=\"script.php?type=%s\"></script>", $readget); ?>
    
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="holder.min.js"></script>
    <script>
      $(function () {
        Holder.addTheme("thumb", { background: "#55595c", foreground: "#eceeef", text: "Thumbnail" });
      });
    </script>
     <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="../scripts/javascript/bootstrap.min.js"></script>
  </body>
</html>
