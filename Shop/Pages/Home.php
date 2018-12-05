<?php

require "Helper.php";
require_once "../SQLDB/Session.php";
require_once "../Entity/ShoppingCart.php";


// Set language and page ID as global variables.
$language = get_param('lang', 'de');
$pageId = get_param('id', "home");

$user = t("username");
$password = t('password');
$first_name = t("firstName");
$last_name = t("lastName");
$submit = t("submit");
$buy = t("buy");
$cancel = t("cancel");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WebShop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="../"></script>
</head>

<body>

<!--- Header --->

<header>
    <img src="../Pictures/shopping-bag.png" height="60" width="60">
    <h1>Domotec.ch</h1>
</header>

<!-- Navigation  -->

<nav class="navigation">
    <ul>
        <?php
            render_navigation($language, $pageId);
            render_dropDown($language, $pageId)
        ?>
    </ul>
</nav>

<!-- Sidebar  -->

<div class="sideBar">
        <ul>
            <?php
             render_sidebar($pageId);
            ?>
        </ul>
</div>

<!-- Registration  -->

<?php include "../Templates/RegistrationForm.php"?>

<!-- Login  -->

<?php include "../Templates/LoginForm.php"?>

<!-- Shopping Cart  -->

<?php include "../Templates/ShoppingCartList.php"?>

<!-- Content  -->

<div class="content">
    <?php
    if (file_exists("../Contents/$pageId.php")) {
        include "../Contents/$pageId.php";
    }
    else {
        echo "Not yet implemented";
    }
    ?>
</div>
<footer>
    <ul class="footerMenu">
        <?php render_footer($language, $pageId) ?>
    </ul>
</footer>
</body>
</html>