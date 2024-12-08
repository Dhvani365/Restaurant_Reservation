function validateLogin() {
    let username = document.getElementById('login-email').value;
    let password = document.getElementById('login-password').value;

    if (username == '' || password == '') {
        alert("Please fill all the fields!");
        return false;
    }
    alert("Login Successful!");
    return true;

}

function validateRegister() {
    var username = document.getElementById('register-username').value;
    var email = document.getElementById('register-email').value;
    var password = document.getElementById('register-password').value;
    var confirmPassword = document.getElementById('register-confirm-password').value;

    if (username == '' || email == '' || password == '' || confirmPassword == '') {
        alert('Please fill in all fields');
        return false;
    }

    if (password != confirmPassword) {
        alert('Passwords do not match');
        return false;
    }

    alert('Registration Successful');
    return true;
}

// function validateRegister() {
//     var password = document.getElementById('register-password').value;
//     var confirmPassword = document.getElementById('register-confirm-password').value;

//     if (password !== confirmPassword) {
//         alert('Passwords do not match.');
//         return false;
//     }
//     return true;
// }
