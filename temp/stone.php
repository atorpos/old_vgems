<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="../scripts/javascript/xpath.js" type="text/javascript"></script>
<script src="../scripts/javascript/SpryData.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
var ds1 = new Spry.Data.XMLDataSet("../scripts/xml/stone.xml", "stones/stone", {distinctOnLoad: true});
//-->
</script>
</head>

<body>
<div spry:region="ds1">
  <table>
    <tr>
      <th spry:sort="name">Name</th>
      <th spry:sort="description">Description</th>
      <th spry:sort="image">Image</th>
    </tr>
    <tr spry:repeat="ds1">
      <td>{name}</td>
      <td>{description}</td>
      <td><img src="{image}" /></td>
    </tr>
  </table>
</div>
</body>
</html>