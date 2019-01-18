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
    <table>
        <tr>
            <td><?php echo t("username") . ":" ?></td>
            <td id="profileUsername"><?php echo $user->getUsername() ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $user->getEmail() ?></td>
        </tr>
        <tr>
            <td><?php echo t("firstName") . ":" ?></td>
            <td><?php echo $user->getFirstName() ?></td>
        </tr>
        <tr>
            <td><?php echo t("lastName") . ":" ?></td>
            <td><?php echo $user->getLastName() ?></td>
        </tr>
        <tr>
            <td>
                <button onclick=showProfileEdit()>Edit profile</button>
            </td>
        </tr>
    </table>
    <div id="profileEdit" class="profileEdit">
        <h2>Edit profile</h2>
        <label id="profileLabel" class="profileLabel"><?php echo t("userExists") ?></label>
        <table>
            <tr>
                <td>
                    <button onclick="closeProfileEdit()">X</button
                </td>
            </tr>
            <tr>
                <td><?php echo t("username") . ":" ?></td>
                <td>
                    <input type="text" name="id" id="profileEditUID"
                           value="<?php echo User::getUser($user->getUsername())->fetch_row()[0] ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><?php echo t("username") . ":" ?></td>
                <td>
                    <input type="text" name="username" id="profileEditUsername"
                           value="<?php echo $user->getUsername() ?>">
                </td>
                <td id="usernameVal" class="profileValLabel"><?php echo t("usernameVal") ?></td>
            </tr>
            <tr>
                <td><?php echo t('password') . ":" ?></td>
                <td>
                    <input type="password" name="password" id="profileEditPassword"
                           value="<?php echo $user->getPassword() ?>">
                </td>
                <td id="passwordVal" class="profileValLabel"><?php echo t("passwordVal") ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input type="email" name="email" id="profileEditEmail" value="<?php echo $user->getEmail() ?>">
                </td>
                <td id="emailVal" class="profileValLabel"><?php echo t("emailVal") ?></td>
            </tr>
            <tr>
                <td><?php echo t("firstName") . ":" ?></td>
                <td><input type="text" name="firstname" id="profileEditFirstName"
                           value="<?php echo $user->getFirstName() ?>"></td>
            </tr>
            <tr>
                <td><?php echo t("lastName") . ":" ?></td>
                <td><input type="text" name="lastname" id="profileEditLastName"
                           value="<?php echo $user->getLastName() ?>"></td>
            </tr>
            <tr>
                <td>
                    <button type='submit' onclick="editProfileUser()">Update</button>
                </td>
            </tr>
        </table
    </div>
</div>
