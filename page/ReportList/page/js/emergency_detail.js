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
                    for (var i = 0; i < responseData.data.num; i++) 
                    {
                        var obj = responseData.data[i];

                        var listView = document.getElementById('listView');

                        var boxDiv = document.createElement("div");

                        var nameDiv = document.createElement("div");

                        // nameDiv.className = 'list_user';
                        
                        nameDiv.innerHTML = obj.name;

                        nameDiv.style.top = i * 10 + 20+"%";

                        var idDiv = document.createElement("div");

                        // idDiv.className = 'list_user_id';
                        
                        idDiv.innerHTML = obj.user_id;
                        idDiv.style.top = i * 10 + 20+"%";

                        var latDiv = document.createElement("div");

                        // latDiv.className = 'list_latidute';
                        
                        latDiv.style.top = i * 10 + 20+"%";
                        latDiv.innerHTML = obj.latitude;

                        var longDiv = document.createElement("div");

                        // longDiv.className = 'list_longitude';
                        
                        longDiv.style.top = i * 10 + 20+"%";
                        longDiv.innerHTML = obj.longitude;

                        var checkDiv = document.createElement("div");

                        // checkDiv.className = 'list_check';
                        
                        checkDiv.style.top = i * 10 + 20+"%";
                        if (obj.t_check == 0)
                        {
                            checkDiv.innerHTML = "未回報";
                        }
                        else if (obj.t_check == 1)
                        {
                            checkDiv.innerHTML = "手機自行回報";
                        }
                        else if (obj.t_check == 2)
                        {
                            checkDiv.innerHTML = "使用者已回報";
                        }

                        listView.appendChild(nameDiv);
                        listView.appendChild(idDiv);
                        listView.appendChild(latDiv);
                        listView.appendChild(longDiv);
                        listView.appendChild(checkDiv);
                    }
                }
            }

        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "postId="+eventID;
    xmlhttp.send(post); 
}