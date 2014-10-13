
var jsonObj;
var detailJson;

var getCity;
var getCityDetail;
var getCityId;
var getCityDetailId;

var userData;

//image
var ImageCheck = 0;

//id
var ID;


var addressCity;
var addressCityDetail;
var addressCityId;
var addressCityDetailId;

function init() 
{
	getData();
	getAddress();
}

function getData()
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "../lib/get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            var user_data = get_json.data;

            userData = user_data;
            //var user_div = document.getElementById("user");
            var city_div = document.getElementById("city");
            var city_detail_div = document.getElementById("city_detail");

			city_div.innerHTML = "市："+user_data.user_city;
			city_detail_div.innerHTML = "區："+user_data.user_city_detail;

			getCity = user_data.user_city;
			getCityDetail = user_data.user_city_detail;
			getCityId = user_data.city_id;
			getCityDetailId = user_data.city_detail_id;

        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+userName); 
}

function pushData()
{
	var xmlhttp = new XMLHttpRequest();
	    
	    xmlhttp.open("POST", "push/delegate.php", true);
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xmlhttp.onreadystatechange = function() 
	    {
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	        {

	            var return_data = xmlhttp.responseText;

				console.log(return_data);

				pushCalendar();
	            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
	        }
	    }
	    // Send the data to PHP now... and wait for response to update the status div

	    var div_title = document.getElementById('title').value;
	    var div_detail = document.getElementById('detail').value;
	    var div_time = document.getElementById('time').value;
	    var div_time_detail = document.getElementById('time_detail').value;
	    var address = document.getElementById('address').value;

		var myDate = new Date(div_time);

		var d = (myDate.getMonth() + 1);

	   	if (d < 10) 
	   	{
	   		d = "0"+d;
	   	}

		var m = myDate.getDate();

	   	if (m < 10) 
	   	{
	   		m = "0"+m;
	   	}

		var day =  myDate.getFullYear()+ "/" + d + "/" + m ;

	    var post = "id="+ID+"&title="+div_title+"&detail="+div_detail+"&time="+day+"&time_detail="+div_time_detail+"&city="+getCity+"&city_detail="+getCityDetail+"&city_id="+getCityId+"&city_detail_id="+getCityDetailId+"&image="+ImageCheck+"&type="+"1"+"&address="+address;

	    xmlhttp.send(post); 
}

function pushCalendar()
{
	var xmlhttp = new XMLHttpRequest();
	    
	    xmlhttp.open("POST", "../Calender/php/push_calendar.php", true);
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xmlhttp.onreadystatechange = function() 
	    {
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	        {

	            var return_data = xmlhttp.responseText;

            	var get_json = JSON.parse(return_data);

	            if (get_json.result) 
	            {
	            	 alert("推送成功");
	            	 
                    history.go(-1);
	            }
	            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
	        }
	    }
	    // Send the data to PHP now... and wait for response to update the status div

	    var div_title = document.getElementById('title').value;
	    var div_detail = document.getElementById('detail').value;
	    var div_time = document.getElementById('time').value;
	    var div_time_detail = document.getElementById('time_detail').value;
	   	var item = document.getElementById('item').value;

	   	var myDate = new Date(div_time);

	   	var d = (myDate.getMonth() + 1);

	   	if (d < 10) 
	   	{
	   		d = "0"+d;
	   	}

		var m = myDate.getDate();

	   	if (m < 10) 
	   	{
	   		m = "0"+m;
	   	}

		var day =  myDate.getFullYear()+ "/" + d + "/" + m ;

	    var post = "id="+item+"&title="+div_title+"&detail="+div_detail+"&date="+day+"&time="+div_time_detail+"&city="+getCity+"&area="+getCityDetail+"&address="+"福利中心"+"&name="+userData.name+"&username="+userData.username+"&liner="+"某某里"+"&image="+ ImageCheck+"&city_id="+getCityId+"&area_id="+ getCityDetailId;

	    xmlhttp.send(post); 

}
function getAddress() 
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "data/GetCityData.php", true);
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
					addressCity = city;
					addressCityId = city_id;
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

	addressCity = get_city;

	var get_city_id = jsonObj[index.selectedIndex].city_id;

	addressCityId = get_city_id;

	loaddata(get_city);
}

function loaddata(get_city)
{

	var xmlhttp = new XMLHttpRequest();
	    
	xmlhttp.open("POST", "data/GetCityDetail.php", true);
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
					addressCityDetail = district_name;
					addressCityDetailId = district_id;
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

	addressCityDetail = detailJson[index.selectedIndex].district_name;
	addressCityDetailId = detailJson[index.selectedIndex].district_id;

}
