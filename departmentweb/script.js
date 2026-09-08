function validateForm() {

    let password = document.getElementById("password").value;

    if (password.length < 6) {
        alert("Password must contain at least 6 characters");
        return false;
    }

    return true;
}