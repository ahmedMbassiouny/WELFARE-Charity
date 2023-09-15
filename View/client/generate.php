
<?php
// Include autoloader 
session_start();



require_once "../client/dompdf/autoload.inc.php";

require_once "../../Controller/DBController.php";

$db = new DBController;
if ($db) {

  if (isset($_GET['transId'])) {
    $sql = "Select * from donation where id = {$_GET['transId']} ";
    $res = $db->select($sql);
    $query = "select organization.address , user.name , user.email from donation inner join organization on organization.id = org_id INNER join user on organization.user_id=user.id WHERE donation.id= {$_GET['transId']}";
    $data = $db->select($query);
    $query1 = "select project_req.proj_name from donation inner join project on project.id = proj_id INNER join project_req  on project.req_id=project_req.id WHERE donation.id= {$_GET['transId']}";
    $ww = $db->select($query1);
  }
}
// Reference the Dompdf namespace 
use Dompdf\Dompdf;

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
$name = 'makboul';





// Load HTML content with options to set CSS path
$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>invoice with client info description amount and pay now button - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>' . file_get_contents('css/style.css') . '</style>

<style>' . file_get_contents('../client/assets/css/pdf.css') . ' </style>

</head>
<body>
    <div class="container mt-6 mb-7" style="margin-top:100px">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-xl-7">
            <div class="card">
              <div class="card-body p-5">
                <h2>
                  Hey ,' . $res[0]['sec_name'] . '
                </h2>
                
    
                <div class="border-top border-gray-200 pt-4 mt-4">
                  <div class="row">
                    <div class="col-md-6">
                      <hr>
                      <div class="text-muted mb-2">Payment No.</div>
                      <strong>#' . $_GET['transId'] . '</strong>
                    </div>
                    <div class="col-md-6 text-md-end">
                      <div class="text-muted mb-2">Payment Date</div>
                      <strong>' . substr($res[0]['start_time'], 0, 10) . '</strong>
                      <hr>
                    </div>
                  </div>
                </div>
    
                <div class="border-top border-gray-200 mt-4 py-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="text-muted mb-2">Client</div>
                      <strong>
                        ' . $res[0]['sec_name'] . '
                      </strong>
                      <p class="fs-sm">
                        ' . $res[0]['address'] . '
                        <br>
                        <a href="#!" class="text-purple">' . $res[0]['email'] . '
                        </a>
                      </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                      <div class="text-muted mb-2">Payment To</div>
                      <strong>
                        ' . $data[0]['name'] . '
                      </strong>
                      <p class="fs-sm">
                        ' . $data[0]['address'] . '
                        <br>
                        <a href="#!" class="text-purple">' . $data[0]['email'] . '
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
    
                <table class="table border-bottom border-gray-200 mt-3">
                  <thead>
                    <tr>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Description</th>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="px-0">' . $ww[0]['proj_name'] . '</td>
                      <td class="text-end px-0">' . $res[0]['amount'] . ' L.E</td>
                    </tr>
                    
                  </tbody>
                </table>
    
                <div class="mt-5">
                  
                  <div class="d-flex justify-content-end mt-3">
                    <h5 class="me-3">Total:</h5>
                    <h5 class="text-success" style="color:green;">' . $res[0]['amount'] . ' EGP</h5>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>

</body>
</html>

';
$options = new \Dompdf\Options();
$options->set('isRemoteEnabled', TRUE);

// Instantiate DOMPDF and load HTML content
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);




// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF 
$dompdf->render();
$dompdf->addInfo('Title', 'invoice');

// Output the generated PDF to Browser 
$dompdf->stream('invoice', array("Attachment" => false));

?>

