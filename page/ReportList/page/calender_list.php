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

<title>活動事件清單</title>
<head>
	<link rel="stylesheet" href="css/calender_style.css">
</head>
<body onload="init()">
	<div id="selectView">
		<div class="styled-select">
			<select id="check_event" onChange="setValue(this)" >
				<option value="1">1月</option>
				<option value="2">2月</option>
				<option value="3">3月</option>
				<option value="4">4月</option>
				<option value="5">5月</option>
				<option value="6">6月</option>
				<option value="7">7月</option>
				<option value="8">8月</option>
				<option value="9">9月</option>
				<option value="10">10月</option>
				<option value="11">11月</option>
				<option value="12">12月</option>
			</select>
		</div>
		<div class="styled-select">
			<select id="check_event" onChange="setValue(this)" >
				<option value="1">1月</option>
				<option value="2">2月</option>
				<option value="3">3月</option>
				<option value="4">4月</option>
				<option value="5">5月</option>
				<option value="6">6月</option>
				<option value="7">7月</option>
				<option value="8">8月</option>
				<option value="9">9月</option>
				<option value="10">10月</option>
				<option value="11">11月</option>
				<option value="12">12月</option>
			</select>
		</div>
	</div>
	<div id="listView" class="css_table">
		<div class="up_css_tr">
          	<div class="up_title_css_td">標題</div>
          	<div class="up_list_css_td">內文</div>
          	<div class="up_date_css_td">日期</div>
          	<div class="up_time_css_td">時間</div>
      	</div>
  </div>
</body>

<script src="js/calender.js"></script>
<script src="../../lib/js/get_data.js"></script>

</html>
