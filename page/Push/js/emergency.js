
var getCity;
var getCityDetail;
var getCityId;
var getCityDetailId;

var userData;

function init () 
{
    getUserData(userName,function(user_data) 
    {
        userData = user_data;
            //var user_div = document.getElementById("user");
        var city_div = document.getElementById("city");

        city_div.innerHTML = "區域："+user_data.user_city +" "+ user_data.user_city_detail;

        var user_div = document.getElementById("user");
        user_div.innerHTML = "發佈人："+user_data.name;

        var dt = new Date();
        var month = dt.getMonth()+1;
        var day = dt.getDate();
        var year = dt.getFullYear();

        var date_div = document.getElementById("date");
            
        date_div.innerHTML = "發佈日期："+year+"/"+month+"/"+day;

        getCity = user_data.user_city;
        getCityDetail = user_data.user_city_detail;
        getCityId = user_data.city_id;
        getCityDetailId = user_data.city_detail_id;

    });
}
function EmergencyPush()
{
     var div_title = document.getElementById('title').value;
        var div_detail = document.getElementById('detail').value;

        var dt = new Date();
        var month = dt.getMonth()+1;
        var day = dt.getDate();
        var year = dt.getFullYear();
    
        var ID = year +""+ month +""+ day+"" + dt.getHours()+""+ dt.getMinutes()+""+ dt.getSeconds();
        var date = year +"/"+ month +"/"+ day;
        var time = dt.getHours() +":"+ dt.getMinutes();
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.open("POST", "push/delegate.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function() 
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                var return_data = xmlhttp.responseText;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
       
        PushSQL(ID,date,time);

        var post = "id="+ID+"&title="+div_title+"&detail="+div_detail+"&time="+date+"&time_detail="+time+"&city="+getCity+"&city_detail="+getCityDetail+"&city_id="+getCityId+"&city_detail_id="+getCityDetailId+"&image="+0+"&type="+"2";

        xmlhttp.send(post); 
}

function PushSQL(ID,date,time)
{
    var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.open("POST", "push/emergency_push.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function() 
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                var return_data = xmlhttp.responseText;
            
                var get_json = JSON.parse(return_data);
 
                alert("推送成功");
                     
                window.location.reload();
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        var div_title = document.getElementById('title').value;
        var div_detail = document.getElementById('detail').value;
        
        var post = "id="+ID+"&title="+div_title+"&detail="+div_detail+"&date="+date+"&time="+time+"&city_id="+getCityId+"&area_id="+getCityDetailId+"&username="+userName+"&name="+userData.name;

        xmlhttp.send(post); 
}
