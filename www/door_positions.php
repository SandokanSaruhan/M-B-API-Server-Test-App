<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />
  <title>MB Door Positions Status Page</title>
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
        $url ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id."/doors";

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
  

        $front_left_door=$obj["doorstatusfrontleft"]["value"];
        $back_left_door=$obj["doorstatusrearleft"]["value"];
        $front_right_door=$obj["doorstatusfrontright"]["value"];
        $back_right_door=$obj["doorstatusrearright"]["value"];

        // Static Value for Test
        $front_left_door="CLOSED"; 
        $back_left_door="CLOSED";
        $front_right_door="CLOSED";
        $back_right_door="CLOSED";

        //error_reporting(0);    
  ?>

  <div class="container-fluid">
    <p>This page could GET the real data from the API, but setting data is not enabled</p>
    <h3>Door Positions</h3>
  </div>

  <div class="center">

    <div class="box">
      <h5>Front Left</h5>
      <button class="btn btn-dark" onclick="document.getElementById('front_left_door').src='img/door_positions_front_left.png'">Open</button>
      <button class="btn btn-dark" onclick="document.getElementById('front_left_door').src='img/door_positions_all_closed.png'">Close</button>
      <br>
      <h6>real position: <?php echo $front_left_door;?></h6>
    </div>

    <div class="box">
      <h5>Back Left</h5>
      <button class="btn btn-dark" onclick="document.getElementById('back_left_door').src='img/door_positions_back_left.png'">Open</button>
      <button class="btn btn-dark" onclick="document.getElementById('back_left_door').src='img/door_positions_all_closed.png'">Close</button>
      <br>
      <h6>real position: <?php echo $back_left_door;?></h6>
    </div>

    <div class="box">
      <h5>Front Right</h5>
      <button class="btn btn-dark" onclick="document.getElementById('front_right_door').src='img/door_positions_front_right.png'">Open</button>
      <button class="btn btn-dark" onclick="document.getElementById('front_right_door').src='img/door_positions_all_closed.png'">Close</button>
      <br>
      <h6>real position: <?php echo $front_right_door;?></h6>
    </div>

    <div class="box">
      <h5>Back Right</h5>
      <button class="btn btn-dark" onclick="document.getElementById('back_right_door').src='img/door_positions_back_right.png'">Open</button>
      <button class="btn btn-dark" onclick="document.getElementById('back_right_door').src='img/door_positions_all_closed.png'">Close</button>
      <br>
      <h6>real position: <?php echo $back_right_door;?></h6>
    </div>

    <div class="box">
      <img id="front_left_door" src="img/door_positions_all_closed.png" style="width:320px; position: absolute; z-index: 1">
      <img id="back_left_door" src="img/door_positions_all_closed.png" style="width:320px; position: absolute; z-index: 2">
      <img id="front_right_door" src="img/door_positions_all_closed.png" style="width:320px; position: absolute; z-index: 3">
      <img id="back_right_door" src="img/door_positions_all_closed.png" style="width:320px; position: absolute; z-index: 4">
    </div>
  
  </div>

</body>
</html>
