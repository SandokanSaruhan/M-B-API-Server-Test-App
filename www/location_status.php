<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />  
	<title>MB Car Location Page</title>
	<style>          
    #map { 
      height: 320px;    
      width: 320px;             
    } 
    #map_holder { 
		  padding: 10px;            
    }          
  </style> 
</head>
<body bgcolor="#000000">

	<?php
    include('session.php');
    include('navbar.php');


    //(API service connection - get php)
    $url ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id."/location";

    $header= array(
      "accept" => "application/json",
      "authorization" => 'Bearer '.$access_token
    );

    function httpGetInf($url,$header) { 
      $ch = curl_init(); 
      curl_setopt($ch,CURLOPT_URL,$url); 
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
      curl_setopt($ch,CURLOPT_HEADER, $header); 
    
      $output=curl_exec($ch); 
      curl_close($ch); 
      return $output; 
    }

    $data = httpGetInf($url,$header);
    //echo $data;

    $obj = json_decode($data);

    $latitude=$obj["latitude"]["value"];
    $longitude=$obj["longitude"]["value"];
    $heading=$obj["heading"]["value"];
        
    // Static Value for Test
    $latitude = 52.516506; 
    $longitude = 13.381815;
    $heading = 52.520008;  

    // data passing - PHP to Javascript
    echo '<script>';
    echo 'var latitude = ' . json_encode($latitude) . ';';
    echo 'var longitude = ' . json_encode($longitude) . ';';
    echo '</script>'; 

    //error_reporting(0);
  ?>

  <div class="container-fluid">
    <h3>Vehicle Location Coordinates</h3>
    <p>Latitude: <?php echo $latitude ?></p> 
    <p>Longitude: <?php echo $longitude ?></p>
    <p>Heading: <?php echo $heading ?></p>
  </div>


  <div id="map_holder">
    <div id="map"></div>
  </div>
        
  <script type="text/javascript">
    var map;
        
    function initMap() {                            
      //var latitude = 41.010290; // YOUR LATITUDE VALUE 
      //var longitude = 28.868740; // YOUR LONGITUDE VALUE 
  
      var myLatLng = {lat: latitude, lng: longitude};
            
      map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 14                    
      });
                    
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        //title: 'Hello World'
        // setting latitude & longitude as title of the marker
        // title is shown when you hover over the marker
        title: latitude + ', ' + longitude 
      });            
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key="add your google key"=initMap"
        async defer> //Google Map API Key - Maps JavaScript API</script> 

</body>    
</html>

