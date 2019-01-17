<?php

require_once "Helper.php";
require_once "../autoloader.php";
require_once "../SQLDB/Session.php";
require_once "../Entity/Cart.php";


// Set language and page ID as global variables.
$language = get_param('lang','en');
$pageId = get_param('id',"home");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebShop</title>
    <link rel="stylesheet" type="text/css" href="/shop/pages/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/Shop/js/AdminSection.js" type="text/javascript"></script>
    <script src="/Shop/js/Products.js" type="text/javascript"></script>
    <script src="/Shop/js/Payment.js" type="text/javascript"></script>
    <script src="/Shop/js/Profile.js" type="text/javascript"></script>
</head>

<body>

<!--- Header --->

<header>
    <img src="/shop/Pictures/shopping-bag.png">
    <h1>Colortec.ch</h1>
</header>

<!-- Navigation  -->

<nav class="navigation">
    <ul>
        <?php
            render_leftNav($language, $pageId);
            render_rightNav($language, $pageId)
        ?>
    </ul>
</nav>

<!-- Sidebar  -->
    <div class="sideBar_content">
        <ul>
            <?php
             render_sidebar($pageId);
            ?>
        </ul>
    </div>
<!-- Registration  -->

<?php include "../Templates/RegistrationForm.php" ?>

<!-- Login  -->

<?php include "../Templates/LoginForm.php" ?>

<!-- Shopping Cart  -->

<?php include "../Templates/ShoppingCartList.php" ?>

<!-- Credit Card Information -->
<?php include "../Templates/CreditCartForm.php" ?>
<!-- Content  -->

<div class="content">
    <?php
    if (file_exists("../Contents/$pageId.php")) {
        include "../Contents/$pageId.php";
    }
    else {
        echo "Not yet implemented arara";
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