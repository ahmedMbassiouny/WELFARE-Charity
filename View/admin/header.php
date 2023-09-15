    <?php
    include_once "../admin/top_code.php"
    ?>
    <!-- ======= header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <span class="d-none d-lg-block">Admin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center fs-5">

          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img class="rounded-circle" src="<?php echo $admin->get_image(); ?>" alt="">
              <!-- <i class="bi bi-person-circle"></i> -->
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $admin->get_name(); ?></span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?php echo $admin->get_name(); ?></h6>
                <span>Admin</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="profile.php">
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="account_settings.php">
                  <i class="bi bi-gear"></i>
                  <span>Account Settings</span>
                </a>
              </li>


              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="../auth/login.php?logout">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>Sign Out</span>
                </a>
              </li><!-- End logout Page Nav -->

            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

        </ul>
      </nav><!-- End Icons Navigation -->

    </header>
    <!-- End Header -->






    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php">
            <i class="bi bi-bar-chart-line"></i>
            <span>Reports</span>
          </a>
        </li><!-- End report Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="donations.php">
            <i class="bi bi-cart"></i>
            <span>Donations</span>
          </a>
        </li><!-- End Donations Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-lines-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="donors.php">
                <i class="bi bi-circle"></i><span>Donors</span>
              </a>
            </li>
            <li>
              <a href="volunteers.php">
                <i class="bi bi-circle"></i><span>Volunteers</span>
              </a>
            </li>
            <li>
              <a href="organizations.php">
                <i class="bi bi-circle"></i><span>Organizations</span>
              </a>
            </li>
          </ul>
        </li><!-- End Users Nav -->


        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-clipboard2-check"></i><span>Requests</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="project_req.php">
                <i class="bi bi-circle"></i><span>Project Request</span>
              </a>
            </li>
            <li>
              <a href="event_req.php">
                <i class="bi bi-circle"></i><span>Event Request</span>
              </a>
            </li>
          </ul>
        </li><!-- End Requests Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="projects.php">
            <i class="bi bi-cash-stack"></i> <span>Projects</span>
          </a>
        </li><!-- End Projects Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="events.php">
            <i class="bi bi-calendar-date-fill"></i>
            <span>Events</span>
          </a>
        </li><!-- End Events Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="payment_plans.php">
            <i class="bi bi-credit-card-2-front"></i>
            <span>Payment Plans</span>
          </a>
        </li><!-- End payment_plans Page Nav -->


        <li class="nav-item">
          <a class="nav-link collapsed" href="payment_methods.php">
            <i class="bi bi-credit-card-2-front-fill"></i> <span>Payment Methods</span>
          </a>
        </li><!-- End Fields Page Nav -->


        <li class="nav-item">
          <a class="nav-link collapsed" href="fields.php">
            <i class="bi bi-card-list"></i> <span>Fields</span>
          </a>
        </li><!-- End Fields Page Nav -->


        <li class="nav-item">
          <a class="nav-link collapsed" href="feedback.php">
            <i class="bi bi-hand-thumbs-up"></i> <span>Feedback</span>
          </a>
        </li><!-- End feedback Page Nav -->



        <li class="nav-heading">Pages</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="profile.php">
            <i class="bi bi-person"></i>
            <span>Profile</span>
          </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="account_settings.php">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="../auth/login.php?logout">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Sign Out</span>
          </a>
        </li><!-- End logout Page Nav -->

      </ul>

    </aside>
    <!-- End Sidebar-->