function validateRegistration() {
var username = document.getElementById("registrationUsername");
var password = document.getElementById("registrationPassword");
var email = document.getElementById("registrationEmail");

    var request = new XMLHttpRequest();
    request.open("POST", "/Shop/Validation/getValidationTranslation?username=" + username + "&password=" + password + "&email=" + email);
    request.onload = function () {
        var data = request.responseText;

    };
    request.send();
}