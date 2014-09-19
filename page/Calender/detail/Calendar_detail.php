<!DOCTYPE html >

<?php

$username = $_GET['username'];
$data_id = $_GET['data_id'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery.qrcode.min.js"></script>

<script type="text/javascript">

var userName = "<?echo $username ?>";
var dataID = "<?echo $data_id ?>";

</script>

<title>發送訊息</title>
<head></head>
<body onload="init()">

	<div class="demo">
   		<h3>活動QR Code：</h3>
   		<div id="code"></div>
		<!-- <img id="image" /> --><a href="#" download="dl.png" onclick="this.href=cvs.toDataURL();" >下載</a>
   </div>

</body>
<script src="js/detail.js" type="text/javascript"></script>
</html>