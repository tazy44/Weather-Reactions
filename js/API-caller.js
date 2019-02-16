function bringWeather() {

  var city = $('#cityField').val();
  var url = 'http://api.openweathermap.org/data/2.5/weather?q='+city+'&APPID=c991a799fb3183a5142203a6f90d0a75';
  var response = ''; //The App's text reaction to user
  var bg = ''; //A background generated from Unsplash
  var img = new Image(); //An Image object to hold the bg and make sure it is fully loaded before it shows
  var responses = [
    "Not at all. It's freezing out there!", // Below 0
    "Kind of. It's a little chilly though!", // (0 - 9)
    "Hell yeah, it is. Get out and dance!", // (10 - 19)
    "Yes. It's a little warm though!", // (20 - 29)
    "Good luck getting BBQed out there!" // 30 or above]
  ];

  $.getJSON (url, function(res) { //The callback function in case the request is successful
    tempinCelcius = parseInt(res['main'].temp)-273; //Converting Temperature from Kelvin to Celcius

    //Based on the temperature range, a response displays and colors transition.
    //The response displays in callback function to force the new response to
    //display after the old response has already faded out

    function displayResults (bg, response, icon, classToAdd, classesToRemove) {
      img.src = 'https://source.unsplash.com/1600x900/?'+bg;
      $('#weather').find('h3').fadeOut(300, function() {
        $(this).html(response).fadeIn(300);
        $('body').addClass(classToAdd, 1000)
        .removeClass(classesToRemove[0]+' '+classesToRemove[1]+' '+classesToRemove[2]+' '+classesToRemove[3]);
      });
      $('#weather').find('h2')
                  .html(tempinCelcius+'&deg;C <div class="'+icon+'"></div></br>'+res['name']+', '+res['sys'].country)
                  .slideDown(1000);
      $('h4').fadeIn(8000, "linear");
      if (img.complete) { //Making sure the new image is fully downloaded before displaying
        showNewBg();
      } else {
        img.addEventListener('load', showNewBg)
        img.addEventListener('error', function() {
            //Show the default bg saved on your server
            //alert('error');
        })
      } 
    }

    function showNewBg() {
      $('html').css({
        "background" : "url("+img.src+") no-repeat center center fixed",
        "-webkit-background-size": "cover",
        "-moz-background-size": "cover",
        "-o-background-size": "cover",
        "background-size": "cover"
      });
    }

    switch (true) {
      case tempinCelcius < 0:
        response = responses[0];
        bg  = 'cold';
        icon = 'icon-snow-flake';
        classToAdd = 'reaction-zero';
        classesToRemove = ['reaction-one', 'reaction-two', 'reaction-three', 'reaction-four'];
        displayResults(bg, response, icon, classToAdd, classesToRemove);
        break;

      case tempinCelcius < 10:
        response = responses[1];
        bg  = 'chill';
        icon = 'icon-hat';
        classToAdd = 'reaction-one';
        classesToRemove = ['reaction-zero', 'reaction-two', 'reaction-three', 'reaction-four'];
        displayResults(bg, response, icon, classToAdd, classesToRemove);
        break;

      case tempinCelcius < 20 :
        response = responses[2];
        bg  = 'dance';
        icon = 'icon-dance';
        classToAdd = 'reaction-two';
        classesToRemove = ['reaction-zero', 'reaction-one', 'reaction-three', 'reaction-four'];
        displayResults(bg, response, icon, classToAdd, classesToRemove);
        break;

      case tempinCelcius < 30:
        response = responses[3];
        bg  = 'summer';
        icon = 'icon-sun-heart';
        classToAdd = 'reaction-three';
        classesToRemove = ['reaction-zero', 'reaction-one', 'reaction-two', 'reaction-four'];
        displayResults(bg, response, icon, classToAdd, classesToRemove);
        break;
      
      default:
        response = responses[4];
        bg  = 'hot';
        icon = 'icon-bbq';
        classToAdd = 'reaction-four';
        classesToRemove = ['reaction-zero', 'reaction-one', 'reaction-two', 'reaction-three'];
        displayResults(bg, response, icon, classToAdd, classesToRemove);
        break;
    }

  })
  .fail(function() { //Error handler in case the user enters an unrecognized city
    resHTML = '<h3 class="display-4">I would tell you If you entered a real place!</h3>';
    $('#weather').html(resHTML);
  });            

}
      
// Try Cairo, london, toronto, juneau, sao paolo, moscow, lviv, warsaw, paris, mexico city, new york,
// vancouver, kiev, oslo, canberra, kuala lumpur, abuja, helsinki, madrid, Buenos Aires, khartoum, tel aviv   