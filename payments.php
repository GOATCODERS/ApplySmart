<?php
require_once 'base_connector.php'; // Ensure this file contains the Database class

// Database connection
$database = new Database();
$db = $database->getConnection();

// Check if application_id is provided
$application_id = isset($_GET['application_id']) ? intval($_GET['application_id']) : 0;

// Retrieve application details to validate
$stmt = $db->prepare("SELECT * FROM applications WHERE application_id = ?");
$stmt->execute([$application_id]);
$applicationDetails = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$applicationDetails) {
    die('Application not found.');
}

$course_id = $applicationDetails['course_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment for Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <?php include 'navBar.php'; ?>

    <div class="container mt-5">
        <h2>Payment for Application</h2>
        <form action="process_payment.php" method="post">
            <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($application_id); ?>">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">

            <div class="mb-3">
                <label for="amount" class="form-label">Payment Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" required>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method">
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <!-- Add more payment methods if needed -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
