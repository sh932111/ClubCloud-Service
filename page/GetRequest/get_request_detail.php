<!DOCTYPE html >

<?php

$username = $_GET['username'];
$post_id = $_GET['post_id'];
$link_class = $_GET['class'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript">

		var userName = "<?php echo $username; ?>";
		var postId = "<?php echo $post_id; ?>";
		var linkClass = "<?php echo $link_class; ?>";

	</script>

	<title>訊息資料查詢</title>
	<head>
		<h2>訊息資料查詢</h2>
	</head>
	<body onload="init()">

		<!-- <p><div id="username"></div></p>
		<p><div id="user"></div></p> -->
		<p><div id="msg_name"></div></p>
		<p><div id="msg_username"></div></p>
		<p><div id="msg_title"></div></p>
		<p><div id="msg_address"></div></p>
		<p><div id="msg_time"></div></p>
		<p><div id="msg_list"></div></p>
		<p><div id="msg_image"></div></p>

		<p><img src="" id="uploadImg" alt=""  style="width:400px;"/></p>
		
		<input id="push_bt" type="button" value="推送活動" onclick="pushMsg()" />
		<input id="delete_bt" type="button" value="刪除活動" onclick="deleteMsg(0)" />
		
	</body>

	<script src="js/request_detail.js"></script>
<script src="../lib/js/get_data.js"></script>
</html>
