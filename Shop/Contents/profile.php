<?php
    require_once "../SQLDB/Session.php";

    echo $_SESSION["logged_in"];
    echo "<br>";
    echo $_SESSION["username"];
    echo "<br>";
    echo $_SESSION["firstname"];
    echo "<br>";
    echo $_SESSION["lastname"];
?>
