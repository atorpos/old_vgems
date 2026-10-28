<?php require_once('../Connections/external.php'); ?>
<?php require_once('../Connections/stockcode.php'); $pagename = "Ring Products";
$sidebarname = $pagename; $pagetype = "productsvisual";?>
<?php include('../header.php'); ?>
<div id="main" align="center">
<table width="999" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include('../scripts/php/php_product_ringstable.php');?></td>
    <td width="249" align="center" valign="top" bgcolor="#383838"><div id="righttitle"><img src="../images/bg_necklet_righttitle.png" /></div>
    <?php include('../sidepanel.php');?></td>
  </tr></table></div>
<?php include('--/footer.php'); ?>
</body>
</html>
