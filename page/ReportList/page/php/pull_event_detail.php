<?php

	$objConnect = mysql_connect("localhost","root","sh3599033");
	$objDB = mysql_select_db("emergency_data");

	mysql_query ( "set character set utf8" );

	header('Content-Type: text/html; charset=utf-8');

	$post_id = $_POST["postId"];

	$select_action = "SELECT * FROM $post_id";

	$select_res = mysql_query($select_action);
	$data = array();
	$list = array();

	$i = 0;
	$intNumRows = mysql_num_rows($select_res);

	while ($record = mysql_fetch_array($select_res)) 
	{
		$username = $record['username'];
		$name = $record['name'];
		$user_id = $record['user_id'];
		$latitude = $record['latitude'];
		$longitude = $record['longitude'];
		$t_check = $record['t_check'];

		$data["username"] = $username;
		$data["name"] = $name;
		$data["user_id"] = $user_id;
		$data["latitude"] = $latitude;
		$data["longitude"] = $longitude;
		$data["t_check"] = $t_check;

		$list[$i] = $data;

		$i = $i + 1;
	}

	$arr["result"] = TRUE;

	$arr["Message"] = "抓取資料成功";

	$list["num"] = $i;

	$arr["data"] = $list;

	echo json_encode($arr);

	exit();
	
	mysql_close($objConnect);

?>

