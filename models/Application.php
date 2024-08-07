<?php

class Application
{
    private $applicationId;
    private $userId;
    private $courseId;
    private $applicationStatus;
    private $applicationDate;
    private $db;

    public function __construct($userId, $courseId, $applicationStatus = 'submitted', $db, $applicationId = null)
    {
        $this->userId = $userId;
        $this->courseId = $courseId;
        $this->applicationStatus = $applicationStatus;
        $this->db = $db;
        $this->applicationId = $applicationId;
        $this->applicationDate = date('Y-m-d H:i:s'); // Default to current timestamp
    }

    // Setters
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    
    public function setCourseId($courseId) {
        $this->courseId = $courseId;
    }
    
    public function setApplicationStatus($status) {
        if (in_array($status, ['submitted', 'under_review', 'accepted', 'rejected'])) {
            $this->applicationStatus = $status;
        } else {
            throw new InvalidArgumentException('Invalid status value.');
        }
    }
    
    public function setApplicationDate($applicationDate) {
        $this->applicationDate = $applicationDate;
    }

    // Getters
    public function getApplicationId() {
        return $this->applicationId;
    }

    public function getUserId() {
        return $this->userId;
    }
    
    public function getCourseId() {
        return $this->courseId;
    }

    public function getApplicationStatus() {
        return $this->applicationStatus;
    }

    public function getApplicationDate() {
        return $this->applicationDate;
    }

    // Add a new application to the database
    public function addApplication() {
        try {
            $sql = "INSERT INTO applications (user_id, course_id, application_status, application_date) 
                    VALUES (:user_id, :course_id, 'submitted', :application_date)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $this->userId);
            $stmt->bindParam(':course_id', $this->courseId);
            $stmt->bindParam(':application_date', $this->applicationDate);

            $stmt->execute();
            echo 'Application submitted successfully!';
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while submitting the application. Please try again later.';
        }
    }

    // Update application status
    public function updateStatus($status) {
        try {
            if (!in_array($status, ['submitted', 'under_review', 'accepted', 'rejected'])) {
                throw new InvalidArgumentException('Invalid status value.');
            }
            
            $sql = "UPDATE applications 
                    SET application_status = :status 
                    WHERE application_id = :application_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':application_id', $this->applicationId);
            $stmt->bindParam(':status', $status);

            $stmt->execute();
            echo 'Application status updated successfully!';
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while updating the application status. Please try again later.';
        }
    }

    // Retrieve application details by application_id
    public function getApplicationDetails() {
        try {
            $sql = "SELECT application_id, user_id, course_id, application_status, application_date 
                    FROM applications 
                    WHERE application_id = :application_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':application_id', $this->applicationId);
            $stmt->execute();
            
            $application = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $application ? $application : null;
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while retrieving application details. Please try again later.';
            return null;
        }
    }

    // Retrieve all applications for a specific user_id
    public static function getApplicationsByUserId($userId, $db) {
        try {
            $sql = "SELECT application_id, user_id, course_id, application_status, application_date 
                    FROM applications 
                    WHERE user_id = :user_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while retrieving applications. Please try again later.';
            return [];
        }
    }

    // Retrieve all applications for a specific course_id
    public static function getApplicationsByCourseId($courseId, $db) {
        try {
            $sql = "SELECT application_id, user_id, course_id, application_status, application_date 
                    FROM applications 
                    WHERE course_id = :course_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':course_id', $courseId);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while retrieving applications. Please try again later.';
            return [];
        }
    }
}
?>
