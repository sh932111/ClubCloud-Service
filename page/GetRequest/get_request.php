<!DOCTYPE html >

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">

var userName = "<?php echo $username; ?>";

</script>

<title>訊息查詢</title>
<head>

</head>
<body onload="init()">
	<p><div>  
		<div id="msg3"></div>   
	</div></p>
</body>

<script src="js/request.js"></script>
<link rel="stylesheet" href="css/get_request.css">
</html>
