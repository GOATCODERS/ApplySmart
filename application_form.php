<?php
require_once 'base_connector.php'; // Ensure this file contains the Database class
require_once 'models/Course.php'; // Ensure this file contains the Course class

// Start session
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: loginPage.php");
    die('Error: User not logged in.');
}

// Database connection
$database = new Database();
$db = $database->getConnection();

// Get course_id from URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Initialize Course object and fetch course details
$course = new Course($course_id, $db);
$courseDetails = $course->getCourseDetails();
$table_name = 'student';
$enum_column = 'marital_status';

$marital_status = $database->getEnumColumnType($table_name, $enum_column);

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

        <div class="card m-5 py-5 bg-success" style=" height: auto; --bs-bg-opacity: 0.1;">
            <div class="card-body mx-5" style="--bs-bg-opacity: 0.1;">
           <div class="card-title mb-5 ">
                <h2>Apply for <?php echo htmlspecialchars($courseDetails['course_name']); ?></h2>
           </div>
            
        <form class="" action="process_applications.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
            <input type="hidden" name="action" value="apply">
            <div class="row g-3 mb-3">
                <div class="col-md-5">
                    <label for="validationDefault01" class="form-label">First name<large class="text-danger"> *</large><small class="text-secondary"> (same as ID)</small> </label>
                    <input type="text" class="form-control" id="validationDefault01" value="Mark" required>
                </div>
                <div class="col-md-6">
                    <label for="validationDefault02" class="form-label">Middle name<small class="text-secondary">(optional)</small></label>
                    <input type="text" class="form-control" id="validationDefault02" value="Otto">
                </div>
            </div>
           
            <div class="row g-3 mb-3">
                <div class="col-md-5 ">
                    <label for="last_name" class="form-label">Last name<large class="text-danger"> *</large> <small class="text-secondary"> (same as ID)</small></label>
                    <input type="text" class="form-control" id="last_name" aria-describedby="inputGroupPrepend2" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-5 ">
                    <label for="id" class="form-label">ID/Passport number<large class="text-danger"> *</large></label>
                    <input type="text" class="form-control" id="id" aria-describedby="inputGroupPrepend2" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-5 ">
                    <label for="marital_status" class="form-label">Marital status</label>
                    <select class="form-select" id="marital_status" required>
                    <option selected disabled value="">Choose...</option>
                    <?php foreach ($marital_status as $option) {
                    echo "<option>" . htmlspecialchars($option) . "</option>";
                    } ?>
                   
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-5">
                    <label for="validationDefault03" class="form-label">City</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                </div>
                <div class="col-md-3">
                    <label for="validationDefault04" class="form-label">State</label>
                    <select class="form-select" id="validationDefault04" required>
                    <option selected disabled value="">Choose...</option>
                    <option>...</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationDefault05" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="validationDefault05" required>
                </div>
            </div>
            
            
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label for="document_type" class="form-label">Document Type</label>
                    <select class="form-select" id="document_type" name="document_type">
                        <option selected disabled value="">Choose...</option>
                        <option value="transcript">Transcript</option>
                        <option value="recommendation_letter">Recommendation Letter</option>
                        <option value="resume">Resume</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="document" class="form-label">Upload Document</label>
                    <input type="file" class="form-control" id="document" name="document" required>
                </div>
            </div>
            

            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                        Agree to terms and conditions
                    </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit Application</button>
            </div>
        </form>
            </div>
        </div>
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
