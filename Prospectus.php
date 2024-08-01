<?php
require_once 'base_connector.php'; // Assume this file creates a $db PDO instance
require_once 'JobDescription.php'; // Assume this file creates a $db PDO instance

// Database connection
$database = new Database();
$db = $database->getConnection();



// Check if job_id is provided in the URL
$jobId = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

$jobId = 2;
if ($jobId) {
    // Create JobDescription instance
    $job = new JobDescription($jobId, $db);
} else {
    die('Invalid Job ID');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prospectus</title>
    <link rel="stylesheet" href="Prospectus.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        hr {
            border: 0;
            height: 3px;
            background: #fff;
            margin: 20px 0;
        }
        .scrollable-panel {
            max-height: 850px;
            overflow-y: auto;
            border: 1px solid #155100;
            padding: 15px;
        }
        .carousel-inner img {
            max-height: 700px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="h-100 bg-success row" style="background-image: url('assets/background9.jpg'); background-position: center left; background-size: cover;">
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

    <div class="d-flex justify-content-center" style="--bs-bg-opacity: 0.1;">
        <h2 class="w-50 m-3">Job Description</h2>
    </div>

    <hr>

    <div class="row m-3">
        <div class="col-4 scrollable-panel">
            <div class="list-group list-group-item-success" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo htmlspecialchars($job->getJobTitle()); ?></h5>
                        <small>Updated recently</small>
                    </div>
                    <p class="mb-1"><?php echo htmlspecialchars($job->getCompany()); ?></p>
                    <small><?php echo htmlspecialchars($job->getLocation()); ?>. Closing date: <?php echo htmlspecialchars($job->getClosingDate()); ?>.</small>
                </a>
            </div>
        </div>
        <div class="col-8 scrollable-panel">
        <?php
                include 'JobDescriptionProcessor.php';
        ?>
        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
