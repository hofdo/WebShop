<?php
require_once "../SQLDB/Session.php";
require_once "../Entity/User.php";
require_once "../Entity/DB.php";

$username = $_SESSION["username"];
$email = $_SESSION["email"];
$firstName = $_SESSION["firstname"];
$lastName = $_SESSION["lastname"];
$user = new User($username, mysqli_fetch_row(User::getUser($username))[2], $firstName, $lastName, $email);
?>
<h1>Profile</h1>

<div class="profileView">
    <table>
        <tr><td>Username:</td><td><?php echo $user->getUsername() ?></td></tr>
        <tr><td>Email:</td><td><?php echo $user->getEmail() ?></td></tr>
        <tr><td>Firstname:</td><td><?php echo $user->getFirstName() ?></td></tr>
        <tr><td>Lastname:</td><td><?php echo $user->getLastName() ?></td></tr>
        <tr><td><button onclick=document.getElementById('profileEdit').style.display='block'>Edit profile</button></td></tr>
        </table>
    <div id="profileEdit" class="profileEdit">
        <form method="post" action="../SQLDB/UpdateUserProfile.php">
            <h2>Edit profile</h2>
            <table>
                <tr><td>Profile Picture to upload:</td><td><input type="file" name="image"/></td></tr>
                <tr><td>Username:</td><td><input type="text" name="username" value="<?php echo $user->getUsername() ?>" pattern="^([A-Za-z0-9\-_.?!]){3,20}" title="Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20\" required></td></tr>
                <tr><td>Password:</td><td><input type="password" name="password" value="<?php echo $user->getPassword() ?>" pattern="^([A-Za-z0-9\-_.?!]){1,30}" title="Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20"  required></td></tr>
                <tr><td>Email:</td><td><input type="email" name="email" value="<?php echo $user->getEmail() ?>" pattern="^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}" title="Email-address should only contain letters, numbers and the following characters: {.,!?:;\-_}" required></td></tr>
                <tr><td>Firstname:</td><td><input type="text" name="firstname" value="<?php echo $user->getFirstName() ?>" ></td></tr>
                <tr><td>Lastname:</td><td><input type="text" name="lastname" value="<?php echo $user->getLastName() ?>"></td></tr>
                <tr><td><button type='submit'>Update</button></td></tr>
            </table
        </form>
    </div>
</div>
