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
            $uid = mysqli_escape_string($db, $_REQUEST['uid']);


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

    DB::closeConnection();

?>