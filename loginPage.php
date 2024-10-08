<?php
session_start(); // Ensure session is started

require_once 'base_connector.php'; // Assume this file creates a $db PDO instance
require_once 'models/Student.php'; // Include the User class

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $database = new Database();
    $db = $database->getConnection();

    // Attempt to login
    $loginSuccess = User::login($email, $password, $db);

    // If login fails, show an error message
    if (!$loginSuccess) {
        $error = "Invalid email or password";
    } else {
        // Redirect to the course list or the desired page
        header('Location: course_list.php');
        exit(); // Ensure no further code is executed after redirection
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

      
      <div class= "d-flex justify-content-center align-items-start row px-2 h-100" width="100" height="100"  style="background-image: url('assets/background9.jpg'); background-position: bottom; background-size: cover;" >
      <?php
        include 'navBar.php';

      ?>
          <div class="card m-5 bg-success" style="width: 42rem; height: 27rem; --bs-bg-opacity: 0.1;">
              <div class="card-body mx-5" style="--bs-bg-opacity: 0.1;">
                  
                  <div class="text-center mb-4">
                      <img src="assets/logo.png" data-bs-theme="dark" alt="Logo" width="60" height="80" class="d-inline-block align-text-top" style="margin-left: 10px; margin-right: 5px;">
                    <h3 class="card-title">Login to Apply Smart</h3>
                  </div>
                  <hr class="mb-4 text-success">
                  <form method="post" action="" class="needs-validation was-validated" novalidate>
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10 has-validation">
                          <input type="email" class="form-control" id="email" name="email" required>
                          <div class="invalid-feedback">
                            Please enter a valid email.
                          </div>
                        </div>
                        
                      </div>
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" id="inputPassword3" required>
                          
                        </div>
                      </div>
                      <div class="row mb-3 text-center">

                      <?php if (isset($error)) echo "<strong style='color:red;'>$error</strong>"; ?>
                      </div>
                      <div class="row mb-3 align-bottom">
                          <button type="submit" class="btn btn-success w-25">Sign in</button>
                          <div class="col-sm-8 align-middle">
                          <p class="d-flex align-items-center h-100">Don't have an account? <a class="link-info link-offset-2 link-opacity-25-hover ms-2" href="signupPage.php"> Sign Up</a></p>
                          </div>
                    
                      
                    </form>
              </div>
            </div>
          <div class="h-100" height="100"> </div>
      </div>

      

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>