<?php
session_start();

        include_once "../client/top_codr.php";

require_once "../../Controller/feedbackController.php";
require_once "../../Model/feedback.php";

$msg = "";
$errmsg = "";

$_SESSION["feedback"] = 0;

$feedback = new feedback();


if (isset($_POST["email"]) && isset($_POST["message"])) {
  if (!empty($_POST["email"]) && !empty($_POST["message"])) {
    $user = new feedbackController();
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $msg = "invalid email";
      $_SESSION["feedback"] = 3;
    } else if ($user->giveFeedback($_POST["email"], $_POST["message"])) {
      $feedback->setDiscription($_POST["message"]);
      $feedback->setEmail($_POST["email"]);
      $msg = "successfully sent";
      $_SESSION["feedback"] = 1;
    }
  } else {
    $msg = "please fill all data";
    $_SESSION["feedback"] = 2;
  }
}





?>





<!DOCTYPE html>
<html lang="en">

<head>
  <title>Feedback</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="style_form/images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style_form/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style_form/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style_form/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style_form/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style_form/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style_form/css/util.css">
  <link rel="stylesheet" type="text/css" href="style_form/css/main.css">
  <!--===============================================================================================-->





  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <?php
  include_once "../client/header.php"
  ?>


  <div class="contact1">
    <div class="container-contact1">
      <div class="contact1-pic js-tilt" data-tilt>
        <img src="style_form/images/img-01.png" alt="IMG">
      </div>

      <form class="contact1-form validate-form" action="feedback.php" method="post">
        <span class="contact1-form-title">
          Give feedback
        </span>

        <?php

        if ($_SESSION["feedback"] == 1) {

        ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php

        } else if ($_SESSION["feedback"] == 2) {
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        } else if ($_SESSION["feedback"] == 3) {

        ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        }


        ?>







        <div class="wrap-input1 validate-input" data-validate="Valid email is required: ex@abc.xyz">
          <input class="input1" type="text" name="email" placeholder="Email">
          <span class="shadow-input1"></span>
        </div>


        <div class="wrap-input1 validate-input" data-validate="Message is required">
          <textarea class="input1" name="message" placeholder="Message"></textarea>
          <span class="shadow-input1"></span>
        </div>

        <div class="container-contact1-form-btn">
          <button class="contact1-form-btn">
            <span>
              Send Feedback
              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>


  <!--===============================================================================================-->
  <script src="style_form/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="style_form/vendor/bootstrap/js/popper.js"></script>
  <script src="style_form/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="style_form/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="style_form/vendor/tilt/tilt.jquery.min.js"></script>
  <script>
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
  </script>

  <!--===============================================================================================-->
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