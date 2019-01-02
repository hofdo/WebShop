<?php

require_once "../autoloader.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {


    $user = new User(strtolower($_POST["username"]), $_POST["password"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);

    if (!($user->checkUserExists($_POST["username"])) && isset($user)) {
        $user->createUser();

        $_SESSION["username"] = $_POST["username"];
        $_SESSION["firstname"] = $_POST["firstName"];
        $_SESSION["lastname"] = $_POST["lastName"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["logged_in"] = true;

        header("Location: ../Pages/Home.php");
    } else {
        echo "User already exists";
    }
}

?>