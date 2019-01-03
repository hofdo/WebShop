<?php

require_once "../Pages/helper.php";

session_start();

$_SESSION = array();

session_destroy();

header("location: /Shop/".get_param('lang','de')."/home");

?>