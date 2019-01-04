<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";



?>

<div class=\"cart\">
    <h2>Shopping Cart</h2>
    <table id='shoppingCartTable'>
    <tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr>
        <?php
        $totalValue = 0;
        foreach (Cart::getItems()->fetch_all() as $item) {
        $totalValue += $item[5];
        echo "<tr><td>$item[1]</td><td>$item[2]</td><td>$item[5]</td><td>$item[4]</td><td>";
        }
        ?>
        <tr><td>Total: </td><td id='totalProductValue'><?php echo $totalValue ?></td></tr>
        </table>
    <button type="button" onclick="showPaymentDetails()">Pay</button>
</div>
<div class="PaymentDetails" id="PaymentDetails">
    <label>First name</label>
    <input type="text">
    <label>Last name</label>
    <input type="text">
    <label>Email</label>
    <input type="email">
    <label>Payment Method</label>
    <input type="">
    <label>Address</label>
    <input>

</div>


