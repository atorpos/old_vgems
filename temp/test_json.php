<?php require_once('../Connections/stockcode.php');header('Content-Type: application/json');
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

mysql_select_db($database_stockcode, $stockcode);
$query_Recordset1 = "SELECT * FROM prefixcode";
$Recordset1 = mysql_query($query_Recordset1, $stockcode) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$i = 0;
echo '{"bracelet":' ."\n[";
do {
	 echo '{"SKU":"' .$row_Recordset1['id'].'",'."\n";
	 echo ' "code":"'.$row_Recordset1['code'].'",'."\n";
	 echo ' "description":"' .$row_Recordset1['description'].'",'."\n";
	 echo ' "type":"' .$row_Recordset1['type'].'",'."\n";
	 echo ' "spec":"' .$row_Recordset1['specification'].'",'."\n";
	 echo ' "active":"' .$row_Recordset1['active'].'",'."\n";
	 echo ' "longdec":"' .$row_Recordset1['longdesc'].'",'."\n";
	 echo ' "shipping":"' .$row_Recordset1['shipping'].'",'."\n";
	 echo ' "exclusive":"' .$row_Recordset1['exclusive']."\"\n";
	 $i++;
	 if ($totalRows_Recordset1 == $i){
	 	echo '}' ."\n";
	 } else {
		 echo '},' ."\n";
	 }
	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
echo "]}";
mysql_free_result($Recordset1);
?>
