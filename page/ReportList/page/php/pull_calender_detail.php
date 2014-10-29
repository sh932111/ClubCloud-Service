<?php

	$objConnect = mysql_connect("localhost","root","sh3599033");

	mysql_query ( "set character set utf8" );

	header('Content-Type: text/html; charset=utf-8');

	mysql_query("SET NAMES 'utf8'",$objConnect);

	$objDB = mysql_select_db("calendar_data");

	$post_id = $_POST["postId"];

	$select_action = "SELECT * FROM `".$post_id."`";

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
		$t_check = $record['t_check'];
		$cellphone = $record['cellphone'];

		$data["username"] = $username;
		$data["name"] = $name;
		$data["user_id"] = $user_id;
		$data["t_check"] = $t_check;
		$data["cellphone"] = $cellphone;

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

