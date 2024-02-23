function printError(Id, Msg) {
    document.getElementById(Id).innerHTML = Msg;
}

function validateForm() {
    var email = document.getElementById("email").value;

    var emailErr = validateEmail(email);

    if (emailErr) {
        return true;
    } else return false;
}

function validateEmail(email) {
    if (email == "" || email == null) {
        printError("emailErr", "Please enter your email.");
        return false;
    } else {
        var regex = /^[a-zA-Z0-9]+@[a-z]+\.[a-zA-Z]{2,3}$/;
        if (!regex.test(email)) {
            printError(
                "emailErr",
                "Please enter a valid email (example@gmail.com)"
            );
            return false;
        } else {
            printError("emailErr", "");
            return true;
        }
    }
}

function keydownValidation() {
    var email = document.getElementById("email");

    email.addEventListener("input", function () {
        validateEmail(email.value);
    });
}

function initValidation() {
    var email = document.getElementById("email");

    email.addEventListener("blur", function () {
        validateEmail(email.value);
    });
}

keydownValidation();
// initValidation();

document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("forgot_password");
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
