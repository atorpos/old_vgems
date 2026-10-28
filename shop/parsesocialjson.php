<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
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
  		}
  		return $theValue;
	}
	}
	mysql_select_db($database_shopSQL, $shopSQL);
	$query_Record = sprintf("SELECT * FROM social_endpoint ORDER BY id DESC LIMIT 3");
	//echo $query_Record;
	$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
	$row_recordset = mysql_fetch_assoc($Recordset);
	$totalRow_Recordset = mysql_num_rows($Recordset);
	//echo $totalRow_Recordset;

	class Item {
		public $soc_type = "";
		public $soc_imgurl = "";
		public $soc_url="";
		public $soc_imgtype = "";
		public $soc_desc = "";
	}
	$items = new Item();
	do {
		$items->soc_type[] = utf8_encode($row_recordset['type']);
		$items->soc_url[] = utf8_encode($row_recordset['url']);	
		$items->soc_imgurl[] = utf8_encode($row_recordset['imgurl']);
		$items->soc_imgtype[] = utf8_encode($row_recordset['imgtype']);
		$items->soc_desc[] = utf8_encode($row_recordset['description']);

	} while ($row_recordset = mysql_fetch_assoc($Recordset));
	echo json_encode($items);
	mysql_free_result($Recordset);

?>