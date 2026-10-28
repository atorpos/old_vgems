<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
	$postcat = $_POST['keyword'];
	$offsetvalue  = $postlast * 20;
	$itemcount =0;
	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each
	 * a unique prefix. Only numbers, letters, and underscores please!
	 */
	$table_prefix  = 'np_';
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
  			case "likec":
  				$theValue = ($theValue !="") ? "'%" .$theValue. "%'" : "NULL";
  			break;
  		}
  		return $theValue;
	}
	}
	function GetJSON($fncproductid) {
    	
	}
	mysql_select_db($database_shopSQL, $shopSQL);
	$query_Record = sprintf("SELECT * FROM np_terms WHERE name LIKE %s", GetSQLValueString($postcat, "likec"));
	//echo $query_Record;
	$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
	$row_recordset = mysql_fetch_assoc($Recordset);
	$totalRow_Recordset = mysql_num_rows($Recordset);
	//echo $totalRow_Recordset;
	
	class Item {
		public $keywordname = "";
		public $keywordslug = "";
		public $keyword_id = "";
	}
	$items = new Item();
	if ($totalRow_Recordset != 0) {
		do {
			$getkeyword = $row_recordset['name'];
			$items->keywordname[] = utf8_encode($getkeyword);
			$getslug = $row_recordset['slug'];
			$items->keywordslug[] = utf8_encode($getslug);
			$getid = $row_recordset['term_id'];
			$items->keyword_id[] = utf8_encode($getid);
			$itemcount ++;
		} while ($row_recordset = mysql_fetch_assoc($Recordset));
	}
	//echo $itemcount;
	if ($itemcount != 0) {
		echo json_encode($items);
	}else {
    	echo "no value";
	}

	mysql_free_result($Recordset);

?>