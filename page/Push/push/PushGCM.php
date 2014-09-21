	
<?php
// 這支程式就是將自己模擬成 client 端,
// 發送 POST 給 Google GCM server
// function sendModifyGCM($regID){
 function callGCM($data_id,$title,$detail,$time,$time_detail ,$device_token,$image)
{
    // $username = $_POST["username"];
 
    // $message = $_POST["message"];

    (string)$regID = array();
    
    //array_push($regID, $_GET["regId"]);
    array_push($regID, $device_token);
     
    $apiKey = "AIzaSyBxsBeuTGrDiAABbP18zUVe3ZGb7QTvTlE";
 
    // Set POST variables
    $url = 'https://android.googleapis.com/gcm/send';
 
    $fields = array('registration_ids'  => $regID,
                    'data'              => array('data_id' => $data_id,'title' => $title,'detail' => $detail,'time' => $time,'time_detail' => $time_detail,'image' => $image)
                    );
      
    $headers = array('Content-Type: application/json',
                    'Authorization: key='.$apiKey
                    );
      
    // Open connection
    $ch = curl_init();
      
    // Set the url, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    // Disabling SSL Certificate support temporarly
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // 發送的訊息內容轉成 JSON 格式

    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
      
    // 傳送到 Google GCM server,
    // 並接收回傳結果
    $result = curl_exec($ch);
    // Close connection
    /*
    if ($result === FALSE)
     {
        die('Curl failed: ' . curl_error($ch));
        
        $arr["result"] = FALSE;

        echo json_encode($arr);
        exit();
    }
    else
    {
        $arr["result"] = TRUE;

        echo json_encode($arr);
        exit();
    }*/
    curl_close($ch);

    //echo 'result =='.$result; 
    // Put your device token here (without spaces):
}
    

?> 