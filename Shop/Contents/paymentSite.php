<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";



?>

<div class=\"cart\">
    <h2>Shopping Cart</h2>
    <table id='paymentTable' class="paymentTable">
    <tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr>
        <?php
        $totalValue = 0;
        foreach (Cart::getItems()->fetch_all() as $item) {
        $totalValue += $item[5];
        echo "<tr><td>$item[1]</td><td>$item[2]</td><td>$item[5]</td><td>$item[4]</td><td>";
        }
        ?>
        <tr><td>Total: </td><td id='totalProductValue'><?php echo $totalValue . ' CHF' ?></td></tr>
        </table>
    <button type="button" class="paymentTableBtn" onclick="showPaymentDetails()">Pay</button>
</div>
<div class="PaymentDetails" id="PaymentDetails">
    <h2>Payment details</h2>
    <table>
        <tr><td><button onclick="closePaymentDetails()">X</button></td></tr>
        <tr><td>Firstname:</td><td><input id="paymentDetailsFirstName" type="text" value=""></td></tr>
        <tr><td>lastname:</td><td><input id="paymentDetailsLastName" type="text" value="" ></td></tr>
        <tr><td>Email:</td><td><input id="paymentDetailsEmail" type="email" value="" ></td></tr>
        <tr><td>Address:</td><td><input id="paymentDetailsAddress" type="text" value="" ></td></tr>
        <tr><td>PLZ:</td><td><input id="paymentDetailsPLZ" type="text" value="" ></td></tr>
        <tr><td>State:</td><td><input id="paymentDetailsState" type="text" value="" ></td></tr>
        <tr><td>Country:</td><td>
                <select id="paymentDetailsCountry">
                <option>Switzerland</option>
                <option>Germany</option>
                <option>Somalia</option>
                </select>
            </td>
        </tr><tr><td>Payment method:</td><td>
                <select id="paymentDetailsPaymentMethod">Payment method
                <option>Cash</option>
                <option>Bill</option>
                <option>Credit Card</option>
                </select>
            </td>
        </tr>
        <tr><td><button type='submit' id="paymentDetailsBtn" class="paymentDetailsBtn" onclick="sendPayment()">Pay</button></td></tr>
    </table

</div>


