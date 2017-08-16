<?php
    include('API-caller.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Weather Scraper</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
      
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-6 col-sm-6">
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

        </div>
        <div class="col-md-3 col-sm-3"></div>
      </div>
      <div class="row">
      <div class="col"></div>
        <div class="col-12">
          
          <div id="weather"><?php

            if ($weather) {
            //echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
              echo '<h2>'.$weather.'</h2></br><h2 class="display-4">'.$response.'</h2>';
            } else if ($error) {
            echo '<h2>'.$error.'<h2>';

            }?>
          </div>

        </div>
        <div class="col"></div>
      </div>
    </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

  </body>
</html>