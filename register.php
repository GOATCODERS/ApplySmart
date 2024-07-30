<?php

require 'base_connector.php';
require 'Student.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = $_POST['first_name'];
    $id = $_POST['user_id'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $userpassword = $_POST['password'];
    $password = $_POST['confirm_password'];
  
    $errors = [];

    // Validate first name
    if (empty($_POST["first_name"])) {
        $errors[] = "First name is required.";
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
        $errors[] = "Last name is required.";
    }

    // Validate user ID
    if (empty($_POST["user_id"])) {
        $errors[] = "Student number is required.";
    }

    // Validate email
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (strlen($_POST["password"]) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate password confirmation
    if ($_POST["password"] !== $_POST["confirm_password"]) {
        $errors[] = "Passwords do not match.";
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

        // Create a new Person instance
        $person = new User($id, $name, $lastName, $email, $userpassword, $db);

        // Save the Person to the database
        $person->createUser();


    } 
}

exit();
?>