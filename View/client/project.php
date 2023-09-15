<?php
session_start();
  include_once "../client/top_codr.php";

require_once "../../Controller/projectController.php";
require_once "../../Model/project.php";

$msg = "";
$project = new projectController();
$proj = new project();

$projects = $project->viewProjects();

if ($projects) {
  $_SESSION["project"] = 0;
} else {
  $msg = "there is no projetcs yet......";
  $_SESSION["project"] = 1;
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
  <title>Welfare - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,400i,600,700" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">



</head>

<body>

  <!-- END nav -->

  <?php
  include_once "../client/header.php"
  ?>


  <div class="hero-wrap" style="background-image: url('images/bg_6.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Donate</span></p>
          <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Donations</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row">

        <?php

        if ($_SESSION["project"] == 0) {

          foreach ($projects as $proj) {
        ?>
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry align-self-stretch" style="width:500px;height: 500px;">
                <a href="blog-single.html" class="block-20" style="background-image: url('images/event-1.jpg');">
                </a>
                <div class="text p-4 d-block">
                  <h3 class="heading mb-4"><a href="#"><?php echo $proj["proj_name"] ?></a></h3>
                  <p><span class="mr-2">Target amount : <?php echo $proj["target_amount"] ?></span></p>
                  <p><?php echo $proj["description"] ?></p>
                  <p><a href="Donationform.php?project_id=<?php echo $proj["proj_id"] ?>&org_id=<?php echo $proj["org_id"] ?> ">Donate now <i class="ion-ios-arrow-forward"></i></a></p>
                </div>
              </div>
            </div>

          <?php
          }
        } else {
          ?>
          <div class="alert alert-secondary bg-secondary text-light border-0 alert-dismissible fade show" role="alert" style="width:50%; margin:auto; padding:10px; text-align:center;">
            <?php echo $msg; ?>
          </div>
        <?php
        }


        ?>





      </div>
    </div>
  </section>

  <?php
  include_once "../client/footer.php"
  ?>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>

</html>