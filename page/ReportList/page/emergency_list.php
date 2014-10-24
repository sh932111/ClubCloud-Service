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
	<div id="listView" class="css_table"></div>
</body>

<script src="js/emergency.js"></script>
<script src="../../lib/js/get_data.js"></script>

</html>
