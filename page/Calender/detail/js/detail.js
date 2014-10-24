function init() 
{	
	$('#code').qrcode(dataID);

	document.getElementById('iframe').setAttribute('src','get_request_detail.php?username='+userName+'&post_id='+dataID);
}
