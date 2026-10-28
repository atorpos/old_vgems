<?php
mysql_connect("server00.vigorgems.info","vigorDB","Simeon1st");
mysql_select_db("vigorDB") or die("Unable to select database");
 
$size = count($_POST['voffid']);
$backpage = $_POST['currentpage']; 
echo $backpage;
$i = 0;
while ($i < $size) {
	$quantity= $_POST['quantity'][$i];
	$comments = $_POST['comments'][$i];
	$id = $_POST['voffid'][$i];
 
	$query = "UPDATE offeritems SET quantity='$quantity', comments='$comments'  WHERE voffid='$id'";
	mysql_query($query) or die ("Error in query: $query");
	echo "$address<br /><br /><em>Updated!</em><br /><br />";
	$i++;
}
header("Location:https://www.vigorgems.com/crm/gofit.php?tovof=$backpage");
?>