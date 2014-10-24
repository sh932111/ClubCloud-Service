<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');
mysql_query("SET NAMES 'utf8'",$link);

$userName = $_POST["username"];
$regId = $_POST['regId'];

if (!$link) 
	{
		$arr["result"] = FALSE;
		$arr["Message"] = "初始化失敗";
		echo json_encode($arr);
		exit();
	}
	$db_selected = mysql_select_db('user_data');

	if (!$db_selected)
	{
		$arr["result"] = FALSE;		

		$arr["Message"] = "抓取資料失敗";

		echo json_encode($arr);
		exit();
	}
	else
	{
		$query = sprintf("UPDATE `user_table` SET 
			`device_token` = '$regId'
			WHERE `username` = '$userName'");
		$res = mysql_query($query,$link);

		$arr["result"] = $res;		

		$arr["Message"] = "更新資料!";

		echo json_encode($arr);
		exit();

		mysql_close($link);

	}
?>
