<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');
mysql_query("SET NAMES 'utf8'",$link);

$username = $_POST["username"];
$id = $_POST["id"];

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
	$arr["Message"] = "error select db";
	echo json_encode($arr);
	exit();
}
else
{
	$creat_query  ="CREATE TABLE `$username`(
		`id` VARCHAR(200) NOT NULL PRIMARY KEY
		);";

	$table_selected = mysql_query($creat_query, $link);

	$user_query = sprintf("INSERT INTO `$username`(`id`) 
                VALUES ('%s')",
                $id);

    $user_query_res = mysql_query($user_query,$link);

    if ($user_query_res) 
    {
    	//去user_data 取資料

    	$db_selected2 = mysql_select_db('user_data');

    	$select_action2 = "SELECT * FROM calendar_table WHERE data_id = '$id'";

		$objQuery = mysql_query($select_action2);
		$objResult = mysql_fetch_array($objQuery);
		$intNumRows = mysql_num_rows($objQuery);
	    
		if ($intNumRows == 0) 
		{
			$response_result = FALSE;
			$arr["result"] = $response_result;
			$arr["Message"] = "無此活動資料！";
			
			echo json_encode($arr);
			exit();
		}
		else
		{
			$arr["name"] = $objResult["name"];
			$arr["username"] = $objResult["username"];
			$arr["data_id"] = $objResult["data_id"];
			$arr["title"] = $objResult["title"];
			$arr["detail"] = $objResult["detail"];
			$arr["date"] = $objResult["date"];
			
			$arr["time"] = $objResult["time"];//territory_name
			$arr["city"] = $objResult["city"];//district_name
			$arr["area"] = $objResult["area"];//city_id
			$arr["liner"] = $objResult["liner"];//district_id
			
			$arr["address"] = $objResult["address"];//district_id
			$arr["image"] = $objResult["image"];//district_id

		    $arr["result"] = TRUE;
			$arr["Message"] = "點名成功!";
			echo json_encode($arr);
			exit();
		}
    }
    else
    {
    	$arr["result"] = FALSE;
		$arr["Message"] = "點名失敗，可能已經點過名";
		echo json_encode($arr);
		exit();
    }
}
mysql_close($link);

?>