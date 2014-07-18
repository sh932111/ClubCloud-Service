<?php

	$objConnect = mysql_connect("localhost","root","sh3599033");
	$objDB = mysql_select_db("user_data");
	mysql_query ( "set character set utf8" );

	$user_name = $_POST["user_name"];
	$user_password = $_POST["user_password"];
	
	$select_action = "SELECT * FROM user_table WHERE user_name = '$user_name'  
		AND user_password = '$user_password'  
		";

	$objQuery = mysql_query($select_action);
	$objResult = mysql_fetch_array($objQuery);
	$intNumRows = mysql_num_rows($objQuery);
	
	if($intNumRows == 0)
	{

		$response_result = FALSE;
		$arr["result"] = $response_result;
		$arr["errorMessage"] = "帳號或密碼輸入錯誤";
		
		echo json_encode($arr);
		exit();
	} 
	else 
	{
		$response_result = TRUE;
		$arr["result"] = $response_result;
		$arr["user_name"] = $user_name;
		$arr["user_password"] = $user_password;
		$arr["name"] = $objResult["name"];
		$arr["job"] = $objResult["job"];
		$arr["Message"] = "登入成功";

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
