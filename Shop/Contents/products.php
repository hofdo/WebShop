<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

?>

<script src="../js/Products.js"></script>

<?php
$category = get_param('q', '0');
if ($category== '0') {
    $result = product::getAllProducts();
} else {
    $result = Product::getProductByCategory($category);
}
echo '<h1>';
echo t("products");
if ($category != "0"){
    echo ": ".t($category);
}
echo '</h1>';

$products = $result->fetch_all();
foreach ($products as $product) {
    Product::renderProduct($product);
}

?>