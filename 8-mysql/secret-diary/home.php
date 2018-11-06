<?php
    session_start();

    $diaryContent = "";
    $email = "";
    if (array_key_exists("id", $_COOKIE)){
        $_SESSION["id"] = $_COOKIE["id"];
    }

    if (array_key_exists("id", $_SESSION)){
        echo "<p><a href='index.php?logout=1'>Log out</a></p>";

        include("connection.php");

        $query = "SELECT diary FROM users WHERE id = ".
            mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        $row = mysqli_fetch_array(mysqli_query($link, $query));
        $diaryContent = $row['diary'];

        $query = "SELECT email FROM users WHERE id = ".
            mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        $row = mysqli_fetch_array(mysqli_query($link, $query));
        $email = $row['email'];


    } else {
        header("Location: index.php");    
    }
?>

<?php include("header.php") ?>

<div class="container-fluid">
    <h1>Bem vindo de volta, <?php echo $email; ?>!</h1>
    <textarea id="diary" class="form-control"><?php echo $diaryContent ?></textarea>
</div>

<?php include("footer.php") ?>