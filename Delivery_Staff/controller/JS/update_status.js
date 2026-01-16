function update_status(orderId, status) {

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("status_" + orderId).innerHTML = status;
        }
    };

    xhr.open("POST", "../controller/update_status_validation.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("orderid=" + orderId + "&status=" + status);
}

