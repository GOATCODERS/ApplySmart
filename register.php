<?php

require 'base_connector.php';
require 'Student.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['first_name'];
    $id = $_POST['user_id'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $userpassword = $_POST['password'];
    $password = $_POST['confirm_password'];
  

    if(!empty($name)){

        // Create a new database connection
        $database = new Database();
        $db = $database->getConnection();

        // Create a new Person instance
        $person = new User($id, $name, $lastName, $email, $userpassword, $db);

        // Save the Person to the database
        $person->save();

    }else {
        echo "<h2>Please enter your name!</h2>";
    }
    
}

?>