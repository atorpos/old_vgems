<?php require_once('../Connections/message.php'); ?>
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

mysql_select_db($database_message, $message);
$query_Messagesystem = "SELECT * FROM fromweb ORDER BY id DESC";
$Messagesystem = mysql_query($query_Messagesystem, $message) or die(mysql_error());
$row_Messagesystem = mysql_fetch_assoc($Messagesystem);
$totalRows_Messagesystem = mysql_num_rows($Messagesystem);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>id</td>
    <td>email</td>
    <td>time</td>
    <td>title</td>
    <td>contents</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Messagesystem['id']; ?></td>
      <td><?php echo $row_Messagesystem['email']; ?></td>
      <td><?php echo $row_Messagesystem['time']; ?></td>
      <td><?php echo $row_Messagesystem['title']; ?></td>
      <td><?php echo $row_Messagesystem['contents']; ?></td>
    </tr>
    <?php } while ($row_Messagesystem = mysql_fetch_assoc($Messagesystem)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Messagesystem);
?>
