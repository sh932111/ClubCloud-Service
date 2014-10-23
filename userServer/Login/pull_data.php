<?php

	$objConnect = mysql_connect("localhost","root","sh3599033");
	$objDB = mysql_select_db("user_data");
	mysql_query ( "set character set utf8" );

	$user_name = $_POST["username"];
	$send_time = $_POST["send_time"];
	$city_id = $_POST["city_id"];
	$area_id = $_POST["area_id"];

	$select_action = "SELECT * FROM user_table WHERE username = '$user_name'";

	$objQuery = mysql_query($select_action);
	$objResult = mysql_fetch_array($objQuery);
	$rows = mysql_num_rows($objQuery);
	
	if($rows == 0)
	{

		$response_result = FALSE;
		$arr["result"] = $response_result;
		$arr["Message"] = "未知錯誤";
		
		echo json_encode($arr);
		exit();
	} 
	else 
	{
		$response_result = TRUE;
		$arr["result"] = $response_result;

		$arr["Message"] = "登入成功";

		$old_time = $objResult["send_time"];
		
		$select_action = "SELECT * FROM calendar_table  WHERE city_id = '$city_id'  
		AND area_id = '$area_id'  ORDER BY CAST(time AS signed) DESC ";

		$select_res = mysql_query($select_action);
		
		$data = array();
		$list = array();

		$i = 0;
		$intNumRows = mysql_num_rows($select_res);

		while ($record = mysql_fetch_array($select_res)) 
		{
			$get_time = $record['send_time'];

			if (date('Y/m/d H:i:s', strtotime($get_time)) >= date('Y/m/d H:i:s', strtotime($old_time)) && date('Y/m/d H:i:s', strtotime($send_time)) >= date('Y/m/d H:i:s', strtotime($get_time))) 
			{
				$data["id"] = $record["id"];
				
				$data["name"] = $record["name"];
				$data["username"] = $record["username"];
				$data["title"] = $record["title"];
				$data["detail"] = $record["detail"];
				$data["date"] = $record["date"];
				
				$data["time"] = $record["time"];//territory_name
				$data["city"] = $record["city"];//district_name
				$data["area"] = $record["area"];//city_id
				$data["liner"] = $record["liner"];//district_id
				
				$data["address"] = $record["address"];//district_id
				$data["image"] = $record["image"];//district_id
			
				$data["address_city"] = $record["address_city"];//district_id
				$data["address_area"] = $record["address_area"];//district_id
				$data["get_time"] = $get_time;//district_id

				$list[$i] = $data;

				$i = $i + 1;
			}
		}
		$list["num"] = $i;

		$arr["data"] = $list;
		
		$query = sprintf("UPDATE `user_table` SET 
						`send_time` = '$send_time' 
						WHERE `username` = '$user_name';");
		$res = mysql_query($query,$objConnect);
		echo json_encode($arr);
		exit();
	}
	
	mysql_close($objConnect);

?>
