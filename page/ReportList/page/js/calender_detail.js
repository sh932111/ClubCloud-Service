var userData;
var responseData;
function init()
{
    getUserData(userName,function(user_data) 
    {
        userData = user_data;
    });
    
    getRequestData();
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
function getDetail() 
{
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "php/pull_calender_detail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            responseData = JSON.parse(return_data);

            setUI();
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    var post = "postId="+eventID;
    xmlhttp.send(post); 
}
function setUI()
{
    var listView = document.getElementById('listView');

    $("#listView").empty();

    var tr_Div = document.createElement("div");

    tr_Div.className = "up_css_tr";

    var name_div = document.createElement("div");

    name_div.className = "up_css_td";

    name_div.innerHTML = "名字";

    var id_div = document.createElement("div");

    id_div.className = "up_css_td";

    id_div.innerHTML = "身分證字號";

    var cellphone_div = document.createElement("div");

    cellphone_div.className = "up_css_td";

    cellphone_div.innerHTML = "聯絡電話";

    var check_div = document.createElement("div");

    check_div.className = "up_css_td";

    check_div.innerHTML = "是否參與";

    tr_Div.appendChild(name_div);
    tr_Div.appendChild(id_div);
    tr_Div.appendChild(cellphone_div);
    tr_Div.appendChild(check_div);
    listView.appendChild(tr_Div);

    reloadData();
}
function reloadData()
{
    var get_data = responseData.data;

    var listView = document.getElementById('listView');

    if (get_data.num != 0) 
    {
        for (var i = 0; i < get_data.num; i++) 
        {
            var obj = get_data[i];

            var tr_Div = document.createElement("div");

            tr_Div.className = "css_tr";

            var name_div = document.createElement("div");

            name_div.className = "css_td";

            name_div.innerHTML = obj.name;

            var id_div = document.createElement("div");

            id_div.className = "css_td";

            id_div.innerHTML = obj.user_id;

            var cellphone_div = document.createElement("div");

            cellphone_div.className = "css_td";

            cellphone_div.innerHTML = obj.cellphone;

            var check_div = document.createElement("div");

            check_div.className = "css_td";

            if (obj.t_check == 1)
            {
                check_div.innerHTML = "以點名";
            }
            else
            {
                check_div.innerHTML = "尚未參與";
            }

            tr_Div.appendChild(name_div);
            tr_Div.appendChild(id_div);
            tr_Div.appendChild(cellphone_div);
            tr_Div.appendChild(check_div);
            listView.appendChild(tr_Div);
        }
    }
    drawChart();
}
function drawChart() 
{
    var data = new google.visualization.DataTable();

    data.addColumn("string", "記錄日期");
    data.addColumn("number", "以參與");
    data.addColumn("number", "未參與");
    data.addRows(1);

    data.setCell(0, 0, Day);
    data.setCell(0, 1, parseFloat(3, 10));
    data.setCell(0, 2, parseFloat(2, 10));
    var options = 
    {
        title: '參與記錄百分比',
        vAxis: 
        {
        title: '參與數值', titleTextStyle: {fontSize:18}, gridlines:{color: 'pink', count: 10}
        },
        hAxis:
         {
        title: '紀錄日期'},
    };

    new google.visualization.ColumnChart(document.getElementById("chart_div")).
    draw(data, options);
}

