<?php

require_once "../SQLDB/Session.php";
require_once "DB.php";

class Product
{
    private $name;
    private $categorie;
    private $description;

    public function __construct($name, $categorie, $description) {
        $this->name = $name;
        $this-> categorie = $categorie;
        $this->description = $description;
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

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    //Methods

    public static function getCategories(){
        $query = "SELECT categorie FROM `categories`";
        return(DB::doQuery($query));
    }

    public static function getProduct($name){
        $query = "SELECT pid, name, value, picture, categorie FROM `products` As p INNER JOIN `categories` AS c ON p.categories_id = c.cid WHERE name = '$name'";
        return(DB::doQuery($query));
    }

    public static function getProducts(){
        $query = "SELECT * FROM products";
        return(DB::doQuery($query));
    }

    public static function getProductList(){
        $query = "SELECT pid, name, value, picture, categorie FROM `products` As p INNER JOIN `categories` AS c ON p.categories_id = c.cid";
        return (DB::doQuery($query));
    }

    public static function checkProductExists($name){
        $query = "Select * FROM `products` WHERE name = $name";
        $result = DB::doQuery($query);
        $count = $result->num_rows;
        if ($count == 1){
            return true;
        }
        else{
            return false;
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
    }

}