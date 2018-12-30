<?php

require "../Entity/DB.php";
require "../Entity/User.php";

$db = DB::getInstance();

$username = $_REQUEST["username"];
User::deleteUser($username);
DB::closeConnection();


?>