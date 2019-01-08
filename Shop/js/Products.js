function addToShoppingCart(pid) {
    var productTitle = "productTitle_" + pid;
    var productPrice = "productPrice_" + pid;
    var productName = document.getElementById(productTitle).innerHTML;
    var productValue = document.getElementById(productPrice).innerHTML.split(" ")[0];
    var request = new XMLHttpRequest();
    request.open("POST", "/Shop/Product/addToShoppingCart.php?pid=" + pid + "&productValue="
        + productValue + "&productName=" + productName);
    request.onload = function(){
        var response = request.responseText;
        var quantity = response.split("_")[0];
        var sid = response.split("_")[1];
        var isEmpty = response.split("_")[2];
        var counter = 0;
        var table = document.getElementById("shoppingCartTable");

        var totalProductValue = document.getElementById("totalProductValue");
        var totalValue = parseInt(totalProductValue.innerText);
        totalValue += parseInt(productValue);

        for (var i = 1; i < (table.rows.length-1); i++){
            if(table.rows[i].cells[0].innerHTML === pid){
                counter++;
                var row = table.rows[i];
            }
        }
        if (isEmpty === "1"){
            document.getElementById("cartIsEmpty").style.display = "none";
        }
        if (counter === 0) {
            var rowNew = table.insertRow((table.rows.length - 1));
            var cellArticleID = rowNew.insertCell(0);
            var cellArticleName = rowNew.insertCell(1);
            var cellArticleValue = rowNew.insertCell(2);
            var cellArticleQuantity = rowNew.insertCell(3);
            var cellArticleDelButton = rowNew.insertCell(4);

            var input = document.createElement("input");
            input.type = "text";
            input.onkeyup = function() {
              changeShoppingCartQuantity(sid, pid);
            };
            input.value = quantity;

            var button = document.createElement("button");
            button.innerText = "X";
            button.onclick = function () {
                deleteFromShoppingCart(sid, pid)
            };
            cellArticleDelButton.appendChild(button);
            cellArticleQuantity.appendChild(input);
            cellArticleID.innerHTML = pid;
            cellArticleName.innerHTML = productName;
            cellArticleValue.innerHTML = productValue;
        }
        else{
            var oldQuantity = parseInt(row.cells[3].childNodes[0].value);
            oldQuantity += 1;
            row.cells[3].childNodes[0].value = oldQuantity;
        }

        totalProductValue.innerText = totalValue.toString();


    };
    request.send();
}

function deleteFromShoppingCart(sid, pid) {
    var table = document.getElementById("shoppingCartTable");
    for (var i = 1; i < (table.rows.length-1); i++){
        if(table.rows[i].cells[0].innerHTML === pid){
            table.deleteRow(i);
        }
    }
    var request = new XMLHttpRequest();
    request.open("POST", "/Shop/Product/deleteFromShoppingCart.php?sid=" + sid);
    request.onload = function(){

    };
    request.send();

}

function changeShoppingCartQuantity(sid, pid) {
    document.getElementById("quantityLabel").style.display = "none";
    var table = document.getElementById("shoppingCartTable");
    for (var i = 1; i < (table.rows.length-1); i++){
        if(table.rows[i].cells[0].innerHTML === pid){
            var quantity = table.rows[i].cells[3].childNodes[0].value;
        }
    }
    alert(quantity);
    var reg = new RegExp("^[0-9]+^");
    if (reg.test(quantity)) {
        var request = new XMLHttpRequest();
        request.open("POST", "/Shop/Product/changeShoppingCartQuantity.php?sid=" + sid + "&quantity=" + quantity);
        request.send();
    }
    else{
        document.getElementById("quantityLabel").style.display = "block";
    }

}