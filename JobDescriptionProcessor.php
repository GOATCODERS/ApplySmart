<?php
require_once 'base_connector.php'; // Assume this file creates a $db PDO instance
require_once 'JobDescription.php'; // Assume this file defines JobDescription class

// Database connection
$database = new Database();
$db = $database->getConnection();

try {
    $sql = "SELECT * FROM job_description ORDER BY closing_date ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($jobs as $job) {
        // Make sure to escape special characters in job details
        $jobTitle = htmlspecialchars($job['Job_Title']);
        $company = htmlspecialchars($job['Company']);
        $location = htmlspecialchars($job['Location']);
        $type = htmlspecialchars($job['Type']);
        $aboutUs = htmlspecialchars($job['About_Us']);
        $roleDescription = htmlspecialchars($job['Role_Description']);
        $responsibilities = htmlspecialchars($job['Responsibilities']);
        $requirements = htmlspecialchars($job['Requirements']);
        $weOffer = htmlspecialchars($job['We_Offer']);
        
        echo '
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="row align-items-center">
                        <a href="https://www.tut.ac.za/online-application-form" class="link-info link-offset-2 link-opacity-25-hover"><h3>' . $jobTitle . '</h3></a>
                        <div class="col-sm-8 text-center">
                            <button type="button" class="btn btn-info text-light my-3">Apply</button>
                            <button type="button" class="btn btn-outline-info my-3">Save Job</button>
                        </div>
                    </div>
                    <hr>
                    <strong class="mb-3">Job description</strong>
                    <br><br>
                    <strong>Job Title:</strong><p>' . $jobTitle . '</p>
                    <strong>Company:</strong><p>' . $company . '</p>
                    <strong>Location:</strong><p>' . $location . '</p>
                    <strong>Type:</strong><p>' . $type . '</p>
                    <strong>About Us:</strong><p>' . $aboutUs . '</p>
                    <strong>Role Description:</strong><p>' . $roleDescription . '</p>
                    <strong>Responsibilities:</strong>
                    <ul>';
                    $responsibilitiesArray = explode(',', $responsibilities);
                    foreach ($responsibilitiesArray as $responsibility) {
                        echo '<li>' . htmlspecialchars(trim($responsibility)) . '</li>';
                    }
        echo '</ul>
                    <strong>Requirements:</strong>
                    <ul>';
                    $requirementsArray = explode(',', $requirements);
                    foreach ($requirementsArray as $requirement) {
                        echo '<li>' . htmlspecialchars(trim($requirement)) . '</li>';
                    }
        echo '</ul>
                    <strong>We Offer:</strong>
                    <p>' . $weOffer . '</p>
                    <button type="button" class="btn btn-success">Apply</button>
                </div>
            </div>';
    }
} catch (PDOException $e) {
    error_log('Database query error: ' . $e->getMessage(), 3, '/var/log/app_errors.log');
    echo '<p>Unable to fetch job listings. Please try again later.</p>';
}
?>
