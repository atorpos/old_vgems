<?php 
	header('Content-Type: application/json');
	require_once($_SERVER["DOCUMENT_ROOT"]. '/Connections/OfficeSQL.php');
	require_once($_SERVER["DOCUMENT_ROOT"]. '/Connections/stockcode.php');
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
$colname_location ="-1";
$colname_location = $_GET["location"];
$colname_code ="-1";

//$array = ['bracelet'];
//$array = ['Type'=>'bracelet', 'code'=>'0'];
//echo '{"bracelet":' ."\n[";

if ($_GET["code"] != NULL) {
	$colname_code = $_GET["code"];
	mysql_select_db($database_OfficeSQL, $OfficeSQL);
	$query_Recordset1 = sprintf("SELECT * FROM ProductsDB WHERE `locations` =%s AND `CODE` =%sORDER BY  `CODE` ASC", GetSQLValueString($colname_location, "text"), GetSQLValueString($colname_code, "text"));
	$Recordset1 = mysql_query($query_Recordset1, $OfficeSQL) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	
	mysql_select_db($database_stockcode, $stockcode);
	$getprefixcode = "0";
	$i = 0;
	if ($totalRows_Recordset1 == 0) {
		header('Location:http://www.vigorgems.com/');
	}else {
		do {	
			$colname_prefixname = "-1";
			$colname_prefixname = $row_Recordset1['CODE'];
			$packageprice = 0;
			$query_prefixname = sprintf("SELECT code, `description` FROM prefixcode WHERE code =%s", GetSQLValueString($colname_prefixname, "text"));
			$prefixname = mysql_query($query_prefixname, $stockcode) or die(mysql_error());
			$row_prefixname = mysql_fetch_assoc($prefixname);
			$totalRows_prefixname = mysql_num_rows($prefixname);
			$packageprice = sprintf('%0.2f',($row_Recordset1['PRICE']* $row_Recordset1['quantprepackage']*0.88));
			$averageprice = sprintf('%0.2f',($packageprice/$row_Recordset1['quantprepackage']));
			if($i ==0){
				$items = array("bracelets"=>array(['sku' =>$row_Recordset1['SKU'], 'code' => $row_Recordset1['CODE'], 'stone' =>$row_Recordset1['STONE'], 'name' =>$row_prefixname['description'], 'price'=>sprintf('%0.2f',$row_Recordset1['PRICE']) ,'size'=>$row_Recordset1['SIZE'],'quantityinpackage'=>$row_Recordset1['quantprepackage'], 'packageprice'=>$packageprice, 'averageprice'=>$averageprice, 'stock'=>$row_Recordset1['STOCK']]));
				$i++;
			} else {
				array_push($items[bracelets], ['sku' =>$row_Recordset1['SKU'], 'code' => $row_Recordset1['CODE'], 'stone' =>$row_Recordset1['STONE'], 'name' =>$row_prefixname['description'], 'price'=>sprintf('%0.2f',$row_Recordset1['PRICE']) ,'size'=>$row_Recordset1['SIZE'],'quantityinpackage'=>$row_Recordset1['quantprepackage'],'packageprice'=>$packageprice, 'averageprice'=>$averageprice, 'stock'=>$row_Recordset1['STOCK']]);
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
	}
//echo "]}";

} else {
	mysql_select_db($database_OfficeSQL, $OfficeSQL);
	$query_Recordset1 = sprintf("SELECT * FROM ProductsDB WHERE `locations` =%s ORDER BY  `CODE` ASC", GetSQLValueString($colname_location, "text"));
	$Recordset1 = mysql_query($query_Recordset1, $OfficeSQL) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	
	mysql_select_db($database_stockcode, $stockcode);
	$getprefixcode = "0";
	$i = 0;

	do {
		if ($getprefixcode == $row_Recordset1['CODE']) {
			echo "";
		} else {
			$getprefixcode = $row_Recordset1['CODE']; //get database prefix code and put it into the temp value
		
			$colname_prefixname = "-1";
			$colname_prefixname = $row_Recordset1['CODE'];
			$packageprice = 0;
			$query_prefixname = sprintf("SELECT code, `description` FROM prefixcode WHERE code =%s", GetSQLValueString($colname_prefixname, "text"));
			$prefixname = mysql_query($query_prefixname, $stockcode) or die(mysql_error());
			$row_prefixname = mysql_fetch_assoc($prefixname);
			$totalRows_prefixname = mysql_num_rows($prefixname);
			$packageprice = sprintf('%0.2f',($row_Recordset1['PRICE']* $row_Recordset1['quantprepackage']*0.88));
			$averageprice = sprintf('%0.2f',($packageprice/$row_Recordset1['quantprepackage']));
			if($i ==0){
				$items = array("bracelets"=>array(['sku' =>$row_Recordset1['SKU'], 'code' => $row_Recordset1['CODE'], 'stone' =>$row_Recordset1['STONE'], 'name' =>$row_prefixname['description'], 'price'=>sprintf('%0.2f',$row_Recordset1['PRICE']) ,'size'=>$row_Recordset1['SIZE'],'quantityinpackage'=>$row_Recordset1['quantprepackage'], 'packageprice'=>$packageprice, 'averageprice'=>$averageprice, 'stock'=>$row_Recordset1['STOCK']]));
				$i++;
			} else {
				array_push($items[bracelets], ['sku' =>$row_Recordset1['SKU'], 'code' => $row_Recordset1['CODE'], 'stone' =>$row_Recordset1['STONE'], 'name' =>$row_prefixname['description'], 'price'=>sprintf('%0.2f',$row_Recordset1['PRICE']) ,'size'=>$row_Recordset1['SIZE'],'quantityinpackage'=>$row_Recordset1['quantprepackage'],'packageprice'=>$packageprice, 'averageprice'=>$averageprice, 'stock'=>$row_Recordset1['STOCK']]);
				$i++;
			}
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

}
mysql_free_result($Recordset1);
echo json_encode(new ArrayValue($items), JSON_PRETTY_PRINT);
// $array = ['foo' => 'bar', 'quux' => 'baz'];
?>



