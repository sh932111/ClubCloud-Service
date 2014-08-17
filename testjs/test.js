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

function init()
{
	callCity();
}

function setValue(index)
{
	var get_city = index.selectedIndex;

	if (get_city == 0)
	{
		callCity();
	}
	else
	{
		callArea();
	}
}

function callCity()
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "http://localhost/ClubCloud/Push/GetCityData.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            jsonObj = JSON.parse(return_data);

            var list = document.getElementById("msg3");

            var result = "<table border='1'>";
	
			result += "<tr><td>territory_name</td><td>city_id</td></tr>";

            for (var i = 0; i < jsonObj.length; i++) 
            {

            	var city = jsonObj[i].territory_name;
            	var city_id = jsonObj[i].city_id;
				
				result += "<tr><td>" + city + "</td><td>" + city_id + "</td></tr>";
            }
			result += "</table>";

			list.innerHTML = result;
            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send(); 
}

function callArea()
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "http://localhost/ClubCloud/Push/GetCityAll.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            jsonObj = JSON.parse(return_data);

            var list = document.getElementById("msg3");

            var result = "<table border='1'>";
	
			result += "<tr><td>territory_name</td><td>district_name</td><td>district_id</td></tr>";

            for (var i = 0; i < jsonObj.length; i++) 
            {

            	var territory_name = jsonObj[i].territory_name;
            	var district_name = jsonObj[i].district_name;
            	var district_id = jsonObj[i].district_id;
				
				result += "<tr><td>" + territory_name + "</td><td>" + district_name + "</td><td>" + district_id + "</td></tr>";
            }
			result += "</table>";

			list.innerHTML = result;
            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send(); 
}
