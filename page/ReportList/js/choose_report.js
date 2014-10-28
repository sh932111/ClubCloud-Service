var calbt = document.getElementById('calbt');
var embt = document.getElementById('embt');
	
function init()
{
	document.getElementById('iframe').setAttribute('src','page/calender_list.php?username='+userName);
}
function emList()
{
	calbt.className = '';
	embt.className = '';
	calbt.className = 'noSelected';
	embt.className = 'Selected';
	
	document.getElementById('iframe').setAttribute('src','page/emergency_list.php?username='+userName);
}
function calList()
{
	calbt.className = '';
	embt.className = '';
	embt.className = 'noSelected';
	calbt.className = 'Selected';
	
	document.getElementById('iframe').setAttribute('src','page/calender_list.php?username='+userName);
}