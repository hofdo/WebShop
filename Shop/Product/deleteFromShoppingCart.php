<?php

require_once "../autoloader.php";


$db = DB::getInstance();

$sid = $_REQUEST["sid"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Cart::removeItem($sid);
}
DB::closeConnection();
