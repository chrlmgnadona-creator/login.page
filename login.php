<?php

session_start();

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = mysqli_real_escape_string($link, $_POST["username"]);
    $password = mysqli_real_escape_string($link, $_POST["password"]);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    if($result = mysqli_query($link, $sql)){

        if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_array($result);

            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];

            header("Location: dashboard.php");
            exit();

        } else {

            echo "Invalid username or password.";

        }

    } else {

        echo "Oops! Something went wrong. Please try again later.";

    }

    mysqli_close($link);
}

?>