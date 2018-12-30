<?php

require "../Entity/DB.php";
require "../Entity/Product.php";

$db = DB::getInstance();

$productName = $_REQUEST["name"];
Product::deleteProduct($productName);
DB::closeConnection();


?>