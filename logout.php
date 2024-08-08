<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If it's desired to delete the session cookie, check if cookies are set
if (isset($_COOKIE[session_name()])) {
    // Set the cookie's expiration date to an hour ago
    setcookie(session_name(), '', time() - 3600, '/');
}

// Finally, destroy the session
session_destroy();

// Redirect to the login page or home page
header("Location: loginPage.php"); // Change to your desired location
exit();
?>
