<?php
require_once("../../Model/donation.php");
require_once('../../Controller/donationcontroller.php');






session_start();
include_once "../client/top_codr.php";



if (isset($_POST['submit']) && $_SESSION['verflag'] == 1) {

  echo '<br>';
  $verCode = $_POST['f'] . $_POST['s'] . $_POST['t'] . $_POST['f1'] . $_POST['f2'] . $_POST['s1'];

  if ($_SESSION["code"] == $verCode) {

    $don = new donation();
    $obj = new donationcontroller;

    $don->setName($_SESSION["name"]);
    $don->setPhone($_SESSION["number"]);
    $don->setEmail($_SESSION["email"]);
    $don->setAmount($_SESSION["amount"]);
    $don->setPaymentmethod($_SESSION["payment_method"]);
    $don->setPaymentplan($_SESSION["paymentplan"]);
    $don->setAddress($_SESSION["address"]);
    $don->setProject_id($_SESSION["proj_id"]);
    $don->setOrgId($_SESSION["org_id"]);
    $don->setUser_id($_SESSION["userId"]);
    //$don->donate();
    $obj->donate($don);
    $_SESSION['verflag'] = 0;
    $_SESSION['donationcompleted'] = 1;
?>

<?php
    header("Location: project.php");
  } else {

    //  echo '<script>alert("Wrong code : try Again")</script>';
    echo '<div class="container">
  
   <div class="alert alert-danger alert-dismissible fade in" style="margin-top:20px">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Warning!</strong> Your Payment verfication code is incorrect.
   </div>
 </div>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Document</title>


  <style>
    .height-100 {
      height: 100vh
    }

    .card {
      width: 400px;
      border: none;
      height: 300px;
      box-shadow: 0px 5px 20px 0px #d2dae3;
      z-index: 1;
      display: flex;
      justify-content: center;
      align-items: center
    }

    .card h6 {
      color: red;
      font-size: 20px
    }

    .inputs input {
      width: 40px;
      height: 40px
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0
    }

    .card-2 {
      background-color: #fff;
      padding: 10px;
      width: 350px;
      height: 100px;
      bottom: -50px;
      left: 20px;
      position: absolute;
      border-radius: 5px
    }

    .card-2 .content {
      margin-top: 50px
    }

    .card-2 .content a {
      color: red
    }

    .form-control:focus {
      box-shadow: none;
      border: 2px solid red
    }

    .validate {
      border-radius: 20px;
      height: 40px;
      background-color: red;
      border: 1px solid red;
      width: 140px
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function(event) {

      function OTPInput() {
        const inputs = document.querySelectorAll('#otp > *[id]');
        for (let i = 0; i < inputs.length; i++) {
          inputs[i].addEventListener('keydown', function(event) {
            if (event.key === "Backspace") {
              inputs[i].value = '';
              if (i !== 0) inputs[i - 1].focus();
            } else {
              if (i === inputs.length - 1 && inputs[i].value !== '') {
                return true;
              } else if (event.keyCode > 47 && event.keyCode < 58) {
                inputs[i].value = event.key;
                if (i !== inputs.length - 1) inputs[i + 1].focus();
                event.preventDefault();
              } else if (event.keyCode > 64 && event.keyCode < 91) {
                inputs[i].value = String.fromCharCode(event.keyCode);
                if (i !== inputs.length - 1) inputs[i + 1].focus();
                event.preventDefault();
              }
            }
          });
        }
      }
      OTPInput();
    });
  </script>


</head>

<body>



  <div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="position-relative">
      <div class="card p-2 text-center">
        <h6>Please enter code <br> to verify your payment</h6>
        <div> <span>A code has been sent to</span> <small><?php if (isset($_SESSION["email"])) {
                                                            echo $_SESSION["email"];
                                                          }  ?></small> </div>
        <form method="post">
          <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" name="f" required /> <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" name="s" required /> <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" name="t" required /> <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" name="f1" required /> <input class="m-2 text-center form-control rounded" type="text" id="fifth" name="f2" maxlength="1" required /> <input class="m-2 text-center form-control rounded" type="text" id="sixth" name="s1" maxlength="1" required /> </div>
          <div class="mt-4"> <input type="submit" onclick="func()" name="submit" value="Validate" class="btn btn-danger px-4 validate"> </div>

        </form>

      </div>
    </div>
  </div>

  <script>
    function func() {
      alert("Sucsess!!Donation completed successfully");
    }
  </script>

</body>

</html>