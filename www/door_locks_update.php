<?php
    include('session.php');
    
    $which_door  = $_POST['door']; 
    
    $command = $_POST['command'];
    echo $which_door.$command;

    //(API service connection - post php)
    $url = 'https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/'.$vehicle_id.'/doors'; 

    $params_lock = array( 
        "command" => "LOCK"
    );
    print_r ($params_lock).'<br>';

    $params_unlock = array( 
        "command" => "UNLOCK"
    );
    print_r ($params_unlock).'<br>';

    $header= array(
        "Content-Type" => "application/json",
        "Authorization" => 'Bearer '.$access_token
    );
    print_r ($header).'<br>';

    function httpPost($url,$params,$header) { 
        $postData = '';
        foreach($params as $k => $v) { 
            $postData .= $k . '='.$v.'&'; 
        } 
        rtrim($postData, '&'); 
        //$postData = "grant_type=authorization_code&code=".$_GET["code"]."&redirect_uri=".$redirect_uri;
    
        $ch = curl_init(); 

        curl_setopt($ch,CURLOPT_URL,$url); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
        curl_setopt($ch,CURLOPT_HEADER, $header); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    
        $output=curl_exec($ch); 

        curl_close($ch); 
        return $output; 
    }

    if ($command == "LOCK") {
        $result = httpPost($url,$params_lock,$header);
        echo $result;
    } 
    else if ($command == "UNLOCK"){
        $result = httpPost($url,$params_unlock,$header);
        echo $result;
    }
  ?>