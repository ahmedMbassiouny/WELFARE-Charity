<?php

// requires
require_once "../../Model/user.php";
require_once "../../Controller/Authcontroller.php";


// logOut
if (isset($_GET["logout"])) {
  session_start();
  session_unset();
  $_SESSION = array();
  session_destroy();
}


// make object
$auth = new Authcontroller;
$user = new user;


// global variable
$errMsg = "";


// coding
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    // $user->set_name($_POST["name"]);
    $user->set_email($_POST["email"]);
    $user->set_password($_POST["password"]);

    $auth = new Authcontroller;
    if ($auth->login($user)) {
      if (!isset($_SESSION["userId"])) {
        session_start();
      }
      if ($_SESSION["userRole"] == 1) {
        header("location: ../admin/index.php");
      } else if ($_SESSION["userRole"] == 2) {
        header("location: ../client/index.php");
      } else if ($_SESSION["userRole"] == 3) {
        header("location: ../organization/index.php");
      }
    } else {
      $errMsg = "You have entered wrong email or password";
    }
  } else {
    $errMsg = "Please fill all fields";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ======= head-code ======= -->
  <?php
  include_once "../admin/head-code.php"
  ?>
  <!-- head-code -->
  <title>Login</title>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="../admin/index.php" class="logo d-flex align-items-center w-auto">
                  <img src="../admin/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div>
              <!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <?php
                  if ($errMsg != "") {
                  ?>
                    <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                  <?php
                  }
                  ?>

                  <form method="post" action="login.php" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="Email" required>
                        <div class="invalid-feedback">Please enter your Email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password! and must be at least 10 characters</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100 mt-2" type="submit">Login</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Don't have account?
                        <a href="register.php">Create an account (USER)</a>
                        <br>
                        <a href="org_register.php">Create an account (ORGANIZATION)</a>
                      </p>
                    </div>

                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="../../View/client/">WELFARE</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->


  <!-- ======= js-links ======= -->
  <?php
  include_once "../admin/js-links.php"
  ?>
  <!-- end  js-links  -->

</body>

</html>