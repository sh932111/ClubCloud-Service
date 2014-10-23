<?php

mysql_query ( "set character set utf8" );

header("Content-Type: text/html;charset=utf-8"); 

$objConnect = mysql_connect("localhost","root","sh3599033");

mysql_query("SET NAMES 'UTF8'",$objConnect);

date_default_timezone_set('Asia/Taipei');

$id = $_POST["id"];

$username = $_POST["username"];//帳號
$name = $_POST["name"];//發送者
$title = $_POST["title"];//標題
$detail = $_POST["detail"];//內文
$date = $_POST["date"];//日期
$time = $_POST["time"];//時間
$city = $_POST["city"];//市
$area = $_POST["area"];//區
$liner = $_POST["liner"];//里
$address = $_POST["address"];//地點
$image = $_POST["image"];//是否有圖 1 or 0
$city_id = $_POST["city_id"];
$area_id = $_POST["area_id"];
$address_city = $_POST["address_city"];
$address_area = $_POST["address_area"];
$send_time = $_POST["send_time"];

if (!$objConnect) 
{
	$arr["result"] = FALSE;
	$arr["Message"] = "errpr open db";
	echo json_encode($arr);
	exit();
}
$db_selected = mysql_select_db('user_data');

if (!$db_selected)
{
	$arr["result"] = FALSE;
	$arr["Message"] = "errpr select db";
	echo json_encode($arr);
	exit();
}

if ($db_selected) 
{
	
	$creat_query  ="CREATE TABLE `calendar_table`(
		`name` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
		`data_id` VARCHAR(20) NOT NULL PRIMARY KEY,
		`username` VARCHAR(20) NOT NULL,
        `city_id` VARCHAR(20) NOT NULL,
        `area_id` VARCHAR(200) NOT NULL,
		`title` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
		`detail` VARCHAR(200)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
		`date` VARCHAR(100) NOT NULL,
		`time` VARCHAR(100) NOT NULL,
		`city` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci   NOT NULL,
		`area` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
		`address_city` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci   NOT NULL,
		`address_area` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
		`liner` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
		`address` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
		`image` INT NOT NULL,
		`send_time` VARCHAR(100) NOT NULL
		);";

$table_selected = mysql_query($creat_query, $objConnect);

$query = sprintf("INSERT INTO `calendar_table`(`data_id`,`name`,`username`,`city_id`,`area_id`,`title`,`detail`,`date`,`time`,`city`,`area`,`liner`,`address`,`image`,`address_city`,`address_area`,`send_time`) 
	VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
	$id,$name,$username,$city_id,$area_id,$title,$detail,$date,$time,$city,$area,$liner,$address,$image,$address_city,$address_area,$send_time);

$res = mysql_query($query,$objConnect);

if (!$res) 
{
	$arr["Message"] = '新增訊息失敗';
	$arr["result"] = FALSE;
	echo json_encode($arr);
	exit();
}
else
{
	$arr["Message"] = '新增訊息成功！';
	$arr["result"] = true;
	echo json_encode($arr);
	exit();
}


}

mysql_close($link);
?>