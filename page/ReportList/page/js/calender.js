var userData;
var responseData;
var year;
var month;


function init()
{
    getUserData(userName,function(user_data) 
    {
        userData = user_data;

        //var dt = new Date();

        month = 1;//dt.getMonth()+1;
        year = 2014//dt.getFullYear();

        var ymd  = year + "/"+month+"/1";
        var ymd2  = year + "/"+month+"/31";

        getEvent(ymd,ymd2);
    });
}
function getEvent(index1,index2) 
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "../../Calender/php/pull_calendar_month.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            
            var listView = document.getElementById('listView');

            $("#listView").empty();

            var tr_Div = document.createElement("div");

            tr_Div.className = "up_css_tr";

            var title_Div = document.createElement("div");

            title_Div.className = "up_title_css_td";

            title_Div.innerHTML = "標題";

            var date_Div = document.createElement("div");

            date_Div.innerHTML = "日期";

            date_Div.className = "up_date_css_td";

            var time_Div = document.createElement("div");

            time_Div.innerHTML = "時間";

            time_Div.className = "up_time_css_td";

            var list_Div = document.createElement("div");

            list_Div.innerHTML = "內文";

            list_Div.className = "up_list_css_td";

            tr_Div.appendChild(title_Div);
            tr_Div.appendChild(list_Div);
            tr_Div.appendChild(date_Div);
            tr_Div.appendChild(time_Div);
            listView.appendChild(tr_Div);
            
            responseData = get_json;

            if (get_json.result)
            {
                if (get_json.data.num != 0)
                {

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

                        listDiv.innerHTML = obj.detail;

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
    var post = "city_id="+userData.city_id+"&area_id="+userData.city_detail_id+"&date_start="+index1+"&date_last="+index2;

    xmlhttp.send(post); 
}
function goPage(i)
{
    var index = i.id;

    var pull_id = responseData.data[index].id;

    location.href = 'calender_detail.php?username='+userName+'&id='+pull_id;

}
function setValue(e)
{
    month = e.value;

    var ymd  = year + "/"+month+"/1";
    var ymd2  = year + "/"+month+"/31";

    getEvent(ymd,ymd2);
}
function setValueYear(e)
{
    year = e.value;

    var ymd  = year + "/"+month+"/1";
    var ymd2  = year + "/"+month+"/31";

    getEvent(ymd,ymd2);

}
