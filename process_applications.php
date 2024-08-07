<?php
require_once 'base_connector.php'; // Ensure this file contains the Database class

// Start session
session_start();

// Database connection
$database = new Database();
$db = $database->getConnection();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die('Error: User not logged in.');
}

$user_id = $_SESSION['user_id'];

// Get data from the form
$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
$document_type = isset($_POST['document_type']) ? $_POST['document_type'] : '';
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0.00;
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

// Check if course_id is valid
$stmt = $db->prepare("SELECT course_id FROM courses WHERE course_id = ?");
$stmt->execute([$course_id]);
$courseExists = $stmt->fetchColumn();

if (!$courseExists) {
    die('Error: Invalid course ID.');
}

// Handle document upload
if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/documents/';
    
    // Check if the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create the directory if it doesn't exist
    }
    
    $upload_file = $upload_dir . basename($_FILES['document']['name']);
    
    if (move_uploaded_file($_FILES['document']['tmp_name'], $upload_file)) {
        // Prepare to insert application and document info into database
        try {
            $db->beginTransaction();
            
            // Insert into applications table
            $stmt = $db->prepare("INSERT INTO applications (user_id, course_id, application_status) VALUES (?, ?, 'submitted')");
            $stmt->execute([$user_id, $course_id]);
            $application_id = $db->lastInsertId();
            
            // Insert into documents table
            $stmt = $db->prepare("INSERT INTO documents (user_id, application_id, document_type, document_path) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $application_id, $document_type, $upload_file]);

            // Insert payment info if applicable
            if ($amount > 0) {
                $stmt = $db->prepare("INSERT INTO payments (user_id, application_id, amount, payment_method) VALUES (?, ?, ?, ?)");
                $stmt->execute([$user_id, $application_id, $amount, $payment_method]);
            }

            $db->commit();
            echo 'Application submitted successfully.';
        } catch (PDOException $e) {
            $db->rollBack();
            die('Database error: ' . $e->getMessage());
        }
    } else {
        echo 'Failed to upload document. Please check the directory permissions.';
    }
} else {
    echo 'No document uploaded or error in file upload.';
}
?>
