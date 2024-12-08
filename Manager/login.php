<?php
session_start(); // Start the session to store user information

$host = 'localhost'; // Database host
$username = 'root'; // Username
$password = ''; // Password (empty if none)
$database = 'test'; // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error="";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Query to check email and password
    $sql = "SELECT username, branch FROM login WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $branch = $row['branch']; // Assuming branch is stored in the login table

        // Store user info in session
        $_SESSION['username'] = $username;
        $_SESSION['branch'] = $branch;
        // Redirect to manager dashboard
        header("Location: manager1.php");
        exit();
    } else {
        // Invalid login
        $error = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Optional: Include Font Awesome for Social Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTTXRN1BYkI1IhG+PAhYq4PpUawTBrIZ05qF9HprSCTjMd8eTtZzBvnRrQBEjH6bGDTQ8xE3qQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Side: Image Section -->
        <div class="image-section">
            <img src="../Images/heroSectionBackground.png" alt="Restaurant Image" class="responsive-image">
        </div>

        <!-- Right Side: Login Form -->
        <div class="form-section">
            <div class="form-container">
                <h2>Login</h2>
                <form id="loginForm" action="login.php" method="POST" onsubmit="return validateForm()">
                    <!-- Email Field -->
                    <label for="email">Username or Email:</label>
                    <input type="email" id="username" name="username" placeholder="Enter your email" required>


                    <!-- Password Field -->
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>

                    <!-- Remember Me and Forgot Password -->
                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Remember Me
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit">Login</button>

                    <!-- Divider -->
                    <div class="divider">
                        <span>OR</span>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="social-login">
                        <button type="button" class="social-btn google">
                            <i class="fab fa-google"></i> Sign in with Google
                        </button>
                        <button type="button" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i> Sign in with Facebook
                        </button>
                        <button type="button" class="social-btn twitter">
                            <i class="fab fa-twitter"></i> Sign in with Twitter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
    <script>
        <?php 
        if (!empty($error)) { ?>
            alert("<?php echo $error; ?>");
        <?php } ?>
    </script>
</body>
</html>