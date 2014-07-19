<?php

function callAPNS($title,$detail,$time,$time_detail,$device_token)
{
	$deviceToken = $device_token;

	// Put your private key's passphrase here:
	$passphrase = '075228906';
	 

	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

	// Open a connection to the APNS server
	$fp = stream_socket_client(
		'ssl://gateway.sandbox.push.apple.com:2195', $err,
		$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

	// $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', 
	// 	$err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
	    
	if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);

	echo 'Connected to APNS' . PHP_EOL;

	// Create the payload body
	$body['aps'] = array(
		'title' => $title,
		'detail' => $detail,
		'time' => $time,
		'time_detail' => $time_detail
		);

	// Encode the payload as JSON
	$payload = json_encode($body);

	// Build the binary notification
	$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

	// Send it to the server
	$result = fwrite($fp, $msg, strlen($msg));
/*
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
*/
	// Close the connection to the server
	fclose($fp);
}


?> 