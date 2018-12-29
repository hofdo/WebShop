<?php
require_once "../SQLDB/Session.php";
require_once "../Entity/Product.php";
require_once "../Entity/DB.php";
$product = product::getProduct($_GET['product'])->fetch_all();
$product = $product[0];
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
            <div class='ProductAdd'>
                <button class='buttonAdd' type='submit'><?php echo t("addCart") ?></button>
            </div>
        </div>
    </table>
</section>