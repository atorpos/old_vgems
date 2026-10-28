<?php 
if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE) 
{ header('Location: http://www.vigorgems.com/mobvigor/'); } 
/*else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
{ header('Location: http://www.vigorgems.com/');}*/
?>