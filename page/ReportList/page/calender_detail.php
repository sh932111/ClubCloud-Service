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

<title>活動參與人</title>
<head>
	<link rel="stylesheet" href="css/calender_detail_style.css">
</head>
<body onload="init()">
	<div>
		
	</div>	
	<div id="listView" class="css_table"></div>
</body>

<script src="js/calender_detail.js"></script>
<script src="../../lib/js/get_data.js"></script>
</html>
