<?php

	$objConnect = mysql_connect("localhost","root","sh3599033");
	$objDB = mysql_select_db("user_data");

	mysql_query ( "set character set utf8" );

	header('Content-Type: text/html; charset=utf-8');

	$post_id = $_POST["postId"];

	$select_action = "SELECT * FROM calendar_table WHERE data_id = '$post_id'";

	$objQuery = mysql_query($select_action);
	$objResult = mysql_fetch_array($objQuery);
	$intNumRows = mysql_num_rows($objQuery);
	
	if($intNumRows == 0)
	{

		$response_result = FALSE;
		$arr["result"] = $response_result;
		$arr["Message"] = "資料查詢錯誤";
		
		echo json_encode($arr);
		exit();
	} 
	else 
	{
		$response_result = TRUE;
		$arr["result"] = $response_result;

		$data["name"] = $objResult["name"];
		$data["username"] = $objResult["username"];
		$data["title"] = $objResult["title"];
		$data["detail"] = $objResult["detail"];
		$data["date"] = $objResult["date"];
		
		$data["time"] = $objResult["time"];//territory_name
		$data["city"] = $objResult["city"];//district_name
		$data["area"] = $objResult["area"];//city_id
		$data["liner"] = $objResult["liner"];//district_id
		
		$data["address"] = $objResult["address"];//district_id
		$data["image"] = $objResult["image"];//district_id
	
		$data["address_city"] = $objResult["address_city"];//district_id
		$data["address_area"] = $objResult["address_area"];//district_id
	
		$arr["data"] = $data;
		
		echo json_encode($arr);

		exit();
	}
	
	mysql_close($objConnect);

?>

