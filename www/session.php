<?php
   session_start();
   
   $access_token = $_SESSION['access_token'];
   //$access_token = ""; // Static Value for Test

   $vehicle_id = "";
   
   if(!isset($_SESSION['session'])){
      //header("location:index.html");
   }
   else{

      $url ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles";

      $header= array(
         "accept" => "application/json",
         "authorization" => 'Bearer '.$token
      );

      function httpGet($url,$header) { 
         $ch = curl_init(); 
         curl_setopt($ch,CURLOPT_URL,$url); 
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
         curl_setopt($ch,CURLOPT_HEADER, $header); 
    
         $output=curl_exec($ch); 
         curl_close($ch); 
         return $output; 
      }

      $result = httpGet($url,$header);

      //echo $result;

      $obj = json_decode($result);
      $var =    $obj->{'id'};

      if (isset($var)) {
         $vehicle_id = $var;
      }
   }

   error_reporting(0);
?>