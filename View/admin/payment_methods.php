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
require_once "../../Model/payment_method.php";


$payment_method = new payment_method();
$adminCN = new adminController();

$all_payment_methods = $adminCN->getAllPaymentMethods();
$num_of_payment_methods = $adminCN->getPaymentMethodsNum();




// //global variable
$errMsg = "";
$addmethod = false;
$resMsg = "";

if (isset($_POST['methodName']) ) {
  if (!empty($_POST['methodName']) ) {
    $payment_method->set_name($_POST['methodName']);

    if ($adminCN->add_payment_method($payment_method)) {
      $addmethod = true;
      $all_payment_methods = $adminCN->getAllPaymentmethods();

      header("Location: payment_methods.php");
      exit();
    } else {
      $addmethod = false;
      $resMsg = "Add Failed";
    }
  } else {
    $errMsg = "Please fill all fields";
  }
}

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
  <title>Payment Methods</title>

</head>

<body>


  <!-- ======= head-code ======= -->
  <?php
  include_once "../admin/header.php"
  ?>
  <!-- head-code -->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Payment Methods</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Payment methods</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div>
          <div class="row">


            <!-- Total Amount Card -->
            <div class="col-xxl-4 col-sm-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Payment Methods</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_payment_methods[0]["count"] ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Total Amount Card -->


          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

    <div>
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Payment methods <b>Details</b></h2>
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
                <th style="width: 18%;">Name</th>
              </tr>
            </thead>

            <!-- start donor table-->
            <?php
            if (count($all_payment_methods) == 0) {
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                No Available papayment methods
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
            } else {
              foreach ($all_payment_methods as $don) {
              ?>
                <tbody>
                  <tr>
                    <td><?php echo $don["id"] ?></td>
                    <td><?php echo $don["name"] ?></td>
                  </tr>
                </tbody>
            <?php }
            } ?>
          </table>
        </div>
      </div>
    </div>

    <br>


    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Method Form <br></h5>
              <!-- Horizontal Form -->
              <form action="" method="POST">

                <?php
                if ($errMsg != "") {
                ?>
                  <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                <?php
                }
                ?>

                <div class="row mb-3">
                  <label for="methodName" class="col-sm-2 col-form-label">method Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="methodName" class="form-control" id="methodName">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" name="add" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Horizontal Form -->
            </div>
          </div>
        </div>
        <?php
        if ($addmethod) {
        ?>
          <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
            <div class="toast-header">
              <i class="bx bx-trash me-2"></i>
              <div class="me-auto fw-semibold">method added succesfully</div>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        <?php
        } else if ($resMsg != "") {
        ?>
          <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
            <div class="toast-header">
              <i class="bx bx-trash me-2"></i>
              <div class="me-auto fw-semibold"><?php echo $resMsg; ?></div>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        <?php
        }
        ?>
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