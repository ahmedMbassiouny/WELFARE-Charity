<?php
session_start();
include_once "../client/top_codr.php";


require_once "../../Controller/orgController.php";
require_once '../../Model/donor.php';
require_once "../../Controller/adminController.php";
$adminCN = new adminController();
$num_of_donations = $adminCN->getDonationNum();

$orgCon = new orgcontroller;
$donor = new donor;

$infos = $orgCon->get_top_donor();

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

  <?php
  include_once "../client/header.php"
  ?>

  <div class="hero-wrap" style="background-image: url('images/bg_7.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Doing Nothing is Not An Option of Our Life</h1>

          <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="https://vimeo.com/45830194" class="btn btn-white btn-outline-white px-4 py-3 popup-vimeo"><span class="icon-play mr-2"></span>Watch Video</a></p>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-counter ftco-intro" id="section-counter">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-5 d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18 color-1 align-items-stretch">
            <div class="text">
              <span>Donations </span>
              <strong class="number" data-number="<?php echo $num_of_donations[0]["count"]; ?>">0</strong>
              <span>Children in 190 countries in the world</span>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18 color-2 align-items-stretch">
            <div class="text">
              <h3 class="mb-4">Donate Money</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts.</p>
              <p><a href="project.php" class="btn btn-white px-3 py-2 mt-2">Donate Now</a></p>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18 color-3 align-items-stretch">
            <div class="text">
              <h3 class="mb-4">Be a Volunteer</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts.</p>
              <p><a href="event.php" class="btn btn-white px-3 py-2 mt-2">Be A Volunteer</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php
  if (count($infos) === 0) {
  ?>
    <div class="alert alert-danger" role="alert">No Available Products</div>
  <?php } else {
  ?>
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">

          <?php
          foreach ($infos as $info) {
          ?>
            <div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
              <div class="staff">
                <div class="d-flex mb-4">
                  <img class="img" src="<?php echo $info['img']; ?>">
                  <div class="infos ml-4">
                    <h3><a href="teacher-single.html"><?php echo $info['name']; ?></a></h3>
                    <div class="text">
                      <p>Donated <span>$<?php echo $info['total_amount']; ?></span></p>
                    </div>
                    <span class="position">Points: <?php echo $info['points']; ?></span>
                    <br>
                    <a style="text-decoration:underline;" href="project.php">Donate Now</a>
                  </div>
                </div>
              </div>
            </div>
        <?php
          }
        } ?>

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