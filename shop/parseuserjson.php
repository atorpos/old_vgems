<?php
	header('Content-type: application/json; charset=utf-8');
	require_once '../Connections/VGshop.php';
	$postid = $_POST['postid'];
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
	$query_Record = sprintf("SELECT * FROM np_users WHERE user_login=%s", GetSQLValueString($postid, "text"));
	//echo $query_Record;
	$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
	$row_recordset = mysql_fetch_assoc($Recordset);
	$totalRow_Recordset = mysql_num_rows($Recordset);
	//echo $totalRow_Recordset;

	class Item {
		public $userid = "";
		public $username = "";
		public $useremail = "";
		public $nickname = "";
		public $first_name = "";
		public $last_name = "";
		public $billing_first_name = "";
		public $billing_last_name = "";
		public $billing_company = "";
		public $billing_address_1 = "";
		public $billing_address_2 = "";
		public $billing_city ="";
		public $billing_postcode ="";
		public $billing_country = "";
		public $billing_state = "";
		public $billing_phone = "";
		public $billing_email = "";
		public $shipping_first_name = "";
		public $shipping_last_name = "";
		public $shipping_company = "";
		public $shipping_address_1 = "";
		public $shipping_address_2 = "";
		public $shipping_city = "";
		public $shipping_postcode = "";
		public $shipping_country = "";
		public $shipping_state = "";
		public $tempcheck = "";
		
	}
	$items = new Item();
	$items->username[] = utf8_encode($postid);
	do {
		$items->useremail[] = utf8_encode($row_recordset['user_email']);
		$getid = $row_recordset['ID'];
		$items->userid[] = utf8_encode($getid);
		$query_posts = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s", GetSQLValueString($getid, "int"));
		$items->tempcheck[] = utf8_encode($query_posts);
		$postRecordset = mysql_query($query_posts, $shopSQL) or die(mysql_error());
		$row_posts = mysql_fetch_assoc($postRecordset);
		$totalRow_post = mysql_num_rows($postRecordset);
		do {
			switch ($row_posts['meta_key']) {
			case "nickname":
				$items->nickname[] = utf8_encode($row_posts['meta_value']);
				break;
			case "first_name":
				$items->first_name[] = utf8_encode($row_posts['meta_value']);
				break;
			case "last_name":
				$items->last_name[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_first_name":
				$items->billing_first_name[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_last_name":
				$items->billing_last_name[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_company":
				$items->billing_company[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_address_1":
				$items->billing_address_1[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_address_2":
				$items->billing_address_2[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_city":
				$items->billing_city[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_postcode":
				$items->billing_postcode[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_country":
				$items->billing_country[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_state":
				$items->billing_state[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_phone":
				$items->billing_phone[] = utf8_encode($row_posts['meta_value']);
				break;
			case "billing_email":
				$items->billing_email[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_first_name":
				$items->shipping_first_name[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_last_name":
				$items->shipping_last_name[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_company":
				$items->shipping_company[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_address_1":
				$items->shipping_address_1[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_address_2":
				$items->shipping_address_2[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_city":
				$items->shipping_city[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_postcode":
				$items->shipping_postcode[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_country":
				$items->shipping_country[] = utf8_encode($row_posts['meta_value']);
				break;
			case "shipping_state":
				$items->shipping_state[] = utf8_encode($row_posts['meta_value']);
				break;
		}
		}while ($row_posts = mysql_fetch_assoc($postRecordset));
		
	} while ($row_recordset = mysql_fetch_assoc($Recordset));
	if ($items->billing_first_name[0] == "") {
		$items->billing_first_name[] = "";
	}
	if ($items->billing_last_name[0] == "") {
		$items->billing_last_name[] = "";
	}
	if ($items->billing_company[0] == "") {
		$items->billing_company[] = "";
	}
	if ($items->billing_address_1[0] == "") {
		$items->billing_address_1[] = "";
	}
	if ($items->billing_address_2[0] == "") {
		$items->billing_address_2[] = "";
	}
	if ($items->billing_city[0] == "") {
		$items->billing_city[] = "";
	}
	if ($items->billing_postcode[0] == "") {
		$items->billing_postcode[] = "";
	}
	if ($items->billing_country[0] == "") {
		$items->billing_country[] = "";
	}
	if ($items->billing_state[0] == "") {
		$items->billing_state[] = "";
	}
	if ($items->billing_phone[0] == "") {
		$items->billing_phone[] = "";
	}
	if ($items->billing_email[0] == "") {
		$items->billing_email[] = "";
	}
	if ($items->shipping_first_name[0] == "") {
		$items->shipping_first_name[] = "";
	}
	if ($items->shipping_last_name[0] == "") {
		$items->shipping_last_name[] = "";
	}
	if ($items->shipping_company[0] == "") {
		$items->shipping_company[] = "";
	}
	if ($items->shipping_address_1[0] == "") {
		$items->shipping_address_1[] = "";
	}
	if ($items->shipping_address_2[0] == "") {
		$items->shipping_address_2[] = "";
	}
	if ($items->shipping_city[0] == "") {
		$items->shipping_city[] = "";
	}
	if ($items->shipping_postcode[0] == "") {
		$items->shipping_postcode[] = "";
	}
	if ($items->shipping_state[0] == "") {
		$items->shipping_state[] = "";
	}
	if ($items->shipping_country[0] == "") {
		$items->shipping_country[] = "";
	}
	echo json_encode($items);
	mysql_free_result($Recordset);

?>