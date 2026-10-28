<?php
	if ($_SERVER['HTTPS'] != "on") { 
    	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
    	header("Location: $url"); 
    	exit; 
    }
	$pagename = "Bracelet Lighttable";
	$pagetype = "lighttable";
	$filename = "https://www.vigorgems.com/lighttable/bracelet.php";
	if (!isset($_SESSION)) {
  session_start();
  }
  $MM_authorizedUsers = "";
  $MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
	function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  	$isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "/signin.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
require_once('../Connections/stockcode.php');
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
$query_Bracelet = "SELECT code, `id`, `description` FROM prefixcode WHERE `type` = '4' AND  `active` ='1' ORDER BY code ASC";
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
<?php include('../header.php'); ?>
 <link rel="stylesheet" href="/scripts/css/lighttable.css" />
<div class="demos">
<div style="display:inline-block;width:100%;padding:10px;background-color:#FFFFFF">
<a href="/bracelet/">Go to bracelets' page</a>
</div>

  <section id="content">

      <h1>Bracelet light-table</h1>

  </section>

<div id="container" class="transitions-enabled infinite-scroll clearfix">
<?php
	do {
	echo "<div class=\"box ". getcol() ."\"><p>";
	echo "<a href=\"/detail/index.php?id=". $row_Bracelet['id']. "\" title=\"".$row_Bracelet['description']. "\"><img src=\"/images/products/". strtolower($row_Bracelet['code']).".jpg\" alt=\"".$row_Bracelet['description']."\" /></a></p>";
	echo "<p>Product code:". $row_Bracelet['code'];
	echo "</p></div>";
	} while ($row_Bracelet = mysql_fetch_assoc($Bracelet));
?>
</div> <!-- #container -->

<nav id="page-nav">
  <a href="/temp/braceletpage2.php"></a>
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


<div id="footer" style="display:inline-block;width:100%;padding:10px;background-color:#FFFFFF"></div>
<?php include('../int_footer.php'); ?>
<?php
		mysql_free_result($Bracelet);
?>
</body>
</html>