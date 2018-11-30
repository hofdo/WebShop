<?php

require "Helper.php";
require_once "../SQLDB/Session.php";


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
        <?php render_navigation($language, $pageId); ?>

        <div class="searchDropDown">
            <button class="searchbtn"><img src="../Pictures/search.png" height="14" width="14"></button>
            <div class="search-content">
                <input type="text" placeholder="<?php echo t("searchDefault")?>">
            </div>
        </div>

        <div class="languageDropDown">
            <button class="languagebtn"><img src="../Pictures/translation.png" height="14" width="14"></button>
            <div class="language-content">
                <?php render_languages($language, $pageId); ?>
            </div>
        </div>

        <?php
        if ($_SESSION["logged_in"] == true) {
            echo "<div class='profile'>";
            echo "<form action='../Contents/profile.php'>";
            echo "<button class='profileBtn' type='submit'>Profile</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>

    </ul>
</nav>

<!-- Sidebar  -->


<div class="sideBar">
        <ul>
            <?php
            if ($_SESSION["logged_in"] == false) {
                echo "<li>";
                echo "<button id='loginBtn' onclick=document.getElementById('login').style.display='block'>";
                echo t("login");
                echo "</button>";
                echo "</li>";
                echo "<li>";
                echo "<button id='registrationBtn' onclick=document.getElementById('registration').style.display='block'>";
                echo t('registration');
                echo "</button>";
                echo "</li>";
            }
            else if ($_SESSION["logged_in"] == true) {
                echo "<li>";
                echo "<form action='../SQLDB/Logout.php' method='post'>";
                echo "     <button type='submit' value='logout' id='logoutBtn' >";
                echo t("logout");
                echo "</button>";
                echo "</form>";
                echo "</li>";
            }
            ?>
            <li>
                <button id="shoppingCartBtn" onclick="document.getElementById('shoppingCart').style.display='block'">
                    <img src="../Pictures/shopping-cart.png" height="25" width="25">
                    <?php echo t("shoppingCart")?>
                </button>
            </li>
        </ul>
</div>

<!-- Registration  -->


<div id="registration" class="registration_container">
    <form class="registration_Form" action="../SQLDB/Registration.php" method="post">

        <label><b><?php echo $user ?></b></label>
        <input type="text" placeholder="<?php echo $user ?>" name="username" pattern="^([A-Za-z0-9\-_.?!]){3,20}" title="Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20" required>
        <label><b><?php echo $password ?></b></label>
        <input type="password" placeholder=<?php echo $password ?> name="password"  pattern="^([A-Za-z0-9\-_.?!]){0,30}" title="Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 30" required>
        <label><b>E-Mail</b></label>
        <input type="email" placeholder="E-Mail" name="email" pattern="^([A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5})" title="Email-address should only contain letters, numbers and the following characters: {.,!?:;\-_}" required>
        <label><b><?php echo $first_name ?></b></label>
        <input type="text" placeholder="<?php echo $first_name ?>" name="firstName">
        <label><b><?php echo $last_name ?></b></label>
        <input type="text" placeholder="<?php echo $last_name ?>" name="lastName">

        <button type="submit" value="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('registration').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>

<!-- Login  -->


<div id="login" class="login_container">
    <form class="login_Form" action="../SQLDB/Login.php" method="post">
        <label><b><?php echo $user ?></b></label>
        <input type="text" name="username" placeholder=<?php echo $user ?>>
        <label><b><?php echo $password ?></b></label>
        <input type="password" name="password" placeholder=<?php echo $password ?>>

        <button type="submit" value="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>

<!-- Shopping Cart  -->


<div id="shoppingCart" class="shoppingCart_Container">
        <div class="shoppingCart_Content">
            <button type="submit"><?php echo $buy ?></button>
            <button type="button" onclick="document.getElementById('shoppingCart').style.display='none'" class="cancel_Btn">
                <?php echo $cancel ?>
            </button>
        </div>
</div>



<!-- Content  -->

<div class="content">
    <?php
    if (file_exists("../Contents/$pageId.php")) {
        include "../Contents/$pageId.php";
    } else {
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