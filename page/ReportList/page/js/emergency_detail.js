var userData;
var responseData;
var selected_value;
function init()
{
    selected_value = 1;

    getUserData(userName,function(user_data) 
    {
        userData = user_data;
    });
    
    getRequestData();
}

function setValue(e)
{
    selected_value = e.value;
    //getDetail();
    setUI();
}

function getRequestData()
{
    var es = new EventSource('php/pull_request.php'); 

    es.onmessage = function(e) 
    {
        var get_json = JSON.parse(e.data);

        getDetail();
    };

}

function setUI() 
{
    if (responseData.result)
    {
        if (responseData.data.num != 0)
        {

            var listView = document.getElementById('listView');

            var result = "<div class='up_css_tr'><div class='up_css_td'>使用者</div><div class='up_css_td'>身分證字號</div><div class='up_css_td'>聯絡電話</div><div class='up_css_td'>Latitude</div><div class='up_css_td'>Longitude</div><div class='up_css_td'>回報狀況</div><div class='up_css_td'>位置查詢</div></div>";

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
                    status = "使用者平安回報";
                }

                else if (obj.t_check == 3)
                {
                    status = "使用者需立刻需救援";
                }

                if (selected_value == 1)
                {
                    result += "<div class='css_tr'><div class='css_td'>" + obj.name + "</div><div class='css_td'>" + obj.user_id + "</div><div class='css_td'>" + obj.cellphone + "</div><div class='css_td'>" + obj.latitude + "</div><div class='css_td'>" + obj.longitude + "</div><div class='css_td'>"+ status  + "</div><div class='css_td'><button onclick='goPage(this)' id="+i+">位置</button></div></div>";
                }
                else if (selected_value == 2)
                {
                    if (obj.t_check == 0)
                    {
                    result += "<div class='css_tr'><div class='css_td'>" + obj.name + "</div><div class='css_td'>" + obj.user_id + "</div><div class='css_td'>" + obj.cellphone + "</div><div class='css_td'>" + obj.latitude + "</div><div class='css_td'>" + obj.longitude + "</div><div class='css_td'>"+ status  + "</div><div class='css_td'><button onclick='goPage(this)' id="+i+">位置</button></div></div>";
                    }
                }
                else if (selected_value == 3)
                {
                    if (obj.t_check == 1)
                    {
                    result += "<div class='css_tr'><div class='css_td'>" + obj.name + "</div><div class='css_td'>" + obj.user_id + "</div><div class='css_td'>" + obj.cellphone + "</div><div class='css_td'>" + obj.latitude + "</div><div class='css_td'>" + obj.longitude + "</div><div class='css_td'>"+ status  + "</div><div class='css_td'><button onclick='goPage(this)' id="+i+">位置</button></div></div>";
                    }
                }
                else if (selected_value == 4)
                {
                    if (obj.t_check == 2)
                    {
                    result += "<div class='css_tr'><div class='css_td'>" + obj.name + "</div><div class='css_td'>" + obj.user_id + "</div><div class='css_td'>" + obj.cellphone + "</div><div class='css_td'>" + obj.latitude + "</div><div class='css_td'>" + obj.longitude + "</div><div class='css_td'>"+ status  + "</div><div class='css_td'><button onclick='goPage(this)' id="+i+">位置</button></div></div>";
                    }
                }
                else if (selected_value == 5)
                {
                    if (obj.t_check == 3)
                    {
                    result += "<div class='css_tr'><div class='css_td'>" + obj.name + "</div><div class='css_td'>" + obj.user_id + "</div><div class='css_td'>" + obj.cellphone + "</div><div class='css_td'>" + obj.latitude + "</div><div class='css_td'>" + obj.longitude + "</div><div class='css_td'>"+ status  + "</div><div class='css_td'><button onclick='goPage(this)' id="+i+">位置</button></div></div>";
                    }
                }


            }

            listView.innerHTML = result;
        }
    }
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
            setUI();
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "postId="+eventID;
    xmlhttp.send(post); 
}

function goPage(i)
{
    var index = i.id;

    var obj = responseData.data[index];

    location.href = 'map.php?name='+obj.name+'&cellphone='+obj.cellphone+'&latitude='+obj.latitude+'&longitude='+obj.longitude;

}