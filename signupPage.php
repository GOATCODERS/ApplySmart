<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
       
      <div class="d-flex justify-content-center bg-success row px-2" width="100" height="100" style="background-image: url('assets/background9.jpg'); background-position: top right; background-size: fill;">
      <?php
        include 'navBar.php';

      ?>
        <div class="card m-5 px-2 bg-success" style="--bs-bg-opacity: 0.1;width: 44rem; height: auto;">
            <div class="card-body mx-5">
                
                <div class="text-center mb-4">
                    <img src="assets/logo.png" data-bs-theme="dark" alt="Logo" width="60" height="80" class="d-inline-block align-text-top" style="margin-left: 10px; margin-right: 5px;">
                    <h3 class="card-title">Register a New Account</h3>
                </div>
                <hr class="mb-4 text-success">
                
                <form id="registrationForm" action="register.php" method="post" class="needs-validation was-validated" novalidate="">
                  <div class="row mb-4">
                    <label for="first_name" class="form-label"><strong>First name</strong></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="e.g Mark" required="">
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter your first name.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="last_name" class="form-label"><strong>Last name</strong></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="e.g Otto" required="">
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter your last name.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="user_id" class="form-label"><strong>Student Number</strong></label>
                    <select id="user_type" class="form-control" name="user_type" required>
                        <option value="prospective_student">Prospective Student</option>
                        <option value="current_student">Current Student</option>
                        <option value="admin">Admin</option>
                        <option value="faculty">Faculty</option>
                    </select>
                    
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter your student number.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" class="form-control" id="email" name="email" placeholder="e.g john.doe@example.com" aria-describedby="inputGroupPrepend" required="">
                      <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                  </div>

                  <div class="row mb-4">
                    <label for="password" class="form-label"><strong>New password</strong></label>
                    <input type="password" class="form-control is-invalid" id="password" name="password" required="">
                    <div class="invalid-feedback">Too short. Password must be at least 8 characters long.</div>
                  </div>

                  <div class="row mb-4">
                    <label for="confirm_password" class="form-label"><strong>Confirm password</strong></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required="">
                    <div class="invalid-feedback">Passwords do not match.</div>
                  </div>

                  <div class="row my-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="terms" required="">
                      <label class="form-check-label" for="terms">
                        <a href="https://www.tut.ac.za/online-application-form" class="link-info">Agree to terms and conditions</a>
                      </label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>

                  <div class="row my-3 w-75 align-bottom">
                    <button class="btn btn-success w-25" type="submit">Register</button>
    <div class="col-sm-8 align-middle">
                    <p class="d-flex align-items-center h-100">Already have an account? <a class="link-info link-offset-2 link-opacity-25-hover ms-2" href="loginPage.php" role="button">Login</a>
                  </p></div></div>
                </form>

            </div>
          </div>


          <div class="h-25" height="10"></div>
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