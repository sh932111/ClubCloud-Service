<?php
/*	$objConnect = mysql_connect("localhost","root","1234");
	$objDB = mysql_select_db("user");
	mysql_query ( "set character set utf8" );
*/
	header('Content-Type: text/html; charset=utf8');

	
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
	mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

	$name = $_POST["name"];//使用者名稱
	
	$username = $_POST["username"];//帳號
	
	$password = $_POST["password"];//密碼
	
	$user_id = $_POST["user_id"];//身分證

	$device_token = $_POST["device_token"];//推撥用的id
	
	$device_os = $_POST["device_os"];//iOS or Android

	$user_city = $_POST["user_city"];//territory_name

	$user_city_detail = $_POST["user_city_detail"];//district_name
	
	$city_id = $_POST["city_id"];//city_id
	
	$city_detail_id = $_POST["city_detail_id"];//district_id

//	mysql_query ( "set character set utf8" );
	//mysql_query("SET NAMES 'UTF8'");

	$link = mysql_connect('localhost','root','sh3599033');

	mysql_query("SET NAMES 'utf8'",$link);
	if (!$link) 
	{
		$arr["result"] = FALSE;
		$arr["Message"] = "errpr open db";
		echo json_encode($arr);
		exit();
	}

	$db_selected = mysql_select_db('user_data');

	if (!$db_selected)
 	{
		$arr["result"] = FALSE;
		$arr["Message"] = "error select db";
		echo json_encode($arr);
		exit();
	}

	if ($db_selected) 
	{
		$creat_query  ="CREATE TABLE `user_table`(
			`name` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
			`username` VARCHAR(20) NOT NULL PRIMARY KEY,
			`password` VARCHAR(20) NOT NULL,
			`user_id` VARCHAR(20) NOT NULL,
			`device_token` VARCHAR(200) NOT NULL,
			`device_os` VARCHAR(10) NOT NULL,
			`user_city` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
			`user_city_detail` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
			`city_id` VARCHAR(20) NOT NULL,
			`city_detail_id` VARCHAR(20) NOT NULL
			);";
		$table_selected = mysql_query($creat_query, $link);

		$query = sprintf("INSERT INTO `user_table`(`name`,`username`,`password`,`user_id`,`device_token`,`device_os`,`user_city`,`user_city_detail`,`city_id`,`city_detail_id`) 
			VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
			$name,$username,$password,$user_id,$device_token,$device_os,$user_city,$user_city_detail,$city_id,$city_detail_id);

			$res = mysql_query($query,$link);

			if (!$res) 
			{
				$arr["Message"] = '以有同樣帳戶';
				$arr["result"] = FALSE;
				echo json_encode($arr);
				exit();
			}
			else
			{
				$arr["Message"] = '新增會員成功！';
				$arr["result"] = true;
				echo json_encode($arr);
				exit();
			}
		
	}

	mysql_close($link);

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
