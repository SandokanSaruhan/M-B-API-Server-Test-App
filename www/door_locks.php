<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />
  <title>MB Door Locks Status Page</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/4.3.1.bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/3.4.1.jquery.min.js"></script>
  <script src="js/1.14.7.popper.min.js"></script>
  <script src="js/4.3.1.bootstrap.min.js"></script>
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #000000;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #000000;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>
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
  

        $front_left_door=$obj["doorlockstatusfrontleft"]["value"];
        $back_left_door=$obj["doorlockstatusrearleft"]["value"];
        $front_right_door=$obj["doorlockstatusfrontright"]["value"];
        $back_right_door=$obj["doorlockstatusrearright"]["value"];

        $front_left_door_check=""; 
        $back_left_door_check="";
        $front_right_door_check="";
        $back_right_door_check="";

        

        // Static Value for Test
        $front_left_door="UNLOCKED"; 
        $back_left_door="UNLOCKED";
        $front_right_door="UNLOCKED";
        $back_right_door="UNLOCKED"; 

        $front_left_door_check=""; 
        $back_left_door_check="";
        $front_right_door_check="";
        $back_right_door_check="";

        if ($front_left_door == "LOCKED") {
          $front_left_door_check="checked";
        } 
        else if ($front_left_door == "UNLOCKED"){
          $front_left_door_check="";
        }

        else if ($back_left_door == "LOCKED") {
          $back_left_door_check="checked";
        } 
        else if($back_left_door == "UNLOCKED") {
          $back_left_door_check="";
        }

        else if ($front_right_door == "LOCKED") {
          $front_right_door_check="checked";
        } 
        else if ($front_right_door == "UNLOCKED") {
          $front_right_door_check="";
        }  

        else if ($back_right_door == "LOCKED") {
          $back_right_door_check="checked";
        } 
        else if ($back_right_door == "UNLOCKED") {
          $back_right_door_check="";
        }

        //error_reporting(0);        
  ?>

  <div class="container-fluid">
    <p>This page could GET the real data from the API</p>
    <p>Also could setting data is enabled</p>
    <h3>Door Locks</h3>
  </div>

   <div class="center">

    <div class="box">
      <h5>Front Left</h5>
      <label class="switch">
        <input type="checkbox" <?php echo $front_left_door_check;?> onclick="fld()">
        <span class="slider round"></span>
      </label>
      <br>
      <div id="front_left_door"><h6><?php echo $front_left_door;?></h6></div>
    </div>

    <div class="box">
      <h5>Back Left</h5>
      <label class="switch">
        <input type="checkbox" <?php echo $back_left_door_check;?> onclick="bld()">
        <span class="slider round"></span>
      </label>
      <br>
      <div id="back_left_door"><h6><?php echo $back_left_door;?></h6></div>
    </div>

    <div class="box">
      <h5>Front Right</h5>
      <label class="switch">
        <input type="checkbox" <?php echo $front_right_door_check;?> onclick="frd()">
        <span class="slider round"></span>
      </label>
      <br>
      <div id="front_right_door"><h6><?php echo $front_right_door;?></h6></div>
    </div>

    <div class="box">
      <h5>Back Right</h5>
      <label class="switch">
        <input type="checkbox" <?php echo $back_right_door_check;?> onclick="brd()" id="brd">
        <span class="slider round"></span>
      </label>
      <br>
      <div id="back_right_door"><h6><?php echo $back_right_door;?></h6></div>
    </div>

  </div>
  
  <script type="text/javascript">

    //(API service connection - post php)

    function fld() {
      var x1 = document.getElementById("front_left_door");
      if (x1.innerHTML == "LOCKED") {
        x1.innerHTML = "UNLOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "UNLOCK"
        };
        $.post("door_locks_update.php", data);
      } else {
        x1.innerHTML = "LOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "LOCK"
        };
        $.post("door_locks_update.php", data);
      }
    }
    function bld() {
      var x2 = document.getElementById("back_left_door");
      if (x2.innerHTML == "LOCKED") {
        x2.innerHTML = "UNLOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "UNLOCK"
        };
        $.post("door_locks_update.php", data);
      } else {
        x2.innerHTML = "LOCKED";

         //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "LOCK"
        };
        $.post("door_locks_update.php", data);
      }
    }
    function frd() {
      var x3 = document.getElementById("front_right_door");
      if (x3.innerHTML == "LOCKED") {
        x3.innerHTML = "UNLOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "UNLOCK"
        };
        $.post("door_locks_update.php", data);
      } else {
        x3.innerHTML = "LOCKED";

         //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "LOCK"
        };
        $.post("door_locks_update.php", data);
      }
    }
    function brd() {
      var x4 = document.getElementById("back_right_door");
      if (x4.innerHTML == "LOCKED") {
        x4.innerHTML = "UNLOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "UNLOCK"
        };
        $.post("door_locks_update.php", data);
      } else {
        x4.innerHTML = "LOCKED";

        //(API service connection - post php)
        // data passing - Javascript to PHP
        var data = {
            door: "alldoors",
            command: "LOCK"
        };
        $.post("door_locks_update.php", data);
      }
    }
  </script>

</body>
</html>
