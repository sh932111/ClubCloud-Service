<?php
header('Content-Type: text/html; charset=utf8');

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$link = mysql_connect('localhost','root','sh3599033');
mysql_query("SET NAMES 'utf8'",$link);
if (!$link) 
{
	$arr["result"] = FALSE;
	$arr["Message"] = "初始化失敗";
	echo json_encode($arr);
	exit();
}
$sql = 'CREATE DATABASE UserCategory';

if (mysql_query($sql, $link)) 
{
	$db_selected = mysql_select_db('UserCategory');
	
	if (!$db_selected)
 	{
		$arr["result"] = FALSE;
		$arr["Message"] = "初始化失敗";
		echo json_encode($arr);
		exit();
	}
	else
	{
		$creat_query  ="CREATE TABLE `data_table`(
			`title` VARCHAR(20)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
			`id` VARCHAR(200) NOT NULL PRIMARY KEY,
			`list` VARCHAR(200)CHARACTER SET utf8 COLLATE utf8_unicode_ci  NOT NULL,
			`date` VARCHAR(20) NOT NULL,
			`time` VARCHAR(20) NOT NULL
			);";

		$table_selected = mysql_query($creat_query, $link);
		
		if ($table_selected) 
		{
			$arr["Message"] = '目前尚無資料!';
			$arr["result"] = TRUE;
			echo json_encode($arr);
			exit();
		}
		else
		{
			$arr["Message"] = '初始化失敗';
			$arr["result"] = FALSE;
			echo json_encode($arr);
			exit();
		}
	}
} 
else 
{
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
		$select_action = "SELECT * FROM data_table  ORDER BY CAST(time AS signed) DESC";

		$select_res = mysql_query($data_table);
		$data = array();
		$list = array();

		$i = 0;
		$intNumRows = mysql_num_rows($select_res);

		while ($record = mysql_fetch_array($select_res)) 
		{
			$id = $record['id'];
			$title = $record['title'];
			$detail = $record['list'];
			$date = $record['date'];
			$time = $record['time'];
			
			$data["id"] = $id;
			$data["title"] = $title;
			$data["list"] = $detail;
			$data["date"] = $date;
			$data["time"] = $time;
			
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
}

?>