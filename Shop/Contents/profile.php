<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";

$username = $_SESSION["username"];
$email = $_SESSION["email"];
$firstName = $_SESSION["firstname"];
$lastName = $_SESSION["lastname"];
$user = new User($username, mysqli_fetch_row(User::getUser($username))[2], $firstName, $lastName, $email);
?>
<h1>Profile</h1>

<div class="profileView">
    <table id="profileTable">
        <tr><td>Username:</td><td id="profileUsername"><?php echo $user->getUsername() ?></td></tr>
        <tr><td>Email:</td><td id="profileEmail"><?php echo $user->getEmail() ?></td></tr>
        <tr><td>Firstname:</td><td id="profileFirstName"><?php echo $user->getFirstName() ?></td></tr>
        <tr><td>Lastname:</td><td id="profileLastName"><?php echo $user->getLastName() ?></td></tr>
        <tr><td><button onclick="showProfileEdit()">Edit profile</button></td></tr>
        </table>
    <label id="profileLabel"></label>
    <div id="profileEdit" class="profileEdit">
            <h2>Edit profile</h2>
            <table id="profileEditTable">
                <tr><td><button onclick="closeProfileEdit()">X</button></td></tr>
                <tr><td>Username:</td><td><input type="text" id="profileEditUID" readonly></td></tr>
                <tr><td>Username:</td><td><input type="text" id="profileEditUsername"></td></tr>
                <tr><td>Password:</td><td><input type="password" id="profileEditPassword"></td></tr>
                <tr><td>Email:</td><td><input type="email" id="profileEditEmail"></td></tr>
                <tr><td>Firstname:</td><td><input type="text" id="profileEditFirstName"></td></tr>
                <tr><td>Lastname:</td><td><input type="text" id="profileEditLastName"></td></tr>
                <tr><td><button type='submit' onclick="editProfileUser()">Update</button></td></tr>
            </table
    </div>
</div>
