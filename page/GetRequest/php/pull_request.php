<?php  

header("Content-Type: text/event-stream"); 

$link = mysql_connect('localhost','root','sh3599033');

mysql_query("SET NAMES 'UTF8'",$link);

$city_id = $_POST["city_id"];
$area_id = $_POST["area_id"];

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

	$select_action = "SELECT * FROM user_request WHERE city_id = '$city_id'  
		AND area_id = '$area_id' ORDER BY CAST(time AS signed) DESC
	";

	$select_res = mysql_query($select_action);
	
	$data = array();
	$list = array();

	$i = 0;
	$intNumRows = mysql_num_rows($select_res);

	$list["num"] = $intNumRows;

	while ($record = mysql_fetch_array($select_res)) 
	{
		$id = $record['id'];
		$name = $record['name'];
		$username = $record['username'];
		$title = $record['title'];
		$detail = $record['detail'];
		$date = $record['date'];
		$time = $record['time'];
		$city = $record['city'];
		$area = $record['area'];
		$liner = $record['liner'];
		$address = $record['address'];

		$data["id"] = $id;
		$data["name"] = $name;
		$data["username"] = $username;
		$data["title"] = $title;
		$data["detail"] = $detail;
		$data["date"] = $date;
		$data["time"] = $time;
		$data["city"] = $city;
		$data["area"] = $area;
		$data["liner"] = $liner;
		$data["address"] = $address;

		$list[$i] = $data;

		$i = $i + 1;
	}

	//$arr["data"] = $list;
		
	echo 'data: ' . json_encode($list) . "\n\n";
		
	flush(); 
	//echo json_encode($arr);
	
	//json_encode($list);

		//echo 'data: ' . json_encode($arr) . "\n\n";


}

?>  