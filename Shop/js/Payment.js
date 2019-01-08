function showPaymentDetails() {
    document.getElementById("PaymentDetails").style.display="block";
}
function closePaymentDetails() {
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
    var tableLenghtCart = (tableCart.rows.length-1);
    for (var i = 1; i < tableLenghtCart; i++){
        tableCart.deleteRow(1);
    }
    var rowCart = tableCart.insertRow(1);


    document.getElementById("totalProductValue").innerText = "0";

}

function renderOrderList() {

    var paymentTable = document.getElementById("paymentTable");
    var orderTable = document.getElementById("paymentOrderTable");
    for (var  i = 1; i < (paymentTable.rows.length-1); i++){
        var rowNew = orderTable.insertRow(-1);
        var cellArticleID = rowNew.insertCell(0);
        var cellArticleName = rowNew.insertCell(1);
        var cellArticleValue = rowNew.insertCell(2);
        var cellArticleQuantity = rowNew.insertCell(3);

        cellArticleID.innerHTML = paymentTable.rows[i].cells[0].innerHTML;
        cellArticleName.innerHTML = paymentTable.rows[i].cells[1].innerHTML;
        cellArticleValue.innerHTML = paymentTable.rows[i].cells[2].innerHTML;
        cellArticleQuantity.innerHTML = paymentTable.rows[i].cells[3].innerHTML;
    }



}

