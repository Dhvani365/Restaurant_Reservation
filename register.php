<?php
$servername = "localhost";
$username = "root";  // Update with your DB username
$password = "";      // Update with your DB password
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname)
or die("Connection failed: " . $conn->connect_error);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $user = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    // Insert data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

    if (mysqli_query($conn, $sql)) {
        // Registration successful, redirect to landing page
        header("Location: LoginPage.html");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);;
    }
}

mysqli_close($conn);
?>