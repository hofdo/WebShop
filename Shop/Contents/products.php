<?php

require_once "../autoloader.php";

$category = get_param('q', '0');
if ($category == '0') {
    $result = product::getAllProducts();
} else {
    $result = Product::getProductByCategory($category);
}
echo '<h1>';
echo t("products");
if ($category != "0") {
    echo ": " . t($category);
}
echo '</h1>';
echo "<div class='products'>";
$products = $result->fetch_all();
foreach ($products as $product) {
    Product::renderProduct($product);
}
echo "</div>";
