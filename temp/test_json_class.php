<?php 
	header('Content-Type: application/json');
	require_once('../Connections/OfficeSQL.php');
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
class ArrayValue implements JsonSerializable {
    public function __construct(array $array) {
        $this->array = $array;
    }

    public function jsonSerialize() {
        return $this->array;
    }
}

mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_Recordset1 = "SELECT * FROM monthlyspecial";
$Recordset1 = mysql_query($query_Recordset1, $OfficeSQL) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_stockcode, $stockcode);

$i = 0;
//$array = ['bracelet'];
//$array = ['Type'=>'bracelet', 'code'=>'0'];
//echo '{"bracelet":' ."\n[";
do {
	$colname_prefixname = "-1";
	$colname_prefixname = $row_Recordset1['code'];
	
	$query_prefixname = sprintf("SELECT code, `description` FROM prefixcode WHERE code =%s", GetSQLValueString($colname_prefixname, "text"));
	$prefixname = mysql_query($query_prefixname, $stockcode) or die(mysql_error());
	$row_prefixname = mysql_fetch_assoc($prefixname);
	$totalRows_prefixname = mysql_num_rows($prefixname);
		if($i ==0){
			$items = array("bracelets"=>array(['code' => $row_Recordset1['code'], 'name' =>$row_prefixname['description'], 'regprice'=>$row_Recordset1['regprice'], 'price'=>$row_Recordset1['price'], 'imgurl'=>$row_Recordset1['imgurl'],'size'=>$row_Recordset1['size'],'description'=>$row_Recordset1['description'],'stock'=>$row_Recordset1['stock'],'availablestone'=>$row_Recordset1['availablestone']]));
			$i++;
		} else {
			array_push($items[bracelets], ['code' => $row_Recordset1['code'], 'name' =>$row_prefixname['description'], 'regprice'=>$row_Recordset1['regprice'], 'price'=>$row_Recordset1['price'], 'imgurl'=>$row_Recordset1['imgurl'],'size'=>$row_Recordset1['size'],'description'=>$row_Recordset1['description'],'stock'=>$row_Recordset1['stock'],'availablestone'=>$row_Recordset1['availablestone']]);
			$i++;
		}
		//array_push($array, ['SKU' => $row_Recordset1['id'], 'code'=> $row_Recordset1['code'], 'description'=>$row_Recordset1['description'], 'type'=>$row_Recordset1['type'], 'spec'=>$row_Recordset1['specification']]);
		
	 //echo '{"SKU":"' .$row_Recordset1['id'].'",'."\n";
	 //echo ' "code":"'.$row_Recordset1['code'].'",'."\n";
	 //echo ' "description":"' .$row_Recordset1['description'].'",'."\n";
	 //echo ' "type":"' .$row_Recordset1['type'].'",'."\n";
	 //echo ' "spec":"' .$row_Recordset1['specification'].'",'."\n";
	 //echo ' "active":"' .$row_Recordset1['active'].'",'."\n";
	 //echo ' "longdec":"' .$row_Recordset1['longdesc'].'",'."\n";
	 //echo ' "shipping":"' .$row_Recordset1['shipping'].'",'."\n";
	 //echo ' "exclusive":"' .$row_Recordset1['exclusive']."\"\n";
	 
	 //if ($totalRows_Recordset1 == $i){
	 //	echo '}' ."\n";
	 //} else {
	//	 echo '},' ."\n";
	 //}
	 
	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
//echo "]}";
mysql_free_result($Recordset1);
echo json_encode(new ArrayValue($items), JSON_PRETTY_PRINT);
// $array = ['foo' => 'bar', 'quux' => 'baz'];
?>



