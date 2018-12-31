<?php
require_once "../SQLDB/Session.php";
require_once "../Entity/Product.php";
require_once "../Entity/DB.php";
$product = product::getProduct($_GET['product'])->fetch_all();
$product = $product[0];
?>

<section>
    <table>
        <?php
            Product::renderProduct($product);
        ?>
    </table>
</section>