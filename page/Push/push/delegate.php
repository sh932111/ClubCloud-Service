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
        (string)$regID = array();
        
        array_push($regID, $row['device_token']);

        $apiKey = "AIzaSyBxsBeuTGrDiAABbP18zUVe3ZGb7QTvTlE";

        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array('registration_ids'  => $regID,
            'data'              => array('data_id' => $id,'title' => $title,'detail' => $detail,'time' => $time,'time_detail' => $time_detail,'image' => $image,'type' => "1")
            );

        $headers = array('Content-Type: application/json',
            'Authorization: key='.$apiKey
            );

        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

        $result = curl_exec($ch);
        
        curl_close($ch);
    }
    if ($row['device_os'] == "ios" && $row['city_id'] == $city_id && $row['city_detail_id']== $city_detail_id) 
    {

        callAPNS($id,$title,$detail,$time,$time_detail,$row['device_token'],$image,1);
       
        $deviceToken = $row['device_token'];
    
        $passphrase = 'enough306';
    

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
       if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;

    // Create the payload body
        $body['aps'] = array(
            'alert' => $title,
            'badge' => "0",
            'soubd' => "default",
            'data_id' => $id,
            'title' => $title,
            'detail' => $detail,
            'time' => $time,
            'time_detail' => $time_detail,
            'image' => $image,
            'type' => "1"
            );

    // Encode the payload as JSON
        $payload = json_encode($body);

    // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

    // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
        {
            $arr["result"] = FALSE;

            echo json_encode($arr);
            exit();

            echo 'Message not delivered' . PHP_EOL;
        }
        else
        {
            $arr["result"] = TRUE;

            echo json_encode($arr);
            exit();

            echo 'Message successfully delivered' . PHP_EOL;

        }

    // Close the connection to the server
        fclose($fp);
    }
}

mysql_close($objConnect);

?> 