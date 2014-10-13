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

<title>緊急事件清單</title>
<head>
	<link rel="stylesheet" href="css/emergency_style.css">
</head>
<body onload="init()">
	<h3>緊急事件清單</h3>
	<p><select id="check_event" onChange="setValue(this)" >
		<option value="all">全部</option>
		<option value="no">未回報</option>
		<option value="phone">手機自行回報</option>
		<option value="help">需救援</option>
		<option value="peace">平安</option>
	</select></p>
	
	<nav>
		<ul id="listView">
		</ul>
	</nav>
</body>

<script src="js/emergency.js"></script>
</html>
