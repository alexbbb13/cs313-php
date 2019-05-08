
const ERROR = false;
var item_0 = 0;
var item_1 = 0;
var item_2 = 0;
var item_3 = 0;
var item_4 = 0;

function setListeners(){
/*
    document.getElementById("first_name").addEventListener("change", checkFirstName, false);
    document.getElementById("last_name").addEventListener("change", checkLastName, false);
    document.getElementById("address").addEventListener("change", checkAddress, false);
    document.getElementById("phone").addEventListener("change", checkPhone, false);
    document.getElementById("credit_card").addEventListener("change", checkCreditCard, false);
    document.getElementById("exp_date").addEventListener("change", checkExpDate, false);
    */
    document.getElementById("item_0").addEventListener("change", checkBox0, false);
    document.getElementById("item_1").addEventListener("change", checkBox1, false);
    document.getElementById("item_2").addEventListener("change", checkBox2, false);
    document.getElementById("item_3").addEventListener("change", checkBox3, false);
    document.getElementById("item_4").addEventListener("change", checkBox4, false);

    document.forms[0].onreset = function () {
        item_0 = 0;
        item_1 = 0;
        item_2 = 0;
        item_3 = 0;
        item_4 = 0;
        updateTotal();
    };
    document.forms[0].addEventListener("submit", evt => doSubmit(evt));
}

function doSubmit(evt) {
    //evt.preventDefault();
    if (checkFirstName()!==ERROR &&
        checkLastName()!==ERROR &&
        checkAddress()!==ERROR &&
        checkPhone()!==ERROR &&
        checkCreditCard()!==ERROR &&
        checkExpDate()!==ERROR
    ) {
        document.getElementById("form_input").submit();
    }else {
        evt.preventDefault();
    }
}

function check() {
    checkFirstName();
    checkLastName();
    checkAddress();
    checkPhone();
    checkCreditCard();
    checkExpDate();
}

function checkFirstName() {
    var result = checkField("first_name", function (field) {
        return (field.length > 0);
    }, 'Please enter first name');
    return result;
}

function checkLastName() {
    var result = checkField("last_name", function (field) {
        return (field.length > 0);
    }, 'Please enter last name');
    return result;
}

function checkAddress() {
    var result = checkField("address", function (field) {
        return (field.length > 0);
    }, 'Please enter a valid address');
    return result;
}

function checkPhone() {
    var result = checkField("phone", function (field) {
        return (/^\d{3}-\d{3}-\d{4}$/.test(field));
    }, 'Phone must be of the format "208-497-3657"');
    return result;
}

function checkCreditCard() {
    var result = checkField("credit_card", function (field) {
        return (/^\d{4} \d{4} \d{4} \d{4}$/.test(field));
    }, 'Must be 16 digits in the format 0000 0000 0000 0000');
    return result;
}

function checkExpDate() {
    var result = checkField("exp_date", function (field) {
        return (/^(0?[1-9]|1[012])\/20(19|2\d)$/.test(field));
    }, 'Please enter in MM/20YY format, valid years are 2019 to 2029');
    return result;
}

function checkBox0() {
    if (document.getElementById("item_0").checked) {
        item_0 = 1;
    } else {
        item_0 = 0;
    };
    updateTotal()
}

function checkBox1() {
    if (document.getElementById("item_1").checked) {
        item_1 = 1;
    } else {
        item_1 = 0;
    };
    updateTotal()
}

function checkBox2() {
    if (document.getElementById("item_2").checked) {
        item_2 = 1;
    } else {
        item_2 = 0;
    };
    updateTotal()
}

function checkBox3() {
    if (document.getElementById("item_3").checked) {
        item_3 = 1;
    } else {
        item_3 = 0;
    };
    updateTotal()
}

function checkBox4() {
    if (document.getElementById("item_4").checked) {
        item_4 = 1;
    } else {
        item_4 = 0;
    };
    updateTotal()
}

function updateTotal() {
    total = item_0 * 1.99 + item_1 * 0.99 + item_2 * 7.99 + item_3 * 3.99 + item_4 * 0.99;
    document.getElementById("total").innerText = "Total: $" + total.toFixed(2);
}

// fieldId - string, validateFunction - function returning true/false, errorText - string message
function checkField(fieldId, validateFunction, errorText) {
    const ERROR_TEXT = errorText;
    var field = document.getElementById(fieldId);
    var errorField = document.getElementById("error_" + fieldId);
    if (field && field.value) {
        if (validateFunction(field.value) === true) {
            //validated
            errorField.visibility = "hidden";
            errorField.innerText = '';
            return field.value;
        } else {
            field.focus()
            errorField.visibility = "visible";
            errorField.innerText = ERROR_TEXT;
        }
        // only on final check
    } else if (field.value === undefined) {
        field.focus()
        errorField.visibility = "visible";
        errorField.innerText = ERROR_TEXT;
    } else {
        field.focus()
        errorField.visibility = "hidden";
        errorField.innerText = ERROR_TEXT;
    }
    return ERROR;
}

function formReset() {
    document.getElementById("form_input").reset();
}



