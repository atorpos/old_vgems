<?php require_once('../Connections/external.php'); ?>
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

$maxRows_Recordset1 = 10000;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_external, $external);
$query_Recordset1 = "SELECT * FROM stock WHERE `prefix` = 'BC003'
    OR `prefix` = 'BC004'
    OR `prefix` = 'BC501'
    OR `prefix` = 'BM501'
    OR `prefix` = 'BF501'
    OR `prefix` = 'BF502'
    OR `prefix` = 'BF504'
    OR `prefix` = 'BF505'
    OR `prefix` = 'BF506'
    OR `prefix` = 'BF507'
    OR `prefix` = 'BC508'
    OR `prefix` = 'BC509'
    OR `prefix` = 'BC510'
    OR `prefix` = 'BC511'
    OR `prefix` = 'BF513'
    OR `prefix` = 'BC001'
    OR `prefix` = 'BF001'
    OR `prefix` = 'BC002'
    OR `prefix` = 'BF002'
    OR `prefix` = 'BF902'
    OR `prefix` = 'BF003'
    OR `prefix` = 'BF403'
    OR `prefix` = 'BF004'
    OR `prefix` = 'BC005'
    OR `prefix` = 'BF005'
    OR `prefix` = 'BC006'
    OR `prefix` = 'BC007'
    OR `prefix` = 'BC008'
    OR `prefix` = 'BC009'
    OR `prefix` = 'BC010'
    OR `prefix` = 'BC011'
    OR `prefix` = 'BC012'
    OR `prefix` = 'BC013'
    OR `prefix` = 'BF013'
    OR `prefix` = 'BC014'
    OR `prefix` = 'BF014'
    OR `prefix` = 'BF215'
    OR `prefix` = 'BC015'
    OR `prefix` = 'BF015'
    OR `prefix` = 'BC016'
    OR `prefix` = 'BF016'
    OR `prefix` = 'BF017'
    OR `prefix` = 'BC018'
    OR `prefix` = 'BM018'
    OR `prefix` = 'BF018'
    OR `prefix` = 'BC019'
    OR `prefix` = 'BF019'
    OR `prefix` = 'BF0192'
    OR `prefix` = 'BC020'
    OR `prefix` = 'BC021'
    OR `prefix` = 'BC022'
    OR `prefix` = 'BF022'
    OR `prefix` = 'BF221'
    OR `prefix` = 'BC023'
    OR `prefix` = 'BF023'
    OR `prefix` = 'BF024'
    OR `prefix` = 'BC025'
    OR `prefix` = 'BC026'
    OR `prefix` = 'BC027'
    OR `prefix` = 'BC028'
    OR `prefix` = 'BC029'
    OR `prefix` = 'BC030'
    OR `prefix` = 'BC031'
    OR `prefix` = 'BC032'
    OR `prefix` = 'BC033'
    OR `prefix` = 'BC034'
    OR `prefix` = 'BC035'
    OR `prefix` = 'BF035'
    OR `prefix` = 'BF134'
    OR `prefix` = 'BC036'
    OR `prefix` = 'BF036'
    OR `prefix` = 'BFT36'
    OR `prefix` = 'BFM36'
    OR `prefix` = 'BC037'
    OR `prefix` = 'BF037'
    OR `prefix` = 'BC038'
    OR `prefix` = 'BC039'
    OR `prefix` = 'BC040'
    OR `prefix` = 'BC041'
    OR `prefix` = 'BC043'
    OR `prefix` = 'BC044'
    OR `prefix` = 'BC045'
    OR `prefix` = 'BC046'
    OR `prefix` = 'BF046'
    OR `prefix` = 'BC047'
    OR `prefix` = 'BF048'
    OR `prefix` = 'BC049'
    OR `prefix` = 'BF050'
    OR `prefix` = 'BC051'
    OR `prefix` = 'BC052'
    OR `prefix` = 'BF053'
    OR `prefix` = 'BC055'
    OR `prefix` = 'BF055'
    OR `prefix` = 'BF056'
    OR `prefix` = 'BC056'
    OR `prefix` = 'BF057'
    OR `prefix` = 'BC157'
    OR `prefix` = 'BF058'
    OR `prefix` = 'BC058'
    OR `prefix` = 'BC059'
    OR `prefix` = 'BF059'
    OR `prefix` = 'BC060'
    OR `prefix` = 'BF060'
    OR `prefix` = 'BC061'
    OR `prefix` = 'BF062'
    OR `prefix` = 'BC063'
    OR `prefix` = 'BF064'
    OR `prefix` = 'BF065'
    OR `prefix` = 'BC067'
    OR `prefix` = 'BF067'
    OR `prefix` = 'BC068'
    OR `prefix` = 'BC069'
    OR `prefix` = 'BC070'
    OR `prefix` = 'BC071'
    OR `prefix` = 'BC072'
    OR `prefix` = 'BF073'
    OR `prefix` = 'BC074'
    OR `prefix` = 'BF075'
    OR `prefix` = 'BF076'
    OR `prefix` = 'BC077'
    OR `prefix` = 'BC078'
    OR `prefix` = 'BC079'
    OR `prefix` = 'BC080'
    OR `prefix` = 'BC081'
    OR `prefix` = 'BC082'
    OR `prefix` = 'BF083'
    OR `prefix` = 'BF084'
    OR `prefix` = 'BC085'
    OR `prefix` = 'BF105'
    OR `prefix` = 'BC116'
    OR `prefix` = 'BF121'
    OR `prefix` = 'BC148'
    OR `prefix` = 'BF154'
    OR `prefix` = 'BF166'
    OR `prefix` = 'BC226'
    OR `prefix` = 'BF282'
    OR `prefix` = 'BF281'
    OR `prefix` = 'BC311'
    OR `prefix` = 'BC317'
    OR `prefix` = 'BC318'
    OR `prefix` = 'BC356'
    OR `prefix` = 'BC357'
    OR `prefix` = 'BC363'
    OR `prefix` = 'BF363'
    OR `prefix` = 'BC364'
    OR `prefix` = 'BC365'
    OR `prefix` = 'BC371'
    OR `prefix` = 'BC372'
    OR `prefix` = 'BF373'
    OR `prefix` = 'BC374'
    OR `prefix` = 'BF374'
    OR `prefix` = 'BF375'
    OR `prefix` = 'BF381'
    OR `prefix` = 'BF382'
    OR `prefix` = 'BC385'
    OR `prefix` = 'BC386'
    OR `prefix` = 'BC401'
    OR `prefix` = 'BC433'
    OR `prefix` = 'BC434'
    OR `prefix` = 'BC435'
    OR `prefix` = 'BC436'
    OR `prefix` = 'BC440'
    OR `prefix` = 'BC448'
    OR `prefix` = 'BC645'
    OR `prefix` = 'BC637'
    OR `prefix` = 'BC638'
    OR `prefix` = 'BC639'
    OR `prefix` = 'BC717'
    OR `prefix` = 'BC718'
    OR `prefix` = 'BC742'
    OR `prefix` = 'BF742'
    OR `prefix` = 'BC802'
    OR `prefix` = 'BC803'
    OR `prefix` = 'BC813'
    OR `prefix` = 'BC954'
    OR `prefix` = 'BF973'
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>id</td>
    <td>prefix</td>
    <td>middle</td>
    <td>suffix</td>
    <td>name</td>
    <td>stocktype</td>
    <td>unitofmeasure</td>
    <td>stock</td>
    <td>imageloc</td>
    <td>price</td>
    <td>rate</td>
    <td>purchaseprice</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['prefix']; ?></td>
      <td><?php echo $row_Recordset1['middle']; ?></td>
      <td><?php echo $row_Recordset1['suffix']; ?></td>
      <td><?php echo $row_Recordset1['name']; ?></td>
      <td><?php echo $row_Recordset1['stocktype']; ?></td>
      <td><?php echo $row_Recordset1['unitofmeasure']; ?></td>
      <td><?php echo $row_Recordset1['stock']; ?></td>
      <td><?php echo $row_Recordset1['imageloc']; ?></td>
      <td><?php echo $row_Recordset1['price']; ?></td>
      <td><?php echo $row_Recordset1['rate']; ?></td>
      <td><?php echo $row_Recordset1['purchaseprice']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
