function showPaymentDetails() {
    document.getElementById("PaymentDetails").style.display="block";
}
function closeclosePaymentDetails() {
    document.getElementById("PaymentDetails").style.display="none";
    document.getElementById("paymentDetailsFirstName").value = "";
    document.getElementById("paymentDetailsLastName").value = "";
    document.getElementById("paymentDetailsEmail").value = "";
    document.getElementById("paymentDetailsAddress").value = "";
    document.getElementById("paymentDetailsPLZ").value = "";
    document.getElementById("paymentDetailsState").value = "";
}

function refreshShoppingCart() {
    var tableCart = document.getElementById("shoppingCartTable");
    var tablePayment = document.getElementById("paymentTable");
    var tableLenghtCart = (tableCart.rows.length-1);
    for (var i = 1; i < tableLenghtCart; i++){
        tableCart.deleteRow(1);
    }
    var rowCart = tableCart.insertRow(1);
    var cellCart = rowCart.insertCell(0);
    cellCart.innerHTML = "Cart empty";

    var tableLenghtPayment = (tablePayment.rows.length-1);
    for (var j = 1; j < tableLenghtPayment; j++){
        tablePayment.deleteRow(1);
    }
    var rowPayment = tablePayment.insertRow(1);
    var cellPayment = rowPayment.insertCell(0);
    cellPayment.innerHTML = "Cart empty";

    document.getElementById("totalProductValue").innerText = "0";

}

function sendPayment() {
    var firstName = document.getElementById("paymentDetailsFirstName").value;
    var lastName = document.getElementById("paymentDetailsLastName").value;
    var email = document.getElementById("paymentDetailsEmail").value;
    var address = document.getElementById("paymentDetailsAddress").value;
    var plz = document.getElementById("paymentDetailsPLZ").value;
    var state = document.getElementById("paymentDetailsState").value;
    var country = document.getElementById("paymentDetailsCountry").value;
    var paymentMethod = document.getElementById("paymentDetailsPaymentMethod").value;

    var table = document.getElementById("paymentTable");

    if (!isEmpty(firstName)){
        document.getElementById("paymentDetailsFirstName").style.borderColor = "";
        if (!isEmpty(lastName)){
            document.getElementById("paymentDetailsLastName").style.borderColor = "";
            if (!isEmpty(email)){
                document.getElementById("paymentDetailsEmail").style.borderColor = "";
                if (!isEmpty(address)){
                    document.getElementById("paymentDetailsAddress").style.borderColor = "";
                    if (!isEmpty(plz)){
                        document.getElementById("paymentDetailsPLZ").style.borderColor = "";
                        if (!isEmpty(state)){
                            document.getElementById("paymentDetailsState").style.borderColor = "";
                            if (paymentMethod === "Credit Card"){
                                document.getElementById("creditCard_container").style.display = "block";
                            }
                            else{
                                var request = new XMLHttpRequest();
                                request.open("POST", "../Product/finishOrder.php?firstName=" + firstName + "&lastName=" + lastName + "&email=" + email + "&address=" + address
                                    + "&plz=" + plz + "&state=" + state + "&country=" + country + "&paymentMethod=" + paymentMethod);
                                request.onload = function(){
                                    refreshShoppingCart();
                                };
                                request.send();
                            }

                        } else {
                            document.getElementById("paymentDetailsState").style.borderColor = "#ee5253";
                        }
                    } else {
                        document.getElementById("paymentDetailsPLZ").style.borderColor = "#ee5253";
                    }
                } else {
                    document.getElementById("paymentDetailsAddress").style.borderColor = "#ee5253";
                }
            } else {
                document.getElementById("paymentDetailsEmail").style.borderColor = "#ee5253";
            }
        } else {
            document.getElementById("paymentDetailsLastName").style.borderColor = "#ee5253";
        }
    }else {
        document.getElementById("paymentDetailsFirstName").style.borderColor = "#ee5253";
    }
}


function sendPaymentCreditCard() {
    var firstName = document.getElementById("paymentDetailsFirstName").value;
    var lastName = document.getElementById("paymentDetailsLastName").value;
    var email = document.getElementById("paymentDetailsEmail").value;
    var address = document.getElementById("paymentDetailsAddress").value;
    var plz = document.getElementById("paymentDetailsPLZ").value;
    var state = document.getElementById("paymentDetailsState").value;
    var country = document.getElementById("paymentDetailsCountry").value;
    var paymentMethod = document.getElementById("paymentDetailsPaymentMethod").value;

    var creditCardHolderName = document.getElementById("creditCardHolderName").value;
    var creditCardNumber = document.getElementById("creditCardNumber").value;
    var creditCardExpireDate = document.getElementById("creditCardExpireDate").value;
    var creditCardCVV = document.getElementById("creditCardCVV").value;

    var request = new XMLHttpRequest();
    request.open("POST", "../Product/finishOrder.php?firstName=" + firstName + "&lastName=" + lastName + "&email=" + email + "&address=" + address
        + "&plz=" + plz + "&state=" + state + "&country=" + country + "&paymentMethod=" + paymentMethod + "&holderName=" + creditCardHolderName
        + "&cardNumber=" + creditCardNumber + "&expireDate=" + creditCardExpireDate + "&cvv=" + creditCardCVV);
    request.onload = function(){
        refreshShoppingCart()
    };
    request.send();

}

function isEmpty(subject) {
    return subject === "";

}