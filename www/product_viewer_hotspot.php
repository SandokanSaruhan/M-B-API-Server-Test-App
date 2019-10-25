<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />
	<title>MB 360 Prodcuct Viewer With Hotspot</title>
	<script src='js/1.9.1.jquery.min.js' type='text/javascript'></script>
	<script src='js/sando.edited.jquery.reel.js' type='text/javascript'></script>
	<style>
  	.center {
    	margin: auto;
    	width: 40%;
    	padding: 10px;
  	}
    .box {
      width: 320px;
      height: 320px;
      float: left;
    }
	</style>
</head>
<body bgcolor="#000000">

	<?php
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
  
        $situtation=$obj["doorlockstatusfrontright"]["value"]; 
        
        // Static Value for Test
        $situtation = "LOCKED";   
  ?>

  <div class="container-fluid">
    <h3>Simulator</h3>
    <p>This page could GET the real data from the API</p>
    <p>Also could setting data is enabled</p>
  </div>


  <div class="box">
    <!--<div class="center">-->
    <!-- Adding ımage options -->
    <img src="car.png" width="320" height="214"
      	 class="reel"
      	 id="image"
      	 data-images="img_product_hotspot/angle##.png|1..36|1"
      	 data-cw="true"
      	 data-frame="36"
      	 data-speed="-0.0"
      	 data-duration="0"
      	 data-velocity="0"
     		 data-brake="0.1">

    <!-- Adding hotspot options -->
    <div class="reel-annotation"
      	 id="spot"
      	 data-x=",,,,,,,,,,,,,,,,,,,,,,,,160,140,130,120,110,110,100,100,"
      	 data-y="70"
      	 data-for="image"
     	 	 style="z-index:0">

      <img id="btnClaim" src="img_product_hotspot/hotspot.gif" width="30" height="30">
      <div id="front_right_door"><?php echo $situtation ?></div>
    </div>
  </div>

  <!-- hotspot content options: -->
  <div class="box">
    <div id="imageContent" style="display:none;background-color:white;margin-top:0px;z-index:100;">
      <img id="theImage" src="img_product_hotspot/inside.png" width="320" height="214">
    </div>
  </div>
    


  <script>
    $('#btnClaim').on({ 'touchstart' : function(){

      var x = document.getElementById("front_right_door");
      if (x.innerHTML == "UNLOCKED") {
        x.innerHTML = "LOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "doorstatusfrontright",
            command: "LOCK"
        };
        $.post("door_locks_update.php", data);
      } else{
        x.innerHTML = "UNLOCKED"; //SANDO Data

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "doorstatusfrontright",
            command: "UNLOCK"
        };
        $.post("door_locks_update.php", data);
      }

      $("#imageContent").fadeIn(1000);
                         
      setTimeout(function(){ location.reload(); }, 5000);
    }});
                         
    document.getElementById('btnClaim').onclick = function (){
       var x = document.getElementById("front_right_door");
      if (x.innerHTML == "UNLOCKED") {
        x.innerHTML = "LOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "doorstatusfrontright",
            command: "LOCK"
        };
        $.post("door_locks_update.php", data);
      } else{
        x.innerHTML = "UNLOCKED"; //SANDO Data

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "doorstatusfrontright",
            command: "UNLOCK"
        };
        $.post("door_locks_update.php", data);
      }

      $("#imageContent").fadeIn(1000);
            
      setTimeout(function(){ location.reload(); }, 5000);
    }
  </script>
</body>
</html>
