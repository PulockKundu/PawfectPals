function findExistingEmail(){
    var email = document.getElementById("email").value;
    // console.log("Email typed: " + email);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ajaxResponse").innerHTML =this.responseText;
        }
        else
        {
            document.getElementById("ajaxResponse").innerHTML = this.status;
        }
    };
    xhttp.open("POST", "../controller/checkEmail.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email="+email);
    }
