function init () 
{
	document.getElementById('iframe').setAttribute('src','Console.php?username='+userName);
}
function MsgPush () 
{
	document.getElementById('iframe').setAttribute('src','Console.php?username='+userName);
}

function EmergencyPush () 
{
	document.getElementById('iframe').setAttribute('src','Emergency.php?username='+userName);
}