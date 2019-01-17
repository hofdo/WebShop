<?php
require_once "../Pages/Helper.php";

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$email = $_REQUEST["email"];
$lang = $_REQUEST["lang"];

$usernameTrans = t("usernameVal");
$passwordTrans = t("passwordVal");
$emailTrans = t("emailVal");

echo $str = "";

if (preg_match("^([A-Za-z0-9\-_.?!]){3,20}^", $username)){
    if (preg_match("^([A-Za-z0-9\-_.?!]){1,30}^", $password)){
        if (preg_match("^([A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5})^", $email)){
        }else{
            $str .= $emailTrans . ";" . "3";
        }
    }else{
        $str .= $passwordTrans . ";" . "2";
    }
}else{
    $str .= $usernameTrans . ";" . "1";
}
if ($str != "") {
    echo $str;
}
else{
    echo "" . ";" . "0";
}