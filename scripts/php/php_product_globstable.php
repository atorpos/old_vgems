<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 15;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_stockcode, $stockcode);
$query_Recordset1 = "SELECT * FROM prefixcode WHERE `type` = '09' AND  `active` ='1'
ORDER BY code DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $external) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?><div id="topbarnav">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td><?php switch ($_GET['code']) {
			case "F":
			echo "<img src=\"/images/button_topbar_nav_f.png\" />";
			break;
			case "C":
			echo "<img src=\"/images/button_topbar_nav_c.png\" />";
			break;
			case NULL:
			echo "<img src=\"/images/button_topbar_nav_all.png\" />";
			break;
		} 
		?></td>

    <td width="30px"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="../../images/button_topbar_nav_03.png" alt="home" border="0"/></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="602px"></td>
    <td  width="30px"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="../../images/button_topbar_nav_01.png" alt="previous" border="0"/></a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="../../images/button_topbar_nav_02.png" alt="next" border="0"/></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</div><div id="biglable"><img src="../../images/bg_biglable_globe.jpg" /></div><div id="centrallist" align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <?php $i = 3; $j = 2;echo"<tr>"; do { ?>
  <?php 
  		if ($i > 0) {
			$i = $i - 1;
		  
		  }
		  else {
		  echo "<tr>"; 
		  $i = 2;
		  
		  }
    ?>
      <td width="230" align="center" id="productsq">
	  <?php
	  	$filename = '../images/products/tb_' .strtolower($row_Recordset1['code']). '.gif';
		if (file_exists($filename)) {
		    print "<a class=\"single_image\" href=\"../images/products/" .strtolower($row_Recordset1['code']). ".jpg\">";
	  		print "<img src=\"../images/products/tb_" .strtolower($row_Recordset1['code']). ".gif\" alt=\"". $row_Recordset1['description']. " \"/></a>";  } 
		else {
		
		print "<img src=\"../images/products/tb_blank.gif\">";
		
		} ?><br /><strong>Product Code: <?php echo $row_Recordset1['code'];
		?>
        
      </strong>
      <br />Description: <?php print $row_Recordset1['description']; ?><br /><div id="moreinfobuy"><a href="/detail/index.php?id=<?php echo $row_Recordset1['id'];?>">More Info</a> <em>|</em> Quote the Price</div></td>
      
      <?php 
  		if ($j > 0) {
			$j = $j - 1;
		  
		  }
		  else {
		  echo "</tr>"; 
		  $j = 2;
		  
		  }
    ?>
      
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</div>
<?php
mysql_free_result($Recordset1);
?><div id="bottombarnav" >
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td><img src="../../images/bg_bottombar_carving.png" /></td>
    <td width="550px"></td>
  </tr>
</table></div>