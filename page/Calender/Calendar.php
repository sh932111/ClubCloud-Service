<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

$username = $_GET['username'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>jMonthCalendar Sample</title>

    <link rel="stylesheet" href="css/core.css" type="text/css" />

	<style type="text/css" media="screen">
		#jMonthCalendar .Meeting { background-color: #DDFFFF;}
		#jMonthCalendar .Birthday { background-color: #DD00FF;}
		#jMonthCalendar #Event_3 { background-color:#0000FF; }
	</style>
	
	    <script src="js/jquery-1.3.min.js" type="text/javascript"></script>
    	<script src="js/jMonthCalendar.js" type="text/javascript"></script>


    <script type="text/javascript">
    var extraEvents;
    var userName = "<?echo $username ?>";

        $().ready(function() {
			var options = {
				height: 500,
				width: 800,
				navHeight: 25,
				labelHeight: 25,
				onMonthChanging: function(dateIn) {
					//this could be an Ajax call to the backend to get this months events
					//var events = [ 	{ "EventID": 7, "StartDate": new Date(2009, 1, 1), "Title": "10:00 pm - EventTitle1", "URL": "#", "Description": "This is a sample event description", "CssClass": "Birthday" },
					//				{ "EventID": 8, "StartDate": new Date(2009, 1, 2), "Title": "9:30 pm - this is a much longer title", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" }
					//];
					//$.jMonthCalendar.ReplaceEventCollection(events);
					return true;
				},
				onEventLinkClick: function(event) {
					//console.log(event.URL); 
					alert("event link click");
					return true; 
				},
				onEventBlockClick: function(event) { 
					alert("block clicked");
					return true; 
				},
				onEventBlockOver: function(event) {
					//alert(event.Title + " - " + event.Description);
					return true;
				},
				onEventBlockOut: function(event) {
					return true;
				},
				onDayLinkClick: function(date) { 
					alert(date.toLocaleDateString());
					return true; 
				},
				onDayCellClick: function(date) { 
					alert(date.toLocaleDateString());
					//alert(userName);
					return true; 
				}
			};
			
			// var events = [ 	{ "EventID": 1, "Date": "new Date(2014, 8, 12)", "Title": "10:00 pm - EventTitle1", "URL": "https://www.google.com.tw", "Description": "This is a sample event description", "CssClass": "Birthday" },
			// 				{ "EventID": 10, "StartDateTime": new Date(2014, 8, 2), "Title": "10:00 pm - EventTitle1", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" },
			// 				{ "EventID": 2, "Date": "2009-04-28T00:00:00.0000000", "Title": "9:30 pm - this is a much longer title", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" },
			// 				{ "EventID": 3, "StartDateTime": new Date(2014, 8, 12), "Title": "9:30 pm - this is a much longer title", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" },
			// 				{ "EventID": 4, "StartDateTime": "2009-04-14", "Title": "9:30 pm - this is a much longer title", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" }
			// ];

			// console.log(events);

			var events = [];
			var newoptions = { };
			var newevents = [ ];
			//$.jMonthCalendar.Initialize(newoptions, newevents);

			
			$.jMonthCalendar.Initialize(options, events);
			
			getData();

			// var events2 = [
			// { "EventID": 3, "StartDateTime": new Date(2014, 8, 10), "Title": "9:30 pm - this is a much longer title", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" },
			// 				{ "EventID": 1, "Date": "new Date(2014, 8, 11)", "Title": "10:00 pm - EventTitle1", "URL": "https://www.google.com.tw", "Description": "This is a sample event description", "CssClass": "Birthday" }
			
			// ];
			
			// $("#Button").click(function() {		

			// 				console.log(events2);
			// 				console.log(extraEvents);
			
			
			// 	//$.jMonthCalendar.AddEvents(events2);
			// 	$.jMonthCalendar.AddEvents(extraEvents);
			// });
			
			// $("#ChangeMonth").click(function() {
			// 	$.jMonthCalendar.ChangeMonth(new Date(2009, 3, 7));
			// });
        });

		function getData()
			{
				var xmlhttp = new XMLHttpRequest();
			    
			    xmlhttp.open("POST", "php/pull_calendar.php", true);
			    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				xmlhttp.onreadystatechange = function() 
			    {
			        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			        {
			            var return_data = xmlhttp.responseText;

			            var get_json = JSON.parse(return_data);

			            var get_data = get_json.data;

			            //console.log(get_data);

			            var extraEvents = [];

			            for (var i = 0; i < get_data.num; i++) 
			            {
			            	if (get_data.num != 1) 
			            	{
			            		var myDate = new Date(get_data[i].date);
				            	//link
								var js_data = { "EventID": get_data[i].id, "StartDateTime": new Date(myDate.getFullYear(), myDate.getMonth(), myDate.getDate()), "Title": get_data[i].title, "URL": ".detail/Calendar_detail.php?username="+userName+"&data_id="+ get_data[i].id, "Description": get_data[i].detail, "CssClass": "Meeting" };
								
								extraEvents.push(js_data);
			            	}

			            	else
			            	{
			            		var myDate = new Date(get_data[i].date);
				            	//link
								var js_data = { "EventID": get_data[i].id, "StartDateTime": new Date(myDate.getFullYear(), myDate.getMonth(), myDate.getDate()), "Title": get_data[i].title, "URL": "detail/Calendar_detail.php?username="+userName+"&data_id="+ get_data[i].id, "Description": get_data[i].detail, "CssClass": "Meeting" };
								var js_data2 = { "EventID": 0, "StartDateTime": new Date(1000, 8, 10), "Title": "9:30 pm - this is a much longer title", "URL": "#", "Description": "This is a sample event description", "CssClass": "Meeting" };
								extraEvents.push(js_data);
								extraEvents.push(js_data2);
			            	}
						}

						$.jMonthCalendar.AddEvents(extraEvents);
			            
			            // var user_div = document.getElementById("user");
			            
			            // user_div.innerHTML = "管理人："+user_data.name;
			        }
			    }
			    // Send the data to PHP now... and wait for response to update the status div
			    xmlhttp.send(); 
			}
    </script>
</head>
<body>

	<left>
		<div id="jMonthCalendar"></div>

		<!-- <button id="Button">Add More Events</button>

		<button id="ChangeMonth">Change Months May 2009</button> -->
	</left>
</body>

</html>