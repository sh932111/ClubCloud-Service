<?php
/*	$objConnect = mysql_connect("localhost","root","1234");
	$objDB = mysql_select_db("user");
	mysql_query ( "set character set utf8" );
*/

	$name = $_POST["name"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$user_id = $_POST["user_id"];

	$link = mysql_connect('localhost','root','sh3599033');

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
		$arr["Message"] = "errpr select db";
		echo json_encode($arr);
		exit();
	}

	if ($db_selected) 
	{
		$creat_query  ="CREATE TABLE `user_table`(
			`name` VARCHAR(20) NOT NULL,
			`username` VARCHAR(20) NOT NULL,
			`password` VARCHAR(20) NOT NULL,
			`user_id` VARCHAR(20) NOT NULL
			);";
		$table_selected = mysql_query($creat_query, $link);

		$query = sprintf("INSERT INTO `user_table`(`name`,`username`,`password`,`user_id`) 
			VALUES ('%s','%s','%s','%s')",
			$name,$username,$password,$user_id);

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
