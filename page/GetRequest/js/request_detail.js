
//訊息資料
var requestData;

//使用者資料
var userData;

//里長住處
var getCity;
var getCityDetail;
var getCityId;
var getCityDetailId;
var imgCheck;


function init() 
{
    getUserData(userName,function(user_data) 
    {
        userData = user_data;

        getCity = userData.user_city;
        getCityDetail = userData.user_city_detail;
        getCityId = userData.city_id;
        getCityDetailId = userData.city_detail_id;
    });

    getDetailData();
}
function getDetailData()
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "php/pull_request_detail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            //console.log(get_json.data);
            
            requestData = get_json.data;
            
            document.getElementById("msg_name").innerHTML = "訊息發送人："+requestData.name+"("+requestData.username+")";
            document.getElementById("msg_title").innerHTML = "標題："+requestData.title;
            document.getElementById("msg_address").innerHTML = "活動地址："+requestData.city + requestData.area+requestData.address;
            
            document.getElementById("msg_time").innerHTML = "活動時間："+requestData.date + "  "+requestData.time;
            document.getElementById("msg_list").innerHTML = "內文：<br>"+requestData.detail;
            
            var img_check = requestData.image;
            imgCheck = img_check;
            
            var msg_image = document.getElementById("msg_image");

            msg_image.innerHTML = "活動圖片：<br>";

            var p = document.createElement("p");

            var img = document.getElementById("uploadImg");
            img.src = "../../userServer/Request/request_img/"+postId+".png"; 

        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("postId="+postId); 
}

function deleteMsg(check)
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "php/delete_request.php", true);
    
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            if (check == 0)
            {
                alert(get_json.Message);
            }
            else
            {
                alert("推送成功");
            }

            if (get_json.Result)
            {
                history.go(-1);
            }

        }
    }
        var post = "id="+postId;

        xmlhttp.send(post); 
}

function pushMsg()
{
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.open("POST", "../Push/push/delegate.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function() 
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {

                var return_data = xmlhttp.responseText;

                pushCalendar();
                //console.log(return_data);
                deleteMsg(1);
                //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
            }
        }
        // Send the data to PHP now... and wait for response to update the status div

        var post = "id="+postId
        +"&title="+requestData.title
        +"&detail="+requestData.detail
        +"&time="+requestData.date
        +"&time_detail="+requestData.time
        +"&city="+getCity
        +"&city_detail="+getCityDetail
        +"&city_id="+getCityId
        +"&city_detail_id="+getCityDetailId
        +"&image="+ imgCheck
        +"&type="+"1"
        +"&address="+requestData.address
        +"&address_city="+requestData.city
        +"&address_area="+requestData.area;

        xmlhttp.send(post); 
}
function pushCalendar()
{
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.open("POST", "../Calender/php/push_calendar.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function() 
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {

                var return_data = xmlhttp.responseText;

                var get_json = JSON.parse(return_data);

                //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        var dt = new Date();
        var month = dt.getMonth()+1;
        var day = dt.getDate();
        var year = dt.getFullYear();
        
        var send_time = year +"/"+ month +"/"+ day + " " + dt.getHours()+":"+ dt.getMinutes()+":"+ dt.getSeconds();
        
        var post = "id="+postId
        +"&title="+requestData.title
        +"&detail="+requestData.detail
        +"&date="+requestData.date
        +"&time="+requestData.time
        +"&city="+getCity
        +"&area="+getCityDetail
        +"&name="+requestData.name
        +"&username="+requestData.username
        +"&liner="+"某某里"
        +"&image="+ imgCheck
        +"&city_id="+getCityId
        +"&area_id="+ getCityDetailId
        +"&address="+requestData.address
        +"&address_city="+requestData.city
        +"&address_area="+requestData.area
        +"&send_time="+send_time;

        xmlhttp.send(post); 
}

