<?php

require_once "../autoloader.php";
require_once "../Pages/helper.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {


    $user = new User(strtolower($_POST["username"]), $_POST["password"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
    $username = $_POST["username"];

    if (!($user->checkUserExists($_POST["username"])) && isset($user)) {
        $user->createUser();

        $_SESSION["uid"] = DB::doQuery("SELECT uid FROM `users` WHERE username = '$username'")->fetch_row()[0];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["firstname"] = $_POST["firstName"];
        $_SESSION["lastname"] = $_POST["lastName"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["logged_in"] = true;


        header("Location: /Shop/" . get_param('lang', 'de') . "/home");
    } else {
        header("Location: /Shop/" . get_param('lang', 'de') . "/home");
    }
}