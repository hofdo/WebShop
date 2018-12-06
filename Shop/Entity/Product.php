<?php

include "DB.php";

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



}