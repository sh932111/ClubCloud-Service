<?php
	$objConnect = mysql_connect("localhost","root","sh3599033");
	$objDB = mysql_select_db("user_data");
	mysql_query ( "set character set utf8" );

	$user_name = $_POST["username"];
	$user_password = $_POST["password"];
	
	$select_action = "SELECT * FROM root_table WHERE username = '$user_name'  
		AND password = '$user_password'  
		";

	$objQuery = mysql_query($select_action);
	$objResult = mysql_fetch_array($objQuery);
	$intNumRows = mysql_num_rows($objQuery);
	
	if($intNumRows == 0)
	{

		$response_result = FALSE;
		$arr["result"] = $response_result;
		$arr["Message"] = "帳號或密碼輸入錯誤";
		
		echo json_encode($arr);
		exit();
	} 
	else 
	{
		$response_result = TRUE;
		$arr["result"] = $response_result;

		$arr["Message"] = "登入成功";

		$data["username"] = $objResult["username"];
		$data["password"] = $objResult["password"];
		$data["name"] = $objResult["name"];
		$data["user_id"] = $objResult["user_id"];
		
		$data["user_city"] = $objResult["user_city"];//territory_name
		$data["user_city_detail"] = $objResult["user_city_detail"];//district_name
		$data["city_id"] = $objResult["city_id"];//city_id
		$data["city_detail_id"] = $objResult["city_detail_id"];//district_id
		
		$data["address"] = $objResult["city_detail_id"];//district_id

		$arr["data"] = $data;
		
		echo json_encode($arr);
		exit();
	}
	
	mysql_close($objConnect);
?>
