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

$adminCN = new adminController();

$total_amount = $adminCN->getTotalDonationAmount();

$num_of_donations = $adminCN->getDonationNum();
$num_of_volunteers = $adminCN->getVolunteersNum();
$num_of_events = $adminCN->getEventNum();
$num_of_donors = $adminCN->getDonorsNum();
$num_of_organizations = $adminCN->getOrganizationsNum();
$num_of_projects = $adminCN->getProjectNum();

$E_accepted = $adminCN->getacceptedEventNum();
$E_rejected  = $adminCN->getRejectedEventNum();
$E_waiting = $adminCN->getWaitingEventNum();

$P_accepted = $adminCN->getacceptedProjectNum();
$P_rejected  = $adminCN->getRejectedProjectNum();
$P_waiting = $adminCN->getWaitingProjectNum();




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ======= head-code ======= -->
  <?php
  include_once "../admin/head-code.php"
  ?>
  <!-- head-code -->
  <title>Home</title>

</head>

<body>

  <!-- ======= Header & siSidebar ======= -->
  <?php
  include_once "../admin/header.php"
  ?>
  <!-- End Header -->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div>
          <div class="row">

            <!-- Donations Card -->
            <div class="col-xxl-4 col-sm-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Donations</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_donations[0]["count"]; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Donations Card -->

            <!-- Total Amount Card -->
            <div class="col-xxl-4 col-sm-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total Amount</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$<?php echo $total_amount[0]["total"]; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Total Amount Card -->

            <!-- Donors Card -->
            <div class="col-xxl-4 col-sm-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Donors</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_donors[0]["count"]; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Donors Card -->

            <!-- Organizations Card -->
            <div class="col-xxl-4 col-sm-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Organizations</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_organizations[0]["count"]; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Organizations Card -->

            <!-- Volunteers Card -->
            <div class="col-xxl-4 col-sm-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Volunteers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_volunteers[0]["count"]; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Volunteers Card -->

            <!-- Events Card -->
            <div class="col-xxl-4 col-sm-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Events</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_events[0]["count"]; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Events Card -->

            <!-- projects Card -->
            <div class="col-xxl-12 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">projects</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $num_of_projects[0]["count"]; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End projects Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">


                <div class="card-body">
                  <h5 class="card-title">Reports <span>/This Year</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Donations',
                          data: [0, <?php echo $num_of_donations[0]["count"]; ?>],
                        }, {
                          name: 'Donors',
                          data: [0, <?php echo $num_of_donors[0]["count"]; ?>],
                        }, {
                          name: 'Organizations',
                          data: [0, <?php echo $num_of_organizations[0]["count"]; ?>],
                        }],
                        chart: {
                          height: 500,
                          type: 'area',
                          toolbar: {
                            show: true
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: true
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19", "2020-9-19"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <div class="col-12 col-lg-6">

              <!-- Website Traffic -->
              <div class="card">

                <div class="card-body pb-0">
                  <h5 class="card-title">Chariyt Users <span>| This Year</span></h5>

                  <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                          trigger: 'item'
                        },
                        legend: {
                          top: '5%',
                          left: 'center'
                        },
                        series: [{
                          name: 'Access From',
                          type: 'pie',
                          radius: ['40%', '70%'],
                          avoidLabelOverlap: false,
                          label: {
                            show: false,
                            position: 'center'
                          },
                          emphasis: {
                            label: {
                              show: true,
                              fontSize: '18',
                              fontWeight: 'bold'
                            }
                          },
                          labelLine: {
                            show: false
                          },
                          data: [{
                              value: <?php echo $num_of_donors[0]["count"]; ?>,
                              name: 'Donors'
                            },
                            {
                              value: <?php echo $num_of_organizations[0]["count"]; ?>,
                              name: 'Organizations'
                            },
                            {
                              value: <?php echo $num_of_volunteers[0]["count"]; ?>,
                              name: 'Volunteers'
                            }
                          ]
                        }]
                      });
                    });
                  </script>

                </div>
              </div><!-- End Website Traffic -->

            </div>

            <div class="col-12 col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Organizations requests</h5>

                  <!-- Pie Chart -->
                  <canvas id="pieChart" style="max-height: 400px;"></canvas>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#pieChart'), {
                        type: 'pie',
                        data: {
                          labels: [
                            'Rejected',
                            'Accepted',
                            'Waiting'
                          ],
                          datasets: [{
                            label: 'Projects',
                            data: [<?php echo $P_rejected[0]["count"]; ?>, <?php echo $P_accepted[0]["count"]; ?>, <?php echo $P_waiting[0]["count"]; ?>],
                            backgroundColor: [
                              'rgb(255, 99, 132)',
                              'rgb(54, 162, 235)',
                              'rgb(255, 205, 86)'
                            ],
                            hoverOffset: 4
                          }, {
                            label: 'Events',
                            data: [<?php echo $E_rejected[0]["count"]; ?>, <?php echo $E_accepted[0]["count"]; ?>, <?php echo $E_waiting[0]["count"]; ?>],
                            backgroundColor: [
                              'rgb(255, 99, 132)',
                              'rgb(54, 162, 235)',
                              'rgb(255, 205, 86)'
                            ],
                            hoverOffset: 4
                          }]
                        }
                      });
                    });
                  </script>
                  <!-- End Pie CHart -->

                </div>
              </div>
            </div>

          </div><!-- End Left side columns -->

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