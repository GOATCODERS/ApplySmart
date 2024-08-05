<?php
require_once 'base_connector.php'; // Ensure this file contains the Database class
require_once 'Course.php'; // Ensure this file contains the Course class

// Database connection
$database = new Database();
$db = $database->getConnection();

// Get course_id from URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Initialize Course object and fetch course details
$course = new Course($course_id, $db);
$courseDetails = $course->getCourseDetails();
$curriculumDetails = $course->getCurriculumDetails();
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
        .curriculum-table th, .curriculum-table td {
            text-align: center;
        }
    </style>
</head>
<body>

    <?php include 'navBar.php'; ?>

    <div class="container course-details">
        <?php if ($courseDetails): ?>
            <div class="card" style="width: 48rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-center row">
                        <h2 class="card-title"><?php echo htmlspecialchars($courseDetails['course_name']); ?></h2>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo htmlspecialchars($courseDetails['description']); ?></h6>
                    </div>
                    <p class="card-text"><strong>Minimum Duration (Years):</strong> <?php echo htmlspecialchars($courseDetails['minimum_duration_years']); ?></p>
                    <p class="card-text"><strong>Closing Date:</strong> <?php echo htmlspecialchars($courseDetails['closing_date']); ?></p>
                    <p class="card-text"><strong>Minimum Requirements:</strong> <?php echo htmlspecialchars($courseDetails['subject_required']); ?></p>
                    <p class="card-text"><strong>Minimum APS:</strong> <?php echo htmlspecialchars($courseDetails['admission_point_score']); ?></p>
                    <p class="card-text"><strong>Possible Further Studies:</strong> <?php echo htmlspecialchars($courseDetails['possible_further_studies']); ?></p>
                    <p class="card-text"><strong>Possible Careers:</strong> <?php echo htmlspecialchars($courseDetails['possible_careers']); ?></p>
                    <p class="card-text"><strong>Price:</strong> $<?php echo htmlspecialchars($courseDetails['price']); ?></p>
                    <p class="card-text"><strong>Faculty:</strong> <?php echo htmlspecialchars($courseDetails['faculty_name']); ?></p>
                    <p class="card-text"><strong>Institution:</strong> <?php echo htmlspecialchars($courseDetails['institution_name']); ?></p>
                    <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($courseDetails['institution_location']); ?></p>
                </div>
            </div>
            
            <h3 class="my-5">Curriculum</h3>
            <?php if (count($curriculumDetails) > 0): ?>
                <table class="table table-striped curriculum-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Module</th>
                            <th>NQF Level</th>
                            <th>Credits</th>
                            <th>Prerequisite Modules</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($curriculumDetails as $curriculum): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($curriculum['code']); ?></td>
                                <td><?php echo htmlspecialchars($curriculum['module']); ?></td>
                                <td><?php echo htmlspecialchars($curriculum['nqf_level']); ?></td>
                                <td><?php echo htmlspecialchars($curriculum['credits']); ?></td>
                                <td><?php echo htmlspecialchars($curriculum['prerequisite_modules']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h4>No curriculum details available.</h4>
            <?php endif; ?>
        <?php else: ?>
            <h1>Course not found.</h1>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
