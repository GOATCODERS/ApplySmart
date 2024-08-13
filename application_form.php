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

$table_name = 'documents';
$enum_column = 'document_type';
$document_type = $database->getEnumColumnType($table_name, $enum_column);

$table_name = 'student';
$enum_column = 'gender';
$gender = $database->getEnumColumnType($table_name, $enum_column);

$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$last_name = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
echo htmlspecialchars($user_name) ;


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
           <div class="card-title mb-1 ">
                <h2>Apply for <?php echo htmlspecialchars($courseDetails['course_name']); ?></h2>
                <h5>It's a <?php echo htmlspecialchars($courseDetails['minimum_duration_years']) ?> year course. </h5>
                <p><?php echo htmlspecialchars($courseDetails['description']) ?>
             </p>
             <hr>
           </div>
           <form class="" action="process_applications.php" method="post" enctype="multipart/form-data">
            <h3>
                Personal Information
            </h3>
           
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
            <input type="hidden" name="action" value="apply">
            <div class="row g-3 mb-3">
                <div class="col-md-5">
                    <label for="validationDefault01" class="form-label"><strong>First name</strong><large class="text-danger"> *</large><small class="text-secondary"> (same as ID)</small> </label>
                    <input type="text" class="form-control" id="validationDefault01" value="<?php echo htmlspecialchars($user_name)  ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="validationDefault02" class="form-label"><strong>Middle name:</strong><small class="text-secondary">(optional)</small></label>
                    <input type="text" class="form-control" id="validationDefault02" >
                </div>
            </div>
           
            <div class="row g-3 mb-3">
                <div class="col-md-5 ">
                    <label for="last_name" class="form-label"><strong>Last name:</strong><large class="text-danger"> *</large> <small class="text-secondary"> (same as ID)</small></label>
                    <input type="text" class="form-control" id="last_name" value="<?php echo htmlspecialchars($last_name)  ?>" aria-describedby="inputGroupPrepend2" required>
                </div>
            </div>
            
            <div class="row g-3 mb-3">
                <div class="col-md-5 ">
                    <label for="marital_status" class="form-label"><strong>Marital status:</strong></label>
                    <select class="form-select" id="marital_status" required>
                    <option selected disabled value="">Choose...</option>
                    <?php foreach ($marital_status as $option) {
                    echo "<option>" . htmlspecialchars($option) . "</option>";
                    } ?>
                   
                    </select>
                </div>
                <div class="col-md-5 ">
                <label for="radio_group" class="form-label"><strong>Gender:</strong></label>
                    <div class="px-5" id="radio_group" role="group" aria-label="Basic radio toggle button group">
                        <?php foreach ($gender as $option) {
                            echo "<input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"" . htmlspecialchars($option) . "\" autocomplete=\"off\" >";
                            echo "<label class=\"btn btn-outline-success mx-1\" for=\"". htmlspecialchars($option) . "\">".  htmlspecialchars($option) . "</label>" ;
                            } ?>
                            
                        
                    </div>
                </div>
               
                    
                
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-5 ">
                    <label for="id" class="form-label"></label><strong>ID/Passport number:</strong><large class="text-danger"> *</large></label>
                    <input type="text" class="form-control" id="id" aria-describedby="inputGroupPrepend2" required>
                </div>
            </div>
            <hr>
            <h3>
                Contact Information
            </h3>
            <div class="row mb-4">
                <div class="col-md-6">
                <label for="tel" class="form-label"><strong>tel-phone:</strong></label>
               
                      <input type="number" class="form-control" id="tel" name="tel" placeholder="e.g 0812345678" aria-describedby="inputGroupPrepend" required="">
                      <div class="invalid-feedback">Please enter a valid email.</div>
                  
                </div>
                    
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                <label for="email" class="form-label"><strong>Email:</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email)  ?>" placeholder="e.g john.doe@example.com" aria-describedby="inputGroupPrepend" required="">
                      <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                </div>
                    
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-5">
                    <label for="validationDefault03" class="form-label"><strong>City:</strong></label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                </div>
                <div class="col-md-3">
                    <label for="validationDefault04" class="form-label"><strong>State:</strong></label>
                    <select class="form-select" id="validationDefault04" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Gauteng</option>
                    <option>Kwa-zulu Natal</option>
                    <option>Limpopo</option>
                    <option>Free-state</option>
                    <option>Mpumalanga</option>
                    <option>Western Cape</option>
                    <option>Northen Cape</option>
                    <option>North-West</option>
                    <option>Eastern Cape</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationDefault05" class="form-label"><strong>Zip:</strong></label>
                    <input type="text" class="form-control" id="validationDefault05" required>
                </div>
            </div>
            
            
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label for="document_type" class="form-label"><strong>Document Type:</strong></label>
                    <select class="form-select" id="document_type" name="document_type">
                        <option selected disabled value="">Choose...</option>
                        <?php foreach ($document_type as $option) {
                    echo "<option>" . htmlspecialchars($option) . "</option>";
                    } ?>
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="document" class="form-label"><strong>Upload Document:</strong></label>
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
                <button class="btn btn-success" type="submit">Submit Application</button>
            </div>
        </form>
            </div>
        </div>
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
