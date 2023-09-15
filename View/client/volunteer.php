<?php
session_start();
include_once "../client/top_codr.php";

require_once "../../Controller/volunteerConroller.php";
require_once "../../Model/volunteer.php";

$msg = "";
$_SESSION["regestration"] = 0;
if (isset($_POST["phone"]) && isset($_POST["address"]) && isset($_POST["message"])) {
  if (!empty($_POST["phone"]) && !empty($_POST["address"]) && !empty($_POST["message"])) {
    $volunteer = new volunteerController();
    if (!$volunteer->checkValidate($_SESSION["userId"])) {
      $vol_id = $volunteer->beVolunteer(1, $_SESSION["userId"]);
      if ($volunteer->regesterInEvent((int)$_GET["event_id"], $vol_id, $_POST["phone"], $_POST["address"], $_POST["message"])) {
        $msg = "Registerd successfullly";
        $_SESSION["regestration"] = 1;
        header("Location: event.php");
      }
    } else {
      $no_of_event = $volunteer->getNoOfEvents($_SESSION["userId"])[0]["no_of_event"];
      $result = $volunteer->updateVolunteer($no_of_event + 1, $_SESSION["userId"]);
      $vol_id = $volunteer->getVolId($_SESSION["userId"])[0]["id"];
      if ($volunteer->regesterInEvent((int)$_GET["event_id"], $vol_id, $_POST["phone"], $_POST["address"], $_POST["message"])) {
        $msg = "Registerd successfullly";
        $_SESSION["regestration"] = 1;
        header("Location: event.php");
      }
    }
  }
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


  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">




  <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
  <link href="css/search.css" rel="stylesheet">



</head>

<body>

  <?php
  include_once "../client/header.php"
  ?>

  <!-- END nav -->

  <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span>volunteer</span></p>
          <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Volunteer</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section-3 img" style="background-image: url(images/bg_3.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row d-md-flex">
        <div class="col-md-6 d-flex ftco-animate">
          <div class="img img-2 align-self-stretch" style="background-image: url(images/bg_4.jpg);"></div>
        </div>
        <div class="col-md-6 volunteer pl-md-5 ftco-animate">
          <h3 class="mb-3">Be a volunteer</h3>

          <?php
          if ($_SESSION["regestration"] == 1) {
          ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle me-1"></i>
              <?php echo $msg; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php
          }




          ?>





          <form action="#" class="volunter-form" method="post">
            <div class="form-group">
              <input type="tel" name="phone" class="form-control" placeholder="Your phone">
            </div>
            <div class="form-group">
              <input type="text" name="address" class="form-control" placeholder="Your address">
            </div>
            <div class="form-group">
              <textarea name="message" id="" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-white py-3 px-5">
            </div>
          </form>
        </div>
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


  <script src="style_form/js/main.js"></script>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>