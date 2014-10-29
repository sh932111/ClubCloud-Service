<!DOCTYPE html >

<?php

$username = $_GET['username'];
$event_id = $_GET['id'];
$date = $_GET['date'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    
	var userName = '<?php echo $username; ?>';
	var eventID = '<?php echo $event_id; ?>';
	var Day = '<?php echo $date; ?>';
</script>

<title>活動參與人</title>
<head>
	<link rel="stylesheet" href="css/calender_detail_style.css">
</head>
<body onload="init()">
	<div id="listView" class="css_table">
		<div class="up_css_tr">
          	<div class="up_css_td">名字</div>
          	<div class="up_css_td">身分證字號</div>
          	<div class="up_css_td">聯絡電話</div>
          	<div class="up_css_td">是否參與</div>
      	</div>
	</div>
	<div id="chart_div" > 
	</div>
</body>

<script src="js/calender_detail.js"></script>
<script src="../../Push/lib/jquery-1.11.1.min.js"></script>
<script src="../../lib/js/get_data.js"></script>
</html>
