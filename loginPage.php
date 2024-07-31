<?php
// Include the User class and establish database connection
require_once 'Student.php';
require_once 'base_connector.php'; // Assume this file creates a $db PDO instance

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password'];
    
    $database = new Database();
    $db = $database->getConnection();

    // Attempt to login
    $loginSuccess = User::login($username, $password, $db);

    // If login fails, redirect with an error message
    if (!$loginSuccess) {
        $error= "Invalid email or password";;
    } else {
      header('Location: Prostectus.php');
  
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

      <?php
        include 'navBar.php';

      ?>
      <div class= "d-flex h-100 justify-content-center bg-success pt-5" width="100" height="100" style="--bs-bg-opacity: 0.1;" >

        <div class="card m-5 border border-success" style="width: 42rem; height: 27rem;">
            <div class="card-body mx-5">
                
                <div class="text-center mb-4">
                    <img src="assets/logo.png" data-bs-theme="dark" alt="Logo" width="60" height="80" class="d-inline-block align-text-top" style="margin-left: 10px; margin-right: 5px;">
                  <h3 class="card-title">Login to Apply Smart</h3>
                </div>
                <hr class="mb-4 text-success">
                <form method="post" action="" class="needs-validation" novalidate>
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="valid-feedback">
                          Looks good!
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

                    <button type="submit" class="btn btn-outline-success w-25">Sign in</button>
                    <p>Don't </p><a href="signupPage.php"></a>
                  </form>
            </div>
          </div>
      </div>

      

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>