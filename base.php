<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApplySmart</title>
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
                  <li><a class="dropdown-item" href="loginPage.html">Login</a></li>
                  <li><a class="dropdown-item" href="signupPage.html">Register</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Log out</a></li>
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
  <?php
    include 'Prospectus.html';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
