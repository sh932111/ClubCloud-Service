
var request_data;
var user_data;

var cityId;
var areaId;

var updateDiv = 0;

function init() 
{
	// var user_div = document.getElementById("username");

	// user_div.innerHTML = "帳號："+userName;

	getData();

    getRequestData();
}
function getData()
{
	var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "../lib/get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            user_data = get_json.data;

            cityId = user_data.city_id;
            areaId = user_data.city_detail_id;

            // var user_div = document.getElementById("user");
            
            // user_div.innerHTML = "管理人："+user_data.name;
        
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+userName); 
}
function getRequestData()
{
    var es = new EventSource('php/pull_request.php'); 

    es.onmessage = function(e) 
    {
        var get_json = JSON.parse(e.data);

        request_data = get_json;

        var num = get_json["num"];

        var list = document.getElementById("msg3");

        if (updateDiv != 0)
        {
            list.removeChild(updateDiv);
        }
        updateDiv = document.createElement("div");
        
        for (var i = 0; i < num; i++) 
        {
            var city_id  = get_json[i]["city_id"];            
            var area_id  = get_json[i]["area_id"];            
            
            if (city_id == cityId && area_id == areaId)
            {
                var name  = get_json[i]["name"];            
                var username  = get_json[i]["username"];            
                var title  = get_json[i]["title"];            
                var date  = get_json[i]["date"];            
                var time  = get_json[i]["time"];  

                var help_div = document.createElement("div");
                help_div.id = i;

                var div_name = document.createElement("div");
                div_name.className = "list";
                var node_name = document.createTextNode("發送者："+name+"("+username+")");
                div_name.appendChild(node_name);

                var hr = document.createElement("hr");
                hr.color = "#C4E1FF";

                var div_title = document.createElement("div");
                div_title.className = "title";
                var node_title = document.createTextNode("標題："+title);
                div_title.appendChild(node_title);
                                
                var div_date = document.createElement("div");
                div_date.className = "list";
                var node_date = document.createTextNode("時間："+date+" "+time);
                div_date.appendChild(node_date);
                            
                var p = document.createElement("p");

                help_div.appendChild(div_title);
                help_div.appendChild(hr);
                help_div.appendChild(div_name);
                help_div.appendChild(p);
                help_div.appendChild(div_date);
                help_div.addEventListener("click", function(e){
                    goPage(this);
                });
                updateDiv.appendChild(help_div);
                var hr = document.createElement("hr");
                hr.color = "#84C1FF";
                updateDiv.appendChild(hr);
            }
        }
        list.appendChild(updateDiv);
    };
        
}
function goPage(i)
{
    var index = i.id;

    var pull_id = request_data[index]["id"];

    location.href = 'get_request_detail.php?username='+userName+'&post_id='+pull_id+'&class='+"1";

}