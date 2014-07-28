<?php

	$data = array();
	$list =  array();
	$i = 0;

	try
	{
		$db_conn = new PDO('sqlite:city.db');
	}
	catch(PDOException $e)
	{
		echo 'Error';
	}
	$sth = $db_conn->prepare("SELECT * FROM city_table");

	$sth->execute();

	while($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$data["territory_name"] = $row['territory_name'];
		$data["city_id"] = $row['city_id'];

		$list[$i] = $data;
		//$list[$i] = $data;

		$i = $i + 1;
	}
	//$list["num"] = $i;

	echo json_encode($list);

	exit();


	// $stmt = "CREATE TABLE mytable(id, user)";

	// $db_conn->exec($stmt);

	// $db = sqlite_open('city');

	// if ($db) 
	// {
	// 	$query = "SELECT * FROM city_table;";

	// 	$result = sqlite_query($db ,$query,SQLITE_ASSOC ,$msg);

	// 	if (!$result) 
	// 	{
	// 		echo 'error:'.$msg;
	// 		exit();
	// 	}
	// 	else
	// 	{
	// 		while ($row = sqlite_fetch_array($result,SQLITE_ASSOC)) 
	// 		{
	// 			foreach ($row as $record) 
	// 			{
	// 				echo $record . "<br>";	
	// 			}
	// 		}
	// 	}
	// }
	// else
	// {
	// 	echo 'error:開啟失敗';
	// }

?>
