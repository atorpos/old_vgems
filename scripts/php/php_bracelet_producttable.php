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

mysql_select_db($database_external, $external);
$query_Recordset1 = "SELECT * FROM stock WHERE `prefix` = 'BL005'
    OR `prefix` = 'BL006'
    OR `prefix` = 'BL007'
    OR `prefix` = 'BL008'
    OR `prefix` = 'BL009'
    OR `prefix` = 'BL010'
    OR `prefix` = 'BL011'
    OR `prefix` = 'BL018'
    OR `prefix` = 'BLC020'
    OR `prefix` = 'BLF020'
    OR `prefix` = 'BL021'
    OR `prefix` = 'BL022'
    OR `prefix` = 'BLC023'
    OR `prefix` = 'BLF023'
    OR `prefix` = 'BL024'
    OR `prefix` = 'BL025'
    OR `prefix` = 'BL026'
    OR `prefix` = 'BL028'
    OR `prefix` = 'BLC029'
    OR `prefix` = 'BL030'
    OR `prefix` = 'BL031'
    OR `prefix` = 'BL032'
    OR `prefix` = 'BL033'
    OR `prefix` = 'BL034'
    OR `prefix` = 'BL035'
    OR `prefix` = 'BL038'
    OR `prefix` = 'BL039'
    OR `prefix` = 'BL040'
    OR `prefix` = 'BL041'
    OR `prefix` = 'BL042'
    OR `prefix` = 'BL044'
    OR `prefix` = 'BL061'
    OR `prefix` = 'BL062'
    OR `prefix` = 'BL080'
    OR `prefix` = 'BL081'
    OR `prefix` = 'BL329'
    OR `prefix` = 'BCL004'
    OR `prefix` = 'BCL001'
    OR `prefix` = 'BCL005'
    OR `prefix` = 'BCL012'
    OR `prefix` = 'BFL012'
    OR `prefix` = 'BCL013'
    OR `prefix` = 'BFL013'
    OR `prefix` = 'BFL022'
    OR `prefix` = 'BFL215'
    OR `prefix` = 'BCL037'
    OR `prefix` = 'BFL039'
    OR `prefix` = 'BCL046'
    OR `prefix` = 'BCL051'
    OR `prefix` = 'BCL055'
    OR `prefix` = 'BFL060'
    OR `prefix` = 'BCL072'
    OR `prefix` = 'BCL081'
    OR `prefix` = 'BCL082'
    OR `prefix` = 'BCL501'
    OR `prefix` = 'BFL503'
    OR `prefix` = 'BLF504'
    OR `prefix` = 'PBL501'
    OR `prefix` = 'BLS060'
ORDER BY id DESC";
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
?>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
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
      <td width="230" align="center" id="productsq"><img src="../images/products/tb_<?php echo strtolower($row_Recordset1['prefix']); ?><?php echo strtolower($row_Recordset1['middle']); ?>.gif" /><br /><strong>Product Name: <?php echo $row_Recordset1['suffix']; ?>mm 
      <?php 
	  	$colname_Recordset3 = "-1";
		if (isset($_POST['name'])) {
		  $colname_Recordset3 = $_POST['name'];
		}
		mysql_select_db($database_stockcode, $stockcode);
		$query_Recordset3 = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_Recordset1['middle']);
		$Recordset3 = mysql_query($query_Recordset3, $stockcode) or die(mysql_error());
		$row_Recordset3 = mysql_fetch_assoc($Recordset3);
		$totalRows_Recordset3 = mysql_num_rows($Recordset3);
		echo $row_Recordset3['description']; 
		?>
	  
	  <?php 
              $colname_Recordset2 = "-1";
        if (isset($_POST['prefix'])) {
          $colname_Recordset2 = $_POST['prefix'];
        }
        mysql_select_db($database_stockcode, $stockcode);
        $query_Recordset2 = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_Recordset1['prefix']);
        $Recordset2 = mysql_query($query_Recordset2, $stockcode) or die(mysql_error());
        $row_Recordset2 = mysql_fetch_assoc($Recordset2);
        $totalRows_Recordset2 = mysql_num_rows($Recordset2);
        echo $row_Recordset2['description']; 
		?> 
        
      </strong>
      <br />In Stock: <?php 
	  if ($row_Recordset1['stock'] = 0 ) {
		  echo "<font color=\"red\"><b>OUT OF STOCK</b></font>";
		  break;}
		  else {
	  echo $row_Recordset1['stock'];
		  }
	  ?><br /><div id="moreinfobuy"><a href="../detail/index.php?id=<?php echo $row_Recordset1['id'];?>">More Info</a> <em>|</em> Quote the Price</div></td>
      
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

<?php
mysql_free_result($Recordset1);
?>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
