<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>Sample</title>
<link rel="stylesheet" href="../scripts/css/index.css" type="text/css" media="all">
<script type="text/javascript" src="../scripts/javascript/prototype.js"></script>
<script type="text/javascript"><!--
dragObj = new Object();
dragObj.dragFlag = false;	// 標示是否為拖曳狀態的旗標
dragObj.targetObj = null	// 作為拖曳對象的物件資訊
// 開始拖曳
dragObj.dragStart = function (event)
{
	dragObj.dragFlag = true;
	dragObj.targetObj = $("floatbox"); // 因為是範例，所以只指定特定物件
	dragObj.offsetX = mouseX - parseInt(dragObj.targetObj.style.left);
	dragObj.offsetY = mouseY - parseInt(dragObj.targetObj.style.top);
	return false;
}
dragObj.dragEnd = function()	// 結束拖曳

{
	dragObj.dragFlag = false;
}
dragObj.dragProc = function(event)	// 拖曳過程
{
	mouseX = Event.pointerX(event);
	mouseY = Event.pointerY(event);
	if (!dragObj.dragFlag) return;
	dragObj.targetObj.style.left = mouseX - dragObj.offsetX;
	dragObj.targetObj.style.top = mouseY - dragObj.offsetY;
	return false;
}
window.onload = function()	// 設定事件處理函式
{
	eleName = "floatbox";
	$(eleName).onmousedown = dragObj.dragStart;
	$(eleName).onmouseup = dragObj.dragEnd;
	$(eleName).style.left = "60px";
	$(eleName).style.top = "50px";
	Event.observe(window.document, "mousemove", dragObj.dragProc, false);
}
// --></script>
</head>
<body>
<h1>拖曳</h1>
<div id="floatbox">
這個方塊可以拖曳。
</div>
</body>
</html>

