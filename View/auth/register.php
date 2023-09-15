<?php

  // requires
  require_once "../../Model/user.php";
  require_once "../../Controller/Authcontroller.php";

  // make object
  $auth = new Authcontroller;
  $user = new user;


  // global variable
  $errMsg="";
  $adduser=false;



  // coding
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
      if($auth->check_email($_POST["email"])) {
        $user->set_name($_POST["name"]);
        $user->set_email($_POST["email"]);
        $user->set_password($_POST["password"]);

        $auth = new Authcontroller;
        if($auth->register($user)) {
          $adduser = true;
          header("Location: ../auth/login.php");
        }
        else {
          $errMsg = "Somthing went wrong... try again later";
        }
      }
      else {
        $errMsg = "Please enter another EMAIL";
      }
    }
    else {
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
    <!-- End head-code -->
    <title>Register User</title>

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

                <?php
                  if($adduser) {
                ?>
                  <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                      <i class="bx bx-trash me-2"></i>
                      <div class="me-auto fw-semibold">Add Succesfully</div>
                      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>
                <?php
                  }
                ?>

                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                      <p class="text-center small">Enter your personal details to create account</p>
                    </div>

                    <?php 
                      if($errMsg!="") {
                    ?>
                      <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                    <?php
                      }
                    ?>

                    <form class="row g-3 needs-validation" action="register.php" method="POST" novalidate>

                      <div class="col-12">
                        <label for="yourName" class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" id="yourName" required>
                        <div class="invalid-feedback">Please, enter your name!</div>
                      </div>

                      <div class="col-12">
                        <label for="Email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="email" name="email" class="form-control" id="Email" required>
                          <div class="invalid-feedback">Please choose a Email.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" minlength="10" required>
                        <div class="invalid-feedback">Please enter your password! and must be at least 10 characters</div>
                      </div>

                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                          <label class="form-check-label" for="acceptTerms">I agree and accept the terms and conditions</label>
                          <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                      </div>

                      <div class="col-12">
                        <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                      </div>

                    </form>
                    
                    <div class="col-12 ">
                      <p class="small mb-0">Register as <a href="org_register.php">Organisation</a>.</p>
                    </div>

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
    </main>
    <!-- End #main -->


    <!-- ======= js-links ======= -->
    <?php
    include_once "../admin/js-links.php"
    ?>
    <!-- end  js-links  -->

  </body>

</html>