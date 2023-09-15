<?php
session_start();
  include_once "../client/top_codr.php";

require_once "../../Controller/eventController.php";
require_once "../../Controller/volunteerConroller.php";
require_once "../../Model/event.php";

$msg = "";
$reg_msg = "";
$_SESSION["btn"] = 0;
$events = new eventController();
$vol = new volunteerController();

$result = $events->viewEvents();
if ($result) {
  $_SESSION["result"] = 0;
} else {
  $msg = "There is no Events yet....";
  $_SESSION["result"] = 2;
}


if (isset($_POST["search"])) {
  if (!empty($_POST["search"])) {
    $search = new eventController();
    $s_result = $search->searchEvent($_POST["search"]);
    if ($s_result) {
      $event = new event();
      $event->setId($s_result[0]["id"]);
      $event->setName($s_result[0]["name"]);
      $event->setInformation($s_result[0]["information"]);
      $event->setTime($s_result[0]["time"]);
      $event->setLocation($s_result[0]["location"]);
      $event->setImage($s_result[0]["image"]);
      $_SESSION["result"] = 1;
    } else {
      $msg = "there is no result";
      $_SESSION["result"] = 3;
    }
  } else {
    $msg = "please enter the name of event to search";
    $_SESSION["result"] = 2;
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


  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">



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
          <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span>Event</span></p>
          <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Events</h1>
        </div>
      </div>
    </div>
  </div>


  <style>
    .search {
      position: relative;
      box-shadow: 0 0 40px rgba(51, 51, 51, .1);

    }

    .search input {

      height: 60px;
      text-indent: 25px;
      border: 2px solid #d6d4d4;


    }


    .search input:focus {

      box-shadow: none;
      border: 2px solid blue;


    }

    .search .fa-search {

      position: absolute;
      top: 20px;
      left: 16px;

    }

    .search button {

      position: absolute;
      top: 5px;
      right: 5px;
      height: 50px;
      width: 110px;
      background: blue;

    }
  </style>

  <form action="event.php" method="post">
    <div class="container">
      <div class="row height d-flex justify-content-center align-items-center" style="margin-top: 50px;">

        <div class="col-md-8">

          <div class="search">
            <input type="text" name="search" class="form-control" placeholder="type to search....">
            <button class="btn btn-primary">Search</button>
          </div>


        </div>
        <button type="button" onclick="location.href='event.php';" class="btn btn-primary" style="width: 110px;height:50px;">Refresh</button>
      </div>
    </div>
  </form>




  <section class="ftco-section">
    <div class="container">
      <div class="row">

        <?php

        if ($_SESSION["result"] == 0) {
          foreach ($result as $res) {
            if ($vol->checkValidate($_SESSION["userId"])) {
              if ($vol->checkRegisterd($res["id"], $vol->getVolId($_SESSION["userId"])[0]["id"])) {
                $reg_msg = "Registerd";
                $_SESSION["btn"] = 0;
              } else {
                $reg_msg = "";
                $_SESSION["btn"] = 1;
              }
            }


        ?>
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry align-self-stretch" style="width:500px;">
                <a href="blog-single.html" class="block-20" style="background-image: url('images/event-1.jpg');">
                </a>
                <div class="text p-4 d-block">
                  <div class="meta mb-3">
                    <div><a href="#"><?php echo $res["time"]; ?></a></div>
                    <div><a href="#">Admin</a></div>
                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                  </div>
                  <h3 class="heading mb-4"><a href="#"><?php echo $res["name"]; ?></a></h3>
                  <p class="time-loc"><span class="mr-2"><i class="icon-clock-o"></i>08:00:00</span> <span><i class="icon-map-o"></i> <?php echo $res["location"]; ?></span></p>
                  <p><?php echo $res["information"]; ?></p>
                  <span class="badge bg-warning text-dark"><?php echo $reg_msg; ?></span>

                  <?php
                  if ($_SESSION["btn"] == 1) {
                  ?>
                    <p><a href="volunteer.php?event_id=<?php echo $res["id"] ?>">Join Event <i class="ion-ios-arrow-forward"></i></a></p>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>

          <?php
          }
        } else if ($_SESSION["result"] == 1) {

          ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch" style="width:500px;">
              <a href="blog-single.html" class="block-20" style="background-image: url('images/event-1.jpg');">
              </a>
              <div class="text p-4 d-block">
                <div class="meta mb-3">
                  <div><a href="#"><?php echo $event->getDate(); ?></a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mb-4"><a href="#"><?php echo $event->getName(); ?></a></h3>
                <p class="time-loc"><span class="mr-2"><i class="icon-clock-o"></i> <?php echo $event->getTime(); ?></span> <span><i class="icon-map-o"></i> <?php echo $event->getLocation(); ?></span></p>
                <p><?php echo $event->getInformation(); ?></p>
                <p><a href="volunteer.php?event_id=<?php echo $res["id"] ?>">Join Event <i class="ion-ios-arrow-forward"></i></a></p>
              </div>
            </div>
          </div>

        <?php
        } else if ($_SESSION["result"] == 2) {
        ?>

          <div class="alert alert-secondary bg-secondary text-light border-0 alert-dismissible fade show" role="alert" style="width:50%; margin:auto; padding:10px; text-align:center;">
            <?php echo $msg; ?>
          </div>

        <?php
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