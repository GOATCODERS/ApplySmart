<?php
require_once 'base_connector.php'; // Ensure this file contains the Database class
require_once 'models/Course.php'; // Ensure this file contains the Course class

// Database connection
$database = new Database();
$db = $database->getConnection();

// Get course_id from URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Initialize Course object and fetch course details
$course = new Course($course_id, $db);
$courseDetails = $course->getCourseDetails();

if (!$courseDetails) {
    die('Course not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <?php include 'navBar.php'; ?>

    <div class="container mt-5">
        <h2>Apply for <?php echo htmlspecialchars($courseDetails['course_name']); ?></h2>
        <form action="process_applications.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
            <input type="hidden" name="action" value="apply">

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required>
            </div>

            <div class="mb-3">
                <label for="document_type" class="form-label">Document Type</label>
                <select class="form-select" id="document_type" name="document_type">
                    <option value="transcript">Transcript</option>
                    <option value="recommendation_letter">Recommendation Letter</option>
                    <option value="resume">Resume</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="document" class="form-label">Upload Document</label>
                <input type="file" class="form-control" id="document" name="document" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
