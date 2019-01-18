<?php

require_once "../autoloader.php";

$db = DB::getInstance();

$productName = $_REQUEST["name"];
Product::deleteProduct($productName);
DB::closeConnection();
