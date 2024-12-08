<?php
session_start(); // Start the session
$servername = "localhost";
$username = "root";  // Update with your DB username
$password = "";      // Update with your DB password
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user = $_POST['uname'];
$pass = $_POST['pass'];

// Prepare and execute query to check if username exists
$sql = "SELECT password FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Username exists, fetch password
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];

        // Compare entered password with the fetched password
        if ($pass === $password) { // Use password_verify() if passwords are hashed
            // Successful login, redirect to index.html
            // Successful login, store username in session
            $_SESSION['username'] = $user;
            $_SESSION['last_activity'] = time(); // Set last activity time stamp
            $_SESSION['expire_time'] = 20 * 60; // 20 minutes (in seconds)
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = "Incorrect password. Please try again."; // Store failure message
            header('location: LoginPage.php');
        }
    } else {
        $_SESSION['message'] = "Incorrect password. Please try again."; // Store failure message
        header('location: LoginPage.php');
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
