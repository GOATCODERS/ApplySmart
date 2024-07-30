<?php

class User {
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $db;

    public function __construct($id, $name, $lastName, $email, $password, $db) {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hash password
        $this->db = $db;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }
    public function setID($id) {
        $this->id = $id;
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

    // Getters
    public function getID() {
        return $this->id;
    }
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

    // Create user in database
    public function createUser() {
        try {
            // Prepare SQL statement
            $sql = "INSERT INTO users (user_id, name, lastName, email, password) VALUES (:user_id, :name, :lastName, :email, :password)";
            $stmt = $this->db->prepare($sql);
            // Bind parameters
            $stmt->bindParam(':user_id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

            // Execute SQL statement
            $stmt->execute();
            header('Location: Prospectus.php');
            exit(); // Always call exit after a header redirection
        } catch (PDOException $e) {
            // Log error to a file (do not expose in production)
            error_log('Error: ' . $e->getMessage(), 3, 'C:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred. Please try again later.';
        }
    }

    // Retrieve user info by user_id
    public static function getUserInfo($user_id, $db) {
        try {
            $sql = "SELECT user_id, name, lastName, email FROM users WHERE user_id = :user_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ? $user : null;
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage(), 3, '/var/log/app_errors.log');
            echo 'An error occurred while retrieving user info. Please try again later.';
            return null;
        }
    }

    // Load user data into the current instance
    public function loadFromDatabase($user_id) {
        $userInfo = self::getUserInfo($user_id, $this->db);

        if ($userInfo) {
            $this->id = $userInfo['user_id'];
            $this->name = $userInfo['name'];
            $this->lastName = $userInfo['lastName'];
            $this->email = $userInfo['email'];
            // Note: Password should not be retrieved from the database for security reasons
        } else {
            echo 'User not found.';
        }
    }

    // Authenticate user
    public static function login($email, $password, $db) {
        try {
            $sql = "SELECT user_id, name, lastName, email, password FROM users WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['loggedin'] = true;
                header('Location: welcome.php');
                exit();
            } else {
                echo $password;
                return false; // Return false if login fails
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage(), 3, '/var/log/app_errors.log');
            echo 'An error occurred during login. Please try again later.';
            return false;
        }
    }
}
?>