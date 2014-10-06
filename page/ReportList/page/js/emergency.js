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

            if (get_json.result)
            {
                if (get_json.data.num != 0)
                {
                    for (var i = 0; i < get_json.data.num; i++) 
                    {
                        var obj = get_json.data[i];

                        var listView = document.getElementById('listView');

                        var nameDiv = document.createElement("div");
                        
                        nameDiv.id="nameDiv";

                        nameDiv.innerHTML = "標題："+obj.title;
                        
                        var oneDiv = document.createElement("div");

                        oneDiv.id="oneDiv";

                        var titleDiv = document.createElement("div");

                        titleDiv.innerHTML = "日期："+obj.date+"&nbsp;&nbsp;&nbsp;時間：" +obj.time;
                            
                        var listDiv = document.createElement("div");

                        listDiv.innerHTML = obj.list;
                        listDiv.id="listDiv";

                        var bt = document.createElement("button");

                        oneDiv.appendChild(titleDiv);

                        listView.appendChild(nameDiv);
                        listView.appendChild(oneDiv);
                        listView.appendChild(listDiv);
                        listView.appendChild(bt);

                        var hr = document.createElement("hr");
                        listView.appendChild(hr);
                    }
               }
           }
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "city_id="+userData.city_id+"&area_id="+userData.city_detail_id;

    xmlhttp.send(post); 
}