<?php

require_once("../../Controller/DBController.php");
session_start();
include_once "../client/top_codr.php";

$db = new DBController();
if ($db) {
  $sql = " SELECT id , email,sec_name FROM donation where user_id ={$_SESSION['userId']} ";
  $sql2 = "SELECT points , total_amount ,donations_num  FROM donor where user_id ={$_SESSION['userId']}";
  $Data = $db->select($sql);
  $donordata = $db->select($sql2);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">


  <title>View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welfare - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/style.css">

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <style type="text/css">
    body {
      color: #6F8BA4;

    }

    .section {
      padding: 100px 0;
      position: relative;
    }

    .gray-bg {
      background-color: #f5f5f5;
    }

    /* About Me 
---------------------*/
    .about-text h3 {
      font-size: 45px;
      font-weight: 700;
      margin: 0 0 6px;
    }

    @media (max-width: 767px) {
      .about-text h3 {
        font-size: 35px;
      }
    }

    .about-text h6 {
      font-weight: 600;
      margin-bottom: 15px;
    }

    @media (max-width: 767px) {
      .about-text h6 {
        font-size: 18px;
      }
    }

    .about-text p {
      font-size: 18px;
      max-width: 450px;
    }

    .about-text p mark {
      font-weight: 600;
      color: #20247b;
    }

    .about-list {
      padding-top: 10px;
    }

    .about-list .media {
      padding: 5px 0;
    }

    .about-list label {
      color: #20247b;
      font-weight: 600;
      width: 88px;
      margin: 0;
      position: relative;
    }

    .about-list label:after {
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      right: 11px;
      width: 1px;
      height: 12px;
      background: #20247b;
      -moz-transform: rotate(15deg);
      -o-transform: rotate(15deg);
      -ms-transform: rotate(15deg);
      -webkit-transform: rotate(15deg);
      transform: rotate(15deg);
      margin: auto;
      opacity: 0.5;
    }

    .about-list p {
      margin: 0;
      font-size: 15px;
    }

    @media (max-width: 991px) {
      .about-avatar {
        margin-top: 30px;
      }
    }

    .about-section .counter {
      padding: 22px 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
    }

    .about-section .counter .count-data {
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .about-section .counter .count {
      font-weight: 700;
      color: #20247b;
      margin: 0 0 5px;
    }

    .about-section .counter p {
      font-weight: 600;
      margin: 0;
    }

    mark {
      background-image: linear-gradient(rgba(252, 83, 86, 0.6), rgba(252, 83, 86, 0.6));
      background-size: 100% 3px;
      background-repeat: no-repeat;
      background-position: 0 bottom;
      background-color: transparent;
      padding: 0;
      color: currentColor;
    }

    .theme-color {
      color: #fc5356;
    }

    .dark-color {
      color: #20247b;
    }
  </style>
</head>

<body>
  <?php
  include_once "../client/header.php"
  ?>

  <section class="section about-section gray-bg" id="about">
    <div style="text-align: center; margin-bottom: 35px; color:rgb(11, 11, 164);">
      <h3>Dashboard</h3>
    </div>

    <div class="container">
      <div class="counter">
        <div class="row">
          <div class="col-4">
            <div class="count-data text-center">
              <h6 class="count h2" data-to="500" data-speed="500"><?php echo count($Data); ?></h6>
              <p class="m-0px font-w-600">Donations</p>
            </div>
          </div>

          <div class="col-4">
            <div class="count-data text-center">
              <h6 class="count h2" data-to="850" data-speed="850"><?php echo $donordata[0]['total_amount']; ?></h6>
              <p class="m-0px font-w-600">Total Amount</p>
            </div>
          </div>
          <div class="col-4">
            <div class="count-data text-center">
              <h6 class="count h2" data-to="190" data-speed="190"><?php echo $donordata[0]['points']; ?></h6>
              <p class="m-0px font-w-600">Bonus Points</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="text-align: center; margin-bottom: 35px; margin-top: 35px; color:rgb(11, 11, 164);">
      <h3>View last Donation</h3>
    </div>
    <div class="container">
      <div class="counter">
        <div class="row">

          <!-- style="margin-top: 15px; height: 500px; overflow-y: scroll; " -->
          <table class="table table-striped">
            <thead>
              <tr>

                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Reciept</th>

              </tr>
            </thead>
            <tbody>

              <?php

              for ($i = 0; $i < count($Data); $i++) {
                $eq = $Data[$i]['id'];
                echo '<tr>';

                echo '<th scope="row">';
                echo $Data[$i]['id'];
                echo '</th>';
                echo '<td>';
                echo $Data[$i]['sec_name'];
                echo '</td>';
                echo '<td>';
                echo $Data[$i]['email'];
                echo '</td>';

                echo '<td>';
                // echo'<a href="http:">view Reciept</a>';
                echo '<a href="generate.php?transId=' . $eq . '">view Reciept</a>';
                echo '</td>';
                echo '</tr>';
              }
              ?>

              <!-- 
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td> -->


            </tbody>
          </table>



        </div>
      </div>
    </div>

  </section>
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