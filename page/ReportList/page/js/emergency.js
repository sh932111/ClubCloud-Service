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

                        var nameDiv = document.createElement("div");
                        
                        nameDiv.className = "css_td";

                        nameDiv.innerHTML = "標題："+obj.title;
                        
                        var oneDiv = document.createElement("div");

                        var titleDiv = document.createElement("div");

                        titleDiv.innerHTML = "日期："+obj.date+"&nbsp;&nbsp;&nbsp;時間：" +obj.time;
                        
                        titleDiv.className = "css_td";

                        var listDiv = document.createElement("div");

                        listDiv.innerHTML = obj.list;

                        listDiv.className = "css_td";

                        oneDiv.appendChild(titleDiv);

                        trDiv.appendChild(nameDiv);
                        trDiv.appendChild(oneDiv);
                        trDiv.appendChild(listDiv);
                        listView.appendChild(trDiv);
                    }
               }
           }
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "city_id="+userData.city_id+"&area_id="+userData.city_detail_id;

    xmlhttp.send(post); 
}