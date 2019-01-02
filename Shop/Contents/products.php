<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

?>

<script src="../js/Products.js"></script>

<?php
$categories_id = get_param('categories', '0');
if ($categories_id == '0') {
    $result = product::getAllProducts();
} else {
    $result = Product::getProductByCategories($categories_id);
}
echo '<h1>';
echo t("products");
if ($categories_id != "0"){
    $query = "SELECT category FROM categories WHERE cid=$categories_id";
    $res = (DB::doQuery($query))->fetch_all();
    echo ": ".t($res[0][0]);
}
echo '</h1>';

$products = $result->fetch_all();
foreach ($products as $product) {
    Product::renderProduct($product);
}

?>