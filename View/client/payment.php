
<?php
session_start();

include_once "../client/top_codr.php";


if(isset($_POST['submit']) ){
    $_SESSION["code"]=random_int(100000,999999);
    require('../../Controller/emailcontroller.php');
     if($_POST['submit']=="Confirm Payment"){
        
        $_SESSION["phonenumber"]=$_POST['phonenumber'];
        $_SESSION["payment_method"]=2;
       // $mail->Body="Vodafone Account No. :".$_SESSION["phonenumber"].'<br>'.'<br>'."your payment  verfication code is  ".$_SESSION["code"];
        if(isset($_SESSION["email"])){

            
            verficationCode_Vcash($_SESSION["email"],$_SESSION["code"],$_SESSION["phonenumber"]);

        }
        
        $_SESSION['state']=1;

    }else if($_POST['submit']=="confirm"){
        
        $_SESSION["payment_method"]=1;
        $_SESSION["cardowner"]=$_POST['cardowner'];
        $_SESSION["cardNumber"]=$_POST['cardNumber'];
        $_SESSION["exp_year"]=$_POST['exp_year'];
        $_SESSION["exp_month"]=$_POST['exp_month'];
        $_SESSION["cvv"]=$_POST['cvv'];
        $rest = substr($_SESSION["cardNumber"], -4);
        //$mail->Body="Your Visa Card No. :"."**** **** **** ".$rest.'<br>'.'<br>'."your payment  verfication code is  ".$_SESSION["code"];
        if(isset($_SESSION["email"])){
            
            verficationCode_visa($_SESSION["email"],$_SESSION["code"],$rest);

        }
       
        $_SESSION['state']=2;
        
    }

     
    

   header("Location: verify.php");

}


?>
<!doctype html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Snippet - BBBootstrap</title>
                                <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                                <style>::-webkit-scrollbar {
                                  width: 8px;
                                }
                                /* Track */
                                ::-webkit-scrollbar-track {
                                  background: #f1f1f1; 
                                }
                                 
                                /* Handle */
                                ::-webkit-scrollbar-thumb {
                                  background: #888; 
                                }
                                
                                /* Handle on hover */
                                ::-webkit-scrollbar-thumb:hover {
                                  background: #555; 
                                } body{background: #f5f5f5}.rounded{border-radius: 1rem}.nav-pills .nav-link{color: #555}.nav-pills .nav-link.active{color: white}input[type="radio"]{margin-right: 5px}.bold{font-weight:bold}</style>
                                </head>
                                <body className='snippet-body'>
                                <div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Select  Payment Method </h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Vod Cash </a> </li>
                            <!-- <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li> -->
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" method="post" >
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="cardowner" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" minlength="16" maxlength="16" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="exp_month" class="form-control" required> <input type="number" placeholder="YY" name="exp_year" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="number" name="cvv" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <input type="submit" name="submit" value="confirm" class="subscribe btn btn-primary btn-block shadow-sm"></button>
                            </form>
                        </div>
                    </div> <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                       
                        <!-- <div class="form-group "> <label class="radio-inline"> <input type="radio" name="optradio" checked> Domestic </label> <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">International </label></div> -->
                        <form action="" method="post">

                        <div class="form-group"> <label for="username">
                                        <h6>Vodafone Cash account </h6>
                                    </label> <input type="text" name="phonenumber" placeholder="Phone Number" required class="form-control "> </div>                  
                        <p> <input type="submit" name="submit" value="Confirm Payment" class="btn btn-primary ">  </p>
                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a page to verify your payment. </p>
                        </form>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
                                <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
                                <script type='text/javascript' src='#'></script>
                                <script type='text/javascript' src='#'></script>
                                <script type='text/javascript' src='#'></script>
                                <script type='text/javascript'>$(function() {
  $('[data-toggle="tooltip"]').tooltip()
})</script>
                                <script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
                                myLink.addEventListener('click', function(e) {
                                  e.preventDefault();
                                });</script>
                            
                                </body>
                            </html>


<!-- End -->
                    <!-- bank transfer info -->
                    <!-- <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>Bank Masr</option>
                                <option>Bank ElAhly</option>
                                
                              </select> </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button> </p>
                        </div>
                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                    </div> End -->
                    <!-- End -->