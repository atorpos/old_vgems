<?php require_once('../Connections/Altawoz.php'); ?>
<?php header('content-type: application/json; charset=utf-8');?>
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

mysql_select_db($database_Altawoz, $Altawoz);
$query_Indextable = "SELECT DISTINCT stocksymble FROM stockDB ORDER BY id DESC";
$Indextable = mysql_query($query_Indextable, $Altawoz) or die(mysql_error());
$row_Indextable = mysql_fetch_assoc($Indextable);
$totalRows_Indextable = mysql_num_rows($Indextable);
class Item {
	public $stockID = "";
	public $lastdate = "";
	public $settarget = "";
	public $bailor = "";
}
$items = new Item();
do { 
	$row_Indextable['stocksymble']; 
	$stockitem = $row_Indextable['stocksymble'];
	$items->stockID[] = utf8_encode($stockitem);
	$colname_details = "-1";
	if (isset($row_Indextable['stocksymble'])) {
 	 	$colname_details = $row_Indextable['stocksymble'];
	}
	$query_details = sprintf("SELECT * FROM stockDB WHERE stocksymble = %s ORDER BY id DESC ", GetSQLValueString($colname_details, "text"));
	$details = mysql_query($query_details, $Altawoz) or die(mysql_error());
	$row_details = mysql_fetch_assoc($details);
	$totalRows_details = mysql_num_rows($details);
	
	$recorddate = $row_details['year']. "-".$row_details['month']. "-" .$row_details['day'];
	$items->lastdate[] = utf8_encode($recorddate);
	$targetsetted = $row_details['yeartarget'];
	$items->settarget[] = utf8_encode($targetsetted);
	$porne = floatval($row_details['yeartarget']) - floatval($row_details['lastprice']) ;
	if ($porne > 0) {
		$isbail = 0;
	} else if ($porne = 0) {
		$isbail = 1;
	} else {
		$isbail = 2;
	}
	$items->bailor[] = utf8_encode($isbail);
	} while ($row_Indextable = mysql_fetch_assoc($Indextable));
	echo json_encode($items);
mysql_free_result($Indextable);

mysql_free_result($details);
?>
