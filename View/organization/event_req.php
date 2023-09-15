<?php 

  //includes
  require_once "../../Controller/orgController.php";
  require_once '../../Model/event_req.php';
  require_once '../../Model/organization.php';
  require_once '../../Model/user.php';



  //dont enter untill login
  session_start();
  if (!isset($_SESSION["userId"])) {

      header("location:../login/login.php ");
  } else {
      if ($_SESSION["userRole"] != 3) {
          header("location:../login/login.php ");
      }
  }


  //make object
  $orgCon = new orgcontroller;
  $event_req = new event_req;
  $organization = new organzation;
  $user = new user;


  //open session if not opened
  if(!isset($_SESSION["userId"])){
    session_start();
  }
  $organization->set_user_id($_SESSION['userId']);
  // $organization->set_id($_SESSION['orgId']);



  //global variable
  $errMsg="";
  $addReq=false;
  $reqMsg="";



  //coding
  $organization->set_id($orgCon->get_org_id($organization->get_user_id()));       // get organization id


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['information']) && !empty($_POST['location']) && !empty($_POST['time']) && !empty($_FILES['image'])) {
        $event_req->set_event_name($_POST['name']);
        $event_req->set_information($_POST['information']);
        $event_req->set_location($_POST['location']);
        $event_req->set_time($_POST['time']);
        $event_req->set_org_id($organization->get_id());

        $location = "../images/".date("h-i-s").$_FILES["image"]["name"];
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
          $event_req->set_img_url($location);
          if ($orgCon->add_event($event_req)) {
            $addReq = true;
            // header("location: request.php");
          } 
          else {
            $addReq = false;
            $reqMsg="Add Failed";
          }
        } 
        else {
          $errMsg = "Error in Upload";
        }
    } 
    else {
      $errMsg = "Please fill all fields";
    }
  }

  $user->set_name($_GET['userName']);
  $user->set_image($_GET['userImage']);

  // echo $_GET['userImage'];

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- head code -->
    <?php include_once "../organization/head-code.php" ?>
  </head>

  <body>

    <!-- ======= Header ======= -->
    <?php include_once "../organization/header.php" ?>
    <!-- End Header -->

    <!-- ======= main ======= -->
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Make Request Page</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Make Request</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <div class="card" style="width: 90%; margin: auto;">
        <div class="card-body">
          <h5 class="card-title">Vertical Form</h5>
          <!-- Vertical Form -->
          <form class="row g-3" action="" method="post"  enctype='multipart/form-data'>

            <?php
                if ($errMsg != "") {
              ?>
                <div class="alert alert-danger" role="alert"><?php echo $errMsg;?></div>
              <?php
                }
            ?>

            <div class="col-12">
              <label for="inputNanme4" class="form-label">Name</label>
              <input type="text" class="form-control" id="inputNanme4" name="name">
            </div>

            <div class="col-12">
              <label for="Information" class="form-label">Information</label>
              <input type="text" class="form-control" id="Information" name="information">
            </div>

            <div class="col-12">
              <label for="Location" class="form-label">Location</label>
              <input type="text" class="form-control" id="Location" name="location">
            </div>

            <div style="display: flex; justify-content: space-between">
              <div style="width: 40%;">
                <label for="inputAddress" class="form-label">Date</label>
                <input type="date" class="form-control" style="width: 100%;" id="inputAddress" name="time">
              </div>

              <div style="width: 55%;">
                <label class="form-label" for="basic-icon-default-message">Image</label>
                <input class="form-control" style="width:100%" type="file" id="formFile" name="image">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>


          </form>
          <!-- Vertical Form -->
        </div>
      </div>

      <?php
        if($addReq) {
      ?>

      <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
        <div class="toast-header">
          <i class="bx bx-trash me-2"></i>
          <div class="me-auto fw-semibold">Add Succesfully</div>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>

      <?php
        }
        else if($reqMsg != ""){
      ?>

      <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 show bg-info" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: 30%;">
        <div class="toast-header">
          <i class="bx bx-trash me-2"></i>
          <div class="me-auto fw-semibold"><?php echo $reqMsg; ?></div>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
      
      <?php
        }
      ?>

    </main>
    <!-- End main -->

    <!-- ======= Footer ======= -->
    <?php include_once "../organization/footer.php" ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include_once "../organization/js-links.php" ?>

  </body>

</html>