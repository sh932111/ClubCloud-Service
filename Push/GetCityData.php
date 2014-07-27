<?php
	
	$db = sqlite_open('city');

	if ($db) 
	{
		$query = "SELECT * FROM city_table;";

		$result = sqlite_query($db ,$query,SQLITE_ASSOC ,$msg);

		if (!$result) 
		{
			echo 'error:'.$msg;
			exit();
		}
		else
		{
			while ($row = sqlite_fetch_array($result,SQLITE_ASSOC)) 
			{
				foreach ($row as $record) 
				{
					echo $record . "<br>";	
				}
			}
		}
	}
	else
	{
		echo 'error:開啟失敗';
	}

?>
