  <?php
    $error = "";
    $weather = "";
    $appid = '01daa2981ac47496e8681388d984f7a4';
    
    if($_GET['city'] and array_key_exists('city', $_GET)){
      $url = 'https://api.openweathermap.org/data/2.5/weather?q='.
          $_GET['city'].
          '&appid='.$appid;
      // $urlContents =  file_get_contents($url);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
      $urlContents = curl_exec($ch);
      curl_close($ch);

      echo $url;
      
      $weatherArray = json_decode($urlContents, true);

      if($weatherArray['cod'] == 200){
        $weather = "The weather in ".$_GET['city']." is currently '".
            $weatherArray['weather'][0]['description']."'. ";
        $weather .= "The temperature is ".($weatherArray['main']['temp']-273)." &degC";
      } else {
        $error .= "City not found.";
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
      <form method="GET">
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
