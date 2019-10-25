<?php

$scope = "";
$redirect_uri = "http://perdecionline.com/test/MB/oauth_get_authorization_code.php"; //SANDO Data
$client_id = "be6572df-6a76-4ce9-8796-ba21cb18f34b";
$client_secret = "3488a30a-eb93-4a2f-832b-17c120725c7a";

$auth_url  = "http://api.secure.mercedes-benz.com/oidc10/auth/oauth/v2/authorize";
$auth_url .= "?";
$auth_url .= "response_type=code&";
$auth_url .= "client_id=$client_id&";
$auth_url .= "redirect_uri=$redirect_uri";
//$auth_url .= "&scope=$scope&"

/*
$contents = file_get_contents($auth_url);
 
if($contents !== false){
    //Print out the contents.
    echo $contents;
}
*/

session_start();
$_SESSION['client_id'] = $client_id;
$_SESSION['client_secret'] = $client_secret;
$_SESSION['redirect_uri'] = $redirect_uri;
header("Location: $auth_url");

?>