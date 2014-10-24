
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

    xmlhttp.open("POST", "../php/pull_calendar_detail.php", true);

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            //console.log(get_json.data);
            
            requestData = get_json.data;
            
            document.getElementById("msg_name").innerHTML = "訊息發送人："+requestData.name;
            document.getElementById("msg_username").innerHTML = "帳號："+requestData.username;
            document.getElementById("msg_title").innerHTML = "標題："+requestData.title;
            document.getElementById("msg_address").innerHTML = "活動地址："+requestData.address_city + requestData.address_area+requestData.address;
            
            document.getElementById("msg_time").innerHTML = "活動時間："+requestData.date + "  "+requestData.time;
            document.getElementById("msg_list").innerHTML = "內文：<br>"+requestData.detail;
            
            var img_check = requestData.image;
            imgCheck = img_check;
                        
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("postId="+postId); 
}

