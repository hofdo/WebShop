<?php
require "Helper.php";

// Set language and page ID as global variables.
$language = get_param('lang', 'de');
$pageId = get_param('id', "home");
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>WebShop</title>
        <link rel="stylesheet" type="text/css" href="layout.css">
    </head>

<body>
    <header>
        <h1><?php echo t("header") ?></h1>
    </header>

    <nav>
        <span>Navigation</span>
        <?php render_navigation($language, $pageId); ?>
        <div>
            <?php render_languages($language, $pageId); ?>
        </div>
    </nav>

<?php
if (file_exists("../Contents/$pageId.php")) {
    include "../Contents/$pageId.php";
} else {
    echo "Not yet implemented";
}
?>

    <footer>
<?php echo t("footer")?>
</footer>

</body>
</html>