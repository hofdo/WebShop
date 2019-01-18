<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

$db = DB::getInstance();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_escape_string($db, $_REQUEST['username']);
    $oldUsername = mysqli_escape_string($db, $_REQUEST['oldUsername']);
    $password = mysqli_escape_string($db, $_REQUEST['password']);
    $email = mysqli_escape_string($db, $_REQUEST['email']);
    $firstName = mysqli_escape_string($db, $_REQUEST['firstname']);
    $lastName = mysqli_escape_string($db, $_REQUEST['lastname']);
    $uid = mysqli_escape_string($db, $_REQUEST['uid']);

    $_SESSION["username"] = $username;
    $_SESSION["firstName"] = $firstName;
    $_SESSION["lastName"] = $lastName;
    $_SESSION["email"] = $email;

    $result = User::checkUserExists($username);

    if (!($result) || $oldUsername == $username) {

        try {
            if (isset($username)) {
                User::updateUser($uid, "username", $username);
            }
            if (isset($password)) {
                User::updateUser($uid, "password", $password);
            }
            if (isset($email)) {
                User::updateUser($uid, "email", $email);
            }
            if (isset($firstName)) {
                User::updateUser($uid, "firstname", $firstName);
            }
            if (isset($lastName)) {
                User::updateUser($uid, "lastname", $lastName);
            }

        } catch (Exception $exception) {

        }
    }
    echo $result;
}

DB::closeConnection();
