<?php require_once('../Connections/external.php'); ?>
<?php require_once('../Connections/stockcode.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$colname_ordersummery = "-1";
if (isset($_GET['invoiceid'])) {
  $colname_ordersummery = $_GET['invoiceid'];
}
mysql_select_db($database_external, $external);
$query_ordersummery = sprintf("SELECT * FROM webinvoice WHERE invoiceid = %s ORDER BY cid ASC", GetSQLValueString($colname_ordersummery, "int"));
$ordersummery = mysql_query($query_ordersummery, $external) or die(mysql_error());
$row_ordersummery = mysql_fetch_assoc($ordersummery);
$totalRows_ordersummery = mysql_num_rows($ordersummery);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>slips</title>
<link href="../scripts/css/slips.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header" align="center"><table><tr><td><img src="../images/bg_slip_logo.png" width="100" height="100" align="middle"/></td><td><div align="center"><span id="chinesename">樹材寶石</span><br />
          <span id="englishnamebig">VIGOR</span><span id="englishnamesmall"> GEMS &amp; JEWELLERY</span><br />
          <span id="address">Flat 24, 6/F, Block B, Focal Ind. Centre.<br />
          21 Man Lok Street, Hung Hom, Kowloon, Hong Kong<br />
          Tel No.:+852-23562083 &nbsp;Fax No.: +852-23059078<br />
          Web Site: http://www.vigorgems.com/ &nbsp;Email: vgrsales@vigorgems.com</span></div></td></tr></table>
</div>
<div id="maincontact">
	<table width="100%"><tr><td width="50%" valign="top">To:
	  <p>Address</p><p>Tel:</p></td><td width="50%" align="center"><font face="Arial, Helvetica, sans-serif" size="12"><B>INVOICE</B></font><table width="60%"><tr><td width="50%">P.I. No:</td><td width="50%"><?php echo $row_ordersummery['type']; echo $row_ordersummery['invoiceid'];?></td></tr><tr><td>DATE:</td><td><?php print(date("F dS, Y"));?></td></tr><tr><td>Customer Code:</td><td></td></tr><tr><td>Payment Term:</td><td></td></tr><tr><td>Salesman:</td><td></td></tr></table></td></tr></table>
</div>
<div id="mainitems">
	<table width="979px" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="47px"><div id="box" align="center">N/W</div></td><td width="145px"><div id="box" align="center">ITEM CODE</div></td><td width="469px"><div id="box" align="center">Stock Name and Description</div></td><td width="97px"><div id="box" align="center">Quantity</div></td><td width="96px"><div id="box" align="center">Unit Price</div></td><td width="99px"><div id="box" align="center">Amount</div></td></tr>
  <?php $ttp = 0; $i=1; $j=20; do { 
  	mysql_select_db($database_external, $external);
	$query_Recordset1 = sprintf("SELECT * FROM shopping WHERE cid = '%s'", $row_ordersummery['cid']);
	$Recordset1 = mysql_query($query_Recordset1, $external) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	
	mysql_select_db($database_external, $external);
	$query_coderetriver = sprintf("SELECT * FROM stock WHERE id = '%s'", $row_Recordset1['name']);
	$coderetriver = mysql_query($query_coderetriver, $external) or die(mysql_error());
	$row_coderetriver = mysql_fetch_assoc($coderetriver);
	$totalRows_coderetriver = mysql_num_rows($coderetriver);

	mysql_select_db($database_stockcode, $stockcode);
	$query_prefixretriver = sprintf("SELECT code, `description` FROM prefixcode WHERE code = '%s'", $row_coderetriver['prefix']);
	$prefixretriver = mysql_query($query_prefixretriver, $stockcode) or die(mysql_error());
	$row_prefixretriver = mysql_fetch_assoc($prefixretriver);
	$totalRows_prefixretriver = mysql_num_rows($prefixretriver);

	mysql_select_db($database_stockcode, $stockcode);
	$query_nameretriver = sprintf("SELECT name, `description` FROM stonename WHERE name = '%s'", $row_coderetriver['middle']);
	$nameretriver = mysql_query($query_nameretriver, $stockcode) or die(mysql_error());
	$row_nameretriver = mysql_fetch_assoc($nameretriver);
	$totalRows_nameretriver = mysql_num_rows($nameretriver);
  ?>
  <tr valign="top"><td ><div id="items"><?php echo $i; $i++; $j--;?></div></td><td ><div id="items"><?php echo $row_coderetriver['prefix']; ?><?php echo $row_coderetriver['middle']; ?>_<?php echo $row_coderetriver['suffix']; ?></div></td><td ><div id="items"><?php echo $row_coderetriver['suffix']; ?> mm <?php echo $row_prefixretriver['description']. " " .$row_nameretriver['description']; ?></div></td><td ><div id="items"><?php echo $row_Recordset1['qty'];?></div></td><td ><div id="items">USD <?php echo $row_Recordset1['price'];?></div></td><td ><div id="items">USD <?php $ttp = $ttp + $row_Recordset1['qty']* $row_Recordset1['price'];echo $ttp; ?></div></td></tr>
  <?php } while ($row_ordersummery = mysql_fetch_assoc($ordersummery)); ?>
  <?php do {  echo "<td width=\"50px\"><div id=\"items\"></div></td><td width=\"150\"><div id=\"items\"></div></td><td width=\"480\"><div id=\"items\"></div></td><td width=\"100\"><div id=\"items\"></div></td><td width=\"100\"><div id=\"items\"></div></td><td width=\"100\"><div id=\"items\"></div></td></tr>";$j--;} while ($j >0); ?>
  <tr><td width="50px"><div id="bottom"></div></td><td width="150"><div id="bottom"></div></td><td width="480"><div id="bottom"></div></td><td width="100"><div id="bottom"></div></td><td width="100"><div id="bottom"></div></td><td width="100"><div id="bottom"></div></td></tr>
  <!--<tr><td width="50px">N/W</td><td width="150">ITEM CODE</td><td width="480">Stock Name and Description</td><td width="100">Quantity</td><td width="100">Unit Price</td><td width="100">Amount</td></tr>--></table>
</div>
<div id="summary">
	<table width="100%" cellpadding="0" cellspacing="0">
    	<tr id="remark">
       	  <td width="60%" valign="top">REMARKS:<p>All price are subjected to USD.</p></td>
        	<td width="40%" align="right">
            	<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" id="total">
<tr>
                    	<td width="40%" align="right">TOTAL<br />EX-FACTORY<br />PRICE:</td>
                        <td>USD <? echo $ttp; ?></td>
                  </tr>
                    <tr>
                    	<td align="right">DELIVERY METHOD:</td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td align="right">SHIPPING COST:</td>
                        <td>USD: 0.00</td>
                    </tr>
                    <tr>
                    	<td align="right">TOTAL<br />BALANCE:</td>
                        <td>USD <? echo $ttp; ?></td>
                    </tr>
                    
                </table>
          </td>
        </tr>
  </table>
</div>          
</body>
</html>
<?
mysql_free_result($ordersummery);
?>
<?php
mysql_free_result($coderetriver);

mysql_free_result($prefixretriver);

mysql_free_result($nameretriver);

mysql_free_result($Recordset1);
?>