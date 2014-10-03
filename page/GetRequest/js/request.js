
var request_data;

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
    
    xmlhttp.open("POST", "../get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            var user_data = get_json.data;


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

        var result = "<table border='1'>";

        result += "<tr><td>發送人</td><td>帳號</td><td>標題</td><td>日期</td><td>時間</td><td>前往</td></tr>";

        for (var i = 0; i < num; i++) 
        {
            var name  = get_json[i]["name"];            
            var username  = get_json[i]["username"];            
            var title  = get_json[i]["title"];            
            var date  = get_json[i]["date"];            
            var time  = get_json[i]["time"];            
                
            result += "<tr><td>" + name + "</td><td>" + username + "</td><td>" + title + "</td><td>" + date + "</td><td>"+ time  + "</td><td><button onclick='goPage(this)' id="+i+">go</button></td></tr>";
        }
        result += "</table>";

        list.innerHTML = result;
    };
        
}
function goPage(i)
{
    var index = i.id;

    var pull_id = request_data[index]["id"];

    location.href = 'get_request_detail.php?username='+userName+'&post_id='+pull_id+'&class='+"1";

}