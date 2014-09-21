function init() 
{	
	$('#code').qrcode(dataID);

	document.getElementById('iframe').setAttribute('src','../../GetRequest/get_request_detail.php?username='+userName+'&post_id='+dataID+'&class='+"0");
    //'get_request_detail.php?username='+userName+'&post_id='+pull_id
}
