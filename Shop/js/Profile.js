/*
    Profile User
 */
function editProfileUser() {
    var uid = document.getElementById("profileEditUID").value;
    var userName = document.getElementById("profileEditUsername").value;
    var oldUserName = document.getElementById("profileUsername").innerText;
    var password = document.getElementById("profileEditPassword").value;
    var email = document.getElementById("profileEditEmail").value;
    var firstName = document.getElementById("profileEditFirstName").value;
    var lastName = document.getElementById("profileEditLastName").value;

    var vals = document.getElementsByClassName("profileValLabel");
    for (var i = 0; i < vals.length; i++){
        vals.item(i).style.display="none";
    }

    if (checkRegex("^([A-Za-z0-9\-_.?!]){3,20}", userName)) {
        if (checkRegex("^([A-Za-z0-9\-_.?!]){1,30}", password)) {
            if (checkRegex("^[A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5}", email)) {
                var request = new XMLHttpRequest();
                request.open("POST", "/Shop/Profile/profileEditUser.php?uid=" + uid + "&username=" + userName + "&oldUsername=" + oldUserName + "&password="
                    + password + "&email=" + email + "&firstname=" + firstName + "&lastname=" + lastName);
                request.onload = function () {
                    var userExists = request.responseText;
                    if (!(userExists) || oldUserName === userName) {
                                document.getElementById("profileUsername").innerText = userName;
                                document.getElementById("profileEmail").innerText = email;
                                document.getElementById("profileFirstName").innerText = firstName;
                                document.getElementById("profileLastName").innerText = lastName;
                    }
                    else{
                    }
                };
                request.send();

            }
            else{
                document.getElementById("emailVal").style.display = "block";
            }
        }else{
            document.getElementById("passwordVal").style.display = "block";
        }
    }
    else{
        document.getElementById("usernameVal").style.display = "block";
    }
}

function showProfileEdit() {
    document.getElementById("profileEdit").style.display = "block";
    var username = document.getElementById("profileUsername").innerText;
    var request = new XMLHttpRequest();
    request.open("GET", "/Shop/Admin/adminGetUser.php?username=" + username);
    request.onload = function(){
        var data = request.responseText;
        var array = data.split(";");
        document.getElementById("profileEditUID").value = array[0];
        document.getElementById("profileEditUsername").value = array[1];
        document.getElementById("profileEditPassword").value = array[2];
        document.getElementById("profileEditEmail").value = array[5];
        document.getElementById("profileEditFirstName").value = array[3];
        document.getElementById("profileEditLastName").value = array[4];
    };
    request.send();
}

function f() {
    
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


