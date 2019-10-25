<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />
	<title>MB Battery Status Page</title>
  <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/4.3.1.bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">

</head>
<body bgcolor="#000000">

	<?php
    include('session.php');
    include('navbar.php'); 

    //(API service connection - get php)
    $url ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id."/stateofcharge";

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
  
    if (isset($obj)) {
        $battery=$obj["stateofcharge"]["value"];
    }
 
    // Static Value for Test
    $battery=90;  

    //error_reporting(0); 
  ?>

  <div class="container-fluid">
    <h3>Charging</h3>
    <p>This page could GET the real data from the API, but setting data is not enabled</p>
    <p>Battery level</p>
  </div>

  <!-- Div For Progress Bar -->
  <div class="progress">
    <div class="progress-bar progress-bar-striped" role="progressbar"  style="width:<?php echo $battery."%" ?>" aria-valuenow="<?php echo $battery ?>" aria-valuemin="0" aria-valuemax="100" id="progressbar" ><?php echo $battery."%" ?></div>
  </div>

  <div class="center">
      <!--<form action="" method="get" name="updateBattery">-->
        <input type="hidden" name="battery" value="<?php echo $battery; ?>">
        <button type="submit" class="btn btn-dark" value="increase" name="increase" id="increase" onclick = "increment()">+</button>
        <button type="submit" class="btn btn-dark" value="reduce" name="reduce" id="reduce" onclick="decrement()">-</button>
      <!--</form>-->
  </div>
  
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/3.4.1.jquery.min.js"></script>
  <script src="js/1.14.7.popper.min.js"></script>
  <script src="js/4.3.1.bootstrap.min.js"></script>
  <script src="js/progressbar-update.js"></script>
</body>
</html>
