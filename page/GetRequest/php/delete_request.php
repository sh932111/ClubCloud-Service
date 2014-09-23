<?php

header("Content-Type: text/event-stream"); 

$id = $_POST["id"];

//unlink("../../../userServer/Request/request_img/" .$id .".png");

$link = mysql_connect('localhost','root','sh3599033');

if (!$link) 
{
	$arr["Result"] = FALSE;
	$arr["Message"] = "errpr open db";
	echo json_encode($arr);
	exit();
}

$db_selected = mysql_select_db('user_data');

if (!$db_selected)
{
	$arr["Result"] = FALSE;
	$arr["Message"] = "errpr select db";
	echo json_encode($arr);
	exit();
}
else
{
	$sql = "DELETE FROM user_request WHERE id = '$id'";

	$objResult = mysql_query($sql, $link);

	if ($objResult) 
	{
		$arr["Result"] = TRUE;
		$arr["Message"] = "刪除成功";
		echo json_encode($arr);
		exit();
	}
	else
	{
		$arr["Result"] = FALSE;
		$arr["Message"] = "刪除失敗";
		echo json_encode($arr);
		exit();
	}
}

?>