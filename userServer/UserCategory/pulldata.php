<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');
mysql_query("SET NAMES 'utf8'",$link);

$userName = $_POST["username"];

if (!$link) 
{
	$arr["result"] = FALSE;
	$arr["Message"] = "初始化失敗";
	echo json_encode($arr);
	exit();
}
$db_selected = mysql_select_db('UserCategory');

if (!$db_selected)
{
	$arr["result"] = FALSE;		

	$arr["Message"] = "抓取資料失敗";

	echo json_encode($arr);
	exit();
}
else
{
	$query = sprintf("SELECT * FROM `$userName`");
	
	$res = mysql_query($query,$link);

	if ($res) 
	{
		$data = array();
		$list = array();

		$i = 0;
		$intNumRows = mysql_num_rows($res);

		while ($objResult = mysql_fetch_array($res)) 
		{
			$data["id"] = $objResult["id"];
			// $data["name"] = $objResult["name"];
			// $data["username"] = $objResult["username"];
			// $data["data_id"] = $objResult["data_id"];
			// $data["title"] = $objResult["title"];
			// $data["detail"] = $objResult["detail"];
			// $data["date"] = $objResult["date"];
			
			// $data["time"] = $objResult["time"];//territory_name
			// $data["city"] = $objResult["city"];//district_name
			// $data["area"] = $objResult["area"];//city_id
			// $data["liner"] = $objResult["liner"];//district_id
			
			// $data["address"] = $objResult["address"];//district_id
			// $data["image"] = $objResult["image"];//district_id

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
	else
	{
		$response_result = TRUE;
		$arr["result"] = $response_result;
		$arr["Message"] = "失敗!";
		echo json_encode($arr);
		exit();
	}

	mysql_close($link);
}
?>