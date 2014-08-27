function login () 
{
	var username = document.getElementById('username').value;
    if (username == "") 
	{
		alert("請輸入您的帳號");
		return;
	}
    var password = document.getElementById('password').value;
	if (password == "") 
	{
		alert("請輸入您的密碼");
		return;
	}

	var xmlhttp = new XMLHttpRequest();
	    
	xmlhttp.open("POST", "page/Login/Login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var return_data = xmlhttp.responseText;
            
            var msg = JSON.parse(return_data);

            console.log(msg);

			alert(msg.Message);

			if (msg.result)
			{
				location.href = "page/home.php";
			}
        }
    }
    var post = "password="+password+"&username="+username;

    xmlhttp.send(post); 
}
function register()
{
	location.href = "page/Register/register.html";
}