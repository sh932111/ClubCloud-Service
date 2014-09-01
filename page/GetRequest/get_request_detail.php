<!DOCTYPE html >

<?php

$username = $_GET['username'];
$post_id = $_GET['post_id'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript">

		var userName = "<?echo $username ?>";
		var postId = "<?echo $post_id ?>";

	</script>

	<title>訊息資料查詢</title>
	<head>
		<h1>訊息資料查詢</h1>
	</head>
	<body onload="init()">

		<p><div id="username"></div></p>
		<p><div id="user"></div></p>
		
	</body>

	<script src="js/request_detail.js"></script>
</html>