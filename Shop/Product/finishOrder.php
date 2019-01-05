<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";


$db = DB::getInstance();

if($_SERVER["REQUEST_METHOD"] == "POST") {

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


    $str = "";
    $totalValue = 0;
    foreach (Cart::getItems()->fetch_all() as $item) {
        $totalValue += $item[5];
        $str .= "<tr><td>" . $item[1] . "</td><td> . $item[2] . </td><td> . $item[5] . </td><td> . $item[4]. </td><td>" . "\n";
    }

    $mailtext = "<html>
        <head>
            <title>Bestätigungsemail Bestellung</title>
        </head>
        
        <body>
        
        <h1>Bestätigung Bestellung</h1>
        
        <p>Sehr geehrte/er " . $gender . " " . $firstName . " " . $lastName . "</p>
        
        <p>Sie haben folgende Produkte bestellt</p>
        <table border='1'>
            <tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr>" .
        $str .
        "</table>
            
        <h2>Zahlungsmittel: </h2>
        
        <p>Sie haben sich entschieden die Produkte mit folgender Zahlungsmethode zu bezahlen:</p>
        <p>Zahlungsmittel:" . $paymentMethod . "</p>
        
        <h2>Persönliche Angaben:</h2>
        <p>Die Produkte werden an die unten genannte Addresse geliefert.</p>
        <p>Bitte überprüfen Sie ihre Angaben erneut und melden sie falls es Fehler geben sollte.</p>
        
        <table>
        <tr><td>Geschlecht: </td>" . $gender . "</tr>
        <tr><td>Vorname: </td>" . $firstName . "</tr>
        <tr><td>Nachname: </td>" . $lastName . "</tr>
        <tr><td>Email: </td>" . $email . "</tr>
        <tr><td>Addresse: </td>" . $address . "</tr>
        <tr><td>PLZ: </td>" . $plz . "</tr>
        <tr><td>Stadt: </td>" . $state . "</tr>
        <tr><td>Land: </td>" . $country . "</tr>
        </table>
        
        <p>Vielen Dank das Sie bei uns eingekauft haben!</p>
        
        <p>Mit freundlichen Grüssen</p>
        
        </body>
        </html>";


    $empfaenger = $email;
    $absender   = "ehofmd@gmail.com";
    $betreff    = "Bestätigungsemail - Bestellungen";

    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=utf-8\r\n";

    $header .= "From: $absender\r\n";
    $header .= "X-Mailer: PHP ". phpversion();

    /*

    mail( $empfaenger,
        $betreff,
        $mailtext,
        $header);

*/
    if (!Cart::isEmpty()) {
        $orderID = Product::getOrderID($_SESSION["username"]);
        $query = "UPDATE `orders` SET `open` = '0' WHERE name = '$orderID'";
        DB::doQuery($query);
    }
}


DB::closeConnection();

?>