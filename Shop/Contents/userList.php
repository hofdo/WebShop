<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";
require_once "../Pages/Helper.php";


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<h1>Admin</h1>
<h2>Userlist</h2>

<div class="userList">
    <input type="search" placeholder="Search..." onkeyup="adminSearchUser()" id="adminSearch" class="adminSearch">
    <table id="userTable">
        <?php
        User::renderUserList();
        ?>
        <tr>
            <td>
                <button onclick="showEditUserForm()">Change User</button>
            </td>
            <td>
                <button onclick="deleteUser()">Delete User</button>
            </td>
            <td>
                <button onclick="showAddUserForm()">Add User</button>
            <td>
                <button onclick="showEditOrderForm()">Orders</button>
            </td>
        </tr>
    </table>
    <label id="adminUserAddLabel"></label>
    <div id="userEdit" class="userEdit">
        <h2>Edit user</h2>
        <table>
            <tr>
                <td>
                    <button onclick="closeUserEdit()">X</button>
                </td>
            </tr>
            <tr>
                <td>ID:</td>
                <td><input id="adminSectionID" class="adminSectionID" name="ID" readonly></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input id="adminSectionUsername" type="text" value=""></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input id="adminSectionPassword" type="password" value=""></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input id="adminSectionEmail" type="email" value=""></td>
            </tr>
            <tr>
                <td>Firstname:</td>
                <td><input id="adminSectionFirstName" type="text" value=""></td>
            </tr>
            <tr>
                <td>Lastname:</td>
                <td><input id="adminSectionLastName" type="text" value=""></td>
            </tr>
            <tr>
                <td>
                    <button type='submit' id="adminChangeUser" class="adminChangeUser" onclick="editUser()">Edit User
                    </button>
                </td>
                <td>
                    <button type='submit' id="adminAddUser" class="adminAddUser" onclick="addUser()">Add user</button>
                </td>
            </tr>
        </table
    </div>
</div>
<div id="adminOrderEdit" class="adminOrderEdit">
    <h2>Orders</h2>
    <table class="adminOrderTable" id="adminOrderTable">
        <tr>
            <td>
                <button onclick="closeEditOrderForm()">X</button>
            </td>
        </tr>
        <tr>
            <th>Order</th>
        </tr>
    </table>
    <label id="adminOrderEditLabel"></label>
</div>

