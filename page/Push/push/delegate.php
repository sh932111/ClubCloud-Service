<?php
  
  header('Content-Type: text/html; charset=utf8');

    
    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
    mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

    echo $title = $_POST["title"];
    echo $detail = $_POST["detail"];
    echo $time = $_POST["time"];
    echo $time_detail = $_POST["time_detail"];
    echo $city = $_POST["city"];
    echo $city_detail = $_POST["city_detail"];
    echo $city_id = $_POST["city_id"];
    echo $city_detail_id = $_POST["city_detail_id"];



    $objConnect = mysql_connect("localhost","root","sh3599033");

    $objDB = mysql_select_db("user_data");

    mysql_query ( "set character set utf8" );

    $select_action = "SELECT * FROM user_table ";

    $objQuery = mysql_query($select_action);

    $intNumRows = mysql_num_rows($objQuery);

    // while($row = mysql_fetch_array($objQuery))
    // {

    //     if ($row['device_os'] == "android" && $row['city_id'] == $city_id && $row['city_detail_id'] == $city_detail_id) 
    //     {
    //         include_once("PushGCM.php");

    //         callGCM($title,$detail,$time,$time_detail ,$row['device_token']);
        
    //     }
    //     else if ($row['device_os'] == "ios" && $row['city_id'] == $city_id && $row['city_detail_id']== $city_detail_id) 
    //     {
    //         include_once("PushAPNS.php");

    //         callAPNS($title,$detail,$time,$time_detail,$row['device_token']);
    //     }
    // }

    include_once("PushAPNS.php");

            callAPNS($title,$detail,"time","time_detail","ss");

    mysql_close($objConnect);


?> 