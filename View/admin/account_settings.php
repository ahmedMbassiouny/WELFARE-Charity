<?php
session_start();
    include_once "../admin/top_code.php";

    $errorMsg = "";
    $succesMsg = "";
    $emailError = "";
    $nameError = "";
    if (isset($_POST['change_password'])) {
      if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {

        // Get form data
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if old password is correct

        if ($old_password === $admin->get_password()) {

          // Check if new password and confirm password match
          if ($new_password === $confirm_password) {

            // Hash new password
            // $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password in database
            $adminCN->editPassword($admin->get_id(), $new_password);

            // // Redirect to dashboard
            // header('Location: ../admin');
            // exit();
            $admin->set_password($new_password);
            $succesMsg .= "The password has been renewed successfully";
          } else {
            $errorMsg .= "New password and confirm password do not match.";
          }
        } else {
          $errorMsg .= "Incorrect old password.";
        }
      } else {
        $errorMsg .= "Please fill all data";
      }
    }
    if (isset($_POST['edit_profile'])) {

      // Validate name
      if (empty($_POST['name'])) {
        $nameError = "Name is required";
      } else {
        $admin->set_name($_POST['name']);
      }

      // Validate email
      if (empty($_POST['email'])) {
        $emailError = "Email is required";
      } elseif(!$adminCN->check_email($_POST['email']) && $_POST['email']!== $admin->get_email()) {
        $emailError = "this email is used";
        $errorMsg .= $emailError;
      }else{
        $admin->set_email($_POST['email']);
      }

      // Upload image 
      if ($_FILES['image']['name']) {
        $target_dir = "../images/" . date("h-i-s");
        $file = $_FILES['image']['name'];
        $path = $target_dir . $file;

        if (!is_uploaded_file($_FILES["image"]["tmp_name"])) {
          echo "Error: File was not uploaded.";
          exit();
        }


        // Attempt to move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
          echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
        } else {
          echo "Error: Failed to move uploaded file.";
        }
        $admin->set_image($path);
      }

      if (empty($nameError) && empty($emailError)) {
        if($adminCN->editAdminData($admin)){
          $succesMsg .= "data is updated successfully";
          $data = $adminCN->getAdminData($admin->get_id());
        }else{
          $errorMsg = "Error: Failed to move uploaded file.";
        }
      } else {
        // $errorMsg+ .= $emailError ." ". $nameError;
      }
    }

    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

      <head>
        <!-- ======= head-code ======= -->
        <?php
        include_once "../admin/head-code.php"
        ?>
        <!-- head-code -->
      </head>

    <body>


      <!-- ======= Header & siSidebar ======= -->
      <?php
      include_once "../admin/header.php"
      ?>
      <!-- End Header -->


      <main id="main" class="main">

        <div class="pagetitle">
          <h1>Profile</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Account Settings</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->
        <?php
        if (!empty($errorMsg)) {
        ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $errorMsg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        } ?>
        <?php
        if (!empty($succesMsg)) {
        ?>
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?php echo $succesMsg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        } ?>
        <section class="section profile">
          <div class="row">
            <div class="col-xl-4">

              <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                  <img src="<?php echo $admin->get_image(); ?>" alt="Profile" class="rounded-circle">
                  <h2><?php echo $admin->get_name(); ?></h2>
                  <h3>Admin</h3>
                </div>
              </div>

            </div>

            <div class=" mt-2 col-xl-8">

              <div class="card">
                <div class="card-body pt-3">
                  <!-- Bordered Tabs -->
                  <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>

                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>

                  </ul>
                  <div class="tab-content pt-2">
                    <div class="active tab-pane fade show profile-edit pt-3" id="profile-edit">

                      <!-- Profile Edit Form -->
                      <form action="account_settings.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                          <div class="col-md-8 col-lg-9">
                            <img src="<?php echo $admin->get_image();?>" alt="Profile">
                            <br>
                            <br>
                            <input type="file" name="image">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $admin->get_name(); ?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="company" type="text" class="form-control" id="company" value="WELFARE" readonly>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="Job" class="col-md-4 col-lg-3 col-form-label readonly">Job</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="job" type="text" class="form-control" id="Job" value="Admin" readonly>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="Email" value="<?php echo $admin->get_email(); ?>">
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" name="edit_profile" class="btn btn-primary">Save Changes</button>
                        </div>
                      </form><!-- End Profile Edit Form -->

                    </div>



                    <div class="tab-pane fade pt-3" id="profile-change-password">

                      <!-- Change Password Form -->
                      <form method="POST">
                        <div class="row mb-3">
                          <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="old_password" type="password" class="form-control" id="old_password">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="new_password" type="password" class="form-control" id="new_password">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                        </div>
                      </form><!-- End Change Password Form -->
                    </div>

                  </div><!-- End Bordered Tabs -->

                </div>
              </div>

            </div>
          </div>
        </section>

      </main><!-- End #main -->


      <!-- ======= Footer ======= -->
      <?php
      include_once "../admin/footer.php"
      ?>
      <!-- end Footer  -->


      <!-- ======= js-links ======= -->
      <?php
      include_once "../admin/js-links.php"
      ?>
      <!-- end  js-links  -->

    </body>

    </html>