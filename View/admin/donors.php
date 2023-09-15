<?php
session_start();
include_once "../admin/top_code.php";

// if (!isset($_SESSION['user_id'])) {
//   header('Location: login.php');
//   exit();
// }
// elseif($_SESSION['role']!=1){
//   header('Location: login.php');
//   exit();
// }

// // logout code
// if (isset($_POST['logout'])) {
//   // Unset all of the session variables
//   $_SESSION = array();
// 
//   // Destroy the session
//   session_destroy();
// 
//   // Redirect to the login page
//   header("Location: ../Auth/login.php");
//   exit();
// }

require_once "../../Controller/adminController.php";
require_once "../../Model/donor.php";

$adminCN = new adminController();
$all_donors = $adminCN->getAlldonors();
$num_of_donors = $adminCN->getDonorsNum();

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
    .table-wrapper {
      min-width: 700px;
      background: #fff;
      padding: 20px 25px;
      border-radius: 3px;
      box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
      color: #fff;
      background: #40b2cd;
      padding: 16px 25px;
      margin: -20px -25px 10px;
      border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
      margin: 5px 0 0;
      font-size: 24px;
    }

    .search-box {
      position: relative;
      float: right;
    }

    .search-box .input-group {
      min-width: 300px;
      position: absolute;
      right: 0;
    }

    .search-box .input-group-addon,
    .search-box input {
      border-color: #ddd;
      border-radius: 0;
    }

    .search-box input {
      height: 34px;
      padding-right: 35px;
      background: #f4fcfd;
      border: none;
      border-radius: 2px !important;
    }

    .search-box input:focus {
      background: #fff;
    }

    .search-box input::placeholder {
      font-style: italic;
    }

    .search-box .input-group-addon {
      min-width: 35px;
      border: none;
      background: transparent;
      position: absolute;
      right: 0;
      z-index: 9;
      padding: 6px 0;
    }

    .search-box i {
      color: #a0a5b1;
      font-size: 19px;
      position: relative;
      top: 2px;
    }

    table.table {
      table-layout: fixed;
      margin-top: 15px;
    }

    table.table tr th,
    table.table tr td {
      border-color: #e9e9e9;
    }

    table.table th i {
      font-size: 13px;
      margin: 0 5px;
      cursor: pointer;
    }

    table.table th:first-child {
      width: 60px;
    }

    table.table th:last-child {
      width: 120px;
    }

    table.table td a.view {
      color: #03A9F4;
    }

    table.table td a.edit {
      color: #FFC107;
    }

    table.table td a.delete {
      color: #E34724;
    }

    table.table td i {
      font-size: 19px;
    }
  </style>
  <script>
    $(document).ready(function() {
      // Activate tooltips
      $('[data-toggle="tooltip"]').tooltip();

      // Filter table rows based on searched term
      $("#search").on("keyup", function() {
        var term = $(this).val().toLowerCase();
        $("table tbody tr").each(function() {
          $row = $(this);
          var name = $row.find("td:nth-child(2)").text().toLowerCase();
          console.log(name);
          if (name.search(term) < 0) {
            $row.hide();
          } else {
            $row.show();
          }
        });
      });
    });
  </script>
  <!-- ======= head-code ======= -->
  <?php
  include_once "../admin/head-code.php"
  ?>
  <!-- head-code -->
  <title>Donors</title>

</head>

<body>


  <!-- ======= head-code ======= -->
  <?php
  include_once "../admin/header.php"
  ?>
  <!-- head-code -->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Donors</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
          <li class="breadcrumb-item active">Donors</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div>
          <!-- Donations Card -->
          <div class="col-xxl-4 col-sm-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Donors</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $num_of_donors[0]["count"] ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Donations Card -->

        </div><!-- End Left side columns -->

        <div class="donation_table">

        </div>

      </div>
    </section>



    <div>
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Donors <b>Details</b></h2>
              </div>
              <div class="col-sm-6">
                <div class="search-box">
                  <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="Search by Name">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table class="table ">
            <thead>
              <tr>
                <th style="width: 10%;">#</th>
                <th style="width: 18%;">User_id</th>
                <th style="width: 18%;">Name</th>
                <th style="width: 18%;">total amount</th>
                <th style="width: 18%;">donations</th>
                <th style="width: 18%;">points</th>
              </tr>
            </thead>

            <!-- start donor table-->
            <?php
            if (count($all_donors) == 0) {
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                No Available donors
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
            } else {
              foreach ($all_donors as $don) {
              ?>
                <tbody>
                  <tr>
                    <td><?php echo $don["id"] ?></td>
                    <td><?php echo $don["user_id"] ?></td>
                    <td><?php echo $don["name"] ?></td>
                    <td><?php echo $don["total_amount"] ?></td>
                    <td><?php echo $don["donations_num"] ?></td>
                    <td><?php echo $don["points"] ?></td>
                  </tr>
                </tbody>
            <?php }
            } ?>
          </table>
        </div>
      </div>
    </div>





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