<?php

require_once "../Entity/DB.php";
require_once "../Entity/ShoppingCart.php";
require_once "../Entity/Product.php";


$db = DB::getInstance();

$productName = mysqli_escape_string($db, $_REQUEST["productName"]);
$productValue = mysqli_escape_string($db, $_REQUEST["productValue"]);
$pid = mysqli_escape_string($db, $_REQUEST["pid"]);

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $product = Product::getProductAndCategoryID($productName)->fetch_row();
    Cart::addItem($product, 1);

}
DB::closeConnection();

?>