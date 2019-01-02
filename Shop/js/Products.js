function addToShoppingCart() {

    var productName = document.getElementById("productTitle").innerHTML;
    var productValue = document.getElementById("productPrice").innerHTML.split(" ")[0];
    var pid = document.getElementById("productID").innerHTML.split(":")[1].replace(/\s+/g, '');
    var request = new XMLHttpRequest();
    request.open("POST", "../Product/addToShoppingCart.php?productName=" + productName + "&productValue="
        + productValue + "&pid=" + pid);
    request.send();
}