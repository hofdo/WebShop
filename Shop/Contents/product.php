<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

$url = $_SERVER["REQUEST_URI"];
$productName = explode("/", $url)[4];
$product = Product::getProduct($productName)->fetch_row();
?>

<section>
    <table>
        <div class='product'>
            <div> <?php
                echo '<img src="data:picture/jpeg;base64,' . base64_encode($product[4]) . '"height="120" width="120"/>';
                ?></div>
            <div class='productTitle'><?php echo t($product[1]) ?></div>
            <div class='productPrice'><?php echo $product[3] . " sfr" ?></div>
            <div class='productDescription'><?php echo t($product[1] . 'Description') ?></div>
            <?php
            if ($_SESSION["logged_in"]) {
                printf("<tr><td class='ProductAdd'><button class='buttonAdd' type='submit' onclick='addToShoppingCart(\"%s\")'>" . t("addCart") . "</button></td></tr></table></div>", $product[0]);
            }
            ?>
        </div>
    </table>
</section>

