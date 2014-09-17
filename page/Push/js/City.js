
// var jsonObj;
// var detailJson;

var getCity;
var getCityDetail;
var getCityId;
var getCityDetailId;

var userData;

function init() 
{

	getData();

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

	            pushCalendar();
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

	            console.log(get_json);

	            //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
	        }
	    }
	    // Send the data to PHP now... and wait for response to update the status div

	    var div_title = document.getElementById('title').value;
	    var div_detail = document.getElementById('detail').value;
	    var div_time = document.getElementById('time').value;
	    var div_time_detail = document.getElementById('time_detail').value;

	    var post = "title="+div_title+"&detail="+div_detail+"&date="+div_time+"&time="+div_time_detail+"&city="+getCity+"&area="+getCityDetail+"&address="+"福利中心"+"&name="+userData.name+"&username="+userData.username+"&liner="+"某某里";

	    xmlhttp.send(post); 
}
