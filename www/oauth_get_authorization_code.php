<?php
	session_start();

	$code = $_GET["code"];
	echo 'code: '.$code.'<br>';

	
	$client_id =  $_SESSION['client_id'];
	$client_secret = $_SESSION['client_secret'];
	$redirect_uri =  $_SESSION['redirect_uri'];
	echo 'client_id: '.$client_id.'<br>';
	echo 'client_secret: '.$client_secret.'<br>';
	echo 'redirect_uri: '.$redirect_uri.'<br>';


	$un_base64 = $client_id.':'.$client_secret;
	$authorization = base64_encode($un_base64);
	//$authorization = 'Basic '.$authorization;
	echo 'authorization: '.$authorization.'<br>';

	$url = 'https://api.secure.mercedes-benz.com/oidc10/auth/oauth/v2/token'; 

	$params = array( 
    	"grant_type" => "authorization_code", 
    	"code" => $_GET["code"],
    	"redirect_uri" => $redirect_uri
	);
	print_r ($params).'<br>';

	$header= array(
		"Content-Type" => "application/x-www-form-urlencoded",
		"Authorization" => 'Basic '.$authorization
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

	$result = httpPost($url,$params,$header);
	echo $result;

	$obj = json_decode($result);
	$var =	 $obj->{'access_token'};

	if (isset($var)) {
   		$_SESSION['access_token'] = $var;
   		//header("location:producet_viewer.php");
	}
	else {
		//header("location:index.html");
		
		// Static Value for Test
		header("location:http://perdecionline.com/test/MB/product_viewer.php");
	}
?>