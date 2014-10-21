<!DOCTYPE html >

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">

var userName = "<?php echo $username; ?>";

</script>
<title>類型選擇</title>
<head>
	<link rel="stylesheet" href="css/class_style.css">
</head>
<body onload="init()">
	<div id="menu">
	<input type="button" value="普通訊息" onclick="MsgPush()" class="Selected" id="MsgPush" />
	<input type="button" value="緊急事件" onclick="EmergencyPush()"  class="noSelected" id="EmergencyPush" />
	</div>
	<div id="main">
		<iframe id="iframe" src="" scrolling="yes" frameborder="0">
		</iframe>
	</div>
</body>
<script src="js/classchoose.js"></script>
</html>