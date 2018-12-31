<?php

require "../Entity/DB.php";
require "../Entity/Product.php";
require "../Entity/ShoppingCart.php";


$db = DB::getInstance();

if($_SERVER["REQUEST_METHOD"] == "POST") {

}

DB::closeConnection();

?>