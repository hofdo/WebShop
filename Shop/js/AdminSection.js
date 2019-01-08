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
        if(table.rows[i].cells[0].childNodes[0].checked === true){
            var oldUserName = table.rows[i].cells[2].innerHTML;
        }
    }

    if (checkRegex("^([A-Za-z0-9\-_.?!]){3,20}", userName)) {
        if (checkRegex("^([A-Za-z0-9\-_.?!]){1,30}", password)) {
            if (checkRegex("^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}", email)) {
                var request = new XMLHttpRequest();
                request.open("POST", "/Shop/Admin/adminEditUser.php?uid=" + uid + "&username=" + userName + "&oldUsername=" + oldUserName + "&password="
                    + password + "&email=" + email + "&firstname=" + firstName + "&lastname=" + lastName);
                request.onload = function () {
                    var userExists = request.responseText;
                    alert(oldUserName);
                    if (!(userExists) || oldUserName === userName) {
                        var table = document.getElementById("userTable");
                        for (var i = 1; i < (table.rows.length - 1); i++) {
                            if (table.rows[i].cells[0].childNodes[0].checked === true) {
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
            else {
                document.getElementById("adminUserAddLabel").innerText = "Email-address should only contain letters, numbers and the following characters: {.,!?:;-_}";
            }
        }
        else {
            document.getElementById("adminUserAddLabel").innerText = "Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 30";
        }
    }else {
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
                        var request = new XMLHttpRequest();
                        request.open("POST", "/Shop/Admin/adminAddUser.php?username=" + userName + "&password="
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
                            else {
                                document.getElementById("adminUserAddLabel").innerText = "User already exists";

                            }

                        };
                        request.send();
                        document.getElementById("adminUserAddLabel").innerText = "";

                    }
                    else {
                        document.getElementById("adminUserAddLabel").innerText = "Email-address should only contain letters, numbers and the following characters: {.,!?:;-_}";
                    }
                }
                else {
                    document.getElementById("adminUserAddLabel").innerText = "Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 30";
                }
            }else {
                document.getElementById("adminUserAddLabel").innerText = "Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20";
            }

}

function deleteUser() {
    var table = document.getElementById("userTable");
    var counter = 0;
    var rowNumber;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        if(table.rows[i].cells[0].childNodes[0].checked === true){
            counter++;
            rowNumber = i;
            var row = table.rows[i];
        }
    }
    if (counter === 1){
        var username = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("POST", "/Shop/Admin/adminDeleteUser.php?username=" + username);
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
        if(table.rows[i].cells[0].childNodes[0].checked === true){
            counter++;
            var row = table.rows[i];
        }
    }
    if (counter === 1 && document.getElementById('adminAddUser').style.display !== "block"){
        var username = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("GET", "/Shop/Admin/adminGetUser.php?username=" + username);
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

function showEditOrderForm() {

    var table = document.getElementById("userTable");
    var counter = 0;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        if(table.rows[i].cells[0].childNodes[0].checked === true){
            counter++;
            var row = table.rows[i];
        }
    }
    if (counter === 1){
        document.getElementById('adminOrderEdit').style.display='block';
        var orderTable = document.getElementById("adminOrderTable");
        var username = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("GET", "/Shop/Admin/adminGetOrders.php?username=" + username);
        request.onload = function(){
            var data = request.responseText;
            var array = data.split("|");
            if (array[1] !== "0") {
                document.getElementById("adminOrderEditLabel").innerText = "";
                document.getElementById("adminOrderTable").style.display="block";
                for (var i = 1; i < array.length; i++) {
                    var orderID = array[i].split(":")[0];
                    var products = array[i].split(":")[1];
                    var productArray = products.split(";");

                    var totalValue = 0;

                    var titleRow = orderTable.insertRow(-1);
                    var cellOrderIDName = titleRow.insertCell(0);
                    var cellOrderID = titleRow.insertCell(1);

                    cellOrderIDName.innerHTML = "OrderID: ";
                    cellOrderID.innerHTML = orderID;

                    for (var j = 0; j < (productArray.length-1); j++) {
                        var pid = productArray[j].split(",")[0];
                        var name = productArray[j].split(",")[1];
                        var value = productArray[j].split(",")[2];
                        var quantity = productArray[j].split(",")[3];

                        totalValue += (parseInt(value) * parseInt(quantity));

                        var row = orderTable.insertRow(-1);
                        var cellPID = row.insertCell(0);
                        var cellProductName = row.insertCell(1);
                        var cellProductValue = row.insertCell(2);
                        var cellProductQuantity = row.insertCell(3);

                        cellPID.innerHTML = pid;
                        cellProductName.innerHTML = name;
                        cellProductValue.innerHTML = value;
                        cellProductQuantity.innerHTML = quantity;
                    }
                    var rowTotal = orderTable.insertRow(-1);
                    var cellTotalValueName = rowTotal.insertCell(0);
                    var cellTotalValue = rowTotal.insertCell(1);

                    cellTotalValueName.innerHTML = "Total: ";
                    cellTotalValue.innerHTML = totalValue.toString();
                }
            }
            else{
                document.getElementById("adminOrderEditLabel").innerText = array[0];
            }

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

function closeEditOrderForm() {
    document.getElementById('adminOrderEdit').style.display='none';
    var orderTable = document.getElementById("adminOrderTable");
    var lenght = orderTable.rows.length;

    for (var i = 1; i < lenght; i++) {
        orderTable.deleteRow(1);
        alert(lenght);
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
    var productName = document.getElementById("adminSectionProductName").value;
    var value = document.getElementById("adminSectionValue").value;
    var category = document.getElementById("adminSectionCategory").value;

    var table = document.getElementById("productListTable");
    for (var i = 1; i < (table.rows.length-1) ; i++) {
        if (table.rows[i].cells[0].childNodes[0].checked === true) {
            var oldName = table.rows[i].cells[2].innerHTML;
        }
    }

    var request = new XMLHttpRequest();
    request.open("POST", "/Shop/Admin/adminAddProduct.php?productName=" + productName + "&value="
        + value + "&category=" + category);
    request.onload = function () {
        var response = request.responseText.split(";");
        var pid = response[0];
        var productExists= response[1];


        if (!productExists) {
            var table = document.getElementById("productListTable");
            var row = table.insertRow(table.rows.length - 1);
            var checkboxCell = row.insertCell(0);
            var pidCell = row.insertCell(1);
            var productNameCell = row.insertCell(2);
            var valueCell = row.insertCell(3);
            var categoryCell = row.insertCell(4);

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.id = "adminProductCheckBox" + (table.rows.length - 2);
            checkboxCell.appendChild(checkbox);

            pidCell.innerHTML = pid;
            productNameCell.innerHTML = productName;
            valueCell.innerHTML = value;
            categoryCell.innerHTML = category;
        }
        else{
            document.getElementById("adminProductAddLabel").innerText = "User already exists";

        }

    };
    request.send();
    document.getElementById("adminProductAddLabel").innerText = ""
}

function editProduct() {
    var pid = document.getElementById("adminSectionProductID").value;
    var productName = document.getElementById("adminSectionProductName").value;
    var value = document.getElementById("adminSectionValue").value;
    var category = document.getElementById("adminSectionCategory").value;

    var table = document.getElementById("productListTable");
    for (var i = 1; i < (table.rows.length-1) ; i++){
        var idName = "adminProductCheckBox"+i;
        if(document.getElementById(idName).checked === true){
            var oldName = table.rows[i].cells[2].innerHTML;
        }
    }
    var request = new XMLHttpRequest();
    request.open("POST", "/Shop/Admin/adminEditProduct.php?pid=" + pid + "&productName=" + productName + "&value="
        + value + "&category=" + category + "&oldName=" + oldName);
    request.onload = function () {
        var productExists = request.responseText;

        if (!(productExists) || oldName === productName) {
                var table = document.getElementById("productListTable");
                for (var i = 1; i < (table.rows.length - 1); i++) {
                    var idName = "adminProductCheckBox" + i;
                    if (document.getElementById(idName).checked === true) {
                        table.rows[i].cells[2].innerHTML = productName;
                        table.rows[i].cells[3].innerHTML = value;
                        table.rows[i].cells[4].innerHTML = category;
                    }
                }
            }
        else{
            document.getElementById("adminProductAddLabel").innerText = "Product already exists";
        }
    };
    request.send();

}

function showAddProductForm() {
    document.getElementById('productEdit').style.display='block';
    document.getElementById("adminChangeProduct").style.display="none";


    if (document.getElementById('adminChangeProduct').style.display !== "block") {
        document.getElementById('adminAddProduct').style.display='block';

    }
    else{
        document.getElementById("adminProductAddLabel").innerText = "Cannot add while editing a product";
    }

}

function deleteProduct() {
    var table = document.getElementById("productListTable");
    var counter = 0;
    var rowNumber;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        if(table.rows[i].cells[0].childNodes[0].checked === true){
            counter++;
            rowNumber = i;
            var row = table.rows[i];
        }
    }
    if (counter === 1){
        var productName = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("POST", "/Shop/Admin/adminDeleteProduct.php?name=" + productName);
        request.onload = function(){
            table.deleteRow(rowNumber);
        };
        request.send();
        document.getElementById("adminProductAddLabel").innerText = "";
    }
    else if (counter > 1){
        document.getElementById("adminProductAddLabel").innerText = "Please Select only one user";
    }
    else{
        document.getElementById("adminProductAddLabel").innerText = "Please select one user";
    }
}

function showEditProductForm() {
    var table = document.getElementById("productListTable");
    var counter = 0;
    for (var i = 1; i < (table.rows.length-1) ; i++){
        if(table.rows[i].cells[0].childNodes[0].checked === true){
            counter++;
            var row = table.rows[i];
        }
    }
    if (counter === 1 && document.getElementById('adminAddProduct').style.display !== "block"){
        var productName = row.cells[2].innerHTML;
        var request = new XMLHttpRequest();
        request.open("GET", "/Shop/Admin/adminGetProduct.php?name=" + productName);
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
            document.getElementById("adminProductAddLabel").innerText = "Cannot edit while adding a product";
        }
    }
    else if (counter > 1){
        document.getElementById("adminProductAddLabel").innerText = "Please Select only one product";
    }
    else if (document.getElementById('adminAddProduct').style.display === "block"){
        document.getElementById("adminProductAddLabel").innerText = "Please close the add product interface first!";
    }
    else{
        document.getElementById("adminProductAddLabel").innerText = "Please select one product";
    }
}

function adminSearchProduct() {
    
}

/*
Common methods
 */

function closeUserEdit() {
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

function closeProductEdit() {

    document.getElementById('productEdit').style.display='none';
    document.getElementById("adminProductAddLabel").innerText = "";
    document.getElementById('adminAddProduct').style.display='none';
    document.getElementById('adminChangeProduct').style.display='none';

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


