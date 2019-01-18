<?php

require_once "../autoloader.php";

$db = DB::getInstance();

$username = $_REQUEST["username"];
User::deleteUser($username);
DB::closeConnection();
