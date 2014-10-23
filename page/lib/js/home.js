function init () 
{
    document.getElementById('iframe').setAttribute('src','Calender/Calendar.php?username='+userName);
    
    getData();

    getUserData(function(obj) {
        console.log(obj);
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
function getData()
{
	var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "lib/get_data/get_data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;

            var get_json = JSON.parse(return_data);

            console.log(get_json.Message);

            var user_data = get_json.data;

            var user_div = document.getElementById("user");
            
            user_div.innerHTML = "管理人："+user_data.name;

        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    xmlhttp.send("username="+userName); 
}
