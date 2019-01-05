<?php
require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

$product = product::getProduct($_GET['product'])->fetch_all();
?>

<section>
    <table>
        <div class='product'>
            <div> <?php
                echo '<img src="data:picture/jpeg;base64,' . base64_encode($product[4]) . '"height="120" width="120"/>';
                ?></div>
            <div class='productTitle'><?php echo $product[1] ?></div>
            <div class='productPrice'><?php echo $product[3] . " sfr" ?></div>
            <div class='productDescription'><?php echo $product[1] ?></div>
            <?php
            if ($_SESSION["logged_in"]) {
                printf("<tr><td class='ProductAdd'><button class='buttonAdd' type='submit' onclick='addToShoppingCart(\"%s\")'>" . t("addCart") . "</button></td></tr></table></div>", $product[0]);
            }
            ?>
        </div>
    </table>
</section>

