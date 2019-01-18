<?php

require_once "../autoloader.php";

$db = DB::getInstance();

$productName = $_REQUEST["name"];
$row = Product::getProductAndCategoryID($productName)->fetch_row();
echo $row[0] . ";" . $row[1] . ";" . $row[2] . ";" . $row[4];

DB::closeConnection();
