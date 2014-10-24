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
		<!-- <p><div id="username"></div></p>
		<p><div id="user"></div></p> -->
		<p><div id="msg_title" class="title"></div></p>
		<p><div id="msg_name"  class="data"></div></p>
		<p><div id="msg_address" class="data"></div></p>
		<p><div id="msg_time" class="data"></div></p>
		<p><div id="msg_list" class="list"></div></p>
		<p><div id="msg_image" class="data"></div></p>

		<p><img src="" id="uploadImg" alt=""  style="width:400px;"/></p>
		
	</body>

	<script src="js/request_detail.js"></script>
	<script src="../../lib/js/get_data.js"></script>
</html>
