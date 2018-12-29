<?php

require_once "../SQLDB/Session.php";
require_once "DB.php";

class Product
{
    private $name;
    private $categories;
    private $description;

    public function __construct($name, $categories, $description)
    {
        $this->name = $name;
        $this->categories = $categories;
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

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public static function getProduct($name)
    {
        $query = "SELECT * FROM products WHERE name='$name'";
        return (DB::doQuery($query));
    }

    public static function getProductByCategories($categories)
    {
        $query = "SELECT * FROM products WHERE categorie ='$categories'";
        return (DB::doQuery($query));
    }

    public static function getAllProducts()
    {
        $query = "SELECT * FROM products";
        return (DB::doQuery($query));
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