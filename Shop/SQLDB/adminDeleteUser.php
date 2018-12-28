<?php

require "../Entity/DB.php";
require "../Entity/User.php";
require "../Entity/Admin.php";

$db = DB::getInstance();

$username = $_REQUEST["username"];
$row = User::getUser($username)->fetch_row();
User::deleteUser($username);

DB::closeConnection();


?>