<?php
	
	//Declaring variables just to make sure no errors appear in case they don't get assigned any values.
	$weather = "";
	$error = "";
	$response = "";

	if (array_key_exists('city', $_GET)) {

		//Calling the API server
		$weatherUrl = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&APPID=c991a799fb3183a5142203a6f90d0a75");
		$weatherArray = json_decode($weatherUrl, true); //The 2nd parameter is for making an associative array
		//print_r($weatherArray); //Just viewing all the weather data for development purposes

		if ($weatherArray['cod'] == 200) { //Making sure the API server recognizes the name of the city

			$tempinCelcius = intval($weatherArray['main']['temp']-273); //Converting from Kelvin to Celcius
			//$weather = "The Temperature in ".$weatherArray['name'].", ".$weatherArray['sys']['country']." is currently ".$tempinCelcius."&deg;C";
			//$weather .= "<br/>With ".$weatherArray['weather'][0]['description'];
			$weather = $tempinCelcius."&deg;C</br>".$weatherArray['name'].", ".$weatherArray['sys']['country'];

		} else { //If not, warn the user about it!

			$error = "No one knows where that is! Please type the name of a real city.";

		}

		// This array includes all the responses for the different temperature ranges
		$responses = array(
			"Nice my ass. It's freezing out there!", // Below 0
			"Yes, it is. Just don't go out in light clothes!", // (0 - 9)
			"Fuck yeah, it is. Get out and dance!", // (10 - 19)
			"Yes, it is. just make sure your clothes are not heavy!", // (20 - 29)
			"Good luck getting BBQed out there!", // 30 or above
		);

		switch ($tempinCelcius) {
			case ($tempinCelcius < 0):
				$response = $responses[0];
				break;

			case ($tempinCelcius < 10):
				$response = $responses[1];
				break;

			case ($tempinCelcius < 20 ):
				$response = $responses[2];
				break;

			case ($tempinCelcius < 30):
				$response = $responses[3];
				break;
			
			default:
				$response = $responses[4];
				break;
		}

	}

	// Try Cairo, london, toronto, juneau, sao paolo, moscow, warsaw, paris, mexico city, new york, vancouver, kiev, oslo, canberra, kuala lumpur, abuja, helsinki, madrid, Buenos Aires, khartoum, tel aviv
?>