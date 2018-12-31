function addToShoppingCart() {
    var request = new XMLHttpRequest();
    request.open("POST", "../Product/addToShoppingCart.php");
    request.onload = function () {
        var response = request.responseText;
    };
    request.send();
}