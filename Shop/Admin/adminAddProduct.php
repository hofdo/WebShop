<?php

require "../Entity/DB.php";
require "../Entity/Product.php";



$db = DB::getInstance();
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_escape_string($db, $_REQUEST['productName']);
    $value = mysqli_escape_string($db, $_REQUEST['value']);
    $category = mysqli_escape_string($db, $_REQUEST['category']);

    $resultName = Product::checkProductExists($name);

        try {
            $product = new Product($name, $category, $value);

            if (!($resultName) && isset($name)) {
                $product->createProduct();
            }
        } catch (Exception $exception) {

        }
    }
    $pid = Product::getProduct($name)->fetch_row()[0];
    echo $pid . ";" . $resultName;

DB::closeConnection();

?>