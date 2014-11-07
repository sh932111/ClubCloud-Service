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
<link rel="stylesheet" href="css/emergency.css">
</head>
<body onload="init()">
	<div id="main">
		<p><div id="user"></div></p>
		<p><div id="city"></div></p>
		<p><div id="date"></div></p>
		<p>標題：</p>
		<p><input type="text" name="title" size="20" id="title" value="地震" class="registerInput"/></p>
		<p>訊息：</p>
		<p><textarea size="20" id="detail" name="detail"  value="地震發生" class="textareaInput"></textarea></p>
		<p><input type="button" value="傳送事件" onclick="EmergencyPush()"  class="EmergencyPushBt"/></p>
	</div>
</body>
<script src="js/emergency.js"></script>
<script src="../lib/js/get_data.js"></script>
</html>