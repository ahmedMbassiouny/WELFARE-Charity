<?php

  //includes
  require_once "../../Controller/orgController.php";
  require_once '../../Model/project_req.php';
  require_once '../../Model/project.php';
  require_once '../../Model/event_req.php';
  require_once '../../Model/event.php';
  require_once '../../Model/user.php';



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
  $organization = new organzation;
  $pro = new project;
  $event = new event;
  $user = new user;



  //open session if not opened
  if(!isset($_SESSION["userId"])){
    session_start();
  }
  $organization->set_user_id($_SESSION['userId']);                          // get org id from session 


  //coding
  $info = $orgCon->get_data_org($organization->get_user_id());              //get all organization information
    $user->set_name($info[0]['name']);
    $user->set_email($info[0]['email']);
    $user->set_id($info[0]['user_id']);
    $user->set_password($info[0]['password']);
    $user->set_image($info[0]['img_url']);
    $organization->set_account_num($info[0]['account_no']);
    $organization->set_address($info[0]['address']);
    $organization->set_id($info[0]['id']);



  //global variable
  $eventNums = $orgCon->get_event_num($organization->get_id());
  $eventReqNums = $orgCon->get_event_req_num($organization->get_id());
  $projectNums = $orgCon->get_project_num($organization->get_id());
  $projectReqNums = $orgCon->get_project_req_num($organization->get_id());


  $Allprojects = $orgCon->get_all_project($organization->get_id());         // get all projects of organization
  $AllReqPros  = $orgCon->get_all_project_req($organization->get_id());     // get all requests requests of organization
  $Allevents   = $orgCon->get_all_event($organization->get_id());           // get all events of organization
  $AllReqEves  = $orgCon->get_all_event_req($organization->get_id());       // get all events requests of organization


