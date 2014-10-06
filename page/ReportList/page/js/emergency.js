var userData;

function init()
{
	getData();
}
function getData()
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "../../lib/get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            userData = get_json.data;

        	getEvent();
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+userName); 
}
function getEvent() 
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "php/pullevent.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            var response = get_json.data;

            console.log(response);
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("city_id="+userData.city_id+"&area_id"+userData.city_detail_id); 

}