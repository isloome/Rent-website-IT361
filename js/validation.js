function validation() {
    var username = document.forms["regform"]["username"].value;
    var email = document.forms["regform"]["email"].value;
    var password = document.forms["regform"]["password"].value;

    if (username == "") {
        alert("Username must be not empty");
        return false;
    }

    if (username == username.includes('9') || username.includes('8') || username.includes('7') || username.includes('6')
        || username.includes('5') || username.includes('4')
        || username.includes('3') || username.includes('2')
        || username.includes('1') || username.includes('0')) {
        alert("Please enter your name without any numbers");
        return false;
    }

    if (password == "") {
        alert("Please enter your password");
        return false;
    }

    if (password.length < 6) {
        alert("Password should be at least 6 character");
        return false;

    }
}