<?php

require_once "../autoloader.php";


$db = DB::getInstance();

$productName = $_REQUEST["productName"];
$productValue = $_REQUEST["productValue"];
$pid = $_REQUEST["pid"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = Product::getProduct($productName)->fetch_row();
    Cart::addItem($product, 1);
}
DB::closeConnection();

?>