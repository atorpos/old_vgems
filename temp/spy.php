<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="../scripts/javascript/xpath.js" type="text/javascript"></script>
<script src="../scripts/javascript/SpryData.js" type="text/javascript"></script>
<link href="../scripts/javascript/SpryMasterDetail.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
var ds1 = new Spry.Data.XMLDataSet("../scripts/xml/productlist.xml", "products/product", {sortOnLoad: "productid", sortOrderOnLoad: "descending"});
//-->
</script>
</head>

<body>
<div class="MasterDetail">
  <div spry:region="ds1" class="MasterContainer">
    <div class="MasterColumn" spry:repeat="ds1" spry:setrow="ds1" spry:hover="MasterColumnHover" spry:select="MasterColumnSelected">{productsearch}</div>
  </div>
  <div spry:detailregion="ds1" class="DetailContainer">
    <div class="DetailColumn"><a href="{productlink}">Link</a></div>
    <div class="DetailColumn">{productid}</div>
    <div class="DetailColumn">{productcode}</div>
    <div class="DetailColumn">{producttype}</div>
    <div class="DetailColumn">{productstonename}</div>
    <div class="DetailColumn">{productstocktype}</div>
    <div class="DetailColumn">{productstock}</div>
    <div class="DetailColumn">{productimage}</div>
    <div class="DetailColumn">{productprice}</div>
    <div class="DetailColumn">{productoutlet}</div>
  </div>
  <br style="clear:both" />
</div>
</body>
</html>