?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- head code -->
    <?php include_once "../organization/head-code.php" ?>

    <!-- css gallary -->
    <style>
      /* Center the gallery container */
      .gallery {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin: 200px 0;
      }
      /* Set the width of each image */
      .gallery img {
        width: 285px;
        height: 200px;
        cursor: pointer;
        transition: transform 0.2s;
      }
      /* Scale up images on hover */
      .gallery img:hover {
        transform: scale(1.1);
      }
      /* Styling for the lightbox */
      .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
      }
      .lightbox img {
        max-width: 90%;
        max-height: 90%;
      }
      .lightbox-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        color: #fff;
        cursor: pointer;
      }
    </style>

    <!-- css cards events -->
    <style>
      @import url('https://fonts.googleapis.com/css?family=Abel');

      .center {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        padding-bottom: 60px;
      } 

      .card-event {
        width: 450px;
        height: 220px;
        background-color: #fff;
        background: linear-gradient(#f8f8f8, #fff);
        box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
        border-radius: 6px;
        overflow: hidden;
        position: relative;
        margin: 1.5rem 1.5rem;
      }

      .card-event h1 {
        text-align: center;
      }

      .card-event .additional {
        position: absolute;
        width: 150px;
        height: 100%;
        background: linear-gradient(#dE685E, #000000);
        transition: width 0.4s;
        overflow: hidden;
        z-index: 2;
      }

      .card-event:hover .additional {
        width: 100%;
        border-radius: 0 5px 5px 0;
      }

      .card-event .additional .user-card {
        width: 150px;
        height: 100%;
        position: relative;
        float: left;
      }

      .card-event .additional .user-card::after {
        content: "";
        display: block;
        position: absolute;
        top: 10%;
        right: -2px;
        height: 80%;
        border-left: 2px solid rgba(0,0,0,0.025);
      }

      .card-event .additional .user-card .level,
      .card-event .additional .user-card .points {
        top: 15%;
        color: #fff;
        text-transform: uppercase;
        font-size: 0.75em;
        font-weight: bold;
        background: rgba(0,0,0,0.15);
        padding: 0.125rem 0.75rem;
        border-radius: 100px;
        white-space: nowrap;
      }

      .card-event .additional .user-card .points {
        top: 85%;
      }

      .card-event .additional .user-card svg {
        top: 50%;
      }

      .card-event .additional .more-info {
        width: 300px;
        float: left;
        position: absolute;
        left: 150px;
        height: 100%;
      }

      .card-event .additional .more-info h1 {
        color: #fff;
        margin-bottom: 0;
      }

      .card-event.green .additional .more-info h1 {
        color: #224C36;
      }

      .card-event .additional .coords {
        margin: 0 1rem;
        color: #fff;
        font-size: 1rem;
      }

      .card-event.green .additional .coords {
        color: #325C46;
      }

      .card-event .additional .coords span + span {
        float: right;
      }

      .card-event .additional .stats {
        font-size: 2rem;
        display: flex;
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
        top: auto;
        color: #fff;
      }

      .card-event.green .additional .stats {
        color: #325C46;
      }

      .card-event .additional .stats > div {
        flex: 1;
        text-align: center;
      }

      .card-event .additional .stats i {
        display: block;
      }

      .card-event .additional .stats div.title {
        font-size: 0.75rem;
        font-weight: bold;
        text-transform: uppercase;
      }

      .card-event .additional .stats div.value {
        font-size: 1.5rem;
        font-weight: bold;
        line-height: 1.5rem;
      }

      .card-event .additional .stats div.value.infinity {
        font-size: 2.5rem;
      }

      .card-event .general {
        width: 300px;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1;
        box-sizing: border-box;
        padding: 1rem;
        padding-top: 0;
      }

      .card-event .general .more {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        font-size: 0.9em;
      }

    </style>

  </head>

  <body>
    <!-- ======= Header ======= -->
    <?php include_once "../organization/header.php" ?>
    <!-- End Header -->

    <!-- ======= main ======= -->
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Home Page</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <!-- Events -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <br>
        <h2>Events</h2>
        <hr style="
          width: 13%;
          border: #0229ff 2px solid;
        ">
        <!-- cards events -->
        <div class="center">

          <?php 
            if($eventNums[0]['count'] == 0) {
          ?>
            <div class="alert alert-danger fw-bold" style="width: 90%; text-align:center;" role="alert">No Events</div>
          <?php
            }
            else {
              foreach($Allevents as $Allevent) {
          ?>
          
            <div class="card-event">
              <div class="additional">

                <div class="user-card">

                  <div class="level center"> <?php echo $user->get_name(); ?> </div>
                  <!-- <div class="points center">ID Event: <?php echo $Allevent['id']; ?> </div>  -->
                  <div class="img-event">
                    <img src="<?php echo $Allevent['img_url']; ?>" alt="" style="width: 100%;">
                  </div>

                </div>

                <div class="more-info">
                  <h1 style="text-transform: capitalize; font-weight: 600;"><?php echo $Allevent['name']; ?></h1>
                  <div class="coords">
                    <br>
                    <p><?php echo $Allevent['information']; ?></p>
                  </div>
                </div>

              </div>

              <div class="general">
                <h1 style="text-transform: capitalize; color: rgb(182,85,77); font-weight: 600;"><?php echo $Allevent['name']; ?></h1>
                <br>
                <div class="points "><span class="fw-bold text-secondary">ID Event:</span> <?php echo $Allevent['id']; ?> </div> 
                <div class="points "><span class="fw-bold text-secondary">Date:</span> <?php echo $Allevent['time']; ?> </div> 
                <div class="points "><span class="fw-bold text-secondary">location:</span> <?php echo '<br>'. $Allevent['location']; ?> </div> 
              </div>
                
            </div>

          <?php
              }
            }
          ?>

        </div>

        <!-- Page Heading -->
        <h2>Requests Events</h2>
        <hr style="
          width: 28%;
          border: #0229ff 2px solid;
        ">
        <!-- table events -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <?php
                if($eventReqNums[0]['count'] == 0) {
              ?>
                <div class="alert alert-secondary fw-bold" style="width: 90%; text-align:center;" role="alert">No Requests Events</div>
              <?php
                } 
                else {
              ?>
              <h5 class="card-title">Requests<span>| Today</span></h5>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Information</th> -->
                    <th scope="col">location</th>
                    <th scope="col">Time</th>
                    <th scope="col">State</th>
                  </tr>
                </thead>
                <?php 
                  foreach($AllReqEves as $AllReqEve) {
                ?>
                <tbody>
                  <tr>
                    <th scope="row"><a href="#"><img src="<?php echo $AllReqEve['img_url']; ?>" alt="" style="max-width: 60px;"></a></th>
                    <td style="vertical-align: middle;"><a href="#" class="text-primary fw-bold"><?php echo $AllReqEve['name']; ?></a></td>
                    <!-- <td style="vertical-align: middle;"><?php echo $AllReqEve['information']; ?></td> -->
                    <td style="vertical-align: middle;"><?php echo $AllReqEve['location']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $AllReqEve['time']; ?></td>
                    <td style="vertical-align: middle;" class="fw-bold text-secondary"><?php echo $AllReqEve['state']; ?></td>
                  </tr>
                </tbody>
                <?php
                  }
                ?>
              </table>

            </div>
              <?php
                }
              ?>

          </div>
        </div>

      </div>
      <!-- end events -->


      <?php 
        if($projectNums[0]['count'] != 0 || $eventNums[0]['count'] != 0) {
      ?>
      <!-- gallary -->
      <div class="gallery">
      <?php
          if($projectNums[0]['count'] != 0) {
            foreach($Allprojects as $Allproject) {
      ?>
          <img src="<?php echo $Allproject['img_url']; ?>" alt="Image 1" onclick="openLightbox('<?php echo $Allproject['img_url'];?>')">
        <?php 
            }
          }
          if($eventNums[0]['count'] != 0) {
            foreach($Allevents as $Allevent) {
      ?>
          <img src="<?php echo $Allevent['img_url']; ?>" alt="Image 1" onclick="openLightbox('<?php echo $Allevent['img_url'];?>')">
      <?php 
            }
          }
        }
        else {
      ?>
        <br><br><br><br><br>
      <?php
        }
      ?>
      </div>
      <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <img src="" alt="" id="lightbox-image">
        <span class="lightbox-close">&times;</span>
      </div>


      <!-- projects -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <br>
        <h2>Projects</h2>
        <hr style="
          width: 14%;
          border: #0229ff 2px solid;
        ">
        <!-- cards projects -->
        <div class="row" style="justify-content: flex-start; ">

          <?php 
            if($projectNums[0]['count'] != 0) {
              foreach($Allprojects as $Allproject) {
          ?>

          <div class="card" style="width: 30%; margin: 0 10px 35px ;">
            <img src="<?php echo $Allproject['img_url']; ?>" class="card-img-top" alt="..." style="height:300px">
            <div class="card-body">
              <h5 class="card-title" style="font-weight: bold;"><?php echo $Allproject["proj_name"];?></h5>
              <p class="card-text" style="color: black;font-weight: 600;"> <b>Total Amount: </b> <?php echo $Allproject["target_amount"];?></p>
              <p class=""><?php echo $Allproject["description"];?>.</p>
            </div>
          </div>

          <?php 
              }
            }
            else {
          ?>
            <div class="alert alert-warning fw-bold" style="width: 90%; text-align:center;" role="alert">No Projects</div>
          <?php
            }
          ?>

        </div>

        <br>

        <!-- Page Heading -->
        <h2>Requests Projects</h2>
        <hr style="
          width: 30%;
          border: #0229ff 2px solid;
        ">
        <!-- table project -->
        <div class="card shadow mb-4">
          <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">All Requests Projects</h6></div>
          <div class="card-body">
            <?php
              if($projectReqNums[0]['count'] == 0) {
            ?>
            <div class="alert alert-primary fw-bold" style="width: 90%; text-align:center;" role="alert">No Projects</div>
            <?php
              } 
              else {
            ?>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Project Id</th>
                    <th>Total Amount</th>
                    <th>State</th>
                  </tr>
                </thead>
                <?php 
                  foreach($AllReqPros as $AllReqPro) {
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $AllReqPro['proj_name']; ?></td>
                    <td><?php echo $AllReqPro['org_id']; ?></td>
                    <td><?php echo $AllReqPro['target_amount']; ?></td>
                    <td><?php echo $AllReqPro['state']; ?></td>
                  </tr>
                </tbody>
                <?php
                  }
                ?>
              </table>
            </div>
            <?php
              }
            ?>
          </div>
        </div>

      </div>
      <!-- end Projects -->

    </main>
    <!-- End main -->

    <!-- ======= Footer ======= -->
    <?php include_once "../organization/footer.php" ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- js gallary -->
    <script>
      function openLightbox(imageUrl) {
        // Show the lightbox
        var lightbox = document.getElementById('lightbox');
        lightbox.style.display = 'flex';

        // Set the image in the lightbox
        var image = document.getElementById('lightbox-image');
        image.src = imageUrl;
      }

      function closeLightbox() {
        // Hide the lightbox
        var lightbox = document.getElementById('lightbox');
        lightbox.style.display = 'none';
      }
    </script>

    <!-- Vendor JS Files -->
    <?php include_once "../organization/js-links.php" ?>

  </body>

</html>