function showEditUserForm() {
    var table = document.getElementById("userTable");
    var counter = 0;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        var idName = "adminCheckBox"+i;
        if(document.getElementById(idName).checked === true){
            counter++;
            var row = table.rows[i];
        }
    }
    if (counter === 1){
        var username = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("GET", "../SQLDB/adminGetUser.php?username=" + username);
        request.onload = function(){
            var data = request.responseText;
            var array = data.split(";");
            document.getElementById("adminSectionID").value = array[0];
            document.getElementById("adminSectionUsername").value = array[1];
            document.getElementById("adminSectionPassword").value = array[2];
            document.getElementById("adminSectionEmail").value = array[5];
            document.getElementById("adminSectionFirstName").value = array[3];
            document.getElementById("adminSectionLastName").value = array[4];
        }
        request.send();

        document.getElementById("adminUserAddLabel").innerText = "";
        document.getElementById('userEdit').style.display='block';

        if (document.getElementById('adminAddUser').style.display !== "block") {
            document.getElementById('adminChangeUser').style.display = 'block';
        }
        else{
            document.getElementById("adminUserAddLabel").innerText = "Cannot edit while adding a user";
        }
    }
    else if (counter > 1){
        document.getElementById("adminUserAddLabel").innerText = "Please Select only one user";
    }
    else{
        document.getElementById("adminUserAddLabel").innerText = "Please select one user";
    }

}

function showAddUserForm() {
    document.getElementById('userEdit').style.display='block';

    if (document.getElementById('adminChangeUser').style.display !== "block") {
        document.getElementById('adminAddUser').style.display='block';

    }
    else{
        document.getElementById("adminUserAddLabel").innerText = "Cannot add while editing a user";
    }

}

function closeEdit() {
    document.getElementById('userEdit').style.display='none';
    document.getElementById("adminUserAddLabel").innerText = "";
    document.getElementById('adminAddUser').style.display='none';
    document.getElementById('adminChangeUser').style.display='none';

    document.getElementById("adminSectionID").value="";
    document.getElementById("adminSectionUsername").value="";
    document.getElementById("adminSectionPassword").value="";
    document.getElementById("adminSectionEmail").value="";
    document.getElementById("adminSectionFirstName").value="";
    document.getElementById("adminSectionLastName").value="";
}

function editUser() {
    var uid = document.getElementById("adminSectionID").value;
    var userName = document.getElementById("adminSectionUsername").value;
    var password = document.getElementById("adminSectionPassword").value;
    var email = document.getElementById("adminSectionEmail").value;
    var firstName = document.getElementById("adminSectionFirstName").value;
    var lastName = document.getElementById("adminSectionLastName").value;

    if (checkRegex("^([A-Za-z0-9\-_.?!]){3,20}", userName)) {
        if (checkRegex("^([A-Za-z0-9\-_.?!]){1,30}", password)) {
            if (checkRegex("^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}", email)) {
                var request = new XMLHttpRequest();
                request.open("POST", "../SQLDB/adminEditUser.php?uid=" + uid + "&username=" + userName + "&password="
                    + password + "&email=" + email + "&firstname=" + firstName + "&lastname=" + lastName);
                request.onload = function () {
                    var userExists = request.responseText;
                    if (!userExists) {
                        alert(userExists);
                        var table = document.getElementById("userTable");
                        for (var i = 1; i < (table.rows.length - 1); i++) {
                            var idName = "adminCheckBox" + i;
                            if (document.getElementById(idName).checked === true) {
                                table.rows[i].cells[2].innerHTML = userName;
                                table.rows[i].cells[3].innerHTML = firstName;
                                table.rows[i].cells[4].innerHTML = lastName;
                                table.rows[i].cells[5].innerHTML = email;
                            }
                        }
                    }
                    else{
                        document.getElementById("adminUserAddLabel").innerText = "User already exists";
                    }
                };
                request.send();
                document.getElementById("adminUserAddLabel").innerText = "";

            }
            else{
                document.getElementById("adminUserAddLabel").innerText = "Email-address should only contain letters, numbers and the following characters: {.,!?:;-_}";
            }
        }
        else{
            document.getElementById("adminUserAddLabel").innerText = "Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20";
        }
    }
    else{
        document.getElementById("adminUserAddLabel").innerText = "Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20";
    }
}

