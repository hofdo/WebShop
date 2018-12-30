/*
Userlist
 */

function editUser() {
    var uid = document.getElementById("adminSectionID").value;
    var userName = document.getElementById("adminSectionUsername").value;
    var password = document.getElementById("adminSectionPassword").value;
    var email = document.getElementById("adminSectionEmail").value;
    var firstName = document.getElementById("adminSectionFirstName").value;
    var lastName = document.getElementById("adminSectionLastName").value;

    var table = document.getElementById("userTable");
    for (var i = 1; i < (table.rows.length-1) ; i++){
        var idName = "adminCheckBox"+i;
        if(document.getElementById(idName).checked === true){
            var oldUserName = table.rows[i].cells[2].innerHTML;
        }
    }

    if (checkRegex("^([A-Za-z0-9\-_.?!]){3,20}", userName)) {
        if (checkRegex("^([A-Za-z0-9\-_.?!]){1,30}", password)) {
            if (checkRegex("^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}", email)) {
                var request = new XMLHttpRequest();
                request.open("POST", "../Admin/adminEditUser.php?uid=" + uid + "&username=" + userName + "&oldUsername=" + oldUserName + "&password="
                    + password + "&email=" + email + "&firstname=" + firstName + "&lastname=" + lastName);
                request.onload = function () {
                    var userExists = request.responseText;
                    alert(oldUserName);
                    if (!(userExists) || oldUserName === userName) {
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
                    request.open("POST", "../Admin/adminAddUser.php?username=" + userName + "&password="
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
        request.open("POST", "../Admin/adminDeleteUser.php?username=" + username);
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
    if (counter === 1 && document.getElementById('adminAddUser').style.display !== "block"){
        var username = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("GET", "../Admin/adminGetUser.php?username=" + username);
        request.onload = function(){
            var data = request.responseText;
            var array = data.split(";");
            document.getElementById("adminSectionID").value = array[0];
            document.getElementById("adminSectionUsername").value = array[1];
            document.getElementById("adminSectionPassword").value = array[2];
            document.getElementById("adminSectionEmail").value = array[5];
            document.getElementById("adminSectionFirstName").value = array[3];
            document.getElementById("adminSectionLastName").value = array[4];
        };
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
    else if (document.getElementById('adminAddUser').style.display === "block"){
        document.getElementById("adminUserAddLabel").innerText = "Please close the add user interface first!";
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

function adminSearchUser() {
    var input = document.getElementById("adminSearch");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("userTable");
    var tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length-1; i++) {
        var td = tr[i].getElementsByTagName("td")[2];
        if (td){
            if (td.textContent.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display="";
            }
            else {
                tr[i].style.display="none";
            }
        }
    }
}

/*
Productlist
 */


function addProduct() {

}

function editProduct() {
    var pid = document.getElementById("adminSectionProductID").value;
    var productName = document.getElementById("adminSectionProductName").value;
    var value = document.getElementById("adminSectionValue").value;
    var category = document.getElementById("adminSectionCategory").value;

    var table = document.getElementById("productTable");
    for (var i = 1; i < (table.rows.length-1) ; i++){
        var idName = "adminProductCheckBox"+i;
        if(document.getElementById(idName).checked === true){
            var oldName = table.rows[i].cells[2].innerHTML;
        }
    }
                var request = new XMLHttpRequest();
                request.open("POST", "../Admin/adminEditProduct.php?pid=" + pid + "&productName=" + productName + "&value="
                    + value + "&category=" + category + "&oldName=" + oldName);
                request.onload = function () {
                    var result = request.responseText.split(";");
                    var productExists = result[0];
                    var categoryExists = result[1];

                    if (!(productExists) || oldName === productName) {
                        if (!(categoryExists)) {
                            var table = document.getElementById("productTable");
                            for (var i = 1; i < (table.rows.length - 1); i++) {
                                var idName = "adminProductCheckBox" + i;
                                if (document.getElementById(idName).checked === true) {
                                    table.rows[i].cells[2].innerHTML = productName;
                                    table.rows[i].cells[3].innerHTML = value;
                                    table.rows[i].cells[4].innerHTML = category;

                                }
                            }
                        }
                        else {
                            document.getElementById("adminProductAddLabel").innerText = "Category already exists";
                        }
                    }
                    else{
                        document.getElementById("adminProductAddLabel").innerText = "Product already exists";
                    }
                };
                request.send();
}

function showAddProductForm() {

}

function deleteProduct() {

}

function showEditProductForm() {
    var table = document.getElementById("productTable");
    var counter = 0;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        var idName = "adminProductCheckBox"+i;
        if(document.getElementById(idName).checked === true){
            counter++;
            var row = table.rows[i];
        }
    }
    if (counter === 1 && document.getElementById('adminAddProduct').style.display !== "block"){
        var productName = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("GET", "../Admin/adminGetProduct.php?name=" + productName);
        request.onload = function(){
            var data = request.responseText;
            var array = data.split(";");
            document.getElementById("adminSectionProductID").value = array[0];
            document.getElementById("adminSectionProductName").value = array[1];
            document.getElementById("adminSectionValue").value = array[2];

            var category = array[3];

            var categories = document.getElementById("adminSectionCategory");

            for (var i = 0; i < categories.length; i++){
                if (categories[i].innerHTML === category){
                    categories[i].selected = true;
                }
            }
        };
        request.send();

        document.getElementById("adminProductAddLabel").innerText = "";
        document.getElementById('productEdit').style.display='block';

        if (document.getElementById('adminAddProduct').style.display !== "block") {
            document.getElementById('adminChangeProduct').style.display = 'block';
        }
        else{
            document.getElementById("adminProductAddLabel").innerText = "Cannot edit while adding a user";
        }
    }
    else if (counter > 1){
        document.getElementById("adminProductAddLabel").innerText = "Please Select only one user";
    }
    else if (document.getElementById('adminAddProduct').style.display === "block"){
        document.getElementById("adminProductAddLabel").innerText = "Please close the add user interface first!";
    }
    else{
        document.getElementById("adminProductAddLabel").innerText = "Please select one user";
    }
}

function adminSearchProduct() {
    
}

/*
Common methods
 */

function closeEdit() {
    document.getElementById('userEdit').style.display='none';
    document.getElementById("adminUserAddLabel").innerText = "";
    document.getElementById('adminAddUser').style.display='none';
    document.getElementById('adminChangeUser').style.display='none';


    document.getElementById('productEdit').style.display='none';
    document.getElementById("adminProductAddLabel").innerText = "";
    document.getElementById('adminAddProduct').style.display='none';
    document.getElementById('adminChangeProduct').style.display='none';


    document.getElementById("adminSectionID").value="";
    document.getElementById("adminSectionUsername").value="";
    document.getElementById("adminSectionPassword").value="";
    document.getElementById("adminSectionEmail").value="";
    document.getElementById("adminSectionFirstName").value="";
    document.getElementById("adminSectionLastName").value="";

    document.getElementById("adminSectionProductID").value="";
    document.getElementById("adminSectionProductName").value="";
    document.getElementById("adminSectionValue").value="";
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


