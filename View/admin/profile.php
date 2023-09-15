<?php
session_start();
include_once "../admin/top_code.php";

?>


<!DOCTYPE html>
<html lang="en">


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
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

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

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin->get_name(); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">WELFARE</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">admin</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin->get_email(); ?></div>
                  </div>

                </div>

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