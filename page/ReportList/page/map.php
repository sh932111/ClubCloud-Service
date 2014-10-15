<!DOCTYPE html>

<?php

$name = $_GET['name'];
$cellphone = $_GET['cellphone'];
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
?>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDQAoaVGyaDkMz6pvCBes7Ci_d0urrNKiA&sensor=TRUE">
    </script>
    <script type="text/javascript">
      function initialize() {
        var name = '<?php echo $name; ?>';
        var cellphone = '<?php echo $cellphone; ?>';
        var latitude = '<?php echo $latitude; ?>';
        var longitude = '<?php echo $longitude; ?>';

        var mapOptions = {
          //center: new google.maps.LatLng(22.763392, 120.375816),
          center: new google.maps.LatLng(latitude, longitude),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width:100%; height:100%"></div>
  </body>
</html>