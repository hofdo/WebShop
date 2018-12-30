<?php

require "../Entity/DB.php";
require "../Entity/Product.php";



        $db = DB::getInstance();
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = mysqli_escape_string($db, $_REQUEST['productName']);
            $value = mysqli_escape_string($db, $_REQUEST['value']);
            $category = mysqli_escape_string($db, $_REQUEST['category']);
            $pid = mysqli_escape_string($db, $_REQUEST['pid']);

            $result = Product::checkProductExists($name);

            if (!$result) {

                try {
                    if (isset($name)) {
                    }
                    if (isset($value)) {
                    }
                    if (isset($category)) {
                    }
                    if (isset($pid)) {
                    }

                } catch (Exception $exception) {

                }
            }
            echo $result;
        }

    DB::closeConnection();

?>