<?php

require "../Entity/DB.php";
require "../Entity/User.php";
require "../Entity/Admin.php";

$db = DB::getInstance();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_escape_string($db, $_POST['username']);
    $password = mysqli_escape_string($db, $_POST['password']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $firstName = mysqli_escape_string($db, $_POST['firstname']);
    $lastName = mysqli_escape_string($db, $_POST['lastname']);

    $uid = $_SESSION["uid"];
    try {
        if (isset($username) && $username != $_SESSION["username"]) {
            User::updateUser($uid, "username", $username);
        }
        if (isset($password)) {
            User::updateUser($uid, "password", $password);
        }
        if (isset($email) && $email != $_SESSION["email"]) {
            User::updateUser($uid, "email", $email);
        }
        if (isset($firstName) && $firstName != $_SESSION["firstname"]) {
            User::updateUser($uid, "firstname", $firstName);
        }
        if (isset($lastName) && $lastName != $_SESSION["lastname"]) {
            User::updateUser($uid, "lastname", $lastName);
        }

        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["firstname"] = $firstName;
        $_SESSION["lastname"] = $lastName;

    }catch (Exception $exception){

    }
    header("location: ../Pages/Home.php");

}
DB::closeConnection();


?>