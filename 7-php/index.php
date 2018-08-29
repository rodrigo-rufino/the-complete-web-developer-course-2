<?php
    /*
    // Variables
    echo "Hello world!<br>";

    $name = "Rob<br>";
    echo $name;

    $string1 = "String 1";
    $string2 = "String 2";
    echo $string1, " ", $string2, "<br>";

    $n = 45;
    $s = $n + 1;
    echo $n, "<br>";

    $myBool = true;
    // 1 for true
    
    $variableName = "name";
    echo $$variableName;


    // Arrays
    $myArray = array("A", "B", "C");
    //echo $myArray; //Error
    print_r($myArray);
    echo $myArray[0];

    $anotherArray[0] = "A";
    $anotherArray[1] = "B";
    $anotherArray[2] = "C";
    $anotherArray["Three"] = "D";
    print_r($anotherArray);

    $thirdArray = array(
        "One" => "1",
        "Two" => "2"
    );

    echo sizeof($thirdArray), "<br>";
    unset($thirdArray["Two"]);


    // If Statements
    $user = "rob";
    if($user == "rob"){
        echo "Hello rob!", "<br>";
    } else {
        echo "Not rob!", "<br>";
    }


    // For and For Each
    for($i = 0; $i<10; $i++){
        echo $i, "<br>";
    }

    foreach($myArray as $key => $value){
        $myArray[$key] = $value."ooooooo";
        echo "Item ", $key, " is ", $myArray[$key], "<br>";
    }
    print_r($myArray);

    

    // GET Variables

    print_r($_GET);
    // Check if prime with GET
    if (is_numeric($_GET['number'])){
        $i = 2;
        $isPrime = true;
        while($i < $_GET['number']){
            if($_GET['number']%$i == 0){
                // Number is not prime
                $isPrime = false;
            }
            $i++;
        }

        if($isPrime){
            echo "<p>".$_GET['number']." is prime!</br>";
        } else {
            echo "<p>".$_GET['number']." is not prime!</br>";
        }
    }
    


    //POST Variables
    print_r($_POST);


    */
    // Sending Email with php
    $emailTo = "rodrigo.srs.br@gmail.com";
    $subject = "Email with php";
    $body = "Tch tch!";
    $headers = "From: rodrigo.srs.br@gmail.com";

    if(mail($emailTo, $subject, $body, $headers)){
        echo "The email was sent successfully";
    }
?>

<html>
    <form method="post">
        <p> Please enter a number </p>
        <input name="number" type="text">
        <input type="submit" value="Go!">
    </form>
</html>