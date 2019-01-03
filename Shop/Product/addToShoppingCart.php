<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";


$db = DB::getInstance();

$productName = $_REQUEST["productName"];
$productValue = $_REQUEST["productValue"];
$pid = $_REQUEST["pid"];

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_SESSION["username"];
    $product = Product::getProduct($productName)->fetch_row();
    Cart::addItem($product, 1);

    $orderID = Product::getOrderID($username);

    $query = "SELECT quantity, sid FROM shoppingcart INNER JOIN products AS p ON p.pid = shoppingcart.product_id INNER JOIN orders AS o ON o.oid = shoppingcart.order_id WHERE o.name = '$orderID' AND pid = '$pid'";
    $result = DB::doQuery($query);
    $count = $result->num_rows;
    if ($count != 0) {
        $str = $result->fetch_row();
        echo $str[0] . "_" . $str[1];
        }
    else{
        echo 0;
    }
}
DB::closeConnection();

?>