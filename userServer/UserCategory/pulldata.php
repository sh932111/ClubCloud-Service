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
			$data_id = $objResult["id"];

			$db_selected2 = mysql_select_db('user_data');

    		$select_action2 = "SELECT * FROM calendar_table WHERE data_id = '$data_id'";

			$objQuery = mysql_query($select_action2);
			$objResult2 = mysql_fetch_array($objQuery);
			$intNumRows2 = mysql_num_rows($objQuery);
	    
			$data["name"] = $objResult2["name"];
			$data["username"] = $objResult2["username"];
			$data["data_id"] = $objResult2["data_id"];
			$data["title"] = $objResult2["title"];
			$data["detail"] = $objResult2["detail"];
			$data["date"] = $objResult2["date"];
			
			$data["time"] = $objResult2["time"];//territory_name
			$data["city"] = $objResult2["city"];//district_name
			$data["area"] = $objResult2["area"];//city_id
			$data["liner"] = $objResult2["liner"];//district_id
			
			$data["address"] = $objResult2["address"];//district_id
			$data["image"] = $objResult2["image"];//district_id

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