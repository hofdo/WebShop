<?php

require "../Entity/DB.php";
require "../Entity/User.php";
require "../Entity/Admin.php";



$db = DB::getInstance();
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_escape_string($db, $_REQUEST['username']);
    $password = mysqli_escape_string($db, $_REQUEST['password']);
    $email = mysqli_escape_string($db, $_REQUEST['email']);
    $firstName = mysqli_escape_string($db, $_REQUEST['firstname']);
    $lastName = mysqli_escape_string($db, $_REQUEST['lastname']);


    try {
        $user = new User($username, $password, $firstName, $lastName, $email);

        if (!($user->checkUserExists($username)) && isset($user)) {
            $user->createUser();
        }
    } catch (Exception $exception) {

    }
}

DB::closeConnection();

?>