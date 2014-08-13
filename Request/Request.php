<?php

header('content-type:text/html;charset=utf8');

date_default_timezone_set('Asia/Taipei');

$id = date("Ymdhis");
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

$link = mysql_connect('localhost','root','sh3599033');

if (!$link) 
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
        // $creat_query  ="CREATE TABLE `user_request`(
        //     `id` VARCHAR(1000) NOT NULL PRIMARY KEY,
        //     `username` VARCHAR(20)  NOT NULL,
        //     `name` VARCHAR(20)  NOT NULL,
        //     `title` VARCHAR(20) NOT NULL,
        //     `detail` VARCHAR(9999) NOT NULL,
        //     `date` VARCHAR(20) NOT NULL,
        //     `time` VARCHAR(20) NOT NULL,
        //     `city` VARCHAR(20) NOT NULL,
        //     `area` VARCHAR(20) NOT NULL,
        //     `liner` VARCHAR(20) NOT NULL,
        //     `address` VARCHAR(2000) NOT NULL
        //     );";


        $creat_query  ="CREATE TABLE `user_request`(
            `name` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `id` VARCHAR(20) NOT NULL PRIMARY KEY,
            `username` VARCHAR(20) NOT NULL,
            `title` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `detail` VARCHAR(200)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `date` VARCHAR(10) NOT NULL,
            `time` VARCHAR(20) NOT NULL,
            `city` VARCHAR(20)  NOT NULL,
            `area` VARCHAR(20) NOT NULL,
            `liner` VARCHAR(20) NOT NULL,
            `address` VARCHAR(20) NOT NULL
            );";

    $table_selected = mysql_query($creat_query, $link);

    // if (!$table_selected) 
    // {
    //     $arr["result"] = FALSE;
    //     $arr["Message"] = "表格新增失敗";
    //     echo json_encode($arr);
    //     exit();
    // }

    $query = sprintf("INSERT INTO `user_request`(`id`,`name`,`username`,`title`,`detail`,`date`,`time`,`city`,`area`,`liner`,`address`) 
            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            $id,$name,$username,$title,$detail,$date,$time,$city,$area,$liner,$address);

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
                exit();
            }
            
}


mysql_close($link);
?>
