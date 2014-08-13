function post() 
{
	var hr = new XMLHttpRequest();

	var url = "http://localhost/ClubCloud/Request/Request.php";

	var vars = "name="+"YoGa"+"&username="+"sh932111"+"&title="+"hello"+"&detail="+"messagetest"+"&date="+"2014/09/29"+"&time="+"19:00"+"&city="+"高雄市"+"&area="+"三民區"+"&liner="+"鼎盛里"+"&address="+"鼎富路46號4F";

	hr.open("POST", url, true);

	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	hr.onreadystatechange = function() 
	{

		if(hr.readyState == 4 && hr.status == 200) 
		{
			var return_data = hr.responseText;

			var jsonObj = JSON.parse(return_data);

			console.log(jsonObj);

			if (jsonObj.Result) 
			{
				alert("新增成功");
			}
			else
			{
				alert("新增失敗");
			}
		}
	}

	hr.send(vars);
}