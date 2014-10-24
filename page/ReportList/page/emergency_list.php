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
	<div id="listView" class="css_table">
		<div class="css_tr">
          	<div class="up_title_css_td">標題</div>
          	<div class="up_list_css_td">內文</div>
          	<div class="up_date_css_td">日期</div>
          	<div class="up_time_css_td">時間</div>
      	</div>
      	<hr>
  </div>
</body>

<script src="js/emergency.js"></script>
<script src="../../lib/js/get_data.js"></script>

</html>
