<?php

require "../Entity/DB.php";
require "../Entity/Product.php";

$db = DB::getInstance();

$productName = $_REQUEST["name"];
$row = Product::getProduct($productName)->fetch_row();
echo $row[0] . ";" . $row[1] . ";" . $row[2] .  ";" . $row[4];

DB::closeConnection();


?>