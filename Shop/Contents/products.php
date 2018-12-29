<?php
require_once "../SQLDB/Session.php";
require_once "../Entity/Product.php";
require_once "../Entity/DB.php";

$categories = get_param('categories', 'all');
if ($categories == 'all') {
    $result = product::getAllProducts();
} else {
    $result = Product::getProductByCategories($categories);
}
echo '<h1>';
echo t("products");
if ($categories != "all"){
    echo ": ".t($categories);
}
echo '</h1>';

$products = $result->fetch_all();
foreach ($products as $product) {
    Product::renderProduct($product);
}