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

    public static function getProduct($name){
        $query = "SELECT * FROM products WHERE name='$name'";
        return(DB::doQuery($query));
    }

    public static function getProducts(){
        $query = "SELECT * FROM products";
        return(DB::doQuery($query));
    }

    public static function renderProductList(){
        $result = self::getProducts();
        $products = $result->fetch_all();
        foreach ($products as $product){
            echo "<tr><td>$product[0]</td><td>$product[1]</td><td>$product[2]</td><td>$product[3]</td></tr>";
        }
    }



}