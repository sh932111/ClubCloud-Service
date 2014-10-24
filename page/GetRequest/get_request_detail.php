<!DOCTYPE html >

<?php

$username = $_GET['username'];
$post_id = $_GET['post_id'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript">

		var userName = "<?php echo $username; ?>";
		var postId = "<?php echo $post_id; ?>";

	</script>

	<title>訊息資料查詢</title>
	<head>
		<link rel="stylesheet" href="css/get_request_detail.css">
	</head>
	<body onload="init()">
		<h2>訊息資料查詢</h2>
		<div id="main">
			<p><div id="msg_title"></div></p>
			<p><div id="msg_name"></div></p>
			<p><div><div id="msg_address"></div><div id="msg_time"></div></div></p>
			<p><div id="msg_list"></div></p>
			<input id="push_bt" type="button" value="推送活動" onclick="pushMsg()" />
			<input id="delete_bt" type="button" value="刪除活動" onclick="deleteMsg(0)" />
		</div>
		<div id="view">
			<p><div id="msg_image"></div></p>
			<p><img src="" id="uploadImg" alt=""  style="width:400px;"/></p>
		</div>
	</body>
	<script src="js/request_detail.js"></script>
	<script src="../lib/js/get_data.js"></script>
</html>
