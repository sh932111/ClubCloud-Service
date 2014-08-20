<?php

	$data = array();
	
	$list =  array();

	$i = 0;

	try
	{
		$db_conn = new PDO('sqlite:res/city.db');
	}
	catch(PDOException $e)
	{
		echo 'Error';
	}
	$sth = $db_conn->prepare("SELECT * FROM city_detail_table");

	$sth->execute();

	while($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$data["district_name"] = $row['district_name'];
		$data["district_id"] = $row['district_id'];
		$data["territory_name"] = $row['territory_name'];

		$list[$i] = $data;
			//$list[$i] = $data;

		$i = $i + 1;
	}
	//$list["num"] = $i;

	echo json_encode($list);

	exit();

?>
