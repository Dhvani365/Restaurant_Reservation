<?php
session_start();
if (isset($_SESSION['session_expired']) && $_SESSION['session_expired']) {
    echo "<p>Your session has expired. Please log in again.</p>";
    unset($_SESSION['session_expired']); // Clear the session expired flag
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="ValidateForm.js"></script>
    <style>
        body {
            background-image: url("./Images/heroSectionBackground.png");
            background-repeat: no-repeat;
            background-size:cover;
            font-family: Arial, sans-serif;
            /* background-color: #f4f4f4; */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 20px;
            width: 300px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        #login-uname,
        #login-password {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #de2b3a;

            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #de2b3a;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #de2b3a;
        }

         /* Notification styles */
         .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: white;
            border: 2px solid red;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000; /* Make sure it appears on top */
            display: block; /* Initially hidden */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="./login.php" method="post" onsubmit="return validateLogin()">
            <div class="input-group">
                <label for="login-uname">Username</label>
                <input type="text" id="login-uname" placeholder="Enter your username" name='uname' required>
            </div>
            <div class="input-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" placeholder="Enter your password" name='pass' required>
            </div>
            
            <!-- Display notification if there is a message in the session -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="notification show">
                    <?php 
                        echo htmlspecialchars($_SESSION['message']); 
                        unset($_SESSION['message']); // Clear the message after displaying
                    ?>
                </div>
            <?php endif; ?>
            
            <input type="submit" value="Login">

            <div class="message">
                <p>Don't have an account? <a href="RegisterPage.html">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>