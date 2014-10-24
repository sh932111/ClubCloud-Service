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

<title>社區雲端事務系統</title>
<head>
	<link rel="stylesheet" href="lib/css/style.css">
	<link rel="shortcut icon" href="lib/img/icon.png">  
</head>
<body onload="init()">

	<div id="header">
		<img src="lib/img/ClubCould-Service.png" id="logo"> 
		<div id="Title">社區雲端事務系統</div>
		<div id="user"></div>
		<img src="lib/img/user.jpg" id="userImg"> 
	</div>
	<div id="sidebar">
		<br>
		<p><input type="button" value="活動行事曆" onclick="checkCalendar()" class="mainNemu"/></p>
		<p><input type="button" value="訊息查詢" onclick="selectMsg()"  class="mainNemu"/></p>
		<p><input type="button" value="訊息傳送" onclick="pushMsg()"  class="mainNemu"/></p>
		<p><input type="button" value="資料清單" onclick="crashMsg()"  class="mainNemu"/></p>
	</div>
	<div id="main">
		<iframe id="iframe" src="" scrolling="yes" frameborder="0">
		</iframe>
	</div>
	
</body>

<script src="lib/js/home.js"></script>
<script src="lib/js/get_data.js"></script>
</html>
