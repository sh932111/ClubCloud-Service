
// var jsonObj;
// var detailJson;

var getCity;
var getCityDetail;
var getCityId;
var getCityDetailId;

function init() 
{
	var user_div = document.getElementById("username");

	user_div.innerHTML = "帳號："+userName;

	getData();

	// var xmlhttp = new XMLHttpRequest();
    
 //    xmlhttp.open("POST", "data/GetCityData.php", true);
 //    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	// xmlhttp.onreadystatechange = function() 
 //    {
 //        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
 //        {
 //            var return_data = xmlhttp.responseText;

 //            jsonObj = JSON.parse(return_data);

 //            for (var i = 0; i < jsonObj.length; i++) 
 //            {

 //            	var city = jsonObj[i].territory_name;
 //            	var city_id = jsonObj[i].city_id;

	// 			var items = new Option(city);

	// 			if (i == 0) 
	// 			{
	// 				getCity = city;
	// 				getCityId = city_id;
	// 			}

	// 		    document.getElementById('citylist').options.add(items);

 //            }
	// 		var city = jsonObj[0].territory_name;
	// 		//var city_id = jsonObj[0].city_id;
 //            loaddata(city);
 //            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
 //        }
 //    }
 //    // Send the data to PHP now... and wait for response to update the status div
 //    xmlhttp.send(); 

}

function getData()
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "../get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            var user_data = get_json.data;

            var user_div = document.getElementById("user");
            var city_div = document.getElementById("city");
            var city_detail_div = document.getElementById("city_detail");

			user_div.innerHTML = "管理人："+user_data.name;
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

// function setValue(index)
// {
// 	var get_city = jsonObj[index.selectedIndex].territory_name;

// 	getCity = get_city;

// 	var get_city_id = jsonObj[index.selectedIndex].city_id;

// 	getCityId = get_city_id;

// 	loaddata(get_city);
// }

// function loaddata(get_city)
// {

// 	var xmlhttp = new XMLHttpRequest();
	    
// 	    xmlhttp.open("POST", "data/GetCityDetail.php", true);
// 	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

// 		xmlhttp.onreadystatechange = function() 
// 	    {
// 	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
// 	        {

// 	            var return_data = xmlhttp.responseText;

// 	            detailJson = JSON.parse(return_data);


// 	            document.getElementById('citydetaillist').options.length = 0;

// 	            for (var i = 0; i < detailJson.length; i++) 
// 	            {

// 	            	var district_name = detailJson[i].district_name;
// 	            	var district_id = detailJson[i].district_id;

// 					var items = new Option(district_name);

// 					if (i == 0) 
// 					{
// 						getCityDetail = district_name;
// 						getCityDetailId = district_id;
// 					}

// 				    document.getElementById('citydetaillist').options.add(items);

// 	            }

// 	            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
// 	        }
// 	    }
// 	    // Send the data to PHP now... and wait for response to update the status div
// 	    xmlhttp.send("territory_name="+get_city); 
// }

// function getDetailValue(index)
// {

// 	getCityDetail = detailJson[index.selectedIndex].district_name;
// 	getCityDetailId = detailJson[index.selectedIndex].district_id;

// }

function send()
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

	            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
	        }
	    }
	    // Send the data to PHP now... and wait for response to update the status div

	    var div_title = document.getElementById('title').value;
	    var div_detail = document.getElementById('detail').value;
	    var div_time = document.getElementById('time').value;
	    var div_time_detail = document.getElementById('time_detail').value;

	    var post = "title="+div_title+"&detail="+div_detail+"&time="+div_time+"&time_detail="+div_time_detail+"&city="+getCity+"&city_detail="+getCityDetail+"&city_id="+getCityId+"&city_detail_id="+getCityDetailId;

	    xmlhttp.send(post); 
}

