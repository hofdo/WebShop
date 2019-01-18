<?php
require_once "../Entity/Cart.php";
require_once "../Pages/Helper.php";

$submit = t("submit");
$cancel = t("cancel");

?>
<div id="creditCard_container" class="creditCard_container">
    <div id="creditCard_content" class="creditCard_content">
        <label><b><?php echo t("CCHolder") ?></b></label>
        <input type="text" id="creditCardHolderName">
        <label><b><?php echo t("CCNumber") ?></b></label>
        <input type="text" id="creditCardNumber">
        <label><b><?php echo t("CCDate") ?></b></label>
        <div>
            <select id="creditCardExpireDateMonth">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
            <select id="creditCardExpireDateYear">
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
            </select>
        </div>
        <label><b>CVV</b></label>
        <input type="text" id="creditCardCVV">

        <button type="button" onclick="sendPaymentCreditCard()"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('creditCard_container').style.display='none'"
                class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </div>
</div>