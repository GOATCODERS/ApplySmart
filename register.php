<?php

require 'base_connector.php';
require 'models/Student.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_type = trim($_POST['user_type']);
  
    $errors = [];

    // Validate first name
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }

    // Validate last name
    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate password confirmation
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Validate user type
    $valid_user_types = ['prospective_student', 'current_student', 'admin', 'faculty'];
    if (!in_array($user_type, $valid_user_types)) {
        $errors[] = "Invalid user type.";
    }

    // Check if there are any errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Create a new database connection
        $database = new Database();
        $db = $database->getConnection();

        // Create a new User instance
        $user = new User($first_name, $last_name, $email, $password, $user_type, $db);

        // Save the User to the database
        $user->createUser();
    }
}

exit();
?>
