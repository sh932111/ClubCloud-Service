<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');
mysql_query("SET NAMES 'utf8'",$link);

$userName = $_POST["username"];

if (!$link) 
{
	$arr["result"] = FALSE;
	$arr["Message"] = "初始化失敗";
	echo json_encode($arr);
	exit();
}
$sql = 'CREATE DATABASE UserCategory';

if (mysql_query($sql, $link)) 
{
	$db_selected = mysql_select_db('UserCategory');
	
	if (!$db_selected)
	{
		$arr["result"] = FALSE;
		$arr["Message"] = "初始化失敗";
		echo json_encode($arr);
		exit();
	}
} 
$db_selected = mysql_select_db('UserCategory');

if (!$db_selected)
{
	$arr["result"] = FALSE;		

	$arr["Message"] = "抓取資料失敗";

	echo json_encode($arr);
	exit();
}
else
{
	$creat_query  ="CREATE TABLE `$userName`(
		`id` VARCHAR(200) NOT NULL PRIMARY KEY
		);";
	
	$table_selected = mysql_query($creat_query, $link);
}
?>