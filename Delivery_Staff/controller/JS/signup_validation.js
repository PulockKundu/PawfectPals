function validateSignup() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let usertype = document.getElementById("usertype").value;

    document.getElementById("emailErr").innerHTML = "";
    document.getElementById("passwordErr").innerHTML = "";
    document.getElementById("usertypeErr").innerHTML = "";

    let valid = true;


    if (email === "") {
        document.getElementById("emailErr").innerHTML = "Email required";
        valid = false;
    } else if (!isValidEmail(email)) {
        document.getElementById("emailErr").innerHTML = "Invalid email format";
        valid = false;
    }

   
    if (password === "") {
        document.getElementById("passwordErr").innerHTML = "Password required";
        valid = false;
    } else if (password.length < 6) {
        document.getElementById("passwordErr").innerHTML =
            "Password must be at least 6 characters";
        valid = false;
    } else if (!password.includes("@") && !password.includes("#")) {
        document.getElementById("passwordErr").innerHTML =
            "Password must contain @ or #";
        valid = false;
    }

    
    if (usertype === "") {
        document.getElementById("usertypeErr").innerHTML =
            "Select user type";
        valid = false;
    }

    return valid;
}

function isValidEmail(email) {
    let at = email.indexOf("@");
    let dot = email.lastIndexOf(".");
    return at > 0 && dot > at + 1 && dot < email.length - 1;
}
