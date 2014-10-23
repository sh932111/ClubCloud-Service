function init () 
{
    document.getElementById('iframe').setAttribute('src','Calender/Calendar.php?username='+userName);
    
    getUserData(userName,function(user_data) 
    {
        var user_div = document.getElementById("user");
            
        user_div.innerHTML = "管理人："+user_data.name;
    });
}

function selectMsg()
{
    document.getElementById('iframe').setAttribute('src','GetRequest/get_request.php?username='+userName);
    //location.href = 'GetRequest/get_request.php?username='+userName;
}

function checkCalendar()
{
    //location.href = 'Calender/Calendar.php?username='+userName;
    document.getElementById('iframe').setAttribute('src','Calender/Calendar.php?username='+userName);
    
}

function crashMsg()
{
    document.getElementById('iframe').setAttribute('src','ReportList/choose_report.php?username='+userName);
}

function pushMsg () 
{
    document.getElementById('iframe').setAttribute('src','Push/ClassChoose.php?username='+userName);
	//location.href = 'Push/Console.php?username='+userName;
}