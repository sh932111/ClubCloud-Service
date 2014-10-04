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
</head>
<body onload="init()">
	<input type="button" value="普通訊息" onclick="MsgPush()" />
	<input type="button" value="緊急事件" onclick="EmergencyPush()" /><br />
</body>
<script src="js/classchoose.js"></script>
</html>