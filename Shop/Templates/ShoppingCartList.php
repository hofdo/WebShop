<?php
require_once "../Entity/Cart.php";
require_once "../Pages/Helper.php";

$submit = t("submit");
$cancel = t("cancel");
?>

<div id="shoppingCart" class="shoppingCart_Container">
    <div class="shoppingCart_Content">
        <div class="Item_Container">
            <?php Cart::render();?>
        </div>
            <?php proceedPaymentSite($language) ?>
        <button type="button" onclick="document.getElementById('shoppingCart').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </div>
</div>