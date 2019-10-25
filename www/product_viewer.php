<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
  	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />
	<title>MB Main Page</title>
	<link rel="stylesheet" href="css/product_page.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="css/product_reset.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="css/product.css" media="screen" type="text/css" />
</head>
<body bgcolor="#000000">

	<?php
        include('session.php');
        include('navbar.php');

        //(API service connection - get php)
        $url ="https://api.mercedes-benz.com/experimental/connectedvehicle/v1/vehicles/".$vehicle_id;

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

      	$result = httpGetInf($url,$header);

      	//echo $result;

      	$obj = json_decode($result);
      	$licenseplate =    $obj->{'licenseplate'};
      	$salesdesignation =    $obj->{'salesdesignation'};

      	// Static Value for Test
    	$vehicle_id="F10F4B9BB792563DD2"; 

    	error_reporting(0); 
    ?>

    <div class="container-fluid">
    	<h3>Welcome to the Mercedes Benz</h3>
    	<h5>API example</p>
    	<h5>this is an app that design to show your vehicle's current status</p>
    	<p>The vehicle id: <?php echo $vehicle_id ?></p>
    	<p>License plate: <?php echo $licenseplate ?></p>
    	<p>Desiganiton: <?php echo $salesdesignation ?></p>
  	</div>

	<div class="bg">
		<div id="sando">
			<div id="spinner">
				<span>0%</span>
			</div>
				<ol id="sando_images"></ol>
			</div>
	
		<script src="js/heartcode-canvasloader-min.js"></script>
		<script src="js/product-jquery.min.js"></script>
		<script src="js/product.js"></script>  
	</div>
</body>
</html>
