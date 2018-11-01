<?php
    session_start();

    $error = "";

    if(array_key_exists("logout", $_GET)){
        unset($_SESSION);
        setcookie("id", "", time()-60*60);
        $_COOKIE["id"] = "";
    } else if ((array_key_exists("id", $_SESSION) and $_SESSION['id']) or
               (array_key_exists("id", $_COOKIE) and $_COOKIE['id'])){
        header("Location: home.php");
    }


    if(array_key_exists("submit", $_POST)){
        $link = mysqli_connect("shareddb1e.hosting.stackcp.net", "secret-diary-3637a194", "o3tvjnsr3z", "secret-diary-3637a194");
        
        if (mysqli_connect_error()){
            die("There was an error connecting to the database");
        }

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

                        $_SESSION['id'] = mysqli_insert_id($link);

                        if (array_key_exists("stayLoggedIn",$_POST) and $_POST['stayLoggedIn'] == 1){
                            setcookie("id", mysqli_insert_id($link), time() + 60*60*64*365);
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

                        if (array_key_exists("stayLoggedIn",$_POST) and $_POST['stayLoggedIn'] == 1){
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

<form method = "post">
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="password">
    <input type="checkbox" name="stayLoggedIn" value=1>
    <input type="hidden" name="signUp" value="1">
    <input type="submit" name="submit" value="Sign up"> 

</form>

<form method = "post">
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="password">
    <input type="checkbox" name="stayLoggedIn" value=1>
    <input type="hidden" name="signUp" value="0">
    <input type="submit" name="submit" value="Log in"> 
</form>

<div id="error"><?php echo $error; ?></div>
