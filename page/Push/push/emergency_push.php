<?php

mysql_query ( "set character set utf8" );

header("Content-Type: text/html;charset=utf-8"); 
date_default_timezone_set('Asia/Taipei');

//$id = date("Ymdhis");
$id = $_POST["id"];
$username = $_POST["username"];//帳號
$name = $_POST["name"];//發送者
$title = $_POST["title"];//標題
$detail = $_POST["detail"];//內文
$date = $_POST["date"];//日期
$time = $_POST["time"];//時間
$city_id = $_POST["city_id"];
$area_id = $_POST["area_id"];

$link = mysql_connect('localhost','root','sh3599033');

mysql_query("SET NAMES 'utf8'",$link);

if (!$link) 
{
    $arr["result"] = FALSE;
    $arr["Message"] = "error open db";
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
        $creat_query  ="CREATE TABLE `user_emergency`(
            `name` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `id` VARCHAR(20) NOT NULL PRIMARY KEY,
            `username` VARCHAR(20) NOT NULL,
            `city_id` VARCHAR(20) NOT NULL,
            `area_id` VARCHAR(200) NOT NULL,
            `title` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `detail` VARCHAR(200)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `date` VARCHAR(10) NOT NULL,
            `time` VARCHAR(20) NOT NULL
            );";

    $table_selected = mysql_query($creat_query, $link);

    $query = sprintf("INSERT INTO `user_emergency`(`id`,`name`,`username`,`city_id`,`area_id`,`title`,`detail`,`date`,`time`) 
            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            $id,$name,$username,$city_id,$area_id,$title,$detail,$date,$time);

    $res = mysql_query($query,$link);

            if (!$res) 
            {
                $arr["Message"] = '訊息新增失敗';
                $arr["result"] = FALSE;
                echo json_encode($arr);
                exit();
            }
            else
            {
                $arr["Message"] = '訊息新增成功！';
                $arr["result"] = true;
                echo json_encode($arr);

                $sq_creat_query  ="CREATE TABLE `$id`(
                `name` VARCHAR(200)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `username` VARCHAR(200) NOT NULL,
                `user_id` VARCHAR(200) NOT NULL,
                `latitude` VARCHAR(200) NOT NULL,
                `longitude` VARCHAR(200) NOT NULL,
                `check` VARCHAR(20) NOT NULL
                );";
            
                $db_table_selected = mysql_query($sq_creat_query, $link);

                exit();
            }

            
}

mysql_close($link);
?>
