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
            echo "<button type='button' class='paymentTableBtn' onclick='showPaymentDetails()'>Pay</button>";
        }
        else{
            echo "<label>You cannot pay when the Cart is empty!</label>";
        }
        ?>
    </div>
    <div class="PaymentDetails" id="PaymentDetails">
        <h2>Payment details</h2>
        <table>
            <tr><td><button onclick="closePaymentDetails()">X</button></td></tr>
            <tr><td>Gender:</td><td><select id="paymentDetailsFirstName">
                        <option>Man</option>
                        <option>Women</option>
                    </select></td></tr>
            <tr><td>Firstname:</td><td><input id="paymentDetailsFirstName" type="text" value=""></td></tr>
            <tr><td>lastname:</td><td><input id="paymentDetailsLastName" type="text" value="" ></td></tr>
            <tr><td>Email:</td><td><input id="paymentDetailsEmail" type="email" value="" ></td></tr>
            <tr><td>Address:</td><td><input id="paymentDetailsAddress" type="text" value="" ></td></tr>
            <tr><td>PLZ:</td><td><input id="paymentDetailsPLZ" type="text" value="" ></td></tr>
            <tr><td>City:</td><td><input id="paymentDetailsState" type="text" value="" ></td></tr>
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
        </table>
    </div>
    <div  class="paymentConfirmation" id="paymentConfirmation">
        <h1>Order Confirmation</h1>
        <label>Your order has been successfully confirmed.</label>
        <label>You will shortly receive an email with the details from the order.</label>
        <label>Below are the details of your order:</label>
        <table class="paymentDetailsTable" id="paymentDetailsTable">
            <tr><td>Gender: </td><td id="paymentConfirmationGender"></td></tr>
            <tr><td>Firstname: </td><td id="paymentConfirmationFirstName"></td></tr>
            <tr><td>Lastname: </td><td id="paymentConfirmationLastName"></td></tr>
            <tr><td>Email: </td><td id="paymentConfirmationEmail" ></td></tr>
            <tr><td>Address: </td><td id="paymentConfirmationAddress"></td></tr>
            <tr><td>PLZ: </td><td id="paymentConfirmationPLZ"></td></tr>
            <tr><td>City: </td><td id="paymentConfirmationCity"></td></tr>
            <tr><td>Country: </td><td id="paymentConfirmationCountry"></td></tr>
            <tr><td>Paymentmethod: </td><td id="paymentConfirmationPaymentMethod"></td></tr>
        </table>
    </div>
    <div class="creditCardDetails" id="creditCardDetails">
        <label>Creditcard Details:</label>
        <table>
            <tr><td>Creditcard Holder: </td><td id="paymentConfirmationHolderName"></td></tr>
            <tr><td>Creditcard number: </td><td id="paymentConfirmationNumber"></td></tr>
            <tr><td>Expiry date: </td><td id="paymentConfirmationExpiryDateMonth" ></td><td id="paymentConfirmationExpiryDateYear"></td>
        </table>
    </div>
    <div id="paymentOrder" class="paymentOrder">
        <label>Order details:</label>
        <table class="paymentOrderTable" id="paymentOrderTable">
            <tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr>
        </table>
    </div>
    <a href="../Pages/Home.php" class="paymentHomeLinkBtn" id="paymentHomeLinkBtn"><button>Homepage</button></a>
</div>

