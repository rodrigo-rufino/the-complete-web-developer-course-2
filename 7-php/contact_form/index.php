<?php
  $error = "";
  if($_POST){
    if(!$_POST["email"]){
      $error = $error."The email email is required.<br>";
    }

    if(!$_POST["subject"]){
      $error = $error."The subject email is required.<br>";
    }

    if(!$_POST["emailbody"]){
      $error = $error."The emailbody is required.<br>";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $error = $error."The email is invalid.<br>";
    }

    if($error != ""){
      $error = '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">'.
      $error.
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span></button></div>';
      
    } else {
      $headers = "From: ".$_POST["email"];
      if(mail($_POST["email"], $_POST["subject"], $_POST["emailbody"], $headers)){
        // Success
        $error = '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                  Email sent successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button></div>';
      } else {
        $error = '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                  Message couldnt be sent!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button></div>'; 
      } 
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

    <title>Hello, world!</title>
  </head>

  <body>
    <!-- Form -->
    <div class="container" style="margin-top: 20px">
      <h1 id="four">Get in Touch!</h1>
      <form method="post">
        <div class="form-group">
          <label for="email" class="col-sm-6">Email address</label>
          <div class="col-sm-6">
              <input id="email" name="email" type="email" class="form-control">
          </div>
        </div>

        <div class="form-group">
            <label for="subject" class="col-sm-6">Subject</label>
            <div class="col-sm-6">
              <input id="subject" name="subject" type="text" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="emailbody" class="col-sm-6">What would you like to ask us?</label>
            <div class="col-sm-6">
            <textarea class="form-control" id="emailbody" name="emailbody" rows="6"></textarea>
            </div>
        </div>

        <p id="error"><? echo $error; ?></p>

        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    <script type="text/javascript">

      $("form").submit(function(e){
        e.preventDefault();

        var error = "";

        if($("#email").val() == ""){
          error += "The subject email is required.<br>"
        }

        if($("#subject").val() == ""){
          error += "The subject field is required.<br>"
        }

        if ($("#emailbody").val() == ""){
          error += "The 'What would you like to ask us?' field is required.<br>"  
        }

        if(error != ""){
          $("#error").html('<div id="alert" class="alert alert-danger \
          alert-dismissible fade show" role="alert">' + error +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
          <span aria-hidden="true">&times;</span></button></div>'
          );
        } else {
          $("form").unbind("submit").submit();
        }
      });

      

      
    </script>
  </body>
</html>