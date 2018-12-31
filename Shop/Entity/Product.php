<?php

require_once "../SQLDB/Session.php";
require_once "DB.php";

class Product
{
    private $name;
    private $value;
    private $category;

    public function __construct($name, $category, $value) {
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

    public function createProduct(){
        $queryCategoryID = "SELECT cid FROM `categories` WHERE category = '$this->category'";
        $categoryID = DB::doQuery($queryCategoryID)->fetch_row();
        $query = "INSERT INTO `products` (`pid`, `name`, `value`, `categories_id`) VALUES (NULL, '$this->name', '$this->value', '$categoryID[0]')";
        DB::doQuery($query);
    }

    public static function updateProduct($pid, $subject, $toChange){
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
        }
        catch (Exception $exception){
            echo $exception->getMessage();
        }
    }

    public static function deleteProduct($name){
        $query = "DELETE FROM `products` WHERE `products`.`name` = '$name'";
        return(DB::doQuery($query));
    }

    public static function getCategories(){
        $query = "SELECT category FROM `categories`";
        return(DB::doQuery($query));
    }

    public static function getProduct($name){
        $query = "SELECT pid, name, value, picture, category FROM `products` As p INNER JOIN `categories` AS c ON p.categories_id = c.cid WHERE name = '$name'";
        return(DB::doQuery($query));
    }

    public static function getProductByCategories($categories_id)
    {
        $query = "SELECT * FROM products WHERE categories_id ='$categories_id'";
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

    public static function checkProductExists($name){
        $query = "Select * FROM `products` WHERE name = '$name'";
        $result = DB::doQuery($query);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public static function checkCategoryExists($newCategory){
        $categories = self::getCategories();
        foreach ($categories as $category){
            if ($category == $newCategory){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public static function renderProductList(){
        $result = self::getProductList();
        $products = $result->fetch_all();
        $counter = 1;
        echo "<tr><th>Select</th><th>ID</th><th>Name</th><th>Value</th><th>Category</th></tr>";
        foreach ($products as $product){
            echo "<tr><td><input type='checkbox' id='adminProductCheckBox$counter'></td><td>$product[0]</td><td>$product[1]</td><td>$product[2]</td><td>$product[4]</td></tr>";
            $counter++;
        }
    public static function renderProduct($product)
    {
        $language = get_param('lang', 'de');
        $url = $_SERVER['PHP_SELF'];
        add_param($url, "lang", $language);
        add_param($url, "id", 'product');
        add_param($url, "product", $product[1]);

        echo    "<div class='product'>";
        echo    '<a href='.$url.'><img src="data:picture/jpeg;base64,' .base64_encode( $product[4] ).'"height="120" width="120"/></a>';
        echo    "<div class='productTitle'>".t($product[1])."</div>";
        echo    "<div class='productPrice'>$product[3] sfr</div>";
        echo    "<div class='ProductAdd'><button class='buttonAdd' type='submit'>".t("addCart")."</button></div></div>";
    }

}