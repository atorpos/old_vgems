<?php
class Cart
{
	/*adding to cart*/
	function add_item($sid, $id, $qty,$cry)
	{
		$query="Select * from stock where id='$id'";
		$result=mysql_query($query);
		$stock=mysql_fetch_object($result);
		switch ($cry) {
		 case NULL :
		 		$price = $stock->price *1.20;
				$cry = "USD";
				break;
		 case "USD" :
				$price = $stock->price *1.20;
				break;
		 case "CAD" :
		 		$price = $stock->price *1.18* 1.3;
				break;
		 case "HKD" :
		 		$price = $stock->price *1.18*7.8;
				break;
		 case "GBP" :
		 		$price = $stock->price *1.18*0.7;
				break;
		 case "EUR" :
		 		$price = $stock->price *1.18*0.8;
				break;
		 case "CNY" :
		 		$price = $stock->price *1.18*7;
				break;
		 case "JPY" :
		 		$price = $stock->price *1.18*110;
				break;
		}
		$query="Insert shopping (sid, name, price, qty, currency)
		values ('$sid', '$stock->id', '$price', '$qty', '$cry')";
		mysql_query($query);
	}
	
	/*view cart*/
	function get_cart($sid)
	{
		$query ="Select * from shopping where sid='$sid'";
		$result=mysql_query($query);
		return $result;
	}
	
	/*total*/
	function cart_total($sid)
	{
		
		$query="Select * from shopping where sid='$sid'";
		$result= mysql_query($query);
		$total=0;
		if(mysql_num_rows($result)>0)
		{
			while ($row=mysql_fetch_object($result))
			$total+=($row->price * $row->qty);
		}
		return $total;
	}
	
	/*change the order*/
	function qty_change($sid, $cid, $qty)
	{
		$query="Update shopping SET qty='$qty' where
				sid='$sid' and cid='$cid'";
		mysql_query($query);
	}
	
	/*delete item*/
	function del_item($sid, $cid)
	{
		$query="Delete from shopping where sid='$sid' and cid='$cid'";
		mysql_query($query);
	}
	
	/*clean cart*/
	function clear_cart($sid)
	{
		$query="Delete from shopping where sid='$sid'";
		mysql_query($query);
	}
}

?>