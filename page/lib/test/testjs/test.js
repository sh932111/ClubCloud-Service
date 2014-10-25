function post() 
{

	var hr = new XMLHttpRequest();

	var url = "../../../userServer/Register/gcm_register.php";
	
	var vars = "regId="+"20141007180328"+"&username="+"790393564314510";

	hr.open("POST", url, true);

	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	hr.onreadystatechange = function() 
	{

		if(hr.readyState == 4 && hr.status == 200) 
		{
			var return_data = hr.responseText;

			var jsonObj = JSON.parse(return_data);

			console.log(jsonObj);
			//alert(jsonObj.Message);
		}
	}

	console.log(vars);

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
    
    xmlhttp.open("POST", "Push/data/GetCityData.php", true);
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
    
    xmlhttp.open("POST", "Push/data/GetCityAll.php", true);
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
