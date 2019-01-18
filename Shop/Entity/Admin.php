<?php

class Admin extends User
{
    private $username;
    private $password;
    private $isAdmin;

    public function __construct($password)
    {
        $this->username = "Admin";
        $this->password = $password;
        $this->isAdmin = true;
    }
}