var userData;
var responseData;

function init()
{
	getData();
    getDetail();
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
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+userName); 
}
function getDetail() 
{
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "php/pull_event_detail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            responseData = JSON.parse(return_data);

            console.log(responseData.data);

            if (responseData.result)
            {
                if (responseData.data.num != 0)
                {

                    var listView = document.getElementById('listView');

                    var result = "<table border='1'>";

                    result += "<tr><td>使用者</td><td>身分證字號</td><td>Latitude</td><td>Longitude</td><td>回報狀況</td></tr>";

                    for (var i = 0; i < responseData.data.num; i++) 
                    {
                        var obj = responseData.data[i];

                        var status = "";

                        if (obj.t_check == 0)
                        {
                            status = "未回報";
                        }
                        else if (obj.t_check == 1)
                        {
                            status = "手機自行回報";
                        }
                        else if (obj.t_check == 2)
                        {
                            status = "使用者已回報";
                        }

                        result += "<tr><td>" + obj.name + "</td><td>" + obj.user_id + "</td><td>" + obj.latitude + "</td><td>" + obj.longitude + "</td><td>"+ status  + "</td></tr>";
            
                    }
                    result += "</table>";

                    listView.innerHTML = result;
                }
            }

        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "postId="+eventID;
    xmlhttp.send(post); 
}