function addUser() {
    var userName = document.getElementById("adminSectionUsername").value;
    var password = document.getElementById("adminSectionPassword").value;
    var email = document.getElementById("adminSectionEmail").value;
    var firstName = document.getElementById("adminSectionFirstName").value;
    var lastName = document.getElementById("adminSectionLastName").value;




    if (checkRegex("^([A-Za-z0-9\-_.?!]){3,20}", userName)) {
        if (checkRegex("^([A-Za-z0-9\-_.?!]){1,30}", password)) {
            if (checkRegex("^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}", email)) {
                if (firstName !== "" && lastName !== "") {
                    var request = new XMLHttpRequest();
                    request.open("POST", "../SQLDB/adminAddUser.php?username=" + userName + "&password="
                        + password + "&email=" + email + "&firstname=" + firstName + "&lastname=" + lastName);
                    request.onload = function () {

                        var response = request.responseText.split(";");
                        var uid = response[0];
                        var userExists = response[1];

                        if (!userExists) {

                            var table = document.getElementById("userTable");
                            var row = table.insertRow(table.rows.length - 1);
                            var checkboxCell = row.insertCell(0);
                            var uidCell = row.insertCell(1);
                            var usernameCell = row.insertCell(2);
                            var firstnameCell = row.insertCell(3);
                            var lastNameCell = row.insertCell(4);
                            var emailCell = row.insertCell(5);

                            var checkbox = document.createElement("input");
                            checkbox.type = "checkbox";
                            checkbox.id = "adminCheckBox" + (table.rows.length - 2);
                            checkboxCell.appendChild(checkbox);

                            uidCell.innerHTML = uid;
                            usernameCell.innerHTML = userName;
                            firstnameCell.innerHTML = firstName;
                            lastNameCell.innerHTML = lastName;
                            emailCell.innerHTML = email;
                        }
                        else{
                            document.getElementById("adminUserAddLabel").innerText = "User already exists";

                        }

                    };
                    request.send();
                    document.getElementById("adminUserAddLabel").innerText = "";

                }
                else {
                    document.getElementById("adminUserAddLabel").innerText = "Firstname or Lastname cannot be empty";
                }
            }
            else{
                document.getElementById("adminUserAddLabel").innerText = "Email-address should only contain letters, numbers and the following characters: {.,!?:;-_}";
            }
        }
        else{
            document.getElementById("adminUserAddLabel").innerText = "Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20";
        }
    }
    else{
        document.getElementById("adminUserAddLabel").innerText = "Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20";
    }


}

function deleteUser() {
    var table = document.getElementById("userTable");
    var counter = 0;
    var rowNumber;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        var idName = "adminCheckBox"+i;
        if(document.getElementById(idName).checked === true){
            counter++;
            rowNumber = i;
            var row = table.rows[i];
        }
    }
    if (counter === 1){
        var username = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("POST", "../SQLDB/adminDeleteUser.php?username=" + username);
        request.onload = function(){
            table.deleteRow(rowNumber);
        };
        request.send();
        document.getElementById("adminUserAddLabel").innerText = "";
    }
    else if (counter > 1){
        document.getElementById("adminUserAddLabel").innerText = "Please Select only one user";
    }
    else{
        document.getElementById("adminUserAddLabel").innerText = "Please select one user";
    }
}


function checkRegex(regex, object) {
    if (object !== "") {
        var regex = new RegExp(regex);
        return regex.test(object);
    }
    else{
        return false
    }
}


