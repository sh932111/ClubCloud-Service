<?php

header('Content-Type: text/html; charset=utf8');

$id = $_POST["id"];
$title = $_POST["title"];
$detail = $_POST["detail"];
$time = $_POST["time"];
$time_detail = $_POST["time_detail"];
$city = $_POST["city"];
$city_detail = $_POST["city_detail"];
$city_id = $_POST["city_id"];
$city_detail_id = $_POST["city_detail_id"];
$image = $_POST["image"];
// date_default_timezone_set('Asia/Taipei');
// $id = date("Ymdhis");
// $arr["id"] = $id;
// echo json_encode($arr);

$objConnect = mysql_connect("localhost","root","sh3599033");

$objDB = mysql_select_db("user_data");

mysql_query ( "set character set utf8" );

$select_action = "SELECT * FROM user_table ";

$objQuery = mysql_query($select_action);

$intNumRows = mysql_num_rows($objQuery);

while($row = mysql_fetch_array($objQuery))
{

    if ($row['device_os'] == "android" && $row['city_id'] == $city_id && $row['city_detail_id'] == $city_detail_id) 
    {
        include_once("PushGCM.php");

        callGCM($id,$title,$detail,$time,$time_detail ,$row['device_token'],$image,1);

    }
    if ($row['device_os'] == "ios" && $row['city_id'] == $city_id && $row['city_detail_id']== $city_detail_id) 
    {
        include_once("PushAPNS.php");

        callAPNS($id,$title,$detail,$time,$time_detail,$row['device_token'],$image,1);
    }
}

mysql_close($objConnect);

?> 