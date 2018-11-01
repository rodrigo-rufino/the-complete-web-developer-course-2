<?php
    //Connecting to database
    //      mysqli_connect(server, username, password, database);
    $link = mysqli_connect("shareddb-g.hosting.stackcp.net", "dbusers-32373a88", "n25g2mvstc", "dbusers-32373a88");
    
    if (mysqli_connect_error()){
        die("There was an error connecting to the database");
    }

    //Inserting and Updating data
    // $query = "INSERT INTO `users` (`name`, `surname`) VALUES('Luna', 'Bruna')";
    $query = "UPDATE `users` SET surname='Bhror' WHERE id=1 LIMIT 1";
    mysqli_query($link, $query);    
    

    //Retrieving data
    $query = "SELECT * FROM users";
    
    if($result = mysqli_query($link, $query)){
        // echo "Query successful";

        //Looping through data
        while($row = mysqli_fetch_array($result)){
            echo "Your full name is ".$row['name']." ".$row["surname"]."<br>";    
        }
        
    }

    // $query = "SELECT 'email' FROM users WHERE name = '".$name."'";
    $name = "Luna";
    $query = "SELECT `surname` FROM users WHERE name = '".mysqli_real_escape_string($link, $name)."'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    print_r($row);

    // security
    //     md5
    //     salt
    //     salt by id


?>