var userData;
var responseData;

function init()
{
    getUserData(userName,function(user_data) 
    {
        userData = user_data;
        getEvent();
    });
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

            responseData = get_json;

            if (get_json.result)
            {
                if (get_json.data.num != 0)
                {

                    var listView = document.getElementById('listView');

                    for (var i = 0; i < get_json.data.num; i++) 
                    {
                        var obj = get_json.data[i];

                        var trDiv = document.createElement("div");
                        
                        trDiv.className = "css_tr";

                        var titleDiv = document.createElement("div");
                        
                        titleDiv.className = "title_css_td";

                        titleDiv.innerHTML = "標題："+obj.title;

                        var dateDiv = document.createElement("div");

                        dateDiv.innerHTML = "日期："+obj.date;
                        
                        dateDiv.className = "date_css_td";

                        var timeDiv = document.createElement("div");

                        timeDiv.innerHTML = "時間："+obj.time;
                        
                        timeDiv.className = "time_css_td";

                        var listDiv = document.createElement("div");

                        listDiv.innerHTML = "內文："+obj.list;

                        var title_hr = document.createElement("hr");

                        var list_hr = document.createElement("hr");

                        trDiv.appendChild(titleDiv);
                        trDiv.appendChild(dateDiv);
                        trDiv.appendChild(timeDiv);
                        listView.appendChild(trDiv);
                        listView.appendChild(title_hr);
                        listView.appendChild(listDiv);
                        listView.appendChild(list_hr);
                    }
               }
           }
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "city_id="+userData.city_id+"&area_id="+userData.city_detail_id;

    xmlhttp.send(post); 
}