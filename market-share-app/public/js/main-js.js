// Global scripts go here


// Uses regex to check a password field element with id 'password'
function pwStrengthCheck() {
    var pw = document.getElementById('password').value;
    var pattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(.{8,})$/; 
    var error = "Password must contain at least:\n 8 characters\n 1 upper " +
    " case letter\n 1 lower case latter \n 1 number";

    // Error message written to element named 'pw-strength'
    if (!pattern.test(pw)) {
        document.getElementById('pw-strength').innerHTML = error;
    }

    else {
        document.getElementById('pw-strength').innerHTML = "";
    }
}