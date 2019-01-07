<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";



?>
<div>
    <div class="cart" id="cart">
        <h2>Shopping Cart</h2>
        <table id='paymentTable' class="paymentTable">
        <tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr>
            <?php
            $totalValue = 0;
            if (Product::checkOrderIsOpen()) {
                $orderID = Product::getOrderID();
                foreach (Cart::getItems()->fetch_all() as $item) {
                    $totalValue += $item[5];
                    echo "<tr><td>$item[1]</td><td>$item[2]</td><td>$item[5]</td><td>$item[4]</td><td>";
                }
            }
            ?>
            <tr><td>Total: </td><td id='totalProductValue'><?php echo $totalValue . ' CHF' ?></td></tr>
            </table>
        <?php
        if (Product::checkOrderIsOpen()) {
            echo "<button type='button' class='paymentTableBtn' onclick='showPaymentDetails()'>".t("pay")."</button>";
        }
        else{
            echo "<label>".t("carEmpty")."</label>";
        }
        ?>
    </div>
    <div class="PaymentDetails" id="PaymentDetails">
        <h2>Payment details</h2>
        <table>
            <tr><td><button onclick="closePaymentDetails()">X</button></td></tr>
            <tr><td><?php echo t("gender")?>:</td><td><select id="paymentDetailsGender">
                        <option><?php echo t("man")?></option>
                        <option><?php echo t("woman")?></option>
                    </select></td></tr>
            <tr><td><?php echo t("firstName")?>:</td><td><input id="paymentDetailsFirstName" type="text" value=""></td></tr>
            <tr><td><?php echo t("lastName")?>:</td><td><input id="paymentDetailsLastName" type="text" value="" ></td></tr>
            <tr><td>Email:</td><td><input id="paymentDetailsEmail" type="email" value="" ></td></tr>
            <tr><td><?php echo t("address")?>:</td><td><input id="paymentDetailsAddress" type="text" value="" ></td></tr>
            <tr><td>PLZ: </td><td><input id="paymentDetailsPLZ" type="text" value="" ></td></tr>
            <tr><td><?php echo t("city")?>:</td><td><input id="paymentDetailsState" type="text" value="" ></td></tr>
            <tr><td><?php echo t("country")?>:</td><td>
                    <select id="paymentDetailsCountry">
                    <option><?php echo t("switzerland") ?></option>
                    <option><?php echo t("germany") ?></option>
                    <option><?php echo t("somalia") ?></option>
                    </select>
                </td>
            </tr><tr><td><?php echo t("paymentMethod")?>:</td><td>
                    <select id="paymentDetailsPaymentMethod">Payment method
                    <option><?php echo t("cash")?></option>
                    <option><?php echo t("bill")?></option>
                    <option><?php echo t("credit")?></option>
                    </select>
                </td>
            </tr>
            <tr><td><button type='submit' id="paymentDetailsBtn" class="paymentDetailsBtn" onclick="sendPayment()">Pay</button></td></tr>
        </table>
    </div>
    <div  class="paymentConfirmation" id="paymentConfirmation">
        <h1><?php echo t("orderConformation")?>:</h1>
        <label><?php echo t("orderOK")?>:</label>
        <table class="paymentDetailsTable" id="paymentDetailsTable">
            <tr><td><?php echo t("gender")?>:</td><td id="paymentConfirmationGender"></td></tr>
            <tr><td><?php echo t("firstName")?>:</td><td id="paymentConfirmationFirstName"></td></tr>
            <tr><td><?php echo t("lastName")?>:</td><td id="paymentConfirmationLastName"></td></tr>
            <tr><td>Email: </td><td id="paymentConfirmationEmail" ></td></tr>
            <tr><td><?php echo t("address")?>:</td><td id="paymentConfirmationAddress"></td></tr>
            <tr><td>PLZ: </td><td id="paymentConfirmationPLZ"></td></tr>
            <tr><td><?php echo t("city")?>: </td><td id="paymentConfirmationCity"></td></tr>
            <tr><td><?php echo t("address")?>country: </td><td id="paymentConfirmationCountry"></td></tr>
            <tr><td><?php echo t("paymentMethod")?>: </td><td id="paymentConfirmationPaymentMethod"></td></tr>
        </table>
    </div>
    <div class="creditCardDetails" id="creditCardDetails">
        <label><?php echo t("CCDetails")?>:</label>
        <table>
            <tr><td><?php echo t("CCHolder")?>: </td><td id="paymentConfirmationHolderName"></td></tr>
            <tr><td><?php echo t("CCNumber")?>: </td><td id="paymentConfirmationNumber"></td></tr>
            <tr><td><?php echo t("CCDate")?>: </td><td id="paymentConfirmationExpiryDateMonth" ></td><td id="paymentConfirmationExpiryDateYear"></td>
        </table>
    </div>
    <div id="paymentOrder" class="paymentOrder">
        <label><?php echo t("orderDetails")?>:</label>
        <table class="paymentOrderTable" id="paymentOrderTable">
            <tr><th><?php echo t("articleId")?></th><th>Name</th><th><?php echo t("value")?></th><th><?php echo t("quantity")?></th></tr>
        </table>
    </div>
    <a href="/Shop/<?php get_param('lang','de') ?>/home" class="paymentHomeLinkBtn" id="paymentHomeLinkBtn"><button>Homepage</button></a>
</div>
