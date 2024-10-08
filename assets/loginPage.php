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
        $error= "Invalid email or password";
      echo "passed here";
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
    <nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark" >
        <!-- Navbar content -->
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
              <img src="assets/logo.png" alt="Logo" width="30" height="40" class="d-inline-block align-text-top" style="margin-left: 10px; margin-right: 5px;">
              ApplySmart
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Prospectus.html">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">About us</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      More options
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="loginPage.php">Login</a></li>
                      <li><a class="dropdown-item" href="signupPage.php">Register</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="index.html">Log out</a></li>
                    </ul>
                  </li>
                </ul>
                <form class="d-flex mt-2" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
              </div>
          </div>
      </nav>

      <div class= "d-flex h-100 justify-content-center bg-success" width="100" height="100" style="--bs-bg-opacity: 0.1;" >

        <div class="card m-5 border border-success" style="width: 40rem; height: 27rem;">
            <div class="card-body">
                
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

                    <button type="submit" class="btn btn-outline-success w-25">Sign in</button>
                    <?php if (isset($error)) echo "<strong class=\"mx-5\" style='color:red;'>$error</strong>"; ?>
                  </form>
            </div>
          </div>
      </div>

      

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>