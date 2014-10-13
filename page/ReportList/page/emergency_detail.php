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
	<p><select id="check_event" onChange="setValue(this)" >
		<option value="all">全部</option>
		<option value="no">未回報</option>
		<option value="phone">手機自行回報</option>
		<option value="help">需救援</option>
		<option value="peace">平安</option>
	</select></p>
	<div id="list">
		<nav>
		<ul id="listView">
			
		</ul>
		</nav>
	</div>
</body>

<script src="js/emergency_detail.js"></script>
</html>
