<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";


$db = DB::getInstance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $gender = $_REQUEST["gender"];
    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $email = $_REQUEST["email"];
    $address = $_REQUEST["address"];
    $plz = $_REQUEST["plz"];
    $state = $_REQUEST["state"];
    $country = $_REQUEST["country"];
    $paymentMethod = $_REQUEST["paymentMethod"];

    if ($paymentMethod == "Credit Card") {
        $holderName = $_REQUEST["holderName"];
        $cardNumber = $_REQUEST["cardNumber"];
        $expireDateMonth = $_REQUEST["expireDateMonth"];
        $expireDateYear = $_REQUEST["expireDateYear"];
        $cvv = $_REQUEST["cvv"];
    }

    /*
     * If we had a Mail-server we would have sended a confirmation-mail here.
     */

    if (!Cart::isEmpty()) {
        $orderID = Product::getOrderID($_SESSION["username"]);
        $query = "UPDATE `orders` SET `open` = '0' WHERE name = '$orderID'";
        DB::doQuery($query);
    }
}


DB::closeConnection();
