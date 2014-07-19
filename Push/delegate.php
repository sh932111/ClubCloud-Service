<?php
  
    echo $title = $_POST["title"];
    echo $detail = $_POST["detail"];
    echo $time = $_POST["time"];
    echo $time_detail = $_POST["time_detail"];

    $objConnect = mysql_connect("localhost","root","sh3599033");

    $objDB = mysql_select_db("user_data");

    mysql_query ( "set character set utf8" );

    $select_action = "SELECT * FROM user_table ";

    $objQuery = mysql_query($select_action);

    $intNumRows = mysql_num_rows($objQuery);

    while($row = mysql_fetch_array($objQuery))
    {
        if ($row['device_os'] == "android") 
        {
            include_once("PushGCM.php");

            callGCM($title,$detail,$time,$time_detail ,$row['device_token']);
        
        }
        else
        {
            include_once("PushAPNS.php");

            callAPNS($title,$detail,$time,$time_detail,$row['device_token']);
        }
    }

    mysql_close($objConnect);


?> 