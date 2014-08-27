var jsonObj;
var detailJson;

var getCity;
var getCityDetail;
var getCityId;
var getCityDetailId;

function init() 
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "../Push/data/GetCityData.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            jsonObj = JSON.parse(return_data);

            for (var i = 0; i < jsonObj.length; i++) 
            {

            	var city = jsonObj[i].territory_name;
            	var city_id = jsonObj[i].city_id;

				var items = new Option(city);

				if (i == 0) 
				{
					getCity = city;
					getCityId = city_id;
				}

			    document.getElementById('citylist').options.add(items);

            }
			var city = jsonObj[0].territory_name;
            loaddata(city);
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send(); 

}

function setValue(index)
{
	var get_city = jsonObj[index.selectedIndex].territory_name;

	getCity = get_city;

	var get_city_id = jsonObj[index.selectedIndex].city_id;

	getCityId = get_city_id;

	loaddata(get_city);
}

function loaddata(get_city)
{

	var xmlhttp = new XMLHttpRequest();
	    
	xmlhttp.open("POST", "../Push/data/GetCityDetail.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
	{
	    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	    {
		    var return_data = xmlhttp.responseText;

            detailJson = JSON.parse(return_data);
            document.getElementById('citydetaillist').options.length = 0;

            for (var i = 0; i < detailJson.length; i++) 
            {
            	var district_name = detailJson[i].district_name;
            	var district_id = detailJson[i].district_id;

				var items = new Option(district_name);

				if (i == 0) 
				{
					getCityDetail = district_name;
					getCityDetailId = district_id;
				}

				document.getElementById('citydetaillist').options.add(items);
	        }
	    }
	}
	// Send the data to PHP now... and wait for response to update the status div
	xmlhttp.send("territory_name="+get_city); 
}

function getDetailValue(index)
{

	getCityDetail = detailJson[index.selectedIndex].district_name;
	getCityDetailId = detailJson[index.selectedIndex].district_id;

}


function post()
{
    var name = document.getElementById('name').value;

    if (name == "") 
	{
		alert("請輸入您的名字");
		return;
	}
    var username = document.getElementById('username').value;
    if (username == "") 
	{
		alert("請輸入您的帳號");
		return;
	}
    var password = document.getElementById('password').value;
	if (password == "") 
	{
		alert("請輸入您的密碼");
		return;
	}
    var password2 = document.getElementById('password2').value;
    if (password2 == "") 
	{
		alert("請再次輸入您的密碼");
		return;
	}
	if (password2 != password)
	{
		alert("兩次密碼輸入不一樣");
		return;
	}
    var user_id = document.getElementById('user_id').value;
    if ( user_id == "") 
	{
		alert("請輸入您的身分證");
		return;
	}
    var address = document.getElementById('address').value;
	if ( address == "") 
	{
		alert("請輸入您的地址");
		return;
	}

	var xmlhttp = new XMLHttpRequest();
	    
	xmlhttp.open("POST", "php/Register.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;
            
            var msg = JSON.parse(return_data);

			alert(msg.Message);

			if (msg.result)
			{
				location.href = "../home.php";
			}
        }
    }
    var post = "name="+name+"&username="+username+"&password="+password+"&user_id="+user_id+"&address="+address+"&city="+getCity+"&city_detail="+getCityDetail+"&city_id="+getCityId+"&city_detail_id="+getCityDetailId;

    xmlhttp.send(post); 
}