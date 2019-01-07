<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 07.01.2019
 * Time: 18:14
 */


$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$email = $_REQUEST["email"];

echo $str;

if (preg_match("^([A-Za-z0-9\-_.?!]){3,20}", $username)){
    $str .= t("usernameVal") . ";";
    if (preg_match("^([A-Za-z0-9\-_.?!]){1,30}", $password)){
        $str .= t("passwordVal") . ";";
        if (preg_match("^([A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5})", $email)){
            $str .= t("emailVal") . ";";
        }
    }
}
echo $str;


?>