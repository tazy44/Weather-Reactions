function bringWeather() {

  var city = $('#cityField').val();
  var url = 'http://api.openweathermap.org/data/2.5/weather?q='+city+'&APPID=c991a799fb3183a5142203a6f90d0a75';
  var resHTML = '';
  var response = '';
  var responses = [
    "Nice my ass. It's freezing out there!", // Below 0
    "Kind of. It's a little chilly though!", // (0 - 9)
    "Fuck yeah, it is. Get out and dance!", // (10 - 19)
    "Yes, it is. It's a little warm though!", // (20 - 29)
    "Good luck getting BBQed out there!" // 30 or above]
  ];

  $.getJSON (url, function(res) { //The callback function in case the request is successful
    tempinCelcius = parseInt(res['main'].temp)-273; //Converting Temperature from Kelvin to Celcius

    switch (true) {
      case tempinCelcius < 0:
        response = responses[0];
        break;

      case tempinCelcius < 10:
        response = responses[1];
        break;

      case tempinCelcius < 20 :
        response = responses[2];
        break;

      case tempinCelcius < 30:
        response = responses[3];
        break;
      
      default:
        response = responses[4];
        break;
    }

    resHTML += '<h2>'+tempinCelcius+'&deg;C</h2></br><h3 class="display-4">'+response+'</h3>';
    $('#weather').html(resHTML);

  })
  .fail(function() { //Error handler in case the user enters an unrecognized city
    resHTML = '<h2>I would tell you</h2></br><h3 class="display-4">If you entered a real place!</h3>';
    $('#weather').html(resHTML);
  });            

}
      
// Try Cairo, london, toronto, juneau, sao paolo, moscow, lviv, warsaw, paris, mexico city, new york,
// vancouver, kiev, oslo, canberra, kuala lumpur, abuja, helsinki, madrid, Buenos Aires, khartoum, tel aviv   