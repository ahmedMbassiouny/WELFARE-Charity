
<?php
 session_start();
//  require_once('donation.php');

  include_once "../client/top_codr.php";


//   $don = new donation();
require_once "../../Controller/projectController.php";

$projCN = new projectController();
$plans = $projCN->getAllPlans();

 // warning exist session user id and set to 12 in line 19
// data isset 
if (DataExist()){
   $_SESSION["name"]=$_POST['name'];
   $_SESSION["email"]=$_POST['email'];
   $_SESSION["number"]=$_POST['number'];
   $_SESSION["amount"]=$_POST['amount'];
   $_SESSION["paymentplan"]=$_POST['paymentplan'];
   $_SESSION["address"]=$_POST['address'];
   $_SESSION['verflag']=1;
   $_SESSION["proj_id"]=$_GET["project_id"];
   $_SESSION["org_id"]=$_GET["org_id"];
   header("Location: payment.php");
}

function exist($var){

	return  isset($_POST[$var]) && !empty($_POST[$var]);

}
function DataExist(){
			
  if(exist('name') && exist('number') && exist('email') && exist('address') && exist('amount')  && exist('paymentplan')){
      
    return true ;        
  }
  else
  {
    return false;
  }
}

 //exist('radio')
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>View</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/form.css">
 
</head>
<body>
  <section class="section about-section gray-bg" id="about">

    <div class="container">

        <div class="counter">
       <div style="text-align: center; margin-bottom: 3px; color:rgb(11, 11, 164);"><h3>Donation form</h3></div>

            <div class="row">

                <div  id="Dform">
                    <form action="" method="POST">
                       
                      <div class="form-group row">
                        <label for="name" class="col-3 col-form-label">Your name</label> 
                        <div class="col-9">
                          <input id="name" name="name" type="text" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Email</label> 
                        <div class="col-9">
                          <input id="email" name="email" type="email" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="number" class="col-3 col-form-label">Number</label> 
                        <div class="col-9">
                          <input id="number" name="number" type="number" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-3 col-form-label">Address</label> 
                        <div class="col-9">
                          <input id="address" name="address" type="text" class="form-control" required="required">
                        </div>
                      </div>
                      

                      <div class="form-group row">
                        <label for="number" class="col-3 col-form-label">Amount</label> 
                        <div class="col-9">
                          <input id="number" name="amount" type="amount" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="paymentplan" class="col-3 col-form-label">PaymentPlan</label> 
                        <div class="col-9">
                          <select id="paymentplan" name="paymentplan" class="custom-select" required="required">
                            <?php foreach($plans as $plan){ ?>
                            <option value="<?php echo $plan['id'];?>"><?php echo $plan['name'];?></option>
                              <?php }?>
                          </select>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <div class="offset-3 col-9">
                          
                          <input type="submit" style="margin-left: 100px; padding: 5px 15px;"  name="submit"  value="Next" class="btn btn-primary">
                        </div>
                      </div>
                    </form>               
                    </div>            
            </div>
        </div>
    </div>
   
</section>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>  

