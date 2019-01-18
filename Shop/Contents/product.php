<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

$product = product::getProduct($_GET['q'])->fetch_all();
$product = $product[0];
?>

<section>
    <table>
        <tr>
            <td>
                <?php
                echo "<img src=$product[4] height=120 width=120>";
                ?></td>
        </tr>
        <tr class="productID">
            <td <?php echo "id='productID$product[0]'" ?> ><?php echo t($product[0]) ?> </td>
        </tr>
        <tr class='productTitle'>
            <td <?php echo "id='productTitle_$product[0]'" ?> ><?php echo t($product[1]) ?></td>
        </tr>
        <tr class='productPrice'>
            <td <?php echo "id='productPrice_$product[0]'" ?> ><?php echo $product[3] . " sfr" ?></td>
        </tr>
        <tr class='productDescription'>
            <td><?php echo t($product[1] . "_Description") ?></td>
        </tr>
        <?php
        if ($_SESSION["logged_in"]) {
            printf("<tr><td class='ProductAdd'><button class='buttonAdd' type='submit' onclick='addToShoppingCart(\"%s\")'>" . t("addCart") . "</button></td></tr>", $product[0]);
        }
        ?>
    </table>
</section>
