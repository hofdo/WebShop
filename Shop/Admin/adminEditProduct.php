<?php

require_once "../autoloader.php";

$db = DB::getInstance();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_escape_string($db, $_REQUEST['productName']);
    $oldName = mysqli_escape_string($db, $_REQUEST['oldName']);
    $value = mysqli_escape_string($db, $_REQUEST['value']);
    $category = mysqli_escape_string($db, $_REQUEST['category']);
    $pid = mysqli_escape_string($db, $_REQUEST['pid']);


    $resultName = Product::checkProductExists($name);
    if (!($resultName) || $oldName == $name) {
        try {
            if (isset($name)) {
                Product::updateProduct($pid, "name", $name);
            }
            if (isset($value)) {
                Product::updateProduct($pid, "value", $value);
            }
            if (isset($category)) {
                Product::updateProduct($pid, "category", $category);
            }

        } catch (Exception $exception) {

        }
    }
    echo $resultName;
}

DB::closeConnection();

?>