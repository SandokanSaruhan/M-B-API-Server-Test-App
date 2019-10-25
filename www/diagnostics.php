<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />
	<title>MB Diagnostics Page</title>
  <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/4.3.1.bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/3.4.1.jquery.min.js"></script>
  <script src="js/1.14.7.popper.min.js"></script>
  <script src="js/4.3.1.bootstrap.min.js"></script>
</head>
<body bgcolor="#000000">

	<?php
    include('session.php');
    include('navbar.php');

    //(API service connection - get php)
    $url_fuel ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id."/fuel";
    $url_tires ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id."/tires";
    $url_odometer ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id."/odometer";

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

    $data_fuel = httpGetInf($url_fuel,$header);
    $data_tires = httpGetInf($url_tires,$header);
    $data_odometer = httpGetInf($url_odometer,$header);

    $obj_fuel = json_decode($data_fuel);
    $fuel=$obj_fuel["fuellevelpercent"]["value"];

    $obj_tires = json_decode($data_tires);
    $front_left_tire_pressure=$obj_tires["tirepressurefrontleft"]["value"];
    $front_right_tire_pressure=$obj_tires["tirepressurefrontright"]["value"];
    $back_left_tire_pressure=$obj_tires["tirepressurerearright"]["value"];
    $back_right_tire_pressure=$obj_tires["tirepressurerearleft"]["value"];

    $obj_odometer = json_decode($data_odometer);
    $mileage=$obj_odometer["odometer"]["value"];
    
    // Static Value for Test
    $fuel = 70;
    $mileage="3000 km";
    $front_left_tire_pressure="2.26 BAR"; 
    $front_right_tire_pressure="2.30 BAR"; 
    $back_left_tire_pressure="2.31 BAR";
    $back_right_tire_pressure="2.30 BAR"; 
    
    //error_reporting(0);     
  ?>

  <div class="container-fluid">
    <h3>Diagnostics</h3>
  </div>
  
  <div class="container-fluid">
    <br>
    <h5>Fuel level:</h5>
  </div>
	<div class="progress">
    <div class="progress-bar  progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fuel."%" ?>">
     <?php echo $fuel."%" ?> 
    </div>
  </div>

  <div class="container-fluid">
    <br>
    <h5>Mileage: <?php echo $mileage ?></h5> 
  </div>

  <div class="container-fluid">
    <br>
    <h5>Tire presures</h5> 
    <p>Front left: <?php echo $front_left_tire_pressure ?></p> 
    <p>Front right: <?php echo $front_right_tire_pressure ?></p> 
    <p>Back left: <?php echo $back_left_tire_pressure ?></p> 
    <p>Back right: <?php echo $back_right_tire_pressure ?></p> 
  </div>

</body>
</html>
