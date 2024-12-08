function validateForm() {
    const email = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    // Validate email format (basic check for email or username)
    if (email === "") {
        alert("Please enter your email or username.");
        return false;
    }

    // Check if password is not empty
    if (password === "") {
        alert("Please enter your password.");
        return false;
    }

    // If all validations pass
    return true;
}
