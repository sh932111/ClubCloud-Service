<!DOCTYPE html >

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="lib/jquery-1.11.1.min.js"></script>
<script src="lib/jquery.form.min.js"></script>

<script type="text/javascript">

var userName = "<?php echo $username; ?>";
function previewImage(imgfile)
{
	var picshow = document.getelementbyid("picshow");
	picshow.filters.item("dximagetransform.microsoft.alphaimageloader").src = imgfile.value;
	picshow.style.width = "88px";
	picshow.style.height = "125px";
} 
</script>

<title>發送訊息</title>
<head>
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="init()">
	<div id="main">
		<p><div id="city"></div></p>
		<p><div id="city_detail"></div></p>

		<p>標題：<input type="text" name="title" size="20" id="title" /></p>
		<p>訊息：</p>
		<p><textarea size="20" id="detail" name="detail"></textarea></p>
		<p>日期：<input type="date" name="time" size="20" id="time" /></p>
		<p>時間：<input type="time" name="time_detail" size="20" id="time_detail" /></p>
	<!-- <select id="citylist" onChange="setValue(this);" >
		
	</select><br /><br />
	<select id="citydetaillist" onChange="getDetailValue(this);" >
		
	</select><br /><br /> -->

	<input id="go_ajs" name="Submit1" type="submit" value="Send" onClick="ajs_upload()"/><br />
</div>
<div id="view">
	<form action="upload.php" method="post" id="ajaxForm">
		<input type="file" id="pic" name="pic"  onchange="previewImage(this)"><br>
		<input name="item" id="item" type="text" value="" style = "display:none"><br>
	</form>
	<div id="picshow"></div> 
</div>
<script>
// 按上傳才上傳
// $("#go_ajs").click(ajs_upload);
// 直接 change 就上傳
//$("#pic").change(ajs_upload);

function ajs_upload()
{
	var dt = new Date();
	var month = dt.getMonth()+1;
	var day = dt.getDate();
	var year = dt.getFullYear();
	
	ID = year +""+ month +""+ day+"" + dt.getHours()+""+ dt.getMinutes()+""+ dt.getSeconds();

	var item = document.getElementById('item');

	item.value = ID;

	console.log(item.value);

	$("#ajaxForm").ajaxSubmit(
	{
		beforeSubmit: function(){},
		success: function(resp,st,xhr,$form) 
		{
			if(resp!="err") 
			{
				ImageCheck = 1;
				//$("#uploadImg").attr("src",resp);
			}
			else
			{
				ImageCheck = 0;
			}
			pushData();
		}
	});
}
</script>
</body>
<script src="js/console.js" type="text/javascript"></script>
</html>

