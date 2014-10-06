
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
    getData();

    getDetailData();
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

            userData = get_json.data;

            getCity = userData.user_city;
            getCityDetail = userData.user_city_detail;
            getCityId = userData.city_id;
            getCityDetailId = userData.city_detail_id;

            // var user_div = document.getElementById("user");
            
            // user_div.innerHTML = "管理人："+user_data.name;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+userName); 
}
function getDetailData()
{
    var xmlhttp = new XMLHttpRequest();

    if (linkClass == 0)
    {
        xmlhttp.open("POST", "../Calender/php/pull_calendar_detail.php", true);

        var push_bt = document.getElementById("push_bt");

        push_bt.style.display = 'none';
        
        var delete_bt = document.getElementById("delete_bt");

        delete_bt.style.display = 'none';
    }
    else if (linkClass == 1)
    {
        xmlhttp.open("POST", "php/pull_request_detail.php", true);
    }
    
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
            document.getElementById("msg_address").innerHTML = "活動地址："+requestData.city + requestData.area+requestData.address;
            document.getElementById("msg_time").innerHTML = "活動時間："+requestData.date + "  "+requestData.time;
            document.getElementById("msg_list").innerHTML = "內文："+requestData.detail;
            
            var img_check = requestData.image;
            imgCheck = img_check;
            
	console.log(imgCheck);
	if (img_check == 1)
            {
                var msg_image = document.getElementById("msg_image");

                msg_image.innerHTML = "活動圖片：<br>";

                var p = document.createElement("p");
		
		console.log(postId);

                var img = document.getElementById("uploadImg");
                //img.setAttribute("src","../../userServer/Request/request_img/"+postId+".png");
	img.src = "../../userServer/Request/request_img/"+postId+".png";	
		
                //img.setAttribute("height","768");
                //img.setAttribute("width","1024");

            }
                        
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
                //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
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

        var post = "id="+postId+"&title="+requestData.title+"&detail="+requestData.detail+"&time="+requestData.date+"&time_detail="+requestData.time+"&city="+getCity+"&city_detail="+getCityDetail+"&city_id="+getCityId+"&city_detail_id="+getCityDetailId+"&image="+ imgCheck+"&type="+"1";

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

                console.log(get_json);

                //{"Result":true,"Message":"\u767b\u5165\u6210\u529f","username":"21115","password":"21115","name":"forte"}"
            }
        }
        // Send the data to PHP now... and wait for response to update the status div

        var post = "id="+postId+"&title="+requestData.title+"&detail="+requestData.detail+"&date="+requestData.date+"&time="+requestData.time+"&city="+getCity+"&area="+getCityDetail+"&address="+requestData.address+"&name="+requestData.name+"&username="+requestData.username+"&liner="+"某某里"+"&image="+ imgCheck+"&city_id="+getCityId+"&area_id="+ getCityDetailId;

        xmlhttp.send(post); 
}

