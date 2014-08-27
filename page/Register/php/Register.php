<?php
    header('Content-Type: text/html; charset=utf8');

    
    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
    mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];
$user_id = $_POST["user_id"];
$address = $_POST["address"];
$city = $_POST["city"];
$city_detail = $_POST["city_detail"];
$city_id = $_POST["city_id"];
$city_detail_id = $_POST["city_detail_id"];

$check = check_nick($user_id);

if ($check) 
{
    include_once("CheckUserID.php");

    $check2 = checkID($user_id);

    if ($check2) 
    {
        //驗證成功後繼續做的事情
        $objConnect = mysql_connect("localhost","root","sh3599033");
        $objDB = mysql_select_db("user_data");
        //mysql_query ( "set character set utf8" );
        mysql_query("SET NAMES 'UTF8'");

        
        $creat_query  ="CREATE TABLE `root_table`(
            `name` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `username` VARCHAR(20) NOT NULL PRIMARY KEY,
            `password` VARCHAR(20) NOT NULL,
            `user_id` VARCHAR(20) NOT NULL,
            `address` VARCHAR(200) NOT NULL,
            `user_city` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `user_city_detail` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
            `city_id` VARCHAR(20) NOT NULL,
            `city_detail_id` VARCHAR(20) NOT NULL
            );";

        $table_selected = mysql_query($creat_query, $objConnect);

        $query = sprintf("INSERT INTO `root_table`(`name`,`username`,`password`,`user_id`,`address`,`user_city`,`user_city_detail`,`city_id`,`city_detail_id`) 
            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            $name,$username,$password,$user_id,$address,$city,$city_detail,$city_id,$city_detail_id);

            $res = mysql_query($query,$objConnect);

            if (!$res) 
            {
                $arr["Message"] = '以有同樣帳戶';
                $arr["result"] = FALSE;
                echo json_encode($arr);
                exit();
            }
            else
            {
                $arr["Message"] = '新增會員成功！';
                $arr["result"] = true;
                echo json_encode($arr);
                exit();
            }
        
    }
    else
    {
        $arr["Message"] = '身分證以註冊';
        $arr["result"] = FALSE;
        echo json_encode($arr);
        exit();
    }
    
}

else
{
	$arr["Message"] = '身分證格式錯誤';
	$arr["result"] = FALSE;
	echo json_encode($arr);
    exit();
}


function check_nick($id) 
{

    $flag = false;
    $id = strtoupper($id); // 將英文字母全部轉成大寫
    $id_len = strlen($id); // 取得字元長度

    if($id_len <= 0) 
    {
        return false;
    }
    if ($id_len > 10) 
    {
        return false;
    }
    if ($id_len < 10 && $id_len > 0) 
    {
        return false;
    }

     //檢 查 第一個字母是否為英文字
     $id_sub1 = substr($id,0,1); // 從第一個字元開始 取得字串
     $id_sub1 = ord($id_sub1); // 回傳字串的acsii 碼
     if ($id_sub1 > 90 || $id_sub1 < 65)
      {
        return false;  
     }

     //檢 查 身份證字號的 第二個字元 男生或女生
     $id_sub2 = substr($id,1,1);

     if($id_sub2 !="1" && $id_sub2 != "2") 
     {
        return false;
     }

     for ($i=1;$i<10;$i++) {
        $id_sub3 = substr($id,$i,1);
        $id_sub3 = ord($id_sub3);
        if ($id_sub3 > 57 || $id_sub3 < 48) 
        {
            $n=$i+1;
            return false;  
        }
     }

     $num=array("A" => "10","B" => "11","C" => "12","D" => "13","E" => "14",
        "F" => "15","G" => "16","H" => "17","J" => "18","K" => "19","L" => "20",
        "M" => "21","N" => "22","P" => "23","Q" => "24","R" => "25","S" => "26",
        "T" => "27","U" => "28","V" => "29","X" => "30","Y" => "31","W" => "32",
        "Z" => "33","I" => "34","O" => "35");

     $d1 = substr($id,0,1); // 從第一個字元開始 取得字串
     $n1=substr($num[$d1],0,1)+(substr($num[$d1],1,1)*9);
     $n2=0; //初使化
     for ($j=1;$j<9;$j++) 
     {
        $d4=substr($id,$j,1);
        $n2=$n2+$d4*(9-$j);
     }
     $n3=$n1+$n2+substr($id,9,1);
     if(($n3 % 10)!= 0) 
     {
        return false;  
     }
     return  true;  

 }

?>
