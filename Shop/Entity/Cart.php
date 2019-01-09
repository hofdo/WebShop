<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

class Cart {
    public static function addItem($num, $pid) {
        $username = $_SESSION["username"];
        $uid = User::getUser($username)->fetch_row()[0];
        $orderID = Product::generateOrder();

        $queryOrderID = "SELECT oid FROM `orders` WHERE name='$orderID'";
        $oid = DB::doQuery($queryOrderID)->fetch_row()[0];
        $queryProduct = "SELECT name, username, quantity, open FROM `shoppingcart` INNER JOIN users ON users.uid = shoppingcart.user_id INNER JOIN orders ON orders.oid = shoppingcart.order_id WHERE users.username = '$username' AND orders.name = '$orderID' AND product_id='$pid'";
        $product = DB::doQuery($queryProduct);
        $count = $product->num_rows;

        if ($count >= 1){
            $queryQuantity = "SELECT quantity FROM `shoppingcart` INNER JOIN orders ON orders.oid = shoppingcart.order_id WHERE name = '$orderID' AND product_id = '$pid'";
            $quantityOld = DB::doQuery($queryQuantity)->fetch_row()[0];
            $quantity = $num + $quantityOld;
            $query = "UPDATE `shoppingcart` SET `quantity` = '$quantity' WHERE `shoppingcart`.`user_id` = '$uid' AND `shoppingcart`.`product_id` = '$pid'";
            DB::doQuery($query);
        }
        else {
            $query = "INSERT INTO `shoppingcart` (`user_id`, `product_id`, `quantity`, `order_id`) VALUES ('$uid', '$pid', '$num', '$oid')";
            DB::doQuery($query);
        }
    }
    public static function removeItem($sid) {
        if(!self::isEmpty()){
            $query = "DELETE FROM `shoppingcart` WHERE `shoppingcart`.`sid` = '$sid'";
            DB::doQuery($query);
        }
    }

    public static function changeQuantity($sid, $num){
        $query = "UPDATE `shoppingcart` SET `quantity` = '$num' WHERE `shoppingcart`.`sid` = '$sid'";
        DB::doQuery($query);
    }

    public static function getItemsByOrderID($orderID){
        $query = "SELECT pid, p.name, value, quantity FROM `shoppingcart` INNER JOIN orders AS o ON o.oid = shoppingcart.order_id INNER JOIN products as p ON p.pid = shoppingcart.product_id WHERE o.name = '$orderID[0]' AND open = false";
        return DB::doQuery($query);
    }

    public static function getItems() {
        $username = $_SESSION["username"];
        $orderID = Product::getOrderID();
        $query = "SELECT sid, pid, p.name, o.name, quantity, value FROM `shoppingcart` INNER JOIN `users` ON shoppingcart.user_id = users.uid INNER JOIN `products` AS p ON shoppingcart.product_id = p.pid INNER JOIN `orders` AS o ON shoppingcart.order_id = o.oid WHERE username = '$username' AND o.name = '$orderID'";
        return(DB::doQuery($query));
    }

    public static function isEmpty() {
        $orderID = Product::getOrderID();
        $query = "SELECT * FROM `shoppingcart` INNER JOIN orders ON orders.oid = shoppingcart.order_id WHERE name = '$orderID'";
        $result = DB::doQuery($query);
        $count = $result->num_rows;

        if ($count == 0){
            return true;
        }
        else{
            return false;
        }
    }

    public static function render() {
        $totalValue = 0;
        if (self::isEmpty() || !Product::checkOrderIsOpen()) {
            echo "<div class=\"cart empty\"><table id='shoppingCartTable'><tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr><tr><td>Total: </td><td id='totalProductValue'>$totalValue</td></tr></table><div id='cartIsEmpty'>" . t("cart_empty") . "</div></div>";
        } else {
            echo "<div class=\"cart\"><table id='shoppingCartTable' class='shoppingCartTable' align='center'>";
            echo "<tr><th>Article-Id</th><th>Name</th><th>Value</th><th>Quantity</th></tr>";
            foreach (self::getItems()->fetch_all() as $item) {
                $totalValue += ($item[5] * $item[4]);
                printf("<tr><td>$item[1]</td><td>$item[2]</td><td>$item[5]</td><td><input type='text' onkeypress='changeShoppingCartQuantity(\"%s\", \"%s\")' value='$item[4] '></td><td><button onclick='deleteFromShoppingCart(\"%s\", \"%s\")'>X</button></td></tr>",  $item[0], $item[1], $item[0], $item[1]);
            }
            echo "<tr><td>Total: </td><td id='totalProductValue'>$totalValue</td></tr>";
            echo "</table></div>";
        }

    }

}