function sendPayment() {
    var gender = document.getElementById("paymentDetailsGender").value;
    var firstName = document.getElementById("paymentDetailsFirstName").value;
    var lastName = document.getElementById("paymentDetailsLastName").value;
    var email = document.getElementById("paymentDetailsEmail").value;
    var address = document.getElementById("paymentDetailsAddress").value;
    var plz = document.getElementById("paymentDetailsPLZ").value;
    var state = document.getElementById("paymentDetailsState").value;
    var country = document.getElementById("paymentDetailsCountry").value;
    var paymentMethod = document.getElementById("paymentDetailsPaymentMethod").value;

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
                            if (paymentMethod === "Credit card" || paymentMethod === "Kreditkarte"){
                                document.getElementById("creditCard_container").style.display = "block";
                            }
                            else{
                                var request = new XMLHttpRequest();
                                request.open("POST", "/Shop/Product/finishOrder.php?firstName=" + firstName + "&lastName=" + lastName + "&gender=" + gender + "&email=" + email + "&address=" + address
                                    + "&plz=" + plz + "&state=" + state + "&country=" + country + "&paymentMethod=" + paymentMethod);
                                request.onload = function(){

                                    document.getElementById("cart").style.display = "none";
                                    document.getElementById("PaymentDetails").style.display = "none";
                                    document.getElementById("paymentConfirmation").style.display = "block";
                                    document.getElementById("paymentOrder").style.display = "block";
                                    document.getElementById("paymentHomeLinkBtn").style.display = "block";
                                    renderOrderList();
                                    refreshShoppingCart();
                                    document.getElementById("paymentConfirmationGender").innerText = gender;
                                    document.getElementById("paymentConfirmationFirstName").innerText = firstName;
                                    document.getElementById("paymentConfirmationLastName").innerText = lastName;
                                    document.getElementById("paymentConfirmationEmail").innerText = email;
                                    document.getElementById("paymentConfirmationAddress").innerText = address;
                                    document.getElementById("paymentConfirmationPLZ").innerText = plz;
                                    document.getElementById("paymentConfirmationCity").innerText = state;
                                    document.getElementById("paymentConfirmationCountry").innerText = country;
                                    document.getElementById("paymentConfirmationPaymentMethod").innerText = paymentMethod;

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
    var gender = document.getElementById("paymentDetailsGender").value;
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
    var creditCardExpireDateMonth = document.getElementById("creditCardExpireDateMonth").value;
    var creditCardExpireDateYear = document.getElementById("creditCardExpireDateYear").value;
    var creditCardCVV = document.getElementById("creditCardCVV").value;

    var request = new XMLHttpRequest();
    request.open("POST", "/Shop/Product/finishOrder.php?firstName=" + firstName + "&lastName=" + lastName + "&gender=" + gender + "&email=" + email + "&address=" + address
        + "&plz=" + plz + "&state=" + state + "&country=" + country + "&paymentMethod=" + paymentMethod + "&holderName=" + creditCardHolderName
        + "&cardNumber=" + creditCardNumber + "&expireDateMonth=" + creditCardExpireDateMonth + "&expireDateYear=" + creditCardExpireDateYear + "&cvv=" + creditCardCVV);
    request.onload = function(){
        if (!isEmpty(document.getElementById("creditCardHolderName").value)) {
            document.getElementById("creditCardHolderName").style.borderColor = "";
            if (!isEmpty(document.getElementById("creditCardNumber").value && checkRegex("^(?:4[0-9]{12}(?:[0-9]{3})? | (?:5[1-5][0-9]{2} | 222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12} | 3[47][0-9]{13} | 3(?:0[0-5]|[68][0-9])[0-9]{11} | 6(?:011|5[0-9]{2})[0-9]{12} | (?:2131|1800|35\d{3})\d{11})$", creditCardNumber))) {
                document.getElementById("creditCardNumber").style.borderColor = "";
                if (!isEmpty(document.getElementById("creditCardExpireDateMonth").value) && !isEmpty(document.getElementById("creditCardExpireDateYear").value)) {
                    document.getElementById("creditCardExpireDateMonth").style.borderColor = "";
                    document.getElementById("creditCardExpireDateYear").style.borderColor = "";
                    if (!isEmpty(document.getElementById("creditCardCVV").value && checkRegex("^[0-9]{3,4}$", creditCardCVV))) {
                        document.getElementById("creditCardCVV").style.borderColor = "";
                        document.getElementById("cart").style.display = "none";
                        document.getElementById("PaymentDetails").style.display = "block";
                        document.getElementById("paymentConfirmation").style.display = "block";
                        document.getElementById("creditCardDetails").style.display = "block";
                        document.getElementById("paymentOrder").style.display = "block";
                        document.getElementById("paymentHomeLinkBtn").style.display = "block";
                        renderOrderList();
                        refreshShoppingCart();
                        document.getElementById("paymentConfirmationGender").innerText = gender;
                        document.getElementById("paymentConfirmationFirstName").innerText = firstName;
                        document.getElementById("paymentConfirmationLastName").innerText = lastName;
                        document.getElementById("paymentConfirmationEmail").innerText = email;
                        document.getElementById("paymentConfirmationAddress").innerText = address;
                        document.getElementById("paymentConfirmationPLZ").innerText = plz;
                        document.getElementById("paymentConfirmationCity").innerText = state;
                        document.getElementById("paymentConfirmationCountry").innerText = country;
                        document.getElementById("paymentConfirmationPaymentMethod").innerText = paymentMethod;

                        document.getElementById("paymentConfirmationHolderName").innerText = document.getElementById("creditCardHolderName").value;
                        document.getElementById("paymentConfirmationNumber").innerText = document.getElementById("creditCardNumber").value;
                        document.getElementById("paymentConfirmationExpiryDateMonth").innerText = document.getElementById("creditCardExpireDateMonth").value;
                        document.getElementById("paymentConfirmationExpiryDateYear").innerText = document.getElementById("creditCardExpireDateYear").value;

                        document.getElementById("creditCard_container").style.display = "none";
                        document.getElementById("PaymentDetails").style.display = "none";

                    }else{
                        document.getElementById("creditCardCVV").style.borderColor = "#ee5253";
                    }
                }else{
                    document.getElementById("creditCardExpireDateMonth").style.borderColor = "#ee5253";
                    document.getElementById("creditCardExpireDateYear").style.borderColor = "#ee5253";
                }
            }else{
                document.getElementById("creditCardNumber").style.borderColor = "#ee5253";
            }
        }else{
            document.getElementById("creditCardHolderName").style.borderColor = "#ee5253";
        }

    };
    request.send();

}

function isEmpty(subject) {
    return subject === "";

}