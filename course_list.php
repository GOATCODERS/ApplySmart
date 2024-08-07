<?php
require_once 'base_connector.php'; // File containing Database class
require_once 'models/Course.php'; // File containing the Course class

// Database connection
$database = new Database();
$db = $database->getConnection();

function fetchCourses($db) {
    try {
        $sql = "SELECT course_id, course_name, description, admission_point_score, subject_required, faculty_id, institution_id FROM Courses";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error: ' . $e->getMessage() . "\r\n", 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
        echo 'An error occurred while retrieving courses. Please try again later.';
        return [];
    }
}

$courses = fetchCourses($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .course-table {
            margin: 20px;
        }
        .course-table th, .course-table td {
            text-align: center;
        }
        .carousel-inner img {
            max-height: 700px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <?php include 'navBar.php'; ?>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="assets/background2.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="assets/background3.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="assets/background4.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" aria-label="Previous">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" aria-label="Next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
<div class="container m-5">
    <h1 class="my-5">Course List</h1>
    <?php if (count($courses) > 0): ?>
        <div class="list-group" id="list-tab" role="tablist">
        <?php foreach ($courses as $course): ?>
    
                <a class="list-group-item list-group-item-action" href="Prospectus.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo htmlspecialchars($course['course_name']); ?></h5>
                        <small>Open</small>
                    </div>
                    <p class="mb-1"><?php echo htmlspecialchars($course['description']); ?> </p>
                    <small>Minimum Requirements: <?php echo htmlspecialchars($course['subject_required']); ?>______ Min APS: <?php echo htmlspecialchars($course['admission_point_score']); ?>.</small>
                </a>
           
       
        <?php endforeach; ?>
            <?php else: ?>
                
                    <h1>No courses found.</h1>
                
            <?php endif; ?>
        </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
