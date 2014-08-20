<?php

	$objConnect = mysql_connect("localhost","root","sh3599033");
	$objDB = mysql_select_db("user_data");
	mysql_query ( "set character set utf8" );

	$user_name = $_POST["username"];
	$user_password = $_POST["password"];
	$device_token = $_POST["device_token"];
	$device_os = $_POST["device_os"];
	
	$query = sprintf("UPDATE `user_table` SET 
					`device_token` = '$device_token',
					`device_os` = '$device_os' 
					WHERE `username` = '$user_name';");

	$res = mysql_query($query,$objConnect);

	$select_action = "SELECT * FROM user_table WHERE username = '$user_name'  
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

		$arr["username"] = $objResult["username"];
		$arr["password"] = $objResult["password"];
		$arr["name"] = $objResult["name"];
		$arr["user_id"] = $objResult["user_id"];
		$arr["device_token"] = $objResult["device_token"];
		$arr["device_os"] = $objResult["device_os"];
		
		$arr["user_city"] = $objResult["user_city"];//territory_name
		$arr["user_city_detail"] = $objResult["user_city_detail"];//district_name
		$arr["city_id"] = $objResult["city_id"];//city_id
		$arr["city_detail_id"] = $objResult["city_detail_id"];//district_id
		
		echo json_encode($arr);
		exit();
	}
	
	mysql_close($objConnect);

/*	$strSQL = "SELECT * FROM treasure WHERE 1 
		AND StudentID = '$strStudentID'  
		AND Password = '$strPassword'  
		";

	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	$intNumRows = mysql_num_rows($objQuery);
	*/

	/*
	if($strStudentID == 'user1' && $strPassword == '123456')
	{
		$arr["Status"] = "1";
		$arr["MemberID"] = $strStudentID.".歡迎登入!";
		$arr["Message"] = "登入成功";
		
		echo json_encode($arr);
		exit();
	} 
	else 
	{
		$arr["Status"] = "0";
		$arr["MemberID"] = "0";
		$arr["Message"] = "帳號或密碼輸入錯誤";
		
		echo json_encode($arr);
		exit();
	}
	*/
	//mysql_close($objConnect);
	
?>
