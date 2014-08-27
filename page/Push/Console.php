<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">


<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>發送訊息</title>
<script src="js/City.js" type="text/javascript"></script>
<head></head>
<body onload="init()">
<p>標題：</p>
	<input type="text" name="title" size="20" id="title" /><br />
	<p>訊息：</p>
	<input type="text" name="detail" size="20" id="detail" /><br />
	<p>日期：</p>
	<input type="text" name="time" size="20" id="time" /><br />
	<p>時間：</p>
	<input type="text" name="time_detail" size="20" id="time_detail" /><br />
	<br />
	<select id="citylist" onChange="setValue(this);" >
		
	</select><br /><br />
	<select id="citydetaillist" onChange="getDetailValue(this);" >
		
	</select><br /><br />

	<input name="Submit1" type="submit" value="Send" onClick="send();"/><br />

</body>
</html>

