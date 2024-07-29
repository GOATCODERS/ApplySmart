<?php

class User {
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $userpassword;
    private $db;

    public function __construct($id, $name, $lastName, $email, $userpassword, $db) {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->userpassword = $userpassword;
        $this->db = $db;
    }

    public function setName($user_name){
        $this->name = $user_name;
    }
    public function setID($id){
        $this->id = $id;
    }
    public function setLastname($user_lastname){
        $this->lastName = $user_lastname;
    }
    public function setEmail($user_email){
        $this->email = $user_email;
    }
    public function setPassword($user_password){
        $this->userpassword = $user_password;
    }
    
    public function getID(){
        return $this->id;
    } 
    public function getName(){
        return $this->name;
    } 
    public function getLastName(){
        return $this->lastName;
    } 
    public function getEmail(){
        return $this->email;
    } 
    public function getPassword(){
        return $this->userpassword;
    } 
    
    public function save() {
        try {
            // Prepare SQL statement
            $sql = "INSERT INTO users (user_id, name, lastName, email, password) VALUES (:user_id, :name, :lastName, :email, :password)";
            $stmt = $this->db->prepare($sql);
            // Bind parameters
            echo $this->name;
            $stmt->bindParam(':user_id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->userpassword);

            // Execute SQL statement
            $stmt->execute();
            echo "Person added successfully!";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
