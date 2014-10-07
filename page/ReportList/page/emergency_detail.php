<!DOCTYPE html >

<?php

$username = $_GET['username'];
$event_id = $_GET['id'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">

var userName = '<?php echo $username; ?>';
var eventID = '<?php echo $event_id; ?>';
//console.log(userName);
</script>

<title>緊急事件清單</title>
<head>
	<link rel="stylesheet" href="css/emergency_detail_style.css">
</head>
<body onload="init()">
	<h3>事件回報人</h3>
	<div id="listTitle">
		<div id="user"><h5>使用者</h5></div>
		<div id="user_id">身分證字號</div>
		<div id="latidute">Latidute</div>
		<div id="longitude">Longitude</div>
		<div id="check">回報狀況</div>
	</div>
	<hr>
	<div id="list">
		<nav>
		<ul id="listView">
			
		</ul>
	</nav>
	</div>
</body>

<script src="js/emergency_detail.js"></script>
</html>
