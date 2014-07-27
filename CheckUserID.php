<?php
		
	function checkID($user_id)
	{
		$objConnect = mysql_connect("localhost","root","sh3599033");
		$objDB = mysql_select_db("user_data");
		mysql_query ( "set character set utf8" );

		$creat_query  ="CREATE TABLE `user_table`(
			`name` VARCHAR(20) NOT NULL,
			`username` VARCHAR(20) NOT NULL PRIMARY KEY,
			`password` VARCHAR(20) NOT NULL,
			`user_id` VARCHAR(20) NOT NULL,
			`device_token` VARCHAR(200) NOT NULL,
			`device_os` VARCHAR(10) NOT NULL,
			`user_city` VARCHAR(20) NOT NULL,
			`user_city_detail` VARCHAR(20) NOT NULL
			);";
		$table_selected = mysql_query($creat_query, $objConnect);

		$select_action = "SELECT * FROM user_table WHERE user_id = '$user_id' ";

		$objQuery = mysql_query($select_action);

		$intNumRows = mysql_num_rows($objQuery);

		if ($intNumRows == 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

?>
