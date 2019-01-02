<?php

require_once "../Entity/DB.php";
require_once "../Entity/ShoppingCart.php";
require_once "../Entity/Product.php";


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