<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "webshop";

    // Create connection
    $conn = new mysqli($dbhost, $dbhost, $dbpass, $dbpass);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}

?>