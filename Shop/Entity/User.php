<?php

class User
{
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $email;

    public function __construct($username, $password, $firstName, $lastName, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }



    public function createUser(){
        $query = "INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `lastname`, `email`) VALUES (NULL, '$this->username', '$this->password', '$this->firstName', '$this->lastName', '$this->email')";
        return(DB::doQuery($query));
    }

    public function updateUsername($username){
        if (preg_match("^([A-Za-z0-9\-_.?!]){3,20}", $username)){
        }
    }
    public function updatePassword($password){
        if (preg_match("^([A-Za-z0-9\-_.?!]){1,30}", $password)){}
    }
    public function updateEmail($email){
        if (preg_match("^([A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5})", $email)){}
    }
    public function updateFirstName($firstName){

    }
    public function updateLastName($lastName){

    }

    public static function getUser($username){
        $query = "SELECT * FROM users WHERE username='$username'";
        return(DB::doQuery($query));
    }

    public static function deleteUser($username){
        $query = "DELETE FROM users WHERE username='$username'";
        return(DB::doQuery($query));
    }

    public static function checkLogin($username, $password){
        $query = "SELECT * FROM users WHERE username='$username' and password='$password'";
        $result = DB::doQuery($query);
        $count = mysqli_num_rows($result);

        if ($count == 1){
            return true;
        }
        return false;
    }

    public static function checkUserExists($username){
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = DB::doQuery($query);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            return true;
        }
        return false;
    }

    public static function isLoggedIn(){
        if (!($_SESSION["logged_in"])){
            return false;
        }
        return true;
    }


}