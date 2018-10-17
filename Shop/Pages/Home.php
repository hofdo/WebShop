<?php
require "Helper.php";

// Set language and page ID as global variables.
$language = get_param('lang', 'de');
$pageId = get_param('id', "home");

$user = t("username");
$password = t('password');
$first_name = t("firsName");
$last_name = t("lastName");
$submit = t("submit");
$cancel = t("cancel");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WebShop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<header>
    <h1><?php echo t("header") ?></h1>
</header>


<nav class="navigation">
    <ul>
        <div class="homeDropDown">
            <button class="homebtn"><img src="../Pictures/home.png" height="14" width="14"></button>
            <div class="home-content">
                <?php render_navigation($language, $pageId); ?>
            </div>
        </div>

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
    </ul>
</nav>

<div class="contentContainter">
    <div class="sideBar">
        <button onclick="document.getElementById('login').style.display='block'"><?php echo t("login")?></button>
        <button onclick="document.getElementById('registration').style.display='block'"><?php echo t("registration")?></button>
    </div>
</div>

<div id="registration" class="registration_container">
    <form class="registration_Form">

        <label><b><?php echo $user ?></b></label>
        <input type="text" placeholder="<?php echo $user ?>">
        <label><b><?php echo $password ?></b></label>
        <input type="password" placeholder=<?php echo $password ?>>
        <label><b>E-Mail</b></label>
        <input type="email">
        <label><b><?php echo $first_name ?></b></label>
        <input type="text" placeholder="<?php echo $first_name ?>">
        <label><b><?php echo $last_name ?></b></label>
        <input type="text" placeholder="<?php echo $last_name ?>">
        <label class="close" onclick="document.getElementById('registration').style.display='none'">X</label>

        <button type="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('registration').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>

<div id="login" class="login_container">
    <form class="login_Form">
        <label><b><?php echo $user ?></b></label>
        <input type="text" placeholder=<?php echo $user ?>>
        <label><b><?php echo $password ?></b></label>
        <input type="password" placeholder=<?php echo $password ?>>
        <label class="close" onclick="document.getElementById('login').style.display='none'">X</label>

        <button type="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>

<?php
if (file_exists("../Contents/$pageId.php")) {
    include "../Contents/$pageId.php";
} else {
    echo "Not yet implemented";
}
?>

<footer>
    <?php echo t("footer") ?>
</footer>

</body>
</html>