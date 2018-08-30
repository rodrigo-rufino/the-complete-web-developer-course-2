<?php
  $error = "";
  $weather = "";

  if(array_key_exists('city', $_POST)){
    //https://www.weather-forecast.com/locations/London/forecasts/latest
    $city =  str_replace(" ", "-", $_POST["city"]);
    $page = 'http://completewebdevelopercourse.com/locations/'.$city;
    $file_headers = @get_headers($page);

    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
      $error = $error.'City not found.<br>';
    } else {
      $pageContent = file_get_contents($page);
      $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $pageContent);

      if(sizeof($pageArray) >= 2){
        $summary = explode('</span></span></span></p>', $pageArray[1]);
        $summary = $summary[0];
        $weather = '
        <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Weather</h5>
          <p class="card-text">'.$summary.'</p>
          </div>
        </div>';
      } else {
        $error = $error."Error gathering the weather data.";
      }
    }

    if ($error != ""){
      $error = '<div class="alert alert-danger" role="alert">'.
                $error.
               '</div>';
    }
  }
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Weather Scraper</title>

    <style type="text/css">
      .container{
        text-align: center;
        width: 500px;
        margin-top: 200px;
      }

      body{
        background: url(https://www.hellobc.com/content/uploads/2018/03/Climate-Weather_Mountains.png)
                    no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <h1>What's The Weather?</h1>      
      <form method="POST">
        <div class="form-group">
          <label for="city">Enter the name of a city.</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
        </div>
        <button type="submit" class="btn btn-secondary">Get Weather!</button>
      </form>

      <div>
        <?
          echo $weather.$error;
        ?>
      </div>
    </div>


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>