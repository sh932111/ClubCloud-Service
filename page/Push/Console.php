<!DOCTYPE html >

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">

var userName = "<?echo $username ?>";

</script>

<title>發送訊息</title>
<head></head>
<body onload="init()">

	<p><div id="city"></div></p>
	<p><div id="city_detail"></div></p>

	<p>標題：<input type="text" name="title" size="20" id="title" /></p>
	<p>訊息：</p>
	<p><textarea size="20" id="detail" name="detail"></textarea></p>
	<p>日期：<input type="date" name="time" size="20" id="time" /></p>
	<p>時間：<input type="time" name="time_detail" size="20" id="time_detail" /></p>
	<!-- <select id="citylist" onChange="setValue(this);" >
		
	</select><br /><br />
	<select id="citydetaillist" onChange="getDetailValue(this);" >
		
	</select><br /><br /> -->

	<input name="Submit1" type="submit" value="Send" onClick="send();"/><br />

</body>
<script src="js/City.js" type="text/javascript"></script>
</html>

