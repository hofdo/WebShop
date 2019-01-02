<?php

require_once "../autoloader.php";

$db = DB::getInstance();

$username = $_REQUEST["username"];
$row = User::getUser($username)->fetch_row();
echo $row[0] . ";" . $row[1] . ";" . $row[2] . ";" . $row[3] . ";" . $row[4] . ";" . $row[5];

DB::closeConnection();


?>