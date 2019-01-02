function addToShoppingCart(pid) {
    var productTitle = "productTitle_" + pid;
    var productPrice = "productPrice_" + pid;
    var productName = document.getElementById(productTitle).innerHTML;
    var productValue = document.getElementById(productPrice).innerHTML.split(" ")[0];
    var request = new XMLHttpRequest();
    request.open("POST", "../Product/addToShoppingCart.php?pid=" + pid + "&productValue="
        + productValue + "&productName=" + productName);
    request.onload = function(){
        var response = request.responseText;
    };
    request.send();
}