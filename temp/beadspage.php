<?php require_once('../Connections/stockcode.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Bracelet = 50;
$pageNum_Bracelet = 0;
if (isset($_GET['pageNum_Bracelet'])) {
  $pageNum_Bracelet = $_GET['pageNum_Bracelet'];
}
$startRow_Bracelet = $pageNum_Bracelet * $maxRows_Bracelet;

mysql_select_db($database_stockcode, $stockcode);
$query_Bracelet = "SELECT code, `description` FROM prefixcode WHERE `type` = '1' AND  `active` ='1' ORDER BY code ASC";
$query_limit_Bracelet = sprintf("%s LIMIT %d, %d", $query_Bracelet, $startRow_Bracelet, $maxRows_Bracelet);
$Bracelet = mysql_query($query_limit_Bracelet, $stockcode) or die(mysql_error());
$row_Bracelet = mysql_fetch_assoc($Bracelet);

if (isset($_GET['totalRows_Bracelet'])) {
  $totalRows_Bracelet = $_GET['totalRows_Bracelet'];
} else {
  $all_Bracelet = mysql_query($query_Bracelet);
  $totalRows_Bracelet = mysql_num_rows($all_Bracelet);
}
$totalPages_Bracelet = ceil($totalRows_Bracelet/$maxRows_Bracelet)-1;

function getcol() {
 	$coltable = "col". rand(1,5);
 	return $coltable;
 	}
 ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />

  <title>Infinite Scroll Demo 1 - jQuery4u</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

  <link rel="stylesheet" href="http://www.jquery4u.com/demos/infinite-scrolling-demo1/css/style.css" />

  <!-- scripts at bottom of page -->

</head>
<body class="demos">

<div style="display:inline-block;width:100%;padding:10px;background-color:#FFFFFF">
<a href="/bead/">back to beads page</a>
</div>

  <section id="content">

      <h1>Beads light-table</h1>

  </section>

<div id="container" class="transitions-enabled infinite-scroll clearfix">
<?php
	do {
	echo "<div class=\"box ". getcol() ."\"><p>";
	echo "<a href=\"/detail/index.php?id=\" title=\"".$row_Bracelet['description']. "\"><img src=\"/images/products/". strtolower($row_Bracelet['code']).".jpg\" alt=\"".$row_Bracelet['description']."\" /></a>";
	echo "</p></div>";
	} while ($row_Bracelet = mysql_fetch_assoc($Bracelet));
?>
</div> <!-- #container -->

<nav id="page-nav">
  <a href="beads/2.php"></a>
</nav>

<script src="http://www.jquery4u.com/demos/infinite-scrolling-demo1/js/jquery-1.6.2.min.js"></script>
<script src="http://www.jquery4u.com/demos/infinite-scrolling-demo1/js/jquery.masonry.min.js"></script>
<script src="http://www.jquery4u.com/demos/infinite-scrolling-demo1/js/jquery.infinitescroll.min.js"></script>
<script>
  $(function(){

    var $container = $('#container');

    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.box',
        columnWidth: 100
      });
    });

    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.box',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true );
        });
      }
    );

  });
</script>

  </section> <!-- #content -->


<div id="footer" style="display:inline-block;width:100%;padding:10px;background-color:#FFFFFF">
</div>
<?php
		mysql_free_result($Bracelet);
?>
</body>
</html>