<?php

require "../Entity/DB.php";
require "../Entity/User.php";
require "../Entity/Admin.php";

$db = DB::getInstance();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_escape_string($db, $_POST['username']);
    $password = mysqli_escape_string($db, $_POST['password']);



    if (User::checkLogin($username, $password)){
        $user = User::getUser($username)->fetch_row();
        $_SESSION["uid"] = $user[0];
        $_SESSION["username"] = $user[1];
        $_SESSION["firstname"] = $user[3];
        $_SESSION["lastname"] = $user[4];
        $_SESSION["email"] = $user[5];
        $_SESSION["logged_in"]=true;
    }
    else {
        echo "<p>Wrong username and/or password</p>";
        echo "<p>Please try again: <a href='../Pages/Home.php'>Home</a></p>";
    }

    header("location: ../Pages/Home.php");

}
DB::closeConnection();
