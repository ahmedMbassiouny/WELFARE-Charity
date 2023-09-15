<?php 

//includes
require_once "../../Controller/orgController.php";
require_once '../../Model/donor.php';

//make object
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
          if(count($infos)===0) {
        ?>
          <div class="alert alert-danger" role="alert">No Available Products</div>
		<?php } 
			else {
		?>
		<section class="ftco-section bg-light">
		<div class="container">
			<div class="row">
				
					<?php
						foreach($infos as $info) {
							?>
				<div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
					<div class="staff">
						<div class="d-flex mb-4">
							<img class="img" src="<?php echo $info['img_url']; ?>">
							<div class="infos ml-4">
								<h3><a href="teacher-single.html"><?php echo $info['name']; ?></a></h3>
								<div class="text">
									<p>Donated <span>$<?php echo $info['total_amount']; ?></span></p>
								</div>
								<span class="position">Points: <?php echo $info['points']; ?></span>
								<br>
								<a style="text-decoration:underline;" href="projects.php">Donate Now</a>
							</div>
						</div>
					</div>
					</div>
					<?php
						}?>
				
			</div>
		</div>
		</section> 
	<?php } ?>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <!-- <script src="js/popper.min.js"></script> -->
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <!-- <script src="js/jquery.easing.1.3.js"></script> -->
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
  <script src="js/aos.js"></script>
  <!-- <script src="js/jquery.animateNumber.min.js"></script> -->
  <!-- <script src="js/bootstrap-datepicker.js"></script> -->
  <!-- <script src="js/jquery.timepicker.min.js"></script> -->
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>