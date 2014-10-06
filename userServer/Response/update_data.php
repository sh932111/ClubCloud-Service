<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');
mysql_query("SET NAMES 'utf8'",$link);

$table_id = $_POST["id"];
$username = $_POST["username"];//帳號
$user_status = $_POST["user_status"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];

if (!$link) 
{
	$arr["result"] = FALSE;
	$arr["Message"] = "初始化失敗";
	echo json_encode($arr);
	exit();
}

$db_selected = mysql_select_db('emergency_data');

$query = sprintf("UPDATE `$table_id` SET 
					`latitude` = '$latitude' ,
					`longitude` = '$longitude' ,
					`t_check` = '$user_status' 
					WHERE `username` = '$username';");

$res = mysql_query($query,$link);

if ($res) 
{
	$response_result = TRUE;
	$arr["result"] = $response_result;
	$arr["Message"] = "回報成功！";
	echo json_encode($arr);
	exit();
}

mysql_close($link);

?>