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
		<p>活動地點：
			<select id="citylist" onChange="setValue(this);" >
			</select>
			<select id="citydetaillist" onChange="getDetailValue(this);" >
			</select>
			<input type="text" name="address" size="20" id="address" /></p>
			<p>日期：<input type="date" name="time" size="20" id="time" /></p>
			<p>時間：<input type="time" name="time_detail" size="20" id="time_detail" /></p>


			<input id="go_ajs" name="Submit1" type="submit" value="Send" onClick="ajs_upload()"/><br />
		</div>
		<div id="view">
			<form action="upload.php" method="post" id="ajaxForm">
				<input type="file" id="pic" name="pic"  onchange="change()"><br>
				<input name="item" id="item" type="text" value="" style = "display:none"><br>
			</form>
			預覽：<img id="preview" alt="" name="pic" />
		</div>
		<script>
		function change() {
			var pic = document.getElementById("preview");
			var file = document.getElementById("pic");
			var ext=file.value.substring(file.value.lastIndexOf(".")+1).toLowerCase();
     // gif在IE浏览器暂时无法显示
     if(ext!='png'&&ext!='jpg'&&ext!='jpeg'){
     	alert("文件必須為圖片！"); return;
     }
     // IE浏览器
     if (document.all) {

     	file.select();
     	var reallocalpath = document.selection.createRange().text;
     	var ie6 = /msie 6/i.test(navigator.userAgent);
         // IE6浏览器设置img的src为本地路径可以直接显示图片
         if (ie6) pic.src = reallocalpath;
         else {
             // 非IE6版本的IE由于安全问题直接设置img的src无法显示本地图片，但是可以通过滤镜来实现
             pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";
             // 设置img的src为base64编码的透明图片 取消显示浏览器默认图片
             pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
         }
     }else{
     	html5Reader(file);
     }
 }
 
 function html5Reader(file){
 	var file = file.files[0];
 	var reader = new FileReader();
 	reader.readAsDataURL(file);
 	reader.onload = function(e){
 		var pic = document.getElementById("preview");
 		pic.src=this.result;
 	}
 }
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

