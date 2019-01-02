<?php
$submit = t("submit");
$buy = t("buy");
$cancel = t("cancel");
?>

<div id="shoppingCart" class="shoppingCart_Container">
    <div class="shoppingCart_Content">
        <div class="Item_Container">
            <?php Cart::render();?>
        </div>
        <button type="submit"><?php echo $buy ?></button>
        <button type="button" onclick="document.getElementById('shoppingCart').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </div>
</div>