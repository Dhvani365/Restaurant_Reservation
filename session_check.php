<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Check if session has expired
    if (time() - $_SESSION['last_activity'] > $_SESSION['expire_time']) {
        // Session has expired, destroy it
        session_unset(); // Unset session variables
        session_destroy(); // Destroy session data
        
        // Redirect to login page with an expired session message
        $_SESSION['session_expired'] = true;
        header("Location: LoginPage.php");
        exit();
    } else {
        // Update last activity time stamp
        $_SESSION['last_activity'] = time();
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: LoginPage.php");
    exit();
}
?>
