<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";
require_once "../Pages/Helper.php";


?>
<div class="orderList">
        <h2>Orders</h2>
        <table class="orderTable">
            <?php
                $orderIDs = Product::getOrderIDs();
                $count = $orderIDs->num_rows;
                if ($count != 0) {
                    foreach ($orderIDs->fetch_all() as $orderID) {
                        $query = "SELECT pid, p.name, quantity, value FROM `shoppingcart` INNER JOIN orders AS o ON o.oid = shoppingcart.order_id INNER JOIN users as u ON u.uid = shoppingcart.user_id INNER JOIN products AS p ON p.pid = shoppingcart.product_id WHERE o.name = '$orderID[0]' AND o.open = false";
                        $result = DB::doQuery($query);
                        echo "<tr><th>OrderID</th><th>" . $orderID[0] . "</th>";
                        foreach ($result->fetch_all() as $product) {
                            echo "<tr><td>ID: " . $product[0] . "</td><td>Name: " . $product[1] . "</td><td>Value: " . $product[3] . "</td><td>Quantity: " . $product[2] . "</td></tr>";
                        }
                    }
                }
                else{
                    echo "<p>No orders mades yet</p>";
                }
            ?>
        </table
</div>
