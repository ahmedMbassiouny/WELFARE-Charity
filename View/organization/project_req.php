<?php 

  //includes
  require_once "../../Controller/orgController.php";
  require_once '../../Model/project_req.php';
  require_once '../../Model/user.php';
  require_once '../../Model/organization.php';



  //dont enter untill login
  session_start();
  if (!isset($_SESSION["userId"])) {

      header("location:../auth/login.php ");
  } else {
      if ($_SESSION["userRole"] != 3) {
          header("location:../auth/login.php ");
      }
  }


  //make object
  $orgCon = new orgcontroller;
  $project_req = new project_req;
  $organization = new organzation;
  $user = new user;


  //open session if not opened
  if(!isset($_SESSION["userId"])){
    session_start();
  }
  $organization->set_user_id($_SESSION['userId']);


  //global variable
  $errMsg="";
  $addReq=false;
  $reqMsg="";


  //coding
  $fields = $orgCon->getAllFields();                                              // get all fields
  $organization->set_id($orgCon->get_org_id($organization->get_user_id()));       // get organization id


  if (isset($_POST['projectName']) && isset($_POST['description']) && isset($_POST['targetAmount']) && isset($_POST['fieldName']) && isset($_FILES["image"])) {
    if (!empty($_POST['projectName']) && !empty($_POST['description']) && !empty($_POST['targetAmount']) && !empty($_POST['fieldName'])) {
        $project_req->set_project_name($_POST['projectName']);
        $project_req->set_description($_POST['description']);
        $project_req->set_target_amount($_POST['targetAmount']);
        $project_req->set_field_id($_POST['fieldName']);
        $project_req->set_org_id($organization->get_id());

        $location = "../images/".date("h-i-s").$_FILES["image"]["name"];
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
          $project_req->set_img_url($location);
          if ($orgCon->add_request($project_req)) {
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
            <li class="breadcrumb-item active">Make project Request</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Horizontal Form <br></h5>
                <!-- Horizontal Form -->
                <form action="" method="post" enctype='multipart/form-data'>

                  <?php
                    if ($errMsg != "") {
                  ?>
                    <div class="alert alert-danger" role="alert"><?php echo $errMsg;?></div>
                  <?php
                    }
                  ?>

                  <div class="row mb-3">
                    <label for="inputname" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="projectName" class="form-control" id="inputname">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputDes" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea name="description" class="form-control" id="inputDes"></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputamount" class="col-sm-2 col-form-label">Target Amount</label>
                    <div class="col-sm-10">
                      <input type="number" name="targetAmount" class="form-control" id="inputamount">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputfield" class="col-sm-2 col-form-label">Field Name</label>
                    <div class="col-sm-10">
                      <select id="inputfield" class="form-select" name="fieldName">

                      <?php
                        foreach ($fields as $field) {
                      ?>
                        <option value="<?php echo $field["id"] ?>"><?php echo $field["name"] ?></option>
                      <?php
                        }
                      ?>

                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-message">Image</label>
                      <div class="col-sm-10">
                          <div class="input-group input-group-merge">
                            <input class="form-control" type="file" id="formFile" name="image">
                          </div>
                      </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>

                </form><!-- End Horizontal Form -->
              </div>
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
        </div>
      </section>

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