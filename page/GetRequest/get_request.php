<!DOCTYPE html >

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript">

		var userName = "<?echo $username ?>";

	</script>

	<title>首頁</title>
	<head>
		<h1>首頁</h1>
	</head>
	<body onload="init()">

		<p><div id="username"></div></p>
		<p><div id="user"></div></p>
	</body>

	<script src="js/request.js"></script>
</html>