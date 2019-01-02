<?php

require_once "Product.php";
require_once "DB.php";

class Cart {
    public static function addItem($item, $num) {
        $username = $_SESSION["username"];
        $uid = User::getUser($username)->fetch_row()[0];
        $pid = $item[0];
        $orderID = Product::generateOrder();

        $queryOrderID = "SELECT oid FROM `orders` WHERE name='$orderID'";
        $oid = DB::doQuery($queryOrderID)->fetch_row();

       $query = "INSERT INTO `shoppingcart` (`user_id`, `product_id`, `quantity`, `order_id`) VALUES ('$uid', '$pid', '$num', '$oid')";
        DB::doQuery($query);
    }
    public function removeItem($item, $num) {

    }
    public function getItems() {
        $query = "SELECT sid, name, value, quantity FROM `shoppingcart` INNER JOIN `users` ON shoppingcart.user_id = users.uid INNER JOIN `products` ON shoppingcart.product_id = products.pid";
        return(DB::doQuery());

    }
    public function isEmpty() {

    }
    public function render() {

        /*
        if ($this->isEmpty()) {
            echo "<div class=\"cart empty\">The Cart is empty</div>";
        } else {
            echo "<div class=\"cart\"><table>";
            echo "<tr><th>Article-Id</th><th>#</th></tr>";
            foreach ($this->getItems()->fetch_all() as $item) {
                echo "<tr><td>$item[1]</td><td>$item[3]</td></tr>";
            }
            echo "</table></div>";
        }

        */
    }

}