<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	require_once('wp-load.php');
	require_once('wp-includes/user.php');
	require_once('wp-includes/pluggable.php');
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];
	$accessloc = $_POST['orgloc'];

	//echo $username. ' ';
	//echo wp_hash_password($passwd);

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

	$creds = array();
	$creds['user_login'] = $username;
	$creds['user_password'] = $passwd;
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	if ( is_wp_error($user) ) {
		echo $user->get_error_message();
	} else {
		header('Content-type: application/json; charset=utf-8');
		require_once '../Connections/VGshop.php';
		mysql_select_db($database_shopSQL, $shopSQL);
		$query_Record = sprintf("SELECT * FROM np_users WHERE user_login=%s", GetSQLValueString($username, "text"));

		$Recordset = mysql_query($query_Record, $shopSQL) or die(mysql_error());
		$totalRow_Recordset = mysql_num_rows($Recordset);
		class Item {
			public $Regusername = "";
			public $Regemail = "";
			public $RegUrl = "";
			public $RegID = "";
			public $Regfirst = "";
			public $Reglast = "";
			public $Regstripe = "";
			public $logresponse = "";
		}
		$items = new Item();
		if($totalRow_Recordset) {
			$row_recordset = mysql_fetch_assoc($Recordset);
			$loginStdisplay_name = mysql_result($Recordset, 0,'display_name');
			$loginStemail = mysql_result($Recordset, 0, 'user_email');
			$loginSturl = mysql_result($Recordset, 0, 'user_url');
			$loginStID = mysql_result($Recordset, 0, 'ID');
			$query_Recordmeta = sprintf("SELECT * FROM np_usermeta WHERE user_id=%s", GetSQLValueString($loginStID, "int"));
			$Recordsetmeta = mysql_query($query_Recordmeta, $shopSQL) or die(mysql_error());
			$totalRow_Recordsetmeta = mysql_num_rows($Recordsetmeta);
			$row_Recordsetmeta = mysql_fetch_assoc($Recordsetmeta);
			if($totalRow_Recordsetmeta) {
				do {
					switch($row_Recordsetmeta['meta_key']) {
						case "first_name":
						$items->Regfirst[] = utf8_encode($row_Recordsetmeta['meta_value']);
						break;
						case "last_name":
						$items->Reglast[] = utf8_encode($row_Recordsetmeta['meta_value']);
						break;
						case "_stripe_customer_id":
						$items->Regstripe[] = utf8_encode($row_Recordsetmeta['meta_value']);
						break;
					}
				}while ($row_Recordsetmeta = mysql_fetch_assoc($Recordsetmeta));
				mysql_free_result($Recordsetmeta);
			}



		}
		$items->Regusername = utf8_encode($loginStdisplay_name);
		$items->Regemail = utf8_encode($loginStemail);
		$items->RegUrl[] = utf8_encode($loginSturl);
		$items->RegID = utf8_encode($loginStID);
		$items->logresponse = "1";

		$_SESSION['MM_Username'] = $username;
		$_SESSION['MM_UserGroup'] = "";
		$_SESSION['MM_Userid'] = $loginStID;
		$_SESSION['MM_showexe'] = 1;

		if ($accessloc == "https://www.vigorgems.com/signin.php") {
			header('Location: https://www.vigorgems.com/');
		} else {
			echo json_encode($items);
		}
		mysql_free_result($Recordset);
	}

?>