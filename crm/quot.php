<?php require_once('../Connections/OfficeSQL.php'); ?>
<?php require_once('../Connections/SecOfSQL.php'); ?>
<?php
$pagename = "View Offers items";
$pagetype = "promotional";
$purpose = "crm";
$filename = "https://www.vigorgems.com/crm/gofit.php";
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
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
if (isset($_GET['tovof'])) {
  $colname_PreviousOrder = $_GET['tovof'];
  $colname_PreviousOrderh = hexdec($colname_PreviousOrder);
  $colname_PreviousOrder = round($colname_PreviousOrderh/257);
}
mysql_select_db($database_OfficeSQL, $OfficeSQL);
$query_PreviousOrder = sprintf("SELECT * FROM offeritems WHERE tovof = %s ORDER BY voffid ASC", GetSQLValueString($colname_PreviousOrder, "int"));
$PreviousOrder = mysql_query($query_PreviousOrder, $OfficeSQL) or die(mysql_error());
$row_PreviousOrder = mysql_fetch_assoc($PreviousOrder);
$totalRows_PreviousOrder = mysql_num_rows($PreviousOrder);

mysql_select_db($database_SecOfSQL, $SecOfSQL);
$query_openorder = sprintf("SELECT * FROM offerorder WHERE viewofferid = %s ORDER BY offertoid DESC", GetSQLValueString($colname_PreviousOrder, "int"));
$openorder = mysql_query($query_openorder, $SecOfSQL) or die(mysql_error());
$row_openorder = mysql_fetch_assoc($openorder);
$totalRows_openorder = mysql_num_rows($openorder);
$colname_PreviousOrder = "-1";


?>
<?php include('../header.php'); ?>
<div id="main">
<div id="crm_bigtitle"><div id="beta"></div></div>
<div id="crm_content">
	<div class="crm_brick">
 	<div class="navbar">VIEW OFFER QU<?php 
	 		echo str_pad($row_openorder['viewofferid'], 6 ,"0", STR_PAD_LEFT);
	 	?>  ITEMS
	</div>

<form method="post" name="form_update" action="update.php">
<table border="1">
  <tr>
    <td width="10%">Item photo</td>
    <td width="5%">Product ID.</td>
    <td width="15%">Product Name</td>
    <td width="8%">Stone Type</td>
    <td width="5%">Size</td>
    <td width="12%">Offer Price</td>
    <td width="10%">Reference delivery date</td>
    <td width="10%">Inquiry quanity</td>
    <td>Comments</td>
  </tr>
  <?php 
   $i = 0;
   $j = 0;
   class Item {
   	   public $orderid = "";
	   public $itemid = "";
	   public $itemname = "";
	   
	   
   }
   $items = new Item();
   
  do { 
    ?>
  	<?php
  		$id[] = $row_PreviousOrder['voffid'];
  		$date = strtotime("+29 day", time()); 
  		$theorderid = $row_PreviousOrder['orderitemid'];
  		$items->orderid[] = $theorderid;
		$thesku = $row_PreviousOrder['sku'];
		$items->itemid[] = $thesku;
		$theprice = number_format ($row_PreviousOrder['price'],2);
		$thequantity = $row_PreviousOrder['quantity'];
		$subtotal = $theprice*$thequantity;
		$j = $j+$thequantity;
   	do { 
		$thepartid = $row_PreviousOrder['productcode'];
		$thedescription =  $row_PreviousOrder['description'];
		$thestonetype = $row_PreviousOrder['stone'];
		$thesize = $row_PreviousOrder['size'];
		$theunit = $row_PreviousOrder['unit'];
		$thecommnet = $row_PreviousOrder['comments'];
		$items->itemname[] = $thedescription;
		
		$i++;
		echo "<input type=\"hidden\" name=\"currentpage\" value =\"". $_GET['tovof']. "\">";
		echo "<input type=\"hidden\" name=\"voffid[$i]\" value=\"" .$row_PreviousOrder['voffid']. "\">";
		$imagefile = 'http://40af8d963e39c6d7dafd-1483642509b9ae1e4ba0c984bc0efda5.r29.cf1.rackcdn.com/' .strtolower($row_PreviousOrder['productcode']).strtolower($thestonetype). '.jpg';
			echo "<tr><td><a class=\"single_image\" href=\"" .$imagefile. "\" /><img src=\"".$imagefile."\" alt=\"". $row_PreviousOrder['description']. " bracelet\" height=\"110px\" weight=\"110px\"/></a></td><td>".$thepartid."</td><td>".$thedescription."</td><td>".$thestonetype. "</td><td>".$thesize."</td><td>USD ".$theprice." per ".$theunit."</td><td>". date('M d, Y', $date) ."</td><td><input type=\"text\" id=\"quantity\" name=\"quantity[$i]\" size=\"8\" value=\"". $row_PreviousOrder['quantity'] ."\"></td><td><textarea id=\"comments\" name =\"comments[$i]\" cols=\"25\" rows\"3\">" .$row_PreviousOrder['comments']."</textarea></td></tr>";
		} while ($row_getitemdetail = mysql_fetch_assoc($getitemdetail));
		/*print json_encode($row);*/
		
	?>
    <?php json_encode($items);} while ($row_PreviousOrder = mysql_fetch_assoc($PreviousOrder)); 
	?>
</table>
<input type="submit" value="Save offer" value="Submit">
</form>
<ul>
<li><strong>Stone A</strong><br>Fancy Agate, Lavender Agate, Amazonite, Red Aventurine, Green Aventurine, Calcite, Carnelian, White Howlite, Fluorite, Serpentine, Lemon New Quartz, Black Labradourite, Dumortierite, Snow Flake, Artistic Jasper, Breciated Jasper, Black Line Jasper, Dalmatine Jasper, Leopard Skin, Ocean Jasper, Crocodile Jasper, Picasson Jasper, Peach Stone, Picture Jasper, Red Jasper. Zebra Jasper, Chinese Yellow Turquoise, Rose Quartz, White Quartz, Studded Star, Unakite, Brazil Sodalite, Moss Agate, Botswana Agate</li>
<li><strong>Stone B</strong><br>Multi Color Stone, Red Agate, Rock Crystal, Crack Crystal, Rainbow Fluorite, Tiger Eye, Red Tiger Eye, Mookaite, Labradourite, Smoky Quartz, Rhodonite, Black Rutilated quartz, Sodalite</li>
<li><strong>Stone C</strong><br>Amethyst</li>
<li><strong>For More information of our stone</strong><br>Go to our stonelist website in <a href="http://www.vigorgems.com/stonelist.php">here</a></li>
</ul>
</div>
</div></div>
<div id="events_bottom"></div>
</div>
<?php include('../int_footer.php'); ?>
</body>
</html>
