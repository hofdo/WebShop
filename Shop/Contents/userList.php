<?php
require_once "../SQLDB/Session.php";
require_once "../Entity/User.php";
require_once "../Entity/DB.php";
require_once "../Pages/Helper.php";


?>

<h1>Admin</h1>
<h2>Studentlist</h2>

<script>
    function changeUser() {
        var table = document.getElementById("userTable");
        var counter = 0;
        for (var i = 1; i < (table.rows.length-1) ; i++){
            var idName = "adminCheckBox"+i;
            if(document.getElementById(idName).checked = true){
                counter++;
                var row = table.rows[i];
            }
        }
        if (counter === 1){

        }
        else if (counter < 1){

        }
        else{

        }
        document.getElementById('userEdit').style.display='block';

    }
</script>

<div class="userList">
    <table id="userTable">
        <form>
        <?php
            User::renderUserList();
        ?>
        </form>
        <tr><td><button onclick="changeUser()">Change User</button></td><td><button>Delete User</button></td><td><button>Add User</button></td></tr>
    </table>
    <div id="userEdit" class="userEdit">
        <form method="post" action="../SQLDB/UpdateUserAdmin.php">
            <h2>Edit user</h2>
            <table>
                <tr><td>Username:</td><td><input type="text" name="username" value="<?php  ?>" pattern="^([A-Za-z0-9\-_.?!]){3,20}" title="Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20\" required></td></tr>
                <tr><td>Password:</td><td><input type="password" name="password" value="<?php  ?>" pattern="^([A-Za-z0-9\-_.?!]){1,30}" title="Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20"  required></td></tr>
                <tr><td>Email:</td><td><input type="email" name="email" value="<?php  ?>" pattern="^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}" title="Email-address should only contain letters, numbers and the following characters: {.,!?:;\-_}" required></td></tr>
                <tr><td>Firstname:</td><td><input type="text" name="firstname" value="<?php  ?>" ></td></tr>
                <tr><td>Lastname:</td><td><input type="text" name="lastname" value="<?php  ?>"></td></tr>
                <tr><td><button type='submit'>Update</button></td></tr>
            </table
        </form>
    </div>

</div>
