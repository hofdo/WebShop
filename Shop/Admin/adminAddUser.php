<?php

require_once "../autoloader.php";

$db = DB::getInstance();
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = strtolower(mysqli_escape_string($db, $_REQUEST['username']));
    $password = mysqli_escape_string($db, $_REQUEST['password']);
    $email = mysqli_escape_string($db, $_REQUEST['email']);
    $firstName = mysqli_escape_string($db, $_REQUEST['firstname']);
    $lastName = mysqli_escape_string($db, $_REQUEST['lastname']);

    $result = User::checkUserExists($username);

        try {
            $user = new User($username, $password, $firstName, $lastName, $email);

            if (!$result && isset($user)) {
                $user->createUser();
            }
        } catch (Exception $exception) {

        }
    }
    $uid = User::getUser($username)->fetch_row()[0];
    echo $uid . ";" . $result;

DB::closeConnection();

?>