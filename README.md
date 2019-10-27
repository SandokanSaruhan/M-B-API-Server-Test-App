# Mercedes Benz Api Test APP - PHP 5.6.40 - JS 1.7 - Bootstrap 4.3.1
This is a simple App for usage and communicate with the Mercedes Benz One API. 

- This APP shows information about the vehicle 
(charging, mileage, tire pressures, fuel level, location, heating, door positions and door status) and 
let you act on the vehicle (e.g. lock/unlock doors)

- This APP has 360 view of the car, also lets you change the door lock sitution by clicking on it
also can show a picture of interior view

- it has some door situtaion open/close  features but it is not really connected to the API (API does not allow us to do at this level)

- for oauth PHP Curl Get/Post Oauth2 methods are used

- for getting and updating information PHP Curl Get/Post methods are used

- PHP 5.6.40 - JS 1.7 (preferred to use - compatible on working most of browsers)

- Bootstrap 4.3.1 for the fast design

## Mercedes Benz One API 

- API used as provider.

- Should be login in Mercedes Benz web enviroment to use this APP

- But in the index page we pretend that we are login to the Mercedes Benz web enviroment

- There is no specific user name or password but these fields could not be empty 

- Oauth https://developer.mercedes-benz.com/content-page/oauth-documentation

- Get/Update information of vehicle https://developer.mercedes-benz.com/apis/connected_vehicle_experimental_api/docs 

## Google Map API - Maps JavaScript API

- In location_status.php , the lat - lon values of the vahecile are collecting from the "Mercedes Benz experimental API"

- We use "Google Map API - Maps JavaScript API" for showing on map.

- Api key is needed: Google Map API Key - Maps JavaScript API https://developers.google.com/maps/ 

## How to build

1) Install one of the php-apache server from web

2) Add sources to the main file of your host (www/public_htm)

3) View the main adress of your host on the browser

# Requirements
* php-apache server (http://www.wampserver.com/en/ , https://www.apachefriends.org/tr/index.html)
* browser or webview 

# To Check My Other Codes (Swift)
https://github.com/SandokanSaruhan

![](Demo_2x.gif)




