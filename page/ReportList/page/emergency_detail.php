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
	<nav>
		<ul id="listView">
			
		</ul>
	</nav>
</body>

<script src="js/emergency_detail.js"></script>
</html>