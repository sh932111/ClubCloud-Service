var MsgPushBt = document.getElementById('MsgPush');
var EmergencyPushBt = document.getElementById('EmergencyPush');
	

function init () 
{
	document.getElementById('iframe').setAttribute('src','Console.php?username='+userName);
}
function MsgPush () 
{
	MsgPushBt.className = '';
	EmergencyPushBt.className = '';
	EmergencyPushBt.className = 'noSelected';
	MsgPushBt.className = 'Selected';
	document.getElementById('iframe').setAttribute('src','Console.php?username='+userName);
}

function EmergencyPush () 
{
	MsgPushBt.className = '';
	EmergencyPushBt.className = '';
	MsgPushBt.className = 'noSelected';
	EmergencyPushBt.className = 'Selected';
	document.getElementById('iframe').setAttribute('src','Emergency.php?username='+userName);
}