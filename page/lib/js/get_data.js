
function getUserData(user_name,callback)
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "/ClubCloud/page/lib/get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            var user_data = get_json.data;

            callback(user_data);
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+user_name); 
}