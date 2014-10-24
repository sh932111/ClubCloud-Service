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
	<div>
		<h3>事件回報人</h3>
		<div class="styled-select">
			<select id="check_event" onChange="setValue(this)" >
				<option value="1">全部</option>
				<option value="2">未回報</option>
				<option value="3">手機自行回報</option>
				<option value="4">使用者平安</option>
				<option value="5">使用者需救援</option>
			</select>
		</div>
	</div>	
	<div id="listView" class="css_table"></div>
</body>

<script src="js/emergency_detail.js"></script>
<script src="../../lib/js/get_data.js"></script>
</html>
