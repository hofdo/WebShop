<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";


$db = DB::getInstance();

if($_SERVER["REQUEST_METHOD"] == "POST") {

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
        $expireDate = $_REQUEST["expireDate"];
        $cvv = $_REQUEST["cvv"];

        if (!Cart::isEmpty()){
            $orderID = Product::getOrderID($_SESSION["username"]);
            $query = "";
        }
        echo $orderID;
        //echo $firstName . "_" . $lastName . "_" . $email . "_" . $address . "_" . $plz . "_" . $state . "_" . $country . "_" . $paymentMethod . "_" . $holderName . "_" . $cardNumber . "_" . $expireDate . "_" . $cvv;
    }
    //echo $firstName . "_" . $lastName . "_" . $email . "_" . $address . "_" . $plz . "_" . $state . "_" . $country . "_" . $paymentMethod;
}


DB::closeConnection();

?>