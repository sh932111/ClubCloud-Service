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
                        trDiv.id = i;
                        trDiv.addEventListener("click", function(e){
                            goPage(this);
                        });

                        var titleDiv = document.createElement("div");
                        
                        titleDiv.className = "title_css_td";

                        titleDiv.innerHTML = obj.title;

                        var dateDiv = document.createElement("div");

                        dateDiv.innerHTML = obj.date;
                        
                        dateDiv.className = "date_css_td";

                        var timeDiv = document.createElement("div");

                        timeDiv.innerHTML = obj.time;
                        
                        timeDiv.className = "time_css_td";

                        var listDiv = document.createElement("div");

                        listDiv.innerHTML = obj.list;

                        listDiv.className = "list_css_td";

                        trDiv.appendChild(titleDiv);
                        trDiv.appendChild(listDiv);
                        trDiv.appendChild(dateDiv);
                        trDiv.appendChild(timeDiv);
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
function goPage(i)
{
    var index = i.id;

    var pull_id = responseData.data[index];

    console.log(pull_id);
//    location.href = 'emergency_detail.php?username='+userName+'&id='+pull_id;

}