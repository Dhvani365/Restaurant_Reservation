<?php
$host = 'localhost'; // Database host
$username = 'root'; // Username
$password = ''; // Password (empty if none)
$database = 'test'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $table_no = $_POST['table_no'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if (empty($username) || empty($table_no) || empty($date) || empty($status)) {
        die("Missing required data.");
    }

    // Debugging output to see the received values
    error_log("Received data: username=$username, table_no=$table_no, date=$date, status=$status");

    // Prepare the SQL statement to update the status
    $stmt = $conn->prepare("UPDATE reserve SET status = ? WHERE username = ? AND table_no = ? AND date = ?");
    
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param('ssis', $status, $username, $table_no, $date);

    // Execute the query and provide detailed debugging information
    if ($stmt->execute()) {
        echo 'success';
    } else {
        // Provide detailed SQL error message
        echo 'error: ' . $conn->error;
    }

    $stmt->close();
} else {
    echo 'Invalid request method';
}

$conn->close();
?>
