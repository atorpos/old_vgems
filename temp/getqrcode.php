<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/Miscsetting.php';
	$getrole = $_GET['rr'];
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
	}if ($getrole != "FFFFFFFFFFFFFF"){
	mysql_select_db($database_Miscsetting, $Miscsetting);
	$query_Recordset2 = "SELECT * FROM productinfo WHERE inactive = 0 ORDER BY pid DESC";
	$Recordset2 = mysql_query($query_Recordset2, $Miscsetting) or die(mysql_error());
	$row_Recordset2 = mysql_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	
	//set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = '../contents/QRCode/';
    
    include "../scripts/qrcode/qrlib.php";
    include ('../scripts/qrcode/qrconfig.php');
    
    $filename = $PNG_TEMP_DIR.'test.png';
    $finalfilename = $PNG_WEB_DIR.'final.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
      

    $matrixPointSize = 10;

	
	do {
		
	$realsku = $row_Recordset2['pid'];
	//add qrcode
	
	
	$filename = $PNG_WEB_DIR.'product'.md5($realsku).'.png';
        if(!file_exists($filename)){
        	QRcode::png($realsku, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
        } else {
	        echo 'QRCode has been created';
        }
           
	//finish qrcode

		
	} while($row_Recordset2= mysql_fetch_assoc($Recordset2));
	//echo json_encode($items);
	
	mysql_free_result($Recordset2);
	//mysql_free_result($Recordset3);
	} else {
		
	}
?>