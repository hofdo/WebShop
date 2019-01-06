<?php

require_once "../SQLDB/Session.php";
require_once "User.php";
require_once "DB.php";

class Product
{
    private $name;
    private $value;
    private $category;

    public function __construct($name, $category, $value)
    {
        $this->name = $name;
        $this->category = $category;
        $this->value = $value;
    }

    //Getter and Setter

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getvalue()
    {
        return $this->value;
    }

    public function setvalue($value)
    {
        $this->value = $value;
    }

    //Methods

    public function createProduct()
    {
        $queryCategoryID = "SELECT cid FROM `categories` WHERE category = '$this->category'";
        $categoryID = DB::doQuery($queryCategoryID)->fetch_row();
        $query = "INSERT INTO `products` (`pid`, `name`, `value`, `categories_id`) VALUES (NULL, '$this->name', '$this->value', '$categoryID[0]')";
        DB::doQuery($query);
    }

    public static function updateProduct($pid, $subject, $toChange)
    {
        try {
            if ($subject == "name") {
                $query = "UPDATE products SET $subject='$toChange' WHERE products.pid='$pid'";
                DB::doQuery($query);
            } elseif ($subject == "value") {
                $query = "UPDATE products SET $subject='$toChange' WHERE products.pid='$pid'";
                DB::doQuery($query);
            } elseif ($subject == "category") {
                $queryCategoryID = "SELECT cid FROM `categories` WHERE category = '$toChange'";
                $categoryID = DB::doQuery($queryCategoryID)->fetch_row();
                $query = "UPDATE `products` SET `categories_id` = '$categoryID[0]' WHERE `products`.`pid` = '$pid'";
                DB::doQuery($query);
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public static function deleteProduct($name)
    {
        $query = "DELETE FROM `products` WHERE `products`.`name` = '$name'";
        return (DB::doQuery($query));
    }

    public static function getOrderID(){
        $uid = $_SESSION["uid"];
        $searchStr = "order_" . $uid . "_[0-9]+";
        $query = "SELECT name FROM orders WHERE name REGEXP '$searchStr'";
        $result = DB::doQuery($query);
        $count = $result->num_rows;
        $rows = $result->fetch_all();
        if ($count != 0) {
            $firstRow = $rows[0];
            $num = explode("_", $firstRow[0]);
            foreach ($rows as $row) {
                $temp = explode("_", $row[0]);
                if ($num[2] < $temp[2]) {
                    $firstRow = $row;
                }
            }
            return $firstRow[0];
        } else {
            return 0;
        }
    }

    public static function getOrderIDs(){
        $uid = $_SESSION["uid"];
        $query = "SELECT DISTINCT name FROM `shoppingcart` INNER JOIN orders ON orders.oid = shoppingcart.order_id WHERE user_id = '$uid' AND open = false";
        return DB::doQuery($query);
    }

    public static function getOrderIDsByUsername($username){
        $query = "SELECT DISTINCT name FROM `shoppingcart` INNER JOIN orders ON orders.oid = shoppingcart.order_id INNER JOIN users ON users.uid = shoppingcart.user_id WHERE username = '$username' AND open = false";
        return DB::doQuery($query);
    }


    public static function getCategories(){
        $query = "SELECT category FROM `categories`";
        return (DB::doQuery($query));
    }

    public static function getProductAndCategoryID($name)
    {
        $query = "SELECT pid, name, value, picture, category FROM `products` As p INNER JOIN `categories` AS c ON p.categories_id = c.cid WHERE name = '$name'";
        return (DB::doQuery($query));
    }

    public static function getProduct($name)
    {
        $query = "SELECT * FROM products WHERE name='$name'";
        return (DB::doQuery($query));
    }

    public static function getProductByCategory($category)
    {
        $query = "SELECT pid, name, categories_id, value, picture FROM `products` As p LEFT JOIN `categories` AS c ON p.categories_id = c.cid WHERE category = '$category'";
        return (DB::doQuery($query));
    }

    public static function getAllProducts()
    {
        $query = "SELECT * FROM products";
        return (DB::doQuery($query));
    }

    public static function getProductList(){
        $query = "SELECT pid, name, value, picture, category FROM `products` As p INNER JOIN `categories` AS c ON p.categories_id = c.cid";
        return (DB::doQuery($query));
    }


    public static function generateOrder()
    {
        $username = $_SESSION["username"];
        $uid = User::getUser($username)->fetch_row()[0];

        $orderQuery = "SELECT user_id, product_id, oid, name, username, open FROM `shoppingcart` INNER JOIN users ON users.uid = shoppingcart.user_id INNER JOIN orders ON orders.oid = shoppingcart.order_id WHERE users.username = '$username'";
        $result = DB::doQuery($orderQuery);
        $rowCount = $result->num_rows;

        if ($rowCount == 0) {
            $orderID = "order_" . $uid . "_1";
            if (!self::checkOrderExists($orderID)) {
                $query = "INSERT INTO `orders` (`oid`, `name`, `open`) VALUES (NULL, '$orderID', '1')";
                DB::doQuery($query);
                return $orderID;
            } else {
                return $orderID;
            }

        } elseif ($rowCount == 1) {
            $row = $result->fetch_row();
            $name = $row[3];
            $open = $row[5];
            $num = explode("_", $name);

            if ($open == 1) {
                $orderID = "order_" . $uid . "_" . $num[2];
                return $orderID;
            } else {
                $orderID = "order_" . $uid . "_" . ($num[2] + 1);
                if (!(self::checkOrderExists($orderID))) {
                    $query2 = "INSERT INTO `orders` (`oid`, `name`, `open`) VALUES (NULL, '$orderID', '1')";
                    DB::doQuery($query2);
                    return $orderID;
                } else {
                    return $orderID;
                }
            }

        } elseif ($rowCount > 1) {
            $rows = $result->fetch_all();
            $firstRow = $rows[0];
            $num = explode("_", $firstRow[3]);
            foreach ($rows as $row) {
                $temp = explode("_", $row[3]);
                if ($num[2] < $temp[2]) {
                    $firstRow = $row;
                }
            }
            $open = $firstRow[5];
            $num = explode("_", $firstRow[3]);
            if ($open == 1) {
                $orderID = "order_" . $uid . "_" . $num[2];
                return $orderID;
            } else {
                $orderID = "order_" . $uid . "_" . ($num[2] + 1);
                if (!(self::checkOrderExists($orderID))) {
                    $query3 = "INSERT INTO `orders` (`oid`, `name`, `open`) VALUES (NULL, '$orderID', '1')";
                    DB::doQuery($query3);
                    return $orderID;
                } else {
                    return $orderID;
                }
            }
        }
    }


    public static function checkOrderExists($orderName)
    {
        $query = "SELECT * FROM `orders` WHERE name='$orderName'";
        $result = DB::doQuery($query);
        $count = $result->num_rows;
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }


    public static function checkProductExists($name)
    {
        $query = "Select * FROM `products` WHERE name = '$name'";
        $result = DB::doQuery($query);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkOrderIsOpen(){
        $username = $_SESSION["username"];
        $orderID = self::getOrderID();
        $query = "SELECT open FROM `shoppingcart` INNER JOIN orders ON orders.oid = shoppingcart.order_id INNER JOIN users ON users.uid = shoppingcart.user_id INNER JOIN products ON products.pid = shoppingcart.product_id WHERE orders.name = '$orderID' AND username = '$username' AND open = 1";
        $result = DB::doQuery($query);
        $count = $result->num_rows;
        if ($count == 0){
            return false;
        }
        return true;
    }

    public static function checkCategoryExists($newCategory)
    {
        $categories = self::getCategories();
        foreach ($categories as $category) {
            if ($category == $newCategory) {
                return true;
            }
        }
        return false;
    }

    public static function renderProductList()
    {
        $result = self::getProductList();
        $products = $result->fetch_all();
        $counter = 1;
        echo "<tr><th>Select</th><th>ID</th><th>Name</th><th>Value</th><th>Category</th></tr>";
        foreach ($products as $product) {
            echo "<tr><td><input type='checkbox' id='adminProductCheckBox$counter'></td><td>$product[0]</td><td>$product[1]</td><td>$product[2]</td><td>$product[4]</td></tr>";
            $counter++;
        }
    }

    public static function renderProduct($product)
    {
        $language = get_param('lang', 'de');
        $url = "/shop/" . $language . "/product/" . $product[1];

        echo "<div class='product' id='product$product[0]'><table class='productTable'>";
        echo "<tr><td id='productID$product[0]'>ID:  $product[0] </td></tr>";
        echo '<tr><td><a href=' . $url . '><img src="data:picture/jpeg;base64,' . base64_encode($product[4]) . '"height="120" width="120"/></a></td></tr>';
        echo "<tr><td class='productTitle' id='productTitle_$product[0]'>" . t($product[1]) . "</td></tr>";
        echo "<tr><td class='productPrice' id='productPrice_$product[0]'>$product[3] sfr</td></tr>";
        if ($_SESSION["logged_in"]) {
            printf("<tr><td class='ProductAdd'><button class='buttonAdd' type='submit' onclick='addToShoppingCart(\"%s\")'>" . t("addCart") . "</button></td></tr></table></div>", $product[0]);
        }
    }
}