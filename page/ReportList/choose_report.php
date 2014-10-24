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

<title>選擇清單</title>
<head>
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="init()">
	<div id="menu">
		<input type="button" value="緊急回報清單" onclick="emList()" class="Selected" />
	</div>
	<div id="main">
		<iframe id="iframe" src="" scrolling="yes" frameborder="0">
		</iframe>
	</div>
</body>

<script src="js/choose_report.js"></script>
</html>
