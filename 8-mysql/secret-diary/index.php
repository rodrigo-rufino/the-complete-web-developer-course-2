<?php
    session_start();

    $error = "";

    if (array_key_exists("logout", $_GET)) {
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        session_destroy();
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id'])
            OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        header("Location: home.php");
    }


    if(array_key_exists("submit", $_POST)){
       
        include("connection.php");
        if(!$_POST['email']){
            $error .= "An email address is required.<br>";
        }

        if(!$_POST['password']){
            $error .= "A password is required.<br>";
        }

        if($error != ""){
            $error = "<p>There were errors in your form</p>"; 
        } else {
            
            if ($_POST["signUp"] == 1){
                $query = "SELECT id FROM `users` WHERE email = '".
                mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                
                $result = mysqli_query($link, $query);
                
                if(mysqli_num_rows($result)>0){
                    $error .= "That email address is taken.";
                } else {
                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".
                    mysqli_real_escape_string($link, $_POST['email'])."', '".
                    mysqli_real_escape_string($link, $_POST['password'])."')";
                    
                    if (!mysqli_query($link, $query)) {
                        $error = "<p>Could not sign you up.</p>";
                    } else {

                        $query = "UPDATE `users` SET password = '".
                        md5(md5(mysqli_insert_id($link)).$_POST['password']).
                        "' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        
                        mysqli_query($link, $query);

                        $query = "SELECT id FROM `users` WHERE email = '".
                        mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                        $result = mysqli_query($link, $query);

                        $row = mysqli_fetch_Array($result);

                        $_SESSION['id'] = $row['id'];

                        if (array_key_exists('stayLoggedIn', $_POST) and 
                            ($_POST['stayLoggedIn'] == '1')) {
                            setcookie("id",  $row['id'], time() + 60*60*24*365);
                        } 

                        header("Location: home.php");
                    }
                }
            } else {
                $query = "SELECT * FROM `users` WHERE email = '".
                mysqli_real_escape_string($link, $_POST['email'])."'";

                $result = mysqli_query($link, $query);

                $row = mysqli_fetch_Array($result);

                if(isset($row)){
                    
                    $hashedPassword = md5(md5($row['id']).$_POST['password']);
                    
                    if ($hashedPassword == $row['password']){
                        $_SESSION['id'] = $row['id']; 

                        if (array_key_exists('stayLoggedIn', $_POST) and 
                            ($_POST['stayLoggedIn'] == '1')){
                            setcookie("id", mysqli_insert_id($link), time() + 60*60*64*365);
                        }
    
                        header("Location: home.php");  
                    
                    }else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                } else {
                        
                    $error = "That email/password combination could not be found.";
                    
                }
            }
            
        }
    }
?>

<?php include("header.php");?>

<div class="container col-md-4">
    <h1>Secret Diary</h1>

    <form method = "post" id="signUpForm">
        <h3>Sign Up</h3>
        <div class="form-group align-items-center">
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input type="checkbox" name="stayLoggedIn" class="form-check-input" id="exampleCheck1" value=1>
            <label class="form-check-label" for="exampleCheck1">Stay Logged in</label>
        </div>
        <input type="hidden" name="signUp" value="1">
        <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
        <p><a href="#" class="toggleForms">Log In!</a></p>  
    </form>   

    <form method = "post" id="loginForm">
        <h3>Login</h3>
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input type="checkbox" name="stayLoggedIn" class="form-check-input" id="exampleCheck1" value=1>
            <label class="form-check-label" for="exampleCheck1">Stay Logged in</label>
        </div>
        <input type="hidden" name="signUp" value="0">
        <button type="submit" name="submit" class="btn btn-primary">Log in</button>
        <p><a href="#" class="toggleForms">Sign up!</a></p>
    </form> 

    
</div>

<div id="error"><?php echo $error; ?></div>

<?php include("footer.php");?>

