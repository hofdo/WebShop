<?php

require_once "../autoloader.php";


$db = DB::getInstance();

$sid = $_REQUEST["sid"];
$quantity = $_REQUEST["quantity"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    Cart::changeQuantity($sid, $quantity);
}
DB::closeConnection();

?>