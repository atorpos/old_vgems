<?php
	session_start();
	//require sql connection
	require_once($_SERVER["DOCUMENT_ROOT"] ."/Connections/stockcode.php");
	//call getsql value string function
	include($_SERVER["DOCUMENT_ROOT"] ."/scripts/lib/getsqlvaluestring.php");
	//set url call 
	$colname_prefixname = "-1";
	if(isset($_GET['code'])) {
	$colname_prefixname = $_GET['code'];
	}
	if($colname_prefixname!= NULL){
		//do if codename in url format is excessed
		$query_prefixname = sprintf("SELECT code, `description` FROM prefixcode WHERE code =%s", GetSQLValueString($colname_prefixname, "text"));
		$prefixname = mysql_query($query_prefixname, $stockcode) or die(mysql_error());
	$row_prefixname = mysql_fetch_assoc($prefixname);
	$totalRows_prefixname = mysql_num_rows($prefixname);
		
		if ($totalRows_prefixname > 0) {
		$productcode = $colname_prefixname; //specify prefixcode
		$productimagedec = "/images/products/".$productcode. "/"; //specify the destination of image files
		$productjson = "/scripts/lib/json_class_specify.php?code=".$productcode; //specify the json list
		} else {
			//if no codename in database
		header("Location: index.php");
		}
	
	} else {
		//if no codename in url format, go back to index.
		header("Location: index.php");
	}
	//name the page name and product name
	$pagename = $row_prefixname['description'];
	$productname = $pagename;
?>