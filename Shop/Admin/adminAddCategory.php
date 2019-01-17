<?php

require_once "../autoloader.php";

$db = DB::getInstance();

$category = mysqli_escape_string($db, $_REQUEST['name']);

$resultName = Product::checkCategoryExists($category);

if (!$resultName){
    Product::createCategory($category);
}

echo $resultName;

DB::closeConnection();

?>