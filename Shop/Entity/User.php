<?php

require_once "../SQLDB/Session.php";

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

    // Getter and Setter

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    //Methods

    public function createUser(){
        $query = "INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `lastname`, `email`) VALUES (NULL, '$this->username', '$this->password', '$this->firstName', '$this->lastName', '$this->email')";
        DB::doQuery($query);
    }

    public static function updateUser($uid, $subject, $toChange){
        try {
            if ($subject == "username" && preg_match("^([A-Za-z0-9\-_.?!]){3,20}^", $toChange)) {
                $query = "UPDATE users SET $subject='$toChange' WHERE users.uid='$uid'";
                DB::doQuery($query);
            } elseif ($subject == "password" && preg_match("^([A-Za-z0-9\-_.?!]){1,30}^", $toChange)) {
                $query = "UPDATE users SET $subject='$toChange' WHERE users.uid='$uid'";
                DB::doQuery($query);
            } elseif ($subject == "email" && preg_match("^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}^", $toChange)) {
                $query = "UPDATE users SET $subject='$toChange' WHERE users.uid='$uid'";
                DB::doQuery($query);
            } elseif ($subject == "firstname" || $subject == "lastname" && preg_match("^[A-Za-z]{1,30}^", $toChange)) {
                $query = "UPDATE users SET $subject='$toChange' WHERE users.uid='$uid'";
                return(DB::doQuery($query));
            }
        }
        catch (Exception $exception){
            echo $exception->getMessage();
        }
    }


    public static function getUser($username){
        $query = "SELECT * FROM users WHERE username='$username'";
        return(DB::doQuery($query));
    }

    public static function deleteUser($username){
        $query = "DELETE FROM users WHERE username='$username'";
        return(DB::doQuery($query));
    }

    public static function renderUserList(){
        $query = "SELECT * From users";
        $counter = 1;
        $result = DB::doQuery($query)->fetch_all();
        echo "<tr><th>Select</th><th>ID</th><th>Username</th><th>Firstname</th><th>Lastname</th><th>Email</th></tr>";
        foreach ($result as $row){
            if ($row[1]!="admin") {
                echo "<tr><td><input type='checkbox' id='adminCheckBox$counter'></td><td>$row[0]</td><td id='editUsername'>$row[1]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
                $counter++;
            }
        }

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
        else{
            return false;
        }
    }

    public static function isLoggedIn(){
        if (!($_SESSION["logged_in"])){
            return false;
        }
        return true;
    }

    public static function isAdmin($username){
        $query = "SELECT isAdmin FROM users WHERE username = '$username' AND isAdmin > 0";
        $result = DB::doQuery($query)->fetch_row();
        if ($result[0]==1){
            return true;
        }
        else{
            return false;
        }
    }


}