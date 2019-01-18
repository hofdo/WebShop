<?php

require_once "../autoloader.php";
require_once "../Pages/helper.php";

$db = DB::getInstance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_escape_string($db, $_POST['username']);
    $password = mysqli_escape_string($db, $_POST['password']);


    if (User::checkLogin($username, $password)) {
        $user = User::getUser($username)->fetch_row();
        $_SESSION["uid"] = $user[0];
        $_SESSION["username"] = $user[1];
        $_SESSION["firstname"] = $user[3];
        $_SESSION["lastname"] = $user[4];
        $_SESSION["email"] = $user[5];
        $_SESSION["logged_in"] = true;
    } else {
        echo "<p>" . t("Wrong user/pw") . "</p>";
        echo "<p>" . t("try again") . " <a href='/Shop/Pages/Home.php'>" . t("Home") . "</a></p>";
    }
    header("Location: /shop/" . get_param('lang', 'de') . "/home");

}
DB::closeConnection();
