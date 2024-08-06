<?php

class User {
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $user_type;
    private $db;

    // Constructor
    public function __construct($name, $lastName, $email, $password, $user_type, $db) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hash password
        $this->user_type = $user_type;
        $this->db = $db;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hash password
    }
    public function setUserType($user_type) {
        $this->user_type = $user_type;
    }

    // Getters
    public function getName() {
        return $this->name;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getUserType() {
        return $this->user_type;
    }

    // Create user in database
    public function createUser() {
        try {
            $sql = "INSERT INTO users (name, lastName, email, password, user_type) VALUES (:name, :lastName, :email, :password, :user_type)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':user_type', $this->user_type);

            $stmt->execute();
            header('Location: course_list.php');
            exit(); // Always call exit after a header redirection
        } catch(Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred. Please try again later.';
        }
    }

    // Retrieve user info by email
    public static function getUserInfo($email, $db) {
        try {
            $sql = "SELECT name, lastName, email, user_type FROM users WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while retrieving user info. Please try again later.';
            return null;
        }
    }

    // Authenticate user
    public static function login($email, $password, $db) {
        try {
            $sql = "SELECT name, lastName, email, password, user_type FROM users WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['name'] = $user['name'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_type'] = $user['user_type']; // Store user type in session
                $_SESSION['loggedin'] = true;
                header('Location: course_list.php');
                exit();
            } else {
                return false; // Return false if login fails
            }
        }  catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred during login. Please try again later.';
            return false;
        }
    }
}
?>
