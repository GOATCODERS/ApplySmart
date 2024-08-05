<?php
require_once 'base_connector.php'; // File containing Database class
require_once 'Course.php'; // File containing the Course class

// Database connection
$database = new Database();
$db = $database->getConnection();

// Get course_id from URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Initialize Course object and fetch course details
$course = new Course($course_id, $db);
$courseDetails = $course->getCourseDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .course-details {
            margin: 20px;
        }
    </style>
</head>
<body>

    <?php include 'navBar.php'; ?>

    <div class="container course-details">
        <?php if ($courseDetails): ?>
            <h1><?php echo htmlspecialchars($courseDetails['course_name']); ?></h1>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($courseDetails['description']); ?></p>
            <p><strong>Minimum Duration (Years):</strong> <?php echo htmlspecialchars($courseDetails['minimum_duration_years']); ?></p>
            <p><strong>Closing Date:</strong> <?php echo htmlspecialchars($courseDetails['closing_date']); ?></p>
            <p><strong>Minimum Requirements:</strong> <?php echo htmlspecialchars($courseDetails['subject_required']); ?></p>
            <p><strong>Minimum APS:</strong> <?php echo htmlspecialchars($courseDetails['admission_point_score']); ?></p>
            <p><strong>Possible Further Studies:</strong> <?php echo htmlspecialchars($courseDetails['possible_further_studies']); ?></p>
            <p><strong>Possible Careers:</strong> <?php echo htmlspecialchars($courseDetails['possible_careers']); ?></p>
            <p><strong>Price:</strong> $<?php echo htmlspecialchars($courseDetails['price']); ?></p>
            <p><strong>Faculty:</strong> <?php echo htmlspecialchars($courseDetails['faculty_name']); ?></p>
            <p><strong>Institution:</strong> <?php echo htmlspecialchars($courseDetails['institution_name']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($courseDetails['institution_location']); ?></p>
        <?php else: ?>
            <h1>Course not found.</h1>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
