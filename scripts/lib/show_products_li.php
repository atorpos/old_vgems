<?php
	require_once($_SERVER["DOCUMENT_ROOT"]. '/Connections/OfficeSQL.php');
	require_once($_SERVER["DOCUMENT_ROOT"]. '/Connections/stockcode.php');
	$colname_location = $_COOKIE["location"];
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

if ($_GET["code"] != NULL) {
	$colname_code = $_GET["code"];
	mysql_select_db($database_OfficeSQL, $OfficeSQL);
	$query_Recordset1 = sprintf("SELECT * FROM ProductsDB WHERE `locations` =%s AND `CODE` =%sORDER BY  `CODE` ASC", GetSQLValueString($colname_location, "text"), GetSQLValueString($colname_code, "text"));
	$Recordset1 = mysql_query($query_Recordset1, $OfficeSQL) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	
	$getprefixcode = "0";
	$i = 0;
	if ($totalRows_Recordset1 == 0) {
		header('Location:http://www.vigorgems.com/');
	} else {
		echo "<ul class=\"thumbs noscript\">";
		do {
			$stonecode = $row_Recordset1['STONE'];
			include($_SERVER["DOCUMENT_ROOT"] . "/scripts/lib/stoneswitch.php");
			$packageprice = sprintf('%0.2f',($row_Recordset1['PRICE']* $row_Recordset1['quantprepackage']*0.9));
			$jpgname = '../images/products/' .$colname_code.'/'.$stonecode.'.jpg';
			if (file_exists($jpgname)){
				echo "<li><a class=\"thumb\" name=\"leaf\" href=\"/images/products/".$colname_code."/" .$stonecode. ".jpg\" title=\"" .$row_Recordset1['SKU']. "\"><img src=\"/images/products/" .$colname_code."/" .$stonecode. ".png\" alt=\"".$row_Recordset1['SKU'] .$row_Recordset1['CODE']. "\" /></a>";
			} else {
				echo "<li><a class=\"thumb\" name=\"leaf\" href=\"/images/products/imagenotavailable.jpg\" title=\"" .$row_Recordset1['SKU']. "\"><img src=\"/images/products/imnv.png\" alt=\"".$row_Recordset1['SKU'] .$row_Recordset1['CODE']. "\" /></a>";
			}
			echo '<div class="captionside"><h2>'.$productname. ' ';
			echo $stonedesc. ' - ' .$row_Recordset1['quantprepackage']. ' Pieces Pack</h2>';
			if ($row_Recordset1['STOCK'] > 10) {
				echo '<p><span class="listprice">$'.$packageprice. ' </span> <button  class="addbutton" type="button"><span class="buttoninfo">Add to Cart</span></button><h2>Stock Status:</h2><span class="detailstatus">In Stock</span>
						</p><p><a href="index~.php">View more items</a></p></div>';
			} elseif($row_Recordset1['STOCK'] >= 2) {
				echo  '<p><span class="listprice">$'.$packageprice. ' </span> <button  class="addbutton" type="button"><span class="buttoninfo">Add to Cart</span></button><h2>Stock Status:</h2><span class="detailstatus">'.$row_Recordset1['STOCK']. ' packs left in stock</span>
						</p><p><a href="index~.php">View more items</a></p></div>';
			}else {
				echo 'Out of Stock, order items will take 4 weeks.</span><p><span class="listprice">$'.$packageprice. ' </span> <button  class="addbutton" type="button"><span class="buttoninfo">Order Now!</span></button>
						</p><p><a href="index~.php">View more items</a></p></div>';
			}
			echo '<div class="caption">';
			echo '<div class="image-title">'.$row_Recordset1['quantprepackage']. ' PCS pack of '.$productname.' '. $stonedesc. '</div>
								<div class="image-desc"><strong >Details</strong>
									<ul>
										<li><div class="detcola">Stone</div><div class="detcolb">'. $stonedesc. '</div></li>
										<li><div class="detcola">Bracelet Type</div><div class="detcolb">Stretch</div></li>
										<li><div class="detcola">Length</div><div class="detcolb">inner wrist 19cm; </div></li>
										<li><div class="detcola">Beads Size</div><div class="detcolb">' .$row_Recordset1['SIZE']. ' mm</div></li>
										<li><div class="detcola">Additional Info.</div><div class="detcolb">SKU:' .$row_Recordset1['SKU']. '</div></li>
									</ul>
								</div>';

			echo '</div>';
			echo "</li>";
		} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
		echo "</ul>";
	}
} else {
}

mysql_free_result($Recordset1);
?>