<?php require_once('Connections/news.php'); ?>
<?php
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

$maxRows_news = 10;
$pageNum_news = 0;
if (isset($_GET['pageNum_news'])) {
  $pageNum_news = $_GET['pageNum_news'];
}
$startRow_news = $pageNum_news * $maxRows_news;

mysql_select_db($database_news, $news);
$query_news = "SELECT * FROM news ORDER BY id DESC";
$query_limit_news = sprintf("%s LIMIT %d, %d", $query_news, $startRow_news, $maxRows_news);
$news = mysql_query($query_limit_news, $news) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);

if (isset($_GET['totalRows_news'])) {
  $totalRows_news = $_GET['totalRows_news'];
} else {
  $all_news = mysql_query($query_news);
  $totalRows_news = mysql_num_rows($all_news);
}
$totalPages_news = ceil($totalRows_news/$maxRows_news)-1;


?>
<?php
date_default_timezone_set('HKT');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<rss version=\"2.0\">\n<channel>";
echo "<title>Vigor Hot News</title>
<link>http://www.vigorgems.com/hotnews/</link>
<description>Hot News provided by Vigor Gems and Jewelry Limited.</description>
<language>en-us</language>
<copyright>Copyright 2009, Vigor Gems and Jewelry LTD.</copyright>
<pubDate>" .date(DATE_RFC822). "</pubDate>
<lastBuildDate>" .date(DATE_RFC822). "</lastBuildDate>
<category>Vigor Gems and Jewelry Limited</category>
<generator>In house</generator>
<docs>http://blogs.law.harvard.edu/tech/rss/</docs>\n";
do {
	echo "<item>\n<title>" .$row_news['title']. "</title>\n";
	echo "<link>" .$row_news['link']. "</link>\n";
	echo "<description>" . $row_news['detail']. "</description>\n";
	echo "<pubDate>" .date('r', strtotime($row_news['pubdate'])). "</pubDate>\n</item>\n";

} while ($row_news = mysql_fetch_assoc($news));
echo "</channel>\n</rss>";
mysql_free_result($news);
?>


