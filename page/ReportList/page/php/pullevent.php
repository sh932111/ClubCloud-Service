<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');

$city_id = $_POST["city_id"];
$area_id = $_POST["area_id"];

mysql_query("SET NAMES 'utf8'",$link);
if (!$link) 
{
	$arr["result"] = FALSE;
	$arr["Message"] = "初始化失敗";
	echo json_encode($arr);
	exit();
}
$db_selected = mysql_select_db('user_data');
if (!$db_selected)
{
	$arr["result"] = FALSE;		

	$arr["Message"] = "抓取資料失敗";

	echo json_encode($arr);
	exit();
}
else
{
	$select_action = "SELECT * FROM user_emergency  WHERE city_id = '$city_id'  
		AND area_id = '$area_id'  ORDER BY CAST(time AS signed) DESC
	";
	$select_res = mysql_query($select_action);
	$data = array();
	$list = array();

	$i = 0;
	$intNumRows = mysql_num_rows($select_res);

	while ($record = mysql_fetch_array($select_res)) 
	{
		$id = $record['id'];
		$title = $record['title'];
		$detail = $record['list'];
		$date = $record['date'];
		$time = $record['time'];

		$data["id"] = $id;
		$data["title"] = $title;
		$data["list"] = $detail;
		$data["date"] = $date;
		$data["time"] = $time;

		$list[$i] = $data;

		$i = $i + 1;
	}

	$arr["result"] = TRUE;

	$arr["Message"] = "抓取資料成功";

	$list["num"] = $i;

	$arr["data"] = $list;

	echo json_encode($arr);

	exit();
}


?>