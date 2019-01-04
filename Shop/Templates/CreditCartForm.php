<?php
require_once "../Entity/Cart.php";
require_once "../Pages/Helper.php";

$submit = t("submit");
$cancel = t("cancel");
?>
<div id="creditCard_container" class="creditCard_container">
    <div id="creditCard_content" class="creditCard_content">
        <label><b>Name</b></label>
        <input type="text" id="creditCardHolderName">
        <label><b>Card Number</b></label>
        <input type="text" id="creditCardNumber">
        <label><b>Card Expiry Date</b></label>
        <input type="text" id="creditCardExpireDate">
        <label><b>CVV</b></label>
        <input type="text" id="creditCardCVV">

        <button type="submit" value="submit" onclick="sendPaymentCreditCard()"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('creditCard_container').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </div>
</div>