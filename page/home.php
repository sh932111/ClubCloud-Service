<!DOCTYPE html >

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">

var userName = '<?php echo $username; ?>';
//console.log(userName);
</script>

<title>首頁</title>
<head>
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="init()">

	<div id="header">
		<h1>首頁</h1>
	</div>
	<div id="sidebar">
		<p><div id="username"></div></p>
		<p><div id="user"></div></p>
		<p><input type="button" value="活動行事曆" onclick="checkCalendar()" /></p>
		<p><input type="button" value="訊息查詢" onclick="selectMsg()" /></p>
		<p><input type="button" value="訊息傳送" onclick="pushMsg()" /></p>
		<p><input type="button" value="社刊製作" onclick="makebook()" /></p>
		<p><input type="button" value="緊急訊息" onclick="crashMsg()" /></p>
	</div>
	<div id="main">

		<iframe id="iframe" src="" scrolling="yes" frameborder="1">
		</iframe>
	</div>
	<div id="footer"></div>
	
</body>

<script src="js/home.js"></script>
</html>
