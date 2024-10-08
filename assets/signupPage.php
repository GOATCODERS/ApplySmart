<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Account</title>

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
      <div class= "d-flex justify-content-center bg-success" width="100" height="100" style="--bs-bg-opacity: 0.1;" >

        <div class="card m-5 px-2 border border-success" style="width: 41rem; height: auto;">
            <div class="card-body ">
                
                <div class="text-center mb-4">
                    <img src="assets/logo.png" data-bs-theme="dark" alt="Logo" width="60" height="80" class="d-inline-block align-text-top" style="margin-left: 10px; margin-right: 5px;">
                    <h3 class="card-title">Register a New Account</h3>
                </div>
                <hr class="mb-4 text-success">
                
                <form id="registrationForm" action="register.php" method="post" class="needs-validation was-validated" novalidate>
                  <div class="row mb-4">
                    <label for="first_name" class="form-label"><strong>First name</strong></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="e.g Mark" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter your first name.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="last_name" class="form-label"><strong>Last name</strong></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="e.g Otto" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter your last name.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="user_id" class="form-label"><strong>Student Number</strong></label>
                    <input type="number" class="form-control" id="user_id" name="user_id" placeholder="e.g 123456789" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter your student number.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" class="form-control" id="email" name="email" placeholder="e.g john.doe@example.com" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                  </div>

                  <div class="row mb-4">
                    <label for="password" class="form-label"><strong>New password</strong></label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">Too short. Password must be at least 8 characters long.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="confirm_password" class="form-label"><strong>Confirm password</strong></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <div class="invalid-feedback">Passwords do not match.</div>
                  </div>

                  <div class="row my-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="terms" required>
                      <label class="form-check-label" for="terms">
                        <a href="https://www.tut.ac.za/online-application-form" class="link-info">Agree to terms and conditions</a>
                      </label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>

                  <div class="d-flex my-5 justify-content-between w-50">
                    <button class="btn btn-success w-50" type="submit">Register</button>
                    <a class="btn btn-outline-success me-5" href="loginPage.php" role="button">Login</a>
                  </div>
                </form>

            </div>
          </div>
      </div>

      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const passwordField = document.getElementById('password');
              const confirmPasswordField = document.getElementById('confirm_password');
              const form = document.getElementById('registrationForm');

              // Function to validate passwords
              function validatePasswords() {
                  const password = passwordField.value;
                  const confirmPassword = confirmPasswordField.value;
                  
                  // Validate password length
                  if (password.length < 8) {
                      passwordField.classList.add('is-invalid');
                      passwordField.setCustomValidity('Password must be at least 8 characters long.');
                  } else {
                      passwordField.classList.remove('is-invalid');
                      passwordField.setCustomValidity('');
                  }
                  
                  // Validate password confirmation
                  if (password !== confirmPassword) {
                      confirmPasswordField.classList.add('is-invalid');
                      confirmPasswordField.setCustomValidity('Passwords do not match.');
                  } else {
                      confirmPasswordField.classList.remove('is-invalid');
                      confirmPasswordField.setCustomValidity('');
                  }
              }

              // Attach event listeners to both password fields
              passwordField.addEventListener('input', validatePasswords);
              confirmPasswordField.addEventListener('input', validatePasswords);

              // Handle form submission
              form.addEventListener('submit', function(event) {
                  validatePasswords(); // Validate passwords before submitting
                  
                  // If there are validation errors, prevent form submission
                  if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                  }
                  
                  form.classList.add('was-validated');
              });
          });
      </script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>