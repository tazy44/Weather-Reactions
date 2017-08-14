<?php
    
    $weather = "";
    $error = "";
    
    if (array_key_exists('city', $_GET)) {

    //Calling the API server
     $weatherUrl = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&APPID=c991a799fb3183a5142203a6f90d0a75");

    $weatherArray = json_decode($weatherUrl, true); //The 2nd parameter is for making an associative array
    //print_r($weatherArray); //Just viewing all the weather data for development purposes

    if ($weatherArray['cod'] == 200) { //Making sure the API server recognizes the name of the city

    $tempinCelcius = intval($weatherArray['main']['temp']-273); //Converting from Kelvin to Celcius

    $weather = "The Temperature in ".$weatherArray['name'].", ".$weatherArray['sys']['country']." is currently ".$tempinCelcius."&deg;C"; 
    $weather .= "<br/>With ".$weatherArray['weather'][0]['description'];
      } 

      else { //If not, warn the user about it!

        $error = "No one knows where that is! Please type the name of a real city.";

      }

    }

    // Try Cairo, london, sao paolo, moscow, warsaw, paris, mexico city, new york, toronto, vancouver, kiev, oslo, canberra, kuala lumpur, abuja, helsinki, juneau, madrid, Buenos Aires, khartoum, tel aviv

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
      <style type="text/css">
      
      html { 
         /* background: url(images/bg3.jpg) no-repeat center center fixed;*/
            background:linear-gradient(rgba(255, 0, 0, 0.45), rgba(255, 0, 0, 0.45)),
            url(images/bg3.jpg) no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              color: white;
              
          }
          
          .container {
              
              text-align: center;
              margin-top: 100px;
              width: 480px;
              
          }
                    
          #weather {
              
              margin-top:60px;
              
          }

          label[for="city"] {
            margin: 30px 0 5px;
          }
         
      </style>
      
  </head>
  <body>
    
      <div class="container">
      
          <h1>Is the weather nice now?</h1>
          
          
          
          <form>
  <fieldset class="form-group">
    <label for="city">Please enter the name of your city below.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo, san francisco" value = "<?php 
																										   
       if (array_key_exists('city', $_GET)) {
       
         echo $_GET['city']; 
       
       }
       
       ?>">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">So, is it?</button>
</form>
      
          <div id="weather"><?php 
              
              if ($weather) {  
                  echo '<div class="alert alert-success" role="alert">
              '.$weather.'
          </div>';
                  
              } else if ($error) {
                  echo '<div class="alert alert-danger" role="alert">
             '.$error.'
          </div>';
                  
              }
              
          ?></div>
      </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>