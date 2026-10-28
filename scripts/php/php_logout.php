<?php
if (!isset($_SESSION)) {
  session_start();
}
 unset($_SESSION['MM_Username']);
 unset($_SESSION['MMUserid']);
 unset($_SESSION['MM_showexe']);
 header( 'Location: https://www.vigorgems.com/index.php' ) ;
?>