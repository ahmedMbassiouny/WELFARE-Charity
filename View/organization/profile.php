<?php

  //includes
  require_once "../../Controller/orgController.php";
  require_once '../../Model/organization.php';
  require_once '../../Model/user.php';
  // require_once '../../Controller/DBController.php';


  //dont enter untill login
  session_start();
  if (!isset($_SESSION["userId"])) {
    header("location:../auth/login.php ");
  } else {
      if ($_SESSION["userRole"] != 3) {
        header("location:../auth/login.php ");
      }
  }


  //make object
  $orgCon = new orgcontroller;
  $organization = new organzation;
  $user = new user;


  //open session if not opened
  if(!isset($_SESSION["userId"])){
    session_start();
  }
  $organization->set_user_id($_SESSION['userId']);



  //global variable
  $errMsg = "";
  $deleteMsg = false;
  $addMsg = false;
  $countEmp = 0;
  $updPass = false;
  $updMsg = "";



  //coding
  $info = $orgCon->get_data_org($organization->get_user_id());       // get all organization information
  $user->set_name($info[0]['name']);
  $user->set_email($info[0]['email']);
  $user->set_id($info[0]['user_id']);
  $user->set_password($info[0]['password']);
  $user->set_image($info[0]['img_url']);
  $organization->set_account_num($info[0]['account_no']);
  $organization->set_address($info[0]['address']);
  $organization->set_id($info[0]['id']);


  // change profile info
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['fullName'])) {
      $query = "UPDATE user SET name = '{$_POST['fullName']}'  where id = {$organization->get_user_id()}";
      if($orgCon->update_info($query)) {
        $user->set_name($_POST['fullName']);
        header("location: profile.php");
        $addMsg = true;
      }
    } else {
      $countEmp++;
    }

    if(!empty($_POST['email'])) {
      if($orgCon->check_email($_POST["email"])) {
        $query = "UPDATE user SET email = '{$_POST['email']}' where id = {$organization->get_user_id()}";
        if($orgCon->update_info($query)) {
          $user->set_email($_POST['email']);
          // header("location: profile.php");
          $addMsg = true;
        }
      } else {
        $errMsg = "Please enter another EMAIL";
      }
    } else {
      $countEmp++;
    }

    if(!empty($_POST['address'])) { 
      $query = "UPDATE organization SET address = '{$_POST['address']}'  where user_id = {$organization->get_user_id()}";
      if($orgCon->update_info($query)) {
        $organization->set_address($_POST['address']);
        // header("location: profile.php");
        $addMsg = true;
      }
    } else {
      $countEmp++;
    }

    if(!empty($_POST['accountNumber'])) {
      $query = "UPDATE organization SET account_no = '{$_POST['accountNumber']}'  where user_id = {$organization->get_user_id()}";
      if($orgCon->update_info($query)) {
        $organization->set_account_num($_POST['accountNumber']);
        // header("location: profile.php");
        $addMsg = true;
      }
    } else {
      $countEmp++;
    }

    if(!empty($_FILES["image"])) {
      $location = "../images/".date("h-i-s").$_FILES["image"]["name"];
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
          if($orgCon->update_photo_org($location, $_SESSION["userId"])) {
            $user->set_image($location);
            // header("location: profile.php");
            $addMsg = true;
          }
      }
      else {
        $countEmp++;
      }
    }

  }


  // delete img org
  if(isset($_POST["delete"])) {
    if (!empty($_POST["userId"])) {
      if ($orgCon->delete_org_photo($_POST["userId"])) {
        header('refresh: 3');
        $user->set_image( $orgCon->get_photo_org($organization->get_user_id()));
        $deleteMsg = true;
        $countEmp = 0;
        // header("location: profile.php");
      }
    }
  }


  // chnage password
  if (isset($_post['btnPassword'])) {
    if (!empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {

      // Get form data
      $old_password = $_POST['oldPassword'];
      $new_password = $_POST['newPassword'];
      $confirm_password = $_POST['confirmPassword'];

      if ($old_password === $user->get_password()) {
        if ($new_password === $confirm_password) {
          if($orgCon->update_password($user->get_id(), $new_password)) {
            $user->set_password($new_password);
            $updPass = true;
          }
          else {
            $updMsg = "Somthing went wrong... try again later";
          }
        } else {
          $updMsg = "New password and confirm password do not match.";
        }
      } else {
        $updMsg = "Incorrect old password.";
      }
    } else {
      $updMsg = "Please fill all data";
    }
  }

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- head code -->
    <?php include_once "../organization/head-code.php" ?>
  </head>

  <body>

    <!-- ======= Header ======= -->
    <?php include_once "../organization/header.php" ?>
    <!-- End Header -->

    <!-- ======= main ======= -->
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Profile Page</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <?php
        if ($updMsg != "") {
      ?>
        <div class="alert alert-danger" style="text-align: center;" role="alert"><?php echo $updMsg;?></div>
      <?php
        }
      ?>

      <?php
        if ($errMsg != "") {
      ?>
        <div class="alert alert-danger" style="text-align: center;" role="alert"><?php echo $errMsg;?></div>
      <?php
        }
      ?>

      <?php
        if ($countEmp == 5) {
      ?>
        <div class="alert alert-danger" style="text-align: center;" role="alert"><?php echo "fill any data";?></div>
      <?php
        }
      ?>


      <section class="section profile">
        <div class="row">

          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="<?php echo $user->get_image()?>" alt="Profile" class="rounded-circle">
                <h2><?php echo $user->get_name();?></h2>
                <h3><?php echo $user->get_email();?></h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3">

                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>

                </ul>

                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">

                    <h5 class="card-title">About</h5>
                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Full Name</div>
                      <div class="col-lg-9 col-md-8"><?php echo $user->get_name(); ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8"><?php echo $user->get_email(); ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Address</div>
                      <div class="col-lg-9 col-md-8"><?php echo $organization->get_address() ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Account Number</div>
                      <div class="col-lg-9 col-md-8"><?php echo $organization->get_account_num(); ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">ID</div>
                      <div class="col-lg-9 col-md-8"><?php echo $organization->get_id(); ?></div>
                    </div>

                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <!-- Profile Edit Form -->
                    <form action="profile.php" method="post" enctype='multipart/form-data'>

                      <div class="row mb-3">

                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                          <img src="<?php echo $user->get_image()?>" alt="Profile">
                            <div class="pt-2">
                              <input class="form-control" type="file" id="formFile" name="image" style="display:inline; width:50%">
                              <button type="submit" name="delete" class="btn btn-danger">
                                <span class="tf-icons bx bx-trash"></span>
                              </button>
                              <input type="hidden" name="userId" value="<?php echo $organization->get_user_id(); ?>">
                            </div>
                        </div>

                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fullName" type="text" class="form-control" id="fullName" placeholder="<?php echo $user->get_name(); ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo $user->get_email(); ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Addrerss</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="address" type="text" class="form-control" id="address" placeholder="<?php echo $organization->get_address(); ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="accountNumber" class="col-md-4 col-lg-3 col-form-label">Account Number</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="accountNumber" type="text" class="form-control" id="accountNumber" placeholder="<?php echo $organization->get_account_num(); ?>">
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>

                    </form>
                    <!-- End Profile Edit Form -->
                  </div>
                  
                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form action="profile.php" method="post" enctype='multipart/form-data'>

                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="oldPassword" type="password" class="form-control" id="currentPassword"  minlength="10" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="newPassword" type="password" class="form-control" id="newPassword"  minlength="10" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="confirmPassword" type="password" class="form-control" id="renewPassword"  minlength="10" required>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" name="btnPasswprd" class="btn btn-primary">Change Password</button>
                      </div>

                    </form>
                    <!-- End Change Password Form -->
                  </div>

                </div>
                <!-- End Bordered Tabs -->
              </div>
            </div>
          </div>

          <?php
            if ($deleteMsg == true) {
          ?>
            <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
              <div class="toast-header">
                <i class="bx bx-trash me-2"></i>
                <div class="me-auto fw-semibold">Deleted Photo Succesfully</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>
          <?php
            }
            if ($addMsg == true) {
          ?>
            <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
              <div class="toast-header">
                <i class="bx bx-trash me-2"></i>
                <div class="me-auto fw-semibold">Update data Succesfully</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>
          <?php
            }
            if($updPass) {
          ?>
            <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
              <div class="toast-header">
                <i class="bx bx-trash me-2"></i>
                <div class="me-auto fw-semibold">Update Password Succesfully</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>
          <?php
            }
          ?>
        </div>

      </section>

    </main>
    <!-- End main -->

    <!-- ======= Footer ======= -->
    <?php include_once "../organization/footer.php" ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include_once "../organization/js-links.php" ?>

  </body>

</html>