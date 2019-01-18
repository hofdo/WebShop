<?php

require_once "../autoloader.php";

$db = DB::getInstance();

$username = $_REQUEST["username"];
$result = Product::getOrderIDsByUsername($username);
$count = $result->num_rows;
$orderIDs = $result->fetch_all();
$str = "";

if ($count != 0) {
    foreach ($orderIDs as $orderID) {
        $products = Cart::getItemsByOrderID($orderID)->fetch_all();
        $str .= "|" . $orderID[0] . ":";
        foreach ($products as $product) {
            $str .= $product[0] . "," . $product[1] . "," . $product[2] . "," . $product[3] . ";";
        }
    }
    echo $str;
} else {
    echo "No orders made yet" . "|" . "0";
}

DB::closeConnection();
