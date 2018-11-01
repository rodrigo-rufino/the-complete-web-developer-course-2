<?php
    session_start();
    //Connecting to database
    //      mysqli_connect(server, username, password, database);
    $link = mysqli_connect("shareddb-g.hosting.stackcp.net", "dbusers-32373a88", "n25g2mvstc", "dbusers-32373a88");
    
    if (mysqli_connect_error()){
        die("There was an error connecting to the database");
    }

    if(array_key_exists('name', $_POST) OR array_key_exists('surname', $_POST)){
        if ($_POST['name'] == ""){
            echo "<p>Name is required</p>";
        } else if ($_POST['surname'] == ""){
            echo "<p>Surname is required</p>";
        } else {
            $query = "SELECT `id` FROM `users` WHERE name = '".mysqli_real_escape_string($link, $_POST['name'])."'";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0){
                echo "<p> Name already taken</p>";
            } else {
                $query = "INSERT INTO `users` (`name`, `surname`) VALUES ('".
                mysqli_real_escape_string($link, $_POST['name'])."', '".
                mysqli_real_escape_string($link, $_POST['surname'])."')";
                
                if(mysqli_query($link, $query)){
                    $_SESSION['name'] = $_POST['name'];
                    header("Location: session.php");
                } else {
                    echo "<p>Problem signing in.</p>";
                }
            }
        } 
    }
?>


<!DOCTYPE html>
<html>

<body>
    <form method = "post">
        <input name="name" placeholder="Name">
        <input name="surname" placeholder="Surname">
        <input type="submit" value="Submit">
        
    </form>
</body>
</html>